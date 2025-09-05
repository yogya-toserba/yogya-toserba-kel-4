@extends('layouts.app')

@section('title', 'Checkout - MyYOGYA')

@section('content')
<div class="checkout-page">
    <div class="container">
        <!-- Header -->
        <div class="checkout-header">
            <nav class="breadcrumb-custom">
                <a href="{{ route('dashboard') }}">Beranda</a>
                <span class="mx-2">/</span>
                <a href="{{ route('keranjang') }}">Keranjang</a>
                <span class="mx-2">/</span>
                <span>Checkout</span>
            </nav>
            <h2 class="checkout-title">
                <i class="fas fa-credit-card me-2"></i>
                Checkout Pesanan
            </h2>
        </div>

        <div class="row">
            <!-- Checkout Form -->
            <div class="col-lg-8">
                <!-- Order Items -->
                <div class="checkout-section">
                    <h4 class="section-title">
                        <i class="fas fa-box me-2"></i>
                        Produk Pesanan
                    </h4>
                    <div class="order-items" id="orderItems">
                        <!-- Items will be loaded here -->
                    </div>
                </div>

                <!-- Shipping Address -->
                <div class="checkout-section">
                    <h4 class="section-title">
                        <i class="fas fa-map-marker-alt me-2"></i>
                        Alamat Pengiriman
                    </h4>
                    <form id="addressForm">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="fullName" class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control" id="fullName" value="John Doe" required>
                            </div>
                            <div class="col-md-6">
                                <label for="phone" class="form-label">Nomor Telepon</label>
                                <input type="tel" class="form-control" id="phone" value="+62 812-3456-7890" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Alamat Lengkap</label>
                            <textarea class="form-control" id="address" rows="3" required>Jl. Malioboro No. 123, Yogyakarta, DIY 55271</textarea>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="province" class="form-label">Provinsi</label>
                                <select class="form-select" id="province" required>
                                    <option value="DIY">DI Yogyakarta</option>
                                    <option value="Jakarta">DKI Jakarta</option>
                                    <option value="Jawa Barat">Jawa Barat</option>
                                    <option value="Jawa Tengah">Jawa Tengah</option>
                                    <option value="Jawa Timur">Jawa Timur</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="city" class="form-label">Kota/Kabupaten</label>
                                <select class="form-select" id="city" required>
                                    <option value="Yogyakarta">Yogyakarta</option>
                                    <option value="Sleman">Sleman</option>
                                    <option value="Bantul">Bantul</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="postalCode" class="form-label">Kode Pos</label>
                                <input type="text" class="form-control" id="postalCode" value="55271" required>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Payment Method -->
                <div class="checkout-section">
                    <h4 class="section-title">
                        <i class="fas fa-credit-card me-2"></i>
                        Metode Pembayaran
                    </h4>
                    <div class="payment-methods">
                        <div class="payment-option">
                            <input type="radio" name="payment" id="cod" value="cod" checked>
                            <label for="cod" class="payment-label">
                                <div class="payment-icon">
                                    <i class="fas fa-money-bill-wave"></i>
                                </div>
                                <div class="payment-info">
                                    <h6>Bayar di Tempat (COD)</h6>
                                    <p>Bayar saat barang diterima</p>
                                </div>
                            </label>
                        </div>

                        <div class="payment-option">
                            <input type="radio" name="payment" id="transfer" value="transfer">
                            <label for="transfer" class="payment-label">
                                <div class="payment-icon">
                                    <i class="fas fa-university"></i>
                                </div>
                                <div class="payment-info">
                                    <h6>Transfer Bank</h6>
                                    <p>BCA, BNI, BRI, Mandiri</p>
                                </div>
                            </label>
                        </div>

                        <div class="payment-option">
                            <input type="radio" name="payment" id="ewallet" value="ewallet">
                            <label for="ewallet" class="payment-label">
                                <div class="payment-icon">
                                    <i class="fas fa-mobile-alt"></i>
                                </div>
                                <div class="payment-info">
                                    <h6>E-Wallet</h6>
                                    <p>GoPay, OVO, DANA, ShopeePay</p>
                                </div>
                            </label>
                        </div>

                        <div class="payment-option">
                            <input type="radio" name="payment" id="credit" value="credit">
                            <label for="credit" class="payment-label">
                                <div class="payment-icon">
                                    <i class="fas fa-credit-card"></i>
                                </div>
                                <div class="payment-info">
                                    <h6>Kartu Kredit/Debit</h6>
                                    <p>Visa, Mastercard, JCB</p>
                                </div>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Order Notes -->
                <div class="checkout-section">
                    <h4 class="section-title">
                        <i class="fas fa-sticky-note me-2"></i>
                        Catatan Pesanan (Opsional)
                    </h4>
                    <textarea class="form-control" id="orderNotes" rows="3" placeholder="Tambahkan catatan untuk pesanan Anda..."></textarea>
                </div>
            </div>

            <!-- Order Summary -->
            <div class="col-lg-4">
                <div class="order-summary sticky-top">
                    <h4 class="summary-title">Ringkasan Pesanan</h4>
                    
                    <div class="summary-content">
                        <div class="summary-row">
                            <span>Subtotal Produk</span>
                            <span id="summarySubtotal">Rp 0</span>
                        </div>
                        
                        <div class="summary-row">
                            <span>Biaya Pengiriman</span>
                            <span id="summaryShipping">Rp 15.000</span>
                        </div>
                        
                        <div class="summary-row">
                            <span>Biaya Layanan</span>
                            <span id="summaryService">Rp 2.500</span>
                        </div>
                        
                        <div class="summary-row discount">
                            <span>Diskon</span>
                            <span id="summaryDiscount">- Rp 0</span>
                        </div>
                        
                        <div class="summary-divider"></div>
                        
                        <div class="summary-row total">
                            <span>Total Pembayaran</span>
                            <span id="summaryTotal">Rp 0</span>
                        </div>
                    </div>

                    <!-- Promo Code -->
                    <div class="promo-section">
                        <div class="input-group">
                            <input type="text" class="form-control" id="promoCode" placeholder="Kode Promo">
                            <button class="btn btn-outline-primary" type="button" onclick="applyPromo()">
                                Gunakan
                            </button>
                        </div>
                    </div>

                    <!-- Place Order Button -->
                    <button class="btn-place-order" onclick="placeOrder()">
                        <i class="fas fa-lock me-2"></i>
                        Buat Pesanan
                    </button>

                    <!-- Security Badge -->
                    <div class="security-badge">
                        <i class="fas fa-shield-alt me-2"></i>
                        <span>Transaksi Aman & Terjamin</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Order Success Modal -->
