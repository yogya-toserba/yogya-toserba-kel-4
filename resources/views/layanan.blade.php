<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Layanan & Bantuan - MyYOGYA</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Custom CSS -->
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
    
    <style>
        /* Service Page Styles */
        .service-hero {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            padding: 100px 0;
            position: relative;
            overflow: hidden;
        }

        .service-hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Ccircle cx='30' cy='30' r='2'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E") repeat;
        }

        .service-hero .container {
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

        .service-card {
            background: white;
            padding: 2.5rem;
            border-radius: 16px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.1);
            text-align: center;
            height: 100%;
            transition: var(--transition);
            border: 1px solid #f0f0f0;
        }

        .service-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 16px 48px rgba(0,0,0,0.15);
            border-color: var(--primary-color);
        }

        .service-icon {
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

        .service-title {
            font-weight: 600;
            margin-bottom: 1rem;
            color: var(--dark-color);
            font-size: 1.25rem;
        }

        .service-description {
            color: var(--gray-600);
            line-height: 1.6;
            margin-bottom: 1.5rem;
        }

        .service-features {
            list-style: none;
            padding: 0;
            margin: 0;
            text-align: left;
        }

        .service-features li {
            padding: 0.5rem 0;
            position: relative;
            padding-left: 1.5rem;
            color: var(--gray-600);
        }

        .service-features li::before {
            content: '✓';
            position: absolute;
            left: 0;
            color: var(--primary-color);
            font-weight: bold;
        }

        .faq-item {
            background: white;
            border-radius: 12px;
            margin-bottom: 1rem;
            box-shadow: 0 4px 16px rgba(0,0,0,0.1);
            overflow: hidden;
        }

        .faq-question {
            padding: 1.5rem;
            background: var(--primary-color);
            color: white;
            font-weight: 600;
            cursor: pointer;
            position: relative;
            transition: all 0.3s ease;
        }

        .faq-question:hover {
            background: var(--secondary-color);
        }

        .faq-question::after {
            content: '+';
            position: absolute;
            right: 1.5rem;
            top: 50%;
            transform: translateY(-50%);
            font-size: 1.5rem;
            transition: transform 0.3s ease;
        }

        .faq-question.active::after {
            transform: translateY(-50%) rotate(45deg);
        }

        .faq-answer {
            padding: 0 1.5rem;
            max-height: 0;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .faq-answer.show {
            padding: 1.5rem;
            max-height: 200px;
        }

        .contact-card {
            background: white;
            padding: 2.5rem;
            border-radius: 16px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.1);
            text-align: center;
            height: 100%;
        }

        .contact-icon {
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

        .contact-title {
            font-weight: 600;
            margin-bottom: 1rem;
            color: var(--dark-color);
        }

        .contact-info {
            color: var(--gray-600);
            line-height: 1.6;
        }

        .contact-link {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
        }

        .contact-link:hover {
            color: var(--secondary-color);
            text-decoration: underline;
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

        /* Responsive */
        @media (max-width: 768px) {
            .hero-stats {
                flex-direction: column;
                gap: 1rem;
            }
            
            .service-hero {
                padding: 60px 0;
            }
            
            .section-title {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>
<!-- Hero Section -->
<div class="service-hero">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="hero-content">
                    <nav class="breadcrumb-custom">
                        <a href="{{ route('dashboard') }}">
                            <i class="fas fa-home me-1"></i>Beranda
                        </a>
                        <span class="mx-2">/</span>
                        <span class="current">Layanan & Bantuan</span>
                    </nav>
                    
                    <h1 class="display-4 fw-bold mb-4">Layanan & <span class="text-primary">Bantuan</span></h1>
                    <p class="lead mb-4">Kami siap membantu Anda 24/7 dengan berbagai layanan terbaik untuk pengalaman berbelanja yang sempurna di MyYOGYA.</p>
                    <div class="hero-stats">
                        <div class="stat-item">
                            <h3 class="stat-number">24/7</h3>
                            <p class="stat-label">Customer Support</p>
                        </div>
                        <div class="stat-item">
                            <h3 class="stat-number">99%</h3>
                            <p class="stat-label">Kepuasan Pelanggan</p>
                        </div>
                        <div class="stat-item">
                            <h3 class="stat-number">&lt;30s</h3>
                            <p class="stat-label">Respon Time</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="hero-image">
                    <img src="{{ asset('image/placeholder.png') }}" alt="Customer Support" class="img-fluid rounded-4 shadow-lg">
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Services Section -->
<section class="services-section py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center mb-5">
                <h2 class="section-title">Layanan Kami</h2>
                <p class="section-subtitle">Berbagai layanan unggulan yang kami tawarkan untuk memberikan pengalaman terbaik kepada setiap pelanggan MyYOGYA</p>
            </div>
        </div>
        
        <div class="row g-4">
            <div class="col-lg-4 col-md-6">
                <div class="service-card">
                    <div class="service-icon">
                        <i class="fas fa-headset"></i>
                    </div>
                    <h5 class="service-title">Customer Support 24/7</h5>
                    <p class="service-description">Tim customer service kami siap membantu Anda kapan saja melalui berbagai channel komunikasi.</p>
                    <ul class="service-features">
                        <li>Live chat real-time</li>
                        <li>Email support</li>
                        <li>Hotline telepon</li>
                        <li>FAQ komprehensif</li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="service-card">
                    <div class="service-icon">
                        <i class="fas fa-shipping-fast"></i>
                    </div>
                    <h5 class="service-title">Pengiriman Express</h5>
                    <p class="service-description">Layanan pengiriman cepat dan terpercaya ke seluruh Indonesia dengan berbagai pilihan ekspedisi.</p>
                    <ul class="service-features">
                        <li>Same day delivery</li>
                        <li>Next day delivery</li>
                        <li>Free shipping minimal pembelian</li>
                        <li>Tracking real-time</li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="service-card">
                    <div class="service-icon">
                        <i class="fas fa-undo-alt"></i>
                    </div>
                    <h5 class="service-title">Easy Return & Refund</h5>
                    <p class="service-description">Proses pengembalian dan penggantian barang yang mudah dengan jaminan uang kembali 100%.</p>
                    <ul class="service-features">
                        <li>Return 30 hari</li>
                        <li>Refund otomatis</li>
                        <li>Tukar barang gratis</li>
                        <li>Pickup service</li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="service-card">
                    <div class="service-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h5 class="service-title">Jaminan Produk Original</h5>
                    <p class="service-description">Semua produk di MyYOGYA dijamin 100% original dengan sertifikat keaslian dari brand resmi.</p>
                    <ul class="service-features">
                        <li>Sertifikat keaslian</li>
                        <li>Garansi resmi</li>
                        <li>Quality check</li>
                        <li>Brand partnership</li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="service-card">
                    <div class="service-icon">
                        <i class="fas fa-credit-card"></i>
                    </div>
                    <h5 class="service-title">Payment Gateway Aman</h5>
                    <p class="service-description">Berbagai metode pembayaran yang aman dan terpercaya dengan enkripsi tingkat bank.</p>
                    <ul class="service-features">
                        <li>Credit/Debit card</li>
                        <li>E-wallet (OVO, GoPay, Dana)</li>
                        <li>Bank transfer</li>
                        <li>Cicilan 0%</li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="service-card">
                    <div class="service-icon">
                        <i class="fas fa-gift"></i>
                    </div>
                    <h5 class="service-title">Loyalty Program</h5>
                    <p class="service-description">Program loyalitas dengan berbagai benefit eksklusif untuk member setia MyYOGYA.</p>
                    <ul class="service-features">
                        <li>Poin reward setiap transaksi</li>
                        <li>Diskon member eksklusif</li>
                        <li>Early access sale</li>
                        <li>Birthday surprise</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="faq-section py-5 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center mb-5">
                <h2 class="section-title">Frequently Asked Questions</h2>
                <p class="section-subtitle">Pertanyaan yang sering diajukan oleh pelanggan MyYOGYA</p>
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        Bagaimana cara melakukan pemesanan di MyYOGYA?
                    </div>
                    <div class="faq-answer">
                        <p>Anda bisa melakukan pemesanan dengan mudah: 1) Pilih produk yang diinginkan, 2) Klik "Add to Cart", 3) Lanjut ke checkout, 4) Isi data pengiriman, 5) Pilih metode pembayaran, 6) Konfirmasi pesanan. Tim kami akan segera memproses pesanan Anda.</p>
                    </div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        Berapa lama waktu pengiriman produk?
                    </div>
                    <div class="faq-answer">
                        <p>Waktu pengiriman tergantung lokasi dan jenis layanan: Same Day (Jakarta, 4-8 jam), Next Day (Jabodetabek, 1-2 hari), Regular (Indonesia, 2-7 hari). Anda dapat tracking real-time melalui akun atau WhatsApp.</p>
                    </div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        Apakah bisa melakukan return atau tukar barang?
                    </div>
                    <div class="faq-answer">
                        <p>Ya, kami menyediakan layanan return/tukar barang dalam 30 hari dengan syarat: barang masih dalam kondisi baik, kemasan asli, dan belum digunakan. Anda bisa request melalui customer service atau akun MyYOGYA.</p>
                    </div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        Apa saja metode pembayaran yang tersedia?
                    </div>
                    <div class="faq-answer">
                        <p>Kami menerima berbagai metode pembayaran: Credit/Debit Card (Visa, Mastercard), E-Wallet (OVO, GoPay, Dana, ShopeePay), Bank Transfer (BCA, Mandiri, BNI, BRI), dan Cicilan 0% melalui Kredivo atau Akulaku.</p>
                    </div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        Bagaimana cara menggunakan voucher atau kode promo?
                    </div>
                    <div class="faq-answer">
                        <p>Masukkan kode voucher/promo di halaman checkout pada kolom "Kode Promo". Pastikan voucher masih berlaku dan memenuhi syarat minimum pembelian. Diskon akan otomatis terpotong dari total pembayaran.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contact Section -->
