<?php

use Illuminate\Support\Facades\Route;

// Pelanggan Routes
Route::get('/login', function () {
    return view('pelanggan.login');
})->name('pelanggan.login');

Route::get('/register', function () {
    return view('pelanggan.register');
})->name('pelanggan.register');

// Gudang Routes
Route::prefix('gudang')->name('gudang.')->group(function () {
    Route::get('/login', function () {
        return view('gudang.login');
    })->name('login');

    Route::get('/manual', function () {
        return view('gudang.manual');
    })->name('manual');

    // Route::post('/login', [App\Http\Controllers\GudangController::class, 'login'])->name('login.submit');
    // Route::get('/dashboard', [App\Http\Controllers\GudangController::class, 'dashboard'])->name('dashboard');
});

// Route::post('/pelanggan/login', [App\Http\Controllers\PelangganController::class, 'login'])->name('pelanggan.login.submit');
// Route::post('/pelanggan/register', [App\Http\Controllers\PelangganController::class, 'register'])->name('pelanggan.register.submit');
