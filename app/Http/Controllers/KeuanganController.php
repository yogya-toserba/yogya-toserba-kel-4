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

        return view('admin.dashboard', compact(
            'produkTerlaris',
            'totalPendapatan',
            'pendapatanHariIni',
            'pendapatanBulanIni',
            'pendapatanPerKategori'
        ));
    }

    public function riwayatTransaksi()
    {
        $transaksi = DB::table('transaksi')
            ->join('pelanggan', 'transaksi.id_pelanggan', '=', 'pelanggan.id_pelanggan')
            ->join('cabang', 'transaksi.id_cabang', '=', 'cabang.id_cabang')
            ->select(
                'transaksi.*',
                'pelanggan.nama_pelanggan',
                'cabang.nama_cabang'
            )
            ->orderByDesc('tanggal_transaksi')
            ->paginate(20);

        return view('admin.riwayat_transaksi', compact('transaksi'));
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

        return view('admin.bukubesar', compact('kasRecords'));
    }

    public function laporan(Request $request)
    {
        $periode = $request->get('periode', 'bulan_ini');
        $kategori = $request->get('kategori');

        // Base query untuk laporan
        $query = DB::table('detail_transaksi')
            ->join('stok_produk', 'detail_transaksi.id_produk', '=', 'stok_produk.id_produk')
            ->join('kategori', 'stok_produk.id_kategori', '=', 'kategori.id_kategori')
            ->join('transaksi', 'detail_transaksi.id_transaksi', '=', 'transaksi.id_transaksi');

        // Filter berdasarkan periode
        switch ($periode) {
            case 'hari_ini':
                $query->whereDate('transaksi.tanggal_transaksi', today());
                break;
            case 'minggu_ini':
                $query->whereBetween('transaksi.tanggal_transaksi', [
                    now()->startOfWeek(),
                    now()->endOfWeek()
                ]);
                break;
            case 'bulan_ini':
                $query->whereMonth('transaksi.tanggal_transaksi', now()->month)
                     ->whereYear('transaksi.tanggal_transaksi', now()->year);
                break;
            case 'tahun_ini':
                $query->whereYear('transaksi.tanggal_transaksi', now()->year);
                break;
        }

        // Filter berdasarkan kategori jika dipilih
        if ($kategori) {
            $query->where('kategori.nama_kategori', $kategori);
        }

        $laporan = $query
            ->select(
                'kategori.nama_kategori',
                DB::raw('SUM(detail_transaksi.total_harga) as total_pendapatan'),
                DB::raw('SUM(detail_transaksi.jumlah_barang) as total_unit_terjual'),
                DB::raw('COUNT(DISTINCT detail_transaksi.id_transaksi) as total_transaksi'),
                DB::raw('COUNT(DISTINCT stok_produk.id_produk) as total_produk_berbeda')
            )
            ->groupBy('kategori.nama_kategori')
            ->orderByDesc('total_pendapatan')
            ->get();

        // Data untuk dropdown kategori
        $kategoriList = DB::table('kategori')->pluck('nama_kategori');

        return view('admin.laporan', compact('laporan', 'kategoriList', 'periode', 'kategori'));
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
        return view('admin.laporan_pdf', compact('data', 'jenisLaporan', 'periodeText'));
    }
}
