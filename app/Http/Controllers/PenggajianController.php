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
use App\Services\PenggajianOtomatisService;
use Carbon\Carbon;

class PenggajianController extends Controller
{
    protected $penggajianService;

    public function __construct(PenggajianOtomatisService $penggajianService)
    {
        $this->penggajianService = $penggajianService;
    }

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
            $results = $this->penggajianService->generateGajiOtomatis($periode);

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
        $periode = Carbon::createFromFormat('Y-m-d', $gaji->periode_gaji);
        $absensiData = Absensi::where('id_karyawan', $gaji->id_karyawan)
            ->whereYear('absensi.tanggal', $periode->year)
            ->whereMonth('absensi.tanggal', $periode->month)
            ->get();

        return view('admin.penggajian.show', compact('gaji', 'absensiData'));
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

        $request->validate([
            'gaji_pokok' => 'required|numeric|min:0',
            'tunjangan_jabatan' => 'nullable|numeric|min:0',
            'tunjangan_kehadiran' => 'nullable|numeric|min:0',
            'tunjangan_lainnya' => 'nullable|numeric|min:0',
            'potongan_absensi' => 'nullable|numeric|min:0',
            'potongan_lainnya' => 'nullable|numeric|min:0',
        ]);

        // Hitung ulang total gaji
        $totalTunjangan = ($request->tunjangan_jabatan ?? 0) +
            ($request->tunjangan_kehadiran ?? 0) +
            ($request->tunjangan_lainnya ?? 0);

        $totalPotongan = ($request->potongan_absensi ?? 0) +
            ($request->potongan_lainnya ?? 0);

        $totalGaji = $request->gaji_pokok + $totalTunjangan - $totalPotongan;

        $gaji->update([
            'gaji_pokok' => $request->gaji_pokok,
            'tunjangan_jabatan' => $request->tunjangan_jabatan ?? 0,
            'tunjangan_kehadiran' => $request->tunjangan_kehadiran ?? 0,
            'tunjangan_lainnya' => $request->tunjangan_lainnya ?? 0,
            'potongan_absensi' => $request->potongan_absensi ?? 0,
            'potongan_lainnya' => $request->potongan_lainnya ?? 0,
            'jumlah_gaji' => $totalGaji,
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
                $gajiData = $this->penggajianService->hitungGajiKaryawan($kar, $startDate, $endDate);
                $preview[] = [
                    'id_karyawan' => $kar->id_karyawan,
                    'nama' => $kar->nama,
                    'jabatan' => $kar->jabatan->nama_jabatan ?? 'Tidak ada',
                    'gaji_pokok' => $gajiData['gaji_pokok'],
                    'total_tunjangan' => $gajiData['total_tunjangan'],
                    'total_potongan' => $gajiData['total_potongan'],
                    'jumlah_gaji' => $gajiData['jumlah_gaji'],
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
            $results = $this->penggajianService->generateGajiOtomatis($periode);

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

        return view('admin.penggajian.konfigurasi', compact('jabatan'));
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

        $karyawan = Karyawan::with(['jabatan', 'cabang'])->find($request->id_karyawan);
        $periode = Carbon::create($request->tahun, $request->bulan, 1);

        $detailAbsensi = $this->penggajianService->getDetailAbsensiKaryawan(
            $request->id_karyawan,
            $periode->startOfMonth(),
            $periode->endOfMonth()
        );

        return response()->json($detailAbsensi);
    }
}
