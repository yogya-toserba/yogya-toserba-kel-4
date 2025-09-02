<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Produk extends Model
{
    use HasFactory;

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
