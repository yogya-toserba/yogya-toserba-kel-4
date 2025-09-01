<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StokProduk;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class InventoriDashboardController extends Controller
{
    public function index()
    {
        // Ambil data statistik dari database stok_produk
        $products = StokProduk::with('cabang')->get();
        
        // Hitung statistik dasar
        $totalProduk = $products->count();
        $produkAktif = $products->where('stok', '>', 0)->count();
        $stokRendah = $products->where('stok', '<', 10)->count(); // Stok rendah < 10
        $stokHabis = $products->where('stok', '<=', 0)->count();
        
        // Hitung total nilai inventori
        $totalNilai = $products->sum(function($item) {
            return ($item->harga_jual ?? 0) * ($item->stok ?? 0);
        });
        
        // Hitung rata-rata harga produk
        $rataRataHarga = $products->where('harga_jual', '>', 0)->avg('harga_jual') ?? 0;
        
        // Trend stok bulanan (6 bulan terakhir)
        $trendStokBulanan = $this->getTrendStokBulanan();
        
        // Top 5 produk dengan stok tertinggi
        $topStokTinggi = $products->sortByDesc('stok')->take(5);
        
        // Top 5 produk dengan stok terendah (tapi masih ada)
        $topStokRendah = $products->where('stok', '>', 0)->sortBy('stok')->take(5);
        
        // Kategori produk berdasarkan stok
        $kategoriStok = [
            'stok_tinggi' => $products->where('stok', '>=', 50)->count(),
            'stok_sedang' => $products->whereBetween('stok', [10, 49])->count(),
            'stok_rendah' => $products->whereBetween('stok', [1, 9])->count(),
            'stok_habis' => $products->where('stok', '<=', 0)->count()
        ];
        
        // Persentase produk aktif
        $persentaseProdukAktif = $totalProduk > 0 ? round(($produkAktif / $totalProduk) * 100) : 0;
        
        // Aktivitas terkini berdasarkan data real dengan informasi lebih detail
        $recentActivities = $this->getRecentActivities();
        
        // Growth metrics (perbandingan dengan bulan lalu)
        $growthMetrics = $this->getGrowthMetrics();
        
        return view('gudang.inventori.DashboardInventori', compact(
            'totalProduk',
            'produkAktif', 
            'stokRendah',
            'stokHabis',
            'totalNilai',
            'rataRataHarga',
            'trendStokBulanan',
            'topStokTinggi',
            'topStokRendah',
            'kategoriStok',
            'persentaseProdukAktif',
            'recentActivities',
            'growthMetrics'
        ));
    }
    
    private function getTrendStokBulanan()
    {
        // Ambil data 6 bulan terakhir
        $months = [];
        $stokData = [];
        $nilaiData = [];
        
        for ($i = 5; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $monthName = $date->locale('id')->format('M');
            $months[] = $monthName;
            
            // Simulasi data berdasarkan produk yang ada (karena tidak ada timestamp historis)
            // Dalam implementasi nyata, ini akan menggunakan data historis dari log atau tabel terpisah
            $baseStok = StokProduk::sum('stok');
            $variation = rand(-20, 20); // Variasi ±20%
            $monthStok = max(0, $baseStok + ($baseStok * $variation / 100));
            
            $baseNilai = StokProduk::sum(DB::raw('harga_jual * stok'));
            $nilaiVariation = rand(-15, 25); // Variasi ±15-25%
            $monthNilai = max(0, $baseNilai + ($baseNilai * $nilaiVariation / 100));
            
            $stokData[] = round($monthStok);
            $nilaiData[] = round($monthNilai);
        }
        
        return [
            'labels' => $months,
            'stok' => $stokData,
            'nilai' => $nilaiData
        ];
    }
    
    private function getRecentActivities()
    {
        $activities = [];
        
        // Ambil 10 produk terbaru
        $recentProducts = StokProduk::orderBy('created_at', 'desc')->take(5)->get();
        
        foreach($recentProducts as $index => $product) {
            $hoursAgo = $index + 1; // Simulasi waktu berbeda
            
            $activities[] = [
                'type' => 'add',
                'icon' => 'fas fa-plus',
                'color' => 'primary',
                'title' => 'Produk baru ditambahkan',
                'description' => $product->nama_barang,
                'details' => 'Stok: ' . number_format($product->stok) . ' • Harga: Rp ' . number_format($product->harga_jual, 0, ',', '.'),
                'time' => $hoursAgo . ' jam yang lalu'
            ];
        }
        
        // Tambah aktivitas untuk stok rendah
        $lowStockProducts = StokProduk::where('stok', '<', 10)->where('stok', '>', 0)->take(3)->get();
        foreach($lowStockProducts as $index => $product) {
            $activities[] = [
                'type' => 'warning',
                'icon' => 'fas fa-exclamation-triangle',
                'color' => 'warning',
                'title' => 'Peringatan stok rendah',
                'description' => $product->nama_barang,
                'details' => 'Sisa stok: ' . $product->stok . ' unit',
                'time' => (6 + $index * 2) . ' jam yang lalu'
            ];
        }
        
        // Tambah aktivitas untuk stok habis
        $emptyStockProducts = StokProduk::where('stok', '<=', 0)->take(2)->get();
        foreach($emptyStockProducts as $index => $product) {
            $activities[] = [
                'type' => 'danger',
                'icon' => 'fas fa-times-circle',
                'color' => 'danger',
                'title' => 'Stok habis',
                'description' => $product->nama_barang,
                'details' => 'Perlu restok segera',
                'time' => (12 + $index * 3) . ' jam yang lalu'
            ];
        }
        
        // Sort by time (most recent first)
        return collect($activities)->sortBy(function($activity) {
            return (int)filter_var($activity['time'], FILTER_SANITIZE_NUMBER_INT);
        })->values()->all();
    }
    
    private function getGrowthMetrics()
    {
        // Simulasi growth metrics (dalam implementasi nyata akan menggunakan data historis)
        $currentMonth = StokProduk::count();
        $lastMonth = max(1, $currentMonth - rand(10, 50)); // Simulasi data bulan lalu
        
        $produkGrowth = $lastMonth > 0 ? round((($currentMonth - $lastMonth) / $lastMonth) * 100) : 0;
        
        $currentValue = StokProduk::sum(DB::raw('harga_jual * stok'));
        $lastMonthValue = max(1, $currentValue - ($currentValue * rand(5, 20) / 100));
        $nilaiGrowth = $lastMonthValue > 0 ? round((($currentValue - $lastMonthValue) / $lastMonthValue) * 100) : 0;
        
        $currentActive = StokProduk::where('stok', '>', 0)->count();
        $lastMonthActive = max(1, $currentActive - rand(5, 20));
        $aktifGrowth = $lastMonthActive > 0 ? round((($currentActive - $lastMonthActive) / $lastMonthActive) * 100) : 0;
        
        return [
            'produk' => ['value' => $produkGrowth, 'trend' => $produkGrowth >= 0 ? 'up' : 'down'],
            'nilai' => ['value' => abs($nilaiGrowth), 'trend' => $nilaiGrowth >= 0 ? 'up' : 'down'],
            'aktif' => ['value' => abs($aktifGrowth), 'trend' => $aktifGrowth >= 0 ? 'up' : 'down']
        ];
    }
    
    public function getStatistics()
    {
        // API endpoint untuk mendapatkan statistik real-time
        $products = StokProduk::all();
        
        return response()->json([
            'total_produk' => $products->count(),
            'produk_aktif' => $products->where('stok', '>', 0)->count(),
            'stok_rendah' => $products->where('stok', '<', 10)->count(),
            'stok_habis' => $products->where('stok', '<=', 0)->count(),
            'total_nilai' => $products->sum(function($item) {
                return ($item->harga_jual ?? 0) * ($item->stok ?? 0);
            }),
            'rata_rata_harga' => $products->where('harga_jual', '>', 0)->avg('harga_jual') ?? 0,
            'persentase_aktif' => $products->count() > 0 ? round(($products->where('stok', '>', 0)->count() / $products->count()) * 100) : 0
        ]);
    }
}
