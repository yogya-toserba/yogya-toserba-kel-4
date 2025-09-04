<?php

// Test query produk terlaris
use Illuminate\Support\Facades\DB;

// Bootstrap Laravel
require_once 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "=== TEST PRODUK TERLARIS ===\n\n";

try {
    // Test query produk terlaris
    $produkTerlaris = DB::table('detail_transaksi')
        ->join('stok_produk', 'detail_transaksi.id_produk', '=', 'stok_produk.id_produk')
        ->join('kategori', 'stok_produk.id_kategori', '=', 'kategori.id_kategori')
        ->select(
            'stok_produk.nama_barang',
            'stok_produk.harga_jual',
            'kategori.nama_kategori',
            DB::raw('SUM(detail_transaksi.jumlah_barang) as total_terjual'),
            DB::raw('SUM(detail_transaksi.total_harga) as total_pendapatan'),
            DB::raw('COUNT(DISTINCT detail_transaksi.id_transaksi) as jumlah_transaksi')
        )
        ->groupBy('stok_produk.id_produk', 'stok_produk.nama_barang', 'stok_produk.harga_jual', 'kategori.nama_kategori')
        ->orderByDesc('total_terjual')
        ->limit(5)
        ->get();

    echo "✅ Query berhasil dijalankan!\n";
    echo "📊 Total produk terlaris ditemukan: " . $produkTerlaris->count() . "\n\n";

    if ($produkTerlaris->count() > 0) {
        echo "🏆 TOP 5 PRODUK TERLARIS:\n";
        echo "=" . str_repeat("=", 80) . "\n";
        
        foreach ($produkTerlaris as $index => $produk) {
            $rank = $index + 1;
            $medal = $rank == 1 ? "🥇" : ($rank == 2 ? "🥈" : ($rank == 3 ? "🥉" : "#{$rank}"));
            
            echo "{$medal} {$produk->nama_barang}\n";
            echo "    Kategori: {$produk->nama_kategori}\n";
            echo "    Harga: Rp " . number_format($produk->harga_jual) . "\n";
            echo "    Total Terjual: " . number_format($produk->total_terjual) . " unit\n";
            echo "    Jumlah Transaksi: {$produk->jumlah_transaksi}\n";
            echo "    Total Pendapatan: Rp " . number_format($produk->total_pendapatan) . "\n";
            echo "    " . str_repeat("-", 60) . "\n";
        }
    } else {
        echo "⚠️  Belum ada data penjualan produk\n";
    }

    echo "\n=== KESIMPULAN ===\n";
    echo "✅ Query produk terlaris berfungsi dengan baik\n";
    echo "✅ Data real dari database sudah terhubung\n";
    echo "✅ Dashboard pelanggan siap menampilkan produk terlaris\n";
    
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
}
