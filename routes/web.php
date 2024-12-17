<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CarController;
use  Illuminate\Support\Facades\Facade;
use App\Http\Controllers\NotificationController;
use App\Models\Notification;


Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
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
    Route::delete('/cars/{id}/remove', [CarController::class, 'removeCar'])->name('cars.remove');
    
    // Wishlist routes
    Route::get('/wishlist', [CarController::class, 'showWishlist'])->name('wishlist.index');
    Route::post('/wishlist/add/{car}', [CarController::class, 'addToWishlist'])->name('wishlist.add');
    Route::delete('/wishlist/remove/{car}', [CarController::class, 'removeFromWishlist'])->name('wishlist.remove');

    // Marketplace routes
    Route::get('/marketplace', [CarController::class, 'marketplace'])->name('marketplace');
    Route::put('/cars/{id}/toggle-sale', [CarController::class, 'toggleSale'])->name('cars.toggleSale');
    Route::post('/cars/{id}/remove-sale', [CarController::class, 'removeSalePost'])->name('removeSalePost');

    // Route for comparing cars
    Route::post('/cars/compare', [CarController::class, 'compare'])->name('cars.compare');

    // Notification routes
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::post('/notifications/{notification}/mark-as-read', [NotificationController::class, 'markAsRead'])->name('notifications.markAsRead');
    Route::post('/notifications/mark-all-as-read', [NotificationController::class, 'markAllAsRead'])->name('notifications.markAllAsRead');
});

// Admin routes
Route::middleware(['auth', 'admin'])->group(function () {
    // Admin Dashboard
    Route::get('admin/dashboard', [HomeController::class, 'adminDashboard'])->name('admin.dashboard');

    // Edit user
    Route::get('admin/user/{user}/edit', [HomeController::class, 'editUser'])->name('admin.edit');

    // Update user
    Route::patch('admin/user/{user}', [HomeController::class, 'updateUser'])->name('admin.update');

    // Delete user
    Route::delete('admin/user/{user}', [HomeController::class, 'deleteUser'])->name('admin.delete');
});

Route::post('/remove-sell/{car}', [CarController::class, 'removeSell'])->name('remove.sell.post');

Route::post('/delete-comment/{id}', function ($id) {
    $comment = \App\Models\Comment::find($id);

    if ($comment) {
        $comment->delete();
        return redirect()->back()->with('success', 'Comment deleted successfully.');
    }

    return redirect()->back()->with('error', 'Comment not found.');
})->name('delete.comment')->middleware('auth');

Route::post('/car/{id}/comment', [CarController::class, 'storeComment'])->name('storeComment');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

require __DIR__.'/auth.php';
