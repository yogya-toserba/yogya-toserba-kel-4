<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Error Pages - Yogya Toserba</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Montserrat', sans-serif;
            background: linear-gradient(135deg, #f26b37 0%, #e55827 100%);
            min-height: 100vh;
            padding: 2rem;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.2);
        }

        .header {
            text-align: center;
            margin-bottom: 3rem;
        }

        .header h1 {
            color: #f26b37;
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .header p {
            color: #6c757d;
            font-size: 1.2rem;
        }

        .test-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin-bottom: 3rem;
        }

        .test-card {
            background: #f8f9fa;
            border-radius: 15px;
            padding: 2rem;
            text-align: center;
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }

        .test-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(242, 107, 55, 0.2);
            border-color: #f26b37;
        }

        .error-icon {
            font-size: 3rem;
            color: #f26b37;
            margin-bottom: 1rem;
        }

        .error-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: #343a40;
            margin-bottom: 0.5rem;
        }

        .error-desc {
            color: #6c757d;
            margin-bottom: 1.5rem;
            line-height: 1.6;
        }

        .test-btn {
            display: inline-block;
            padding: 1rem 2rem;
            background: #f26b37;
            color: white;
            text-decoration: none;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            font-size: 1rem;
        }

        .test-btn:hover {
            background: #e55827;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(242, 107, 55, 0.4);
        }

        .instructions {
            background: #e3f2fd;
            border-radius: 15px;
            padding: 2rem;
            margin-bottom: 2rem;
            border-left: 5px solid #2196f3;
        }

        .instructions h3 {
            color: #1976d2;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .instructions ul {
            color: #333;
            padding-left: 1.5rem;
        }

        .instructions li {
            margin-bottom: 0.5rem;
            line-height: 1.6;
        }

        .back-btn {
            display: inline-block;
            padding: 1rem 2rem;
            background: #6c757d;
            color: white;
            text-decoration: none;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s ease;
            margin-right: 1rem;
        }

        .back-btn:hover {
            background: #5a6268;
            transform: translateY(-2px);
        }

        .footer-actions {
            text-align: center;
            padding-top: 2rem;
            border-top: 2px solid #e9ecef;
        }

        @media (max-width: 768px) {
            body {
                padding: 1rem;
            }
            
            .container {
                padding: 1.5rem;
            }
            
            .header h1 {
                font-size: 2rem;
            }
            
            .test-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1><i class="fas fa-bug"></i> Test Error Pages</h1>
            <p>Klik tombol di bawah untuk test halaman error yang sudah dibuat</p>
        </div>

        <div class="instructions">
            <h3><i class="fas fa-info-circle"></i> Cara Testing:</h3>
            <ul>
                <li>Klik tombol "Test" pada setiap error code</li>
                <li>Halaman error akan terbuka di tab baru</li>
                <li>Periksa apakah animasi, styling, dan tombol-tombol berfungsi dengan baik</li>
                <li>Test juga fitur keyboard shortcut (ESC untuk back, Enter untuk home)</li>
                <li>Pastikan responsive design berfungsi dengan mengubah ukuran browser</li>
            </ul>
        </div>

        <div class="test-grid">
            <div class="test-card">
                <div class="error-icon">
                    <i class="fas fa-lock"></i>
                </div>
                <h3 class="error-title">Error 403</h3>
                <p class="error-desc">
                    Halaman Akses Ditolak<br>
                    Untuk halaman yang memerlukan permission khusus
                </p>
                <a href="{{ url('/test/403') }}" target="_blank" class="test-btn">
                    <i class="fas fa-external-link-alt"></i> Test 403
                </a>
            </div>

            <div class="test-card">
                <div class="error-icon">
                    <i class="fas fa-search"></i>
                </div>
                <h3 class="error-title">Error 404</h3>
                <p class="error-desc">
                    Halaman Tidak Ditemukan<br>
                    Untuk URL yang tidak ada atau salah
                </p>
                <a href="{{ url('/test/404') }}" target="_blank" class="test-btn">
                    <i class="fas fa-external-link-alt"></i> Test 404
                </a>
            </div>

            <div class="test-card">
                <div class="error-icon">
                    <i class="fas fa-ban"></i>
                </div>
                <h3 class="error-title">Error 405</h3>
                <p class="error-desc">
                    Method Not Allowed<br>
                    Untuk HTTP method yang tidak diizinkan
                </p>
                <a href="{{ url('/test/405') }}" target="_blank" class="test-btn">
                    <i class="fas fa-external-link-alt"></i> Test 405
                </a>
            </div>

            <div class="test-card">
                <div class="error-icon">
                    <i class="fas fa-server"></i>
                </div>
                <h3 class="error-title">Error 500</h3>
                <p class="error-desc">
                    Internal Server Error<br>
                    Untuk error sistem dan database
                </p>
                <a href="{{ url('/test/500') }}" target="_blank" class="test-btn">
                    <i class="fas fa-external-link-alt"></i> Test 500
                </a>
            </div>
        </div>

        <div class="footer-actions">
            <a href="{{ url('/') }}" class="back-btn">
                <i class="fas fa-home"></i> Kembali ke Beranda
            </a>
            <a href="{{ url('/pelanggan/manual') }}" class="test-btn">
                <i class="fas fa-book"></i> Lihat Manual Pelanggan
            </a>
        </div>
    </div>

    <script>
        // Add click effects
        document.querySelectorAll('.test-btn, .back-btn').forEach(btn => {
            btn.addEventListener('click', function(e) {
                this.style.transform = 'scale(0.95)';
                setTimeout(() => {
                    this.style.transform = '';
                }, 150);
            });
        });

        // Add counter animation
        let counter = 1;
        setInterval(() => {
            document.querySelectorAll('.test-card').forEach((card, index) => {
                if (counter % 4 === index) {
                    card.style.transform = 'scale(1.02)';
                    setTimeout(() => {
                        card.style.transform = '';
                    }, 200);
                }
            });
            counter++;
        }, 3000);
    </script>
</body>
</html>
