@extends('layouts.app')

@section('title', 'Keranjang Belanja - MyYOGYA')

@section('content')
<!-- Cart Header -->
<div class="category-header">
    <div class="container">
        <nav class="breadcrumb-custom">
            <a href="{{ route('dashboard') }}">Beranda</a>
            <span class="mx-2">/</span>
            <span>Keranjang Belanja</span>
        </nav>
        
        <h1 class="display-5 fw-bold mb-3">🛒 Keranjang Belanja</h1>
        <p class="lead mb-0">Review produk pilihan Anda sebelum melakukan pembelian</p>
    </div>
</div>

<div class="container">
    <!-- Cart Content -->
    <div class="row">
        <!-- Cart Items -->
        <div class="col-lg-8">
            <div class="cart-section">
                <div class="section-header">
                    <h5 class="mb-0">Produk dalam Keranjang</h5>
                    <button class="btn btn-sm btn-outline-danger" id="clearCartBtn">
                        <i class="fas fa-trash me-1"></i>Kosongkan Keranjang
                    </button>
                </div>
                
                <!-- Cart Items Container -->
                <div id="cartItemsContainer">
                    <!-- Cart items will be populated by JavaScript -->
                </div>
                
                <!-- Empty Cart Message -->
                <div id="emptyCartMessage" class="empty-cart text-center py-5" style="display: none;">
                    <div class="empty-cart-icon mb-4">
                        <i class="fas fa-shopping-cart fa-4x text-muted"></i>
                    </div>
                    <h4 class="text-muted mb-3">Keranjang Belanja Kosong</h4>
                    <p class="text-muted mb-4">Belum ada produk di keranjang Anda. Yuk, mulai belanja sekarang!</p>
                    <a href="{{ route('dashboard') }}" class="btn btn-primary btn-lg">
                        <i class="fas fa-arrow-left me-2"></i>Mulai Belanja
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Cart Summary -->
        <div class="col-lg-4">
            <div class="cart-summary sticky-top">
                <div class="summary-header">
                    <h5 class="mb-0">Ringkasan Belanja</h5>
                </div>
                
                <div class="summary-content">
                    <div class="summary-row">
                        <span>Subtotal (<span id="totalItems">0</span> item)</span>
                        <span id="subtotalAmount">Rp 0</span>
                    </div>
                    
                    <div class="summary-row">
                        <span>Ongkos Kirim</span>
                        <span id="shippingCost">Gratis</span>
                    </div>
                    
                    <div class="summary-row">
                        <span>Pajak (11%)</span>
                        <span id="taxAmount">Rp 0</span>
                    </div>
                    
                    <hr class="summary-divider">
                    
                    <div class="summary-total">
                        <span class="total-label">Total</span>
                        <span class="total-amount" id="totalAmount">Rp 0</span>
                    </div>
                    
                    <!-- Promo Code -->
                    <div class="promo-section">
                        <div class="input-group">
                            <input type="text" class="form-control" id="promoCode" placeholder="Kode promo">
                            <button class="btn btn-outline-secondary" type="button" id="applyPromoBtn">
                                Gunakan
                            </button>
                        </div>
                        <small class="text-success mt-2" id="promoMessage" style="display: none;">
                            <i class="fas fa-check-circle me-1"></i>Kode promo berhasil diterapkan!
                        </small>
                    </div>
                    
                    <!-- Checkout Button -->
                    <button class="btn btn-checkout w-100" id="checkoutBtn" disabled>
                        <i class="fas fa-credit-card me-2"></i>Lanjut ke Pembayaran
                    </button>
                    
                    <!-- Continue Shopping -->
                    <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary w-100 mt-2">
                        <i class="fas fa-arrow-left me-2"></i>Lanjut Belanja
                    </a>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Recommended Products -->
    <div class="recommended-section mt-5">
        <h4 class="section-title mb-4">Produk Rekomendasi</h4>
        <div class="row">
            @foreach([
                [
                    'name' => 'Tas Selempang Pria Casual',
                    'price' => 'Rp 149.000',
                    'original_price' => 'Rp 199.000',
                    'discount' => '25%',
                    'image' => '/image/kategori/fashion/tas_selempang.png',
                    'rating' => 4.6
                ],
                [
                    'name' => 'Kaos Wanita Cotton Premium',
                    'price' => 'Rp 89.000',
                    'original_price' => '',
                    'discount' => '',
                    'image' => '/image/kategori/fashion/kaos_wanita.png',
                    'rating' => 4.8
                ],
                [
                    'name' => 'Celana Chino Pria Slim Fit',
                    'price' => 'Rp 179.000',
                    'original_price' => 'Rp 249.000',
                    'discount' => '28%',
                    'image' => '/image/kategori/fashion/celana_chino.png',
                    'rating' => 4.5
                ],
                [
                    'name' => 'Sandal Jepit Wanita Comfortable',
                    'price' => 'Rp 59.000',
                    'original_price' => '',
                    'discount' => '',
                    'image' => '/image/kategori/fashion/sandal_jepit.png',
                    'rating' => 4.4
                ]
            ] as $product)
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="product-card-small">
                    <div class="product-image-small">
                        <img src="{{ $product['image'] }}" alt="{{ $product['name'] }}">
                        @if($product['discount'])
                        <span class="discount-badge-small">-{{ $product['discount'] }}</span>
                        @endif
                    </div>
                    <div class="product-info-small">
                        <h6 class="product-title-small">{{ $product['name'] }}</h6>
                        <div class="product-rating-small">
                            @for($i = 1; $i <= 5; $i++)
                            <i class="fas fa-star{{ $i <= floor($product['rating']) ? '' : ' text-muted' }}"></i>
                            @endfor
                        </div>
                        <div class="product-price-small">
                            <span class="current-price-small">{{ $product['price'] }}</span>
                            @if($product['original_price'])
                            <span class="original-price-small">{{ $product['original_price'] }}</span>
                            @endif
                        </div>
                        <button class="btn btn-sm btn-outline-primary add-recommend-btn">
                            <i class="fas fa-plus me-1"></i>Tambah
                        </button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
