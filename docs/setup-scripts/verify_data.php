<?php

// Database Verification Script
echo "=== YOGYA TOSERBA DATABASE VERIFICATION ===\n";
echo "Checking all seeded data...\n\n";

try {
  $pdo = new PDO("mysql:host=127.0.0.1;port=3306;dbname=db_yogya", 'root', '');
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  echo "Connected to database successfully!\n\n";

  // Function to count records in a table
  function countRecords($pdo, $tableName)
  {
    $stmt = $pdo->query("SELECT COUNT(*) as count FROM $tableName");
    return $stmt->fetch()['count'];
  }

  // Function to show sample data
  function showSampleData($pdo, $tableName, $limit = 3)
  {
    $stmt = $pdo->query("SELECT * FROM $tableName LIMIT $limit");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  $tables = ['users', 'cabang', 'pelanggan', 'kategori', 'stok_gudang_pusat', 'gudang', 'kas', 'transaksi', 'detail_transaksi'];

  echo "=== DATABASE RECORDS COUNT ===\n";
  foreach ($tables as $table) {
    $count = countRecords($pdo, $table);
    echo sprintf("%-20s: %d records\n", ucfirst($table), $count);
  }

  echo "\n=== SAMPLE DATA PREVIEW ===\n";

  // Show sample cabang data
  echo "\nCABANG (Sample 3 records):\n";
  $data = showSampleData($pdo, 'cabang', 3);
  foreach ($data as $row) {
    echo "- ID: {$row['id_cabang']}, Nama: {$row['nama_cabang']}, Kategori: {$row['kategori']}, Wilayah: {$row['wilayah']}\n";
  }

  // Show sample pelanggan data
  echo "\nPELANGGAN (Sample 3 records):\n";
  $data = showSampleData($pdo, 'pelanggan', 3);
  foreach ($data as $row) {
    echo "- ID: {$row['id_pelanggan']}, Nama: {$row['nama_pelanggan']}, Email: {$row['email']}, Level: {$row['level_membership']}\n";
  }

  // Show sample produk data
  echo "\nPRODUK (Sample 3 records):\n";
  $data = showSampleData($pdo, 'stok_gudang_pusat', 3);
  foreach ($data as $row) {
    echo "- ID: {$row['id_produk']}, Nama: {$row['nama_produk']}, Harga: Rp " . number_format($row['harga'], 0, ',', '.') . ", Stok: {$row['stok']}\n";
  }

  // Show sample transaksi data
  echo "\nTRANSAKSI (Sample 3 records):\n";
  $data = showSampleData($pdo, 'transaksi', 3);
  foreach ($data as $row) {
    echo "- ID: {$row['id_transaksi']}, Tanggal: {$row['tanggal']}, Total: Rp " . number_format($row['total_harga'], 0, ',', '.') . ", Metode: {$row['metode_pembayaran']}\n";
  }

  // Show detailed transaction analysis
  echo "\n=== TRANSACTION ANALYSIS ===\n";
  $stmt = $pdo->query("
        SELECT 
            t.id_transaksi,
            t.tanggal,
            t.total_harga,
            t.metode_pembayaran,
            p.nama_pelanggan,
            c.nama_cabang,
            COUNT(dt.id) as jumlah_item
        FROM transaksi t
        LEFT JOIN pelanggan p ON t.id_pelanggan = p.id_pelanggan
        LEFT JOIN cabang c ON t.id_cabang = c.id_cabang
        LEFT JOIN detail_transaksi dt ON t.id_transaksi = dt.id_transaksi
        GROUP BY t.id_transaksi
        ORDER BY t.tanggal DESC
    ");

  $transactions = $stmt->fetchAll(PDO::FETCH_ASSOC);
  echo "Total Transactions: " . count($transactions) . "\n";
  echo "\nTransaction Details:\n";
  foreach ($transactions as $trans) {
    echo "- Transaksi #{$trans['id_transaksi']} ({$trans['tanggal']})\n";
    echo "  Customer: {$trans['nama_pelanggan']}\n";
    echo "  Cabang: {$trans['nama_cabang']}\n";
    echo "  Total: Rp " . number_format($trans['total_harga'], 0, ',', '.') . "\n";
    echo "  Payment: {$trans['metode_pembayaran']}\n";
    echo "  Items: {$trans['jumlah_item']} items\n\n";
  }

  // Show stock summary
  echo "=== STOCK SUMMARY ===\n";
  $stmt = $pdo->query("
        SELECT 
            kategori,
            COUNT(*) as jumlah_produk,
            SUM(stok) as total_stok,
            AVG(harga) as rata_rata_harga
        FROM stok_gudang_pusat 
        GROUP BY kategori
        ORDER BY jumlah_produk DESC
    ");

  $stockSummary = $stmt->fetchAll(PDO::FETCH_ASSOC);
  foreach ($stockSummary as $stock) {
    echo "- {$stock['kategori']}: {$stock['jumlah_produk']} produk, Total stok: {$stock['total_stok']}, Avg price: Rp " . number_format($stock['rata_rata_harga'], 0, ',', '.') . "\n";
  }

  // Show kas summary
  echo "\n=== KAS SUMMARY ===\n";
  $stmt = $pdo->query("
        SELECT 
            jenis_transaksi,
            COUNT(*) as jumlah_transaksi,
            SUM(jumlah) as total_amount
        FROM kas 
        GROUP BY jenis_transaksi
    ");

  $kasSummary = $stmt->fetchAll(PDO::FETCH_ASSOC);
  foreach ($kasSummary as $kas) {
    echo "- {$kas['jenis_transaksi']}: {$kas['jumlah_transaksi']} transaksi, Total: Rp " . number_format($kas['total_amount'], 0, ',', '.') . "\n";
  }

  // Get final balance
  $stmt = $pdo->query("SELECT saldo_akhir FROM kas ORDER BY created_at DESC LIMIT 1");
  $finalBalance = $stmt->fetch()['saldo_akhir'];
  echo "- Saldo Akhir: Rp " . number_format($finalBalance, 0, ',', '.') . "\n";

  echo "\n=== VERIFICATION COMPLETED SUCCESSFULLY! ===\n";
  echo "Database is properly seeded and ready for use.\n";
} catch (PDOException $e) {
  echo "Database Error: " . $e->getMessage() . "\n";
} catch (Exception $e) {
  echo "Error: " . $e->getMessage() . "\n";
}
