<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Info Pengiriman - MyYOGYA</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Custom CSS -->
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
    
    <style>
        /* Shipping Page Styles */
        .shipping-hero {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            padding: 100px 0;
            position: relative;
            overflow: hidden;
        }

        .shipping-hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Ccircle cx='30' cy='30' r='2'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E") repeat;
        }

        .shipping-hero .container {
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

        .shipping-card {
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

        .shipping-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        }

        .shipping-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 60px rgba(0,0,0,0.15);
            border-color: var(--primary-color);
        }

        .shipping-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            font-size: 2rem;
            color: white;
            position: relative;
        }

        .shipping-icon::after {
            content: '';
            position: absolute;
            width: 100px;
            height: 100px;
            border: 2px dashed var(--primary-color);
            border-radius: 50%;
            opacity: 0.3;
            animation: rotate 8s linear infinite;
        }

        @keyframes rotate {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        .shipping-title {
            font-weight: 700;
            font-size: 1.3rem;
            margin-bottom: 1rem;
            color: var(--dark-color);
        }

        .shipping-price {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 1rem;
        }

        .shipping-duration {
            background: var(--primary-color);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 25px;
            font-size: 0.9rem;
            font-weight: 600;
            display: inline-block;
            margin-bottom: 1.5rem;
        }

        .shipping-features {
            list-style: none;
            padding: 0;
            margin: 0;
            text-align: left;
        }

        .shipping-features li {
            padding: 0.5rem 0;
            position: relative;
            padding-left: 2rem;
            color: var(--gray-600);
            font-size: 0.95rem;
        }

        .shipping-features li::before {
            content: '✓';
            position: absolute;
            left: 0;
            color: var(--primary-color);
            font-weight: bold;
            font-size: 1.1rem;
        }

        .coverage-map {
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            border-radius: 20px;
            padding: 3rem 2rem;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .coverage-map::before {
            content: '';
            position: absolute;
            top: -20px;
            left: -20px;
            right: -20px;
            bottom: -20px;
            background: url("data:image/svg+xml,%3Csvg width='40' height='40' viewBox='0 0 40 40' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='%23000' fill-opacity='0.02'%3E%3Cpath d='M20 20c0-11.046-8.954-20-20-20v20h20z'/%3E%3C/g%3E%3C/svg%3E") repeat;
        }

        .coverage-content {
            position: relative;
            z-index: 1;
        }

        .zone-card {
            background: white;
            border-radius: 16px;
            padding: 2rem;
            box-shadow: 0 8px 32px rgba(0,0,0,0.1);
            text-align: center;
            height: 100%;
            transition: var(--transition);
            border: 1px solid #f0f0f0;
        }

        .zone-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 16px 48px rgba(0,0,0,0.15);
            border-color: var(--primary-color);
        }

        .zone-badge {
            background: var(--primary-color);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 25px;
            font-size: 0.8rem;
            font-weight: 600;
            display: inline-block;
            margin-bottom: 1rem;
        }

        .zone-title {
            font-weight: 600;
            margin-bottom: 1rem;
            color: var(--dark-color);
        }

        .zone-cities {
            color: var(--gray-600);
            line-height: 1.6;
            font-size: 0.9rem;
        }

        .tracking-steps {
            position: relative;
            padding: 2rem 0;
        }

        .tracking-step {
            display: flex;
            align-items: center;
            margin-bottom: 2rem;
            position: relative;
        }

        .tracking-step:not(:last-child)::after {
            content: '';
            position: absolute;
            left: 35px;
            top: 70px;
            width: 2px;
            height: 40px;
            background: var(--primary-color);
            opacity: 0.3;
        }

        .step-icon {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 2rem;
            font-size: 1.5rem;
            color: white;
            flex-shrink: 0;
        }

        .step-content {
            flex: 1;
        }

        .step-title {
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: var(--dark-color);
        }

        .step-description {
            color: var(--gray-600);
            line-height: 1.6;
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

        .promo-shipping {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            border-radius: 20px;
            padding: 3rem 2rem;
            text-align: center;
            color: white;
            position: relative;
            overflow: hidden;
        }

        .promo-shipping::before {
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

        /* Responsive */
        @media (max-width: 768px) {
            .hero-stats {
                flex-direction: column;
                gap: 1rem;
            }
            
            .shipping-hero {
                padding: 60px 0;
            }
            
            .section-title {
                font-size: 2rem;
            }

            .tracking-step {
                flex-direction: column;
                text-align: center;
            }

            .tracking-step:not(:last-child)::after {
                display: none;
            }

            .step-icon {
                margin-right: 0;
                margin-bottom: 1rem;
            }
        }
    </style>
</head>
<body>
<!-- Hero Section -->
<div class="shipping-hero">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="hero-content">
                    <nav class="breadcrumb-custom">
                        <a href="{{ route('dashboard') }}">
                            <i class="fas fa-home me-1"></i>Beranda
                        </a>
                        <span class="mx-2">/</span>
                        <span class="current">Info Pengiriman</span>
                    </nav>
                    
                    <h1 class="display-4 fw-bold mb-4">Info <span class="text-primary">Pengiriman</span></h1>
                    <p class="lead mb-4">Layanan pengiriman terpercaya ke seluruh Indonesia dengan berbagai pilihan ekspedisi dan jaminan keamanan barang hingga tujuan.</p>
                    <div class="hero-stats">
                        <div class="stat-item">
                            <h3 class="stat-number">500+</h3>
                            <p class="stat-label">Kota Terjangkau</p>
                        </div>
                        <div class="stat-item">
                            <h3 class="stat-number">24h</h3>
                            <p class="stat-label">Same Day Delivery</p>
                        </div>
                        <div class="stat-item">
                            <h3 class="stat-number">99%</h3>
                            <p class="stat-label">Tepat Waktu</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="hero-image">
                    <img src="{{ asset('image/pengiriman.png') }}" alt="Pengiriman MyYOGYA" class="img-fluid rounded-4 shadow-lg">
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Shipping Options Section -->
<section class="shipping-options py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center mb-5">
                <h2 class="section-title">Pilihan Layanan Pengiriman</h2>
                <p class="section-subtitle">Berbagai pilihan pengiriman sesuai kebutuhan dan budget Anda dengan jaminan keamanan terbaik</p>
            </div>
        </div>
        
        <div class="row g-4">
            <div class="col-lg-4 col-md-6">
                <div class="shipping-card">
                    <div class="shipping-icon">
                        <i class="fas fa-rocket"></i>
                    </div>
                    <h5 class="shipping-title">Same Day Delivery</h5>
                    <div class="shipping-price">Rp 15.000</div>
                    <div class="shipping-duration">4-8 Jam</div>
                    <ul class="shipping-features">
                        <li>Khusus area Jabodetabek</li>
                        <li>Pemesanan sebelum jam 14:00</li>
                        <li>Tracking real-time</li>
                        <li>Asuransi gratis hingga 1 juta</li>
                        <li>Customer service prioritas</li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="shipping-card">
                    <div class="shipping-icon">
                        <i class="fas fa-shipping-fast"></i>
                    </div>
                    <h5 class="shipping-title">Next Day Delivery</h5>
                    <div class="shipping-price">Rp 10.000</div>
                    <div class="shipping-duration">1-2 Hari</div>
                    <ul class="shipping-features">
                        <li>Area Jawa & Sumatera</li>
                        <li>Pickup & delivery harian</li>
                        <li>Notifikasi SMS & WhatsApp</li>
                        <li>Asuransi opsional</li>
                        <li>Resi tracking online</li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="shipping-card">
                    <div class="shipping-icon">
                        <i class="fas fa-truck"></i>
                    </div>
                    <h5 class="shipping-title">Regular Delivery</h5>
                    <div class="shipping-price">Rp 7.000</div>
                    <div class="shipping-duration">2-7 Hari</div>
                    <ul class="shipping-features">
                        <li>Seluruh Indonesia</li>
                        <li>Harga terjangkau</li>
                        <li>Pickup terjadwal</li>
                        <li>Tracking tersedia</li>
                        <li>COD available</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Coverage Area Section -->
<section class="coverage-area py-5 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center mb-5">
                <h2 class="section-title">Jangkauan Pengiriman</h2>
                <p class="section-subtitle">Melayani pengiriman ke seluruh Indonesia dengan pembagian zona berdasarkan waktu tempuh</p>
            </div>
        </div>
        
        <div class="row g-4">
            <div class="col-lg-3 col-md-6">
                <div class="zone-card">
                    <div class="zone-badge">ZONA 1</div>
                    <h6 class="zone-title">Jakarta & Sekitarnya</h6>
                    <div class="zone-cities">
                        Jakarta, Depok, Tangerang, Bekasi, Bogor, Tangerang Selatan
                    </div>
                    <div class="mt-3">
                        <small class="text-primary fw-bold">Same Day Available</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="zone-card">
                    <div class="zone-badge">ZONA 2</div>
                    <h6 class="zone-title">Jawa & Bali</h6>
                    <div class="zone-cities">
                        Bandung, Surabaya, Semarang, Yogyakarta, Solo, Malang, Denpasar, Cirebon
                    </div>
                    <div class="mt-3">
                        <small class="text-primary fw-bold">1-2 Hari</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="zone-card">
                    <div class="zone-badge">ZONA 3</div>
                    <h6 class="zone-title">Sumatera & Kalimantan</h6>
                    <div class="zone-cities">
                        Medan, Palembang, Pekanbaru, Padang, Pontianak, Balikpapan, Banjarmasin
                    </div>
                    <div class="mt-3">
                        <small class="text-primary fw-bold">2-4 Hari</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="zone-card">
                    <div class="zone-badge">ZONA 4</div>
                    <h6 class="zone-title">Sulawesi & Indonesia Timur</h6>
                    <div class="zone-cities">
                        Makassar, Manado, Palu, Ambon, Jayapura, Kupang, Mataram
                    </div>
                    <div class="mt-3">
                        <small class="text-primary fw-bold">3-7 Hari</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Tracking Process -->
<section class="tracking-process py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center mb-5">
                <h2 class="section-title">Proses Tracking Pengiriman</h2>
                <p class="section-subtitle">Pantau perjalanan paket Anda dari gudang hingga tiba di alamat tujuan dengan update real-time</p>
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="tracking-steps">
                    <div class="tracking-step">
                        <div class="step-icon">
                            <i class="fas fa-box"></i>
                        </div>
                        <div class="step-content">
                            <h6 class="step-title">Pesanan Dikemas</h6>
                            <p class="step-description">Tim warehouse mengemas pesanan Anda dengan bubble wrap dan kardus berkualitas untuk memastikan keamanan produk.</p>
                        </div>
                    </div>
                    
                    <div class="tracking-step">
                        <div class="step-icon">
                            <i class="fas fa-truck-pickup"></i>
                        </div>
                        <div class="step-content">
                            <h6 class="step-title">Pickup dari Gudang</h6>
                            <p class="step-description">Kurir ekspedisi mengambil paket dari gudang MyYOGYA dan melakukan scanning barcode untuk tracking.</p>
                        </div>
                    </div>
                    
                    <div class="tracking-step">
                        <div class="step-icon">
                            <i class="fas fa-warehouse"></i>
                        </div>
                        <div class="step-content">
                            <h6 class="step-title">Transit di Sorting Center</h6>
                            <p class="step-description">Paket diproses di pusat distribusi untuk disortir berdasarkan alamat tujuan dan diteruskan ke cabang terdekat.</p>
                        </div>
                    </div>
                    
                    <div class="tracking-step">
                        <div class="step-icon">
                            <i class="fas fa-shipping-fast"></i>
                        </div>
                        <div class="step-content">
                            <h6 class="step-title">Dalam Perjalanan</h6>
                            <p class="step-description">Paket dalam perjalanan menuju kota tujuan. Anda akan mendapat notifikasi ketika paket tiba di kota Anda.</p>
                        </div>
                    </div>
                    
                    <div class="tracking-step">
                        <div class="step-icon">
                            <i class="fas fa-home"></i>
                        </div>
                        <div class="step-content">
                            <h6 class="step-title">Siap Dikirim</h6>
                            <p class="step-description">Paket tiba di cabang terdekat dan siap dikirim ke alamat Anda. Kurir akan menghubungi sebelum pengiriman.</p>
                        </div>
                    </div>
                    
                    <div class="tracking-step">
                        <div class="step-icon">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <div class="step-content">
                            <h6 class="step-title">Paket Diterima</h6>
                            <p class="step-description">Paket berhasil diterima. Silakan konfirmasi penerimaan di aplikasi dan berikan review untuk produk.</p>
                        </div>
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
                    <h6>Syarat & Ketentuan Pengiriman</h6>
                    <p>Pastikan alamat pengiriman lengkap dan akurat. Untuk barang elektronik dan pecah belah, gunakan asuransi tambahan. Paket yang tidak dapat dikirim akan dikembalikan ke gudang.</p>
                </div>
                
                <div class="info-alert">
                    <div class="info-alert-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h6>Asuransi Pengiriman</h6>
                    <p>Asuransi gratis hingga Rp 1.000.000 untuk Same Day Delivery. Untuk nilai lebih tinggi, tersedia asuransi tambahan dengan premi 0.2% dari nilai barang (minimum Rp 5.000).</p>
                </div>
                
                <div class="info-alert">
                    <div class="info-alert-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <h6>Estimasi Pengiriman</h6>
                    <p>Waktu pengiriman dihitung dari hari kerja (Senin-Jumat). Pengiriman pada akhir pekan dan hari libur dapat mengalami keterlambatan. Force majeure dapat mempengaruhi jadwal.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Free Shipping Promo -->
<section class="promo-section py-5">
    <div class="container">
        <div class="promo-shipping">
            <div class="promo-content">
                <h3 class="mb-3 fw-bold">🎉 GRATIS ONGKIR SPECIAL! 🎉</h3>
                <p class="mb-4 lead">Dapatkan gratis ongkir ke seluruh Indonesia untuk pembelian minimal Rp 200.000</p>
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

</body>
</html>
