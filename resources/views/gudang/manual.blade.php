<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manual Sistem Gudang - Yogya Toserba</title>
    <link rel="stylesheet" href="{{ asset('css/gudang/manual.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="icon" href="{{ asset('image/logo_yogya.png') }}" type="image/png">
</head>

<body>
    <!-- Header -->
    <header class="manual-header">
        <div class="header-container">
            <div class="logo-section">
                <div class="warehouse-icon-header">
                    <i class="fas fa-warehouse"></i>
                </div>
                <div class="header-title">
                    <h1>Manual Sistem Gudang</h1>
                    <p>Panduan Penggunaan Sistem Manajemen Gudang v1.0.0</p>
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
    <main class="manual-main">
        <div class="container">
            <!-- Sidebar Navigation -->
            <aside class="manual-sidebar">
                <div class="sidebar-sticky">
                    <h3><i class="fas fa-list"></i> Daftar Isi</h3>
                    <nav class="manual-nav">
                        <ul>
                            <li><a href="#pengenalan" class="nav-link active"><i class="fas fa-home"></i> Pengenalan</a></li>
                            <li><a href="#login" class="nav-link"><i class="fas fa-sign-in-alt"></i> Login Sistem</a></li>
                            <li><a href="#dashboard" class="nav-link"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                            <li><a href="#manajemen-barang" class="nav-link"><i class="fas fa-boxes"></i> Manajemen Barang</a></li>
                            <li><a href="#stok" class="nav-link"><i class="fas fa-clipboard-list"></i> Kelola Stok</a></li>
                            <li><a href="#laporan" class="nav-link"><i class="fas fa-chart-bar"></i> Laporan</a></li>
                            <li><a href="#pengaturan" class="nav-link"><i class="fas fa-cog"></i> Pengaturan</a></li>
                            <li><a href="#troubleshooting" class="nav-link"><i class="fas fa-tools"></i> Troubleshooting</a></li>
                        </ul>
                    </nav>
                </div>
            </aside>

            <!-- Content Area -->
            <div class="manual-content">
                <!-- Section: Pengenalan -->
                <section id="pengenalan" class="manual-section">
                    <div class="section-header">
                        <i class="fas fa-home section-icon"></i>
                        <h2>Pengenalan Sistem Gudang</h2>
                    </div>
                    <div class="section-content">
                        <p class="intro-text">
                            Selamat datang di Sistem Manajemen Gudang Yogya Toserba. Sistem ini dirancang untuk membantu staff gudang dalam mengelola inventaris, melacak stok barang, dan menghasilkan laporan yang akurat.
                        </p>
                        
                        <div class="feature-grid">
                            <div class="feature-item">
                                <i class="fas fa-boxes"></i>
                                <h4>Manajemen Inventaris</h4>
                                <p>Kelola data barang dengan mudah dan efisien</p>
                            </div>
                            <div class="feature-item">
                                <i class="fas fa-chart-line"></i>
                                <h4>Tracking Real-time</h4>
                                <p>Pantau stok barang secara real-time</p>
                            </div>
                            <div class="feature-item">
                                <i class="fas fa-file-alt"></i>
                                <h4>Laporan Otomatis</h4>
                                <p>Generate laporan stok dan pergerakan barang</p>
                            </div>
                            <div class="feature-item">
                                <i class="fas fa-shield-alt"></i>
                                <h4>Keamanan Data</h4>
                                <p>Sistem keamanan berlapis untuk melindungi data</p>
                            </div>
                            <div class="feature-item">
                                <i class="fas fa-barcode"></i>
                                <h4>Barcode Scanner</h4>
                                <p>Scan barcode untuk input dan tracking barang yang cepat</p>
                            </div>
                            <div class="feature-item">
                                <i class="fas fa-sync-alt"></i>
                                <h4>Backup Otomatis</h4>
                                <p>Data tersimpan aman dengan backup berkala otomatis</p>
                            </div>
                        </div>

                        <div class="info-box">
                            <i class="fas fa-info-circle"></i>
                            <div>
                                <h4>Informasi Penting</h4>
                                <p>Manual ini akan terus diperbarui seiring dengan pengembangan sistem. Pastikan untuk selalu menggunakan versi terbaru.</p>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Section: Login -->
                <section id="login" class="manual-section">
                    <div class="section-header">
                        <i class="fas fa-sign-in-alt section-icon"></i>
                        <h2>Login ke Sistem</h2>
                    </div>
                    <div class="section-content">
                        <div class="step-container">
                            <div class="step-item">
                                <div class="step-number">1</div>
                                <div class="step-content">
                                    <h4>Akses Halaman Login</h4>
                                    <p>Buka browser dan navigasikan ke halaman login gudang. Pastikan koneksi internet stabil.</p>
                                </div>
                            </div>
                            
                            <div class="step-item">
                                <div class="step-number">2</div>
                                <div class="step-content">
                                    <h4>Masukkan ID Gudang</h4>
                                    <p>Input ID Gudang yang terdiri dari 4-8 digit angka. ID ini diberikan oleh supervisor gudang.</p>
                                    <div class="code-example">
                                        <strong>Contoh ID:</strong> 1234, 56789, 12345678
                                    </div>
                                </div>
                            </div>

                            <div class="step-item">
                                <div class="step-number">3</div>
                                <div class="step-content">
                                    <h4>Masukkan Password</h4>
                                    <p>Input password yang telah diberikan. Password bersifat case-sensitive.</p>
                                </div>
                            </div>

                            <div class="step-item">
                                <div class="step-number">4</div>
                                <div class="step-content">
                                    <h4>Klik Tombol Masuk</h4>
                                    <p>Setelah semua data diisi dengan benar, klik tombol "Masuk ke Sistem Gudang".</p>
                                </div>
                            </div>
                        </div>

                        <div class="warning-box">
                            <i class="fas fa-exclamation-triangle"></i>
                            <div>
                                <h4>Keamanan Login</h4>
                                <p>Untuk keamanan, sistem tidak menyimpan informasi login. Staff gudang harus login ulang setiap kali mengakses sistem.</p>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Section: Dashboard -->
                <section id="dashboard" class="manual-section">
                    <div class="section-header">
                        <i class="fas fa-tachometer-alt section-icon"></i>
                        <h2>Dashboard Utama</h2>
                    </div>
                    <div class="section-content">
                        <p>Dashboard adalah halaman utama setelah login yang menampilkan ringkasan informasi penting gudang.</p>
                        
                        <div class="dashboard-preview">
                            <h4>Komponen Dashboard:</h4>
                            <ul class="feature-list">
                                <li><i class="fas fa-chart-pie"></i> <strong>Ringkasan Stok:</strong> Jumlah total barang, barang hampir habis, dan barang baru</li>
                                <li><i class="fas fa-bell"></i> <strong>Notifikasi:</strong> Peringatan stok menipis dan update sistem</li>
                                <li><i class="fas fa-clock"></i> <strong>Aktivitas Terbaru:</strong> Log aktivitas terbaru di gudang</li>
                                <li><i class="fas fa-chart-bar"></i> <strong>Grafik Pergerakan:</strong> Visualisasi data masuk dan keluar barang</li>
                            </ul>
                        </div>
                    </div>
                </section>

                <!-- Section: Manajemen Barang -->
                <section id="manajemen-barang" class="manual-section">
                    <div class="section-header">
                        <i class="fas fa-boxes section-icon"></i>
                        <h2>Manajemen Barang</h2>
                    </div>
                    <div class="section-content">
                        <p>Fitur ini memungkinkan Anda untuk mengelola semua data barang di gudang.</p>
                        
                        <div class="tabs-container">
                            <div class="tab-headers">
                                <button class="tab-btn active" data-tab="tambah-barang">Tambah Barang</button>
                                <button class="tab-btn" data-tab="edit-barang">Edit Barang</button>
                                <button class="tab-btn" data-tab="hapus-barang">Hapus Barang</button>
                            </div>
                            
                            <div class="tab-content active" id="tambah-barang">
                                <h4>Menambah Barang Baru</h4>
                                <ol class="numbered-list">
                                    <li>Navigasikan ke menu "Manajemen Barang"</li>
                                    <li>Klik tombol "Tambah Barang Baru"</li>
                                    <li>Isi semua field yang diperlukan:
                                        <ul>
                                            <li>Kode Barang (otomatis generate)</li>
                                            <li>Nama Barang</li>
                                            <li>Kategori</li>
                                            <li>Harga Beli</li>
                                            <li>Harga Jual</li>
                                            <li>Stok Awal</li>
                                            <li>Minimum Stok</li>
                                        </ul>
                                    </li>
                                    <li>Upload foto barang (opsional)</li>
                                    <li>Klik "Simpan" untuk menyimpan data</li>
                                </ol>
                            </div>
                            
                            <div class="tab-content" id="edit-barang">
                                <h4>Mengedit Data Barang</h4>
                                <ol class="numbered-list">
                                    <li>Cari barang menggunakan fitur pencarian</li>
                                    <li>Klik tombol "Edit" pada barang yang ingin diubah</li>
                                    <li>Modifikasi data yang diperlukan</li>
                                    <li>Klik "Update" untuk menyimpan perubahan</li>
                                </ol>
                            </div>
                            
                            <div class="tab-content" id="hapus-barang">
                                <h4>Menghapus Data Barang</h4>
                                <ol class="numbered-list">
                                    <li>Cari barang yang ingin dihapus</li>
                                    <li>Klik tombol "Hapus" (ikon tong sampah)</li>
                                    <li>Konfirmasi penghapusan</li>
                                    <li>Data akan dipindahkan ke arsip</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Section: Kelola Stok -->
                <section id="stok" class="manual-section">
                    <div class="section-header">
                        <i class="fas fa-clipboard-list section-icon"></i>
                        <h2>Kelola Stok</h2>
                    </div>
                    <div class="section-content">
                        <p>Mengelola pergerakan stok barang masuk dan keluar dari gudang.</p>
                        
                        <div class="grid-2">
                            <div class="card">
                                <h4><i class="fas fa-plus-circle text-success"></i> Barang Masuk</h4>
                                <ul>
                                    <li>Scan barcode atau input manual</li>
                                    <li>Pilih supplier</li>
                                    <li>Input jumlah barang masuk</li>
                                    <li>Catat tanggal dan waktu</li>
                                    <li>Upload dokumen pendukung</li>
                                </ul>
                            </div>
                            <div class="card">
                                <h4><i class="fas fa-minus-circle text-danger"></i> Barang Keluar</h4>
                                <ul>
                                    <li>Scan barcode barang keluar</li>
                                    <li>Input tujuan (toko, cabang)</li>
                                    <li>Verifikasi jumlah</li>
                                    <li>Generate surat jalan</li>
                                    <li>Update stok otomatis</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Section: Laporan -->
                <section id="laporan" class="manual-section">
                    <div class="section-header">
                        <i class="fas fa-chart-bar section-icon"></i>
                        <h2>Laporan</h2>
                    </div>
                    <div class="section-content">
                        <p>Generate berbagai jenis laporan untuk analisis dan monitoring gudang.</p>
                        
                        <div class="report-grid">
                            <div class="report-item">
                                <i class="fas fa-boxes"></i>
                                <h4>Laporan Stok</h4>
                                <p>Laporan stok saat ini, stok minimum, dan prediksi kehabisan</p>
                            </div>
                            <div class="report-item">
                                <i class="fas fa-exchange-alt"></i>
                                <h4>Laporan Pergerakan</h4>
                                <p>History barang masuk dan keluar dalam periode tertentu</p>
                            </div>
                            <div class="report-item">
                                <i class="fas fa-money-bill-wave"></i>
                                <h4>Laporan Nilai Inventaris</h4>
                                <p>Nilai total inventaris berdasarkan harga beli dan jual</p>
                            </div>
                            <div class="report-item">
                                <i class="fas fa-truck"></i>
                                <h4>Laporan Supplier</h4>
                                <p>Analisis performa dan ranking supplier</p>
                            </div>
                            <div class="report-item">
                                <i class="fas fa-calendar-check"></i>
                                <h4>Laporan Harian</h4>
                                <p>Ringkasan aktivitas gudang per hari dengan detail transaksi</p>
                            </div>
                            <div class="report-item">
                                <i class="fas fa-exclamation-triangle"></i>
                                <h4>Laporan Stok Kritis</h4>
                                <p>Daftar barang dengan stok mendekati batas minimum atau habis</p>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Section: Pengaturan -->
                <section id="pengaturan" class="manual-section">
                    <div class="section-header">
                        <i class="fas fa-cog section-icon"></i>
                        <h2>Pengaturan Sistem</h2>
                    </div>
                    <div class="section-content">
                        <p>Konfigurasi pengaturan sistem sesuai kebutuhan gudang.</p>
                        
                        <div class="settings-grid">
                            <div class="setting-category">
                                <h4><i class="fas fa-user-cog"></i> Pengaturan Akun</h4>
                                <ul>
                                    <li>Ubah password</li>
                                    <li>Atur preferensi tampilan</li>
                                    <li>Konfigurasi notifikasi</li>
                                </ul>
                            </div>
                            <div class="setting-category">
                                <h4><i class="fas fa-database"></i> Pengaturan Data</h4>
                                <ul>
                                    <li>Backup data otomatis</li>
                                    <li>Import/Export data</li>
                                    <li>Atur retention policy</li>
                                </ul>
                            </div>
                            <div class="setting-category">
                                <h4><i class="fas fa-bell"></i> Pengaturan Alert</h4>
                                <ul>
                                    <li>Threshold stok minimum</li>
                                    <li>Notifikasi email</li>
                                    <li>Alert barang expired</li>
                                </ul>
                            </div>
                            <div class="setting-category">
                                <h4><i class="fas fa-shield-alt"></i> Pengaturan Keamanan</h4>
                                <ul>
                                    <li>Atur timeout session</li>
                                    <li>Konfigurasi akses user</li>
                                    <li>Log aktivitas sistem</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Section: Troubleshooting -->
                <section id="troubleshooting" class="manual-section">
                    <div class="section-header">
                        <i class="fas fa-tools section-icon"></i>
                        <h2>Troubleshooting</h2>
                    </div>
                    <div class="section-content">
                        <p>Solusi untuk masalah umum yang mungkin dihadapi saat menggunakan sistem.</p>
                        
                        <div class="faq-container">
                            <div class="faq-item">
                                <div class="faq-question">
                                    <i class="fas fa-question-circle"></i>
                                    <strong>Tidak bisa login ke sistem</strong>
                                </div>
                                <div class="faq-answer">
                                    <ul>
                                        <li>Pastikan ID Gudang dan password benar</li>
                                        <li>Cek koneksi internet</li>
                                        <li>Clear cache browser</li>
                                        <li>Hubungi supervisor jika masih bermasalah</li>
                                    </ul>
                                </div>
                            </div>
                            
                            <div class="faq-item">
                                <div class="faq-question">
                                    <i class="fas fa-question-circle"></i>
                                    <strong>Data tidak ter-update</strong>
                                </div>
                                <div class="faq-answer">
                                    <ul>
                                        <li>Refresh halaman (F5)</li>
                                        <li>Logout dan login kembali</li>
                                        <li>Pastikan tidak ada 2 orang yang mengedit barang yang sama di waktu bersamaan</li>
                                        <li>Tunggu beberapa detik lalu coba lagi</li>
                                        <li>Cek apakah data sudah tersimpan di menu lain</li>
                                    </ul>
                                </div>
                            </div>
                            
                            <div class="faq-item">
                                <div class="faq-question">
                                    <i class="fas fa-question-circle"></i>
                                    <strong>Scanner barcode tidak berfungsi</strong>
                                </div>
                                <div class="faq-answer">
                                    <ul>
                                        <li>Cek koneksi USB scanner</li>
                                        <li>Restart scanner</li>
                                        <li>Gunakan input manual sebagai alternatif</li>
                                        <li>Hubungi IT support</li>
                                    </ul>
                                </div>
                            </div>

                            <div class="faq-item">
                                <div class="faq-question">
                                    <i class="fas fa-question-circle"></i>
                                    <strong>Laporan tidak bisa di-generate</strong>
                                </div>
                                <div class="faq-answer">
                                    <ul>
                                        <li>Pastikan periode tanggal sudah dipilih dengan benar</li>
                                        <li>Cek apakah ada data dalam periode tersebut</li>
                                        <li>Tunggu beberapa saat dan coba lagi</li>
                                        <li>Coba dengan periode yang lebih kecil</li>
                                        <li>Restart browser jika masalah berlanjut</li>
                                    </ul>
                                </div>
                            </div>

                            <div class="faq-item">
                                <div class="faq-question">
                                    <i class="fas fa-question-circle"></i>
                                    <strong>Sistem berjalan lambat</strong>
                                </div>
                                <div class="faq-answer">
                                    <ul>
                                        <li>Cek koneksi internet</li>
                                        <li>Tutup tab browser yang tidak perlu</li>
                                        <li>Clear cache dan cookies</li>
                                        <li>Restart komputer jika diperlukan</li>
                                        <li>Gunakan browser terbaru (Chrome/Firefox)</li>
                                    </ul>
                                </div>
                            </div>

                            <div class="faq-item">
                                <div class="faq-question">
                                    <i class="fas fa-question-circle"></i>
                                    <strong>Error saat input data barang</strong>
                                </div>
                                <div class="faq-answer">
                                    <ul>
                                        <li>Pastikan semua field yang wajib sudah diisi</li>
                                        <li>Cek format data (angka, tanggal, dll)</li>
                                        <li>Pastikan kode barang belum ada di sistem</li>
                                        <li>Simpan dalam draft terlebih dahulu</li>
                                        <li>Refresh halaman dan coba input ulang</li>
                                    </ul>
                                </div>
                            </div>

                            <div class="faq-item">
                                <div class="faq-question">
                                    <i class="fas fa-question-circle"></i>
                                    <strong>Session timeout atau logout otomatis</strong>
                                </div>
                                <div class="faq-answer">
                                    <ul>
                                        <li>Login kembali dengan kredensial yang sama</li>
                                        <li>Simpan pekerjaan secara berkala</li>
                                        <li>Jangan tinggalkan sistem dalam waktu lama</li>
                                        <li>Atur pengaturan session di menu Pengaturan</li>
                                    </ul>
                                </div>
                            </div>

                            <div class="faq-item">
                                <div class="faq-question">
                                    <i class="fas fa-question-circle"></i>
                                    <strong>Notifikasi tidak muncul</strong>
                                </div>
                                <div class="faq-answer">
                                    <ul>
                                        <li>Cek pengaturan notifikasi di browser</li>
                                        <li>Pastikan notifikasi diizinkan untuk website ini</li>
                                        <li>Periksa pengaturan alert di menu Pengaturan</li>
                                        <li>Refresh halaman untuk sinkronisasi</li>
                                    </ul>
                                </div>
                            </div>

                            <div class="faq-item">
                                <div class="faq-question">
                                    <i class="fas fa-question-circle"></i>
                                    <strong>Data tidak tersimpan atau hilang</strong>
                                </div>
                                <div class="faq-answer">
                                    <ul>
                                        <li>Pastikan selalu klik tombol "Simpan" setelah input data</li>
                                        <li>Jangan tutup browser sebelum data tersimpan</li>
                                        <li>Cek kembali data yang sudah diinput tadi</li>
                                        <li>Lakukan input ulang jika data benar-benar hilang</li>
                                        <li>Laporkan ke supervisor jika masalah terus terjadi</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="contact-support">
                            <h4><i class="fas fa-headset"></i> Butuh Bantuan Lebih Lanjut?</h4>
                            <p>Jika masalah tidak dapat diselesaikan, hubungi:</p>
                            <div class="contact-info">
                                <div class="contact-item">
                                    <i class="fas fa-phone"></i>
                                    <span>IT Support: (021) 1234-5678</span>
                                </div>
                                <div class="contact-item">
                                    <i class="fas fa-envelope"></i>
                                    <span>Email: support@yogyatoserba.com</span>
                                </div>
                                <div class="contact-item">
                                    <i class="fas fa-clock"></i>
                                    <span>Jam Operasional: 08:00 - 17:00 WIB</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="manual-footer">
        <div class="footer-container">
            <div class="footer-content">
                <!-- Sistem Gudang -->
                <div class="footer-section">
                    <h4>Sistem Gudang</h4>
                    <ul>
                        <li><a href="#pengenalan">Tentang Sistem</a></li>
                        <li><a href="#login">Panduan Login</a></li>
                        <li><a href="#manajemen-barang">Kelola Inventaris</a></li>
                        <li><a href="#stok">Manajemen Stok</a></li>
                        <li><a href="#laporan">Laporan</a></li>
                        <li><a href="#pengaturan">Pengaturan</a></li>
                    </ul>
                </div>

                <!-- Fitur Utama -->
                <div class="footer-section">
                    <h4>Fitur Utama</h4>
                    <ul>
                        <li><a href="#manajemen-barang">Input Barang</a></li>
                        <li><a href="#stok">Tracking Stok</a></li>
                        <li><a href="#laporan">Generate Laporan</a></li>
                        <li><a href="#dashboard">Dashboard Real-time</a></li>
                        <li><a href="#pengaturan">Backup Data</a></li>
                        <li><a href="#troubleshooting">Bantuan Teknis</a></li>
                    </ul>
                </div>

                <!-- Informasi Sistem -->
                <div class="footer-section">
                    <h4>Informasi Sistem</h4>
                    <ul>
                        <li><a href="#login">Akses Sistem</a></li>
                        <li><a href="#fitur">Fitur Unggulan</a></li>
                        <li><a href="#keamanan">Keamanan Data</a></li>
                        <li><a href="#dukungan">Dukungan Teknis</a></li>
                        <li><a href="#pembaruan">Update Sistem</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="footer-bottom">
                <p>&copy; 2025 Yogya Toserba - Sistem Manajemen Gudang. Semua hak dilindungi.</p>
                <p class="version-info">Versi Sistem: 1.0.0 | Build: 20250801 | Release: Agustus 2025</p>
            </div>
        </div>
    </footer>

    <!-- Scroll to Top Button -->
    <button class="scroll-to-top" id="scrollToTop">
        <i class="fas fa-arrow-up"></i>
    </button>

    <script>
        // Initialize page
        document.addEventListener('DOMContentLoaded', function() {
            // Show first section immediately
            document.querySelector('.manual-section').classList.add('visible');
        });

        // Scroll to Top Button functionality
        const scrollToTopBtn = document.getElementById('scrollToTop');
        
        // Show/hide scroll to top button
        window.addEventListener('scroll', function() {
            if (window.scrollY > 300) {
                scrollToTopBtn.classList.add('visible');
            } else {
                scrollToTopBtn.classList.remove('visible');
            }
        });
        
        // Scroll to top when button is clicked
        scrollToTopBtn.addEventListener('click', function() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });

        // Smooth scrolling for navigation links with offset
        document.querySelectorAll('.nav-link').forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const targetId = this.getAttribute('href').substring(1);
                const targetSection = document.getElementById(targetId);
                const headerHeight = document.querySelector('.manual-header').offsetHeight;
                
                // Update active nav link immediately
                document.querySelectorAll('.nav-link').forEach(l => l.classList.remove('active'));
                this.classList.add('active');
                
                // Smooth scroll to section with offset
                const targetPosition = targetSection.offsetTop - headerHeight - 20;
                window.scrollTo({
                    top: targetPosition,
                    behavior: 'smooth'
                });
            });
        });

        // Enhanced Intersection Observer for better section tracking
        const observerOptions = {
            threshold: [0.1, 0.3, 0.6],
            rootMargin: '-100px 0px -50% 0px'
        };

        let currentActiveSection = null;
        let isUpdating = false;

        const sectionObserver = new IntersectionObserver(function(entries) {
            if (isUpdating) return;
            
            // Find the section with highest visibility ratio
            let mostVisible = null;
            let highestRatio = 0;

            entries.forEach(entry => {
                // Add visible class for animation
                if (entry.isIntersecting && entry.intersectionRatio > 0.1) {
                    entry.target.classList.add('visible');
                }
                
                // Track most visible section
                if (entry.isIntersecting && entry.intersectionRatio > highestRatio) {
                    mostVisible = entry.target;
                    highestRatio = entry.intersectionRatio;
                }
            });

            // Update navigation only if we have a clear winner and it's different from current
            if (mostVisible && mostVisible.id !== currentActiveSection) {
                isUpdating = true;
                currentActiveSection = mostVisible.id;
                
                // Remove all active states
                document.querySelectorAll('.nav-link').forEach(link => {
                    link.classList.remove('active');
                });
                
                // Add active state to matching link
                const activeLink = document.querySelector(`.nav-link[href="#${currentActiveSection}"]`);
                if (activeLink) {
                    activeLink.classList.add('active');
                }
                
                // Reset update flag after a short delay
                setTimeout(() => {
                    isUpdating = false;
                }, 50);
            }
        }, observerOptions);

        // Progressive section reveal on scroll
        const revealObserver = new IntersectionObserver(function(entries) {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.transitionDelay = '0.1s';
                    entry.target.classList.add('visible');
                }
            });
        }, {
            threshold: 0.15,
            rootMargin: '0px 0px -100px 0px'
        });

        // Observe all sections
        document.querySelectorAll('.manual-section').forEach((section, index) => {
            sectionObserver.observe(section);
            revealObserver.observe(section);
            
            // Add staggered delay for initial load
            section.style.transitionDelay = `${index * 0.1}s`;
        });

        // Sidebar positioning - only prevent footer overlap
        let scrollTimeout = null;
        
        window.addEventListener('scroll', function() {
            const sidebar = document.querySelector('.manual-sidebar');
            const footer = document.querySelector('.manual-footer');
            
            if (sidebar && footer) {
                const sidebarRect = sidebar.getBoundingClientRect();
                const footerRect = footer.getBoundingClientRect();
                const viewportHeight = window.innerHeight;
                
                // Only move sidebar when footer is actually overlapping
                const footerTop = footerRect.top;
                const sidebarBottom = sidebarRect.bottom;
                
                // Calculate if sidebar would overlap footer
                const wouldOverlap = footerTop < sidebarBottom && footerTop > 0;
                
                if (wouldOverlap) {
                    // Calculate minimal movement needed to avoid overlap
                    const overlapAmount = sidebarBottom - footerTop + 20; // 20px buffer
                    sidebar.style.transform = `translateY(-${overlapAmount}px)`;
                } else {
                    // Keep sidebar in normal position
                    sidebar.style.transform = 'translateY(0)';
                }
            }

            // Backup navigation detection for fast scrolling
            if (scrollTimeout) {
                clearTimeout(scrollTimeout);
            }
            
            scrollTimeout = setTimeout(() => {
                if (!isUpdating) {
                    const sections = document.querySelectorAll('.manual-section');
                    const headerHeight = document.querySelector('.manual-header').offsetHeight;
                    const scrollPos = window.scrollY + headerHeight + 150;
                    
                    let activeSection = null;
                    sections.forEach(section => {
                        const sectionTop = section.offsetTop;
                        const sectionBottom = sectionTop + section.offsetHeight;
                        
                        if (scrollPos >= sectionTop && scrollPos < sectionBottom) {
                            activeSection = section.id;
                        }
                    });
                    
                    if (activeSection && activeSection !== currentActiveSection) {
                        currentActiveSection = activeSection;
                        
                        document.querySelectorAll('.nav-link').forEach(link => {
                            link.classList.remove('active');
                        });
                        
                        const activeLink = document.querySelector(`.nav-link[href="#${activeSection}"]`);
                        if (activeLink) {
                            activeLink.classList.add('active');
                        }
                    }
                }
            }, 100);
        });

        // Tab functionality with smooth transitions
        document.querySelectorAll('.tab-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const tabId = this.getAttribute('data-tab');
                
                // Update active button
                document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
                this.classList.add('active');
                
                // Update active content with fade effect
                document.querySelectorAll('.tab-content').forEach(content => {
                    content.style.opacity = '0';
                    setTimeout(() => {
                        content.classList.remove('active');
                    }, 150);
                });
                
                setTimeout(() => {
                    const activeContent = document.getElementById(tabId);
                    activeContent.classList.add('active');
                    activeContent.style.opacity = '1';
                }, 150);
            });
        });

        // Enhanced FAQ toggle functionality
        document.querySelectorAll('.faq-question').forEach(question => {
            question.addEventListener('click', function() {
                const faqItem = this.parentElement;
                const answer = faqItem.querySelector('.faq-answer');
                const isActive = faqItem.classList.contains('active');
                
                // Close all other FAQ items
                document.querySelectorAll('.faq-item').forEach(item => {
                    if (item !== faqItem) {
                        item.classList.remove('active');
                        const otherAnswer = item.querySelector('.faq-answer');
                        otherAnswer.style.maxHeight = '0';
                    }
                });
                
                // Toggle current item
                faqItem.classList.toggle('active');
                
                if (!isActive) {
                    answer.style.maxHeight = answer.scrollHeight + 'px';
                } else {
                    answer.style.maxHeight = '0';
                }
            });
        });

        // Add loading animation
        window.addEventListener('load', function() {
            document.body.classList.add('loaded');
        });
    </script>
</body>

</html>
