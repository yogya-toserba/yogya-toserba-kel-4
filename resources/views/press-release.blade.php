<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Press Release - Berita & Pengumuman MyYOGYA</title>
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
        /* Press Release Page Styles */
        .press-hero {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            padding: 100px 0;
            position: relative;
            overflow: hidden;
        }

        .press-hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Ccircle cx='30' cy='30' r='2'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E") repeat;
        }

        .press-hero .container {
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

        .press-card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.1);
            transition: var(--transition);
            overflow: hidden;
            margin-bottom: 2rem;
        }

        .press-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 16px 48px rgba(0,0,0,0.15);
        }

        .press-image {
            position: relative;
            overflow: hidden;
            height: 200px;
        }

        .press-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: var(--transition);
        }

        .press-card:hover .press-image img {
            transform: scale(1.05);
        }

        .press-badge {
            position: absolute;
            top: 1rem;
            left: 1rem;
            background: var(--primary-color);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .press-content {
            padding: 2rem;
        }

        .press-date {
            color: var(--gray-500);
            font-size: 0.85rem;
            margin-bottom: 0.5rem;
        }

        .press-category {
            color: var(--primary-color);
            font-size: 0.85rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .press-title {
            font-size: 1.3rem;
            font-weight: 600;
            color: var(--dark-color);
            margin-bottom: 1rem;
            line-height: 1.4;
        }

        .press-excerpt {
            color: var(--gray-600);
            line-height: 1.6;
            margin-bottom: 1.5rem;
        }

        .press-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 1rem;
            border-top: 1px solid var(--gray-200);
        }

        .press-author {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--gray-600);
            font-size: 0.85rem;
        }

        .read-more-btn {
            background: var(--primary-color);
            color: white;
            border: none;
            padding: 0.5rem 1.5rem;
            border-radius: 25px;
            font-size: 0.85rem;
            font-weight: 600;
            text-decoration: none;
            transition: var(--transition);
        }

        .read-more-btn:hover {
            background: var(--secondary-color);
            color: white;
            transform: translateY(-2px);
        }

        .featured-press {
            background: white;
            border-radius: 16px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.1);
            overflow: hidden;
            margin-bottom: 3rem;
        }

        .featured-image {
            position: relative;
            overflow: hidden;
            height: 300px;
        }

        .featured-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .featured-badge {
            position: absolute;
            top: 1.5rem;
            left: 1.5rem;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 25px;
            font-size: 0.9rem;
            font-weight: 700;
        }

        .featured-content {
            padding: 2.5rem;
        }

        .featured-title {
            font-size: 2rem;
            font-weight: 700;
            color: var(--dark-color);
            margin-bottom: 1rem;
            line-height: 1.3;
        }

        .featured-excerpt {
            font-size: 1.1rem;
            color: var(--gray-600);
            line-height: 1.6;
            margin-bottom: 2rem;
        }

        .filter-tabs {
            display: flex;
            gap: 1rem;
            margin-bottom: 2rem;
            flex-wrap: wrap;
        }

        .filter-tab {
            background: transparent;
            border: 2px solid var(--gray-300);
            color: var(--gray-600);
            padding: 0.75rem 1.5rem;
            border-radius: 25px;
            font-weight: 600;
            text-decoration: none;
            transition: var(--transition);
        }

        .filter-tab:hover,
        .filter-tab.active {
            background: var(--primary-color);
            border-color: var(--primary-color);
            color: white;
        }

        .newsletter-signup {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            padding: 3rem;
            border-radius: 16px;
            text-align: center;
            margin-bottom: 3rem;
        }

        .newsletter-title {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .newsletter-subtitle {
            opacity: 0.9;
            margin-bottom: 2rem;
        }

        .newsletter-form {
            display: flex;
            max-width: 400px;
            margin: 0 auto;
            gap: 1rem;
        }

        .newsletter-input {
            flex: 1;
            padding: 0.75rem 1rem;
            border: none;
            border-radius: 25px;
            font-size: 0.9rem;
        }

        .newsletter-btn {
            background: white;
            color: var(--primary-color);
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 25px;
            font-weight: 600;
            transition: var(--transition);
        }

        .newsletter-btn:hover {
            background: var(--gray-100);
            transform: translateY(-2px);
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

        .archive-card {
            background: white;
            padding: 1.5rem;
            border-radius: 12px;
            box-shadow: 0 4px 16px rgba(0,0,0,0.1);
            transition: var(--transition);
        }

        .archive-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 24px rgba(0,0,0,0.15);
        }

        .archive-year {
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 1rem;
        }

        .archive-count {
            color: var(--gray-600);
            font-size: 0.9rem;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .hero-stats {
                flex-direction: column;
                gap: 1rem;
            }
            
            .press-hero {
                padding: 60px 0;
            }
            
            .section-title {
                font-size: 2rem;
            }
            
            .featured-title {
                font-size: 1.5rem;
            }
            
            .newsletter-form {
                flex-direction: column;
            }
            
            .filter-tabs {
                justify-content: center;
            }
        }
    </style>
</head>
<body>
<!-- Hero Section -->
<div class="press-hero">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="hero-content">
                    <nav class="breadcrumb-custom">
                        <a href="{{ route('dashboard') }}">
                            <i class="fas fa-home me-1"></i>Beranda
                        </a>
                        <span class="mx-2">/</span>
                        <span class="current">Press Release</span>
                    </nav>
                    
                    <h1 class="display-4 fw-bold mb-4">Press Release <span class="text-primary">MyYOGYA</span></h1>
                    <p class="lead mb-4">Dapatkan informasi terkini tentang perkembangan, pencapaian, dan inovasi terbaru MyYOGYA dalam melayani pelanggan di seluruh Indonesia.</p>
                    <div class="hero-stats">
                        <div class="stat-item">
                            <h3 class="stat-number">50+</h3>
                            <p class="stat-label">Press Release</p>
                        </div>
                        <div class="stat-item">
                            <h3 class="stat-number">100+</h3>
                            <p class="stat-label">Media Coverage</p>
                        </div>
                        <div class="stat-item">
                            <h3 class="stat-number">25+</h3>
                            <p class="stat-label">Penghargaan</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="hero-image">
                    <img src="{{ asset('image/placeholder.png') }}" alt="Press Release MyYOGYA" class="img-fluid rounded-4 shadow-lg">
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Featured Press Release -->
<section class="py-5">
    <div class="container">
        <div class="featured-press">
            <div class="row g-0">
                <div class="col-lg-6">
                    <div class="featured-image">
                        <img src="{{ asset('image/placeholder.png') }}" alt="Featured Press Release">
                        <div class="featured-badge">
                            <i class="fas fa-star me-2"></i>Featured
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="featured-content">
                        <div class="press-date mb-2">
                            <i class="fas fa-calendar-alt me-2"></i>25 Agustus 2025
                        </div>
                        <div class="press-category mb-3">PENGUMUMAN RESMI</div>
                        <h2 class="featured-title">MyYOGYA Raih Penghargaan "Best E-Commerce Platform 2025"</h2>
                        <p class="featured-excerpt">MyYOGYA dengan bangga mengumumkan pencapaian penghargaan bergengsi "Best E-Commerce Platform 2025" dari Indonesia Digital Awards. Penghargaan ini merupakan pengakuan atas komitmen kami dalam memberikan layanan terbaik dan inovasi berkelanjutan.</p>
                        <a href="#" class="read-more-btn">
                            <i class="fas fa-arrow-right me-2"></i>Baca Selengkapnya
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Filter Tabs -->
<section class="py-3">
    <div class="container">
        <div class="filter-tabs justify-content-center">
            <a href="#" class="filter-tab active">Semua</a>
            <a href="#" class="filter-tab">Pengumuman</a>
            <a href="#" class="filter-tab">Penghargaan</a>
            <a href="#" class="filter-tab">Ekspansi</a>
            <a href="#" class="filter-tab">Kemitraan</a>
            <a href="#" class="filter-tab">CSR</a>
        </div>
    </div>
</section>

<!-- Press Release List -->
<section class="pb-5">
    <div class="container">
        <div class="row g-4">
            <!-- Press Release 1 -->
            <div class="col-lg-4 col-md-6">
                <div class="press-card">
                    <div class="press-image">
                        <img src="{{ asset('image/placeholder.png') }}" alt="Press Release">
                        <div class="press-badge">EKSPANSI</div>
                    </div>
                    <div class="press-content">
                        <div class="press-date">20 Agustus 2025</div>
                        <div class="press-category">PENGEMBANGAN BISNIS</div>
                        <h4 class="press-title">MyYOGYA Buka 5 Cabang Baru di Jawa Barat</h4>
                        <p class="press-excerpt">Dalam rangka memperluas jangkauan layanan, MyYOGYA resmi membuka 5 cabang baru yang tersebar di kota-kota strategis di Jawa Barat...</p>
                        <div class="press-meta">
                            <div class="press-author">
                                <i class="fas fa-user-circle"></i>
                                <span>Tim Redaksi</span>
                            </div>
                            <a href="#" class="read-more-btn">Baca</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Press Release 2 -->
            <div class="col-lg-4 col-md-6">
                <div class="press-card">
                    <div class="press-image">
                        <img src="{{ asset('image/placeholder.png') }}" alt="Press Release">
                        <div class="press-badge">KEMITRAAN</div>
                    </div>
                    <div class="press-content">
                        <div class="press-date">15 Agustus 2025</div>
                        <div class="press-category">KOLABORASI STRATEGIS</div>
                        <h4 class="press-title">Kerja Sama Strategis dengan Bank Digital Terkemuka</h4>
                        <p class="press-excerpt">MyYOGYA menjalin kemitraan strategis dengan bank digital terkemuka untuk menghadirkan solusi pembayaran yang lebih mudah dan aman...</p>
                        <div class="press-meta">
                            <div class="press-author">
                                <i class="fas fa-user-circle"></i>
                                <span>Tim Redaksi</span>
                            </div>
                            <a href="#" class="read-more-btn">Baca</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Press Release 3 -->
            <div class="col-lg-4 col-md-6">
                <div class="press-card">
                    <div class="press-image">
                        <img src="{{ asset('image/placeholder.png') }}" alt="Press Release">
                        <div class="press-badge">CSR</div>
                    </div>
                    <div class="press-content">
                        <div class="press-date">10 Agustus 2025</div>
                        <div class="press-category">TANGGUNG JAWAB SOSIAL</div>
                        <h4 class="press-title">Program "MyYOGYA Peduli Pendidikan" Capai 1000 Siswa</h4>
                        <p class="press-excerpt">Program beasiswa pendidikan MyYOGYA telah berhasil membantu 1000 siswa berprestasi dari keluarga kurang mampu untuk melanjutkan pendidikan...</p>
                        <div class="press-meta">
                            <div class="press-author">
                                <i class="fas fa-user-circle"></i>
                                <span>Tim Redaksi</span>
                            </div>
                            <a href="#" class="read-more-btn">Baca</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Press Release 4 -->
            <div class="col-lg-4 col-md-6">
                <div class="press-card">
                    <div class="press-image">
                        <img src="{{ asset('image/placeholder.png') }}" alt="Press Release">
                        <div class="press-badge">PENGHARGAAN</div>
                    </div>
                    <div class="press-content">
                        <div class="press-date">5 Agustus 2025</div>
                        <div class="press-category">PRESTASI</div>
                        <h4 class="press-title">MyYOGYA Raih Top Brand Award 2025</h4>
                        <p class="press-excerpt">Untuk kelima kalinya berturut-turut, MyYOGYA meraih penghargaan Top Brand Award kategori E-Commerce berdasarkan survei kepuasan konsumen...</p>
                        <div class="press-meta">
                            <div class="press-author">
                                <i class="fas fa-user-circle"></i>
                                <span>Tim Redaksi</span>
                            </div>
                            <a href="#" class="read-more-btn">Baca</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Press Release 5 -->
            <div class="col-lg-4 col-md-6">
                <div class="press-card">
                    <div class="press-image">
                        <img src="{{ asset('image/placeholder.png') }}" alt="Press Release">
                        <div class="press-badge">INOVASI</div>
                    </div>
                    <div class="press-content">
                        <div class="press-date">1 Agustus 2025</div>
                        <div class="press-category">TEKNOLOGI</div>
                        <h4 class="press-title">Peluncuran Fitur AI Shopping Assistant</h4>
                        <p class="press-excerpt">MyYOGYA menghadirkan inovasi terbaru berupa AI Shopping Assistant yang membantu pelanggan menemukan produk sesuai kebutuhan dengan lebih mudah...</p>
                        <div class="press-meta">
                            <div class="press-author">
                                <i class="fas fa-user-circle"></i>
                                <span>Tim Redaksi</span>
                            </div>
                            <a href="#" class="read-more-btn">Baca</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Press Release 6 -->
            <div class="col-lg-4 col-md-6">
                <div class="press-card">
                    <div class="press-image">
                        <img src="{{ asset('image/placeholder.png') }}" alt="Press Release">
                        <div class="press-badge">PENGUMUMAN</div>
                    </div>
                    <div class="press-content">
                        <div class="press-date">28 Juli 2025</div>
                        <div class="press-category">LAYANAN BARU</div>
                        <h4 class="press-title">Layanan Same Day Delivery Kini Tersedia di 10 Kota</h4>
                        <p class="press-excerpt">Merespons kebutuhan pelanggan akan pengiriman cepat, MyYOGYA meluncurkan layanan Same Day Delivery yang kini tersedia di 10 kota besar...</p>
                        <div class="press-meta">
                            <div class="press-author">
                                <i class="fas fa-user-circle"></i>
                                <span>Tim Redaksi</span>
                            </div>
                            <a href="#" class="read-more-btn">Baca</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Load More Button -->
        <div class="text-center mt-5">
            <button class="btn btn-outline-primary btn-lg px-5">
                <i class="fas fa-plus me-2"></i>Muat Lebih Banyak
            </button>
        </div>
    </div>
</section>

<!-- Archive Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 mx-auto text-center mb-5">
                <h2 class="section-title">Arsip Press Release</h2>
                <p class="section-subtitle">Jelajahi arsip berita dan pengumuman MyYOGYA dari tahun-tahun sebelumnya</p>
            </div>
        </div>
        <div class="row g-4">
            <div class="col-lg-3 col-md-6">
                <div class="archive-card">
                    <div class="archive-year">2025</div>
                    <div class="archive-count">25 Press Release</div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="archive-card">
                    <div class="archive-year">2024</div>
                    <div class="archive-count">32 Press Release</div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="archive-card">
                    <div class="archive-year">2023</div>
                    <div class="archive-count">28 Press Release</div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="archive-card">
                    <div class="archive-year">2022</div>
                    <div class="archive-count">24 Press Release</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Newsletter Signup -->
<section class="py-5">
    <div class="container">
        <div class="newsletter-signup">
            <h3 class="newsletter-title">Dapatkan Update Terbaru</h3>
            <p class="newsletter-subtitle">Berlangganan newsletter kami untuk mendapatkan press release dan berita terbaru langsung di email Anda</p>
            <form class="newsletter-form">
                <input type="email" class="newsletter-input" placeholder="Masukkan email Anda" required>
                <button type="submit" class="newsletter-btn">
                    <i class="fas fa-paper-plane me-2"></i>Berlangganan
                </button>
            </form>
        </div>
    </div>
</section>

<!-- Contact Media Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center">
                <h3 class="mb-4">Kontak Media</h3>
                <p class="mb-4">Untuk pertanyaan media, wawancara, atau informasi lebih lanjut, silakan hubungi tim Public Relations kami</p>
                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="contact-item">
                            <h5><i class="fas fa-envelope me-2 text-primary"></i>Email</h5>
                            <p>media@myyogya.com</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="contact-item">
                            <h5><i class="fas fa-phone me-2 text-primary"></i>Telepon</h5>
                            <p>(0265) 777-779 ext. 123</p>
                        </div>
                    </div>
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
// Newsletter Form Submission
document.querySelector('.newsletter-form').addEventListener('submit', function(e) {
    e.preventDefault();
    const email = this.querySelector('input[type="email"]').value;
    alert('Terima kasih! Anda telah berlangganan newsletter MyYOGYA dengan email: ' + email);
    this.querySelector('input[type="email"]').value = '';
});

// Filter Tabs Functionality
document.querySelectorAll('.filter-tab').forEach(tab => {
    tab.addEventListener('click', function(e) {
        e.preventDefault();
        
        // Remove active class from all tabs
        document.querySelectorAll('.filter-tab').forEach(t => t.classList.remove('active'));
        
        // Add active class to clicked tab
        this.classList.add('active');
        
        // Here you would typically filter the press releases
        // For demo purposes, we'll just show an alert
        const category = this.textContent.trim();
        console.log('Filtering by category:', category);
    });
});
</script>
</body>
</html>
