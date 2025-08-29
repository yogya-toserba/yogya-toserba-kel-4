<?php

// Manual Database Seeding Script
echo "=== YOGYA TOSERBA DATABASE SEEDING ===\n";
echo "Seeding data into database...\n\n";

// Konfigurasi database
$host = '127.0.0.1';
$port = '3306';
$database = 'db_yogya';
$username = 'root';
$password = '';

try {
  // Koneksi ke database
  $pdo = new PDO("mysql:host=$host;port=$port;dbname=$database", $username, $password);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  echo "Connected to database successfully!\n\n";

  // === SEEDING CABANG ===
  echo "Seeding cabang data...\n";
  $pdo->exec("DELETE FROM cabang");

  $cabangData = [
    [101, 'Cabang Bandung', 'Supermarket', 'Jl. Asia Afrika No. 10, Bandung', 'Bandung'],
    [102, 'Cabang Jakarta Selatan', 'Hypermarket', 'Jl. Sudirman No. 25, Jakarta Selatan', 'Jakarta'],
    [103, 'Cabang Yogyakarta', 'Mini Market', 'Jl. Malioboro No. 88, Yogyakarta', 'Yogyakarta'],
    [104, 'Cabang Surabaya', 'Supermarket', 'Jl. Tunjungan No. 15, Surabaya', 'Surabaya'],
    [105, 'Cabang Medan', 'Hypermarket', 'Jl. Merdeka No. 30, Medan', 'Medan']
  ];

  $stmt = $pdo->prepare("INSERT INTO cabang (id_cabang, nama_cabang, kategori, alamat, wilayah, created_at, updated_at) VALUES (?, ?, ?, ?, ?, NOW(), NOW())");
  foreach ($cabangData as $data) {
    $stmt->execute($data);
  }
  echo "Cabang data seeded successfully! (" . count($cabangData) . " records)\n";

  // === SEEDING KATEGORI ===
  echo "Seeding kategori data...\n";
  $pdo->exec("DELETE FROM kategori");

  $kategoriData = [
    'Makanan & Minuman',
    'Perawatan Pribadi',
    'Rumah Tangga',
    'Elektronik',
    'Pakaian',
    'Olahraga',
    'Kesehatan',
    'Mainan & Hobi',
    'Buku & Alat Tulis',
    'Otomotif'
  ];

  $stmt = $pdo->prepare("INSERT INTO kategori (nama_kategori, created_at, updated_at) VALUES (?, NOW(), NOW())");
  foreach ($kategoriData as $kategori) {
    $stmt->execute([$kategori]);
  }
  echo "Kategori data seeded successfully! (" . count($kategoriData) . " records)\n";

  // === SEEDING GUDANG ===
  echo "Seeding gudang data...\n";
  $pdo->exec("DELETE FROM gudang");

  $gudangData = [
    ['Gudang Pusat Jakarta', 'Jakarta', 10000, 'aktif'],
    ['Gudang Bandung', 'Bandung', 5000, 'aktif'],
    ['Gudang Surabaya', 'Surabaya', 7500, 'aktif'],
    ['Gudang Medan', 'Medan', 4000, 'aktif'],
    ['Gudang Yogyakarta', 'Yogyakarta', 3000, 'aktif']
  ];

  $stmt = $pdo->prepare("INSERT INTO gudang (nama_gudang, lokasi, kapasitas, status, created_at, updated_at) VALUES (?, ?, ?, ?, NOW(), NOW())");
  foreach ($gudangData as $data) {
    $stmt->execute($data);
  }
  echo "Gudang data seeded successfully! (" . count($gudangData) . " records)\n";

  // === SEEDING PELANGGAN ===
  echo "Seeding pelanggan data...\n";
  $pdo->exec("DELETE FROM pelanggan");

  $pelangganData = [
    ['Ahmad Wijaya', '1985-05-15', 'L', 'ahmad@email.com', '081234567890', 'Jl. Merdeka No. 10, Jakarta', password_hash('password123', PASSWORD_BCRYPT), 'Gold'],
    ['Siti Nurhaliza', '1990-08-20', 'P', 'siti@email.com', '081234567891', 'Jl. Sudirman No. 25, Bandung', password_hash('password123', PASSWORD_BCRYPT), 'Silver'],
    ['Budi Santoso', '1988-12-03', 'L', 'budi@email.com', '081234567892', 'Jl. Malioboro No. 88, Yogyakarta', password_hash('password123', PASSWORD_BCRYPT), 'Bronze'],
    ['Rina Dewi', '1992-03-10', 'P', 'rina@email.com', '081234567893', 'Jl. Tunjungan No. 15, Surabaya', password_hash('password123', PASSWORD_BCRYPT), 'Platinum'],
    ['Eko Prasetyo', '1987-11-22', 'L', 'eko@email.com', '081234567894', 'Jl. Pahlawan No. 5, Medan', password_hash('password123', PASSWORD_BCRYPT), 'Silver']
  ];

  $stmt = $pdo->prepare("INSERT INTO pelanggan (nama_pelanggan, tanggal_lahir, jenis_kelamin, email, nomer_telepon, alamat, password, level_membership, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW(), NOW())");
  foreach ($pelangganData as $data) {
    $stmt->execute($data);
  }
  echo "Pelanggan data seeded successfully! (" . count($pelangganData) . " records)\n";

  // === SEEDING STOK GUDANG PUSAT ===
  echo "Seeding stok gudang pusat data...\n";
  $pdo->exec("DELETE FROM stok_gudang_pusat");

  $produkData = [
    ['Indomie Goreng', 500, '2025-01-01', 'Makanan & Minuman', 'Mie instan rasa ayam goreng', 3500.00, 'PT. Indofood'],
    ['Shampoo Pantene', 200, '2025-01-01', 'Perawatan Pribadi', 'Shampoo untuk rambut sehat', 25000.00, 'PT. Procter & Gamble'],
    ['Rice Cooker Cosmos', 50, '2025-01-01', 'Elektronik', 'Rice cooker 1.8 liter', 350000.00, 'PT. Cosmos'],
    ['Kaos Polo', 100, '2025-01-01', 'Pakaian', 'Kaos polo cotton combed', 75000.00, 'PT. Fashion Indonesia'],
    ['Sabun Lifebuoy', 300, '2025-01-01', 'Perawatan Pribadi', 'Sabun mandi antibakteri', 8500.00, 'PT. Unilever'],
    ['Beras Premium', 1000, '2025-01-01', 'Makanan & Minuman', 'Beras putih premium 5kg', 65000.00, 'PT. Beras Nusantara'],
    ['Deterjen Rinso', 150, '2025-01-01', 'Rumah Tangga', 'Deterjen bubuk 800gram', 15000.00, 'PT. Unilever'],
    ['Air Mineral Aqua', 800, '2025-01-01', 'Makanan & Minuman', 'Air mineral 600ml', 3000.00, 'PT. Aqua Golden Mississippi'],
    ['Pasta Gigi Pepsodent', 250, '2025-01-01', 'Perawatan Pribadi', 'Pasta gigi keluarga 190gr', 12000.00, 'PT. Unilever'],
    ['Minyak Goreng Bimoli', 200, '2025-01-01', 'Makanan & Minuman', 'Minyak goreng 2 liter', 32000.00, 'PT. Salim Ivomas']
  ];

  $stmt = $pdo->prepare("INSERT INTO stok_gudang_pusat (nama_produk, stok, tanggal, kategori, deskripsi, harga, supplier, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?, NOW(), NOW())");
  foreach ($produkData as $data) {
    $stmt->execute($data);
  }
  echo "Stok gudang pusat data seeded successfully! (" . count($produkData) . " records)\n";

  // === SEEDING KAS ===
  echo "Seeding kas data...\n";
  $pdo->exec("DELETE FROM kas");

  $kasData = [
    ['2025-01-01', 'pemasukan', 10000000.00, 'Modal awal', 0.00, 10000000.00],
    ['2025-01-02', 'pemasukan', 5000000.00, 'Penjualan hari pertama', 10000000.00, 15000000.00],
    ['2025-01-03', 'pengeluaran', 2000000.00, 'Pembelian stok', 15000000.00, 13000000.00],
    ['2025-01-04', 'pemasukan', 3500000.00, 'Penjualan hari kedua', 13000000.00, 16500000.00],
    ['2025-01-05', 'pengeluaran', 500000.00, 'Biaya operasional', 16500000.00, 16000000.00]
  ];

  $stmt = $pdo->prepare("INSERT INTO kas (tanggal, jenis_transaksi, jumlah, keterangan, saldo_awal, saldo_akhir, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, NOW(), NOW())");
  foreach ($kasData as $data) {
    $stmt->execute($data);
  }
  echo "Kas data seeded successfully! (" . count($kasData) . " records)\n";

  // === SEEDING TRANSAKSI ===
  echo "Seeding transaksi data...\n";
  $pdo->exec("DELETE FROM detail_transaksi");
  $pdo->exec("DELETE FROM transaksi");

  $transaksiData = [
    ['2025-01-02', 150000.00, 'tunai', 1, 101],
    ['2025-01-02', 85000.00, 'kartu_kredit', 2, 102],
    ['2025-01-03', 220000.00, 'e_wallet', 3, 103],
    ['2025-01-04', 95000.00, 'tunai', 4, 101],
    ['2025-01-05', 180000.00, 'kartu_debit', 5, 102]
  ];

  $stmt = $pdo->prepare("INSERT INTO transaksi (tanggal, total_harga, metode_pembayaran, id_pelanggan, id_cabang, created_at, updated_at) VALUES (?, ?, ?, ?, ?, NOW(), NOW())");
  $transaksiIds = [];
  foreach ($transaksiData as $data) {
    $stmt->execute($data);
    $transaksiIds[] = $pdo->lastInsertId();
  }
  echo "Transaksi data seeded successfully! (" . count($transaksiData) . " records)\n";

  // === SEEDING DETAIL TRANSAKSI ===
  echo "Seeding detail transaksi data...\n";

  $detailTransaksiData = [
    // Transaksi 1
    [$transaksiIds[0], 1, 'Indomie Goreng', 3500.00, 10, 35000.00],
    [$transaksiIds[0], 2, 'Shampoo Pantene', 25000.00, 1, 25000.00],
    [$transaksiIds[0], 5, 'Sabun Lifebuoy', 8500.00, 5, 42500.00],

    // Transaksi 2
    [$transaksiIds[1], 6, 'Beras Premium', 65000.00, 1, 65000.00],
    [$transaksiIds[1], 8, 'Air Mineral Aqua', 3000.00, 5, 15000.00],

    // Transaksi 3
    [$transaksiIds[2], 3, 'Rice Cooker Cosmos', 350000.00, 1, 350000.00],

    // Transaksi 4
    [$transaksiIds[3], 7, 'Deterjen Rinso', 15000.00, 2, 30000.00],
    [$transaksiIds[3], 9, 'Pasta Gigi Pepsodent', 12000.00, 3, 36000.00],
    [$transaksiIds[3], 10, 'Minyak Goreng Bimoli', 32000.00, 1, 32000.00],

    // Transaksi 5
    [$transaksiIds[4], 4, 'Kaos Polo', 75000.00, 2, 150000.00],
    [$transaksiIds[4], 1, 'Indomie Goreng', 3500.00, 5, 17500.00]
  ];

  $stmt = $pdo->prepare("INSERT INTO detail_transaksi (id_transaksi, id_produk, nama_produk, harga_satuan, jumlah, subtotal, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, NOW(), NOW())");
  foreach ($detailTransaksiData as $data) {
    $stmt->execute($data);
  }
  echo "Detail transaksi data seeded successfully! (" . count($detailTransaksiData) . " records)\n";

  // === SEEDING USERS ===
  echo "Seeding users data...\n";
  $pdo->exec("DELETE FROM users");

  $userData = [
    ['Admin Sistem', 'admin@yogyatoserba.com', password_hash('admin123', PASSWORD_BCRYPT)],
    ['Manager Jakarta', 'manager.jakarta@yogyatoserba.com', password_hash('manager123', PASSWORD_BCRYPT)],
    ['Kasir Bandung', 'kasir.bandung@yogyatoserba.com', password_hash('kasir123', PASSWORD_BCRYPT)],
    ['Supervisor Surabaya', 'supervisor.surabaya@yogyatoserba.com', password_hash('supervisor123', PASSWORD_BCRYPT)]
  ];

  $stmt = $pdo->prepare("INSERT INTO users (name, email, password, created_at, updated_at) VALUES (?, ?, ?, NOW(), NOW())");
  foreach ($userData as $data) {
    $stmt->execute($data);
  }
  echo "Users data seeded successfully! (" . count($userData) . " records)\n";

  echo "\n=== DATABASE SEEDING COMPLETED SUCCESSFULLY! ===\n";
  echo "Summary:\n";
  echo "- Cabang: " . count($cabangData) . " records\n";
  echo "- Kategori: " . count($kategoriData) . " records\n";
  echo "- Gudang: " . count($gudangData) . " records\n";
  echo "- Pelanggan: " . count($pelangganData) . " records\n";
  echo "- Produk: " . count($produkData) . " records\n";
  echo "- Kas: " . count($kasData) . " records\n";
  echo "- Transaksi: " . count($transaksiData) . " records\n";
  echo "- Detail Transaksi: " . count($detailTransaksiData) . " records\n";
  echo "- Users: " . count($userData) . " records\n";
  echo "\nDatabase is ready for use!\n";
} catch (PDOException $e) {
  echo "Database Error: " . $e->getMessage() . "\n";
} catch (Exception $e) {
  echo "Error: " . $e->getMessage() . "\n";
}
