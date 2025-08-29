<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>403 - Akses Ditolak | Yogya Toserba</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #f26b37;
            --primary-dark: #e55827;
            --secondary-color: #6c757d;
            --dark-color: #343a40;
            --light-color: rgba(242, 107, 55, 0.1);
            --border-color: #e9ecef;
            --shadow-color: rgba(0, 0, 0, 0.1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Montserrat', sans-serif;
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            position: relative;
        }

        .error-container {
            text-align: center;
            padding: 2rem;
            max-width: 600px;
            width: 100%;
            position: relative;
            z-index: 2;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 80vh;
        }

        .error-number {
            font-size: 8rem;
            font-weight: 700;
            color: white;
            text-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            margin-bottom: 1.5rem;
            animation: float 3s ease-in-out infinite;
            letter-spacing: -8px;
        }

        .error-title {
            font-size: 1.8rem;
            font-weight: 600;
            color: white;
            margin-bottom: 1rem;
            text-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        }

        .error-message {
            font-size: 1rem;
            color: rgba(255, 255, 255, 0.9);
            margin-bottom: 2.5rem;
            line-height: 1.6;
            text-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
            max-width: 400px;
            margin-left: auto;
            margin-right: auto;
        }

        .error-actions {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
            margin-bottom: 2rem;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.8rem 1.5rem;
            font-size: 0.9rem;
            font-weight: 500;
            text-decoration: none;
            border-radius: 50px;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .btn-primary {
            background: rgba(255, 255, 255, 0.9);
            color: var(--primary-color);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
        }

        .btn-secondary {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            border: 2px solid rgba(255, 255, 255, 0.3);
            backdrop-filter: blur(10px);
        }

        .btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 35px rgba(0, 0, 0, 0.3);
        }

        .btn-primary:hover {
            background: white;
            color: var(--primary-dark);
        }

        .btn-secondary:hover {
            background: rgba(255, 255, 255, 0.3);
            border-color: rgba(255, 255, 255, 0.5);
        }

        .quick-links {
            position: fixed;
            bottom: 2rem;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 0.8rem;
            flex-wrap: wrap;
            justify-content: center;
            z-index: 3;
        }

        .quick-link {
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
            padding: 0.5rem 1rem;
            background: rgba(255, 255, 255, 0.15);
            color: white;
            text-decoration: none;
            border-radius: 25px;
            font-size: 0.8rem;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.25);
            font-weight: 500;
        }

        .quick-link:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-2px);
        }

        .floating-shapes {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 1;
        }

        .shape {
            position: absolute;
            opacity: 0.08;
            animation: float-shapes 20s ease-in-out infinite;
            color: white;
        }

        .shape:nth-child(1) {
            top: 5%;
            left: 8%;
            animation-delay: -2s;
            font-size: 2.5rem;
        }

        .shape:nth-child(2) {
            top: 15%;
            right: 12%;
            animation-delay: -4s;
            font-size: 2rem;
        }

        .shape:nth-child(3) {
            bottom: 25%;
            left: 15%;
            animation-delay: -6s;
            font-size: 1.8rem;
        }

        .shape:nth-child(4) {
            bottom: 10%;
            right: 8%;
            animation-delay: -8s;
            font-size: 2.2rem;
        }

        .shape:nth-child(5) {
            top: 35%;
            left: 5%;
            animation-delay: -1s;
            font-size: 1.5rem;
        }

        .shape:nth-child(6) {
            top: 45%;
            right: 5%;
            animation-delay: -3s;
            font-size: 1.7rem;
        }

        .shape:nth-child(7) {
            bottom: 40%;
            right: 25%;
            animation-delay: -5s;
            font-size: 2rem;
        }

        .shape:nth-child(8) {
            top: 25%;
            left: 25%;
            animation-delay: -7s;
            font-size: 1.8rem;
        }

        .shape:nth-child(9) {
            bottom: 35%;
            left: 35%;
            animation-delay: -9s;
            font-size: 1.6rem;
        }

        .shape:nth-child(10) {
            top: 55%;
            right: 15%;
            animation-delay: -10s;
            font-size: 2.3rem;
        }

        .shape:nth-child(11) {
            bottom: 60%;
            left: 10%;
            animation-delay: -11s;
            font-size: 1.4rem;
        }

        .shape:nth-child(12) {
            top: 70%;
            right: 30%;
            animation-delay: -12s;
            font-size: 1.9rem;
        }

        .yogya-logo {
            position: absolute;
            top: 2rem;
            left: 2rem;
            color: white;
            font-size: 1.5rem;
            font-weight: 700;
            opacity: 0.8;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-15px); }
        }

        @keyframes float-shapes {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            25% { transform: translateY(-30px) rotate(90deg); }
            50% { transform: translateY(-60px) rotate(180deg); }
            75% { transform: translateY(-30px) rotate(270deg); }
        }

        @media (max-width: 768px) {
            .error-container {
                padding: 1rem;
                min-height: 85vh;
            }

            .error-number {
                font-size: 6rem;
                letter-spacing: -6px;
            }

            .error-title {
                font-size: 1.5rem;
            }

            .error-message {
                font-size: 0.9rem;
                margin-bottom: 2rem;
            }

            .person-icon {
                font-size: 1.2rem;
            }

            .magnifying-glass {
                font-size: 1rem;
                right: -5px;
                top: -2px;
            }

            .search-illustration {
                height: 30px;
                width: 30px;
                margin-bottom: 0rem;
            }

            .error-number {
                font-size: 6rem;
                letter-spacing: -6px;
            }

            .quick-links {
                position: relative;
                bottom: auto;
                left: auto;
                transform: none;
                margin-top: 1rem;
                gap: 0.5rem;
            }

            .quick-link {
                font-size: 0.7rem;
                padding: 0.4rem 0.8rem;
            }

            .yogya-logo {
                font-size: 1.2rem;
            }

            .shape {
                opacity: 0.05;
            }
        }

        @media (max-width: 480px) {
            .error-actions {
                flex-direction: column;
                align-items: center;
            }

            .btn {
                width: 200px;
                justify-content: center;
            }
        }
    </style>
