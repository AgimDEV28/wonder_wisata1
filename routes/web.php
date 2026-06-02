<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PlaceController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PlaceController::class, 'landing'])->name('home');

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/places', [PlaceController::class, 'index'])->name('places.index');
Route::get('/places/{place}', [PlaceController::class, 'show'])->name('places.show');

Route::middleware('auth')->group(function () {
    Route::post('/places/{place}/order', [PlaceController::class, 'order'])->name('places.order');
    Route::get('/orders', [DashboardController::class, 'userOrders'])->name('orders.index');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
Route::get('/admin', [DashboardController::class, 'adminDashboard'])->name('admin.dashboard');
Route::post('/admin/orders/{order}/approve', [DashboardController::class, 'approve'])->name('admin.orders.approve');
