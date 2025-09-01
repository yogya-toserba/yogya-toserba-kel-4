@extends('layouts.app')

@section('title', 'Perawatan & Kecantikan - MyYOGYA')

@section('content')
<!-- Category Header -->
<div class="category-header">
    <div class="container">
        <nav class="breadcrumb-custom">
            <a href="{{ route('dashboard') }}">Beranda</a>
            <span class="mx-2">/</span>
            <span>Perawatan & Kecantikan</span>
        </nav>
        
        <h1 class="display-5 fw-bold mb-3">💄 Perawatan & Kecantikan</h1>
        <p class="lead mb-0">Produk kecantikan dan perawatan terbaik untuk penampilan sempurna Anda</p>
    </div>
</div>

<div class="container">
    <!-- Filter Section -->
    <div class="filter-section">
        <div class="row align-items-center">
            <div class="col-md-9">
                <div class="row g-3">
                    <div class="col-md-4">
                        <div class="dropdown">
                            <button class="btn btn-outline-secondary dropdown-toggle d-flex align-items-center justify-content-between w-100 filter-dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <span><i class="fas fa-th-large me-2"></i>Semua Kategori</span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-wide w-100">
                                <li><a class="dropdown-item" href="#"><i class="fas fa-spa me-2 text-primary"></i>Perawatan Wajah</a></li>
                                <li><a class="dropdown-item" href="#"><i class="fas fa-tint me-2 text-info"></i>Makeup</a></li>
                                <li><a class="dropdown-item" href="#"><i class="fas fa-hand-sparkles me-2 text-success"></i>Perawatan Tubuh</a></li>
                                <li><a class="dropdown-item" href="#"><i class="fas fa-cut me-2 text-warning"></i>Perawatan Rambut</a></li>
                                <li><a class="dropdown-item" href="#"><i class="fas fa-heart me-2 text-danger"></i>Parfum & Fragrance</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="dropdown">
                            <button class="btn btn-outline-secondary dropdown-toggle d-flex align-items-center justify-content-between w-100 filter-dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <span><i class="fas fa-tags me-2"></i>Rentang Harga</span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-wide w-100">
                                <li><a class="dropdown-item" href="#"><i class="fas fa-dollar-sign me-2 text-success"></i>< Rp 100rb</a></li>
                                <li><a class="dropdown-item" href="#"><i class="fas fa-dollar-sign me-2 text-info"></i>Rp 100rb-300rb</a></li>
                                <li><a class="dropdown-item" href="#"><i class="fas fa-dollar-sign me-2 text-warning"></i>Rp 300rb-500rb</a></li>
                                <li><a class="dropdown-item" href="#"><i class="fas fa-dollar-sign me-2 text-danger"></i>> Rp 500rb</a></li>
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
            <div class="col-md-3 text-end">
                <small class="text-muted">Menampilkan 1-12 dari 192 produk</small>
            </div>
        </div>
    </div>

    <!-- Products Grid -->
    <div class="product-grid">
        @foreach([
            [
                'name' => 'Wardah Lightening Day Cream 20g',
                'price' => 'Rp 32.500',
                'original_price' => 'Rp 38.000',
                'discount' => '14%',
                'image' => 'https://via.placeholder.com/300x300/f0f0f0/888?text=Wardah+Day+Cream',
                'rating' => 4.6,
                'reviews' => 892
            ],
            [
                'name' => 'Make Over Intense Matte Lip Cream',
                'price' => 'Rp 89.000',
                'original_price' => '',
                'discount' => '',
                'image' => 'https://via.placeholder.com/300x300/f0f0f0/888?text=Make+Over+Lipstick',
                'rating' => 4.8,
                'reviews' => 567
            ],
            [
                'name' => 'Cetaphil Gentle Skin Cleanser 125ml',
                'price' => 'Rp 87.500',
                'original_price' => 'Rp 105.000',
                'discount' => '17%',
                'image' => 'https://via.placeholder.com/300x300/f0f0f0/888?text=Cetaphil+Cleanser',
                'rating' => 4.7,
                'reviews' => 743
            ],
            [
                'name' => 'Emina Bright Stuff Face Wash 100ml',
                'price' => 'Rp 18.900',
                'original_price' => '',
                'discount' => '',
                'image' => 'https://via.placeholder.com/300x300/f0f0f0/888?text=Emina+Face+Wash',
                'rating' => 4.5,
                'reviews' => 1234
            ],
            [
                'name' => 'The Body Shop Tea Tree Oil 10ml',
                'price' => 'Rp 149.000',
                'original_price' => 'Rp 179.000',
                'discount' => '17%',
                'image' => 'https://via.placeholder.com/300x300/f0f0f0/888?text=Tea+Tree+Oil',
                'rating' => 4.9,
                'reviews' => 423
            ],
            [
                'name' => 'Garnier Micellar Water 125ml',
                'price' => 'Rp 24.500',
                'original_price' => '',
                'discount' => '',
                'image' => 'https://via.placeholder.com/300x300/f0f0f0/888?text=Micellar+Water',
                'rating' => 4.6,
                'reviews' => 856
            ],
            [
                'name' => 'Maybelline Fit Me Foundation',
                'price' => 'Rp 129.000',
                'original_price' => 'Rp 159.000',
                'discount' => '19%',
                'image' => 'https://via.placeholder.com/300x300/f0f0f0/888?text=Fit+Me+Foundation',
                'rating' => 4.4,
                'reviews' => 345
            ],
            [
                'name' => 'Pixy UV Whitening Two Way Cake',
                'price' => 'Rp 54.900',
                'original_price' => '',
                'discount' => '',
                'image' => 'https://via.placeholder.com/300x300/f0f0f0/888?text=Pixy+Two+Way+Cake',
                'rating' => 4.3,
                'reviews' => 678
            ],
            [
                'name' => 'Nivea Soft Light Moisturizer 200ml',
                'price' => 'Rp 32.000',
                'original_price' => 'Rp 39.000',
                'discount' => '18%',
                'image' => 'https://via.placeholder.com/300x300/f0f0f0/888?text=Nivea+Moisturizer',
                'rating' => 4.5,
                'reviews' => 567
            ],
            [
                'name' => 'Scarlett Whitening Body Lotion 300ml',
                'price' => 'Rp 89.000',
                'original_price' => '',
                'discount' => '',
                'image' => 'https://via.placeholder.com/300x300/f0f0f0/888?text=Scarlett+Body+Lotion',
                'rating' => 4.7,
                'reviews' => 923
            ],
            [
                'name' => 'LOreal Paris Extraordinary Oil',
                'price' => 'Rp 67.500',
                'original_price' => 'Rp 85.000',
                'discount' => '21%',
                'image' => 'https://via.placeholder.com/300x300/f0f0f0/888?text=LOreal+Hair+Oil',
                'rating' => 4.6,
                'reviews' => 412
            ],
            [
                'name' => 'Kahf Gentle Exfoliating Face Scrub',
                'price' => 'Rp 27.900',
                'original_price' => '',
                'discount' => '',
                'image' => 'https://via.placeholder.com/300x300/f0f0f0/888?text=Kahf+Face+Scrub',
                'rating' => 4.4,
                'reviews' => 289
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
                <a class="page-link" href="#" title="Go to page 16">16</a>
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
