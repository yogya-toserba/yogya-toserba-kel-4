<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bantuan IT - My Yogya</title>
    <link rel="stylesheet" href="{{ asset('css/pelanggan/manual.css') }}?v=20250830">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="icon" href="{{ asset('image/logo_yogya.png') }}" type="image/png">
</head>

<body>
    <!-- Header -->
    <header class="manual-header">
        <div class="header-container">
            <div class="logo-section">
                <div class="warehouse-icon-header">
                    <i class="fas fa-headset"></i>
                </div>
                <div class="header-title">
                    <h1>Bantuan IT My Yogya</h1>
                    <p>Dukungan Teknis untuk Pelanggan My Yogya v1.0.0</p>
                </div>
            </div>
            <div class="header-actions">
                <a href="{{ url('/') }}" class="btn-back">
                    <i class="fas fa-arrow-left"></i>
                    Kembali ke Beranda
                </a>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="manual-main">
        <div class="container">
            <!-- Sidebar Navigation -->
            <aside class="manual-sidebar">
                <div class="sidebar-sticky">
                    <h3><i class="fas fa-list"></i> Daftar Isi</h3>
                    <nav class="manual-nav">
                        <ul>
                            <li><a href="#kontak-it" class="nav-link active"><i class="fas fa-phone"></i> Kontak Customer Care</a></li>
                            <li><a href="#troubleshooting" class="nav-link"><i class="fas fa-tools"></i> Troubleshooting</a></li>
                            <li><a href="#faq" class="nav-link"><i class="fas fa-question-circle"></i> FAQ</a></li>
                            <li><a href="#panduan-login" class="nav-link"><i class="fas fa-sign-in-alt"></i> Panduan Login</a></li>
                            <li><a href="#masalah-belanja" class="nav-link"><i class="fas fa-shopping-cart"></i> Masalah Belanja</a></li>
                            <li><a href="#masalah-pembayaran" class="nav-link"><i class="fas fa-credit-card"></i> Masalah Pembayaran</a></li>
                            <li><a href="#masalah-poin" class="nav-link"><i class="fas fa-star"></i> Masalah Poin</a></li>
                            <li><a href="#bantuan" class="nav-link"><i class="fas fa-life-ring"></i> Bantuan</a></li>
                        </ul>
                    </nav>
                </div>
            </aside>

            <!-- Content -->
            <div class="manual-content">
                <!-- Kontak Customer Care Section -->
                <div id="kontak-it" class="manual-section">
                    <div class="section-header">
                        <div class="section-icon">
                            <i class="fas fa-phone"></i>
                        </div>
                        <div class="section-title">
                            <h2>Kontak Customer Care</h2>
                            <p>Hubungi tim dukungan teknis kami untuk bantuan langsung</p>
                        </div>
                    </div>

                    <div class="content-card">
                        <h3><i class="fas fa-headset"></i> Tim Dukungan Teknis</h3>
                        
                        <div class="contact-grid">
                            <div class="contact-item">
                                <div class="contact-icon">
                                    <i class="fas fa-phone"></i>
                                </div>
                                <h4>Customer Care 24/7</h4>
                                <p>0800-1-YOGYA (96492)</p>
                                <p>Senin - Minggu: 24 jam</p>
                            </div>
                            <div class="contact-item">
                                <div class="contact-icon">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <h4>Email IT Support</h4>
                                <p>it-support@myyogya.co.id</p>
                                <p>Respon dalam 2 jam</p>
                            </div>
                            <div class="contact-item">
                                <div class="contact-icon">
                                    <i class="fab fa-whatsapp"></i>
                                </div>
                                <h4>WhatsApp IT</h4>
                                <p>+62 812 3456 7891</p>
                                <p>Chat langsung dengan teknisi</p>
                            </div>
                            <div class="contact-item">
                                <div class="contact-icon">
                                    <i class="fas fa-comments"></i>
                                </div>
                                <h4>Live Chat IT</h4>
                                <p>Tersedia di website</p>
                                <p>Senin - Minggu: 08:00 - 22:00</p>
                            </div>
                            <div class="contact-item">
                                <div class="contact-icon">
                                    <i class="fas fa-ticket-alt"></i>
                                </div>
                                <h4>Ticket System</h4>
                                <p>Buat tiket dukungan online</p>
                                <p>Tracking progress real-time</p>
                            </div>
                            <div class="contact-item">
                                <div class="contact-icon">
                                    <i class="fas fa-video"></i>
                                </div>
                                <h4>Remote Support</h4>
                                <p>Bantuan jarak jauh</p>
                                <p>Dengan izin dari Anda</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Troubleshooting Section -->
                <div id="troubleshooting" class="manual-section">
                    <div class="section-header">
                        <div class="section-icon">
                            <i class="fas fa-tools"></i>
                        </div>
                        <div class="section-title">
                            <h2>Troubleshooting Umum</h2>
                            <p>Solusi untuk masalah teknis yang sering terjadi</p>
                        </div>
                    </div>

                    <div class="content-card">
                        <h3><i class="fas fa-wrench"></i> Masalah Umum & Solusi</h3>
                        
                        <div class="feature-grid">
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="fas fa-wifi"></i>
                                </div>
                                <h4>Koneksi Internet</h4>
                                <p>Periksa koneksi WiFi atau data seluler Anda</p>
                            </div>
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="fas fa-sync-alt"></i>
                                </div>
                                <h4>Refresh Halaman</h4>
                                <p>Tekan F5 atau tarik halaman ke bawah untuk refresh</p>
                            </div>
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="fas fa-trash"></i>
                                </div>
                                <h4>Clear Cache</h4>
                                <p>Hapus cache browser untuk performa optimal</p>
                            </div>
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="fas fa-mobile-alt"></i>
                                </div>
                                <h4>Update Browser</h4>
                                <p>Gunakan browser versi terbaru untuk kompatibilitas</p>
                            </div>
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="fas fa-shield-alt"></i>
                                </div>
                                <h4>Disable AdBlock</h4>
                                <p>Matikan ad blocker yang dapat mengganggu fungsi</p>
                            </div>
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="fas fa-cookie-bite"></i>
                                </div>
                                <h4>Enable Cookies</h4>
                                <p>Aktifkan cookies untuk menyimpan sesi login</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- FAQ Section -->
                <div id="faq" class="manual-section">
                    <div class="section-header">
                        <div class="section-icon">
                            <i class="fas fa-question-circle"></i>
                        </div>
                        <div class="section-title">
                            <h2>Frequently Asked Questions</h2>
                            <p>Pertanyaan yang sering diajukan dan jawabannya</p>
                        </div>
                    </div>

                    <div class="content-card">
                        <h3><i class="fas fa-clipboard-question"></i> FAQ Teknis</h3>
                        
                        <div class="faq-container">
                            <div class="faq-item">
                                <div class="faq-question">
                                    <h4>Mengapa website loading lambat?</h4>
                                    <i class="fas fa-plus"></i>
                                </div>
                                <div class="faq-answer">
                                    <p>Website loading lambat bisa disebabkan oleh koneksi internet yang lemah, cache browser yang penuh, atau banyak tab yang terbuka. Coba tutup tab lain, refresh halaman, atau clear cache browser.</p>
                                </div>
                            </div>
                            <div class="faq-item">
                                <div class="faq-question">
                                    <h4>Kenapa tidak bisa login?</h4>
                                    <i class="fas fa-plus"></i>
                                </div>
                                <div class="faq-answer">
                                    <p>Pastikan email/username dan password benar. Cek caps lock, hapus spasi berlebih, dan pastikan koneksi internet stabil. Jika lupa password, gunakan fitur reset password.</p>
                                </div>
                            </div>
                            <div class="faq-item">
                                <div class="faq-question">
                                    <h4>Produk tidak muncul di pencarian?</h4>
                                    <i class="fas fa-plus"></i>
                                </div>
                                <div class="faq-answer">
                                    <p>Coba gunakan kata kunci yang berbeda, periksa filter yang dipilih, atau browse melalui kategori. Pastikan ejaan benar dan gunakan sinonim produk.</p>
                                </div>
                            </div>
                            <div class="faq-item">
                                <div class="faq-question">
                                    <h4>Keranjang belanja kosong?</h4>
                                    <i class="fas fa-plus"></i>
                                </div>
                                <div class="faq-answer">
                                    <p>Pastikan cookies diaktifkan di browser. Keranjang tersimpan di cookies. Jika masih kosong, coba disable ad blocker dan refresh halaman.</p>
                                </div>
                            </div>
                            <div class="faq-item">
                                <div class="faq-question">
                                    <h4>Pembayaran gagal?</h4>
                                    <i class="fas fa-plus"></i>
                                </div>
                                <div class="faq-answer">
                                    <p>Periksa saldo rekening/kartu, pastikan data kartu benar, dan koneksi internet stabil. Coba metode pembayaran lain atau hubungi bank Anda.</p>
                                </div>
                            </div>
                            <div class="faq-item">
                                <div class="faq-question">
                                    <h4>Poin tidak bertambah?</h4>
                                    <i class="fas fa-plus"></i>
                                </div>
                                <div class="faq-answer">
                                    <p>Poin biasanya ditambahkan 1x24 jam setelah transaksi selesai. Pastikan login saat berbelanja dan transaksi berhasil dibayar.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Panduan Login Section -->
                <div id="panduan-login" class="manual-section">
                    <div class="section-header">
                        <div class="section-icon">
                            <i class="fas fa-sign-in-alt"></i>
                        </div>
                        <div class="section-title">
                            <h2>Panduan Login</h2>
                            <p>Langkah-langkah untuk masuk ke akun My Yogya</p>
                        </div>
                    </div>

                    <div class="content-card">
                        <h3><i class="fas fa-user-check"></i> Cara Login</h3>
                        
                        <div class="step-container">
                            <div class="step-item">
                                <div class="step-number">1</div>
                                <div class="step-content">
                                    <h4>Buka Halaman Login</h4>
                                    <p>Klik tombol "Login" di halaman beranda atau akses langsung halaman login.</p>
                                </div>
                            </div>
                            <div class="step-item">
                                <div class="step-number">2</div>
                                <div class="step-content">
                                    <h4>Masukkan Email/Username</h4>
                                    <p>Ketik email atau username yang terdaftar dengan benar.</p>
                                </div>
                            </div>
                            <div class="step-item">
                                <div class="step-number">3</div>
                                <div class="step-content">
                                    <h4>Masukkan Password</h4>
                                    <p>Ketik password dengan benar. Perhatikan caps lock dan karakter khusus.</p>
                                </div>
                            </div>
                            <div class="step-item">
                                <div class="step-number">4</div>
                                <div class="step-content">
                                    <h4>Klik Login</h4>
                                    <p>Tekan tombol login dan tunggu proses verifikasi selesai.</p>
                                </div>
                            </div>
                        </div>

                        <div class="info-box info-warning">
                            <i class="fas fa-exclamation-triangle"></i>
                            <div>
                                <h4>Tips Keamanan</h4>
                                <p>Jangan bagikan password Anda kepada siapapun. Logout setelah selesai berbelanja, terutama di komputer umum.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Masalah Belanja Section -->
                <div id="masalah-belanja" class="manual-section">
                    <div class="section-header">
                        <div class="section-icon">
                            <i class="fas fa-shopping-cart"></i>
                        </div>
                        <div class="section-title">
                            <h2>Masalah Belanja</h2>
                            <p>Solusi untuk kendala saat berbelanja online</p>
                        </div>
                    </div>

                    <div class="content-card">
                        <h3><i class="fas fa-bug"></i> Troubleshooting Belanja</h3>
                        
                        <div class="feature-grid">
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="fas fa-search"></i>
                                </div>
                                <h4>Produk Tidak Ditemukan</h4>
                                <p>Coba kata kunci berbeda atau browse kategori</p>
                            </div>
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="fas fa-shopping-bag"></i>
                                </div>
                                <h4>Tidak Bisa Add to Cart</h4>
                                <p>Refresh halaman atau cek stok produk</p>
                            </div>
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="fas fa-images"></i>
                                </div>
                                <h4>Gambar Tidak Muncul</h4>
                                <p>Periksa koneksi internet dan refresh halaman</p>
                            </div>
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="fas fa-tag"></i>
                                </div>
                                <h4>Harga Tidak Sesuai</h4>
                                <p>Refresh halaman untuk update harga terbaru</p>
                            </div>
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="fas fa-filter"></i>
                                </div>
                                <h4>Filter Tidak Berfungsi</h4>
                                <p>Clear cache browser dan coba lagi</p>
                            </div>
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="fas fa-sort"></i>
                                </div>
                                <h4>Sorting Bermasalah</h4>
                                <p>Tunggu loading selesai sebelum ganti sorting</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Masalah Pembayaran Section -->
                <div id="masalah-pembayaran" class="manual-section">
                    <div class="section-header">
                        <div class="section-icon">
                            <i class="fas fa-credit-card"></i>
                        </div>
                        <div class="section-title">
                            <h2>Masalah Pembayaran</h2>
                            <p>Solusi untuk kendala pembayaran dan transaksi</p>
                        </div>
                    </div>

                    <div class="content-card">
                        <h3><i class="fas fa-exclamation-circle"></i> Troubleshooting Pembayaran</h3>
                        
                        <div class="feature-grid">
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="fas fa-credit-card"></i>
                                </div>
                                <h4>Kartu Ditolak</h4>
                                <p>Periksa saldo, limit, atau hubungi bank Anda</p>
                            </div>
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="fas fa-mobile-alt"></i>
                                </div>
                                <h4>E-Wallet Error</h4>
                                <p>Pastikan aplikasi e-wallet update dan saldo cukup</p>
                            </div>
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="fas fa-university"></i>
                                </div>
                                <h4>Transfer Gagal</h4>
                                <p>Cek nomor rekening dan pastikan internet banking aktif</p>
                            </div>
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="fas fa-qrcode"></i>
                                </div>
                                <h4>QR Code Error</h4>
                                <p>Scan ulang QR code atau gunakan metode lain</p>
                            </div>
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="fas fa-clock"></i>
                                </div>
                                <h4>Timeout Pembayaran</h4>
                                <p>Lakukan pembayaran ulang dengan cepat</p>
                            </div>
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="fas fa-undo"></i>
                                </div>
                                <h4>Refund Bermasalah</h4>
                                <p>Hubungi customer service untuk proses refund</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Masalah Poin Section -->
                <div id="masalah-poin" class="manual-section">
                    <div class="section-header">
                        <div class="section-icon">
                            <i class="fas fa-star"></i>
                        </div>
                        <div class="section-title">
                            <h2>Masalah Poin Reward</h2>
                            <p>Solusi untuk masalah sistem poin dan reward</p>
                        </div>
                    </div>

                    <div class="content-card">
                        <h3><i class="fas fa-coins"></i> Troubleshooting Poin</h3>
                        
                        <div class="feature-grid">
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="fas fa-plus"></i>
                                </div>
                                <h4>Poin Tidak Bertambah</h4>
                                <p>Tunggu 1x24 jam setelah transaksi berhasil</p>
                            </div>
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="fas fa-minus"></i>
                                </div>
                                <h4>Poin Berkurang</h4>
                                <p>Cek riwayat penggunaan poin untuk pembelian</p>
                            </div>
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="fas fa-exchange-alt"></i>
                                </div>
                                <h4>Tidak Bisa Tukar Poin</h4>
                                <p>Pastikan poin cukup dan item reward tersedia</p>
                            </div>
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="fas fa-calendar"></i>
                                </div>
                                <h4>Poin Expired</h4>
                                <p>Poin berlaku 1 tahun, gunakan sebelum habis masa berlaku</p>
                            </div>
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="fas fa-calculator"></i>
                                </div>
                                <h4>Perhitungan Salah</h4>
                                <p>1 poin = Rp 1.000 pembelian, cek kembali transaksi</p>
                            </div>
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="fas fa-gift"></i>
                                </div>
                                <h4>Hadiah Tidak Diterima</h4>
                                <p>Tunggu konfirmasi atau hubungi customer service</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Bantuan Section -->
                <div id="bantuan" class="manual-section">
                    <div class="section-header">
                        <div class="section-icon">
                            <i class="fas fa-life-ring"></i>
                        </div>
                        <div class="section-title">
                            <h2>Pusat Bantuan</h2>
                            <p>Butuh bantuan lebih lanjut? Hubungi kami</p>
                        </div>
                    </div>

                    <div class="content-card">
                        <h3><i class="fas fa-question-circle"></i> Panduan Bantuan</h3>
                        
                        <div class="info-box info-info">
                            <i class="fas fa-info-circle"></i>
                            <div>
                                <h4>FAQ Terlebih Dahulu</h4>
                                <p>Banyak pertanyaan umum telah dijawab di halaman FAQ. Silakan cek terlebih dahulu sebelum menghubungi customer service.</p>
                            </div>
                        </div>

                        <div class="feature-grid">
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="fas fa-phone"></i>
                                </div>
                                <h4>Hubungi Langsung</h4>
                                <p>0800-1-YOGYA untuk bantuan cepat</p>
                            </div>
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="fab fa-whatsapp"></i>
                                </div>
                                <h4>Chat WhatsApp</h4>
                                <p>+62 812 3456 7891 untuk IT support</p>
                            </div>
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <h4>Email Support</h4>
                                <p>it-support@myyogya.co.id</p>
                            </div>
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="fas fa-ticket-alt"></i>
                                </div>
                                <h4>Buat Tiket</h4>
                                <p>Sistem tiket untuk tracking masalah</p>
                            </div>
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="fas fa-video"></i>
                                </div>
                                <h4>Remote Support</h4>
                                <p>Bantuan jarak jauh real-time</p>
                            </div>
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="fas fa-book"></i>
                                </div>
                                <h4>Manual Lengkap</h4>
                                <p>Dokumentasi sistem yang detail</p>
                            </div>
                        </div>

                        <div class="info-box info-success">
                            <i class="fas fa-lightbulb"></i>
                            <div>
                                <h4>Tips Bantuan Efektif</h4>
                                <p>Siapkan informasi lengkap: screenshot error, langkah yang sudah dicoba, detail browser/device yang digunakan. Ini akan mempercepat proses bantuan.</p>
                            </div>
                        </div>

                        <div class="info-box info-warning">
                            <i class="fas fa-clock"></i>
                            <div>
                                <h4>Jam Layanan</h4>
                                <p>Customer Service: 24/7 | IT Support: Senin-Jumat 08:00-17:00 | Emergency: 24/7 untuk masalah kritis</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Scripts -->
    <script>
        // Smooth scrolling for navigation links
        document.querySelectorAll('.nav-link').forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const targetId = this.getAttribute('href').substring(1);
                const targetSection = document.getElementById(targetId);
                
                if (targetSection) {
                    // Remove active class from all links
                    document.querySelectorAll('.nav-link').forEach(l => l.classList.remove('active'));
                    // Add active class to clicked link
                    this.classList.add('active');
                    
                    // Scroll to target section
                    targetSection.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Update active navigation on scroll
        window.addEventListener('scroll', function() {
            const sections = document.querySelectorAll('.manual-section');
            const navLinks = document.querySelectorAll('.nav-link');
            
            let current = '';
            sections.forEach(section => {
                const sectionTop = section.offsetTop;
                const sectionHeight = section.clientHeight;
                if (window.pageYOffset >= (sectionTop - 200)) {
                    current = section.getAttribute('id');
                }
            });

            navLinks.forEach(link => {
                link.classList.remove('active');
                if (link.getAttribute('href').substring(1) === current) {
                    link.classList.add('active');
                }
            });
        });

        // FAQ accordion functionality
        document.querySelectorAll('.faq-question').forEach(question => {
            question.addEventListener('click', function() {
                const faqItem = this.parentElement;
                const answer = faqItem.querySelector('.faq-answer');
                const icon = this.querySelector('i');
                
                // Toggle active class
                faqItem.classList.toggle('active');
                
                // Toggle icon
                if (faqItem.classList.contains('active')) {
                    icon.classList.remove('fa-plus');
                    icon.classList.add('fa-minus');
                } else {
                    icon.classList.remove('fa-minus');
                    icon.classList.add('fa-plus');
                }
            });
        });

        // Add loaded class to body for animations
        window.addEventListener('load', function() {
            document.body.classList.add('loaded');
        });
    </script>
</body>

</html>
