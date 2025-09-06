<?php
require 'vendor/autoload.php';

$app = require 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Absensi;
use App\Models\Karyawan;

echo "=== Testing Absensi Function ===\n";

// Ambil karyawan pertama
$karyawan = Karyawan::first();
if (!$karyawan) {
    echo "No karyawan found!\n";
    exit;
}

echo "Testing with: {$karyawan->nama} (ID: {$karyawan->id_karyawan})\n";

// Test cek status hari ini
$today = \Carbon\Carbon::today();
$absensi = Absensi::where('id_karyawan', $karyawan->id_karyawan)
    ->where('tanggal', $today)
    ->first();

echo "Current absensi status: " . ($absensi ? "Ada" : "Belum ada") . "\n";

if ($absensi) {
    echo "- Jam masuk: " . ($absensi->jam_masuk ?? 'Belum') . "\n";
    echo "- Jam keluar: " . ($absensi->jam_keluar ?? 'Belum') . "\n";
    echo "- Status: " . $absensi->status . "\n";
}

echo "\n=== Ready for testing ===\n";
echo "Gunakan ID: {$karyawan->id_karyawan}\n";
echo "Atau nama: {$karyawan->nama}\n";
echo "Di halaman: http://127.0.0.1:8000/karyawan\n";
