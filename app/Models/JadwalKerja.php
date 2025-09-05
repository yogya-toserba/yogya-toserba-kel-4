<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalKerja extends Model
{
    use HasFactory;

    protected $table = 'jadwal_kerja';
    protected $primaryKey = 'id_jadwal';

    protected $fillable = [
        'id_karyawan',
        'id_shift',
        'tanggal'
    ];

    protected $casts = [
        'tanggal' => 'date'
    ];

    // Relationships
    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'id_karyawan');
    }

    public function shift()
    {
        return $this->belongsTo(Shift::class, 'id_shift');
    }

    public function absensi()
    {
        return $this->hasOne(Absensi::class, 'id_jadwal');
    }

    // Methods
    public function hasAbsensi()
    {
        return $this->absensi()->exists();
    }
}
