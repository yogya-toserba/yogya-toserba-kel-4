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

    protected $appends = [
        'name', 'description', 'price', 'image', 'formatted_price', 
        'original_price', 'formatted_original_price', 'discount_percentage',
        'rating', 'reviews_count', 'stock', 'colors', 'sizes', 'features',
        'category', 'subcategory', 'gallery'
    ];

    // Relationship ke cabang
    public function cabang()
    {
        return $this->belongsTo(Cabang::class, 'id_cabang', 'id_cabang');
    }

    // Relationship ke kategori
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori', 'id_kategori');
    }

    // Accessor untuk compatibility dengan view fashion
    public function getNameAttribute()
    {
        return $this->nama_barang;
    }

    public function getDescriptionAttribute()
    {
        return $this->deskripsi ?? 'Deskripsi produk ' . $this->nama_barang;
    }

    public function getPriceAttribute()
    {
        return $this->harga_jual;
    }

    public function getImageAttribute()
    {
        return $this->foto;
    }

    public function getFormattedPriceAttribute()
    {
        return 'Rp ' . number_format((float)$this->harga_jual, 0, ',', '.');
    }

    public function getRatingAttribute()
    {
        return 4.5; // Rating default
    }

    public function getReviewsCountAttribute()
    {
        return rand(50, 200); // Review count simulasi
    }

    public function getStockAttribute()
    {
        return $this->stok;
    }

    public function getFeaturesAttribute()
    {
        return [
            'Kualitas Premium',
            'Garansi Resmi',
            'Pengiriman Cepat',
            'Original Product'
        ];
    }

    public function getCategoryAttribute()
    {
        if ($this->kategori) {
            $namaKategori = strtolower($this->kategori->nama_kategori);
            if (strpos($namaKategori, 'fashion') !== false || 
                strpos($namaKategori, 'pakaian') !== false ||
                strpos($namaKategori, 'sepatu') !== false ||
                strpos($namaKategori, 'tas') !== false) {
                return 'fashion';
            } elseif (strpos($namaKategori, 'elektronik') !== false ||
                      strpos($namaKategori, 'gadget') !== false) {
                return 'elektronik';
            } elseif (strpos($namaKategori, 'makanan') !== false ||
                      strpos($namaKategori, 'minuman') !== false) {
                return 'makanan';
            }
        }
        return 'fashion'; // Default ke fashion
    }

    public function getSubcategoryAttribute()
    {
        return $this->kategori->sub_kategori ?? 'Umum';
    }

    public function getGalleryAttribute()
    {
        // Simulasi gallery dengan foto utama
        return [$this->foto, $this->foto, $this->foto];
    }

    // Scope untuk filter kategori fashion
    public static function scopeFashionProducts($query)
    {
        return $query->whereHas('kategori', function($q) {
            $q->where('nama_kategori', 'LIKE', '%fashion%')
              ->orWhere('nama_kategori', 'LIKE', '%pakaian%')
              ->orWhere('nama_kategori', 'LIKE', '%sepatu%')
              ->orWhere('nama_kategori', 'LIKE', '%tas%');
        });
    }

    // Scope untuk produk aktif (stok > 0)
    public static function scopeActive($query)
    {
        return $query->where('stok', '>', 0);
    }

    // Untuk compatibility dengan form yang ada
    public function getNamaBarangAttribute($value)
    {
        return $value;
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
