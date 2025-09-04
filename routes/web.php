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
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\KeuanganController;
use App\Http\Controllers\PenggajianController;
use App\Http\Controllers\PenggajianOtomatisController;
use App\Http\Controllers\PemasokController;

// Global login route - redirects to admin login
Route::get('/login', function () {
    return redirect()->route('admin.login');
})->name('login');

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

// Keranjang Routes
Route::prefix('keranjang')->name('keranjang.')->group(function () {
    Route::get('/', [KeranjangController::class, 'index'])->name('index');
    Route::post('/add', [KeranjangController::class, 'add'])->name('add');
    Route::post('/update', [KeranjangController::class, 'update'])->name('update');
    Route::delete('/remove', [KeranjangController::class, 'remove'])->name('remove');
    Route::delete('/clear', [KeranjangController::class, 'clear'])->name('clear');
    Route::get('/data', [KeranjangController::class, 'getCart'])->name('data');
});

// Product Detail Routes
Route::prefix('produk')->name('produk.')->group(function () {
    Route::get('/detail', [ProdukController::class, 'detail'])->name('detail');
    Route::get('/{id}/reviews', [ProdukController::class, 'getReviews'])->name('reviews');
    Route::post('/{id}/reviews', [ProdukController::class, 'addReview'])->name('reviews.add');
});

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
    
    // Search route (available to all customers)
    Route::get('/search', [PelangganController::class, 'search'])->name('search');
    
    // Protected pelanggan routes
    Route::middleware('auth:pelanggan')->group(function () {
        Route::get('/dashboard', [PelangganController::class, 'dashboard'])->name('dashboard');
        Route::get('/profile', [PelangganController::class, 'profile'])->name('profile');
        Route::post('/profile', [PelangganController::class, 'updateProfile'])->name('profile.update');
        Route::post('/profile/password', [PelangganController::class, 'updatePassword'])->name('profile.password');
    });

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

<<<<<<< HEAD
=======
    // Dashboard Inventori Routes (no authentication required)
    Route::get('/inventori/dashboard', [App\Http\Controllers\InventoriDashboardController::class, 'index'])
        ->name('inventori.dashboard');
    
    Route::get('/inventori/statistics', [App\Http\Controllers\InventoriDashboardController::class, 'getStatistics'])
        ->name('inventori.statistics');
