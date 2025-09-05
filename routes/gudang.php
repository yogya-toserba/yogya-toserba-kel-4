<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GudangController;
use App\Http\Controllers\StokGudangPusatController;
use App\Http\Controllers\PemasokController;
use App\Http\Controllers\ProductController;

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

    // Dashboard Inventori Routes (no authentication required)
    Route::get('/inventori/dashboard', [App\Http\Controllers\InventoriDashboardController::class, 'index'])
        ->name('inventori.dashboard');
    
    Route::get('/inventori/statistics', [App\Http\Controllers\InventoriDashboardController::class, 'getStatistics'])
        ->name('inventori.statistics');

    // Debug route (public, no auth required)
    Route::get('/debug-test', function () {
        return response()->json([
            'message' => 'Debug route working!',
            'pemasok_count' => \App\Models\Pemasok::count(),
            'timestamp' => now()
        ]);
    });

    // ...protected and other gudang routes (kept as in original web.php)
    Route::middleware(['auth.gudang'])->group(function () {
        Route::get('/dashboard', [GudangController::class, 'dashboard'])->name('dashboard');

        // Stock management routes
        Route::get('stok-export', [StokGudangPusatController::class, 'export'])->name('stok.export');
        Route::get('stok-data', [StokGudangPusatController::class, 'getStokData'])->name('stok.data');
        Route::get('stok/{stok}/add-stock', [StokGudangPusatController::class, 'showAddStock'])->name('stok.add-stock');
        Route::post('stok/{stok}/add-stock', [StokGudangPusatController::class, 'addStock'])->name('stok.add-stock.submit');
        Route::resource('stok', StokGudangPusatController::class)->names([
            'index' => 'stok.index',
            'create' => 'stok.create',
            'store' => 'stok.store',
            'show' => 'stok.show',
            'edit' => 'stok.edit',
            'update' => 'stok.update',
            'destroy' => 'stok.destroy'
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
        
        // Permintaan workflow routes
        Route::post('/permintaan/terima', [GudangController::class, 'terimaPermintaan'])->name('permintaan.terima');
        Route::post('/permintaan/tolak', [GudangController::class, 'tolakPermintaan'])->name('permintaan.tolak');
        Route::post('/permintaan/kirim', [GudangController::class, 'kirimPermintaan'])->name('permintaan.kirim');

        // Notification routes
        Route::get('/notifications', [GudangController::class, 'getNotifications'])->name('notifications.get');
        Route::post('/notifications/mark-read', [GudangController::class, 'markNotificationRead'])->name('notifications.mark-read');

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

        // ... additional protected routes copied as needed
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
