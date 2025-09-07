<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KaryawanAbsensiController;

/*
|--------------------------------------------------------------------------
| Karyawan Routes
|--------------------------------------------------------------------------
|
| Routes untuk halaman karyawan absensi
|
*/

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
