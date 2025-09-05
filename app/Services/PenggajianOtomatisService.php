<?php

namespace App\Services;

use App\Models\Karyawan;
use App\Models\Gaji;
use App\Models\Absensi;
use App\Models\JadwalKerja;
use App\Models\Jabatan;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PenggajianOtomatisService
{
    /**
     * Konfigurasi gaji berdasarkan jenis karyawan
     */
    private $configGaji = [
        'Kasir' => [
            'gaji_pokok_harian' => 150000,
            'tunjangan_jabatan' => 300000,
            'bonus_kehadiran_per_hari' => 25000,
            'bonus_shift_malam' => 15000,
            'denda_terlambat_per_menit' => 2000,
            'minimal_hari_kerja' => 22,
            'lembur_tarif_per_jam' => 20000
        ],
        'Pramuniaga' => [
            'gaji_pokok_harian' => 130000,
            'tunjangan_jabatan' => 250000,
            'bonus_kehadiran_per_hari' => 20000,
            'bonus_shift_malam' => 12000,
            'denda_terlambat_per_menit' => 1500,
            'minimal_hari_kerja' => 22,
            'lembur_tarif_per_jam' => 18000
        ],
        'Customer Service' => [
            'gaji_pokok_harian' => 140000,
            'tunjangan_jabatan' => 275000,
            'bonus_kehadiran_per_hari' => 22000,
            'bonus_shift_malam' => 13000,
            'denda_terlambat_per_menit' => 1800,
            'minimal_hari_kerja' => 22,
            'lembur_tarif_per_jam' => 19000
        ],
        'Bagian Gudang' => [
            'gaji_pokok_harian' => 145000,
            'tunjangan_jabatan' => 280000,
            'bonus_kehadiran_per_hari' => 23000,
            'bonus_shift_malam' => 14000,
            'denda_terlambat_per_menit' => 1700,
            'minimal_hari_kerja' => 22,
            'lembur_tarif_per_jam' => 20000
        ]
    ];

    /**
     * Generate gaji otomatis untuk periode tertentu
     */
    public function generateGajiOtomatis($bulan = null, $tahun = null)
    {
        $bulan = $bulan ?? Carbon::now()->month;
        $tahun = $tahun ?? Carbon::now()->year;

        $startDate = Carbon::create($tahun, $bulan, 1);
        $endDate = $startDate->copy()->endOfMonth();

        $results = [];
        $karyawanList = Karyawan::with(['jabatan'])->where('status', 'aktif')->get();

        foreach ($karyawanList as $karyawan) {
            try {
                $gajiData = $this->hitungGajiKaryawan($karyawan, $startDate, $endDate);

                // Cek apakah gaji untuk periode ini sudah ada
                $existingGaji = Gaji::where('id_karyawan', $karyawan->id_karyawan)
                    ->where('periode_gaji', $startDate->format('Y-m'))
                    ->first();

                if ($existingGaji) {
                    // Update existing record
                    $existingGaji->update($gajiData);
                    $results[] = [
                        'karyawan' => $karyawan->nama,
                        'status' => 'updated',
                        'jumlah_gaji' => $gajiData['jumlah_gaji']
                    ];
                } else {
                    // Create new record
                    Gaji::create($gajiData);
                    $results[] = [
                        'karyawan' => $karyawan->nama,
                        'status' => 'created',
                        'jumlah_gaji' => $gajiData['jumlah_gaji']
                    ];
                }
            } catch (\Exception $e) {
                $results[] = [
                    'karyawan' => $karyawan->nama,
                    'status' => 'error',
                    'message' => $e->getMessage()
                ];
            }
        }

        return $results;
    }

    /**
     * Hitung gaji untuk satu karyawan
     */
    public function hitungGajiKaryawan(Karyawan $karyawan, Carbon $startDate, Carbon $endDate)
    {
        $jabatan = $karyawan->jabatan->nama_jabatan ?? 'Pramuniaga';
        $config = $this->configGaji[$jabatan] ?? $this->configGaji['Pramuniaga'];

        // Ambil data jadwal kerja dan absensi
        $jadwalKerja = JadwalKerja::where('id_karyawan', $karyawan->id_karyawan)
            ->whereBetween('tanggal', [$startDate, $endDate])
            ->with(['shift', 'absensi'])
            ->get();

        $totalHariKerja = $jadwalKerja->count();
        $totalHariHadir = 0;
        $totalJamLembur = 0;
        $totalDendaTerlambat = 0;
        $totalBonusShiftMalam = 0;
        $totalHariAlpa = 0;

        foreach ($jadwalKerja as $jadwal) {
            $absensi = $jadwal->absensi;

            if ($absensi) {
                if ($absensi->status === 'Hadir') {
                    $totalHariHadir++;

                    // Hitung denda terlambat
                    if ($absensi->terlambat_menit > 0) {
                        $totalDendaTerlambat += ($absensi->terlambat_menit * $config['denda_terlambat_per_menit']);
                    }

                    // Hitung lembur
                    $durasiKerja = $absensi->durasi_kerja ?? 0;
                    $shift = $jadwal->shift;
                    if ($shift && $durasiKerja > $shift->durasi_kerja) {
                        $totalJamLembur += ($durasiKerja - $shift->durasi_kerja);
                    }

                    // Bonus shift malam
                    if ($shift && $shift->isShiftMalam()) {
                        $totalBonusShiftMalam += $config['bonus_shift_malam'];
                    }
                } elseif ($absensi->status === 'Alpa') {
                    $totalHariAlpa++;
                }
            } else {
                // Tidak ada absensi = Alpa
                $totalHariAlpa++;
            }
        }

        // Perhitungan gaji
        $gajiPokok = $config['gaji_pokok_harian'] * $totalHariHadir;
        $tunjanganJabatan = $config['tunjangan_jabatan'];
        $bonusKehadiran = $config['bonus_kehadiran_per_hari'] * $totalHariHadir;
        $totalLembur = $totalJamLembur * $config['lembur_tarif_per_jam'];

        // Potongan
        $potonganAbsen = $totalHariAlpa * ($config['gaji_pokok_harian'] * 0.5); // 50% dari gaji harian
        $potonganBPJS = ($gajiPokok + $tunjanganJabatan) * 0.01; // 1% untuk BPJS
        $potonganPajak = $this->hitungPajakPPh21($gajiPokok + $tunjanganJabatan + $bonusKehadiran);

        $totalBonus = $bonusKehadiran + $totalBonusShiftMalam;
        $totalPotongan = $potonganAbsen + $potonganBPJS + $potonganPajak + $totalDendaTerlambat;
        $totalGaji = $gajiPokok + $tunjanganJabatan + $totalBonus + $totalLembur - $totalPotongan;

        return [
            'id_karyawan' => $karyawan->id_karyawan,
            'total_hari_hadir' => $totalHariHadir,
            'total_hari_kerja' => $totalHariKerja,
            'gaji_pokok' => $gajiPokok,
            'tunjangan' => $tunjanganJabatan,
            'bonus' => $totalBonus,
            'potongan_absen' => $potonganAbsen,
            'lembur_jam' => $totalJamLembur,
            'lembur_tarif' => $config['lembur_tarif_per_jam'],
            'total_lembur' => $totalLembur,
            'potongan_bpjs' => $potonganBPJS,
            'potongan_pajak' => $potonganPajak,
            'potongan_lain' => $totalDendaTerlambat,
            'total_potongan' => $totalPotongan,
            'jumlah_gaji' => $totalGaji,
            'status' => 'pending',
            'periode_gaji' => $startDate->format('Y-m'),
            'is_auto_generated' => true,
            'keterangan' => "Gaji otomatis untuk {$jabatan} periode {$startDate->format('F Y')}. Hadir: {$totalHariHadir}/{$totalHariKerja} hari. Lembur: {$totalJamLembur} jam."
        ];
    }

    /**
     * Hitung pajak PPh21 sederhana
     */
    private function hitungPajakPPh21($penghasilanBruto)
    {
        // PTKP (Penghasilan Tidak Kena Pajak) per bulan untuk TK/0 = Rp 4.500.000
        $ptkp = 4500000;
        $penghasilanKenaPajak = max(0, ($penghasilanBruto * 12) - $ptkp); // Annualized

        $pajak = 0;
        if ($penghasilanKenaPajak <= 60000000) { // 5%
            $pajak = $penghasilanKenaPajak * 0.05;
        } elseif ($penghasilanKenaPajak <= 250000000) { // 15%
            $pajak = (60000000 * 0.05) + (($penghasilanKenaPajak - 60000000) * 0.15);
        } else { // 25%
            $pajak = (60000000 * 0.05) + (190000000 * 0.15) + (($penghasilanKenaPajak - 250000000) * 0.25);
        }

        return $pajak / 12; // Monthly tax
    }

    /**
     * Generate laporan gaji berdasarkan jabatan
     */
    public function laporanGajiPerJabatan($bulan, $tahun)
    {
        $periode = Carbon::create($tahun, $bulan, 1)->format('Y-m');

        $laporan = DB::table('gaji')
            ->join('karyawan', 'gaji.id_karyawan', '=', 'karyawan.id_karyawan')
            ->join('jabatan', 'karyawan.jabatan_id', '=', 'jabatan.id')
            ->where('gaji.periode_gaji', $periode)
            ->select(
                'jabatan.nama_jabatan',
                DB::raw('COUNT(*) as jumlah_karyawan'),
                DB::raw('AVG(gaji.jumlah_gaji) as rata_rata_gaji'),
                DB::raw('SUM(gaji.jumlah_gaji) as total_gaji_jabatan'),
                DB::raw('AVG(gaji.total_hari_hadir) as rata_rata_kehadiran')
            )
            ->groupBy('jabatan.nama_jabatan')
            ->get();

        return $laporan;
    }

    /**
     * Validasi data gaji sebelum finalisasi
     */
    public function validasiGaji($periode)
    {
        $errors = [];

        // Cek karyawan yang belum ada gaji
        $karyawanTanpaGaji = Karyawan::whereNotExists(function ($query) use ($periode) {
            $query->select(DB::raw(1))
                ->from('gaji')
                ->whereRaw('gaji.id_karyawan = karyawan.id_karyawan')
                ->where('periode_gaji', $periode);
        })->where('status', 'aktif')->get();

        if ($karyawanTanpaGaji->count() > 0) {
            $errors[] = "Karyawan belum ada gaji: " . $karyawanTanpaGaji->pluck('nama')->implode(', ');
        }

        // Cek gaji dengan nilai negatif
        $gajiNegatif = Gaji::where('periode_gaji', $periode)
            ->where('jumlah_gaji', '<', 0)
            ->with('karyawan')
            ->get();

        if ($gajiNegatif->count() > 0) {
            $errors[] = "Gaji negatif ditemukan pada: " . $gajiNegatif->pluck('karyawan.nama')->implode(', ');
        }

        return $errors;
    }
}
