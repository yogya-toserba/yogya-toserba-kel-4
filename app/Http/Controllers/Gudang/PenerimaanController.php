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
        
        // Transform data untuk menampilkan nama cabang sebagai nama produk
        $sessionPenerimaan = collect($sessionPenerimaan)->map(function($item) {
            return [
                'id' => $item['id'] ?? 'N/A',
                'id_pengiriman' => $item['id_pengiriman'] ?? 'SHIP-UNKNOWN',
                'nama_produk' => $item['nama_produk'] ?? 'Unknown Product', // Ini akan tetap sebagai backup
                'tujuan' => $item['tujuan'] ?? 'Unknown Branch', // Ini yang akan ditampilkan sebagai nama cabang
                'nama_cabang' => $item['tujuan'] ?? 'Unknown Branch', // Alias untuk clarity
                'jumlah' => $item['jumlah'] ?? 0,
                'status' => $item['status'] ?? 'Dalam Perjalanan',
                'tanggal_kirim' => $item['tanggal_kirim'] ?? date('Y-m-d'),
                'tanggal_kirim_aktual' => $item['tanggal_kirim_aktual'] ?? null,
                'tanggal_terima' => $item['tanggal_terima'] ?? null,
                'created_at' => $item['created_at'] ?? date('Y-m-d H:i:s'),
                'products' => $item['products'] ?? null, // Detail produk jika ada
            ];
        })->toArray();
        
        // Apply filters if any
        if ($request->filled('search')) {
            $searchTerm = strtolower($request->search);
            $sessionPenerimaan = collect($sessionPenerimaan)->filter(function($item) use ($searchTerm) {
                return str_contains(strtolower($item['tujuan']), $searchTerm) ||
                       str_contains(strtolower($item['nama_produk']), $searchTerm) ||
                       str_contains(strtolower($item['id_pengiriman']), $searchTerm);
            })->values()->toArray();
        }
        
        if ($request->filled('status')) {
            $sessionPenerimaan = collect($sessionPenerimaan)->filter(function($item) use ($request) {
                return $item['status'] === $request->status;
            })->values()->toArray();
        }
        
        if ($request->filled('tanggal_dari')) {
            $sessionPenerimaan = collect($sessionPenerimaan)->filter(function($item) use ($request) {
                return $item['tanggal_kirim'] >= $request->tanggal_dari;
            })->values()->toArray();
        }
        
        if ($request->filled('tanggal_sampai')) {
            $sessionPenerimaan = collect($sessionPenerimaan)->filter(function($item) use ($request) {
                return $item['tanggal_kirim'] <= $request->tanggal_sampai;
            })->values()->toArray();
        }
        
        // Buat pagination kosong untuk menghindari error hasPages()
        $penerimaan = new \Illuminate\Pagination\LengthAwarePaginator(
            collect([]), // items kosong
            0, // total items: 0
            10, // per page: 10
            1, // current page: 1
            ['path' => request()->url(), 'pageName' => 'page']
        );

        // Statistik dari session data (sebelum filter)
        $allSessionData = session('all_penerimaan', []);
        $sessionCount = count($allSessionData);
        $sessionMenunggu = collect($allSessionData)->where('status', 'Dalam Perjalanan')->count();
        $sessionDiterima = collect($allSessionData)->where('status', 'Diterima')->count();
        $sessionSelesai = collect($allSessionData)->where('status', 'Selesai')->count();

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
        $produkList = collect($allSessionData)->pluck('nama_produk')->unique()->map(function($nama) {
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
            // Update status penerimaan menjadi "Diterima"
            $sessionPenerimaan[$index]['status'] = 'Diterima';
            $sessionPenerimaan[$index]['tanggal_terima'] = now()->format('Y-m-d H:i:s');
            
            // Update status pengiriman terkait menjadi "Diterima"
            $idPengiriman = $sessionPenerimaan[$index]['id_pengiriman'] ?? null;
            if ($idPengiriman) {
                $sessionPengiriman = session('all_pengiriman', []);
                foreach ($sessionPengiriman as $i => $pengiriman) {
                    if (($pengiriman['id_pengiriman'] ?? null) === $idPengiriman) {
                        $sessionPengiriman[$i]['status'] = 'Diterima';
                        $sessionPengiriman[$i]['tanggal_diterima'] = now()->format('Y-m-d H:i:s');
                        break;
                    }
                }
                session(['all_pengiriman' => $sessionPengiriman]);
            }
            
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
            // Update status dengan timestamp
            $sessionPenerimaan[$index]['status'] = $status;
            $sessionPenerimaan[$index]['updated_at'] = now()->format('Y-m-d H:i:s');
            
            // Set tanggal terima jika status berubah ke Diterima
            if ($status === 'Diterima') {
                $sessionPenerimaan[$index]['tanggal_terima'] = now()->format('Y-m-d H:i:s');
            }
            
            // Update session
            session(['all_penerimaan' => $sessionPenerimaan]);
            
            return response()->json([
                'success' => true,
                'message' => "Status berhasil diubah menjadi {$status}!"
            ]);
        }
        
        return response()->json([
            'success' => false,
            'message' => 'Data tidak ditemukan!'
        ], 404);
    }
    
    public function hapusPenerimaan(Request $request)
    {
        $index = $request->input('index');
        $sessionPenerimaan = session('all_penerimaan', []);
        
        if (isset($sessionPenerimaan[$index])) {
            // Simpan info sebelum dihapus
            $item = $sessionPenerimaan[$index];
            $idPengiriman = $item['id_pengiriman'] ?? 'Unknown';
            
            // Hapus item dari array
            unset($sessionPenerimaan[$index]);
            
            // Re-index array untuk menghindari gap
            $sessionPenerimaan = array_values($sessionPenerimaan);
            
            // Update session
            session(['all_penerimaan' => $sessionPenerimaan]);
            
            return response()->json([
                'success' => true,
                'message' => "Data penerimaan {$idPengiriman} berhasil dihapus!"
            ]);
        }
        
        return response()->json([
            'success' => false,
            'message' => 'Data tidak ditemukan!'
        ], 404);
    }
}
