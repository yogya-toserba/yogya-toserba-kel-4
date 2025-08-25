@extends('layouts.app')

@section('title', 'Perawatan - MyYOGYA')

@section('content')
<!-- Category Header -->
<div class="category-header">
    <div class="container">
        <nav class="breadcrumb-custom">
            <a href="{{ route('dashboard') }}">Beranda</a>
            <span class="mx-2">/</span>
            <span>Perawatan</span>
        </nav>
        
        <h1 class="display-5 fw-bold mb-3">🧴 Perawatan</h1>
        <p class="lead mb-0">Produk perawatan diri terlengkap untuk kecantikan dan kesehatan Anda</p>
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
                            <option>Skincare</option>
                            <option>Makeup</option>
                            <option>Haircare</option>
                            <option>Body Care</option>
                            <option>Parfum</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select class="form-select">
                            <option>Rentang Harga</option>
                            <option>< Rp 50.000</option>
                            <option>Rp 50.000-200.000</option>
                            <option>Rp 200.000-500.000</option>
                            <option>> Rp 500.000</option>
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
                <small class="text-muted">Menampilkan 1-12 dari 89 produk</small>
            </div>
        </div>
    </div>

    <!-- Products Grid -->
    <div class="product-grid">
        @foreach([
            [
                'name' => 'The Ordinary Niacinamide 10% + Zinc 1%',
                'price' => 'Rp 89.000',
                'original_price' => 'Rp 109.000',
                'discount' => '18%',
                'image' => 'https://via.placeholder.com/300x300/f0f0f0/888?text=The+Ordinary+Serum',
                'rating' => 4.7,
                'reviews' => 456
            ],
            [
                'name' => 'Wardah Perfect Bright Micellar Water',
                'price' => 'Rp 32.000',
                'original_price' => '',
                'discount' => '',
                'image' => 'https://via.placeholder.com/300x300/f0f0f0/888?text=Wardah+Micellar',
                'rating' => 4.5,
                'reviews' => 789
            ],
            [
                'name' => 'Scarlett Brightening Body Lotion',
                'price' => 'Rp 45.000',
                'original_price' => 'Rp 55.000',
                'discount' => '18%',
                'image' => 'https://via.placeholder.com/300x300/f0f0f0/888?text=Scarlett+Lotion',
                'rating' => 4.6,
                'reviews' => 634
            ],
            [
                'name' => 'Somethinc Retinol 0.2% Serum',
                'price' => 'Rp 125.000',
                'original_price' => '',
                'discount' => '',
                'image' => 'https://via.placeholder.com/300x300/f0f0f0/888?text=Somethinc+Retinol',
                'rating' => 4.8,
                'reviews' => 298
            ],
            [
                'name' => 'Garnier Vitamin C Face Wash',
                'price' => 'Rp 28.000',
                'original_price' => 'Rp 35.000',
                'discount' => '20%',
                'image' => 'https://via.placeholder.com/300x300/f0f0f0/888?text=Garnier+Vitamin+C',
                'rating' => 4.4,
                'reviews' => 567
            ],
            [
                'name' => 'Maybelline Fit Me Concealer',
                'price' => 'Rp 85.000',
                'original_price' => '',
                'discount' => '',
                'image' => 'https://via.placeholder.com/300x300/f0f0f0/888?text=Maybelline+Concealer',
                'rating' => 4.6,
                'reviews' => 234
            ],
            [
                'name' => 'TBS Tea Tree Oil Face Wash',
                'price' => 'Rp 165.000',
                'original_price' => 'Rp 195.000',
                'discount' => '15%',
                'image' => 'https://via.placeholder.com/300x300/f0f0f0/888?text=TBS+Tea+Tree',
                'rating' => 4.7,
                'reviews' => 345
            ],
            [
                'name' => 'Pixy UV Whitening Two Way Cake',
                'price' => 'Rp 45.000',
                'original_price' => 'Rp 52.000',
                'discount' => '13%',
                'image' => 'https://via.placeholder.com/300x300/f0f0f0/888?text=Pixy+Two+Way',
                'rating' => 4.3,
                'reviews' => 189
            ],
            [
                'name' => 'Pantene Shampoo Anti Dandruff',
                'price' => 'Rp 35.000',
                'original_price' => '',
                'discount' => '',
                'image' => 'https://via.placeholder.com/300x300/f0f0f0/888?text=Pantene+Shampoo',
                'rating' => 4.5,
                'reviews' => 423
            ],
            [
                'name' => 'Kahf Gentle Exfoliating Face Wash',
                'price' => 'Rp 28.000',
                'original_price' => 'Rp 32.000',
                'discount' => '12%',
                'image' => 'https://via.placeholder.com/300x300/f0f0f0/888?text=Kahf+Face+Wash',
                'rating' => 4.6,
                'reviews' => 278
            ],
            [
                'name' => 'Innisfree Green Tea Seed Serum',
                'price' => 'Rp 285.000',
                'original_price' => '',
                'discount' => '',
                'image' => 'https://via.placeholder.com/300x300/f0f0f0/888?text=Innisfree+Serum',
                'rating' => 4.8,
                'reviews' => 156
            ],
            [
                'name' => 'Emina Bright Stuff Face Mist',
                'price' => 'Rp 22.000',
                'original_price' => 'Rp 28.000',
                'discount' => '21%',
                'image' => 'https://via.placeholder.com/300x300/f0f0f0/888?text=Emina+Face+Mist',
                'rating' => 4.4,
                'reviews' => 367
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