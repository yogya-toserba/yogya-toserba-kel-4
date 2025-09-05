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
        $validated = $request->validate([
            'nama_perusahaan' => 'required|string|max:255',
            'kontak_person' => 'required|string|max:255',
            'telepon' => 'required|string|max:20',
            'email' => 'required|email|unique:pemasok,email',
            'alamat' => 'required|string',
            'kota' => 'required|string|max:100',
            'kategori_produk' => 'required|string|max:255',
            'tanggal_kerjasama' => 'nullable|date',
            'status' => 'required|in:aktif,non-aktif',
            'catatan' => 'nullable|string',
            'rating' => 'nullable|numeric|between:1,5'
        ]);

        // Set default rating jika tidak diisi
        if (!isset($validated['rating'])) {
            $validated['rating'] = 5.0;
        }

        // Buat pemasok
        $pemasok = Pemasok::create($validated);

        // Generate username dan password untuk akun supplier
        $username = Str::slug($validated['nama_perusahaan']) . '_' . $pemasok->id_pemasok;
        $password = Str::random(8); // Generate password random 8 karakter

        // Buat user account untuk pemasok
        $pemasokUser = PemasokUser::create([
            'pemasok_id' => $pemasok->id_pemasok,
            'username' => $username,
            'email' => $validated['email'],
            'password' => Hash::make($password),
            'nama_lengkap' => $validated['kontak_person'],
            'telepon' => $validated['telepon'],
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
                'username' => $username,
                'password' => $password,
                'email' => $validated['email'],
                'login_url' => route('supplier.login')
            ]);
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

            // Include user login credentials
            $data = $pemasok->toArray();
            if ($pemasok->user) {
                $data['login_credentials'] = [
                    'username' => $pemasok->user->username,
                    'email' => $pemasok->user->email,
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
        $pemasok = Pemasok::findOrFail($id);
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
        $pemasok = Pemasok::findOrFail($id);

        $validated = $request->validate([
            'nama_perusahaan' => 'required|string|max:255',
            'kontak_person' => 'required|string|max:255',
            'telepon' => 'required|string|max:20',
            'email' => 'required|email|unique:pemasok,email,' . $pemasok->id_pemasok . ',id_pemasok',
            'alamat' => 'required|string',
            'kota' => 'required|string|max:100',
            'kategori_produk' => 'required|string|max:255',
            'tanggal_kerjasama' => 'nullable|date',
            'status' => 'required|in:aktif,non-aktif',
            'catatan' => 'nullable|string',
            'rating' => 'nullable|numeric|between:1,5'
        ]);

        $pemasok->update($validated);

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
            $pemasok = Pemasok::findOrFail($id);
            $pemasok->delete();

            return response()->json([
                'success' => true,
                'message' => 'Pemasok berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus pemasok: ' . $e->getMessage()
            ], 500);
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

            $pemasoks = $query->orderBy('nama_perusahaan', 'asc')->get();

            // Jika tidak ada data, buat data sample untuk testing
            if ($pemasoks->isEmpty()) {
                $pemasoks = collect([
                    (object) [
                        'nama_perusahaan' => 'PT Sumber Rezeki',
                        'kontak_person' => 'Ahmad Wijaya',
                        'telepon' => '021-5551234',
                        'email' => 'ahmad@sumberrezeki.com',
                        'alamat' => 'Jl. Gatot Subroto No. 45, Jakarta Selatan',
                        'kota' => 'Jakarta',
                        'kategori_produk' => 'Makanan & Minuman',
                        'tanggal_kerjasama' => now(),
                        'status' => 'aktif',
                        'rating' => 4.8,
                        'catatan' => 'Supplier utama untuk produk makanan dan minuman'
                    ],
                    (object) [
                        'nama_perusahaan' => 'CV Berkah Jaya',
                        'kontak_person' => 'Siti Nurhaliza',
                        'telepon' => '021-7778899',
                        'email' => 'siti@berkahjaya.com',
                        'alamat' => 'Jl. Sudirman No. 123, Jakarta Pusat',
                        'kota' => 'Jakarta',
                        'kategori_produk' => 'Elektronik',
                        'tanggal_kerjasama' => now(),
                        'status' => 'aktif',
                        'rating' => 4.5,
                        'catatan' => 'Supplier elektronik dengan kualitas terbaik'
                    ]
                ]);
            }

            // Check if user wants Excel format
            if ($request->get('format') === 'excel') {
                return $this->exportToExcel($pemasoks);
            }

            // Default CSV export
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
                    'Catatan'
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
                        str_replace(["\r", "\n"], ' ', $pemasok->catatan ?? '')
                    ], ';'); // Gunakan semicolon sebagai delimiter
                }

                fclose($file);
            };

            return response()->stream($callback, 200, $headers);
        } catch (\Exception $e) {
            Log::error('Export error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat export: ' . $e->getMessage());
        }
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
                th, td { border: 1px solid #000; padding: 5px; text-align: left; }
                th { background-color: #4472C4; color: white; font-weight: bold; }
                tr:nth-child(even) { background-color: #f2f2f2; }
            </style>
        </head>
        <body>
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
                'new_password' => $newPassword
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }
}
