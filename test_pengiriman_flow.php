<?php
// Test script untuk flow pengiriman ke penerimaan

// Simulasi data pengiriman
session_start();

$contohPengiriman = [
    [
        'id' => 1,
        'id_pengiriman' => 'SHIP-001',
        'nama_produk' => 'Monitor Samsung 24 inch',
        'tujuan' => 'Cabang Bandung',
        'jumlah' => 3,
        'tanggal_kirim' => date('Y-m-d'),
        'status' => 'Siap Kirim',
        'created_at' => date('Y-m-d H:i:s')
    ],
    [
        'id' => 2,
        'id_pengiriman' => 'SHIP-002',
        'nama_produk' => 'Printer Canon PIXMA',
        'tujuan' => 'Cabang Medan',
        'jumlah' => 2,
        'tanggal_kirim' => date('Y-m-d'),
        'status' => 'Siap Kirim',
        'created_at' => date('Y-m-d H:i:s')
    ],
    [
        'id' => 3,
        'id_pengiriman' => 'SHIP-003',
        'nama_produk' => 'Laptop ASUS ROG',
        'tujuan' => 'Cabang Surabaya',
        'jumlah' => 1,
        'tanggal_kirim' => date('Y-m-d'),
        'status' => 'Dikirim',
        'created_at' => date('Y-m-d H:i:s')
    ]
];

$contohPenerimaan = [
    [
        'id' => 1,
        'id_pengiriman' => 'SHIP-003',
        'nama_produk' => 'Laptop ASUS ROG',
        'tujuan' => 'Cabang Surabaya',
        'jumlah' => 1,
        'status' => 'Dalam Perjalanan',
        'tanggal_kirim' => date('Y-m-d'),
        'tanggal_kirim_aktual' => date('Y-m-d H:i:s'),
        'created_at' => date('Y-m-d H:i:s')
    ]
];

// Set session data
$_SESSION['all_pengiriman'] = $contohPengiriman;
$_SESSION['all_penerimaan'] = $contohPenerimaan;

echo json_encode([
    'success' => true,
    'message' => 'Data test berhasil dibuat!',
    'pengiriman_count' => count($contohPengiriman),
    'penerimaan_count' => count($contohPenerimaan),
    'pengiriman_data' => $contohPengiriman,
    'penerimaan_data' => $contohPenerimaan
], JSON_PRETTY_PRINT);
?>
