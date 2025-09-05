<?php

require_once 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Gaji;
use Carbon\Carbon;

echo "=== Test Query Penggajian Controller ===\n";

// Simulasi parameter yang digunakan di controller
$bulan = 12; // Desember
$tahun = 2024;

echo "Testing query untuk periode: $tahun-$bulan\n\n";

// Test query yang sama seperti di controller
$gajiList = Gaji::with(['karyawan.jabatan', 'karyawan.cabang'])
    ->where('periode_gaji', '2024-12') // Format yang kita gunakan
    ->orderBy('created_at', 'desc')
    ->limit(10)
    ->get();

echo "Jumlah data gaji ditemukan: " . $gajiList->count() . "\n\n";

if ($gajiList->count() > 0) {
    echo "Sample data:\n";
    foreach ($gajiList as $index => $gaji) {
        echo ($index + 1) . ". ID: {$gaji->id_gaji}, Karyawan: {$gaji->karyawan->nama}, ";
        echo "Jabatan: " . ($gaji->karyawan->jabatan ? $gaji->karyawan->jabatan->nama_jabatan : 'N/A') . ", ";
        echo "Periode: {$gaji->periode_gaji}, Gaji: Rp " . number_format($gaji->jumlah_gaji) . "\n";
    }
} else {
    echo "MASALAH: Tidak ada data gaji yang ditemukan!\n";
    echo "Mari cek query yang digunakan di controller...\n\n";

    // Test query seperti di controller (dengan whereYear dan whereMonth)
    echo "Testing query controller (whereYear & whereMonth):\n";
    $gajiListController = Gaji::with(['karyawan.jabatan', 'karyawan.cabang'])
        ->whereYear('periode_gaji', $tahun)
        ->whereMonth('periode_gaji', $bulan)
        ->limit(5)
        ->get();

    echo "Hasil query controller: " . $gajiListController->count() . " data\n";

    if ($gajiListController->count() == 0) {
        echo "\nMasalah: Query controller tidak menemukan data!\n";
        echo "Ini karena periode_gaji berformat '2024-12' bukan date yang bisa diparse whereYear/whereMonth\n";
    }
}
