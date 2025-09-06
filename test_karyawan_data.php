<?php
require 'vendor/autoload.php';

$app = require 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Karyawan;
use App\Models\Jabatan;

echo "=== Checking Karyawan Data ===\n";

// Check karyawan data
$karyawan = Karyawan::with('jabatan')->limit(10)->get();

if ($karyawan->count() > 0) {
    echo "Found " . $karyawan->count() . " karyawan:\n";
    foreach ($karyawan as $k) {
        echo "- ID: {$k->id_karyawan}, Nama: {$k->nama}, Jabatan: " . ($k->jabatan ? $k->jabatan->nama_jabatan : 'N/A') . "\n";
    }
} else {
    echo "No karyawan found. Creating sample data...\n";

    // Create sample jabatan
    $jabatan1 = Jabatan::firstOrCreate(['nama_jabatan' => 'Staff'], [
        'gaji_pokok' => 3000000,
        'tunjangan' => 500000
    ]);

    $jabatan2 = Jabatan::firstOrCreate(['nama_jabatan' => 'Supervisor'], [
        'gaji_pokok' => 5000000,
        'tunjangan' => 800000
    ]);

    // Create sample karyawan
    $samples = [
        ['K001', 'Ahmad Rizki', $jabatan1->id_jabatan],
        ['K002', 'Siti Nurhaliza', $jabatan1->id_jabatan],
        ['K003', 'Budi Santoso', $jabatan2->id_jabatan],
        ['K004', 'Maya Sari', $jabatan1->id_jabatan],
        ['K005', 'Dedi Kurniawan', $jabatan2->id_jabatan]
    ];

    foreach ($samples as $sample) {
        Karyawan::firstOrCreate(['id_karyawan' => $sample[0]], [
            'nama' => $sample[1],
            'alamat' => 'Jl. Sample No. 123',
            'telepon' => '081234567890',
            'tanggal_masuk' => now()->subMonths(rand(1, 12)),
            'id_jabatan' => $sample[2],
            'status' => 'Aktif'
        ]);
    }

    echo "Sample data created!\n";

    // Show created data
    $karyawan = Karyawan::with('jabatan')->get();
    foreach ($karyawan as $k) {
        echo "- ID: {$k->id_karyawan}, Nama: {$k->nama}, Jabatan: " . ($k->jabatan ? $k->jabatan->nama_jabatan : 'N/A') . "\n";
    }
}

echo "\n=== Testing Complete ===\n";
