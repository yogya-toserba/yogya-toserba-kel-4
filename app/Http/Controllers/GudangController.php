<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Gudang;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;

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

            // Return JSON response for AJAX requests
            if ($request->wantsJson() || $request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => "Selamat datang, {$gudang->nama_gudang}!",
                    'redirect' => route('gudang.dashboard')
                ]);
            }

            return redirect()->intended(route('gudang.dashboard'));
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

        // Aggregates for dashboard
        $totalStok = \App\Models\StokGudangPusat::sum('jumlah');

        // Barang masuk: approximate as total stock added in last 30 days (if created_at exists)
        $barangMasuk = (int) \App\Models\StokGudangPusat::where('created_at', '>=', now()->subDays(30))->sum('jumlah');

        // Barang keluar: sum of pengiriman jumlah
        $barangKeluar = (int) \App\Models\Pengiriman::sum('jumlah');

        // Akurasi pengiriman: simple percentage = (1 - abs(keluar - keluar_tercatat)/max(1, keluar_tercatat)) * 100
        // Here we use a simple heuristic: if barangKeluar matches total decremented from stok, we assume high accuracy.
        // For now calculate ratio of successful (status 'selesai') to total pengiriman.
        $totalPengiriman = \App\Models\Pengiriman::count();
        $pengirimanSelesai = \App\Models\Pengiriman::where('status', 'selesai')->count();
        $akurasi = $totalPengiriman > 0 ? round(($pengirimanSelesai / $totalPengiriman) * 100, 1) : 0.0;

        // Pie chart: distribution by kategori from stok table
        $kategoriDistribusi = \App\Models\StokGudangPusat::select('kategori', DB::raw('SUM(jumlah) as total'))
            ->groupBy('kategori')
            ->orderBy('total', 'desc')
            ->get()
            ->map(function ($r) {
                return ['kategori' => $r->kategori ?? 'Unknown', 'total' => (int) $r->total];
            });

        return view('gudang.dashboard', compact(
            'gudang',
            'totalStok',
            'barangMasuk',
            'barangKeluar',
            'akurasi',
            'kategoriDistribusi'
        ));
    }

    public function logout(Request $request)
    {
        Auth::guard('gudang')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('gudang.login');
    }
}
