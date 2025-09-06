<?php
require 'vendor/autoload.php';

$app = require 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

echo "=== Checking Karyawan Table Structure ===\n";

try {
    $columns = Schema::getColumnListing('karyawan');
    echo "Karyawan table columns:\n";
    foreach ($columns as $column) {
        echo "- $column\n";
    }

    echo "\n=== Trying to get sample record ===\n";
    $sample = DB::table('karyawan')->first();
    if ($sample) {
        print_r($sample);
    } else {
        echo "No records found\n";
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
