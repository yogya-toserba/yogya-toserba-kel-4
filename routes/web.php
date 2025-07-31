<?php

use Illuminate\Support\Facades\Route;

Route::get('/login', function () {
    return view('pelanggan.login');
})->name('pelanggan.login');

Route::get('/register', function () {
    return view('pelanggan.register');
})->name('pelanggan.register');

// Route::post('/pelanggan/login', [App\Http\Controllers\PelangganController::class, 'login'])->name('pelanggan.login.submit');
// Route::post('/pelanggan/register', [App\Http\Controllers\PelangganController::class, 'register'])->name('pelanggan.register.submit');
