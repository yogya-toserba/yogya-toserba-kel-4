@extends('layouts.app')

@section('title', 'Elektronik - MyYOGYA')

@section('content')
<!-- Category Header -->
<div class="category-header">
    <div class="container">
        <nav class="breadcrumb-custom">
            <a href="{{ route('dashboard') }}">Beranda</a>
            <span class="mx-2">/</span>
            <span>Elektronik</span>
        </nav>
        
        <h1 class="display-5 fw-bold mb-3">📱 Elektronik</h1>
        <p class="lead mb-0">Temukan berbagai produk elektronik terkini dengan teknologi terdepan</p>
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
                            <option>Smartphone</option>
                            <option>Laptop</option>
                            <option>TV & Audio</option>
                            <option>Gaming</option>
                            <option>Aksesoris</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select class="form-select">
                            <option>Rentang Harga</option>
                            <option>< Rp 1 Juta</option>
                            <option>Rp 1-5 Juta</option>
                            <option>Rp 5-10 Juta</option>
                            <option>> Rp 10 Juta</option>
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
                <small class="text-muted">Menampilkan 1-12 dari 156 produk</small>
            </div>
        </div>
    </div>

    <!-- Products Grid -->
    <div class="product-grid">
        @foreach([
            [
                'name' => 'Samsung Galaxy S24 Ultra 256GB',
                'price' => 'Rp 18.999.000',
                'original_price' => 'Rp 21.999.000',
                'discount' => '15%',
                'image' => 'https://via.placeholder.com/300x300/f0f0f0/888?text=Samsung+S24+Ultra',
                'rating' => 4.8,
                'reviews' => 245
            ],
            [
                'name' => 'iPhone 15 Pro Max 256GB',
                'price' => 'Rp 19.999.000',
                'original_price' => '',
                'discount' => '',
                'image' => 'https://via.placeholder.com/300x300/f0f0f0/888?text=iPhone+15+Pro',
                'rating' => 4.9,
                'reviews' => 189
            ],
            [
                'name' => 'MacBook Air M2 13" 256GB',
                'price' => 'Rp 16.499.000',
                'original_price' => 'Rp 18.999.000',
                'discount' => '13%',
                'image' => 'https://via.placeholder.com/300x300/f0f0f0/888?text=MacBook+Air+M2',
                'rating' => 4.7,
                'reviews' => 156
            ],
            [
                'name' => 'Sony PlayStation 5 825GB',
                'price' => 'Rp 7.999.000',
                'original_price' => '',
                'discount' => '',
                'image' => 'https://via.placeholder.com/300x300/f0f0f0/888?text=PlayStation+5',
                'rating' => 4.8,
                'reviews' => 324
            ],
            [
                'name' => 'Samsung 55" QLED 4K Smart TV',
                'price' => 'Rp 8.999.000',
                'original_price' => 'Rp 10.999.000',
                'discount' => '18%',
                'image' => 'https://via.placeholder.com/300x300/f0f0f0/888?text=Samsung+QLED+TV',
                'rating' => 4.6,
                'reviews' => 98
            ],
            [
                'name' => 'Apple AirPods Pro 2nd Gen',
                'price' => 'Rp 3.799.000',
                'original_price' => '',
                'discount' => '',
                'image' => 'https://via.placeholder.com/300x300/f0f0f0/888?text=AirPods+Pro+2',
                'rating' => 4.7,
                'reviews' => 267
            ],
            [
                'name' => 'ASUS ROG Strix G15 Gaming',
                'price' => 'Rp 14.999.000',
                'original_price' => 'Rp 17.999.000',
                'discount' => '17%',
                'image' => 'https://via.placeholder.com/300x300/f0f0f0/888?text=ASUS+ROG+G15',
                'rating' => 4.6,
                'reviews' => 134
            ],
            [
                'name' => 'Xiaomi Mi 13 Pro 256GB',
                'price' => 'Rp 8.999.000',
                'original_price' => 'Rp 10.499.000',
                'discount' => '14%',
                'image' => 'https://via.placeholder.com/300x300/f0f0f0/888?text=Xiaomi+Mi+13+Pro',
                'rating' => 4.5,
                'reviews' => 78
            ],
            [
                'name' => 'Nintendo Switch OLED 64GB',
                'price' => 'Rp 4.599.000',
                'original_price' => '',
                'discount' => '',
                'image' => 'https://via.placeholder.com/300x300/f0f0f0/888?text=Nintendo+Switch',
                'rating' => 4.8,
                'reviews' => 412
            ],
            [
                'name' => 'Sony WH-1000XM5 Headphone',
                'price' => 'Rp 4.999.000',
                'original_price' => 'Rp 5.799.000',
                'discount' => '14%',
                'image' => 'https://via.placeholder.com/300x300/f0f0f0/888?text=Sony+WH1000XM5',
                'rating' => 4.9,
                'reviews' => 189
            ],
            [
                'name' => 'iPad Air 5th Gen 256GB WiFi',
                'price' => 'Rp 9.999.000',
                'original_price' => '',
                'discount' => '',
                'image' => 'https://via.placeholder.com/300x300/f0f0f0/888?text=iPad+Air+5',
                'rating' => 4.7,
                'reviews' => 203
            ],
            [
                'name' => 'LG 27" UltraGear Gaming Monitor',
                'price' => 'Rp 3.299.000',
                'original_price' => 'Rp 3.899.000',
                'discount' => '15%',
                'image' => 'https://via.placeholder.com/300x300/f0f0f0/888?text=LG+UltraGear',
                'rating' => 4.6,
                'reviews' => 167
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
