<?php

require_once 'vendor/autoload.php';

// Bootstrap Laravel app
$app = require_once 'bootstrap/app.php';

// Initialize the HTTP kernel
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

// Bootstrap the application
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

echo "=== Testing Absensi Data ===\n";

try {
    $count = \App\Models\Absensi::count();
    echo "Total absensi records: $count\n";
    
    if ($count > 0) {
        $first = \App\Models\Absensi::first();
        echo "First absensi ID: " . $first->id . "\n";
        echo "Tanggal: " . $first->tanggal . "\n";
        echo "Status: " . $first->status . "\n";
        
        // Test loading relationships
        $absensi = \App\Models\Absensi::with(['karyawan.jabatan'])->first();
        echo "Karyawan: " . ($absensi->karyawan->nama ?? 'N/A') . "\n";
        echo "Jabatan: " . ($absensi->karyawan->jabatan->nama_jabatan ?? 'N/A') . "\n";
    } else {
        echo "No absensi data found. Creating sample data...\n";
        
        // Get first karyawan
        $karyawan = \App\Models\Karyawan::first();
        if ($karyawan) {
            $absensi = \App\Models\Absensi::create([
                'id_karyawan' => $karyawan->id,
                'tanggal' => date('Y-m-d'),
                'jam_masuk' => '08:00',
                'jam_keluar' => '17:00',
                'status' => 'hadir',
                'keterangan' => 'Test data for API'
            ]);
            
            echo "Sample absensi created with ID: " . $absensi->id . "\n";
        } else {
            echo "No karyawan data found!\n";
        }
    }
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}

echo "\n=== Testing Complete ===\n";
