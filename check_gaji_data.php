<?php
require_once 'vendor/autoload.php';

$app = require 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "=== CHECKING GAJI DATA ===\n";

try {
    $gajiCount = App\Models\Gaji::count();
    echo "Total Gaji records: $gajiCount\n\n";
    
    if ($gajiCount > 0) {
        $firstGaji = App\Models\Gaji::with('karyawan')->first();
        echo "First Gaji ID: " . $firstGaji->id_gaji . "\n";
        echo "Karyawan: " . $firstGaji->karyawan->nama . "\n";
        echo "Status: " . $firstGaji->status_pembayaran . "\n\n";
        
        echo "Testing API endpoint...\n";
        $testUrl = "http://127.0.0.1:8000/admin/penggajian/{$firstGaji->id_gaji}/api";
        echo "URL: $testUrl\n";
    } else {
        echo "❌ No gaji data found! Need to generate some data first.\n";
    }
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
?>
