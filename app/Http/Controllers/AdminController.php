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
                DB::raw('WEEK(tanggal_transaksi, 1) as week'),
                DB::raw('YEAR(tanggal_transaksi) as year'),
                DB::raw('SUM(total_belanja) as total')
            )
            ->whereDate('tanggal_transaksi', '>=', now()->subDays(29))
            ->groupBy('year', 'week')
            ->orderBy('year')
            ->orderBy('week')
            ->get();

        $labels = ['Week 1', 'Week 2', 'Week 3', 'Week 4'];
        $values = [];

        for ($i = 0; $i < 4; $i++) {
            $weekStart = now()->subDays(29)->addWeeks($i);
            $weekNumber = $weekStart->week;
            $year = $weekStart->year;

            $weekData = $data->where('week', $weekNumber)->where('year', $year)->first();
            $values[] = $weekData ? (float) $weekData->total : 0;
        }

        return ['labels' => $labels, 'data' => $values];
    }

    private function getQuarterlyData()
    {
        $data = DB::table('transaksi')
            ->select(
                DB::raw('MONTH(tanggal_transaksi) as month'),
                DB::raw('YEAR(tanggal_transaksi) as year'),
                DB::raw('SUM(total_belanja) as total')
            )
            ->whereDate('tanggal_transaksi', '>=', now()->subDays(89))
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get();

        $labels = [];
        $values = [];

        for ($i = 2; $i >= 0; $i--) {
            $monthDate = now()->subMonths($i);
            $labels[] = $monthDate->format('M Y');

            $monthData = $data->where('month', $monthDate->month)->where('year', $monthDate->year)->first();
            $values[] = $monthData ? (float) $monthData->total : 0;
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

    public function dataKaryawan()
    {
        $karyawan = Karyawan::orderBy('nama', 'asc')->get();

        return view('admin.data-karyawan', compact('karyawan'));
    }

    public function tambahKaryawan()
    {
        return view('admin.tambah-karyawan');
    }

    public function storeKaryawan(Request $request)
    {
        // Debug: Log the incoming request data
        Log::info('Attempting to create karyawan with data:', $request->all());

        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'divisi' => ['required', 'string', 'max:255'],
            'alamat' => ['required', 'string', 'max:500'],
            'email' => ['required', 'email', 'unique:karyawan,email'],
            'tanggal_lahir' => ['required', 'date', 'before:today'],
            'nomer_telepon' => ['required', 'string', 'max:20'],
            'id_shift' => ['required', 'integer', 'min:1'],
        ], [
            'nama.required' => 'Nama karyawan wajib diisi',
            'divisi.required' => 'Divisi wajib diisi',
            'alamat.required' => 'Alamat wajib diisi',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email sudah terdaftar',
            'tanggal_lahir.required' => 'Tanggal lahir wajib diisi',
            'tanggal_lahir.before' => 'Tanggal lahir harus sebelum hari ini',
            'nomer_telepon.required' => 'Nomor telepon wajib diisi',
            'id_shift.required' => 'Shift kerja wajib dipilih',
        ]);

        Log::info('Validation passed, validated data:', $validated);

        try {
            // First, let's check if the karyawan table exists
            $tableExists = DB::select("SHOW TABLES LIKE 'karyawan'");
            if (empty($tableExists)) {
                Log::error('Table karyawan does not exist');
                return back()->withInput()
                    ->with('error', 'Tabel karyawan tidak ditemukan. Silakan jalankan migrasi database.');
            }

            // Check if shift table exists, if not, temporarily disable foreign key checks
            $shiftTableExists = DB::select("SHOW TABLES LIKE 'shift'");

            if (empty($shiftTableExists)) {
                Log::info('Shift table does not exist, creating temporary entry or disabling FK checks');
                // Temporarily disable foreign key checks
                DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            }

            // Create the karyawan record
            $karyawan = new Karyawan();
            $karyawan->nama = $validated['nama'];
            $karyawan->divisi = $validated['divisi'];
            $karyawan->alamat = $validated['alamat'];
            $karyawan->email = $validated['email'];
            $karyawan->tanggal_lahir = $validated['tanggal_lahir'];
            $karyawan->nomer_telepon = $validated['nomer_telepon'];
            $karyawan->id_shift = $validated['id_shift'];

            $result = $karyawan->save();

            Log::info('Karyawan save result:', ['result' => $result, 'id' => $karyawan->id_karyawan]);

            // Re-enable foreign key checks if we disabled them
            if (empty($shiftTableExists)) {
                DB::statement('SET FOREIGN_KEY_CHECKS=1;');
            }

            if ($result) {
                Log::info('Karyawan created successfully with ID: ' . $karyawan->id_karyawan);
                return redirect()->route('admin.data-karyawan')
                    ->with('success', 'Karyawan berhasil ditambahkan! (ID: ' . $karyawan->id_karyawan . ')');
            } else {
                Log::error('Karyawan save returned false');
                return back()->withInput()
                    ->with('error', 'Gagal menyimpan data karyawan. Save method returned false.');
            }
        } catch (\Illuminate\Database\QueryException $e) {
            Log::error('Database error when creating karyawan: ' . $e->getMessage());
            Log::error('SQL State: ' . $e->getCode());

            // Re-enable foreign key checks if we disabled them
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');

            return back()->withInput()
                ->with('error', 'Gagal menambahkan karyawan. Error database: ' . $e->getMessage());
        } catch (\Exception $e) {
            Log::error('General error when creating karyawan: ' . $e->getMessage());
            Log::error('Exception trace: ' . $e->getTraceAsString());

            // Re-enable foreign key checks if we disabled them  
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');

            return back()->withInput()
                ->with('error', 'Gagal menambahkan karyawan. Error: ' . $e->getMessage());
        }
    }
}
