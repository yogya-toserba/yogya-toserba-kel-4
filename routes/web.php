<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminProductController;
use App\Http\Controllers\AdminOrderController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AdminReportController;
// Add the following import if not already present
use App\Http\Controllers\AdminPasswordResetController;

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

    Route::get('/iventory', [ProductController::class, 'index'])->name('iventory');
    Route::get('/inventory', [ProductController::class, 'index'])->name('inventory.index');
    Route::get('/inventory/create', [ProductController::class, 'create'])->name('inventory.create');
    Route::post('/inventory', [ProductController::class, 'store'])->name('inventory.store');
    // Route::post('/login', [App\Http\Controllers\GudangController::class, 'login'])->name('login.submit');
    // Route::get('/dashboard', [App\Http\Controllers\GudangController::class, 'dashboard'])->name('dashboard');

});

// Dashboard route
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

// Route kategori elektronik
Route::get('/kategori/elektronik', function () {
    return view('dashboard.kategori.elektronik');
})->name('kategori.elektronik');

// Route kategori fashion
Route::get('/kategori/fashion', function () {
    return view('dashboard.kategori.fashion');
})->name('kategori.fashion');

// Route kategori makanan & minuman
Route::get('/kategori/makanan-minuman', function () {
    return view('dashboard.kategori.makanan-minuman');
})->name('kategori.makanan-minuman');

// Route kategori kesehatan & kecantikan
Route::get('/kategori/kesehatan-kecantikan', function () {
    return view('dashboard.kategori.kesehatan-kecantikan');
})->name('kategori.kesehatan-kecantikan');

// Route kategori rumah tangga
Route::get('/kategori/rumah-tangga', function () {
    return view('dashboard.kategori.rumah-tangga');
})->name('kategori.rumah-tangga');

// Route kategori olahraga
Route::get('/kategori/olahraga', function () {
    return view('dashboard.kategori.olahraga');
})->name('kategori.olahraga');


// Route::post('/pelanggan/login', [App\Http\Controllers\PelangganController::class, 'login'])->name('pelanggan.login.submit');
// Route::post('/pelanggan/register', [App\Http\Controllers\PelangganController::class, 'register'])->name('pelanggan.register.submit');

Route::prefix('admin')->name('admin.')->group(function () {
    // Authentication Routes
    Route::get('/login', [AdminController::class, 'showLogin'])->name('login');
    Route::post('/login', [AdminController::class, 'login'])->name('login.submit');
    Route::post('/logout', [AdminController::class, 'logout'])->name('logout');

    // Protected Admin Routes
    Route::middleware(['auth:admin'])->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::get('/profile', [AdminController::class, 'profile'])->name('profile');
        Route::post('/profile', [AdminController::class, 'updateProfile'])->name('profile.update');
        route::get('penggajian', function () {
            return view('admin.penggajian');
        })->name('penggajian');
        route::get('laporan', function () {
            return view('admin.laporan');
        })->name('laporan');
        route::get('absensi', function () {
            return view('admin.absensi');
        })->name('absensi');
        route::get('pengaturan', function () {
            return view('admin.pengaturan');
        })->name('pengaturan');
        Route::get('keuangan', function () {
            return view('keuangan.app');
        })->name('keuangan');
        Route::get('/testing', function () {
            return view('welcome');
        });
    });
});
