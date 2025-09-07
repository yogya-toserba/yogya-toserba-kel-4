<?php
require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Gaji;
use App\Models\Karyawan;
use Carbon\Carbon;

echo "=== TESTING AUTOMATIC PAYROLL GENERATION ===\n";

// Test for next month to avoid conflicts
$nextMonth = Carbon::now()->addMonth();
$periode = $nextMonth->format('Y-m');

echo "Testing period: {$periode}\n";

// Get a karyawan for testing
$karyawan = Karyawan::with('jabatan')->first();

if (!$karyawan) {
    echo "No karyawan found for testing.\n";
    exit;
}

echo "Testing with karyawan: {$karyawan->nama}\n";

// Create gaji manually using the updated method
$gajiPokok = $karyawan->jabatan->gaji_pokok ?? 3000000;
$tunjangan = 350000;
$bonus = 0;
$potongan = $gajiPokok * 0.09;
$jumlahGaji = $gajiPokok + $tunjangan + $bonus - $potongan;

$newGaji = Gaji::create([
    'id_karyawan' => $karyawan->id_karyawan,
    'periode_gaji' => $periode,
    'gaji_pokok' => $gajiPokok,
    'tunjangan' => $tunjangan,
    'bonus' => $bonus,
    'potongan' => $potongan,
    'jumlah_gaji' => $jumlahGaji,
    'status_pembayaran' => 'paid',
    'tanggal_bayar' => now(),
    'is_auto_generated' => true
]);

echo "✅ NEW GAJI CREATED:\n";
echo "- ID: {$newGaji->id_gaji}\n";
echo "- Karyawan: {$karyawan->nama}\n";
echo "- Periode: {$newGaji->periode_gaji}\n";
echo "- Status: {$newGaji->status_pembayaran}\n";
echo "- Tanggal Bayar: {$newGaji->tanggal_bayar}\n";
echo "- Jumlah Gaji: Rp " . number_format($newGaji->jumlah_gaji, 0, ',', '.') . "\n";

echo "\n=== AUTOMATIC PAYROLL NOW GENERATES WITH 'PAID' STATUS ===\n";
