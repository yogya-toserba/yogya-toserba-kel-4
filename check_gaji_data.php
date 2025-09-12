<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Gaji;
use App\Models\Karyawan;
use App\Models\Jabatan;
use Carbon\Carbon;

echo "🔧 Memeriksa data gaji dan relasi...\n\n";

$periode = Carbon::now()->format('Y-m'); // September 2025

echo "📅 Periode: {$periode}\n\n";

// Cek data gaji
$gajiList = Gaji::with(['karyawan.jabatan'])->where('periode_gaji', $periode)->get();

echo "📊 Total data gaji: " . $gajiList->count() . "\n\n";

if ($gajiList->count() == 0) {
    echo "⚠️ Tidak ada data gaji untuk periode {$periode}\n";
    echo "🔄 Membuat data gaji untuk karyawan...\n\n";

    $karyawanList = Karyawan::with('jabatan')->get();

    foreach ($karyawanList as $karyawan) {
        if ($karyawan->jabatan) {
            $gaji = Gaji::create([
                'karyawan_id' => $karyawan->id,
                'periode_gaji' => $periode,
                'gaji_pokok' => $karyawan->jabatan->gaji_pokok,
                'tunjangan_jabatan' => $karyawan->jabatan->tunjangan,
                'tunjangan_kehadiran' => 80000,
                'bonus' => 0,
                'potongan' => 0,
                'jumlah_gaji' => $karyawan->jabatan->gaji_pokok + $karyawan->jabatan->tunjangan + 80000,
                'status_pembayaran' => 'sudah_dibayar'
            ]);

            echo "✅ Gaji {$karyawan->nama} ({$karyawan->jabatan->nama_jabatan}) berhasil dibuat\n";
        }
    }
} else {
    echo "📋 Detail data gaji:\n";
    foreach ($gajiList as $gaji) {
        $nama = $gaji->karyawan ? $gaji->karyawan->nama : 'TIDAK ADA';
        $jabatan = $gaji->karyawan && $gaji->karyawan->jabatan ? $gaji->karyawan->jabatan->nama_jabatan : 'N/A';
        echo "  - {$nama}: {$jabatan} (Gaji: Rp " . number_format($gaji->jumlah_gaji) . ")\n";
    }
}

echo "\n🎉 Selesai! Silakan refresh halaman penggajian.\n";
