<?php
require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "Database Test:\n";
echo "Total Karyawan: " . App\Models\Karyawan::count() . "\n";
echo "Total Absensi: " . App\Models\Absensi::count() . "\n";

// Insert sample absensi data if empty
if (App\Models\Absensi::count() == 0 && App\Models\Karyawan::count() > 0) {
    $karyawan = App\Models\Karyawan::first();
    if ($karyawan) {
        App\Models\Absensi::create([
            'id_karyawan' => $karyawan->id_karyawan,
            'tanggal' => date('Y-m-d'),
            'jam_masuk' => '08:00:00',
            'jam_keluar' => '17:00:00',
            'status' => 'hadir',
            'durasi_kerja' => 9,
            'keterlambatan' => 0,
            'keterangan' => 'Sample data'
        ]);
        echo "Sample absensi data created\n";
    }
}

echo "Final Total Absensi: " . App\Models\Absensi::count() . "\n";
