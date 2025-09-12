<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password - MyYOGYA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap');
        
        * {
            font-family: 'Montserrat', sans-serif;
        }
        
        body {
            background: #ffffff;
            margin: 0;
            padding: 0;
            height: 100vh;
            overflow: hidden;
        }

        .forgot-password-container {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 15px;
        }

        .forgot-password-card {
            display: flex;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
            max-width: 900px;
            min-height: 70vh;
            width: 100%;
            background-color: #fff;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .forgot-password-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 35px 60px rgba(0, 0, 0, 0.2);
        }

        .forgot-left {
            background: linear-gradient(135deg, #F26B37 0%, #E55827 100%);
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            color: white;
            padding: 30px 25px;
            position: relative;
            overflow: hidden;
        }

        .forgot-left::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 400 400"><text x="50" y="60" fill="rgba(255,255,255,0.15)" font-size="20">🔐</text><text x="200" y="100" fill="rgba(255,255,255,0.12)" font-size="18">📧</text><text x="120" y="180" fill="rgba(255,255,255,0.14)" font-size="22">🛡️</text><text x="300" y="150" fill="rgba(255,255,255,0.10)" font-size="16">🔑</text><text x="80" y="250" fill="rgba(255,255,255,0.13)" font-size="19">💌</text><text x="250" y="220" fill="rgba(255,255,255,0.11)" font-size="17">🔒</text><text x="150" y="320" fill="rgba(255,255,255,0.12)" font-size="20">📱</text><text x="350" y="280" fill="rgba(255,255,255,0.09)" font-size="15">🔓</text><text x="30" y="200" fill="rgba(255,255,255,0.16)" font-size="24">🏪</text><text x="320" y="80" fill="rgba(255,255,255,0.08)" font-size="14">💳</text></svg>');
            animation: float 37s infinite linear, wave 23s infinite ease-in-out;
            z-index: 0;
        }

        .forgot-left::after {
            content: '';
            position: absolute;
            top: -30%;
            left: -30%;
            width: 160%;
            height: 160%;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 300 300"><text x="40" y="50" fill="rgba(255,255,255,0.08)" font-size="16">🔐</text><text x="180" y="80" fill="rgba(255,255,255,0.10)" font-size="18">📧</text><text x="100" y="150" fill="rgba(255,255,255,0.12)" font-size="20">🔑</text><text x="230" y="180" fill="rgba(255,255,255,0.09)" font-size="15">🛡️</text><text x="60" y="220" fill="rgba(255,255,255,0.11)" font-size="17">💌</text><text x="200" y="250" fill="rgba(255,255,255,0.07)" font-size="14">🔒</text><text x="140" y="280" fill="rgba(255,255,255,0.13)" font-size="19">📱</text></svg>');
            animation: floatReverse 43s infinite linear, pulse 17s infinite ease-in-out;
            z-index: 0;
        }

        @keyframes float {
            0% { 
                transform: translate(-50%, -50%) rotate(0deg) scale(1);
                opacity: 0.8;
            }
            25% { 
                transform: translate(-60%, -40%) rotate(120deg) scale(0.95);
                opacity: 1;
            }
            50% { 
                opacity: 0.7;
                transform: translate(-70%, -30%) rotate(270deg) scale(0.85);
            }
            75% { 
                transform: translate(-25%, -70%) rotate(320deg) scale(1.35);
                opacity: 1;
            }
            100% { 
                transform: translate(-50%, -50%) rotate(480deg) scale(1);
                opacity: 0.8;
            }
        }

        @keyframes floatReverse {
            0% { 
                transform: translate(-30%, -30%) rotate(0deg) scale(0.8);
                opacity: 0.6;
            }
            30% { 
                transform: translate(-45%, -15%) rotate(-150deg) scale(0.7);
                opacity: 0.9;
            }
            60% { 
                opacity: 1;
                transform: translate(-50%, -10%) rotate(-300deg) scale(0.9);
            }
            100% { 
                transform: translate(-30%, -30%) rotate(-480deg) scale(0.8);
                opacity: 0.6;
            }
        }

        @keyframes pulse {
            0% { 
                transform: scale(1);
                opacity: 0.7;
            }
            50% { 
                transform: scale(0.95);
                opacity: 0.8;
            }
            100% { 
                transform: scale(1);
                opacity: 0.7;
            }
        }

        @keyframes wave {
            0% { 
                transform: translate(-50%, -50%) rotate(0deg) scale(1) skewX(0deg);
            }
            33% { 
                transform: translate(-50%, -50%) rotate(140deg) scale(0.9) skewX(-12deg);
            }
            66% { 
                transform: translate(-50%, -50%) rotate(290deg) scale(0.8) skewX(-8deg);
            }
            100% { 
                transform: translate(-50%, -50%) rotate(450deg) scale(1) skewX(0deg);
            }
        }

        .forgot-left h2 {
            font-weight: 700;
            font-size: 2.2rem;
            margin-bottom: 1.5rem;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            z-index: 1;
            position: relative;
            animation: glow 11s infinite ease-in-out alternate;
        }

        @keyframes glow {
            0% { 
                text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1), 0 0 10px rgba(255,255,255,0.2);
            }
            50% { 
                text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1), 0 0 30px rgba(255,255,255,0.6), 0 0 45px rgba(255,255,255,0.4);
            }
            100% { 
                text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1), 0 0 10px rgba(255,255,255,0.2);
            }
        }

        .forgot-left img {
            z-index: 1;
            position: relative;
            margin: 1.5rem auto;
            max-height: 200px !important;
            width: auto;
            max-width: 95%;
            display: block;
            text-align: center;
        }

        .forgot-left p {
            font-weight: 300;
            font-size: 1rem;
            text-align: center;
            line-height: 1.6;
            opacity: 0.9;
            z-index: 1;
            position: relative;
            margin: 0;
            padding: 0 10px;
        }

        .forgot-right {
            flex: 1;
            padding: 20px 25px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            max-height: 70vh;
            overflow-y: auto;
        }

        .logo-section {
            text-align: center;
            margin-bottom: 1.2rem;
        }

        .logo-section .logo {
            width: 80px;
            height: 80px;
            margin: 0 auto 20px;
            background: linear-gradient(135deg, #F26B37 0%, #E55827 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 2rem;
            box-shadow: 0 10px 30px rgba(242, 107, 55, 0.3);
            transition: all 0.3s ease;
        }

        .logo-section .logo:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(242, 107, 55, 0.4);
        }

        .welcome-title {
            color: #F26B37;
            font-weight: 600;
            font-size: 1.6rem;
            margin: 0;
        }

        .welcome-subtitle {
            color: #6c757d;
            font-weight: 400;
            font-size: 0.9rem;
            margin-top: 0.2rem;
        }

        /* Floating Label Styles */
        .floating-label {
            position: relative;
            margin-bottom: 1.2rem;
        }

        .floating-label .form-control {
            padding: 12px 12px 12px 12px;
            height: 45px;
            background-color: #f8f9fa;
            border: 2px solid #e9ecef;
            border-radius: 10px;
            font-size: 0.85rem;
            transition: all 0.3s ease;
        }

        .floating-label .form-control:focus {
            border-color: #F26B37;
            box-shadow: 0 0 0 0.1rem rgba(242, 107, 55, 0.15);
            background-color: #ffffff;
            outline: none;
        }

        .floating-label-text {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            background-color: transparent;
            color: #adb5bd;
            font-size: 0.85rem;
            font-weight: 400;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            pointer-events: none;
            z-index: 2;
            padding: 0 4px;
        }

        .floating-label .form-control:focus + .floating-label-text,
        .floating-label-text.active {
            top: 0;
            transform: translateY(-50%);
            font-size: 0.7rem;
            color: #F26B37;
            font-weight: 500;
            background-color: #ffffff;
        }

        .form-control {
            border-radius: 10px;
            height: 38px;
            padding: 0 12px;
            border: 2px solid #e9ecef;
            font-size: 0.85rem;
            font-weight: 400;
            transition: all 0.3s ease;
            background-color: #f8f9fa;
            width: 100%;
            box-sizing: border-box;
        }

        .form-control:focus {
            border-color: #F26B37;
            box-shadow: 0 0 0 0.1rem rgba(242, 107, 55, 0.15);
            background-color: #ffffff;
            outline: none;
        }

        .form-control::placeholder {
            color: #adb5bd;
            font-weight: 400;
        }

        .btn-primary {
            background: linear-gradient(135deg, #F26B37 0%, #E55827 100%);
            color: white;
            border-radius: 15px;
            height: 55px;
            border: none;
            font-weight: 600;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            width: 100%;
        }

        .btn-primary::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #E55827 0%, #D44A1A 100%);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(242, 107, 55, 0.3);
            color: white;
        }

        .btn-primary:hover::before {
            left: 100%;
        }

        .btn-primary:active {
            transform: translateY(0);
        }

        .back-link {
            text-align: center;
            margin-top: 1rem;
        }

        .back-link a {
            color: #F26B37;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s ease;
            font-size: 0.9rem;
        }

        .back-link a:hover {
            color: #E55827;
            text-decoration: underline;
        }

        .alert {
            border-radius: 12px;
            border: none;
            padding: 1rem 1.5rem;
            margin-bottom: 1.5rem;
            font-weight: 500;
        }

        .alert-success {
            background-color: #d1edff;
            color: #0c5460;
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .forgot-password-card {
                flex-direction: column;
                margin: 20px;
                max-width: none;
                min-height: 80vh;
            }
            
            .forgot-left {
                padding: 30px 20px;
                min-height: 250px;
            }
            
            .forgot-left h2 {
                font-size: 1.8rem;
            }
            
            .forgot-right {
                padding: 30px 20px;
            }
            
            .welcome-title {
                font-size: 1.4rem;
            }
        }
    </style>
