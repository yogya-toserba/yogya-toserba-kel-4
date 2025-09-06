<?php

namespace App\Http\Controllers\Gudang;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PenerimaanController extends Controller
{
    public function index(Request $request)
    {
        // Ambil data penerimaan dari session (data dari pengiriman yang dikirim)
        $sessionPenerimaan = session('all_penerimaan', []);
        
        // Buat pagination kosong untuk menghindari error hasPages()
        $penerimaan = new \Illuminate\Pagination\LengthAwarePaginator(
            collect([]), // items kosong
            0, // total items: 0
            10, // per page: 10
            1, // current page: 1
            ['path' => request()->url(), 'pageName' => 'page']
        );

        // Statistik dari session data
        $sessionCount = count($sessionPenerimaan);
        $sessionMenunggu = collect($sessionPenerimaan)->where('status', 'Dalam Perjalanan')->count();
        $sessionDiterima = collect($sessionPenerimaan)->where('status', 'Diterima')->count();
        $sessionSelesai = collect($sessionPenerimaan)->where('status', 'Selesai')->count();

        // Variabel yang dibutuhkan view
        $totalPenerimaan = $sessionCount;
        $menunggu = $sessionMenunggu;
        $diterima = $sessionDiterima;
        $selesai = $sessionSelesai;

        // Data untuk dropdown
        $statusOptions = [
            'Dalam Perjalanan' => 'Dalam Perjalanan',
            'Diterima' => 'Diterima',
            'Selesai' => 'Selesai'
        ];
        
        // Ambil produk dari session penerimaan untuk dropdown
        $produkList = collect($sessionPenerimaan)->pluck('nama_produk')->unique()->map(function($nama) {
            return (object) ['nama_produk' => $nama];
        });

        return view('gudang.inventori.penerimaan', compact(
            'penerimaan',
            'sessionPenerimaan',
            'totalPenerimaan',
            'menunggu',
            'diterima',
            'selesai',
            'sessionCount',
            'sessionMenunggu',
            'sessionDiterima',
            'sessionSelesai',
            'statusOptions',
            'produkList'
        ));
    }

    public function terimaPenerimaan(Request $request)
    {
        $index = $request->input('index');
        $sessionPenerimaan = session('all_penerimaan', []);
        
        if (isset($sessionPenerimaan[$index])) {
            $sessionPenerimaan[$index]['status'] = 'Diterima';
            $sessionPenerimaan[$index]['tanggal_terima'] = now()->format('Y-m-d H:i:s');
            
            session(['all_penerimaan' => $sessionPenerimaan]);
            
            return response()->json([
                'success' => true,
                'message' => 'Penerimaan berhasil diterima!'
            ]);
        }
        
        return response()->json([
            'success' => false,
            'message' => 'Data tidak ditemukan!'
        ]);
    }

    public function updateStatus(Request $request)
    {
        $index = $request->input('index');
        $status = $request->input('status');
        $sessionPenerimaan = session('all_penerimaan', []);
        
        if (isset($sessionPenerimaan[$index])) {
            $sessionPenerimaan[$index]['status'] = $status;
            $sessionPenerimaan[$index]['updated_at'] = now()->format('Y-m-d H:i:s');
            
            session(['all_penerimaan' => $sessionPenerimaan]);
            
            return response()->json([
                'success' => true,
                'message' => 'Status berhasil diupdate!'
            ]);
        }
        
        return response()->json([
            'success' => false,
            'message' => 'Data tidak ditemukan!'
        ]);
    }
}
