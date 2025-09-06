<?php
require 'vendor/autoload.php';

$app = require 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

echo "=== Shift Table Structure ===\n";
$columns = Schema::getColumnListing('shift');
echo "Columns: " . implode(', ', $columns) . "\n";

echo "\n=== Sample Shift Data ===\n";
$shift = DB::table('shift')->first();
if ($shift) {
    print_r($shift);
} else {
    echo "No shift data found\n";
}
