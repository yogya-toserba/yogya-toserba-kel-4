<?php
require_once 'vendor/autoload.php';

// Simulasi Laravel App
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "=== Cek Data Absensi Terbaru ===\n\n";

use Illuminate\Support\Facades\DB;

$absensi = DB::select("SELECT a.*, k.nama 
    FROM absensi a 
    LEFT JOIN karyawan k ON a.id_karyawan = k.id_karyawan 
    ORDER BY a.created_at DESC 
    LIMIT 5");

foreach ($absensi as $a) {
    echo "ID: " . $a->id_absensi . "\n";
    echo "Karyawan: " . $a->nama . " (ID: " . $a->id_karyawan . ")\n";
    echo "Tanggal: " . $a->tanggal . "\n";
    echo "Status: " . $a->status . "\n";
    echo "Jam Masuk: " . $a->jam_masuk . "\n";
    echo "Jam Keluar: " . ($a->jam_keluar ?: 'Belum checkout') . "\n";
    echo "Keterangan: " . ($a->keterangan ?: '-') . "\n";
    echo "---\n";
}
