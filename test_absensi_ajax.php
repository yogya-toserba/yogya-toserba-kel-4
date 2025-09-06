<?php
require_once 'vendor/autoload.php';

use Illuminate\Http\Request;
use App\Http\Controllers\KaryawanAbsensiController;
use App\Models\Karyawan;

// Simulasi Laravel App
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "=== Test Absensi AJAX Request ===\n\n";

// Cek data karyawan
$karyawan = Karyawan::first();
if ($karyawan) {
    echo "Karyawan ditemukan:\n";
    echo "ID: " . $karyawan->id . "\n";
    echo "Nama: " . $karyawan->nama . "\n";
    echo "Type ID: " . gettype($karyawan->id) . "\n\n";

    // Simulasi request POST
    $requestData = [
        'id_karyawan' => $karyawan->id_karyawan,
        'keterangan' => 'Test absensi dari script'
    ];

    echo "Data yang akan dikirim:\n";
    print_r($requestData);
    echo "\n";

    // Buat request object
    $request = new Request();
    $request->merge($requestData);
    $request->setMethod('POST');

    echo "Request data:\n";
    echo "id_karyawan: " . $request->input('id_karyawan') . "\n";
    echo "keterangan: " . $request->input('keterangan') . "\n";
    echo "Type id_karyawan: " . gettype($request->input('id_karyawan')) . "\n\n";

    // Test controller
    $controller = new KaryawanAbsensiController();

    try {
        echo "Testing checkIn method...\n";
        $response = $controller->checkIn($request);
        echo "Response: " . $response . "\n";
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage() . "\n";
        echo "File: " . $e->getFile() . ":" . $e->getLine() . "\n";
        echo "Trace:\n" . $e->getTraceAsString() . "\n";
    }
} else {
    echo "Tidak ada data karyawan!\n";
}
