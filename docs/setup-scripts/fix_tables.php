<?php

$pdo = new PDO('mysql:host=127.0.0.1;port=3306;dbname=db_yogya', 'root', '');
$pdo->exec('DROP TABLE IF EXISTS detail_transaksi');
$pdo->exec('DROP TABLE IF EXISTS transaksi');
$pdo->exec('DROP TABLE IF EXISTS pelanggan');

// Recreate pelanggan table
$sql = "
CREATE TABLE pelanggan (
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
";
$pdo->exec($sql);

// Recreate transaksi table
$sql = "
CREATE TABLE transaksi (
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
";
$pdo->exec($sql);

// Recreate detail_transaksi table
$sql = "
CREATE TABLE detail_transaksi (
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
";
$pdo->exec($sql);

echo "Tables recreated successfully!\n";
