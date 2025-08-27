<?php

// Simple script to display product distribution
require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Illuminate\Support\Facades\DB;

echo "=== LAPORAN STOK PRODUK ===\n";
echo "Total Produk: " . DB::table('stok_produk')->count() . "\n\n";

echo "Distribusi per Kategori:\n";
$categories = DB::table('stok_produk')
    ->join('kategori', 'stok_produk.id_kategori', '=', 'kategori.id_kategori')
    ->select('kategori.nama_kategori', DB::raw('count(*) as total'))
    ->groupBy('kategori.nama_kategori', 'kategori.id_kategori')
    ->orderBy('kategori.nama_kategori')
    ->get();

foreach ($categories as $category) {
    echo "- {$category->nama_kategori}: {$category->total} produk\n";
}

echo "\nDistribusi per Cabang:\n";
$branches = DB::table('stok_produk')
    ->join('cabang', 'stok_produk.id_cabang', '=', 'cabang.id_cabang')
    ->select('cabang.nama_cabang', DB::raw('count(*) as total'))
    ->groupBy('cabang.nama_cabang', 'cabang.id_cabang')
    ->orderBy('cabang.nama_cabang')
    ->get();

foreach ($branches as $branch) {
    echo "- {$branch->nama_cabang}: {$branch->total} produk\n";
}

echo "\nContoh Produk per Kategori:\n";
$samples = DB::table('stok_produk')
    ->join('kategori', 'stok_produk.id_kategori', '=', 'kategori.id_kategori')
    ->select('stok_produk.nama_barang', 'kategori.nama_kategori', 'stok_produk.harga_jual')
    ->orderBy('kategori.nama_kategori')
    ->get()
    ->groupBy('nama_kategori');

foreach ($samples as $kategori => $products) {
    echo "\n{$kategori}:\n";
    $products->take(3)->each(function ($product) {
        echo "  - {$product->nama_barang} (Rp " . number_format($product->harga_jual, 0, ',', '.') . ")\n";
    });
}
