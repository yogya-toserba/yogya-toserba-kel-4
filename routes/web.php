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

// Load separate route files
require __DIR__ . '/pelanggan.php';
require __DIR__ . '/gudang.php';
require __DIR__ . '/admin.php';

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

// Route keranjang belanja
Route::get('/keranjang', function () {
    return view('dashboard.keranjang');
})->name('keranjang');

// Route checkout
Route::get('/checkout', function () {
    return view('dashboard.checkout');
})->name('checkout');

// Fallback route untuk halaman yang tidak ditemukan (404)
Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});
