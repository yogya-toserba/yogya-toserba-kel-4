<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kebijakan Privasi - MyYOGYA</title>
    
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
            background: var(--primary-color);
            border-radius: 50%;
        }

        .data-table {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 8px 32px rgba(0,0,0,0.1);
            margin: 2rem 0;
        }

        .data-table table {
            margin: 0;
        }

        .data-table thead {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
        }

        .data-table th {
            padding: 1.5rem 1rem;
            font-weight: 600;
            border: none;
        }

        .data-table td {
            padding: 1.25rem 1rem;
            border-color: #f0f0f0;
            vertical-align: middle;
        }

        .data-table tbody tr:hover {
            background-color: #f8f9fa;
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

        .security-box {
            background: linear-gradient(135deg, #e8f5e8, #c8e6c9);
            border: 1px solid #4caf50;
            border-radius: 16px;
            padding: 2rem;
            margin: 2rem 0;
            position: relative;
            overflow: hidden;
        }

        .security-box::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(135deg, #4caf50, #388e3c);
        }

        .security-box h6 {
            color: #2e7d32;
            font-weight: 600;
            margin-bottom: 1rem;
            font-size: 1.1rem;
        }

        .security-box p {
            color: #1b5e20;
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

        .rights-section {
            background: linear-gradient(135deg, #f3e5f5, #e1bee7);
            border-radius: 20px;
            padding: 2.5rem;
            margin: 2rem 0;
        }

        .rights-title {
            font-weight: 700;
            font-size: 1.5rem;
            color: #4a148c;
            margin-bottom: 1.5rem;
            text-align: center;
        }

        .rights-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-top: 2rem;
        }

        .right-item {
            background: white;
            padding: 1.5rem;
            border-radius: 12px;
            box-shadow: 0 4px 16px rgba(0,0,0,0.1);
            text-align: center;
            transition: all 0.3s ease;
        }

        .right-item:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 24px rgba(0,0,0,0.15);
        }

        .right-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            color: white;
            font-size: 1.5rem;
        }

        .right-title {
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: var(--dark-color);
        }

        .right-desc {
            color: var(--gray-600);
            font-size: 0.9rem;
            line-height: 1.5;
            margin: 0;
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

        /* Responsive */
        @media (max-width: 768px) {
            .privacy-hero {
                padding: 60px 0;
            }
            
            .privacy-navigation {
                position: static;
                margin-bottom: 2rem;
            }
            
            .privacy-content {
                padding: 2rem;
            }
            
            .section-title {
                font-size: 1.5rem;
            }
            
            .contact-methods {
                flex-direction: column;
                align-items: center;
            }

            .rights-grid {
                grid-template-columns: 1fr;
            }
        }

        /* Smooth scrolling */
        html {
            scroll-behavior: smooth;
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
                    <span class="current">Kebijakan Privasi</span>
                </nav>
                
                <h1 class="display-4 fw-bold mb-4">Kebijakan <span class="text-warning">Privasi</span></h1>
                <p class="lead mb-4">Komitmen MyYOGYA dalam melindungi privasi dan keamanan data pribadi pengguna sesuai dengan peraturan perlindungan data yang berlaku.</p>
                <div class="d-flex justify-content-center gap-4 flex-wrap">
                    <div class="text-center">
                        <i class="fas fa-shield-alt mb-2" style="font-size: 2rem;"></i>
                        <h5 class="mb-1 fw-bold">100% Aman</h5>
                        <p class="mb-0 opacity-75">Data Terenkripsi</p>
                    </div>
                    <div class="text-center">
                        <i class="fas fa-user-lock mb-2" style="font-size: 2rem;"></i>
                        <h5 class="mb-1 fw-bold">Privasi Terjaga</h5>
                        <p class="mb-0 opacity-75">Tidak Dibagikan</p>
                    </div>
                    <div class="text-center">
                        <i class="fas fa-certificate mb-2" style="font-size: 2rem;"></i>
                        <h5 class="mb-1 fw-bold">Standar Internasional</h5>
                        <p class="mb-0 opacity-75">ISO 27001</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Privacy Content -->
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="privacy-navigation">
                    <h6 class="privacy-nav-title">Daftar Isi</h6>
                    <ul class="privacy-nav-list">
                        <li><a href="#pendahuluan" class="nav-link">Pendahuluan</a></li>
                        <li><a href="#data-dikumpulkan" class="nav-link">Data yang Dikumpulkan</a></li>
                        <li><a href="#cara-pengumpulan" class="nav-link">Cara Pengumpulan</a></li>
                        <li><a href="#tujuan-penggunaan" class="nav-link">Tujuan Penggunaan</a></li>
                        <li><a href="#pembagian-data" class="nav-link">Pembagian Data</a></li>
                        <li><a href="#keamanan-data" class="nav-link">Keamanan Data</a></li>
                        <li><a href="#hak-pengguna" class="nav-link">Hak Pengguna</a></li>
                        <li><a href="#cookies" class="nav-link">Cookies & Tracking</a></li>
                        <li><a href="#retensi-data" class="nav-link">Retensi Data</a></li>
                        <li><a href="#perubahan-kebijakan" class="nav-link">Perubahan Kebijakan</a></li>
                        <li><a href="#kontak-dpo" class="nav-link">Kontak DPO</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="col-lg-9">
                <div class="privacy-content">
                    <!-- Section 1: Pendahuluan -->
                    <div id="pendahuluan" class="privacy-section">
                        <h2 class="section-title">1. Pendahuluan</h2>
                        <p class="privacy-text">MyYOGYA berkomitmen untuk melindungi privasi dan keamanan informasi pribadi Anda. Kebijakan Privasi ini menjelaskan bagaimana kami mengumpulkan, menggunakan, menyimpan, dan melindungi informasi pribadi Anda saat menggunakan platform e-commerce MyYOGYA.</p>
                        
                        <div class="highlight-box">
                            <h6><i class="fas fa-info-circle me-2"></i>Penting untuk Diketahui</h6>
                            <p>Dengan menggunakan layanan MyYOGYA, Anda menyetujui praktik penanganan data yang dijelaskan dalam kebijakan ini. Jika Anda tidak setuju, mohon untuk tidak menggunakan layanan kami.</p>
                        </div>

                        <p class="privacy-text">Kebijakan ini berlaku untuk semua pengguna MyYOGYA dan sejalan dengan Undang-Undang No. 27 Tahun 2022 tentang Perlindungan Data Pribadi (UU PDP) dan peraturan terkait lainnya.</p>
                    </div>

                    <!-- Section 2: Data yang Dikumpulkan -->
                    <div id="data-dikumpulkan" class="privacy-section">
                        <h2 class="section-title">2. Data yang Kami Kumpulkan</h2>
                        <p class="privacy-text">Kami mengumpulkan berbagai jenis informasi untuk menyediakan layanan terbaik kepada Anda:</p>
                        
                        <h4 class="subsection-title">2.1 Data Pribadi</h4>
                        <ul class="privacy-list">
                            <li><strong>Informasi Identitas:</strong> Nama lengkap, tanggal lahir, jenis kelamin</li>
                            <li><strong>Informasi Kontak:</strong> Alamat email, nomor telepon, alamat rumah</li>
                            <li><strong>Dokumen Identitas:</strong> Nomor KTP/SIM/Paspor (jika diperlukan)</li>
                            <li><strong>Informasi Finansial:</strong> Detail kartu kredit/debit, rekening bank</li>
                            <li><strong>Foto Profil:</strong> Gambar yang Anda unggah ke akun</li>
                        </ul>

                        <h4 class="subsection-title">2.2 Data Transaksi</h4>
                        <ul class="privacy-list">
                            <li>Riwayat pembelian dan pesanan</li>
                            <li>Preferensi produk dan kategori</li>
                            <li>Metode pembayaran yang digunakan</li>
                            <li>Alamat pengiriman dan penagihan</li>
                            <li>Review dan rating produk</li>
                        </ul>

                        <h4 class="subsection-title">2.3 Data Teknis</h4>
                        <div class="data-table">
                            <table class="table table-striped mb-0">
                                <thead>
                                    <tr>
                                        <th>Jenis Data</th>
                                        <th>Contoh</th>
                                        <th>Tujuan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><strong>Informasi Perangkat</strong></td>
                                        <td>IP address, browser, OS</td>
                                        <td>Keamanan & optimasi</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Data Lokasi</strong></td>
                                        <td>GPS, Wi-Fi, cell tower</td>
                                        <td>Layanan berbasis lokasi</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Log Aktivitas</strong></td>
                                        <td>Halaman dikunjungi, waktu</td>
                                        <td>Analisis penggunaan</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Cookies</strong></td>
                                        <td>Session ID, preferensi</td>
                                        <td>Personalisasi pengalaman</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Section 3: Cara Pengumpulan -->
                    <div id="cara-pengumpulan" class="privacy-section">
                        <h2 class="section-title">3. Cara Kami Mengumpulkan Data</h2>
                        <p class="privacy-text">Data pribadi Anda dikumpulkan melalui berbagai cara yang transparan dan sesuai hukum:</p>
                        
                        <h4 class="subsection-title">3.1 Langsung dari Anda</h4>
                        <ul class="privacy-list">
                            <li>Saat registrasi akun atau mengisi profil</li>
                            <li>Ketika melakukan transaksi pembelian</li>
                            <li>Mengisi formulir kontak atau customer service</li>
                            <li>Berpartisipasi dalam survei atau promosi</li>
                            <li>Memberikan review dan feedback</li>
                        </ul>

                        <h4 class="subsection-title">3.2 Otomatis saat Menggunakan Layanan</h4>
                        <ul class="privacy-list">
                            <li>Cookies dan teknologi pelacakan serupa</li>
                            <li>Log server dan analitik website</li>
                            <li>Interaksi dengan fitur-fitur platform</li>
                            <li>Data lokasi (dengan persetujuan)</li>
                        </ul>

                        <h4 class="subsection-title">3.3 Dari Pihak Ketiga</h4>
                        <ul class="privacy-list">
                            <li>Mitra pembayaran dan ekspedisi</li>
                            <li>Platform media sosial (login sosial)</li>
                            <li>Layanan verifikasi identitas</li>
                            <li>Penyedia layanan analitik</li>
                        </ul>
                    </div>

                    <!-- Section 4: Tujuan Penggunaan -->
                    <div id="tujuan-penggunaan" class="privacy-section">
                        <h2 class="section-title">4. Tujuan Penggunaan Data</h2>
                        <p class="privacy-text">Kami menggunakan data pribadi Anda untuk berbagai tujuan yang sah dan bermanfaat:</p>
                        
                        <h4 class="subsection-title">4.1 Penyediaan Layanan</h4>
                        <ul class="privacy-list">
                            <li>Memproses dan memenuhi pesanan Anda</li>
                            <li>Mengelola akun dan profil pengguna</li>
                            <li>Menyediakan customer service dan dukungan teknis</li>
                            <li>Memfasilitasi komunikasi terkait pesanan</li>
                            <li>Memproses pembayaran dan refund</li>
                        </ul>

                        <h4 class="subsection-title">4.2 Peningkatan Layanan</h4>
                        <ul class="privacy-list">
                            <li>Personalisasi pengalaman berbelanja</li>
                            <li>Rekomendasi produk yang relevan</li>
                            <li>Analisis tren dan perilaku pengguna</li>
                            <li>Pengembangan fitur dan layanan baru</li>
                            <li>Optimasi performa platform</li>
                        </ul>

                        <h4 class="subsection-title">4.3 Keamanan dan Kepatuhan</h4>
                        <ul class="privacy-list">
                            <li>Mencegah penipuan dan aktivitas mencurigakan</li>
                            <li>Memverifikasi identitas pengguna</li>
                            <li>Mematuhi kewajiban hukum dan regulasi</li>
                            <li>Menyelesaikan sengketa dan investigasi</li>
                            <li>Penegakan syarat dan ketentuan</li>
                        </ul>

                        <div class="security-box">
                            <h6><i class="fas fa-shield-alt me-2"></i>Komitmen Keamanan</h6>
                            <p>Semua penggunaan data dilakukan dengan standar keamanan tinggi dan hanya untuk tujuan yang telah dijelaskan. Kami tidak akan menggunakan data Anda untuk tujuan lain tanpa persetujuan eksplisit.</p>
                        </div>
                    </div>

                    <!-- Section 5: Pembagian Data -->
                    <div id="pembagian-data" class="privacy-section">
                        <h2 class="section-title">5. Pembagian dan Pengungkapan Data</h2>
                        <p class="privacy-text">MyYOGYA tidak menjual data pribadi Anda. Namun, kami dapat membagikan informasi dalam situasi tertentu:</p>
                        
                        <h4 class="subsection-title">5.1 Mitra Layanan Terpercaya</h4>
                        <ul class="privacy-list">
                            <li><strong>Payment Gateway:</strong> Untuk memproses pembayaran</li>
                            <li><strong>Ekspedisi:</strong> Untuk pengiriman produk</li>
                            <li><strong>Cloud Provider:</strong> Untuk penyimpanan data</li>
                            <li><strong>Email Service:</strong> Untuk komunikasi</li>
                            <li><strong>Analytics Provider:</strong> Untuk analisis website</li>
                        </ul>

                        <h4 class="subsection-title">5.2 Kewajiban Hukum</h4>
                        <ul class="privacy-list">
                            <li>Permintaan dari otoritas penegak hukum</li>
                            <li>Proses pengadilan atau investigasi resmi</li>
                            <li>Kepatuhan terhadap regulasi pemerintah</li>
                            <li>Perlindungan hak dan keamanan publik</li>
                        </ul>

                        <h4 class="subsection-title">5.3 Situasi Darurat</h4>
                        <ul class="privacy-list">
                            <li>Melindungi keselamatan pengguna atau publik</li>
                            <li>Mencegah aktivitas ilegal atau penipuan</li>
                            <li>Membela hak hukum MyYOGYA</li>
                        </ul>

                        <div class="warning-box">
                            <h6><i class="fas fa-exclamation-triangle me-2"></i>Perlindungan Mitra</h6>
                            <p>Semua mitra yang menerima data dari kami diwajibkan menandatangani perjanjian kerahasiaan dan mematuhi standar perlindungan data yang sama dengan MyYOGYA.</p>
                        </div>
                    </div>

                    <!-- Section 6: Keamanan Data -->
                    <div id="keamanan-data" class="privacy-section">
                        <h2 class="section-title">6. Keamanan dan Perlindungan Data</h2>
                        <p class="privacy-text">Kami menerapkan berbagai langkah keamanan teknis dan organisasional untuk melindungi data pribadi Anda:</p>
                        
                        <h4 class="subsection-title">6.1 Keamanan Teknis</h4>
                        <ul class="privacy-list">
                            <li><strong>Enkripsi:</strong> SSL/TLS 256-bit untuk transmisi data</li>
                            <li><strong>Firewall:</strong> Perlindungan jaringan berlapis</li>
                            <li><strong>Access Control:</strong> Autentikasi multi-faktor</li>
                            <li><strong>Monitoring:</strong> Pemantauan keamanan 24/7</li>
                            <li><strong>Backup:</strong> Pencadangan data reguler</li>
                        </ul>

                        <h4 class="subsection-title">6.2 Keamanan Organisasional</h4>
                        <ul class="privacy-list">
                            <li>Pelatihan keamanan data untuk karyawan</li>
                            <li>Kebijakan akses data berdasarkan kebutuhan</li>
                            <li>Audit keamanan internal dan eksternal</li>
                            <li>Rencana respons insiden keamanan</li>
                            <li>Sertifikasi keamanan internasional</li>
                        </ul>

                        <div class="security-box">
                            <h6><i class="fas fa-certificate me-2"></i>Sertifikasi Keamanan</h6>
                            <p>MyYOGYA telah memperoleh sertifikasi ISO 27001 untuk sistem manajemen keamanan informasi dan mematuhi standar PCI DSS untuk keamanan data kartu pembayaran.</p>
                        </div>
                    </div>

                    <!-- Section 7: Hak Pengguna -->
                    <div id="hak-pengguna" class="privacy-section">
                        <h2 class="section-title">7. Hak-Hak Anda</h2>
                        <p class="privacy-text">Sesuai dengan UU PDP, Anda memiliki berbagai hak terkait data pribadi Anda:</p>
                        
                        <div class="rights-section">
                            <h5 class="rights-title">Hak Data Pribadi Anda</h5>
                            <div class="rights-grid">
                                <div class="right-item">
                                    <div class="right-icon">
                                        <i class="fas fa-eye"></i>
                                    </div>
                                    <h6 class="right-title">Hak Akses</h6>
                                    <p class="right-desc">Melihat data pribadi apa saja yang kami simpan tentang Anda</p>
                                </div>
                                
                                <div class="right-item">
                                    <div class="right-icon">
                                        <i class="fas fa-edit"></i>
                                    </div>
                                    <h6 class="right-title">Hak Perbaikan</h6>
                                    <p class="right-desc">Memperbarui atau memperbaiki data yang tidak akurat</p>
                                </div>
                                
                                <div class="right-item">
                                    <div class="right-icon">
                                        <i class="fas fa-trash"></i>
                                    </div>
                                    <h6 class="right-title">Hak Penghapusan</h6>
                                    <p class="right-desc">Meminta penghapusan data dalam kondisi tertentu</p>
                                </div>
                                
                                <div class="right-item">
                                    <div class="right-icon">
                                        <i class="fas fa-download"></i>
                                    </div>
                                    <h6 class="right-title">Hak Portabilitas</h6>
                                    <p class="right-desc">Mendapatkan salinan data dalam format yang dapat dibaca</p>
                                </div>
                                
                                <div class="right-item">
                                    <div class="right-icon">
                                        <i class="fas fa-ban"></i>
                                    </div>
                                    <h6 class="right-title">Hak Pembatasan</h6>
                                    <p class="right-desc">Membatasi pemrosesan data dalam situasi tertentu</p>
                                </div>
                                
                                <div class="right-item">
                                    <div class="right-icon">
                                        <i class="fas fa-times-circle"></i>
                                    </div>
                                    <h6 class="right-title">Hak Keberatan</h6>
                                    <p class="right-desc">Menolak penggunaan data untuk tujuan tertentu</p>
                                </div>
                            </div>
                        </div>

                        <p class="privacy-text">Untuk menggunakan hak-hak di atas, silakan hubungi Data Protection Officer (DPO) kami melalui kontak yang tercantum di bagian akhir kebijakan ini.</p>
                    </div>

                    <!-- Section 8: Cookies -->
                    <div id="cookies" class="privacy-section">
                        <h2 class="section-title">8. Cookies dan Teknologi Pelacakan</h2>
                        <p class="privacy-text">Kami menggunakan cookies dan teknologi serupa untuk meningkatkan pengalaman Anda:</p>
                        
                        <h4 class="subsection-title">8.1 Jenis Cookies</h4>
                        <div class="data-table">
                            <table class="table table-striped mb-0">
                                <thead>
                                    <tr>
                                        <th>Jenis</th>
                                        <th>Tujuan</th>
                                        <th>Durasi</th>
                                        <th>Wajib</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><strong>Essential</strong></td>
                                        <td>Fungsi dasar website</td>
                                        <td>Session</td>
                                        <td>Ya</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Performance</strong></td>
                                        <td>Analisis kinerja</td>
                                        <td>2 tahun</td>
                                        <td>Tidak</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Functional</strong></td>
                                        <td>Preferensi pengguna</td>
                                        <td>1 tahun</td>
                                        <td>Tidak</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Marketing</strong></td>
                                        <td>Iklan yang relevan</td>
                                        <td>1 tahun</td>
                                        <td>Tidak</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <h4 class="subsection-title">8.2 Mengelola Cookies</h4>
                        <p class="privacy-text">Anda dapat mengelola preferensi cookies melalui:</p>
                        <ul class="privacy-list">
                            <li>Pengaturan browser Anda</li>
                            <li>Banner cookie di website kami</li>
                            <li>Halaman pengaturan privasi di akun Anda</li>
                            <li>Tools opt-out dari penyedia layanan analitik</li>
                        </ul>
                    </div>

                    <!-- Section 9: Retensi Data -->
                    <div id="retensi-data" class="privacy-section">
                        <h2 class="section-title">9. Retensi dan Penghapusan Data</h2>
                        <p class="privacy-text">Kami hanya menyimpan data pribadi selama diperlukan untuk tujuan yang telah ditetapkan:</p>
                        
                        <h4 class="subsection-title">9.1 Periode Retensi</h4>
                        <ul class="privacy-list">
                            <li><strong>Data Akun:</strong> Selama akun aktif + 3 tahun setelah penutupan</li>
                            <li><strong>Data Transaksi:</strong> 10 tahun untuk keperluan perpajakan</li>
                            <li><strong>Data Marketing:</strong> Hingga Anda menarik persetujuan</li>
                            <li><strong>Log Teknis:</strong> 2 tahun untuk tujuan keamanan</li>
                            <li><strong>Data Customer Service:</strong> 5 tahun setelah kasus selesai</li>
                        </ul>

                        <h4 class="subsection-title">9.2 Penghapusan Otomatis</h4>
                        <p class="privacy-text">Sistem kami secara otomatis akan menghapus data yang telah melewati periode retensi. Proses ini dilakukan secara aman dan tidak dapat dipulihkan.</p>
                    </div>

                    <!-- Section 10: Perubahan Kebijakan -->
                    <div id="perubahan-kebijakan" class="privacy-section">
                        <h2 class="section-title">10. Perubahan Kebijakan Privasi</h2>
                        <p class="privacy-text">Kami dapat memperbarui kebijakan ini dari waktu ke waktu untuk mencerminkan perubahan dalam praktik atau hukum yang berlaku:</p>
                        
                        <ul class="privacy-list">
                            <li>Perubahan material akan diberitahukan minimal 30 hari sebelumnya</li>
                            <li>Notifikasi akan dikirim melalui email dan banner di website</li>
                            <li>Versi terbaru selalu tersedia di halaman ini</li>
                            <li>Tanggal "terakhir diperbarui" akan selalu dicantumkan</li>
                        </ul>

                        <div class="highlight-box">
                            <h6><i class="fas fa-bell me-2"></i>Tetap Terinformasi</h6>
                            <p>Kami menyarankan Anda untuk meninjau kebijakan ini secara berkala. Penggunaan layanan yang berkelanjutan setelah perubahan menunjukkan penerimaan Anda terhadap kebijakan yang diperbarui.</p>
                        </div>
                    </div>

                    <!-- Section 11: Kontak DPO -->
                    <div id="kontak-dpo" class="privacy-section">
                        <h2 class="section-title">11. Data Protection Officer (DPO)</h2>
                        <p class="privacy-text">Untuk pertanyaan, keluhan, atau permintaan terkait data pribadi, silakan hubungi DPO kami:</p>

                        <div class="contact-info">
                            <h5 class="contact-title">Hubungi Data Protection Officer</h5>
                            <p class="contact-text">Tim DPO kami siap membantu Anda dengan segala pertanyaan terkait privasi dan perlindungan data</p>
                            
                            <div class="contact-methods">
                                <div class="contact-method">
                                    <div class="contact-icon">
                                        <i class="fas fa-envelope"></i>
                                    </div>
                                    <div class="contact-details">
                                        <h6>Email DPO</h6>
                                        <p>dpo@myyogya.co.id</p>
                                    </div>
                                </div>
                                
                                <div class="contact-method">
                                    <div class="contact-icon">
                                        <i class="fas fa-phone"></i>
                                    </div>
                                    <div class="contact-details">
                                        <h6>Hotline Privasi</h6>
                                        <p>021-1234-5679</p>
                                    </div>
                                </div>
                                
                                <div class="contact-method">
                                    <div class="contact-icon">
                                        <i class="fas fa-map-marker-alt"></i>
                                    </div>
                                    <div class="contact-details">
                                        <h6>Alamat Kantor</h6>
                                        <p>Jakarta, Indonesia</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="warning-box">
                            <h6><i class="fas fa-clock me-2"></i>Waktu Respons</h6>
                            <p>Kami berkomitmen untuk merespons setiap permintaan terkait data pribadi dalam waktu maksimal 30 hari sesuai dengan ketentuan UU PDP.</p>
                        </div>
                    </div>

                    <div class="last-updated">
                        <p><i class="fas fa-calendar-alt me-2"></i>Terakhir diperbarui: 15 Agustus 2025</p>
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
        
        sections.forEach(section => {
            const sectionTop = section.offsetTop;
            const sectionHeight = section.offsetHeight;
            const sectionId = section.getAttribute('id');
            const correspondingLink = document.querySelector(`a[href="#${sectionId}"]`);
            
            if (scrollPosition >= sectionTop && scrollPosition < sectionTop + sectionHeight) {
                navLinks.forEach(link => link.classList.remove('active'));
                if (correspondingLink) {
                    correspondingLink.classList.add('active');
                }
            }
        });
    });
});
</script>

</body>
</html>
