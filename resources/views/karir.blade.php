<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Karir - Bergabunglah dengan Tim MyYOGYA</title>
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
        /* Reset default margins and paddings */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        html, body {
            margin: 0 !important;
            padding: 0 !important;
            height: 100%;
            overflow-x: hidden;
        }

        /* Remove any top spacing */
        body {
            padding-top: 0 !important;
            margin-top: 0 !important;
        }

        /* Career Page Styles */
        .career-hero {
            margin-top: 0 !important;
            padding-top: 50px;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            padding: 50px 0 100px 0;
            position: relative;
            overflow: hidden;
        }

        .career-hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Ccircle cx='30' cy='30' r='2'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E") repeat;
        }

        .career-hero .container {
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

        .job-card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.1);
            transition: var(--transition);
            overflow: hidden;
            margin-bottom: 2rem;
        }

        .job-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 16px 48px rgba(0,0,0,0.15);
        }

        .job-header {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            padding: 1.5rem 2rem;
        }

        .job-title {
            font-size: 1.3rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .job-department {
            font-size: 0.9rem;
            opacity: 0.9;
            margin-bottom: 1rem;
        }

        .job-meta {
            display: flex;
            gap: 1rem;
            font-size: 0.85rem;
        }

        .job-meta span {
            background: rgba(255, 255, 255, 0.2);
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
        }

        .job-content {
            padding: 2rem;
        }

        .job-description {
            color: var(--gray-600);
            line-height: 1.6;
            margin-bottom: 1.5rem;
        }

        .requirements-list {
            list-style: none;
            padding: 0;
            margin-bottom: 1.5rem;
        }

        .requirements-list li {
            position: relative;
            padding-left: 1.5rem;
            margin-bottom: 0.5rem;
            color: var(--gray-600);
        }

        .requirements-list li::before {
            content: '✓';
            position: absolute;
            left: 0;
            color: var(--primary-color);
            font-weight: bold;
        }

        .apply-btn {
            background: var(--primary-color);
            color: white;
            border: none;
            padding: 0.75rem 2rem;
            border-radius: 50px;
            font-weight: 600;
            text-decoration: none;
            transition: var(--transition);
            display: inline-block;
        }

        .apply-btn:hover {
            background: var(--secondary-color);
            color: white;
            transform: translateY(-2px);
        }

        .benefit-card {
            background: white;
            padding: 2rem;
            border-radius: 16px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.1);
            text-align: center;
            height: 100%;
            transition: var(--transition);
        }

        .benefit-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 16px 48px rgba(0,0,0,0.15);
        }

        .benefit-icon {
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

        .benefit-title {
            font-weight: 600;
            margin-bottom: 1rem;
            color: var(--dark-color);
        }

        .benefit-description {
            color: var(--gray-600);
            line-height: 1.6;
            font-size: 0.9rem;
        }

        .process-card {
            background: white;
            padding: 2rem;
            border-radius: 16px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.1);
            text-align: center;
            height: 100%;
            transition: var(--transition);
            position: relative;
        }

        .process-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 16px 48px rgba(0,0,0,0.15);
        }

        .process-number {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            font-size: 1.5rem;
            font-weight: 700;
            color: white;
        }

        .process-title {
            font-weight: 600;
            margin-bottom: 1rem;
            color: var(--dark-color);
        }

        .process-description {
            color: var(--gray-600);
            line-height: 1.6;
            font-size: 0.9rem;
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

        .no-jobs {
            text-align: center;
            padding: 3rem;
            background: white;
            border-radius: 16px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.1);
        }

        .no-jobs-icon {
            font-size: 3rem;
            color: var(--gray-400);
            margin-bottom: 1rem;
        }

        .contact-hr {
            background: white;
            padding: 3rem;
            border-radius: 16px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.1);
            text-align: center;
        }

        .contact-hr h4 {
            color: var(--dark-color);
            margin-bottom: 1rem;
        }

        .contact-hr p {
            color: var(--gray-600);
            margin-bottom: 2rem;
        }

        .contact-buttons {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
        }

        /* Custom Contact Buttons */
        .contact-buttons .btn {
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

        .contact-buttons .btn-primary {
            background: rgba(242, 107, 55, 0.15);
            color: var(--primary-color);
            border: 2px solid rgba(242, 107, 55, 0.3);
            backdrop-filter: blur(10px);
        }

        .contact-buttons .btn-primary:hover {
            background: var(--primary-color);
            color: var(--white);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(242, 107, 55, 0.3);
            border-color: var(--primary-color);
        }

        .contact-buttons .btn-outline-primary {
            background: rgba(242, 107, 55, 0.1);
            color: var(--primary-color);
            border: 2px solid rgba(242, 107, 55, 0.25);
            backdrop-filter: blur(10px);
        }

        .contact-buttons .btn-outline-primary:hover {
            background: var(--primary-color);
            color: var(--white);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(242, 107, 55, 0.3);
            border-color: var(--primary-color);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .hero-stats {
                flex-direction: column;
                gap: 1rem;
            }
            
            .career-hero {
                padding: 60px 0;
            }
            
            .section-title {
                font-size: 2rem;
            }
            
            .job-meta {
                flex-direction: column;
                gap: 0.5rem;
            }
            
            .contact-buttons {
                flex-direction: column;
                align-items: center;
            }
        }
    </style>
</head>
<body>
<!-- Hero Section -->
<div class="career-hero">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="hero-content">
                    <nav class="breadcrumb-custom">
                        <a href="{{ route('dashboard') }}">
                            <i class="fas fa-home me-1"></i>Beranda
                        </a>
                        <span class="mx-2">/</span>
                        <span class="current">Karir</span>
                    </nav>
                    
                    <h1 class="display-4 fw-bold mb-4">Bergabunglah dengan <span style="color: #ffc107;">Tim MyYOGYA</span></h1>
                    <p class="lead mb-4">Wujudkan karir impian Anda bersama kami. Bergabunglah dengan tim profesional yang berdedikasi memberikan pelayanan terbaik untuk pelanggan di seluruh Indonesia.</p>
                    <div class="hero-stats">
                        <div class="stat-item">
                            <h3 class="stat-number">500+</h3>
                            <p class="stat-label">Karyawan</p>
                        </div>
                        <div class="stat-item">
                            <h3 class="stat-number">50+</h3>
                            <p class="stat-label">Cabang</p>
                        </div>
                        <div class="stat-item">
                            <h3 class="stat-number">10+</h3>
                            <p class="stat-label">Departemen</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="hero-image">
                    <img src="{{ asset('image/tim_kami/hehe.jpg') }}" alt="Karir di MyYOGYA" class="img-fluid rounded-4 shadow-lg">
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Mengapa Bekerja di MyYOGYA Section -->
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 mx-auto text-center mb-5">
                <h2 class="section-title">Mengapa Bekerja di MyYOGYA?</h2>
                <p class="section-subtitle">Kami menawarkan lingkungan kerja yang mendukung pengembangan karir dan kesejahteraan karyawan</p>
            </div>
        </div>
        <div class="row g-4">
            <div class="col-lg-4 col-md-6">
                <div class="value-card">
                    <div class="value-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <h5 class="value-title">Pengembangan Karir</h5>
                    <p class="value-description">Program pelatihan dan pengembangan yang komprehensif untuk mendukung pertumbuhan karir Anda.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="value-card">
                    <div class="value-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <h5 class="value-title">Tim yang Solid</h5>
                    <p class="value-description">Bekerja dengan tim profesional yang saling mendukung dan berkolaborasi untuk mencapai tujuan bersama.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="value-card">
                    <div class="value-icon">
                        <i class="fas fa-balance-scale"></i>
                    </div>
                    <h5 class="value-title">Work-Life Balance</h5>
                    <p class="value-description">Kami menghargai keseimbangan antara kehidupan kerja dan pribadi karyawan kami.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="value-card">
                    <div class="value-icon">
                        <i class="fas fa-rocket"></i>
                    </div>
                    <h5 class="value-title">Inovasi</h5>
                    <p class="value-description">Kesempatan untuk berkontribusi dalam inovasi teknologi dan pengembangan bisnis yang berkelanjutan.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="value-card">
                    <div class="value-icon">
                        <i class="fas fa-trophy"></i>
                    </div>
                    <h5 class="value-title">Prestasi</h5>
                    <p class="value-description">Sistem reward dan recognition yang adil untuk mengapresiasi kontribusi setiap karyawan.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="value-card">
                    <div class="value-icon">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    <h5 class="value-title">Pembelajaran</h5>
                    <p class="value-description">Budaya belajar yang kuat dengan akses ke berbagai pelatihan dan sertifikasi profesional.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Benefits Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 mx-auto text-center mb-5">
                <h2 class="section-title">Benefit & Fasilitas</h2>
                <p class="section-subtitle">Paket kompensasi dan fasilitas yang menarik untuk mendukung kesejahteraan karyawan</p>
            </div>
        </div>
        <div class="row g-4">
            <div class="col-lg-3 col-md-6">
                <div class="benefit-card">
                    <div class="benefit-icon">
                        <i class="fas fa-money-bill-wave"></i>
                    </div>
                    <h6 class="benefit-title">Gaji Kompetitif</h6>
                    <p class="benefit-description">Paket gaji yang kompetitif sesuai dengan standar industri dan pengalaman.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="benefit-card">
                    <div class="benefit-icon">
                        <i class="fas fa-heartbeat"></i>
                    </div>
                    <h6 class="benefit-title">BPJS & Asuransi</h6>
                    <p class="benefit-description">Perlindungan kesehatan BPJS dan asuransi kesehatan tambahan untuk keluarga.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="benefit-card">
                    <div class="benefit-icon">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                    <h6 class="benefit-title">Cuti Tahunan</h6>
                    <p class="benefit-description">Cuti tahunan yang fleksibel untuk menjaga keseimbangan hidup dan kerja.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="benefit-card">
                    <div class="benefit-icon">
                        <i class="fas fa-gift"></i>
                    </div>
                    <h6 class="benefit-title">THR & Bonus</h6>
                    <p class="benefit-description">Tunjangan Hari Raya dan bonus kinerja berdasarkan pencapaian target.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Lowongan Kerja Section -->
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 mx-auto text-center mb-5">
                <h2 class="section-title">Lowongan Kerja Terbuka</h2>
                <p class="section-subtitle">Temukan posisi yang sesuai dengan keahlian dan minat Anda</p>
            </div>
        </div>

        <!-- Job Listings -->
        <div class="row">
            <div class="col-lg-6">
                <div class="job-card">
                    <div class="job-header">
                        <h4 class="job-title">Frontend Developer</h4>
                        <p class="job-department">Teknologi Informasi</p>
                        <div class="job-meta">
                            <span><i class="fas fa-map-marker-alt me-1"></i>Jakarta</span>
                            <span><i class="fas fa-clock me-1"></i>Full Time</span>
                            <span><i class="fas fa-graduation-cap me-1"></i>S1</span>
                        </div>
                    </div>
                    <div class="job-content">
                        <p class="job-description">Mengembangkan dan memelihara antarmuka pengguna untuk platform e-commerce MyYOGYA dengan teknologi modern.</p>
                        <ul class="requirements-list">
                            <li>Minimal S1 Teknik Informatika/Sistem Informasi</li>
                            <li>Pengalaman min. 2 tahun dengan React.js/Vue.js</li>
                            <li>Menguasai HTML5, CSS3, JavaScript</li>
                            <li>Familiar dengan responsive design</li>
                            <li>Memahami version control (Git)</li>
                        </ul>
                        <a href="mailto:yogyatoserba@gmail.com?subject=Lamaran Frontend Developer" class="apply-btn">
                            <i class="fas fa-paper-plane me-2"></i>Lamar Sekarang
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="job-card">
                    <div class="job-header">
                        <h4 class="job-title">Digital Marketing Specialist</h4>
                        <p class="job-department">Marketing</p>
                        <div class="job-meta">
                            <span><i class="fas fa-map-marker-alt me-1"></i>Jakarta</span>
                            <span><i class="fas fa-clock me-1"></i>Full Time</span>
                            <span><i class="fas fa-graduation-cap me-1"></i>S1</span>
                        </div>
                    </div>
                    <div class="job-content">
                        <p class="job-description">Mengembangkan dan mengeksekusi strategi pemasaran digital untuk meningkatkan brand awareness dan penjualan.</p>
                        <ul class="requirements-list">
                            <li>Minimal S1 Marketing/Komunikasi</li>
                            <li>Pengalaman min. 2 tahun digital marketing</li>
                            <li>Menguasai Google Ads, Facebook Ads</li>
                            <li>Familiar dengan SEO/SEM</li>
                            <li>Kreatif dan analitis</li>
                            <li>Mampu bekerja dalam tim</li>
                        </ul>
                        <a href="mailto:yogyatoserba@gmail.com?subject=Lamaran Digital Marketing Specialist" class="apply-btn">
                            <i class="fas fa-paper-plane me-2"></i>Lamar Sekarang
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="job-card">
                    <div class="job-header">
                        <h4 class="job-title">Customer Service Representative</h4>
                        <p class="job-department">Customer Relations</p>
                        <div class="job-meta">
                            <span><i class="fas fa-map-marker-alt me-1"></i>Ciamis</span>
                            <span><i class="fas fa-clock me-1"></i>Full Time</span>
                            <span><i class="fas fa-graduation-cap me-1"></i>SMA/SMK</span>
                        </div>
                    </div>
                    <div class="job-content">
                        <p class="job-description">Memberikan layanan pelanggan terbaik melalui berbagai channel komunikasi untuk memastikan kepuasan pelanggan.</p>
                        <ul class="requirements-list">
                            <li>Minimal SMA/SMK sederajat</li>
                            <li>Komunikasi yang baik</li>
                            <li>Sabar dan ramah dalam melayani</li>
                            <li>Bisa bekerja shift</li>
                            <li>Pengalaman customer service diutamakan</li>
                        </ul>
                        <a href="mailto:yogyatoserba@gmail.com?subject=Lamaran Customer Service Representative" class="apply-btn">
                            <i class="fas fa-paper-plane me-2"></i>Lamar Sekarang
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="job-card">
                    <div class="job-header">
                        <h4 class="job-title">Warehouse Staff</h4>
                        <p class="job-department">Operasional</p>
                        <div class="job-meta">
                            <span><i class="fas fa-map-marker-alt me-1"></i>Ciamis</span>
                            <span><i class="fas fa-clock me-1"></i>Full Time</span>
                            <span><i class="fas fa-graduation-cap me-1"></i>SMA/SMK</span>
                        </div>
                    </div>
                    <div class="job-content">
                        <p class="job-description">Mengelola inventory dan proses packing/shipping produk untuk memastikan kelancaran operasional gudang.</p>
                        <ul class="requirements-list">
                            <li>Minimal SMA/SMK sederajat</li>
                            <li>Fisik yang kuat dan sehat</li>
                            <li>Teliti dan bertanggung jawab</li>
                            <li>Bisa bekerja tim</li>
                            <li>Pengalaman warehouse diutamakan</li>
                        </ul>
                        <a href="mailto:yogyatoserba@gmail.com?subject=Lamaran Warehouse Staff" class="apply-btn">
                            <i class="fas fa-paper-plane me-2"></i>Lamar Sekarang
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Proses Rekrutment Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 mx-auto text-center mb-5">
                <h2 class="section-title">Proses Rekrutmen</h2>
                <p class="section-subtitle">Ikuti langkah-langkah sederhana untuk bergabung dengan tim kami</p>
            </div>
        </div>
        <div class="row g-4">
            <div class="col-lg-3 col-md-6">
                <div class="process-card">
                    <div class="process-number">1</div>
                    <h6 class="process-title">Kirim Lamaran</h6>
                    <p class="process-description">Kirim CV dan surat lamaran ke email yang tertera atau melalui form online.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="process-card">
                    <div class="process-number">2</div>
                    <h6 class="process-title">Seleksi Administrasi</h6>
                    <p class="process-description">Tim HR akan melakukan review dokumen dan menyeleksi kandidat yang sesuai.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="process-card">
                    <div class="process-number">3</div>
                    <h6 class="process-title">Interview</h6>
                    <p class="process-description">Tahap wawancara dengan HR dan user untuk menilai kompetensi dan kultur fit.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="process-card">
                    <div class="process-number">4</div>
                    <h6 class="process-title">Bergabung</h6>
                    <p class="process-description">Selamat datang di keluarga besar MyYOGYA! Ikuti proses onboarding.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contact HR Section -->
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="contact-hr">
                    <h4>Tidak Menemukan Posisi yang Sesuai?</h4>
                    <p>Kirim CV Anda kepada kami. Kami akan menghubungi Anda ketika ada posisi yang sesuai dengan kualifikasi Anda.</p>
                    <div class="contact-buttons">
                        <a href="mailto:yogya.toserba@gmail.com?subject=Initiave Application" class="btn btn-primary me-3">
                            <i class="fas fa-envelope me-2"></i>yogya.toserba@gmail.com
                        </a>
                        <a href="tel:0851-8909-4514" class="btn btn-outline-primary">
                            <i class="fas fa-phone me-2"></i>0851-8909-4514
                        </a>
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
