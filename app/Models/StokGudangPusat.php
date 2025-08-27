<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StokGudangPusat extends Model
{
    use HasFactory;

    protected $table = 'stok_gudang_pusat';
    protected $primaryKey = 'id_produk';

    protected $fillable = [
        'tanggal',
        'nama_produk',
        'kategori',
        'deskripsi',
        'satuan',
        'jumlah',
        'harga_beli',
        'harga_jual',
        'foto',
        'status',
        'expired',
    ];

    protected $casts = [
        'expired' => 'date',
        'jumlah' => 'integer',
    ];

    // Relationship with Gudang if needed
    public function gudang()
    {
        return $this->belongsTo(Gudang::class, 'id_gudang');
    }

    // Scope for products that are about to expire
    public function scopeExpiringSoon($query, $days = 30)
    {
        return $query->whereNotNull('expired')
                    ->where('expired', '<=', now()->addDays($days));
    }

    // Scope for low stock items
    public function scopeLowStock($query, $threshold = 10)
    {
        return $query->where('jumlah', '<=', $threshold);
    }

    // Get formatted stock status
    public function getStockStatusAttribute()
    {
        if ($this->jumlah <= 0) {
            return 'Habis';
        } elseif ($this->jumlah <= 10) {
            return 'Stok Rendah';
        } elseif ($this->jumlah <= 50) {
            return 'Stok Sedang';
        } else {
            return 'Stok Tinggi';
        }
    }

    // Get formatted expiry status
    public function getExpiryStatusAttribute()
    {
        if (!$this->expired) {
            return 'Tidak Ada Expired';
        }

        $daysUntilExpiry = now()->diffInDays($this->expired, false);
        
        if ($daysUntilExpiry < 0) {
            return 'Expired';
        } elseif ($daysUntilExpiry <= 7) {
            return 'Akan Expired';
        } elseif ($daysUntilExpiry <= 30) {
            return 'Perlu Perhatian';
        } else {
            return 'Aman';
        }
    }
}
