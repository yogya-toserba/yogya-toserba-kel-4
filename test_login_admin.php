<?php
require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

echo "=== Test Login Admin ===\n";

// Check if admin exists
$admin = Admin::first();
if (!$admin) {
    echo "Creating default admin...\n";
    Admin::create([
        'name' => 'Admin',
        'email' => 'admin@admin.com',
        'password' => Hash::make('admin123')
    ]);
    echo "Admin created: admin@admin.com / admin123\n";
} else {
    echo "Admin exists: " . $admin->email . "\n";
}

echo "You can login with: admin@admin.com / admin123\n";
