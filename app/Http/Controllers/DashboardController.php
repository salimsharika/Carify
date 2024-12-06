<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Car;

class DashboardController extends Controller
{
    public function index()
    {
        $cars = Car::where('user_id', Auth::id())->get();

        return view('dashboard', compact('cars'));
    }
}
