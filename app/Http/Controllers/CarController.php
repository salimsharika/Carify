<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Car;
use Illuminate\Support\Facades\DB;

class CarController extends Controller
{
    // Show the dashboard
    public function index()
    {
        $user = auth()->user();
        $cars = Car::where('user_id', auth()->id())->get();
        $totalCars = $cars->count();
        $carsForSale = $cars->where('is_for_sale', true)->count();
        $maintenanceDue = $cars->where('next_maintenance', '<=', now())->count();
        
        // Simple workaround - just count raw database entries
        $wishlistCount = DB::table('wishlists')->where('user_id', auth()->id())->count();

        return view('dashboard', compact('cars', 'totalCars', 'carsForSale', 'maintenanceDue', 'wishlistCount'));
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
        $car = Car::findOrFail($id);
        $distance = $car->distance_travelled;
        
        // Get similar cars
        $similarCars = Car::where('car_name', 'LIKE', '%' . $car->car_name . '%')
                         ->where('id', '!=', $car->id)
                         ->where('is_for_sale', true)
                         ->get();

        // Get maintenance suggestions based on distance
        $maintenanceSuggestions = [];
        
        // Basic maintenance (every 5,000 km)
        if ($distance % 5000 <= 1000) {
            $maintenanceSuggestions[] = [
                'type' => 'Regular Check',
                'items' => [
                    'Check and top up all fluid levels',
                    'Inspect tire pressure and condition',
                    'Check all lights and signals'
                ]
            ];
        }

        // Oil change (every 8,000 km)
        if ($distance % 8000 <= 1000) {
            $maintenanceSuggestions[] = [
                'type' => 'Oil Service',
                'items' => [
                    'Change engine oil',
                    'Replace oil filter',
                    'Check air filter condition'
                ]
            ];
        }

        // Tire rotation (every 10,000 km)
        if ($distance % 10000 <= 1000) {
            $maintenanceSuggestions[] = [
                'type' => 'Tire Service',
                'items' => [
                    'Rotate tires',
                    'Check wheel alignment',
                    'Check brake pad condition'
                ]
            ];
        }

        // Major service suggestions based on total distance
        if ($distance >= 20000 && $distance < 25000) {
            $maintenanceSuggestions[] = [
                'type' => 'Major Service',
                'items' => [
                    'Replace air filter',
                    'Replace cabin filter',
                    'Inspect brake system',
                    'Check suspension components'
                ]
            ];
        } elseif ($distance >= 40000 && $distance < 45000) {
            $maintenanceSuggestions[] = [
                'type' => 'Major Service',
                'items' => [
                    'Replace spark plugs',
                    'Replace transmission fluid',
                    'Check timing belt condition',
                    'Inspect cooling system'
                ]
            ];
        } elseif ($distance >= 60000 && $distance < 65000) {
            $maintenanceSuggestions[] = [
                'type' => 'Major Service',
                'items' => [
                    'Replace timing belt',
                    'Replace water pump',
                    'Replace brake fluid',
                    'Check engine mounts'
                ]
            ];
        }

        // Brake fluid (every 30,000 km)
        if ($distance % 30000 <= 1000) {
            $maintenanceSuggestions[] = [
                'type' => 'Brake Service',
                'items' => [
                    'Replace brake fluid',
                    'Inspect brake lines',
                    'Check brake pedal feel'
                ]
            ];
        }

        // Transmission service (every 40,000 km)
        if ($distance % 40000 <= 1000) {
            $maintenanceSuggestions[] = [
                'type' => 'Transmission Service',
                'items' => [
                    'Replace transmission fluid',
                    'Check transmission mounts',
                    'Inspect CV joints and boots'
                ]
            ];
        }

        return view('carSuggestions', [
            'car' => $car,
            'suggestions' => $similarCars,
            'maintenanceSuggestions' => $maintenanceSuggestions
        ]);
    }

