<?php
require_once 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

try {
    echo "Struktur tabel stok_produk:\n";
    $columns = DB::select("DESCRIBE stok_produk");
    foreach ($columns as $column) {
        echo "- " . $column->Field . " (" . $column->Type . ")\n";
    }
    
    echo "\nSample data:\n";
    $sample = DB::table('stok_produk')->limit(3)->get();
    foreach ($sample as $row) {
        echo "Data: " . json_encode($row) . "\n";
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
