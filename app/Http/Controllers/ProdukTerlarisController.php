<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProdukTerlarisController extends Controller
{
    /**
     * Mendapatkan data produk terlaris berdasarkan transaksi
     */
    public function getProdukTerlaris(Request $request)
    {
        $limit = $request->get('limit', 10);
        $periode = $request->get('periode', 30); // dalam hari
        
        $produkTerlaris = DB::table('detail_transaksi')
            ->join('stok_produk', 'detail_transaksi.id_produk', '=', 'stok_produk.id_produk')
            ->join('kategori', 'stok_produk.id_kategori', '=', 'kategori.id_kategori')
            ->join('transaksi', 'detail_transaksi.id_transaksi', '=', 'transaksi.id_transaksi')
            ->select(
                'stok_produk.id_produk',
                'stok_produk.nama_barang',
                'kategori.nama_kategori',
                'stok_produk.harga_jual',
                'stok_produk.foto',
                'stok_produk.stok',
                DB::raw('SUM(detail_transaksi.jumlah_barang) as total_terjual'),
                DB::raw('SUM(detail_transaksi.total_harga) as total_pendapatan'),
                DB::raw('COUNT(DISTINCT detail_transaksi.id_transaksi) as jumlah_transaksi'),
                DB::raw('AVG(detail_transaksi.total_harga / detail_transaksi.jumlah_barang) as harga_rata_rata')
            )
            ->where('transaksi.tanggal_transaksi', '>=', now()->subDays($periode))
            ->groupBy(
                'stok_produk.id_produk', 
                'stok_produk.nama_barang', 
                'kategori.nama_kategori', 
                'stok_produk.harga_jual',
                'stok_produk.foto',
                'stok_produk.stok'
            )
            ->orderByDesc('total_terjual')
            ->limit($limit)
            ->get();
            
        return response()->json([
            'success' => true,
            'data' => $produkTerlaris,
            'periode' => $periode . ' hari terakhir',
            'total_produk' => $produkTerlaris->count()
        ]);
    }
    
    /**
     * Mendapatkan produk terlaris per kategori
     */
    public function getProdukTerlarisPerKategori(Request $request)
    {
        $kategori = $request->get('kategori');
        $limit = $request->get('limit', 5);
        $periode = $request->get('periode', 30);
        
        $query = DB::table('detail_transaksi')
            ->join('stok_produk', 'detail_transaksi.id_produk', '=', 'stok_produk.id_produk')
            ->join('kategori', 'stok_produk.id_kategori', '=', 'kategori.id_kategori')
            ->join('transaksi', 'detail_transaksi.id_transaksi', '=', 'transaksi.id_transaksi')
            ->select(
                'stok_produk.id_produk',
                'stok_produk.nama_barang',
                'kategori.nama_kategori',
                'stok_produk.harga_jual',
                'stok_produk.foto',
                DB::raw('SUM(detail_transaksi.jumlah_barang) as total_terjual'),
                DB::raw('SUM(detail_transaksi.total_harga) as total_pendapatan')
            )
            ->where('transaksi.tanggal_transaksi', '>=', now()->subDays($periode))
            ->groupBy(
                'stok_produk.id_produk', 
                'stok_produk.nama_barang', 
                'kategori.nama_kategori', 
                'stok_produk.harga_jual',
                'stok_produk.foto'
            )
            ->orderByDesc('total_terjual');
            
        if ($kategori) {
            $query->where('kategori.nama_kategori', $kategori);
        }
        
        $produkTerlaris = $query->limit($limit)->get();
            
        return response()->json([
            'success' => true,
            'data' => $produkTerlaris,
            'kategori' => $kategori ?? 'Semua Kategori',
            'periode' => $periode . ' hari terakhir',
            'total_produk' => $produkTerlaris->count()
        ]);
    }
    
    /**
     * Mendapatkan statistik penjualan produk
     */
    public function getStatistikPenjualan(Request $request)
    {
        $periode = $request->get('periode', 30);
        
        $statistik = DB::table('detail_transaksi')
            ->join('stok_produk', 'detail_transaksi.id_produk', '=', 'stok_produk.id_produk')
            ->join('kategori', 'stok_produk.id_kategori', '=', 'kategori.id_kategori')
            ->join('transaksi', 'detail_transaksi.id_transaksi', '=', 'transaksi.id_transaksi')
            ->select(
                'kategori.nama_kategori',
                DB::raw('COUNT(DISTINCT stok_produk.id_produk) as jumlah_produk_terjual'),
                DB::raw('SUM(detail_transaksi.jumlah_barang) as total_unit_terjual'),
                DB::raw('SUM(detail_transaksi.total_harga) as total_pendapatan_kategori'),
                DB::raw('AVG(detail_transaksi.total_harga) as rata_rata_nilai_transaksi')
            )
            ->where('transaksi.tanggal_transaksi', '>=', now()->subDays($periode))
            ->groupBy('kategori.nama_kategori')
            ->orderByDesc('total_pendapatan_kategori')
            ->get();
            
        return response()->json([
            'success' => true,
            'data' => $statistik,
            'periode' => $periode . ' hari terakhir'
        ]);
    }
    
    /**
     * Mendapatkan tren penjualan produk harian
     */
    public function getTrenPenjualanHarian(Request $request)
    {
        $produkId = $request->get('produk_id');
        $periode = $request->get('periode', 30);
        
        if (!$produkId) {
            return response()->json([
                'success' => false,
                'message' => 'ID Produk harus disertakan'
            ], 400);
        }
        
        $tren = DB::table('detail_transaksi')
            ->join('transaksi', 'detail_transaksi.id_transaksi', '=', 'transaksi.id_transaksi')
            ->join('stok_produk', 'detail_transaksi.id_produk', '=', 'stok_produk.id_produk')
            ->select(
                DB::raw('DATE(transaksi.tanggal_transaksi) as tanggal'),
                DB::raw('SUM(detail_transaksi.jumlah_barang) as total_terjual'),
                DB::raw('SUM(detail_transaksi.total_harga) as total_pendapatan'),
                DB::raw('COUNT(detail_transaksi.id_transaksi) as jumlah_transaksi')
            )
            ->where('detail_transaksi.id_produk', $produkId)
            ->where('transaksi.tanggal_transaksi', '>=', now()->subDays($periode))
            ->groupBy(DB::raw('DATE(transaksi.tanggal_transaksi)'))
            ->orderBy('tanggal', 'asc')
            ->get();
            
        return response()->json([
            'success' => true,
            'data' => $tren,
            'produk_id' => $produkId,
            'periode' => $periode . ' hari terakhir'
        ]);
    }
}
