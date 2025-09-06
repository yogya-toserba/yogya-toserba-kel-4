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

        .story-icon i {
            font-family: "Font Awesome 6 Free" !important;
            font-weight: 900 !important;
            -webkit-font-smoothing: antialiased;
            display: inline-block;
            font-style: normal;
            font-variant: normal;
            text-rendering: auto;
            line-height: 1;
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
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 10px 40px rgba(0,0,0,0.08);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            border: 1px solid rgba(0, 0, 0, 0.05);
        }

        .team-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            border-color: rgba(0, 0, 0, 0.1);
        }

        .team-image {
            position: relative;
            overflow: hidden;
            height: 320px; /* Increased height for portrait aspect ratio */
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
        }

        .team-image::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(0, 0, 0, 0.05), rgba(0, 0, 0, 0.02));
            opacity: 0;
            transition: opacity 0.3s ease;
            z-index: 1;
        }

        .team-card:hover .team-image::before {
            opacity: 1;
        }

        .team-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center top;
            transition: transform 0.4s ease;
            border-radius: 0;
        }

        .team-card:hover .team-image img {
            transform: scale(1.05);
        }

        /* Portrait photo frame effect */
        .team-image::after {
            content: '';
            position: absolute;
            top: 15px;
            left: 15px;
            right: 15px;
            bottom: 15px;
            border: 3px solid rgba(255, 255, 255, 0.8);
            border-radius: 16px;
            pointer-events: none;
            transition: all 0.3s ease;
            z-index: 2;
        }

        .team-card:hover .team-image::after {
            border-color: rgba(255, 255, 255, 0.9);
            top: 12px;
            left: 12px;
            right: 12px;
            bottom: 12px;
        }

        .team-info {
            padding: 2rem 1.5rem 1.5rem;
            text-align: center;
            background: white;
            position: relative;
        }

        .team-info::before {
            content: '';
            position: absolute;
            top: -1px;
            left: 0;
            right: 0;
            height: 2px;
            background: linear-gradient(90deg, transparent, rgba(0, 0, 0, 0.1), transparent);
        }

        .team-name {
            font-weight: 700;
            margin-bottom: 0.5rem;
            color: var(--dark-color);
            font-size: 1.1rem;
            letter-spacing: -0.02em;
        }

        .team-position {
            color: #666;
            font-size: 0.9rem;
            font-weight: 500;
            margin-bottom: 1.5rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .team-social {
            display: flex;
            justify-content: center;
            gap: 0.75rem;
        }

        .team-social a {
            width: 42px;
            height: 42px;
            background: rgba(0, 0, 0, 0.05);
            border: 2px solid rgba(0, 0, 0, 0.1);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #666;
            text-decoration: none;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            font-size: 1.1rem;
        }

        .team-social a:hover {
            background: #f8f9fa;
            color: #333;
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            border-color: rgba(0, 0, 0, 0.15);
        }

        .team-social a:nth-child(1):hover {
            background: #0077b5;
            color: white;
            border-color: #0077b5;
        }

        .team-social a:nth-child(2):hover {
            background: #333;
            color: white;
            border-color: #333;
        }

        .team-social a:nth-child(3):hover {
            background: #e4405f;
            color: white;
            border-color: #e4405f;
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

        /* Responsive Improvements */
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

            .team-image {
                height: 280px; /* Slightly smaller on mobile */
            }

            .team-info {
                padding: 1.5rem 1rem 1rem;
            }

            .team-name {
                font-size: 1rem;
            }

            .team-position {
                font-size: 0.85rem;
            }

            .team-social a {
                width: 38px;
                height: 38px;
                font-size: 1rem;
            }
        }

        /* Enhanced Section Styling */
        .team-section {
            background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 50%, #f8f9fa 100%);
            position: relative;
        }

        .team-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23f26b37' fill-opacity='0.02'%3E%3Ccircle cx='30' cy='30' r='1'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E") repeat;
        }

        .team-section .container {
            position: relative;
            z-index: 1;
        }

        /* Enhanced Grid Layout */
        .team-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 2rem;
            max-width: 1200px;
            margin: 0 auto;
        }

        /* Center the last item if it's alone */
        .team-grid .team-card:nth-child(7) {
            grid-column: 2;
        }

        @media (max-width: 992px) {
            .team-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 1.5rem;
            }
            
            .team-grid .team-card:nth-child(7) {
                grid-column: span 2;
                max-width: 350px;
                margin: 0 auto;
            }
        }

        @media (max-width: 768px) {
            .team-grid {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }
            
            .team-grid .team-card:nth-child(7) {
                grid-column: 1;
                max-width: 100%;
            }
        }

        /* Elegant Back to Top Button */
        .back-to-top {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            border: none;
            border-radius: 50%;
            cursor: pointer;
            opacity: 0;
            visibility: hidden;
            transform: translateY(20px);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 8px 32px rgba(242, 107, 55, 0.3);
            z-index: 1000;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            backdrop-filter: blur(10px);
            border: 2px solid rgba(255, 255, 255, 0.1);
        }

        .back-to-top.show {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .back-to-top:hover {
            transform: translateY(-5px) scale(1.1);
            box-shadow: 0 12px 40px rgba(242, 107, 55, 0.4);
            background: linear-gradient(135deg, var(--secondary-color), var(--primary-color));
        }

        .back-to-top:active {
            transform: translateY(-3px) scale(1.05);
        }

        /* Elegant arrow animation */
        .back-to-top i {
            transition: transform 0.3s ease;
        }

        .back-to-top:hover i {
            transform: translateY(-2px);
            animation: bounce 1s infinite;
        }

        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% {
                transform: translateY(-2px);
            }
            40% {
                transform: translateY(-6px);
            }
            60% {
                transform: translateY(-4px);
            }
        }

        /* Mobile responsive */
        @media (max-width: 768px) {
            .back-to-top {
                width: 50px;
                height: 50px;
                bottom: 20px;
                right: 20px;
                font-size: 18px;
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
                    
                    <h1 class="display-4 fw-bold mb-4">Tentang <span style="color: #ffc107;">MyYOGYA</span></h1>
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
                    <img src="{{ asset('image/tim_kami/hehe.jpg') }}" alt="YOGYA Group" class="img-fluid rounded-4 shadow-lg">
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
                        <i class="fas fa-users"></i>
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
<section class="achievements py-5 text-white" style="background-color: #ec6230;">
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
        
        <div class="team-grid">
            <div class="team-card">
                <div class="team-image">
                    <img src="{{ asset('image/tim_kami/haikal.jpg') }}" alt="Muhammad Fikri Haikal">
                </div>
                <div class="team-info">
                    <h5 class="team-name">Muhammad Fikri Haikal</h5>
                    <p class="team-position">Project Manager</p>
                    <div class="team-social">
                        <a href="#" title="LinkedIn" aria-label="LinkedIn Muhammad Fikri Haikal">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a href="#" title="Twitter" aria-label="Twitter Muhammad Fikri Haikal">
                            <i class="fab fa-twitter"></i>
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="team-card">
                <div class="team-image">
                    <img src="{{ asset('image/tim_kami/erfan.jpg') }}" alt="Erfan Eka Maulana">
                </div>
                <div class="team-info">
                    <h5 class="team-name">Erfan Eka Maulana</h5>
                    <p class="team-position">UI/UX Designer</p>
                    <div class="team-social">
                        <a href="#" title="LinkedIn" aria-label="LinkedIn Erfan Eka Maulana">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a href="#" title="GitHub" aria-label="GitHub Erfan Eka Maulana">
                            <i class="fab fa-github"></i>
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="team-card">
                <div class="team-image">
                    <img src="{{ asset('image/tim_kami/nabil.jpg') }}" alt="Nabil Cahyadi Abdillah">
                </div>
                <div class="team-info">
                    <h5 class="team-name">Nabil Cahyadi Abdillah</h5>
                    <p class="team-position">Backend Developer</p>
                    <div class="team-social">
                        <a href="#" title="LinkedIn" aria-label="LinkedIn Nabil Cahyadi Abdillah">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a href="#" title="Instagram" aria-label="Instagram Nabil Cahyadi Abdillah">
                            <i class="fab fa-instagram"></i>
                        </a>
                    </div> 
                </div>
            </div>
            
            <div class="team-card">
                <div class="team-image">
                    <img src="{{ asset('image/tim_kami/mahesa.jpg') }}" alt="Mahesa Putra Faturrohman">
                </div>
                <div class="team-info">
                    <h5 class="team-name">Mahesa Putra Faturrohman</h5>
                    <p class="team-position">Frontend Developer</p>
                    <div class="team-social">
                        <a href="#" title="LinkedIn" aria-label="LinkedIn Mahesa Putra Faturrohman">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a href="#" title="Twitter" aria-label="Twitter Mahesa Putra Faturrohman">
                            <i class="fab fa-twitter"></i>
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="team-card">
                <div class="team-image">
                    <img src="{{ asset('image/tim_kami/yazdi.jpg') }}" alt="Yazdi Prayogi Apriana">
                </div>
                <div class="team-info">
                    <h5 class="team-name">Yazdi Prayogi Apriana</h5>
                    <p class="team-position">Quality Assurance</p>
                    <div class="team-social">
                        <a href="#" title="LinkedIn" aria-label="LinkedIn Yazdi Prayogi Apriana">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a href="#" title="Twitter" aria-label="Twitter Yazdi Prayogi Apriana">
                            <i class="fab fa-twitter"></i>
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="team-card">
                <div class="team-image">
                    <img src="{{ asset('image/tim_kami/ikmal.jpg') }}" alt="Ikmal Suryana Putra">
                </div>
                <div class="team-info">
                    <h5 class="team-name">Ikmal Suryana Putra</h5>
                    <p class="team-position">Documentation Specialist</p>
                    <div class="team-social">
                        <a href="#" title="LinkedIn" aria-label="LinkedIn Ikmal Suryana Putra">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a href="#" title="GitHub" aria-label="GitHub Ikmal Suryana Putra">
                            <i class="fab fa-github"></i>
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="team-card">
                <div class="team-image">
                    <img src="{{ asset('image/tim_kami/vikri.jpg') }}" alt="Vikri Alva Pratama">
                </div>
                <div class="team-info">
                    <h5 class="team-name">Vikri Alva Pratama</h5>
                    <p class="team-position">Database Administrator</p>
                    <div class="team-social">
                        <a href="#" title="LinkedIn" aria-label="LinkedIn Vikri Alva Pratama">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a href="#" title="Instagram" aria-label="Instagram Vikri Alva Pratama">
                            <i class="fab fa-instagram"></i>
                        </a>
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
                    <a href="tel:0852-1551-4124" class="btn btn-outline-primary">
                        <i class="fas fa-phone me-2"></i>0852-1551-4124
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

<script>
// Elegant Back to Top Functionality
document.addEventListener('DOMContentLoaded', function() {
    const backToTopButton = document.getElementById('backToTop');
    
    // Show/hide button based on scroll position
    function toggleBackToTop() {
        if (window.pageYOffset > 300) {
            backToTopButton.classList.add('show');
        } else {
            backToTopButton.classList.remove('show');
        }
    }
    
    // Smooth scroll to top
    function scrollToTop() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    }
    
    // Event listeners for back to top
    window.addEventListener('scroll', toggleBackToTop);
    backToTopButton.addEventListener('click', scrollToTop);
    
    // Initial check
    toggleBackToTop();
});
</script>

<!-- Back to Top Button -->
<button class="back-to-top" id="backToTop" aria-label="Kembali ke atas">
    <i class="fas fa-chevron-up"></i>
</button>

</body>
</html>
