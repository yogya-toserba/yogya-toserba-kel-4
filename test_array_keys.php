<?php

// Test file untuk debugging array key issues
echo "<h2>Testing Array Key Access Patterns</h2>";

// Simulate data structure dari session
$testData = [
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
        // intentionally missing 'nama_produk' to test error
        'tujuan' => 'Surabaya',
        'jumlah' => 50,
        'status' => 'Siap Kirim',
        'tanggal_kirim' => '2024-01-16'
    ]
];

echo "<h3>Test 1: Standard array access (will cause error on missing keys)</h3>";
foreach ($testData as $index => $item) {
    echo "<div>";
    echo "Index {$index}:<br>";
    try {
        echo "ID: " . $item['id'] . "<br>";
        echo "ID Pengiriman: " . $item['id_pengiriman'] . "<br>";
        echo "Nama Produk: " . $item['nama_produk'] . "<br>"; // This will error on index 1
        echo "Tujuan: " . $item['tujuan'] . "<br>";
        echo "Jumlah: " . $item['jumlah'] . "<br>";
        echo "Status: " . $item['status'] . "<br>";
        echo "Tanggal Kirim: " . $item['tanggal_kirim'] . "<br>";
    } catch (Exception $e) {
        echo "ERROR: " . $e->getMessage() . "<br>";
    }
    echo "</div><hr>";
}

echo "<h3>Test 2: Safe array access with null coalescing operator</h3>";
foreach ($testData as $index => $item) {
    echo "<div>";
    echo "Index {$index}:<br>";
    echo "ID: " . ($item['id'] ?? 'N/A') . "<br>";
    echo "ID Pengiriman: " . ($item['id_pengiriman'] ?? 'Unknown') . "<br>";
    echo "Nama Produk: " . ($item['nama_produk'] ?? 'Unknown Product') . "<br>";
    echo "Tujuan: " . ($item['tujuan'] ?? 'Unknown Destination') . "<br>";
    echo "Jumlah: " . ($item['jumlah'] ?? 0) . "<br>";
    echo "Status: " . ($item['status'] ?? 'Unknown Status') . "<br>";
    echo "Tanggal Kirim: " . ($item['tanggal_kirim'] ?? date('Y-m-d')) . "<br>";
    echo "</div><hr>";
}

echo "<h3>Test 3: Simulate kirimPengiriman function logic</h3>";
function simulateKirimPengiriman($index, $sessionData) {
    if (!isset($sessionData[$index])) {
        return [
            'success' => false,
            'message' => "Data pengiriman tidak ditemukan di index: {$index}"
        ];
    }
    
    $item = $sessionData[$index];
    
    // Update status with safe array access
    $sessionData[$index]['status'] = 'Dikirim';
    $sessionData[$index]['tanggal_kirim_aktual'] = date('Y-m-d H:i:s');
    
    // Prepare data for penerimaan with safe array access
    $penerimaanData = [
        'id' => $item['id'] ?? 'Unknown',
        'id_pengiriman' => $item['id_pengiriman'] ?? 'SHIP-UNKNOWN',
        'nama_produk' => $item['nama_produk'] ?? 'Unknown Product',
        'tujuan' => $item['tujuan'] ?? 'Unknown Destination',
        'jumlah' => $item['jumlah'] ?? 0,
        'status' => 'Dalam Perjalanan',
        'tanggal_kirim' => $item['tanggal_kirim'] ?? date('Y-m-d'),
        'tanggal_kirim_aktual' => date('Y-m-d H:i:s'),
        'created_at' => date('Y-m-d H:i:s')
    ];
    
    return [
        'success' => true,
        'message' => 'Pengiriman berhasil dikirim!',
        'updated_item' => $sessionData[$index],
        'penerimaan_data' => $penerimaanData
    ];
}

// Test both items
for ($i = 0; $i < count($testData); $i++) {
    echo "<h4>Testing kirimPengiriman for index {$i}</h4>";
    $result = simulateKirimPengiriman($i, $testData);
    echo "<pre>";
    print_r($result);
    echo "</pre>";
}

echo "<h3>Test 4: Array key existence check</h3>";
foreach ($testData as $index => $item) {
    echo "Index {$index} keys: " . implode(', ', array_keys($item)) . "<br>";
    echo "Has nama_produk? " . (array_key_exists('nama_produk', $item) ? 'YES' : 'NO') . "<br>";
    echo "Has tujuan? " . (array_key_exists('tujuan', $item) ? 'YES' : 'NO') . "<br>";
    echo "<hr>";
}

?>
