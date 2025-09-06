<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Collection;
use App\Models\Gaji;
use App\Models\Karyawan;
use App\Models\Jabatan;
use App\Models\Absensi;
use App\Models\Shift;
use Carbon\Carbon;

class PenggajianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $bulan = (int) $request->get('bulan', Carbon::now()->month);
        $tahun = (int) $request->get('tahun', Carbon::now()->year);
        $perPage = (int) $request->get('per_page', 10);
        $periode = Carbon::create($tahun, $bulan, 1)->format('Y-m');

        // Ambil data gaji dengan relasi
        $gajiList = Gaji::with(['karyawan.jabatan', 'karyawan.cabang'])
            ->where('periode_gaji', $periode) // Menggunakan format YYYY-MM
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);

        // Append query parameters to pagination links
        $gajiList->appends($request->query());

        // Statistik
        $stats = [
            'total_gaji' => Gaji::where('periode_gaji', $periode)->sum('jumlah_gaji'),
            'total_karyawan' => Gaji::where('periode_gaji', $periode)->count(),
            'rata_rata_gaji' => Gaji::where('periode_gaji', $periode)->avg('jumlah_gaji'),
            'gaji_tertinggi' => Gaji::where('periode_gaji', $periode)->max('jumlah_gaji')
        ];

        return view('admin.penggajian.index', compact(
            'gajiList',
            'stats',
            'bulan',
            'tahun',
            'periode'
        ));
    }

    /**
     * Generate gaji otomatis untuk periode tertentu
     */
    public function generateGaji(Request $request)
    {
        $request->validate([
            'bulan' => 'required|integer|min:1|max:12',
            'tahun' => 'required|integer|min:2020|max:2030'
        ]);

        try {
            $periode = Carbon::create($request->tahun, $request->bulan, 1);
            
            // Generate gaji otomatis (simplified version)
            $results = $this->generateGajiOtomatisSimple($periode);

            $created = collect($results)->where('status', 'created')->count();
            $updated = collect($results)->where('status', 'updated')->count();
            $errors = collect($results)->where('status', 'error')->count();

            return redirect()->back()
                ->with('success', "Gaji berhasil digenerate! Created: {$created}, Updated: {$updated}, Errors: {$errors}");
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal generate gaji: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $karyawan = Karyawan::with('jabatan')->get();
        $jabatan = Jabatan::all();

        return view('admin.penggajian.create', compact('karyawan', 'jabatan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_karyawan' => 'required|exists:karyawan,id_karyawan',
            'periode_gaji' => 'required|date',
            'gaji_pokok' => 'required|numeric|min:0',
            'tunjangan_jabatan' => 'nullable|numeric|min:0',
            'tunjangan_kehadiran' => 'nullable|numeric|min:0',
            'tunjangan_lainnya' => 'nullable|numeric|min:0',
            'potongan_absensi' => 'nullable|numeric|min:0',
            'potongan_lainnya' => 'nullable|numeric|min:0',
        ]);

        // Cek apakah sudah ada gaji untuk periode ini
        $existingGaji = Gaji::where('id_karyawan', $request->id_karyawan)
            ->whereYear('periode_gaji', date('Y', strtotime($request->periode_gaji)))
            ->whereMonth('periode_gaji', date('m', strtotime($request->periode_gaji)))
            ->first();

        if ($existingGaji) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Karyawan sudah memiliki data gaji untuk periode ini.');
        }

        // Hitung total gaji
        $totalTunjangan = ($request->tunjangan_jabatan ?? 0) +
            ($request->tunjangan_kehadiran ?? 0) +
            ($request->tunjangan_lainnya ?? 0);

        $totalPotongan = ($request->potongan_absensi ?? 0) +
            ($request->potongan_lainnya ?? 0);

        $totalGaji = $request->gaji_pokok + $totalTunjangan - $totalPotongan;

        Gaji::create([
            'id_karyawan' => $request->id_karyawan,
            'periode_gaji' => $request->periode_gaji,
            'gaji_pokok' => $request->gaji_pokok,
            'tunjangan_jabatan' => $request->tunjangan_jabatan ?? 0,
            'tunjangan_kehadiran' => $request->tunjangan_kehadiran ?? 0,
            'tunjangan_lainnya' => $request->tunjangan_lainnya ?? 0,
            'potongan_absensi' => $request->potongan_absensi ?? 0,
            'potongan_lainnya' => $request->potongan_lainnya ?? 0,
            'jumlah_gaji' => $totalGaji,
            'status_pembayaran' => 'pending'
        ]);

        return redirect()->route('admin.penggajian')
            ->with('success', 'Data gaji berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $gaji = Gaji::with(['karyawan.jabatan', 'karyawan.cabang'])->findOrFail($id);

        // Ambil data absensi untuk periode gaji
        $periode = Carbon::createFromFormat('Y-m', $gaji->periode_gaji);
        $absensiData = Absensi::where('id_karyawan', $gaji->id_karyawan)
            ->whereYear('tanggal', $periode->year)
            ->whereMonth('tanggal', $periode->month)
            ->get();

        return view('admin.penggajian.show', compact('gaji', 'absensiData'));
    }

    /**
     * API endpoint untuk mendapatkan detail gaji dalam format JSON
     */
    public function showApi($id)
    {
        try {
            $gaji = Gaji::with(['karyawan.jabatan', 'karyawan.shift'])->findOrFail($id);
            
            // Calculate totals
            $total_gaji = $gaji->gaji_pokok + $gaji->uang_makan + $gaji->uang_transport + $gaji->uang_lembur;
            $total_potongan = $gaji->potongan_bpjs + $gaji->potongan_pajak;
            $gaji_bersih = $total_gaji - $total_potongan;
            
            // Format tanggal
            $periode = \Carbon\Carbon::parse($gaji->tanggal_gaji)->translatedFormat('F Y');
            $tanggal_gaji = \Carbon\Carbon::parse($gaji->tanggal_gaji)->translatedFormat('d F Y');
            
            // Build HTML for modal
            $html = '
            <div class="row">
                <!-- Card Informasi Karyawan -->
                <div class="col-md-6 mb-3">
                    <div class="detail-card">
                        <div class="card-header">
                            <h6 class="mb-0"><i class="fas fa-user me-2"></i>Informasi Karyawan</h6>
                        </div>
                        <div class="card-body p-0">
                            <table class="table detail-table">
                                <tr>
                                    <td width="35%"><strong>Nama Karyawan</strong></td>
                                    <td>: ' . $gaji->karyawan->nama . '</td>
                                </tr>
                                <tr>
                                    <td><strong>ID Karyawan</strong></td>
                                    <td>: ' . $gaji->id_karyawan . '</td>
                                </tr>
                                <tr>
                                    <td><strong>Email</strong></td>
                                    <td>: ' . $gaji->karyawan->email . '</td>
                                </tr>
                                <tr>
                                    <td><strong>Jabatan</strong></td>
                                    <td>: ' . ($gaji->karyawan->jabatan->nama_jabatan ?? 'Tidak ada') . '</td>
                                </tr>
                                <tr>
                                    <td><strong>Shift</strong></td>
                                    <td>: ' . ($gaji->karyawan->shift->nama_shift ?? 'Tidak ada') . '</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                
                <!-- Card Informasi Periode -->
                <div class="col-md-6 mb-3">
                    <div class="detail-card">
                        <div class="card-header">
                            <h6 class="mb-0"><i class="fas fa-calendar-alt me-2"></i>Informasi Periode</h6>
                        </div>
                        <div class="card-body p-0">
                            <table class="table detail-table">
                                <tr>
                                    <td width="35%"><strong>Periode Gaji</strong></td>
                                    <td>: ' . $periode . '</td>
                                </tr>
                                <tr>
                                    <td><strong>Tanggal Gaji</strong></td>
                                    <td>: ' . $tanggal_gaji . '</td>
                                </tr>
                                <tr>
                                    <td><strong>Status Pembayaran</strong></td>
                                    <td>: <span class="badge ' . ($gaji->status_pembayaran == 'sudah_dibayar' ? 'bg-success' : 'bg-warning') . '">' . ucfirst(str_replace('_', ' ', $gaji->status_pembayaran)) . '</span></td>
                                </tr>
                                <tr>
                                    <td><strong>Hari Kerja</strong></td>
                                    <td>: ' . ($gaji->hari_kerja ?? '-') . ' hari</td>
                                </tr>
                                <tr>
                                    <td><strong>Jam Lembur</strong></td>
                                    <td>: ' . ($gaji->jam_lembur ?? '0') . ' jam</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Card Detail Gaji -->
            <div class="row">
                <div class="col-12">
                    <div class="detail-card">
                        <div class="card-header">
                            <h6 class="mb-0"><i class="fas fa-money-bill-wave me-2"></i>Rincian Gaji</h6>
                        </div>
                        <div class="card-body p-0">
                            <table class="table detail-table">
                                <tr>
                                    <td width="30%"><strong>Gaji Pokok</strong></td>
                                    <td width="20%" class="text-end">Rp ' . number_format($gaji->gaji_pokok, 0, ',', '.') . '</td>
                                    <td width="30%"><strong>Uang Makan</strong></td>
                                    <td class="text-end">Rp ' . number_format($gaji->uang_makan, 0, ',', '.') . '</td>
                                </tr>
                                <tr>
                                    <td><strong>Uang Transport</strong></td>
                                    <td class="text-end">Rp ' . number_format($gaji->uang_transport, 0, ',', '.') . '</td>
                                    <td><strong>Uang Lembur</strong></td>
                                    <td class="text-end">Rp ' . number_format($gaji->uang_lembur, 0, ',', '.') . '</td>
                                </tr>
                                <tr>
                                    <td><strong>Potongan BPJS</strong></td>
                                    <td class="text-end text-danger">- Rp ' . number_format($gaji->potongan_bpjs, 0, ',', '.') . '</td>
                                    <td><strong>Potongan Pajak</strong></td>
                                    <td class="text-end text-danger">- Rp ' . number_format($gaji->potongan_pajak, 0, ',', '.') . '</td>
                                </tr>
                                <tr class="highlight-row">
                                    <td><strong>Total Gaji Kotor</strong></td>
                                    <td class="text-end"><strong>Rp ' . number_format($total_gaji, 0, ',', '.') . '</strong></td>
                                    <td><strong>Total Potongan</strong></td>
                                    <td class="text-end text-danger"><strong>- Rp ' . number_format($total_potongan, 0, ',', '.') . '</strong></td>
                                </tr>
                                <tr class="table-success">
                                    <td colspan="3"><strong>GAJI BERSIH</strong></td>
                                    <td class="text-end"><strong class="fs-5 text-success">Rp ' . number_format($gaji_bersih, 0, ',', '.') . '</strong></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>';
            
            return response()->json([
                'success' => true,
                'html' => $html,
                'data' => $gaji
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan: ' . $e->getMessage()
            ], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $gaji = Gaji::with('karyawan')->findOrFail($id);
        $karyawan = Karyawan::with('jabatan')->get();
        $jabatan = Jabatan::all();

        return view('admin.penggajian.edit', compact('gaji', 'karyawan', 'jabatan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $gaji = Gaji::findOrFail($id);

        // Jika AJAX request untuk update status
        if ($request->ajax() && $request->has('status_pembayaran')) {
            $request->validate([
                'status_pembayaran' => 'required|in:pending,paid,cancelled'
            ]);

            $gaji->update([
                'status_pembayaran' => $request->status_pembayaran,
                'tanggal_bayar' => $request->status_pembayaran === 'paid' ? now() : null
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Status pembayaran berhasil diupdate.'
            ]);
        }

        // Update normal form
        $request->validate([
            'gaji_pokok' => 'required|numeric|min:0',
            'tunjangan' => 'nullable|numeric|min:0',
            'bonus' => 'nullable|numeric|min:0',
            'potongan' => 'nullable|numeric|min:0',
            'status_pembayaran' => 'nullable|in:pending,paid,cancelled',
            'keterangan' => 'nullable|string'
        ]);

        // Hitung ulang total gaji
        $totalGaji = $request->gaji_pokok + ($request->tunjangan ?? 0) + ($request->bonus ?? 0) - ($request->potongan ?? 0);

        $gaji->update([
            'gaji_pokok' => $request->gaji_pokok,
            'tunjangan' => $request->tunjangan ?? 0,
            'bonus' => $request->bonus ?? 0,
            'potongan' => $request->potongan ?? 0,
            'jumlah_gaji' => $totalGaji,
            'status_pembayaran' => $request->status_pembayaran ?? $gaji->status_pembayaran,
            'keterangan' => $request->keterangan ?? $gaji->keterangan,
            'tanggal_bayar' => $request->status_pembayaran === 'paid' ? now() : ($gaji->status_pembayaran === 'paid' ? $gaji->tanggal_bayar : null)
        ]);

        return redirect()->route('admin.penggajian')
            ->with('success', 'Data gaji berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $gaji = Gaji::findOrFail($id);
        $gaji->delete();

        return redirect()->route('admin.penggajian')
            ->with('success', 'Data gaji berhasil dihapus.');
    }

    /**
     * Proses pembayaran gaji
     */
    public function prosesPembayaran(Request $request)
    {
        $request->validate([
            'gaji_ids' => 'required|array',
            'gaji_ids.*' => 'exists:gaji,id_gaji'
        ]);

        Gaji::whereIn('id_gaji', $request->gaji_ids)
            ->update(['status_pembayaran' => 'paid', 'tanggal_bayar' => now()]);

        return redirect()->back()
            ->with('success', 'Pembayaran gaji berhasil diproses.');
    }

    /**
     * Preview gaji sebelum generate
     */
    public function previewGaji(Request $request)
    {
        $request->validate([
            'bulan' => 'required|integer|min:1|max:12',
            'tahun' => 'required|integer|min:2020|max:2030'
        ]);

        $periode = Carbon::create($request->tahun, $request->bulan, 1);
        $startDate = $periode->copy()->startOfMonth();
        $endDate = $periode->copy()->endOfMonth();
        $karyawan = Karyawan::with(['jabatan', 'cabang'])->get();

        $preview = [];

        foreach ($karyawan as $kar) {
            try {
                // Calculate gaji data (simplified)
                $gajiPokok = $kar->jabatan->gaji_pokok ?? 3000000;
                $uangMakan = 200000;
                $uangTransport = 150000;
                $totalTunjangan = $uangMakan + $uangTransport;
                $potonganBpjs = $gajiPokok * 0.04;
                $potonganPajak = $gajiPokok * 0.05;
                $totalPotongan = $potonganBpjs + $potonganPajak;
                $jumlahGaji = $gajiPokok + $totalTunjangan - $totalPotongan;

                $preview[] = [
                    'id_karyawan' => $kar->id_karyawan,
                    'nama' => $kar->nama,
                    'jabatan' => $kar->jabatan->nama_jabatan ?? 'Tidak ada',
                    'gaji_pokok' => $gajiPokok,
                    'total_tunjangan' => $totalTunjangan,
                    'total_potongan' => $totalPotongan,
                    'jumlah_gaji' => $jumlahGaji,
                    'status' => 'ready'
                ];
            } catch (\Exception $e) {
                $preview[] = [
                    'id_karyawan' => $kar->id_karyawan,
                    'nama' => $kar->nama,
                    'jabatan' => $kar->jabatan->nama_jabatan ?? 'Tidak ada',
                    'error' => $e->getMessage(),
                    'status' => 'error'
                ];
            }
        }

        return response()->json($preview);
    }

    /**
     * Proses gaji otomatis untuk periode tertentu
     */
    public function prosesOtomatis(Request $request)
    {
        $request->validate([
            'bulan' => 'required|integer|min:1|max:12',
            'tahun' => 'required|integer|min:2020|max:2030'
        ]);

        try {
            $periode = Carbon::create($request->tahun, $request->bulan, 1);
            $results = $this->generateGajiOtomatisSimple($periode);

            $created = collect($results)->where('status', 'created')->count();
            $updated = collect($results)->where('status', 'updated')->count();
            $errors = collect($results)->where('status', 'error')->count();

            return redirect()->back()
                ->with('success', "Gaji otomatis berhasil diproses! Dibuat: {$created}, Diupdate: {$updated}, Error: {$errors}");
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal memproses gaji otomatis: ' . $e->getMessage());
        }
    }

    /**
     * Halaman konfigurasi sistem penggajian
     */
    public function konfigurasi()
    {
        $jabatan = Jabatan::where('status', true)->get();

        // TODO: Buat view konfigurasi
        return redirect()->route('admin.penggajian')->with('info', 'Halaman konfigurasi belum tersedia');
    }

    /**
     * Get detail absensi karyawan untuk periode tertentu
     */
    public function getDetailAbsensi(Request $request)
    {
        $request->validate([
            'id_karyawan' => 'required|exists:karyawan,id_karyawan',
            'bulan' => 'required|integer|min:1|max:12',
            'tahun' => 'required|integer|min:2020|max:2030'
        ]);

        $karyawan = Karyawan::with(['jabatan', 'shift'])->find($request->id_karyawan);
        $periode = Carbon::create($request->tahun, $request->bulan, 1);

        // Get detail absensi untuk periode tertentu
        $absensi = Absensi::where('id_karyawan', $request->id_karyawan)
            ->whereYear('tanggal', $request->tahun)
            ->whereMonth('tanggal', $request->bulan)
            ->get();

        $totalHadir = $absensi->where('status', 'hadir')->count();
        $totalAlpha = $absensi->where('status', 'alpha')->count();
        $totalIzin = $absensi->where('status', 'izin')->count();
        $totalSakit = $absensi->where('status', 'sakit')->count();

        $detailAbsensi = [
            'karyawan' => $karyawan,
            'periode' => $periode->format('F Y'),
            'total_hari_kerja' => $absensi->count(),
            'total_hadir' => $totalHadir,
            'total_alpha' => $totalAlpha,
            'total_izin' => $totalIzin,
            'total_sakit' => $totalSakit,
            'data_absensi' => $absensi
        ];

        return response()->json($detailAbsensi);
    }

    /**
     * Generate gaji otomatis sederhana
     */
    private function generateGajiOtomatisSimple($periode)
    {
        $results = [];
        
        try {
            // Get all active karyawan
            $karyawan = Karyawan::with(['jabatan'])->where('status', true)->get();
            
            foreach ($karyawan as $kar) {
                try {
                    // Check if gaji already exists for this period
                    $existingGaji = Gaji::where('id_karyawan', $kar->id_karyawan)
                        ->where('periode_gaji', $periode->format('Y-m'))
                        ->first();

                    if ($existingGaji) {
                        $results[] = ['status' => 'updated', 'karyawan' => $kar->nama];
                        continue;
                    }

                    // Calculate basic salary
                    $gajiPokok = $kar->jabatan->gaji_pokok ?? 3000000;
                    $tunjangan = 350000; // Tunjangan total
                    $bonus = 0;
                    $potongan = $gajiPokok * 0.09; // 9% total potongan
                    $jumlahGaji = $gajiPokok + $tunjangan + $bonus - $potongan;

                    // Create new gaji record with correct structure
                    Gaji::create([
                        'id_karyawan' => $kar->id_karyawan,
                        'periode_gaji' => $periode->format('Y-m'),
                        'gaji_pokok' => $gajiPokok,
                        'tunjangan' => $tunjangan,
                        'bonus' => $bonus,
                        'potongan' => $potongan,
                        'jumlah_gaji' => $jumlahGaji,
                        'status_pembayaran' => 'pending',
                        'is_auto_generated' => true
                    ]);

                    $results[] = ['status' => 'created', 'karyawan' => $kar->nama];
                } catch (\Exception $e) {
                    $results[] = ['status' => 'error', 'karyawan' => $kar->nama, 'error' => $e->getMessage()];
                }
            }
        } catch (\Exception $e) {
            $results[] = ['status' => 'error', 'message' => $e->getMessage()];
        }

        return $results;
    }
}
