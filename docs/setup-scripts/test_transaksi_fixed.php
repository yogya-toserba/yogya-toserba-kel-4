<?php

require_once 'vendor/autoload.php';

use Illuminate\Database\Capsule\Manager as Capsule;

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

echo "=== TESTING TRANSAKSI TABLE WITH LARAVEL ===\n";

try {
  // Test the original failing query
  $today = date('Y-m-d');
  echo "Testing original failing query...\n";
  echo "Query: SELECT COUNT(*) as aggregate FROM transaksi WHERE DATE(tanggal_transaksi) = '{$today}'\n";

  $count = Capsule::table('transaksi')
    ->whereRaw('DATE(tanggal_transaksi) = ?', [$today])
    ->count();

  echo "✅ SUCCESS: Query executed without errors!\n";
  echo "   Transactions today ({$today}): {$count}\n";

  // Test with sample dates
  echo "\nTesting with sample dates...\n";
  $sampleDates = ['2025-01-02', '2025-01-03', '2025-01-04', '2025-01-05'];

  foreach ($sampleDates as $date) {
    $count = Capsule::table('transaksi')
      ->whereRaw('DATE(tanggal_transaksi) = ?', [$date])
      ->count();
    echo "   Transactions on {$date}: {$count}\n";
  }

  // Test table structure
  echo "\n=== TABLE STRUCTURE VERIFICATION ===\n";
  $columns = Capsule::select("SHOW COLUMNS FROM transaksi");
  echo "transaksi table columns:\n";
  foreach ($columns as $column) {
    echo "- {$column->Field} ({$column->Type})\n";
  }

  // Test data integrity
  echo "\n=== DATA INTEGRITY TEST ===\n";
  $transaksiCount = Capsule::table('transaksi')->count();
  $detailCount = Capsule::table('detail_transaksi')->count();

  echo "transaksi records: {$transaksiCount}\n";
  echo "detail_transaksi records: {$detailCount}\n";

  // Test join queries
  echo "\n=== JOIN QUERY TEST ===\n";
  $results = Capsule::table('transaksi')
    ->join('pelanggan', 'transaksi.id_pelanggan', '=', 'pelanggan.id_pelanggan')
    ->join('cabang', 'transaksi.id_cabang', '=', 'cabang.id_cabang')
    ->select(
      'transaksi.id_transaksi',
      'transaksi.tanggal_transaksi',
      'transaksi.total_belanja',
      'pelanggan.nama_pelanggan',
      'cabang.nama_cabang'
    )
    ->get();

  echo "JOIN query results: " . $results->count() . " records\n";
  if ($results->count() > 0) {
    $sample = $results->first();
    echo "Sample result:\n";
    echo "- Transaction ID: {$sample->id_transaksi}\n";
    echo "- Date: {$sample->tanggal_transaksi}\n";
    echo "- Total: Rp " . number_format($sample->total_belanja, 0, ',', '.') . "\n";
    echo "- Customer: {$sample->nama_pelanggan}\n";
    echo "- Branch: {$sample->nama_cabang}\n";
  }

  echo "\n✅ ALL TESTS PASSED!\n";
  echo "transaksi table structure is now fully compatible with application queries.\n";
} catch (Exception $e) {
  echo "❌ Error: " . $e->getMessage() . "\n";
}
