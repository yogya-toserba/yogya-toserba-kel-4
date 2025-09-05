<?php

namespace App\Services;

use App\Models\Karyawan;
use App\Models\Gaji;
use App\Models\Absensi;
use App\Models\JadwalKerja;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PenggajianOtomatisService
{
    /**
     * Generate gaji otomatis untuk semua karyawan dalam periode tertentu
     */
    public function generateGajiOtomatis($periode)
    {
        $results = [];

        // Coba berbagai kemungkinan status aktif
        $karyawanList = Karyawan::with(['jabatan', 'cabang'])
            ->whereIn('status', ['active', 'aktif', 'Active', 'Aktif', '1', 1, true])
            ->get();

        // Jika tidak ada dengan status tersebut, ambil semua karyawan
        if ($karyawanList->isEmpty()) {
            $karyawanList = Karyawan::with(['jabatan', 'cabang'])->get();
        }

        foreach ($karyawanList as $karyawan) {
            try {
                $result = $this->processGajiKaryawan($karyawan, $periode);
                $results[] = $result;
            } catch (\Exception $e) {
                $results[] = [
                    'id_karyawan' => $karyawan->id_karyawan,
                    'nama' => $karyawan->nama,
                    'status' => 'error',
                    'message' => $e->getMessage()
                ];
            }
        }

        return $results;
    }

    /**
     * Proses gaji untuk satu karyawan
     */
    public function processGajiKaryawan($karyawan, $periode)
    {
        $startDate = Carbon::parse($periode)->startOfMonth();
        $endDate = Carbon::parse($periode)->endOfMonth();

        // Hitung gaji berdasarkan data absensi
        $gajiData = $this->hitungGajiKaryawan($karyawan, $startDate, $endDate);

        // Cek apakah sudah ada gaji untuk periode ini
        $periodeGaji = $startDate->format('Y-m'); // Format YYYY-MM
        $existingGaji = Gaji::where('id_karyawan', $karyawan->id_karyawan)
            ->where('periode_gaji', $periodeGaji)
            ->first();

        if ($existingGaji) {
            // Update gaji yang sudah ada
            $existingGaji->update([
                'gaji_pokok' => $gajiData['gaji_pokok'],
                'tunjangan' => $gajiData['total_tunjangan'],
                'bonus' => $gajiData['bonus_kehadiran'],
                'potongan' => $gajiData['total_potongan'],
                'jumlah_gaji' => $gajiData['jumlah_gaji'],
                'is_auto_generated' => true,
                'keterangan' => $gajiData['keterangan']
            ]);

            return [
                'id_karyawan' => $karyawan->id_karyawan,
                'nama' => $karyawan->nama,
                'status' => 'updated',
                'jumlah_gaji' => $gajiData['jumlah_gaji']
            ];
        } else {
            // Buat gaji baru
            Gaji::create([
                'id_karyawan' => $karyawan->id_karyawan,
                'periode_gaji' => $periodeGaji,
                'gaji_pokok' => $gajiData['gaji_pokok'],
                'tunjangan' => $gajiData['total_tunjangan'],
                'bonus' => $gajiData['bonus_kehadiran'],
                'potongan' => $gajiData['total_potongan'],
                'jumlah_gaji' => $gajiData['jumlah_gaji'],
                'status_pembayaran' => 'pending',
                'is_auto_generated' => true,
                'keterangan' => $gajiData['keterangan']
            ]);

            return [
                'id_karyawan' => $karyawan->id_karyawan,
                'nama' => $karyawan->nama,
                'status' => 'created',
                'jumlah_gaji' => $gajiData['jumlah_gaji']
            ];
        }
    }

    /**
     * Hitung gaji karyawan berdasarkan absensi dan jabatan
     */
    public function hitungGajiKaryawan($karyawan, $startDate, $endDate)
    {
        if (!$karyawan->jabatan) {
            throw new \Exception('Karyawan tidak memiliki jabatan');
        }

        // Ambil data absensi karyawan untuk periode tertentu
        $absensiData = $this->getAbsensiData($karyawan->id_karyawan, $startDate, $endDate);

        // Hitung hari kerja
        $totalHariKerja = $this->hitungHariKerja($startDate, $endDate);
        $hariHadir = $absensiData['hadir'];
        $hariAlpha = $absensiData['alpha'];
        $hariIzin = $absensiData['izin'];
        $hariSakit = $absensiData['sakit'];
        $totalTerlambat = $absensiData['total_terlambat_menit'];

        // Gaji pokok dari jabatan
        $gajiPokok = $karyawan->jabatan->gaji_pokok ?? 0;

        // Tunjangan jabatan (fixed)
        $tunjanganJabatan = $karyawan->jabatan->tunjangan_jabatan ?? 0;

        // Tunjangan kehadiran (berdasarkan kehadiran)
        $persentaseKehadiran = $totalHariKerja > 0 ? ($hariHadir / $totalHariKerja) * 100 : 0;
        $tunjanganKehadiran = 0;

        if ($persentaseKehadiran >= 95) {
            $tunjanganKehadiran = 500000; // Bonus kehadiran penuh
        } elseif ($persentaseKehadiran >= 90) {
            $tunjanganKehadiran = 300000; // Bonus kehadiran baik
        } elseif ($persentaseKehadiran >= 80) {
            $tunjanganKehadiran = 100000; // Bonus kehadiran cukup
        }

        // Potongan absensi
        $potonganAbsensi = 0;
        $potonganPerHari = $gajiPokok / $totalHariKerja; // Potongan per hari

        // Potongan untuk alpha (potong penuh)
        $potonganAbsensi += $hariAlpha * $potonganPerHari;

        // Potongan untuk izin (potong 50%)
        $potonganAbsensi += $hariIzin * ($potonganPerHari * 0.5);

        // Potongan untuk sakit (tidak ada potongan jika ada surat dokter)
        // Untuk sekarang, sakit tidak dipotong

        // Potongan keterlambatan
        $potonganTerlambat = 0;
        if ($totalTerlambat > 0) {
            $potonganPerMenit = 5000; // Rp 5000 per menit terlambat
            $potonganTerlambat = min($totalTerlambat * $potonganPerMenit, $gajiPokok * 0.1); // Max 10% dari gaji pokok
        }

        $totalPotongan = $potonganAbsensi + $potonganTerlambat;
        $totalTunjangan = $tunjanganJabatan + $tunjanganKehadiran;
        $jumlahGaji = $gajiPokok + $totalTunjangan - $totalPotongan;

        // Pastikan gaji tidak negatif
        $jumlahGaji = max($jumlahGaji, 0);

        return [
            'gaji_pokok' => $gajiPokok,
            'tunjangan_jabatan' => $tunjanganJabatan,
            'tunjangan_kehadiran' => $tunjanganKehadiran,
            'bonus_kehadiran' => $tunjanganKehadiran, // Alias untuk compatibility
            'tunjangan_lainnya' => 0,
            'potongan_absensi' => $potonganAbsensi,
            'potongan_lainnya' => $potonganTerlambat,
            'total_tunjangan' => $totalTunjangan,
            'total_potongan' => $totalPotongan,
            'jumlah_gaji' => $jumlahGaji,
            'keterangan' => $this->generateKeterangan($absensiData, $persentaseKehadiran),
            'detail_absensi' => $absensiData
        ];
    }

    /**
     * Ambil data absensi karyawan untuk periode tertentu
     */
    private function getAbsensiData($idKaryawan, $startDate, $endDate)
    {
        // Ambil jadwal kerja karyawan
        $jadwalKerja = JadwalKerja::where('id_karyawan', $idKaryawan)
            ->whereBetween('tanggal', [$startDate, $endDate])
            ->get();

        // Ambil data absensi
        $absensi = Absensi::whereHas('jadwalKerja', function ($query) use ($idKaryawan) {
            $query->where('id_karyawan', $idKaryawan);
        })
            ->whereBetween('absensi.tanggal', [$startDate, $endDate])
            ->get();

        $hadir = $absensi->where('status', 'Hadir')->count();
        $alpha = $absensi->where('status', 'Alpha')->count();
        $izin = $absensi->where('status', 'Izin')->count();
        $sakit = $absensi->where('status', 'Sakit')->count();
        $totalTerlambat = $absensi->sum('terlambat_menit');

        return [
            'total_jadwal' => $jadwalKerja->count(),
            'hadir' => $hadir,
            'alpha' => $alpha,
            'izin' => $izin,
            'sakit' => $sakit,
            'total_terlambat_menit' => $totalTerlambat,
            'persentase_kehadiran' => $jadwalKerja->count() > 0 ? ($hadir / $jadwalKerja->count()) * 100 : 0
        ];
    }

    /**
     * Hitung total hari kerja dalam periode (tidak termasuk weekend)
     */
    private function hitungHariKerja($startDate, $endDate)
    {
        $hariKerja = 0;
        $current = $startDate->copy();

        while ($current->lte($endDate)) {
            // Senin-Jumat = hari kerja (1-5), Sabtu-Minggu = weekend (6-7)
            if ($current->dayOfWeek >= 1 && $current->dayOfWeek <= 5) {
                $hariKerja++;
            }
            $current->addDay();
        }

        return $hariKerja;
    }

    /**
     * Generate keterangan gaji
     */
    private function generateKeterangan($absensiData, $persentaseKehadiran)
    {
        $keterangan = "Gaji otomatis - ";
        $keterangan .= "Hadir: {$absensiData['hadir']} hari, ";
        $keterangan .= "Alpha: {$absensiData['alpha']} hari, ";
        $keterangan .= "Izin: {$absensiData['izin']} hari, ";
        $keterangan .= "Sakit: {$absensiData['sakit']} hari. ";
        $keterangan .= "Kehadiran: " . number_format($persentaseKehadiran, 1) . "%";

        if ($absensiData['total_terlambat_menit'] > 0) {
            $keterangan .= ". Terlambat total: {$absensiData['total_terlambat_menit']} menit";
        }

        return $keterangan;
    }

    /**
     * Preview gaji sebelum generate
     */
    public function previewGaji($periode)
    {
        $startDate = Carbon::parse($periode)->startOfMonth();
        $endDate = Carbon::parse($periode)->endOfMonth();
        $karyawanList = Karyawan::with(['jabatan', 'cabang'])->where('status', 'active')->get();

        $preview = [];

        foreach ($karyawanList as $karyawan) {
            try {
                $gajiData = $this->hitungGajiKaryawan($karyawan, $startDate, $endDate);
                $preview[] = [
                    'id_karyawan' => $karyawan->id_karyawan,
                    'nama' => $karyawan->nama,
                    'jabatan' => $karyawan->jabatan->nama_jabatan ?? 'Tidak ada',
                    'gaji_pokok' => $gajiData['gaji_pokok'],
                    'total_tunjangan' => $gajiData['total_tunjangan'],
                    'total_potongan' => $gajiData['total_potongan'],
                    'jumlah_gaji' => $gajiData['jumlah_gaji'],
                    'kehadiran' => $gajiData['detail_absensi']['hadir'],
                    'alpha' => $gajiData['detail_absensi']['alpha'],
                    'status' => 'ready'
                ];
            } catch (\Exception $e) {
                $preview[] = [
                    'id_karyawan' => $karyawan->id_karyawan,
                    'nama' => $karyawan->nama,
                    'jabatan' => $karyawan->jabatan->nama_jabatan ?? 'Tidak ada',
                    'error' => $e->getMessage(),
                    'status' => 'error'
                ];
            }
        }

        return $preview;
    }

    /**
     * Generate laporan gaji per jabatan
     */
    public function laporanGajiPerJabatan($bulan, $tahun)
    {
        $periode = $tahun . '-' . str_pad($bulan, 2, '0', STR_PAD_LEFT);

        $laporan = DB::table('gaji')
            ->join('karyawan', 'gaji.id_karyawan', '=', 'karyawan.id_karyawan')
            ->join('jabatan', 'karyawan.jabatan_id', '=', 'jabatan.id_jabatan')
            ->select(
                'jabatan.nama_jabatan',
                DB::raw('COUNT(gaji.id_gaji) as total_karyawan'),
                DB::raw('SUM(gaji.jumlah_gaji) as total_gaji'),
                DB::raw('AVG(gaji.jumlah_gaji) as rata_gaji'),
                DB::raw('MIN(gaji.jumlah_gaji) as gaji_min'),
                DB::raw('MAX(gaji.jumlah_gaji) as gaji_max')
            )
            ->where('gaji.periode_gaji', $periode)
            ->groupBy('jabatan.id_jabatan', 'jabatan.nama_jabatan')
            ->orderBy('total_gaji', 'desc')
            ->get();

        return $laporan;
    }

    /**
     * Validasi data gaji
     */
    public function validasiGaji($periode)
    {
        $errors = [];

        // Check duplicate gaji
        $duplicates = DB::table('gaji')
            ->select('id_karyawan', DB::raw('COUNT(*) as total'))
            ->where('periode_gaji', $periode)
            ->groupBy('id_karyawan')
            ->having('total', '>', 1)
            ->get();

        if ($duplicates->count() > 0) {
            $errors[] = 'Ditemukan ' . $duplicates->count() . ' karyawan dengan gaji duplicate pada periode ' . $periode;
        }

        // Check karyawan tanpa gaji
        $karyawanAktif = Karyawan::where('status', 'aktif')->count();
        $karyawanDenganGaji = Gaji::where('periode_gaji', $periode)->distinct('id_karyawan')->count();

        if ($karyawanDenganGaji < $karyawanAktif) {
            $selisih = $karyawanAktif - $karyawanDenganGaji;
            $errors[] = 'Terdapat ' . $selisih . ' karyawan aktif yang belum memiliki data gaji';
        }

        // Check gaji dengan nilai 0 atau negatif
        $gajiInvalid = Gaji::where('periode_gaji', $periode)
            ->where('jumlah_gaji', '<=', 0)
            ->count();

        if ($gajiInvalid > 0) {
            $errors[] = 'Ditemukan ' . $gajiInvalid . ' data gaji dengan nilai <= 0';
        }

        // Check karyawan tanpa jabatan
        $tanpaJabatan = Karyawan::whereNull('jabatan_id')
            ->where('status', 'aktif')
            ->count();

        if ($tanpaJabatan > 0) {
            $errors[] = 'Terdapat ' . $tanpaJabatan . ' karyawan aktif tanpa jabatan';
        }

        return $errors;
    }
}
