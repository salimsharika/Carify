<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Car;

class CarController extends Controller
{
    // Show the dashboard
    public function index()
    {
        $cars = Car::where('user_id', Auth::id())->get();
        return view('dashboard', compact('cars'));
    }

    // Show the form to add a car
    public function create()
    {
        return view('addCar');
    }

    // Store the car information
    public function store(Request $request)
    {
        $request->validate([
            'car_name' => 'required|string|max:255',
            'distance_travelled' => 'required|numeric|min:0',
            'date_of_purchase' => 'required|date|before_or_equal:today',
        ]);

        Car::create([
            'car_name' => $request->car_name,
            'distance_travelled' => $request->distance_travelled,
            'date_of_purchase' => $request->date_of_purchase,
            'user_id' => Auth::id(),
            'is_for_sale' => false,
        ]);

        return redirect()->route('dashboard')->with('success', 'Car added successfully!');
    }

    // Show the form to edit a car
    public function edit($id)
    {
        $car = Car::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        return view('editCar', compact('car'));
    }

    // Update the car details
    public function update(Request $request, $id)
    {
        $car = Car::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        $request->validate([
            'car_name' => 'required|string|max:255',
            'distance_travelled' => 'required|numeric|min:0',
            'date_of_purchase' => 'required|date|before_or_equal:today',
        ]);

        $car->update([
            'car_name' => $request->car_name,
            'distance_travelled' => $request->distance_travelled,
            'date_of_purchase' => $request->date_of_purchase,
        ]);

        return redirect()->route('dashboard')->with('success', 'Car updated successfully!');
    }

    // Show suggestions for a car
    public function showSuggestions($id)
    {
        $car = Car::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $distance = $car->distance_travelled;

        $suggestions = [];
        if ($distance >= 8000 && $distance < 16000) {
            $suggestions = ['Verify fluid levels', 'Check and adjust tire pressure', 'Inspect belts and hoses'];
        } elseif ($distance >= 16000 && $distance < 24000) {
            $suggestions = ['Replace air filter', 'Oil change', 'Replace oil filter'];
        } elseif ($distance >= 24000 && $distance < 32000) {
            $suggestions = ['Inspect brake pads and rotors', 'Inspect and replace wiper blades'];
        } elseif ($distance >= 40000 && $distance < 48000) {
            $suggestions = ['Inspect and replace timing belt'];
        } elseif ($distance >= 48000 && $distance < 56000) {
            $suggestions = ['Inspect and replace serpentine belt'];
        } elseif ($distance >= 56000 && $distance < 64000) {
            $suggestions = ['Inspect and replace coolant'];
        } else {
            $suggestions = ['No specific suggestions available for this distance range.'];
        }

        return view('carSuggestions', compact('car', 'suggestions'));
    }

    public function marketplace()
    {
        $cars = Car::where('is_for_sale', true)
            ->with(['owner', 'comments.user'])
            ->orderBy('created_at', 'desc')
            ->get();
            
        return view('marketplace', compact('cars'));
    }

    public function toggleSale($id)
    {
        $car = Car::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $car->update([
            'is_for_sale' => !$car->is_for_sale
        ]);

        $message = $car->is_for_sale ? 
            'Car has been listed in the marketplace!' : 
            'Car has been removed from the marketplace!';

        return redirect()->back()->with('success', $message);
    }

    public function storeComment(Request $request, $carId)
    {
        $request->validate([
            'comment' => 'required|string|max:500',
        ]);

        $car = Car::findOrFail($carId);

        $car->comments()->create([
            'user_id' => Auth::id(),
            'comment' => $request->comment,
        ]);

        return redirect()->route('marketplace')->with('success', 'Comment added successfully!');
    }

    /**
     * Add a car to the user's wishlist.
     *
     * @param  int  $carId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addToWishlist($carId)
    {
        $user = auth()->user();
        if ($user->wishlist()->where('car_id', $carId)->exists()) {
            return redirect()->back()->with('info', 'Car is already in your wishlist.');
        }
        $user->wishlist()->attach($carId);

        return redirect()->back()->with('success', 'Car added to wishlist!');
    }

    /**
     * Remove a car from the user's wishlist.
     *
     * @param  int  $carId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function removeFromWishlist($carId)
    {
        $user = auth()->user();
        $user->wishlist()->detach($carId);

        return redirect()->back()->with('success', 'Car removed from wishlist!');
    }

    /**
     * Display the user's wishlist.
     *
     * @return \Illuminate\View\View
     */
    public function showWishlist()
    {
        $user = auth()->user();
        $wishlistCars = $user->wishlist()->with('owner')->get();

        return view('wishlist', compact('wishlistCars'));
    }

    /**
     * Compare selected cars.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function compare(Request $request)
    {
        $carIds = $request->input('car_ids');
        $cars = Car::whereIn('id', $carIds)->get();

        if ($cars->count() !== 2) {
            return redirect()->back()->with('error', 'Please select exactly two cars to compare.');
        }

        return view('compare', compact('cars'));
    }
}
