<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::guard('admin')->attempt($credentials, $request->remember)) {
            $request->session()->regenerate();
            return redirect()->intended(route('admin.dashboard'));
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
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

        return view('admin.dashboard', compact(
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

        return view('admin.dashboard-keuangan', compact(
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

        return view('admin.dashboard-pelanggan', compact(
            'totalPelanggan',
            'pelangganBulanIni',
            'pelangganAktif',
            'pelangganTerbaru'
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

        return view('admin.dashboard-barang', compact(
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

        return view('admin.dashboard-penjualan', compact(
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
        return view('admin.profile', [
            'admin' => Auth::guard('admin')->user()
        ]);
    }

    public function updateProfile(Request $request)
    {
        /** @var Admin $admin */
        $admin = Auth::guard('admin')->user();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:admins,email,' . $admin->id],
            'password' => ['nullable', 'min:8', 'confirmed'],
        ]);

        $admin->name = $validated['name'];
        $admin->email = $validated['email'];

        if (!empty($validated['password'])) {
            $admin->password = bcrypt($validated['password']);
        }

        $admin->save();

        return back()->with('status', 'Profile updated successfully');
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

        return view('admin.data-karyawan', compact(
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
        return view('admin.tambah-karyawan');
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

            // Create the karyawan record
            $karyawan = Karyawan::create([
                'nama' => $validated['nama'],
                'divisi' => $validated['divisi'],
                'alamat' => $validated['alamat'],
                'email' => $validated['email'],
                'tanggal_lahir' => $validated['tanggal_lahir'],
                'nomer_telepon' => $validated['nomer_telepon'],
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
}
