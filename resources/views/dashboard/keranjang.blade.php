@extends('layouts.app')

@section('title', 'Keranjang Belanja - MyYOGYA')

@section('content')
<div class="container mt-5 pt-5">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2><i class="fas fa-shopping-cart me-2"></i>Keranjang Belanja</h2>
                <a href="{{ route('dashboard') }}" class="btn btn-outline-primary">
                    <i class="fas fa-arrow-left me-2"></i>Lanjut Belanja
                </a>
            </div>
            
            @if(isset($keranjangItems) && $keranjangItems->count() > 0)
                <div class="row">
                    <!-- Cart Items -->
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="mb-0">Item Keranjang ({{ $keranjangItems->sum('jumlah') }} produk)</h5>
                            </div>
                            <div class="card-body p-0">
                                @foreach($keranjangItems as $item)
                                    <div class="cart-item" data-item-id="{{ $item->id }}">
                                        <div class="row align-items-center p-3 border-bottom">
                                            <div class="col-md-2">
                                                <img src="{{ $item->gambar ? asset($item->gambar) : asset('images/produk/default-product.svg') }}" 
                                                     alt="{{ $item->nama_produk }}" class="img-fluid rounded">
                                            </div>
                                            <div class="col-md-4">
                                                <h6 class="mb-1">{{ $item->nama_produk }}</h6>
                                                <small class="text-muted">{{ $item->kategori ?? 'Produk' }}</small>
                                            </div>
                                            <div class="col-md-2">
                                                <strong>Rp {{ number_format($item->harga, 0, ',', '.') }}</strong>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="quantity-controls">
                                                    <button class="btn btn-sm btn-outline-secondary" onclick="updateQuantity({{ $item->id }}, {{ $item->jumlah - 1 }})">
                                                        <i class="fas fa-minus"></i>
                                                    </button>
                                                    <span class="quantity mx-2">{{ $item->jumlah }}</span>
                                                    <button class="btn btn-sm btn-outline-secondary" onclick="updateQuantity({{ $item->id }}, {{ $item->jumlah + 1 }})">
                                                        <i class="fas fa-plus"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="col-md-1">
                                                <strong class="item-subtotal">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</strong>
                                            </div>
                                            <div class="col-md-1">
                                                <button class="btn btn-sm btn-outline-danger" onclick="removeItem({{ $item->id }})">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        
                        <!-- Action Buttons -->
                        <div class="d-flex justify-content-between mt-3">
                            <button class="btn btn-outline-danger" onclick="clearCart()">
                                <i class="fas fa-trash me-2"></i>Kosongkan Keranjang
                            </button>
                            <button class="btn btn-outline-secondary" onclick="updateAllCart()">
                                <i class="fas fa-sync me-2"></i>Update Keranjang
                            </button>
                        </div>
                    </div>
                    
                    <!-- Cart Summary -->
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="mb-0">Ringkasan Pesanan</h5>
                            </div>
                            <div class="card-body">
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Subtotal ({{ $keranjangItems->sum('jumlah') }} item)</span>
                                    <strong id="cart-subtotal">Rp {{ number_format($keranjangItems->sum('subtotal'), 0, ',', '.') }}</strong>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Ongkos Kirim</span>
                                    <span class="text-success">GRATIS</span>
                                </div>
                                <hr>
                                <div class="d-flex justify-content-between mb-3">
                                    <strong>Total</strong>
                                    <strong class="text-primary" id="cart-total">Rp {{ number_format($keranjangItems->sum('subtotal'), 0, ',', '.') }}</strong>
                                </div>
                                
                                <button class="btn btn-primary w-100 btn-lg" onclick="proceedToCheckout()">
                                    <i class="fas fa-credit-card me-2"></i>Checkout
                                </button>
                                
                                <div class="mt-3 text-center">
                                    <small class="text-muted">
                                        <i class="fas fa-shield-alt me-1"></i>
                                        Transaksi aman dan terpercaya
                                    </small>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Promo Code -->
                        <div class="card mt-3">
                            <div class="card-body">
                                <h6>Kode Promo</h6>
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Masukkan kode promo">
                                    <button class="btn btn-outline-primary" type="button">Gunakan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <!-- Empty Cart -->
                <div class="text-center py-5">
                    <div class="empty-cart-illustration mb-4">
                        <i class="fas fa-shopping-cart fa-4x text-muted"></i>
                    </div>
                    <h4>Keranjang Anda Kosong</h4>
                    <p class="text-muted mb-4">Sepertinya Anda belum menambahkan produk ke keranjang.</p>
                    <a href="{{ route('dashboard') }}" class="btn btn-primary">
                        <i class="fas fa-shopping-bag me-2"></i>Mulai Belanja
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>

        <div class="row">
            <!-- Cart Items -->
            <div class="col-lg-8">
                <div class="cart-section">
                    <!-- Select All Header -->
                    <div class="cart-header-controls">
                        <div class="select-all-container">
                            <label class="custom-checkbox">
                                <input type="checkbox" id="selectAll">
                                <span class="checkmark"></span>
                                <span class="checkbox-label">Pilih Semua</span>
                            </label>
                            <button class="btn-delete-selected" id="deleteSelected" disabled>
                                <i class="fas fa-trash me-1"></i>Hapus
                            </button>
                        </div>
                        <div class="cart-count">
                            <span id="totalItems">0</span> Produk
                        </div>
                    </div>

                    <!-- Cart Items Container -->
                    <div class="cart-items" id="cartItems">
                        <!-- Items will be loaded here by JavaScript -->
                    </div>

                    <!-- Empty Cart Message -->
                    <div class="empty-cart" id="emptyCart" style="display: none;">
                        <div class="empty-cart-icon">
                            <i class="fas fa-shopping-cart"></i>
                        </div>
                        <h3>Keranjang Belanja Kosong</h3>
                        <p>Belum ada produk di keranjang belanja Anda</p>
                        <a href="{{ route('dashboard') }}" class="btn btn-primary">
                            <i class="fas fa-shopping-bag me-2"></i>Mulai Belanja
                        </a>
                    </div>
                </div>
            </div>

            <!-- Checkout Sidebar -->
            <div class="col-lg-4">
                <div class="checkout-sidebar">
                    <!-- Order Summary -->
                    <div class="order-summary">
                        <h4 class="summary-title">Ringkasan Pesanan</h4>
                        
                        <div class="summary-row">
                            <span>Subtotal Produk</span>
                            <span id="subtotal">Rp 0</span>
                        </div>
                        
                        <div class="summary-row">
                            <span>Biaya Pengiriman</span>
                            <span id="shippingCost">Rp 15.000</span>
                        </div>
                        
                        <div class="summary-divider"></div>
                        
                        <div class="summary-row total">
                            <span>Total Pembayaran</span>
                            <span id="totalPayment">Rp 0</span>
                        </div>
                    </div>

                    <!-- Shipping Address -->
                    <div class="shipping-section">
                        <h5 class="section-title">
                            <i class="fas fa-map-marker-alt me-2"></i>Alamat Pengiriman
                        </h5>
                        <div class="address-container">
                            <div class="address-item active" id="defaultAddress">
                                <div class="address-header">
                                    <strong>Alamat Utama</strong>
                                    <span class="address-badge">Utama</span>
                                </div>
                                <div class="address-details">
                                    <p class="recipient-name">John Doe</p>
                                    <p class="phone">+62 812-3456-7890</p>
                                    <p class="address-text">Jl. Malioboro No. 123, Yogyakarta, DIY 55271</p>
                                </div>
                            </div>
                            <button class="btn-change-address" data-bs-toggle="modal" data-bs-target="#addressModal">
                                <i class="fas fa-edit me-2"></i>Ubah Alamat
                            </button>
                        </div>
                    </div>

                    <!-- Payment Method -->
                    <div class="payment-section">
                        <h5 class="section-title">
                            <i class="fas fa-credit-card me-2"></i>Metode Pembayaran
                        </h5>
                        <div class="payment-methods">
                            <label class="payment-option">
                                <input type="radio" name="payment" value="cod" checked>
                                <div class="payment-content">
                                    <div class="payment-icon">
                                        <i class="fas fa-money-bill-wave"></i>
                                    </div>
                                    <div class="payment-info">
                                        <span class="payment-name">Bayar di Tempat (COD)</span>
                                        <span class="payment-desc">Bayar saat barang diterima</span>
                                    </div>
                                </div>
                            </label>

                            <label class="payment-option">
                                <input type="radio" name="payment" value="transfer">
                                <div class="payment-content">
                                    <div class="payment-icon">
                                        <i class="fas fa-university"></i>
                                    </div>
                                    <div class="payment-info">
                                        <span class="payment-name">Transfer Bank</span>
                                        <span class="payment-desc">BCA, BNI, BRI, Mandiri</span>
                                    </div>
                                </div>
                            </label>

                            <label class="payment-option">
                                <input type="radio" name="payment" value="ewallet">
                                <div class="payment-content">
                                    <div class="payment-icon">
                                        <i class="fas fa-mobile-alt"></i>
                                    </div>
                                    <div class="payment-info">
                                        <span class="payment-name">E-Wallet</span>
                                        <span class="payment-desc">GoPay, OVO, DANA, ShopeePay</span>
                                    </div>
                                </div>
                            </label>
                        </div>
                    </div>

                    <!-- Checkout Button -->
                    <div class="checkout-action">
                        <button class="btn-checkout" id="checkoutBtn" disabled>
                            <i class="fas fa-lock me-2"></i>
                            Checkout (<span id="selectedCount">0</span> item)
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Address Modal -->
<div class="modal fade" id="addressModal" tabindex="-1" aria-labelledby="addressModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addressModalLabel">
                    <i class="fas fa-map-marker-alt me-2"></i>Pilih Alamat Pengiriman
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="address-list">
                    <div class="address-option active">
                        <label class="address-radio">
                            <input type="radio" name="selectedAddress" value="1" checked>
                            <div class="address-details">
                                <div class="address-header">
                                    <strong>Alamat Utama</strong>
                                    <span class="address-badge">Utama</span>
                                </div>
                                <p class="recipient-name">John Doe</p>
                                <p class="phone">+62 812-3456-7890</p>
                                <p class="address-text">Jl. Malioboro No. 123, Yogyakarta, DIY 55271</p>
                            </div>
                        </label>
                        <div class="address-actions">
                            <button class="btn btn-outline-primary btn-sm">Edit</button>
                        </div>
                    </div>

                    <div class="address-option">
                        <label class="address-radio">
                            <input type="radio" name="selectedAddress" value="2">
                            <div class="address-details">
                                <div class="address-header">
                                    <strong>Alamat Kantor</strong>
                                </div>
                                <p class="recipient-name">John Doe</p>
                                <p class="phone">+62 812-3456-7890</p>
                                <p class="address-text">Jl. Sudirman No. 456, Jakarta Pusat, DKI Jakarta 10270</p>
                            </div>
                        </label>
                        <div class="address-actions">
                            <button class="btn btn-outline-primary btn-sm">Edit</button>
                        </div>
                    </div>
                </div>

                <button class="btn btn-outline-success w-100 mt-3">
                    <i class="fas fa-plus me-2"></i>Tambah Alamat Baru
                </button>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" onclick="updateAddress()">Pilih Alamat</button>
            </div>
        </div>
    </div>