    public function showSuggestionsNew($id)
    {
        $car = Car::findOrFail($id);
        
        // Get similar cars based on name similarity
        $similarCars = Car::where('car_name', 'LIKE', '%' . $car->car_name . '%')
                         ->where('id', '!=', $car->id)
                         ->where('is_for_sale', true)
                         ->get();
        
        // Get cars with similar distance travelled (±20%)
        $similarDistanceCars = Car::whereBetween('distance_travelled', [
                                $car->distance_travelled * 0.8,
                                $car->distance_travelled * 1.2
                            ])
                            ->where('id', '!=', $car->id)
                            ->where('is_for_sale', true)
                            ->get();
        
        return view('cars.suggestions', [
            'car' => $car,
            'similarCars' => $similarCars,
            'priceRangeCars' => $similarDistanceCars
        ]);
    }

    public function marketplace()
    {
        // Get cars that are for sale with their relationships
        $cars = Car::where('is_for_sale', true)
                  ->with(['owner', 'comments.user'])
                  ->get();

        // Get the current user's wishlist car IDs
        $wishlistCarIds = collect([]);
        if (auth()->check()) {
            $wishlistCarIds = auth()->user()
                ->wishlist()
                ->pluck('cars.id')
                ->toArray();
        }

        return view('marketplace', [
            'cars' => $cars,
            'wishlistCarIds' => $wishlistCarIds
        ]);
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
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addToWishlist($id)
    {
        try {
            $car = Car::findOrFail($id);
            $user = auth()->user();
            
            // Check if car exists and is for sale
            if (!$car->is_for_sale) {
                return back()->with('error', 'This car is not available for wishlist.');
            }

            // Check if user owns the car
            if ($car->user_id === $user->id) {
                return back()->with('error', 'You cannot add your own car to wishlist.');
            }

            // Check if car is already in wishlist
            if ($user->wishlist()->where('car_id', $id)->exists()) {
                return back()->with('info', 'This car is already in your wishlist.');
            }

            // Add to wishlist
            $user->wishlist()->attach($id);
            
            return back()->with('success', 'Car added to wishlist successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'Could not add car to wishlist. Please try again.');
        }
    }

    /**
     * Remove a car from the user's wishlist.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function removeFromWishlist($id)
    {
        try {
            $user = auth()->user();
            $user->wishlist()->detach($id);
            return back()->with('success', 'Car removed from your wishlist.');
        } catch (\Exception $e) {
            return back()->with('error', 'Error removing car from wishlist.');
        }
    }

    /**
     * Display the user's wishlist.
     *
     * @return \Illuminate\View\View
     */
    public function showWishlist()
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Please login to view your wishlist.');
        }

        $user = auth()->user();
        $wishlistCars = $user->wishlist()->with('owner')->get();

        if ($wishlistCars === null) {
            $wishlistCars = collect(); // Create an empty collection if null
        }

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

   public function removeSell($carId)
   {
       $car = Car::findOrFail($carId);
       $car->is_for_sale = false;
       $car->save();
   
       return redirect()->route('marketplace')->with('success', 'Car removed from sale.');
   }
   
   public function removeSalePost($id)
    {
        $car = Car::findOrFail($id);
        
        // Check if user owns the car or is admin
        if (auth()->id() !== $car->user_id && auth()->user()->usertype !== 'admin') {
            return redirect()->back()->with('error', 'Unauthorized action.');
        }

        $car->update(['is_for_sale' => false]);
        
        return redirect()->route('marketplace')->with('success', 'Car removed from marketplace.');
    }

    // Remove a car from the user's dashboard
    public function removeCar($id)
    {
        try {
            $car = Car::where('id', $id)
                     ->where('user_id', auth()->id())
                     ->firstOrFail();

            // Delete any related records first (if you have any)
            // For example: $car->comments()->delete();
            
            $car->delete();

            return response()->json([
                'success' => true,
                'message' => 'Car removed successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error removing car'
            ], 500);
        }
    }
}
