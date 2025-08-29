<?php

// Create migrations table for Laravel
$pdo = new PDO("mysql:host=127.0.0.1;port=3306;dbname=db_yogya", 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Create migrations table
$sql = "
CREATE TABLE migrations (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    migration VARCHAR(255) NOT NULL,
    batch INT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
";

$pdo->exec($sql);

// Add migration records to simulate that migrations have been run
$migrations = [
  '0001_01_01_000000_create_users_table',
  '0001_01_01_000001_create_cache_table',
  '0001_01_01_000002_create_jobs_table',
  '2025_08_07_002359_admin',
  '2025_08_08_000630_create_pelanggan',
  '2025_08_08_000712_create_riwayat_poin',
  '2025_08_08_000800_create_daftar_hadiah',
  '2025_08_08_000828_create_penukaran_koin',
  '2025_08_08_001409_create_shift',
  '2025_08_08_001426_create_karyawan',
  '2025_08_08_001451_create_jadwal_kerja',
  '2025_08_08_001452_create_absensi',
  '2025_08_08_001516_create_gaji',
  '2025_08_08_001606_create_cabang',
  '2025_08_08_001626_create_kategori',
  '2025_08_08_001657_create_stok_produk',
  '2025_08_08_001722_create_stok_gudang_pusat',
  '2025_08_08_001809_create_kas',
  '2025_08_08_001913_create_transaksi',
  '2025_08_08_001946_create_detail_transaksi'
];

$stmt = $pdo->prepare("INSERT INTO migrations (migration, batch) VALUES (?, 1)");
foreach ($migrations as $migration) {
  $stmt->execute([$migration]);
}

echo "Migrations table created and populated successfully!\n";
