@extends('layouts.app')

@section('title', 'Fashion - MyYOGYA')

@section('content')
    <!-- Category Header -->
    <div class="category-header">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <nav class="breadcrumb-custom">
                    <a href="{{ route('dashboard') }}">Beranda</a>
                    <span class="mx-2">/</span>
                    <span>Fashion</span>
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
            
            <h1 class="display-5 fw-bold mb-3">Fashion</h1>
            <p class="lead mb-0">Koleksi fashion terdepan untuk gaya hidup modern Anda</p>
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
                                    <li><a class="dropdown-item" href="#"><i class="fas fa-tshirt me-2 text-primary"></i>Pakaian Pria</a></li>
                                    <li><a class="dropdown-item" href="#"><i class="fas fa-female me-2 text-info"></i>Pakaian Wanita</a></li>
                                    <li><a class="dropdown-item" href="#"><i class="fas fa-shoe-prints me-2 text-success"></i>Sepatu</a></li>
                                    <li><a class="dropdown-item" href="#"><i class="fas fa-shopping-bag me-2 text-warning"></i>Tas & Dompet</a></li>
                                    <li><a class="dropdown-item" href="#"><i class="fas fa-gem me-2 text-danger"></i>Aksesoris</a></li>
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
                    <small class="text-muted">Menampilkan 1-12 dari 234 produk</small>
                </div>
            </div>
        </div>

        <!-- Products Grid -->
        <div class="product-grid">
            @foreach([
                    [
                        'name' => 'Kemeja Formal Pria Premium Cotton',
                        'price' => 'Rp 299.000',
                        'original_price' => 'Rp 399.000',
                        'discount' => '25%',
                        'image' => '/image/kategori/fashion/kemeja_formal.png',
                        'rating' => 4.7,
                        'reviews' => 156,
                        'description' => 'Kemeja formal premium dengan bahan 100% katun berkualitas tinggi. Desain slim fit yang elegan, cocok untuk acara formal maupun kantor. Tersedia dalam berbagai ukuran dan warna. Mudah dirawat dan tahan lama.',
                        'category' => 'Fashion Pria'
                    ],
                    [
                        'name' => 'Dress Wanita Elegant Korean Style',
                        'price' => 'Rp 159.000',
                        'original_price' => 'Rp 219.000',
                        'discount' => '27%',
                        'image' => '/image/kategori/fashion/dress_wanita.png',
                        'rating' => 4.8,
                        'reviews' => 243,
                        'description' => 'Dress wanita dengan gaya Korean yang elegan dan trendy. Bahan berkualitas premium yang nyaman digunakan sehari-hari. Model A-line yang flattering untuk semua bentuk tubuh. Perfect untuk hangout atau acara casual.',
                        'category' => 'Fashion Wanita'
                    ],
                    [
                        'name' => 'Sepatu Sneakers Pria Casual Sport',
                        'price' => 'Rp 449.000',
                        'original_price' => '',
                        'discount' => '',
                        'image' => '/image/kategori/fashion/sepatu_sneaker.png',
                        'rating' => 4.6,
                        'reviews' => 189,
                        'description' => 'Sepatu sneakers pria dengan teknologi cushioning terdepan untuk kenyamanan maksimal. Sol anti-slip dan breathable material. Cocok untuk olahraga ringan dan aktivitas sehari-hari. Desain modern dan sporty.',
                        'category' => 'Sepatu Pria'
                    ],
                    [
                        'name' => 'Tas Handbag Wanita Kulit Premium',
                        'price' => 'Rp 689.000',
                        'original_price' => 'Rp 899.000',
                        'discount' => '23%',
                        'image' => '/image/kategori/fashion/tas_handbag.png',
                        'rating' => 4.9,
                        'reviews' => 98,
                        'description' => 'Tas handbag wanita dari kulit asli premium dengan finishing yang mewah. Interior luas dengan berbagai compartment untuk organisasi barang. Handle dan tali yang kokoh. Cocok untuk formal maupun casual wear.',
                        'category' => 'Aksesoris Wanita'
                    ],
                    [
                        'name' => 'Blouse Wanita Chiffon Modern',
                        'price' => 'Rp 129.000',
                        'original_price' => 'Rp 179.000',
                        'discount' => '28%',
                        'image' => '/image/kategori/fashion/blouse_wanita.png',
                        'rating' => 4.5,
                        'reviews' => 167,
                        'description' => 'Blouse wanita dari bahan chiffon berkualitas dengan desain modern dan feminin. Lengan panjang dengan detail yang elegan. Cocok untuk ke kantor atau acara semi-formal. Material yang adem dan nyaman.',
                        'category' => 'Fashion Wanita'
                    ],
                    [
                        'name' => 'Celana Jeans Pria Slim Fit',
                        'price' => 'Rp 199.000',
                        'original_price' => '',
                        'discount' => '',
                        'image' => '/image/kategori/fashion/celana_jeans.png',
                        'rating' => 4.7,
                        'reviews' => 134,
                        'description' => 'Celana jeans pria dengan potongan slim fit yang modern. Bahan denim berkualitas premium yang tahan lama dan nyaman. Warna classic blue yang mudah dipadukan. Perfect untuk gaya casual dan semi-formal.',
                        'category' => 'Fashion Pria'
                    ],
                    [
                        'name' => 'High Heels Wanita Formal 7cm',
                        'price' => 'Rp 349.000',
                        'original_price' => 'Rp 449.000',
                        'discount' => '22%',
                        'image' => '/image/kategori/fashion/high_heels.png',
                        'rating' => 4.4,
                        'reviews' => 76,
                        'description' => 'High heels wanita dengan tinggi 7cm yang ideal untuk acara formal. Sol empuk dan nyaman untuk penggunaan lama. Bahan berkualitas premium dengan finishing yang elegan. Tersedia dalam berbagai warna classic.',
                        'category' => 'Sepatu Wanita'
                    ],
                    [
                        'name' => 'Jaket Bomber Pria Stylish',
                        'price' => 'Rp 259.000',
                        'original_price' => 'Rp 329.000',
                        'discount' => '21%',
                        'image' => '/image/kategori/fashion/jaket_bomber.png',
                        'rating' => 4.6,
                        'reviews' => 112,
                        'description' => 'Jaket bomber pria dengan desain stylish dan modern. Bahan polyester berkualitas yang tahan air dan angin. Interior dengan lining yang hangat. Perfect untuk cuaca dingin dan tampil fashionable.',
                        'category' => 'Fashion Pria'
                    ],
                    [
                        'name' => 'Rok Mini Wanita A-Line Casual',
                        'price' => 'Rp 89.000',
                        'original_price' => 'Rp 119.000',
                        'discount' => '25%',
                        'image' => '/image/kategori/fashion/rok_mini.png',
                        'rating' => 4.3,
                        'reviews' => 89,
                        'description' => 'Rok mini wanita dengan model A-line yang flattering dan casual. Bahan cotton blend yang nyaman dan breathable. Elastic waistband untuk fit yang sempurna. Cocok untuk hangout dan acara santai.',
                        'category' => 'Fashion Wanita'
                    ],
                    [
                        'name' => 'Dompet Pria Kulit Asli Premium',
                        'price' => 'Rp 179.000',
                        'original_price' => '',
                        'discount' => '',
                        'image' => '/image/kategori/fashion/dompet_pria.png',
                        'rating' => 4.8,
                        'reviews' => 203,
                        'description' => 'Dompet pria dari kulit asli premium dengan kualitas terbaik. Design minimalis dengan banyak slot kartu dan uang. Jahitan rapi dan tahan lama. Ukuran pas untuk saku celana. Investasi jangka panjang.',
                        'category' => 'Aksesoris Pria'
                    ],
                    [
                        'name' => 'Kaos Polo Pria Cotton Combed',
                        'price' => 'Rp 149.000',
                        'original_price' => 'Rp 199.000',
                        'discount' => '25%',
                        'image' => '/image/kategori/fashion/kaos_polo.png',
                        'rating' => 4.5,
                        'reviews' => 145,
                        'description' => 'Kaos polo pria dari 100% cotton combed berkualitas premium. Breathable dan soft texture. Collar yang rapi dan tidak mudah melar. Cocok untuk smart casual look di berbagai occasion. Easy care dan tahan lama.',
                        'category' => 'Fashion Pria'
                    ],
                    [
                        'name' => 'Sandal Wanita Casual Comfortable',
                        'price' => 'Rp 99.000',
                        'original_price' => 'Rp 139.000',
                        'discount' => '29%',
                        'image' => '/image/kategori/fashion/sandal_wanita.png',
                        'rating' => 4.4,
                        'reviews' => 67,
                        'description' => 'Sandal wanita casual dengan sol yang empuk dan nyaman untuk aktivitas sehari-hari. Material berkualitas dan anti-slip. Design simple yang mudah dipadukan dengan outfit apapun. Perfect untuk cuaca panas.',
                        'category' => 'Sepatu Wanita'
                    ]
                ] as $product)
                <div class="product-card product-clickable" style="cursor:pointer" data-bs-toggle="modal" data-bs-target="#productModal"
                    data-product-name="{{ $product['name'] }}"
                    data-product-price="{{ $product['price'] }}"
                    data-product-original-price="{{ $product['original_price'] ?? '' }}"
                    data-product-image="{{ $product['image'] }}"
                    data-product-description="{{ $product['description'] }}"
                    data-product-category="{{ $product['category'] }}"
                    data-product-id="{{ $loop->index + 1 }}">
                    <div class="product-image">
                        <img src="{{ $product['image'] }}" alt="{{ $product['name'] }}">
                        @if($product['discount'])
                            <span class="discount-badge">-{{ $product['discount'] }}</span>
                        @endif
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
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <nav class="pagination-custom" aria-label="Product pagination">
            <ul class="pagination" id="pagination-container">
                <li class="page-item" id="prevPage">
                    <a class="page-link" href="#" onclick="changePage('prev')">
                        <i class="fas fa-arrow-left me-1"></i>Previous
                    </a>
                </li>
                <li class="page-item active" data-page="1">
                    <a class="page-link" href="#" onclick="changePage(1)">1</a>
                </li>
                <li class="page-item" data-page="2">
                    <a class="page-link" href="#" onclick="changePage(2)">2</a>
                </li>
                <li class="page-item" data-page="3">
                    <a class="page-link" href="#" onclick="changePage(3)">3</a>
                </li>
                <li class="page-item" data-page="4">
                    <a class="page-link" href="#" onclick="changePage(4)">4</a>
                </li>
                <li class="page-item" id="nextPage">
                    <a class="page-link" href="#" onclick="changePage('next')">
                        Next<i class="fas fa-arrow-right ms-1"></i>
                    </a>
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

    <!-- Product Options Modal -->
    <div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h5 class="modal-title fw-bold" id="productModalLabel">Detail Produk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <!-- Product Images -->
                        <div class="col-md-6">
                            <div class="product-image-gallery">
                                <!-- Main Product Image -->
                                <div class="main-image-container mb-3">
                                    <img id="modalProductImage" src="" alt="" class="img-fluid rounded main-product-image">
                                </div>

                                <!-- Thumbnail Images -->
                                <div class="thumbnail-images d-flex gap-2">
                                    <div class="thumbnail-item active">
                                        <img id="thumb1" src="/image/kategori/fashion/kemeja_formal.png" alt="" class="img-fluid rounded thumbnail-img">
                                    </div>
                                    <div class="thumbnail-item">
                                        <img id="thumb2" src="/image/kategori/fashion/kemeja_formal.png" alt="" class="img-fluid rounded thumbnail-img">
                                    </div>
                                    <div class="thumbnail-item">
                                        <img id="thumb3" src="/image/kategori/fashion/kemeja_formal.png" alt="" class="img-fluid rounded thumbnail-img">
                                    </div>
                                    <div class="thumbnail-item">
                                        <img id="thumb4" src="/image/kategori/fashion/kemeja_formal.png" alt="" class="img-fluid rounded thumbnail-img">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Product Details -->
                        <div class="col-md-6">
                            <div class="product-details-modal">
                                <!-- Product Title & Category -->
                                <div class="product-header mb-3">
                                    <span id="modalProductCategory" class="badge bg-primary mb-2"></span>
                                    <h4 id="modalProductName" class="fw-bold mb-2"></h4>
                                    
                                    <!-- Store Information -->
                                    <div class="store-info mb-3">
                                        <div class="d-flex align-items-center">
                                            <img src="/image/logo/yogya-store.png" alt="Store" class="store-logo me-2" onerror="this.style.display='none'">
                                            <div>
                                                <div class="store-name fw-semibold text-primary">
                                                    <i class="fas fa-store me-1"></i>
                                                    MyYOGYA Official Store
                                                </div>
                                                <div class="store-badges">
                                                    <span class="badge bg-success me-1">
                                                        <i class="fas fa-check-circle me-1"></i>Toko Resmi
                                                    </span>
                                                    <span class="badge bg-warning text-dark me-1">
                                                        <i class="fas fa-star me-1"></i>4.8
                                                    </span>
                                                    <span class="badge bg-info">
                                                        <i class="fas fa-shipping-fast me-1"></i>Pengiriman Cepat
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="product-rating mb-3">
                                        <div class="stars d-inline-block me-2">
                                            <i class="fas fa-star text-warning"></i>
                                            <i class="fas fa-star text-warning"></i>
                                            <i class="fas fa-star text-warning"></i>
                                            <i class="fas fa-star text-warning"></i>
                                            <i class="fas fa-star text-warning"></i>
                                        </div>
                                        <span class="text-muted">(4.5) • 150+ terjual</span>
                                    </div>
                                </div>

                                <!-- Price Section -->
                                <div class="price-section mb-4">
                                    <span id="modalCurrentPrice" class="current-price-modal"></span>
                                    <span id="modalOriginalPrice" class="original-price-modal"></span>
                                    <div class="price-savings mt-1">
                                        <span class="badge bg-danger">Hemat 25%</span>
                                    </div>
                                </div>

                                <!-- Product Description -->
                                <div class="product-description mb-4">
                                    <h6 class="fw-semibold mb-2">Deskripsi Produk:</h6>
                                    <p id="modalProductDescription" class="text-muted mb-3"></p>

                                    <!-- Product Features -->
                                    <div class="product-features">
                                        <h6 class="fw-semibold mb-2">Keunggulan:</h6>
                                        <ul class="feature-list">
                                            <li><i class="fas fa-check text-success me-2"></i>Kualitas Premium</li>
                                            <li><i class="fas fa-check text-success me-2"></i>Bahan Berkualitas Tinggi</li>
                                            <li><i class="fas fa-check text-success me-2"></i>Garansi Resmi</li>
                                            <li><i class="fas fa-check text-success me-2"></i>Pengiriman Gratis</li>
                                        </ul>
                                    </div>
                                </div>

                                <!-- Size Selection -->
                                <div class="option-group mb-4">
                                    <label class="form-label fw-semibold">Ukuran:</label>
                                    <div class="size-options">
                                        <input type="radio" name="size" id="size-xs" value="XS" class="btn-check">
                                        <label class="btn btn-outline-secondary size-btn" for="size-xs">XS</label>

                                        <input type="radio" name="size" id="size-s" value="S" class="btn-check">
                                        <label class="btn btn-outline-secondary size-btn" for="size-s">S</label>

                                        <input type="radio" name="size" id="size-m" value="M" class="btn-check" checked>
                                        <label class="btn btn-outline-secondary size-btn" for="size-m">M</label>

                                        <input type="radio" name="size" id="size-l" value="L" class="btn-check">
                                        <label class="btn btn-outline-secondary size-btn" for="size-l">L</label>

                                        <input type="radio" name="size" id="size-xl" value="XL" class="btn-check">
                                        <label class="btn btn-outline-secondary size-btn" for="size-xl">XL</label>

                                        <input type="radio" name="size" id="size-xxl" value="XXL" class="btn-check">
                                        <label class="btn btn-outline-secondary size-btn" for="size-xxl">XXL</label>
                                    </div>
                                </div>

                                <!-- Color Selection -->
                                <div class="option-group mb-4">
                                    <label class="form-label fw-semibold">Warna:</label>
                                    <div class="color-options">
                                        <input type="radio" name="color" id="color-black" value="Hitam" class="btn-check">
                                        <label class="btn color-btn" for="color-black" style="background-color: #000000;" title="Hitam"></label>

                                        <input type="radio" name="color" id="color-white" value="Putih" class="btn-check" checked>
                                        <label class="btn color-btn" for="color-white" style="background-color: #ffffff; border: 2px solid #ddd;" title="Putih"></label>

                                        <input type="radio" name="color" id="color-red" value="Merah" class="btn-check">
                                        <label class="btn color-btn" for="color-red" style="background-color: #dc3545;" title="Merah"></label>

                                        <input type="radio" name="color" id="color-blue" value="Biru" class="btn-check">
                                        <label class="btn color-btn" for="color-blue" style="background-color: #0d6efd;" title="Biru"></label>

                                        <input type="radio" name="color" id="color-green" value="Hijau" class="btn-check">
                                        <label class="btn color-btn" for="color-green" style="background-color: #198754;" title="Hijau"></label>

                                        <input type="radio" name="color" id="color-yellow" value="Kuning" class="btn-check">
                                        <label class="btn color-btn" for="color-yellow" style="background-color: #ffc107;" title="Kuning"></label>

                                        <input type="radio" name="color" id="color-navy" value="Navy" class="btn-check">
                                        <label class="btn color-btn" for="color-navy" style="background-color: #1e3a8a;" title="Navy"></label>
                                    </div>
                                </div>

                                <!-- Quantity Selection -->
                                <div class="option-group mb-4">
                                    <label class="form-label fw-semibold">Jumlah:</label>
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="quantity-selector">
                                            <button type="button" class="btn btn-outline-secondary quantity-btn" onclick="decreaseQuantity()">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                            <input type="number" id="quantity" class="form-control quantity-input" value="1" min="1" max="10">
                                            <button type="button" class="btn btn-outline-secondary quantity-btn" onclick="increaseQuantity()">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </div>
                                        <small class="text-muted">Stok tersedia: <span class="fw-bold text-success">20</span></small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <div class="text-center w-100">
                        <p class="text-muted mb-0">Lihat detail produk untuk informasi lengkap</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('styles')
    <style>
    /* Product Card Hover Effects */
    .product-clickable {
        transition: all 0.3s ease;
    }

    .product-clickable:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }

    .product-clickable:hover .product-image img {
        transform: scale(1.05);
    }

    .product-image {
        overflow: hidden;
    }

    .product-image img {
        transition: transform 0.3s ease;
    }

    /* Product Modal Styles */
    .main-product-image {
        max-height: 400px;
        object-fit: cover;
        width: 100%;
        border: 1px solid #eee;
    }

    .thumbnail-images {
        max-height: 80px;
    }

    .thumbnail-item {
        cursor: pointer;
        border: 2px solid transparent;
        border-radius: 8px;
        overflow: hidden;
        transition: all 0.3s ease;
        opacity: 0.7;
    }

    .thumbnail-item.active,
    .thumbnail-item:hover {
        border-color: #f26b37;
        opacity: 1;
    }

    .thumbnail-img {
        width: 70px;
        height: 70px;
        object-fit: cover;
    }

    .product-header .badge {
        font-size: 0.75rem;
    }

    .product-description {
        background: #f8f9fa;
        padding: 15px;
        border-radius: 8px;
        border-left: 4px solid #f26b37;
    }

    .feature-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .feature-list li {
        padding: 5px 0;
        font-size: 0.9rem;
    }

    .current-price-modal {
        font-size: 1.8rem;
        font-weight: 700;
        color: #e74c3c;
    }

    .original-price-modal {
        color: #95a5a6;
        text-decoration: line-through;
        margin-left: 15px;
        font-size: 1.2rem;
    }

    .price-savings .badge {
        font-size: 0.8rem;
    }
    .product-image-modal img {
        max-height: 300px;
        object-fit: cover;
        width: 100%;
    }

    .current-price-modal {
        font-size: 1.5rem;
        font-weight: 700;
        color: #e74c3c;
    }

    .original-price-modal {
        color: #95a5a6;
        text-decoration: line-through;
        margin-left: 10px;
        font-size: 1.1rem;
    }

    /* Size Options */
    .size-options {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
    }

    .size-btn {
        min-width: 50px;
        border-radius: 8px !important;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .size-btn:hover {
        background: #f26b37;
        border-color: #f26b37;
        color: white;
    }

    .btn-check:checked + .size-btn {
        background: #f26b37 !important;
        border-color: #f26b37 !important;
        color: white !important;
    }

    /* Color Options */
    .color-options {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }

    .color-btn {
        width: 40px;
        height: 40px;
        border-radius: 50% !important;
        border: 3px solid transparent !important;
        transition: all 0.3s ease;
        position: relative;
    }

    .color-btn:hover {
        transform: scale(1.1);
        box-shadow: 0 4px 10px rgba(0,0,0,0.2);
    }

    .btn-check:checked + .color-btn {
        border-color: #f26b37 !important;
        box-shadow: 0 0 0 3px rgba(242, 107, 55, 0.3);
    }

    /* Quantity Selector */
    .quantity-selector {
        display: flex;
        align-items: center;
        gap: 0;
        max-width: 150px;
    }

    .quantity-btn {
        width: 40px;
        height: 40px;
        border-radius: 0;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .quantity-btn:first-child {
        border-top-left-radius: 8px;
        border-bottom-left-radius: 8px;
    }

    .quantity-btn:last-child {
        border-top-right-radius: 8px;
        border-bottom-right-radius: 8px;
    }

    .quantity-input {
        border-radius: 0;
        text-align: center;
        width: 70px;
        border-left: 0;
        border-right: 0;
    }

    .quantity-input:focus {
        box-shadow: none;
        border-color: #f26b37;
    }

    /* Modal Actions - Cart button removed */

    /* Responsive Modal */
    @media (max-width: 768px) {
        .modal-dialog {
            margin: 10px;
        }

        .product-image-modal img {
            max-height: 200px;
        }

        .size-options {
            gap: 6px;
        }

        .size-btn {
            min-width: 45px;
            font-size: 0.9rem;
        }

        .color-btn {
            width: 35px;
            height: 35px;
        }
    }
    </style>
@endpush

@push('scripts')
    <script>
    // Pagination variables
    let currentPage = 1;
    const totalPages = 20; // Total halaman yang tersedia

    // Pagination functions
    function updatePagination() {
        const pagination = document.getElementById('pagination');
        const prevButton = document.getElementById('prevPage');
        const nextButton = document.getElementById('nextPage');

        // Clear existing page numbers
        const pageItems = pagination.querySelectorAll('.page-item[data-page]');
        pageItems.forEach(item => item.remove());

        // Calculate page range to show
        let startPage = Math.max(1, currentPage - 2);
        let endPage = Math.min(totalPages, startPage + 3);

        // Adjust start page if we're near the end
        if (endPage - startPage < 3) {
            startPage = Math.max(1, endPage - 3);
        }

        // Create page number buttons
        for (let i = startPage; i <= endPage; i++) {
            const pageItem = document.createElement('li');
            pageItem.className = `page-item ${i === currentPage ? 'active' : ''}`;
            pageItem.setAttribute('data-page', i);

            const pageLink = document.createElement('a');
            pageLink.className = 'page-link';
            pageLink.href = '#';
            pageLink.textContent = i;
            pageLink.onclick = () => changePage(i);

            pageItem.appendChild(pageLink);
            nextButton.parentNode.insertBefore(pageItem, nextButton);
        }

        // Update Previous button state
        if (currentPage <= 1) {
            prevButton.classList.add('disabled');
            prevButton.querySelector('a').style.pointerEvents = 'none';
            prevButton.querySelector('a').style.opacity = '0.5';
        } else {
            prevButton.classList.remove('disabled');
            prevButton.querySelector('a').style.pointerEvents = 'auto';
            prevButton.querySelector('a').style.opacity = '1';
        }

        // Update Next button state
        if (currentPage >= totalPages) {
            nextButton.classList.add('disabled');
            nextButton.querySelector('a').style.pointerEvents = 'none';
            nextButton.querySelector('a').style.opacity = '0.5';
        } else {
            nextButton.classList.remove('disabled');
            nextButton.querySelector('a').style.pointerEvents = 'auto';
            nextButton.querySelector('a').style.opacity = '1';
        }

        // Update page info
        updatePageInfo();
    }

    function changePage(page) {
        if (page === 'prev' && currentPage > 1) {
            currentPage--;
        } else if (page === 'next' && currentPage < totalPages) {
            currentPage++;
        } else if (typeof page === 'number' && page >= 1 && page <= totalPages) {
            currentPage = page;
        }

        // Update pagination display
        updatePagination();

        // Scroll to top of products
        document.querySelector('.product-grid').scrollIntoView({ 
            behavior: 'smooth',
            block: 'start'
        });

        // Here you would typically load new products from server
        // For now, we'll just update the page display
        console.log(`Loading page ${currentPage}`);
    }

    function updatePageInfo() {
        const pageInfo = document.querySelector('.text-muted');
        if (pageInfo) {
            const itemsPerPage = 12;
            const startItem = (currentPage - 1) * itemsPerPage + 1;
            const endItem = Math.min(currentPage * itemsPerPage, 234); // 234 total products
            pageInfo.textContent = `Menampilkan ${startItem}-${endItem} dari 234 produk`;
        }
    }

    // Product modal functionality
    document.addEventListener('DOMContentLoaded', function() {
        const productModal = document.getElementById('productModal');

        // Initialize pagination
        updatePagination();

        if (productModal) {
            productModal.addEventListener('show.bs.modal', function(event) {
                const button = event.relatedTarget;
                const productName = button.getAttribute('data-product-name');
                const productPrice = button.getAttribute('data-product-price');
                const productOriginalPrice = button.getAttribute('data-product-original-price');
                const productImage = button.getAttribute('data-product-image');
                const productDescription = button.getAttribute('data-product-description');
                const productCategory = button.getAttribute('data-product-category');
                const productId = button.getAttribute('data-product-id');

                // Update modal content
                document.getElementById('modalProductName').textContent = productName;
                document.getElementById('modalCurrentPrice').textContent = productPrice;
                document.getElementById('modalProductImage').src = productImage;
                document.getElementById('modalProductImage').alt = productName;
                document.getElementById('modalProductDescription').textContent = productDescription;
                document.getElementById('modalProductCategory').textContent = productCategory;

                // Store product data for cart
                productModal.setAttribute('data-product-id', productId);
                productModal.setAttribute('data-product-name', productName);
                productModal.setAttribute('data-product-price', productPrice.replace(/[^\d]/g, ''));
                productModal.setAttribute('data-product-image', productImage);
                productModal.setAttribute('data-product-category', productCategory);

                // Handle original price
                const originalPriceElement = document.getElementById('modalOriginalPrice');
                if (productOriginalPrice && productOriginalPrice !== '') {
                    originalPriceElement.textContent = productOriginalPrice;
                    originalPriceElement.style.display = 'inline';
                } else {
                    originalPriceElement.style.display = 'none';
                }

                // Set thumbnail images (same image for demo purposes)
                document.getElementById('thumb1').src = productImage;
                document.getElementById('thumb2').src = productImage;
                document.getElementById('thumb3').src = productImage;
                document.getElementById('thumb4').src = productImage;

                // Reset form selections
                document.querySelector('input[name="color"][value="Putih"]').checked = true;
                document.querySelector('input[name="size"][value="M"]').checked = true;
                document.getElementById('quantity').value = 1;
            });

            // Handle thumbnail clicks
            document.addEventListener('click', function(e) {
                if (e.target.closest('.thumbnail-item')) {
                    const clickedThumb = e.target.closest('.thumbnail-item');

                    // Remove active class from all thumbnails
                    document.querySelectorAll('.thumbnail-item').forEach(t => t.classList.remove('active'));
                    // Add active class to clicked thumbnail
                    clickedThumb.classList.add('active');

                    // Update main image
                    const mainImage = document.getElementById('modalProductImage');
                    const thumbImage = clickedThumb.querySelector('img');
                    if (thumbImage && mainImage) {
                        mainImage.src = thumbImage.src;
                    }
                }
            });
        }

                // Reset form
                document.getElementById('quantity').value = 1;
                document.querySelector('input[name="size"][value="M"]').checked = true;
                document.querySelector('input[name="color"][value="Putih"]').checked = true;
            });
        }

        // Update cart badge on page load
        updateCartBadge();
    });

    }

    // Quantity functions (kept for display purposes only)
    function increaseQuantity() {
        const quantityInput = document.getElementById('quantity');
        const currentValue = parseInt(quantityInput.value);
        const maxValue = parseInt(quantityInput.max);

        if (currentValue < maxValue) {
            quantityInput.value = currentValue + 1;
        }
    }

    function decreaseQuantity() {
        const quantityInput = document.getElementById('quantity');
        const currentValue = parseInt(quantityInput.value);
        const minValue = parseInt(quantityInput.min);

        if (currentValue > minValue) {
            quantityInput.value = currentValue - 1;
        }
    }

    // Toast notification function
    function showToast(message, type = 'success') {
        // Create toast element
        const toastHtml = `
            <div class="toast align-items-center text-white bg-${type} border-0" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                        <i class="fas fa-check-circle me-2"></i>${message}
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
        `;

        // Create toast container if it doesn't exist
        let toastContainer = document.getElementById('toast-container');
        if (!toastContainer) {
            toastContainer = document.createElement('div');
            toastContainer.id = 'toast-container';
            toastContainer.className = 'toast-container position-fixed top-0 end-0 p-3';
            toastContainer.style.zIndex = '9999';
            document.body.appendChild(toastContainer);
        }

        // Add toast to container
        toastContainer.insertAdjacentHTML('beforeend', toastHtml);

        // Initialize and show toast
        const toastElement = toastContainer.lastElementChild;
        const toast = new bootstrap.Toast(toastElement, {
            autohide: true,
            delay: 3000
        });
        toast.show();

        // Remove toast element after it's hidden
        toastElement.addEventListener('hidden.bs.toast', function() {
            toastElement.remove();
        });
    }
    </script>

    <!-- Pagination functionality disabled as requested -->
@endpush
