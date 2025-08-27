<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Metode Pembayaran - MyYOGYA</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Custom CSS -->
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
    
    <style>
        /* Payment Page Styles */
        .payment-hero {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            padding: 100px 0;
            position: relative;
            overflow: hidden;
        }

        .payment-hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Ccircle cx='30' cy='30' r='2'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E") repeat;
        }

        .payment-hero .container {
            position: relative;
            z-index: 1;
        }

        .breadcrumb-custom {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 50px;
            padding: 0.75rem 1.5rem;
            margin-bottom: 2rem;
            display: inline-flex;
            align-items: center;
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        .breadcrumb-custom a {
            color: white;
            text-decoration: none;
            font-weight: 500;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            padding: 0.25rem 0.5rem;
            border-radius: 25px;
        }

        .breadcrumb-custom a:hover {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            transform: translateY(-1px);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .breadcrumb-custom span {
            color: rgba(255, 255, 255, 0.8);
            font-size: 0.9rem;
        }

        .breadcrumb-custom .current {
            color: rgba(255, 255, 255, 0.9);
            font-weight: 600;
            background: rgba(255, 255, 255, 0.1);
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
        }

        .payment-method-card {
            background: white;
            border-radius: 20px;
            padding: 2.5rem;
            box-shadow: 0 10px 40px rgba(0,0,0,0.1);
            text-align: center;
            height: 100%;
            transition: all 0.3s ease;
            border: 2px solid transparent;
            position: relative;
            overflow: hidden;
        }

        .payment-method-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        }

        .payment-method-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 60px rgba(0,0,0,0.15);
            border-color: var(--primary-color);
        }

        .payment-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            font-size: 2rem;
            color: white;
            position: relative;
        }

        .payment-icon.bank {
            background: linear-gradient(135deg, #1e88e5, #1565c0);
        }

        .payment-icon.ewallet {
            background: linear-gradient(135deg, #43a047, #2e7d32);
        }

        .payment-icon.qris {
            background: linear-gradient(135deg, #ff7043, #d84315);
        }

        .payment-icon.cod {
            background: linear-gradient(135deg, #8e24aa, #6a1b9a);
        }

        .payment-icon.credit {
            background: linear-gradient(135deg, #ffc107, #ff8f00);
        }

        .payment-icon.crypto {
            background: linear-gradient(135deg, #ff5722, #d84315);
        }

        .payment-title {
            font-weight: 700;
            font-size: 1.3rem;
            margin-bottom: 1rem;
            color: var(--dark-color);
        }

        .payment-description {
            color: var(--gray-600);
            margin-bottom: 2rem;
            line-height: 1.6;
        }

        .payment-options {
            list-style: none;
            padding: 0;
            margin: 0;
            text-align: left;
        }

        .payment-options li {
            padding: 0.75rem 0;
            border-bottom: 1px solid #f0f0f0;
            display: flex;
            align-items: center;
            font-size: 0.95rem;
            color: var(--gray-700);
        }

        .payment-options li:last-child {
            border-bottom: none;
        }

        .payment-options li::before {
            content: '•';
            color: var(--primary-color);
            font-weight: bold;
            font-size: 1.2rem;
            margin-right: 0.75rem;
        }

        .payment-options li img {
            width: 30px;
            height: 20px;
            margin-right: 0.75rem;
            border-radius: 4px;
        }

        .step-guide {
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            border-radius: 20px;
            padding: 3rem 2rem;
            margin-bottom: 3rem;
        }

        .step-item {
            display: flex;
            align-items: flex-start;
            margin-bottom: 2rem;
            position: relative;
        }

        .step-item:not(:last-child)::after {
            content: '';
            position: absolute;
            left: 35px;
            top: 70px;
            width: 2px;
            height: 40px;
            background: var(--primary-color);
            opacity: 0.3;
        }

        .step-number {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 2rem;
            font-size: 1.5rem;
            font-weight: 700;
            color: white;
            flex-shrink: 0;
        }

        .step-content {
            flex: 1;
            padding-top: 1rem;
        }

        .step-title {
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: var(--dark-color);
        }

        .step-text {
            color: var(--gray-600);
            line-height: 1.6;
            margin: 0;
        }

        .security-features {
            background: white;
            border-radius: 20px;
            padding: 2.5rem;
            box-shadow: 0 10px 40px rgba(0,0,0,0.1);
            border-left: 5px solid var(--primary-color);
        }

        .security-item {
            display: flex;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .security-icon {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 1rem;
            color: white;
            font-size: 1.2rem;
        }

        .security-text {
            flex: 1;
        }

        .security-title {
            font-weight: 600;
            margin-bottom: 0.25rem;
            color: var(--dark-color);
        }

        .security-desc {
            color: var(--gray-600);
            font-size: 0.9rem;
            margin: 0;
        }

        .fee-table {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 8px 32px rgba(0,0,0,0.1);
        }

        .fee-table table {
            margin: 0;
        }

        .fee-table thead {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
        }

        .fee-table th {
            padding: 1.5rem 1rem;
            font-weight: 600;
            border: none;
        }

        .fee-table td {
            padding: 1.25rem 1rem;
            border-color: #f0f0f0;
            vertical-align: middle;
        }

        .fee-table tbody tr:hover {
            background-color: #f8f9fa;
        }

        .promo-payment {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            border-radius: 20px;
            padding: 3rem 2rem;
            text-align: center;
            color: white;
            position: relative;
            overflow: hidden;
        }

        .promo-payment::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            animation: pulse 4s ease-in-out infinite;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); opacity: 0.7; }
            50% { transform: scale(1.1); opacity: 1; }
        }

        .promo-content {
            position: relative;
            z-index: 1;
        }

        .section-title {
            font-weight: 700;
            font-size: 2.5rem;
            color: var(--dark-color);
            margin-bottom: 1rem;
        }

        .section-subtitle {
            font-size: 1.1rem;
            color: var(--gray-600);
            line-height: 1.6;
        }

        .hero-stats {
            display: flex;
            gap: 2rem;
            margin-top: 2rem;
        }

        .stat-item {
            text-align: center;
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: 800;
            color: white;
            margin-bottom: 0.5rem;
        }

        .stat-label {
            font-size: 0.9rem;
            opacity: 0.9;
            margin: 0;
        }

        .info-alert {
            background: linear-gradient(135deg, #e3f2fd, #bbdefb);
            border: 1px solid #2196f3;
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 2rem;
        }

        .info-alert .alert-icon {
            width: 40px;
            height: 40px;
            background: #2196f3;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1rem;
            color: white;
        }

        .info-alert h6 {
            color: #1976d2;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .info-alert p {
            color: #0d47a1;
            margin: 0;
            line-height: 1.6;
        }

        .faq-item {
            background: white;
            border-radius: 12px;
            margin-bottom: 1rem;
            box-shadow: 0 4px 16px rgba(0,0,0,0.1);
            overflow: hidden;
        }

        .faq-question {
            padding: 1.5rem;
            cursor: pointer;
            font-weight: 600;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: all 0.3s ease;
            border: none;
            background: none;
            width: 100%;
            text-align: left;
        }

        .faq-question:hover {
            background-color: #f8f9fa;
        }

        .faq-answer {
            padding: 0 1.5rem 1.5rem;
            color: var(--gray-600);
            line-height: 1.6;
            display: none;
        }

        .faq-answer.show {
            display: block;
        }

        .faq-toggle {
            font-size: 1.2rem;
            color: var(--primary-color);
            transition: transform 0.3s ease;
        }

        .faq-toggle.rotate {
            transform: rotate(45deg);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .hero-stats {
                flex-direction: column;
                gap: 1rem;
            }
            
            .payment-hero {
                padding: 60px 0;
            }
            
            .section-title {
                font-size: 2rem;
            }

            .step-item {
                flex-direction: column;
                text-align: center;
            }

            .step-item:not(:last-child)::after {
                display: none;
            }

            .step-number {
                margin-right: 0;
                margin-bottom: 1rem;
            }

            .security-item {
                flex-direction: column;
                text-align: center;
            }

            .security-icon {
                margin-right: 0;
                margin-bottom: 1rem;
            }

            .fee-table {
                font-size: 0.9rem;
            }

            .fee-table th,
            .fee-table td {
                padding: 1rem 0.5rem;
            }
        }
    </style>
</head>
<body>
<!-- Hero Section -->
<div class="payment-hero">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="hero-content">
                    <nav class="breadcrumb-custom">
                        <a href="{{ route('dashboard') }}">
                            <i class="fas fa-home me-1"></i>Beranda
                        </a>
                        <span class="mx-2">/</span>
                        <span class="current">Metode Pembayaran</span>
                    </nav>
                    
                    <h1 class="display-4 fw-bold mb-4">Metode <span class="text-warning">Pembayaran</span></h1>
                    <p class="lead mb-4">Berbagai pilihan metode pembayaran yang aman, mudah, dan terpercaya untuk kenyamanan berbelanja Anda di MyYOGYA.</p>
                    <div class="hero-stats">
                        <div class="stat-item">
                            <h3 class="stat-number">15+</h3>
                            <p class="stat-label">Metode Pembayaran</p>
                        </div>
                        <div class="stat-item">
                            <h3 class="stat-number">100%</h3>
                            <p class="stat-label">Aman & Terjamin</p>
                        </div>
                        <div class="stat-item">
                            <h3 class="stat-number">24/7</h3>
                            <p class="stat-label">Support Payment</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="hero-image">
                    <img src="{{ asset('image/placeholder.png') }}" alt="Metode Pembayaran MyYOGYA" class="img-fluid rounded-4 shadow-lg">
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Payment Methods Section -->
<section class="payment-methods py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center mb-5">
                <h2 class="section-title">Pilihan Metode Pembayaran</h2>
                <p class="section-subtitle">Pilih metode pembayaran yang paling sesuai dengan kebutuhan dan preferensi Anda</p>
            </div>
        </div>
        
        <div class="row g-4">
            <div class="col-lg-4 col-md-6">
                <div class="payment-method-card">
                    <div class="payment-icon bank">
                        <i class="fas fa-university"></i>
                    </div>
                    <h5 class="payment-title">Transfer Bank</h5>
                    <p class="payment-description">Transfer langsung ke rekening bank resmi MyYOGYA dengan berbagai pilihan bank</p>
                    <ul class="payment-options">
                        <li>BCA - Bank Central Asia</li>
                        <li>Mandiri - Bank Mandiri</li>
                        <li>BNI - Bank Negara Indonesia</li>
                        <li>BRI - Bank Rakyat Indonesia</li>
                        <li>CIMB Niaga</li>
                        <li>Danamon</li>
                    </ul>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6">
                <div class="payment-method-card">
                    <div class="payment-icon ewallet">
                        <i class="fas fa-mobile-alt"></i>
                    </div>
                    <h5 class="payment-title">E-Wallet</h5>
                    <p class="payment-description">Pembayaran praktis menggunakan dompet digital favorit Anda dengan proses instan</p>
                    <ul class="payment-options">
                        <li>GoPay - Gojek Wallet</li>
                        <li>OVO - One Verification</li>
                        <li>DANA - Digital Wallet</li>
                        <li>ShopeePay</li>
                        <li>LinkAja</li>
                        <li>Jenius Pay</li>
                    </ul>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6">
                <div class="payment-method-card">
                    <div class="payment-icon qris">
                        <i class="fas fa-qrcode"></i>
                    </div>
                    <h5 class="payment-title">QRIS</h5>
                    <p class="payment-description">Scan QR Code untuk pembayaran yang cepat dan mudah dari berbagai aplikasi</p>
                    <ul class="payment-options">
                        <li>QRIS Universal</li>
                        <li>Semua Bank & E-Wallet</li>
                        <li>Scan & Pay</li>
                        <li>Instant Payment</li>
                        <li>No Registration</li>
                        <li>Secure Transaction</li>
                    </ul>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6">
                <div class="payment-method-card">
                    <div class="payment-icon credit">
                        <i class="fas fa-credit-card"></i>
                    </div>
                    <h5 class="payment-title">Kartu Kredit/Debit</h5>
                    <p class="payment-description">Pembayaran dengan kartu kredit atau debit dari berbagai bank dengan sistem keamanan 3D Secure</p>
                    <ul class="payment-options">
                        <li>Visa</li>
                        <li>Mastercard</li>
                        <li>JCB</li>
                        <li>American Express</li>
                        <li>Kartu Debit ATM</li>
                        <li>3D Secure Protection</li>
                    </ul>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6">
                <div class="payment-method-card">
                    <div class="payment-icon cod">
                        <i class="fas fa-hand-holding-usd"></i>
                    </div>
                    <h5 class="payment-title">COD (Cash on Delivery)</h5>
                    <p class="payment-description">Bayar tunai saat barang tiba di alamat Anda dengan fee tambahan yang terjangkau</p>
                    <ul class="payment-options">
                        <li>Bayar saat terima barang</li>
                        <li>Cek kondisi barang dulu</li>
                        <li>Area Jabodetabek</li>
                        <li>Fee COD Rp 5.000</li>
                        <li>Max 3 juta per transaksi</li>
                        <li>Uang pas/kembalian</li>
                    </ul>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6">
                <div class="payment-method-card">
                    <div class="payment-icon crypto">
                        <i class="fab fa-bitcoin"></i>
                    </div>
                    <h5 class="payment-title">Cryptocurrency</h5>
                    <p class="payment-description">Pembayaran modern dengan mata uang digital untuk transaksi yang aman dan global</p>
                    <ul class="payment-options">
                        <li>Bitcoin (BTC)</li>
                        <li>Ethereum (ETH)</li>
                        <li>Tether (USDT)</li>
                        <li>Binance Coin (BNB)</li>
                        <li>Secure Blockchain</li>
                        <li>Fast Transaction</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Payment Process -->
<section class="payment-process py-5 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center mb-5">
                <h2 class="section-title">Cara Melakukan Pembayaran</h2>
                <p class="section-subtitle">Ikuti langkah-langkah mudah untuk menyelesaikan pembayaran dengan aman</p>
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-10 mx-auto">
                <div class="step-guide">
                    <div class="step-item">
                        <div class="step-number">1</div>
                        <div class="step-content">
                            <h6 class="step-title">Pilih Produk & Checkout</h6>
                            <p class="step-text">Tambahkan produk ke keranjang belanja, review pesanan Anda, lalu klik tombol "Checkout" untuk melanjutkan ke halaman pembayaran.</p>
                        </div>
                    </div>
                    
                    <div class="step-item">
                        <div class="step-number">2</div>
                        <div class="step-content">
                            <h6 class="step-title">Pilih Metode Pembayaran</h6>
                            <p class="step-text">Pilih metode pembayaran yang diinginkan dari berbagai opsi yang tersedia sesuai dengan preferensi dan kemudahan Anda.</p>
                        </div>
                    </div>
                    
                    <div class="step-item">
                        <div class="step-number">3</div>
                        <div class="step-content">
                            <h6 class="step-title">Konfirmasi Detail Pembayaran</h6>
                            <p class="step-text">Periksa kembali detail pesanan, jumlah pembayaran, dan metode yang dipilih. Pastikan semua informasi sudah benar.</p>
                        </div>
                    </div>
                    
                    <div class="step-item">
                        <div class="step-number">4</div>
                        <div class="step-content">
                            <h6 class="step-title">Lakukan Pembayaran</h6>
                            <p class="step-text">Ikuti instruksi pembayaran sesuai metode yang dipilih. Untuk transfer bank, transfer ke rekening yang tertera. Untuk e-wallet, ikuti redirect ke aplikasi.</p>
                        </div>
                    </div>
                    
                    <div class="step-item">
                        <div class="step-number">5</div>
                        <div class="step-content">
                            <h6 class="step-title">Konfirmasi Pembayaran</h6>
                            <p class="step-text">Setelah pembayaran berhasil, Anda akan menerima notifikasi konfirmasi. Pesanan akan segera diproses untuk pengiriman.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Security Features -->
<section class="security-section py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center mb-5">
                <h2 class="section-title">Keamanan Pembayaran</h2>
                <p class="section-subtitle">Sistem keamanan berlapis untuk melindungi data dan transaksi Anda</p>
            </div>
        </div>
        
        <div class="row g-4">
            <div class="col-lg-6">
                <div class="security-features">
                    <div class="security-item">
                        <div class="security-icon">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <div class="security-text">
                            <h6 class="security-title">SSL Encryption</h6>
                            <p class="security-desc">Enkripsi 256-bit untuk melindungi data pribadi dan transaksi</p>
                        </div>
                    </div>
                    
                    <div class="security-item">
                        <div class="security-icon">
                            <i class="fas fa-lock"></i>
                        </div>
                        <div class="security-text">
                            <h6 class="security-title">3D Secure</h6>
                            <p class="security-desc">Autentikasi tambahan untuk transaksi kartu kredit</p>
                        </div>
                    </div>
                    
                    <div class="security-item">
                        <div class="security-icon">
                            <i class="fas fa-eye-slash"></i>
                        </div>
                        <div class="security-text">
                            <h6 class="security-title">Data Protection</h6>
                            <p class="security-desc">Data kartu tidak disimpan di server kami</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-6">
                <div class="security-features">
                    <div class="security-item">
                        <div class="security-icon">
                            <i class="fas fa-certificate"></i>
                        </div>
                        <div class="security-text">
                            <h6 class="security-title">PCI DSS Compliant</h6>
                            <p class="security-desc">Sertifikasi standar keamanan industri pembayaran</p>
                        </div>
                    </div>
                    
                    <div class="security-item">
                        <div class="security-icon">
                            <i class="fas fa-bell"></i>
                        </div>
                        <div class="security-text">
                            <h6 class="security-title">Real-time Monitoring</h6>
                            <p class="security-desc">Pemantauan transaksi 24/7 untuk deteksi fraud</p>
                        </div>
                    </div>
                    
                    <div class="security-item">
                        <div class="security-icon">
                            <i class="fas fa-undo"></i>
                        </div>
                        <div class="security-text">
                            <h6 class="security-title">Refund Protection</h6>
                            <p class="security-desc">Garansi pengembalian dana untuk transaksi bermasalah</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Fee Information -->
<section class="fee-section py-5 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center mb-5">
                <h2 class="section-title">Biaya Transaksi</h2>
                <p class="section-subtitle">Informasi biaya administrasi untuk setiap metode pembayaran</p>
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-10 mx-auto">
                <div class="fee-table">
                    <table class="table table-striped mb-0">
                        <thead>
                            <tr>
                                <th>Metode Pembayaran</th>
                                <th>Biaya Admin</th>
                                <th>Minimum Transaksi</th>
                                <th>Waktu Verifikasi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><strong>Transfer Bank</strong></td>
                                <td>Gratis</td>
                                <td>Rp 10.000</td>
                                <td>1-3 jam kerja</td>
                            </tr>
                            <tr>
                                <td><strong>E-Wallet (GoPay, OVO, DANA)</strong></td>
                                <td>Gratis</td>
                                <td>Rp 1.000</td>
                                <td>Instant</td>
                            </tr>
                            <tr>
                                <td><strong>QRIS</strong></td>
                                <td>Gratis</td>
                                <td>Rp 1.000</td>
                                <td>Instant</td>
                            </tr>
                            <tr>
                                <td><strong>Kartu Kredit/Debit</strong></td>
                                <td>2.9% + Rp 2.000</td>
                                <td>Rp 10.000</td>
                                <td>Instant</td>
                            </tr>
                            <tr>
                                <td><strong>COD</strong></td>
                                <td>Rp 5.000</td>
                                <td>Rp 50.000</td>
                                <td>Saat terima barang</td>
                            </tr>
                            <tr>
                                <td><strong>Cryptocurrency</strong></td>
                                <td>1% + Gas Fee</td>
                                <td>$10 USD</td>
                                <td>10-30 menit</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="faq-section py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center mb-5">
                <h2 class="section-title">FAQ Pembayaran</h2>
                <p class="section-subtitle">Pertanyaan yang sering diajukan seputar metode pembayaran</p>
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="faq-item">
                    <button class="faq-question" onclick="toggleFAQ(this)">
                        <span>Apakah pembayaran di MyYOGYA aman?</span>
                        <i class="fas fa-plus faq-toggle"></i>
                    </button>
                    <div class="faq-answer">
                        Ya, sangat aman. Kami menggunakan enkripsi SSL 256-bit, sertifikasi PCI DSS, dan sistem 3D Secure untuk melindungi semua transaksi. Data kartu tidak disimpan di server kami.
                    </div>
                </div>
                
                <div class="faq-item">
                    <button class="faq-question" onclick="toggleFAQ(this)">
                        <span>Berapa lama verifikasi pembayaran?</span>
                        <i class="fas fa-plus faq-toggle"></i>
                    </button>
                    <div class="faq-answer">
                        E-wallet dan QRIS instant, transfer bank 1-3 jam kerja, kartu kredit instant, COD saat terima barang, cryptocurrency 10-30 menit tergantung network.
                    </div>
                </div>
                
                <div class="faq-item">
                    <button class="faq-question" onclick="toggleFAQ(this)">
                        <span>Bagaimana jika pembayaran gagal?</span>
                        <i class="fas fa-plus faq-toggle"></i>
                    </button>
                    <div class="faq-answer">
                        Jika pembayaran gagal, pesanan akan otomatis dibatalkan. Dana akan dikembalikan ke rekening/e-wallet Anda dalam 1-7 hari kerja tergantung metode pembayaran.
                    </div>
                </div>
                
                <div class="faq-item">
                    <button class="faq-question" onclick="toggleFAQ(this)">
                        <span>Apakah bisa refund jika barang tidak sesuai?</span>
                        <i class="fas fa-plus faq-toggle"></i>
                    </button>
                    <div class="faq-answer">
                        Ya, kami memiliki kebijakan refund 7 hari. Jika barang tidak sesuai deskripsi atau rusak, Anda bisa mengajukan refund dan dana akan dikembalikan setelah barang diterima kembali.
                    </div>
                </div>
                
                <div class="faq-item">
                    <button class="faq-question" onclick="toggleFAQ(this)">
                        <span>Apakah ada batas maksimal transaksi?</span>
                        <i class="fas fa-plus faq-toggle"></i>
                    </button>
                    <div class="faq-answer">
                        Transfer bank: Rp 50 juta, E-wallet: sesuai limit aplikasi, Kartu kredit: sesuai limit kartu, COD: Rp 3 juta, Cryptocurrency: tidak terbatas.
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Important Info -->
<section class="important-info py-5 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <h2 class="section-title text-center mb-5">Informasi Penting</h2>
                
                <div class="info-alert">
                    <div class="info-alert-icon">
                        <i class="fas fa-exclamation-triangle"></i>
                    </div>
                    <h6>Perhatian Khusus</h6>
                    <p>Jangan pernah memberikan data kartu kredit, PIN, atau OTP kepada siapa pun. MyYOGYA tidak pernah meminta informasi sensitif melalui telepon atau email.</p>
                </div>
                
                <div class="info-alert">
                    <div class="info-alert-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <h6>Batas Waktu Pembayaran</h6>
                    <p>Setelah checkout, Anda memiliki waktu 24 jam untuk menyelesaikan pembayaran. Pesanan akan otomatis dibatalkan jika melewati batas waktu.</p>
                </div>
                
                <div class="info-alert">
                    <div class="info-alert-icon">
                        <i class="fas fa-phone"></i>
                    </div>
                    <h6>Bantuan Customer Service</h6>
                    <p>Jika mengalami kendala pembayaran, hubungi customer service kami 24/7 melalui WhatsApp, Live Chat, atau telepon untuk bantuan langsung.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Promo Section -->
<section class="promo-section py-5">
    <div class="container">
        <div class="promo-payment">
            <div class="promo-content">
                <h3 class="mb-3 fw-bold">💳 PROMO PAYMENT SPECIAL! 💳</h3>
                <p class="mb-4 lead">Cashback 5% untuk pembayaran dengan e-wallet dan potongan biaya admin kartu kredit!</p>
                <div class="d-flex justify-content-center gap-3 flex-wrap">
                    <a href="{{ route('dashboard') }}" class="btn btn-light btn-lg px-4">
                        <i class="fas fa-shopping-bag me-2"></i>Belanja Sekarang
                    </a>
                    <a href="{{ route('cara-belanja') }}" class="btn btn-outline-light btn-lg px-4">
                        <i class="fas fa-info-circle me-2"></i>Cara Belanja
                    </a>
                </div>
                <div class="mt-4">
                    <small class="opacity-75">*Syarat dan ketentuan berlaku. Promo terbatas hingga akhir bulan.</small>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Footer -->
<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="footer-brand">
                    <h5 class="mb-2">MyYOGYA</h5>
                    <p>Platform belanja online terpercaya dengan ribuan produk berkualitas dan pelayanan terbaik untuk kepuasan Anda.</p>
                </div>
            </div>
            <div class="col-lg-2 col-md-6 mb-4">
                <h6 class="footer-title">Tentang Kami</h6>
                <ul class="footer-links">
                    <li><a href="{{ route('tentang') }}">Tentang MyYOGYA</a></li>
                    <li><a href="{{ route('karir') }}">Karir</a></li>
                    <li><a href="{{ route('press-release') }}">Press Release</a></li>
                    <li><a href="{{ route('investor-relations') }}">Investor Relations</a></li>
                </ul>
            </div>
            <div class="col-lg-2 col-md-6 mb-4">
                <h6 class="footer-title">Layanan</h6>
                <ul class="footer-links">
                    <li><a href="{{ route('layanan') }}">Bantuan</a></li>
                    <li><a href="{{ route('cara-belanja') }}">Cara Belanja</a></li>
                    <li><a href="{{ route('pengiriman') }}">Pengiriman</a></li>
                    <li><a href="{{ route('metode-pembayaran') }}">Metode Pembayaran</a></li>
                </ul>
            </div>
            <div class="col-lg-2 col-md-6 mb-4">
                <h6 class="footer-title">Kebijakan</h6>
                <ul class="footer-links">
                    <li><a href="{{ route('syarat-ketentuan') }}">Syarat & Ketentuan</a></li>
                    <li><a href="{{ route('kebijakan-privasi') }}">Kebijakan Privasi</a></li>
                    <li><a href="{{ route('kebijakan-return') }}">Kebijakan Return</a></li>
                    <li><a href="{{ route('hak-kekayaan-intelektual') }}">Hak Kekayaan Intelektual</a></li>
                </ul>
            </div>
            <div class="col-lg-2 col-md-6 mb-4">
                <h6 class="footer-title">Ikuti Kami</h6>
                <div class="social-links">
                    <a href="https://www.facebook.com/toserbayogyaciamis57/" target="_blank" rel="noopener" title="Facebook Toserba YOGYA Ciamis" aria-label="Facebook">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="https://www.google.com/maps?q=Jl.%20Perintis%20Kemerdekaan%20No.57%2C%20Ciamis%2C%20Kec.%20Ciamis%2C%20Kabupaten%20Ciamis%2C%20Jawa%20Barat%2046211%2C%20Indonesia" target="_blank" rel="noopener" title="Lihat lokasi di Google Maps (Jl. Perintis Kemerdekaan No.57, Ciamis · +62 265 777779)" aria-label="Lokasi">
                        <i class="fas fa-map-marker-alt"></i>
                    </a>
                    <a href="https://www.instagram.com/yogya_ciamis/reels/" target="_blank" rel="noopener" title="Instagram YOGYA Ciamis" aria-label="Instagram">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="https://www.youtube.com/ToserbaYOGYA" target="_blank" rel="noopener" title="YouTube Toserba YOGYA" aria-label="YouTube">
                        <i class="fab fa-youtube"></i>
                    </a>
                </div>
            </div>
        </div>
        <hr class="footer-divider">
        <div class="row">
            <div class="col-md-6">
                <p class="footer-text">&copy; 2025 MyYOGYA. All rights reserved.</p>
            </div>
            <div class="col-md-6 text-md-end">
                <p class="footer-text">Made from Selenium in Indonesia</p>
            </div>
        </div>
    </div>
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- Custom JS -->
<script src="{{ asset('js/dashboard.js') }}"></script>

<script>
function toggleFAQ(element) {
    const answer = element.nextElementSibling;
    const toggle = element.querySelector('.faq-toggle');
    
    // Close all other FAQ items
    document.querySelectorAll('.faq-answer').forEach(item => {
        if (item !== answer) {
            item.classList.remove('show');
        }
    });
    
    document.querySelectorAll('.faq-toggle').forEach(item => {
        if (item !== toggle) {
            item.classList.remove('rotate');
        }
    });
    
    // Toggle current FAQ item
    answer.classList.toggle('show');
    toggle.classList.toggle('rotate');
}
</script>

</body>
</html>
