<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\GudangController;
use App\Http\Controllers\StokGudangPusatController;
use App\Http\Controllers\ProdukTerlarisController;
use App\Http\Controllers\KeuanganController;

// Dashboard utama
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

// Tentang MyYOGYA
Route::get('/tentang', function () {
    return view('tentang');
})->name('tentang');

// Karir
Route::get('/karir', function () {
    return view('karir');
})->name('karir');

// Investor Relations
Route::get('/investor-relations', function () {
    return view('investor-relations');
})->name('investor-relations');

// Layanan & Bantuan
Route::get('/layanan', function () {
    return view('layanan');
})->name('layanan');

// Cara Belanja
Route::get('/cara-belanja', function () {
    return view('cara-belanja');
})->name('cara-belanja');

// Pengiriman
Route::get('/pengiriman', function () {
    return view('pengiriman');
})->name('pengiriman');

Route::get('/metode-pembayaran', function () {
    return view('metode-pembayaran');
})->name('metode-pembayaran');

Route::get('/syarat-ketentuan', function () {
    return view('syarat-ketentuan');
})->name('syarat-ketentuan');

Route::get('/kebijakan-privasi', function () {
    return view('kebijakan-privasi');
})->name('kebijakan-privasi');

Route::get('/kebijakan-return', function () {
    return view('kebijakan-return');
})->name('kebijakan-return');

Route::get('/hak-kekayaan-intelektual', function () {
    return view('hak-kekayaan-intelektual');
})->name('hak-kekayaan-intelektual');

// AJAX routes for dashboard
Route::post('/add-to-cart', [DashboardController::class, 'addToCart'])->name('add.to.cart');

// API Routes untuk Produk Terlaris
Route::prefix('api')->group(function () {
    Route::get('/produk-terlaris', [ProdukTerlarisController::class, 'getProdukTerlaris'])->name('api.produk.terlaris');
    Route::get('/produk-terlaris-kategori', [ProdukTerlarisController::class, 'getProdukTerlarisPerKategori'])->name('api.produk.terlaris.kategori');
    Route::get('/statistik-penjualan', [ProdukTerlarisController::class, 'getStatistikPenjualan'])->name('api.statistik.penjualan');
    Route::get('/tren-penjualan', [ProdukTerlarisController::class, 'getTrenPenjualanHarian'])->name('api.tren.penjualan');
});

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
    // Authentication routes
    Route::get('/login', [GudangController::class, 'showLogin'])->name('login');
    Route::post('/login', [GudangController::class, 'login'])->name('login.submit');
    Route::post('/logout', [GudangController::class, 'logout'])->name('logout');

    // Protected routes (require gudang authentication)
    Route::middleware(['auth:gudang'])->group(function () {
        Route::get('/dashboard', [GudangController::class, 'dashboard'])->name('dashboard');

        // Stock management routes
        Route::resource('stok', StokGudangPusatController::class);

        // Other gudang routes
        Route::get('/manual', function () {
            return view('gudang.manual');
        })->name('manual');

        Route::get('/permintaan', function () {
            return view('gudang.permintaan');
        })->name('permintaan');

        Route::get('/pengiriman', function () {
            return view('gudang.pengiriman');
        })->name('pengiriman');

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

        Route::get('/inventory', [ProductController::class, 'index'])->name('inventory.index');
        Route::get('/inventory/create', [ProductController::class, 'create'])->name('inventory.create');
        Route::post('/inventory', [ProductController::class, 'store'])->name('inventory.store');
        Route::resource('produk', ProductController::class);
    });
});

// Route kategori elektronik
Route::get('/kategori/elektronik', [CategoryController::class, 'elektronik'])->name('kategori.elektronik');

// Route kategori fashion
Route::get('/kategori/fashion', [CategoryController::class, 'fashion'])->name('kategori.fashion');

// Route kategori makanan & minuman
Route::get('/kategori/makanan', [CategoryController::class, 'makanan'])->name('kategori.makanan');
Route::get('/kategori/otomotif', [CategoryController::class, 'otomotif'])->name('kategori.otomotif');

Route::get('/kategori/makanan-minuman', [CategoryController::class, 'makanan'])->name('kategori.makanan-minuman');

// Route kategori kesehatan & kecantikan
Route::get('/kategori/kesehatan-kecantikan', [CategoryController::class, 'kesehatan'])->name('kategori.kesehatan-kecantikan');

// Route kategori rumah tangga
Route::get('/kategori/rumah-tangga', [CategoryController::class, 'rumahTangga'])->name('kategori.rumah-tangga');

// Route kategori olahraga
Route::get('/kategori/olahraga', [CategoryController::class, 'olahraga'])->name('kategori.olahraga');

// Route kategori buku & alat tulis
Route::get('/kategori/buku', [CategoryController::class, 'buku'])->name('kategori.buku');

// Route kategori perawatan pribadi
Route::get('/kategori/perawatan', [CategoryController::class, 'perawatan'])->name('kategori.perawatan');

Route::prefix('admin')->name('admin.')->group(function () {
    // Authentication Routes
    Route::get('/login', [AdminController::class, 'showLogin'])->name('login');
    Route::post('/login', [AdminController::class, 'login'])->name('login.submit');
    Route::post('/logout', [AdminController::class, 'logout'])->name('logout');

    // Protected Admin Routes
    Route::middleware(['auth:admin'])->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::get('/data-karyawan', [AdminController::class, 'dataKaryawan'])->name('data-karyawan');
        Route::get('/data-karyawan/tambah', [AdminController::class, 'tambahKaryawan'])->name('data-karyawan.tambah');
        Route::post('/data-karyawan', [AdminController::class, 'storeKaryawan'])->name('data-karyawan.store');
        Route::get('/sales-data', [AdminController::class, 'getSalesData'])->name('sales.data');
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
        
        // Keuangan Routes
        Route::prefix('keuangan')->name('keuangan.')->group(function () {
            Route::get('dashboard', [KeuanganController::class, 'dashboard'])->name('dashboard');
            Route::get('riwayat-transaksi', [KeuanganController::class, 'riwayatTransaksi'])->name('riwayat');
            Route::get('buku-besar', [KeuanganController::class, 'bukuBesar'])->name('bukubesar');
            Route::get('laporan', [KeuanganController::class, 'laporan'])->name('laporan');
        });
    });
});
