<?php

// Fix database structure to match the expected schema
echo "=== FIXING DATABASE STRUCTURE ===\n";
echo "Creating correct tables as per migrations...\n\n";

$host = '127.0.0.1';
$port = '3306';
$database = 'db_yogya';
$username = 'root';
$password = '';

try {
  $pdo = new PDO("mysql:host=$host;port=$port;dbname=$database", $username, $password);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  echo "Connected to database successfully!\n\n";

  // Drop existing problematic tables
  echo "Dropping existing tables...\n";
  $pdo->exec("SET FOREIGN_KEY_CHECKS = 0");
  $pdo->exec("DROP TABLE IF EXISTS detail_transaksi");
  $pdo->exec("DROP TABLE IF EXISTS stok_produk");
  $pdo->exec("DROP TABLE IF EXISTS stok_gudang_pusat");
  $pdo->exec("SET FOREIGN_KEY_CHECKS = 1");
  echo "Tables dropped successfully!\n";

  // Create stok_produk table (correct structure)
  echo "Creating stok_produk table...\n";
  $sql = "
    CREATE TABLE stok_produk (
        id_produk BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        id_cabang BIGINT UNSIGNED NOT NULL,
        id_kategori BIGINT UNSIGNED NOT NULL,
        foto VARCHAR(255) NOT NULL,
        nama_barang VARCHAR(255) NOT NULL,
        jumlah_barang INT NOT NULL,
        harga_jual DECIMAL(15,2) NOT NULL,
        stok INT NOT NULL,
        created_at TIMESTAMP NULL,
        updated_at TIMESTAMP NULL,
        FOREIGN KEY (id_cabang) REFERENCES cabang(id_cabang) ON DELETE CASCADE,
        FOREIGN KEY (id_kategori) REFERENCES kategori(id_kategori) ON DELETE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
    ";
  $pdo->exec($sql);
  echo "stok_produk table created successfully!\n";

  // Create detail_transaksi table (correct structure)
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

  echo "\n=== TABLES FIXED SUCCESSFULLY! ===\n";
  echo "Database structure now matches the expected schema.\n";
  echo "Ready for re-seeding with correct data structure.\n";
} catch (PDOException $e) {
  echo "Database Error: " . $e->getMessage() . "\n";
} catch (Exception $e) {
  echo "Error: " . $e->getMessage() . "\n";
}
