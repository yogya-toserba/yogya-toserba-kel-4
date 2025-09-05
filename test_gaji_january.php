<?php

require_once __DIR__ . '/vendor/autoload.php';

// Bootstrap Laravel
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Services\PenggajianOtomatisService;

$service = new PenggajianOtomatisService();

// Test untuk periode Januari 2025 (bukan Desember 2024 yang sudah ada datanya)
$results = $service->generateGajiOtomatis('2025-01');

echo "Periode: 2025-01\n";
echo "Total karyawan diproses: " . count($results) . "\n";

// Hitung statistik
$created = 0;
$updated = 0;
$errors = 0;

foreach ($results as $result) {
    if ($result['status'] === 'created') {
        $created++;
    } elseif ($result['status'] === 'updated') {
        $updated++;
    } elseif ($result['status'] === 'error') {
        $errors++;
    }
}

echo "Dibuat: $created, Diupdate: $updated, Error: $errors\n";

// Tampilkan beberapa contoh hasil
echo "\nContoh hasil:\n";
$count = 0;
foreach ($results as $result) {
    if ($count >= 5) break;
    echo "- {$result['nama']}: {$result['status']}";
    if (isset($result['jumlah_gaji'])) {
        echo " (Rp " . number_format($result['jumlah_gaji'], 0, ',', '.') . ")";
    }
    echo "\n";
    $count++;
}

// Jika ada error, tampilkan
if ($errors > 0) {
    echo "\nError yang terjadi:\n";
    $count = 0;
    foreach ($results as $result) {
        if ($result['status'] === 'error' && $count < 3) {
            echo "- {$result['nama']}: {$result['message']}\n";
            $count++;
        }
    }
}
