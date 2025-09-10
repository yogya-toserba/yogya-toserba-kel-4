<?php
// Simple Gmail connection test
$smtp_host = 'smtp.gmail.com';
$smtp_port = 465;
$username = 'yogya.toserbaa@gmail.com';

echo "Testing direct connection to Gmail SMTP...\n";
echo "Host: $smtp_host\n";
echo "Port: $smtp_port\n";
echo "SSL Context: " . (stream_context_create() ? 'Available' : 'Not Available') . "\n";

// Test socket connection
$context = stream_context_create([
    'ssl' => [
        'verify_peer' => false,
        'verify_peer_name' => false,
    ]
]);

$socket = @stream_socket_client(
    "ssl://$smtp_host:$smtp_port", 
    $errno, 
    $errstr, 
    10, 
    STREAM_CLIENT_CONNECT, 
    $context
);

if ($socket) {
    echo "SUCCESS: Connected to Gmail SMTP with SSL\n";
    $response = fgets($socket);
    echo "Server Response: " . trim($response) . "\n";
    fclose($socket);
} else {
    echo "ERROR: Cannot connect to Gmail SMTP\n";
    echo "Error Code: $errno\n";
    echo "Error Message: $errstr\n";
}

echo "\nConnection test completed.\n";
