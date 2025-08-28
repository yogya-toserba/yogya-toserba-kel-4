<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksi';
    protected $primaryKey = 'id_transaksi';
    
    protected $fillable = [
        'id_pelanggan',
        'tanggal_transaksi',
        'total_belanja',
        'id_cabang',
        'poin_yang_didapatkan',
        'poin_yang_digunakan',
        'id_kas',
    ];

    protected $dates = [
        'tanggal_transaksi'
    ];

    protected $casts = [
        'total_belanja' => 'decimal:2',
        'tanggal_transaksi' => 'date'
    ];

    /**
     * Relasi ke pelanggan
     */
    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'id_pelanggan', 'id_pelanggan');
    }

    /**
     * Relasi ke cabang
     */
    public function cabang()
    {
        return $this->belongsTo(\App\Models\Cabang::class, 'id_cabang', 'id_cabang');
    }

    /**
     * Relasi ke detail transaksi
     */
    public function detailTransaksi()
    {
        return $this->hasMany(DetailTransaksi::class, 'id_transaksi', 'id_transaksi');
    }

    /**
     * Relasi ke kas
     */
    public function kas()
    {
        return $this->belongsTo(\App\Models\Kas::class, 'id_kas', 'id_kas');
    }
}
