<?php
require_once 'vendor/autoload.php';

// Simulasi Laravel App
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "=== Cek Struktur Tabel Absensi ===\n\n";

use Illuminate\Support\Facades\DB;

// Cek struktur tabel absensi
echo "Struktur tabel absensi:\n";
$columns = DB::select("DESCRIBE absensi");
foreach ($columns as $column) {
    echo $column->Field . " | " . $column->Type . " | " . ($column->Null == 'YES' ? 'NULL' : 'NOT NULL') . " | " . $column->Default . "\n";
}
