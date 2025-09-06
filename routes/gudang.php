<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GudangController;
use App\Http\Controllers\StokGudangPusatController;
use App\Http\Controllers\PemasokController;
use App\Http\Controllers\ProductController;

// Test route untuk menambah data session
Route::get('/test-data', function () {
    // Buat data contoh untuk pengiriman
    $contohPengiriman = [
        [
            'id' => 1,
            'id_pengiriman' => 'SHIP-001',
            'nama_produk' => 'Monitor Samsung',
            'tujuan' => 'Cabang Bandung',
            'jumlah' => 3,
            'tanggal_kirim' => date('Y-m-d'),
            'status' => 'Siap Kirim',
            'created_at' => date('Y-m-d H:i:s')
        ],
        [
            'id' => 2,
            'id_pengiriman' => 'SHIP-002',
            'nama_produk' => 'Printer Canon',
            'tujuan' => 'Cabang Medan',
            'jumlah' => 2,
            'tanggal_kirim' => date('Y-m-d'),
            'status' => 'Siap Kirim',
            'created_at' => date('Y-m-d H:i:s')
        ]
    ];

    // Set session data
    session(['all_pengiriman' => $contohPengiriman]);
    session(['all_penerimaan' => []]);

    return response()->json([
        'success' => true,
        'message' => 'Data test berhasil ditambahkan!',
        'pengiriman_count' => count($contohPengiriman),
        'penerimaan_count' => 0
    ]);
});

// Test page untuk kirim pengiriman
Route::get('/test-kirim', function () {
    return view('test-kirim');
});

// Test AJAX kirim
Route::post('/test-kirim-ajax', function (Illuminate\Http\Request $request) {
    try {
        $index = $request->input('index');
        $sessionPengiriman = session('all_pengiriman', []);
        
        if (isset($sessionPengiriman[$index])) {
            // Ambil data yang akan dikirim
            $item = $sessionPengiriman[$index];
            
            // Update status pengiriman menjadi "Dikirim"
            $sessionPengiriman[$index]['status'] = 'Dikirim';
            $sessionPengiriman[$index]['tanggal_kirim_aktual'] = now()->format('Y-m-d H:i:s');
            
            // Transfer data ke session penerimaan dengan status "Dalam Perjalanan"
            $sessionPenerimaan = session('all_penerimaan', []);
            $penerimaanItem = [
                'id' => $item['id'] ?? count($sessionPenerimaan) + 1,
                'nama_produk' => $item['nama_produk'],
                'tujuan' => $item['tujuan'],
                'jumlah' => $item['jumlah'],
                'status' => 'Dalam Perjalanan',
                'tanggal_kirim' => $item['tanggal_kirim'] ?? date('Y-m-d'),
                'tanggal_kirim_aktual' => now()->format('Y-m-d H:i:s'),
                'created_at' => now()->format('Y-m-d H:i:s')
            ];
            
            $sessionPenerimaan[] = $penerimaanItem;
            
            // Save kedua session
            session(['all_pengiriman' => $sessionPengiriman]);
            session(['all_penerimaan' => $sessionPenerimaan]);
            
            return response()->json([
                'success' => true,
                'message' => 'Pengiriman berhasil dikirim dan masuk ke sistem penerimaan!',
                'redirect' => route('gudang.inventori.penerimaan.index'),
                'data' => [
                    'pengiriman_updated' => $sessionPengiriman[$index],
                    'penerimaan_added' => $penerimaanItem,
                    'total_penerimaan' => count($sessionPenerimaan)
                ]
            ]);
        } else {
            throw new \Exception('Data pengiriman tidak ditemukan dalam session');
        }
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Terjadi kesalahan: ' . $e->getMessage()
        ], 500);
    }
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
        Route::post('/pengiriman/kirim', [App\Http\Controllers\Gudang\PengirimanController::class, 'kirimPengiriman'])
            ->name('pengiriman.kirim');

        // Penerimaan routes (via Gudang Dashboard)
        Route::get('/penerimaan', [App\Http\Controllers\Gudang\PenerimaanController::class, 'index'])
            ->name('penerimaan.index');
        Route::post('/penerimaan/terima', [App\Http\Controllers\Gudang\PenerimaanController::class, 'terimaPenerimaan'])
            ->name('penerimaan.terima');
        Route::post('/penerimaan/update-status', [App\Http\Controllers\Gudang\PenerimaanController::class, 'updateStatus'])
            ->name('penerimaan.update-status');
            
        // Keep inventori routes for backward compatibility
        Route::get('/inventori/penerimaan', [App\Http\Controllers\Gudang\PenerimaanController::class, 'index'])
            ->name('inventori.penerimaan.index');
        Route::post('/inventori/penerimaan/terima', [App\Http\Controllers\Gudang\PenerimaanController::class, 'terimaPenerimaan'])
            ->name('inventori.penerimaan.terima');
        Route::post('/inventori/penerimaan/update-status', [App\Http\Controllers\Gudang\PenerimaanController::class, 'updateStatus'])
            ->name('inventori.penerimaan.update-status');
        Route::post('/pengiriman/update-session-status', [App\Http\Controllers\Gudang\PengirimanController::class, 'updateSessionStatus'])
            ->name('pengiriman.updateSessionStatus');

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
