@extends('layouts.app')

@section('title', 'Otomotif - MyYOGYA')

@section('content')
<!-- Category Header -->
<div class="category-header">
    <div class="container">
        <nav class="breadcrumb-custom">
            <a href="{{ route('dashboard') }}">Beranda</a>
            <span class="mx-2">/</span>
            <span>Otomotif</span>
        </nav>
        
        <h1 class="display-5 fw-bold mb-3">🚗 Otomotif</h1>
        <p class="lead mb-0">Aksesoris dan spare part untuk kendaraan Anda</p>
    </div>
</div>

<div class="container">
    <!-- Filter Section -->
    <div class="filter-section">
        <div class="row align-items-center">
            <div class="col-md-8">
                <div class="row g-3">
                    <div class="col-md-3">
                        <select class="form-select">
                            <option>Semua Kategori</option>
                            <option>Aksesoris Mobil</option>
                            <option>Aksesoris Motor</option>
                            <option>Spare Part</option>
                            <option>Tools & Equipment</option>
                            <option>Ban & Velg</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select class="form-select">
                            <option>Rentang Harga</option>
                            <option>< Rp 100.000</option>
                            <option>Rp 100.000-500.000</option>
                            <option>Rp 500.000-1.000.000</option>
                            <option>> Rp 1.000.000</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select class="form-select">
                            <option>Urutkan</option>
                            <option>Harga Terendah</option>
                            <option>Harga Tertinggi</option>
                            <option>Terpopuler</option>
                            <option>Terbaru</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-4 text-end">
                <small class="text-muted">Menampilkan 1-12 dari 98 produk</small>
            </div>
        </div>
    </div>

    <!-- Products Grid -->
    <div class="product-grid">
        @foreach([
            [
                'name' => 'Karpet Mobil Universal 5 Pcs',
                'price' => 'Rp 125.000',
                'original_price' => 'Rp 150.000',
                'discount' => '17%',
                'image' => 'https://via.placeholder.com/300x300/f0f0f0/888?text=Karpet+Mobil',
                'rating' => 4.5,
                'reviews' => 298
            ],
            [
                'name' => 'Car Holder HP Magnetik Dashboard',
                'price' => 'Rp 45.000',
                'original_price' => '',
                'discount' => '',
                'image' => 'https://via.placeholder.com/300x300/f0f0f0/888?text=Car+Holder',
                'rating' => 4.3,
                'reviews' => 456
            ],
            [
                'name' => 'Oli Mesin Shell Helix Ultra 1L',
                'price' => 'Rp 189.000',
                'original_price' => 'Rp 210.000',
                'discount' => '10%',
                'image' => 'https://via.placeholder.com/300x300/f0f0f0/888?text=Shell+Helix',
                'rating' => 4.7,
                'reviews' => 234
            ],
            [
                'name' => 'Sarung Jok Mobil Universal',
                'price' => 'Rp 285.000',
                'original_price' => '',
                'discount' => '',
                'image' => 'https://via.placeholder.com/300x300/f0f0f0/888?text=Sarung+Jok',
                'rating' => 4.4,
                'reviews' => 167
            ],
            [
                'name' => 'Dashcam 70mai A800 4K',
                'price' => 'Rp 1.250.000',
                'original_price' => 'Rp 1.450.000',
                'discount' => '14%',
                'image' => 'https://via.placeholder.com/300x300/f0f0f0/888?text=Dashcam+70mai',
                'rating' => 4.8,
                'reviews' => 89
            ],
            [
                'name' => 'Ban Mobil Bridgestone Turanza 185/65R15',
                'price' => 'Rp 650.000',
                'original_price' => '',
                'discount' => '',
                'image' => 'https://via.placeholder.com/300x300/f0f0f0/888?text=Ban+Bridgestone',
                'rating' => 4.6,
                'reviews' => 145
            ],
            [
                'name' => 'Helm Half Face KYT DJ Maru',
                'price' => 'Rp 285.000',
                'original_price' => 'Rp 325.000',
                'discount' => '12%',
                'image' => 'https://via.placeholder.com/300x300/f0f0f0/888?text=Helm+KYT',
                'rating' => 4.7,
                'reviews' => 378
            ],
            [
                'name' => 'Kunci Pas Set 8-24mm 10 Pcs',
                'price' => 'Rp 85.000',
                'original_price' => 'Rp 105.000',
                'discount' => '19%',
                'image' => 'https://via.placeholder.com/300x300/f0f0f0/888?text=Kunci+Pas+Set',
                'rating' => 4.4,
                'reviews' => 267
            ],
            [
                'name' => 'Air Freshener Glade Car Gel',
                'price' => 'Rp 35.000',
                'original_price' => '',
                'discount' => '',
                'image' => 'https://via.placeholder.com/300x300/f0f0f0/888?text=Air+Freshener',
                'rating' => 4.2,
                'reviews' => 567
            ],
            [
                'name' => 'Velg Racing HSR Ring 15" PCD 4x100',
                'price' => 'Rp 1.850.000',
                'original_price' => 'Rp 2.100.000',
                'discount' => '12%',
                'image' => 'https://via.placeholder.com/300x300/f0f0f0/888?text=Velg+HSR',
                'rating' => 4.6,
                'reviews' => 67
            ],
            [
                'name' => 'Charger Mobil Fast Charging 3.0A',
                'price' => 'Rp 75.000',
                'original_price' => '',
                'discount' => '',
                'image' => 'https://via.placeholder.com/300x300/f0f0f0/888?text=Charger+Mobil',
                'rating' => 4.5,
                'reviews' => 234
            ],
            [
                'name' => 'Wiper Blade Bosch Advantage 22"',
                'price' => 'Rp 125.000',
                'original_price' => 'Rp 145.000',
                'discount' => '14%',
                'image' => 'https://via.placeholder.com/300x300/f0f0f0/888?text=Wiper+Bosch',
                'rating' => 4.7,
                'reviews' => 189
            ]
        ] as $product)
        <div class="product-card">
            <div class="product-image">
                <img src="{{ $product['image'] }}" alt="{{ $product['name'] }}">
                @if($product['discount'])
                <span class="discount-badge">-{{ $product['discount'] }}</span>
                @endif
                <button class="wishlist-btn">
                    <i class="far fa-heart"></i>
                </button>
            </div>
            
            <div class="product-info">
                <h6 class="product-title">{{ $product['name'] }}</h6>
                
                <div class="product-rating">
                    <div class="stars">
                        @for($i = 1; $i <= 5; $i++)
                        <i class="fas fa-star{{ $i <= floor($product['rating']) ? '' : ' text-muted' }}"></i>
                        @endfor
                    </div>
                    <span class="review-count">({{ $product['reviews'] }})</span>
                </div>
                
                <div class="product-price">
                    <span class="current-price">{{ $product['price'] }}</span>
                    @if($product['original_price'])
                    <span class="original-price">{{ $product['original_price'] }}</span>
                    @endif
                </div>
                
                <button class="add-to-cart-btn">
                    <i class="fas fa-shopping-cart me-2"></i>Tambah ke Keranjang
                </button>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Pagination -->
    <nav class="pagination-custom" aria-label="Product pagination">
        <ul class="pagination">
            <li class="page-item disabled">
                <span class="page-link">Previous</span>
            </li>
            <li class="page-item active">
                <span class="page-link">1</span>
            </li>
            <li class="page-item">
                <a class="page-link" href="#">2</a>
            </li>
            <li class="page-item">
                <a class="page-link" href="#">3</a>
            </li>
            <li class="page-item">
                <a class="page-link" href="#">4</a>
            </li>
            <li class="page-item">
                <a class="page-link" href="#">Next</a>
            </li>
        </ul>
    </nav>
</div>
@endsection