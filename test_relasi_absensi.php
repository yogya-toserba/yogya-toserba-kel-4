<?php
require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Absensi;

echo "=== Test Relasi Absensi ===\n";

// Test ambil data dengan relasi
$absensi = Absensi::with(['jadwalKerja.karyawan.jabatan', 'jadwalKerja.shift'])->first();

if ($absensi) {
    echo "ID Absensi: " . $absensi->id_absensi . "\n";
    echo "Status: " . $absensi->status . "\n";
    echo "Tanggal: " . $absensi->tanggal . "\n";

    if ($absensi->jadwalKerja) {
        echo "ID Jadwal: " . $absensi->jadwalKerja->id_jadwal . "\n";

        if ($absensi->jadwalKerja->karyawan) {
            echo "Nama Karyawan: " . $absensi->jadwalKerja->karyawan->nama . "\n";

            if ($absensi->jadwalKerja->karyawan->jabatan) {
                echo "Jabatan: " . $absensi->jadwalKerja->karyawan->jabatan->nama_jabatan . "\n";
            } else {
                echo "Jabatan: NULL\n";
            }
        } else {
            echo "Karyawan: NULL\n";
        }

        if ($absensi->jadwalKerja->shift) {
            echo "Shift: " . $absensi->jadwalKerja->shift->nama_shift . "\n";
        } else {
            echo "Shift: NULL\n";
        }
    } else {
        echo "Jadwal Kerja: NULL\n";
    }
} else {
    echo "Tidak ada data absensi\n";
}

echo "\n=== Test Multiple Records ===\n";
$absensiList = Absensi::with(['jadwalKerja.karyawan.jabatan', 'jadwalKerja.shift'])->take(3)->get();

foreach ($absensiList as $item) {
    echo "ID: {$item->id_absensi} - ";
    echo "Karyawan: " . ($item->jadwalKerja->karyawan->nama ?? 'NULL') . " - ";
    echo "Jabatan: " . ($item->jadwalKerja->karyawan->jabatan->nama_jabatan ?? 'NULL') . " - ";
    echo "Shift: " . ($item->jadwalKerja->shift->nama_shift ?? 'NULL') . "\n";
}
