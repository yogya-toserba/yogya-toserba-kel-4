<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Absensi;
use App\Models\Karyawan;
use App\Models\JadwalKerja;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class KaryawanAbsensiController extends Controller
{
    public function index()
    {
        return view('karyawan.index');
    }

    public function checkIn(Request $request)
    {
        try {
            $request->validate([
                'id_karyawan' => 'required|exists:karyawan,id_karyawan',
                'keterangan' => 'nullable|string|max:255'
            ]);

            $karyawan = Karyawan::where('id_karyawan', $request->id_karyawan)->first();
            $today = Carbon::today();

            // Cek apakah sudah absen masuk hari ini (langsung ke tabel absensi)
            $existingAbsensi = Absensi::where('id_karyawan', $request->id_karyawan)
                ->where('tanggal', $today)
                ->first();

            if ($existingAbsensi && $existingAbsensi->jam_masuk) {
                return response()->json([
                    'success' => false,
                    'message' => 'Anda sudah melakukan absen masuk hari ini.'
                ]);
            }

            $jamMasuk = Carbon::now();
            $jamKerja = Carbon::parse('08:00:00'); // Jam kerja standar
            $terlambatMenit = $jamMasuk > $jamKerja ? $jamMasuk->diffInMinutes($jamKerja) : 0;

            if ($existingAbsensi) {
                // Update existing record
                $existingAbsensi->update([
                    'jam_masuk' => $jamMasuk,
                    'terlambat_menit' => $terlambatMenit,
                    'status' => 'Hadir',
                    'keterangan' => $request->keterangan
                ]);
            } else {
                // Create new record tanpa bergantung pada jadwal_kerja
                Absensi::create([
                    'id_karyawan' => $request->id_karyawan,
                    'tanggal' => $today,
                    'jam_masuk' => $jamMasuk,
                    'terlambat_menit' => $terlambatMenit,
                    'status' => 'Hadir',
                    'keterangan' => $request->keterangan
                ]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Berhasil melakukan absen masuk.',
                'data' => [
                    'jam_masuk' => $jamMasuk->format('H:i:s'),
                    'terlambat' => $terlambatMenit > 0 ? "Terlambat {$terlambatMenit} menit" : 'Tepat waktu'
                ]
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak valid: ' . implode(', ', $e->validator->errors()->all())
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ]);
        }
    }

    public function checkOut(Request $request)
    {
        $request->validate([
            'id_karyawan' => 'required|exists:karyawan,id_karyawan',
            'keterangan' => 'nullable|string|max:255'
        ]);

        $today = Carbon::today();
        $karyawan = Karyawan::where('id_karyawan', $request->id_karyawan)->first();

        // Cari data absensi hari ini langsung dari tabel absensi
        $absensi = Absensi::where('id_karyawan', $request->id_karyawan)
            ->where('tanggal', $today)
            ->first();

        if (!$absensi || !$absensi->jam_masuk) {
            return response()->json([
                'success' => false,
                'message' => 'Anda belum melakukan absen masuk hari ini.'
            ]);
        }

        if ($absensi->jam_keluar) {
            return response()->json([
                'success' => false,
                'message' => 'Anda sudah melakukan absen keluar hari ini.'
            ]);
        }

        $jamKeluar = Carbon::now();
        $jamMasuk = Carbon::parse($absensi->jam_masuk);
        $durasiKerjaJam = $jamKeluar->diffInHours($jamMasuk);
        $durasiKerjaMenit = $jamKeluar->diffInMinutes($jamMasuk);

        // Update absensi dengan jam keluar
        $absensi->update([
            'jam_keluar' => $jamKeluar,
            'durasi_kerja_jam' => $durasiKerjaJam,
            'durasi_kerja_menit' => $durasiKerjaMenit,
            'keterangan' => $request->keterangan ? $absensi->keterangan . ' | ' . $request->keterangan : $absensi->keterangan
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Berhasil melakukan absen keluar.',
            'data' => [
                'jam_keluar' => $jamKeluar->format('H:i:s'),
                'durasi_kerja' => $durasiKerjaJam . ' jam ' . ($durasiKerjaMenit % 60) . ' menit'
            ]
        ]);
    }

    public function riwayat(Request $request)
    {
        $idKaryawan = $request->get('id_karyawan');
        $bulan = $request->get('bulan', Carbon::now()->month);
        $tahun = $request->get('tahun', Carbon::now()->year);

        if (!$idKaryawan) {
            return response()->json([
                'success' => false,
                'message' => 'ID Karyawan diperlukan.'
            ]);
        }

        $karyawan = Karyawan::find($idKaryawan);
        if (!$karyawan) {
            return response()->json([
                'success' => false,
                'message' => 'Karyawan tidak ditemukan.'
            ]);
        }

        $riwayat = Absensi::where('id_karyawan', $idKaryawan)
            ->whereMonth('tanggal', $bulan)
            ->whereYear('tanggal', $tahun)
            ->orderBy('tanggal', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'data' => [
                'karyawan' => $karyawan,
                'riwayat' => $riwayat,
                'statistik' => [
                    'total_hadir' => $riwayat->where('status', 'Hadir')->count(),
                    'total_terlambat' => $riwayat->where('terlambat_menit', '>', 0)->count(),
                    'total_alfa' => $riwayat->whereIn('status', ['Alfa', 'Alpa'])->count(),
                    'total_izin' => $riwayat->where('status', 'Izin')->count(),
                    'total_sakit' => $riwayat->where('status', 'Sakit')->count(),
                ]
            ]
        ]);
    }

    public function cariKaryawan(Request $request)
    {
        $search = $request->get('search', '');

        $karyawan = Karyawan::with('jabatan')
            ->where('nama', 'like', "%{$search}%")
            ->orWhere('id_karyawan', 'like', "%{$search}%")
            ->where('status', 'Aktif')
            ->limit(10)
            ->get();

        return response()->json([
            'success' => true,
            'data' => $karyawan
        ]);
    }

    public function statusHariIni(Request $request)
    {
        $idKaryawan = $request->get('id_karyawan');
        $today = Carbon::today();

        // Cari absensi hari ini langsung dari tabel absensi
        $absensi = Absensi::where('id_karyawan', $idKaryawan)
            ->where('tanggal', $today)
            ->first();

        return response()->json([
            'success' => true,
            'data' => [
                'absensi' => $absensi,
                'sudah_checkin' => $absensi && $absensi->jam_masuk ? true : false,
                'sudah_checkout' => $absensi && $absensi->jam_keluar ? true : false
            ]
        ]);
    }

    public function submitIzinSakit(Request $request)
    {
        try {
            $request->validate([
                'id_karyawan' => 'required|exists:karyawan,id_karyawan',
                'jenis' => 'required|in:Izin,Sakit',
                'keterangan' => 'required|string|max:255',
                'tanggal' => 'required|date'
            ]);

            $tanggal = Carbon::parse($request->tanggal);
            $today = Carbon::today();

            // Validasi tanggal tidak boleh masa lalu (kecuali hari ini)
            if ($tanggal->lt($today)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Tidak dapat mengajukan izin/sakit untuk tanggal yang sudah berlalu.'
                ]);
            }

            // Cek apakah sudah ada absensi di tanggal tersebut
            $existingAbsensi = Absensi::where('id_karyawan', $request->id_karyawan)
                ->where('tanggal', $tanggal)
                ->first();

            if ($existingAbsensi) {
                return response()->json([
                    'success' => false,
                    'message' => 'Sudah ada catatan absensi untuk tanggal tersebut.'
                ]);
            }

            // Buat record absensi baru
            $absensi = Absensi::create([
                'id_karyawan' => $request->id_karyawan,
                'tanggal' => $tanggal,
                'status' => $request->jenis,
                'keterangan' => $request->keterangan,
                'jam_masuk' => null,
                'jam_keluar' => null,
                'terlambat_menit' => 0
            ]);

            return response()->json([
                'success' => true,
                'message' => "Pengajuan {$request->jenis} berhasil disubmit untuk tanggal " . $tanggal->format('d/m/Y'),
                'data' => $absensi
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ]);
        }
    }
}
