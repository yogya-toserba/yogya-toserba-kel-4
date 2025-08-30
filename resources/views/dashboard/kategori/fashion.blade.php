@extends('layouts.app')

@section('title', 'Fashion - MyYOGYA')

@section('content')
<!-- Category Header -->
<div class="category-header">
    <div class="container">
        <nav class="breadcrumb-custom">
            <a href="{{ route('dashboard') }}">Beranda</a>
            <span class="mx-2">/</span>
            <span>Fashion</span>
        </nav>
        
        <h1 class="display-5 fw-bold mb-3">👗 Fashion</h1>
        <p class="lead mb-0">Koleksi fashion terdepan untuk gaya hidup modern Anda</p>
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
                                <li><a class="dropdown-item" href="#"><i class="fas fa-dollar-sign me-2 text-info"></i>Rp 100rb-500rb</a></li>
                                <li><a class="dropdown-item" href="#"><i class="fas fa-dollar-sign me-2 text-warning"></i>Rp 500rb-1jt</a></li>
                                <li><a class="dropdown-item" href="#"><i class="fas fa-dollar-sign me-2 text-danger"></i>> Rp 1 Juta</a></li>
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
                'image' => 'https://via.placeholder.com/300x300/f0f0f0/888?text=Kemeja+Formal',
                'rating' => 4.7,
                'reviews' => 156
            ],
            [
                'name' => 'Dress Wanita Elegant Korean Style',
                'price' => 'Rp 159.000',
                'original_price' => 'Rp 219.000',
                'discount' => '27%',
                'image' => 'https://via.placeholder.com/300x300/f0f0f0/888?text=Dress+Wanita',
                'rating' => 4.8,
                'reviews' => 243
            ],
            [
                'name' => 'Sepatu Sneakers Pria Casual Sport',
                'price' => 'Rp 449.000',
                'original_price' => '',
                'discount' => '',
                'image' => 'https://via.placeholder.com/300x300/f0f0f0/888?text=Sneakers+Pria',
                'rating' => 4.6,
                'reviews' => 189
            ],
            [
                'name' => 'Tas Handbag Wanita Kulit Premium',
                'price' => 'Rp 689.000',
                'original_price' => 'Rp 899.000',
                'discount' => '23%',
                'image' => 'https://via.placeholder.com/300x300/f0f0f0/888?text=Tas+Handbag',
                'rating' => 4.9,
                'reviews' => 98
            ],
            [
                'name' => 'Blouse Wanita Chiffon Modern',
                'price' => 'Rp 129.000',
                'original_price' => 'Rp 179.000',
                'discount' => '28%',
                'image' => 'https://via.placeholder.com/300x300/f0f0f0/888?text=Blouse+Wanita',
                'rating' => 4.5,
                'reviews' => 167
            ],
            [
                'name' => 'Celana Jeans Pria Slim Fit',
                'price' => 'Rp 199.000',
                'original_price' => '',
                'discount' => '',
                'image' => 'https://via.placeholder.com/300x300/f0f0f0/888?text=Celana+Jeans',
                'rating' => 4.7,
                'reviews' => 134
            ],
            [
                'name' => 'High Heels Wanita Formal 7cm',
                'price' => 'Rp 349.000',
                'original_price' => 'Rp 449.000',
                'discount' => '22%',
                'image' => 'https://via.placeholder.com/300x300/f0f0f0/888?text=High+Heels',
                'rating' => 4.4,
                'reviews' => 76
            ],
            [
                'name' => 'Jaket Bomber Pria Stylish',
                'price' => 'Rp 259.000',
                'original_price' => 'Rp 329.000',
                'discount' => '21%',
                'image' => 'https://via.placeholder.com/300x300/f0f0f0/888?text=Jaket+Bomber',
                'rating' => 4.6,
                'reviews' => 112
            ],
            [
                'name' => 'Rok Mini Wanita A-Line Casual',
                'price' => 'Rp 89.000',
                'original_price' => 'Rp 119.000',
                'discount' => '25%',
                'image' => 'https://via.placeholder.com/300x300/f0f0f0/888?text=Rok+Mini',
                'rating' => 4.3,
                'reviews' => 89
            ],
            [
                'name' => 'Dompet Pria Kulit Asli Premium',
                'price' => 'Rp 179.000',
                'original_price' => '',
                'discount' => '',
                'image' => 'https://via.placeholder.com/300x300/f0f0f0/888?text=Dompet+Pria',
                'rating' => 4.8,
                'reviews' => 203
            ],
            [
                'name' => 'Kaos Polo Pria Cotton Combed',
                'price' => 'Rp 149.000',
                'original_price' => 'Rp 199.000',
                'discount' => '25%',
                'image' => 'https://via.placeholder.com/300x300/f0f0f0/888?text=Kaos+Polo',
                'rating' => 4.5,
                'reviews' => 145
            ],
            [
                'name' => 'Sandal Wanita Casual Comfortable',
                'price' => 'Rp 99.000',
                'original_price' => 'Rp 139.000',
                'discount' => '29%',
                'image' => 'https://via.placeholder.com/300x300/f0f0f0/888?text=Sandal+Wanita',
                'rating' => 4.4,
                'reviews' => 67
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
<<<<<<< HEAD
                
                <div class="product-actions">
                    <button class="btn btn-outline-primary btn-detail" onclick="viewProductDetail('{{ $loop->index + 1 }}', '{{ $product['name'] }}', '{{ $product['price'] }}', '{{ $product['original_price'] ?? '' }}', '{{ $product['image'] }}', '{{ $product['rating'] }}', '{{ $product['reviews'] }}')">
                        <i class="fas fa-eye me-2"></i>Lihat Detail
                    </button>
                    <button class="btn btn-primary btn-quick-add" onclick="quickAddToCart('{{ $loop->index + 1 }}', '{{ $product['name'] }}', '{{ $product['price'] }}', '{{ $product['image'] }}')">
                        <i class="fas fa-cart-plus me-2"></i>Tambah Cepat
                    </button>
                </div>
=======
>>>>>>> origin/main
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

<<<<<<< HEAD
=======
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

>>>>>>> origin/main
@endsection

@push('styles')
<style>
/* Updated Product Actions */
.product-actions {
    display: flex;
    gap: 8px;
    flex-direction: column;
}

.btn-detail,
.btn-quick-add {
    flex: 1;
    padding: 10px 16px;
    border-radius: 8px;
    font-weight: 600;
    font-size: 0.9rem;
    transition: all 0.3s ease;
    text-align: center;
}

.btn-detail {
    background: transparent;
    color: #f26b37;
    border: 2px solid #f26b37;
}

.btn-detail:hover {
    background: #f26b37;
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(242, 107, 55, 0.3);
}

.btn-quick-add {
    background: linear-gradient(135deg, #f26b37 0%, #e55827 100%);
    border: none;
    color: white;
}

.btn-quick-add:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(242, 107, 55, 0.3);
}

/* Product card adjustments */
.product-card {
    height: auto;
    min-height: 420px;
}

/* Responsive adjustments */
@media (max-width: 576px) {
    .product-actions {
        flex-direction: column;
        gap: 6px;
    }
    
    .btn-detail,
    .btn-quick-add {
        font-size: 0.85rem;
        padding: 8px 12px;
    }
}
</style>
@endpush

@push('scripts')
<script>
// Global cart array
let cart = JSON.parse(localStorage.getItem('cart')) || [];

// Update cart badge
function updateCartBadge() {
    const cartBadge = document.querySelector('.cart-badge');
    if (cartBadge) {
        const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);
        cartBadge.textContent = totalItems;
    }
}

