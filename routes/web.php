<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserDashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::get('register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('register', [AuthController::class, 'register']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');


// User routes
Route::prefix('user')->name('user.')->group(function () {
    Route::middleware('auth')->group(function () {
        Route::get('dashboard', [UserDashboardController::class, 'index'])->name('dashboard');
    });
});


// Admin Routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::redirect('', '/admin/dashboard');
    Route::middleware('auth.admin')->group(function () {
        Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    });
});
