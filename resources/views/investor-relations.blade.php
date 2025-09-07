<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Investor Relations - Informasi Investasi MyYOGYA</title>
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
        /* Investor Relations Page Styles */
        .investor-hero {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            padding: 100px 0;
            position: relative;
            overflow: hidden;
        }

        .investor-hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Ccircle cx='30' cy='30' r='2'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E") repeat;
        }

        .investor-hero .container {
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

        .financial-card {
            background: white;
            padding: 2rem;
            border-radius: 16px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.1);
            text-align: center;
            height: 100%;
            transition: var(--transition);
        }

        .financial-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 16px 48px rgba(0,0,0,0.15);
        }

        .financial-icon {
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

        .financial-title {
            font-weight: 600;
            margin-bottom: 1rem;
            color: var(--dark-color);
        }

        .financial-value {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 0.5rem;
        }

        .financial-description {
            color: var(--gray-600);
            line-height: 1.6;
            font-size: 0.9rem;
        }

        .report-card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.1);
            transition: var(--transition);
            overflow: hidden;
            margin-bottom: 2rem;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .report-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 16px 48px rgba(0,0,0,0.15);
        }

        .report-header {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            padding: 1.5rem 2rem;
        }

        .report-title {
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .report-period {
            font-size: 0.9rem;
            opacity: 0.9;
            margin-bottom: 1rem;
        }

        .report-meta {
            display: flex;
            gap: 1rem;
            font-size: 0.85rem;
        }

        .report-meta span {
            background: rgba(255, 255, 255, 0.2);
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
        }

        .report-content {
            padding: 2rem;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .report-description {
            color: var(--gray-600);
            line-height: 1.6;
            margin-bottom: 1.5rem;
            flex: 1;
        }

        .report-highlights {
            list-style: none;
            padding: 0;
            margin-bottom: 1.5rem;
        }

        .report-highlights li {
            position: relative;
            padding-left: 1.5rem;
            margin-bottom: 0.5rem;
            color: var(--gray-600);
        }

        .report-highlights li::before {
            content: '📈';
            position: absolute;
            left: 0;
            font-size: 0.9rem;
        }

        .download-btn {
            background: var(--primary-color);
            color: white;
            border: none;
            padding: 0.75rem 2rem;
            border-radius: 25px;
            font-weight: 600;
            text-decoration: none;
            transition: var(--transition);
            display: inline-block;
            margin-right: 1rem;
        }

        .download-btn:hover {
            background: var(--secondary-color);
            color: white;
            transform: translateY(-2px);
        }

        .view-btn {
            background: transparent;
            color: var(--primary-color);
            border: 2px solid var(--primary-color);
            padding: 0.75rem 2rem;
            border-radius: 25px;
            font-weight: 600;
            text-decoration: none;
            transition: var(--transition);
            display: inline-block;
        }

        .view-btn:hover {
            background: var(--primary-color);
            color: white;
        }

        .investor-contact {
            background: white;
            padding: 3rem;
            border-radius: 16px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.1);
            text-align: center;
        }

        .investor-contact h4 {
            color: var(--dark-color);
            margin-bottom: 1rem;
        }

        .investor-contact p {
            color: var(--gray-600);
            margin-bottom: 2rem;
        }

        .contact-info {
            margin-bottom: 2rem;
        }

        .contact-info .col-lg-6 {
            display: flex;
            margin-bottom: 2rem;
        }

        .contact-item {
            text-align: left;
            background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
            padding: 2rem;
            border-radius: 12px;
            border: 1px solid #e9ecef;
            transition: var(--transition);
            height: 100%;
            width: 100%;
        }

        .contact-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
        }

        .contact-item h6 {
            color: var(--primary-color);
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .contact-item p {
            margin-bottom: 0.5rem;
            color: var(--gray-600);
        }

        .governance-card {
            background: white;
            padding: 2rem;
            border-radius: 16px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.1);
            text-align: center;
            height: 100%;
            transition: var(--transition);
        }

        .governance-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 16px 48px rgba(0,0,0,0.15);
        }

        .governance-icon {
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

        .governance-title {
            font-weight: 600;
            margin-bottom: 1rem;
            color: var(--dark-color);
        }

        .governance-description {
            color: var(--gray-600);
            line-height: 1.6;
            font-size: 0.9rem;
        }

        .calendar-card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.1);
            transition: var(--transition);
            overflow: hidden;
            margin-bottom: 1.5rem;
        }

        .calendar-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 16px 48px rgba(0,0,0,0.15);
        }

        .calendar-date {
            background: var(--primary-color);
            color: white;
            padding: 1rem;
            text-align: center;
            font-weight: 700;
            font-size: 0.9rem;
        }

        .calendar-content {
            padding: 1.5rem;
        }

        .calendar-title {
            font-weight: 600;
            color: var(--dark-color);
            margin-bottom: 0.5rem;
        }

        .calendar-description {
            color: var(--gray-600);
            font-size: 0.9rem;
            line-height: 1.5;
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

        .stock-info {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            padding: 3rem;
            border-radius: 16px;
            text-align: center;
            margin-bottom: 3rem;
        }

        .stock-price {
            font-size: 3rem;
            font-weight: 800;
            margin-bottom: 0.5rem;
        }

        .stock-change {
            font-size: 1.2rem;
            margin-bottom: 1rem;
        }

        .stock-change.positive {
            color: #4ade80;
        }

        .stock-change.negative {
            color: #f87171;
        }

        .stock-meta {
            display: flex;
            justify-content: center;
            gap: 2rem;
            margin-top: 2rem;
        }

        .stock-meta-item {
            text-align: center;
        }

        .stock-meta-value {
            font-size: 1.5rem;
            font-weight: 700;
        }

        .stock-meta-label {
            font-size: 0.9rem;
            opacity: 0.8;
        }

        /* Reports Grid */
        .reports-row .col-lg-6 {
            display: flex;
            margin-bottom: 2rem;
        }

        .report-buttons {
            margin-top: auto;
            padding-top: 1rem;
        }

        /* Custom Contact Buttons */
        .text-center .btn {
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

        .text-center .btn-primary {
            background: rgba(242, 107, 55, 0.15);
            color: var(--primary-color);
            border: 2px solid rgba(242, 107, 55, 0.3);
            backdrop-filter: blur(10px);
        }

        .text-center .btn-primary:hover {
            background: var(--primary-color);
            color: var(--white);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(242, 107, 55, 0.3);
            border-color: var(--primary-color);
        }

        .text-center .btn-outline-primary {
            background: rgba(242, 107, 55, 0.1);
            color: var(--primary-color);
            border: 2px solid rgba(242, 107, 55, 0.25);
            backdrop-filter: blur(10px);
        }

        .text-center .btn-outline-primary:hover {
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
            
            .investor-hero {
                padding: 60px 0;
            }
            
            .section-title {
                font-size: 2rem;
            }
            
            .contact-info {
                grid-template-columns: 1fr;
            }
            
            .stock-meta {
                flex-direction: column;
                gap: 1rem;
            }
            
            .stock-price {
                font-size: 2rem;
            }
        }

        /* Elegant Back to Top Button */
        .back-to-top {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #ff6b37, #f26b37);
            color: white;
            border: none;
            border-radius: 50%;
            cursor: pointer;
            opacity: 0;
            visibility: hidden;
            transform: translateY(20px);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 10px 40px rgba(242, 107, 55, 0.5);
            z-index: 99999;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            backdrop-filter: blur(10px);
            border: 3px solid rgba(255, 255, 255, 0.2);
        }

        .back-to-top.show {
            opacity: 1 !important;
            visibility: visible !important;
            transform: translateY(0) !important;
        }

        .back-to-top:hover {
            transform: translateY(-5px) scale(1.1);
            box-shadow: 0 15px 50px rgba(242, 107, 55, 0.6);
            background: linear-gradient(135deg, #f26b37, #ff6b37);
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
<div class="investor-hero">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="hero-content">
                    <nav class="breadcrumb-custom">
                        <a href="{{ route('dashboard') }}">
                            <i class="fas fa-home me-1"></i>Beranda
                        </a>
                        <span class="mx-2">/</span>
                        <span class="current">Investor Relations</span>
                    </nav>
                    
                    <h1 class="display-4 fw-bold mb-4">Investor <span style="color: #ffc107;">Relations</span></h1>
                    <p class="lead mb-4">Akses informasi keuangan, laporan tahunan, dan data investor terkini MyYOGYA. Kami berkomitmen memberikan transparansi penuh kepada para stakeholder.</p>
                    <div class="hero-stats">
                        <div class="stat-item">
                            <h3 class="stat-number">15%</h3>
                            <p class="stat-label">Growth YoY</p>
                        </div>
                        <div class="stat-item">
                            <h3 class="stat-number">8.2B</h3>
                            <p class="stat-label">Market Cap</p>
                        </div>
                        <div class="stat-item">
                            <h3 class="stat-number">12.5%</h3>
                            <p class="stat-label">ROE</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="hero-image">
                    <img src="{{ asset('image/placeholder.png') }}" alt="Investor Relations MyYOGYA" class="img-fluid rounded-4 shadow-lg">
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Stock Information -->
<section class="py-5">
    <div class="container">
        <div class="stock-info">
            <h3 class="mb-3">YOGYA Stock Price</h3>
            <div class="stock-price">Rp 2,450</div>
            <div class="stock-change positive">
                <i class="fas fa-arrow-up me-2"></i>+2.8% (+68)
            </div>
            <p class="mb-0">Last updated: 25 Agustus 2025, 15:30 WIB</p>
            
            <div class="stock-meta">
                <div class="stock-meta-item">
                    <div class="stock-meta-value">2,520</div>
                    <div class="stock-meta-label">Day High</div>
                </div>
                <div class="stock-meta-item">
                    <div class="stock-meta-value">2,380</div>
                    <div class="stock-meta-label">Day Low</div>
                </div>
                <div class="stock-meta-item">
                    <div class="stock-meta-value">2.1M</div>
                    <div class="stock-meta-label">Volume</div>
                </div>
                <div class="stock-meta-item">
                    <div class="stock-meta-value">8.2B</div>
                    <div class="stock-meta-label">Market Cap</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Financial Highlights -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 mx-auto text-center mb-5">
                <h2 class="section-title">Financial Highlights</h2>
                <p class="section-subtitle">Ringkasan kinerja keuangan MyYOGYA tahun 2024</p>
            </div>
        </div>
        <div class="row g-4">
            <div class="col-lg-3 col-md-6">
                <div class="financial-card">
                    <div class="financial-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <h6 class="financial-title">Total Revenue</h6>
                    <div class="financial-value">Rp 1.2T</div>
                    <p class="financial-description">Peningkatan 15% dari tahun sebelumnya</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="financial-card">
                    <div class="financial-icon">
                        <i class="fas fa-coins"></i>
                    </div>
                    <h6 class="financial-title">Net Profit</h6>
                    <div class="financial-value">Rp 185B</div>
                    <p class="financial-description">Margin keuntungan bersih 15.4%</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="financial-card">
                    <div class="financial-icon">
                        <i class="fas fa-building"></i>
                    </div>
                    <h6 class="financial-title">Total Assets</h6>
                    <div class="financial-value">Rp 2.8T</div>
                    <p class="financial-description">Pertumbuhan aset 12% YoY</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="financial-card">
                    <div class="financial-icon">
                        <i class="fas fa-percent"></i>
                    </div>
                    <h6 class="financial-title">ROE</h6>
                    <div class="financial-value">12.5%</div>
                    <p class="financial-description">Return on Equity yang konsisten</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Annual Reports -->
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 mx-auto text-center mb-5">
                <h2 class="section-title">Laporan Tahunan & Keuangan</h2>
                <p class="section-subtitle">Akses laporan keuangan dan dokumen investor terbaru</p>
            </div>
        </div>

        <div class="row reports-row">
            <div class="col-lg-6">
                <div class="report-card">
                    <div class="report-header">
                        <h4 class="report-title">Laporan Tahunan 2024</h4>
                        <p class="report-period">Periode: Januari - Desember 2024</p>
                        <div class="report-meta">
                            <span><i class="fas fa-file-pdf me-1"></i>PDF</span>
                            <span><i class="fas fa-download me-1"></i>2.1 MB</span>
                            <span><i class="fas fa-calendar me-1"></i>31 Mar 2025</span>
                        </div>
                    </div>
                    <div class="report-content">
                        <p class="report-description">Laporan tahunan lengkap yang mencakup analisis manajemen, laporan keuangan auditan, dan strategi bisnis untuk tahun mendatang.</p>
                        <ul class="report-highlights">
                            <li>Pertumbuhan revenue 15% YoY</li>
                            <li>Ekspansi ke 10 kota baru</li>
                            <li>Peningkatan customer base 25%</li>
                            <li>ROE mencapai 12.5%</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="report-card">
                    <div class="report-header">
                        <h4 class="report-title">Laporan Keuangan Q2 2025</h4>
                        <p class="report-period">Periode: April - Juni 2025</p>
                        <div class="report-meta">
                            <span><i class="fas fa-file-pdf me-1"></i>PDF</span>
                            <span><i class="fas fa-download me-1"></i>1.8 MB</span>
                            <span><i class="fas fa-calendar me-1"></i>25 Jul 2025</span>
                        </div>
                    </div>
                    <div class="report-content">
                        <p class="report-description">Laporan keuangan kuartalan yang menampilkan kinerja keuangan terkini dan pencapaian target bisnis triwulan kedua.</p>
                        <ul class="report-highlights">
                            <li>Revenue Q2: Rp 320B</li>
                            <li>Gross margin 18.2%</li>
                            <li>Net profit Rp 52B</li>
                            <li>Cash flow positif</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="report-card">
                    <div class="report-header">
                        <h4 class="report-title">Prospektus IPO 2023</h4>
                        <p class="report-period">Initial Public Offering</p>
                        <div class="report-meta">
                            <span><i class="fas fa-file-pdf me-1"></i>PDF</span>
                            <span><i class="fas fa-download me-1"></i>4.2 MB</span>
                            <span><i class="fas fa-calendar me-1"></i>15 Sep 2023</span>
                        </div>
                    </div>
                    <div class="report-content">
                        <p class="report-description">Dokumen prospektus lengkap yang memuat informasi detail tentang penawaran umum perdana saham MyYOGYA.</p>
                        <ul class="report-highlights">
                            <li>Rencana penggunaan dana IPO</li>
                            <li>Analisis industri e-commerce</li>
                            <li>Profil manajemen dan komisaris</li>
                            <li>Faktor risiko investasi</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="report-card">
                    <div class="report-header">
                        <h4 class="report-title">Sustainability Report 2024</h4>
                        <p class="report-period">Laporan Keberlanjutan</p>
                        <div class="report-meta">
                            <span><i class="fas fa-file-pdf me-1"></i>PDF</span>
                            <span><i class="fas fa-download me-1"></i>3.5 MB</span>
                            <span><i class="fas fa-calendar me-1"></i>20 Apr 2025</span>
                        </div>
                    </div>
                    <div class="report-content">
                        <p class="report-description">Laporan komprehensif tentang upaya keberlanjutan dan tanggung jawab sosial perusahaan MyYOGYA.</p>
                        <ul class="report-highlights">
                            <li>Program CSR dan community impact</li>
                            <li>Inisiatif green technology</li>
                            <li>Carbon footprint reduction</li>
                            <li>Employee welfare programs</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Corporate Governance -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 mx-auto text-center mb-5">
                <h2 class="section-title">Corporate Governance</h2>
                <p class="section-subtitle">Komitmen kami terhadap tata kelola perusahaan yang baik dan transparan</p>
            </div>
        </div>
        <div class="row g-4">
            <div class="col-lg-4 col-md-6">
                <div class="governance-card">
                    <div class="governance-icon">
                        <i class="fas fa-gavel"></i>
                    </div>
                    <h6 class="governance-title">Board of Directors</h6>
                    <p class="governance-description">Dewan direksi yang berpengalaman dan independen untuk mengawasi strategi bisnis perusahaan.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="governance-card">
                    <div class="governance-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h6 class="governance-title">Audit Committee</h6>
                    <p class="governance-description">Komite audit independen yang memastikan transparansi dan akurasi laporan keuangan.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="governance-card">
                    <div class="governance-icon">
                        <i class="fas fa-balance-scale"></i>
                    </div>
                    <h6 class="governance-title">Risk Management</h6>
                    <p class="governance-description">Sistem manajemen risiko yang komprehensif untuk melindungi kepentingan stakeholder.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="governance-card">
                    <div class="governance-icon">
                        <i class="fas fa-users-cog"></i>
                    </div>
                    <h6 class="governance-title">Nomination Committee</h6>
                    <p class="governance-description">Komite nominasi untuk memastikan kualitas dan kompetensi manajemen perusahaan.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="governance-card">
                    <div class="governance-icon">
                        <i class="fas fa-file-contract"></i>
                    </div>
                    <h6 class="governance-title">Compliance</h6>
                    <p class="governance-description">Kepatuhan penuh terhadap regulasi bursa efek dan peraturan pemerintah yang berlaku.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="governance-card">
                    <div class="governance-icon">
                        <i class="fas fa-eye"></i>
                    </div>
                    <h6 class="governance-title">Transparency</h6>
                    <p class="governance-description">Komitmen transparansi informasi kepada publik dan stakeholder secara berkala.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Investor Calendar -->
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 mx-auto text-center mb-5">
                <h2 class="section-title">Kalender Investor</h2>
                <p class="section-subtitle">Jadwal penting untuk para investor dan stakeholder</p>
            </div>
        </div>
        <div class="row g-4">
            <div class="col-lg-6">
                <div class="calendar-card">
                    <div class="calendar-date">15 SEP 2025</div>
                    <div class="calendar-content">
                        <h6 class="calendar-title">Rapat Umum Pemegang Saham Tahunan</h6>
                        <p class="calendar-description">RUPST 2025 untuk membahas laporan tahunan, pembagian dividen, dan rencana strategis tahun mendatang.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="calendar-card">
                    <div class="calendar-date">25 OCT 2025</div>
                    <div class="calendar-content">
                        <h6 class="calendar-title">Laporan Keuangan Q3 2025</h6>
                        <p class="calendar-description">Publikasi laporan keuangan kuartalan ketiga dan conference call dengan investor.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="calendar-card">
                    <div class="calendar-date">30 NOV 2025</div>
                    <div class="calendar-content">
                        <h6 class="calendar-title">Investor Day 2025</h6>
                        <p class="calendar-description">Acara tahunan untuk presentasi strategi bisnis dan target pertumbuhan jangka panjang.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="calendar-card">
                    <div class="calendar-date">15 DEC 2025</div>
                    <div class="calendar-content">
                        <h6 class="calendar-title">Pembagian Dividen Interim</h6>
                        <p class="calendar-description">Jadwal cum-date dan ex-date untuk pembagian dividen interim tahun 2025.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Investor Contact -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 mx-auto">
                <div class="investor-contact">
                    <h3>Kontak Investor Relations</h3>
                    <p>Untuk pertanyaan investor, informasi keuangan, atau permintaan meeting dengan manajemen, silakan hubungi tim Investor Relations kami</p>
                    
                    <div class="row contact-info">
                        <div class="col-lg-6">
                            <div class="contact-item">
                                <h6><i class="fas fa-user-tie me-2"></i>Investor Relations Officer</h6>
                                <p><strong>Budi Santoso, CFA</strong></p>
                                <p>Vice President Investor Relations</p>
                                <p>Email: investor@myyogya.com</p>
                                <p>Phone: (021) 5555-1234</p>
                            </div>
                        </div>
                        
                        <div class="col-lg-6">
                            <div class="contact-item">
                                <h6><i class="fas fa-building me-2"></i>Head Office</h6>
                                <p>MyYOGYA Corporate Center</p>
                                <p>Jl. Sudirman No. 123</p>
                                <p>Jakarta Pusat 10220</p>
                                <p>Indonesia</p>
                            </div>
                        </div>
                        
                        <div class="col-lg-6">
                            <div class="contact-item">
                                <h6><i class="fas fa-clock me-2"></i>Office Hours</h6>
                                <p>Senin - Jumat: 09:00 - 17:00 WIB</p>
                                <p>Sabtu: 09:00 - 12:00 WIB</p>
                                <p>Minggu: Tutup</p>
                            </div>
                        </div>
                        
                        <div class="col-lg-6">
                            <div class="contact-item">
                                <h6><i class="fas fa-envelope me-2"></i>Email Contacts</h6>
                                <p>General Inquiry: investor@myyogya.com</p>
                                <p>Financial Reports: reports@myyogya.com</p>
                                <p>Meeting Request: meeting@myyogya.com</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="text-center">
                        <a href="mailto:yogya.toserbaa@gmail.com" class="btn btn-primary me-3">
                            <i class="fas fa-envelope me-2"></i>Email Investor Relations
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

<script>
// Stock price animation
function updateStockPrice() {
    const priceElement = document.querySelector('.stock-price');
    const changeElement = document.querySelector('.stock-change');
    
    // Simulate real-time price updates (for demo)
    const basePrice = 2450;
    const variation = Math.random() * 100 - 50; // ±50
    const newPrice = Math.round(basePrice + variation);
    const change = variation;
    const changePercent = ((change / basePrice) * 100).toFixed(2);
    
    if (priceElement) {
        priceElement.textContent = `Rp ${newPrice.toLocaleString()}`;
    }
    
    if (changeElement) {
        const icon = change >= 0 ? 'fa-arrow-up' : 'fa-arrow-down';
        const className = change >= 0 ? 'positive' : 'negative';
        const sign = change >= 0 ? '+' : '';
        
        changeElement.className = `stock-change ${className}`;
        changeElement.innerHTML = `<i class="fas ${icon} me-2"></i>${sign}${changePercent}% (${sign}${Math.round(change)})`;
    }
}

// Update stock price every 30 seconds (for demo)
setInterval(updateStockPrice, 30000);

// Download button functionality
document.querySelectorAll('.download-btn').forEach(btn => {
    btn.addEventListener('click', function(e) {
        e.preventDefault();
        const reportTitle = this.closest('.report-card').querySelector('.report-title').textContent;
        alert(`Mengunduh: ${reportTitle}\n\nDalam implementasi nyata, ini akan mengunduh file PDF.`);
    });
});

// View button functionality
document.querySelectorAll('.view-btn').forEach(btn => {
    btn.addEventListener('click', function(e) {
        e.preventDefault();
        const reportTitle = this.closest('.report-card').querySelector('.report-title').textContent;
        alert(`Membuka: ${reportTitle}\n\nDalam implementasi nyata, ini akan membuka PDF di tab baru.`);
    });
});

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
