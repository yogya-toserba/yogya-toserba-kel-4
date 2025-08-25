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
                        
                        <h3 class="subsection-title">1.1 Hak Return Pelanggan</h3>
                        <ul class="privacy-list">
                            <li>Pelanggan berhak melakukan return produk dalam waktu 7 (tujuh) hari sejak barang diterima</li>
                            <li>Return dapat dilakukan untuk semua kategori produk kecuali yang dikecualikan dalam kebijakan ini</li>
                            <li>Tidak dikenakan biaya tambahan untuk proses return yang sesuai ketentuan</li>
                            <li>Pelanggan berhak mendapat pengembalian dana penuh sesuai metode pembayaran awal</li>
                        </ul>

                        <div class="privacy-highlight">
                            <h5>Catatan Penting</h5>
                            <p>Kebijakan return ini berlaku untuk semua pembelian yang dilakukan melalui platform MyYOGYA, baik melalui website, aplikasi mobile, maupun marketplace resmi kami.</p>
                        </div>
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
                        </ul>

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
                        </div>
                    </div>

                    <!-- Section 3: Prosedur Return -->
                    <div id="prosedur-return" class="privacy-section">
                        <h2 class="section-title">3. Prosedur Return</h2>
                        
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
                        </div>
                    </div>

                    <!-- Section 4: Waktu Proses -->
                    <div id="waktu-proses" class="privacy-section">
                        <h2 class="section-title">4. Estimasi Waktu Proses</h2>
                        
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
                        </div>
                    </div>

                    <!-- Section 5: Jenis Refund -->
                    <div id="jenis-refund" class="privacy-section">
                        <h2 class="section-title">5. Metode Pengembalian Dana</h2>
                        
                        <div class="return-process-grid">
                            <div class="return-process-card">
                                <div class="return-process-icon">
                                    <i class="fas fa-university"></i>
                                </div>
                                <h5>Transfer Bank</h5>
                                <p class="privacy-text">Dana dikembalikan ke rekening bank yang sama dengan pembayaran awal.</p>
                            </div>
                            <div class="return-process-card">
                                <div class="return-process-icon">
                                    <i class="fas fa-credit-card"></i>
                                </div>
                                <h5>Kartu Kredit/Debit</h5>
                                <p class="privacy-text">Refund otomatis ke kartu yang digunakan untuk transaksi.</p>
                            </div>
                            <div class="return-process-card">
                                <div class="return-process-icon">
                                    <i class="fas fa-mobile-alt"></i>
                                </div>
                                <h5>E-Wallet</h5>
                                <p class="privacy-text">Kembali ke e-wallet yang sama (OVO, DANA, GoPay, dll).</p>
                            </div>
                        </div>
                    </div>

                    <!-- Section 6: Pengecualian -->
                    <div id="pengecualian" class="privacy-section">
                        <h2 class="section-title">6. Produk yang Tidak Dapat Di-Return</h2>
                        
                        <div class="return-process-grid">
                            <div class="return-process-card">
                                <div class="return-process-icon">
                                    <i class="fas fa-exclamation-triangle"></i>
                                </div>
                                <h5>Pakaian Dalam</h5>
                                <p class="privacy-text">Untuk alasan kebersihan dan kesehatan.</p>
                            </div>
                            <div class="return-process-card">
                                <div class="return-process-icon">
                                    <i class="fas fa-palette"></i>
                                </div>
                                <h5>Kosmetik Terbuka</h5>
                                <p class="privacy-text">Produk yang sudah dibuka atau digunakan.</p>
                            </div>
                            <div class="return-process-card">
                                <div class="return-process-icon">
                                    <i class="fas fa-apple-alt"></i>
                                </div>
                                <h5>Makanan & Minuman</h5>
                                <p class="privacy-text">Produk konsumsi dan yang mudah rusak.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Section 7: Kontak Bantuan -->
                    <div id="kontak-bantuan" class="privacy-section">
                        <h2 class="section-title">7. Kontak Customer Service</h2>
                        
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
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const navLinks = document.querySelectorAll('.privacy-nav-list .nav-link');
    
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
