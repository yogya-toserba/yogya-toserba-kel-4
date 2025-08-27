<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cara Belanja - MyYOGYA</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Custom CSS -->
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
    
    <style>
        /* Shopping Guide Page Styles */
        .guide-hero {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            padding: 100px 0;
            position: relative;
            overflow: hidden;
        }

        .guide-hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Ccircle cx='30' cy='30' r='2'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E") repeat;
        }

        .guide-hero .container {
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

        .breadcrumb-custom a:active {
            transform: translateY(0);
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

        .step-card {
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

        .step-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        }

        .step-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 60px rgba(0,0,0,0.15);
            border-color: var(--primary-color);
        }

        .step-number {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            font-size: 2rem;
            font-weight: bold;
            color: white;
            position: relative;
        }

        .step-number::after {
            content: '';
            position: absolute;
            width: 100px;
            height: 100px;
            border: 2px dashed var(--primary-color);
            border-radius: 50%;
            opacity: 0.3;
            animation: rotate 10s linear infinite;
        }

        @keyframes rotate {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        .step-title {
            font-weight: 700;
            font-size: 1.4rem;
            margin-bottom: 1rem;
            color: var(--dark-color);
        }

        .step-description {
            color: var(--gray-600);
            line-height: 1.7;
            margin-bottom: 1.5rem;
        }

        .step-features {
            list-style: none;
            padding: 0;
            margin: 0;
            text-align: left;
        }

        .step-features li {
            padding: 0.5rem 0;
            position: relative;
            padding-left: 2rem;
            color: var(--gray-600);
            font-size: 0.95rem;
        }

        .step-features li::before {
            content: '✓';
            position: absolute;
            left: 0;
            color: var(--primary-color);
            font-weight: bold;
            font-size: 1.1rem;
        }

        .payment-card {
            background: white;
            padding: 2rem;
            border-radius: 16px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.1);
            text-align: center;
            height: 100%;
            transition: var(--transition);
            border: 1px solid #f0f0f0;
        }

        .payment-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 16px 48px rgba(0,0,0,0.15);
            border-color: var(--primary-color);
        }

        .payment-icon {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            font-size: 1.8rem;
            color: white;
        }

        .payment-title {
            font-weight: 600;
            margin-bottom: 1rem;
            color: var(--dark-color);
        }

        .payment-description {
            color: var(--gray-600);
            line-height: 1.6;
            font-size: 0.9rem;
        }

        .tips-card {
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            border-radius: 16px;
            padding: 2rem;
            margin-bottom: 1.5rem;
            border-left: 4px solid var(--primary-color);
        }

        .tips-icon {
            width: 50px;
            height: 50px;
            background: var(--primary-color);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1rem;
            color: white;
            font-size: 1.2rem;
        }

        .tips-title {
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: var(--dark-color);
        }

        .tips-text {
            color: var(--gray-600);
            line-height: 1.6;
            margin: 0;
        }

        .promo-banner {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            border-radius: 20px;
            padding: 3rem 2rem;
            text-align: center;
            color: white;
            position: relative;
            overflow: hidden;
        }

        .promo-banner::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            animation: pulse 3s ease-in-out infinite;
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

        .process-timeline {
            position: relative;
            padding: 2rem 0;
        }

        .process-timeline::before {
            content: '';
            position: absolute;
            left: 50%;
            top: 0;
            bottom: 0;
            width: 2px;
            background: linear-gradient(to bottom, var(--primary-color), var(--secondary-color));
            transform: translateX(-50%);
        }

        .timeline-item {
            position: relative;
            margin-bottom: 3rem;
        }

        .timeline-item:nth-child(odd) .timeline-content {
            margin-right: 60%;
            text-align: right;
        }

        .timeline-item:nth-child(even) .timeline-content {
            margin-left: 60%;
            text-align: left;
        }

        .timeline-marker {
            position: absolute;
            left: 50%;
            top: 20px;
            width: 20px;
            height: 20px;
            background: var(--primary-color);
            border-radius: 50%;
            transform: translateX(-50%);
            border: 4px solid white;
            box-shadow: 0 0 0 4px var(--primary-color);
        }

        .timeline-content {
            background: white;
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.1);
        }

        .timeline-title {
            font-weight: 600;
            color: var(--dark-color);
            margin-bottom: 1rem;
        }

        .timeline-text {
            color: var(--gray-600);
            line-height: 1.6;
        }

        /* Custom Promo Buttons */
        .promo-content .btn {
            border-radius: 25px;
            padding: 12px 24px;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            font-family: "Montserrat", sans-serif;
        }

        .promo-content .btn-light {
            background: rgba(255, 255, 255, 0.15);
            color: white;
            border: 2px solid rgba(255, 255, 255, 0.3);
            backdrop-filter: blur(10px);
        }

        .promo-content .btn-light:hover {
            background: rgba(255, 255, 255, 0.9);
            color: var(--primary-color);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(255, 255, 255, 0.3);
            border-color: rgba(255, 255, 255, 0.8);
        }

        .promo-content .btn-outline-light {
            background: rgba(255, 255, 255, 0.1);
            color: white;
            border: 2px solid rgba(255, 255, 255, 0.25);
            backdrop-filter: blur(10px);
        }

        .promo-content .btn-outline-light:hover {
            background: rgba(255, 255, 255, 0.9);
            color: var(--primary-color);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(255, 255, 255, 0.3);
            border-color: rgba(255, 255, 255, 0.8);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .hero-stats {
                flex-direction: column;
                gap: 1rem;
            }
            
            .guide-hero {
                padding: 60px 0;
            }
            
            .section-title {
                font-size: 2rem;
            }

            .process-timeline::before {
                left: 30px;
            }

            .timeline-item:nth-child(odd) .timeline-content,
            .timeline-item:nth-child(even) .timeline-content {
                margin: 0 0 0 60px;
                text-align: left;
            }

            .timeline-marker {
                left: 30px;
            }
        }
    </style>
