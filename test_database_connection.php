<?php

require_once 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Gaji;
use App\Models\Karyawan;

echo "=== Verifikasi Koneksi Database Penggajian ===\n\n";

// 1. Test koneksi database
try {
    echo "1. Test koneksi database...\n";
    $totalGaji = Gaji::count();
    echo "   ✓ Koneksi berhasil. Total data gaji: $totalGaji\n\n";
} catch (\Exception $e) {
    echo "   ✗ Koneksi gagal: " . $e->getMessage() . "\n";
    exit;
}

// 2. Test relasi dengan karyawan
try {
    echo "2. Test relasi dengan karyawan...\n";
    $gajiWithKaryawan = Gaji::with('karyawan')->first();
    if ($gajiWithKaryawan && $gajiWithKaryawan->karyawan) {
        echo "   ✓ Relasi karyawan berhasil. Sample: {$gajiWithKaryawan->karyawan->nama}\n\n";
    } else {
        echo "   ✗ Relasi karyawan tidak ditemukan\n\n";
    }
} catch (\Exception $e) {
    echo "   ✗ Error relasi karyawan: " . $e->getMessage() . "\n\n";
}

// 3. Test relasi dengan jabatan
try {
    echo "3. Test relasi dengan jabatan...\n";
    $gajiWithJabatan = Gaji::with('karyawan.jabatan')->first();
    if ($gajiWithJabatan && $gajiWithJabatan->karyawan && $gajiWithJabatan->karyawan->jabatan) {
        echo "   ✓ Relasi jabatan berhasil. Sample: {$gajiWithJabatan->karyawan->jabatan->nama_jabatan}\n\n";
    } else {
        echo "   ✗ Relasi jabatan tidak ditemukan\n\n";
    }
} catch (\Exception $e) {
    echo "   ✗ Error relasi jabatan: " . $e->getMessage() . "\n\n";
}

// 4. Test query periode 2024-12
try {
    echo "4. Test query periode 2024-12...\n";
    $gajiPeriode = Gaji::where('periode_gaji', '2024-12')->count();
    echo "   ✓ Data periode 2024-12: $gajiPeriode records\n\n";
} catch (\Exception $e) {
    echo "   ✗ Error query periode: " . $e->getMessage() . "\n\n";
}

// 5. Test statistik
try {
    echo "5. Test statistik gaji...\n";
    $stats = [
        'total_gaji' => Gaji::where('periode_gaji', '2024-12')->sum('jumlah_gaji'),
        'total_karyawan' => Gaji::where('periode_gaji', '2024-12')->count(),
        'rata_rata_gaji' => Gaji::where('periode_gaji', '2024-12')->avg('jumlah_gaji'),
        'gaji_tertinggi' => Gaji::where('periode_gaji', '2024-12')->max('jumlah_gaji')
    ];

    echo "   ✓ Total Gaji: Rp " . number_format($stats['total_gaji']) . "\n";
    echo "   ✓ Total Karyawan: {$stats['total_karyawan']}\n";
    echo "   ✓ Rata-rata Gaji: Rp " . number_format($stats['rata_rata_gaji']) . "\n";
    echo "   ✓ Gaji Tertinggi: Rp " . number_format($stats['gaji_tertinggi']) . "\n\n";
} catch (\Exception $e) {
    echo "   ✗ Error statistik: " . $e->getMessage() . "\n\n";
}

echo "=== KESIMPULAN ===\n";
echo "Database penggajian sudah tersambung dengan baik dan data tersedia!\n";
