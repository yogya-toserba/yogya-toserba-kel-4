@extends('layouts.search')

@section('title', 'Hasil Pencarian - ' . $query)

@section('content')
<div class="container-fluid py-4">
    <!-- Search Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                <div class="card-body text-white p-4">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h3 class="mb-2">
                                <i class="fas fa-search me-3"></i>
                                Hasil Pencarian
                            </h3>
                            <p class="mb-0 opacity-90">
                                {{ count($results) }} produk ditemukan untuk kata kunci: "<strong>{{ $query }}</strong>"
                            </p>
                        </div>
                        <div class="col-md-4 text-end d-none d-md-block">
                            <i class="fas fa-list-ul fa-3x opacity-75"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Search Results -->
    <div class="row">
        @if(count($results) > 0)
            <!-- Search Statistics -->
            <div class="col-12 mb-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <h5 class="mb-0">
                                    <i class="fas fa-box text-primary me-2"></i>
                                    Ditemukan {{ count($results) }} Produk
                                </h5>
                            </div>
                            <div class="col-md-6 text-end">
                                <div class="btn-group" role="group">
                                    <button type="button" class="btn btn-outline-secondary btn-sm active">
                                        <i class="fas fa-th-large me-1"></i>Grid
                                    </button>
                                    <button type="button" class="btn btn-outline-secondary btn-sm">
                                        <i class="fas fa-list me-1"></i>List
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Products Grid -->
            <div class="col-12">
                <div class="row">
                    @foreach($results as $product)
                        <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                            <div class="card border-0 shadow-sm h-100 product-card">
                                <div class="position-relative overflow-hidden">
                                    @if($product->foto)
                                        @if(str_starts_with($product->foto, 'http'))
                                            <img src="{{ $product->foto }}" 
                                                 class="card-img-top" 
                                                 alt="{{ $product->nama_barang }}" 
                                                 style="height: 200px; object-fit: cover;">
                                        @elseif(str_starts_with($product->foto, 'images/') || str_starts_with($product->foto, 'image/'))
                                            <img src="{{ asset($product->foto) }}" 
                                                 class="card-img-top" 
                                                 alt="{{ $product->nama_barang }}" 
                                                 style="height: 200px; object-fit: cover;">
                                        @else
                                            <img src="{{ asset('storage/' . $product->foto) }}" 
                                                 class="card-img-top" 
                                                 alt="{{ $product->nama_barang }}" 
                                                 style="height: 200px; object-fit: cover;"
                                                 onerror="this.src='{{ asset('images/produk/default-product.svg') }}';">
                                        @endif
                                    @else
                                        <div class="card-img-top bg-light d-flex align-items-center justify-content-center" 
                                             style="height: 200px;">
                                            <i class="fas fa-image fa-3x text-muted"></i>
                                        </div>
                                    @endif
                                    
                                    <!-- Stock Badge -->
                                    @if($product->stok > 0)
                                        <span class="badge bg-success position-absolute top-0 end-0 m-2">
                                            <i class="fas fa-check me-1"></i>Tersedia
                                        </span>
                                    @else
                                        <span class="badge bg-danger position-absolute top-0 end-0 m-2">
                                            <i class="fas fa-times me-1"></i>Habis
                                        </span>
                                    @endif
                                </div>
                                
                                <div class="card-body d-flex flex-column">
                                    <h6 class="card-title text-truncate mb-2" title="{{ $product->nama_barang }}">
                                        {{ $product->nama_barang }}
                                    </h6>
                                    
                                    <div class="mb-3">
                                        @if($product->kategori)
                                            <div class="mb-2">
                                                <span class="badge bg-light text-dark">
                                                    <i class="fas fa-tag me-1"></i>{{ $product->kategori }}
                                                </span>
                                            </div>
                                        @endif
                                        
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <span class="text-muted small">Harga</span>
                                            <span class="fw-bold text-primary fs-5">
                                                Rp {{ number_format($product->harga, 0, ',', '.') }}
                                            </span>
                                        </div>
                                        
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span class="text-muted small">Stok</span>
                                            <span class="badge {{ $product->stok > 10 ? 'bg-success' : ($product->stok > 0 ? 'bg-warning' : 'bg-danger') }}">
                                                {{ $product->stok }} unit
                                            </span>
                                        </div>
                                    </div>
                                    
                                    <div class="mt-auto">
                                        @if($product->stok > 0)
                                            <button class="btn btn-primary btn-sm w-100 mb-2" 
                                                    onclick="addToCart(event, {
                                                        id: {{ $product->id_produk }},
                                                        name: '{{ addslashes($product->nama_barang) }}',
                                                        price: {{ $product->harga }},
                                                        image: '{{ $product->foto ? (str_starts_with($product->foto, 'http') ? $product->foto : (str_starts_with($product->foto, 'images/') || str_starts_with($product->foto, 'image/') ? asset($product->foto) : asset('storage/' . $product->foto))) : asset('images/produk/default-product.svg') }}',
                                                        category: '{{ $product->kategori ?? 'Produk' }}',
                                                        stock: {{ $product->stok }},
                                                        size: null,
                                                        color: null
                                                    })">
                                                <i class="fas fa-shopping-cart me-1"></i>Tambah ke Keranjang
                                            </button>
                                        @else
                                            <button class="btn btn-secondary btn-sm w-100 mb-2" disabled>
                                                <i class="fas fa-ban me-1"></i>Stok Habis
                                            </button>
                                        @endif
                                        
                                        <div class="d-flex gap-1">
                                            <button class="btn btn-outline-danger btn-sm flex-fill">
                                                <i class="fas fa-heart"></i>
                                            </button>
                                            <button class="btn btn-outline-info btn-sm flex-fill">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button class="btn btn-outline-secondary btn-sm flex-fill">
                                                <i class="fas fa-share"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @else
            <!-- No Results Found -->
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-body text-center py-5">
                        <div class="mb-4">
                            <i class="fas fa-search fa-4x text-muted opacity-50"></i>
                        </div>
                        <h4 class="text-muted mb-3">Oops! Tidak ada hasil ditemukan</h4>
                        <p class="text-muted mb-4">
                            Produk dengan kata kunci "<strong>{{ $query }}</strong>" tidak ditemukan.<br>
                            Coba gunakan kata kunci yang berbeda atau periksa ejaan Anda.
                        </p>
                        
                        <!-- Search Suggestions -->
                        <div class="mb-4">
                            <h6 class="text-muted mb-3">Saran Pencarian:</h6>
                            <div class="d-flex flex-wrap justify-content-center gap-2">
                                <span class="badge bg-light text-dark px-3 py-2 search-suggestion" style="cursor: pointer;">
                                    <i class="fas fa-mobile-alt me-1"></i>Elektronik
                                </span>
                                <span class="badge bg-light text-dark px-3 py-2 search-suggestion" style="cursor: pointer;">
                                    <i class="fas fa-tshirt me-1"></i>Fashion
                                </span>
                                <span class="badge bg-light text-dark px-3 py-2 search-suggestion" style="cursor: pointer;">
                                    <i class="fas fa-utensils me-1"></i>Makanan
                                </span>
                                <span class="badge bg-light text-dark px-3 py-2 search-suggestion" style="cursor: pointer;">
                                    <i class="fas fa-home me-1"></i>Rumah Tangga
                                </span>
                            </div>
                        </div>
                        
                        <div class="d-flex justify-content-center gap-2">
                            <a href="{{ route('dashboard') }}" class="btn btn-primary">
                                <i class="fas fa-home me-2"></i>Kembali ke Beranda
                            </a>
                            <button class="btn btn-outline-primary" onclick="document.getElementById('searchInput').focus()">
                                <i class="fas fa-search me-2"></i>Cari Lagi
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>

