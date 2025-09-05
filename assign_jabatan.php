<?php

require_once 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Illuminate\Support\Facades\DB;

echo "=== Update karyawan dengan jabatan ===\n";

// Ambil semua jabatan yang ada
$jabatan = DB::select('SELECT id, nama_jabatan FROM jabatan WHERE is_active = 1');
$jabatanIds = array_column($jabatan, 'id');

echo "Jabatan yang tersedia:\n";
foreach ($jabatan as $j) {
    echo "- ID: {$j->id}, Nama: {$j->nama_jabatan}\n";
}

// Update karyawan secara acak dengan jabatan
$totalKaryawan = DB::selectOne('SELECT COUNT(*) as total FROM karyawan')->total;
echo "\nTotal karyawan: $totalKaryawan\n";

// Update karyawan dengan jabatan secara acak
$updated = 0;
foreach ($jabatanIds as $jabatanId) {
    // Assign setiap jabatan ke beberapa karyawan
    $count = rand(50, 70); // 50-70 karyawan per jabatan

    $result = DB::update("
        UPDATE karyawan 
        SET jabatan_id = ? 
        WHERE jabatan_id IS NULL 
        LIMIT ?
    ", [$jabatanId, $count]);

    $updated += $result;
    echo "Assign jabatan ID $jabatanId ke $result karyawan\n";
}

echo "\nTotal karyawan yang diupdate: $updated\n";

// Cek hasil
$withJabatan = DB::selectOne('SELECT COUNT(*) as total FROM karyawan WHERE jabatan_id IS NOT NULL')->total;
$withoutJabatan = DB::selectOne('SELECT COUNT(*) as total FROM karyawan WHERE jabatan_id IS NULL')->total;

echo "Karyawan dengan jabatan: $withJabatan\n";
echo "Karyawan tanpa jabatan: $withoutJabatan\n";
