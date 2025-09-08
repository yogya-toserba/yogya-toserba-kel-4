<?php

// Test script untuk mengecek pagination pengguna
require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

try {
    // Test controller method
    $controller = new App\Http\Controllers\AdminController();
    
    // Cek jumlah data pelanggan
    $count = DB::table('pelanggan')->count();
    echo "Total data pelanggan: " . $count . "\n";
    
    // Test pagination
    $pelanggan = DB::table('pelanggan')
        ->select('id', 'nama_pelanggan as nama', 'email', 'nomer_telepon as telepon', 'alamat', 'created_at')
        ->orderBy('created_at', 'desc')
        ->paginate(5);
    
    echo "Data pelanggan (page 1):\n";
    foreach ($pelanggan as $p) {
        echo "- " . $p->nama . " (" . $p->email . ")\n";
    }
    
    echo "\nPagination info:\n";
    echo "Current page: " . $pelanggan->currentPage() . "\n";
    echo "Per page: " . $pelanggan->perPage() . "\n";
    echo "Total: " . $pelanggan->total() . "\n";
    echo "Last page: " . $pelanggan->lastPage() . "\n";
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
    echo "Trace: " . $e->getTraceAsString() . "\n";
}
