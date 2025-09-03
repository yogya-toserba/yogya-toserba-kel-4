<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    use HasFactory;

    protected $table = 'jabatan';

    protected $fillable = [
        'nama_jabatan',
        'gaji_pokok',
        'tunjangan_jabatan',
        'bonus_kehadiran_per_hari',
        'minimal_hari_kerja',
        'deskripsi',
        'status'
    ];

    protected $casts = [
        'gaji_pokok' => 'decimal:2',
        'tunjangan_jabatan' => 'decimal:2',
        'bonus_kehadiran_per_hari' => 'decimal:2',
        'status' => 'boolean'
    ];

    // Relationship
    public function karyawan()
    {
        return $this->hasMany(Karyawan::class);
    }

    // Scope
    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    // Method untuk menghitung gaji berdasarkan kehadiran
    public function hitungGaji($totalHariHadir, $totalHariKerja = 22)
    {
        $gajiPerHari = $this->gaji_pokok / $totalHariKerja;
        $gajiPokok = $gajiPerHari * $totalHariHadir;

        $bonusKehadiran = $this->bonus_kehadiran_per_hari * $totalHariHadir;

        // Potongan jika tidak mencapai minimal hari kerja
        $potonganAbsen = 0;
        if ($totalHariHadir < $this->minimal_hari_kerja) {
            $hariAbsen = $this->minimal_hari_kerja - $totalHariHadir;
            $potonganAbsen = $gajiPerHari * $hariAbsen * 0.5; // 50% potongan per hari absen
        }

        $totalGaji = $gajiPokok + $this->tunjangan_jabatan + $bonusKehadiran - $potonganAbsen;

        return [
            'gaji_pokok' => $gajiPokok,
            'tunjangan_jabatan' => $this->tunjangan_jabatan,
            'bonus_kehadiran' => $bonusKehadiran,
            'potongan_absen' => $potonganAbsen,
            'total_gaji' => $totalGaji
        ];
    }

    // Accessor
    public function getFormattedGajiPokokAttribute()
    {
        return 'Rp ' . number_format($this->gaji_pokok, 0, ',', '.');
    }
}
