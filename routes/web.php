<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\DashboardController;

// Dashboard utama
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

// AJAX routes for dashboard
Route::post('/add-to-cart', [DashboardController::class, 'addToCart'])->name('add.to.cart');

// Pelanggan Routes - login dan register dengan controller
Route::prefix('pelanggan')->name('pelanggan.')->group(function () {
    Route::get('/login', [PelangganController::class, 'showLogin'])->name('login');
    Route::post('/login', [PelangganController::class, 'login'])->name('login.submit');

    Route::get('/register', [PelangganController::class, 'showRegister'])->name('register');
    Route::post('/register', [PelangganController::class, 'register'])->name('register.submit');

    Route::post('/logout', [PelangganController::class, 'logout'])->name('logout');
});

// Gudang Routes
Route::prefix('gudang')->name('gudang.')->group(function () {
    Route::get('/login', function () {
        return view('gudang.login');
    })->name('login');

    Route::get('/manual', function () {
        return view('gudang.manual');
    })->name('manual');

      Route::get('/dahsboard', function () {
        return view('gudang.dahsboard');
    })->name('dahsboard');

      Route::get('/permintaan', function () {
        return view('gudang.permintaan');
    })->name('permintaan');

    Route::get('/pengiriman', function () {
        return view('gudang.pengiriman');
    })->name('pengiriman');
   
   Route::get('/stok', function () {
        return view('gudang.stok');
    })->name('stok');

        Route::get('/inventori', function () {
        return view('gudang.inventori');
    })->name('inventori');

        Route::get('/pemasok', function () {
        return view('gudang.pemasok');
    })->name('pemasok');

        Route::get('/resiko', function () {
        return view('gudang.resiko');
    })->name('resiko');

        Route::get('/logistik', function () {
        return view('gudang.logistik');
    })->name('logistik');

    // Route::post('/login', [App\Http\Controllers\GudangController::class, 'login'])->name('login.submit');
    // Route::get('/dashboard', [App\Http\Controllers\GudangController::class, 'dashboard'])->name('dashboard');
});

Route::get('/dashboard', function () {
    return view('dashboard.index');
})->name('dashboard.index');

// Route::post('/pelanggan/login', [App\Http\Controllers\PelangganController::class, 'login'])->name('pelanggan.login.submit');
// Route::post('/pelanggan/register', [App\Http\Controllers\PelangganController::class, 'register'])->name('pelanggan.register.submit');
 

   