<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Car;

class CarController extends Controller
{
    public function create()
    {
        return view('addCar');
    }

    public function store(Request $request)
    {
        $request->validate([
            'car_name' => 'required|string|max:255',
            'distance_travelled' => 'required|numeric',
            'date_of_purchase' => 'required|date',
        ]);

        Car::create([
            'user_id' => Auth::id(),
            'car_name' => $request->car_name,
            'distance_travelled' => $request->distance_travelled,
            'date_of_purchase' => $request->date_of_purchase,
        ]);

        return redirect()->route('dashboard')->with('success', 'Car added successfully!');
    }
}
