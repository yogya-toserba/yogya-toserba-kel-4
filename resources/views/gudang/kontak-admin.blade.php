<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontak Admin - Sistem Gudang Yogya Toserba</title>
    <link rel="stylesheet" href="{{ asset('css/gudang/kontak-admin.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="icon" href="{{ asset('image/logo_yogya.png') }}" type="image/png">
</head>

<body>
    <!-- Header -->
    <header class="kontak-header">
        <div class="header-container">
            <div class="logo-section">
                <div class="admin-icon-header">
                    <i class="fas fa-user-shield"></i>
                </div>
                <div class="header-title">
                    <h1>Kontak Admin Sistem Gudang</h1>
                    <p>Direktori Kontak Administrator & Supervisor v1.0.0</p>
                </div>
            </div>
            <div class="header-actions">
                <a href="{{ route('gudang.login') }}" class="btn-back">
                    <i class="fas fa-arrow-left"></i>
                    Kembali ke Login
                </a>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="kontak-main">
        <div class="container">
            <!-- Sidebar Navigation -->
            <aside class="kontak-sidebar">
                <div class="sidebar-sticky">
                    <h3><i class="fas fa-list"></i> Menu Kontak</h3>
                    <nav class="kontak-nav">
                        <ul>
                            <li><a href="#admin-utama" class="nav-link active"><i class="fas fa-crown"></i> Admin Utama</a></li>
                            <li><a href="#supervisor" class="nav-link"><i class="fas fa-users"></i> Supervisor</a></li>
                            <li><a href="#admin-cabang" class="nav-link"><i class="fas fa-building"></i> Admin Cabang</a></li>
                            <li><a href="#admin-teknis" class="nav-link"><i class="fas fa-cogs"></i> Admin Teknis</a></li>
                            <li><a href="#jadwal-kerja" class="nav-link"><i class="fas fa-clock"></i> Jadwal Kerja</a></li>
                            <li><a href="#kontak-darurat" class="nav-link"><i class="fas fa-exclamation-triangle"></i> Kontak Darurat</a></li>
                        </ul>
                    </nav>
                </div>
            </aside>

            <!-- Content Area -->
            <div class="kontak-content">
                <!-- Admin Utama Section -->
                <section id="admin-utama" class="kontak-section">
                    <div class="section-header">
                        <i class="fas fa-crown section-icon"></i>
                        <h2>Administrator Utama</h2>
                    </div>
                    <div class="section-content">
                        <p class="intro-text">
                            Administrator utama sistem gudang yang memiliki akses penuh dan bertanggung jawab atas operasional sistem secara keseluruhan.
                        </p>

                        <div class="admin-hierarchy">
                            <div class="hierarchy-title">
                                <h3>Struktur Administrator</h3>
                                <p>Hierarki administrator sistem gudang Yogya Toserba</p>
                            </div>
                            
                            <div class="hierarchy-chart">
                                <div class="hierarchy-level">
                                    <div class="admin-card manager">
                                        <div class="admin-avatar">
                                            <i class="fas fa-user-tie"></i>
                                        </div>
                                        <div class="admin-name">Budi Santoso</div>
                                        <div class="admin-role">General Manager</div>
                                        <div class="admin-contact">budi.santoso@yogya.co.id</div>
                                    </div>
                                </div>
                                
                                <div class="hierarchy-level">
                                    <div class="admin-card supervisor">
                                        <div class="admin-avatar">
                                            <i class="fas fa-user-cog"></i>
                                        </div>
                                        <div class="admin-name">Sari Dewi</div>
                                        <div class="admin-role">IT Manager</div>
                                        <div class="admin-contact">sari.dewi@yogya.co.id</div>
                                    </div>
                                    
                                    <div class="admin-card supervisor">
                                        <div class="admin-avatar">
                                            <i class="fas fa-warehouse"></i>
                                        </div>
                                        <div class="admin-name">Ahmad Fauzi</div>
                                        <div class="admin-role">Warehouse Manager</div>
                                        <div class="admin-contact">ahmad.fauzi@yogya.co.id</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="contact-grid">
                            <div class="contact-item">
                                <div class="contact-header">
                                    <div class="contact-icon">
                                        <i class="fas fa-user-tie"></i>
                                    </div>
                                    <div class="contact-info">
                                        <h4>General Manager</h4>
                                        <p>Kepala operasional seluruh sistem</p>
                                    </div>
                                </div>
                                <div class="contact-details">
                                    <p><strong>Nama:</strong> Budi Santoso</p>
                                    <p><strong>Email:</strong> <a href="mailto:budi.santoso@yogya.co.id">budi.santoso@yogya.co.id</a></p>
                                    <p><strong>Phone:</strong> <a href="tel:+622174567890">+62 21 7456 7890</a></p>
                                    <p><strong>Ext:</strong> 101</p>
                                    <p><strong>WhatsApp:</strong> <a href="https://wa.me/6281234567890">+62 812 3456 7890</a></p>
                                </div>
                            </div>

                            <div class="contact-item">
                                <div class="contact-header">
                                    <div class="contact-icon">
                                        <i class="fas fa-user-cog"></i>
                                    </div>
                                    <div class="contact-info">
                                        <h4>IT Manager</h4>
                                        <p>Kepala divisi teknologi informasi</p>
                                    </div>
                                </div>
                                <div class="contact-details">
                                    <p><strong>Nama:</strong> Sari Dewi</p>
                                    <p><strong>Email:</strong> <a href="mailto:sari.dewi@yogya.co.id">sari.dewi@yogya.co.id</a></p>
                                    <p><strong>Phone:</strong> <a href="tel:+622174567891">+62 21 7456 7891</a></p>
                                    <p><strong>Ext:</strong> 102</p>
                                    <p><strong>WhatsApp:</strong> <a href="https://wa.me/6281234567891">+62 812 3456 7891</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Supervisor Section -->
                <section id="supervisor" class="kontak-section">
                    <div class="section-header">
                        <i class="fas fa-users section-icon"></i>
                        <h2>Supervisor Gudang</h2>
                    </div>
                    <div class="section-content">
                        <p class="intro-text">
                            Supervisor yang bertanggung jawab atas operasional harian gudang dan supervisi langsung terhadap staff gudang.
                        </p>

                        <div class="contact-grid">
                            <div class="contact-item">
                                <div class="contact-header">
                                    <div class="contact-icon">
                                        <i class="fas fa-warehouse"></i>
                                    </div>
                                    <div class="contact-info">
                                        <h4>Warehouse Manager</h4>
                                        <p>Supervisor operasional gudang</p>
                                    </div>
                                </div>
                                <div class="contact-details">
                                    <p><strong>Nama:</strong> Ahmad Fauzi</p>
                                    <p><strong>Email:</strong> <a href="mailto:ahmad.fauzi@yogya.co.id">ahmad.fauzi@yogya.co.id</a></p>
                                    <p><strong>Phone:</strong> <a href="tel:+622174567892">+62 21 7456 7892</a></p>
                                    <p><strong>Ext:</strong> 201</p>
                                    <p><strong>WhatsApp:</strong> <a href="https://wa.me/6281234567892">+62 812 3456 7892</a></p>
                                </div>
                            </div>

                            <div class="contact-item">
                                <div class="contact-header">
                                    <div class="contact-icon">
                                        <i class="fas fa-clipboard-check"></i>
                                    </div>
                                    <div class="contact-info">
                                        <h4>Supervisor Shift Pagi</h4>
                                        <p>Supervisi operasional shift 07:00-15:00</p>
                                    </div>
                                </div>
                                <div class="contact-details">
                                    <p><strong>Nama:</strong> Maya Sari</p>
                                    <p><strong>Email:</strong> <a href="mailto:maya.sari@yogya.co.id">maya.sari@yogya.co.id</a></p>
                                    <p><strong>Phone:</strong> <a href="tel:+622174567893">+62 21 7456 7893</a></p>
                                    <p><strong>Ext:</strong> 202</p>
                                    <p><strong>WhatsApp:</strong> <a href="https://wa.me/6281234567893">+62 812 3456 7893</a></p>
                                </div>
                            </div>

                            <div class="contact-item">
                                <div class="contact-header">
                                    <div class="contact-icon">
                                        <i class="fas fa-moon"></i>
                                    </div>
                                    <div class="contact-info">
                                        <h4>Supervisor Shift Sore</h4>
                                        <p>Supervisi operasional shift 15:00-23:00</p>
                                    </div>
                                </div>
                                <div class="contact-details">
                                    <p><strong>Nama:</strong> Rudi Hartono</p>
                                    <p><strong>Email:</strong> <a href="mailto:rudi.hartono@yogya.co.id">rudi.hartono@yogya.co.id</a></p>
                                    <p><strong>Phone:</strong> <a href="tel:+622174567894">+62 21 7456 7894</a></p>
                                    <p><strong>Ext:</strong> 203</p>
                                    <p><strong>WhatsApp:</strong> <a href="https://wa.me/6281234567894">+62 812 3456 7894</a></p>
                                </div>
                            </div>

                            <div class="contact-item">
                                <div class="contact-header">
                                    <div class="contact-icon">
                                        <i class="fas fa-star"></i>
                                    </div>
                                    <div class="contact-info">
                                        <h4>Supervisor Shift Malam</h4>
                                        <p>Supervisi operasional shift 23:00-07:00</p>
                                    </div>
                                </div>
                                <div class="contact-details">
                                    <p><strong>Nama:</strong> Sari Dewi</p>
                                    <p><strong>Email:</strong> <a href="mailto:sari.dewi@yogya.co.id">sari.dewi@yogya.co.id</a></p>
                                    <p><strong>Phone:</strong> <a href="tel:+622174567895">+62 21 7456 7895</a></p>
                                    <p><strong>Ext:</strong> 204</p>
                                    <p><strong>WhatsApp:</strong> <a href="https://wa.me/6281234567895">+62 812 3456 7895</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Admin Cabang Section -->
                <section id="admin-cabang" class="kontak-section">
                    <div class="section-header">
                        <i class="fas fa-building section-icon"></i>
                        <h2>Administrator Cabang</h2>
                    </div>
                    <div class="section-content">
                        <p class="intro-text">
                            Administrator yang bertanggung jawab atas sistem gudang di setiap cabang Yogya Toserba.
                        </p>

                        <div class="contact-grid">
                            <div class="contact-item">
                                <div class="contact-header">
                                    <div class="contact-icon">
                                        <i class="fas fa-store"></i>
                                    </div>
                                    <div class="contact-info">
                                        <h4>Admin Cabang Jakarta</h4>
                                        <p>Gudang Jakarta Pusat & Jakarta Selatan</p>
                                    </div>
                                </div>
                                <div class="contact-details">
                                    <p><strong>Nama:</strong> Andi Wijaya</p>
                                    <p><strong>Email:</strong> <a href="mailto:andi.wijaya@yogya.co.id">andi.wijaya@yogya.co.id</a></p>
                                    <p><strong>Phone:</strong> <a href="tel:+622174567895">+62 21 7456 7895</a></p>
                                    <p><strong>Ext:</strong> 301</p>
                                    <p><strong>WhatsApp:</strong> <a href="https://wa.me/6281234567895">+62 812 3456 7895</a></p>
                                </div>
                            </div>

                            <div class="contact-item">
                                <div class="contact-header">
                                    <div class="contact-icon">
                                        <i class="fas fa-city"></i>
                                    </div>
                                    <div class="contact-info">
                                        <h4>Admin Cabang Surabaya</h4>
                                        <p>Gudang Surabaya & Jawa Timur</p>
                                    </div>
                                </div>
                                <div class="contact-details">
                                    <p><strong>Nama:</strong> Fitri Handayani</p>
                                    <p><strong>Email:</strong> <a href="mailto:fitri.handayani@yogya.co.id">fitri.handayani@yogya.co.id</a></p>
                                    <p><strong>Phone:</strong> <a href="tel:+62317234567">+62 31 7234 567</a></p>
                                    <p><strong>Ext:</strong> 302</p>
                                    <p><strong>WhatsApp:</strong> <a href="https://wa.me/6281234567896">+62 812 3456 7896</a></p>
                                </div>
                            </div>

                            <div class="contact-item">
                                <div class="contact-header">
                                    <div class="contact-icon">
                                        <i class="fas fa-mountain"></i>
                                    </div>
                                    <div class="contact-info">
                                        <h4>Admin Cabang Bandung</h4>
                                        <p>Gudang Bandung & Jawa Barat</p>
                                    </div>
                                </div>
                                <div class="contact-details">
                                    <p><strong>Nama:</strong> Dedi Setiawan</p>
                                    <p><strong>Email:</strong> <a href="mailto:dedi.setiawan@yogya.co.id">dedi.setiawan@yogya.co.id</a></p>
                                    <p><strong>Phone:</strong> <a href="tel:+62227345678">+62 22 7345 678</a></p>
                                    <p><strong>Ext:</strong> 303</p>
                                    <p><strong>WhatsApp:</strong> <a href="https://wa.me/6281234567897">+62 812 3456 7897</a></p>
                                </div>
                            </div>

                            <div class="contact-item">
                                <div class="contact-header">
                                    <div class="contact-icon">
                                        <i class="fas fa-tree"></i>
                                    </div>
                                    <div class="contact-info">
                                        <h4>Admin Cabang Medan</h4>
                                        <p>Gudang Medan & Sumatera Utara</p>
                                    </div>
                                </div>
                                <div class="contact-details">
                                    <p><strong>Nama:</strong> Rina Maharani</p>
                                    <p><strong>Email:</strong> <a href="mailto:rina.maharani@yogya.co.id">rina.maharani@yogya.co.id</a></p>
                                    <p><strong>Phone:</strong> <a href="tel:+62617345678">+62 61 7345 678</a></p>
                                    <p><strong>Ext:</strong> 304</p>
                                    <p><strong>WhatsApp:</strong> <a href="https://wa.me/6281234567898">+62 812 3456 7898</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Admin Teknis Section -->
                <section id="admin-teknis" class="kontak-section">
                    <div class="section-header">
                        <i class="fas fa-cogs section-icon"></i>
                        <h2>Administrator Teknis</h2>
                    </div>
                    <div class="section-content">
                        <p class="intro-text">
                            Administrator yang menangani aspek teknis sistem, maintenance, dan support IT untuk operasional gudang.
                        </p>

                        <div class="contact-grid">
                            <div class="contact-item">
                                <div class="contact-header">
                                    <div class="contact-icon">
                                        <i class="fas fa-database"></i>
                                    </div>
                                    <div class="contact-info">
                                        <h4>Database Administrator</h4>
                                        <p>Pengelolaan database dan backup sistem</p>
                                    </div>
                                </div>
                                <div class="contact-details">
                                    <p><strong>Nama:</strong> Agus Pratama</p>
                                    <p><strong>Email:</strong> <a href="mailto:agus.pratama@yogya.co.id">agus.pratama@yogya.co.id</a></p>
                                    <p><strong>Phone:</strong> <a href="tel:+622174567896">+62 21 7456 7896</a></p>
                                    <p><strong>Ext:</strong> 401</p>
                                    <p><strong>WhatsApp:</strong> <a href="https://wa.me/6281234567898">+62 812 3456 7898</a></p>
                                </div>
                            </div>

                            <div class="contact-item">
                                <div class="contact-header">
                                    <div class="contact-icon">
                                        <i class="fas fa-network-wired"></i>
                                    </div>
                                    <div class="contact-info">
                                        <h4>Network Administrator</h4>
                                        <p>Pengelolaan jaringan dan infrastruktur IT</p>
                                    </div>
                                </div>
                                <div class="contact-details">
                                    <p><strong>Nama:</strong> Lisa Permata</p>
                                    <p><strong>Email:</strong> <a href="mailto:lisa.permata@yogya.co.id">lisa.permata@yogya.co.id</a></p>
                                    <p><strong>Phone:</strong> <a href="tel:+622174567897">+62 21 7456 7897</a></p>
                                    <p><strong>Ext:</strong> 402</p>
                                    <p><strong>WhatsApp:</strong> <a href="https://wa.me/6281234567899">+62 812 3456 7899</a></p>
                                </div>
                            </div>

                            <div class="contact-item">
                                <div class="contact-header">
                                    <div class="contact-icon">
                                        <i class="fas fa-shield-alt"></i>
                                    </div>
                                    <div class="contact-info">
                                        <h4>Security Administrator</h4>
                                        <p>Keamanan sistem dan access control</p>
                                    </div>
                                </div>
                                <div class="contact-details">
                                    <p><strong>Nama:</strong> Bayu Nugroho</p>
                                    <p><strong>Email:</strong> <a href="mailto:bayu.nugroho@yogya.co.id">bayu.nugroho@yogya.co.id</a></p>
                                    <p><strong>Phone:</strong> <a href="tel:+622174567898">+62 21 7456 7898</a></p>
                                    <p><strong>Ext:</strong> 403</p>
                                    <p><strong>WhatsApp:</strong> <a href="https://wa.me/6281234567800">+62 812 3456 7800</a></p>
                                </div>
                            </div>

                            <div class="contact-item">
                                <div class="contact-header">
                                    <div class="contact-icon">
                                        <i class="fas fa-chart-line"></i>
                                    </div>
                                    <div class="contact-info">
                                        <h4>System Analyst</h4>
                                        <p>Analisis sistem dan optimasi performa</p>
                                    </div>
                                </div>
                                <div class="contact-details">
                                    <p><strong>Nama:</strong> Fira Andini</p>
                                    <p><strong>Email:</strong> <a href="mailto:fira.andini@yogya.co.id">fira.andini@yogya.co.id</a></p>
                                    <p><strong>Phone:</strong> <a href="tel:+622174567899">+62 21 7456 7899</a></p>
                                    <p><strong>Ext:</strong> 404</p>
                                    <p><strong>WhatsApp:</strong> <a href="https://wa.me/6281234567801">+62 812 3456 7801</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Jadwal Kerja Section -->
                <section id="jadwal-kerja" class="kontak-section">
                    <div class="section-header">
                        <i class="fas fa-clock section-icon"></i>
                        <h2>Jadwal Kerja Administrator</h2>
                    </div>
                    <div class="section-content">
                        <p class="intro-text">
                            Jadwal kerja dan ketersediaan administrator sistem gudang untuk berbagai keperluan support dan konsultasi.
                        </p>

                        <div class="operating-hours">
                            <div class="hours-header">
                                <h3><i class="fas fa-business-time"></i> Jam Operasional Admin</h3>
                            </div>
                            <div class="hours-content">
                                <div class="hours-grid">
                                    <div class="hours-item">
                                        <h4>Admin Utama</h4>
                                        <p><strong>Senin - Jumat:</strong> 08:00 - 17:00 WIB</p>
                                        <p><strong>Sabtu:</strong> 08:00 - 14:00 WIB</p>
                                        <p><strong>Minggu:</strong> Libur</p>
                                        <p class="status online">📱 On-call untuk emergency</p>
                                    </div>

                                    <div class="hours-item">
                                        <h4>Supervisor Shift</h4>
                                        <p><strong>Shift Pagi:</strong> 07:00 - 15:00 WIB</p>
                                        <p><strong>Shift Sore:</strong> 15:00 - 23:00 WIB</p>
                                        <p><strong>Shift Malam:</strong> 23:00 - 07:00 WIB</p>
                                        <p class="status online">🔄 Rotasi mingguan</p>
                                    </div>

                                    <div class="hours-item">
                                        <h4>Admin Teknis</h4>
                                        <p><strong>Senin - Jumat:</strong> 09:00 - 18:00 WIB</p>
                                        <p><strong>Weekend:</strong> On-call only</p>
                                        <p><strong>Maintenance:</strong> Minggu 02:00 - 06:00 WIB</p>
                                        <p class="status limited">⚡ Emergency 24/7</p>
                                    </div>

                                    <div class="hours-item">
                                        <h4>Admin Cabang</h4>
                                        <p><strong>Senin - Sabtu:</strong> 08:00 - 16:00 WIB</p>
                                        <p><strong>Minggu:</strong> 09:00 - 13:00 WIB</p>
                                        <p><strong>Libur Nasional:</strong> Standby</p>
                                        <p class="status online">📞 WhatsApp tersedia</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Kontak Darurat Section -->
                <section id="kontak-darurat" class="kontak-section">
                    <div class="section-header">
                        <i class="fas fa-exclamation-triangle section-icon"></i>
                        <h2>Kontak Darurat</h2>
                    </div>
                    <div class="section-content">
                        <p class="intro-text">
                            Kontak darurat yang dapat dihubungi 24/7 untuk situasi kritis yang memerlukan penanganan segera.
                        </p>

                        <div class="emergency-contact">
                            <h3><i class="fas fa-phone-alt"></i> Hotline Darurat 24/7</h3>
                            <p>Untuk masalah kritis sistem gudang, keamanan data, atau down-time</p>
                            <p><a href="tel:+6280123456789">+62 801 2345 6789</a></p>
                            <p><strong>Response Time:</strong> Maksimal 15 menit</p>
                        </div>

                        <div class="contact-grid">
                            <div class="contact-item">
                                <div class="contact-header">
                                    <div class="contact-icon">
                                        <i class="fas fa-shield-alt"></i>
                                    </div>
                                    <div class="contact-info">
                                        <h4>Security Emergency</h4>
                                        <p>Pelanggaran keamanan & akses tidak sah</p>
                                    </div>
                                </div>
                                <div class="contact-details">
                                    <p><strong>Contact:</strong> Bayu Nugroho</p>
                                    <p><strong>Phone:</strong> <a href="tel:+6281987654321">+62 819 8765 4321</a></p>
                                    <p><strong>Email:</strong> <a href="mailto:security@yogya.co.id">security@yogya.co.id</a></p>
                                    <p><strong>Priority:</strong> <span style="color: #dc3545; font-weight: 600;">CRITICAL</span></p>
                                </div>
                            </div>

                            <div class="contact-item">
                                <div class="contact-header">
                                    <div class="contact-icon">
                                        <i class="fas fa-server"></i>
                                    </div>
                                    <div class="contact-info">
                                        <h4>System Emergency</h4>
                                        <p>Down-time sistem & database error</p>
                                    </div>
                                </div>
                                <div class="contact-details">
                                    <p><strong>Contact:</strong> Agus Pratama</p>
                                    <p><strong>Phone:</strong> <a href="tel:+6281876543210">+62 818 7654 3210</a></p>
                                    <p><strong>Email:</strong> <a href="mailto:system@yogya.co.id">system@yogya.co.id</a></p>
                                    <p><strong>Priority:</strong> <span style="color: #dc3545; font-weight: 600;">URGENT</span></p>
                                </div>
                            </div>

                            <div class="contact-item">
                                <div class="contact-header">
                                    <div class="contact-icon">
                                        <i class="fas fa-exclamation-circle"></i>
                                    </div>
                                    <div class="contact-info">
                                        <h4>Operational Emergency</h4>
                                        <p>Masalah operasional gudang kritik</p>
                                    </div>
                                </div>
                                <div class="contact-details">
                                    <p><strong>Contact:</strong> Ahmad Fauzi</p>
                                    <p><strong>Phone:</strong> <a href="tel:+6281765432109">+62 817 6543 2109</a></p>
                                    <p><strong>Email:</strong> <a href="mailto:operations@yogya.co.id">operations@yogya.co.id</a></p>
                                    <p><strong>Priority:</strong> <span style="color: #ffc107; font-weight: 600;">HIGH</span></p>
                                </div>
                            </div>

                            <div class="contact-item">
                                <div class="contact-header">
                                    <div class="contact-icon">
                                        <i class="fas fa-users-cog"></i>
                                    </div>
                                    <div class="contact-info">
                                        <h4>Management Emergency</h4>
                                        <p>Eskalasi ke level manajemen senior</p>
                                    </div>
                                </div>
                                <div class="contact-details">
                                    <p><strong>Contact:</strong> Direktur Operasional</p>
                                    <p><strong>Phone:</strong> <a href="tel:+6281765432110">+62 817 6543 2110</a></p>
                                    <p><strong>Email:</strong> <a href="mailto:management@yogya.co.id">management@yogya.co.id</a></p>
                                    <p><strong>Priority:</strong> <span style="color: #dc3545; font-weight: 600;">CRITICAL</span></p>
                                </div>
                            </div>
                        </div>

                        <div style="background: #f8f9fa; border: 1px solid #dee2e6; border-radius: 8px; padding: 1.5rem; margin-top: 2rem;">
                            <h4 style="color: #495057; margin-bottom: 1rem;"><i class="fas fa-info-circle"></i> Panduan Kontak Darurat</h4>
                            <ul style="color: #6c757d; margin: 0; padding-left: 1.5rem;">
                                <li><strong>CRITICAL:</strong> Masalah keamanan data, akses tidak sah, kebocoran sistem</li>
                                <li><strong>URGENT:</strong> Down-time sistem, database corrupt, kehilangan data</li>
                                <li><strong>HIGH:</strong> Gangguan operasional berat, error massal, sistem lambat kritik</li>
                                <li><strong>Catatan:</strong> Untuk masalah non-darurat gunakan kontak regular admin</li>
                            </ul>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </main>

    <!-- Scroll to Top Button -->
    <button class="scroll-to-top" id="scrollToTop">
        <i class="fas fa-arrow-up"></i>
    </button>

    <script>
        // Initialize page
        document.addEventListener('DOMContentLoaded', function() {
            // Show first section immediately
            const sections = document.querySelectorAll('.kontak-section');
            sections.forEach((section, index) => {
                section.style.animationDelay = (index * 0.1) + 's';
            });
            
            // Smooth scroll for navigation links
            const navLinks = document.querySelectorAll('.nav-link');
            navLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    const targetId = this.getAttribute('href');
                    const targetSection = document.querySelector(targetId);
                    
                    // Update active link
                    navLinks.forEach(l => l.classList.remove('active'));
                    this.classList.add('active');
                    
                    // Smooth scroll to section
                    targetSection.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                });
            });
        });

        // Scroll to Top Button
        const scrollToTopBtn = document.getElementById('scrollToTop');
        
        window.addEventListener('scroll', () => {
            if (window.scrollY > 300) {
                scrollToTopBtn.classList.add('visible');
            } else {
                scrollToTopBtn.classList.remove('visible');
            }
        });

        scrollToTopBtn.addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });

        // Update active navigation based on scroll
        window.addEventListener('scroll', () => {
            const sections = document.querySelectorAll('.kontak-section');
            const navLinks = document.querySelectorAll('.nav-link');
            
            let current = '';
            const scrollY = window.scrollY;
            
            sections.forEach(section => {
                const sectionTop = section.offsetTop - 200;
                const sectionBottom = sectionTop + section.offsetHeight;
                
                if (scrollY >= sectionTop && scrollY < sectionBottom) {
                    current = section.getAttribute('id');
                }
            });
            
            navLinks.forEach(link => {
                link.classList.remove('active');
                if (link.getAttribute('href') === '#' + current) {
                    link.classList.add('active');
                }
            });
        });

        // Animation on load
        document.addEventListener('DOMContentLoaded', function() {
            document.body.classList.add('loaded');
        });
    </script>
</body>
</html>
