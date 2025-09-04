@extends('layouts.app')

@section('title', 'Rumah Tangga - MyYOGYA')

@section('content')
<!-- Category Header -->
<div class="category-header">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <nav class="breadcrumb-custom">
                <a href="{{ route('dashboard') }}">Beranda</a>
                <span class="mx-2">/</span>
                <span>Rumah Tangga</span>
            </nav>
            
            <!-- Category Navigation Button -->
            <div class="dropdown">
                <button class="btn btn-category-nav dropdown-toggle d-flex align-items-center" type="button" id="categoryDropdownHeader" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-th-large me-2"></i>
                    Semua Kategori
                </button>
                <ul class="dropdown-menu dropdown-menu-wide dropdown-menu-end" aria-labelledby="categoryDropdownHeader">
                    <li><a class="dropdown-item" href="{{ route('kategori.elektronik') }}">
                        <i class="fas fa-laptop me-2 text-primary"></i>Elektronik
                    </a></li>
                    <li><a class="dropdown-item" href="{{ route('kategori.fashion') }}">
                        <i class="fas fa-tshirt me-2 text-danger"></i>Fashion
                    </a></li>
                    <li><a class="dropdown-item" href="{{ route('kategori.makanan') }}">
                        <i class="fas fa-hamburger me-2 text-warning"></i>Makanan & Minuman
                    </a></li>
                    <li><a class="dropdown-item" href="{{ route('kategori.perawatan') }}">
                        <i class="fas fa-spa me-2 text-info"></i>Perawatan & Kecantikan
                    </a></li>
                    <li><a class="dropdown-item" href="{{ route('kategori.rumah-tangga') }}">
                        <i class="fas fa-home me-2 text-success"></i>Rumah Tangga
                    </a></li>
                    <li><a class="dropdown-item" href="{{ route('kategori.olahraga') }}">
                        <i class="fas fa-dumbbell me-2 text-dark"></i>Olahraga
                    </a></li>
                    <li><a class="dropdown-item" href="{{ route('kategori.otomotif') }}">
                        <i class="fas fa-car me-2 text-secondary"></i>Otomotif
                    </a></li>
                    <li><a class="dropdown-item" href="{{ route('kategori.buku') }}">
                        <i class="fas fa-book me-2 text-muted"></i>Buku & Alat Tulis
                    </a></li>
                    <li><a class="dropdown-item" href="{{ route('kategori.kesehatan-kecantikan') }}">
                        <i class="fas fa-heart me-2 text-danger"></i>Kesehatan & Kecantikan
                    </a></li>
                </ul>
            </div>
        </div>
        
        <h1 class="display-5 fw-bold mb-3">Rumah Tangga</h1>
        <p class="lead mb-0">Perlengkapan rumah tangga modern untuk rumah yang nyaman dan fungsional</p>
    </div>
</div>

