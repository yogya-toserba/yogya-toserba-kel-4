<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kebijakan Return - MyYOGYA</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
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

        /* Privacy Page Styles */
        .privacy-hero {
            margin-top: 0 !important;
            padding-top: 50px;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            padding: 50px 0 100px 0;
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

        .privacy-highlight {
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.1), rgba(118, 75, 162, 0.1));
            border-left: 4px solid var(--primary-color);
            border-radius: 10px;
            padding: 1.5rem;
            margin: 1.5rem 0;
        }

        .privacy-highlight h5 {
            color: var(--primary-color);
            font-weight: 600;
            margin-bottom: 0.75rem;
        }

        .privacy-highlight p {
            margin-bottom: 0;
            color: var(--gray-700);
            line-height: 1.6;
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

        .return-process-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 1.5rem;
            margin: 2rem 0;
        }

        .return-process-card {
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.05), rgba(118, 75, 162, 0.05));
            border: 1px solid rgba(102, 126, 234, 0.2);
            border-radius: 15px;
            padding: 2rem;
            text-align: center;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .return-process-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(102, 126, 234, 0.2);
            border-color: var(--primary-color);
        }

        .return-process-icon {
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
            margin-top: 0 !important;
            padding-top: 50px;
                padding: 60px 0;
            }
            
            .section-title {
                font-size: 1.5rem;
            }
            
            .return-process-grid {
                grid-template-columns: 1fr;
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
                    <span class="current">Kebijakan Return</span>
                </nav>
                
                <h1 class="display-4 fw-bold mb-4">Kebijakan <span class="text-warning">Return</span></h1>
                <p class="lead mb-4">Ketentuan lengkap mengenai prosedur return dan pengembalian produk di MyYOGYA untuk memberikan kepuasan dan kemudahan berbelanja bagi pelanggan.</p>
                <div class="d-flex justify-content-center gap-4 flex-wrap">
                    <div class="text-center">
                        <i class="fas fa-undo-alt mb-2" style="font-size: 2rem;"></i>
                        <h5 class="mb-1 fw-bold">7 Hari</h5>
                        <p class="mb-0 opacity-75">Garansi Return</p>
                    </div>
                    <div class="text-center">
                        <i class="fas fa-shipping-fast mb-2" style="font-size: 2rem;"></i>
                        <h5 class="mb-1 fw-bold">Gratis Ongkir</h5>
                        <p class="mb-0 opacity-75">Return Bergaransi</p>
                    </div>
                    <div class="text-center">
                        <i class="fas fa-money-bill-wave mb-2" style="font-size: 2rem;"></i>
                        <h5 class="mb-1 fw-bold">Full Refund</h5>
                        <p class="mb-0 opacity-75">Uang Kembali 100%</p>
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
                        <li><a href="#ketentuan-umum" class="nav-link">1. Ketentuan Umum</a></li>
                        <li><a href="#syarat-return" class="nav-link">2. Syarat Return</a></li>
                        <li><a href="#prosedur-return" class="nav-link">3. Prosedur Return</a></li>
                        <li><a href="#waktu-proses" class="nav-link">4. Waktu Proses</a></li>
                        <li><a href="#jenis-refund" class="nav-link">5. Jenis Refund</a></li>
                        <li><a href="#pengecualian" class="nav-link">6. Pengecualian</a></li>
                        <li><a href="#kontak-bantuan" class="nav-link">7. Kontak Bantuan</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="col-lg-9">
                <div class="privacy-content">
                    <!-- Section 1: Ketentuan Umum -->
                    <div id="ketentuan-umum" class="privacy-section">
                        <h2 class="section-title">1. Ketentuan Umum Return</h2>
                        <p class="privacy-text">MyYOGYA berkomitmen memberikan pengalaman berbelanja yang memuaskan. Kami menyediakan kebijakan return yang jelas dan mudah untuk memastikan kepuasan pelanggan dalam setiap transaksi pembelian.</p>
                        
                        <div class="highlight-box">
                            <h6><i class="fas fa-shield-alt me-2"></i>Jaminan Kepuasan</h6>
                            <p>Kebijakan return ini berlaku untuk semua pembelian yang dilakukan melalui platform MyYOGYA, baik melalui website, aplikasi mobile, maupun marketplace resmi kami. Kami menjamin proses return yang mudah dan transparan.</p>
                        </div>

                        <h3 class="subsection-title">1.1 Hak Return Pelanggan</h3>
                        <ul class="privacy-list">
                            <li>Pelanggan berhak melakukan return produk dalam waktu 7 (tujuh) hari sejak barang diterima</li>
                            <li>Return dapat dilakukan untuk semua kategori produk kecuali yang dikecualikan dalam kebijakan ini</li>
                            <li>Tidak dikenakan biaya tambahan untuk proses return yang sesuai ketentuan</li>
                            <li>Pelanggan berhak mendapat pengembalian dana penuh sesuai metode pembayaran awal</li>
                            <li>Proses return dijamin selesai maksimal 14 hari kerja</li>
                        </ul>
                    </div>

                    <!-- Section 2: Syarat Return -->
                    <div id="syarat-return" class="privacy-section">
                        <h2 class="section-title">2. Syarat dan Ketentuan Return</h2>
                        
                        <h3 class="subsection-title">2.1 Syarat Umum</h3>
                        <ul class="privacy-list">
                            <li><strong>Batas Waktu:</strong> Maksimal 7 hari sejak barang diterima pelanggan</li>
                            <li><strong>Kondisi Barang:</strong> Dalam kondisi asli, belum digunakan, dan kemasan utuh</li>
                            <li><strong>Bukti Pembelian:</strong> Menyertakan nota pembelian atau invoice asli</li>
                            <li><strong>Kelengkapan:</strong> Semua label, tag, aksesoris, dan kemasan asli masih terpasang/tersedia</li>
                            <li><strong>Kualitas:</strong> Tidak ada kerusakan yang disebabkan oleh pemakaian</li>
                        </ul>

                        <div class="warning-box">
                            <h6><i class="fas fa-exclamation-triangle me-2"></i>Perhatian Penting</h6>
                            <p>Barang yang tidak memenuhi syarat return di atas akan ditolak dan dikembalikan kepada pelanggan dengan biaya pengiriman ditanggung pelanggan.</p>
                        </div>

                        <div class="return-process-grid">
                            <div class="return-process-card">
                                <div class="return-process-icon">
                                    <i class="fas fa-tshirt"></i>
                                </div>
                                <h5>Fashion & Pakaian</h5>
                                <p class="privacy-text">Tag harga masih terpasang, tidak ada noda atau bau, kemasan plastik asli (jika ada).</p>
                            </div>
                            <div class="return-process-card">
                                <div class="return-process-icon">
                                    <i class="fas fa-mobile-alt"></i>
                                </div>
                                <h5>Elektronik</h5>
                                <p class="privacy-text">Kotak dan aksesoris lengkap, tidak ada kerusakan fisik, garansi masih berlaku.</p>
                            </div>
                            <div class="return-process-card">
                                <div class="return-process-icon">
                                    <i class="fas fa-home"></i>
                                </div>
                                <h5>Rumah Tangga</h5>
                                <p class="privacy-text">Tidak ada tanda-tanda pemakaian, kemasan asli, manual lengkap.</p>
                            </div>
                            <div class="return-process-card">
                                <div class="return-process-icon">
                                    <i class="fas fa-book"></i>
                                </div>
                                <h5>Buku & Media</h5>
                                <p class="privacy-text">Tidak ada lipatan, coretan, atau kerusakan cover, kemasan plastik masih utuh.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Section 3: Prosedur Return -->
                    <div id="prosedur-return" class="privacy-section">
                        <h2 class="section-title">3. Prosedur Return</h2>
                        
                        <p class="privacy-text">Proses return di MyYOGYA dirancang untuk kemudahan pelanggan dengan langkah-langkah yang jelas dan sistematis:</p>

                        <div class="return-process-grid">
                            <div class="return-process-card">
                                <div class="return-process-icon">
                                    <i class="fas fa-phone"></i>
                                </div>
                                <h5>1. Hubungi CS</h5>
                                <p class="privacy-text">Hubungi customer service melalui telepon, email, atau live chat dengan nomor order.</p>
                            </div>
                            <div class="return-process-card">
                                <div class="return-process-icon">
                                    <i class="fas fa-clipboard-list"></i>
                                </div>
                                <h5>2. Isi Form Return</h5>
                                <p class="privacy-text">Lengkapi form return dengan informasi produk dan alasan return yang jelas.</p>
                            </div>
                            <div class="return-process-card">
                                <div class="return-process-icon">
                                    <i class="fas fa-shipping-fast"></i>
                                </div>
                                <h5>3. Kirim Barang</h5>
                                <p class="privacy-text">Kemas barang dengan rapi dan kirim ke alamat yang telah ditentukan.</p>
                            </div>
                            <div class="return-process-card">
                                <div class="return-process-icon">
                                    <i class="fas fa-check-circle"></i>
                                </div>
                                <h5>4. Konfirmasi Diterima</h5>
                                <p class="privacy-text">Tunggu konfirmasi dari tim kami bahwa barang return telah diterima dan diproses.</p>
                            </div>
                        </div>

                        <div class="highlight-box">
                            <h6><i class="fas fa-info-circle me-2"></i>Tips Return Mudah</h6>
                            <p>Untuk mempercepat proses, pastikan Anda sudah menyiapkan nomor order, foto kondisi barang, dan alasan return yang jelas sebelum menghubungi customer service kami.</p>
                        </div>
                    </div>

                    <!-- Section 4: Waktu Proses -->
                    <div id="waktu-proses" class="privacy-section">
                        <h2 class="section-title">4. Estimasi Waktu Proses</h2>
                        
                        <p class="privacy-text">Kami berkomitmen memberikan proses return yang cepat dan efisien:</p>

                        <div class="return-process-grid">
                            <div class="return-process-card">
                                <div class="return-process-icon">
                                    <i class="fas fa-shipping-fast"></i>
                                </div>
                                <h5>Pengiriman Return</h5>
                                <p class="privacy-text"><strong>1-3 Hari Kerja</strong><br>Tergantung lokasi dan jasa pengiriman</p>
                            </div>
                            <div class="return-process-card">
                                <div class="return-process-icon">
                                    <i class="fas fa-search"></i>
                                </div>
                                <h5>Verifikasi QC</h5>
                                <p class="privacy-text"><strong>1-2 Hari Kerja</strong><br>Pemeriksaan kondisi dan kelengkapan</p>
                            </div>
                            <div class="return-process-card">
                                <div class="return-process-icon">
                                    <i class="fas fa-money-bill-wave"></i>
                                </div>
                                <h5>Proses Refund</h5>
                                <p class="privacy-text"><strong>1-7 Hari Kerja</strong><br>Sesuai metode pembayaran</p>
                            </div>
                            <div class="return-process-card">
                                <div class="return-process-icon">
                                    <i class="fas fa-bell"></i>
                                </div>
                                <h5>Notifikasi Selesai</h5>
                                <p class="privacy-text"><strong>1 Hari Kerja</strong><br>Email konfirmasi refund berhasil</p>
                            </div>
                        </div>

                        <div class="warning-box">
                            <h6><i class="fas fa-clock me-2"></i>Catatan Waktu Proses</h6>
                            <p>Estimasi waktu di atas dapat berubah tergantung kondisi tertentu seperti hari libur nasional, kondisi cuaca ekstrem, atau volume return yang tinggi pada periode tertentu.</p>
                        </div>
                    </div>

                    <!-- Section 5: Jenis Refund -->
                    <div id="jenis-refund" class="privacy-section">
                        <h2 class="section-title">5. Metode Pengembalian Dana</h2>
                        
                        <p class="privacy-text">Dana return akan dikembalikan sesuai dengan metode pembayaran yang digunakan saat pembelian:</p>

                        <div class="return-process-grid">
                            <div class="return-process-card">
                                <div class="return-process-icon">
                                    <i class="fas fa-university"></i>
                                </div>
                                <h5>Transfer Bank</h5>
                                <p class="privacy-text">Dana dikembalikan ke rekening bank yang sama dengan pembayaran awal dalam 3-7 hari kerja.</p>
                            </div>
                            <div class="return-process-card">
                                <div class="return-process-icon">
                                    <i class="fas fa-credit-card"></i>
                                </div>
                                <h5>Kartu Kredit/Debit</h5>
                                <p class="privacy-text">Refund otomatis ke kartu yang digunakan untuk transaksi dalam 7-14 hari kerja.</p>
                            </div>
                            <div class="return-process-card">
                                <div class="return-process-icon">
                                    <i class="fas fa-mobile-alt"></i>
                                </div>
                                <h5>E-Wallet</h5>
                                <p class="privacy-text">Kembali ke e-wallet yang sama (OVO, DANA, GoPay, dll) dalam 1-3 hari kerja.</p>
                            </div>
                            <div class="return-process-card">
                                <div class="return-process-icon">
                                    <i class="fas fa-coins"></i>
                                </div>
                                <h5>MyYOGYA Credits</h5>
                                <p class="privacy-text">Dana dalam bentuk store credit yang bisa digunakan untuk pembelian berikutnya.</p>
                            </div>
                        </div>

                        <div class="highlight-box">
                            <h6><i class="fas fa-money-check-alt me-2"></i>Jaminan Refund Penuh</h6>
                            <p>MyYOGYA menjamin pengembalian dana 100% untuk return yang disetujui, termasuk biaya pengiriman awal jika produk mengalami cacat atau tidak sesuai deskripsi.</p>
                        </div>
                    </div>

                    <!-- Section 6: Pengecualian -->
                    <div id="pengecualian" class="privacy-section">
                        <h2 class="section-title">6. Produk yang Tidak Dapat Di-Return</h2>
                        
                        <p class="privacy-text">Untuk alasan kesehatan, keamanan, dan kebersihan, beberapa kategori produk tidak dapat di-return:</p>

                        <div class="return-process-grid">
                            <div class="return-process-card">
                                <div class="return-process-icon">
                                    <i class="fas fa-exclamation-triangle"></i>
                                </div>
                                <h5>Pakaian Dalam</h5>
                                <p class="privacy-text">Untuk alasan kebersihan dan kesehatan personal.</p>
                            </div>
                            <div class="return-process-card">
                                <div class="return-process-icon">
                                    <i class="fas fa-palette"></i>
                                </div>
                                <h5>Kosmetik Terbuka</h5>
                                <p class="privacy-text">Produk yang sudah dibuka atau digunakan untuk mencegah kontaminasi.</p>
                            </div>
                            <div class="return-process-card">
                                <div class="return-process-icon">
                                    <i class="fas fa-apple-alt"></i>
                                </div>
                                <h5>Makanan & Minuman</h5>
                                <p class="privacy-text">Produk konsumsi dan yang mudah rusak atau kadaluarsa.</p>
                            </div>
                            <div class="return-process-card">
                                <div class="return-process-icon">
                                    <i class="fas fa-prescription-bottle"></i>
                                </div>
                                <h5>Produk Kesehatan</h5>
                                <p class="privacy-text">Obat-obatan, suplemen, dan produk medis untuk keamanan konsumen.</p>
                            </div>
                        </div>

                        <div class="warning-box">
                            <h6><i class="fas fa-ban me-2"></i>Pengecualian Lainnya</h6>
                            <p>Produk custom/pesanan khusus, voucher/gift card yang sudah digunakan, dan produk digital juga tidak dapat di-return. Namun, jika terdapat kerusakan atau cacat produksi, pelanggan tetap dapat mengajukan klaim garansi.</p>
                        </div>
                    </div>

                    <!-- Section 7: Kontak Bantuan -->
                    <div id="kontak-bantuan" class="privacy-section">
                        <h2 class="section-title">7. Kontak Customer Service</h2>
                        
                        <p class="privacy-text">Tim customer service MyYOGYA siap membantu proses return Anda:</p>

                        <div class="return-process-grid">
                            <div class="return-process-card">
                                <div class="return-process-icon">
                                    <i class="fas fa-phone"></i>
                                </div>
                                <h5>Telepon</h5>
                                <p class="privacy-text"><strong>(0274) 512345</strong><br>Senin-Jumat: 08:00-17:00</p>
                            </div>
                            <div class="return-process-card">
                                <div class="return-process-icon">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <h5>Email</h5>
                                <p class="privacy-text"><strong>return@myyogya.com</strong><br>Respon maksimal 24 jam</p>
                            </div>
                            <div class="return-process-card">
                                <div class="return-process-icon">
                                    <i class="fas fa-comments"></i>
                                </div>
                                <h5>Live Chat</h5>
                                <p class="privacy-text"><strong>Chat di Website</strong><br>Senin-Sabtu: 08:00-22:00</p>
                            </div>
                            <div class="return-process-card">
                                <div class="return-process-icon">
                                    <i class="fab fa-whatsapp"></i>
                                </div>
                                <h5>WhatsApp</h5>
                                <p class="privacy-text"><strong>+62 821 1234 5678</strong><br>Respons cepat 24/7</p>
                            </div>
                        </div>

                        <div class="contact-info">
                            <h5 class="contact-title">Butuh Bantuan Lebih Lanjut?</h5>
                            <p class="contact-text">Tim customer service MyYOGYA siap membantu Anda 24/7 untuk semua kebutuhan return dan refund</p>
                            
                            <div class="contact-methods">
                                <div class="contact-method">
                                    <div class="contact-icon">
                                        <i class="fab fa-whatsapp"></i>
                                    </div>
                                    <div class="contact-details">
                                        <h6>WhatsApp</h6>
                                        <p>+62 812-3456-7890</p>
                                    </div>
                                </div>
                                
                                <div class="contact-method">
                                    <div class="contact-icon">
                                        <i class="fas fa-envelope"></i>
                                    </div>
                                    <div class="contact-details">
                                        <h6>Email Support</h6>
                                        <p>support@myyogya.co.id</p>
                                    </div>
                                </div>
                                
                                <div class="contact-method">
                                    <div class="contact-icon">
                                        <i class="fas fa-headset"></i>
                                    </div>
                                    <div class="contact-details">
                                        <h6>Call Center</h6>
                                        <p>021-1234-5678</p>
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
                    <a href="https://www.google.com/maps?q=Jl.%20Perintis%20Kemerdekaan%20No.57%2C%20Ciamis%2C%20Kec.%20Ciamis%2C%20Kabupaten%20Ciamis%2C%20Jawa%20Barat%2046211%2C%20Indonesia" target="_blank" rel="noopener" title="Lihat lokasi di Google Maps (Jl. Perintis Kemerdekaan No.57, Ciamis Â· +62 265 777779)" aria-label="Lokasi">
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

