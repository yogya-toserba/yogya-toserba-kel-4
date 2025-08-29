<?php

// Re-seed database with correct structure
echo "=== RE-SEEDING DATABASE WITH CORRECT STRUCTURE ===\n";
echo "Seeding data into corrected tables...\n\n";

$host = '127.0.0.1';
$port = '3306';
$database = 'db_yogya';
$username = 'root';
$password = '';

try {
  $pdo = new PDO("mysql:host=$host;port=$port;dbname=$database", $username, $password);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  echo "Connected to database successfully!\n\n";

  // === SEEDING STOK_PRODUK ===
  echo "Seeding stok_produk data...\n";
  $pdo->exec("DELETE FROM stok_produk");

  // Get kategori IDs first
  $kategoriMap = [];
  $stmt = $pdo->query("SELECT id_kategori, nama_kategori FROM kategori");
  while ($row = $stmt->fetch()) {
    $kategoriMap[$row['nama_kategori']] = $row['id_kategori'];
  }

  $produkData = [
    // Makanan & Minuman
    [101, $kategoriMap['Makanan & Minuman'], 'indomie.jpg', 'Indomie Goreng', 20, 3500.00, 500],
    [101, $kategoriMap['Makanan & Minuman'], 'beras.jpg', 'Beras Premium 5kg', 1, 65000.00, 100],
    [102, $kategoriMap['Makanan & Minuman'], 'aqua.jpg', 'Air Mineral Aqua 600ml', 24, 3000.00, 800],
    [103, $kategoriMap['Makanan & Minuman'], 'minyak.jpg', 'Minyak Goreng Bimoli 2L', 1, 32000.00, 200],

    // Perawatan Pribadi
    [101, $kategoriMap['Perawatan Pribadi'], 'pantene.jpg', 'Shampoo Pantene 400ml', 1, 25000.00, 150],
    [102, $kategoriMap['Perawatan Pribadi'], 'lifebuoy.jpg', 'Sabun Lifebuoy', 3, 8500.00, 300],
    [103, $kategoriMap['Perawatan Pribadi'], 'pepsodent.jpg', 'Pasta Gigi Pepsodent 190gr', 1, 12000.00, 250],

    // Elektronik
    [101, $kategoriMap['Elektronik'], 'cosmos.jpg', 'Rice Cooker Cosmos 1.8L', 1, 350000.00, 50],

    // Pakaian
    [102, $kategoriMap['Pakaian'], 'kaos_polo.jpg', 'Kaos Polo Cotton', 1, 75000.00, 100],

    // Rumah Tangga
    [103, $kategoriMap['Rumah Tangga'], 'rinso.jpg', 'Deterjen Rinso 800gr', 1, 15000.00, 150]
  ];

  $stmt = $pdo->prepare("INSERT INTO stok_produk (id_cabang, id_kategori, foto, nama_barang, jumlah_barang, harga_jual, stok, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?, NOW(), NOW())");
  foreach ($produkData as $data) {
    $stmt->execute($data);
  }
  echo "stok_produk data seeded successfully! (" . count($produkData) . " records)\n";

  // === SEEDING DETAIL_TRANSAKSI ===
  echo "Seeding detail_transaksi data...\n";
  $pdo->exec("DELETE FROM detail_transaksi");

  // Get product IDs
  $produktIds = [];
  $stmt = $pdo->query("SELECT id_produk, nama_barang, harga_jual FROM stok_produk ORDER BY id_produk");
  while ($row = $stmt->fetch()) {
    $produktIds[] = $row;
  }

  // Get transaction IDs
  $transaksiIds = [];
  $stmt = $pdo->query("SELECT id_transaksi FROM transaksi ORDER BY id_transaksi");
  while ($row = $stmt->fetch()) {
    $transaksiIds[] = $row['id_transaksi'];
  }

  $detailTransaksiData = [
    // Transaksi 1
    [$transaksiIds[0], $produktIds[0]['id_produk'], $produktIds[0]['nama_barang'], 10, $produktIds[0]['harga_jual'] * 10],
    [$transaksiIds[0], $produktIds[4]['id_produk'], $produktIds[4]['nama_barang'], 1, $produktIds[4]['harga_jual'] * 1],
    [$transaksiIds[0], $produktIds[5]['id_produk'], $produktIds[5]['nama_barang'], 5, $produktIds[5]['harga_jual'] * 5],

    // Transaksi 2
    [$transaksiIds[1], $produktIds[1]['id_produk'], $produktIds[1]['nama_barang'], 1, $produktIds[1]['harga_jual'] * 1],
    [$transaksiIds[1], $produktIds[2]['id_produk'], $produktIds[2]['nama_barang'], 5, $produktIds[2]['harga_jual'] * 5],

    // Transaksi 3
    [$transaksiIds[2], $produktIds[7]['id_produk'], $produktIds[7]['nama_barang'], 1, $produktIds[7]['harga_jual'] * 1],

    // Transaksi 4
    [$transaksiIds[3], $produktIds[9]['id_produk'], $produktIds[9]['nama_barang'], 2, $produktIds[9]['harga_jual'] * 2],
    [$transaksiIds[3], $produktIds[6]['id_produk'], $produktIds[6]['nama_barang'], 3, $produktIds[6]['harga_jual'] * 3],
    [$transaksiIds[3], $produktIds[3]['id_produk'], $produktIds[3]['nama_barang'], 1, $produktIds[3]['harga_jual'] * 1],

    // Transaksi 5
    [$transaksiIds[4], $produktIds[8]['id_produk'], $produktIds[8]['nama_barang'], 2, $produktIds[8]['harga_jual'] * 2],
    [$transaksiIds[4], $produktIds[0]['id_produk'], $produktIds[0]['nama_barang'], 5, $produktIds[0]['harga_jual'] * 5]
  ];

  $stmt = $pdo->prepare("INSERT INTO detail_transaksi (id_transaksi, id_produk, nama_barang, jumlah_barang, total_harga, created_at, updated_at) VALUES (?, ?, ?, ?, ?, NOW(), NOW())");
  foreach ($detailTransaksiData as $data) {
    $stmt->execute($data);
  }
  echo "detail_transaksi data seeded successfully! (" . count($detailTransaksiData) . " records)\n";

  // Update transaction totals based on detail
  echo "Updating transaction totals...\n";
  $stmt = $pdo->query("
        UPDATE transaksi t 
        SET total_harga = (
            SELECT SUM(total_harga) 
            FROM detail_transaksi dt 
            WHERE dt.id_transaksi = t.id_transaksi
        )
    ");
  echo "Transaction totals updated successfully!\n";

  echo "\n=== RE-SEEDING COMPLETED SUCCESSFULLY! ===\n";
  echo "Summary:\n";
  echo "- stok_produk: " . count($produkData) . " records\n";
  echo "- detail_transaksi: " . count($detailTransaksiData) . " records\n";
  echo "- Transaction totals updated based on details\n";
  echo "\nDatabase structure now matches application expectations!\n";
} catch (PDOException $e) {
  echo "Database Error: " . $e->getMessage() . "\n";
} catch (Exception $e) {
  echo "Error: " . $e->getMessage() . "\n";
}
