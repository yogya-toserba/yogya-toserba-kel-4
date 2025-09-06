<?php
require_once 'vendor/autoload.php';

// Simulasi Laravel App
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "=== Membuat Data Dummy Gaji September 2025 ===\n\n";

use App\Models\Gaji;
use App\Models\Karyawan;
use Carbon\Carbon;

try {
    // Ambil semua karyawan aktif
    $karyawanList = Karyawan::where('status', 'Aktif')->get();

    echo "Ditemukan " . $karyawanList->count() . " karyawan aktif\n\n";

    $periode = '2025-09';
    $counter = 0;

    foreach ($karyawanList as $karyawan) {
        // Cek apakah sudah ada gaji untuk periode ini
        $existing = Gaji::where('id_karyawan', $karyawan->id_karyawan)
            ->where('periode_gaji', $periode)
            ->first();

        if (!$existing) {
            // Buat data gaji dummy
            $gajiPokok = rand(3000000, 8000000); // 3-8 juta
            $tunjangan = rand(500000, 1500000); // 500rb - 1.5 juta
            $bonus = rand(0, 1000000); // 0 - 1 juta
            $potongan = rand(0, 300000); // 0 - 300rb
            $jumlahGaji = $gajiPokok + $tunjangan + $bonus - $potongan;

            Gaji::create([
                'id_karyawan' => $karyawan->id_karyawan,
                'periode_gaji' => $periode,
                'gaji_pokok' => $gajiPokok,
                'tunjangan' => $tunjangan,
                'bonus' => $bonus,
                'potongan' => $potongan,
                'jumlah_gaji' => $jumlahGaji,
                'status_pembayaran' => 'pending',
                'keterangan' => 'Data dummy untuk testing',
                'is_auto_generated' => 1
            ]);

            $counter++;
            echo "✅ Membuat gaji untuk: " . $karyawan->nama . " (Rp " . number_format($jumlahGaji) . ")\n";
        } else {
            echo "⚠️ Gaji sudah ada untuk: " . $karyawan->nama . "\n";
        }
    }

    echo "\n🎉 Berhasil membuat $counter data gaji dummy untuk periode $periode\n";

    // Cek total data
    $totalGaji = Gaji::where('periode_gaji', $periode)->count();
    echo "Total data gaji di periode $periode: $totalGaji\n";
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
    echo "File: " . $e->getFile() . ":" . $e->getLine() . "\n";
}
