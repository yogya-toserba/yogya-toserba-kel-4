<?php
require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Illuminate\Support\Facades\DB;

echo "=== Struktur Table Jadwal Kerja ===\n";
$columns = DB::select('DESCRIBE jadwal_kerja');
foreach ($columns as $col) {
    echo $col->Field . ' - ' . $col->Type . "\n";
}

echo "\n=== Sample Data ===\n";
$sample = DB::select('SELECT * FROM jadwal_kerja LIMIT 3');
foreach ($sample as $row) {
    print_r((array)$row);
}

echo "\n=== Join Absensi & Jadwal Kerja ===\n";
$join = DB::select('
    SELECT a.id_absensi, a.status, a.tanggal, 
           j.id_karyawan, j.shift 
    FROM absensi a 
    LEFT JOIN jadwal_kerja j ON a.id_jadwal = j.id_jadwal 
    LIMIT 3
');
foreach ($join as $row) {
    print_r((array)$row);
}
