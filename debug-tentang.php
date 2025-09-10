<?php
// Debug script untuk cek halaman tentang
require_once 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

try {
    // Get the route for tentang
    $response = file_get_contents('http://127.0.0.1:8000/tentang');
    
    // Check if button exists in HTML
    if (strpos($response, 'backToTopBtn') !== false) {
        echo "✅ Button HTML found in page\n";
        
        // Extract button HTML
        preg_match('/<button[^>]*id="backToTopBtn"[^>]*>.*?<\/button>/s', $response, $matches);
        if (!empty($matches)) {
            echo "Button HTML:\n" . $matches[0] . "\n\n";
        }
        
        // Check CSS
        if (strpos($response, 'back-to-top-btn') !== false) {
            echo "✅ CSS class found\n";
        } else {
            echo "❌ CSS class NOT found\n";
        }
        
        // Check JavaScript
        if (strpos($response, 'scrollToTop') !== false) {
            echo "✅ JavaScript function found\n";
        } else {
            echo "❌ JavaScript function NOT found\n";
        }
        
    } else {
        echo "❌ Button NOT found in HTML\n";
        echo "First 500 chars of response:\n";
        echo substr($response, 0, 500) . "\n";
    }
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