</div>
<style>
/* Cart Page Styles */
.cart-page {
    background: #f8f9fa;
    min-height: 100vh;
    padding: 20px 0 50px;
}

.cart-header {
    background: white;
    padding: 20px;
    border-radius: 12px;
    margin-bottom: 20px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.breadcrumb-custom {
    margin-bottom: 15px;
    font-size: 14px;
}

.breadcrumb-custom a {
    color: #666;
    text-decoration: none;
}

.cart-title {
    color: #333;
    font-weight: 600;
    margin: 0;
}

/* Cart Section */
.cart-section {
    background: white;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.cart-header-controls {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 20px;
    border-bottom: 1px solid #eee;
    background: #fafafa;
}

.select-all-container {
    display: flex;
    align-items: center;
    gap: 15px;
}

.custom-checkbox {
    display: flex;
    align-items: center;
    cursor: pointer;
    font-weight: 500;
}

.custom-checkbox input {
    display: none;
}

.checkmark {
    width: 20px;
    height: 20px;
    border: 2px solid #ddd;
    border-radius: 4px;
    margin-right: 10px;
    position: relative;
    transition: all 0.3s ease;
}

.custom-checkbox input:checked + .checkmark {
    background: #f26b37;
    border-color: #f26b37;
}

.custom-checkbox input:checked + .checkmark::after {
    content: '✓';
    position: absolute;
    left: 3px;
    top: -2px;
    color: white;
    font-size: 14px;
    font-weight: bold;
}

.btn-delete-selected {
    background: none;
    border: none;
    color: #dc3545;
    font-size: 14px;
    cursor: pointer;
    opacity: 0.5;
    transition: opacity 0.3s ease;
}

.btn-delete-selected:not(:disabled) {
    opacity: 1;
}

.cart-count {
    color: #666;
    font-weight: 500;
}

/* Cart Items */
.cart-item {
    display: flex;
    align-items: center;
    padding: 20px;
    border-bottom: 1px solid #eee;
    transition: background 0.3s ease;
}

.cart-item:hover {
    background: #fafafa;
}

.cart-item-checkbox {
    margin-right: 15px;
}

.cart-item-image {
    width: 80px;
    height: 80px;
    border-radius: 8px;
    object-fit: cover;
    margin-right: 15px;
}

.cart-item-details {
    flex: 1;
    margin-right: 15px;
}

.cart-item-name {
    font-weight: 600;
    color: #333;
    margin-bottom: 5px;
    font-size: 16px;
}

.cart-item-category {
    color: #666;
    font-size: 14px;
    margin-bottom: 5px;
}

.cart-item-variant {
    font-size: 13px;
    color: #888;
}

.cart-item-price {
    font-weight: 600;
    color: #f26b37;
    font-size: 18px;
    margin-right: 20px;
    min-width: 120px;
    text-align: right;
}

.quantity-controls {
    display: flex;
    align-items: center;
    margin-right: 20px;
}

.quantity-btn {
    width: 30px;
    height: 30px;
    border: 1px solid #ddd;
    background: white;
    border-radius: 4px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.3s ease;
}

.quantity-btn:hover {
    background: #f26b37;
    color: white;
    border-color: #f26b37;
}

.quantity-input {
    width: 50px;
    height: 30px;
    border: 1px solid #ddd;
    border-left: none;
    border-right: none;
    text-align: center;
    font-weight: 600;
}

.cart-item-remove {
    background: none;
    border: none;
    color: #dc3545;
    font-size: 18px;
    cursor: pointer;
    padding: 5px;
    border-radius: 4px;
    transition: background 0.3s ease;
}

.cart-item-remove:hover {
    background: #ffe6e6;
}

/* Empty Cart */
.empty-cart {
    text-align: center;
    padding: 60px 20px;
}

.empty-cart-icon {
    font-size: 64px;
    color: #ddd;
    margin-bottom: 20px;
}

.empty-cart h3 {
    color: #666;
    margin-bottom: 10px;
}

.empty-cart p {
    color: #999;
    margin-bottom: 30px;
}

/* Checkout Sidebar */
.checkout-sidebar {
    position: sticky;
    top: 20px;
}

.order-summary {
    background: white;
    padding: 20px;
    border-radius: 12px;
    margin-bottom: 20px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.summary-title {
    font-weight: 600;
    margin-bottom: 20px;
    color: #333;
}

.summary-row {
    display: flex;
    justify-content: space-between;
    margin-bottom: 12px;
    font-size: 15px;
}

.summary-row.total {
    font-weight: 600;
    font-size: 18px;
    color: #f26b37;
    padding-top: 15px;
}

.summary-divider {
    height: 1px;
    background: #eee;
    margin: 15px 0;
}

/* Shipping Section */
.shipping-section, .payment-section {
    background: white;
    padding: 20px;
    border-radius: 12px;
    margin-bottom: 20px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.section-title {
    font-weight: 600;
    margin-bottom: 15px;
    color: #333;
    font-size: 16px;
}

.address-container {
    border: 1px solid #eee;
    border-radius: 8px;
    overflow: hidden;
}

.address-item {
    padding: 15px;
    background: #fafafa;
}

.address-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 10px;
}

.address-badge {
    background: #f26b37;
    color: white;
    padding: 2px 8px;
    border-radius: 12px;
    font-size: 12px;
}

.recipient-name {
    font-weight: 600;
    margin-bottom: 5px;
}

.phone, .address-text {
    color: #666;
    margin-bottom: 5px;
    font-size: 14px;
}

.btn-change-address {
    width: 100%;
    padding: 10px;
    background: white;
    border: 1px solid #f26b37;
    color: #f26b37;
    border-radius: 0 0 8px 8px;
    cursor: pointer;
    transition: all 0.3s ease;
}

.btn-change-address:hover {
    background: #f26b37;
    color: white;
}

/* Payment Methods */
.payment-methods {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.payment-option {
    display: block;
    cursor: pointer;
}

.payment-option input {
    display: none;
}

.payment-content {
    display: flex;
    align-items: center;
    padding: 15px;
    border: 2px solid #eee;
    border-radius: 8px;
    transition: all 0.3s ease;
}

.payment-option input:checked + .payment-content {
    border-color: #f26b37;
    background: #fff5f2;
}

.payment-icon {
    width: 40px;
    height: 40px;
    background: #f8f9fa;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 15px;
    color: #f26b37;
    font-size: 18px;
}

.payment-info {
    display: flex;
    flex-direction: column;
}

.payment-name {
    font-weight: 600;
    margin-bottom: 2px;
    color: #333;
}

.payment-desc {
    font-size: 13px;
    color: #666;
}

/* Checkout Button */
.checkout-action {
    position: sticky;
    bottom: 0;
    background: white;
    padding: 20px;
    border-radius: 12px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.btn-checkout {
    width: 100%;
    padding: 15px;
    background: #f26b37;
    color: white;
    border: none;
    border-radius: 8px;
    font-weight: 600;
    font-size: 16px;
    cursor: pointer;
    transition: all 0.3s ease;
}

.btn-checkout:not(:disabled):hover {
    background: #e55827;
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(242, 107, 55, 0.3);
}

.btn-checkout:disabled {
    background: #ccc;
    cursor: not-allowed;
}

/* Modal Styles */
.address-list {
    max-height: 400px;
    overflow-y: auto;
}

.address-option {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    padding: 15px;
    border: 1px solid #eee;
    border-radius: 8px;
    margin-bottom: 10px;
    cursor: pointer;
    transition: all 0.3s ease;
}

.address-option:hover {
    border-color: #f26b37;
}

.address-option.active {
    border-color: #f26b37;
    background: #fff5f2;
}

.address-radio {
    display: flex;
    align-items: flex-start;
    flex: 1;
    cursor: pointer;
}

.address-radio input {
    margin-right: 10px;
    margin-top: 2px;
}

.address-actions {
    margin-left: 15px;
}

/* Responsive */
@media (max-width: 768px) {
    .cart-item {
        flex-direction: column;
        align-items: flex-start;
        gap: 15px;
    }
    
    .cart-item-checkbox {
        margin-right: 0;
        align-self: flex-start;
    }
    
    .quantity-controls {
        margin-right: 0;
    }
    
    .cart-item-price {
        margin-right: 0;
        text-align: left;
        min-width: auto;
    }
    
    .checkout-sidebar {
        position: static;
        margin-top: 20px;
    }
    
    .cart-header-controls {
        flex-direction: column;
        gap: 15px;
        align-items: flex-start;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Load cart from localStorage
    loadCart();
    
    // Event listeners
    document.getElementById('selectAll').addEventListener('change', toggleSelectAll);
    document.getElementById('deleteSelected').addEventListener('click', deleteSelected);
    document.getElementById('checkoutBtn').addEventListener('click', checkout);
});

function loadCart() {
    const cart = JSON.parse(localStorage.getItem('cart') || '[]');
    const cartItems = document.getElementById('cartItems');
    const emptyCart = document.getElementById('emptyCart');
    
    if (cart.length === 0) {
        cartItems.style.display = 'none';
        emptyCart.style.display = 'block';
        document.querySelector('.cart-header-controls').style.display = 'none';
        return;
    }
    
    cartItems.style.display = 'block';
    emptyCart.style.display = 'none';
    document.querySelector('.cart-header-controls').style.display = 'flex';
    
    cartItems.innerHTML = '';
    
    cart.forEach((item, index) => {
        const cartItem = createCartItemElement(item, index);
        cartItems.appendChild(cartItem);
    });
    
    updateCartSummary();
    updateTotalItems();
}

function createCartItemElement(item, index) {
    const div = document.createElement('div');
    div.className = 'cart-item';
    div.innerHTML = `
        <label class="custom-checkbox cart-item-checkbox">
            <input type="checkbox" class="item-checkbox" data-index="${index}" onchange="updateSelection()">
            <span class="checkmark"></span>
        </label>
        
        <img src="${item.image}" alt="${item.name}" class="cart-item-image">
        
        <div class="cart-item-details">
            <div class="cart-item-name">${item.name}</div>
            <div class="cart-item-category">${item.category}</div>
            ${item.size || item.color ? `<div class="cart-item-variant">
                ${item.size ? `Ukuran: ${item.size}` : ''}
                ${item.size && item.color ? ', ' : ''}
                ${item.color ? `Warna: ${item.color}` : ''}
            </div>` : ''}
        </div>
        
        <div class="cart-item-price">${formatPrice(item.price)}</div>
        
        <div class="quantity-controls">
            <button class="quantity-btn" onclick="updateQuantity(${index}, -1)">
                <i class="fas fa-minus"></i>
            </button>
            <input type="number" class="quantity-input" value="${item.quantity}" min="1" readonly>
            <button class="quantity-btn" onclick="updateQuantity(${index}, 1)">
                <i class="fas fa-plus"></i>
            </button>
        </div>
        
        <button class="cart-item-remove" onclick="removeItem(${index})">
            <i class="fas fa-trash"></i>
        </button>
    `;
    return div;
}

function updateQuantity(index, change) {
    const cart = JSON.parse(localStorage.getItem('cart') || '[]');
    cart[index].quantity = Math.max(1, cart[index].quantity + change);
    localStorage.setItem('cart', JSON.stringify(cart));
    loadCart();
}

function removeItem(index) {
    const cart = JSON.parse(localStorage.getItem('cart') || '[]');
    cart.splice(index, 1);
    localStorage.setItem('cart', JSON.stringify(cart));
    loadCart();
    showToast('Produk berhasil dihapus dari keranjang', 'success');
}

function toggleSelectAll() {
    const selectAll = document.getElementById('selectAll');
    const itemCheckboxes = document.querySelectorAll('.item-checkbox');
    
    itemCheckboxes.forEach(checkbox => {
        checkbox.checked = selectAll.checked;
    });
    
    updateSelection();
}

function updateSelection() {
<style>
.cart-item:hover {
    background-color: #f8f9fa;
}

.quantity-controls {
    display: flex;
    align-items: center;
    justify-content: center;
}

.quantity {
    min-width: 40px;
    text-align: center;
    font-weight: bold;
}

.empty-cart-illustration {
    opacity: 0.5;
}

.card {
    box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
    border: 1px solid rgba(0, 0, 0, 0.125);
}

.btn-lg {
    font-weight: 600;
}
</style>

<script>
// Update quantity
function updateQuantity(itemId, newQuantity) {
    if (newQuantity < 1) {
        removeItem(itemId);
        return;
    }
    
    fetch('/keranjang/update', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            id: itemId,
            quantity: newQuantity
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            location.reload(); // Reload to update all totals
        } else {
            alert(data.message || 'Gagal update quantity');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Terjadi kesalahan');
    });
}

// Remove item
function removeItem(itemId) {
    if (confirm('Yakin ingin menghapus item ini?')) {
        fetch('/keranjang/remove', {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                id: itemId
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert(data.message || 'Gagal menghapus item');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan');
        });
    }
}

// Clear cart
function clearCart() {
    if (confirm('Yakin ingin mengosongkan seluruh keranjang?')) {
        fetch('/keranjang/clear', {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert(data.message || 'Gagal mengosongkan keranjang');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan');
        });
    }
}

// Proceed to checkout
function proceedToCheckout() {
    // For now, just alert. You can implement actual checkout flow
    alert('Fitur checkout akan segera tersedia!');
}

// Update all cart (refresh)
function updateAllCart() {
    location.reload();
}

function deleteSelected() {
    const checkedItems = document.querySelectorAll('.item-checkbox:checked');
    const indices = Array.from(checkedItems).map(cb => parseInt(cb.dataset.index)).sort((a, b) => b - a);
    
    const cart = JSON.parse(localStorage.getItem('cart') || '[]');
    indices.forEach(index => cart.splice(index, 1));
    localStorage.setItem('cart', JSON.stringify(cart));
    
    loadCart();
    showToast('Produk terpilih berhasil dihapus', 'success');
}

function updateCartSummary() {
    const checkedItems = document.querySelectorAll('.item-checkbox:checked');
    const cart = JSON.parse(localStorage.getItem('cart') || '[]');
    
    let subtotal = 0;
    checkedItems.forEach(checkbox => {
        const index = parseInt(checkbox.dataset.index);
        const item = cart[index];
        subtotal += item.price * item.quantity;
    });
    
    const shipping = checkedItems.length > 0 ? 15000 : 0;
    const total = subtotal + shipping;
    
    document.getElementById('subtotal').textContent = formatPrice(subtotal);
    document.getElementById('shippingCost').textContent = formatPrice(shipping);
    document.getElementById('totalPayment').textContent = formatPrice(total);
}

function updateTotalItems() {
    const cart = JSON.parse(localStorage.getItem('cart') || '[]');
    const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);
    document.getElementById('totalItems').textContent = totalItems;
}

function formatPrice(price) {
    return 'Rp ' + price.toLocaleString('id-ID');
}

function updateAddress() {
    const selectedAddress = document.querySelector('input[name="selectedAddress"]:checked');
    if (selectedAddress) {
        // Update address display in sidebar
        const addressContainer = document.getElementById('defaultAddress');
        const selectedOption = selectedAddress.closest('.address-option');
        const addressDetails = selectedOption.querySelector('.address-details').innerHTML;
        addressContainer.innerHTML = addressDetails;
        
        // Close modal
        const modal = bootstrap.Modal.getInstance(document.getElementById('addressModal'));
        modal.hide();
        
        showToast('Alamat pengiriman berhasil diubah', 'success');
    }
}

function checkout() {
    const checkedItems = document.querySelectorAll('.item-checkbox:checked');
    if (checkedItems.length === 0) {
        showToast('Pilih produk yang ingin dicheckout', 'warning');
        return;
    }
    
    const cart = JSON.parse(localStorage.getItem('cart') || '[]');
    
    // Get selected items
    const selectedItems = [];
    checkedItems.forEach(checkbox => {
        const index = parseInt(checkbox.dataset.index);
        selectedItems.push(cart[index]);
    });
    
    // Save selected items to separate storage for checkout
    localStorage.setItem('selectedCartItems', JSON.stringify(selectedItems));
    
    // Redirect to checkout page
    window.location.href = '/checkout';
}

function showToast(message, type = 'success') {
    // Create toast element
    const toast = document.createElement('div');
    toast.className = `toast align-items-center text-white bg-${type} border-0`;
    toast.style.position = 'fixed';
    toast.style.top = '20px';
    toast.style.right = '20px';
    toast.style.zIndex = '9999';
    
    toast.innerHTML = `
        <div class="d-flex">
            <div class="toast-body">
                <i class="fas fa-check-circle me-2"></i>${message}
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
        </div>
    `;
    
    document.body.appendChild(toast);
    
    const bsToast = new bootstrap.Toast(toast);
    bsToast.show();
    
    setTimeout(() => {
        toast.remove();
    }, 5000);
}
</script>
@endsection
