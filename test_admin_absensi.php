<?php
require_once 'vendor/autoload.php';

use App\Http\Controllers\AbsensiController;
use App\Services\AbsensiService;
use Illuminate\Http\Request;

// Simulasi Laravel App
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "=== Test Admin Controller Absensi ===\n\n";

// Simulasi service
$absensiService = new AbsensiService();

// Buat request kosong (tanpa filter)
$request = new Request();

try {
    // Test controller
    $controller = new AbsensiController($absensiService);

    echo "Testing admin index method...\n";
    $response = $controller->index($request);

    // Ambil data dari response
    $data = $response->getData();
    if (isset($data['absensi'])) {
        echo "Data absensi berhasil dimuat:\n";
        echo "Total records: " . $data['absensi']->total() . "\n";
        echo "Current page: " . $data['absensi']->currentPage() . "\n";
        echo "Per page: " . $data['absensi']->perPage() . "\n\n";

        echo "Sample records:\n";
        foreach ($data['absensi']->take(3) as $index => $absensi) {
            echo "Record " . ($index + 1) . ":\n";
            echo "  ID: " . $absensi->id_absensi . "\n";
            echo "  ID Karyawan: " . $absensi->id_karyawan . "\n";
            echo "  Nama: " . ($absensi->karyawan->nama ?? 'N/A') . "\n";
            echo "  Tanggal: " . $absensi->tanggal . "\n";
            echo "  Status: " . $absensi->status . "\n";
            echo "  Jam Masuk: " . ($absensi->jam_masuk ?: 'N/A') . "\n";
            echo "  Jam Keluar: " . ($absensi->jam_keluar ?: 'N/A') . "\n";
            echo "  ---\n";
        }
    } else {
        echo "Tidak ada data absensi\n";
        print_r($data);
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
    echo "File: " . $e->getFile() . ":" . $e->getLine() . "\n";
    echo "Trace:\n" . $e->getTraceAsString() . "\n";
}
