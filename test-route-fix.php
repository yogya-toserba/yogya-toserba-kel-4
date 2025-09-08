<?php
require_once 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "=== Testing Route pelanggan.search ===\n";

try {
    // Test route generation
    $url = route('pelanggan.search', ['q' => 'samsung']);
    echo "✅ Route URL generated: $url\n";
    
    // Test controller method
    $request = new \Illuminate\Http\Request(['q' => 'samsung']);
    $controller = new \App\Http\Controllers\PelangganController();
    $response = $controller->search($request);
    
    echo "✅ Controller method executed successfully\n";
    echo "✅ Response type: " . get_class($response) . "\n";
    
    // Test data
    $data = $response->getData();
    echo "✅ Results count: " . count($data['results']) . "\n";
    echo "✅ Search query: " . $data['query'] . "\n";
    
    if (count($data['results']) > 0) {
        echo "✅ Sample result: " . $data['results'][0]->nama_barang . "\n";
    }
    
    echo "\n=== All tests passed! Search function is working correctly ===\n";
    
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
    echo "Trace: " . $e->getTraceAsString() . "\n";
}
