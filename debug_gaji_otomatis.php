<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Services\PenggajianOtomatisService;
use App\Models\Karyawan;

echo "=== Debug Gaji Otomatis ===\n";

try {
    // Cek karyawan dulu
    $karyawanCount = Karyawan::where('status', 'active')->count();
    echo "Total karyawan aktif: $karyawanCount\n";

    if ($karyawanCount > 0) {
        $karyawan = Karyawan::with('jabatan')->where('status', 'active')->first();
        echo "Sample karyawan: " . $karyawan->nama . "\n";
        echo "Jabatan: " . ($karyawan->jabatan ? $karyawan->jabatan->nama_jabatan : 'Tidak ada') . "\n";
        echo "Gaji jabatan: " . ($karyawan->jabatan ? $karyawan->jabatan->jumlah_gaji : 'Tidak ada') . "\n";
    }

    echo "\n=== Test Generate Gaji ===\n";
    $service = new PenggajianOtomatisService();
    $result = $service->generateGajiOtomatis('2024-12');

    echo "Hasil generate gaji:\n";
    print_r($result);
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
    echo "File: " . $e->getFile() . ":" . $e->getLine() . "\n";
    echo "Stack trace:\n" . $e->getTraceAsString() . "\n";
}
