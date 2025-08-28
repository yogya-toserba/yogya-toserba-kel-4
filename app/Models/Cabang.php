<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cabang extends Model
{
    use HasFactory;
    
    protected $table = 'cabang';
    protected $primaryKey = 'id_cabang';
    
    protected $fillable = [
        'nama_cabang',
        'kategori',
        'alamat',
        'wilayah'
    ];
    
    /**
     * Relasi ke transaksi
     */
    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'id_cabang', 'id_cabang');
    }
    
    /**
     * Relasi ke stok produk
     */
    public function stokProduk()
    {
        return $this->hasMany(StokGudangPusat::class, 'id_cabang', 'id_cabang');
    }
    
    /**
     * Scope untuk cabang berdasarkan wilayah
     */
    public function scopeWilayah($query, $wilayah)
    {
        return $query->where('wilayah', $wilayah);
    }
}