</head>
<body>
<!-- Hero Section -->
<div class="guide-hero">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="hero-content">
                    <nav class="breadcrumb-custom">
                        <a href="{{ route('dashboard') }}">
                            <i class="fas fa-home me-1"></i>Beranda
                        </a>
                        <span class="mx-2">/</span>
                        <span class="current">Cara Belanja</span>
                    </nav>
                    
                    <h1 class="display-4 fw-bold mb-4">Cara <span style="color: #ffc107;">Belanja</span></h1>
                    <p class="lead mb-4">Panduan lengkap berbelanja di MyYOGYA dengan mudah, aman, dan menyenangkan. Dari pemilihan produk hingga pembayaran hanya dalam beberapa langkah sederhana.</p>
                    <div class="hero-stats">
                        <div class="stat-item">
                            <h3 class="stat-number">5</h3>
                            <p class="stat-label">Langkah Mudah</p>
                        </div>
                        <div class="stat-item">
                            <h3 class="stat-number">10+</h3>
                            <p class="stat-label">Metode Bayar</p>
                        </div>
                        <div class="stat-item">
                            <h3 class="stat-number">2-7</h3>
                            <p class="stat-label">Hari Sampai</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="hero-image">
                    <img src="{{ asset('image/placeholder.png') }}" alt="Cara Belanja" class="img-fluid rounded-4 shadow-lg">
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Steps Section -->
<section class="steps-section py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center mb-5">
                <h2 class="section-title">5 Langkah Mudah Berbelanja</h2>
                <p class="section-subtitle">Ikuti panduan step-by-step untuk pengalaman berbelanja yang lancar dan menyenangkan di MyYOGYA</p>
            </div>
        </div>
        
        <div class="row g-4">
            <div class="col-lg-4 col-md-6">
                <div class="step-card">
                    <div class="step-number">1</div>
                    <h5 class="step-title">Pilih Produk</h5>
                    <p class="step-description">Jelajahi ribuan produk berkualitas dengan fitur pencarian dan filter yang canggih.</p>
                    <ul class="step-features">
                        <li>Browse kategori produk</li>
                        <li>Gunakan fitur search</li>
                        <li>Filter berdasarkan harga & brand</li>
                        <li>Lihat detail & review produk</li>
                        <li>Bandingkan produk serupa</li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="step-card">
                    <div class="step-number">2</div>
                    <h5 class="step-title">Tambah ke Keranjang</h5>
                    <p class="step-description">Klik "Add to Cart" untuk menambahkan produk pilihan Anda ke dalam keranjang belanja.</p>
                    <ul class="step-features">
                        <li>Pilih varian produk (ukuran/warna)</li>
                        <li>Tentukan jumlah yang diinginkan</li>
                        <li>Klik tombol "Add to Cart"</li>
                        <li>Cek keranjang belanja</li>
                        <li>Lanjut shopping atau checkout</li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="step-card">
                    <div class="step-number">3</div>
                    <h5 class="step-title">Isi Data Pengiriman</h5>
                    <p class="step-description">Lengkapi informasi pengiriman dengan akurat untuk memastikan produk sampai dengan selamat.</p>
                    <ul class="step-features">
                        <li>Nama penerima lengkap</li>
                        <li>Alamat pengiriman detail</li>
                        <li>Nomor telepon aktif</li>
                        <li>Pilih ekspedisi pengiriman</li>
                        <li>Estimasi waktu & biaya kirim</li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="step-card">
                    <div class="step-number">4</div>
                    <h5 class="step-title">Pilih Metode Pembayaran</h5>
                    <p class="step-description">Berbagai pilihan pembayaran aman dan terpercaya sesuai kebutuhan Anda.</p>
                    <ul class="step-features">
                        <li>Transfer bank (BCA, Mandiri, BNI, BRI)</li>
                        <li>E-Wallet (OVO, GoPay, Dana, ShopeePay)</li>
                        <li>Credit/Debit Card (Visa, Mastercard)</li>
                        <li>Cicilan 0% (Kredivo, Akulaku)</li>
                        <li>Virtual Account & QRIS</li>
                        <li>COD (Cash on Delivery)</li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="step-card">
                    <div class="step-number">5</div>
                    <h5 class="step-title">Konfirmasi & Track Pesanan</h5>
                    <p class="step-description">Setelah pembayaran berhasil, pantau status pesanan Anda real-time.</p>
                    <ul class="step-features">
                        <li>Konfirmasi pesanan otomatis</li>
                        <li>Notifikasi via email & WhatsApp</li>
                        <li>Tracking real-time pengiriman</li>
                        <li>Update status di akun MyYOGYA</li>
                        <li>Estimasi waktu tiba</li>
                        <li>Konfirmasi penerimaan barang</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Payment Methods Section -->
