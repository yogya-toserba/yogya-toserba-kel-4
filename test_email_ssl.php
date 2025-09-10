<?php
require_once __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

echo "Testing Gmail SMTP connection with SSL...\n";

try {
    Mail::raw('Test email from Laravel - SSL Port 465', function($message) {
        $message->to('yogya.toserbaa@gmail.com')
               ->subject('Test Connection SSL');
    });
    echo "SUCCESS: Email sent successfully via SSL!\n";
} catch (Exception $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
    Log::error('Email SSL Test Error: ' . $e->getMessage());
}

echo "Test completed.\n";
