<?php
require_once 'vendor/autoload.php';

use App\Http\Controllers\PenggajianController;
use App\Services\PenggajianOtomatisService;
use Illuminate\Http\Request;

// Simulasi Laravel App
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "=== Test Semua Aksi Penggajian ===\n\n";

try {
    // Test Controller Methods
    $penggajianService = new PenggajianOtomatisService();
    $controller = new PenggajianController($penggajianService);

    echo "1. Testing Index Method...\n";
    $request = new Request();
    $response = $controller->index($request);
    echo "✅ Index method works\n\n";

    echo "2. Testing Show Method...\n";
    $response = $controller->show(1); // Test dengan ID 1
    echo "✅ Show method works\n\n";

    echo "3. Testing Edit Method...\n";
    $response = $controller->edit(1); // Test dengan ID 1
    echo "✅ Edit method works\n\n";

    echo "4. Testing Preview Gaji...\n";
    $request = new Request();
    $request->merge(['bulan' => 9, 'tahun' => 2025]);
    $response = $controller->previewGaji($request);
    echo "✅ PreviewGaji method works\n\n";

    echo "5. Testing Generate Gaji...\n";
    $request = new Request();
    $request->merge(['bulan' => 9, 'tahun' => 2025]);
    $response = $controller->generateGaji($request);
    echo "✅ GenerateGaji method works\n\n";

    echo "🎉 Semua method controller berfungsi dengan baik!\n";
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
    echo "File: " . $e->getFile() . ":" . $e->getLine() . "\n";
    echo "Trace:\n" . $e->getTraceAsString() . "\n";
}
