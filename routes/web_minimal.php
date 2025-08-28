<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;

// Dashboard utama
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

// Pelanggan Routes - login dan register dengan controller
Route::prefix('pelanggan')->name('pelanggan.')->group(function () {
    Route::get('/login', [PelangganController::class, 'showLogin'])->name('login');
    Route::post('/login', [PelangganController::class, 'login'])->name('login.submit');

    Route::get('/register', [PelangganController::class, 'showRegister'])->name('register');
    Route::post('/register', [PelangganController::class, 'register'])->name('register.submit');

    Route::post('/logout', [PelangganController::class, 'logout'])->name('logout');
});

// Test route to verify pelanggan routes work
Route::get('/test-pelanggan-routes', function () {
    return response()->json([
        'message' => 'Pelanggan routes are working!',
        'routes' => [
            'login_form' => route('pelanggan.login'),
            'login_submit' => route('pelanggan.login.submit'), 
            'register_form' => route('pelanggan.register'),
            'register_submit' => route('pelanggan.register.submit'),
            'dashboard' => route('dashboard')
        ]
    ]);
})->name('test.pelanggan.routes');
