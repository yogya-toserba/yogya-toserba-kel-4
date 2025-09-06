<?php
require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Illuminate\Support\Facades\DB;

echo "=== Struktur Table Karyawan ===\n";
$columns = DB::select('DESCRIBE karyawan');
foreach ($columns as $col) {
    echo $col->Field . ' - ' . $col->Type . "\n";
}

echo "\n=== Sample Data Karyawan ===\n";
$sample = DB::select('SELECT id_karyawan, nama, jabatan_id FROM karyawan LIMIT 3');
foreach ($sample as $row) {
    print_r((array)$row);
}

echo "\n=== Join Karyawan & Jabatan ===\n";
$join = DB::select('
    SELECT k.id_karyawan, k.nama, k.jabatan_id, j.nama_jabatan
    FROM karyawan k 
    LEFT JOIN jabatan j ON k.jabatan_id = j.id 
    LIMIT 3
');
foreach ($join as $row) {
    print_r((array)$row);
}
