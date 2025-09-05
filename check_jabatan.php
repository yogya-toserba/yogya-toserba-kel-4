<?php

require_once 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Illuminate\Support\Facades\DB;

echo "=== Struktur tabel jabatan ===\n";
$columns = DB::select('DESCRIBE jabatan');
foreach ($columns as $column) {
    echo $column->Field . ' - ' . $column->Type . "\n";
}

echo "\n=== Data jabatan ===\n";
$jabatan = DB::select('SELECT * FROM jabatan LIMIT 5');
foreach ($jabatan as $j) {
    print_r($j);
}