<div class="container">
    <!-- Filter Section -->
    <div class="filter-section">
        <div class="row align-items-center">
            <div class="col-md-9">
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="dropdown">
                            <button class="btn btn-outline-secondary dropdown-toggle d-flex align-items-center justify-content-between w-100 filter-dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <span><i class="fas fa-th-large me-2"></i>Semua Kategori</span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-wide w-100">
                                <li><a class="dropdown-item" href="#"><i class="fas fa-utensils me-2 text-primary"></i>Peralatan Dapur</a></li>
                                <li><a class="dropdown-item" href="#"><i class="fas fa-broom me-2 text-info"></i>Alat Kebersihan</a></li>
                                <li><a class="dropdown-item" href="#"><i class="fas fa-couch me-2 text-success"></i>Furniture</a></li>
                                <li><a class="dropdown-item" href="#"><i class="fas fa-lightbulb me-2 text-warning"></i>Lampu & Listrik</a></li>
                                <li><a class="dropdown-item" href="#"><i class="fas fa-tools me-2 text-danger"></i>Peralatan Rumah</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="dropdown">
                            <button class="btn btn-outline-secondary dropdown-toggle d-flex align-items-center justify-content-between w-100 filter-dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <span><i class="fas fa-tags me-2"></i>Rentang Harga</span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-wide w-100">
                                <li><a class="dropdown-item" href="#"><i class="fas fa-dollar-sign me-2 text-success"></i>< Rp 100rb</a></li>
                                <li><a class="dropdown-item" href="#"><i class="fas fa-dollar-sign me-2 text-info"></i>Rp 100rb-500rb</a></li>
                                <li><a class="dropdown-item" href="#"><i class="fas fa-dollar-sign me-2 text-warning"></i>Rp 500rb-1jt</a></li>
                                <li><a class="dropdown-item" href="#"><i class="fas fa-dollar-sign me-2 text-danger"></i>> Rp 1 Juta</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-6">
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
                <small class="text-muted">Menampilkan 1-12 dari 264 produk</small>
            </div>
        </div>
    </div>

    <!-- Products Grid -->
    <div class="product-grid">
        @foreach([
            [
                'name' => 'Tefal Non-Stick Frying Pan 26cm',
                'price' => 'Rp 289.000',
                'original_price' => 'Rp 359.000',
                'discount' => '19%',
                'image' => 'https://via.placeholder.com/300x300/f0f0f0/888?text=Tefal+Frying+Pan',
                'rating' => 4.8,
                'reviews' => 567
            ],
            [
                'name' => 'Ikea BILLY Bookcase White 80x28x202cm',
                'price' => 'Rp 799.000',
                'original_price' => '',
                'discount' => '',
                'image' => 'https://via.placeholder.com/300x300/f0f0f0/888?text=IKEA+Bookcase',
                'rating' => 4.6,
                'reviews' => 234
            ],
            [
                'name' => 'Philips LED Bulb 13W Cool Daylight',
                'price' => 'Rp 45.000',
                'original_price' => 'Rp 55.000',
                'discount' => '18%',
                'image' => 'https://via.placeholder.com/300x300/f0f0f0/888?text=Philips+LED+Bulb',
                'rating' => 4.5,
                'reviews' => 892
            ],
            [
                'name' => 'Tupperware Modular Mates Set 4pcs',
                'price' => 'Rp 189.000',
                'original_price' => '',
                'discount' => '',
                'image' => 'https://via.placeholder.com/300x300/f0f0f0/888?text=Tupperware+Set',
                'rating' => 4.7,
                'reviews' => 445
            ],
            [
                'name' => 'Vacuum Cleaner Electrolux 1400W',
                'price' => 'Rp 1.299.000',
                'original_price' => 'Rp 1.599.000',
                'discount' => '19%',
                'image' => 'https://via.placeholder.com/300x300/f0f0f0/888?text=Vacuum+Cleaner',
                'rating' => 4.4,
                'reviews' => 178
            ],
            [
                'name' => 'Oxone Panci Set Stainless Steel 12pcs',
                'price' => 'Rp 459.000',
                'original_price' => '',
                'discount' => '',
                'image' => 'https://via.placeholder.com/300x300/f0f0f0/888?text=Oxone+Panci+Set',
                'rating' => 4.6,
                'reviews' => 723
            ],
            [
                'name' => 'Ace Hardware Tool Box Set 25pcs',
                'price' => 'Rp 235.000',
                'original_price' => 'Rp 289.000',
                'discount' => '19%',
                'image' => 'https://via.placeholder.com/300x300/f0f0f0/888?text=Tool+Box+Set',
                'rating' => 4.3,
                'reviews' => 156
            ],
            [
                'name' => 'Maspion Rice Cooker 1.8L Magic Com',
                'price' => 'Rp 289.000',
                'original_price' => '',
                'discount' => '',
                'image' => 'https://via.placeholder.com/300x300/f0f0f0/888?text=Rice+Cooker',
                'rating' => 4.5,
                'reviews' => 634
            ],
            [
                'name' => 'Krisbow Plastic Storage Box 45L',
                'price' => 'Rp 89.000',
                'original_price' => 'Rp 109.000',
                'discount' => '18%',
                'image' => 'https://via.placeholder.com/300x300/f0f0f0/888?text=Storage+Box',
                'rating' => 4.4,
                'reviews' => 389
            ],
            [
                'name' => 'Miyako Blender 2 in 1 BL-152PF',
                'price' => 'Rp 189.000',
                'original_price' => '',
                'discount' => '',
                'image' => 'https://via.placeholder.com/300x300/f0f0f0/888?text=Miyako+Blender',
                'rating' => 4.6,
                'reviews' => 456
            ],
            [
                'name' => 'Informa Dining Chair Set 4pcs Oak',
                'price' => 'Rp 1.299.000',
                'original_price' => 'Rp 1.599.000',
                'discount' => '19%',
                'image' => 'https://via.placeholder.com/300x300/f0f0f0/888?text=Dining+Chair+Set',
                'rating' => 4.7,
                'reviews' => 167
            ],
            [
                'name' => 'Cosmos Stand Fan CFS-16 TE',
                'price' => 'Rp 145.000',
                'original_price' => 'Rp 179.000',
                'discount' => '19%',
                'image' => 'https://via.placeholder.com/300x300/f0f0f0/888?text=Stand+Fan',
                'rating' => 4.5,
                'reviews' => 298
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
                    
                    <!-- Add to cart button removed -->
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Pagination -->
    <nav class="pagination-custom" aria-label="Product pagination">
        <ul class="pagination" id="pagination-container">
            <li class="page-item disabled" id="prev-page">
                <span class="page-link">Previous</span>
            </li>
            <li class="page-item active">
                <span class="page-link">1</span>
            </li>
            <li class="page-item">
                <a class="page-link" href="#" data-page="2" title="Go to page 2">2</a>
            </li>
            <li class="page-item">
                <a class="page-link" href="#" data-page="3" title="Go to page 3">3</a>
            </li>
            <li class="page-item">
                <a class="page-link" href="#" data-page="4" title="Go to page 4">4</a>
            </li>
            <li class="page-item">
                <span class="page-link text-muted">...</span>
            </li>
            <li class="page-item">
                <a class="page-link" href="#" data-page="14" title="Go to page 14">14</a>
            </li>
            <li class="page-item" id="next-page">
                <a class="page-link" href="#" title="Next page">Next</a>
            </li>
        </ul>
    </nav>

    <!-- Loading indicator -->
    <div id="pagination-loading" class="text-center my-4" style="display: none;">
        <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
        <p class="mt-2 text-muted">Memuat produk...</p>
    </div>
</div>

<!-- Include Pagination JavaScript -->
<script src="{{ asset('js/pagination.js') }}"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize pagination manager for household category
    window.rumahTanggaManager = new PaginationManager({
        totalPages: 14,
        itemsPerPage: 12,
        totalItems: 168,
        paginationId: 'pagination-container',
        pageInfoSelector: '.text-muted',
        productGridSelector: '.product-grid'
    });
});
</script>

@push('styles')
<style>
    
    /* Category Navigation Button Styles */
    .btn-category-nav {
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(10px);
        border: 2px solid rgba(255, 255, 255, 0.3);
        color: white;
        border-radius: 25px;
        padding: 10px 20px;
        font-weight: 600;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .btn-category-nav:hover {
        background: rgba(255, 255, 255, 0.25);
        border-color: rgba(255, 255, 255, 0.5);
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
    }

    .btn-category-nav:focus {
        background: rgba(255, 255, 255, 0.25);
        border-color: rgba(255, 255, 255, 0.5);
        color: white;
        box-shadow: 0 0 0 0.2rem rgba(255, 255, 255, 0.25);
    }

    .btn-category-nav i {
        color: white;
    }
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
        .filter-section .row .col-md-6 {
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



