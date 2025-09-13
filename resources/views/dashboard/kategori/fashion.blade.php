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
                    <small class="text-muted">Menampilkan {{ $products->count() }} dari {{ $products->total() }} produk</small>
                </div>
            </div>
        </div>

        <!-- Products Grid -->
        <div class="product-grid">
            @forelse($products as $product)
                <div class="product-item" onclick="openProductModal({{ $product->id_produk }})" data-product-id="{{ $product->id_produk }}"
                     style="transition: none !important; transform: none !important; animation: none !important;">
                    <div class="product-image" style="transition: none !important; transform: none !important;">
                        <img src="{{ $product->image }}" alt="{{ $product->name }}" 
                             onerror="this.onerror=null; this.src='{{ asset('images/products/placeholder-fashion.jpg') }}'"
                             style="transition: none !important; display: block; opacity: 1 !important; transform: none !important; animation: none !important;"
                             onload="this.style.opacity='1'"
                             loading="eager">>
                    </div>
                    <div class="product-info">
                        <h6 class="product-title">{{ $product->name }}</h6>
                        <div class="rating">
                            <div class="stars">
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="fas fa-star{{ $i <= floor($product->rating) ? ' text-warning' : ' text-muted' }}"></i>
                                @endfor
                            </div>
                            <span class="review-count">({{ $product->reviews_count }})</span>
                        </div>
                        <div class="product-price">
                            <span class="current-price">{{ $product->formatted_price }}</span>
                        </div>
                        <div class="product-actions">
                            <button class="btn-quick-view" onclick="openProductModal({{ $product->id_produk }})">
                                <i class="fas fa-eye me-1"></i>Lihat Detail
                            </button>
                            <button class="btn-add-cart" onclick="addToCartDirect({{ $product->id_produk }})">
                                <i class="fas fa-shopping-cart me-1"></i>Keranjang
                            </button>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <i class="fas fa-box-open fa-3x text-muted mb-3"></i>
                    <h5 class="text-muted">Belum ada produk tersedia</h5>
                    <p class="text-muted">Produk fashion akan segera hadir!</p>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($products->hasPages())
            <div class="d-flex justify-content-center mt-5">
                {{ $products->links() }}
            </div>
        @endif
    </div>

    <!-- Product Detail Modal -->
    <div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="productModalLabel">Detail Produk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modal-content">
                    <!-- Dynamic content will be loaded here -->
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
    /* ULTIMATE ANTI-FLICKER RULES */
    body, html {
        overflow-x: hidden;
    }
    
    /* Global image anti-flicker rules */
    * img, img * {
        transition: none !important;
        transform: none !important;
        animation: none !important;
        will-change: auto !important;
        backface-visibility: hidden !important;
        -webkit-backface-visibility: hidden !important;
        -webkit-transform: translateZ(0) !important;
        transform: translateZ(0) !important;
    }
    
    /* Force stable rendering */
    .product-image, .product-image * {
        transform: none !important;
        transition: none !important;
        animation: none !important;
    }
    
    /* Product Grid Styling */
    .product-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .product-item {
        border: 1px solid #e3e6f0;
        border-radius: 0.5rem;
        background: white;
        overflow: hidden;
        /* COMPLETE ANTI-FLICKER */
        transition: none !important;
        transform: none !important;
        animation: none !important;
        will-change: auto !important;
    }

    .product-item:hover {
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        /* REMOVE TRANSFORM TO PREVENT FLICKER */
        transform: none !important;
        transition: none !important;
    }

    .product-image {
        position: relative;
        overflow: hidden;
        height: 200px;
    }

    .product-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        opacity: 1 !important;
        background-color: #f8f9fa;
        display: block;
        transition: none !important;
        transform: none !important;
        will-change: auto;
        backface-visibility: hidden;
        -webkit-backface-visibility: hidden;
        image-rendering: auto;
    }

    /* Loading state */
    .product-image::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 40px;
        height: 40px;
        background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="%23dee2e6"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/></svg>') no-repeat center;
        background-size: contain;
        z-index: 1;
    }

    /* Remove hover transform to prevent flicker */
    .product-item:hover .product-image img {
        /* transform: scale(1.05); - REMOVED to prevent flicker */
        /* filter: brightness(1.1); - ALSO REMOVE TO PREVENT FLICKER */
        transform: none !important;
        transition: none !important;
        filter: none !important;
    }

    .product-info {
        padding: 1rem;
    }

    .product-title {
        font-size: 1rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
        color: #5a5c69;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .product-price {
        font-size: 1.1rem;
        font-weight: 700;
        color: #e74a3b;
        margin-bottom: 0.5rem;
    }

    .original-price {
        font-size: 0.9rem;
        color: #858796;
        text-decoration: line-through;
        margin-left: 0.5rem;
    }

    .discount-badge {
        position: absolute;
        top: 10px;
        left: 10px;
        background: #e74a3b;
        color: white;
        padding: 0.25rem 0.5rem;
        border-radius: 0.25rem;
        font-size: 0.75rem;
        font-weight: 600;
    }

    .rating {
        display: flex;
        align-items: center;
        margin-bottom: 0.5rem;
    }

    .rating .stars {
        color: #f6c23e;
        margin-right: 0.5rem;
    }

    .product-actions {
        display: flex;
        gap: 0.5rem;
        margin-top: 1rem;
    }

    .btn-quick-view {
        flex: 1;
        background: #4e73df;
        color: white;
        border: none;
        padding: 0.5rem;
        border-radius: 0.25rem;
        font-size: 0.875rem;
        transition: all 0.3s ease;
    }

    .btn-quick-view:hover {
        background: #2e59d9;
        color: white;
    }

    .btn-add-cart {
        flex: 1;
        background: #1cc88a;
        color: white;
        border: none;
        padding: 0.5rem;
        border-radius: 0.25rem;
        font-size: 0.875rem;
        transition: all 0.3s ease;
    }

    .btn-add-cart:hover {
        background: #17a673;
        color: white;
    }

    .original-price {
        font-size: 0.9rem;
        color: #858796;
        text-decoration: line-through;
        margin-left: 0.5rem;
    }

    .discount-badge {
        position: absolute;
        top: 10px;
        left: 10px;
        background: #e74a3b;
        color: white;
        padding: 0.25rem 0.5rem;
        border-radius: 0.25rem;
        font-size: 0.75rem;
        font-weight: 600;
    }

    /* Modal Styling */
    .modal-lg {
        max-width: 1000px;
    }

    /* Ensure modal backdrop is properly removed */
    .modal-backdrop {
        transition: opacity 0.15s linear !important;
    }
    
    .modal-backdrop.show {
        opacity: 0.5;
    }
    
    /* Prevent body scroll issues */
    body.modal-open {
        overflow: hidden !important;
        padding-right: 0 !important;
    }

    .main-product-image {
        max-height: 450px;
        width: 100%;
        object-fit: cover;
        border-radius: 0.5rem;
        border: 1px solid #e3e6f0;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        transition: none !important;
        opacity: 1 !important;
        display: block;
        background-color: #f8f9fa;
    }

    .store-info {
        background: #f8f9fc;
        padding: 1rem;
        border-radius: 0.5rem;
        border-left: 4px solid #4e73df;
    }

    .store-name {
        font-size: 1rem;
        margin-bottom: 0.5rem;
    }

    .store-badges .badge {
        font-size: 0.75rem;
    }

    .quantity-selector {
        max-width: 200px;
    }

    .quantity-input {
        max-width: 80px;
        text-align: center;
    }

    .quantity-btn {
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .feature-list {
        list-style: none;
        padding: 0;
    }

    .feature-list li {
        padding: 0.25rem 0;
        color: #5a5c69;
    }

    /* Pagination Styling */
    .pagination-info {
        display: flex;
        justify-content: between;
        align-items: center;
        margin-top: 2rem;
        padding: 1rem 0;
        border-top: 1px solid #e3e6f0;
    }

    .showing-text {
        color: #858796;
        font-size: 0.875rem;
    }

    /* Category Header */
    .category-header {
        background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
        color: white;
        padding: 2rem 0;
        margin-bottom: 2rem;
        border-radius: 0.5rem;
    }

    .category-title {
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
    }

    .category-description {
        font-size: 1.1rem;
        opacity: 0.9;
    }

    /* Filter Section */
    .filter-section {
        background: white;
        padding: 1.5rem;
        border-radius: 0.5rem;
        border: 1px solid #e3e6f0;
        margin-bottom: 2rem;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .product-grid {
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 1rem;
        }
        
        .category-title {
            font-size: 1.5rem;
        }
        
        .modal-lg {
            max-width: 95%;
        }
        
        .main-product-image {
            max-height: 300px;
        }
        
        .action-buttons .d-md-flex {
            flex-direction: column;
        }
        
        .action-buttons .btn {
            margin-bottom: 0.5rem;
        }
    }

    @media (max-width: 576px) {
        .product-grid {
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
        }
        
        .product-info {
            padding: 0.75rem;
        }
        
        .product-title {
            font-size: 0.875rem;
        }
        
        .product-price {
            font-size: 1rem;
        }
    }

    /* Toast Notifications */
    .toast-notification {
        position: fixed;
        top: 20px;
        right: 20px;
        z-index: 9999;
        background: white;
        border-radius: 0.5rem;
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        padding: 1rem;
        margin-bottom: 1rem;
        transform: translateX(400px);
        transition: all 0.3s ease;
        opacity: 0;
        max-width: 350px;
    }

    .toast-notification.show {
        transform: translateX(0);
        opacity: 1;
    }

    .toast-notification.success {
        border-left: 4px solid #1cc88a;
    }

    .toast-notification.error {
        border-left: 4px solid #e74a3b;
    }

    .toast-content {
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .toast-notification.success .fas {
        color: #1cc88a;
    }

    .toast-notification.error .fas {
        color: #e74a3b;
    }

    .toast-content span {
        color: #5a5c69;
        font-weight: 500;
    }
    </style>
@endpush

@push('scripts')
    <script>
    let currentProduct = null;

    // Open product modal and load dynamic content
    async function openProductModal(productId) {
        const modal = document.getElementById('productModal');
        const modalContent = document.getElementById('modal-content');
        
        // Show loading
        modalContent.innerHTML = `
            <div class="text-center py-5">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <p class="mt-2">Memuat detail produk...</p>
            </div>
        `;
        
        // Show modal
        const bootstrapModal = new bootstrap.Modal(modal, {
            backdrop: true,
            keyboard: true,
            focus: true
        });
        
        // Add event listeners for modal cleanup
        modal.addEventListener('hidden.bs.modal', function () {
            // Clean up modal content
            modalContent.innerHTML = '';
            currentProduct = null;
            
            // Remove any remaining backdrop
            const backdrop = document.querySelector('.modal-backdrop');
            if (backdrop) {
                backdrop.remove();
            }
            
            // Remove modal-open class from body if it's stuck
            document.body.classList.remove('modal-open');
            document.body.style.paddingRight = '';
            document.body.style.overflow = '';
        });
        
        bootstrapModal.show();
        
        try {
            // Fetch product data
            const response = await fetch(`/api/product/${productId}`);
            const product = await response.json();
            currentProduct = product;
            
            // Load dynamic content
            modalContent.innerHTML = generateModalContent(product);
            
            // Initialize event listeners
            initializeModalEvents();
            
        } catch (error) {
            console.error('Error loading product:', error);
            modalContent.innerHTML = `
                <div class="text-center py-5">
                    <i class="fas fa-exclamation-triangle text-warning fa-3x mb-3"></i>
                    <p class="text-muted">Gagal memuat detail produk. Silakan coba lagi.</p>
                </div>
            `;
        }
    }

    // Generate dynamic modal content
    function generateModalContent(product) {
        return `
            <div class="row">
                <!-- Product Images -->
                <div class="col-md-6">
                    <div class="product-image-gallery text-center">
                        <!-- Main Product Image Only -->
                        <div class="main-image-container">
                            <img id="modalProductImage" src="${product.image}" alt="${product.name}" 
                                 class="img-fluid rounded main-product-image"
                                 style="transition: none !important; opacity: 1 !important; display: block !important;"
                                 onload="this.style.opacity='1'"
                                 onerror="this.onerror=null; this.src='https://via.placeholder.com/450x450/e9ecef/6c757d?text=No+Image'">
                        </div>
                    </div>
                </div>

                <!-- Product Details -->
                <div class="col-md-6">
                    <div class="product-details-modal">
                        <!-- Product Header -->
                        <div class="product-header mb-3">
                            <span class="badge bg-primary mb-2">${product.subcategory || product.category}</span>
                            <h4 class="fw-bold mb-2">${product.name}</h4>
                            
                            <!-- Rating -->
                            <div class="rating-section mb-3">
                                <div class="d-flex align-items-center">
                                    <div class="stars me-2">
                                        ${Array.from({length: 5}, (_, i) => 
                                            `<i class="fas fa-star ${i < Math.floor(product.rating) ? 'text-warning' : 'text-muted'}"></i>`
                                        ).join('')}
                                    </div>
                                    <span class="rating-number fw-bold">${product.rating}</span>
                                    <span class="review-count text-muted ms-2">(${product.reviews_count} ulasan)</span>
                                </div>
                            </div>
                        </div>

                        <!-- Price Section -->
                        <div class="price-section mb-4">
                            <div class="d-flex align-items-baseline gap-2">
                                <h3 class="current-price text-danger fw-bold mb-0">${product.price}</h3>
                            </div>
                        </div>

                        <!-- Quantity Selector -->
                        <div class="quantity-section mb-4">
                            <h6 class="fw-semibold mb-2">Jumlah:</h6>
                            <div class="quantity-selector d-flex align-items-center">
                                <button class="btn btn-outline-secondary quantity-btn" onclick="changeQuantity(-1)">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <input type="number" class="form-control quantity-input mx-2" 
                                       value="1" min="1" max="${product.stock}" id="quantityInput">
                                <button class="btn btn-outline-secondary quantity-btn" onclick="changeQuantity(1)">
                                    <i class="fas fa-plus"></i>
                                </button>
                                <span class="text-muted ms-3">Stok tersedia: ${product.stock}</span>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="action-buttons mb-4">
                            <div class="d-grid gap-2 d-md-flex">
                                <button class="btn btn-primary flex-fill me-md-2" onclick="addToCart()">
                                    <i class="fas fa-shopping-cart me-2"></i>Tambah ke Keranjang
                                </button>
                                <button class="btn btn-danger flex-fill" onclick="buyNow()">
                                    <i class="fas fa-bolt me-2"></i>Beli Sekarang
                                </button>
                            </div>
                        </div>

                        <!-- Product Features -->
                        ${product.features && product.features.length > 0 ? `
                            <div class="features-section mb-4">
                                <h6 class="fw-semibold mb-2">Keunggulan Produk:</h6>
                                <ul class="feature-list">
                                    ${product.features.map(feature => `
                                        <li><i class="fas fa-check text-success me-2"></i>${feature}</li>
                                    `).join('')}
                                </ul>
                            </div>
                        ` : ''}

                        <!-- Product Description -->
                        <div class="description-section">
                            <h6 class="fw-semibold mb-2">Deskripsi Produk:</h6>
                            <p class="text-muted">${product.description}</p>
                        </div>
                    </div>
                </div>
            </div>
        `;
    }

    // Initialize modal event listeners
    function initializeModalEvents() {
        // Add close button functionality
        const modal = document.getElementById('productModal');
        const closeButtons = modal.querySelectorAll('[data-bs-dismiss="modal"], .btn-close');
        
        closeButtons.forEach(button => {
            button.addEventListener('click', function() {
                closeModal();
            });
        });
        
        // Close modal when clicking outside
        modal.addEventListener('click', function(e) {
            if (e.target === modal) {
                closeModal();
            }
        });
    }

    // Function to properly close modal
    function closeModal() {
        const modal = document.getElementById('productModal');
        const modalInstance = bootstrap.Modal.getInstance(modal);
        
        if (modalInstance) {
            modalInstance.hide();
        }
        
        // Force cleanup
        setTimeout(() => {
            // Remove backdrop
            const backdrop = document.querySelector('.modal-backdrop');
            if (backdrop) {
                backdrop.remove();
            }
            
            // Clean body classes and styles
            document.body.classList.remove('modal-open');
            document.body.style.paddingRight = '';
            document.body.style.overflow = '';
            
            // Clear modal content
            document.getElementById('modal-content').innerHTML = '';
            currentProduct = null;
        }, 150);
    }

    // Change quantity
    function changeQuantity(change) {
        const input = document.getElementById('quantityInput');
        const currentValue = parseInt(input.value);
        const newValue = currentValue + change;
        const maxStock = parseInt(input.max);
        
        if (newValue >= 1 && newValue <= maxStock) {
            input.value = newValue;
        }
    }

    // Add to cart function
    function addToCart() {
        if (!currentProduct) return;
        
        const quantity = parseInt(document.getElementById('quantityInput').value);
        
        // Check if user is logged in
        @auth('pelanggan')
            // Add to cart logic here
            alert('Produk berhasil ditambahkan ke keranjang!');
        @else
            // Show login modal
            showLoginModal();
        @endauth
    }

    // Buy now function
    function buyNow() {
        addToCart(); // Validate and add to cart first
        // Then redirect to checkout
        window.location.href = '/checkout';
    }

    // Show login modal for guests
    function showLoginModal() {
        // Implement login modal logic
        alert('Silakan login terlebih dahulu untuk menambahkan produk ke keranjang');
    }

    // Add to cart directly from product card
    async function addToCartDirect(productId) {
        try {
            const response = await fetch('/api/cart/add', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    id_produk: productId,
                    quantity: 1
                })
            });

            const result = await response.json();

            if (result.success) {
                // Show success message
                showSuccessMessage(result.message);
                
                // Update cart count if there's a cart indicator
                updateCartCount(result.cart_count);
            } else {
                // Show error message
                showErrorMessage(result.message);
            }
        } catch (error) {
            console.error('Error adding to cart:', error);
            showErrorMessage('Terjadi kesalahan saat menambahkan ke keranjang');
        }
    }

    // Show success message
    function showSuccessMessage(message) {
        // Create and show a toast notification
        const toast = document.createElement('div');
        toast.className = 'toast-notification success';
        toast.innerHTML = `
            <div class="toast-content">
                <i class="fas fa-check-circle"></i>
                <span>${message}</span>
            </div>
        `;
        
        document.body.appendChild(toast);
        
        // Show toast
        setTimeout(() => toast.classList.add('show'), 100);
        
        // Remove toast after 3 seconds
        setTimeout(() => {
            toast.classList.remove('show');
            setTimeout(() => document.body.removeChild(toast), 300);
        }, 3000);
    }

    // Show error message
    function showErrorMessage(message) {
        const toast = document.createElement('div');
        toast.className = 'toast-notification error';
        toast.innerHTML = `
            <div class="toast-content">
                <i class="fas fa-exclamation-circle"></i>
                <span>${message}</span>
            </div>
        `;
        
        document.body.appendChild(toast);
        
        // Show toast
        setTimeout(() => toast.classList.add('show'), 100);
        
        // Remove toast after 3 seconds
        setTimeout(() => {
            toast.classList.remove('show');
            setTimeout(() => document.body.removeChild(toast), 300);
        }, 3000);
    }

    // Update cart count
    function updateCartCount(count) {
        const cartCountElements = document.querySelectorAll('.cart-count');
        cartCountElements.forEach(element => {
            element.textContent = count;
            if (count > 0) {
                element.style.display = 'inline';
            }
        });
    }

    // Load cart count on page load
    document.addEventListener('DOMContentLoaded', async function() {
        try {
            const response = await fetch('/api/cart/count');
            const result = await response.json();
            updateCartCount(result.cart_count);
        } catch (error) {
            console.error('Error loading cart count:', error);
        }

        // FORCE DISABLE ALL ANIMATIONS AND TRANSITIONS
        const style = document.createElement('style');
        style.innerHTML = `
            *, *::before, *::after, *:hover, *:focus, *:active {
                animation-duration: 0s !important;
                animation-delay: 0s !important;
                transition-duration: 0s !important;
                transition-delay: 0s !important;
                transform: none !important;
                will-change: auto !important;
                backface-visibility: hidden !important;
            }
            
            .product-image img, .main-product-image, img {
                transition: none !important;
                transform: none !important;
                animation: none !important;
                opacity: 1 !important;
                display: block !important;
                will-change: auto !important;
                -webkit-transform: translateZ(0) !important;
                transform: translateZ(0) !important;
                image-rendering: -webkit-optimize-contrast !important;
                image-rendering: crisp-edges !important;
            }

            /* Disable Bootstrap animations */
            .fade, .collapse, .modal {
                transition: none !important;
                animation: none !important;
            }
        `;
        document.head.appendChild(style);

        // Ensure all images are stable
        const allImages = document.querySelectorAll('img');
        allImages.forEach(img => {
            img.style.transition = 'none';
            img.style.transform = 'none';
            img.style.animation = 'none';
            if (img.complete) {
                img.style.opacity = '1';
            }
        });

        // Setup global modal cleanup
        setupModalCleanup();
    });

    // Global modal cleanup function
    function setupModalCleanup() {
        const modal = document.getElementById('productModal');
        
        // Listen for all modal hide events
        modal.addEventListener('hide.bs.modal', function () {
            // Start cleanup process
            setTimeout(() => {
                cleanupModalBackdrop();
            }, 100);
        });
        
        modal.addEventListener('hidden.bs.modal', function () {
            // Final cleanup
            cleanupModalBackdrop();
        });
        
        // Listen for escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                const modalInstance = bootstrap.Modal.getInstance(modal);
                if (modalInstance) {
                    closeModal();
                }
            }
        });
    }

    // Cleanup modal backdrop function
    function cleanupModalBackdrop() {
        // Remove all backdrops
        const backdrops = document.querySelectorAll('.modal-backdrop');
        backdrops.forEach(backdrop => backdrop.remove());
        
        // Clean body
        document.body.classList.remove('modal-open');
        document.body.style.paddingRight = '';
        document.body.style.overflow = '';
        
        // Clear modal content
        const modalContent = document.getElementById('modal-content');
        if (modalContent) {
            modalContent.innerHTML = '';
        }
        currentProduct = null;
    }
    </script>
@endpush