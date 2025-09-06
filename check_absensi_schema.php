<?php

require_once 'vendor/autoload.php';

// Bootstrap Laravel
$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

echo "=== Checking Absensi Table Schema ===\n";

try {
    $absensi = \App\Models\Absensi::first();
    if ($absensi) {
        echo "Primary key name: " . $absensi->getKeyName() . "\n";
        echo "Primary key value: " . $absensi->getKey() . "\n";
        echo "Table name: " . $absensi->getTable() . "\n";
        
        // Show attributes
        echo "\nAttributes:\n";
        foreach ($absensi->getAttributes() as $key => $value) {
            echo "- $key: $value\n";
        }
        
        // Test findOrFail with the key
        $testRecord = \App\Models\Absensi::findOrFail($absensi->getKey());
        echo "\nTesting findOrFail: SUCCESS - Found record with ID " . $testRecord->getKey() . "\n";
        
    } else {
        echo "No absensi records found\n";
    }
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
    echo "Stack trace: " . $e->getTraceAsString() . "\n";
}

echo "\n=== Schema Check Complete ===\n";
