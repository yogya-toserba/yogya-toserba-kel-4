<?php
require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Absensi;

echo "=== Membuat Data Absensi Dummy ===\n";

// Data dummy untuk berbagai status
$dummyData = [
    [
        'id_jadwal' => 1,
        'status' => 'Izin',
        'keterangan' => 'Izin keperluan keluarga',
        'tanggal' => '2025-09-04',
        'terlambat_menit' => 0,
        'pulang_awal_menit' => 0,
        'durasi_kerja_jam' => 0.00
    ],
    [
        'id_jadwal' => 2,
        'status' => 'Sakit',
        'keterangan' => 'Sakit demam',
        'tanggal' => '2025-09-05',
        'terlambat_menit' => 0,
        'pulang_awal_menit' => 0,
        'durasi_kerja_jam' => 0.00
    ],
    [
        'id_jadwal' => 3,
        'status' => 'Alpa',
        'keterangan' => 'Tidak masuk tanpa keterangan',
        'tanggal' => '2025-09-06',
        'terlambat_menit' => 0,
        'pulang_awal_menit' => 0,
        'durasi_kerja_jam' => 0.00
    ]
];

foreach ($dummyData as $data) {
    $absensi = Absensi::create($data);
    echo "Created: {$absensi->status} for {$absensi->tanggal}\n";
}

echo "\n=== Status Count After Insert ===\n";
echo "Total Hadir: " . Absensi::hadir()->count() . "\n";
echo "Total Alfa: " . Absensi::alfa()->count() . "\n";
echo "Total Izin: " . Absensi::izin()->count() . "\n";
echo "Total Sakit: " . Absensi::sakit()->count() . "\n";
