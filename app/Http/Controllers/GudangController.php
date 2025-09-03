<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Gudang;
use Illuminate\Routing\Controller as BaseController;

class GudangController extends BaseController
{
    public function __construct()
    {
        // Middleware is handled in routes, not in controller
        // $this->middleware('auth:gudang')->except(['showLogin', 'login']);
    }

    public function showLogin()
    {
        return view('gudang.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'id_gudang' => ['required', 'string', 'regex:/^[0-9]{4,8}$/'],
            'password' => ['required'],
        ]);

        if (Auth::guard('gudang')->attempt($credentials, $request->remember)) {
            $request->session()->regenerate();

            $gudang = Auth::guard('gudang')->user();
            
            // Cek jika ID gudang adalah 1002, arahkan ke dashboard inventori
            $redirectRoute = $gudang->id_gudang == '1002' ? route('gudang.inventori.dashboard') : route('gudang.dashboard');

            // Return JSON response for AJAX requests
            if ($request->wantsJson() || $request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => "Selamat datang, {$gudang->nama_gudang}!",
                    'redirect' => $redirectRoute
                ]);
            }

            return redirect()->intended($redirectRoute);
        }

        // Return JSON response for AJAX requests
        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => false,
                'message' => 'ID Gudang atau password tidak valid. Silakan periksa kembali data Anda.'
            ], 422);
        }

        return back()->withErrors([
            'id_gudang' => 'ID Gudang atau password tidak valid.',
        ])->onlyInput('id_gudang');
    }

    public function dashboard()
    {
        $gudang = Auth::guard('gudang')->user();
        return view('gudang.dashboard', compact('gudang'));
    }

    public function logout(Request $request)
    {
        Auth::guard('gudang')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('gudang.login');
    }

    public function permintaan()
    {
        // Ambil semua data permintaan dari session
        $allPermintaan = session('all_permintaan', []);
        
        // Debug logging
        \Log::info('Displaying permintaan page:', ['count' => count($allPermintaan)]);
        
        return view('gudang.permintaan', compact('allPermintaan'));
    }

    public function submitPermintaan(Request $request)
    {
        \Log::info('=== SUBMIT PERMINTAAN START ===');
        \Log::info('All request data: ', $request->all());
        
        // Validasi input
        $validated = $request->validate([
            'id_cabang' => 'required|string',
            'tanggal_dibutuhkan' => 'required|date',
            'prioritas' => 'required|string|in:Tinggi,Sedang,Rendah',
            'penanggung_jawab' => 'required|string|max:255',
            'catatan_umum' => 'nullable|string',
            'kode_produk' => 'required|array|min:1',
            'kode_produk.*' => 'required|string',
            'nama_barang' => 'required|array',
            'nama_barang.*' => 'required|string',
            'kategori' => 'required|array',
            'kategori.*' => 'required|string',
            'jumlah' => 'required|array',
            'jumlah.*' => 'required|integer|min:1',
            'satuan' => 'required|array',
            'satuan.*' => 'required|string',
            'stok_tersedia' => 'nullable|array',
            'stok_tersedia.*' => 'nullable|integer',
            'catatan' => 'nullable|array',
            'catatan.*' => 'nullable|string'
        ]);

        \Log::info('Validation SUCCESS - validated data: ', $validated);

        // Generate ID permintaan
        $permintaanId = '#REQ' . str_pad(rand(100, 999), 3, '0', STR_PAD_LEFT);
        
        // Mapping nama cabang
        $cabangNames = [
            'CB001' => 'Cabang Bandung',
            'CB002' => 'Cabang Jakarta', 
            'CB003' => 'Cabang Surabaya'
        ];

        // Siapkan data produk
        $produkList = [];
        $totalItems = 0;
        
        for ($i = 0; $i < count($validated['kode_produk']); $i++) {
            $produkList[] = [
                'kode_produk' => $validated['kode_produk'][$i],
                'nama_barang' => $validated['nama_barang'][$i],
                'kategori' => $validated['kategori'][$i],
                'jumlah' => $validated['jumlah'][$i],
                'satuan' => $validated['satuan'][$i],
                'stok_tersedia' => $validated['stok_tersedia'][$i] ?? 0,
                'catatan' => $validated['catatan'][$i] ?? ''
            ];
            $totalItems += (int)$validated['jumlah'][$i];
        }

        // Siapkan data permintaan untuk disimpan
        $permintaanData = [
            'id_permintaan' => $permintaanId,
            'id_cabang' => $validated['id_cabang'],
            'nama_cabang' => $cabangNames[$validated['id_cabang']] ?? 'Unknown',
            'tanggal' => date('d F Y'),
            'waktu' => date('H:i') . ' WIB',
            'tanggal_dibutuhkan' => date('d F Y', strtotime($validated['tanggal_dibutuhkan'])),
            'total_items' => $totalItems,
            'prioritas' => $validated['prioritas'],
            'status' => 'Menunggu',
            'penanggung_jawab' => $validated['penanggung_jawab'],
            'catatan_umum' => $validated['catatan_umum'],
            'produk_list' => $produkList
        ];

        \Log::info('Permintaan data prepared: ', $permintaanData);

        // Ambil data permintaan yang sudah ada dari session atau buat array kosong
        $existingPermintaan = session('all_permintaan', []);
        \Log::info('Existing permintaan before add: ', ['count' => count($existingPermintaan)]);
        
        // Tambahkan permintaan baru ke array
        $existingPermintaan[] = $permintaanData;
        
        // Simpan kembali ke session
        session(['all_permintaan' => $existingPermintaan]);

        // Verify data was saved
        $verifySession = session('all_permintaan', []);
        \Log::info('Session verification: ', [
            'count' => count($verifySession), 
            'last_item' => end($verifySession)
        ]);

        \Log::info('=== SUBMIT PERMINTAAN END SUCCESS ===');

        // Return JSON response untuk AJAX
        return response()->json([
            'success' => true,
            'message' => 'Permintaan berhasil dikirim ke gudang pusat!',
            'data' => $permintaanData,
            'total_count' => count($existingPermintaan)
        ]);
    }
}
