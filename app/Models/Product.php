<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'nama_barang',
        'image',
        'deskripsi',
        'sku',
        'unit',
        'harga_beli',
        'harga_jual',
        'status',
        'tanggal'
    ];
}
