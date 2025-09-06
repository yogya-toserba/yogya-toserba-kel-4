<?php
require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';

use Illuminate\Support\Facades\Session;

// Start Laravel session
session_start();

// Buat data contoh untuk permintaan
$contohPermintaan = [
    [
        'id' => 1,
        'nama_produk' => 'Laptop Asus',
        'asal' => 'Gudang Pusat',
        'tujuan' => 'Cabang Yogyakarta',
        'jumlah' => 5,
        'tanggal_permintaan' => date('Y-m-d'),
        'status' => 'Pending',
        'keterangan' => 'Untuk kebutuhan kantor',
        'created_at' => date('Y-m-d H:i:s')
    ],
    [
        'id' => 2,
        'nama_produk' => 'Mouse Logitech',
        'asal' => 'Gudang Pusat',
        'tujuan' => 'Cabang Jakarta',
        'jumlah' => 10,
        'tanggal_permintaan' => date('Y-m-d'),
        'status' => 'Pending',
        'keterangan' => 'Untuk staff administrasi',
        'created_at' => date('Y-m-d H:i:s')
    ],
    [
        'id' => 3,
        'nama_produk' => 'Keyboard Wireless',
        'asal' => 'Gudang Pusat',
        'tujuan' => 'Cabang Surabaya',
        'jumlah' => 8,
        'tanggal_permintaan' => date('Y-m-d'),
        'status' => 'Pending',
        'keterangan' => 'Untuk upgrade peralatan',
        'created_at' => date('Y-m-d H:i:s')
    ]
];

// Buat data contoh untuk pengiriman
$contohPengiriman = [
    [
        'id' => 1,
        'id_pengiriman' => 'SHIP-001',
        'nama_produk' => 'Monitor Samsung',
        'tujuan' => 'Cabang Bandung',
        'jumlah' => 3,
        'tanggal_kirim' => date('Y-m-d'),
        'status' => 'Siap Kirim',
        'created_at' => date('Y-m-d H:i:s')
    ],
    [
        'id' => 2,
        'id_pengiriman' => 'SHIP-002',
        'nama_produk' => 'Printer Canon',
        'tujuan' => 'Cabang Medan',
        'jumlah' => 2,
        'tanggal_kirim' => date('Y-m-d'),
        'status' => 'Siap Kirim',
        'created_at' => date('Y-m-d H:i:s')
    ]
];

// Set session data
$_SESSION['all_permintaan'] = $contohPermintaan;
$_SESSION['all_pengiriman'] = $contohPengiriman;
$_SESSION['all_penerimaan'] = []; // Kosong untuk mulai testing

echo "Data contoh berhasil ditambahkan ke session!\n";
echo "- " . count($contohPermintaan) . " data permintaan\n";
echo "- " . count($contohPengiriman) . " data pengiriman\n";
echo "- Data penerimaan kosong (siap untuk testing)\n";
echo "\nSekarang buka browser untuk test workflow:\n";
echo "1. http://127.0.0.1:8000/gudang/permintaan\n";
echo "2. http://127.0.0.1:8000/gudang/pengiriman\n";
echo "3. http://127.0.0.1:8000/gudang/inventori/penerimaan\n";
?>
