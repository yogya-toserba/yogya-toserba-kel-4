<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\Karyawan;
use App\Models\Shift;
use App\Models\JadwalKerja;
use App\Services\AbsensiService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AbsensiController extends Controller
{
    protected $absensiService;

    public function __construct(AbsensiService $absensiService)
    {
        $this->absensiService = $absensiService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $tanggal = $request->get('tanggal');
        $bulan = $request->get('bulan', Carbon::now()->month);
        $tahun = $request->get('tahun', Carbon::now()->year);
        $karyawan_id = $request->get('karyawan_id');
        $status = $request->get('status');
        $perPage = $request->get('per_page', 15);

        // Base query dengan relasi yang benar
        $query = Absensi::with(['karyawan.jabatan']);

        // Filter berdasarkan parameter
        if ($request->filled('tanggal')) {
            $query->whereDate('tanggal', $tanggal);
        } else {
            $query->whereYear('tanggal', $tahun)
                ->whereMonth('tanggal', $bulan);
        }

        if ($karyawan_id) {
            $query->where('id_karyawan', $karyawan_id);
        }

        if ($status) {
            $query->where('status', $status);
        }

        $absensiList = $query->orderBy('tanggal', 'desc')
            ->orderBy('jam_masuk', 'asc')
            ->paginate($perPage);

        // Append query parameters
        $absensiList->appends($request->query());

        // Data untuk filter
        $karyawanList = Karyawan::where('status', 'aktif')
            ->orderBy('nama')
            ->get();
        $shiftList = Shift::all();

        // Statistik berdasarkan filter yang sama
        $statsQuery = Absensi::query();

        if ($request->filled('tanggal')) {
            $statsQuery->whereDate('tanggal', $tanggal);
        } else {
            $statsQuery->whereYear('tanggal', $tahun)
                ->whereMonth('tanggal', $bulan);
        }

        if ($karyawan_id) {
            $statsQuery->where('id_karyawan', $karyawan_id);
        }

        $stats = [
            'total_hadir' => $statsQuery->clone()->hadir()->count(),
            'total_alfa' => $statsQuery->clone()->alfa()->count(),
            'total_izin' => $statsQuery->clone()->izin()->count(),
            'total_sakit' => $statsQuery->clone()->sakit()->count(),
            'total_terlambat' => $statsQuery->clone()->terlambat()->count(),
            'rata_durasi_kerja' => round($statsQuery->clone()->hadir()->avg('durasi_kerja_jam'), 2) ?? 0,
            'total_menit_terlambat' => $statsQuery->clone()->sum('terlambat_menit') ?? 0
        ];

        // Alias untuk backward compatibility dengan view
        $absensi = $absensiList;

        return view('admin.absensi.index', compact(
            'absensi',
            'absensiList',
            'karyawanList',
            'shiftList',
            'stats',
            'tanggal',
            'bulan',
            'tahun',
            'karyawan_id',
            'status'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $karyawanList = Karyawan::where('status', 'aktif')->get();
        $shiftList = Shift::all();

        return view('admin.absensi.create', compact('karyawanList', 'shiftList'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_karyawan' => 'required|exists:karyawan,id_karyawan',
            'tanggal' => 'required|date',
            'id_shift' => 'required|exists:shift,id_shift',
            'jam_masuk' => 'nullable|date_format:H:i',
            'jam_keluar' => 'nullable|date_format:H:i',
            'status' => 'required|in:hadir,terlambat,alpha,izin,sakit',
            'keterangan' => 'nullable|string|max:500'
        ]);

        // Check if absensi already exists for this date and employee
        $existingAbsensi = Absensi::where('id_karyawan', $request->id_karyawan)
            ->whereDate('tanggal', $request->tanggal)
            ->first();

        if ($existingAbsensi) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['id_karyawan' => 'Karyawan sudah memiliki data absensi untuk tanggal ini.']);
        }

        Absensi::create($request->all());

        return redirect()->route('admin.absensi.index')
            ->with('success', 'Data absensi berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $absensi = Absensi::with(['karyawan.jabatan', 'jadwalKerja.shift'])->findOrFail($id);

        return view('admin.absensi.detail', compact('absensi'));
    }

    /**
     * Display the specified resource for API (AJAX).
     */
    public function showApi($id)
    {
        try {
            $absensi = Absensi::with(['karyawan.jabatan', 'jadwalKerja.shift'])->findOrFail($id);

            $html = view('admin.absensi.partials.detail', compact('absensi'))->render();

            return response()->json([
                'success' => true,
                'html' => $html,
                'data' => $absensi
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Data absensi tidak ditemukan: ' . $e->getMessage()
            ], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $absensi = Absensi::findOrFail($id);
        $karyawanList = Karyawan::where('status', 'aktif')->get();
        $shiftList = Shift::all();

        return view('admin.absensi.edit', compact('absensi', 'karyawanList', 'shiftList'));
    }

    /**
     * Show the form for editing the specified resource for API (AJAX).
     */
    public function editApi($id)
    {
        try {
            $absensi = Absensi::with(['karyawan'])->findOrFail($id);
            $karyawanList = Karyawan::where('status', 'aktif')->get();
            $shiftList = Shift::all();

            $html = view('admin.absensi.partials.edit-form', compact('absensi', 'karyawanList', 'shiftList'))->render();

            return response()->json([
                'success' => true,
                'html' => $html,
                'data' => $absensi
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Data absensi tidak ditemukan: ' . $e->getMessage()
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'jam_masuk' => 'nullable|date_format:H:i',
            'jam_keluar' => 'nullable|date_format:H:i',
            'status' => 'required|in:hadir,terlambat,alpha,izin,sakit',
            'keterangan' => 'nullable|string|max:500'
        ]);

        try {
            $absensi = Absensi::findOrFail($id);
            $absensi->update($request->all());

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Data absensi berhasil diperbarui.',
                    'data' => $absensi
                ]);
            }

            return redirect()->route('admin.absensi.index')
                ->with('success', 'Data absensi berhasil diperbarui.');
                
        } catch (\Exception $e) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal memperbarui data absensi: ' . $e->getMessage()
                ], 500);
            }
            
            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'Gagal memperbarui data absensi: ' . $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $absensi = Absensi::findOrFail($id);
        $absensi->delete();

        return redirect()->route('admin.absensi.index')
            ->with('success', 'Data absensi berhasil dihapus.');
    }

    /**
     * Import absensi from external system or file
     */
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:csv,xlsx',
        ]);

        // Handle file import logic here
        // For now, just return success message

        return redirect()->route('admin.absensi.index')
            ->with('success', 'Data absensi berhasil diimport.');
    }

    /**
     * Export absensi data
     */
    public function export(Request $request)
    {
        $bulan = $request->get('bulan', Carbon::now()->month);
        $tahun = $request->get('tahun', Carbon::now()->year);

        $absensiList = Absensi::with(['karyawan.jabatan', 'jadwalKerja.shift'])
            ->whereYear('tanggal', $tahun)
            ->whereMonth('tanggal', $bulan)
            ->get();

        $filename = "absensi_" . str_pad($bulan, 2, '0', STR_PAD_LEFT) . "_" . $tahun . ".csv";

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"'
        ];

        $callback = function () use ($absensiList) {
            $file = fopen('php://output', 'w');

            // CSV Headers
            fputcsv($file, [
                'Tanggal',
                'Nama Karyawan',
                'Jabatan',
                'Shift',
                'Jam Masuk',
                'Jam Keluar',
                'Status',
                'Keterangan'
            ]);

            foreach ($absensiList as $absensi) {
                fputcsv($file, [
                    $absensi->tanggal,
                    $absensi->karyawan->nama ?? 'N/A',
                    $absensi->karyawan->jabatan->nama_jabatan ?? 'N/A',
                    $absensi->shift->nama_shift ?? 'N/A',
                    $absensi->jam_masuk,
                    $absensi->jam_keluar,
                    ucfirst($absensi->status),
                    $absensi->keterangan
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Bulk update absensi status
     */
    public function bulkUpdate(Request $request)
    {
        $request->validate([
            'selected_ids' => 'required|array|min:1',
            'selected_ids.*' => 'exists:absensi,id_absensi',
            'status' => 'required|in:hadir,terlambat,alpha,izin,sakit'
        ]);

        Absensi::whereIn('id_absensi', $request->selected_ids)
            ->update(['status' => $request->status]);

        return redirect()->route('admin.absensi.index')
            ->with('success', 'Status absensi berhasil diperbarui secara massal.');
    }

    /**
     * Absensi masuk
     */
    public function checkIn(Request $request)
    {
        $request->validate([
            'id_karyawan' => 'required|exists:karyawan,id_karyawan',
            'foto' => 'nullable|image|max:2048',
            'lokasi' => 'nullable|string|max:255'
        ]);

        $data = [
            'tanggal' => now()->toDateString(),
            'jam' => now()->toTimeString(),
            'lokasi' => $request->lokasi,
            'foto' => $request->hasFile('foto') ? $this->uploadFoto($request->file('foto'), 'masuk') : null
        ];

        $result = $this->absensiService->recordKehadiran($request->id_karyawan, 'masuk', $data);

        if ($result['success']) {
            return response()->json([
                'success' => true,
                'message' => $result['message'],
                'data' => $result['data']
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => $result['message']
        ], 400);
    }

    /**
     * Absensi keluar
     */
    public function checkOut(Request $request)
    {
        $request->validate([
            'id_karyawan' => 'required|exists:karyawan,id_karyawan',
            'foto' => 'nullable|image|max:2048',
            'lokasi' => 'nullable|string|max:255'
        ]);

        $data = [
            'tanggal' => now()->toDateString(),
            'jam' => now()->toTimeString(),
            'lokasi' => $request->lokasi,
            'foto' => $request->hasFile('foto') ? $this->uploadFoto($request->file('foto'), 'keluar') : null
        ];

        $result = $this->absensiService->recordKehadiran($request->id_karyawan, 'keluar', $data);

        if ($result['success']) {
            return response()->json([
                'success' => true,
                'message' => $result['message'],
                'data' => $result['data']
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => $result['message']
        ], 400);
    }

    /**
     * Pengajuan izin/sakit
     */
    public function submitIzinSakit(Request $request)
    {
        $request->validate([
            'id_karyawan' => 'required|exists:karyawan,id_karyawan',
            'tanggal' => 'required|date|after_or_equal:today',
            'status' => 'required|in:Izin,Sakit',
            'keterangan' => 'required|string|max:500',
            'dokumen' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048'
        ]);

        $dokumen = null;
        if ($request->hasFile('dokumen')) {
            $dokumen = $request->file('dokumen')->store('absensi/dokumen', 'public');
        }

        $result = $this->absensiService->recordIzinSakit(
            $request->id_karyawan,
            $request->tanggal,
            $request->status,
            $request->keterangan,
            $dokumen
        );

        if ($result['success']) {
            return redirect()->back()->with('success', $result['message']);
        }

        return redirect()->back()->withErrors(['error' => $result['message']]);
    }

    /**
     * Laporan harian
     */
    public function laporanHarian(Request $request)
    {
        $tanggal = $request->get('tanggal', now()->toDateString());

        $laporan = $this->absensiService->getLaporanHarian($tanggal);

        return view('admin.absensi.laporan-harian', compact('laporan', 'tanggal'));
    }

    /**
     * Dashboard absensi
     */
    public function dashboard(Request $request)
    {
        $periode = $request->get('periode', now()->format('Y-m'));

        // Statistik umum
        $stats = $this->absensiService->getStatistikAbsensi($periode);

        // Data untuk chart kehadiran
        $chartData = $this->getChartKehadiran($periode);

        // Top 5 karyawan terlambat
        $topTerlambat = Absensi::with('karyawan')
            ->whereYear('tanggal', Carbon::parse($periode)->year)
            ->whereMonth('tanggal', Carbon::parse($periode)->month)
            ->where('terlambat_menit', '>', 0)
            ->select('id_karyawan', DB::raw('SUM(terlambat_menit) as total_terlambat'), DB::raw('COUNT(*) as jumlah_terlambat'))
            ->groupBy('id_karyawan')
            ->orderBy('total_terlambat', 'desc')
            ->limit(5)
            ->get();

        return view('admin.absensi.dashboard', compact('stats', 'chartData', 'topTerlambat', 'periode'));
    }

    /**
     * Auto mark absent for today
     */
    public function autoMarkAbsent(Request $request)
    {
        $tanggal = $request->get('tanggal', now()->toDateString());

        $count = $this->absensiService->autoMarkAbsent($tanggal);

        return response()->json([
            'success' => true,
            'message' => "Berhasil menandai {$count} karyawan sebagai alfa",
            'count' => $count
        ]);
    }

    /**
     * Upload foto absensi
     */
    private function uploadFoto($file, $type)
    {
        $filename = time() . '_' . $type . '.' . $file->getClientOriginalExtension();
        return $file->storeAs('absensi/foto', $filename, 'public');
    }

    /**
     * Get chart data for attendance
     */
    private function getChartKehadiran($periode)
    {
        $tanggal = Carbon::parse($periode);
        $startDate = $tanggal->copy()->startOfMonth();
        $endDate = $tanggal->copy()->endOfMonth();

        $data = [];

        while ($startDate->lte($endDate)) {
            $hadir = Absensi::whereDate('tanggal', $startDate->toDateString())
                ->hadir()
                ->count();

            $data[] = [
                'tanggal' => $startDate->format('Y-m-d'),
                'hari' => $startDate->format('D'),
                'hadir' => $hadir
            ];

            $startDate->addDay();
        }

        return $data;
    }
}
