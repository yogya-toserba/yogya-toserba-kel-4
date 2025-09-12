<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KaryawanAbsensiController;
use App\Http\Controllers\KaryawanGajiController;

/*
|--------------------------------------------------------------------------
| Karyawan Routes
|--------------------------------------------------------------------------
|
| Routes untuk halaman karyawan absensi dan gaji
|
*/

// Karyawan Authentication Routes
Route::prefix('karyawan')->name('karyawan.')->group(function () {
    Route::get('login', [KaryawanGajiController::class, 'login'])->name('login');
    Route::post('login', [KaryawanGajiController::class, 'authenticate'])->name('authenticate');
    Route::post('logout', [KaryawanGajiController::class, 'logout'])->name('logout');
    Route::get('dashboard', [KaryawanGajiController::class, 'dashboard'])->name('dashboard');

    // Gaji Routes
    Route::prefix('gaji')->name('gaji.')->group(function () {
        Route::get('/', [KaryawanGajiController::class, 'index'])->name('index');
        Route::get('{id}/detail', [KaryawanGajiController::class, 'detail'])->name('detail');
        Route::get('{id}/slip', [KaryawanGajiController::class, 'downloadSlip'])->name('slip');
    });

    // Absensi Routes
    Route::get('/', [KaryawanAbsensiController::class, 'index'])->name('index');
    Route::get('absensi', [KaryawanAbsensiController::class, 'index'])->name('absensi.index');
    Route::post('absensi/check-in', [KaryawanAbsensiController::class, 'checkIn'])->name('absensi.check-in');
    Route::post('absensi/check-out', [KaryawanAbsensiController::class, 'checkOut'])->name('absensi.check-out');
    Route::post('absensi/izin-sakit', [KaryawanAbsensiController::class, 'submitIzinSakit'])->name('absensi.izin-sakit');
    Route::get('absensi/dashboard', [KaryawanAbsensiController::class, 'dashboard'])->name('absensi.dashboard');
    Route::get('absensi/statistics', [KaryawanAbsensiController::class, 'getStatistics'])->name('absensi.statistics');
    Route::get('absensi/history', [KaryawanAbsensiController::class, 'getHistory'])->name('absensi.history');
    Route::get('status', [KaryawanAbsensiController::class, 'statusHariIni'])->name('status');
    Route::get('riwayat', [KaryawanAbsensiController::class, 'riwayat'])->name('riwayat');

    // Search route
    Route::get('cari', [KaryawanAbsensiController::class, 'cariKaryawan'])->name('cari');
    Route::post('cari', [KaryawanAbsensiController::class, 'cariKaryawan'])->name('cari.post');

    // Alias routes for backward compatibility
    Route::post('checkin', [KaryawanAbsensiController::class, 'checkIn'])->name('checkin');
    Route::post('checkout', [KaryawanAbsensiController::class, 'checkOut'])->name('checkout');
    Route::post('izin-sakit', [KaryawanAbsensiController::class, 'submitIzinSakit'])->name('izin-sakit');
});

Route::prefix('karyawan')->name('karyawan.')->group(function () {
    // Main index route
    Route::get('/', [KaryawanAbsensiController::class, 'index'])->name('index');
    Route::get('absensi', [KaryawanAbsensiController::class, 'index'])->name('absensi.index');
    Route::post('absensi/check-in', [KaryawanAbsensiController::class, 'checkIn'])->name('absensi.check-in');
    Route::post('absensi/check-out', [KaryawanAbsensiController::class, 'checkOut'])->name('absensi.check-out');
    Route::post('absensi/izin-sakit', [KaryawanAbsensiController::class, 'submitIzinSakit'])->name('absensi.izin-sakit');
    Route::get('absensi/dashboard', [KaryawanAbsensiController::class, 'dashboard'])->name('absensi.dashboard');
    Route::get('absensi/statistics', [KaryawanAbsensiController::class, 'getStatistics'])->name('absensi.statistics');
    Route::get('absensi/history', [KaryawanAbsensiController::class, 'getHistory'])->name('absensi.history');
    Route::get('status', [KaryawanAbsensiController::class, 'statusHariIni'])->name('status');
    Route::get('riwayat', [KaryawanAbsensiController::class, 'riwayat'])->name('riwayat');

    // Search route
    Route::get('cari', [KaryawanAbsensiController::class, 'cariKaryawan'])->name('cari');
    Route::post('cari', [KaryawanAbsensiController::class, 'cariKaryawan'])->name('cari.post');

    // Alias routes for backward compatibility
    Route::post('checkin', [KaryawanAbsensiController::class, 'checkIn'])->name('checkin');
    Route::post('checkout', [KaryawanAbsensiController::class, 'checkOut'])->name('checkout');
    Route::post('izin-sakit', [KaryawanAbsensiController::class, 'submitIzinSakit'])->name('izin-sakit');
});
