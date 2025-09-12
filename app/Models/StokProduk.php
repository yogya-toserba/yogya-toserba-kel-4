<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StokProduk extends Model
{
    use HasFactory;

    protected $table = 'stok_produk';
    protected $primaryKey = 'id_produk';

    protected $fillable = [
        'id_cabang',
        'id_kategori', 
        'foto',
        'nama_barang',
        'sku',
        'jumlah_barang',
        'harga_beli',
        'harga_jual',
        'stok',
        'deskripsi'
    ];

    // Relationship ke cabang
    public function cabang()
    {
        return $this->belongsTo(Cabang::class, 'id_cabang', 'id_cabang');
    }

    // Untuk compatibility dengan form yang ada
    public function getNamaBarangAttribute($value)
    {
        return $value;
    }

    public function getImageAttribute()
    {
        return $this->foto;
    }

    public function getHargaBeliAttribute()
    {
        // Kalkulasi sederhana: harga jual - 20% untuk harga beli
        return $this->harga_jual * 0.8;
    }

    public function getUnitAttribute()
    {
        return $this->stok;
    }

    public function getStatusAttribute()
    {
        return $this->stok > 0 ? 'aktif' : 'nonaktif';
    }

    // Accessor untuk backward compatibility
    public function getSkuAttribute($value)
    {
        // Jika ada SKU yang disimpan, gunakan itu. Jika tidak, generate dari ID
        return $value ?: 'SKU-' . str_pad($this->id_produk, 6, '0', STR_PAD_LEFT);
    }
}
