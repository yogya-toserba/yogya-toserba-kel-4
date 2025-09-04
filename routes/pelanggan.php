<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PelangganController;

// Pelanggan Routes - login and register with controller
Route::prefix('pelanggan')->name('pelanggan.')->group(function () {
    Route::get('/login', [PelangganController::class, 'showLogin'])->name('login');
    Route::post('/login', [PelangganController::class, 'login'])->name('login.submit');

    Route::get('/register', [PelangganController::class, 'showRegister'])->name('register');
    Route::post('/register', [PelangganController::class, 'register'])->name('register.submit');

    Route::post('/logout', [PelangganController::class, 'logout'])->name('logout');
    
    // Search route (available to all customers)
    Route::get('/search', [PelangganController::class, 'search'])->name('search');
    
    // Protected pelanggan routes
    Route::middleware('auth:pelanggan')->group(function () {
        Route::get('/dashboard', [PelangganController::class, 'dashboard'])->name('dashboard');
        Route::get('/profile', [PelangganController::class, 'profile'])->name('profile');
        Route::post('/profile', [PelangganController::class, 'updateProfile'])->name('profile.update');
        Route::post('/profile/password', [PelangganController::class, 'updatePassword'])->name('profile.password');
    });

    // Public routes for customer help
    Route::get('/manual', function () {
        return view('pelanggan.manual');
    })->name('manual');

    Route::get('/bantuan-it', function () {
        return view('pelanggan.bantuan-it');
    })->name('bantuan-it');

    Route::get('/kontak-admin', function () {
        return view('pelanggan.kontak-admin');
    })->name('kontak-admin');
});
