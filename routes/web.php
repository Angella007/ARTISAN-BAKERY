<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Public routes
Route::get('/', function () {
    return view('index');
})->name('home');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

// Protected routes - require authentication for customers
Route::middleware(['auth'])->group(function () {
    // Customer order submission (from contact form) - requires login
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
});

// Protected admin routes - require authentication AND admin privileges
Route::middleware(['auth', 'admin'])->group(function () {
    // Dashboard - shows all customer orders with details
    Route::get('/admin/dashboard', function () {
        return view('dashboard');
    })->name('admin.dashboard');
    
    // Order management routes (CRUD)
    Route::get('/admin/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/admin/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    Route::get('/admin/orders/{order}/edit', [OrderController::class, 'edit'])->name('orders.edit');
    Route::put('/admin/orders/{order}', [OrderController::class, 'update'])->name('orders.update');
    Route::delete('/admin/orders/{order}', [OrderController::class, 'destroy'])->name('orders.destroy');
    
    // Additional order filtering route
    Route::get('/admin/orders/type/{type}', [OrderController::class, 'byType'])->name('orders.byType');
    
    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
