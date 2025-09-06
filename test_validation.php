<?php
require 'vendor/autoload.php';

$app = require 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Karyawan;
use Illuminate\Support\Facades\Validator;

echo "=== Testing Validation ===\n";

// Check if karyawan exists
$karyawan = Karyawan::where('id_karyawan', '302')->first();
echo "Karyawan exists: " . ($karyawan ? "Yes - {$karyawan->nama}" : "No") . "\n";

// Test validation
$data = [
    'id_karyawan' => '302',
    'keterangan' => 'Test'
];

$validator = Validator::make($data, [
    'id_karyawan' => 'required|exists:karyawan,id_karyawan',
    'keterangan' => 'nullable|string|max:255'
]);

echo "Validation result: " . ($validator->passes() ? "PASS" : "FAIL") . "\n";

if ($validator->fails()) {
    echo "Errors:\n";
    foreach ($validator->errors()->all() as $error) {
        echo "- $error\n";
    }
}

echo "\n=== Testing Direct Query ===\n";
$exists = \Illuminate\Support\Facades\DB::table('karyawan')
    ->where('id_karyawan', '302')
    ->exists();
echo "Direct DB check: " . ($exists ? "EXISTS" : "NOT FOUND") . "\n";
