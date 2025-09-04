<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PenggajianController;
use App\Http\Controllers\PenggajianOtomatisController;

Route::prefix('admin')->name('admin.')->group(function () {
    // Authentication Routes
    Route::get('/login', [AdminController::class, 'showLogin'])->name('login');
    Route::post('/login', [AdminController::class, 'login'])->name('login.submit');
    Route::post('/logout', [AdminController::class, 'logout'])->name('logout');

    // Protected Admin Routes
    Route::middleware(['auth:admin'])->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::get('/chart-data', [AdminController::class, 'getChartData'])->name('chart.data');
        Route::get('/data-karyawan', [AdminController::class, 'dataKaryawan'])->name('data-karyawan');
        Route::get('/data-karyawan/search', [AdminController::class, 'searchKaryawan'])->name('data-karyawan.search');
        Route::get('/data-karyawan/tambah', [AdminController::class, 'tambahKaryawan'])->name('data-karyawan.tambah');
        Route::post('/data-karyawan', [AdminController::class, 'storeKaryawan'])->name('data-karyawan.store');
        Route::post('/karyawan/{id}/toggle-status', [AdminController::class, 'toggleKaryawanStatus'])->name('karyawan.toggle-status');
        
        // Search Routes
        Route::post('/search', [AdminController::class, 'search'])->name('search');
        Route::get('/search-results', [AdminController::class, 'searchResults'])->name('search-results');
        
        // Profile Routes
        Route::get('/profile', [AdminController::class, 'profile'])->name('profile');
        Route::put('/profile', [AdminController::class, 'updateProfile'])->name('profile.update');
        Route::get('/sales-data', [AdminController::class, 'getSalesData'])->name('sales.data');
        Route::post('/profile', [AdminController::class, 'updateProfile'])->name('profile.update');
        Route::get('penggajian', [PenggajianController::class, 'index'])->name('penggajian');
        Route::get('penggajian/create', [PenggajianController::class, 'create'])->name('penggajian.create');
        Route::post('penggajian/store', [PenggajianController::class, 'store'])->name('penggajian.store');
        Route::get('penggajian/karyawan/{id}/gaji', [PenggajianController::class, 'getGajiByKaryawan'])->name('penggajian.gaji-by-karyawan');
        Route::post('penggajian/bulk-action', [PenggajianController::class, 'bulkAction'])->name('penggajian.bulk-action');
        Route::post('penggajian/generate', [PenggajianController::class, 'generateSlipGaji'])->name('penggajian.generate');
        Route::post('penggajian/export', [PenggajianController::class, 'exportData'])->name('penggajian.export');

        // Penggajian Otomatis Routes
        Route::get('penggajian-otomatis', [PenggajianOtomatisController::class, 'index'])->name('penggajian-otomatis');
        Route::post('penggajian-otomatis/generate', [PenggajianOtomatisController::class, 'generateGaji'])->name('penggajian-otomatis.generate');
        Route::post('penggajian-otomatis/approve', [PenggajianOtomatisController::class, 'bulkApprove'])->name('penggajian-otomatis.approve');
        Route::post('penggajian-otomatis/approve/{id}', [PenggajianOtomatisController::class, 'approveGaji'])->name('penggajian-otomatis.approve.single');
        Route::post('penggajian-otomatis/pay/{id}', [PenggajianOtomatisController::class, 'markAsPaid'])->name('penggajian-otomatis.pay');
        Route::get('penggajian-detail/{id}', [PenggajianOtomatisController::class, 'detail'])->name('penggajian-detail');

        // Analisis routes (dashboard pages)
        Route::get('/analisis', [AdminController::class, 'dashboard'])->name('analisis');

        Route::get('/analisis/keuangan', [AdminController::class, 'dashboardKeuangan'])->name('analisis.keuangan');

        Route::get('/analisis/pelanggan', [AdminController::class, 'dashboardPelanggan'])->name('analisis.pelanggan');

        Route::get('/analisis/barang', [AdminController::class, 'dashboardBarang'])->name('analisis.barang');

        Route::get('/analisis/penjualan', [AdminController::class, 'dashboardPenjualan'])->name('analisis.penjualan');

    });
});
