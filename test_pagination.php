<?php

require_once __DIR__ . '/vendor/autoload.php';

// Bootstrap Laravel
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Gaji;

echo "=== Test Pagination Penggajian ===\n\n";

try {
    // Test berbagai periode
    $periods = ['2024-12', '2025-01', '2025-02'];

    foreach ($periods as $periode) {
        echo "Periode: $periode\n";
        $count = Gaji::where('periode_gaji', $periode)->count();
        echo "  Total records: $count\n";

        if ($count > 0) {
            // Test pagination
            $perPage = 10;
            $totalPages = ceil($count / $perPage);
            echo "  Pages needed (per_page=$perPage): $totalPages\n";

            // Test first page
            $firstPage = Gaji::where('periode_gaji', $periode)
                ->paginate($perPage, ['*'], 'page', 1);
            echo "  First page items: {$firstPage->firstItem()} - {$firstPage->lastItem()}\n";

            // Test last page if exists
            if ($totalPages > 1) {
                $lastPage = Gaji::where('periode_gaji', $periode)
                    ->paginate($perPage, ['*'], 'page', $totalPages);
                echo "  Last page items: {$lastPage->firstItem()} - {$lastPage->lastItem()}\n";
            }
        }
        echo "\n";
    }

    echo "✅ Pagination test completed successfully!\n";
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
}
