<?php
// Simplified test - just check if we can send a basic email
require_once __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\Mail;

echo "Testing basic email sending...\n";

try {
    Mail::raw('Test OTP: 123456. This code expires in 5 minutes.', function($message) {
        $message->to('yogya.toserbaa@gmail.com')
               ->subject('Test OTP - MyYOGYA')
               ->from('yogya.toserbaa@gmail.com', 'MyYOGYA');
    });
    
    echo "SUCCESS: Basic email sent successfully!\n";
    
} catch (Exception $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
}

echo "\nBasic test completed.\n";
