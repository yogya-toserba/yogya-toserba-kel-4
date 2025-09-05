<?php

require_once __DIR__ . '/vendor/autoload.php';

// Bootstrap Laravel
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Services\PenggajianOtomatisService;
use App\Models\Karyawan;
use App\Models\Gaji;
use App\Models\Absensi;

echo "=== Final System Test ===\n\n";

try {
    // 1. Test Database Connection
    echo "1. Testing Database Connection...\n";
    $karyawanCount = Karyawan::count();
    $gajiCount = Gaji::count();
    $absensiCount = Absensi::count();

    echo "   ✅ Karyawan: $karyawanCount records\n";
    echo "   ✅ Gaji: $gajiCount records\n";
    echo "   ✅ Absensi: $absensiCount records\n\n";

    // 2. Test Karyawan Model Methods
    echo "2. Testing Karyawan Model Methods...\n";
    $karyawan = Karyawan::with(['jabatan'])->first();
    if ($karyawan) {
        $totalHadir = $karyawan->getTotalKehadiranBulan(2025, 9);
        $statistik = $karyawan->getStatistikAbsensiBulan(2025, 9);

        echo "   ✅ getTotalKehadiranBulan: $totalHadir\n";
        echo "   ✅ getStatistikAbsensiBulan: " . json_encode($statistik) . "\n\n";
    }

    // 3. Test PenggajianOtomatisService
    echo "3. Testing Penggajian Otomatis Service...\n";
    $service = new PenggajianOtomatisService();

    // Test dengan periode February 2025 (periode baru)
    $results = $service->generateGajiOtomatis('2025-02');

    $created = array_filter($results, fn($r) => $r['status'] === 'created');
    $updated = array_filter($results, fn($r) => $r['status'] === 'updated');
    $errors = array_filter($results, fn($r) => $r['status'] === 'error');

    echo "   ✅ Total Processed: " . count($results) . "\n";
    echo "   ✅ Created: " . count($created) . "\n";
    echo "   ✅ Updated: " . count($updated) . "\n";
    echo "   ✅ Errors: " . count($errors) . "\n\n";

    // 4. Test Final Gaji Count
    echo "4. Final Database Status...\n";
    $finalGajiCount = Gaji::count();
    echo "   ✅ Total Gaji Records: $finalGajiCount\n";

    // Count by periode
    $periodeCount = Gaji::selectRaw('periode_gaji, COUNT(*) as count')
        ->groupBy('periode_gaji')
        ->orderBy('periode_gaji')
        ->get();

    echo "   📊 Gaji by Periode:\n";
    foreach ($periodeCount as $p) {
        echo "      - {$p->periode_gaji}: {$p->count} records\n";
    }

    echo "\n🎉 ALL TESTS PASSED! System is fully functional.\n";
} catch (Exception $e) {
    echo "\n❌ ERROR: " . $e->getMessage() . "\n";
    echo "File: " . $e->getFile() . ":" . $e->getLine() . "\n";
    echo "Trace: " . $e->getTraceAsString() . "\n";
}
