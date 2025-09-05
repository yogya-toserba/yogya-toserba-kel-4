<?php

require_once 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Illuminate\Support\Facades\DB;

echo "=== Cek struktur tabel karyawan ===\n";
$columns = DB::select('DESCRIBE karyawan');
foreach ($columns as $column) {
    echo $column->Field . ' - ' . $column->Type . ' - ' . $column->Null . ' - ' . $column->Default . "\n";
}

echo "\n=== Cek data karyawan sample ===\n";
$karyawan = DB::select('SELECT id_karyawan, nama, jabatan_id, status FROM karyawan LIMIT 5');
foreach ($karyawan as $k) {
    echo "ID: {$k->id_karyawan}, Nama: {$k->nama}, ID Jabatan: {$k->jabatan_id}, Status: {$k->status}\n";
}

echo "\n=== Cek tabel jabatan ===\n";
$jabatan = DB::select('SELECT * FROM jabatan LIMIT 5');
foreach ($jabatan as $j) {
    echo "ID: {$j->id_jabatan}, Nama: {$j->nama_jabatan}, Gaji: {$j->jumlah_gaji}\n";
}
