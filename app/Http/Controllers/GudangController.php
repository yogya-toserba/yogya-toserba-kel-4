<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
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

    public function permintaan()
    {
        // Ambil semua data permintaan dari session
        $allPermintaan = session('all_permintaan', []);

        // Debug logging
        Log::info('Displaying permintaan page:', ['count' => count($allPermintaan)]);

        return view('gudang.permintaan', compact('allPermintaan'));
    }

    public function submitPermintaan(Request $request)
    {
        Log::info('=== SUBMIT PERMINTAAN START ===');
        Log::info('All request data: ', $request->all());

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

        Log::info('Validation SUCCESS - validated data: ', $validated);

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

        Log::info('Permintaan data prepared: ', $permintaanData);

        // Ambil data permintaan yang sudah ada dari session atau buat array kosong
        $existingPermintaan = session('all_permintaan', []);
        Log::info('Existing permintaan before add: ', ['count' => count($existingPermintaan)]);

        // Tambahkan permintaan baru ke array
        $existingPermintaan[] = $permintaanData;

        // Simpan kembali ke session
        session(['all_permintaan' => $existingPermintaan]);

        // Verify data was saved
        $verifySession = session('all_permintaan', []);
        Log::info('Session verification: ', [
            'count' => count($verifySession),
            'last_item' => end($verifySession)
        ]);

        Log::info('=== SUBMIT PERMINTAAN END SUCCESS ===');

        // Return JSON response untuk AJAX
        return response()->json([
            'success' => true,
            'message' => 'Permintaan berhasil dikirim ke gudang pusat!',
            'data' => $permintaanData,
            'total_count' => count($existingPermintaan)
        ]);
    }

    public function inventoriDashboard()
    {
        $gudang = Auth::guard('gudang')->user();
        return view('gudang.inventori.dashboard', compact('gudang'));
    }

    public function permintaanInventori()
    {
        return view('gudang.inventori.permintaan_inventori');
    }

    public function stokInventori()
    {
        return view('gudang.inventori.stok');
    }

    // Method untuk mendapatkan notifikasi permintaan baru
    public function getNotifications()
    {
        $allPermintaan = session('all_permintaan', []);
        $notifications = [];

        // Ambil permintaan dengan status 'Menunggu' (baru masuk)
        foreach ($allPermintaan as $permintaan) {
            if ($permintaan['status'] === 'Menunggu') {
                $notifications[] = [
                    'id' => $permintaan['id_permintaan'],
                    'title' => 'Permintaan Inventori Baru',
                    'message' => "Permintaan dari {$permintaan['nama_cabang']} dengan {$permintaan['total_items']} item",
                    'type' => 'info',
                    'priority' => $permintaan['prioritas'],
                    'time' => $permintaan['waktu'],
                    'url' => route('gudang.permintaan')
                ];
            }
        }

        return response()->json([
            'notifications' => $notifications,
            'count' => count($notifications)
        ]);
    }

    // Method untuk menandai notifikasi sebagai sudah dibaca
    public function markNotificationRead(Request $request)
    {
        $permintaanId = $request->input('id');
        $allPermintaan = session('all_permintaan', []);

        // Update status permintaan menjadi 'Dilihat'
        foreach ($allPermintaan as $key => $permintaan) {
            if ($permintaan['id_permintaan'] === $permintaanId) {
                $allPermintaan[$key]['status'] = 'Dilihat';
                break;
            }
        }

        session(['all_permintaan' => $allPermintaan]);

        return response()->json(['success' => true]);
    }

    // Method untuk terima permintaan
    public function terimaPermintaan(Request $request)
    {
        $permintaanId = $request->input('permintaan_id');
        $index = $request->input('index');

        $allPermintaan = session('all_permintaan', []);

        if (isset($allPermintaan[$index]) && $allPermintaan[$index]['id_permintaan'] === $permintaanId) {
            $allPermintaan[$index]['status'] = 'Siap Kirim';
            session(['all_permintaan' => $allPermintaan]);

            return response()->json([
                'success' => true,
                'message' => 'Permintaan berhasil diterima dan siap untuk dikirim'
            ]);
        }

        return response()->json(['success' => false, 'message' => 'Permintaan tidak ditemukan']);
    }

    // Method untuk tolak permintaan
    public function tolakPermintaan(Request $request)
    {
        $permintaanId = $request->input('permintaan_id');
        $index = $request->input('index');

        $allPermintaan = session('all_permintaan', []);

        if (isset($allPermintaan[$index]) && $allPermintaan[$index]['id_permintaan'] === $permintaanId) {
            $allPermintaan[$index]['status'] = 'Ditolak';
            session(['all_permintaan' => $allPermintaan]);

            return response()->json([
                'success' => true,
                'message' => 'Permintaan berhasil ditolak'
            ]);
        }

        return response()->json(['success' => false, 'message' => 'Permintaan tidak ditemukan']);
    }

    // Method untuk kirim permintaan ke pengiriman
    public function kirimPermintaan(Request $request)
    {
        $permintaanId = $request->input('permintaan_id');
        $index = $request->input('index');

        $allPermintaan = session('all_permintaan', []);

        if (isset($allPermintaan[$index]) && $allPermintaan[$index]['id_permintaan'] === $permintaanId) {
            $permintaan = $allPermintaan[$index];

            // Cek apakah sudah diterima
            if ($permintaan['status'] !== 'Siap Kirim') {
                return response()->json([
                    'success' => false,
                    'message' => 'Permintaan harus diterima terlebih dahulu sebelum dapat dikirim'
                ]);
            }

            // Buat data pengiriman
            $pengirimanData = [
                'id_pengiriman' => 'PGR-' . date('Ymd') . '-' . str_pad(rand(1, 9999), 4, '0', STR_PAD_LEFT),
                'no_permintaan' => $permintaan['id_permintaan'],
                'produk' => $this->formatProdukList($permintaan['produk_list']),
                'tujuan' => $permintaan['nama_cabang'],
                'tanggal_kirim' => date('Y-m-d H:i:s'),
                'status' => 'Siap Kirim',
                'total_items' => $permintaan['total_items'],
                'penanggung_jawab' => $permintaan['penanggung_jawab'],
                'prioritas' => $permintaan['prioritas'],
                'catatan' => $permintaan['catatan_umum'] ?? ''
            ];

            // Simpan ke session pengiriman
            $allPengiriman = session('all_pengiriman', []);
            $allPengiriman[] = $pengirimanData;
            session(['all_pengiriman' => $allPengiriman]);

            // Update status permintaan menjadi Dikirim
            $allPermintaan[$index]['status'] = 'Dikirim';
            $allPermintaan[$index]['tanggal_dikirim'] = date('Y-m-d H:i:s');
            session(['all_permintaan' => $allPermintaan]);

            return response()->json([
                'success' => true,
                'message' => 'Permintaan berhasil dikirim ke bagian pengiriman',
                'pengiriman_id' => $pengirimanData['id_pengiriman']
            ]);
        }

        return response()->json(['success' => false, 'message' => 'Permintaan tidak ditemukan']);
    }

    // Helper method untuk format produk list
    private function formatProdukList($produkList)
    {
        if (is_array($produkList) && count($produkList) > 0) {
            $formatted = [];
            foreach ($produkList as $produk) {
                $formatted[] = $produk['nama_barang'] . ' (' . $produk['jumlah'] . ' ' . $produk['satuan'] . ')';
            }
            return implode(', ', $formatted);
        }
        return 'N/A';
    }

    /**
     * Display data pengawai gudang
     */
    public function dataPengawaiGudang()
    {
        // Ambil data karyawan yang bekerja di gudang
        $pengawaiGudang = DB::table('karyawan')
            ->leftJoin('jabatan', 'karyawan.jabatan_id', '=', 'jabatan.id')
            ->leftJoin('cabang', 'karyawan.cabang_id', '=', 'cabang.id_cabang')
            ->select(
                'karyawan.*',
                'jabatan.nama_jabatan',
                'jabatan.gaji_pokok',
                'cabang.nama_cabang'
            )
            ->where('karyawan.divisi', 'LIKE', '%gudang%')
            ->orWhere('jabatan.nama_jabatan', 'LIKE', '%gudang%')
            ->orWhere('karyawan.divisi', 'LIKE', '%warehouse%')
            ->orWhere('karyawan.divisi', 'LIKE', '%logistik%')
            ->where('karyawan.status', 'aktif')
            ->orderBy('karyawan.nama')
            ->get();

        // Statistik pengawai gudang
        $stats = [
            'total_pengawai' => $pengawaiGudang->count(),
            'pengawai_aktif' => $pengawaiGudang->where('status', 'aktif')->count(),
            'rata_rata_gaji' => $pengawaiGudang->avg('gaji_pokok'),
            'total_gaji' => $pengawaiGudang->sum('gaji_pokok')
        ];

        // Grouping by jabatan
        $pengawaiByJabatan = $pengawaiGudang->groupBy('nama_jabatan')->map(function ($items, $jabatan) {
            return [
                'jabatan' => $jabatan ?: 'Belum ada jabatan',
                'jumlah' => $items->count(),
                'rata_gaji' => $items->avg('gaji_pokok')
            ];
        });

        return view('admin.gudang.data-pengawai-gudang', compact(
            'pengawaiGudang',
            'stats',
            'pengawaiByJabatan'
        ));
    }

    /**
     * Display lokasi gudang
     */
    public function lokasiGudang()
    {
        // Ambil data gudang dari database
        $gudangList = DB::table('gudang')
            ->leftJoin('cabang', 'gudang.id_cabang', '=', 'cabang.id_cabang')
            ->select(
                'gudang.*',
                'cabang.nama_cabang',
                'cabang.alamat as alamat_cabang'
            )
            ->orderBy('gudang.nama_gudang')
            ->get();

        // Statistik gudang
        $stats = [
            'total_gudang' => $gudangList->count(),
            'gudang_aktif' => $gudangList->where('status', 'aktif')->count(),
            'gudang_nonaktif' => $gudangList->where('status', 'nonaktif')->count(),
            'kapasitas_total' => $gudangList->sum('kapasitas')
        ];

        // Grouping by cabang
        $gudangByCabang = $gudangList->groupBy('nama_cabang')->map(function ($items, $cabang) {
            return [
                'cabang' => $cabang ?: 'Pusat',
                'jumlah' => $items->count(),
                'kapasitas_total' => $items->sum('kapasitas'),
                'gudang_aktif' => $items->where('status', 'aktif')->count()
            ];
        });

        return view('admin.gudang.lokasi-gudang', compact(
            'gudangList',
            'stats',
            'gudangByCabang'
        ));
    }

    public function dataBarang()
    {
        // Mengambil data produk dan stok gudang
        $produkList = DB::table('produk')
            ->leftJoin('stok_produk', 'produk.id_produk', '=', 'stok_produk.id_produk')
            ->leftJoin('kategori', 'produk.id_kategori', '=', 'kategori.id_kategori')
            ->select(
                'produk.*',
                'stok_produk.stok',
                'stok_produk.stok_minimum',
                'kategori.nama_kategori'
            )
            ->get();

        // Statistik produk
        $stats = [
            'total_produk' => $produkList->count(),
            'produk_stok_habis' => $produkList->where('stok', '<=', 0)->count(),
            'produk_stok_minimum' => $produkList->where('stok', '<=', DB::raw('stok_minimum'))->count(),
            'total_nilai_stok' => $produkList->sum(function ($item) {
                return $item->stok * $item->harga_jual;
            })
        ];

        // Grouping by kategori
        $produkByKategori = $produkList->groupBy('nama_kategori')->map(function ($items, $kategori) {
            return [
                'kategori' => $kategori ?: 'Tidak Terkategori',
                'jumlah' => $items->count(),
                'total_stok' => $items->sum('stok'),
                'nilai_stok' => $items->sum(function ($item) {
                    return $item->stok * $item->harga_jual;
                })
            ];
        });

        return view('admin.gudang.data-barang', compact(
            'produkList',
            'stats',
            'produkByKategori'
        ));
    }
}
