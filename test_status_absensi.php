<?php
require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Absensi;
use Illuminate\Support\Facades\DB;

echo "=== Status Absensi yang Ada ===\n";
$statuses = DB::select('SELECT DISTINCT status FROM absensi');
foreach ($statuses as $status) {
    echo "- " . $status->status . "\n";
}

echo "\n=== Count per Status ===\n";
$counts = DB::select('SELECT status, COUNT(*) as total FROM absensi GROUP BY status');
foreach ($counts as $count) {
    echo $count->status . ": " . $count->total . "\n";
}

echo "\n=== Test Scope Methods ===\n";
echo "Total Hadir: " . Absensi::hadir()->count() . "\n";
echo "Total Alfa: " . Absensi::alfa()->count() . "\n";
echo "Total Izin: " . Absensi::izin()->count() . "\n";
echo "Total Sakit: " . Absensi::sakit()->count() . "\n";
echo "Total Terlambat: " . Absensi::terlambat()->count() . "\n";
