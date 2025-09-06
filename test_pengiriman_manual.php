<?php

require_once 'vendor/autoload.php';

// Import Laravel facades
use Illuminate\Support\Facades\DB;

// Bootstrap Laravel
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

// Test manual insert
try {
    // Get a sample product
    $stok = App\Models\StokGudangPusat::first();
    echo "Sample product: " . $stok->nama_produk . " (Stock: " . $stok->jumlah . ")\n";
    
    // Try manual insert
    $data = [
        'id_produk' => $stok->id_produk,
        'nama_produk' => $stok->nama_produk,
        'tujuan' => 'Test Tujuan Manual',
        'jumlah' => 5,
        'tanggal_kirim' => date('Y-m-d'),
        'status' => 'pending',
    ];
    
    echo "Data to insert:\n";
    print_r($data);
    
    $pengiriman = App\Models\Pengiriman::create($data);
    echo "Success! Created pengiriman with ID: " . $pengiriman->id . "\n";
    
    // Check if data exists in database
    $count = DB::table('simple_pengiriman_produk')->count();
    echo "Total records in simple_pengiriman_produk: " . $count . "\n";
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
    echo "Stack trace:\n" . $e->getTraceAsString() . "\n";
}