>>>>>>> b1217d2b7d36e3fafa2c47b1ef057eb526439e13
    // Debug route (public, no auth required)
    Route::get('/debug-test', function () {
        return response()->json([
            'message' => 'Debug route working!',
            'pemasok_count' => \App\Models\Pemasok::count(),
            'timestamp' => now()
        ]);
    });

    // Simple pemasok test route (no auth required)
    Route::get('/test-pemasok/{id}', function ($id) {
        $pemasok = \App\Models\Pemasok::where('id_pemasok', $id)->first();
        return response()->json([
            'found' => $pemasok ? true : false,
            'data' => $pemasok,
            'total_count' => \App\Models\Pemasok::count()
        ]);
    });

    // Protected routes (require gudang authentication)
    Route::middleware(['auth.gudang'])->group(function () {
        Route::get('/dashboard', [GudangController::class, 'dashboard'])->name('dashboard');

        // Stock management routes
        Route::get('stok-export', [StokGudangPusatController::class, 'export'])->name('gudang.stok.export');
        Route::get('stok-data', [StokGudangPusatController::class, 'getStokData'])->name('gudang.stok.data');
        Route::get('stok/{stok}/add-stock', [StokGudangPusatController::class, 'showAddStock'])->name('gudang.stok.add-stock');
        Route::post('stok/{stok}/add-stock', [StokGudangPusatController::class, 'addStock'])->name('gudang.stok.add-stock.submit');
        Route::resource('stok', StokGudangPusatController::class)->names([
            'index' => 'gudang.stok.index',
            'create' => 'gudang.stok.create',
            'store' => 'gudang.stok.store',
            'show' => 'gudang.stok.show',
            'edit' => 'gudang.stok.edit',
            'update' => 'gudang.stok.update',
            'destroy' => 'gudang.stok.destroy'
        ]);

        // Main stok route for sidebar
        Route::get('/stok-main', [StokGudangPusatController::class, 'index'])->name('stok');
        
        // Other gudang routes
        Route::get('/permintaan', [GudangController::class, 'permintaan'])->name('permintaan');
        
        Route::get('/permintaan-inventori', function () {
            return view('gudang.permintaan_inventori');
        })->name('permintaan.inventori');
        
        Route::get('/inventori/permintaan-inventori', function () {
            return view('gudang.inventori.permintaan_inventori');
        })->name('inventori.permintaan.inventori');
        
        Route::post('/permintaan-submit', [GudangController::class, 'submitPermintaan'])->name('permintaan.submit');

        // Pengiriman routes
        Route::resource('pengiriman', App\Http\Controllers\Gudang\PengirimanController::class)->names([
            'index' => 'pengiriman.index',
            'create' => 'pengiriman.create',
            'store' => 'pengiriman.store',
            'show' => 'pengiriman.show',
            'edit' => 'pengiriman.edit',
            'update' => 'pengiriman.update',
            'destroy' => 'pengiriman.destroy'
        ]);
        Route::post('/pengiriman/{id}/update-status', [App\Http\Controllers\Gudang\PengirimanController::class, 'updateStatus'])
            ->name('pengiriman.updateStatus');

        Route::get('/inventori', function () {
            return view('gudang.inventori');
        })->name('inventori');

        // Routes untuk Pemasok
        // Export route harus diletakkan sebelum resource route
        Route::get('/export-pemasok', [PemasokController::class, 'export'])->name('pemasok.export');
        Route::get('/pemasok/export', [PemasokController::class, 'export'])->name('pemasok.export.alt');
        Route::get('/pemasok-data', [PemasokController::class, 'getData'])->name('pemasok.data');

        Route::resource('pemasok', PemasokController::class)->names([
            'index' => 'pemasok.index',
            'create' => 'pemasok.create',
            'store' => 'pemasok.store',
            'show' => 'pemasok.show',
            'edit' => 'pemasok.edit',
            'update' => 'pemasok.update',
            'destroy' => 'pemasok.destroy'
        ]);

        // Debug route to check pemasok count
        Route::get('/check-pemasok', function () {
            $count = \App\Models\Pemasok::count();
            $sample = \App\Models\Pemasok::take(3)->get();
            return response()->json([
                'total_pemasok' => $count,
                'sample_data' => $sample
            ]);
        });

        // Simple test export without authentication
        Route::get('/test-export', function () {
            return response('Test Export Working!', 200);
        });

        // Simple test route inside protected group
        Route::get('/test-auth', function () {
            return response()->json([
                'message' => 'Auth working!',
                'user' => auth('gudang')->user() ? 'Authenticated' : 'Not authenticated',
                'timestamp' => now()
            ]);
        });

        // Debug route to check pemasok data
        Route::get('/debug-pemasok', function () {
            $pemasoks = \App\Models\Pemasok::all();
            return response()->json([
                'count' => $pemasoks->count(),
                'data' => $pemasoks->take(5)
            ]);
        });

        Route::get('/resiko', function () {
            return view('gudang.resiko');
        })->name('resiko');

        Route::get('/logistik', function () {
            return view('gudang.logistik');
        })->name('logistik');

        Route::get('/inventori', [ProductController::class, 'index'])->name('inventori.index');
        Route::get('/inventori/create', [ProductController::class, 'create'])->name('inventori.create');
        Route::post('/inventori', [ProductController::class, 'store'])->name('inventori.store');
        Route::get('/inventori/{id}/edit', [ProductController::class, 'edit'])->name('inventori.edit');
        Route::put('/inventori/{id}', [ProductController::class, 'update'])->name('inventori.update');
        Route::delete('/inventori/{id}', [ProductController::class, 'destroy'])->name('inventori.destroy');
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
        Route::get('/profile', [AdminController::class, 'profile'])->name('profile');
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

        // Jabatan & Gaji Management Routes
        Route::get('jabatan-gaji', [PenggajianOtomatisController::class, 'jabatan'])->name('jabatan-gaji');
        Route::post('jabatan-gaji', [PenggajianOtomatisController::class, 'storeJabatan'])->name('jabatan-gaji.store');
        Route::put('jabatan-gaji/{id}', [PenggajianOtomatisController::class, 'updateJabatan'])->name('jabatan-gaji.update');
        Route::delete('jabatan-gaji/{id}', [PenggajianOtomatisController::class, 'deleteJabatan'])->name('jabatan-gaji.delete');
        Route::get('laporan', [KeuanganController::class, 'laporan'])->name('laporan');
        Route::get('absensi', function () {
            return view('admin.absensi');
        })->name('absensi');

        // Manajemen Pengguna Routes
        Route::get('daftar-pengguna', function () {
            return view('admin.daftar-pengguna');
        })->name('daftar-pengguna');
        Route::get('membership', function () {
            return view('admin.membership');
        })->name('membership');
        Route::get('log-aktivitas', function () {
            return view('admin.log-aktivitas');
        })->name('log-aktivitas');

        // Manajemen Gudang Routes
        Route::get('data-pengawai-gudang', function () {
            return view('admin.data-pengawai-gudang');
        })->name('data-pengawai-gudang');
        Route::get('lokasi-gudang', function () {
            return view('admin.lokasi-gudang');
        })->name('lokasi-gudang');
        Route::get('data-barang', function () {
            return view('admin.data-barang');
        })->name('data-barang');

        Route::get('pengaturan', function () {
            return view('admin.pengaturan');
        })->name('pengaturan');

        // Keuangan Routes
        Route::prefix('keuangan')->name('keuangan.')->group(function () {
            Route::get('dashboard', [KeuanganController::class, 'dashboard'])->name('dashboard');
            Route::get('riwayat-transaksi', [KeuanganController::class, 'riwayatTransaksi'])->name('riwayat');
            Route::get('buku-besar', [KeuanganController::class, 'bukuBesar'])->name('bukubesar');
            Route::get('laporan', [KeuanganController::class, 'laporan'])->name('laporan');
            Route::get('export-pdf', [KeuanganController::class, 'exportPDF'])->name('export.pdf');

            // AJAX Routes
            Route::get('detail-transaksi/{id}', [KeuanganController::class, 'getDetailTransaksi'])->name('detail.transaksi');
            Route::get('export-riwayat', [KeuanganController::class, 'exportRiwayatTransaksi'])->name('export.riwayat');
        });

        // Route redirect untuk kompatibilitas layout
        Route::get('keuangan', function () {
            return redirect()->route('admin.keuangan.dashboard');
        })->name('keuangan');
    });
});

// Fallback route untuk halaman yang tidak ditemukan (404)
Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});
