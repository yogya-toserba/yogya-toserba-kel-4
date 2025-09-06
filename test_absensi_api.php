<?php

require_once 'vendor/autoload.php';

use Illuminate\Http\Request;

// Bootstrap Laravel
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

// Create a test request for API endpoints
echo "=== Testing Admin Absensi API Endpoints ===\n\n";

try {
    // Test with first absensi record
    $firstAbsensi = \App\Models\Absensi::first();
    
    if (!$firstAbsensi) {
        echo "❌ No absensi records found in database\n";
        exit;
    }
    
    echo "Testing with Absensi ID: {$firstAbsensi->id}\n";
    echo "Karyawan: " . ($firstAbsensi->karyawan->nama ?? 'N/A') . "\n";
    echo "Tanggal: {$firstAbsensi->tanggal}\n\n";
    
    // Test detail API
    echo "1. Testing Detail API (/admin/absensi/api/{id}/detail):\n";
    $request = Request::create("/admin/absensi/api/{$firstAbsensi->id}/detail", 'GET');
    $request->headers->set('Accept', 'application/json');
    $request->headers->set('X-Requested-With', 'XMLHttpRequest');
    
    try {
        $controller = new \App\Http\Controllers\AbsensiController();
        $response = $controller->showApi($firstAbsensi->id);
        $data = json_decode($response->getContent(), true);
        
        if ($data['success'] ?? false) {
            echo "✅ Detail API works!\n";
            echo "   - Response contains HTML: " . (isset($data['html']) ? 'Yes' : 'No') . "\n";
            echo "   - HTML length: " . strlen($data['html'] ?? '') . " characters\n";
        } else {
            echo "❌ Detail API failed: " . ($data['message'] ?? 'Unknown error') . "\n";
        }
    } catch (Exception $e) {
        echo "❌ Detail API exception: " . $e->getMessage() . "\n";
    }
    
    echo "\n";
    
    // Test edit API
    echo "2. Testing Edit API (/admin/absensi/api/{id}/edit):\n";
    try {
        $controller = new \App\Http\Controllers\AbsensiController();
        $response = $controller->editApi($firstAbsensi->id);
        $data = json_decode($response->getContent(), true);
        
        if ($data['success'] ?? false) {
            echo "✅ Edit API works!\n";
            echo "   - Response contains HTML: " . (isset($data['html']) ? 'Yes' : 'No') . "\n";
            echo "   - HTML length: " . strlen($data['html'] ?? '') . " characters\n";
        } else {
            echo "❌ Edit API failed: " . ($data['message'] ?? 'Unknown error') . "\n";
        }
    } catch (Exception $e) {
        echo "❌ Edit API exception: " . $e->getMessage() . "\n";
    }
    
    echo "\n";
    
    // Test update API with sample data
    echo "3. Testing Update API (PUT /admin/absensi/{id}):\n";
    try {
        $controller = new \App\Http\Controllers\AbsensiController();
        $updateRequest = Request::create("/admin/absensi/{$firstAbsensi->id}", 'PUT', [
            'jam_masuk' => $firstAbsensi->jam_masuk,
            'jam_keluar' => $firstAbsensi->jam_keluar,
            'status' => $firstAbsensi->status,
            'keterangan' => $firstAbsensi->keterangan . ' (test update)'
        ]);
        $updateRequest->headers->set('Accept', 'application/json');
        $updateRequest->headers->set('X-Requested-With', 'XMLHttpRequest');
        
        $response = $controller->update($updateRequest, $firstAbsensi->id);
        $data = json_decode($response->getContent(), true);
        
        if ($data['success'] ?? false) {
            echo "✅ Update API works!\n";
            echo "   - Message: " . ($data['message'] ?? 'No message') . "\n";
        } else {
            echo "❌ Update API failed: " . ($data['message'] ?? 'Unknown error') . "\n";
        }
    } catch (Exception $e) {
        echo "❌ Update API exception: " . $e->getMessage() . "\n";
    }
    
    echo "\n=== API Testing Complete ===\n";
    
} catch (Exception $e) {
    echo "❌ General error: " . $e->getMessage() . "\n";
}
