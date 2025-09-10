<?php
require_once 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

try {
    echo "Sample data dari stok_produk:\n";
    $sample = DB::table('stok_produk')
        ->select('nama_barang', 'harga_jual', 'stok')
        ->limit(5)
        ->get();
    
    foreach ($sample as $row) {
        echo "- {$row->nama_barang} | Rp " . number_format($row->harga_jual, 0, ',', '.') . " | Stok: {$row->stok}\n";
    }
    
    echo "\nTest search samsung:\n";
    $results = DB::table('stok_produk')
      ->select('id_produk', 'nama_barang', 'harga_jual as harga', 'stok', 'foto')
      ->where('nama_barang', 'like', "%samsung%")
      ->limit(5)
      ->get();
      
    foreach ($results as $row) {
        echo "- {$row->nama_barang} | Rp " . number_format($row->harga, 0, ',', '.') . " | Stok: {$row->stok}\n";
    }
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
