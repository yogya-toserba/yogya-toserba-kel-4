<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use HasFactory;

class Produk extends Model
{
    protected $table = 'produks';

    protected $fillable = [
        'nama',
        'sku',
        'unit',
        'harga_beli',
        'harga_jual',
        'gambar',
        'status',
        'deskripsi',
    ];
}