<section class="contact-section py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center mb-5">
                <h2 class="section-title">Hubungi Kami</h2>
                <p class="section-subtitle">Tim customer service kami siap membantu Anda dengan respon cepat dan solusi terbaik</p>
            </div>
        </div>
        
        <div class="row g-4">
            <div class="col-lg-3 col-md-6">
                <div class="contact-card">
                    <div class="contact-icon">
                        <i class="fas fa-phone"></i>
                    </div>
                    <h6 class="contact-title">Hotline</h6>
                    <div class="contact-info">
                        <a href="tel:0800-1-500-500" class="contact-link">0800-1-500-500</a><br>
                        <small class="text-muted">24 jam setiap hari</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="contact-card">
                    <div class="contact-icon">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <h6 class="contact-title">Email</h6>
                    <div class="contact-info">
                        <a href="mailto:support@myyogya.com" class="contact-link">support@myyogya.com</a><br>
                        <small class="text-muted">Respon dalam 1 jam</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="contact-card">
                    <div class="contact-icon">
                        <i class="fab fa-whatsapp"></i>
                    </div>
                    <h6 class="contact-title">WhatsApp</h6>
                    <div class="contact-info">
                        <a href="https://wa.me/628989148030" class="contact-link">+62 898-9148-030</a><br>
                        <small class="text-muted">Chat langsung</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="contact-card">
                    <div class="contact-icon">
                        <i class="fas fa-comments"></i>
                    </div>
                    <h6 class="contact-title">Live Chat</h6>
                    <div class="contact-info">
                        <a href="#" class="contact-link" onclick="openLiveChat()">Mulai Chat</a><br>
                        <small class="text-muted">Real-time support</small>
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
    function toggleFAQ(element) {
        const answer = element.nextElementSibling;
        const isActive = element.classList.contains('active');
        
        // Close all FAQ items
        document.querySelectorAll('.faq-question').forEach(q => {
            q.classList.remove('active');
            q.nextElementSibling.classList.remove('show');
        });
        
        // Toggle current item
        if (!isActive) {
            element.classList.add('active');
            answer.classList.add('show');
        }
    }
    
    function openLiveChat() {
        alert('Live Chat akan segera tersedia! Sementara ini Anda bisa menghubungi kami melalui WhatsApp atau email.');
    }
</script>

</body>
</html>
