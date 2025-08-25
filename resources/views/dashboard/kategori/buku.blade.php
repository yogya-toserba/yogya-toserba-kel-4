@extends('layouts.app')

@section('title', 'Buku - MyYOGYA')

@section('content')
<!-- Category Header -->
<div class="category-header">
    <div class="container">
        <nav class="breadcrumb-custom">
            <a href="{{ route('dashboard') }}">Beranda</a>
            <span class="mx-2">/</span>
            <span>Buku</span>
        </nav>
        
        <h1 class="display-5 fw-bold mb-3">📚 Buku</h1>
        <p class="lead mb-0">Koleksi buku terlengkap untuk menambah wawasan Anda</p>
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
                            <option>Novel</option>
                            <option>Pendidikan</option>
                            <option>Agama</option>
                            <option>Bisnis</option>
                            <option>Anak-anak</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select class="form-select">
                            <option>Rentang Harga</option>
                            <option>< Rp 50.000</option>
                            <option>Rp 50.000-100.000</option>
                            <option>Rp 100.000-200.000</option>
                            <option>> Rp 200.000</option>
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
                <small class="text-muted">Menampilkan 1-12 dari 267 produk</small>
            </div>
        </div>
    </div>

    <!-- Products Grid -->
    <div class="product-grid">
        @foreach([
            [
                'name' => 'Atomic Habits - James Clear',
                'price' => 'Rp 89.000',
                'original_price' => 'Rp 105.000',
                'discount' => '15%',
                'image' => 'https://via.placeholder.com/300x300/f0f0f0/888?text=Atomic+Habits',
                'rating' => 4.9,
                'reviews' => 567
            ],
            [
                'name' => 'Sapiens - Yuval Noah Harari',
                'price' => 'Rp 125.000',
                'original_price' => '',
                'discount' => '',
                'image' => 'https://via.placeholder.com/300x300/f0f0f0/888?text=Sapiens',
                'rating' => 4.8,
                'reviews' => 434
            ],
            [
                'name' => 'The Psychology of Money',
                'price' => 'Rp 95.000',
                'original_price' => 'Rp 110.000',
                'discount' => '14%',
                'image' => 'https://via.placeholder.com/300x300/f0f0f0/888?text=Psychology+Money',
                'rating' => 4.7,
                'reviews' => 298
            ],
            [
                'name' => 'Kamus Bahasa Indonesia Lengkap',
                'price' => 'Rp 75.000',
                'original_price' => '',
                'discount' => '',
                'image' => 'https://via.placeholder.com/300x300/f0f0f0/888?text=Kamus+Indonesia',
                'rating' => 4.5,
                'reviews' => 189
            ],
            [
                'name' => 'Rich Dad Poor Dad - Robert Kiyosaki',
                'price' => 'Rp 98.000',
                'original_price' => 'Rp 118.000',
                'discount' => '17%',
                'image' => 'https://via.placeholder.com/300x300/f0f0f0/888?text=Rich+Dad+Poor+Dad',
                'rating' => 4.8,
                'reviews' => 389
            ],
            [
                'name' => 'Ensiklopedia Anak Bergambar',
                'price' => 'Rp 145.000',
                'original_price' => '',
                'discount' => '',
                'image' => 'https://via.placeholder.com/300x300/f0f0f0/888?text=Ensiklopedia+Anak',
                'rating' => 4.6,
                'reviews' => 234
            ],
            [
                'name' => 'Al-Quran Terjemah Per Kata',
                'price' => 'Rp 185.000',
                'original_price' => 'Rp 225.000',
                'discount' => '18%',
                'image' => 'https://via.placeholder.com/300x300/f0f0f0/888?text=Al+Quran+Terjemah',
                'rating' => 4.9,
                'reviews' => 456
            ],
            [
                'name' => 'Laskar Pelangi - Andrea Hirata',
                'price' => 'Rp 68.000',
                'original_price' => 'Rp 85.000',
                'discount' => '20%',
                'image' => 'https://via.placeholder.com/300x300/f0f0f0/888?text=Laskar+Pelangi',
                'rating' => 4.7,
                'reviews' => 678
            ],
            [
                'name' => 'Buku Resep Masakan Nusantara',
                'price' => 'Rp 85.000',
                'original_price' => '',
                'discount' => '',
                'image' => 'https://via.placeholder.com/300x300/f0f0f0/888?text=Resep+Nusantara',
                'rating' => 4.4,
                'reviews' => 267
            ],
            [
                'name' => 'Think and Grow Rich - Napoleon Hill',
                'price' => 'Rp 78.000',
                'original_price' => 'Rp 95.000',
                'discount' => '18%',
                'image' => 'https://via.placeholder.com/300x300/f0f0f0/888?text=Think+Grow+Rich',
                'rating' => 4.6,
                'reviews' => 345
            ],
            [
                'name' => 'Buku Mewarnai & Aktivitas Anak',
                'price' => 'Rp 25.000',
                'original_price' => '',
                'discount' => '',
                'image' => 'https://via.placeholder.com/300x300/f0f0f0/888?text=Buku+Mewarnai',
                'rating' => 4.3,
                'reviews' => 489
            ],
            [
                'name' => 'Matematika SMA Kelas 10-12',
                'price' => 'Rp 125.000',
                'original_price' => 'Rp 150.000',
                'discount' => '17%',
                'image' => 'https://via.placeholder.com/300x300/f0f0f0/888?text=Matematika+SMA',
                'rating' => 4.5,
                'reviews' => 156
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