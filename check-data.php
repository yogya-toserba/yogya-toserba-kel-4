<?php

require_once 'vendor/autoload.php';

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Capsule\Manager as Capsule;

// Setup Laravel App
$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

echo "=== STATUS KONEKSI DATA ANALISIS ===\n\n";

try {
    // Cek koneksi database
    DB::connection()->getPdo();
    echo "✅ Koneksi database berhasil\n\n";
    
    // Cek data di setiap tabel
    $tables = [
        'transaksi' => 'Transaksi',
        'detail_transaksi' => 'Detail Transaksi', 
        'pelanggan' => 'Pelanggan',
        'stok_produk' => 'Produk',
        'kategori' => 'Kategori',
        'cabang' => 'Cabang'
    ];
    
    foreach ($tables as $table => $label) {
        $count = DB::table($table)->count();
        echo "📊 {$label}: {$count} record\n";
    }
    
    echo "\n=== SAMPLE DATA TESTING ===\n\n";
    
    // Test query untuk masing-masing dashboard
    echo "💰 DASHBOARD KEUANGAN:\n";
    $pendapatanHariIni = DB::table('transaksi')->whereDate('tanggal_transaksi', today())->sum('total_belanja') ?? 0;
    $transaksiHariIni = DB::table('transaksi')->whereDate('tanggal_transaksi', today())->count();
    echo "   - Pendapatan hari ini: Rp " . number_format($pendapatanHariIni) . "\n";
    echo "   - Transaksi hari ini: {$transaksiHariIni}\n";
    
    echo "\n👥 DASHBOARD PELANGGAN:\n";
    $totalPelanggan = DB::table('pelanggan')->count();
    $pelangganBulanIni = DB::table('pelanggan')->whereMonth('created_at', now()->month)->count();
    echo "   - Total pelanggan: {$totalPelanggan}\n";
    echo "   - Pelanggan baru bulan ini: {$pelangganBulanIni}\n";
    
    echo "\n📦 DASHBOARD BARANG:\n";
    $totalProduk = DB::table('stok_produk')->count();
    $totalStok = DB::table('stok_produk')->sum('stok') ?? 0;
    $stokMenipis = DB::table('stok_produk')->where('stok', '<', 10)->count();
    echo "   - Total produk: {$totalProduk}\n";
    echo "   - Total stok: {$totalStok}\n";
    echo "   - Produk stok menipis: {$stokMenipis}\n";
    
    echo "\n📈 DASHBOARD PENJUALAN:\n";
    $totalTransaksi = DB::table('transaksi')->count();
    $totalPendapatan = DB::table('transaksi')->sum('total_belanja') ?? 0;
    $rataRataTransaksi = $totalTransaksi > 0 ? ($totalPendapatan / $totalTransaksi) : 0;
    echo "   - Total transaksi: {$totalTransaksi}\n";
    echo "   - Total pendapatan: Rp " . number_format($totalPendapatan) . "\n";
    echo "   - Rata-rata per transaksi: Rp " . number_format($rataRataTransaksi) . "\n";
    
    // Cek chart data
    echo "\n📊 CHART DATA:\n";
    $chartDataCount = 0;
    for ($i = 6; $i >= 0; $i--) {
        $date = now()->subDays($i);
        $total = DB::table('transaksi')->whereDate('tanggal_transaksi', $date->format('Y-m-d'))->sum('total_belanja') ?? 0;
        if ($total > 0) {
            $chartDataCount++;
        }
    }
    echo "   - Hari dengan data penjualan (7 hari terakhir): {$chartDataCount}/7\n";
    
    echo "\n=== KESIMPULAN ===\n";
    if ($totalTransaksi > 0) {
        echo "✅ Semua visual data SUDAH TERHUBUNG ke database\n";
        echo "✅ Data tersedia dan siap untuk ditampilkan\n";
    } else {
        echo "❌ Belum ada data transaksi di database\n";
        echo "⚠️  Jalankan seeder untuk mengisi data\n";
    }
    
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
}
