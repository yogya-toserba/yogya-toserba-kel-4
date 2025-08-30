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
                    <div class="col-md-3">
                        <select class="form-select">
                            <option>Semua Kategori</option>
                            <option>Pakaian Pria</option>
                            <option>Pakaian Wanita</option>
                            <option>Sepatu</option>
                            <option>Tas & Dompet</option>
                            <option>Aksesoris</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select class="form-select">
                            <option>Ukuran</option>
                            <option>XS</option>
                            <option>S</option>
                            <option>M</option>
                            <option>L</option>
                            <option>XL</option>
                            <option>XXL</option>
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
                'reviews' => 156
            ],
            [
                'name' => 'Dress Wanita Elegant Korean Style',
                'price' => 'Rp 159.000',
                'original_price' => 'Rp 219.000',
                'discount' => '27%',
                'image' => '/image/kategori/fashion/dress_wanita.png',
                'rating' => 4.8,
                'reviews' => 243
            ],
            [
                'name' => 'Sepatu Sneakers Pria Casual Sport',
                'price' => 'Rp 449.000',
                'original_price' => '',
                'discount' => '',
                'image' => '/image/kategori/fashion/sepatu_sneaker.png',
                'rating' => 4.6,
                'reviews' => 189
            ],
            [
                'name' => 'Tas Handbag Wanita Kulit Premium',
                'price' => 'Rp 689.000',
                'original_price' => 'Rp 899.000',
                'discount' => '23%',
                'image' => '/image/kategori/fashion/tas_handbag.png',
                'rating' => 4.9,
                'reviews' => 98
            ],
            [
                'name' => 'Blouse Wanita Chiffon Modern',
                'price' => 'Rp 129.000',
                'original_price' => 'Rp 179.000',
                'discount' => '28%',
                'image' => '/image/kategori/fashion/blouse_wanita.png',
                'rating' => 4.5,
                'reviews' => 167
            ],
            [
                'name' => 'Celana Jeans Pria Slim Fit',
                'price' => 'Rp 199.000',
                'original_price' => '',
                'discount' => '',
                'image' => '/image/kategori/fashion/celana_jeans.png',
                'rating' => 4.7,
                'reviews' => 134
            ],
            [
                'name' => 'High Heels Wanita Formal 7cm',
                'price' => 'Rp 349.000',
                'original_price' => 'Rp 449.000',
                'discount' => '22%',
                'image' => '/image/kategori/fashion/high_heels.png',
                'rating' => 4.4,
                'reviews' => 76
            ],
            [
                'name' => 'Jaket Bomber Pria Stylish',
                'price' => 'Rp 259.000',
                'original_price' => 'Rp 329.000',
                'discount' => '21%',
                'image' => '/image/kategori/fashion/jaket_bomber.png',
                'rating' => 4.6,
                'reviews' => 112
            ],
            [
                'name' => 'Rok Mini Wanita A-Line Casual',
                'price' => 'Rp 89.000',
                'original_price' => 'Rp 119.000',
                'discount' => '25%',
                'image' => '/image/kategori/fashion/rok_mini.png',
                'rating' => 4.3,
                'reviews' => 89
            ],
            [
                'name' => 'Dompet Pria Kulit Asli Premium',
                'price' => 'Rp 179.000',
                'original_price' => '',
                'discount' => '',
                'image' => '/image/kategori/fashion/dompet_pria.png',
                'rating' => 4.8,
                'reviews' => 203
            ],
            [
                'name' => 'Kaos Polo Pria Cotton Combed',
                'price' => 'Rp 149.000',
                'original_price' => 'Rp 199.000',
                'discount' => '25%',
                'image' => '/image/kategori/fashion/kaos_polo.png',
                'rating' => 4.5,
                'reviews' => 145
            ],
            [
                'name' => 'Sandal Wanita Casual Comfortable',
                'price' => 'Rp 99.000',
                'original_price' => 'Rp 139.000',
                'discount' => '29%',
                'image' => '/image/kategori/fashion/sandal_wanita.png',
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
                
                <div class="product-actions">
                    <button class="btn btn-outline-primary btn-detail" onclick="viewProductDetail('{{ $loop->index + 1 }}', '{{ $product['name'] }}', '{{ $product['price'] }}', '{{ $product['original_price'] ?? '' }}', '{{ $product['image'] }}', '{{ $product['rating'] }}', '{{ $product['reviews'] }}')">
                        <i class="fas fa-eye me-2"></i>Lihat Detail
                    </button>
                    <button class="btn btn-primary btn-quick-add" onclick="quickAddToCart('{{ $loop->index + 1 }}', '{{ $product['name'] }}', '{{ $product['price'] }}', '{{ $product['image'] }}')">
                        <i class="fas fa-cart-plus me-2"></i>Tambah Cepat
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
