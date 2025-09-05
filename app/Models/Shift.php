<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    use HasFactory;

    protected $table = 'shift';
    protected $primaryKey = 'id_shift';

    protected $fillable = [
        'nama_shift',
        'jam_mulai',
        'jam_selesai',
        'tunjangan_shift'
    ];

    protected $casts = [
        'jam_mulai' => 'datetime:H:i',
        'jam_selesai' => 'datetime:H:i',
        'tunjangan_shift' => 'decimal:2'
    ];

    // Relationships
    public function jadwalKerja()
    {
        return $this->hasMany(JadwalKerja::class, 'id_shift');
    }

    public function karyawan()
    {
        return $this->hasMany(Karyawan::class, 'id_shift');
    }

    // Methods
    public function getDurasiKerjaAttribute()
    {
        $mulai = \Carbon\Carbon::parse($this->jam_mulai);
        $selesai = \Carbon\Carbon::parse($this->jam_selesai);

        // Handle shift yang melewati midnight
        if ($selesai->lt($mulai)) {
            $selesai->addDay();
        }

        return $mulai->diffInHours($selesai);
    }

    public function isShiftMalam()
    {
        $mulai = \Carbon\Carbon::parse($this->jam_mulai);
        return $mulai->hour >= 22 || $mulai->hour <= 6;
    }
}
