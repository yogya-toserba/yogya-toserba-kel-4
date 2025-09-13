<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kategori extends Model
{
    use HasFactory;

    protected $table = 'kategori';
    protected $primaryKey = 'id_kategori';

    protected $fillable = [
        'nama_kategori',
        'sub_kategori'
    ];

    // Relationship ke stok produk
    public function stokProduk()
    {
        return $this->hasMany(StokProduk::class, 'id_kategori', 'id_kategori');
    }
}