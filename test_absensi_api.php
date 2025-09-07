<?php

require_once 'vendor/autoload.php';

// Bootstrap Laravel
$app = require_once 'bootstrap/app.php';

// Bootstrap the application properly
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

// Set the application instance for facades
Illuminate\Support\Facades\Facade::setFacadeApplication($app);

use Illuminate\Http\Request;

// Create a test request for API endpoints
echo "=== Testing Admin Absensi API Endpoints ===\n\n";

try {
    // Test with first absensi record
    $firstAbsensi = \App\Models\Absensi::first();

    if (!$firstAbsensi) {
        echo "❌ No absensi records found in database\n";
        exit;
    }

    echo "Testing with Absensi ID: {$firstAbsensi->id_absensi}\n";
    echo "Karyawan: " . ($firstAbsensi->karyawan->nama ?? 'N/A') . "\n";
    echo "Tanggal: {$firstAbsensi->tanggal}\n\n";

    // Test detail API
    echo "1. Testing Detail API (/admin/absensi/api/{id}/detail):\n";
    $request = Request::create("/admin/absensi/api/{$firstAbsensi->id_absensi}/detail", 'GET');
    $request->headers->set('Accept', 'application/json');
    $request->headers->set('X-Requested-With', 'XMLHttpRequest');

    try {
        $controller = $app->make(\App\Http\Controllers\AbsensiController::class);
        $response = $controller->showApi($firstAbsensi->id_absensi);
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
        $controller = $app->make(\App\Http\Controllers\AbsensiController::class);
        $response = $controller->editApi($firstAbsensi->id_absensi);
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
        $controller = $app->make(\App\Http\Controllers\AbsensiController::class);
        $updateRequest = Request::create("/admin/absensi/{$firstAbsensi->id_absensi}", 'PUT', [
            'jam_masuk' => $firstAbsensi->jam_masuk ? date('H:i', strtotime($firstAbsensi->jam_masuk)) : '08:00',
            'jam_keluar' => $firstAbsensi->jam_keluar ? date('H:i', strtotime($firstAbsensi->jam_keluar)) : '17:00',
            'status' => 'hadir', // Use valid status
            'keterangan' => ($firstAbsensi->keterangan ?? '') . ' (test update from API)'
        ]);
        $updateRequest->headers->set('Accept', 'application/json');
        $updateRequest->headers->set('X-Requested-With', 'XMLHttpRequest');

        $response = $controller->update($updateRequest, $firstAbsensi->id_absensi);
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
