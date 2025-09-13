<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description', 
        'price',
        'original_price',
        'discount_percentage',
        'image',
        'gallery',
        'category',
        'subcategory',
        'rating',
        'reviews_count',
        'stock',
        'sizes',
        'colors',
        'features',
        'is_active'
    ];

    protected $casts = [
        'gallery' => 'array',
        'sizes' => 'array',
        'colors' => 'array',
        'features' => 'array',
        'price' => 'decimal:2',
        'original_price' => 'decimal:2',
        'rating' => 'decimal:1',
        'is_active' => 'boolean'
    ];

    // Accessor untuk format harga
    public function getFormattedPriceAttribute()
    {
        return 'Rp ' . number_format((float)$this->price, 0, ',', '.');
    }

    public function getFormattedOriginalPriceAttribute()
    {
        return $this->original_price ? 'Rp ' . number_format((float)$this->original_price, 0, ',', '.') : null;
    }

    // Scope untuk kategori
    // Scope untuk filter berdasarkan kategori
    public function scopeByCategory($query, $category)
    {
        return $query->where('category', '=', $category);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeInStock($query)
    {
        return $query->where('stock', '>', 0);
    }

    // Method untuk mendapatkan ukuran dengan detail
    public function getSizeDetails()
    {
        $sizeDetails = [
            'XS' => ['chest' => 46, 'length' => 65, 'shoulder' => 38],
            'S' => ['chest' => 50, 'length' => 68, 'shoulder' => 40],
            'M' => ['chest' => 54, 'length' => 71, 'shoulder' => 42],
            'L' => ['chest' => 58, 'length' => 74, 'shoulder' => 44],
            'XL' => ['chest' => 62, 'length' => 77, 'shoulder' => 46],
            'XXL' => ['chest' => 66, 'length' => 80, 'shoulder' => 48],
            // Ukuran sepatu
            '39' => ['length' => 25.0, 'width' => 9.5],
            '40' => ['length' => 25.5, 'width' => 10.0],
            '41' => ['length' => 26.0, 'width' => 10.0],
            '42' => ['length' => 26.5, 'width' => 10.5],
            '43' => ['length' => 27.0, 'width' => 10.5],
            '44' => ['length' => 27.5, 'width' => 11.0],
        ];

        $result = [];
        if ($this->sizes) {
            foreach ($this->sizes as $size) {
                if (isset($sizeDetails[$size])) {
                    $result[$size] = $sizeDetails[$size];
                }
            }
        }
        
        return $result;
    }

    // Method untuk mendapatkan warna dengan hex code
    public function getColorDetails()
    {
        $colorMap = [
            'Hitam' => '#000000',
            'Putih' => '#ffffff', 
            'Merah' => '#dc3545',
            'Biru' => '#0d6efd',
            'Hijau' => '#198754',
            'Kuning' => '#ffc107',
            'Navy' => '#1e3a8a',
            'Abu-abu' => '#6c757d',
            'Pink' => '#e91e63',
            'Orange' => '#ff5722',
            'Ungu' => '#6f42c1',
            'Coklat' => '#8b4513'
        ];

        $result = [];
        if ($this->colors) {
            foreach ($this->colors as $color) {
                $result[$color] = $colorMap[$color] ?? '#6c757d';
            }
        }
        
        return $result;
    }

    // Method untuk mendapatkan kategori yang tersedia
    public static function getAvailableCategories()
    {
        return [
            'fashion' => [
                'name' => 'Fashion',
                'icon' => 'fas fa-tshirt',
                'color' => 'danger'
            ],
            'elektronik' => [
                'name' => 'Elektronik', 
                'icon' => 'fas fa-laptop',
                'color' => 'primary'
            ],
            'makanan' => [
                'name' => 'Makanan & Minuman',
                'icon' => 'fas fa-hamburger', 
                'color' => 'warning'
            ],
            'perawatan' => [
                'name' => 'Perawatan & Kecantikan',
                'icon' => 'fas fa-spa',
                'color' => 'info'
            ],
            'rumah-tangga' => [
                'name' => 'Rumah Tangga',
                'icon' => 'fas fa-home',
                'color' => 'success'
            ],
            'olahraga' => [
                'name' => 'Olahraga',
                'icon' => 'fas fa-dumbbell',
                'color' => 'dark'
            ],
            'otomotif' => [
                'name' => 'Otomotif',
                'icon' => 'fas fa-car',
                'color' => 'secondary'
            ],
            'buku' => [
                'name' => 'Buku & Alat Tulis',
                'icon' => 'fas fa-book',
                'color' => 'muted'
            ]
        ];
    }
}
