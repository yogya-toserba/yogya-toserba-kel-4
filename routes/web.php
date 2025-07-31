<?php

Route::get('/pelanggan/login', function () {
    return view('pelanggan.login');
})->name('pelanggan.login');

// Route::post('/pelanggan/login', [App\Http\Controllers\PelangganController::class, 'login'])->name('pelanggan.login.submit');