<section class="payment-section py-5 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center mb-5">
                <h2 class="section-title">Metode Pembayaran</h2>
                <p class="section-subtitle">Pilihan pembayaran lengkap dan aman dengan teknologi enkripsi tingkat bank</p>
            </div>
        </div>
        
        <div class="row g-4">
            <div class="col-lg-3 col-md-6">
                <div class="payment-card">
                    <div class="payment-icon">
                        <i class="fas fa-university"></i>
                    </div>
                    <h6 class="payment-title">Transfer Bank</h6>
                    <p class="payment-description">BCA, Mandiri, BNI, BRI, dan bank lainnya dengan virtual account otomatis.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="payment-card">
                    <div class="payment-icon">
                        <i class="fas fa-mobile-alt"></i>
                    </div>
                    <h6 class="payment-title">E-Wallet</h6>
                    <p class="payment-description">OVO, GoPay, Dana, ShopeePay - bayar praktis dengan saldo digital.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="payment-card">
                    <div class="payment-icon">
                        <i class="fas fa-credit-card"></i>
                    </div>
                    <h6 class="payment-title">Kartu Kredit/Debit</h6>
                    <p class="payment-description">Visa, Mastercard dengan sistem keamanan 3D Secure terdepan.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="payment-card">
                    <div class="payment-icon">
                        <i class="fas fa-hand-holding-usd"></i>
                    </div>
                    <h6 class="payment-title">Cicilan 0%</h6>
                    <p class="payment-description">Kredivo, Akulaku untuk cicilan mudah tanpa bunga hingga 12 bulan.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Tips Section -->
<section class="tips-section py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="text-center mb-5">
                    <h2 class="section-title">Tips Belanja Cerdas</h2>
                    <p class="section-subtitle">Maksimalkan pengalaman berbelanja Anda dengan tips dan trik dari para ahli</p>
                </div>
                
                <div class="tips-card">
                    <div class="tips-icon">
                        <i class="fas fa-tags"></i>
                    </div>
                    <h6 class="tips-title">Manfaatkan Promo & Voucher</h6>
                    <p class="tips-text">Selalu cek halaman promo dan masukkan kode voucher saat checkout. Subscribe newsletter untuk mendapat notifikasi penawaran terbaru.</p>
                </div>
                
                <div class="tips-card">
                    <div class="tips-icon">
                        <i class="fas fa-star"></i>
                    </div>
                    <h6 class="tips-title">Baca Review & Rating</h6>
                    <p class="tips-text">Pelajari review dari pembeli sebelumnya dan perhatikan rating produk untuk memastikan kualitas sesuai ekspektasi.</p>
                </div>
                
                <div class="tips-card">
                    <div class="tips-icon">
                        <i class="fas fa-shipping-fast"></i>
                    </div>
                    <h6 class="tips-title">Pilih Ekspedisi Sesuai Kebutuhan</h6>
                    <p class="tips-text">Same day untuk kebutuhan mendesak, reguler untuk menghemat biaya. Pertimbangkan asuransi untuk barang mahal.</p>
                </div>
                
                <div class="tips-card">
                    <div class="tips-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h6 class="tips-title">Pastikan Data Akurat</h6>
                    <p class="tips-text">Double check alamat pengiriman, nomor telepon, dan data pembayaran untuk menghindari kendala pengiriman.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Promo Banner -->
<section class="promo-section py-5">
    <div class="container">
        <div class="promo-banner">
            <div class="promo-content">
                <h3 class="mb-3 fw-bold">Siap Mulai Berbelanja?</h3>
                <p class="mb-4 lead">Dapatkan pengalaman berbelanja terbaik dengan ribuan produk pilihan dan pelayanan terdepan!</p>
                <div class="d-flex justify-content-center gap-3 flex-wrap">
                    <a href="{{ route('dashboard') }}" class="btn btn-light btn-lg px-4">
                        <i class="fas fa-shopping-bag me-2"></i>Mulai Belanja
                    </a>
                    <a href="{{ route('layanan') }}" class="btn btn-outline-light btn-lg px-4">
                        <i class="fas fa-headset me-2"></i>Butuh Bantuan?
                    </a>
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

</body>
</html>
