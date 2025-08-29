<?php

// Manual Database Setup Script
echo "=== YOGYA TOSERBA DATABASE SETUP ===\n";
echo "Setting up database tables manually...\n\n";

// Konfigurasi database
$host = '127.0.0.1';
$port = '3306';
$database = 'db_yogya';
$username = 'root';
$password = '';

// SQL untuk membuat database
$createDbSql = "CREATE DATABASE IF NOT EXISTS $database CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci";

// SQL untuk membuat tabel-tabel utama
$tables = [
  'users' => "
        CREATE TABLE IF NOT EXISTS users (
            id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(255) NOT NULL,
            email VARCHAR(255) UNIQUE NOT NULL,
            email_verified_at TIMESTAMP NULL,
            password VARCHAR(255) NOT NULL,
            remember_token VARCHAR(100) NULL,
            created_at TIMESTAMP NULL,
            updated_at TIMESTAMP NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
    ",

  'cabang' => "
        CREATE TABLE IF NOT EXISTS cabang (
            id_cabang BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            nama_cabang VARCHAR(255) NOT NULL,
            kategori VARCHAR(255) NOT NULL,
            alamat VARCHAR(255) NOT NULL,
            wilayah VARCHAR(255) NOT NULL,
            created_at TIMESTAMP NULL,
            updated_at TIMESTAMP NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
    ",

  'pelanggan' => "
        CREATE TABLE IF NOT EXISTS pelanggan (
            id_pelanggan BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            nama_pelanggan VARCHAR(255) NOT NULL,
            tanggal_lahir DATE NOT NULL,
            jenis_kelamin ENUM('L', 'P') NOT NULL,
            email VARCHAR(255) UNIQUE NOT NULL,
            nomer_telepon VARCHAR(20) NOT NULL,
            alamat VARCHAR(255) NOT NULL,
            password VARCHAR(255) NOT NULL,
            level_membership VARCHAR(255) NOT NULL,
            created_at TIMESTAMP NULL,
            updated_at TIMESTAMP NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
    ",

  'kategori' => "
        CREATE TABLE IF NOT EXISTS kategori (
            id_kategori BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            nama_kategori VARCHAR(255) NOT NULL,
            created_at TIMESTAMP NULL,
            updated_at TIMESTAMP NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
    ",

  'stok_gudang_pusat' => "
        CREATE TABLE IF NOT EXISTS stok_gudang_pusat (
            id_produk BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            nama_produk VARCHAR(255) NOT NULL,
            stok INT NOT NULL,
            tanggal DATE NOT NULL,
            kategori VARCHAR(255) NOT NULL,
            deskripsi TEXT NOT NULL,
            harga DECIMAL(10,2) NOT NULL,
            supplier VARCHAR(255) NOT NULL,
            created_at TIMESTAMP NULL,
            updated_at TIMESTAMP NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
    ",

  'gudang' => "
        CREATE TABLE IF NOT EXISTS gudang (
            id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            nama_gudang VARCHAR(255) NOT NULL,
            lokasi VARCHAR(255) NOT NULL,
            kapasitas INT NOT NULL,
            status ENUM('aktif', 'tidak_aktif') NOT NULL DEFAULT 'aktif',
            created_at TIMESTAMP NULL,
            updated_at TIMESTAMP NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
    ",

  'kas' => "
        CREATE TABLE IF NOT EXISTS kas (
            id_kas BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            tanggal DATE NOT NULL,
            jenis_transaksi ENUM('pemasukan', 'pengeluaran') NOT NULL,
            jumlah DECIMAL(15,2) NOT NULL,
            keterangan TEXT NOT NULL,
            saldo_awal DECIMAL(15,2) NOT NULL,
            saldo_akhir DECIMAL(15,2) NOT NULL,
            created_at TIMESTAMP NULL,
            updated_at TIMESTAMP NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
    ",

  'transaksi' => "
        CREATE TABLE IF NOT EXISTS transaksi (
            id_transaksi BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            tanggal DATE NOT NULL,
            total_harga DECIMAL(15,2) NOT NULL,
            metode_pembayaran ENUM('tunai', 'kartu_kredit', 'kartu_debit', 'e_wallet') NOT NULL,
            id_pelanggan BIGINT UNSIGNED NULL,
            id_cabang BIGINT UNSIGNED NOT NULL,
            created_at TIMESTAMP NULL,
            updated_at TIMESTAMP NULL,
            FOREIGN KEY (id_pelanggan) REFERENCES pelanggan(id_pelanggan) ON DELETE SET NULL,
            FOREIGN KEY (id_cabang) REFERENCES cabang(id_cabang) ON DELETE CASCADE
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
    ",

  'detail_transaksi' => "
        CREATE TABLE IF NOT EXISTS detail_transaksi (
            id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            id_transaksi BIGINT UNSIGNED NOT NULL,
            id_produk BIGINT UNSIGNED NOT NULL,
            nama_produk VARCHAR(255) NOT NULL,
            harga_satuan DECIMAL(10,2) NOT NULL,
            jumlah INT NOT NULL,
            subtotal DECIMAL(15,2) NOT NULL,
            created_at TIMESTAMP NULL,
            updated_at TIMESTAMP NULL,
            FOREIGN KEY (id_transaksi) REFERENCES transaksi(id_transaksi) ON DELETE CASCADE,
            FOREIGN KEY (id_produk) REFERENCES stok_gudang_pusat(id_produk) ON DELETE CASCADE
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
    "
];

try {
  echo "Attempting to connect to MySQL...\n";

  // Coba koneksi tanpa database dulu untuk membuat database
  $pdoNoDB = new PDO("mysql:host=$host;port=$port", $username, $password);
  $pdoNoDB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  echo "Connected to MySQL successfully!\n";

  // Buat database
  echo "Creating database '$database'...\n";
  $pdoNoDB->exec($createDbSql);
  echo "Database created successfully!\n";

  // Koneksi ke database yang baru dibuat
  $pdo = new PDO("mysql:host=$host;port=$port;dbname=$database", $username, $password);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  echo "Connected to database '$database'!\n\n";

  // Buat tabel-tabel
  foreach ($tables as $tableName => $sql) {
    echo "Creating table '$tableName'...\n";
    $pdo->exec($sql);
    echo "Table '$tableName' created successfully!\n";
  }

  echo "\n=== DATABASE SETUP COMPLETED SUCCESSFULLY! ===\n";
  echo "All tables have been created.\n";
  echo "Ready for seeding data.\n";
} catch (PDOException $e) {
  echo "Database Error: " . $e->getMessage() . "\n";
  echo "Make sure MySQL is running and accessible.\n";
} catch (Exception $e) {
  echo "Error: " . $e->getMessage() . "\n";
}