<div class="modal fade" id="orderSuccessModal" tabindex="-1" aria-labelledby="orderSuccessModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center p-5">
                <div class="success-icon mb-4">
                    <i class="fas fa-check-circle"></i>
                </div>
                <h3 class="mb-3">Pesanan Berhasil Dibuat!</h3>
                <p class="text-muted mb-4">Terima kasih atas pesanan Anda. Kami akan segera memproses pesanan ini.</p>
                <div class="order-info mb-4">
                    <strong>Nomor Pesanan: <span id="orderNumber">#ORD-2024-001</span></strong>
                </div>
                <div class="d-grid gap-2">
                    <button type="button" class="btn btn-primary" onclick="redirectToDashboard()">
                        <i class="fas fa-home me-2"></i>Kembali ke Beranda
                    </button>
                    <button type="button" class="btn btn-outline-primary" onclick="trackOrder()">
                        <i class="fas fa-search me-2"></i>Lacak Pesanan
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Checkout Page Styles */
.checkout-page {
    background: #f8f9fa;
    min-height: 100vh;
    padding: 20px 0 50px;
}

.checkout-header {
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

.checkout-title {
    color: #333;
    font-weight: 600;
    margin: 0;
}

/* Checkout Sections */
.checkout-section {
    background: white;
    padding: 25px;
    border-radius: 12px;
    margin-bottom: 20px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.section-title {
    color: #333;
    font-weight: 600;
    margin-bottom: 20px;
    font-size: 18px;
}

/* Order Items */
.order-item {
    display: flex;
    align-items: center;
    padding: 15px 0;
    border-bottom: 1px solid #eee;
}

.order-item:last-child {
    border-bottom: none;
}

.order-item-image {
    width: 60px;
    height: 60px;
    border-radius: 8px;
    object-fit: cover;
    margin-right: 15px;
}

.order-item-details {
    flex: 1;
}

.order-item-name {
    font-weight: 600;
    margin-bottom: 5px;
    color: #333;
}

.order-item-category {
    color: #666;
    font-size: 14px;
    margin-bottom: 5px;
}

.order-item-quantity {
    color: #888;
    font-size: 14px;
}

.order-item-price {
    font-weight: 600;
    color: #f26b37;
    font-size: 16px;
}

/* Form Styles */
.form-label {
    font-weight: 600;
    color: #333;
    margin-bottom: 8px;
}

.form-control, .form-select {
    border: 1px solid #ddd;
    border-radius: 8px;
    padding: 12px 15px;
    font-size: 14px;
    transition: border-color 0.3s ease;
}

.form-control:focus, .form-select:focus {
    border-color: #f26b37;
    box-shadow: 0 0 0 0.2rem rgba(242, 107, 55, 0.15);
}

/* Payment Methods */
.payment-methods {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.payment-option {
    position: relative;
}

.payment-option input[type="radio"] {
    display: none;
}

.payment-label {
    display: flex;
    align-items: center;
    padding: 20px;
    border: 2px solid #eee;
    border-radius: 12px;
    cursor: pointer;
    transition: all 0.3s ease;
    margin: 0;
}

.payment-option input[type="radio"]:checked + .payment-label {
    border-color: #f26b37;
    background: #fff5f2;
}

.payment-icon {
    width: 50px;
    height: 50px;
    background: #f8f9fa;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 15px;
    color: #f26b37;
    font-size: 20px;
}

.payment-info h6 {
    margin: 0 0 5px 0;
    font-weight: 600;
    color: #333;
}

.payment-info p {
    margin: 0;
    color: #666;
    font-size: 14px;
}

/* Order Summary */
.order-summary {
    background: white;
    padding: 25px;
    border-radius: 12px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    top: 20px;
}

.summary-title {
    font-weight: 600;
    margin-bottom: 20px;
    color: #333;
}

.summary-content {
    margin-bottom: 20px;
}

.summary-row {
    display: flex;
    justify-content: space-between;
    margin-bottom: 12px;
    font-size: 15px;
}

.summary-row.discount {
    color: #28a745;
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

/* Promo Section */
.promo-section {
    margin-bottom: 25px;
}

.promo-section .input-group {
    border-radius: 8px;
    overflow: hidden;
}

.promo-section .form-control {
    border-radius: 0;
    border-right: none;
}

.promo-section .btn {
    border-radius: 0;
    border-left: none;
}

/* Place Order Button */
.btn-place-order {
    width: 100%;
    padding: 15px;
    background: #f26b37;
    color: white;
    border: none;
    border-radius: 12px;
    font-weight: 600;
    font-size: 16px;
    cursor: pointer;
    transition: all 0.3s ease;
    margin-bottom: 15px;
}

.btn-place-order:hover {
    background: #e55827;
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(242, 107, 55, 0.3);
}

/* Security Badge */
.security-badge {
    text-align: center;
    color: #666;
    font-size: 14px;
    padding: 10px;
    background: #f8f9fa;
    border-radius: 8px;
}

/* Order Success Modal */
.success-icon {
    font-size: 64px;
    color: #28a745;
}

.order-info {
    background: #f8f9fa;
    padding: 15px;
    border-radius: 8px;
}

/* Responsive */
@media (max-width: 768px) {
    .checkout-section {
        padding: 20px 15px;
    }
    
    .order-summary {
        position: static !important;
        margin-top: 20px;
    }
    
    .payment-label {
        flex-direction: column;
        text-align: center;
        padding: 15px;
    }
    
    .payment-icon {
        margin-right: 0;
        margin-bottom: 10px;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    loadOrderItems();
    calculateSummary();
});

function loadOrderItems() {
    const cart = JSON.parse(localStorage.getItem('selectedCartItems') || '[]');
    const orderItems = document.getElementById('orderItems');
    
    if (cart.length === 0) {
        // If no selected items, redirect to cart
        window.location.href = '/keranjang';
        return;
    }
    
    orderItems.innerHTML = '';
    
    cart.forEach(item => {
        const orderItem = document.createElement('div');
        orderItem.className = 'order-item';
        orderItem.innerHTML = `
            <img src="${item.image}" alt="${item.name}" class="order-item-image">
            <div class="order-item-details">
                <div class="order-item-name">${item.name}</div>
                <div class="order-item-category">${item.category}</div>
                <div class="order-item-quantity">Qty: ${item.quantity}</div>
            </div>
            <div class="order-item-price">${formatPrice(item.price * item.quantity)}</div>
        `;
        orderItems.appendChild(orderItem);
    });
}

function calculateSummary() {
    const cart = JSON.parse(localStorage.getItem('selectedCartItems') || '[]');
    
    const subtotal = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
    const shipping = 15000;
    const service = 2500;
    const discount = 0;
    const total = subtotal + shipping + service - discount;
    
    document.getElementById('summarySubtotal').textContent = formatPrice(subtotal);
    document.getElementById('summaryShipping').textContent = formatPrice(shipping);
    document.getElementById('summaryService').textContent = formatPrice(service);
    document.getElementById('summaryDiscount').textContent = '- ' + formatPrice(discount);
    document.getElementById('summaryTotal').textContent = formatPrice(total);
}

function applyPromo() {
    const promoCode = document.getElementById('promoCode').value.trim();
    
    if (!promoCode) {
        showToast('Masukkan kode promo terlebih dahulu', 'warning');
        return;
    }
    
    // Simulate promo validation
    const validPromos = {
        'WELCOME10': 10,
        'SAVE20': 20,
        'NEWUSER': 15
    };
    
    if (validPromos[promoCode.toUpperCase()]) {
        const discountPercent = validPromos[promoCode.toUpperCase()];
        const cart = JSON.parse(localStorage.getItem('selectedCartItems') || '[]');
        const subtotal = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
        const discount = Math.floor(subtotal * discountPercent / 100);
        
        document.getElementById('summaryDiscount').textContent = '- ' + formatPrice(discount);
        
        // Recalculate total
        const shipping = 15000;
        const service = 2500;
        const total = subtotal + shipping + service - discount;
        document.getElementById('summaryTotal').textContent = formatPrice(total);
        
        showToast(`Kode promo berhasil diterapkan! Diskon ${discountPercent}%`, 'success');
    } else {
        showToast('Kode promo tidak valid', 'error');
    }
}

function placeOrder() {
    // Validate form
    const fullName = document.getElementById('fullName').value.trim();
    const phone = document.getElementById('phone').value.trim();
    const address = document.getElementById('address').value.trim();
    const selectedPayment = document.querySelector('input[name="payment"]:checked');
    
    if (!fullName || !phone || !address || !selectedPayment) {
        showToast('Mohon lengkapi semua data yang diperlukan', 'warning');
        return;
    }
    
    // Show loading
    const btn = document.querySelector('.btn-place-order');
    const originalText = btn.innerHTML;
    btn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Memproses Pesanan...';
    btn.disabled = true;
    
    // Simulate order processing
    setTimeout(() => {
        // Generate order number
        const orderNumber = '#ORD-' + new Date().getFullYear() + '-' + String(Math.floor(Math.random() * 10000)).padStart(3, '0');
        document.getElementById('orderNumber').textContent = orderNumber;
        
        // Clear selected cart items
        localStorage.removeItem('selectedCartItems');
        
        // Show success modal
        const modal = new bootstrap.Modal(document.getElementById('orderSuccessModal'));
        modal.show();
        
        // Reset button
        btn.innerHTML = originalText;
        btn.disabled = false;
        
    }, 3000);
}

function redirectToDashboard() {
    window.location.href = '/';
}

function trackOrder() {
    showToast('Fitur pelacakan pesanan akan segera tersedia', 'info');
}

function formatPrice(price) {
    return 'Rp ' + price.toLocaleString('id-ID');
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
