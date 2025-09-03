@extends('layouts.app')

@section('title', 'Keranjang Belanja - Yogya Toserba')

@section('content')
<div class="container-fluid py-4">
    <!-- Header Keranjang -->
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="fw-bold text-dark">
                <i class="fas fa-shopping-cart me-2 text-primary"></i>
                Keranjang Belanja
            </h2>
            <p class="text-muted">Kelola produk yang akan Anda beli</p>
        </div>
    </div>

    <!-- Keranjang Kosong -->
    <div id="empty-cart" class="text-center py-5" style="display: none;">
        <div class="empty-cart-icon mb-4">
            <i class="fas fa-shopping-cart fa-5x text-muted"></i>
        </div>
        <h4 class="text-muted mb-3">Keranjang Belanja Kosong</h4>
        <p class="text-muted mb-4">Yuk, isi keranjangmu dengan produk-produk menarik dari Yogya Toserba!</p>
        <a href="{{ route('dashboard.kategori.fashion') }}" class="btn btn-primary">
            <i class="fas fa-shopping-bag me-2"></i>
            Mulai Belanja
        </a>
    </div>

    <!-- Daftar Produk di Keranjang -->
    <div id="cart-items" class="row">
        <div class="col-lg-8">
            <div class="card shadow-sm">
                <div class="card-header bg-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">
                            <i class="fas fa-list me-2"></i>
                            Produk di Keranjang (<span id="cart-count">0</span>)
                        </h5>
                        <button class="btn btn-outline-danger btn-sm" onclick="clearCart()">
                            <i class="fas fa-trash me-2"></i>
                            Kosongkan Keranjang
                        </button>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div id="cart-list">
                        <!-- Cart items akan ditampilkan di sini -->
                    </div>
                </div>
            </div>
        </div>

        <!-- Ringkasan Belanja -->
        <div class="col-lg-4">
            <div class="card shadow-sm sticky-top" style="top: 20px;">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-receipt me-2"></i>
                        Ringkasan Belanja
                    </h5>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-3">
                        <span>Total Produk:</span>
                        <span id="total-items">0 item</span>
                    </div>
                    <div class="d-flex justify-content-between mb-3">
                        <span>Subtotal:</span>
                        <span id="subtotal">Rp 0</span>
                    </div>
                    <div class="d-flex justify-content-between mb-3">
                        <span>Biaya Pengiriman:</span>
                        <span class="text-success">GRATIS</span>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between mb-4">
                        <strong>Total Pembayaran:</strong>
                        <strong class="text-primary" id="total-payment">Rp 0</strong>
                    </div>
                    
                    <button class="btn btn-primary w-100 mb-3" onclick="checkout()" id="checkout-btn">
                        <i class="fas fa-credit-card me-2"></i>
                        Checkout
                    </button>
                    
                    <a href="{{ route('dashboard.kategori.fashion') }}" class="btn btn-outline-primary w-100">
                        <i class="fas fa-arrow-left me-2"></i>
                        Lanjut Belanja
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Konfirmasi Hapus -->
<div class="modal fade" id="deleteItemModal" tabindex="-1" aria-labelledby="deleteItemModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteItemModalLabel">Hapus Produk</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menghapus produk ini dari keranjang?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-danger" id="confirm-delete">Hapus</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.cart-item {
    border-bottom: 1px solid #eee;
    padding: 20px;
    transition: background-color 0.3s ease;
}

.cart-item:hover {
    background-color: #f8f9fa;
}

.cart-item:last-child {
    border-bottom: none;
}

.product-image-cart {
    width: 100px;
    height: 100px;
    object-fit: cover;
    border-radius: 8px;
}

.quantity-controls {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
}

.quantity-btn {
    width: 35px;
    height: 35px;
    border: 1px solid #ddd;
    background: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.3s ease;
}

.quantity-btn:hover {
    background-color: #007bff;
    color: white;
    border-color: #007bff;
}

.quantity-input {
    width: 60px;
    text-align: center;
    border: 1px solid #ddd;
    border-radius: 5px;
    padding: 5px;
}

.empty-cart-icon {
    opacity: 0.3;
}

@media (max-width: 768px) {
    .product-info {
        text-align: center;
        margin-top: 15px;
    }
    
    .quantity-controls {
        justify-content: center;
        margin-top: 15px;
    }
}
</style>
@endpush

@push('scripts')
<script>
// Fungsi untuk memuat keranjang dari localStorage
function loadCart() {
    const cart = JSON.parse(localStorage.getItem('cart')) || [];
    displayCart(cart);
}

