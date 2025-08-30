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

// Route untuk testing error pages
Route::get('/test-errors', function () {
    return view('test-errors');
})->name('test.errors');

Route::get('/test/403', function () {
    abort(403, 'Testing halaman 403');
});

Route::get('/test/404', function () {
    abort(404, 'Testing halaman 404');
});

Route::get('/test/405', function () {
    abort(405, 'Testing halaman 405');
});

Route::get('/test/500', function () {
    abort(500, 'Testing halaman 500');
});

// Route langsung untuk error pages
Route::get('/404', function () {
    return response()->view('errors.404', [], 404);
});

Route::get('/403', function () {
    return response()->view('errors.403', [], 403);
});

Route::get('/405', function () {
    return response()->view('errors.405', [], 405);
});

Route::get('/500', function () {
    return response()->view('errors.500', [], 500);
});

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

    // Public routes for customer help
    Route::get('/manual', function () {
        return view('pelanggan.manual');
    })->name('manual');

    Route::get('/bantuan-it', function () {
        return view('pelanggan.bantuan-it');
    })->name('bantuan-it');

    Route::get('/kontak-admin', function () {
        return view('pelanggan.kontak-admin');
    })->name('kontak-admin');
});

// Gudang Routes
Route::prefix('gudang')->name('gudang.')->group(function () {
    // Authentication routes
    Route::get('/login', [GudangController::class, 'showLogin'])->name('login');
    Route::post('/login', [GudangController::class, 'login'])->name('login.submit');
    Route::post('/logout', [GudangController::class, 'logout'])->name('logout');

    // Public routes (accessible without authentication)
    Route::get('/manual', function () {
        return view('gudang.manual');
    })->name('manual');

    Route::get('/bantuan-it', function () {
        return view('gudang.bantuan-it');
    })->name('bantuan-it');

    Route::get('/kontak-admin', function () {
        return view('gudang.kontak-admin');
    })->name('kontak-admin');

    // Protected routes (require gudang authentication)
    Route::middleware(['auth.gudang'])->group(function () {
        Route::get('/dashboard', [GudangController::class, 'dashboard'])->name('dashboard');

        // Stock management routes
        Route::get('stok/{stok}/add-stock', [StokGudangPusatController::class, 'showAddStock'])->name('stok.add-stock');
        Route::post('stok/{stok}/add-stock', [StokGudangPusatController::class, 'addStock'])->name('stok.add-stock.submit');
        Route::resource('stok', StokGudangPusatController::class);

        // Other gudang routes
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

// Route kategori - cleaned up without duplicates
Route::prefix('kategori')->name('kategori.')->group(function () {
    Route::get('/elektronik', [CategoryController::class, 'elektronik'])->name('elektronik');
    Route::get('/fashion', [CategoryController::class, 'fashion'])->name('fashion');
    Route::get('/makanan', [CategoryController::class, 'makanan'])->name('makanan');
    Route::get('/makanan-minuman', [CategoryController::class, 'makanan'])->name('makanan-minuman');
    Route::get('/otomotif', [CategoryController::class, 'otomotif'])->name('otomotif');
    Route::get('/kesehatan-kecantikan', [CategoryController::class, 'kesehatan'])->name('kesehatan-kecantikan');
    Route::get('/rumah-tangga', [CategoryController::class, 'rumahTangga'])->name('rumah-tangga');
    Route::get('/olahraga', [CategoryController::class, 'olahraga'])->name('olahraga');
    Route::get('/buku', [CategoryController::class, 'buku'])->name('buku');
    Route::get('/perawatan', [CategoryController::class, 'perawatan'])->name('perawatan');
});

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
        Route::get('penggajian', function () {
            return view('admin.penggajian');
        })->name('penggajian');
        Route::get('laporan', function () {
            return view('admin.laporan');
        })->name('laporan');
        Route::get('absensi', function () {
            return view('admin.absensi');
        })->name('absensi');
        Route::get('pengaturan', function () {
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

// Fallback route untuk halaman yang tidak ditemukan (404)
Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});
