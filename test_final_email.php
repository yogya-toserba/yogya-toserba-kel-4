<?php
// Final email test with current Laravel configuration
require_once __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\Mail;
use App\Notifications\PelangganResetPasswordNotification;

echo "Testing OTP email with current configuration...\n";

// Create a mock user object
$user = (object) [
    'nama_pelanggan' => 'Test User',
    'email' => 'yogya.toserbaa@gmail.com'
];

$otp = '123456';
$expires_in = 5; // 5 minutes

try {
    echo "Sending test OTP email...\n";
    
    // Send notification directly
    $notification = new PelangganResetPasswordNotification($otp, $expires_in);
    
    // Convert to mail message
    $mailData = $notification->toMail($user);
    
    echo "Email template prepared successfully\n";
    echo "Subject: " . $mailData->subject . "\n";
    echo "View: " . $mailData->view[0] . "\n";
    
    // Send actual email
    Mail::send($mailData->view[0], $mailData->viewData, function($message) use ($user, $mailData) {
        $message->to($user->email)
               ->subject($mailData->subject);
    });
    
    echo "SUCCESS: OTP email sent successfully!\n";
    
} catch (Exception $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
    echo "Stack trace:\n" . $e->getTraceAsString() . "\n";
}

echo "\nTest completed.\n";