</head>
<body>
    <!-- Yogya Logo -->
    <div class="yogya-logo">
        <i class="fas fa-store"></i> MyYogya
    </div>

    <!-- Floating Background Shapes -->
    <div class="floating-shapes">
        <div class="shape">
            <i class="fas fa-shopping-cart"></i>
        </div>
        <div class="shape">
            <i class="fas fa-store"></i>
        </div>
        <div class="shape">
            <i class="fas fa-gift"></i>
        </div>
        <div class="shape">
            <i class="fas fa-tag"></i>
        </div>
        <div class="shape">
            <i class="fas fa-box"></i>
        </div>
        <div class="shape">
            <i class="fas fa-truck"></i>
        </div>
        <div class="shape">
            <i class="fas fa-warehouse"></i>
        </div>
        <div class="shape">
            <i class="fas fa-barcode"></i>
        </div>
        <div class="shape">
            <i class="fas fa-receipt"></i>
        </div>
        <div class="shape">
            <i class="fas fa-credit-card"></i>
        </div>
        <div class="shape">
            <i class="fas fa-shopping-bag"></i>
        </div>
        <div class="shape">
            <i class="fas fa-percent"></i>
        </div>
    </div>

    <div class="error-container">
        <div class="error-number">403</div>
        
        <h1 class="error-title">Akses Ditolak</h1>
        <p class="error-message">
            Maaf, Anda tidak memiliki izin untuk mengakses halaman ini. Silakan login dengan akun yang memiliki hak akses yang sesuai.
        </p>

        <div class="error-actions">
            <a href="{{ url('/') }}" class="btn btn-primary">
                <i class="fas fa-home"></i>
                Kembali ke Beranda
            </a>
            <a href="javascript:history.back()" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i>
                Halaman Sebelumnya
            </a>
        </div>
    </div>

    <!-- Quick Links -->
    <div class="quick-links">
        <a href="{{ url('/pelanggan/manual') }}" class="quick-link">
            <i class="fas fa-book"></i>
            Manual
        </a>
        <a href="{{ url('/pelanggan/bantuan-it') }}" class="quick-link">
            <i class="fas fa-life-ring"></i>
            Bantuan IT
        </a>
        <a href="{{ url('/pelanggan/kontak-admin') }}" class="quick-link">
            <i class="fas fa-address-book"></i>
            Kontak Admin
        </a>
    </div>

    <script>
        // Add loading animation
        document.addEventListener('DOMContentLoaded', function() {
            // Animate error elements on load
            const errorNumber = document.querySelector('.error-number');
            const searchIllustration = document.querySelector('.search-illustration');
            
            if (searchIllustration) {
                searchIllustration.style.transform = 'scale(0)';
                searchIllustration.style.opacity = '0';
                
                setTimeout(() => {
                    searchIllustration.style.transition = 'all 0.8s cubic-bezier(0.175, 0.885, 0.32, 1.275)';
                    searchIllustration.style.transform = 'scale(1)';
                    searchIllustration.style.opacity = '1';
                }, 300);
            }

            errorNumber.style.transform = 'scale(0)';
            errorNumber.style.opacity = '0';

            setTimeout(() => {
                errorNumber.style.transition = 'all 0.8s cubic-bezier(0.175, 0.885, 0.32, 1.275)';
                errorNumber.style.transform = 'scale(1)';
                errorNumber.style.opacity = '1';
            }, 600);

            // Add click effects
            document.querySelectorAll('.btn, .quick-link').forEach(element => {
                element.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-3px) scale(1.05)';
                });
                
                element.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0) scale(1)';
                });
            });
        });

        // Add some interactive particle effects
        function createParticle() {
            const particle = document.createElement('div');
            particle.style.position = 'absolute';
            particle.style.width = '4px';
            particle.style.height = '4px';
            particle.style.background = 'white';
            particle.style.borderRadius = '50%';
            particle.style.opacity = '0.6';
            particle.style.pointerEvents = 'none';
            particle.style.left = Math.random() * window.innerWidth + 'px';
            particle.style.top = window.innerHeight + 'px';
            particle.style.animation = 'particleFloat 4s linear forwards';
            
            document.body.appendChild(particle);
            
            setTimeout(() => particle.remove(), 4000);
        }

        // Add particle animation
        const style = document.createElement('style');
        style.textContent = `
            @keyframes particleFloat {
                to {
                    transform: translateY(-${window.innerHeight + 100}px);
                    opacity: 0;
                }
            }
        `;
        document.head.appendChild(style);

        // Create particles periodically
        setInterval(createParticle, 800);
    </script>
</body>
</html>
