<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Karyawan extends Model
{
    use HasFactory;

    protected $table = 'karyawan';
    protected $primaryKey = 'id_karyawan';

    protected $fillable = [
        'nama',
        'divisi',
        'alamat',
        'email',
        'tanggal_lahir',
        'nomer_telepon',
        'id_shift',
        'id_cabang',
        'jabatan_id',
        'status'
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
    ];

    // Relationship with Cabang table
    public function cabang()
    {
        return $this->belongsTo(Cabang::class, 'id_cabang', 'id_cabang');
    }

    // Relationship with Jabatan table
    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class, 'jabatan_id');
    }

    // Relationship with Gaji table
    public function gaji()
    {
        return $this->hasMany(Gaji::class, 'id_karyawan', 'id_karyawan');
    }

    // Relationship with Absensi table
    public function absensi()
    {
        return $this->hasManyThrough(
            Absensi::class,
            JadwalKerja::class,
            'id_karyawan',
            'id_jadwal',
            'id_karyawan',
            'id_jadwal'
        );
    }

    // Relationship with JadwalKerja table
    public function jadwalKerja()
    {
        return $this->hasMany(JadwalKerja::class, 'id_karyawan', 'id_karyawan');
    }

    // Method untuk menghitung total kehadiran dalam periode tertentu
    public function getTotalKehadiranBulan($tahun, $bulan)
    {
        return $this->absensi()
            ->whereYear('absensi.tanggal', $tahun)
            ->whereMonth('absensi.tanggal', $bulan)
            ->where('absensi.status', 'Hadir')
            ->count();
    }

    // Method untuk menghitung total absensi dalam periode tertentu
    public function getTotalAbsensiBulan($tahun, $bulan)
    {
        return $this->absensi()
            ->whereYear('absensi.tanggal', $tahun)
            ->whereMonth('absensi.tanggal', $bulan)
            ->whereIn('absensi.status', ['Tidak Hadir', 'Sakit', 'Izin'])
            ->count();
    }

    // Method untuk menghitung total keterlambatan dalam periode tertentu
    public function getTotalTerlambatBulan($tahun, $bulan)
    {
        return $this->absensi()
            ->whereYear('absensi.tanggal', $tahun)
            ->whereMonth('absensi.tanggal', $bulan)
            ->where('absensi.terlambat_menit', '>', 0)
            ->sum('absensi.terlambat_menit');
    }

    // Method untuk mendapatkan statistik absensi bulan
    public function getStatistikAbsensiBulan($tahun, $bulan)
    {
        $totalJadwal = $this->jadwalKerja()
            ->whereYear('jadwal_kerja.tanggal', $tahun)
            ->whereMonth('jadwal_kerja.tanggal', $bulan)
            ->count();

        $totalHadir = $this->getTotalKehadiranBulan($tahun, $bulan);
        $totalAbsen = $this->getTotalAbsensiBulan($tahun, $bulan);
        $totalTerlambat = $this->getTotalTerlambatBulan($tahun, $bulan);

        return [
            'total_jadwal' => $totalJadwal,
            'total_hadir' => $totalHadir,
            'total_absen' => $totalAbsen,
            'total_terlambat_menit' => $totalTerlambat,
            'persentase_kehadiran' => $totalJadwal > 0 ? round(($totalHadir / $totalJadwal) * 100, 2) : 0
        ];
    }

    // Method untuk generate gaji otomatis berdasarkan absensi
    public function generateGajiOtomatis($periode)
    {
        if (!$this->jabatan) {
            return null;
        }

        $tahun = date('Y', strtotime($periode));
        $bulan = date('m', strtotime($periode));

        // Ambil statistik absensi
        $statsAbsensi = $this->getStatistikAbsensiBulan($tahun, $bulan);
        $totalHariHadir = $statsAbsensi['total_hadir'];
        $totalHariAbsen = $statsAbsensi['total_absen'];
        $totalTerlambat = $statsAbsensi['total_terlambat_menit'];

        // Hitung gaji berdasarkan jabatan dan kehadiran
        $perhitunganGaji = $this->jabatan->hitungGaji($totalHariHadir);

        // Hitung potongan tambahan berdasarkan keterlambatan
        $potonganTerlambat = ($totalTerlambat / 60) * 50000; // Rp 50,000 per jam terlambat

        // Hitung potongan absensi tambahan
        $potonganAbsenTambahan = $totalHariAbsen * 100000; // Rp 100,000 per hari absen

        $totalPotongan = $perhitunganGaji['potongan_absen'] + $potonganTerlambat + $potonganAbsenTambahan;

        return [
            'id_karyawan' => $this->id_karyawan,
            'total_hari_hadir' => $totalHariHadir,
            'total_hari_absen' => $totalHariAbsen,
            'total_terlambat_menit' => $totalTerlambat,
            'total_hari_kerja' => $this->jabatan->minimal_hari_kerja ?? 22,
            'periode_gaji' => $periode,
            'gaji_pokok' => $perhitunganGaji['gaji_pokok'],
            'tunjangan' => $perhitunganGaji['tunjangan_jabatan'],
            'bonus' => $perhitunganGaji['bonus_kehadiran'],
            'potongan_absen' => $perhitunganGaji['potongan_absen'],
            'potongan_terlambat' => $potonganTerlambat,
            'potongan_absen_tambahan' => $potonganAbsenTambahan,
            'total_potongan' => $totalPotongan,
            'jumlah_gaji' => $perhitunganGaji['gaji_pokok'] + $perhitunganGaji['tunjangan_jabatan'] + $perhitunganGaji['bonus_kehadiran'] - $totalPotongan,
            'status' => 'pending',
            'is_auto_generated' => true,
            'keterangan' => sprintf(
                'Gaji otomatis - Hadir: %d hari, Absen: %d hari, Terlambat: %d menit - %s',
                $totalHariHadir,
                $totalHariAbsen,
                $totalTerlambat,
                $this->jabatan->nama_jabatan
            )
        ];
    }

    // Relationship with Shift table
    public function shift()
    {
        return $this->belongsTo(Shift::class, 'id_shift', 'id_shift');
    }

    // Accessor for formatted phone number
    public function getFormattedPhoneAttribute()
    {
        return '+62 ' . substr($this->nomer_telepon, 1);
    }

    // Accessor for age calculation
    public function getAgeAttribute()
    {
        return Carbon::parse($this->tanggal_lahir)->age;
    }
}
