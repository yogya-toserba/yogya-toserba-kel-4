<?php
echo "=== TESTING DROPDOWN FUNCTIONALITY ===\n";
echo "Date: " . date('Y-m-d H:i:s') . "\n\n";

// Test if we can access the routes
$base_url = "http://127.0.0.1:8000";

echo "Testing penggajian page...\n";

// Check if we have gaji data to test with
try {
    require_once __DIR__ . '/vendor/autoload.php';
    require_once __DIR__ . '/bootstrap/app.php';
    
    $app = require_once __DIR__ . '/bootstrap/app.php';
    $app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();
    
    // Get some test data
    $gaji = App\Models\Gaji::with(['karyawan'])->first();
    
    if ($gaji) {
        echo "✅ Found test gaji data: ID {$gaji->id_gaji} for {$gaji->karyawan->nama}\n";
        echo "   Testing API endpoint: {$base_url}/admin/penggajian/{$gaji->id_gaji}/api\n";
        
        // Test API endpoint
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "{$base_url}/admin/penggajian/{$gaji->id_gaji}/api");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        
        if ($httpCode === 200) {
            echo "✅ API endpoint accessible (HTTP $httpCode)\n";
            $data = json_decode($response, true);
            if ($data && isset($data['success']) && $data['success']) {
                echo "✅ API returns valid JSON response\n";
            } else {
                echo "❌ API returns invalid response\n";
                echo "Response: " . substr($response, 0, 200) . "...\n";
            }
        } else {
            echo "❌ API endpoint not accessible (HTTP $httpCode)\n";
        }
        
    } else {
        echo "❌ No gaji data found for testing\n";
    }
    
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
}

echo "\n=== POTENTIAL ISSUES TO CHECK ===\n";
echo "1. Bootstrap dropdowns not initializing properly\n";
echo "2. JavaScript functions not being called\n";
echo "3. CSRF token issues\n";
echo "4. Event listeners not attached\n";
echo "5. Modal not showing due to CSS/JS conflicts\n";

echo "\n=== NEXT STEPS ===\n";
echo "1. Check browser console for JavaScript errors\n";
echo "2. Verify Bootstrap is loaded correctly\n";
echo "3. Test clicking the dropdown button\n";
echo "4. Check if onclick events are firing\n";
?>
