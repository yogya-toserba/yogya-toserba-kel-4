<?php

namespace App\Http\Controllers;

use App\Models\Pemasok;
use App\Models\PemasokUser;
use App\Models\ChatRoom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class PemasokController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $gudang = Auth::guard('gudang')->user();

        $query = Pemasok::query();

        // Filter berdasarkan pencarian
        if ($request->filled('search')) {
            $query->search($request->search);
        }

        // Filter berdasarkan status
        if ($request->filled('status')) {
            if ($request->status === 'aktif') {
                $query->aktif();
            } elseif ($request->status === 'non-aktif') {
                $query->nonAktif();
            }
        }

        // Filter berdasarkan kategori
        if ($request->filled('kategori')) {
            $query->kategori($request->kategori);
        }

        // Filter berdasarkan kota
        if ($request->filled('kota')) {
            $query->where('kota', 'like', '%' . $request->kota . '%');
        }

        // Sorting
        $sortBy = $request->get('sort', 'nama_perusahaan');
        $sortOrder = $request->get('order', 'asc');
        $query->orderBy($sortBy, $sortOrder);

        $pemasoks = $query->paginate(10);

        // Data untuk statistics
        $totalPemasok = Pemasok::count();
        $pemasokAktif = Pemasok::aktif()->count();
        $pemasokNonAktif = Pemasok::nonAktif()->count();
        $totalKategori = Pemasok::distinct('kategori_produk')->count();

        // Kategori produk untuk dropdown filter
        $kategoriProduk = Pemasok::distinct()
            ->pluck('kategori_produk')
            ->filter()
            ->sort()
            ->values();

        // Kota untuk dropdown filter  
        $kotaList = Pemasok::distinct()
            ->pluck('kota')
            ->filter()
            ->sort()
            ->values();

        return view('gudang.pemasok', compact(
            'gudang',
            'pemasoks',
            'totalPemasok',
            'pemasokAktif',
            'pemasokNonAktif',
            'totalKategori',
            'kategoriProduk',
            'kotaList'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $gudang = Auth::guard('gudang')->user();
        return view('gudang.pemasok-create', compact('gudang'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi data pemasok
        $validated = $request->validate([
            // Data Perusahaan
            'nama_perusahaan' => 'required|string|max:255',
            'kontak_person' => 'required|string|max:255',
            'telepon' => 'required|string|max:20',
            'email' => 'required|email|unique:pemasok,email',
            'alamat' => 'required|string',
            'kota' => 'required|string|max:100',
            'kategori_produk' => 'required|string|max:255',
            'tanggal_kerjasama' => 'nullable|date',
            'catatan' => 'nullable|string',
            'rating' => 'nullable|numeric|between:1,5',

            // Data Akun Login
            'username' => 'required|string|max:255|unique:pemasok_users,username',
            'email_login' => 'required|email|unique:pemasok_users,email',
            'password' => 'required|string|min:8|confirmed',
            'nama_lengkap' => 'required|string|max:255',
            'telepon_pic' => 'nullable|string|max:20'
        ]);

        try {
            // Set default values
            if (!isset($validated['rating'])) {
                $validated['rating'] = 5.0;
            }

            if (!isset($validated['tanggal_kerjasama'])) {
                $validated['tanggal_kerjasama'] = now()->toDateString();
            }

            // Buat pemasok dengan data perusahaan
            $pemasok = Pemasok::create([
                'nama_perusahaan' => $validated['nama_perusahaan'],
                'kontak_person' => $validated['kontak_person'],
                'telepon' => $validated['telepon'],
                'email' => $validated['email'],
                'alamat' => $validated['alamat'],
                'kota' => $validated['kota'],
                'kategori_produk' => $validated['kategori_produk'],
                'tanggal_kerjasama' => $validated['tanggal_kerjasama'],
                'status' => 'aktif',
                'catatan' => $validated['catatan'],
                'rating' => $validated['rating']
            ]);

            // Buat user account untuk pemasok dengan data yang diinput user
            $pemasokUser = PemasokUser::create([
                'pemasok_id' => $pemasok->id_pemasok,
                'username' => $validated['username'],
                'email' => $validated['email_login'],
                'password' => Hash::make($validated['password']),
                'plain_password' => $validated['password'], // Simpan plain password untuk ditampilkan
                'nama_lengkap' => $validated['nama_lengkap'],
                'telepon' => $validated['telepon_pic'] ?? $validated['telepon'],
                'status' => 'aktif'
            ]);

            // Buat chat room default
            ChatRoom::create([
                'pemasok_id' => $pemasok->id_pemasok,
                'gudang_id' => Auth::guard('gudang')->user()->id_gudang,
                'nama_room' => 'Chat dengan ' . $validated['nama_perusahaan'],
                'deskripsi' => 'Room chat untuk komunikasi dengan supplier ' . $validated['nama_perusahaan'],
                'status' => 'aktif'
            ]);

            return redirect()->route('gudang.pemasok.index')
                ->with('success', 'Pemasok berhasil ditambahkan!')
                ->with('user_credentials', [
                    'username' => $validated['username'],
                    'password' => $validated['password'],
                    'email' => $validated['email_login'],
                    'nama_perusahaan' => $validated['nama_perusahaan'],
                    'login_url' => route('supplier.login')
                ]);
        } catch (\Exception $e) {
            Log::error('Error creating pemasok: ' . $e->getMessage());
            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal menambahkan pemasok: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        Log::info('PemasokController@show called with ID: ' . $id);

        try {
            $pemasok = Pemasok::with('user')->where('id_pemasok', $id)->first();

            if (!$pemasok) {
                Log::error('Pemasok not found with ID: ' . $id);
                return response()->json([
                    'success' => false,
                    'message' => 'Pemasok tidak ditemukan'
                ], 404);
            }

            Log::info('Pemasok found: ' . json_encode($pemasok));

            // Include user login credentials with additional data
            $data = $pemasok->toArray();
            if ($pemasok->user) {
                $data['user'] = [
                    'username' => $pemasok->user->username,
                    'email' => $pemasok->user->email,
                    'plain_password' => $pemasok->user->plain_password ?: 'Password tidak tersimpan',
                    'nama_lengkap' => $pemasok->user->nama_lengkap,
                    'telepon' => $pemasok->user->telepon,
                    'status' => $pemasok->user->status,
                    'last_login' => $pemasok->user->last_login ? $pemasok->user->last_login->format('d/m/Y H:i') : 'Belum pernah login',
                    'created_at' => $pemasok->user->created_at ? $pemasok->user->created_at->format('d/m/Y H:i') : '-'
                ];
                $data['login_credentials'] = [
                    'username' => $pemasok->user->username,
                    'email' => $pemasok->user->email,
                    'password' => $pemasok->user->plain_password ?: 'Password tidak tersimpan',
                    'login_url' => route('supplier.login'),
                    'status' => $pemasok->user->status
                ];
            }

            return response()->json([
                'success' => true,
                'data' => $data
            ]);
        } catch (\Exception $e) {
            Log::error('Error in PemasokController@show: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $pemasok = Pemasok::where('id_pemasok', $id)->first();

        if (!$pemasok) {
            return response()->json([
                'success' => false,
                'message' => 'Pemasok tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $pemasok
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $pemasok = Pemasok::where('id_pemasok', $id)->first();

        if (!$pemasok) {
            return response()->json([
                'success' => false,
                'message' => 'Pemasok tidak ditemukan'
            ], 404);
        }

        $validated = $request->validate([
            'nama_perusahaan' => 'required|string|max:255',
            'kontak_person' => 'nullable|string|max:255',
            'telepon' => 'nullable|string|max:20',
            'email' => 'nullable|email|unique:pemasok,email,' . $pemasok->id_pemasok . ',id_pemasok',
            'alamat' => 'nullable|string',
            'kota' => 'nullable|string|max:100',
            'kategori_produk' => 'nullable|string|max:255',
            'tanggal_kerjasama' => 'nullable|date',
            'status' => 'nullable|in:aktif,non-aktif',
            'catatan' => 'nullable|string',
            'rating' => 'nullable|numeric|between:1,5',
            // Data akun login
            'email_login' => 'nullable|email',
            'nama_lengkap' => 'nullable|string|max:255',
            'telepon_pic' => 'nullable|string|max:20',
            'status_akun' => 'nullable|in:aktif,non-aktif'
        ]);

        // Update pemasok data
        $pemasokData = collect($validated)->except(['email_login', 'nama_lengkap', 'telepon_pic', 'status_akun'])->toArray();
        $pemasok->update($pemasokData);

        // Update user account data if exists and data is provided
        if ($pemasok->user && ($request->has('email_login') || $request->has('nama_lengkap') || $request->has('telepon_pic') || $request->has('status_akun'))) {
            $userUpdateData = [];

            if ($request->filled('email_login')) {
                // Check if email is unique
                $emailExists = PemasokUser::where('email', $request->email_login)
                    ->where('id', '!=', $pemasok->user->id)
                    ->exists();

                if (!$emailExists) {
                    $userUpdateData['email'] = $request->email_login;
                } else {
                    return response()->json([
                        'success' => false,
                        'message' => 'Email login sudah digunakan oleh pemasok lain'
                    ], 400);
                }
            }

            if ($request->filled('nama_lengkap')) {
                $userUpdateData['nama_lengkap'] = $request->nama_lengkap;
            }

            if ($request->filled('telepon_pic')) {
                $userUpdateData['telepon'] = $request->telepon_pic;
            }

            if ($request->filled('status_akun')) {
                $userUpdateData['status'] = $request->status_akun;
            }

            if (!empty($userUpdateData)) {
                $pemasok->user->update($userUpdateData);
            }
        }

        // Handle AJAX requests
        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Pemasok berhasil diperbarui',
                'data' => $pemasok->fresh()
            ]);
        }

        return redirect()->route('gudang.pemasok.index')
            ->with('success', 'Pemasok berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $pemasok = Pemasok::where('id_pemasok', $id)->first();

            if (!$pemasok) {
                return response()->json([
                    'success' => false,
                    'message' => 'Pemasok tidak ditemukan'
                ], 404);
            }

            // Also delete related user account if exists
            if ($pemasok->user) {
                $pemasok->user->delete();
            }

            // Delete chat rooms
            ChatRoom::where('pemasok_id', $pemasok->id_pemasok)->delete();

            $pemasok->delete();

            // Handle AJAX requests
            if (request()->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Pemasok berhasil dihapus'
                ]);
            }

            return redirect()->route('gudang.pemasok.index')
                ->with('success', 'Pemasok berhasil dihapus');
        } catch (\Exception $e) {
            if (request()->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal menghapus pemasok: ' . $e->getMessage()
                ], 500);
            }

            return redirect()->route('gudang.pemasok.index')
                ->with('error', 'Gagal menghapus pemasok: ' . $e->getMessage());
        }
    }

    /**
     * Get pemasok data for AJAX
     */
    public function getData(Request $request)
    {
        // If ID is provided, return single pemasok
        if ($request->filled('id')) {
            $pemasok = Pemasok::where('id_pemasok', $request->id)->first();

            if (!$pemasok) {
                return response()->json([
                    'success' => false,
                    'message' => 'Pemasok tidak ditemukan'
                ], 404);
            }

            return response()->json([
                'success' => true,
                'data' => $pemasok
            ]);
        }

        $query = Pemasok::query();

        // Apply filters
        if ($request->filled('search')) {
            $query->search($request->search);
        }

        if ($request->filled('status')) {
            if ($request->status === 'aktif') {
                $query->aktif();
            } elseif ($request->status === 'non-aktif') {
                $query->nonAktif();
            }
        }

        if ($request->filled('kategori')) {
            $query->kategori($request->kategori);
        }

        if ($request->filled('kota')) {
            $query->where('kota', 'like', '%' . $request->kota . '%');
        }

        $pemasoks = $query->get();

        return response()->json([
            'success' => true,
            'data' => $pemasoks
        ]);
    }

    /**
     * Export pemasok data to CSV/Excel
     */
    public function export(Request $request)
    {
        try {
            // Get filters from request
            $filters = [
                'search' => $request->get('search'),
                'status' => $request->get('status'),
                'kategori' => $request->get('kategori'),
                'kota' => $request->get('kota')
            ];

            // Remove empty filters
            $filters = array_filter($filters, function ($value) {
                return !empty($value);
            });

            // Check format
            $format = $request->get('format', 'csv');

            // If trying to use Laravel Excel but package not available, fall back to manual export
            if (class_exists('Maatwebsite\Excel\Facades\Excel')) {
                // Use Laravel Excel package
                $export = new \App\Exports\PemasokExport($filters);
                $filename = 'Data_Pemasok_' . date('Y-m-d_H-i-s');

                // Use dynamic class calls to avoid IDE errors when package not installed
                $excelClass = '\Maatwebsite\Excel\Facades\Excel';

                if ($format === 'excel') {
                    return $excelClass::download($export, $filename . '.xlsx');
                } else {
                    return $excelClass::download($export, $filename . '.csv');
                }
            } else {
                // Manual export fallback
                return $this->manualExport($request, $format);
            }
        } catch (\Exception $e) {
            Log::error('Export error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat export: ' . $e->getMessage());
        }
    }

    /**
     * Manual export when Laravel Excel is not available
     */
    private function manualExport(Request $request, $format = 'csv')
    {
        $query = Pemasok::with('user');

        // Apply filters
        if ($request->filled('search')) {
            $query->search($request->search);
        }

        if ($request->filled('status')) {
            if ($request->status === 'aktif') {
                $query->aktif();
            } elseif ($request->status === 'non-aktif') {
                $query->nonAktif();
            }
        }

        if ($request->filled('kategori')) {
            $query->kategori($request->kategori);
        }

        if ($request->filled('kota')) {
            $query->where('kota', 'like', '%' . $request->kota . '%');
        }

        $pemasoks = $query->orderBy('nama_perusahaan', 'asc')->get();

        // Check if user wants Excel format
        if ($format === 'excel') {
            return $this->exportToExcel($pemasoks);
        }

        // CSV export
        return $this->exportToCSV($pemasoks);
    }

    /**
     * Export to CSV format
     */
    private function exportToCSV($pemasoks)
    {
        $filename = 'Data_Pemasok_' . date('Y-m-d_H-i-s') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0'
        ];

        $callback = function () use ($pemasoks) {
            $file = fopen('php://output', 'w');

            // Add BOM untuk UTF-8 encoding di Excel
            fprintf($file, chr(0xEF) . chr(0xBB) . chr(0xBF));

            // Add headers dengan delimiter titik koma untuk Excel Indonesia
            fputcsv($file, [
                'No',
                'Nama Perusahaan',
                'Kontak Person',
                'Telepon',
                'Email',
                'Alamat',
                'Kota',
                'Kategori Produk',
                'Tanggal Kerjasama',
                'Status',
                'Rating',
                'Catatan',
                'Username Login',
                'Email Login',
                'Nama PIC Login',
                'Telepon PIC',
                'Status Akun',
                'Terakhir Login',
                'Dibuat Pada'
            ], ';'); // Gunakan semicolon sebagai delimiter

            // Add data
            $no = 1;
            foreach ($pemasoks as $pemasok) {
                $tanggalKerjasama = '';
                if (isset($pemasok->tanggal_kerjasama)) {
                    if (is_object($pemasok->tanggal_kerjasama)) {
                        $tanggalKerjasama = $pemasok->tanggal_kerjasama->format('d/m/Y');
                    } else {
                        $tanggalKerjasama = date('d/m/Y', strtotime($pemasok->tanggal_kerjasama));
                    }
                }

                // Bersihkan data untuk menghindari line break
                fputcsv($file, [
                    $no++,
                    str_replace(["\r", "\n"], ' ', $pemasok->nama_perusahaan ?? ''),
                    str_replace(["\r", "\n"], ' ', $pemasok->kontak_person ?? ''),
                    $pemasok->telepon ?? '',
                    $pemasok->email ?? '',
                    str_replace(["\r", "\n"], ' ', $pemasok->alamat ?? ''),
                    str_replace(["\r", "\n"], ' ', $pemasok->kota ?? ''),
                    str_replace(["\r", "\n"], ' ', $pemasok->kategori_produk ?? ''),
                    $tanggalKerjasama,
                    ucfirst($pemasok->status ?? 'aktif'),
                    $pemasok->rating ? number_format($pemasok->rating, 1) : '',
                    str_replace(["\r", "\n"], ' ', $pemasok->catatan ?? ''),
                    // Data akun login
                    $pemasok->user ? $pemasok->user->username : 'Belum dibuat',
                    $pemasok->user ? $pemasok->user->email : 'Belum dibuat',
                    $pemasok->user ? str_replace(["\r", "\n"], ' ', $pemasok->user->nama_lengkap) : 'Belum dibuat',
                    $pemasok->user ? $pemasok->user->telepon : 'Belum dibuat',
                    $pemasok->user ? ucfirst($pemasok->user->status) : 'Belum dibuat',
                    $pemasok->user && $pemasok->user->last_login ? $pemasok->user->last_login->format('d/m/Y H:i') : 'Belum login',
                    $pemasok->created_at->format('d/m/Y H:i')
                ], ';');
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Export to Excel format (HTML table yang bisa dibuka Excel)
     */
    private function exportToExcel($pemasoks)
    {
        $filename = 'Data_Pemasok_' . date('Y-m-d_H-i-s') . '.xls';

        $headers = [
            'Content-Type' => 'application/vnd.ms-excel; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0'
        ];

        $html = '
        <html>
        <head>
            <meta charset="UTF-8">
            <style>
                table { border-collapse: collapse; width: 100%; }
                th, td { border: 1px solid #000; padding: 5px; text-align: left; font-size: 12px; }
                th { background-color: #4472C4; color: white; font-weight: bold; }
                tr:nth-child(even) { background-color: #f2f2f2; }
                .login-info { background-color: #e8f4f8; }
            </style>
        </head>
        <body>
            <h2>Data Pemasok MyYOGYA - ' . date('d/m/Y H:i') . '</h2>
            <table>
                <tr>
                    <th>No</th>
                    <th>Nama Perusahaan</th>
                    <th>Kontak Person</th>
                    <th>Telepon</th>
                    <th>Email</th>
                    <th>Alamat</th>
                    <th>Kota</th>
                    <th>Kategori Produk</th>
                    <th>Tanggal Kerjasama</th>
                    <th>Status</th>
                    <th>Rating</th>
                    <th>Catatan</th>
                    <th class="login-info">Username Login</th>
                    <th class="login-info">Email Login</th>
                    <th class="login-info">Nama PIC Login</th>
                    <th class="login-info">Telepon PIC</th>
                    <th class="login-info">Status Akun</th>
                    <th class="login-info">Terakhir Login</th>
                    <th>Dibuat Pada</th>
                </tr>';

        $no = 1;
        foreach ($pemasoks as $pemasok) {
            $tanggalKerjasama = '';
            if (isset($pemasok->tanggal_kerjasama)) {
                if (is_object($pemasok->tanggal_kerjasama)) {
                    $tanggalKerjasama = $pemasok->tanggal_kerjasama->format('d/m/Y');
                } else {
                    $tanggalKerjasama = date('d/m/Y', strtotime($pemasok->tanggal_kerjasama));
                }
            }

            $html .= '<tr>';
            $html .= '<td>' . $no++ . '</td>';
            $html .= '<td>' . htmlspecialchars($pemasok->nama_perusahaan ?? '') . '</td>';
            $html .= '<td>' . htmlspecialchars($pemasok->kontak_person ?? '') . '</td>';
            $html .= '<td>' . htmlspecialchars($pemasok->telepon ?? '') . '</td>';
            $html .= '<td>' . htmlspecialchars($pemasok->email ?? '') . '</td>';
            $html .= '<td>' . htmlspecialchars($pemasok->alamat ?? '') . '</td>';
            $html .= '<td>' . htmlspecialchars($pemasok->kota ?? '') . '</td>';
            $html .= '<td>' . htmlspecialchars($pemasok->kategori_produk ?? '') . '</td>';
            $html .= '<td>' . $tanggalKerjasama . '</td>';
            $html .= '<td>' . ucfirst($pemasok->status ?? 'aktif') . '</td>';
            $html .= '<td>' . ($pemasok->rating ? number_format($pemasok->rating, 1) : '') . '</td>';
            $html .= '<td>' . htmlspecialchars($pemasok->catatan ?? '') . '</td>';
            // Data akun login
            $html .= '<td class="login-info">' . ($pemasok->user ? htmlspecialchars($pemasok->user->username) : 'Belum dibuat') . '</td>';
            $html .= '<td class="login-info">' . ($pemasok->user ? htmlspecialchars($pemasok->user->email) : 'Belum dibuat') . '</td>';
            $html .= '<td class="login-info">' . ($pemasok->user ? htmlspecialchars($pemasok->user->nama_lengkap) : 'Belum dibuat') . '</td>';
            $html .= '<td class="login-info">' . ($pemasok->user ? htmlspecialchars($pemasok->user->telepon) : 'Belum dibuat') . '</td>';
            $html .= '<td class="login-info">' . ($pemasok->user ? ucfirst($pemasok->user->status) : 'Belum dibuat') . '</td>';
            $html .= '<td class="login-info">' . ($pemasok->user && $pemasok->user->last_login ? $pemasok->user->last_login->format('d/m/Y H:i') : 'Belum login') . '</td>';
            $html .= '<td>' . $pemasok->created_at->format('d/m/Y H:i') . '</td>';
            $html .= '</tr>';
        }

        $html .= '</table></body></html>';

        return response($html, 200, $headers);
    }

    /**
     * Reset password untuk akun supplier
     */
    public function resetPassword($id)
    {
        try {
            $pemasok = Pemasok::with('user')->findOrFail($id);

            if (!$pemasok->user) {
                return response()->json([
                    'success' => false,
                    'message' => 'Akun supplier belum dibuat untuk pemasok ini'
                ], 404);
            }

            // Generate password baru
            $newPassword = Str::random(8);

            // Update password
            $pemasok->user->update([
                'password' => Hash::make($newPassword)
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Password berhasil direset',
                'username' => $pemasok->user->username,
                'new_password' => $newPassword
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Create account untuk pemasok yang belum memiliki akun
     */
    public function createAccount($id)
    {
        try {
            $pemasok = Pemasok::findOrFail($id);

            // Check if account already exists
            if ($pemasok->user) {
                return response()->json([
                    'success' => false,
                    'message' => 'Pemasok ini sudah memiliki akun login'
                ], 400);
            }

            // Generate username dan password
            $username = Str::slug($pemasok->nama_perusahaan) . '_' . $pemasok->id_pemasok;
            $password = Str::random(8);

            // Create user account
            $pemasokUser = PemasokUser::create([
                'pemasok_id' => $pemasok->id_pemasok,
                'username' => $username,
                'email' => $pemasok->email,
                'password' => Hash::make($password),
                'plain_password' => $password,
                'nama_lengkap' => $pemasok->kontak_person,
                'telepon' => $pemasok->telepon,
                'status' => 'aktif'
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Akun berhasil dibuat',
                'username' => $username,
                'password' => $password,
                'email' => $pemasok->email
            ]);
        } catch (\Exception $e) {
            Log::error('Error creating account for pemasok: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }
}
