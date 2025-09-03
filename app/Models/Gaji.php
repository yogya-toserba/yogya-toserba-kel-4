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
        'total_hari_hadir',
        'total_hari_kerja',
        'gaji_pokok',
        'tunjangan',
        'bonus',
        'potongan_absen',
        'lembur_jam',
        'lembur_tarif',
        'total_lembur',
        'potongan_bpjs',
        'potongan_pajak',
        'potongan_lain',
        'total_potongan',
        'total_gaji',
        'status',
        'periode_gaji',
        'is_auto_generated',
        'keterangan'
    ];

    protected $casts = [
        'gaji_pokok' => 'decimal:2',
        'tunjangan' => 'decimal:2',
        'bonus' => 'decimal:2',
        'potongan_absen' => 'decimal:2',
        'lembur_jam' => 'decimal:2',
        'lembur_tarif' => 'decimal:2',
        'total_lembur' => 'decimal:2',
        'potongan_bpjs' => 'decimal:2',
        'potongan_pajak' => 'decimal:2',
        'potongan_lain' => 'decimal:2',
        'total_potongan' => 'decimal:2',
        'total_gaji' => 'decimal:2',
        'periode_gaji' => 'date',
        'is_auto_generated' => 'boolean'
    ];

    // Relationship with Karyawan
    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'id_karyawan', 'id_karyawan');
    }

    // Relationship with Absensi (commented until Absensi model is created)
    // public function absensi()
    // {
    //     return $this->belongsTo(Absensi::class, 'id_absensi', 'id_absensi');
    // }

    // Scope untuk filter berdasarkan status
    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    // Scope untuk filter berdasarkan periode
    public function scopeByPeriode($query, $periode)
    {
        return $query->where('periode_gaji', $periode);
    }

    // Method untuk approve gaji
    public function approve()
    {
        $this->update(['status' => 'approved']);
    }

    // Method untuk mark as paid
    public function markAsPaid()
    {
        $this->update(['status' => 'paid']);
    }

    // Accessor untuk format currency
    public function getFormattedTotalGajiAttribute()
    {
        return 'Rp ' . number_format($this->total_gaji, 0, ',', '.');
    }

    // Accessor untuk format gaji pokok
    public function getFormattedGajiPokokAttribute()
    {
        return 'Rp ' . number_format($this->gaji_pokok, 0, ',', '.');
    }

    // Static method untuk generate gaji otomatis semua karyawan
    public static function generateGajiOtomatisSemua($periode)
    {
        $karyawan = Karyawan::with('jabatan')->whereNotNull('jabatan_id')->get();
        $gajiGenerated = [];

        foreach ($karyawan as $emp) {
            // Cek apakah gaji untuk periode ini sudah ada
            $existingGaji = self::where('id_karyawan', $emp->id_karyawan)
                ->where('periode_gaji', $periode)
                ->first();

            if (!$existingGaji) {
                $dataGaji = $emp->generateGajiOtomatis($periode);
                if ($dataGaji) {
                    $gaji = self::create($dataGaji);
                    $gajiGenerated[] = $gaji;
                }
            }
        }

        return $gajiGenerated;
    }
}
