@extends('layouts.app')

@section('title', 'Elektronik - MyYOGYA')

@section('content')
<!-- Category Header -->
<div class="category-header">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <nav class="breadcrumb-custom">
                <a href="{{ route('dashboard') }}">Beranda</a>
                <span class="mx-2">/</span>
                <span>Elektronik</span>
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
        
        <h1 class="display-5 fw-bold mb-3">Elektronik</h1>
        <p class="lead mb-0">Temukan berbagai produk elektronik terkini dengan teknologi terdepan</p>
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
            <div class="col-md-3 text-end">
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
        <div class="product-card" onclick="openProductModal('{{ addslashes($product['name']) }}', '{{ $product['image'] }}', '{{ $product['price'] }}', '{{ $product['original_price'] ?? '' }}', {{ $product['rating'] }}, {{ $product['reviews'] }}, 'TechStore Official')" style="cursor: pointer;">
            <div class="product-image">
                <img src="{{ $product['image'] }}" alt="{{ $product['name'] }}">
                @if($product['discount'])
                <span class="discount-badge">-{{ $product['discount'] }}</span>
                @endif
                <button class="wishlist-btn" onclick="event.stopPropagation();">
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
                    
                    <div class="store-info">
                        <small class="text-muted">TechStore Official</small>
                    </div>
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
                <a class="page-link" href="#" data-page="13" title="Go to page 13">13</a>
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

<!-- Pagination functionality disabled as requested -->

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

    /* Store Info Styles */
    .store-info {
        margin-top: 8px;
    }
    
    .store-info small {
        font-size: 0.8rem;
        color: #666;
    }

    /* Product Card Hover Effect */
    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.15);
    }
</style>
@endpush

