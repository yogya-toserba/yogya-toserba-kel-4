<?php
require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

// Test AbsensiController index method manually
try {
    $request = new \Illuminate\Http\Request();
    $controller = new \App\Http\Controllers\AbsensiController(new \App\Services\AbsensiService());

    echo "Testing AbsensiController index method...\n";

    // Mock the request with some parameters
    $request->merge([
        'bulan' => date('m'),
        'tahun' => date('Y'),
        'per_page' => 15
    ]);

    $response = $controller->index($request);
    echo "Controller executed successfully!\n";
    echo "View: " . $response->name() . "\n";
    echo "Data keys: " . implode(', ', array_keys($response->getData())) . "\n";

    $data = $response->getData();
    if (isset($data['absensi'])) {
        echo "Absensi data count: " . $data['absensi']->count() . "\n";
    }
    if (isset($data['stats'])) {
        echo "Stats available: " . implode(', ', array_keys($data['stats'])) . "\n";
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
    echo "File: " . $e->getFile() . " Line: " . $e->getLine() . "\n";
}