@push('styles')
<style>
    .product-card {
        transition: all 0.3s ease;
        cursor: pointer;
    }
    
    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.15) !important;
    }
    
    .search-suggestion:hover {
        background-color: #667eea !important;
        color: white !important;
        transform: scale(1.05);
        transition: all 0.2s ease;
    }
    
    .card-img-top {
        transition: transform 0.3s ease;
    }
    
    .product-card:hover .card-img-top {
        transform: scale(1.05);
    }
    
    .badge {
        font-size: 0.75em;
    }
</style>
@endpush

@push('scripts')
<script>
    // Global cart array
    let cart = JSON.parse(localStorage.getItem('cart')) || [];

    // Update cart badge in navbar
    function updateCartBadge() {
        const cartBadge = document.querySelector('.cart-badge');
        if (cartBadge) {
            const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);
            cartBadge.textContent = totalItems;
            cartBadge.style.display = totalItems > 0 ? 'inline' : 'none';
        }
    }

    // Add to cart function
    function addToCart(event, product) {
        event.stopPropagation();
        event.preventDefault();
        
        // Validate stock
        if (product.stock <= 0) {
            showToast('Produk sedang habis', 'danger');
            return;
        }

        // Check if product already exists in cart
        const existingProductIndex = cart.findIndex(item => 
            item.id === product.id && item.name === product.name
        );

        if (existingProductIndex > -1) {
            // Check if adding one more would exceed stock
            if (cart[existingProductIndex].quantity >= product.stock) {
                showToast(`Stok maksimal ${product.stock} unit`, 'warning');
                return;
            }
            // If product exists, increase quantity
            cart[existingProductIndex].quantity += 1;
        } else {
            // If new product, add to cart
            product.quantity = 1;
            cart.push(product);
        }

        // Save to localStorage
        localStorage.setItem('cart', JSON.stringify(cart));

        // Update cart counter in navbar
        updateCartBadge();

        // Also save to session via AJAX
        saveCartToSession(cart);

        // Show success toast
        showToast(`${product.name} berhasil ditambahkan ke keranjang!`, 'success');
    }

    // Save cart to session
    function saveCartToSession(cartData) {
        fetch('/keranjang/sync', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ cart: cartData })
        })
        .then(response => response.json())
        .then(data => {
            console.log('Cart synced to session:', data);
        })
        .catch(error => {
            console.error('Error syncing cart:', error);
        });
    }

    // Toast notification function
    function showToast(message, type = 'success') {
        // Create toast element
        const toastHtml = `
            <div class="toast align-items-center text-white bg-${type} border-0" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                        <i class="fas fa-${type === 'success' ? 'check-circle' : type === 'danger' ? 'exclamation-triangle' : 'info-circle'} me-2"></i>${message}
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

    // Initialize cart badge on page load
    document.addEventListener('DOMContentLoaded', function() {
        updateCartBadge();
    });

    // Search suggestion click handler
    document.querySelectorAll('.search-suggestion').forEach(function(element) {
        element.addEventListener('click', function() {
            const searchText = this.textContent.trim();
            const searchInput = document.getElementById('searchInput');
            if (searchInput) {
                searchInput.value = searchText;
                searchInput.closest('form').submit();
            }
        });
    });
    
    // Product card hover effects
    document.querySelectorAll('.product-card').forEach(function(card) {
        card.addEventListener('mouseenter', function() {
            this.style.boxShadow = '0 8px 25px rgba(0,0,0,0.15)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.boxShadow = '0 2px 10px rgba(0,0,0,0.1)';
        });
    });
</script>
@endpush
@endsection
