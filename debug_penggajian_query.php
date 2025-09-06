<?php
require_once 'vendor/autoload.php';

use App\Http\Controllers\PenggajianController;
use App\Services\PenggajianOtomatisService;
use Illuminate\Http\Request;
use Carbon\Carbon;

// Simulasi Laravel App
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "=== Test Penggajian Controller ===\n\n";

// Simulasi service
$penggajianService = new PenggajianOtomatisService();

// Buat request seperti di browser
$request = new Request();

try {
    // Test controller
    $controller = new PenggajianController($penggajianService);

    echo "Testing penggajian index method...\n";

    // Cek periode yang digunakan
    $bulan = (int) $request->get('bulan', Carbon::now()->month);
    $tahun = (int) $request->get('tahun', Carbon::now()->year);
    $periode = Carbon::create($tahun, $bulan, 1)->format('Y-m');

    echo "Bulan: $bulan\n";
    echo "Tahun: $tahun\n";
    echo "Periode: $periode\n\n";

    // Test query manual
    echo "Testing query manual...\n";
    $count = \App\Models\Gaji::where('periode_gaji', $periode)->count();
    echo "Count result: $count\n\n";

    // Test dengan berbagai periode
    $testPeriodes = ['2025-09', '2025-9', '09-2025'];
    foreach ($testPeriodes as $testPeriode) {
        echo "Testing periode: $testPeriode\n";
        $testCount = \App\Models\Gaji::where('periode_gaji', $testPeriode)->count();
        echo "Count: $testCount\n";
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
    echo "File: " . $e->getFile() . ":" . $e->getLine() . "\n";
}
