<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\DashboardController;




Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});




require __DIR__.'/auth.php';


route::get('admin/dashboard',[HomeController::class,'index'])->middleware(['auth','admin']);



// Dashboard route
Route::get('/dashboard', [CarController::class, 'index'])->name('dashboard');

// Add a car
Route::get('/car/add', [CarController::class, 'create'])->name('addCar');
Route::post('/car/add', [CarController::class, 'store']);

// Edit a car
Route::get('/car/{id}/edit', [CarController::class, 'edit'])->name('editCar');
Route::post('/car/{id}/update', [CarController::class, 'update'])->name('updateCar');

// Show car suggestions
Route::get('/car/{id}/suggestions', [CarController::class, 'showSuggestions'])->name('showCarSuggestions');
