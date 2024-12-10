<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CarController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Car management routes
    Route::get('/dashboard', [CarController::class, 'index'])->name('dashboard');
    Route::get('/car/add', [CarController::class, 'create'])->name('addCar');
    Route::post('/car/add', [CarController::class, 'store'])->name('storeCar');
    Route::get('/car/{id}/edit', [CarController::class, 'edit'])->name('editCar');
    Route::post('/car/{id}/update', [CarController::class, 'update'])->name('updateCar');
    Route::get('/car/{id}/suggestions', [CarController::class, 'showSuggestions'])->name('showCarSuggestions');
    
    // Wishlist routes
    Route::get('/wishlist', [CarController::class, 'showWishlist'])->name('wishlist.index');
    Route::post('/wishlist/add/{car}', [CarController::class, 'addToWishlist'])->name('wishlist.add');
    Route::delete('/wishlist/remove/{car}', [CarController::class, 'removeFromWishlist'])->name('wishlist.remove');

    // Marketplace routes
    Route::get('/marketplace', [CarController::class, 'marketplace'])->name('marketplace');
    Route::post('/car/{id}/toggle-sale', [CarController::class, 'toggleSale'])->name('toggleSale');

    // Route for comparing cars
    Route::post('/cars/compare', [CarController::class, 'compare'])->name('cars.compare');
});

// Admin routes
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('admin/dashboard', [HomeController::class, 'index'])->name('admin.dashboard');
});

require __DIR__.'/auth.php';
Route::post('/car/{id}/comment', [CarController::class, 'storeComment'])->name('storeComment');