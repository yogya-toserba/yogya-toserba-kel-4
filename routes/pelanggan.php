<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PelangganForgotPasswordController;

// Pelanggan Routes - login and register with controller
Route::prefix('pelanggan')->name('pelanggan.')->group(function () {
    Route::get('/login', [PelangganController::class, 'showLogin'])->name('login');
    Route::post('/login', [PelangganController::class, 'login'])->name('login.submit');

    Route::get('/register', [PelangganController::class, 'showRegister'])->name('register');
    Route::post('/register', [PelangganController::class, 'register'])->name('register.submit');

    Route::post('/logout', [PelangganController::class, 'logout'])->name('logout');

    // Forgot Password Routes
    Route::get('/forgot-password', [PelangganForgotPasswordController::class, 'showForgotPasswordForm'])->name('password.request');
    Route::post('/forgot-password', [PelangganForgotPasswordController::class, 'sendResetCode'])->name('password.email');
    Route::get('/verify-code', [PelangganForgotPasswordController::class, 'showVerifyCodeForm'])->name('verify.code.form');
    Route::post('/verify-code', [PelangganForgotPasswordController::class, 'verifyCode'])->name('verify.code');
    Route::get('/reset-password/{token}', [PelangganForgotPasswordController::class, 'showResetPasswordForm'])->name('password.reset');
    Route::post('/reset-password', [PelangganForgotPasswordController::class, 'resetPassword'])->name('password.update');

    // Search route (available to all customers)
    Route::get('/search', [PelangganController::class, 'search'])->name('search');
    Route::get('/search/suggestions', [PelangganController::class, 'searchSuggestions'])->name('search.suggestions');

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
