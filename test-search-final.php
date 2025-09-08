<?php
require_once 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "=== Testing Search Query ===\n";

// Simulate the controller search
$query = 'samsung';
$results = DB::table('stok_produk')
  ->select('id_produk', 'nama_barang', 'harga_jual as harga', 'stok', 'foto')
  ->where('nama_barang', 'like', "%{$query}%")
  ->limit(10)
  ->get();

echo "Search query: $query\n";
echo "Results found: " . count($results) . "\n\n";

foreach ($results as $product) {
    echo "Product: {$product->nama_barang}\n";
    echo "Price: Rp " . number_format($product->harga, 0, ',', '.') . "\n";
    echo "Stock: {$product->stok}\n";
    echo "Photo: {$product->foto}\n";
    echo "---\n";
}

// Test the controller method directly
echo "\n=== Testing Controller Method ===\n";
$request = new \Illuminate\Http\Request(['q' => 'samsung']);
$controller = new \App\Http\Controllers\PelangganController();

try {
    $response = $controller->search($request);
    echo "Controller response generated successfully\n";
    echo "Response type: " . get_class($response) . "\n";
} catch (Exception $e) {
    echo "Controller error: " . $e->getMessage() . "\n";
}
