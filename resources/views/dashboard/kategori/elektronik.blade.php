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
                    <div class="col-md-4">
                        <div class="dropdown">
                            <button class="btn btn-outline-secondary dropdown-toggle d-flex align-items-center justify-content-between w-100 filter-dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <span><i class="fas fa-th-large me-2"></i>Semua Kategori</span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-wide w-100">
                                <li><a class="dropdown-item" href="#"><i class="fas fa-mobile-alt me-2 text-primary"></i>Smartphone</a></li>
                                <li><a class="dropdown-item" href="#"><i class="fas fa-laptop me-2 text-info"></i>Laptop</a></li>
                                <li><a class="dropdown-item" href="#"><i class="fas fa-tv me-2 text-success"></i>TV & Audio</a></li>
                                <li><a class="dropdown-item" href="#"><i class="fas fa-gamepad me-2 text-warning"></i>Gaming</a></li>
                                <li><a class="dropdown-item" href="#"><i class="fas fa-headphones me-2 text-danger"></i>Aksesoris</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="dropdown">
                            <button class="btn btn-outline-secondary dropdown-toggle d-flex align-items-center justify-content-between w-100 filter-dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <span><i class="fas fa-tags me-2"></i>Rentang Harga</span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-wide w-100">
                                <li><a class="dropdown-item" href="#"><i class="fas fa-dollar-sign me-2 text-success"></i>< Rp 1 Juta</a></li>
                                <li><a class="dropdown-item" href="#"><i class="fas fa-dollar-sign me-2 text-info"></i>Rp 1-5 Juta</a></li>
                                <li><a class="dropdown-item" href="#"><i class="fas fa-dollar-sign me-2 text-warning"></i>Rp 5-10 Juta</a></li>
                                <li><a class="dropdown-item" href="#"><i class="fas fa-dollar-sign me-2 text-danger"></i>> Rp 10 Juta</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="dropdown">
                            <button class="btn btn-outline-secondary dropdown-toggle d-flex align-items-center justify-content-between w-100 filter-dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <span><i class="fas fa-sort me-2"></i>Urutkan</span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-wide w-100">
                                <li><a class="dropdown-item" href="#"><i class="fas fa-arrow-down me-2 text-success"></i>Harga Terendah</a></li>
                                <li><a class="dropdown-item" href="#"><i class="fas fa-arrow-up me-2 text-danger"></i>Harga Tertinggi</a></li>
                                <li><a class="dropdown-item" href="#"><i class="fas fa-fire me-2 text-warning"></i>Terpopuler</a></li>
                                <li><a class="dropdown-item" href="#"><i class="fas fa-clock me-2 text-info"></i>Terbaru</a></li>
                            </ul>
                        </div>
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
                <div class="product-content">
                    <h6 class="product-title">{{ $product['name'] }}</h6>
                    
                    <div class="product-rating">
                        <div class="stars">
                            @for($i = 1; $i <= 5; $i++)
                            <i class="fas fa-star{{ $i <= floor($product['rating']) ? '' : ' text-muted' }}"></i>
                            @endfor
                        </div>
                        <span class="review-count">({{ $product['reviews'] }})</span>
                    </div>
                </div>
                
                <div class="product-meta">
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
                <a class="page-link" href="#" title="Go to page 2">2</a>
            </li>
            <li class="page-item">
                <a class="page-link" href="#" title="Go to page 3">3</a>
            </li>
            <li class="page-item">
                <a class="page-link" href="#" title="Go to page 4">4</a>
            </li>
            <li class="page-item">
                <span class="page-link text-muted">...</span>
            </li>
            <li class="page-item">
                <a class="page-link" href="#" title="Go to page 13">13</a>
            </li>
            <li class="page-item">
                <a class="page-link" href="#" title="Next page">Next</a>
            </li>
        </ul>
    </nav>
</div>

@push('styles')
<style>
    /* Filter Dropdown Styles */
    .filter-dropdown {
        border: 2px solid #dee2e6;
        border-radius: 25px;
        padding: 8px 16px;
        font-weight: 500;
        transition: all 0.3s ease;
        background: white;
        text-align: left;
        color: #495057;
        position: relative;
        z-index: 1;
    }

    .filter-dropdown * {
        position: relative;
        z-index: 2;
    }

    .filter-dropdown:hover {
        border-color: #f26b37;
        background: linear-gradient(135deg, #f26b37 0%, #e55827 100%);
        color: white !important;
    }

    .filter-dropdown:hover,
    .filter-dropdown:hover * {
        color: white !important;
    }

    .filter-dropdown:hover i {
        color: white !important;
    }

    .filter-section .dropdown-menu-wide {
        min-width: 100%;
        border-radius: 12px;
        border: none;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        padding: 10px 0;
        margin-top: 5px;
    }

    .filter-section .dropdown-menu-wide .dropdown-item {
        padding: 10px 16px;
        font-weight: 500;
        transition: all 0.3s ease;
        border-radius: 0;
    }

    .filter-section .dropdown-menu-wide .dropdown-item:hover {
        background: linear-gradient(135deg, #f26b37 0%, #e55827 100%);
        color: white;
    }

    .filter-section .dropdown-menu-wide .dropdown-item i {
        width: 18px;
        transition: all 0.3s ease;
    }

    .filter-section .dropdown-menu-wide .dropdown-item:hover i {
        color: white !important;
    }

    /* Responsive filter */
    @media (max-width: 768px) {
        .filter-section .row .col-md-4 {
            margin-bottom: 10px;
        }
        
        .filter-dropdown {
            font-size: 0.9rem;
            padding: 6px 12px;
        }
    }
</style>
@endpush

@endsection
