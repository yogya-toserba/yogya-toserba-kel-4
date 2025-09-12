<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Karyawan;
use App\Models\Jabatan;

echo "🔧 Memperbaiki data jabatan karyawan...\n\n";

// Cek karyawan yang tidak memiliki jabatan
$karyawanTanpaJabatan = Karyawan::whereNull('jabatan_id')->get();

echo "📊 Karyawan tanpa jabatan: " . $karyawanTanpaJabatan->count() . "\n";

if ($karyawanTanpaJabatan->count() > 0) {
    // Pastikan ada jabatan default
    $jabatanDefault = Jabatan::first();

    if (!$jabatanDefault) {
        echo "⚠️ Tidak ada jabatan di database, membuat jabatan default...\n";

        $jabatanDefault = Jabatan::create([
            'nama_jabatan' => 'Staff',
            'gaji_pokok' => 3000000,
            'tunjangan' => 500000
        ]);

        echo "✅ Jabatan default 'Staff' berhasil dibuat\n";
    }

    echo "🔄 Mengupdate karyawan tanpa jabatan...\n";

    foreach ($karyawanTanpaJabatan as $karyawan) {
        $karyawan->update(['jabatan_id' => $jabatanDefault->id]);
        echo "  - {$karyawan->nama} -> {$jabatanDefault->nama_jabatan}\n";
    }

    echo "\n✅ Semua karyawan berhasil memiliki jabatan!\n";
} else {
    echo "✅ Semua karyawan sudah memiliki jabatan\n";
}

// Tampilkan ringkasan
echo "\n📋 Ringkasan data karyawan:\n";
$karyawanWithJabatan = Karyawan::with('jabatan')->get();

foreach ($karyawanWithJabatan as $karyawan) {
    $jabatan = $karyawan->jabatan ? $karyawan->jabatan->nama_jabatan : 'TIDAK ADA';
    echo "  - {$karyawan->nama}: {$jabatan}\n";
}

echo "\n🎉 Selesai! Silakan refresh halaman penggajian.\n";
