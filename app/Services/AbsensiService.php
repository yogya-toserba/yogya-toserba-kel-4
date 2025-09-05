<?php

namespace App\Services;

use App\Models\Absensi;
use App\Models\Karyawan;
use App\Models\JadwalKerja;
use App\Models\Shift;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AbsensiService
{
    /**
     * Record attendance for employee
     */
    public function recordKehadiran($karyawanId, $type = 'masuk', $data = [])
    {
        try {
            DB::beginTransaction();

            $tanggal = $data['tanggal'] ?? now()->toDateString();
            $jam = $data['jam'] ?? now()->toTimeString();

            // Cari jadwal kerja karyawan untuk hari ini
            $jadwal = JadwalKerja::where('id_karyawan', $karyawanId)
                ->whereDate('tanggal', $tanggal)
                ->with('shift')
                ->first();

            if (!$jadwal) {
                throw new \Exception('Jadwal kerja tidak ditemukan untuk tanggal ' . $tanggal);
            }

            // Cek apakah sudah ada absensi untuk tanggal ini
            $absensi = Absensi::where('id_karyawan', $karyawanId)
                ->whereDate('tanggal', $tanggal)
                ->first();

            if (!$absensi) {
                // Buat record absensi baru
                $absensi = new Absensi();
                $absensi->id_karyawan = $karyawanId;
                $absensi->id_jadwal = $jadwal->id_jadwal;
                $absensi->tanggal = $tanggal;
                $absensi->status = 'Hadir';
                $absensi->ip_address = request()->ip();
                $absensi->lokasi_masuk = $data['lokasi'] ?? null;
                $absensi->foto_masuk = $data['foto'] ?? null;
            }

            if ($type === 'masuk') {
                $absensi->jam_masuk = $jam;
                $absensi->terlambat_menit = $this->hitungTerlambat($jadwal->shift, $jam);
            } else {
                $absensi->jam_keluar = $jam;
                $absensi->pulang_awal_menit = $this->hitungPulangAwal($jadwal->shift, $jam);
                $absensi->lokasi_keluar = $data['lokasi'] ?? null;
                $absensi->foto_keluar = $data['foto'] ?? null;
            }

            $absensi->save();

            DB::commit();

            return [
                'success' => true,
                'message' => 'Absensi berhasil dicatat',
                'data' => $absensi
            ];
        } catch (\Exception $e) {
            DB::rollback();

            return [
                'success' => false,
                'message' => $e->getMessage(),
                'data' => null
            ];
        }
    }

    /**
     * Record izin/sakit
     */
    public function recordIzinSakit($karyawanId, $tanggal, $status, $keterangan = null, $dokumen = null)
    {
        try {
            DB::beginTransaction();

            // Cari jadwal kerja karyawan
            $jadwal = JadwalKerja::where('id_karyawan', $karyawanId)
                ->whereDate('tanggal', $tanggal)
                ->first();

            if (!$jadwal) {
                throw new \Exception('Jadwal kerja tidak ditemukan untuk tanggal ' . $tanggal);
            }

            // Cek apakah sudah ada absensi
            $absensi = Absensi::where('id_karyawan', $karyawanId)
                ->whereDate('tanggal', $tanggal)
                ->first();

            if ($absensi) {
                throw new \Exception('Absensi untuk tanggal ini sudah ada');
            }

            // Buat record absensi
            $absensi = Absensi::create([
                'id_karyawan' => $karyawanId,
                'id_jadwal' => $jadwal->id_jadwal,
                'tanggal' => $tanggal,
                'status' => $status,
                'keterangan' => $keterangan,
                'ip_address' => request()->ip()
            ]);

            DB::commit();

            return [
                'success' => true,
                'message' => "Status $status berhasil dicatat",
                'data' => $absensi
            ];
        } catch (\Exception $e) {
            DB::rollback();

            return [
                'success' => false,
                'message' => $e->getMessage(),
                'data' => null
            ];
        }
    }

    /**
     * Get attendance statistics
     */
    public function getStatistikAbsensi($periode = null, $karyawanId = null)
    {
        $query = Absensi::query();

        if ($periode) {
            $tanggal = Carbon::parse($periode);
            $query->whereYear('tanggal', $tanggal->year)
                ->whereMonth('tanggal', $tanggal->month);
        } else {
            $query->whereMonth('tanggal', now()->month)
                ->whereYear('tanggal', now()->year);
        }

        if ($karyawanId) {
            $query->where('id_karyawan', $karyawanId);
        }

        $stats = [
            'total_kehadiran' => $query->clone()->hadir()->count(),
            'total_alfa' => $query->clone()->alfa()->count(),
            'total_izin' => $query->clone()->izin()->count(),
            'total_sakit' => $query->clone()->sakit()->count(),
            'total_terlambat' => $query->clone()->terlambat()->count(),
            'rata_rata_jam_kerja' => $query->clone()->hadir()->avg(DB::raw('TIMESTAMPDIFF(MINUTE, jam_masuk, jam_keluar)')) / 60,
            'total_menit_terlambat' => $query->clone()->sum('terlambat_menit'),
            'total_menit_pulang_awal' => $query->clone()->sum('pulang_awal_menit')
        ];

        return $stats;
    }

    /**
     * Get daily attendance report
     */
    public function getLaporanHarian($tanggal = null)
    {
        $tanggal = $tanggal ?? now()->toDateString();

        $karyawanList = Karyawan::where('status', 'aktif')
            ->with(['jabatan', 'cabang'])
            ->get();

        $absensiList = Absensi::with(['karyawan.jabatan', 'jadwalKerja.shift'])
            ->whereDate('tanggal', $tanggal)
            ->get()
            ->keyBy('id_karyawan');

        $laporan = [];

        foreach ($karyawanList as $karyawan) {
            $absensi = $absensiList->get($karyawan->id_karyawan);

            $laporan[] = [
                'karyawan' => $karyawan,
                'absensi' => $absensi,
                'status' => $absensi ? $absensi->status : 'Belum Absen',
                'jam_masuk' => $absensi ? $absensi->jam_masuk : null,
                'jam_keluar' => $absensi ? $absensi->jam_keluar : null,
                'terlambat' => $absensi ? $absensi->terlambat_menit : 0,
                'durasi_kerja' => $absensi ? $absensi->durasi_kerja_format : '-'
            ];
        }

        return $laporan;
    }

    /**
     * Calculate lateness in minutes
     */
    private function hitungTerlambat($shift, $jamMasuk)
    {
        if (!$shift || !$shift->jam_masuk) {
            return 0;
        }

        $jamMasukShift = Carbon::parse($shift->jam_masuk);
        $jamMasukActual = Carbon::parse($jamMasuk);

        if ($jamMasukActual->gt($jamMasukShift)) {
            return $jamMasukActual->diffInMinutes($jamMasukShift);
        }

        return 0;
    }

    /**
     * Calculate early leave in minutes
     */
    private function hitungPulangAwal($shift, $jamKeluar)
    {
        if (!$shift || !$shift->jam_keluar) {
            return 0;
        }

        $jamKeluarShift = Carbon::parse($shift->jam_keluar);
        $jamKeluarActual = Carbon::parse($jamKeluar);

        if ($jamKeluarActual->lt($jamKeluarShift)) {
            return $jamKeluarShift->diffInMinutes($jamKeluarActual);
        }

        return 0;
    }

    /**
     * Auto mark absent for employees who didn't check in
     */
    public function autoMarkAbsent($tanggal = null)
    {
        $tanggal = $tanggal ?? now()->toDateString();

        // Ambil semua jadwal untuk tanggal ini
        $jadwalList = JadwalKerja::whereDate('tanggal', $tanggal)
            ->with('karyawan')
            ->get();

        $markedCount = 0;

        foreach ($jadwalList as $jadwal) {
            // Cek apakah sudah ada absensi
            $absensi = Absensi::where('id_karyawan', $jadwal->id_karyawan)
                ->whereDate('tanggal', $tanggal)
                ->first();

            if (!$absensi) {
                // Mark as absent
                Absensi::create([
                    'id_karyawan' => $jadwal->id_karyawan,
                    'id_jadwal' => $jadwal->id_jadwal,
                    'tanggal' => $tanggal,
                    'status' => 'Alfa',
                    'keterangan' => 'Auto marked absent - tidak ada check in'
                ]);

                $markedCount++;
            }
        }

        return $markedCount;
    }
}
