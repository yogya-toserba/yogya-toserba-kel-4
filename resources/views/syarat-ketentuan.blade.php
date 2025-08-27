<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Syarat dan Ketentuan - MyYOGYA</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Custom CSS -->
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
    
    <style>
        /* Terms Page Styles */
        .terms-hero {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            padding: 100px 0;
            position: relative;
            overflow: hidden;
        }

        .terms-hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Ccircle cx='30' cy='30' r='2'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E") repeat;
        }

        .terms-hero .container {
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

        .terms-navigation {
            background: white;
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 10px 40px rgba(0,0,0,0.1);
            position: sticky;
            top: 2rem;
            max-height: 80vh;
            overflow-y: auto;
        }

        .terms-nav-title {
            font-weight: 700;
            margin-bottom: 1.5rem;
            color: var(--dark-color);
            font-size: 1.2rem;
        }

        .terms-nav-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .terms-nav-list li {
            margin-bottom: 0.75rem;
        }

        .terms-nav-list a {
            color: var(--gray-600);
            text-decoration: none;
            padding: 0.75rem 1rem;
            border-radius: 12px;
            display: block;
            transition: all 0.3s ease;
            font-size: 0.95rem;
            border-left: 3px solid transparent;
        }

        .terms-nav-list a:hover,
        .terms-nav-list a.active {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            transform: translateX(5px);
            border-left-color: white;
        }

        .terms-content {
            background: white;
            border-radius: 20px;
            padding: 3rem;
            box-shadow: 0 10px 40px rgba(0,0,0,0.1);
        }

        .terms-section {
            margin-bottom: 3rem;
            scroll-margin-top: 2rem;
        }

        .terms-section:last-child {
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

        .terms-text {
            color: var(--gray-700);
            line-height: 1.8;
            margin-bottom: 1.5rem;
            text-align: justify;
        }

        .terms-list {
            padding-left: 0;
            list-style: none;
            margin-bottom: 1.5rem;
        }

        .terms-list li {
            position: relative;
            padding: 0.5rem 0 0.5rem 2rem;
            color: var(--gray-700);
            line-height: 1.6;
            margin-bottom: 0.75rem;
        }

        .terms-list li::before {
            content: '';
            position: absolute;
            left: 0;
            top: 1rem;
            width: 8px;
            height: 8px;
            background: var(--primary-color);
            border-radius: 50%;
        }

        .numbered-list {
            counter-reset: item;
            padding-left: 0;
            list-style: none;
        }

        .numbered-list li {
            position: relative;
            padding: 0.75rem 0 0.75rem 3rem;
            color: var(--gray-700);
            line-height: 1.6;
            margin-bottom: 1rem;
            counter-increment: item;
        }

        .numbered-list li::before {
            content: counter(item);
            position: absolute;
            left: 0;
            top: 0.75rem;
            width: 2rem;
            height: 2rem;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 0.9rem;
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

        /* Responsive */
        @media (max-width: 768px) {
            .terms-hero {
                padding: 60px 0;
            }
            
            .terms-navigation {
                position: static;
                margin-bottom: 2rem;
            }
            
            .terms-content {
                padding: 2rem;
            }
            
            .section-title {
                font-size: 1.5rem;
            }
            
            .contact-methods {
                flex-direction: column;
                align-items: center;
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
<div class="terms-hero">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8 mx-auto text-center">
                <nav class="breadcrumb-custom">
                    <a href="{{ route('dashboard') }}">
                        <i class="fas fa-home me-1"></i>Beranda
                    </a>
                    <span class="mx-2">/</span>
                    <span class="current">Syarat dan Ketentuan</span>
                </nav>
                
                <h1 class="display-4 fw-bold mb-4">Syarat dan <span class="text-warning">Ketentuan</span></h1>
                <p class="lead mb-4">Ketentuan penggunaan platform MyYOGYA yang mengatur hak dan kewajiban pengguna dalam berbelanja online dengan aman dan nyaman.</p>
                <div class="d-flex justify-content-center gap-3 flex-wrap">
                    <div class="text-center">
                        <h5 class="mb-1 fw-bold">Berlaku Sejak</h5>
                        <p class="mb-0 opacity-75">1 Januari 2025</p>
                    </div>
                    <div class="text-center">
                        <h5 class="mb-1 fw-bold">Terakhir Diperbarui</h5>
                        <p class="mb-0 opacity-75">25 Agustus 2025</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Terms Content -->
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="terms-navigation">
                    <h6 class="terms-nav-title">Daftar Isi</h6>
                    <ul class="terms-nav-list">
                        <li><a href="#definisi" class="nav-link">Definisi</a></li>
                        <li><a href="#penerimaan" class="nav-link">Penerimaan Syarat</a></li>
                        <li><a href="#registrasi" class="nav-link">Registrasi Akun</a></li>
                        <li><a href="#penggunaan" class="nav-link">Penggunaan Platform</a></li>
                        <li><a href="#pembelian" class="nav-link">Pembelian & Pembayaran</a></li>
                        <li><a href="#pengiriman" class="nav-link">Pengiriman</a></li>
                        <li><a href="#pengembalian" class="nav-link">Pengembalian & Penukaran</a></li>
                        <li><a href="#privasi" class="nav-link">Kebijakan Privasi</a></li>
                        <li><a href="#larangan" class="nav-link">Larangan Penggunaan</a></li>
                        <li><a href="#tanggung-jawab" class="nav-link">Tanggung Jawab</a></li>
                        <li><a href="#perubahan" class="nav-link">Perubahan Ketentuan</a></li>
                        <li><a href="#kontak" class="nav-link">Informasi Kontak</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="col-lg-9">
                <div class="terms-content">
                    <!-- Section 1: Definisi -->
                    <div id="definisi" class="terms-section">
                        <h2 class="section-title">1. Definisi</h2>
                        <p class="terms-text">Dalam Syarat dan Ketentuan ini, kecuali konteks menghendaki lain, istilah-istilah berikut memiliki arti sebagai berikut:</p>
                        <ul class="terms-list">
                            <li><strong>"MyYOGYA"</strong> adalah platform e-commerce yang dioperasikan oleh PT. YOGYA Indonesia, menyediakan layanan jual beli online.</li>
                            <li><strong>"Pengguna"</strong> adalah setiap orang atau badan hukum yang mengakses dan menggunakan platform MyYOGYA.</li>
                            <li><strong>"Produk"</strong> adalah barang atau jasa yang dijual melalui platform MyYOGYA.</li>
                            <li><strong>"Transaksi"</strong> adalah kegiatan jual beli yang dilakukan melalui platform MyYOGYA.</li>
                            <li><strong>"Akun"</strong> adalah akun pengguna yang terdaftar di platform MyYOGYA.</li>
                        </ul>
                    </div>

                    <!-- Section 2: Penerimaan Syarat -->
                    <div id="penerimaan" class="terms-section">
                        <h2 class="section-title">2. Penerimaan Syarat dan Ketentuan</h2>
                        <p class="terms-text">Dengan mengakses dan menggunakan platform MyYOGYA, Anda dianggap telah membaca, memahami, dan menyetujui untuk terikat oleh seluruh syarat dan ketentuan yang berlaku.</p>
                        
                        <div class="highlight-box">
                            <h6><i class="fas fa-info-circle me-2"></i>Penting untuk Diketahui</h6>
                            <p>Jika Anda tidak menyetujui sebagian atau seluruh syarat dan ketentuan ini, mohon untuk tidak menggunakan platform MyYOGYA.</p>
                        </div>

                        <p class="terms-text">Syarat dan ketentuan ini berlaku untuk semua pengguna, termasuk namun tidak terbatas pada pengunjung, pembeli, dan pihak lain yang mengakses platform MyYOGYA.</p>
                    </div>

                    <!-- Section 3: Registrasi -->
                    <div id="registrasi" class="terms-section">
                        <h2 class="section-title">3. Registrasi dan Keamanan Akun</h2>
                        <h4 class="subsection-title">3.1 Persyaratan Registrasi</h4>
                        <p class="terms-text">Untuk dapat melakukan transaksi di MyYOGYA, Anda wajib melakukan registrasi akun dengan ketentuan sebagai berikut:</p>
                        <ol class="numbered-list">
                            <li>Berusia minimal 17 tahun atau sudah menikah secara sah menurut hukum Indonesia</li>
                            <li>Memberikan informasi yang akurat, lengkap, dan terkini</li>
                            <li>Memiliki alamat email yang valid dan aktif</li>
                            <li>Memiliki nomor telepon yang dapat dihubungi</li>
                        </ol>

                        <h4 class="subsection-title">3.2 Keamanan Akun</h4>
                        <p class="terms-text">Pengguna bertanggung jawab penuh atas keamanan akun, termasuk:</p>
                        <ul class="terms-list">
                            <li>Menjaga kerahasiaan password dan informasi login</li>
                            <li>Tidak memberikan akses akun kepada pihak lain</li>
                            <li>Segera mengganti password jika dicurigai telah diketahui pihak lain</li>
                            <li>Melaporkan kepada MyYOGYA jika terjadi penyalahgunaan akun</li>
                        </ul>
                    </div>

                    <!-- Section 4: Penggunaan Platform -->
                    <div id="penggunaan" class="terms-section">
                        <h2 class="section-title">4. Penggunaan Platform</h2>
                        <p class="terms-text">Platform MyYOGYA disediakan untuk memfasilitasi transaksi jual beli online. Dalam menggunakan platform ini, pengguna wajib:</p>
                        <ul class="terms-list">
                            <li>Menggunakan platform sesuai dengan tujuan yang dimaksudkan</li>
                            <li>Tidak melakukan tindakan yang dapat merusak atau mengganggu sistem</li>
                            <li>Tidak menggunakan robot, spider, atau automated tools lainnya</li>
                            <li>Menghormati hak kekayaan intelektual MyYOGYA dan pihak ketiga</li>
                            <li>Mematuhi semua hukum dan peraturan yang berlaku</li>
                        </ul>
                    </div>

                    <!-- Section 5: Pembelian -->
                    <div id="pembelian" class="terms-section">
                        <h2 class="section-title">5. Pembelian dan Pembayaran</h2>
                        <h4 class="subsection-title">5.1 Proses Pembelian</h4>
                        <p class="terms-text">Setiap pembelian melalui platform MyYOGYA mengikuti alur sebagai berikut:</p>
                        <ol class="numbered-list">
                            <li>Pengguna memilih produk dan menambahkan ke keranjang belanja</li>
                            <li>Pengguna melakukan checkout dan mengisi informasi pengiriman</li>
                            <li>Pengguna memilih metode pembayaran dan menyelesaikan pembayaran</li>
                            <li>MyYOGYA memproses pesanan setelah pembayaran terkonfirmasi</li>
                            <li>Produk dikirim ke alamat yang telah ditentukan</li>
                        </ol>

                        <h4 class="subsection-title">5.2 Harga dan Pembayaran</h4>
                        <ul class="terms-list">
                            <li>Harga yang tertera sudah termasuk PPN sesuai ketentuan</li>
                            <li>Harga dapat berubah sewaktu-waktu tanpa pemberitahuan</li>
                            <li>Pembayaran harus dilakukan sesuai metode yang tersedia</li>
                            <li>Pesanan akan dibatalkan jika pembayaran tidak diselesaikan dalam 24 jam</li>
                        </ul>

                        <div class="warning-box">
                            <h6><i class="fas fa-exclamation-triangle me-2"></i>Perhatian</h6>
                            <p>MyYOGYA berhak membatalkan pesanan jika terdapat kesalahan harga yang signifikan atau kehabisan stok.</p>
                        </div>
                    </div>

                    <!-- Section 6: Pengiriman -->
                    <div id="pengiriman" class="terms-section">
                        <h2 class="section-title">6. Pengiriman</h2>
                        <h4 class="subsection-title">6.1 Waktu Pengiriman</h4>
                        <p class="terms-text">Estimasi waktu pengiriman bervariasi berdasarkan lokasi dan jenis layanan pengiriman yang dipilih. MyYOGYA akan berusaha mengirim produk sesuai estimasi, namun tidak bertanggung jawab atas keterlambatan yang disebabkan oleh:</p>
                        <ul class="terms-list">
                            <li>Force majeure (bencana alam, wabah, kerusuhan)</li>
                            <li>Keterlambatan dari pihak ekspedisi</li>
                            <li>Kesalahan alamat pengiriman dari pembeli</li>
                            <li>Kondisi cuaca atau lalu lintas</li>
                        </ul>

                        <h4 class="subsection-title">6.2 Risiko Pengiriman</h4>
                        <p class="terms-text">Risiko kehilangan atau kerusakan produk selama pengiriman ditanggung oleh pihak ekspedisi. Pembeli dapat mengajukan klaim asuransi sesuai ketentuan ekspedisi yang bersangkutan.</p>
                    </div>

                    <!-- Section 7: Pengembalian -->
                    <div id="pengembalian" class="terms-section">
                        <h2 class="section-title">7. Pengembalian dan Penukaran</h2>
                        <h4 class="subsection-title">7.1 Kebijakan Return</h4>
                        <p class="terms-text">MyYOGYA menerima pengembalian produk dengan syarat:</p>
                        <ol class="numbered-list">
                            <li>Produk masih dalam kondisi asli dan belum digunakan</li>
                            <li>Kemasan produk masih lengkap dan tidak rusak</li>
                            <li>Permintaan return diajukan maksimal 7 hari setelah produk diterima</li>
                            <li>Produk bukan kategori yang tidak dapat dikembalikan (makanan, obat-obatan, produk personal)</li>
                        </ol>

                        <h4 class="subsection-title">7.2 Proses Refund</h4>
                        <p class="terms-text">Setelah produk return diterima dan diverifikasi, refund akan diproses dalam waktu 7-14 hari kerja melalui metode pembayaran yang sama.</p>
                    </div>

                    <!-- Section 8: Privasi -->
                    <div id="privasi" class="terms-section">
                        <h2 class="section-title">8. Kebijakan Privasi</h2>
                        <p class="terms-text">MyYOGYA berkomitmen untuk melindungi privasi pengguna. Informasi pribadi yang dikumpulkan akan digunakan untuk:</p>
                        <ul class="terms-list">
                            <li>Memproses transaksi dan pengiriman</li>
                            <li>Memberikan layanan customer service</li>
                            <li>Mengirim informasi promosi (dengan persetujuan)</li>
                            <li>Meningkatkan kualitas layanan</li>
                            <li>Mematuhi kewajiban hukum</li>
                        </ul>

                        <div class="highlight-box">
                            <h6><i class="fas fa-shield-alt me-2"></i>Perlindungan Data</h6>
                            <p>MyYOGYA tidak akan menjual, menyewakan, atau membagikan informasi pribadi pengguna kepada pihak ketiga tanpa persetujuan, kecuali diwajibkan oleh hukum.</p>
                        </div>
                    </div>

                    <!-- Section 9: Larangan -->
                    <div id="larangan" class="terms-section">
                        <h2 class="section-title">9. Larangan Penggunaan</h2>
                        <p class="terms-text">Pengguna dilarang melakukan hal-hal berikut:</p>
                        <ul class="terms-list">
                            <li>Menggunakan platform untuk tujuan ilegal atau tidak sah</li>
                            <li>Melakukan penipuan atau memberikan informasi palsu</li>
                            <li>Mengganggu atau merusak sistem keamanan platform</li>
                            <li>Melakukan spamming atau distribusi malware</li>
                            <li>Melanggar hak kekayaan intelektual pihak lain</li>
                            <li>Menggunakan platform untuk bersaing langsung dengan MyYOGYA</li>
                        </ul>

                        <div class="warning-box">
                            <h6><i class="fas fa-ban me-2"></i>Sanksi Pelanggaran</h6>
                            <p>Pelanggaran terhadap ketentuan ini dapat mengakibatkan pemblokiran akun permanen dan tindakan hukum sesuai peraturan yang berlaku.</p>
                        </div>
                    </div>

                    <!-- Section 10: Tanggung Jawab -->
                    <div id="tanggung-jawab" class="terms-section">
                        <h2 class="section-title">10. Batasan Tanggung Jawab</h2>
                        <p class="terms-text">MyYOGYA tidak bertanggung jawab atas:</p>
                        <ul class="terms-list">
                            <li>Kerugian yang timbul akibat kesalahan pengguna</li>
                            <li>Gangguan layanan karena force majeure</li>
                            <li>Kerugian tidak langsung atau konsekuensial</li>
                            <li>Tindakan pihak ketiga yang tidak dapat dikendalikan</li>
                            <li>Kehilangan data akibat masalah teknis</li>
                        </ul>

                        <p class="terms-text">Tanggung jawab MyYOGYA terbatas pada nilai transaksi yang bermasalah dan tidak melebihi jumlah yang telah dibayarkan oleh pengguna.</p>
                    </div>

                    <!-- Section 11: Perubahan -->
                    <div id="perubahan" class="terms-section">
                        <h2 class="section-title">11. Perubahan Syarat dan Ketentuan</h2>
                        <p class="terms-text">MyYOGYA berhak mengubah syarat dan ketentuan ini sewaktu-waktu. Perubahan akan diberitahukan melalui:</p>
                        <ul class="terms-list">
                            <li>Pemberitahuan di website utama</li>
                            <li>Email kepada pengguna terdaftar</li>
                            <li>Notifikasi dalam aplikasi mobile</li>
                            <li>Pengumuman di media sosial resmi</li>
                        </ul>

                        <p class="terms-text">Pengguna yang terus menggunakan platform setelah perubahan dianggap menyetujui syarat dan ketentuan yang baru.</p>
                    </div>

                    <!-- Section 12: Kontak -->
                    <div id="kontak" class="terms-section">
                        <h2 class="section-title">12. Hukum yang Berlaku</h2>
                        <p class="terms-text">Syarat dan ketentuan ini tunduk pada hukum Republik Indonesia. Segala sengketa yang timbul akan diselesaikan melalui Pengadilan Negeri Jakarta Selatan atau melalui mekanisme penyelesaian sengketa alternatif.</p>

                        <div class="contact-info">
                            <h5 class="contact-title">Butuh Bantuan atau Informasi Lebih Lanjut?</h5>
                            <p class="contact-text">Tim customer service MyYOGYA siap membantu Anda 24/7</p>
                            
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
                                        <h6>Email</h6>
                                        <p>support@myyogya.co.id</p>
                                    </div>
                                </div>
                                
                                <div class="contact-method">
                                    <div class="contact-icon">
                                        <i class="fas fa-phone"></i>
                                    </div>
                                    <div class="contact-details">
                                        <h6>Telepon</h6>
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
    const navLinks = document.querySelectorAll('.terms-nav-list a');
    
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
        const sections = document.querySelectorAll('.terms-section');
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