/* Cart Styles */
.cart-section {
    background: white;
    border-radius: 15px;
    padding: 25px;
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
    margin-bottom: 30px;
}

.section-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
    padding-bottom: 15px;
    border-bottom: 2px solid #f8f9fa;
}

.cart-item {
    display: flex;
    align-items: center;
    padding: 20px 0;
    border-bottom: 1px solid #f1f3f4;
    transition: all 0.3s ease;
}

.cart-item:hover {
    background: #f8f9fa;
    margin: 0 -25px;
    padding: 20px 25px;
    border-radius: 12px;
}

.cart-item:last-child {
    border-bottom: none;
}

.item-image {
    width: 80px;
    height: 80px;
    border-radius: 10px;
    object-fit: cover;
    margin-right: 15px;
}

.item-details {
    flex: 1;
    margin-right: 15px;
}

.item-name {
    font-weight: 600;
    color: #2c3e50;
    margin-bottom: 5px;
}

.item-options {
    font-size: 0.9rem;
    color: #7f8c8d;
    margin-bottom: 5px;
}

.item-price {
    font-weight: 700;
    color: #e74c3c;
}

.quantity-controls {
    display: flex;
    align-items: center;
    margin: 0 15px;
}

.quantity-btn-cart {
    width: 32px;
    height: 32px;
    border: 1px solid #dee2e6;
    background: white;
    border-radius: 6px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.3s ease;
}

.quantity-btn-cart:hover {
    background: #f26b37;
    border-color: #f26b37;
    color: white;
}

.quantity-display {
    margin: 0 10px;
    font-weight: 600;
    min-width: 30px;
    text-align: center;
}

.remove-item {
    color: #dc3545;
    background: none;
    border: none;
    padding: 8px;
    border-radius: 6px;
    transition: all 0.3s ease;
}

.remove-item:hover {
    background: #dc3545;
    color: white;
}

/* Cart Summary */
.cart-summary {
    background: white;
    border-radius: 15px;
    padding: 25px;
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
    top: 120px;
}

.summary-header {
    margin-bottom: 20px;
    padding-bottom: 15px;
    border-bottom: 2px solid #f8f9fa;
}

.summary-row {
    display: flex;
    justify-content: space-between;
    margin-bottom: 12px;
    color: #495057;
}

.summary-divider {
    margin: 20px 0;
    border-color: #dee2e6;
}

.summary-total {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
}

.total-label {
    font-size: 1.2rem;
    font-weight: 700;
    color: #2c3e50;
}

