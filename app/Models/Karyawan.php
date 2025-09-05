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

    // Relationship with Absensi table (jika model Absensi ada)
    // public function absensi()
    // {
    //     return $this->hasMany(Absensi::class, 'id_karyawan', 'id_karyawan');
    // }

    // Method untuk menghitung total kehadiran dalam periode tertentu
    public function getTotalKehadiranBulan($tahun, $bulan)
    {
        // Simulasi data kehadiran - nanti bisa diganti dengan query ke tabel absensi
        return rand(18, 22); // Simulasi 18-22 hari hadir
    }

    // Method untuk generate gaji otomatis
    public function generateGajiOtomatis($periode)
    {
        if (!$this->jabatan) {
            return null;
        }

        $tahun = date('Y', strtotime($periode));
        $bulan = date('m', strtotime($periode));

        $totalHariHadir = $this->getTotalKehadiranBulan($tahun, $bulan);
        $perhitunganGaji = $this->jabatan->hitungGaji($totalHariHadir);

        return [
            'id_karyawan' => $this->id_karyawan,
            'total_hari_hadir' => $totalHariHadir,
            'total_hari_kerja' => $this->jabatan->minimal_hari_kerja,
            'periode_gaji' => $periode,
            'gaji_pokok' => $perhitunganGaji['gaji_pokok'],
            'tunjangan' => $perhitunganGaji['tunjangan_jabatan'], // Sesuaikan dengan kolom tabel
            'bonus' => $perhitunganGaji['bonus_kehadiran'], // Sesuaikan dengan kolom tabel
            'potongan_absen' => $perhitunganGaji['potongan_absen'],
            'jumlah_gaji' => $perhitunganGaji['jumlah_gaji'],
            'status' => 'pending',
            'is_auto_generated' => true,
            'keterangan' => 'Gaji digenerate otomatis berdasarkan jabatan: ' . $this->jabatan->nama_jabatan
        ];
    }

    // Relationship with Shift table (commented until Shift model is created)
    // public function shift()
    // {
    //     return $this->belongsTo(Shift::class, 'id_shift', 'id_shift');
    // }

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