// View product detail
function viewProductDetail(id, name, price, originalPrice, image, rating, reviews) {
    const detailUrl = new URL('/produk/detail', window.location.origin);
    detailUrl.searchParams.set('id', id);
    detailUrl.searchParams.set('name', name);
    detailUrl.searchParams.set('price', price);
    if (originalPrice) {
        detailUrl.searchParams.set('originalPrice', originalPrice);
    }
    detailUrl.searchParams.set('image', image);
    detailUrl.searchParams.set('rating', rating);
    detailUrl.searchParams.set('reviews', reviews);
    
    window.location.href = detailUrl.toString();
}

// Quick add to cart with default options
function quickAddToCart(id, name, price, image) {
    const cartItem = {
        id: id,
        name: name,
        price: parseInt(price.replace(/[^\d]/g, '')),
        image: image,
        size: 'M', // Default size
        color: 'Putih', // Default color
        quantity: 1,
        addedAt: new Date().toISOString()
    };
    
    // Check if item already exists with same default options
    const existingItemIndex = cart.findIndex(item => 
        item.id === id && 
        item.size === 'M' && 
        item.color === 'Putih'
    );
    
    if (existingItemIndex > -1) {
        cart[existingItemIndex].quantity += 1;
    } else {
        cart.push(cartItem);
    }
    
    // Save to localStorage
    localStorage.setItem('cart', JSON.stringify(cart));
    
    // Update cart badge
    updateCartBadge();
    
    // Show success message
    showToast(`${name} berhasil ditambahkan ke keranjang!`, 'success');
}

// Toast notification function
function showToast(message, type = 'success') {
    const bgClass = type === 'success' ? 'bg-success' : 'bg-danger';
    const icon = type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle';
    
    const toastHtml = `
        <div class="toast align-items-center text-white ${bgClass} border-0" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    <i class="fas ${icon} me-2"></i>${message}
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

// Initialize page
document.addEventListener('DOMContentLoaded', function() {
    updateCartBadge();
});
</script>
@endpush