.total-amount {
    font-size: 1.5rem;
    font-weight: 700;
    color: #e74c3c;
}

.promo-section {
    margin-bottom: 20px;
}

.btn-checkout {
    background: linear-gradient(135deg, #f26b37 0%, #e55827 100%);
    color: white;
    border: none;
    padding: 15px;
    border-radius: 10px;
    font-weight: 600;
    font-size: 1.1rem;
    transition: all 0.3s ease;
}

.btn-checkout:hover:not(:disabled) {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(242, 107, 55, 0.3);
}

.btn-checkout:disabled {
    background: #dee2e6;
    color: #6c757d;
    cursor: not-allowed;
}

/* Empty Cart */
.empty-cart-icon {
    opacity: 0.6;
}

/* Recommended Products */
.recommended-section {
    margin-top: 50px;
}

.product-card-small {
    background: white;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 3px 15px rgba(0, 0, 0, 0.06);
    transition: all 0.3s ease;
    height: 100%;
}

.product-card-small:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
}

.product-image-small {
    position: relative;
    height: 150px;
    overflow: hidden;
}

.product-image-small img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.discount-badge-small {
    position: absolute;
    top: 8px;
    left: 8px;
    background: #e74c3c;
    color: white;
    padding: 3px 8px;
    border-radius: 12px;
    font-size: 0.75rem;
    font-weight: 600;
}

.product-info-small {
    padding: 15px;
}

.product-title-small {
    font-weight: 600;
    font-size: 0.9rem;
    margin-bottom: 8px;
    color: #2c3e50;
    height: 2.4em;
    overflow: hidden;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
}

.product-rating-small {
    color: #f39c12;
    font-size: 0.8rem;
    margin-bottom: 8px;
}

.product-price-small {
    margin-bottom: 12px;
}

.current-price-small {
    font-weight: 700;
    color: #e74c3c;
    font-size: 1rem;
}

.original-price-small {
    color: #95a5a6;
    text-decoration: line-through;
    margin-left: 5px;
    font-size: 0.85rem;
}

/* Responsive */
@media (max-width: 768px) {
    .cart-item {
        flex-direction: column;
        align-items: flex-start;
        text-align: left;
    }
    
    .item-image {
        width: 60px;
        height: 60px;
        margin-bottom: 10px;
    }
    
    .quantity-controls {
        margin: 10px 0;
    }
    
    .cart-summary {
        position: static;
        margin-top: 20px;
    }
    
    .section-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 10px;
    }
}
</style>
@endpush

@push('scripts')
<script>
// Get cart from localStorage
let cart = JSON.parse(localStorage.getItem('cart')) || [];

// Format currency
function formatCurrency(amount) {
    return new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
        minimumFractionDigits: 0
    }).format(amount).replace('IDR', 'Rp');
}

// Update cart display
function updateCartDisplay() {
    const cartContainer = document.getElementById('cartItemsContainer');
    const emptyMessage = document.getElementById('emptyCartMessage');
    
    if (cart.length === 0) {
        cartContainer.style.display = 'none';
        emptyMessage.style.display = 'block';
        document.getElementById('checkoutBtn').disabled = true;
        updateCartSummary();
        return;
    }
    
    cartContainer.style.display = 'block';
    emptyMessage.style.display = 'none';
    document.getElementById('checkoutBtn').disabled = false;
    
    cartContainer.innerHTML = cart.map((item, index) => `
        <div class="cart-item" data-index="${index}">
            <img src="${item.image}" alt="${item.name}" class="item-image">
            <div class="item-details">
                <div class="item-name">${item.name}</div>
                <div class="item-options">Ukuran: ${item.size} | Warna: ${item.color}</div>
                <div class="item-price">${formatCurrency(item.price)}</div>
            </div>
            <div class="quantity-controls">
                <button class="quantity-btn-cart" onclick="updateQuantity(${index}, -1)">
                    <i class="fas fa-minus"></i>
                </button>
                <span class="quantity-display">${item.quantity}</span>
                <button class="quantity-btn-cart" onclick="updateQuantity(${index}, 1)">
                    <i class="fas fa-plus"></i>
                </button>
            </div>
            <button class="remove-item" onclick="removeItem(${index})" title="Hapus item">
                <i class="fas fa-trash"></i>
            </button>
        </div>
    `).join('');
    
    updateCartSummary();
}