// Fungsi untuk menampilkan isi keranjang
function displayCart(cart) {
    const cartList = document.getElementById('cart-list');
    const emptyCart = document.getElementById('empty-cart');
    const cartItems = document.getElementById('cart-items');
    
    if (cart.length === 0) {
        emptyCart.style.display = 'block';
        cartItems.style.display = 'none';
        return;
    }
    
    emptyCart.style.display = 'none';
    cartItems.style.display = 'block';
    
    let cartHTML = '';
    cart.forEach((item, index) => {
        cartHTML += `
            <div class="cart-item" data-index="${index}">
                <div class="row align-items-center">
                    <div class="col-md-2">
                        <img src="${item.image}" alt="${item.name}" class="product-image-cart">
                    </div>
                    <div class="col-md-4">
                        <h6 class="mb-1">${item.name}</h6>
                        <p class="text-muted mb-0">${item.category}</p>
                        <p class="text-primary fw-bold mb-0">${formatCurrency(item.price)}</p>
                    </div>
                    <div class="col-md-3">
                        <div class="quantity-controls">
                            <button class="quantity-btn" onclick="updateQuantity(${index}, -1)">
                                <i class="fas fa-minus"></i>
                            </button>
                            <input type="number" class="quantity-input" value="${item.quantity}" min="1" 
                                   onchange="setQuantity(${index}, this.value)">
                            <button class="quantity-btn" onclick="updateQuantity(${index}, 1)">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="col-md-2 text-center">
                        <p class="fw-bold mb-0">${formatCurrency(item.price * item.quantity)}</p>
                    </div>
                    <div class="col-md-1 text-center">
                        <button class="btn btn-outline-danger btn-sm" onclick="confirmDeleteItem(${index})">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
            </div>
        `;
    });
    
    cartList.innerHTML = cartHTML;
    updateCartSummary(cart);
}

// Fungsi untuk memperbarui ringkasan keranjang
function updateCartSummary(cart) {
    const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);
    const subtotal = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
    
    document.getElementById('cart-count').textContent = cart.length;
    document.getElementById('total-items').textContent = `${totalItems} item`;
    document.getElementById('subtotal').textContent = formatCurrency(subtotal);
    document.getElementById('total-payment').textContent = formatCurrency(subtotal);
    
    // Disable checkout button jika keranjang kosong
    const checkoutBtn = document.getElementById('checkout-btn');
    checkoutBtn.disabled = cart.length === 0;
}

// Fungsi untuk memperbarui quantity
function updateQuantity(index, change) {
    let cart = JSON.parse(localStorage.getItem('cart')) || [];
    
    if (cart[index]) {
        cart[index].quantity += change;
        
        if (cart[index].quantity <= 0) {
            cart.splice(index, 1);
        }
        
        localStorage.setItem('cart', JSON.stringify(cart));
        displayCart(cart);
    }
}

// Fungsi untuk set quantity langsung
function setQuantity(index, newQuantity) {
    let cart = JSON.parse(localStorage.getItem('cart')) || [];
    const quantity = parseInt(newQuantity);
    
    if (cart[index] && quantity > 0) {
        cart[index].quantity = quantity;
        localStorage.setItem('cart', JSON.stringify(cart));
        displayCart(cart);
    }
}

// Fungsi konfirmasi hapus item
let itemToDelete = null;
function confirmDeleteItem(index) {
    itemToDelete = index;
    const modal = new bootstrap.Modal(document.getElementById('deleteItemModal'));
    modal.show();
}

// Handler konfirmasi hapus
document.getElementById('confirm-delete').addEventListener('click', function() {
    if (itemToDelete !== null) {
        let cart = JSON.parse(localStorage.getItem('cart')) || [];
        cart.splice(itemToDelete, 1);
        localStorage.setItem('cart', JSON.stringify(cart));
        displayCart(cart);
        
        const modal = bootstrap.Modal.getInstance(document.getElementById('deleteItemModal'));
        modal.hide();
        itemToDelete = null;
    }
});

// Fungsi untuk mengosongkan keranjang
function clearCart() {
    if (confirm('Apakah Anda yakin ingin mengosongkan keranjang?')) {
        localStorage.removeItem('cart');
        displayCart([]);
    }
}

// Fungsi checkout
function checkout() {
    const cart = JSON.parse(localStorage.getItem('cart')) || [];
    
    if (cart.length === 0) {
        alert('Keranjang masih kosong!');
        return;
    }
    
    // Simulasi proses checkout
    alert('Fitur checkout akan segera tersedia!\n\nTotal item: ' + cart.reduce((sum, item) => sum + item.quantity, 0) + '\nTotal pembayaran: ' + formatCurrency(cart.reduce((sum, item) => sum + (item.price * item.quantity), 0)));
}

// Fungsi format currency
function formatCurrency(amount) {
    return new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
        minimumFractionDigits: 0,
        maximumFractionDigits: 0
    }).format(amount);
}

// Load keranjang saat halaman dimuat
document.addEventListener('DOMContentLoaded', function() {
    loadCart();
});
</script>
@endpush
