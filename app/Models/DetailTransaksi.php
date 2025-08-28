<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailTransaksi extends Model
{
    use HasFactory;

    protected $table = 'detail_transaksi';
    protected $primaryKey = 'id_detail_penjualan';
    
    protected $fillable = [
        'id_transaksi',
        'id_produk',
        'nama_barang',
        'jumlah_barang',
        'total_harga',
    ];

    protected $casts = [
        'total_harga' => 'decimal:2'
    ];

    /**
     * Relasi ke transaksi
     */
    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class, 'id_transaksi', 'id_transaksi');
    }

    /**
     * Relasi ke produk (stok_produk)
     */
    public function produk()
    {
        return $this->belongsTo(StokGudangPusat::class, 'id_produk', 'id_produk');
    }
}
