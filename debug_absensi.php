<?php
require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

// Test AbsensiController index method manual debug
try {
    $request = new \Illuminate\Http\Request();
    $request->merge([
        'bulan' => date('m'),
        'tahun' => date('Y'),
        'per_page' => 15
    ]);

    echo "Testing AbsensiController with debug...\n";

    // Test model relationship first
    echo "\n=== Testing Model Relationships ===\n";

    $absensi = \App\Models\Absensi::with(['karyawan.jabatan', 'jadwalKerja.shift'])->first();
    if ($absensi) {
        echo "Absensi found: ID {$absensi->id_absensi}\n";
        echo "Karyawan: " . ($absensi->karyawan ? $absensi->karyawan->nama : 'NULL') . "\n";
        echo "Jabatan: " . ($absensi->karyawan && $absensi->karyawan->jabatan ? $absensi->karyawan->jabatan->nama : 'NULL') . "\n";
        echo "Jadwal: " . ($absensi->jadwalKerja ? 'Found' : 'NULL') . "\n";
    } else {
        echo "No absensi data found\n";
    }

    // Test specific absensi data
    echo "\n=== Testing Absensi Data ===\n";
    $count = \App\Models\Absensi::count();
    echo "Total Absensi: $count\n";

    $withKaryawan = \App\Models\Absensi::whereHas('karyawan')->count();
    echo "Absensi with Karyawan: $withKaryawan\n";

    $withoutKaryawan = \App\Models\Absensi::whereDoesntHave('karyawan')->count();
    echo "Absensi without Karyawan: $withoutKaryawan\n";

    if ($withoutKaryawan > 0) {
        $orphans = \App\Models\Absensi::whereDoesntHave('karyawan')->limit(5)->get(['id_absensi', 'id_karyawan']);
        echo "Orphan absensi (first 5): \n";
        foreach ($orphans as $orphan) {
            echo "  - ID: {$orphan->id_absensi}, id_karyawan: {$orphan->id_karyawan}\n";
        }
    }

    // Test Controller
    echo "\n=== Testing Controller ===\n";
    $controller = new \App\Http\Controllers\AbsensiController(new \App\Services\AbsensiService());
    $response = $controller->index($request);
    echo "Controller executed successfully!\n";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
    echo "File: " . $e->getFile() . " Line: " . $e->getLine() . "\n";
    echo "Trace: " . $e->getTraceAsString() . "\n";
}
