<?php

// Simple test to check if pengiriman index loads without errors
session_start();

// Set some test data
$_SESSION['pengiriman_data'] = [
    [
        'id' => 1,
        'id_pengiriman' => 'SHIP-001',
        'nama_produk' => 'Product A',
        'tujuan' => 'Jakarta',
        'jumlah' => 100,
        'status' => 'Siap Kirim',
        'tanggal_kirim' => '2024-01-15'
    ],
    [
        'id' => 2,
        'id_pengiriman' => 'SHIP-002',
        // Missing nama_produk to test error handling
        'tujuan' => 'Surabaya',
        'jumlah' => 50,
        'status' => 'Siap Kirim',
        'tanggal_kirim' => '2024-01-16'
    ]
];

echo "Session data set successfully!\n";
echo "Navigate to: /gudang/pengiriman to test the page\n";
echo "Test data count: " . count($_SESSION['pengiriman_data']) . "\n";
echo "Data structure:\n";
foreach ($_SESSION['pengiriman_data'] as $index => $item) {
    echo "Index {$index}: " . implode(', ', array_keys($item)) . "\n";
}

?>
