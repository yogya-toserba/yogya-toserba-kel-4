<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PenggajianController;
use App\Http\Controllers\PenggajianOtomatisController;
use App\Http\Controllers\GajiOtomatisController;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\KeuanganController;
use App\Http\Controllers\GudangController;

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
        Route::post('/profile', [AdminController::class, 'updateProfile'])->name('profile.update');
        Route::get('/sales-data', [AdminController::class, 'getSalesData'])->name('sales.data');

        // Pengaturan Routes
        Route::get('/pengaturan', [AdminController::class, 'pengaturan'])->name('pengaturan');
        Route::post('/pengaturan', [AdminController::class, 'updatePengaturan'])->name('pengaturan.update');

        // Penggajian Routes
        Route::get('penggajian', [PenggajianController::class, 'index'])->name('penggajian');
        Route::get('penggajian/create', [PenggajianController::class, 'create'])->name('penggajian.create');
        Route::post('penggajian/store', [PenggajianController::class, 'store'])->name('penggajian.store');
        Route::post('penggajian/proses-otomatis', [PenggajianController::class, 'prosesOtomatis'])->name('penggajian.proses-otomatis');
        Route::post('penggajian/preview', [PenggajianController::class, 'preview'])->name('penggajian.preview');
        Route::get('penggajian/konfigurasi', [PenggajianController::class, 'konfigurasi'])->name('penggajian.konfigurasi');
        Route::get('penggajian/karyawan/{id}/gaji', [PenggajianController::class, 'getGajiByKaryawan'])->name('penggajian.gaji-by-karyawan');
        Route::post('penggajian/bulk-action', [PenggajianController::class, 'bulkAction'])->name('penggajian.bulk-action');
        Route::post('penggajian/generate', [PenggajianController::class, 'generateSlipGaji'])->name('penggajian.generate');
        Route::post('penggajian/export', [PenggajianController::class, 'exportData'])->name('penggajian.export');

        // Absensi Routes
        Route::get('absensi', [AbsensiController::class, 'index'])->name('absensi');
        Route::get('absensi/create', [AbsensiController::class, 'create'])->name('absensi.create');
        Route::post('absensi', [AbsensiController::class, 'store'])->name('absensi.store');
        Route::get('absensi/{id}', [AbsensiController::class, 'show'])->name('absensi.show');
        Route::get('absensi/{id}/edit', [AbsensiController::class, 'edit'])->name('absensi.edit');
        Route::put('absensi/{id}', [AbsensiController::class, 'update'])->name('absensi.update');
        Route::delete('absensi/{id}', [AbsensiController::class, 'destroy'])->name('absensi.destroy');
        Route::post('absensi/import', [AbsensiController::class, 'import'])->name('absensi.import');
        Route::get('absensi/export', [AbsensiController::class, 'export'])->name('absensi.export');
        Route::post('absensi/bulk-update', [AbsensiController::class, 'bulkUpdate'])->name('absensi.bulk-update');

        // Penggajian Otomatis Routes
        Route::get('penggajian-otomatis', [PenggajianOtomatisController::class, 'index'])->name('penggajian-otomatis');
        Route::post('penggajian-otomatis/generate', [PenggajianOtomatisController::class, 'generateGaji'])->name('penggajian-otomatis.generate');
        Route::post('penggajian-otomatis/approve', [PenggajianOtomatisController::class, 'bulkApprove'])->name('penggajian-otomatis.approve');
        Route::post('penggajian-otomatis/approve/{id}', [PenggajianOtomatisController::class, 'approveGaji'])->name('penggajian-otomatis.approve.single');
        Route::post('penggajian-otomatis/pay/{id}', [PenggajianOtomatisController::class, 'markAsPaid'])->name('penggajian-otomatis.pay');
        Route::get('penggajian-detail/{id}', [PenggajianOtomatisController::class, 'detail'])->name('penggajian-detail');

        // Gaji Otomatis Routes (Sistem Baru)
        Route::prefix('gaji-otomatis')->name('gaji-otomatis.')->group(function () {
            Route::get('/', [GajiOtomatisController::class, 'index'])->name('index');
            Route::post('/proses', [GajiOtomatisController::class, 'generateOtomatis'])->name('proses');
            Route::get('/preview', [GajiOtomatisController::class, 'previewGaji'])->name('preview');
            Route::get('/validasi', [GajiOtomatisController::class, 'validasi'])->name('validasi');
            Route::get('/detail/{id}', [GajiOtomatisController::class, 'detail'])->name('detail');
            Route::get('/analytics', [GajiOtomatisController::class, 'analytics'])->name('analytics');
        });

        // Analisis routes (dashboard pages)
        Route::get('/analisis', [AdminController::class, 'dashboard'])->name('analisis');

        Route::get('/analisis/keuangan', [AdminController::class, 'dashboardKeuangan'])->name('analisis.keuangan');

        Route::get('/analisis/pelanggan', [AdminController::class, 'dashboardPelanggan'])->name('analisis.pelanggan');

        Route::get('/analisis/barang', [AdminController::class, 'dashboardBarang'])->name('analisis.barang');

        Route::get('/analisis/penjualan', [AdminController::class, 'dashboardPenjualan'])->name('analisis.penjualan');

        // Laporan Routes
        Route::get('laporan', [LaporanController::class, 'index'])->name('laporan');
        Route::get('laporan/keuangan', [LaporanController::class, 'keuangan'])->name('laporan.keuangan');
        Route::get('laporan/gaji', [LaporanController::class, 'gaji'])->name('laporan.gaji');
        Route::get('laporan/absensi', [LaporanController::class, 'absensi'])->name('laporan.absensi');
        Route::get('laporan/karyawan', [LaporanController::class, 'karyawan'])->name('laporan.karyawan');
        Route::get('laporan/export', [LaporanController::class, 'export'])->name('laporan.export');

        // Keuangan Routes
        Route::get('keuangan', [KeuanganController::class, 'dashboard'])->name('keuangan');
        Route::get('keuangan/dashboard', [KeuanganController::class, 'dashboard'])->name('keuangan.dashboard');
        Route::get('keuangan/riwayat', [KeuanganController::class, 'riwayatTransaksi'])->name('keuangan.riwayat');
        Route::get('keuangan/buku-besar', [KeuanganController::class, 'bukuBesar'])->name('keuangan.buku-besar');
        Route::get('keuangan/bukubesar', [KeuanganController::class, 'bukuBesar'])->name('keuangan.bukubesar');
        Route::get('keuangan/laporan', [KeuanganController::class, 'laporan'])->name('keuangan.laporan');
        Route::get('keuangan/export-pdf', [KeuanganController::class, 'exportPDF'])->name('keuangan.export-pdf');

        // Gudang Routes
        Route::get('data-pengawai-gudang', [GudangController::class, 'dataPengawaiGudang'])->name('data-pengawai-gudang');
        Route::get('lokasi-gudang', [GudangController::class, 'lokasiGudang'])->name('lokasi-gudang');
        Route::get('data-barang', [GudangController::class, 'dataBarang'])->name('data-barang');
    });
});
