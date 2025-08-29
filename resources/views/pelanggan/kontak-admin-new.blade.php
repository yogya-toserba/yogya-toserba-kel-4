<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontak Admin - My Yogya</title>
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
                    <i class="fas fa-user-shield"></i>
                </div>
                <div class="header-title">
                    <h1>Kontak Admin My Yogya</h1>
                    <p>Direktori Kontak Administrator & Customer Service v1.0.0</p>
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
                            <li><a href="#customer-service" class="nav-link active"><i class="fas fa-headset"></i> Customer Service</a></li>
                            <li><a href="#admin-utama" class="nav-link"><i class="fas fa-crown"></i> Admin Utama</a></li>
                            <li><a href="#manager-toko" class="nav-link"><i class="fas fa-store"></i> Manager Toko</a></li>
                            <li><a href="#technical-support" class="nav-link"><i class="fas fa-cogs"></i> Technical Support</a></li>
                            <li><a href="#jam-operasional" class="nav-link"><i class="fas fa-clock"></i> Jam Operasional</a></li>
                            <li><a href="#kontak-darurat" class="nav-link"><i class="fas fa-exclamation-triangle"></i> Kontak Darurat</a></li>
                            <li><a href="#faq" class="nav-link"><i class="fas fa-question-circle"></i> FAQ</a></li>
                            <li><a href="#bantuan" class="nav-link"><i class="fas fa-life-ring"></i> Bantuan</a></li>
                        </ul>
                    </nav>
                </div>
            </aside>

            <!-- Content -->
            <div class="manual-content">
                <!-- Customer Service Section -->
                <div id="customer-service" class="manual-section">
                    <div class="section-header">
                        <div class="section-icon">
                            <i class="fas fa-headset"></i>
                        </div>
                        <div class="section-title">
                            <h2>Customer Service</h2>
                            <p>Tim customer service siap membantu Anda 24/7</p>
                        </div>
                    </div>

                    <div class="content-card">
                        <h3><i class="fas fa-users"></i> Tim Customer Service</h3>
                        
                        <div class="contact-grid">
                            <div class="contact-item">
                                <div class="contact-icon">
                                    <i class="fas fa-phone"></i>
                                </div>
                                <h4>Customer Care Hotline</h4>
                                <p>0800-1-YOGYA (96492)</p>
                                <p>Senin - Minggu: 24 jam</p>
                            </div>
                            <div class="contact-item">
                                <div class="contact-icon">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <h4>Email Customer Care</h4>
                                <p>customercare@myyogya.co.id</p>
                                <p>Respon dalam 2 jam</p>
                            </div>
                            <div class="contact-item">
                                <div class="contact-icon">
                                    <i class="fab fa-whatsapp"></i>
                                </div>
                                <h4>WhatsApp CS</h4>
                                <p>+62 812 3456 7890</p>
                                <p>Chat langsung 24/7</p>
                            </div>
                            <div class="contact-item">
                                <div class="contact-icon">
                                    <i class="fas fa-comments"></i>
                                </div>
                                <h4>Live Chat</h4>
                                <p>Tersedia di website</p>
                                <p>Senin - Minggu: 08:00 - 22:00</p>
                            </div>
                            <div class="contact-item">
                                <div class="contact-icon">
                                    <i class="fas fa-user-tie"></i>
                                </div>
                                <h4>CS Manager</h4>
                                <p>Supervisor Customer Care</p>
                                <p>cs.manager@myyogya.co.id</p>
                            </div>
                            <div class="contact-item">
                                <div class="contact-icon">
                                    <i class="fas fa-ticket-alt"></i>
                                </div>
                                <h4>Ticket System</h4>
                                <p>Support online</p>
                                <p>Tracking real-time</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Admin Utama Section -->
                <div id="admin-utama" class="manual-section">
                    <div class="section-header">
                        <div class="section-icon">
                            <i class="fas fa-crown"></i>
                        </div>
                        <div class="section-title">
                            <h2>Admin Utama</h2>
                            <p>Kontak administrator sistem dan pengelola utama</p>
                        </div>
                    </div>

                    <div class="content-card">
                        <h3><i class="fas fa-user-cog"></i> Tim Administrator</h3>
                        
                        <div class="contact-grid">
                            <div class="contact-item">
                                <div class="contact-icon">
                                    <i class="fas fa-user-shield"></i>
                                </div>
                                <h4>Super Admin</h4>
                                <p>admin@myyogya.co.id</p>
                                <p>Akses penuh sistem</p>
                            </div>
                            <div class="contact-item">
                                <div class="contact-icon">
                                    <i class="fas fa-database"></i>
                                </div>
                                <h4>Admin Database</h4>
                                <p>database@myyogya.co.id</p>
                                <p>Pengelola data sistem</p>
                            </div>
                            <div class="contact-item">
                                <div class="contact-icon">
                                    <i class="fas fa-users-cog"></i>
                                </div>
                                <h4>Admin User</h4>
                                <p>useradmin@myyogya.co.id</p>
                                <p>Pengelola akun pengguna</p>
                            </div>
                            <div class="contact-item">
                                <div class="contact-icon">
                                    <i class="fas fa-shopping-cart"></i>
                                </div>
                                <h4>Admin Produk</h4>
                                <p>produk@myyogya.co.id</p>
                                <p>Pengelola katalog produk</p>
                            </div>
                            <div class="contact-item">
                                <div class="contact-icon">
                                    <i class="fas fa-credit-card"></i>
                                </div>
                                <h4>Admin Transaksi</h4>
                                <p>transaksi@myyogya.co.id</p>
                                <p>Pengelola pembayaran</p>
                            </div>
                            <div class="contact-item">
                                <div class="contact-icon">
                                    <i class="fas fa-chart-line"></i>
                                </div>
                                <h4>Admin Laporan</h4>
                                <p>laporan@myyogya.co.id</p>
                                <p>Analisis & reporting</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Manager Toko Section -->
                <div id="manager-toko" class="manual-section">
                    <div class="section-header">
                        <div class="section-icon">
                            <i class="fas fa-store"></i>
                        </div>
                        <div class="section-title">
                            <h2>Manager Toko</h2>
                            <p>Kontak manager untuk setiap cabang toko</p>
                        </div>
                    </div>

                    <div class="content-card">
                        <h3><i class="fas fa-building"></i> Manager Cabang</h3>
                        
                        <div class="contact-grid">
                            <div class="contact-item">
                                <div class="contact-icon">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                <h4>Manager Yogyakarta</h4>
                                <p>manager.yogya@myyogya.co.id</p>
                                <p>+62 274 123 4567</p>
                            </div>
                            <div class="contact-item">
                                <div class="contact-icon">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                <h4>Manager Jakarta</h4>
                                <p>manager.jakarta@myyogya.co.id</p>
                                <p>+62 21 234 5678</p>
                            </div>
                            <div class="contact-item">
                                <div class="contact-icon">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                <h4>Manager Surabaya</h4>
                                <p>manager.surabaya@myyogya.co.id</p>
                                <p>+62 31 345 6789</p>
                            </div>
                            <div class="contact-item">
                                <div class="contact-icon">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                <h4>Manager Bandung</h4>
                                <p>manager.bandung@myyogya.co.id</p>
                                <p>+62 22 456 7890</p>
                            </div>
                            <div class="contact-item">
                                <div class="contact-icon">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                <h4>Manager Medan</h4>
                                <p>manager.medan@myyogya.co.id</p>
                                <p>+62 61 567 8901</p>
                            </div>
                            <div class="contact-item">
                                <div class="contact-icon">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                <h4>Manager Semarang</h4>
                                <p>manager.semarang@myyogya.co.id</p>
                                <p>+62 24 678 9012</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Technical Support Section -->
                <div id="technical-support" class="manual-section">
                    <div class="section-header">
                        <div class="section-icon">
                            <i class="fas fa-cogs"></i>
                        </div>
                        <div class="section-title">
                            <h2>Technical Support</h2>
                            <p>Tim dukungan teknis untuk masalah sistem dan IT</p>
                        </div>
                    </div>

                    <div class="content-card">
                        <h3><i class="fas fa-tools"></i> Tim IT Support</h3>
                        
                        <div class="contact-grid">
                            <div class="contact-item">
                                <div class="contact-icon">
                                    <i class="fas fa-laptop-code"></i>
                                </div>
                                <h4>IT Support Level 1</h4>
                                <p>support@myyogya.co.id</p>
                                <p>Bantuan teknis umum</p>
                            </div>
                            <div class="contact-item">
                                <div class="contact-icon">
                                    <i class="fas fa-server"></i>
                                </div>
                                <h4>IT Support Level 2</h4>
                                <p>advanced.support@myyogya.co.id</p>
                                <p>Masalah teknis kompleks</p>
                            </div>
                            <div class="contact-item">
                                <div class="contact-icon">
                                    <i class="fas fa-network-wired"></i>
                                </div>
                                <h4>Network Admin</h4>
                                <p>network@myyogya.co.id</p>
                                <p>Masalah jaringan & koneksi</p>
                            </div>
                            <div class="contact-item">
                                <div class="contact-icon">
                                    <i class="fas fa-shield-alt"></i>
                                </div>
                                <h4>Security Admin</h4>
                                <p>security@myyogya.co.id</p>
                                <p>Keamanan sistem & data</p>
                            </div>
                            <div class="contact-item">
                                <div class="contact-icon">
                                    <i class="fas fa-mobile-alt"></i>
                                </div>
                                <h4>Mobile App Support</h4>
                                <p>mobile@myyogya.co.id</p>
                                <p>Dukungan aplikasi mobile</p>
                            </div>
                            <div class="contact-item">
                                <div class="contact-icon">
                                    <i class="fas fa-globe"></i>
                                </div>
                                <h4>Web Support</h4>
                                <p>web@myyogya.co.id</p>
                                <p>Dukungan website</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Jam Operasional Section -->
                <div id="jam-operasional" class="manual-section">
                    <div class="section-header">
                        <div class="section-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div class="section-title">
                            <h2>Jam Operasional</h2>
                            <p>Waktu layanan untuk setiap departemen</p>
                        </div>
                    </div>

                    <div class="content-card">
                        <h3><i class="fas fa-calendar-alt"></i> Jadwal Layanan</h3>
                        
                        <div class="step-container">
                            <div class="step-item">
                                <div class="step-number"><i class="fas fa-headset"></i></div>
                                <div class="step-content">
                                    <h4>Customer Service</h4>
                                    <p>Senin - Minggu: 24 jam (Online)<br>
                                    Live Chat: 08:00 - 22:00 WIB</p>
                                </div>
                            </div>
                            <div class="step-item">
                                <div class="step-number"><i class="fas fa-cogs"></i></div>
                                <div class="step-content">
                                    <h4>Technical Support</h4>
                                    <p>Senin - Jumat: 08:00 - 17:00 WIB<br>
                                    Weekend: 09:00 - 15:00 WIB</p>
                                </div>
                            </div>
                            <div class="step-item">
                                <div class="step-number"><i class="fas fa-store"></i></div>
                                <div class="step-content">
                                    <h4>Manager Toko</h4>
                                    <p>Senin - Minggu: 08:00 - 21:00 WIB<br>
                                    Sesuai jam operasional toko</p>
                                </div>
                            </div>
                            <div class="step-item">
                                <div class="step-number"><i class="fas fa-user-shield"></i></div>
                                <div class="step-content">
                                    <h4>Admin Sistem</h4>
                                    <p>Senin - Jumat: 08:00 - 17:00 WIB<br>
                                    Emergency: 24/7</p>
                                </div>
                            </div>
                        </div>

                        <div class="info-box info-info">
                            <i class="fas fa-info-circle"></i>
                            <div>
                                <h4>Catatan Penting</h4>
                                <p>Untuk emergency atau masalah kritis, gunakan kontak darurat yang tersedia 24/7. Respon time bervariasi tergantung tingkat prioritas masalah.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Kontak Darurat Section -->
                <div id="kontak-darurat" class="manual-section">
                    <div class="section-header">
                        <div class="section-icon">
                            <i class="fas fa-exclamation-triangle"></i>
                        </div>
                        <div class="section-title">
                            <h2>Kontak Darurat</h2>
                            <p>Nomor kontak untuk situasi darurat dan kritis</p>
                        </div>
                    </div>

                    <div class="content-card">
                        <h3><i class="fas fa-phone-volume"></i> Emergency Contacts</h3>
                        
                        <div class="contact-grid">
                            <div class="contact-item">
                                <div class="contact-icon">
                                    <i class="fas fa-exclamation-circle"></i>
                                </div>
                                <h4>Emergency Hotline</h4>
                                <p>+62 812 9999 0000</p>
                                <p>24/7 Emergency Response</p>
                            </div>
                            <div class="contact-item">
                                <div class="contact-icon">
                                    <i class="fas fa-shield-alt"></i>
                                </div>
                                <h4>Security Emergency</h4>
                                <p>+62 812 8888 0000</p>
                                <p>Keamanan & ancaman sistem</p>
                            </div>
                            <div class="contact-item">
                                <div class="contact-icon">
                                    <i class="fas fa-server"></i>
                                </div>
                                <h4>System Down Emergency</h4>
                                <p>+62 812 7777 0000</p>
                                <p>Server down & system critical</p>
                            </div>
                            <div class="contact-item">
                                <div class="contact-icon">
                                    <i class="fas fa-credit-card"></i>
                                </div>
                                <h4>Payment Emergency</h4>
                                <p>+62 812 6666 0000</p>
                                <p>Masalah transaksi kritis</p>
                            </div>
                            <div class="contact-item">
                                <div class="contact-icon">
                                    <i class="fas fa-user-tie"></i>
                                </div>
                                <h4>Management Emergency</h4>
                                <p>emergency@myyogya.co.id</p>
                                <p>Direktur & management tinggi</p>
                            </div>
                            <div class="contact-item">
                                <div class="contact-icon">
                                    <i class="fas fa-ambulance"></i>
                                </div>
                                <h4>Incident Response</h4>
                                <p>incident@myyogya.co.id</p>
                                <p>Tim respons cepat</p>
                            </div>
                        </div>

                        <div class="info-box info-warning">
                            <i class="fas fa-exclamation-triangle"></i>
                            <div>
                                <h4>Peringatan</h4>
                                <p>Gunakan kontak darurat hanya untuk situasi yang benar-benar emergency. Penyalahgunaan kontak darurat akan dikenakan sanksi.</p>
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
                            <h2>FAQ Kontak</h2>
                            <p>Pertanyaan yang sering diajukan tentang kontak admin</p>
                        </div>
                    </div>

                    <div class="content-card">
                        <h3><i class="fas fa-clipboard-question"></i> FAQ</h3>
                        
                        <div class="faq-container">
                            <div class="faq-item">
                                <div class="faq-question">
                                    <h4>Siapa yang harus dihubungi untuk masalah login?</h4>
                                    <i class="fas fa-plus"></i>
                                </div>
                                <div class="faq-answer">
                                    <p>Untuk masalah login, hubungi Customer Service di 0800-1-YOGYA atau chat WhatsApp +62 812 3456 7890. Mereka akan membantu reset password atau troubleshooting masalah login.</p>
                                </div>
                            </div>
                            <div class="faq-item">
                                <div class="faq-question">
                                    <h4>Bagaimana menghubungi admin untuk masalah produk?</h4>
                                    <i class="fas fa-plus"></i>
                                </div>
                                <div class="faq-answer">
                                    <p>Hubungi Admin Produk di produk@myyogya.co.id untuk masalah terkait katalog produk, stok, harga, atau informasi produk yang tidak akurat.</p>
                                </div>
                            </div>
                            <div class="faq-item">
                                <div class="faq-question">
                                    <h4>Kapan menggunakan kontak darurat?</h4>
                                    <i class="fas fa-plus"></i>
                                </div>
                                <div class="faq-answer">
                                    <p>Kontak darurat hanya untuk situasi kritis seperti: system down total, security breach, masalah pembayaran besar-besaran, atau ancaman keamanan data.</p>
                                </div>
                            </div>
                            <div class="faq-item">
                                <div class="faq-question">
                                    <h4>Berapa lama respon time setiap departemen?</h4>
                                    <i class="fas fa-plus"></i>
                                </div>
                                <div class="faq-answer">
                                    <p>Customer Service: Instant (chat/call), Email: 2 jam. Technical Support: 4-8 jam. Admin: 1-2 hari kerja. Emergency: 15 menit.</p>
                                </div>
                            </div>
                            <div class="faq-item">
                                <div class="faq-question">
                                    <h4>Bagaimana cara escalate masalah yang tidak terselesaikan?</h4>
                                    <i class="fas fa-plus"></i>
                                </div>
                                <div class="faq-answer">
                                    <p>Jika masalah tidak terselesaikan: CS → CS Manager → Technical Support → Admin terkait → Management Emergency. Atau langsung email ke escalation@myyogya.co.id</p>
                                </div>
                            </div>
                            <div class="faq-item">
                                <div class="faq-question">
                                    <h4>Apakah ada biaya untuk menghubungi customer service?</h4>
                                    <i class="fas fa-plus"></i>
                                </div>
                                <div class="faq-answer">
                                    <p>Customer service melalui hotline 0800-1-YOGYA gratis. WhatsApp, email, dan live chat juga gratis. Hanya berlaku tarif normal operator untuk panggilan mobile.</p>
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
                            <p>Informasi tambahan dan panduan kontak</p>
                        </div>
                    </div>

                    <div class="content-card">
                        <h3><i class="fas fa-question-circle"></i> Panduan Kontak</h3>
                        
                        <div class="info-box info-success">
                            <i class="fas fa-lightbulb"></i>
                            <div>
                                <h4>Tips Kontak Efektif</h4>
                                <p>Siapkan informasi lengkap sebelum menghubungi: nomor akun, detail masalah, screenshot error (jika ada), dan langkah yang sudah dicoba.</p>
                            </div>
                        </div>

                        <div class="info-box info-info">
                            <i class="fas fa-clock"></i>
                            <div>
                                <h4>Waktu Terbaik Menghubungi</h4>
                                <p>Untuk respon tercepat: Senin-Jumat 09:00-11:00 dan 14:00-16:00 WIB. Hindari jam sibuk 12:00-13:00 dan 17:00-19:00 WIB.</p>
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
