<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Gaji extends Model
{
    use HasFactory;

    protected $table = 'gaji';
    protected $primaryKey = 'id_gaji';

    protected $fillable = [
        'id_karyawan',
        'id_absensi',
        'jumlah_gaji'
    ];

    protected $casts = [
        'jumlah_gaji' => 'decimal:2',
    ];

    // Relationship with Karyawan
    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'id_karyawan', 'id_karyawan');
    }

    // Relationship with Absensi (if needed)
    public function absensi()
    {
        return $this->belongsTo(Absensi::class, 'id_absensi', 'id_absensi');
    }

    // Accessor untuk format currency
    public function getFormattedJumlahGajiAttribute()
    {
        return 'Rp ' . number_format($this->jumlah_gaji, 0, ',', '.');
    }
}
