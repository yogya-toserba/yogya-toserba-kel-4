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
        'status',
        'keterangan',
        'tanggal',
        'jam_masuk',
        'jam_keluar',
        'terlambat_menit',
        'pulang_awal_menit'
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

    // Methods
    public function isHadir()
    {
        return $this->status === 'Hadir';
    }

    public function isTerlambat()
    {
        return $this->terlambat_menit > 0;
    }

    public function isPulangAwal()
    {
        return $this->pulang_awal_menit > 0;
    }

    public function getDurasiKerjaAttribute()
    {
        if (!$this->jam_masuk || !$this->jam_keluar) {
            return 0;
        }

        $masuk = \Carbon\Carbon::parse($this->jam_masuk);
        $keluar = \Carbon\Carbon::parse($this->jam_keluar);

        return $masuk->diffInHours($keluar);
    }
}
