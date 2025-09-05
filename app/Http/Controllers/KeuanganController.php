<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KeuanganController extends Controller
{
    public function dashboard()
    {
        // Ambil data produk terlaris untuk dashboard keuangan
        $produkTerlaris = DB::table('detail_transaksi')
            ->join('stok_produk', 'detail_transaksi.id_produk', '=', 'stok_produk.id_produk')
            ->join('kategori', 'stok_produk.id_kategori', '=', 'kategori.id_kategori')
            ->select(
                'stok_produk.nama_barang',
                'kategori.nama_kategori',
                'stok_produk.harga_jual',
                DB::raw('SUM(detail_transaksi.jumlah_barang) as total_terjual'),
                DB::raw('SUM(detail_transaksi.total_harga) as total_pendapatan'),
                DB::raw('COUNT(DISTINCT detail_transaksi.id_transaksi) as jumlah_transaksi'),
                DB::raw('AVG(detail_transaksi.total_harga / detail_transaksi.jumlah_barang) as harga_rata_rata')
            )
            ->groupBy('stok_produk.id_produk', 'stok_produk.nama_barang', 'kategori.nama_kategori', 'stok_produk.harga_jual')
            ->orderByDesc('total_pendapatan') // Urutkan berdasarkan pendapatan tertinggi untuk keuangan
            ->limit(8)
            ->get();

        // Data keuangan statistik
        $totalPendapatan = DB::table('transaksi')->sum('total_belanja') ?? 0;
        $pendapatanHariIni = DB::table('transaksi')
            ->whereDate('tanggal_transaksi', today())
            ->sum('total_belanja') ?? 0;
        $pendapatanBulanIni = DB::table('transaksi')
            ->whereMonth('tanggal_transaksi', now()->month)
            ->whereYear('tanggal_transaksi', now()->year)
            ->sum('total_belanja') ?? 0;

        // Statistik produk berdasarkan kategori
        $pendapatanPerKategori = DB::table('detail_transaksi')
            ->join('stok_produk', 'detail_transaksi.id_produk', '=', 'stok_produk.id_produk')
            ->join('kategori', 'stok_produk.id_kategori', '=', 'kategori.id_kategori')
            ->select(
                'kategori.nama_kategori',
                DB::raw('SUM(detail_transaksi.total_harga) as total_pendapatan'),
                DB::raw('SUM(detail_transaksi.jumlah_barang) as total_unit'),
                DB::raw('COUNT(DISTINCT stok_produk.id_produk) as jumlah_produk')
            )
            ->groupBy('kategori.nama_kategori')
            ->orderByDesc('total_pendapatan')
            ->get();

        return view('admin.analisis.dashboard', compact(
            'produkTerlaris',
            'totalPendapatan',
            'pendapatanHariIni',
            'pendapatanBulanIni',
            'pendapatanPerKategori'
        ));
    }

    public function riwayatTransaksi(Request $request)
    {
        $query = DB::table('transaksi')
            ->join('pelanggan', 'transaksi.id_pelanggan', '=', 'pelanggan.id_pelanggan')
            ->join('cabang', 'transaksi.id_cabang', '=', 'cabang.id_cabang')
            ->select(
                'transaksi.*',
                'pelanggan.nama_pelanggan',
                'cabang.nama_cabang'
            );

        // Filter berdasarkan pencarian
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('transaksi.id_transaksi', 'like', "%{$search}%")
                  ->orWhere('pelanggan.nama_pelanggan', 'like', "%{$search}%")
                  ->orWhere('transaksi.metode_pembayaran', 'like', "%{$search}%");
            });
        }

        // Filter berdasarkan periode
        if ($request->filled('periode')) {
            switch ($request->periode) {
                case 'harian':
                    $query->whereDate('transaksi.tanggal_transaksi', today());
                    break;
                case 'mingguan':
                    $query->whereBetween('transaksi.tanggal_transaksi', [
                        now()->startOfWeek(),
                        now()->endOfWeek()
                    ]);
                    break;
                case 'bulanan':
                    $query->whereMonth('transaksi.tanggal_transaksi', now()->month)
                          ->whereYear('transaksi.tanggal_transaksi', now()->year);
                    break;
            }
        }

        // Filter berdasarkan status
        if ($request->filled('status')) {
            $query->where('transaksi.status_transaksi', $request->status);
        }

        // Filter berdasarkan metode pembayaran
        if ($request->filled('metode')) {
            $query->where('transaksi.metode_pembayaran', $request->metode);
        }

        $transaksi = $query->orderByDesc('tanggal_transaksi')->paginate(20);

        // Statistik untuk cards
        $totalPendapatan = DB::table('transaksi')->sum('total_belanja') ?? 0;
        $totalTransaksi = DB::table('transaksi')->count();
        $pendapatanBulanIni = DB::table('transaksi')
            ->whereMonth('tanggal_transaksi', now()->month)
            ->whereYear('tanggal_transaksi', now()->year)
            ->sum('total_belanja') ?? 0;
        $pendapatanBulanLalu = DB::table('transaksi')
            ->whereMonth('tanggal_transaksi', now()->subMonth()->month)
            ->whereYear('tanggal_transaksi', now()->subMonth()->year)
            ->sum('total_belanja') ?? 0;

        $pertumbuhanPendapatan = $pendapatanBulanLalu > 0 
            ? (($pendapatanBulanIni - $pendapatanBulanLalu) / $pendapatanBulanLalu) * 100 
            : 0;

        return view('admin.keuangan.riwayat_transaksi', compact(
            'transaksi', 
            'totalPendapatan', 
            'totalTransaksi', 
            'pendapatanBulanIni',
            'pertumbuhanPendapatan'
        ));
    }

    public function bukuBesar()
    {
        $kasRecords = DB::table('kas')
            ->join('cabang', 'kas.id_cabang', '=', 'cabang.id_cabang')
            ->leftJoin('transaksi', 'kas.id_kas', '=', 'transaksi.id_kas')
            ->select(
                'kas.*',
                'cabang.nama_cabang',
                DB::raw('COUNT(transaksi.id_transaksi) as jumlah_transaksi')
            )
            ->groupBy('kas.id_kas', 'kas.id_cabang', 'kas.referensi', 'kas.jenis_transaksi', 'kas.jumlah', 'kas.keterangan', 'kas.created_at', 'kas.updated_at', 'cabang.nama_cabang')
            ->orderByDesc('kas.created_at')
            ->paginate(15);

        return view('admin.keuangan.bukubesar', compact('kasRecords'));
    }

    public function laporan(Request $request)
    {
        $periode = $request->get('periode', 'bulan_ini');
        $kategori = $request->get('kategori');
        $status = $request->get('status');
        $search = $request->get('search');

        // Base query untuk laporan - using a simulated dataset since we don't have actual transaction tables
        $laporanData = collect([
            [
                'id' => 'TRX001',
                'nama_laporan' => 'Laporan Pendapatan Bulanan',
                'kategori' => 'Pendapatan',
                'periode' => 'September 2025',
                'status' => 'selesai',
                'nilai' => 2500000,
                'deskripsi' => '+12% dari target',
                'avatar' => 'RP'
            ],
            [
                'id' => 'TRX002', 
                'nama_laporan' => 'Laporan Pengeluaran',
                'kategori' => 'Pengeluaran',
                'periode' => 'September 2025',
                'status' => 'selesai',
                'nilai' => 1800000,
                'deskripsi' => 'Dalam batas budget',
                'avatar' => 'RP'
            ],
            [
                'id' => 'TRX003',
                'nama_laporan' => 'Laporan Laba Rugi',
                'kategori' => 'Laba Rugi',
                'periode' => 'September 2025',
                'status' => 'review',
                'nilai' => 700000,
                'deskripsi' => 'Dalam review',
                'avatar' => 'LP'
            ],
            [
                'id' => 'TRX004',
                'nama_laporan' => 'Laporan Aset',
                'kategori' => 'Aset',
                'periode' => 'September 2025',
                'status' => 'selesai',
                'nilai' => 8500000,
                'deskripsi' => 'Nilai aset stabil',
                'avatar' => 'AT'
            ],
            [
                'id' => 'TRX005',
                'nama_laporan' => 'Laporan Pajak',
                'kategori' => 'Pajak',
                'periode' => 'September 2025',
                'status' => 'pending',
                'nilai' => 250000,
                'deskripsi' => 'Menunggu verifikasi',
                'avatar' => 'PJ'
            ]
        ]);

        // Apply filters
        $filteredData = $laporanData;

        // Filter by search
        if ($search) {
            $filteredData = $filteredData->filter(function($item) use ($search) {
                return stripos($item['nama_laporan'], $search) !== false ||
                       stripos($item['id'], $search) !== false ||
                       stripos($item['kategori'], $search) !== false;
            });
        }

        // Filter by period
        if ($periode && $periode !== 'semua') {
            $currentMonth = now()->format('F Y');
            $filteredData = $filteredData->filter(function($item) use ($periode, $currentMonth) {
                switch ($periode) {
                    case 'bulan_ini':
                        return $item['periode'] === $currentMonth;
                    case 'bulan_lalu':
                        return $item['periode'] === now()->subMonth()->format('F Y');
                    default:
                        return true;
                }
            });
        }

        // Filter by status
        if ($status && $status !== 'semua') {
            $filteredData = $filteredData->filter(function($item) use ($status) {
                return $item['status'] === $status;
            });
        }

        // Filter by category
        if ($kategori && $kategori !== 'semua') {
            $filteredData = $filteredData->filter(function($item) use ($kategori) {
                return $item['kategori'] === $kategori;
            });
        }

        // Pagination simulation using Laravel Paginator
        $currentPage = $request->get('page', 1);
        $perPage = 5;
        $total = $filteredData->count();
        
        // Get items for current page
        $items = $filteredData->forPage($currentPage, $perPage)->values();
        
        // Create Laravel paginator
        $laporan = new \Illuminate\Pagination\LengthAwarePaginator(
            $items,
            $total,
            $perPage,
            $currentPage,
            [
                'path' => $request->url(),
                'pageName' => 'page',
            ]
        );
        
        // Append query parameters to pagination links
        $laporan->appends($request->query());

        // Data untuk dropdown kategori
        $kategoriList = collect(['Pendapatan', 'Pengeluaran', 'Laba Rugi', 'Aset', 'Pajak']);

        // Data untuk dropdown status
        $statusList = [
            'selesai' => 'Selesai',
            'pending' => 'Pending', 
            'review' => 'Review'
        ];

        // Data untuk dropdown periode
        $periodeList = [
            'hari_ini' => 'Hari Ini',
            'minggu_ini' => 'Minggu Ini',
            'bulan_ini' => 'Bulan Ini',
            'bulan_lalu' => 'Bulan Lalu',
            'tahun_ini' => 'Tahun Ini',
            'tahun_lalu' => 'Tahun Lalu',
            'semua' => 'Semua Periode'
        ];

        return view('admin.keuangan.laporan', compact('laporan', 'kategoriList', 'statusList', 'periodeList', 'periode', 'kategori', 'status', 'search', 'total'));
    }
    
    public function exportPDF(Request $request)
    {
        $jenisLaporan = $request->get('jenis_laporan', 'Laporan Keseluruhan');
        $periode = $request->get('periode', date('Y-m'));
        $format = $request->get('format', 'pdf');
        
        // Convert periode to readable format
        $periodeText = date('F Y', strtotime($periode . '-01'));
        
        // Generate sample data based on report type
        $data = [];
        
        switch ($jenisLaporan) {
            case 'neraca':
                $data = [
                    ['keterangan' => 'Kas', 'debit' => 50000000, 'kredit' => 0, 'saldo' => 50000000],
                    ['keterangan' => 'Piutang Usaha', 'debit' => 20000000, 'kredit' => 0, 'saldo' => 70000000],
                    ['keterangan' => 'Persediaan Barang', 'debit' => 30000000, 'kredit' => 0, 'saldo' => 100000000],
                    ['keterangan' => 'Utang Usaha', 'debit' => 0, 'kredit' => 15000000, 'saldo' => 85000000],
                    ['keterangan' => 'Modal', 'debit' => 0, 'kredit' => 25000000, 'saldo' => 60000000],
                ];
                break;
                
            case 'laba_rugi':
                $data = [
                    ['keterangan' => 'Pendapatan Penjualan', 'debit' => 0, 'kredit' => 80000000, 'saldo' => -80000000],
                    ['keterangan' => 'Harga Pokok Penjualan', 'debit' => 45000000, 'kredit' => 0, 'saldo' => -35000000],
                    ['keterangan' => 'Beban Operasional', 'debit' => 15000000, 'kredit' => 0, 'saldo' => -20000000],
                    ['keterangan' => 'Beban Administrasi', 'debit' => 8000000, 'kredit' => 0, 'saldo' => -12000000],
                    ['keterangan' => 'Laba Bersih', 'debit' => 0, 'kredit' => 12000000, 'saldo' => 12000000],
                ];
                break;
                
            case 'arus_kas':
                $data = [
                    ['keterangan' => 'Kas Awal Periode', 'debit' => 25000000, 'kredit' => 0, 'saldo' => 25000000],
                    ['keterangan' => 'Penerimaan dari Penjualan', 'debit' => 75000000, 'kredit' => 0, 'saldo' => 100000000],
                    ['keterangan' => 'Pembayaran Supplier', 'debit' => 0, 'kredit' => 40000000, 'saldo' => 60000000],
                    ['keterangan' => 'Pembayaran Beban Operasional', 'debit' => 0, 'kredit' => 10000000, 'saldo' => 50000000],
                    ['keterangan' => 'Kas Akhir Periode', 'debit' => 50000000, 'kredit' => 0, 'saldo' => 50000000],
                ];
                break;
                
            default:
                $data = [
                    ['keterangan' => 'Kas', 'debit' => 50000000, 'kredit' => 0, 'saldo' => 50000000],
                    ['keterangan' => 'Piutang Usaha', 'debit' => 20000000, 'kredit' => 0, 'saldo' => 70000000],
                    ['keterangan' => 'Pendapatan Penjualan', 'debit' => 0, 'kredit' => 80000000, 'saldo' => -10000000],
                    ['keterangan' => 'Beban Operasional', 'debit' => 5000000, 'kredit' => 0, 'saldo' => -15000000],
                ];
        }
        
        if ($format === 'excel') {
            // For future Excel export implementation
            return response()->json([
                'message' => 'Excel export feature coming soon',
                'data' => $data
            ]);
        }
        
        // Generate PDF
        return view('admin.keuangan.laporan_pdf', compact('data', 'jenisLaporan', 'periodeText'));
    }
}
