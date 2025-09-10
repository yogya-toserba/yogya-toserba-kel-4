<?php

require 'vendor/autoload.php';

use Illuminate\Support\Facades\DB;

// Load Laravel app
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "Testing detail transaksi query...\n";

try {
    // Test basic query
    $count = DB::table('detail_transaksi')->where('id_transaksi', 1862)->count();
    echo "Detail count for transaction 1862: " . $count . "\n";
    
    if ($count > 0) {
        // Test the fixed query
        $detail = DB::table('detail_transaksi')
            ->where('id_transaksi', 1862)
            ->select(
                'nama_barang',
                'jumlah_barang', 
                'total_harga',
                DB::raw('ROUND(total_harga / jumlah_barang, 0) as harga_satuan')
            )
            ->first();
            
        echo "Sample detail:\n";
        var_dump($detail);
    } else {
        echo "No detail found for transaction 1862\n";
        
        // Find any transaction with detail
        $anyDetail = DB::table('detail_transaksi')->first();
        if ($anyDetail) {
            echo "Sample detail from any transaction:\n";
            var_dump($anyDetail);
        }
    }
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
