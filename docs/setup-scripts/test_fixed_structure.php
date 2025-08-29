<?php

require_once 'vendor/autoload.php';

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Schema\Blueprint;

// Setup database connection
$capsule = new Capsule;
$capsule->addConnection([
  'driver' => 'mysql',
  'host' => '127.0.0.1',
  'port' => '3306',
  'database' => 'db_yogya',
  'username' => 'root',
  'password' => '',
  'charset' => 'utf8mb4',
  'collation' => 'utf8mb4_unicode_ci',
  'prefix' => '',
]);

$capsule->setAsGlobal();
$capsule->bootEloquent();

echo "=== TESTING FIXED DATABASE STRUCTURE ===\n";

try {
  // Test the original problematic query
  echo "Testing the original query...\n";

  $result = Capsule::table('detail_transaksi')
    ->join('stok_produk', 'detail_transaksi.id_produk', '=', 'stok_produk.id_produk')
    ->join('kategori', 'stok_produk.id_kategori', '=', 'kategori.id_kategori')
    ->select(
      'stok_produk.id_produk',
      'stok_produk.nama_barang as name',
      'stok_produk.harga_jual as price',
      'stok_produk.foto as image',
      'kategori.nama_kategori',
      Capsule::raw('SUM(detail_transaksi.jumlah_barang) as total_sold'),
      Capsule::raw('COUNT(detail_transaksi.id_transaksi) as transaction_count'),
      Capsule::raw('AVG(4.5 + (RAND() * 0.5)) as rating'),
      Capsule::raw('ROUND(stok_produk.harga_jual * 1.2) as original_price')
    )
    ->groupBy('stok_produk.id_produk', 'stok_produk.nama_barang', 'stok_produk.harga_jual', 'stok_produk.foto', 'kategori.nama_kategori')
    ->orderBy('total_sold', 'desc')
    ->limit(8)
    ->get();

  echo "✅ Query executed successfully!\n";
  echo "Found " . $result->count() . " products.\n\n";

  echo "=== SAMPLE RESULTS ===\n";
  foreach ($result->take(3) as $product) {
    echo "- {$product->name} (ID: {$product->id_produk})\n";
    echo "  Category: {$product->nama_kategori}\n";
    echo "  Price: Rp " . number_format($product->price, 0, ',', '.') . "\n";
    echo "  Total Sold: {$product->total_sold}\n";
    echo "  Transactions: {$product->transaction_count}\n";
    echo "  Rating: " . round($product->rating, 1) . "/5\n\n";
  }

  // Test table counts
  echo "=== TABLE COUNTS ===\n";
  echo "stok_produk: " . Capsule::table('stok_produk')->count() . " records\n";
  echo "detail_transaksi: " . Capsule::table('detail_transaksi')->count() . " records\n";
  echo "kategori: " . Capsule::table('kategori')->count() . " records\n";
  echo "transaksi: " . Capsule::table('transaksi')->count() . " records\n";

  // Test relationships
  echo "\n=== RELATIONSHIP TEST ===\n";
  $productWithDetails = Capsule::table('stok_produk')
    ->leftJoin('detail_transaksi', 'stok_produk.id_produk', '=', 'detail_transaksi.id_produk')
    ->leftJoin('kategori', 'stok_produk.id_kategori', '=', 'kategori.id_kategori')
    ->leftJoin('cabang', 'stok_produk.id_cabang', '=', 'cabang.id_cabang')
    ->select('stok_produk.nama_barang', 'kategori.nama_kategori', 'cabang.nama_cabang', 'detail_transaksi.jumlah_barang')
    ->get();

  echo "Total product-transaction relationships: " . $productWithDetails->count() . "\n";

  echo "\n✅ ALL TESTS PASSED!\n";
  echo "Database structure is now compatible with the application.\n";
} catch (Exception $e) {
  echo "❌ Error: " . $e->getMessage() . "\n";
}
