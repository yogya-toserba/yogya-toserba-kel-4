<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Admin;
use App\Models\Karyawan;

class AdminController extends BaseController
{
    public function __construct()
    {
        $this->middleware('auth:admin')->except(['showLogin', 'login']);
    }

    public function showLogin()
    {
        // Regenerate CSRF token untuk menghindari page expired
        if (!session()->has('_token')) {
            session()->regenerateToken();
        }

        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        // Debug untuk mengetahui penyebab page expired
        Log::info('Login attempt initiated', [
            'method' => $request->method(),
            'has_csrf' => $request->hasHeader('X-CSRF-TOKEN') || $request->has('_token'),
            'csrf_token' => $request->header('X-CSRF-TOKEN') ?: $request->get('_token'),
            'session_id' => $request->session()->getId(),
        ]);

        try {
            $credentials = $request->validate([
                'email' => ['required', 'email'],
                'password' => ['required'],
            ]);

            Log::info('Validation passed', ['email' => $credentials['email']]);

            if (Auth::guard('admin')->attempt($credentials, $request->remember)) {
                $request->session()->regenerate();
                Log::info('Login successful', ['email' => $credentials['email']]);
                return redirect()->intended(route('admin.dashboard'));
            }

            Log::warning('Login failed - invalid credentials', ['email' => $credentials['email']]);
            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ])->onlyInput('email');
        } catch (\Exception $e) {
            Log::error('Login error', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return back()->withErrors([
                'email' => 'An error occurred during login. Please try again.',
            ]);
        }
    }

    public function dashboard()
    {
        // Ambil data statistik dari tabel stok_produk saja
        $totalProduk = DB::table('stok_produk')->count();

        // Ambil total stok dari tabel stok_produk
        $totalStok = DB::table('stok_produk')->sum('stok') ?? 0;

        // Ambil transaksi hari ini
        $transaksiHariIni = DB::table('transaksi')
            ->whereDate('tanggal_transaksi', today())
            ->count();

        // Ambil total pendapatan hari ini
        $pendapatanHariIni = DB::table('transaksi')
            ->whereDate('tanggal_transaksi', today())
            ->sum('total_belanja') ?? 0;

        // Ambil total pengguna dari tabel pelanggan saja
        $totalPengguna = DB::table('pelanggan')->count() ?? 0;

        // Default data grafik untuk 7 hari
        $salesChartData = $this->getSalesChartData(7);
        $chartLabels = $salesChartData['labels'];
        $chartData = $salesChartData['data'];

        // Ambil produk terlaris berdasarkan transaksi
        $produkTerlaris = DB::table('detail_transaksi')
            ->join('stok_produk', 'detail_transaksi.id_produk', '=', 'stok_produk.id_produk')
            ->join('kategori', 'stok_produk.id_kategori', '=', 'kategori.id_kategori')
            ->select(
                'stok_produk.nama_barang',
                'kategori.nama_kategori',
                'stok_produk.harga_jual',
                DB::raw('SUM(detail_transaksi.jumlah_barang) as total_terjual'),
                DB::raw('SUM(detail_transaksi.total_harga) as total_pendapatan'),
                DB::raw('COUNT(DISTINCT detail_transaksi.id_transaksi) as jumlah_transaksi')
            )
            ->groupBy('stok_produk.id_produk', 'stok_produk.nama_barang', 'kategori.nama_kategori', 'stok_produk.harga_jual')
            ->orderByDesc('total_terjual')
            ->limit(5)
            ->get();

        // Ambil kategori populer berdasarkan transaksi (tampilkan semua kategori)
        $kategoriPopuler = DB::table('kategori')
            ->leftJoin('stok_produk', 'kategori.id_kategori', '=', 'stok_produk.id_kategori')
            ->leftJoin('detail_transaksi', 'stok_produk.id_produk', '=', 'detail_transaksi.id_produk')
            ->select(
                'kategori.nama_kategori',
                DB::raw('COALESCE(SUM(detail_transaksi.jumlah_barang), 0) as total_terjual'),
                DB::raw('COUNT(DISTINCT detail_transaksi.id_transaksi) as jumlah_transaksi')
            )
            ->groupBy('kategori.id_kategori', 'kategori.nama_kategori')
            ->orderByDesc('total_terjual')
            ->get();

        // Ambil transaksi terbaru
        $transaksiTerbaru = DB::table('transaksi')
            ->join('pelanggan', 'transaksi.id_pelanggan', '=', 'pelanggan.id_pelanggan')
            ->select(
                'transaksi.id_transaksi',
                'transaksi.total_belanja',
                'transaksi.tanggal_transaksi',
                'pelanggan.nama_pelanggan'
            )
            ->orderByDesc('transaksi.tanggal_transaksi')
            ->limit(5)
            ->get();

        // Ambil produk dengan stok menipis
        $stokMenipis = DB::table('stok_produk')
            ->join('kategori', 'stok_produk.id_kategori', '=', 'kategori.id_kategori')
            ->select('stok_produk.nama_barang', 'stok_produk.stok', 'kategori.nama_kategori')
            ->where('stok_produk.stok', '<', 10)
            ->orderBy('stok_produk.stok', 'asc')
            ->limit(5)
            ->get();

        return view('admin.analisis.dashboard', compact(
            'totalProduk',
            'totalStok',
            'transaksiHariIni',
            'pendapatanHariIni',
            'totalPengguna',
            'chartLabels',
            'chartData',
            'produkTerlaris',
            'kategoriPopuler',
            'transaksiTerbaru',
            'stokMenipis'
        ));
    }

    public function dashboardKeuangan()
    {
        // Data keuangan dan transaksi
        $pendapatanHariIni = DB::table('transaksi')
            ->whereDate('tanggal_transaksi', today())
            ->sum('total_belanja') ?? 0;

        $pendapatanBulanIni = DB::table('transaksi')
            ->whereMonth('tanggal_transaksi', now()->month)
            ->whereYear('tanggal_transaksi', now()->year)
            ->sum('total_belanja') ?? 0;

        $pendapatanTahunIni = DB::table('transaksi')
            ->whereYear('tanggal_transaksi', now()->year)
            ->sum('total_belanja') ?? 0;

        $transaksiHariIni = DB::table('transaksi')
            ->whereDate('tanggal_transaksi', today())
            ->count();

        // Chart data untuk keuangan  
        $salesChartData = $this->getSalesChartData(7);
        $chartLabels = $salesChartData['labels'];
        $chartData = $salesChartData['data'];

        // Transaksi terbaru
        $transaksiTerbaru = DB::table('transaksi')
            ->join('pelanggan', 'transaksi.id_pelanggan', '=', 'pelanggan.id_pelanggan')
            ->select('transaksi.*', 'pelanggan.nama_pelanggan')
            ->orderByDesc('transaksi.tanggal_transaksi')
            ->limit(10)
            ->get();

        // Pendapatan per kategori
        $pendapatanKategori = DB::table('kategori')
            ->join('stok_produk', 'kategori.id_kategori', '=', 'stok_produk.id_kategori')
            ->join('detail_transaksi', 'stok_produk.id_produk', '=', 'detail_transaksi.id_produk')
            ->select(
                'kategori.nama_kategori',
                DB::raw('SUM(detail_transaksi.total_harga) as total_pendapatan'),
                DB::raw('COUNT(DISTINCT detail_transaksi.id_transaksi) as jumlah_transaksi')
            )
            ->groupBy('kategori.nama_kategori')
            ->orderByDesc('total_pendapatan')
            ->get();

        return view('admin.analisis.dashboard-keuangan', compact(
            'pendapatanHariIni',
            'pendapatanBulanIni',
            'pendapatanTahunIni',
            'transaksiHariIni',
            'chartLabels',
            'chartData',
            'transaksiTerbaru',
            'pendapatanKategori'
        ));
    }

    public function dashboardPelanggan()
    {
        // Data pelanggan
        $totalPelanggan = DB::table('pelanggan')->count();
        $pelangganBulanIni = DB::table('pelanggan')
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();

        $pelangganAktif = DB::table('pelanggan')
            ->join('transaksi', 'pelanggan.id_pelanggan', '=', 'transaksi.id_pelanggan')
            ->whereDate('transaksi.tanggal_transaksi', '>=', now()->subDays(30))
            ->distinct('pelanggan.id_pelanggan')
            ->count();

        // Pelanggan terbaru
        $pelangganTerbaru = DB::table('pelanggan')
            ->orderByDesc('created_at')
            ->limit(10)
            ->get();

        // Produk terlaris berdasarkan total jumlah yang dibeli
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
            ->limit(10)
            ->get();

        return view('admin.analisis.dashboard-pelanggan', compact(
            'totalPelanggan',
            'pelangganBulanIni',
            'pelangganAktif',
            'pelangganTerbaru',
            'produkTerlaris'
        ));
    }

    public function dashboardBarang()
    {
        // Data barang dan stok
        $totalProduk = DB::table('stok_produk')->count();
        $totalStok = DB::table('stok_produk')->sum('stok') ?? 0;
        $stokMenipis = DB::table('stok_produk')->where('stok', '<', 10)->count();

        // Kategori dengan produk terbanyak
        $kategoriTerbanyak = DB::table('kategori')
            ->join('stok_produk', 'kategori.id_kategori', '=', 'stok_produk.id_kategori')
            ->groupBy('kategori.nama_kategori')
            ->orderByRaw('COUNT(*) DESC')
            ->value('kategori.nama_kategori');

        // Produk dengan stok menipis
        $produkStokMenipis = DB::table('stok_produk')
            ->join('kategori', 'stok_produk.id_kategori', '=', 'kategori.id_kategori')
            ->select('stok_produk.*', 'kategori.nama_kategori')
            ->where('stok_produk.stok', '<', 10)
            ->orderBy('stok_produk.stok', 'asc')
            ->get();

        return view('admin.analisis.dashboard-barang', compact(
            'totalProduk',
            'totalStok',
            'stokMenipis',
            'kategoriTerbanyak',
            'produkStokMenipis'
        ));
    }

    public function dashboardPenjualan()
    {
        // Total transaksi
        $totalTransaksi = DB::table('transaksi')->count();

        // Total pendapatan
        $pendapatan = DB::table('transaksi')
            ->sum('total_belanja') ?? 0;

        // Rata-rata transaksi
        $rataRataTransaksi = $totalTransaksi > 0 ? ($pendapatan / $totalTransaksi) : 0;

        // Barang terlaris (nama saja)
        $barangTerlaris = DB::table('detail_transaksi')
            ->join('stok_produk', 'detail_transaksi.id_produk', '=', 'stok_produk.id_produk')
            ->select('stok_produk.nama_barang', DB::raw('SUM(detail_transaksi.jumlah_barang) as total_terjual'))
            ->groupBy('stok_produk.nama_barang')
            ->orderByDesc('total_terjual')
            ->value('stok_produk.nama_barang');

        // Data barang terlaris untuk table
        $barangTerlarisData = DB::table('detail_transaksi')
            ->join('stok_produk', 'detail_transaksi.id_produk', '=', 'stok_produk.id_produk')
            ->join('kategori', 'stok_produk.id_kategori', '=', 'kategori.id_kategori')
            ->select(
                'stok_produk.nama_barang',
                'kategori.nama_kategori',
                DB::raw('SUM(detail_transaksi.jumlah_barang) as total_terjual'),
                DB::raw('SUM(detail_transaksi.total_harga) as total_pendapatan')
            )
            ->groupBy('stok_produk.nama_barang', 'kategori.nama_kategori')
            ->orderByDesc('total_terjual')
            ->limit(10)
            ->get();

        // Data penjualan harian (7 hari terakhir)
        $penjualanHarian = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i);
            $total = DB::table('transaksi')
                ->whereDate('tanggal_transaksi', $date->format('Y-m-d'))
                ->sum('total_belanja') ?? 0;

            $penjualanHarian[] = [
                'tanggal' => $date->format('d M'),
                'total' => (float) $total
            ];
        }

        return view('admin.analisis.dashboard-penjualan', compact(
            'totalTransaksi',
            'pendapatan',
            'rataRataTransaksi',
            'barangTerlaris',
            'barangTerlarisData',
            'penjualanHarian'
        ));
    }

    public function getChartData(Request $request)
    {
        try {
            $period = $request->get('period', 7);

            // Query data berdasarkan periode
            switch ($period) {
                case 7:
                    $data = $this->getWeeklyData();
                    break;
                case 30:
                    $data = $this->getMonthlyData();
                    break;
                case 90:
                    $data = $this->getQuarterlyData();
                    break;
                case 365:
                    $data = $this->getYearlyData();
                    break;
                default:
                    $data = $this->getWeeklyData();
            }

            return response()->json([
                'success' => true,
                'labels' => $data['labels'],
                'data' => $data['data']
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal memuat data grafik: ' . $e->getMessage()
            ], 500);
        }
    }

    private function getWeeklyData()
    {
        $data = DB::table('transaksi')
            ->select(
                DB::raw('DATE(tanggal_transaksi) as date'),
                DB::raw('SUM(total_belanja) as total')
            )
            ->whereDate('tanggal_transaksi', '>=', now()->subDays(6))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $labels = [];
        $values = [];

        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i);
            $dateString = $date->format('Y-m-d');
            $labels[] = $date->format('j M');

            $dayData = $data->where('date', $dateString)->first();
            $values[] = $dayData ? (float) $dayData->total : 0;
        }

        return ['labels' => $labels, 'data' => $values];
    }

    private function getMonthlyData()
    {
        $data = DB::table('transaksi')
            ->select(
                DB::raw('DATE(tanggal_transaksi) as date'),
                DB::raw('SUM(total_belanja) as total')
            )
            ->whereDate('tanggal_transaksi', '>=', now()->subDays(29))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $labels = [];
        $values = [];

        for ($i = 29; $i >= 0; $i--) {
            $date = now()->subDays($i);
            $dateString = $date->format('Y-m-d');

            if ($i % 3 == 0) { // Show every 3rd day to avoid crowding
                $labels[] = $date->format('j M');
            } else {
                $labels[] = '';
            }

            $dayData = $data->where('date', $dateString)->first();
            $values[] = $dayData ? (float) $dayData->total : 0;
        }

        return ['labels' => $labels, 'data' => $values];
    }

    private function getQuarterlyData()
    {
        $data = DB::table('transaksi')
            ->select(
                DB::raw('DATE(tanggal_transaksi) as date'),
                DB::raw('SUM(total_belanja) as total')
            )
            ->whereDate('tanggal_transaksi', '>=', now()->subDays(89))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $labels = [];
        $values = [];

        for ($i = 89; $i >= 0; $i--) {
            $date = now()->subDays($i);
            $dateString = $date->format('Y-m-d');

            if ($i % 7 == 0) { // Show every week to avoid crowding
                $labels[] = $date->format('j M');
            } else {
                $labels[] = '';
            }

            $dayData = $data->where('date', $dateString)->first();
            $values[] = $dayData ? (float) $dayData->total : 0;
        }

        return ['labels' => $labels, 'data' => $values];
    }

    private function getYearlyData()
    {
        $data = DB::table('transaksi')
            ->select(
                DB::raw('QUARTER(tanggal_transaksi) as quarter'),
                DB::raw('YEAR(tanggal_transaksi) as year'),
                DB::raw('SUM(total_belanja) as total')
            )
            ->whereDate('tanggal_transaksi', '>=', now()->subYear())
            ->groupBy('year', 'quarter')
            ->orderBy('year')
            ->orderBy('quarter')
            ->get();

        $labels = ['Q1 2025', 'Q2 2025', 'Q3 2025', 'Q4 2025'];
        $values = [];

        for ($quarter = 1; $quarter <= 4; $quarter++) {
            $quarterData = $data->where('quarter', $quarter)->where('year', 2025)->first();
            $values[] = $quarterData ? (float) $quarterData->total : 0;
        }

        return ['labels' => $labels, 'data' => $values];
    }

    public function getSalesData(Request $request)
    {
        try {
            $days = $request->get('days', 7);

            // Debug: Log the request
            Log::info('Sales data requested for days: ' . $days);

            $chartData = $this->getSalesChartData($days);

            return response()->json([
                'success' => true,
                'labels' => $chartData['labels'],
                'data' => $chartData['data'],
                'debug' => [
                    'days' => $days,
                    'labels_count' => count($chartData['labels']),
                    'data_count' => count($chartData['data'])
                ]
            ]);
        } catch (\Exception $e) {
            Log::error('Sales data error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Gagal memuat data grafik: ' . $e->getMessage(),
                'error' => $e->getMessage()
            ], 500);
        }
    }

    private function getSalesChartData($days)
    {
        // Ambil data grafik penjualan berdasarkan jumlah hari
        $salesData = DB::table('transaksi')
            ->select(
                DB::raw('DATE(tanggal_transaksi) as date'),
                DB::raw('SUM(total_belanja) as total'),
                DB::raw('COUNT(*) as transaction_count')
            )
            ->whereDate('tanggal_transaksi', '>=', now()->subDays($days - 1))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // Prepare data untuk grafik (pastikan ada semua hari)
        $chartLabels = [];
        $chartData = [];

        for ($i = $days - 1; $i >= 0; $i--) {
            $date = now()->subDays($i);
            $dateString = $date->format('Y-m-d');

            // Format label berdasarkan periode
            if ($days <= 7) {
                $chartLabels[] = $date->format('j M'); // "27 Agu"
            } elseif ($days <= 30) {
                $chartLabels[] = $date->format('j/n'); // "27/8"
            } else {
                $chartLabels[] = $date->format('j/n'); // "27/8"
            }

            $dayData = $salesData->where('date', $dateString)->first();
            $chartData[] = $dayData ? round($dayData->total / 1000, 1) : 0; // Convert to thousands
        }

        return [
            'labels' => $chartLabels,
            'data' => $chartData
        ];
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }

    public function profile()
    {
        $admin = Auth::guard('admin')->user();
        return view('admin.sistem.profile', compact('admin'));
    }

    public function updateProfile(Request $request)
    {
        try {
            $admin = Auth::guard('admin')->user();

            if (!$admin) {
                return redirect()->route('admin.login')->with('error', 'Please login first.');
            }

            $request->validate([
                'name' => 'required|string|max:255',
                'username' => 'required|string|max:255|unique:admin,username,' . $admin->id,
                'email' => 'required|email|max:255|unique:admin,email,' . $admin->id,
                'phone' => 'nullable|string|max:20',
                'position' => 'nullable|string|max:100',
                'bio' => 'nullable|string|max:500',
                'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'current_password' => 'nullable|required_with:new_password',
                'new_password' => 'nullable|min:8|confirmed',
            ]);

            // Handle avatar upload
            if ($request->hasFile('avatar')) {
                // Create uploads directory if it doesn't exist
                $uploadsDir = public_path('uploads/avatars');
                if (!file_exists($uploadsDir)) {
                    mkdir($uploadsDir, 0755, true);
                }

                // Delete old avatar if exists
                if ($admin->avatar && file_exists(public_path('uploads/avatars/' . $admin->avatar))) {
                    unlink(public_path('uploads/avatars/' . $admin->avatar));
                }

                $avatar = $request->file('avatar');
                $avatarName = time() . '_' . $admin->id . '.' . $avatar->getClientOriginalExtension();
                $avatar->move($uploadsDir, $avatarName);
                $admin->avatar = $avatarName;
            }

            // Update basic information
            $admin->name = $request->name;
            $admin->username = $request->username ?? $admin->username;
            $admin->email = $request->email;
            $admin->phone = $request->phone;
            $admin->position = $request->position ?? 'Administrator';
            $admin->bio = $request->bio;

            // Update password if provided
            if ($request->filled('current_password')) {
                if (!Hash::check($request->current_password, $admin->password)) {
                    return back()->withErrors(['current_password' => 'Password saat ini tidak sesuai']);
                }

                if ($request->filled('new_password')) {
                    $admin->password = Hash::make($request->new_password);
                }
            }

            // Save the admin model using query builder to avoid model issues
            DB::table('admin')
                ->where('id', $admin->id)
                ->update([
                    'name' => $admin->name,
                    'username' => $admin->username,
                    'email' => $admin->email,
                    'phone' => $admin->phone,
                    'position' => $admin->position,
                    'bio' => $admin->bio,
                    'avatar' => $admin->avatar,
                    'password' => $admin->password,
                    'updated_at' => now(),
                ]);

            return redirect()->route('admin.profile')
                ->with('success', 'Profile berhasil diperbarui!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            Log::error('Profile update error: ' . $e->getMessage());
            return back()->with('error', 'Gagal memperbarui profile: ' . $e->getMessage())->withInput();
        }
    }

    public function dataKaryawan(Request $request)
    {
        $query = Karyawan::query();

        // Filter berdasarkan search
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', '%' . $search . '%')
                    ->orWhere('divisi', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%');
            });
        }

        // Filter berdasarkan department
        if ($request->has('department') && $request->department) {
            $query->where('divisi', $request->department);
        }

        // Filter berdasarkan status
        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }

        // Pagination dengan 10 data per halaman
        $karyawan = $query->orderBy('nama', 'asc')->paginate(10);

        // Jika AJAX request, return JSON response
        if ($request->ajax()) {
            return response()->json([
                'karyawan' => $karyawan->items(),
                'pagination' => [
                    'current_page' => $karyawan->currentPage(),
                    'last_page' => $karyawan->lastPage(),
                    'per_page' => $karyawan->perPage(),
                    'total' => $karyawan->total(),
                    'from' => $karyawan->firstItem(),
                    'to' => $karyawan->lastItem()
                ]
            ]);
        }

        // Ambil daftar divisi untuk filter
        $divisiList = Karyawan::distinct('divisi')->pluck('divisi')->sort();

        // Ambil data shift untuk form
        $shiftList = DB::table('shift')->select('id_shift', 'nama_shift', 'jam_mulai', 'jam_selesai')->get();

        // Statistik untuk cards
        $totalKaryawan = Karyawan::count();
        $karyawanAktif = Karyawan::where('status', 'Aktif')->count();
        $totalDepartemen = Karyawan::distinct('divisi')->count();
        $hadirHariIni = $karyawanAktif; // Simulasi hadir hari ini

        // Distribusi departemen real dengan pagination
        $distribusiDepartemen = Karyawan::select('divisi', DB::raw('count(*) as jumlah'))
            ->groupBy('divisi')
            ->orderBy('jumlah', 'desc')
            ->paginate(5, ['*'], 'dept_page');

        return view('admin.karyawan.data-karyawan', compact(
            'karyawan',
            'divisiList',
            'shiftList',
            'totalKaryawan',
            'karyawanAktif',
            'totalDepartemen',
            'hadirHariIni',
            'distribusiDepartemen'
        ));
    }

    public function toggleKaryawanStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Aktif,Non-Aktif'
        ]);

        $karyawan = Karyawan::findOrFail($id);
        $karyawan->status = $request->status;
        $karyawan->save();

        return response()->json([
            'success' => true,
            'message' => "Status karyawan berhasil diubah menjadi {$request->status}",
            'data' => [
                'id_karyawan' => $karyawan->id_karyawan,
                'nama' => $karyawan->nama,
                'status' => $karyawan->status
            ]
        ]);
    }

    public function searchKaryawan(Request $request)
    {
        $query = Karyawan::query();

        // Filter berdasarkan search
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', '%' . $search . '%')
                    ->orWhere('divisi', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%');
            });
        }

        // Filter berdasarkan divisi
        if ($request->has('divisi') && $request->divisi) {
            $query->where('divisi', $request->divisi);
        }

        // Pagination dengan 10 data per halaman
        $karyawan = $query->orderBy('nama', 'asc')->paginate(10);

        // Return partial view untuk AJAX
        if ($request->ajax()) {
            return response()->json([
                'html' => view('admin.partials.karyawan-table', compact('karyawan'))->render(),
                'pagination' => view('admin.partials.karyawan-pagination', compact('karyawan'))->render()
            ]);
        }

        return redirect()->route('admin.data-karyawan');
    }

    public function tambahKaryawan()
    {
        $shifts = \App\Models\Shift::all();
        return view('admin.karyawan.tambah-karyawan', compact('shifts'));
    }

    public function storeKaryawan(Request $request)
    {
        try {
            // Validate request data
            $validated = $request->validate([
                'nama' => ['required', 'string', 'max:255'],
                'divisi' => ['required', 'string', 'max:255'],
                'alamat' => ['required', 'string', 'max:500'],
                'email' => ['required', 'email', 'unique:karyawan,email'],
                'tanggal_lahir' => ['required', 'date', 'before:today'],
                'nomer_telepon' => ['required', 'string', 'regex:/^08\d{8,11}$/'],
                'foto' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
                'id_shift' => ['required', 'integer', 'exists:shift,id_shift'],
                'status' => ['required', 'in:Aktif,Non-Aktif']
            ], [
                'nama.required' => 'Nama karyawan wajib diisi',
                'nama.max' => 'Nama karyawan maksimal 255 karakter',
                'divisi.required' => 'Divisi wajib diisi',
                'divisi.max' => 'Divisi maksimal 255 karakter',
                'alamat.required' => 'Alamat wajib diisi',
                'alamat.max' => 'Alamat maksimal 500 karakter',
                'email.required' => 'Email wajib diisi',
                'email.email' => 'Format email tidak valid',
                'email.unique' => 'Email sudah terdaftar, gunakan email lain',
                'tanggal_lahir.required' => 'Tanggal lahir wajib diisi',
                'tanggal_lahir.before' => 'Tanggal lahir harus sebelum hari ini',
                'nomer_telepon.required' => 'Nomor telepon wajib diisi',
                'nomer_telepon.regex' => 'Nomor telepon harus dimulai dengan 08 dan terdiri dari 10-13 digit',
                'foto.image' => 'File harus berupa gambar',
                'foto.mimes' => 'Format foto harus jpeg, png, jpg, atau gif',
                'foto.max' => 'Ukuran foto maksimal 2MB',
                'id_shift.required' => 'Shift kerja wajib dipilih',
                'id_shift.integer' => 'Shift kerja tidak valid',
                'id_shift.exists' => 'Shift yang dipilih tidak tersedia',
                'status.required' => 'Status karyawan wajib dipilih',
                'status.in' => 'Status harus Aktif atau Non-Aktif'
            ]);

            // Additional age validation (minimum 17 years old)
            $birthDate = new \DateTime($validated['tanggal_lahir']);
            $today = new \DateTime();
            $age = $today->diff($birthDate)->y;

            if ($age < 17) {
                if ($request->expectsJson()) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Karyawan harus berusia minimal 17 tahun',
                        'errors' => [
                            'tanggal_lahir' => ['Karyawan harus berusia minimal 17 tahun']
                        ]
                    ], 422);
                }
                return back()->withInput()->withErrors([
                    'tanggal_lahir' => 'Karyawan harus berusia minimal 17 tahun'
                ]);
            }

            // Handle foto upload
            $fotoPath = null;
            if ($request->hasFile('foto')) {
                $foto = $request->file('foto');
                $fotoName = time() . '_' . $foto->getClientOriginalName();
                $fotoPath = $foto->storeAs('karyawan', $fotoName, 'public');
            }

            // Create the karyawan record
            $karyawan = Karyawan::create([
                'nama' => $validated['nama'],
                'divisi' => $validated['divisi'],
                'alamat' => $validated['alamat'],
                'email' => $validated['email'],
                'tanggal_lahir' => $validated['tanggal_lahir'],
                'nomer_telepon' => $validated['nomer_telepon'],
                'foto' => $fotoPath,
                'id_shift' => $validated['id_shift'],
                'status' => $validated['status']
            ]);

            // Return appropriate response based on request type
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Karyawan berhasil ditambahkan',
                    'data' => [
                        'id_karyawan' => $karyawan->id_karyawan,
                        'nama' => $karyawan->nama,
                        'divisi' => $karyawan->divisi,
                        'email' => $karyawan->email,
                        'status' => $karyawan->status,
                        'created_at' => $karyawan->created_at
                    ]
                ], 201);
            }

            return redirect()->route('admin.data-karyawan')
                ->with('success', 'Karyawan berhasil ditambahkan!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data tidak valid',
                    'errors' => $e->errors()
                ], 422);
            }
            throw $e;
        } catch (\Exception $e) {
            Log::error('Error creating karyawan: ' . $e->getMessage());

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Terjadi kesalahan saat menyimpan data'
                ], 500);
            }

            return back()->withInput()
                ->with('error', 'Gagal menambahkan karyawan: ' . $e->getMessage());
        }
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        if (!$query || strlen($query) < 2) {
            return response()->json(['results' => [], 'hasMore' => false]);
        }

        $results = [];
        $limit = 5; // Limit untuk quick search

        try {
            // Search Produk
            $produk = DB::table('stok_produk')
                ->join('kategori', 'stok_produk.id_kategori', '=', 'kategori.id_kategori')
                ->where('stok_produk.nama_barang', 'LIKE', "%{$query}%")
                ->select('stok_produk.*', 'kategori.nama_kategori')
                ->limit($limit)
                ->get();

            foreach ($produk as $item) {
                $results[] = [
                    'type' => 'produk',
                    'title' => $item->nama_barang,
                    'subtitle' => "Kategori: {$item->nama_kategori} • Stok: {$item->stok} • Rp " . number_format($item->harga_jual),
                    'url' => route('admin.dashboard')
                ];
            }

            // Search Pelanggan
            $pelanggan = DB::table('pelanggan')
                ->where('nama_pelanggan', 'LIKE', "%{$query}%")
                ->orWhere('email', 'LIKE', "%{$query}%")
                ->limit($limit)
                ->get();

            foreach ($pelanggan as $item) {
                $results[] = [
                    'type' => 'pelanggan',
                    'title' => $item->nama_pelanggan,
                    'subtitle' => "Email: {$item->email} • Telp: {$item->nomer_telepon}",
                    'url' => route('admin.analisis.pelanggan')
                ];
            }

            // Search Transaksi berdasarkan ID atau tanggal
            $transaksi = DB::table('transaksi')
                ->join('pelanggan', 'transaksi.id_pelanggan', '=', 'pelanggan.id_pelanggan')
                ->where('transaksi.id_transaksi', 'LIKE', "%{$query}%")
                ->orWhere('pelanggan.nama_pelanggan', 'LIKE', "%{$query}%")
                ->select('transaksi.*', 'pelanggan.nama_pelanggan')
                ->limit($limit)
                ->get();

            foreach ($transaksi as $item) {
                $results[] = [
                    'type' => 'transaksi',
                    'title' => "Transaksi #{$item->id_transaksi}",
                    'subtitle' => "{$item->nama_pelanggan} • " . date('d M Y', strtotime($item->tanggal_transaksi)) . " • Rp " . number_format($item->total_belanja),
                    'url' => route('admin.analisis.penjualan')
                ];
            }

            // Search Kategori
            $kategori = DB::table('kategori')
                ->where('nama_kategori', 'LIKE', "%{$query}%")
                ->limit($limit)
                ->get();

            foreach ($kategori as $item) {
                $results[] = [
                    'type' => 'kategori',
                    'title' => $item->nama_kategori,
                    'subtitle' => "Kategori produk",
                    'url' => route('admin.analisis.barang')
                ];
            }

            // Batasi total hasil untuk quick search
            $results = array_slice($results, 0, 8);

            return response()->json([
                'results' => $results,
                'hasMore' => count($results) >= 8
            ]);
        } catch (\Exception $e) {
            Log::error('Search error: ' . $e->getMessage());
            return response()->json(['results' => [], 'hasMore' => false, 'error' => 'Search failed']);
        }
    }

    public function searchResults(Request $request)
    {
        $query = $request->input('q');

        if (!$query) {
            return redirect()->route('admin.dashboard');
        }

        $results = [
            'produk' => [],
            'pelanggan' => [],
            'transaksi' => [],
            'kategori' => []
        ];

        try {
            // Search semua produk
            $results['produk'] = DB::table('stok_produk')
                ->join('kategori', 'stok_produk.id_kategori', '=', 'kategori.id_kategori')
                ->where('stok_produk.nama_barang', 'LIKE', "%{$query}%")
                ->select('stok_produk.*', 'kategori.nama_kategori')
                ->paginate(20);

            // Search semua pelanggan
            $results['pelanggan'] = DB::table('pelanggan')
                ->where('nama_pelanggan', 'LIKE', "%{$query}%")
                ->orWhere('email', 'LIKE', "%{$query}%")
                ->paginate(20);

            // Search semua transaksi
            $results['transaksi'] = DB::table('transaksi')
                ->join('pelanggan', 'transaksi.id_pelanggan', '=', 'pelanggan.id_pelanggan')
                ->where('transaksi.id_transaksi', 'LIKE', "%{$query}%")
                ->orWhere('pelanggan.nama_pelanggan', 'LIKE', "%{$query}%")
                ->select('transaksi.*', 'pelanggan.nama_pelanggan')
                ->paginate(20);

            // Search semua kategori
            $results['kategori'] = DB::table('kategori')
                ->where('nama_kategori', 'LIKE', "%{$query}%")
                ->paginate(20);
        } catch (\Exception $e) {
            Log::error('Detailed search error: ' . $e->getMessage());
        }

        return view('admin.sistem.search-results', compact('query', 'results'));
    }

    public function pengaturan()
    {
        $admin = Auth::guard('admin')->user();
        return view('admin.sistem.pengaturan', compact('admin'));
    }

    public function updatePengaturan(Request $request)
    {
        try {
            $admin = Auth::guard('admin')->user();

            $request->validate([
                'system_name' => 'nullable|string|max:255',
                'company_name' => 'nullable|string|max:255',
                'company_address' => 'nullable|string|max:500',
                'company_phone' => 'nullable|string|max:20',
                'company_email' => 'nullable|email|max:255',
                'timezone' => 'nullable|string|max:50',
                'currency' => 'nullable|string|max:10',
                'language' => 'nullable|string|max:10',
            ]);

            // Update sistem settings
            // Untuk sekarang kita hanya redirect dengan success message
            return redirect()->route('admin.pengaturan')
                ->with('success', 'Pengaturan berhasil diperbarui.');
        } catch (\Exception $e) {
            Log::error('Error updating settings: ' . $e->getMessage());
            return redirect()->route('admin.pengaturan')
                ->with('error', 'Terjadi kesalahan saat memperbarui pengaturan.');
        }
    }

    public function daftarPengguna()
    {
        try {
            // Ambil data pelanggan dari database
            $pelanggan = DB::table('pelanggan')
                ->select('id', 'nama', 'email', 'telepon', 'alamat', 'created_at')
                ->orderBy('created_at', 'desc')
                ->paginate(20);

            // Statistik pengguna
            $totalPengguna = DB::table('pelanggan')->count();
            $penggunaBulanIni = DB::table('pelanggan')
                ->whereMonth('created_at', now()->month)
                ->whereYear('created_at', now()->year)
                ->count();
            $penggunaAktif = DB::table('pelanggan')
                ->where('updated_at', '>=', now()->subDays(30))
                ->count();

            return view('admin.sistem.daftar-pengguna', compact(
                'pelanggan',
                'totalPengguna',
                'penggunaBulanIni',
                'penggunaAktif'
            ));
        } catch (\Exception $e) {
            Log::error('Error loading daftar pengguna: ' . $e->getMessage());
            return redirect()->route('admin.dashboard')
                ->with('error', 'Terjadi kesalahan saat memuat data pengguna.');
        }
    }
}
