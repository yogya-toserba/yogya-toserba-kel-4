<?php
require 'vendor/autoload.php';

$app = require 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Shift;
use App\Models\Cabang;

echo "=== Checking Required Data ===\n";

$shift = Shift::first();
echo "Available shift: " . ($shift ? $shift->id . " - " . $shift->nama_shift : "None") . "\n";

$cabang = Cabang::first();
echo "Available cabang: " . ($cabang ? $cabang->id_cabang . " - " . $cabang->nama_cabang : "None") . "\n";

// Create default shift and cabang if not exist
if (!$shift) {
    echo "Creating default shift...\n";
    $shift = Shift::create([
        'nama_shift' => 'Shift Pagi',
        'jam_masuk' => '08:00:00',
        'jam_keluar' => '17:00:00'
    ]);
    echo "Shift created: {$shift->id}\n";
}

if (!$cabang) {
    echo "Creating default cabang...\n";
    $cabang = Cabang::create([
        'nama_cabang' => 'Kantor Pusat',
        'alamat' => 'Jl. Yogya No. 1',
        'telepon' => '0274-123456'
    ]);
    echo "Cabang created: {$cabang->id_cabang}\n";
}

echo "\nUsing:\n";
echo "- Shift ID: {$shift->id}\n";
echo "- Cabang ID: {$cabang->id_cabang}\n";
