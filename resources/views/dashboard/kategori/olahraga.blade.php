@extends('layouts.app')

@section('title', 'Olahraga - MyYOGYA')

@section('content')
<!-- Category Header -->
<div class="category-header">
    <div class="container">
        <nav class="breadcrumb-custom">
            <a href="{{ route('dashboard') }}">Beranda</a>
            <span class="mx-2">/</span>
            <span>Olahraga</span>
        </nav>
        
        <h1 class="display-5 fw-bold mb-3">⚽ Olahraga</h1>
        <p class="lead mb-0">Perlengkapan olahraga untuk hidup sehat dan aktif</p>
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
                            <option>Sepatu Olahraga</option>
                            <option>Pakaian Olahraga</option>
                            <option>Peralatan Fitness</option>
                            <option>Olahraga Air</option>
                            <option>Bola & Raket</option>
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
                <small class="text-muted">Menampilkan 1-12 dari 156 produk</small>
            </div>
        </div>
    </div>

    <!-- Products Grid -->
    <div class="product-grid">
        @foreach([
            [
                'name' => 'Sepatu Running Adidas Ultraboost 22',
                'price' => 'Rp 2.499.000',
                'original_price' => 'Rp 2.799.000',
                'discount' => '11%',
                'image' => 'https://via.placeholder.com/300x300/f0f0f0/888?text=Adidas+Ultraboost',
                'rating' => 4.8,
                'reviews' => 324
            ],
            [
                'name' => 'Dumbbell Set Kettler 10kg',
                'price' => 'Rp 345.000',
                'original_price' => '',
                'discount' => '',
                'image' => 'https://via.placeholder.com/300x300/f0f0f0/888?text=Dumbbell+Kettler',
                'rating' => 4.6,
                'reviews' => 189
            ],
            [
                'name' => 'Jersey Futsal Nike Dry-FIT',
                'price' => 'Rp 189.000',
                'original_price' => 'Rp 225.000',
                'discount' => '16%',
                'image' => 'https://via.placeholder.com/300x300/f0f0f0/888?text=Jersey+Nike',
                'rating' => 4.5,
                'reviews' => 267
            ],
            [
                'name' => 'Matras Yoga Premium 6mm',
                'price' => 'Rp 125.000',
                'original_price' => '',
                'discount' => '',
                'image' => 'https://via.placeholder.com/300x300/f0f0f0/888?text=Matras+Yoga',
                'rating' => 4.4,
                'reviews' => 456
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
