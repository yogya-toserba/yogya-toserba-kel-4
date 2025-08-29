<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manual Sistem Pelanggan - My Yogya</title>
    <link rel="stylesheet" href="{{ asset('css/pelanggan/manual.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="icon" href="{{ asset('image/logo_yogya.png') }}" type="image/png">
</head>

<body>
    <!-- Header -->
    <header class="manual-header">
        <div class="header-container">
            <div class="logo-section">
                <div class="warehouse-icon-header">
                    <i class="fas fa-users"></i>
                </div>
                <div class="header-title">
                    <h1>Manual Sistem Pelanggan</h1>
                    <p>Panduan Penggunaan Sistem My Yogya untuk Pelanggan v1.0.0</p>
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
                            <li><a href="#pengenalan" class="nav-link active"><i class="fas fa-home"></i> Pengenalan</a></li>
                            <li><a href="#pendaftaran" class="nav-link"><i class="fas fa-user-plus"></i> Pendaftaran</a></li>
                            <li><a href="#login" class="nav-link"><i class="fas fa-sign-in-alt"></i> Login</a></li>
                            <li><a href="#beranda" class="nav-link"><i class="fas fa-store"></i> Beranda</a></li>
                            <li><a href="#produk" class="nav-link"><i class="fas fa-shopping-cart"></i> Belanja Produk</a></li>
                            <li><a href="#keranjang" class="nav-link"><i class="fas fa-shopping-bag"></i> Keranjang</a></li>
                            <li><a href="#checkout" class="nav-link"><i class="fas fa-credit-card"></i> Pembayaran</a></li>
                            <li><a href="#poin" class="nav-link"><i class="fas fa-star"></i> Sistem Poin</a></li>
                            <li><a href="#hadiah" class="nav-link"><i class="fas fa-gift"></i> Penukaran Hadiah</a></li>
                            <li><a href="#riwayat" class="nav-link"><i class="fas fa-history"></i> Riwayat Belanja</a></li>
                            <li><a href="#profil" class="nav-link"><i class="fas fa-user-cog"></i> Kelola Profil</a></li>
                            <li><a href="#bantuan" class="nav-link"><i class="fas fa-life-ring"></i> Bantuan</a></li>
                        </ul>
                    </nav>
                </div>
            </aside>

            <!-- Content -->
            <section class="manual-content">
                <!-- Pengenalan Section -->
                <div id="pengenalan" class="manual-section">
                    <div class="section-header">
                        <div class="section-icon">
                            <i class="fas fa-home"></i>
                        </div>
                        <div class="section-title">
                            <h2>Pengenalan Sistem My Yogya</h2>
                            <p>Selamat datang di panduan lengkap penggunaan aplikasi My Yogya untuk pelanggan</p>
                        </div>
                    </div>

                    <div class="content-card">
                        <h3><i class="fas fa-info-circle"></i> Tentang My Yogya</h3>
                        <p>My Yogya adalah platform digital yang memungkinkan pelanggan untuk berbelanja dengan mudah, mengumpulkan poin reward, dan menikmati berbagai keuntungan eksklusif dari Yogya Toserba.</p>
                        
                        <div class="feature-grid">
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="fas fa-shopping-cart"></i>
                                </div>
                                <h4>Belanja Online</h4>
                                <p>Berbelanja produk Yogya dengan mudah dari rumah</p>
                            </div>
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="fas fa-star"></i>
                                </div>
                                <h4>Sistem Poin</h4>
                                <p>Kumpulkan poin setiap pembelian dan tukar dengan hadiah</p>
                            </div>
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="fas fa-gift"></i>
                                </div>
                                <h4>Reward Eksklusif</h4>
                                <p>Dapatkan penawaran dan promo khusus member</p>
                            </div>
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="fas fa-mobile-alt"></i>
                                </div>
                                <h4>Akses Mobile</h4>
                                <p>Aplikasi responsive yang bisa diakses di semua device</p>
                            </div>
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="fas fa-percent"></i>
                                </div>
                                <h4>Promo & Diskon</h4>
                                <p>Nikmati berbagai penawaran menarik setiap harinya</p>
                            </div>
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="fas fa-truck"></i>
                                </div>
                                <h4>Pengiriman Cepat</h4>
                                <p>Layanan antar yang cepat dan terpercaya</p>
                            </div>
                        </div>
                    </div>

                    <div class="info-box info-success">
                        <i class="fas fa-lightbulb"></i>
                        <div>
                            <h4>Tips Memulai</h4>
                            <p>Untuk pengalaman terbaik, pastikan Anda telah mendaftar sebagai member My Yogya dan login ke akun Anda.</p>
                        </div>
                    </div>
                </div>

                <!-- Pendaftaran Section -->
                <div id="pendaftaran" class="manual-section">
                    <div class="section-header">
                        <div class="section-icon">
                            <i class="fas fa-user-plus"></i>
                        </div>
                        <div class="section-title">
                            <h2>Cara Mendaftar Akun</h2>
                            <p>Langkah-langkah mudah untuk membuat akun My Yogya</p>
                        </div>
                    </div>

                    <div class="content-card">
                        <h3><i class="fas fa-clipboard-list"></i> Langkah Pendaftaran</h3>
                        
                        <div class="step-guide">
                            <div class="step-item">
                                <div class="step-number">1</div>
                                <div class="step-content">
                                    <h4>Klik Tombol Daftar</h4>
                                    <p>Pada halaman beranda, klik tombol "Daftar" atau "Register" di bagian atas halaman.</p>
                                </div>
                            </div>
                            <div class="step-item">
                                <div class="step-number">2</div>
                                <div class="step-content">
                                    <h4>Isi Form Pendaftaran</h4>
                                    <p>Lengkapi semua data yang diperlukan seperti nama, email, nomor telepon, dan alamat.</p>
                                </div>
                            </div>
                            <div class="step-item">
                                <div class="step-number">3</div>
                                <div class="step-content">
                                    <h4>Verifikasi Email</h4>
                                    <p>Cek email Anda dan klik link verifikasi yang dikirimkan oleh sistem.</p>
                                </div>
                            </div>
                            <div class="step-item">
                                <div class="step-number">4</div>
                                <div class="step-content">
                                    <h4>Akun Siap Digunakan</h4>
                                    <p>Setelah verifikasi berhasil, Anda dapat login dan mulai berbelanja.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="info-box info-warning">
                        <i class="fas fa-exclamation-triangle"></i>
                        <div>
                            <h4>Penting</h4>
                            <p>Pastikan email yang Anda gunakan aktif karena akan digunakan untuk verifikasi dan notifikasi penting.</p>
                        </div>
                    </div>
                </div>

                <!-- Login Section -->
                <div id="login" class="manual-section">
                    <div class="section-header">
                        <div class="section-icon">
                            <i class="fas fa-sign-in-alt"></i>
                        </div>
                        <div class="section-title">
                            <h2>Cara Login ke Sistem</h2>
                            <p>Masuk ke akun My Yogya Anda dengan mudah</p>
                        </div>
                    </div>

                    <div class="content-card">
                        <h3><i class="fas fa-key"></i> Proses Login</h3>
                        
                        <div class="step-guide">
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
                                    <h4>Masukkan Kredensial</h4>
                                    <p>Input email dan password yang telah Anda daftarkan sebelumnya.</p>
                                </div>
                            </div>
                            <div class="step-item">
                                <div class="step-number">3</div>
                                <div class="step-content">
                                    <h4>Klik Login</h4>
                                    <p>Tekan tombol "Login" untuk masuk ke akun Anda.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="info-box info-info">
                        <i class="fas fa-shield-alt"></i>
                        <div>
                            <h4>Keamanan</h4>
                            <p>Jangan pernah membagikan password Anda kepada siapapun. Gunakan password yang kuat dengan kombinasi huruf, angka, dan simbol.</p>
                        </div>
                    </div>
                </div>

                <!-- Beranda Section -->
                <div id="beranda" class="manual-section">
                    <div class="section-header">
                        <div class="section-icon">
                            <i class="fas fa-store"></i>
                        </div>
                        <div class="section-title">
                            <h2>Navigasi Halaman Beranda</h2>
                            <p>Mengenal fitur-fitur yang tersedia di halaman utama</p>
                        </div>
                    </div>

                    <div class="content-card">
                        <h3><i class="fas fa-compass"></i> Komponen Beranda</h3>
                        
                        <div class="feature-grid">
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="fas fa-search"></i>
                                </div>
                                <h4>Pencarian Produk</h4>
                                <p>Gunakan kolom pencarian untuk menemukan produk yang Anda inginkan dengan cepat</p>
                            </div>
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="fas fa-th-large"></i>
                                </div>
                                <h4>Kategori Produk</h4>
                                <p>Jelajahi produk berdasarkan kategori seperti makanan, minuman, perawatan, dll</p>
                            </div>
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="fas fa-fire"></i>
                                </div>
                                <h4>Produk Terlaris</h4>
                                <p>Lihat produk-produk yang paling diminati oleh pelanggan lain</p>
                            </div>
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="fas fa-percent"></i>
                                </div>
                                <h4>Promo & Diskon</h4>
                                <p>Temukan penawaran menarik dan diskon khusus yang sedang berlangsung</p>
                            </div>
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="fas fa-user-circle"></i>
                                </div>
                                <h4>Profil Pelanggan</h4>
                                <p>Akses informasi akun dan pengaturan profil Anda</p>
                            </div>
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="fas fa-history"></i>
                                </div>
                                <h4>Riwayat Belanja</h4>
                                <p>Lihat transaksi dan pesanan yang pernah Anda lakukan</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Belanja Produk Section -->
                <div id="produk" class="manual-section">
                    <div class="section-header">
                        <div class="section-icon">
                            <i class="fas fa-shopping-cart"></i>
                        </div>
                        <div class="section-title">
                            <h2>Cara Berbelanja Produk</h2>
                            <p>Panduan lengkap untuk berbelanja di My Yogya</p>
                        </div>
                    </div>

                    <div class="content-card">
                        <h3><i class="fas fa-mouse-pointer"></i> Langkah Berbelanja</h3>
                        
                        <div class="step-guide">
                            <div class="step-item">
                                <div class="step-number">1</div>
                                <div class="step-content">
                                    <h4>Cari Produk</h4>
                                    <p>Gunakan fitur pencarian atau jelajahi kategori untuk menemukan produk yang diinginkan.</p>
                                </div>
                            </div>
                            <div class="step-item">
                                <div class="step-number">2</div>
                                <div class="step-content">
                                    <h4>Lihat Detail Produk</h4>
                                    <p>Klik pada produk untuk melihat detail lengkap, harga, dan deskripsi.</p>
                                </div>
                            </div>
                            <div class="step-item">
                                <div class="step-number">3</div>
                                <div class="step-content">
                                    <h4>Pilih Jumlah</h4>
                                    <p>Tentukan jumlah produk yang ingin dibeli.</p>
                                </div>
                            </div>
                            <div class="step-item">
                                <div class="step-number">4</div>
                                <div class="step-content">
                                    <h4>Tambah ke Keranjang</h4>
                                    <p>Klik tombol "Tambah ke Keranjang" untuk menyimpan produk.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Keranjang Section -->
                <div id="keranjang" class="manual-section">
                    <div class="section-header">
                        <div class="section-icon">
                            <i class="fas fa-shopping-bag"></i>
                        </div>
                        <div class="section-title">
                            <h2>Mengelola Keranjang Belanja</h2>
                            <p>Cara mengatur dan mengelola item di keranjang Anda</p>
                        </div>
                    </div>

                    <div class="content-card">
                        <h3><i class="fas fa-edit"></i> Fitur Keranjang</h3>
                        
                        <div class="feature-grid">
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="fas fa-plus-minus"></i>
                                </div>
                                <h4>Ubah Jumlah</h4>
                                <p>Tambah atau kurangi jumlah item sesuai kebutuhan</p>
                            </div>
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="fas fa-trash-alt"></i>
                                </div>
                                <h4>Hapus Item</h4>
                                <p>Buang item yang tidak diinginkan dari keranjang</p>
                            </div>
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="fas fa-calculator"></i>
                                </div>
                                <h4>Total Harga</h4>
                                <p>Lihat total belanja Anda secara real-time</p>
                            </div>
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="fas fa-save"></i>
                                </div>
                                <h4>Simpan Keranjang</h4>
                                <p>Keranjang otomatis tersimpan untuk sesi berikutnya</p>
                            </div>
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="fas fa-heart"></i>
                                </div>
                                <h4>Wishlist</h4>
                                <p>Pindahkan item ke wishlist untuk dibeli nanti</p>
                            </div>
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="fas fa-share-alt"></i>
                                </div>
                                <h4>Bagikan Keranjang</h4>
                                <p>Kirim keranjang belanja ke teman atau keluarga</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pembayaran Section -->
                <div id="checkout" class="manual-section">
                    <div class="section-header">
                        <div class="section-icon">
                            <i class="fas fa-credit-card"></i>
                        </div>
                        <div class="section-title">
                            <h2>Proses Pembayaran</h2>
                            <p>Cara menyelesaikan transaksi pembayaran</p>
                        </div>
                    </div>

                    <div class="content-card">
                        <h3><i class="fas fa-money-check-alt"></i> Metode Pembayaran</h3>
                        
                        <div class="feature-grid">
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="fas fa-money-bill-wave"></i>
                                </div>
                                <h4>Tunai</h4>
                                <p>Bayar di kasir saat pengambilan barang</p>
                            </div>
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="fas fa-credit-card"></i>
                                </div>
                                <h4>Kartu Kredit/Debit</h4>
                                <p>Pembayaran elektronik dengan kartu</p>
                            </div>
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="fas fa-mobile-alt"></i>
                                </div>
                                <h4>E-Wallet</h4>
                                <p>Pembayaran digital melalui aplikasi</p>
                            </div>
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="fas fa-star"></i>
                                </div>
                                <h4>Poin Reward</h4>
                                <p>Gunakan poin yang terkumpul untuk pembayaran</p>
                            </div>
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="fas fa-university"></i>
                                </div>
                                <h4>Transfer Bank</h4>
                                <p>Pembayaran melalui transfer ke rekening toko</p>
                            </div>
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="fas fa-qrcode"></i>
                                </div>
                                <h4>QRIS</h4>
                                <p>Scan QR code untuk pembayaran instan</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sistem Poin Section -->
                <div id="poin" class="manual-section">
                    <div class="section-header">
                        <div class="section-icon">
                            <i class="fas fa-star"></i>
                        </div>
                        <div class="section-title">
                            <h2>Sistem Poin Reward</h2>
                            <p>Kumpulkan poin setiap berbelanja dan dapatkan keuntungan</p>
                        </div>
                    </div>

                    <div class="content-card">
                        <h3><i class="fas fa-trophy"></i> Cara Kerja Poin</h3>
                        
                        <div class="info-box info-success">
                            <i class="fas fa-coins"></i>
                            <div>
                                <h4>Rumus Poin</h4>
                                <p>Setiap pembelian Rp 1.000 = 1 poin. Semakin banyak belanja, semakin banyak poin yang didapat!</p>
                            </div>
                        </div>

                        <div class="step-guide">
                            <div class="step-item">
                                <div class="step-number">1</div>
                                <div class="step-content">
                                    <h4>Berbelanja</h4>
                                    <p>Lakukan transaksi pembelian dengan login ke akun My Yogya.</p>
                                </div>
                            </div>
                            <div class="step-item">
                                <div class="step-number">2</div>
                                <div class="step-content">
                                    <h4>Poin Otomatis Masuk</h4>
                                    <p>Poin akan otomatis terakumulasi setelah transaksi selesai.</p>
                                </div>
                            </div>
                            <div class="step-item">
                                <div class="step-number">3</div>
                                <div class="step-content">
                                    <h4>Cek Saldo Poin</h4>
                                    <p>Lihat total poin Anda di dashboard atau profil akun.</p>
                                </div>
                            </div>
                            <div class="step-item">
                                <div class="step-number">4</div>
                                <div class="step-content">
                                    <h4>Tukar Poin</h4>
                                    <p>Gunakan poin untuk mendapat diskon atau hadiah menarik.</p>
                                </div>
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
                            <p>Butuh bantuan? Hubungi kami melalui berbagai cara</p>
                        </div>
                    </div>

                    <div class="content-card">
                        <h3><i class="fas fa-headset"></i> Kontak Bantuan</h3>
                        
                        <div class="contact-grid">
                            <div class="contact-item">
                                <div class="contact-icon">
                                    <i class="fas fa-phone"></i>
                                </div>
                                <h4>Customer Service</h4>
                                <p>0800-1-YOGYA (96492)</p>
                                <p>Senin - Minggu: 08:00 - 22:00</p>
                            </div>
                            <div class="contact-item">
                                <div class="contact-icon">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <h4>Email Support</h4>
                                <p>support@myyogya.co.id</p>
                                <p>Respon dalam 1x24 jam</p>
                            </div>
                            <div class="contact-item">
                                <div class="contact-icon">
                                    <i class="fab fa-whatsapp"></i>
                                </div>
                                <h4>WhatsApp</h4>
                                <p>+62 812 3456 7890</p>
                                <p>Chat langsung dengan CS</p>
                            </div>
                            <div class="contact-item">
                                <div class="contact-icon">
                                    <i class="fas fa-comments"></i>
                                </div>
                                <h4>Live Chat</h4>
                                <p>Tersedia di website</p>
                                <p>Senin - Minggu: 08:00 - 22:00</p>
                            </div>
                        </div>
                    </div>

                    <div class="info-box info-info">
                        <i class="fas fa-question-circle"></i>
                        <div>
                            <h4>FAQ</h4>
                            <p>Banyak pertanyaan umum telah dijawab di halaman FAQ. Silakan cek terlebih dahulu sebelum menghubungi customer service.</p>
                        </div>
                    </div>
                </div>
            </section>
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

        // Add loaded class to body for animations
        window.addEventListener('load', function() {
            document.body.classList.add('loaded');
        });
    </script>
</body>

</html>
