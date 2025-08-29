<?php

// Fix transaksi table structure to match migration
echo "=== FIXING TRANSAKSI TABLE STRUCTURE ===\n";
echo "Updating table to match migration specification...\n\n";

$host = '127.0.0.1';
$port = '3306';
$database = 'db_yogya';
$username = 'root';
$password = '';

try {
  $pdo = new PDO("mysql:host=$host;port=$port;dbname=$database", $username, $password);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  echo "Connected to database successfully!\n\n";

  // Drop existing tables that depend on transaksi
  echo "Dropping dependent tables...\n";
  $pdo->exec("SET FOREIGN_KEY_CHECKS = 0");
  $pdo->exec("DROP TABLE IF EXISTS detail_transaksi");
  $pdo->exec("DROP TABLE IF EXISTS transaksi");
  $pdo->exec("SET FOREIGN_KEY_CHECKS = 1");
  echo "Tables dropped successfully!\n";

  // Create transaksi table with correct structure from migration
  echo "Creating transaksi table with correct structure...\n";
  $sql = "
    CREATE TABLE transaksi (
        id_transaksi BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        id_pelanggan BIGINT UNSIGNED NOT NULL,
        tanggal_transaksi DATE NOT NULL,
        total_belanja DECIMAL(15,2) NOT NULL,
        id_cabang BIGINT UNSIGNED NOT NULL,
        poin_yang_didapatkan INT NULL,
        poin_yang_digunakan INT NULL,
        id_kas BIGINT UNSIGNED NOT NULL,
        created_at TIMESTAMP NULL,
        updated_at TIMESTAMP NULL,
        FOREIGN KEY (id_pelanggan) REFERENCES pelanggan(id_pelanggan) ON DELETE CASCADE,
        FOREIGN KEY (id_cabang) REFERENCES cabang(id_cabang) ON DELETE CASCADE,
        FOREIGN KEY (id_kas) REFERENCES kas(id_kas) ON DELETE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
    ";
  $pdo->exec($sql);
  echo "transaksi table created successfully!\n";

  // Create detail_transaksi table with correct structure
  echo "Creating detail_transaksi table...\n";
  $sql = "
    CREATE TABLE detail_transaksi (
        id_detail_penjualan BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        id_transaksi BIGINT UNSIGNED NOT NULL,
        id_produk BIGINT UNSIGNED NOT NULL,
        nama_barang VARCHAR(255) NOT NULL,
        jumlah_barang INT NOT NULL,
        total_harga DECIMAL(15,2) NOT NULL,
        created_at TIMESTAMP NULL,
        updated_at TIMESTAMP NULL,
        FOREIGN KEY (id_transaksi) REFERENCES transaksi(id_transaksi) ON DELETE CASCADE,
        FOREIGN KEY (id_produk) REFERENCES stok_produk(id_produk) ON DELETE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
    ";
  $pdo->exec($sql);
  echo "detail_transaksi table created successfully!\n";

  echo "\n=== RE-SEEDING DATA ===\n";

  // Seed transaksi data with correct column names
  echo "Seeding transaksi data...\n";
  $transaksiData = [
    [1, '2025-01-02', 150000.00, 101, 150, 0, 1], // id_pelanggan, tanggal_transaksi, total_belanja, id_cabang, poin_didapat, poin_digunakan, id_kas
    [2, '2025-01-02', 85000.00, 102, 85, 0, 2],
    [3, '2025-01-03', 350000.00, 103, 350, 0, 3],
    [4, '2025-01-04', 98000.00, 101, 98, 0, 4],
    [5, '2025-01-05', 167500.00, 102, 167, 0, 5]
  ];

  $stmt = $pdo->prepare("INSERT INTO transaksi (id_pelanggan, tanggal_transaksi, total_belanja, id_cabang, poin_yang_didapatkan, poin_yang_digunakan, id_kas, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?, NOW(), NOW())");
  $transaksiIds = [];
  foreach ($transaksiData as $data) {
    $stmt->execute($data);
    $transaksiIds[] = $pdo->lastInsertId();
  }
  echo "transaksi data seeded successfully! (" . count($transaksiData) . " records)\n";

  // Seed detail_transaksi data
  echo "Seeding detail_transaksi data...\n";

  // Get product IDs
  $produktIds = [];
  $stmt = $pdo->query("SELECT id_produk, nama_barang, harga_jual FROM stok_produk ORDER BY id_produk");
  while ($row = $stmt->fetch()) {
    $produktIds[] = $row;
  }

  $detailTransaksiData = [
    // Transaksi 1 (150000)
    [$transaksiIds[0], $produktIds[0]['id_produk'], $produktIds[0]['nama_barang'], 10, $produktIds[0]['harga_jual'] * 10],
    [$transaksiIds[0], $produktIds[4]['id_produk'], $produktIds[4]['nama_barang'], 1, $produktIds[4]['harga_jual'] * 1],
    [$transaksiIds[0], $produktIds[5]['id_produk'], $produktIds[5]['nama_barang'], 5, $produktIds[5]['harga_jual'] * 5],

    // Transaksi 2 (85000)
    [$transaksiIds[1], $produktIds[1]['id_produk'], $produktIds[1]['nama_barang'], 1, $produktIds[1]['harga_jual'] * 1],
    [$transaksiIds[1], $produktIds[2]['id_produk'], $produktIds[2]['nama_barang'], 5, $produktIds[2]['harga_jual'] * 5],

    // Transaksi 3 (350000)
    [$transaksiIds[2], $produktIds[7]['id_produk'], $produktIds[7]['nama_barang'], 1, $produktIds[7]['harga_jual'] * 1],

    // Transaksi 4 (98000)
    [$transaksiIds[3], $produktIds[9]['id_produk'], $produktIds[9]['nama_barang'], 2, $produktIds[9]['harga_jual'] * 2],
    [$transaksiIds[3], $produktIds[6]['id_produk'], $produktIds[6]['nama_barang'], 3, $produktIds[6]['harga_jual'] * 3],
    [$transaksiIds[3], $produktIds[3]['id_produk'], $produktIds[3]['nama_barang'], 1, $produktIds[3]['harga_jual'] * 1],

    // Transaksi 5 (167500)
    [$transaksiIds[4], $produktIds[8]['id_produk'], $produktIds[8]['nama_barang'], 2, $produktIds[8]['harga_jual'] * 2],
    [$transaksiIds[4], $produktIds[0]['id_produk'], $produktIds[0]['nama_barang'], 5, $produktIds[0]['harga_jual'] * 5]
  ];

  $stmt = $pdo->prepare("INSERT INTO detail_transaksi (id_transaksi, id_produk, nama_barang, jumlah_barang, total_harga, created_at, updated_at) VALUES (?, ?, ?, ?, ?, NOW(), NOW())");
  foreach ($detailTransaksiData as $data) {
    $stmt->execute($data);
  }
  echo "detail_transaksi data seeded successfully! (" . count($detailTransaksiData) . " records)\n";

  // Test the failing query
  echo "\n=== TESTING FAILING QUERY ===\n";
  $today = date('Y-m-d');
  $stmt = $pdo->prepare("SELECT COUNT(*) as aggregate FROM transaksi WHERE DATE(tanggal_transaksi) = ?");
  $stmt->execute([$today]);
  $result = $stmt->fetch();

  echo "✅ SUCCESS: Query with 'tanggal_transaksi' works!\n";
  echo "   Transactions today ({$today}): {$result['aggregate']}\n";

  // Test with sample date
  $stmt = $pdo->prepare("SELECT COUNT(*) as aggregate FROM transaksi WHERE DATE(tanggal_transaksi) = ?");
  $stmt->execute(['2025-01-02']);
  $result = $stmt->fetch();
  echo "   Transactions on 2025-01-02: {$result['aggregate']}\n";

  echo "\n=== TRANSAKSI TABLE STRUCTURE FIXED SUCCESSFULLY! ===\n";
  echo "All queries using 'tanggal_transaksi' should now work properly.\n";
} catch (PDOException $e) {
  echo "Database Error: " . $e->getMessage() . "\n";
} catch (Exception $e) {
  echo "Error: " . $e->getMessage() . "\n";
}
