<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bantuan IT - Sistem Gudang Yogya Toserba</title>
    <link rel="stylesheet" href="{{ asset('css/gudang/bantuan-it.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="icon" href="{{ asset('image/logo_yogya.png') }}" type="image/png">
</head>

<body>
    <!-- Header -->
    <header class="bantuan-header">
        <div class="header-container">
            <div class="logo-section">
                <div class="support-icon-header">
                    <i class="fas fa-headset"></i>
                </div>
                <div class="header-title">
                    <h1>Bantuan IT Sistem Gudang</h1>
                    <p>Dukungan Teknis & Panduan Troubleshooting v1.0.0</p>
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
    <main class="bantuan-main">
        <div class="container">
            <!-- Sidebar Navigation -->
            <aside class="bantuan-sidebar">
                <div class="sidebar-sticky">
                    <h3><i class="fas fa-list"></i> Menu Bantuan</h3>
                    <nav class="bantuan-nav">
                        <ul>
                            <li><a href="#kontak-it" class="nav-link active"><i class="fas fa-phone"></i> Kontak IT Support</a></li>
                            <li><a href="#troubleshooting" class="nav-link"><i class="fas fa-tools"></i> Troubleshooting</a></li>
                            <li><a href="#faq" class="nav-link"><i class="fas fa-question-circle"></i> FAQ</a></li>
                            <li><a href="#panduan-login" class="nav-link"><i class="fas fa-sign-in-alt"></i> Panduan Login</a></li>
                            <li><a href="#masalah-umum" class="nav-link"><i class="fas fa-exclamation-triangle"></i> Masalah Umum</a></li>
                            <li><a href="#permintaan-akses" class="nav-link"><i class="fas fa-user-plus"></i> Permintaan Akses</a></li>
                            <li><a href="#pelaporan-bug" class="nav-link"><i class="fas fa-bug"></i> Laporkan Bug</a></li>
                        </ul>
                    </nav>
                </div>
            </aside>

            <!-- Content Area -->
            <div class="bantuan-content">
                <!-- Kontak IT Support Section -->
                <section id="kontak-it" class="bantuan-section">
                    <div class="section-header">
                        <i class="fas fa-phone section-icon"></i>
                        <h2>Kontak IT Support</h2>
                    </div>
                    <div class="section-content">
                        <p class="intro-text">
                            Tim IT Support Yogya Toserba siap membantu Anda 24/7. Hubungi kami melalui berbagai channel komunikasi di bawah ini untuk mendapatkan bantuan teknis yang cepat dan tepat.
                        </p>
                        
                        <div class="contact-grid">
                            <div class="contact-item">
                                <i class="fas fa-phone-alt"></i>
                                <h4>Hotline IT Support</h4>
                                <p>Layanan darurat 24/7 untuk masalah kritis sistem gudang</p>
                                <div class="contact-info">
                                    <strong>📞 0800-1234-5678</strong><br>
                                    <small>Ext. 888 (Internal)</small>
                                </div>
                            </div>
                            
                            <div class="contact-item">
                                <i class="fas fa-envelope"></i>
                                <h4>Email Support</h4>
                                <p>Kirim email untuk bantuan non-urgent dan dokumentasi masalah</p>
                                <div class="contact-info">
                                    <strong>📧 it-support@yogyatoserba.com</strong><br>
                                    <small>Response: 2-4 jam kerja</small>
                                </div>
                            </div>
                            
                            <div class="contact-item">
                                <i class="fas fa-comments"></i>
                                <h4>Live Chat</h4>
                                <p>Chat real-time dengan technical specialist kami</p>
                                <div class="contact-info">
                                    <strong>💬 chat.yogyatoserba.com/it</strong><br>
                                    <small>Online: Senin-Sabtu 08:00-22:00</small>
                                </div>
                            </div>
                            
                            <div class="contact-item">
                                <i class="fas fa-ticket-alt"></i>
                                <h4>Ticket System</h4>
                                <p>Buat tiket untuk tracking progress penyelesaian masalah</p>
                                <div class="contact-info">
                                    <strong>🎫 helpdesk.yogyatoserba.com</strong><br>
                                    <small>Login dengan akun gudang Anda</small>
                                </div>
                            </div>
                            
                            <div class="contact-item">
                                <i class="fas fa-map-marker-alt"></i>
                                <h4>On-Site Support</h4>
                                <p>Kunjungan teknisi langsung ke lokasi gudang</p>
                                <div class="contact-info">
                                    <strong>📍 Booking via Hotline</strong><br>
                                    <small>Emergency: < 2 jam | Normal: 1-2 hari</small>
                                </div>
                            </div>
                            
                            <div class="contact-item">
                                <i class="fas fa-desktop"></i>
                                <h4>Remote Support</h4>
                                <p>Akses remote untuk troubleshooting cepat dan tepat</p>
                                <div class="contact-info">
                                    <strong>🖥️ TeamViewer/AnyDesk</strong><br>
                                    <small>Dengan approval supervisor</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Troubleshooting Section -->
                <section id="troubleshooting" class="bantuan-section">
                    <div class="section-header">
                        <i class="fas fa-tools section-icon"></i>
                        <h2>Panduan Troubleshooting</h2>
                    </div>
                    <div class="section-content">
                        <p class="intro-text">
                            Panduan step-by-step untuk mengatasi masalah teknis yang sering terjadi di sistem gudang. Klik pada masalah untuk melihat solusi lengkap.
                        </p>

                        <div class="faq-container">
                            <div class="faq-item">
                                <div class="faq-question">
                                    <strong>Masalah Koneksi Internet</strong>
                                    <i class="fas fa-wifi"></i>
                                </div>
                                <div class="faq-answer">
                                    <ul>
                                        <li>Periksa kabel ethernet atau sinyal WiFi</li>
                                        <li>Restart modem/router (tunggu 30 detik)</li>
                                        <li>Flush DNS: buka Command Prompt, ketik "ipconfig /flushdns"</li>
                                        <li>Coba akses website lain untuk memastikan koneksi</li>
                                        <li>Hubungi IT jika masalah berlanjut</li>
                                    </ul>
                                </div>
                            </div>

                            <div class="faq-item">
                                <div class="faq-question">
                                    <strong>Error Login Sistem</strong>
                                    <i class="fas fa-exclamation-triangle"></i>
                                </div>
                                <div class="faq-answer">
                                    <ul>
                                        <li>Pastikan username dan password benar (case-sensitive)</li>
                                        <li>Clear browser cache dan cookies</li>
                                        <li>Coba browser lain (Chrome, Firefox, Edge)</li>
                                        <li>Periksa Caps Lock dan keyboard layout</li>
                                        <li>Reset password melalui admin atau IT Support</li>
                                    </ul>
                                </div>
                            </div>

                            <div class="faq-item">
                                <div class="faq-question">
                                    <strong>Data Tidak Tersimpan</strong>
                                    <i class="fas fa-database"></i>
                                </div>
                                <div class="faq-answer">
                                    <ul>
                                        <li>Pastikan semua field mandatory sudah diisi</li>
                                        <li>Periksa format data (angka, tanggal, email)</li>
                                        <li>Tunggu hingga proses saving selesai</li>
                                        <li>Refresh halaman dan cek kembali</li>
                                        <li>Screenshot error message untuk dilaporkan</li>
                                    </ul>
                                </div>
                            </div>

                            <div class="faq-item">
                                <div class="faq-question">
                                    <strong>Masalah Printer</strong>
                                    <i class="fas fa-print"></i>
                                </div>
                                <div class="faq-answer">
                                    <ul>
                                        <li>Periksa koneksi USB/Network printer</li>
                                        <li>Pastikan printer dalam status "Online"</li>
                                        <li>Cek level tinta/toner dan kertas</li>
                                        <li>Restart printer dan komputer</li>
                                        <li>Test print dari aplikasi lain</li>
                                    </ul>
                                </div>
                            </div>

                            <div class="faq-item">
                                <div class="faq-question">
                                    <strong>Sistem Lambat/Hang</strong>
                                    <i class="fas fa-clock"></i>
                                </div>
                                <div class="faq-answer">
                                    <ul>
                                        <li>Close aplikasi yang tidak diperlukan</li>
                                        <li>Periksa Task Manager untuk proses yang menggunakan CPU tinggi</li>
                                        <li>Restart browser atau aplikasi</li>
                                        <li>Restart komputer jika diperlukan</li>
                                        <li>Scan virus menggunakan antivirus terbaru</li>
                                    </ul>
                                </div>
                            </div>

                            <div class="faq-item">
                                <div class="faq-question">
                                    <strong>Scanner Barcode Error</strong>
                                    <i class="fas fa-barcode"></i>
                                </div>
                                <div class="faq-answer">
                                    <ul>
                                        <li>Bersihkan lensa scanner dengan kain lembut</li>
                                        <li>Periksa koneksi USB scanner</li>
                                        <li>Test scanner di notepad/text editor</li>
                                        <li>Adjust jarak dan sudut scanning</li>
                                        <li>Coba scan barcode yang sudah diketahui berfungsi</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- FAQ Section -->
                <section id="faq" class="bantuan-section">
                    <div class="section-header">
                        <i class="fas fa-question-circle section-icon"></i>
                        <h2>Frequently Asked Questions (FAQ)</h2>
                    </div>
                    <div class="section-content">
                        <p class="intro-text">
                            Pertanyaan yang sering diajukan beserta jawabannya. Klik pada pertanyaan untuk melihat jawaban lengkap.
                        </p>

                        <div class="faq-container">
                            <div class="faq-item">
                                <div class="faq-question">
                                    <strong>Bagaimana cara reset password akun gudang?</strong>
                                    <i class="fas fa-question-circle"></i>
                                </div>
                                <div class="faq-answer">
                                    <p>Untuk reset password akun gudang, Anda bisa:</p>
                                    <ol>
                                        <li>Hubungi administrator gudang atau IT Support</li>
                                        <li>Berikan ID karyawan dan informasi verifikasi identitas</li>
                                        <li>Admin akan mereset password ke default sementara</li>
                                        <li>Login dengan password sementara dan ubah password baru</li>
                                        <li>Password baru harus minimal 8 karakter dengan kombinasi huruf dan angka</li>
                                    </ol>
                                </div>
                            </div>

                            <div class="faq-item">
                                <div class="faq-question">
                                    <strong>Mengapa sistem kadang logout otomatis?</strong>
                                    <i class="fas fa-question-circle"></i>
                                </div>
                                <div class="faq-answer">
                                    <p>Sistem logout otomatis terjadi karena:</p>
                                    <ul>
                                        <li><strong>Session timeout:</strong> Tidak ada aktivitas selama 30 menit</li>
                                        <li><strong>Keamanan:</strong> Login dari device lain dengan akun yang sama</li>
                                        <li><strong>Maintenance:</strong> Server restart untuk update sistem</li>
                                        <li><strong>Koneksi:</strong> Gangguan jaringan yang terputus</li>
                                    </ul>
                                    <p>Untuk mencegah logout, pastikan ada aktivitas setiap 20-25 menit.</p>
                                </div>
                            </div>

                            <div class="faq-item">
                                <div class="faq-question">
                                    <strong>Bagaimana cara mengakses sistem dari luar kantor?</strong>
                                    <i class="fas fa-question-circle"></i>
                                </div>
                                <div class="faq-answer">
                                    <p>Akses sistem dari luar kantor memerlukan:</p>
                                    <ol>
                                        <li>VPN connection yang sudah dikonfigurasi IT</li>
                                        <li>Approval dari supervisor untuk remote access</li>
                                        <li>Gunakan browser yang sudah teregistrasi</li>
                                        <li>Pastikan koneksi internet stabil</li>
                                        <li>Logout setelah selesai untuk keamanan</li>
                                    </ol>
                                    <p><strong>Catatan:</strong> Remote access hanya untuk emergency dan dengan izin khusus.</p>
                                </div>
                            </div>

                            <div class="faq-item">
                                <div class="faq-question">
                                    <strong>Apa yang harus dilakukan jika data hilang?</strong>
                                    <i class="fas fa-question-circle"></i>
                                </div>
                                <div class="faq-answer">
                                    <p>Jika data hilang atau terhapus:</p>
                                    <ol>
                                        <li><strong>JANGAN PANIC!</strong> Stop aktivitas input immediately</li>
                                        <li>Catat waktu dan jenis data yang hilang</li>
                                        <li>Screenshot kondisi sistem saat ini</li>
                                        <li>Hubungi IT Support SEGERA (hotline darurat)</li>
                                        <li>Jangan coba recovery sendiri untuk menghindari kerusakan lebih lanjut</li>
                                    </ol>
                                    <p><strong>Backup otomatis:</strong> Sistem backup setiap 6 jam, data bisa direstore maksimal 24 jam terakhir.</p>
                                </div>
                            </div>

                            <div class="faq-item">
                                <div class="faq-question">
                                    <strong>Bagaimana cara mengatasi error "Access Denied"?</strong>
                                    <i class="fas fa-question-circle"></i>
                                </div>
                                <div class="faq-answer">
                                    <p>Error "Access Denied" biasanya karena:</p>
                                    <ul>
                                        <li><strong>Permission level:</strong> Akun tidak memiliki akses ke fitur tersebut</li>
                                        <li><strong>Role restriction:</strong> Fitur khusus untuk supervisor/admin</li>
                                        <li><strong>Time restriction:</strong> Akses dibatasi jam kerja tertentu</li>
                                        <li><strong>Module lock:</strong> Fitur sedang maintenance</li>
                                    </ul>
                                    <p>Solusi: Hubungi supervisor untuk upgrade permission atau gunakan akun dengan role yang sesuai.</p>
                                </div>
                            </div>

                            <div class="faq-item">
                                <div class="faq-question">
                                    <strong>Kapan jadwal maintenance sistem?</strong>
                                    <i class="fas fa-question-circle"></i>
                                </div>
                                <div class="faq-answer">
                                    <p>Jadwal maintenance rutin sistem:</p>
                                    <ul>
                                        <li><strong>Weekly Maintenance:</strong> Minggu 02:00-04:00 WIB</li>
                                        <li><strong>Monthly Update:</strong> Minggu pertama setiap bulan 01:00-05:00 WIB</li>
                                        <li><strong>Emergency Maintenance:</strong> Akan diinformasikan via email H-1</li>
                                        <li><strong>Daily Backup:</strong> Setiap hari 23:00-23:30 WIB (sistem tetap online)</li>
                                    </ul>
                                    <p>Selama maintenance, sistem tidak dapat diakses. Pastikan save semua data sebelum waktu maintenance.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Panduan Login Section -->
                <section id="panduan-login" class="bantuan-section">
                    <div class="section-header">
                        <i class="fas fa-sign-in-alt section-icon"></i>
                        <h2>Panduan Login Sistem</h2>
                    </div>
                    <div class="section-content">
                        <p class="intro-text">
                            Panduan lengkap untuk login ke sistem gudang, termasuk persyaratan akun dan troubleshooting login.
                        </p>

                        <div class="steps-container">
                            <div class="step-item">
                                <div class="step-number">1</div>
                                <div class="step-content">
                                    <h4>Akses Halaman Login</h4>
                                    <p>Buka browser (Chrome/Firefox/Edge) dan akses URL: <strong>http://gudang.yogyatoserba.com</strong> atau gunakan IP lokal yang telah diberikan IT.</p>
                                </div>
                            </div>

                            <div class="step-item">
                                <div class="step-number">2</div>
                                <div class="step-content">
                                    <h4>Input Kredensial</h4>
                                    <p>Masukkan Username (ID Karyawan) dan Password. Username format: <strong>GDG001</strong> untuk gudang, <strong>ADM001</strong> untuk admin. Password case-sensitive.</p>
                                </div>
                            </div>

                            <div class="step-item">
                                <div class="step-number">3</div>
                                <div class="step-content">
                                    <h4>Verifikasi Captcha</h4>
                                    <p>Jika muncul captcha, masukkan kode yang terlihat. Klik refresh jika sulit dibaca. Captcha berfungsi untuk keamanan sistem.</p>
                                </div>
                            </div>

                            <div class="step-item">
                                <div class="step-number">4</div>
                                <div class="step-content">
                                    <h4>Login dan Dashboard</h4>
                                    <p>Klik tombol "Login" dan tunggu proses autentikasi. Setelah berhasil, Anda akan diarahkan ke dashboard sesuai role akun Anda.</p>
                                </div>
                            </div>
                        </div>

                        <div class="alert alert-info">
                            <strong>Tips Keamanan:</strong> Selalu logout setelah selesai menggunakan sistem. Jangan share username/password dengan orang lain. Ganti password secara berkala setiap 3 bulan.
                        </div>

                        <div class="alert alert-warning">
                            <strong>Perhatian:</strong> Setelah 5 kali gagal login, akun akan terkunci selama 15 menit. Hubungi IT jika lupa password atau akun terkunci.
                        </div>
                    </div>
                </section>

                <!-- Masalah Umum Section -->
                <section id="masalah-umum" class="bantuan-section">
                    <div class="section-header">
                        <i class="fas fa-exclamation-triangle section-icon"></i>
                        <h2>Masalah Umum & Solusi</h2>
                    </div>
                    <div class="section-content">
                        <p class="intro-text">
                            Kumpulan masalah yang sering terjadi di sistem gudang beserta solusi cepat yang bisa Anda lakukan sendiri.
                        </p>

                        <div class="troubleshoot-grid">
                            <div class="troubleshoot-item">
                                <div class="troubleshoot-header">
                                    <i class="fas fa-eye-slash"></i>
                                    <h4>Halaman Blank/Putih</h4>
                                </div>
                                <div class="troubleshoot-content">
                                    <p><strong>Gejala:</strong> Halaman kosong atau putih setelah login</p>
                                    <p><strong>Penyebab:</strong> JavaScript error, cache corrupt, atau koneksi terputus</p>
                                    <p><strong>Solusi:</strong></p>
                                    <ol class="troubleshoot-steps">
                                        <li>Hard refresh: Ctrl + F5 (Windows) atau Cmd + Shift + R (Mac)</li>
                                        <li>Clear browser cache dan cookies</li>
                                        <li>Disable browser extensions sementara</li>
                                        <li>Coba mode incognito/private browsing</li>
                                    </ol>
                                </div>
                            </div>

                            <div class="troubleshoot-item">
                                <div class="troubleshoot-header">
                                    <i class="fas fa-spinner"></i>
                                    <h4>Loading Terus Menerus</h4>
                                </div>
                                <div class="troubleshoot-content">
                                    <p><strong>Gejala:</strong> Halaman loading tidak selesai atau loading icon berputar terus</p>
                                    <p><strong>Penyebab:</strong> Koneksi lambat, server overload, atau proses stuck</p>
                                    <p><strong>Solusi:</strong></p>
                                    <ol class="troubleshoot-steps">
                                        <li>Wait 30-60 detik untuk timeout natural</li>
                                        <li>Refresh halaman (F5)</li>
                                        <li>Check koneksi internet</li>
                                        <li>Logout dan login kembali</li>
                                    </ol>
                                </div>
                            </div>

                            <div class="troubleshoot-item">
                                <div class="troubleshoot-header">
                                    <i class="fas fa-ban"></i>
                                    <h4>Tombol Tidak Berfungsi</h4>
                                </div>
                                <div class="troubleshoot-content">
                                    <p><strong>Gejala:</strong> Button/tombol diklik tapi tidak ada respon</p>
                                    <p><strong>Penyebab:</strong> JavaScript disabled, browser compatibility, atau form validation error</p>
                                    <p><strong>Solusi:</strong></p>
                                    <ol class="troubleshoot-steps">
                                        <li>Check apakah semua field mandatory sudah diisi</li>
                                        <li>Enable JavaScript di browser</li>
                                        <li>Update browser ke versi terbaru</li>
                                        <li>Coba browser alternatif</li>
                                    </ol>
                                </div>
                            </div>

                            <div class="troubleshoot-item">
                                <div class="troubleshoot-header">
                                    <i class="fas fa-file-excel"></i>
                                    <h4>Export/Download Gagal</h4>
                                </div>
                                <div class="troubleshoot-content">
                                    <p><strong>Gejala:</strong> File Excel/PDF tidak bisa didownload atau corrupt</p>
                                    <p><strong>Penyebab:</strong> Pop-up blocker, download folder full, atau file size terlalu besar</p>
                                    <p><strong>Solusi:</strong></p>
                                    <ol class="troubleshoot-steps">
                                        <li>Allow pop-up untuk domain sistem</li>
                                        <li>Check space disk di download folder</li>
                                        <li>Kurangi range data yang di-export</li>
                                        <li>Try download dengan browser lain</li>
                                    </ol>
                                </div>
                            </div>
                        </div>

                        <div class="alert alert-danger">
                            <strong>Error Kritis:</strong> Jika muncul error "Database Connection Lost", "Server Error 500", atau "System Down", segera hubungi IT Support via hotline darurat!
                        </div>
                    </div>
                </section>

                <!-- Permintaan Akses Section -->
                <section id="permintaan-akses" class="bantuan-section">
                    <div class="section-header">
                        <i class="fas fa-user-plus section-icon"></i>
                        <h2>Permintaan Akses & Role</h2>
                    </div>
                    <div class="section-content">
                        <p class="intro-text">
                            Panduan untuk mengajukan permintaan akses baru, upgrade role, atau perubahan permission sistem gudang.
                        </p>

                        <div class="steps-container">
                            <div class="step-item">
                                <div class="step-number">1</div>
                                <div class="step-content">
                                    <h4>Identifikasi Kebutuhan Akses</h4>
                                    <p>Tentukan jenis akses yang dibutuhkan: akun baru, upgrade role (staff → supervisor → admin), atau akses fitur khusus (laporan, export, delete).</p>
                                </div>
                            </div>

                            <div class="step-item">
                                <div class="step-number">2</div>
                                <div class="step-content">
                                    <h4>Approval Supervisor</h4>
                                    <p>Dapatkan approval tertulis dari supervisor langsung. Sertakan justifikasi bisnis dan urgensi permintaan akses tersebut.</p>
                                </div>
                            </div>

                            <div class="step-item">
                                <div class="step-number">3</div>
                                <div class="step-content">
                                    <h4>Submit Request Form</h4>
                                    <p>Isi form permintaan akses (tersedia di IT atau download dari portal). Lengkapi dengan data karyawan, role yang diminta, dan approval supervisor.</p>
                                </div>
                            </div>

                            <div class="step-item">
                                <div class="step-number">4</div>
                                <div class="step-content">
                                    <h4>Proses Verifikasi</h4>
                                    <p>IT akan verifikasi dokumen dan koordinasi dengan HR. Proses normal memakan waktu 1-3 hari kerja, urgent bisa same-day dengan approval khusus.</p>
                                </div>
                            </div>

                            <div class="step-item">
                                <div class="step-number">5</div>
                                <div class="step-content">
                                    <h4>Account Setup & Training</h4>
                                    <p>Setelah approved, IT akan setup akun dan memberikan kredensial. Training penggunaan sistem akan dijadwalkan jika diperlukan.</p>
                                </div>
                            </div>
                        </div>

                        <h3 style="color: var(--primary-color); margin: 2rem 0 1rem;">Jenis Role & Permission</h3>
                        
                        <div class="troubleshoot-grid">
                            <div class="troubleshoot-item">
                                <div class="troubleshoot-header">
                                    <i class="fas fa-user"></i>
                                    <h4>Staff Gudang</h4>
                                </div>
                                <div class="troubleshoot-content">
                                    <ul style="list-style-type: disc; margin-left: 1rem;">
                                        <li>Input dan edit data barang</li>
                                        <li>View stok dan inventory</li>
                                        <li>Proses transaksi harian</li>
                                        <li>Print label dan barcode</li>
                                        <li>Basic reporting (read-only)</li>
                                    </ul>
                                </div>
                            </div>

                            <div class="troubleshoot-item">
                                <div class="troubleshoot-header">
                                    <i class="fas fa-user-tie"></i>
                                    <h4>Supervisor Gudang</h4>
                                </div>
                                <div class="troubleshoot-content">
                                    <ul style="list-style-type: disc; margin-left: 1rem;">
                                        <li>Semua akses Staff +</li>
                                        <li>Approve/reject transaksi</li>
                                        <li>Access advanced reports</li>
                                        <li>Export data ke Excel/PDF</li>
                                        <li>Manage staff assignments</li>
                                        <li>View audit logs</li>
                                    </ul>
                                </div>
                            </div>

                            <div class="troubleshoot-item">
                                <div class="troubleshoot-header">
                                    <i class="fas fa-user-shield"></i>
                                    <h4>Admin Gudang</h4>
                                </div>
                                <div class="troubleshoot-content">
                                    <ul style="list-style-type: disc; margin-left: 1rem;">
                                        <li>Full system access</li>
                                        <li>User management</li>
                                        <li>System configuration</li>
                                        <li>Database maintenance</li>
                                        <li>Backup & restore data</li>
                                        <li>Security settings</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="alert alert-warning">
                            <strong>Catatan Penting:</strong> Setiap akses akan di-review setiap 6 bulan. Akses yang tidak digunakan akan dicabut untuk menjaga keamanan sistem.
                        </div>
                    </div>
                </section>

                <!-- Pelaporan Bug Section -->
                <section id="pelaporan-bug" class="bantuan-section">
                    <div class="section-header">
                        <i class="fas fa-bug section-icon"></i>
                        <h2>Pelaporan Bug & Feedback</h2>
                    </div>
                    <div class="section-content">
                        <p class="intro-text">
                            Bantu kami meningkatkan sistem dengan melaporkan bug, error, atau memberikan feedback untuk pengembangan fitur baru.
                        </p>

                        <h3 style="color: var(--primary-color); margin: 2rem 0 1rem;">Cara Melaporkan Bug</h3>
                        
                        <div class="steps-container">
                            <div class="step-item">
                                <div class="step-number">1</div>
                                <div class="step-content">
                                    <h4>Screenshot & Dokumentasi</h4>
                                    <p>Ambil screenshot error message atau kondisi bug. Catat waktu kejadian, browser yang digunakan, dan langkah yang menyebabkan bug.</p>
                                </div>
                            </div>

                            <div class="step-item">
                                <div class="step-number">2</div>
                                <div class="step-content">
                                    <h4>Buat Ticket Report</h4>
                                    <p>Akses <strong>helpdesk.yogyatoserba.com</strong> atau kirim email ke <strong>bug-report@yogyatoserba.com</strong> dengan detail lengkap bug yang ditemukan.</p>
                                </div>
                            </div>

                            <div class="step-item">
                                <div class="step-number">3</div>
                                <div class="step-content">
                                    <h4>Prioritas & Follow-up</h4>
                                    <p>Tim akan mengkategorikan bug (Critical/High/Medium/Low) dan memberikan estimasi waktu fix. Anda akan mendapat update via email.</p>
                                </div>
                            </div>
                        </div>

                        <h3 style="color: var(--primary-color); margin: 2rem 0 1rem;">Template Laporan Bug</h3>
                        
                        <div style="background: var(--light-color); padding: 1.5rem; border-radius: 8px; border-left: 4px solid var(--primary-color); margin: 1rem 0;">
                            <h4>Subject: [BUG] - [Deskripsi singkat masalah]</h4>
                            <br>
                            <p><strong>Informasi Sistem:</strong></p>
                            <ul>
                                <li>Browser: Chrome/Firefox/Edge + versi</li>
                                <li>OS: Windows/Mac + versi</li>
                                <li>URL halaman: [link halaman yang bermasalah]</li>
                                <li>User Role: Staff/Supervisor/Admin</li>
                            </ul>
                            <br>
                            <p><strong>Deskripsi Bug:</strong></p>
                            <p>[Jelaskan detail masalah yang terjadi]</p>
                            <br>
                            <p><strong>Langkah Reproduksi:</strong></p>
                            <ol>
                                <li>Buka halaman...</li>
                                <li>Klik button...</li>
                                <li>Isi form dengan...</li>
                                <li>Error muncul di...</li>
                            </ol>
                            <br>
                            <p><strong>Expected Result:</strong> [Apa yang seharusnya terjadi]</p>
                            <p><strong>Actual Result:</strong> [Apa yang benar-benar terjadi]</p>
                            <br>
                            <p><strong>Screenshot:</strong> [Attach screenshot jika ada]</p>
                            <p><strong>Urgency:</strong> Critical/High/Medium/Low</p>
                        </div>

                        <div class="alert alert-success">
                            <strong>Reward Program:</strong> Bug report terbaik setiap bulan akan mendapat hadiah dari IT Team! 🎁
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
        // Navigation active state
        document.addEventListener('DOMContentLoaded', function() {
            const navLinks = document.querySelectorAll('.nav-link');
            
            // Smooth scroll for navigation links
            navLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    
                    // Remove active class from all links
                    navLinks.forEach(nav => nav.classList.remove('active'));
                    
                    // Add active class to clicked link
                    this.classList.add('active');
                    
                    // Smooth scroll to target
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            });
        });

        // Update active navigation on scroll
        window.addEventListener('scroll', function() {
            const sections = document.querySelectorAll('.bantuan-section');
            const navLinks = document.querySelectorAll('.bantuan-nav .nav-link');
            
            let current = '';
            sections.forEach(section => {
                const sectionTop = section.offsetTop;
                const sectionHeight = section.clientHeight;
                if (scrollY >= (sectionTop - 200)) {
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

        // FAQ Toggle Function - Same as Manual
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

        // Animation on load
        document.addEventListener('DOMContentLoaded', function() {
            document.body.classList.add('loaded');
        });
    </script>
</body>
</html>
