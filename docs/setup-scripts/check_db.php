<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Illuminate\Support\Facades\DB;

echo "=== DATABASE STATUS ===\n";

try {
    $cabangCount = DB::table('cabang')->count();
    echo "Cabang: {$cabangCount} records\n";
    
    $kategoriCount = DB::table('kategori')->count();
    echo "Kategori: {$kategoriCount} records\n";
    
    $produkCount = DB::table('stok_produk')->count();
    echo "Stok Produk: {$produkCount} records\n";
    
    $pelangganCount = DB::table('pelanggan')->count();
    echo "Pelanggan: {$pelangganCount} records\n";
    
    $gudangCount = DB::table('stok_gudang_pusat')->count();
    echo "Stok Gudang Pusat: {$gudangCount} records\n";
    
    echo "\n=== SEEDING SUCCESS ===\n";
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
