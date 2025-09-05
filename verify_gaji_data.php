<?php

require_once 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Illuminate\Support\Facades\DB;

echo "=== Verifikasi Data Gaji di Database ===\n";

// Hitung total data gaji
$totalGaji = DB::selectOne('SELECT COUNT(*) as total FROM gaji')->total;
echo "Total data gaji: $totalGaji\n\n";

// Hitung berdasarkan periode
$periodeGaji = DB::select('SELECT periode_gaji, COUNT(*) as total FROM gaji GROUP BY periode_gaji');
echo "Data gaji berdasarkan periode:\n";
foreach ($periodeGaji as $periode) {
    echo "- Periode {$periode->periode_gaji}: {$periode->total} karyawan\n";
}

echo "\n=== Sample data gaji ===\n";
$sampleGaji = DB::select('
    SELECT g.id_gaji, g.id_karyawan, k.nama, g.periode_gaji, 
           g.gaji_pokok, g.tunjangan, g.bonus, g.jumlah_gaji, g.status_pembayaran
    FROM gaji g 
    JOIN karyawan k ON g.id_karyawan = k.id_karyawan 
    LIMIT 10
');

foreach ($sampleGaji as $gaji) {
    echo "ID: {$gaji->id_gaji}, Karyawan: {$gaji->nama}, Periode: {$gaji->periode_gaji}, Total: Rp " . number_format($gaji->jumlah_gaji) . "\n";
}

echo "\n=== Ringkasan berdasarkan jumlah gaji ===\n";
$ringkasan = DB::select('
    SELECT jumlah_gaji, COUNT(*) as total 
    FROM gaji 
    GROUP BY jumlah_gaji 
    ORDER BY jumlah_gaji DESC
');

foreach ($ringkasan as $item) {
    echo "Gaji Rp " . number_format($item->jumlah_gaji) . ": {$item->total} karyawan\n";
}