</head>
<body>
    <div class="forgot-password-container">
        <div class="forgot-password-card">
            <!-- Left Side - Branding -->
            <div class="forgot-left">
                <h2>MyYOGYA</h2>
                <p>Sistem keamanan terpercaya untuk akun MyYOGYA Anda. Dapatkan kembali akses dengan mudah dan aman.</p>
            </div>
            
            <!-- Right Side - Form -->
            <div class="forgot-right">
                <div class="logo-section">
                    <div class="logo">
                        <i class="fas fa-key"></i>
                    </div>
                    <h4 class="welcome-title">Lupa Password</h4>
                    <p class="welcome-subtitle">Masukkan email Anda untuk menerima kode OTP</p>
                </div>

                @if(session('success') || session('status'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle me-2"></i>
                        {{ session('success') ?? session('status') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-circle me-2"></i>
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <form action="{{ route('password.send.otp') }}" method="POST">
                    @csrf
                    <div class="floating-label">
                        <input type="email" class="form-control @error('email') is-invalid @enderror" 
                               id="email" name="email" value="{{ old('email') }}" required>
                        <label for="email" class="floating-label-text">
                            <i class="fas fa-envelope me-1"></i>Email Address
                        </label>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-grid mb-3">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-paper-plane me-2"></i>Kirim Kode OTP
                        </button>
                    </div>
                </form>

                <div class="back-link">
                    <a href="{{ route('pelanggan.login') }}">
                        <i class="fas fa-arrow-left me-1"></i>Kembali ke Login
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Floating label functionality
        document.addEventListener('DOMContentLoaded', function() {
            const floatingInputs = document.querySelectorAll('.floating-label .form-control');
            
            floatingInputs.forEach(input => {
                const label = input.nextElementSibling;
                
                // Check initial state
                if (input.value.trim() !== '') {
                    label.classList.add('active');
                }
                
                // Focus event
                input.addEventListener('focus', () => {
                    label.classList.add('active');
                });
                
                // Blur event
                input.addEventListener('blur', () => {
                    if (input.value.trim() === '') {
                        label.classList.remove('active');
                    }
                });
                
                // Input event
                input.addEventListener('input', () => {
                    if (input.value.trim() !== '') {
                        label.classList.add('active');
                    } else {
                        label.classList.remove('active');
                    }
                });
            });
        });

        // Debug form submission
        document.querySelector('form').addEventListener('submit', function(e) {
            console.log('Form submitted!');
            const email = document.querySelector('#email').value;
            console.log('Email value:', email);
            if (!email) {
                e.preventDefault();
                alert('Please enter email');
                return false;
            }
        });
    </script>
</body>
</html>
