<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\AdminTicketController;
use App\Http\Controllers\UserTicketController;


Route::get('/', function () {
    return view('home');
})->name('home');


// Auth Routes
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::get('register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('register', [AuthController::class, 'register']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');


// User routes
Route::prefix('user')->name('user.')->group(function () {
    Route::middleware('auth')->group(function () {
        Route::get('tickets', [UserTicketController::class, 'index'])->name('tickets');
        Route::get('tickets/create', [UserTicketController::class, 'create'])->name('tickets.create');
        Route::post('tickets', [UserTicketController::class, 'store'])->name('tickets.store');
        Route::get('tickets/{ticket}', [UserTicketController::class, 'show'])->name('tickets.show');
        Route::post('tickets/{ticket}/message', [UserTicketController::class, 'sendMessage']);
    });
});


// Admin Routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::redirect('', '/admin/tickets');
    Route::middleware('auth.admin')->group(function () {
        Route::get('tickets', [AdminTicketController::class, 'index'])->name('tickets');
        Route::get('tickets/{ticket}', [AdminTicketController::class, 'show'])->name('tickets.show');
        Route::post('/tickets/{ticket}/open', [AdminTicketController::class, 'open'])->name('tickets.open');
        Route::post('/tickets/{ticket}/close', [AdminTicketController::class, 'close'])->name('tickets.close');
        Route::post('tickets/{ticket}/message', [AdminTicketController::class, 'sendMessage']);
    });
});
