<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PenggajianOtomatisService;
use App\Models\Gaji;
use App\Models\Karyawan;
use App\Models\Jabatan;
use App\Models\JadwalKerja;
use App\Models\Absensi;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class GajiOtomatisController extends Controller
{
    protected $penggajianService;

    public function __construct()
    {
        $this->penggajianService = new PenggajianOtomatisService();
    }

    /**
     * Halaman utama penggajian otomatis
     */
    public function index(Request $request)
    {
        $bulan = $request->get('bulan', Carbon::now()->month);
        $tahun = $request->get('tahun', Carbon::now()->year);
        $periode = Carbon::create($tahun, $bulan, 1)->format('Y-m');

        // Ambil data gaji untuk periode yang dipilih
        $gajiList = Gaji::with(['karyawan.jabatan', 'karyawan.cabang'])
            ->where('periode_gaji', $periode)
            ->orderBy('id_karyawan')
            ->paginate(15);

        // Statistik
        $totalKaryawan = Karyawan::where('status', 'aktif')->count();
        $totalGajiDibayar = Gaji::where('periode_gaji', $periode)->sum('jumlah_gaji');
        $karyawanSudahDigaji = Gaji::where('periode_gaji', $periode)->count();

        // Laporan per jabatan
        $laporanJabatan = $this->penggajianService->laporanGajiPerJabatan($bulan, $tahun);

        return view('admin.gaji-otomatis.index', compact(
            'gajiList',
            'bulan',
            'tahun',
            'periode',
            'totalKaryawan',
            'totalGajiDibayar',
            'karyawanSudahDigaji',
            'laporanJabatan'
        ));
    }

    /**
     * Generate gaji otomatis
     */
    public function generateOtomatis(Request $request)
    {
        $request->validate([
            'bulan' => 'required|integer|between:1,12',
            'tahun' => 'required|integer|min:2020'
        ]);

        try {
            $results = $this->penggajianService->generateGajiOtomatis(
                $request->bulan,
                $request->tahun
            );

            $created = collect($results)->where('status', 'created')->count();
            $updated = collect($results)->where('status', 'updated')->count();
            $errors = collect($results)->where('status', 'error')->count();

            $message = "Gaji berhasil digenerate: {$created} dibuat, {$updated} diperbarui";
            if ($errors > 0) {
                $message .= ", {$errors} error";
            }

            return redirect()->back()
                ->with('success', $message)
                ->with('generate_results', $results);
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal generate gaji: ' . $e->getMessage());
        }
    }

    /**
     * Preview gaji sebelum generate
     */
    public function previewGaji(Request $request)
    {
        $bulan = $request->get('bulan', Carbon::now()->month);
        $tahun = $request->get('tahun', Carbon::now()->year);

        $karyawanList = Karyawan::with(['jabatan'])->where('status', 'aktif')->take(5)->get();
        $preview = [];

        $startDate = Carbon::create($tahun, $bulan, 1);
        $endDate = $startDate->copy()->endOfMonth();

        foreach ($karyawanList as $karyawan) {
            try {
                $gajiData = $this->penggajianService->hitungGajiKaryawan($karyawan, $startDate, $endDate);
                $preview[] = [
                    'nama' => $karyawan->nama,
                    'jabatan' => $karyawan->jabatan->nama_jabatan ?? 'Tidak ada',
                    'gaji_pokok' => number_format($gajiData['gaji_pokok'], 0, ',', '.'),
                    'jumlah_gaji' => number_format($gajiData['jumlah_gaji'], 0, ',', '.'),
                    'hari_hadir' => $gajiData['total_hari_hadir'],
                    'hari_kerja' => $gajiData['total_hari_kerja']
                ];
            } catch (\Exception $e) {
                $preview[] = [
                    'nama' => $karyawan->nama,
                    'jabatan' => $karyawan->jabatan->nama_jabatan ?? 'Tidak ada',
                    'error' => $e->getMessage()
                ];
            }
        }

        return response()->json($preview);
    }

    /**
     * Validasi data penggajian
     */
    public function validasi(Request $request)
    {
        $bulan = $request->get('bulan', Carbon::now()->month);
        $tahun = $request->get('tahun', Carbon::now()->year);
        $periode = Carbon::create($tahun, $bulan, 1)->format('Y-m');

        try {
            $errors = $this->penggajianService->validasiGaji($periode);

            return response()->json([
                'success' => true,
                'errors' => $errors,
                'valid' => count($errors) === 0
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal melakukan validasi: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Detail perhitungan gaji
     */
    public function detail($id)
    {
        $gaji = Gaji::with(['karyawan.jabatan', 'karyawan.cabang'])
            ->findOrFail($id);

        // Ambil data absensi untuk periode ini
        $periode = Carbon::createFromFormat('Y-m', $gaji->periode_gaji);
        $startDate = $periode->copy()->startOfMonth();
        $endDate = $periode->copy()->endOfMonth();

        $absensiData = JadwalKerja::where('id_karyawan', $gaji->id_karyawan)
            ->whereBetween('tanggal', [$startDate, $endDate])
            ->with(['shift', 'absensi'])
            ->orderBy('tanggal')
            ->get();

        return view('admin.gaji-otomatis.detail', compact('gaji', 'absensiData'));
    }

    /**
     * Analytics dashboard
     */
    public function analytics(Request $request)
    {
        $tahun = $request->get('tahun', Carbon::now()->year);

        // Data untuk chart gaji per bulan
        $gajiPerBulan = [];
        for ($i = 1; $i <= 12; $i++) {
            $periode = Carbon::create($tahun, $i, 1)->format('Y-m');
            $gajiPerBulan[] = [
                'bulan' => Carbon::create($tahun, $i, 1)->format('F'),
                'total' => Gaji::where('periode_gaji', $periode)->sum('jumlah_gaji')
            ];
        }

        // Statistik per jabatan
        $gajiPerJabatan = DB::table('gaji')
            ->join('karyawan', 'gaji.id_karyawan', '=', 'karyawan.id_karyawan')
            ->join('jabatan', 'karyawan.jabatan_id', '=', 'jabatan.id')
            ->whereYear('gaji.created_at', $tahun)
            ->select(
                'jabatan.nama_jabatan',
                DB::raw('AVG(gaji.jumlah_gaji) as rata_rata'),
                DB::raw('COUNT(*) as jumlah_periode'),
                DB::raw('SUM(gaji.jumlah_gaji) as total_gaji')
            )
            ->groupBy('jabatan.nama_jabatan')
            ->get();

        // Trend kehadiran
        $trendKehadiran = DB::table('gaji')
            ->join('karyawan', 'gaji.id_karyawan', '=', 'karyawan.id_karyawan')
            ->whereYear('gaji.created_at', $tahun)
            ->select(
                'gaji.periode_gaji',
                DB::raw('AVG(gaji.total_hari_hadir) as rata_rata_hadir'),
                DB::raw('AVG(gaji.total_hari_kerja) as rata_rata_kerja')
            )
            ->groupBy('gaji.periode_gaji')
            ->orderBy('gaji.periode_gaji')
            ->get();

        return view('admin.gaji-otomatis.analytics', compact(
            'gajiPerBulan',
            'gajiPerJabatan',
            'trendKehadiran',
            'tahun'
        ));
    }
}
