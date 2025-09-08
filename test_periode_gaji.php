<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Gaji;

try {
  $count = Gaji::where('periode_gaji', '2025-09')->count();
  echo "Query successful! Count: " . $count . PHP_EOL;
  echo "Test passed - periode_gaji column is working correctly!" . PHP_EOL;
} catch (Exception $e) {
  echo "Error: " . $e->getMessage() . PHP_EOL;
}
