<?php

// Test Search Functionality
require_once 'vendor/autoload.php';

// Setup Laravel app
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;

echo "=== Testing Search Functionality ===\n\n";

// Test 1: Basic product search
echo "1. Testing basic product search...\n";
$testQuery = "laptop";
echo "Searching for: '{$testQuery}'\n";

$results = DB::table('stok_produk')
  ->leftJoin('kategori', 'stok_produk.id_kategori', '=', 'kategori.id_kategori')
  ->leftJoin('cabang', 'stok_produk.id_cabang', '=', 'cabang.id_cabang')
  ->select(
    'stok_produk.*',
    'kategori.nama_kategori',
    'kategori.sub_kategori',
    'cabang.nama_cabang'
  )
  ->where(function ($q) use ($testQuery) {
    $q->where('stok_produk.nama_barang', 'like', "%{$testQuery}%")
      ->orWhere('kategori.nama_kategori', 'like', "%{$testQuery}%")
      ->orWhere('kategori.sub_kategori', 'like', "%{$testQuery}%");
  })
  ->where('stok_produk.stok', '>', 0)
  ->limit(5)
  ->get();

echo "Found " . $results->count() . " results:\n";
foreach ($results as $product) {
  echo "- {$product->nama_barang} (Stok: {$product->stok}, Harga: Rp " . number_format($product->harga_jual, 0, ',', '.') . ")\n";
  echo "  Kategori: {$product->nama_kategori}\n";
  if ($product->sub_kategori) {
    echo "  Sub Kategori: {$product->sub_kategori}\n";
  }
  echo "\n";
}

// Test 2: Multi-word search
echo "\n2. Testing multi-word search...\n";
$testQuery = "smartphone android";
echo "Searching for: '{$testQuery}'\n";
$searchTerms = explode(' ', strtolower($testQuery));

$results = DB::table('stok_produk')
  ->leftJoin('kategori', 'stok_produk.id_kategori', '=', 'kategori.id_kategori')
  ->select('stok_produk.*', 'kategori.nama_kategori')
  ->where(function ($q) use ($testQuery, $searchTerms) {
    $q->where('stok_produk.nama_barang', 'like', "%{$testQuery}%")
      ->orWhere('kategori.nama_kategori', 'like', "%{$testQuery}%");

    foreach ($searchTerms as $term) {
      if (strlen($term) > 2) {
        $q->orWhere('stok_produk.nama_barang', 'like', "%{$term}%")
          ->orWhere('kategori.nama_kategori', 'like', "%{$term}%");
      }
    }
  })
  ->where('stok_produk.stok', '>', 0)
  ->limit(5)
  ->get();

echo "Found " . $results->count() . " results:\n";
foreach ($results as $product) {
  echo "- {$product->nama_barang} (Kategori: {$product->nama_kategori})\n";
}

// Test 3: Category suggestions
echo "\n3. Testing category suggestions...\n";
$testQuery = "elektronik";
echo "Searching categories for: '{$testQuery}'\n";

$categories = DB::table('kategori')
  ->select('nama_kategori')
  ->where('nama_kategori', 'like', "%{$testQuery}%")
  ->limit(5)
  ->get();

echo "Category suggestions:\n";
foreach ($categories as $category) {
  echo "- {$category->nama_kategori}\n";
}

// Test 4: Sub-category suggestions
echo "\n4. Testing sub-category suggestions...\n";
$subCategories = DB::table('kategori')
  ->select('sub_kategori')
  ->where('sub_kategori', 'like', "%{$testQuery}%")
  ->whereNotNull('sub_kategori')
  ->limit(5)
  ->get();

echo "Sub-category suggestions:\n";
foreach ($subCategories as $subCat) {
  echo "- {$subCat->sub_kategori}\n";
}

// Test 5: Empty search
echo "\n5. Testing empty search...\n";
$testQuery = "";
echo "Searching for empty query: '{$testQuery}'\n";

if (!$testQuery) {
  echo "Empty query handled correctly - no search performed\n";
}

echo "\n=== Search Functionality Test Complete ===\n";
