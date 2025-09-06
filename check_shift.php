<?php
require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Illuminate\Support\Facades\DB;

echo "=== Struktur Table Shift ===\n";
$columns = DB::select('DESCRIBE shift');
foreach ($columns as $col) {
    echo $col->Field . ' - ' . $col->Type . "\n";
}

echo "\n=== Sample Data Shift ===\n";
$sample = DB::select('SELECT * FROM shift LIMIT 3');
foreach ($sample as $row) {
    print_r((array)$row);
}

echo "\n=== Correct Join Absensi, Jadwal Kerja & Karyawan ===\n";
$join = DB::select('
    SELECT a.id_absensi, a.status, a.tanggal, 
           j.id_karyawan, s.nama_shift,
           k.nama as nama_karyawan
    FROM absensi a 
    LEFT JOIN jadwal_kerja j ON a.id_jadwal = j.id_jadwal 
    LEFT JOIN shift s ON j.id_shift = s.id_shift
    LEFT JOIN karyawan k ON j.id_karyawan = k.id_karyawan
    LIMIT 3
');
foreach ($join as $row) {
    print_r((array)$row);
}
