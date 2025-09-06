<?php
require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Gaji;
use App\Models\Karyawan;
use Illuminate\Support\Facades\DB;

echo "=== Test Data Gaji ===\n";

// Check if gaji data exists
$gajiCount = Gaji::count();
$karyawanCount = Karyawan::count();

echo "Gaji count: $gajiCount\n";
echo "Karyawan count: $karyawanCount\n";

if ($gajiCount == 0 && $karyawanCount > 0) {
    echo "Creating dummy gaji data...\n";
    
    $karyawan = Karyawan::take(3)->get();
    
    foreach ($karyawan as $kar) {
        Gaji::create([
            'id_karyawan' => $kar->id_karyawan,
            'tanggal_gaji' => now(),
            'gaji_pokok' => 5000000,
            'uang_makan' => 300000,
            'uang_transport' => 200000,
            'uang_lembur' => 150000,
            'potongan_bpjs' => 200000,
            'potongan_pajak' => 250000,
            'status_pembayaran' => 'belum_dibayar'
        ]);
        echo "Created gaji for: " . $kar->nama . "\n";
    }
} else {
    echo "Gaji data already exists or no karyawan data\n";
    
    if ($gajiCount > 0) {
        echo "Sample gaji data:\n";
        $sample = Gaji::with('karyawan')->take(3)->get();
        foreach ($sample as $gaji) {
            echo "- ID: {$gaji->id_gaji}, Karyawan: {$gaji->karyawan->nama}, Status: {$gaji->status_pembayaran}\n";
        }
    }
}
