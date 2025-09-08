<?php

// Test script untuk mengecek struktur database
require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

try {
    // Cek struktur tabel pelanggan
    $columns = DB::select("DESCRIBE pelanggan");
    
    echo "Struktur tabel pelanggan:\n";
    foreach ($columns as $column) {
        echo "- " . $column->Field . " (" . $column->Type . ")\n";
    }
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
