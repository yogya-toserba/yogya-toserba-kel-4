<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keranjang extends Model
{
    use HasFactory;
    
    protected $table = 'keranjang';
    
    protected $fillable = [
        'id_pelanggan',
        'id_produk',
        'nama_produk',
        'harga',
        'jumlah',
        'subtotal',
        'gambar',
        'kategori'
    ];
    
    protected $casts = [
        'harga' => 'integer',
        'jumlah' => 'integer',
        'subtotal' => 'integer',
    ];
    
    // Relationship dengan Pelanggan
    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'id_pelanggan');
    }
    
    // Method untuk menghitung subtotal otomatis
    public function calculateSubtotal()
    {
        $this->subtotal = $this->harga * $this->jumlah;
        return $this;
    }
    
    // Scope untuk mendapatkan keranjang pelanggan tertentu
    public function scopeForPelanggan($query, $pelangganId)
    {
        return $query->where('id_pelanggan', $pelangganId);
    }
}space App\Models;

use Illuminate\Database\Eloquent\Model;

class Keranjang extends Model
{
    //
}
