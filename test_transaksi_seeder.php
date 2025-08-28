<?php

require_once 'vendor/autoload.php';

use Illuminate\Support\Facades\DB;

// Load Laravel app
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

try {
    echo "🔄 Testing TransaksiSeeder...\n";
    
    // Test database connection
    echo "Testing database connection: ";
    $count = DB::table('pelanggan')->count();
    echo "OK - Found {$count} pelanggan\n";
    
    // Test if required data exists
    $cabangCount = DB::table('cabang')->count();
    $produkCount = DB::table('stok_produk')->count();
    echo "Required data - Cabang: {$cabangCount}, Produk: {$produkCount}\n";
    
    // Run TransaksiSeeder
    $seeder = new Database\Seeders\TransaksiSeeder();
    $seeder->run();
    
    echo "✅ TransaksiSeeder completed successfully!\n";
    
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
    echo "File: " . $e->getFile() . ":" . $e->getLine() . "\n";
    echo "Stack trace:\n" . $e->getTraceAsString() . "\n";
}