// Update quantity
function updateQuantity(index, change) {
    if (cart[index]) {
        cart[index].quantity += change;
        
        if (cart[index].quantity <= 0) {
            cart.splice(index, 1);
        }
        
        localStorage.setItem('cart', JSON.stringify(cart));
        updateCartDisplay();
        updateCartBadge();
    }
}

// Remove item
function removeItem(index) {
    if (confirm('Apakah Anda yakin ingin menghapus item ini dari keranjang?')) {
        cart.splice(index, 1);
        localStorage.setItem('cart', JSON.stringify(cart));
        updateCartDisplay();
        updateCartBadge();
        showToast('Item berhasil dihapus dari keranjang', 'success');
    }
}

// Clear cart
function clearCart() {
    if (cart.length === 0) return;
    
    if (confirm('Apakah Anda yakin ingin mengosongkan keranjang?')) {
        cart = [];
        localStorage.setItem('cart', JSON.stringify(cart));
        updateCartDisplay();
        updateCartBadge();
        showToast('Keranjang berhasil dikosongkan', 'success');
    }
}

// Update cart summary
function updateCartSummary() {
    const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);
    const subtotal = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
    const tax = Math.round(subtotal * 0.11);
    const total = subtotal + tax;
    
    document.getElementById('totalItems').textContent = totalItems;
    document.getElementById('subtotalAmount').textContent = formatCurrency(subtotal);
    document.getElementById('taxAmount').textContent = formatCurrency(tax);
    document.getElementById('totalAmount').textContent = formatCurrency(total);
}

// Update cart badge
function updateCartBadge() {
    const cartBadge = document.querySelector('.cart-badge');
    if (cartBadge) {
        const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);
        cartBadge.textContent = totalItems;
    }
}

// Promo code functionality
function applyPromoCode() {
    const promoCode = document.getElementById('promoCode').value.trim().toUpperCase();
    const promoMessage = document.getElementById('promoMessage');
    
    // Sample promo codes
    const promoCodes = {
        'SAVE10': 0.1,
        'WELCOME20': 0.2,
        'FASHION15': 0.15
    };
    
    if (promoCodes[promoCode]) {
        promoMessage.style.display = 'block';
        promoMessage.innerHTML = `<i class="fas fa-check-circle me-1"></i>Kode promo ${promoCode} berhasil diterapkan! Diskon ${promoCodes[promoCode] * 100}%`;
        showToast(`Promo code ${promoCode} applied successfully!`, 'success');
    } else {
        showToast('Kode promo tidak valid', 'error');
    }
}

// Toast notification function
function showToast(message, type = 'success') {
    const bgClass = type === 'success' ? 'bg-success' : 'bg-danger';
    const toastHtml = `
        <div class="toast align-items-center text-white ${bgClass} border-0" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    <i class="fas ${type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle'} me-2"></i>${message}
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    `;
    
    let toastContainer = document.getElementById('toast-container');
    if (!toastContainer) {
        toastContainer = document.createElement('div');
        toastContainer.id = 'toast-container';
        toastContainer.className = 'toast-container position-fixed top-0 end-0 p-3';
        toastContainer.style.zIndex = '9999';
        document.body.appendChild(toastContainer);
    }
    
    toastContainer.insertAdjacentHTML('beforeend', toastHtml);
    
    const toastElement = toastContainer.lastElementChild;
    const toast = new bootstrap.Toast(toastElement, {
        autohide: true,
        delay: 3000
    });
    toast.show();
    
    toastElement.addEventListener('hidden.bs.toast', function() {
        toastElement.remove();
    });
}

// Initialize page
document.addEventListener('DOMContentLoaded', function() {
    updateCartDisplay();
    updateCartBadge();
    
    // Event listeners
    document.getElementById('clearCartBtn').addEventListener('click', clearCart);
    document.getElementById('applyPromoBtn').addEventListener('click', applyPromoCode);
    
    // Checkout button
    document.getElementById('checkoutBtn').addEventListener('click', function() {
        if (cart.length === 0) return;
        
        showToast('Fitur checkout akan segera tersedia!', 'success');
        // Here you would typically redirect to checkout page
        // window.location.href = '/checkout';
    });
    
    // Enter key for promo code
    document.getElementById('promoCode').addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            applyPromoCode();
        }
    });
});
</script>
@endpush