<script>
// Add to cart function
function addToCart(event, product) {
    event.stopPropagation(); // Prevent any parent click events
    
    // Get existing cart from localStorage
    let cart = JSON.parse(localStorage.getItem('cart') || '[]');
    
    // Check if product already exists in cart
    const existingProductIndex = cart.findIndex(item => 
        item.id === product.id && item.name === product.name
    );
    
    if (existingProductIndex > -1) {
        // If product exists, increase quantity
        cart[existingProductIndex].quantity += 1;
    } else {
        // If new product, add to cart
        product.quantity = 1;
        cart.push(product);
    }
    
    // Save to localStorage
    localStorage.setItem('cart', JSON.stringify(cart));
    
    // Update cart counter in navbar (use global function from layout)
    if (typeof updateCartBadge === 'function') {
        updateCartBadge();
    }
    
    // Show success toast
    showToast(`${product.name} berhasil ditambahkan ke keranjang!`, 'success');
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

// Product modal functions
function openProductModal(name, image, price, originalPrice, rating, reviews, storeName) {
    const modal = document.getElementById('productModal');
    
    // Update modal content
    modal.querySelector('.modal-title').textContent = name;
    modal.querySelector('.product-image').src = image;
    modal.querySelector('.current-price').textContent = price;
    modal.querySelector('.store-name').textContent = storeName;
    
    if (originalPrice) {
        modal.querySelector('.original-price').textContent = originalPrice;
        modal.querySelector('.original-price').style.display = 'inline';
    } else {
        modal.querySelector('.original-price').style.display = 'none';
    }
    
    // Update rating
    const starsContainer = modal.querySelector('.modal-rating .stars');
    starsContainer.innerHTML = '';
    for (let i = 1; i <= 5; i++) {
        const star = document.createElement('i');
        star.className = `fas fa-star${i <= Math.floor(rating) ? '' : ' text-muted'}`;
        starsContainer.appendChild(star);
    }
    modal.querySelector('.review-count').textContent = `(${reviews} ulasan)`;
    
    // Show modal
    const modalInstance = new bootstrap.Modal(modal);
    modalInstance.show();
}

function addToCartFromModal() {
    const modal = document.getElementById('productModal');
    const productTitle = modal.querySelector('.modal-title').textContent;
    const productPrice = modal.querySelector('.current-price').textContent;
    const productImage = modal.querySelector('.product-image').src;
    const quantityInput = document.getElementById('quantity');
    const quantity = parseInt(quantityInput?.value || 1);
    
    // Data produk yang akan ditambahkan ke keranjang
    const product = {
        id: Date.now(), // Generate unique ID
        name: productTitle,
        price: parseInt(productPrice.replace(/[^0-9]/g, '')),
        quantity: quantity,
        image: productImage,
        category: 'Elektronik'
    };
    
    // Use existing addToCart function but modify for modal context
    let cart = JSON.parse(localStorage.getItem('cart') || '[]');
    
    // Check if product already exists in cart
    const existingProductIndex = cart.findIndex(item => 
        item.name === product.name
    );
    
    if (existingProductIndex !== -1) {
        // If product exists, increase quantity
        cart[existingProductIndex].quantity += quantity;
    } else {
        // If new product, add to cart
        cart.push(product);
    }
    
    // Save updated cart to localStorage
    localStorage.setItem('cart', JSON.stringify(cart));
    
    // Update cart counter in navbar
    if (typeof updateCartBadge === 'function') {
        updateCartBadge();
    }
    
    // Tutup modal
    const modalInstance = bootstrap.Modal.getInstance(modal);
    modalInstance.hide();
    
    showToast('Produk berhasil ditambahkan ke keranjang!', 'success');
}

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

function addToWishlist() {
    showToast('Produk ditambahkan ke wishlist!', 'success');
}

// Initialize cart counter on page load
document.addEventListener('DOMContentLoaded', function() {
    if (typeof updateCartBadge === 'function') {
        updateCartBadge();
    }
});
</script>

<!-- Product Detail Modal -->
<div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0 pb-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pt-0">
                <div class="row">
                    <!-- Product Image -->
                    <div class="col-md-6">
                        <div class="product-image-container text-center">
                            <img src="" alt="" class="product-image img-fluid rounded" style="max-height: 400px;">
                        </div>
                    </div>
                    
                    <!-- Product Info -->
                    <div class="col-md-6">
                        <div class="product-details">
                            <!-- Store Information -->
                            <div class="store-section mb-3 p-3 bg-light rounded">
                                <div class="d-flex align-items-center mb-2">
                                    <div class="store-avatar me-3">
                                        <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                            <i class="fas fa-store"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h6 class="store-name mb-1">TechStore Official</h6>
                                        <div class="d-flex align-items-center gap-2">
                                            <span class="badge bg-success">
                                                <i class="fas fa-check-circle me-1"></i>Official Store
                                            </span>
                                            <span class="badge bg-warning text-dark">
                                                <i class="fas fa-star me-1"></i>4.8
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row text-center">
                                    <div class="col-4">
                                        <small class="text-muted d-block">Produk</small>
                                        <strong>2.3k+</strong>
                                    </div>
                                    <div class="col-4">
                                        <small class="text-muted d-block">Rating</small>
                                        <strong>4.8/5</strong>
                                    </div>
                                    <div class="col-4">
                                        <small class="text-muted d-block">Kota</small>
                                        <strong>Jakarta</strong>
                                    </div>
                                </div>
                            </div>

                            <!-- Product Title -->
                            <h4 class="modal-title mb-3">Product Name</h4>
                            
                            <!-- Rating -->
                            <div class="modal-rating mb-3">
                                <div class="d-flex align-items-center">
                                    <div class="stars me-2">
                                        <!-- Stars will be populated by JavaScript -->
                                    </div>
                                    <span class="review-count text-muted">(0 ulasan)</span>
                                </div>
                            </div>
                            
                            <!-- Price -->
                            <div class="price-section mb-4">
                                <div class="d-flex align-items-baseline gap-2">
                                    <span class="current-price h4 text-danger mb-0">Rp 0</span>
                                    <span class="original-price text-muted text-decoration-line-through">Rp 0</span>
                                </div>
                            </div>
                            
                            <!-- Product Description -->
                            <div class="product-description mb-4">
                                <h6>Deskripsi Produk</h6>
                                <p class="text-muted">
                                    Produk elektronik berkualitas tinggi dengan teknologi terdepan. 
                                    Dilengkapi dengan fitur-fitur canggih untuk memenuhi kebutuhan sehari-hari Anda.
                                    Garansi resmi 1 tahun dari distributor resmi.
                                </p>
                            </div>
                            
                            <!-- Quantity Selector -->
                            <div class="quantity-section mb-4">
                                <label class="form-label">Kuantitas</label>
                                <div class="d-flex align-items-center gap-2">
                                    <button type="button" class="btn btn-outline-secondary btn-sm" onclick="decreaseQuantity()">-</button>
                                    <input type="number" id="quantity" class="form-control text-center" style="width: 80px;" value="1" min="1" max="99">
                                    <button type="button" class="btn btn-outline-secondary btn-sm" onclick="increaseQuantity()">+</button>
                                    <small class="text-muted ms-2">Stok: 50</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer border-0 pt-0">
                <div class="d-flex gap-2 w-100">
                    <button type="button" class="btn btn-outline-primary flex-fill" onclick="addToWishlist()">
                        <i class="far fa-heart me-2"></i>Wishlist
                    </button>
                    <button type="button" class="btn btn-primary flex-fill" onclick="addToCartFromModal()">
                        <i class="fas fa-shopping-cart me-2"></i>Tambah ke Keranjang
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
