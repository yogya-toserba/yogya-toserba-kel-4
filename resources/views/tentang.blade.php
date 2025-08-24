<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang MyYOGYA - Platform Belanja Online Terpercaya</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
    
    <style>
        /* About Page Styles */
        .about-hero {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            padding: 100px 0;
            position: relative;
            overflow: hidden;
        }

        .about-hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Ccircle cx='30' cy='30' r='2'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E") repeat;
        }

        .about-hero .container {
            position: relative;
            z-index: 1;
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

        .story-card {
            background: white;
            padding: 2rem;
            border-radius: 16px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.1);
            text-align: center;
            height: 100%;
            transition: var(--transition);
        }

        .story-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 16px 48px rgba(0,0,0,0.15);
        }

        .story-icon {
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
        }

        .story-title {
            font-weight: 600;
            margin-bottom: 1rem;
            color: var(--dark-color);
        }

        .story-description {
            color: var(--gray-600);
            line-height: 1.6;
        }

        .vm-card {
            background: white;
            padding: 2.5rem;
            border-radius: 16px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.1);
            height: 100%;
        }

        .vm-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.5rem;
            font-size: 1.5rem;
            color: white;
        }

        .vm-title {
            font-weight: 600;
            margin-bottom: 1rem;
            color: var(--dark-color);
        }

        .vm-description {
            color: var(--gray-600);
            line-height: 1.6;
            margin: 0;
        }

        .mission-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .mission-list li {
            padding: 0.5rem 0;
            position: relative;
            padding-left: 1.5rem;
            color: var(--gray-600);
        }

        .mission-list li::before {
            content: '✓';
            position: absolute;
            left: 0;
            color: var(--primary-color);
            font-weight: bold;
        }

        .value-card {
            background: white;
            padding: 2rem;
            border-radius: 16px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.1);
            text-align: center;
            height: 100%;
            transition: var(--transition);
        }

        .value-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 16px 48px rgba(0,0,0,0.15);
        }

        .value-icon {
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

        .value-title {
            font-weight: 600;
            margin-bottom: 1rem;
            color: var(--dark-color);
        }

        .value-description {
            color: var(--gray-600);
            line-height: 1.6;
            font-size: 0.9rem;
        }

        .achievement-item {
            padding: 1rem;
        }

        .achievement-number {
            font-size: 3rem;
            font-weight: 800;
            margin-bottom: 0.5rem;
        }

        .achievement-label {
            font-size: 1rem;
            opacity: 0.9;
        }

        .team-card {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 8px 32px rgba(0,0,0,0.1);
            transition: var(--transition);
        }

        .team-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 16px 48px rgba(0,0,0,0.15);
        }

        .team-image {
            position: relative;
            overflow: hidden;
            height: 200px;
        }

        .team-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .team-info {
            padding: 1.5rem;
            text-align: center;
        }

        .team-name {
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: var(--dark-color);
            font-size: 1rem;
        }

        .team-position {
            color: var(--gray-600);
            font-size: 0.85rem;
            margin-bottom: 1rem;
        }

        .team-social {
            display: flex;
            justify-content: center;
            gap: 0.5rem;
        }

        .team-social a {
            width: 36px;
            height: 36px;
            background: var(--gray-100);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--gray-600);
            text-decoration: none;
            transition: var(--transition);
        }

        .team-social a:hover {
            background: var(--primary-color);
            color: white;
        }

        .contact-buttons {
            margin-top: 2rem;
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

        /* Responsive */
        @media (max-width: 768px) {
            .hero-stats {
                flex-direction: column;
                gap: 1rem;
            }
            
            .about-hero {
                padding: 60px 0;
            }
            
            .section-title {
                font-size: 2rem;
            }
            
            .achievement-number {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>
<!-- Hero Section -->
<div class="about-hero">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="hero-content">
                    <nav class="breadcrumb-custom">
                        <a href="{{ route('dashboard') }}">
                            <i class="fas fa-home me-1"></i>Beranda
                        </a>
                        <span class="mx-2">/</span>
                        <span class="current">Tentang MyYOGYA</span>
                    </nav>
                    
                    <h1 class="display-4 fw-bold mb-4">Tentang <span class="text-primary">MyYOGYA</span></h1>
                    <p class="lead mb-4">Platform belanja online terpercaya #1 di Indonesia dengan komitmen memberikan pengalaman berbelanja terbaik untuk seluruh keluarga Indonesia.</p>
                    <div class="hero-stats">
                        <div class="stat-item">
                            <h3 class="stat-number">10+</h3>
                            <p class="stat-label">Tahun Pengalaman</p>
                        </div>
                        <div class="stat-item">
                            <h3 class="stat-number">1M+</h3>
                            <p class="stat-label">Pelanggan Setia</p>
                        </div>
                        <div class="stat-item">
                            <h3 class="stat-number">50K+</h3>
                            <p class="stat-label">Produk Berkualitas</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="hero-image">
                    <img src="{{ asset('image/placeholder.png') }}" alt="YOGYA Group" class="img-fluid rounded-4 shadow-lg">
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Story Section -->
<section class="about-story py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center">
                <h2 class="section-title mb-4">Cerita Kami</h2>
                <p class="section-subtitle mb-5">Perjalanan MyYOGYA dimulai dari visi sederhana: memberikan akses mudah dan terpercaya untuk kebutuhan sehari-hari keluarga Indonesia.</p>
            </div>
        </div>
        
        <div class="row g-4">
            <div class="col-lg-4">
                <div class="story-card">
                    <div class="story-icon">
                        <i class="fas fa-store"></i>
                    </div>
                    <h5 class="story-title">Dimulai dari Toserba</h5>
                    <p class="story-description">YOGYA Group memulai perjalanan sebagai toserba tradisional yang melayani masyarakat Ciamis dan sekitarnya sejak puluhan tahun lalu.</p>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="story-card">
                    <div class="story-icon">
                        <i class="fas fa-laptop"></i>
                    </div>
                    <h5 class="story-title">Transformasi Digital</h5>
                    <p class="story-description">Memasuki era digital, kami bertransformasi menjadi platform e-commerce untuk menjangkau lebih banyak keluarga Indonesia.</p>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="story-card">
                    <div class="story-icon">
                        <i class="fas fa-heart"></i>
                    </div>
                    <h5 class="story-title">Melayani dengan Hati</h5>
                    <p class="story-description">Hingga kini, komitmen kami tetap sama: melayani dengan sepenuh hati dan memberikan yang terbaik untuk setiap pelanggan.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Vision Mission Section -->
<section class="vision-mission py-5 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 mb-4">
                <div class="vm-card vision-card">
                    <div class="vm-icon">
                        <i class="fas fa-eye"></i>
                    </div>
                    <h3 class="vm-title">Visi Kami</h3>
                    <p class="vm-description">Menjadi platform belanja online terdepan dan terpercaya di Indonesia yang memberikan kemudahan akses terhadap produk berkualitas untuk seluruh keluarga Indonesia.</p>
                </div>
            </div>
            <div class="col-lg-6 mb-4">
                <div class="vm-card mission-card">
                    <div class="vm-icon">
                        <i class="fas fa-rocket"></i>
                    </div>
                    <h3 class="vm-title">Misi Kami</h3>
                    <ul class="mission-list">
                        <li>Menyediakan produk berkualitas dengan harga terjangkau</li>
                        <li>Memberikan pelayanan pelanggan terbaik dan responsif</li>
                        <li>Membangun ekosistem belanja yang aman dan terpercaya</li>
                        <li>Mendukung pertumbuhan ekonomi digital Indonesia</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Values Section -->
<section class="company-values py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center mb-5">
                <h2 class="section-title">Nilai-Nilai Kami</h2>
                <p class="section-subtitle">Nilai-nilai yang menjadi fondasi dalam setiap langkah perjalanan MyYOGYA</p>
            </div>
        </div>
        
        <div class="row g-4">
            <div class="col-lg-3 col-md-6">
                <div class="value-card">
                    <div class="value-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h5 class="value-title">Kepercayaan</h5>
                    <p class="value-description">Membangun kepercayaan melalui transparansi, keamanan, dan konsistensi dalam pelayanan.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="value-card">
                    <div class="value-icon">
                        <i class="fas fa-gem"></i>
                    </div>
                    <h5 class="value-title">Kualitas</h5>
                    <p class="value-description">Berkomitmen menyediakan produk berkualitas tinggi dari brand-brand terpercaya.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="value-card">
                    <div class="value-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <h5 class="value-title">Pelayanan</h5>
                    <p class="value-description">Mengutamakan kepuasan pelanggan dengan pelayanan yang ramah dan profesional.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="value-card">
                    <div class="value-icon">
                        <i class="fas fa-lightbulb"></i>
                    </div>
                    <h5 class="value-title">Inovasi</h5>
                    <p class="value-description">Terus berinovasi untuk memberikan pengalaman berbelanja yang lebih baik.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Achievements Section -->
<section class="achievements py-5 bg-primary text-white">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center mb-5">
                <h2 class="section-title text-white">Pencapaian Kami</h2>
                <p class="section-subtitle text-white opacity-75">Beberapa milestone penting dalam perjalanan MyYOGYA</p>
            </div>
        </div>
        
        <div class="row g-4">
            <div class="col-lg-3 col-md-6 text-center">
                <div class="achievement-item">
                    <div class="achievement-number">1M+</div>
                    <div class="achievement-label">Pelanggan Aktif</div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 text-center">
                <div class="achievement-item">
                    <div class="achievement-number">50K+</div>
                    <div class="achievement-label">Produk Tersedia</div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 text-center">
                <div class="achievement-item">
                    <div class="achievement-number">500+</div>
                    <div class="achievement-label">Brand Partner</div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 text-center">
                <div class="achievement-item">
                    <div class="achievement-number">100+</div>
                    <div class="achievement-label">Kota Terjangkau</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Team Section -->
<section class="team-section py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center mb-5">
                <h2 class="section-title">Tim Kami</h2>
                <p class="section-subtitle">Orang-orang hebat di balik kesuksesan MyYOGYA</p>
            </div>
        </div>
        
        <div class="row g-4">
            <div class="col-lg-4 col-md-6">
                <div class="team-card">
                    <div class="team-image">
                        <img src="{{ asset('image/placeholder.png') }}" alt="Muhammad Fikri Haikal" class="img-fluid">
                    </div>
                    <div class="team-info">
                        <h5 class="team-name">Muhammad Fikri Haikal</h5>
                        <p class="team-position">Chief Executive Officer</p>
                        <div class="team-social">
                            <a href="#"><i class="fab fa-linkedin-in"></i></a>
                            <a href="#"><i class="fab fa-twitter"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="team-card">
                    <div class="team-image">
                        <img src="{{ asset('image/placeholder.png') }}" alt="Erfan Eka Maulana" class="img-fluid">
                    </div>
                    <div class="team-info">
                        <h5 class="team-name">Erfan Eka Maulana</h5>
                        <p class="team-position">Chief Technology Officer</p>
                        <div class="team-social">
                            <a href="#"><i class="fab fa-linkedin-in"></i></a>
                            <a href="#"><i class="fab fa-github"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="team-card">
                    <div class="team-image">
                        <img src="{{ asset('image/placeholder.png') }}" alt="Nabil Cahyadi Abdillah" class="img-fluid">
                    </div>
                    <div class="team-info">
                        <h5 class="team-name">Nabil Cahyadi Abdillah</h5>
                        <p class="team-position">Chief Marketing Officer</p>
                        <div class="team-social">
                            <a href="#"><i class="fab fa-linkedin-in"></i></a>
                            <a href="#"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="team-card">
                    <div class="team-image">
                        <img src="{{ asset('image/placeholder.png') }}" alt="Mahesa Putra Faturrohman" class="img-fluid">
                    </div>
                    <div class="team-info">
                        <h5 class="team-name">Mahesa Putra Faturrohman</h5>
                        <p class="team-position">Chief Operating Officer</p>
                        <div class="team-social">
                            <a href="#"><i class="fab fa-linkedin-in"></i></a>
                            <a href="#"><i class="fab fa-twitter"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="team-card">
                    <div class="team-image">
                        <img src="{{ asset('image/placeholder.png') }}" alt="Yazdi Prayogi Aprianal" class="img-fluid">
                    </div>
                    <div class="team-info">
                        <h5 class="team-name">Yazdi Prayogi Aprianal</h5>
                        <p class="team-position">Chief Financial Officer</p>
                        <div class="team-social">
                            <a href="#"><i class="fab fa-linkedin-in"></i></a>
                            <a href="#"><i class="fab fa-twitter"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="team-card">
                    <div class="team-image">
                        <img src="{{ asset('image/placeholder.png') }}" alt="Ikmal Suryana Putra" class="img-fluid">
                    </div>
                    <div class="team-info">
                        <h5 class="team-name">Ikmal Suryana Putra</h5>
                        <p class="team-position">Head of Product Development</p>
                        <div class="team-social">
                            <a href="#"><i class="fab fa-linkedin-in"></i></a>
                            <a href="#"><i class="fab fa-github"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="team-card">
                    <div class="team-image">
                        <img src="{{ asset('image/placeholder.png') }}" alt="Vikri Alva Pratama" class="img-fluid">
                    </div>
                    <div class="team-info">
                        <h5 class="team-name">Vikri Alva Pratama</h5>
                        <p class="team-position">Head of Customer Relations</p>
                        <div class="team-social">
                            <a href="#"><i class="fab fa-linkedin-in"></i></a>
                            <a href="#"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contact CTA Section -->
<section class="contact-cta py-5 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center">
                <h2 class="section-title mb-4">Mari Berkenalan Lebih Dekat</h2>
                <p class="section-subtitle mb-4">Punya pertanyaan atau ingin bekerjasama dengan kami? Jangan ragu untuk menghubungi tim MyYOGYA.</p>
                <div class="contact-buttons">
                    <a href="mailto:info@myyogya.com" class="btn btn-primary me-3">
                        <i class="fas fa-envelope me-2"></i>Hubungi Kami
                    </a>
                    <a href="tel:0800-1-500-500" class="btn btn-outline-primary">
                        <i class="fas fa-phone me-2"></i>0800-1-500-500
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
                    <li><a href="#">Karir</a></li>
                    <li><a href="#">Press Release</a></li>
                    <li><a href="#">Investor Relations</a></li>
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
                    <li><a href="#">Hak Kekayaan Intelektual</a></li>
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
