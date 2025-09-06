<?php
require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Illuminate\Support\Facades\DB;

echo "=== Struktur Table Absensi ===\n";
$columns = DB::select('DESCRIBE absensi');
foreach ($columns as $col) {
    echo $col->Field . ' - ' . $col->Type . "\n";
}

echo "\n=== Sample Data ===\n";
$sample = DB::select('SELECT * FROM absensi LIMIT 3');
foreach ($sample as $row) {
    print_r((array)$row);
}
