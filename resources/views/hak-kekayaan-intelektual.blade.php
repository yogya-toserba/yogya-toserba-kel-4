<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hak Kekayaan Intelektual - MyYOGYA</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Custom CSS -->
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
    
    <style>
        /* Privacy Page Styles */
        .privacy-hero {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            padding: 100px 0;
            position: relative;
            overflow: hidden;
        }

        .privacy-hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Ccircle cx='30' cy='30' r='2'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E") repeat;
        }

        .privacy-hero .container {
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

        .privacy-navigation {
            background: white;
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 10px 40px rgba(0,0,0,0.1);
            position: sticky;
            top: 2rem;
            max-height: 80vh;
            overflow-y: auto;
        }

        .privacy-nav-title {
            font-weight: 700;
            margin-bottom: 1.5rem;
            color: var(--dark-color);
            font-size: 1.2rem;
        }

        .privacy-nav-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .privacy-nav-list li {
            margin-bottom: 0.75rem;
        }

        .privacy-nav-list a {
            color: var(--gray-600);
            text-decoration: none;
            padding: 0.75rem 1rem;
            border-radius: 12px;
            display: block;
            transition: all 0.3s ease;
            font-size: 0.95rem;
            border-left: 3px solid transparent;
        }

        .privacy-nav-list a:hover,
        .privacy-nav-list a.active {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            transform: translateX(5px);
            border-left-color: white;
        }

        .privacy-content {
            background: white;
            border-radius: 20px;
            padding: 3rem;
            box-shadow: 0 10px 40px rgba(0,0,0,0.1);
        }

        .privacy-section {
            margin-bottom: 3rem;
            scroll-margin-top: 2rem;
        }

        .privacy-section:last-child {
            margin-bottom: 0;
        }

        .section-title {
            font-weight: 700;
            font-size: 1.8rem;
            color: var(--dark-color);
            margin-bottom: 1.5rem;
            position: relative;
            padding-left: 1rem;
        }

        .section-title::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 4px;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            border-radius: 2px;
        }

        .subsection-title {
            font-weight: 600;
            font-size: 1.3rem;
            color: var(--dark-color);
            margin: 2rem 0 1rem;
        }

        .privacy-text {
            color: var(--gray-700);
            line-height: 1.8;
            margin-bottom: 1.5rem;
            text-align: justify;
        }

        .privacy-list {
            padding-left: 0;
            list-style: none;
            margin-bottom: 1.5rem;
        }

        .privacy-list li {
            position: relative;
            padding: 0.5rem 0 0.5rem 2rem;
            color: var(--gray-700);
            line-height: 1.6;
            margin-bottom: 0.75rem;
        }

        .privacy-list li::before {
            content: '';
            position: absolute;
            left: 0;
            top: 1rem;
            width: 8px;
            height: 8px;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            border-radius: 50%;
        }

        .highlight-box {
            background: linear-gradient(135deg, #e3f2fd, #bbdefb);
            border: 1px solid #2196f3;
            border-radius: 16px;
            padding: 2rem;
            margin: 2rem 0;
            position: relative;
            overflow: hidden;
        }

        .highlight-box::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        }

        .highlight-box h6 {
            color: #1976d2;
            font-weight: 600;
            margin-bottom: 1rem;
            font-size: 1.1rem;
        }

        .highlight-box p {
            color: #0d47a1;
            margin: 0;
            line-height: 1.6;
        }

        .warning-box {
            background: linear-gradient(135deg, #fff3e0, #ffe0b2);
            border: 1px solid #ff9800;
            border-radius: 16px;
            padding: 2rem;
            margin: 2rem 0;
            position: relative;
            overflow: hidden;
        }

        .warning-box::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(135deg, #ff9800, #f57c00);
        }

        .warning-box h6 {
            color: #e65100;
            font-weight: 600;
            margin-bottom: 1rem;
            font-size: 1.1rem;
        }

        .warning-box p {
            color: #bf360c;
            margin: 0;
            line-height: 1.6;
        }

        .contact-info {
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            border-radius: 20px;
            padding: 2.5rem;
            text-align: center;
            margin-top: 3rem;
        }

        .contact-title {
            font-weight: 700;
            font-size: 1.5rem;
            color: var(--dark-color);
            margin-bottom: 1rem;
        }

        .contact-text {
            color: var(--gray-600);
            margin-bottom: 2rem;
            line-height: 1.6;
        }

        .contact-methods {
            display: flex;
            justify-content: center;
            gap: 2rem;
            flex-wrap: wrap;
        }

        .contact-method {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            background: white;
            padding: 1rem 1.5rem;
            border-radius: 12px;
            box-shadow: 0 4px 16px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
        }

        .contact-method:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 24px rgba(0,0,0,0.15);
        }

        .contact-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.2rem;
        }

        .contact-details h6 {
            margin: 0;
            font-weight: 600;
            color: var(--dark-color);
        }

        .contact-details p {
            margin: 0;
            color: var(--gray-600);
            font-size: 0.9rem;
        }

        .last-updated {
            text-align: center;
            padding: 2rem 0;
            color: var(--gray-500);
            font-style: italic;
            border-top: 1px solid #f0f0f0;
            margin-top: 3rem;
        }

        .ip-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 1.5rem;
            margin: 2rem 0;
        }

        .ip-card {
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.05), rgba(118, 75, 162, 0.05));
            border: 1px solid rgba(102, 126, 234, 0.2);
            border-radius: 15px;
            padding: 2rem;
            text-align: center;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .ip-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(102, 126, 234, 0.2);
            border-color: var(--primary-color);
        }

        .ip-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem auto;
            color: white;
            font-size: 1.5rem;
        }

        @media (max-width: 991px) {
            .privacy-navigation {
                position: relative;
                margin-bottom: 2rem;
                max-height: none;
            }
            
            .privacy-content {
                padding: 2rem;
            }
        }

        @media (max-width: 768px) {
            .privacy-hero {
                padding: 60px 0;
            }
            
            .section-title {
                font-size: 1.5rem;
            }
            
            .ip-grid {
                grid-template-columns: 1fr;
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
<div class="privacy-hero">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8 mx-auto text-center">
                <nav class="breadcrumb-custom">
                    <a href="{{ route('dashboard') }}">
                        <i class="fas fa-home me-1"></i>Beranda
                    </a>
                    <span class="mx-2">/</span>
                    <span class="current">Hak Kekayaan Intelektual</span>
                </nav>
                
                <h1 class="display-4 fw-bold mb-4">Hak Kekayaan <span class="text-warning">Intelektual</span></h1>
                <p class="lead mb-4">Perlindungan dan penghormatan terhadap hak kekayaan intelektual di platform MyYOGYA sesuai dengan peraturan hukum yang berlaku di Indonesia.</p>
                <div class="d-flex justify-content-center gap-4 flex-wrap">
                    <div class="text-center">
                        <i class="fas fa-copyright mb-2" style="font-size: 2rem;"></i>
                        <h5 class="mb-1 fw-bold">Copyright</h5>
                        <p class="mb-0 opacity-75">Dilindungi Hukum</p>
                    </div>
                    <div class="text-center">
                        <i class="fas fa-trademark mb-2" style="font-size: 2rem;"></i>
                        <h5 class="mb-1 fw-bold">Trademark</h5>
                        <p class="mb-0 opacity-75">Terdaftar Resmi</p>
                    </div>
                    <div class="text-center">
                        <i class="fas fa-shield-alt mb-2" style="font-size: 2rem;"></i>
                        <h5 class="mb-1 fw-bold">Perlindungan</h5>
                        <p class="mb-0 opacity-75">24/7 Monitoring</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Content -->
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="privacy-navigation">
                    <h6 class="privacy-nav-title">Daftar Isi</h6>
                    <ul class="privacy-nav-list">
                        <li><a href="#pendahuluan" class="nav-link">1. Pendahuluan</a></li>
                        <li><a href="#jenis-hki" class="nav-link">2. Jenis HKI</a></li>
                        <li><a href="#kepemilikan" class="nav-link">3. Kepemilikan</a></li>
                        <li><a href="#penggunaan-diizinkan" class="nav-link">4. Penggunaan Diizinkan</a></li>
                        <li><a href="#pelanggaran" class="nav-link">5. Pelanggaran HKI</a></li>
                        <li><a href="#dmca" class="nav-link">6. DMCA Takedown</a></li>
                        <li><a href="#lisensi" class="nav-link">7. Lisensi Pihak Ketiga</a></li>
                        <li><a href="#pelaporan" class="nav-link">8. Pelaporan</a></li>
                        <li><a href="#sanksi" class="nav-link">9. Sanksi</a></li>
                        <li><a href="#kontak" class="nav-link">10. Kontak</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="col-lg-9">
                <div class="privacy-content">
                    <!-- Section 1: Pendahuluan -->
                    <div id="pendahuluan" class="privacy-section">
                        <h2 class="section-title">1. Pendahuluan</h2>
                        <p class="privacy-text">MyYOGYA menghormati dan melindungi hak kekayaan intelektual (HKI) dari semua pihak. Kebijakan ini mengatur penggunaan, perlindungan, dan penegakan hak kekayaan intelektual di platform kami sesuai dengan Undang-Undang No. 28 Tahun 2014 tentang Hak Cipta dan peraturan terkait lainnya.</p>
                        
                        <div class="highlight-box">
                            <h6><i class="fas fa-balance-scale me-2"></i>Komitmen Kami</h6>
                            <p>MyYOGYA berkomitmen untuk menciptakan ekosistem digital yang menghormati hak kekayaan intelektual, mendukung inovasi, dan melindungi kreativitas semua pengguna platform kami.</p>
                        </div>

                        <p class="privacy-text">Kebijakan ini berlaku untuk semua pengguna, mitra, penjual, dan pihak yang berinteraksi dengan platform MyYOGYA dalam bentuk apapun.</p>
                    </div>

                    <!-- Section 2: Jenis HKI -->
                    <div id="jenis-hki" class="privacy-section">
                        <h2 class="section-title">2. Jenis Hak Kekayaan Intelektual</h2>
                        
                        <p class="privacy-text">Platform MyYOGYA melindungi berbagai jenis hak kekayaan intelektual:</p>

                        <div class="ip-grid">
                            <div class="ip-card">
                                <div class="ip-icon">
                                    <i class="fas fa-copyright"></i>
                                </div>
                                <h5>Hak Cipta</h5>
                                <p class="privacy-text">Konten original, foto produk, deskripsi, logo, dan materi kreatif lainnya.</p>
                            </div>
                            <div class="ip-card">
                                <div class="ip-icon">
                                    <i class="fas fa-trademark"></i>
                                </div>
                                <h5>Merek Dagang</h5>
                                <p class="privacy-text">Logo MyYOGYA, nama brand, slogan, dan identitas visual perusahaan.</p>
                            </div>
                            <div class="ip-card">
                                <div class="ip-icon">
                                    <i class="fas fa-lightbulb"></i>
                                </div>
                                <h5>Paten</h5>
                                <p class="privacy-text">Teknologi inovatif, algoritma, dan solusi teknis yang dikembangkan.</p>
                            </div>
                            <div class="ip-card">
                                <div class="ip-icon">
                                    <i class="fas fa-user-secret"></i>
                                </div>
                                <h5>Rahasia Dagang</h5>
                                <p class="privacy-text">Informasi bisnis rahasia, database, dan know-how proprietary.</p>
                            </div>
                            <div class="ip-card">
                                <div class="ip-icon">
                                    <i class="fas fa-palette"></i>
                                </div>
                                <h5>Desain Industri</h5>
                                <p class="privacy-text">Desain interface, kemasan, dan elemen visual produk.</p>
                            </div>
                            <div class="ip-card">
                                <div class="ip-icon">
                                    <i class="fas fa-microchip"></i>
                                </div>
                                <h5>Desain Tata Letak</h5>
                                <p class="privacy-text">Layout website, aplikasi mobile, dan sistem digital.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Section 3: Kepemilikan -->
                    <div id="kepemilikan" class="privacy-section">
                        <h2 class="section-title">3. Kepemilikan Hak Kekayaan Intelektual</h2>
                        
                        <h3 class="subsection-title">3.1 Hak Milik MyYOGYA</h3>
                        <ul class="privacy-list">
                            <li><strong>Platform dan Teknologi:</strong> Seluruh teknologi, kode sumber, algoritma, dan sistem MyYOGYA</li>
                            <li><strong>Identitas Brand:</strong> Logo, nama MyYOGYA, slogan, dan elemen branding</li>
                            <li><strong>Konten Platform:</strong> Layout, desain interface, fitur-fitur unik platform</li>
                            <li><strong>Database:</strong> Struktur data, sistem klasifikasi, dan metadata produk</li>
                            <li><strong>Dokumentasi:</strong> Manual, panduan, dan materi edukasi platform</li>
                        </ul>

                        <h3 class="subsection-title">3.2 Hak Milik Penjual/Mitra</h3>
                        <ul class="privacy-list">
                            <li><strong>Produk dan Merek:</strong> Hak atas produk yang dijual dan merek dagang mereka</li>
                            <li><strong>Konten Produk:</strong> Foto, deskripsi, dan materi promosi yang dibuat sendiri</li>
                            <li><strong>Inovasi:</strong> Teknologi atau desain produk yang dikembangkan secara mandiri</li>
                        </ul>

                        <div class="warning-box">
                            <h6><i class="fas fa-exclamation-triangle me-2"></i>Penting untuk Diketahui</h6>
                            <p>Dengan menggunakan platform MyYOGYA, penjual memberikan lisensi terbatas kepada MyYOGYA untuk menampilkan, mendistribusikan, dan mempromosikan konten produk mereka di platform kami.</p>
                        </div>
                    </div>

                    <!-- Section 4: Penggunaan Diizinkan -->
                    <div id="penggunaan-diizinkan" class="privacy-section">
                        <h2 class="section-title">4. Penggunaan yang Diizinkan</h2>
                        
                        <p class="privacy-text">Berikut adalah penggunaan hak kekayaan intelektual yang diizinkan di platform MyYOGYA:</p>

                        <h3 class="subsection-title">4.1 Fair Use / Penggunaan Wajar</h3>
                        <ul class="privacy-list">
                            <li>Kutipan singkat untuk review produk yang sah</li>
                            <li>Penggunaan logo untuk tujuan identifikasi dalam konteks bisnis resmi</li>
                            <li>Screenshot platform untuk tujuan edukasi atau pelaporan</li>
                            <li>Referensi nama MyYOGYA dalam konteks jurnalistik atau akademis</li>
                        </ul>

                        <h3 class="subsection-title">4.2 Penggunaan dengan Izin</h3>
                        <ul class="privacy-list">
                            <li>Program afiliasi dan kemitraan resmi</li>
                            <li>Kampanye marketing bersama yang telah disetujui</li>
                            <li>Integrasi API dengan lisensi yang valid</li>
                            <li>Content sharing melalui fitur platform yang disediakan</li>
                        </ul>

                        <div class="highlight-box">
                            <h6><i class="fas fa-handshake me-2"></i>Kemitraan HKI</h6>
                            <p>MyYOGYA terbuka untuk kemitraan strategis yang saling menguntungkan dalam pemanfaatan hak kekayaan intelektual. Hubungi tim legal kami untuk informasi lebih lanjut.</p>
                        </div>
                    </div>

                    <!-- Section 5: Pelanggaran -->
                    <div id="pelanggaran" class="privacy-section">
                        <h2 class="section-title">5. Pelanggaran Hak Kekayaan Intelektual</h2>
                        
                        <p class="privacy-text">Tindakan berikut dianggap sebagai pelanggaran hak kekayaan intelektual:</p>

                        <h3 class="subsection-title">5.1 Pelanggaran Hak Cipta</h3>
                        <ul class="privacy-list">
                            <li>Menyalin konten, foto, atau deskripsi produk tanpa izin</li>
                            <li>Menggunakan logo atau materi visual MyYOGYA tanpa otorisasi</li>
                            <li>Menduplikasi layout atau desain interface platform</li>
                            <li>Mengunggah konten yang melanggar hak cipta pihak lain</li>
                        </ul>

                        <h3 class="subsection-title">5.2 Pelanggaran Merek Dagang</h3>
                        <ul class="privacy-list">
                            <li>Menggunakan nama MyYOGYA atau variasi nama serupa</li>
                            <li>Membuat website atau aplikasi yang menyerupai MyYOGYA</li>
                            <li>Menjual produk palsu atau tiruan merek terkenal</li>
                            <li>Menggunakan logo atau identitas visual yang menyesatkan</li>
                        </ul>

                        <div class="warning-box">
                            <h6><i class="fas fa-ban me-2"></i>Konsekuensi Pelanggaran</h6>
                            <p>Pelanggaran HKI dapat mengakibatkan penghapusan konten, penangguhan akun, tuntutan hukum, dan ganti rugi sesuai dengan peraturan perundang-undangan yang berlaku.</p>
                        </div>
                    </div>

                    <!-- Section 6: DMCA -->
                    <div id="dmca" class="privacy-section">
                        <h2 class="section-title">6. DMCA Takedown Notice</h2>
                        
                        <p class="privacy-text">MyYOGYA mematuhi Digital Millennium Copyright Act (DMCA) dan menyediakan prosedur untuk pelaporan pelanggaran hak cipta:</p>

                        <h3 class="subsection-title">6.1 Prosedur Pelaporan</h3>
                        <ul class="privacy-list">
                            <li>Identifikasi konten yang diduga melanggar hak cipta</li>
                            <li>Berikan bukti kepemilikan hak cipta yang sah</li>
                            <li>Sertakan informasi kontak yang valid</li>
                            <li>Nyatakan itikad baik dalam pelaporan</li>
                            <li>Tanda tangan digital atau fisik pemilik hak</li>
                        </ul>

                        <h3 class="subsection-title">6.2 Counter-Notice</h3>
                        <p class="privacy-text">Pengguna yang merasa kontennya dihapus secara tidak tepat dapat mengajukan counter-notice dengan menyertakan:</p>
                        <ul class="privacy-list">
                            <li>Identifikasi konten yang dihapus</li>
                            <li>Pernyataan bahwa penggunaan adalah sah</li>
                            <li>Bukti lisensi atau izin penggunaan</li>
                            <li>Kesediaan untuk menghadapi proses hukum</li>
                        </ul>

                        <div class="highlight-box">
                            <h6><i class="fas fa-clock me-2"></i>Waktu Pemrosesan</h6>
                            <p>DMCA takedown notice akan diproses dalam 24-48 jam. Counter-notice akan ditinjau dalam 7-14 hari kerja dengan melibatkan tim legal internal.</p>
                        </div>
                    </div>

                    <!-- Section 7: Lisensi -->
                    <div id="lisensi" class="privacy-section">
                        <h2 class="section-title">7. Lisensi dan Penggunaan Pihak Ketiga</h2>
                        
                        <p class="privacy-text">MyYOGYA menggunakan berbagai teknologi dan konten dari pihak ketiga dengan lisensi yang sesuai:</p>

                        <h3 class="subsection-title">7.1 Open Source Software</h3>
                        <ul class="privacy-list">
                            <li>Laravel Framework (MIT License)</li>
                            <li>Bootstrap CSS Framework (MIT License)</li>
                            <li>Font Awesome Icons (SIL OFL 1.1)</li>
                            <li>jQuery Library (MIT License)</li>
                        </ul>

                        <h3 class="subsection-title">7.2 Paid Licenses</h3>
                        <ul class="privacy-list">
                            <li>Stock photos dari Shutterstock dan Unsplash</li>
                            <li>Font commercial dari Google Fonts Pro</li>
                            <li>API services dari payment gateways</li>
                            <li>Security tools dan monitoring services</li>
                        </ul>

                        <div class="highlight-box">
                            <h6><i class="fas fa-file-contract me-2"></i>Compliance</h6>
                            <p>Semua penggunaan teknologi pihak ketiga telah melalui review legal dan compliance untuk memastikan kesesuaian dengan persyaratan lisensi masing-masing.</p>
                        </div>
                    </div>

                    <!-- Section 8: Pelaporan -->
                    <div id="pelaporan" class="privacy-section">
                        <h2 class="section-title">8. Pelaporan Pelanggaran HKI</h2>
                        
                        <p class="privacy-text">Jika Anda menemukan pelanggaran hak kekayaan intelektual di platform MyYOGYA, segera laporkan melalui saluran berikut:</p>

                        <div class="ip-grid">
                            <div class="ip-card">
                                <div class="ip-icon">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <h5>Email Legal</h5>
                                <p class="privacy-text"><strong>legal@myyogya.co.id</strong><br>Respon dalam 24 jam</p>
                            </div>
                            <div class="ip-card">
                                <div class="ip-icon">
                                    <i class="fas fa-phone"></i>
                                </div>
                                <h5>Hotline HKI</h5>
                                <p class="privacy-text"><strong>021-1234-5678</strong><br>Senin-Jumat: 09:00-17:00</p>
                            </div>
                            <div class="ip-card">
                                <div class="ip-icon">
                                    <i class="fas fa-file-alt"></i>
                                </div>
                                <h5>Form Online</h5>
                                <p class="privacy-text"><strong>Report IP Violation</strong><br>Available 24/7</p>
                            </div>
                        </div>

                        <h3 class="subsection-title">8.1 Informasi yang Dibutuhkan</h3>
                        <ul class="privacy-list">
                            <li>Deskripsi lengkap pelanggaran yang terjadi</li>
                            <li>URL atau lokasi konten yang melanggar</li>
                            <li>Bukti kepemilikan hak kekayaan intelektual</li>
                            <li>Screenshot atau dokumentasi pendukung</li>
                            <li>Informasi kontak yang dapat dihubungi</li>
                        </ul>
                    </div>

                    <!-- Section 9: Sanksi -->
                    <div id="sanksi" class="privacy-section">
                        <h2 class="section-title">9. Sanksi dan Tindakan Hukum</h2>
                        
                        <p class="privacy-text">MyYOGYA menerapkan sanksi tegas terhadap pelanggaran hak kekayaan intelektual:</p>

                        <h3 class="subsection-title">9.1 Sanksi Administratif</h3>
                        <ul class="privacy-list">
                            <li><strong>Peringatan Pertama:</strong> Notifikasi dan permintaan penghapusan konten</li>
                            <li><strong>Peringatan Kedua:</strong> Pembatasan fitur akun selama 7 hari</li>
                            <li><strong>Peringatan Ketiga:</strong> Penangguhan akun selama 30 hari</li>
                            <li><strong>Pelanggaran Berulang:</strong> Penutupan akun permanen</li>
                        </ul>

                        <h3 class="subsection-title">9.2 Tindakan Hukum</h3>
                        <ul class="privacy-list">
                            <li>Gugatan perdata untuk ganti rugi materiil dan immateriil</li>
                            <li>Pelaporan pidana sesuai UU Hak Cipta dan UU Merek</li>
                            <li>Injunction atau surat perintah pengadilan</li>
                            <li>Klaim aset digital dan pemblokiran domain</li>
                        </ul>

                        <div class="warning-box">
                            <h6><i class="fas fa-gavel me-2"></i>Penegakan Hukum</h6>
                            <p>MyYOGYA akan mengejar tindakan hukum maksimal terhadap pelanggaran HKI yang signifikan, termasuk kerjasama dengan penegak hukum dan organisasi perlindungan HKI internasional.</p>
                        </div>
                    </div>

                    <!-- Section 10: Kontak -->
                    <div id="kontak" class="privacy-section">
                        <h2 class="section-title">10. Kontak dan Informasi Lebih Lanjut</h2>
                        
                        <p class="privacy-text">Untuk pertanyaan, kerjasama, atau informasi lebih lanjut mengenai hak kekayaan intelektual:</p>

                        <div class="contact-info">
                            <h5 class="contact-title">Tim Legal & Intellectual Property</h5>
                            <p class="contact-text">Siap membantu Anda dalam semua hal terkait hak kekayaan intelektual</p>
                            
                            <div class="contact-methods">
                                <div class="contact-method">
                                    <div class="contact-icon">
                                        <i class="fas fa-envelope"></i>
                                    </div>
                                    <div class="contact-details">
                                        <h6>Legal Department</h6>
                                        <p>legal@myyogya.co.id</p>
                                    </div>
                                </div>
                                
                                <div class="contact-method">
                                    <div class="contact-icon">
                                        <i class="fas fa-phone"></i>
                                    </div>
                                    <div class="contact-details">
                                        <h6>IP Hotline</h6>
                                        <p>021-1234-5678 ext. 301</p>
                                    </div>
                                </div>
                                
                                <div class="contact-method">
                                    <div class="contact-icon">
                                        <i class="fas fa-map-marker-alt"></i>
                                    </div>
                                    <div class="contact-details">
                                        <h6>Legal Office</h6>
                                        <p>Jakarta, Indonesia</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="last-updated">
                        <p><i class="fas fa-calendar-alt me-2"></i>Terakhir diperbarui: 25 Agustus 2025</p>
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
// Smooth scrolling navigation
document.addEventListener('DOMContentLoaded', function() {
    const navLinks = document.querySelectorAll('.privacy-nav-list a');
    
    navLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Remove active class from all links
            navLinks.forEach(l => l.classList.remove('active'));
            
            // Add active class to clicked link
            this.classList.add('active');
            
            // Smooth scroll to target
            const targetId = this.getAttribute('href');
            const targetElement = document.querySelector(targetId);
            
            if (targetElement) {
                targetElement.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
    
    // Highlight current section on scroll
    window.addEventListener('scroll', function() {
        const sections = document.querySelectorAll('.privacy-section');
        const scrollPosition = window.scrollY + 100;
        const sidebar = document.querySelector('.privacy-navigation');
        
        sections.forEach(section => {
            const sectionTop = section.offsetTop;
            const sectionHeight = section.offsetHeight;
            const sectionId = section.getAttribute('id');
            const correspondingLink = document.querySelector(`a[href="#${sectionId}"]`);
            
            if (scrollPosition >= sectionTop && scrollPosition < sectionTop + sectionHeight) {
                navLinks.forEach(link => link.classList.remove('active'));
                if (correspondingLink) {
                    correspondingLink.classList.add('active');
                    
                    // Auto-scroll sidebar to show active link
                    const linkOffsetTop = correspondingLink.offsetTop;
                    const linkHeight = correspondingLink.offsetHeight;
                    const sidebarHeight = sidebar.offsetHeight;
                    const sidebarScrollTop = sidebar.scrollTop;
                    
                    // Calculate if the active link is outside visible area
                    const linkBottom = linkOffsetTop + linkHeight;
                    const visibleTop = sidebarScrollTop;
                    const visibleBottom = sidebarScrollTop + sidebarHeight;
                    
                    // Scroll sidebar if active link is not fully visible
                    if (linkOffsetTop < visibleTop) {
                        // Link is above visible area, scroll up
                        sidebar.scrollTo({
                            top: linkOffsetTop - 20,
                            behavior: 'smooth'
                        });
                    } else if (linkBottom > visibleBottom) {
                        // Link is below visible area, scroll down
                        sidebar.scrollTo({
                            top: linkOffsetTop - sidebarHeight + linkHeight + 20,
                            behavior: 'smooth'
                        });
                    }
                }
            }
        });
    });

    // Elegant Back to Top Functionality
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
