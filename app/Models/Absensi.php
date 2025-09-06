<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;

    protected $table = 'absensi';
    protected $primaryKey = 'id_absensi';

    protected $fillable = [
        'id_jadwal',
        'id_karyawan',
        'status',
        'keterangan',
        'tanggal',
        'jam_masuk',
        'jam_keluar',
        'durasi_kerja_jam',
        'terlambat_menit',
        'pulang_awal_menit',
        'foto_masuk',
        'foto_keluar',
        'lokasi_masuk',
        'lokasi_keluar',
        'ip_address'
    ];

    protected $casts = [
        'tanggal' => 'date',
        'jam_masuk' => 'datetime:H:i:s',
        'jam_keluar' => 'datetime:H:i:s',
        'terlambat_menit' => 'integer',
        'pulang_awal_menit' => 'integer'
    ];

    // Relationships
    public function jadwalKerja()
    {
        return $this->belongsTo(JadwalKerja::class, 'id_jadwal');
    }

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'id_karyawan', 'id_karyawan');
    }

    public function shift()
    {
        return $this->belongsTo(Shift::class, 'id_shift');
    }

    // Accessor untuk mendapatkan data shift melalui jadwal kerja
    public function getShiftAttribute()
    {
        return $this->jadwalKerja ? $this->jadwalKerja->shift : null;
    }

    // Methods
    public function isHadir()
    {
        return strtolower($this->status) === 'hadir';
    }

    public function isTerlambat()
    {
        return $this->terlambat_menit > 0;
    }

    public function isPulangAwal()
    {
        return $this->pulang_awal_menit > 0;
    }

    public function isAlfa()
    {
        return strtolower($this->status) === 'alfa' || strtolower($this->status) === 'tidak hadir';
    }

    public function isIzin()
    {
        return strtolower($this->status) === 'izin';
    }

    public function isSakit()
    {
        return strtolower($this->status) === 'sakit';
    }

    public function getDurasiKerjaAttribute()
    {
        if (!$this->jam_masuk || !$this->jam_keluar) {
            return 0;
        }

        $masuk = \Carbon\Carbon::parse($this->jam_masuk);
        $keluar = \Carbon\Carbon::parse($this->jam_keluar);

        return $keluar->diffInMinutes($masuk);
    }

    public function getDurasiKerjaFormatAttribute()
    {
        $durasi = $this->durasi_kerja;
        $jam = intval($durasi / 60);
        $menit = $durasi % 60;

        return sprintf('%02d:%02d', $jam, $menit);
    }

    // Scope untuk filter berdasarkan status
    public function scopeHadir($query)
    {
        return $query->where('status', 'Hadir');
    }

    public function scopeAlfa($query)
    {
        return $query->whereIn('status', ['Alfa', 'Alpa', 'Tidak Hadir']);
    }

    public function scopeIzin($query)
    {
        return $query->where('status', 'Izin');
    }

    public function scopeSakit($query)
    {
        return $query->where('status', 'Sakit');
    }

    public function scopeTerlambat($query)
    {
        return $query->where('terlambat_menit', '>', 0);
    }

    public function scopeBulanIni($query)
    {
        return $query->whereMonth('tanggal', now()->month)
            ->whereYear('tanggal', now()->year);
    }

    public function scopeHariIni($query)
    {
        return $query->whereDate('tanggal', now()->toDateString());
    }
}
