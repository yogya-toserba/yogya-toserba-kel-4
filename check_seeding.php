<?php
require 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Admin;
use App\Models\Karyawan;
use App\Models\Shift;

echo "Checking database data...\n";
echo "Admin count: " . Admin::count() . "\n";
echo "Karyawan count: " . Karyawan::count() . "\n";  
echo "Shift count: " . Shift::count() . "\n";
