<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login Supplier - Yogya Toserba</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    
    <style>
        /* Supplier Login Page Styles - Based on Gudang Login */
        @import url("https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap");

        * {
            font-family: "Montserrat", sans-serif;
        }

        body {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-container {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 15px;
            box-sizing: border-box;
        }

        .login-card {
            display: flex;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
            max-width: 1000px;
            min-height: 600px;
            width: 100%;
            background-color: #ffffff;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .login-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 35px 60px rgba(0, 0, 0, 0.2);
        }

        /* Left Side - Orange Supplier Theme */
        .login-left {
            background: linear-gradient(135deg, #f26b37 0%, #e55827 100%);
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

        /* Supplier animated background */
        .login-left::before {
            content: "";
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 400 400"><text x="50" y="60" fill="rgba(255,255,255,0.12)" font-size="20">🚚</text><text x="200" y="100" fill="rgba(255,255,255,0.10)" font-size="18">📦</text><text x="120" y="180" fill="rgba(255,255,255,0.14)" font-size="22">📋</text><text x="300" y="150" fill="rgba(255,255,255,0.08)" font-size="16">🏭</text><text x="80" y="250" fill="rgba(255,255,255,0.10)" font-size="19">🤝</text><text x="250" y="220" fill="rgba(255,255,255,0.08)" font-size="17">💼</text><text x="150" y="320" fill="rgba(255,255,255,0.12)" font-size="20">📈</text><text x="350" y="280" fill="rgba(255,255,255,0.06)" font-size="15">⚙️</text><text x="30" y="200" fill="rgba(255,255,255,0.14)" font-size="24">🏪</text><text x="320" y="80" fill="rgba(255,255,255,0.06)" font-size="14">📱</text></svg>');
            animation: supplierFloat 45s infinite linear;
            z-index: 0;
            opacity: 0.8;
        }

        .login-left::after {
            content: "";
            position: absolute;
            top: -30%;
            left: -30%;
            width: 160%;
            height: 160%;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 300 300"><text x="40" y="50" fill="rgba(255,255,255,0.08)" font-size="16">🎯</text><text x="180" y="80" fill="rgba(255,255,255,0.10)" font-size="18">📍</text><text x="100" y="150" fill="rgba(255,255,255,0.12)" font-size="20">🔍</text><text x="230" y="180" fill="rgba(255,255,255,0.08)" font-size="15">💼</text><text x="60" y="220" fill="rgba(255,255,255,0.10)" font-size="17">📌</text><text x="200" y="250" fill="rgba(255,255,255,0.06)" font-size="14">🔗</text><text x="140" y="280" fill="rgba(255,255,255,0.12)" font-size="19">🛠️</text></svg>');
            animation: supplierFloatReverse 38s infinite linear, supplierPulse 15s infinite ease-in-out;
            z-index: 0;
            opacity: 0.7;
        }

        @keyframes supplierFloat {
            0% { transform: translate(-50%, -50%) rotate(0deg) scale(1); opacity: 0.9; }
            25% { transform: translate(-60%, -40%) rotate(90deg) scale(1.1); opacity: 1; }
            50% { transform: translate(-40%, -60%) rotate(180deg) scale(0.9); opacity: 0.8; }
            75% { transform: translate(-70%, -30%) rotate(270deg) scale(1.2); opacity: 1; }
            100% { transform: translate(-50%, -50%) rotate(360deg) scale(1); opacity: 0.9; }
        }

        @keyframes supplierFloatReverse {
            0% { transform: translate(-30%, -30%) rotate(0deg) scale(0.8); opacity: 0.7; }
            33% { transform: translate(-20%, -50%) rotate(-120deg) scale(1.3); opacity: 1; }
            66% { transform: translate(-50%, -20%) rotate(-240deg) scale(0.7); opacity: 1; }
            100% { transform: translate(-30%, -30%) rotate(-360deg) scale(0.8); opacity: 0.7; }
        }

        @keyframes supplierPulse {
            0% { transform: scale(0.9); opacity: 0.8; filter: brightness(1); }
            50% { transform: scale(1.4); opacity: 1; filter: brightness(1.3); }
            100% { transform: scale(0.9); opacity: 0.8; filter: brightness(1); }
        }

        .login-left h2 {
            font-weight: 700;
            font-size: 2.2rem;
            margin-bottom: 1rem;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            z-index: 1;
            position: relative;
            animation: supplierGlow 8s infinite ease-in-out alternate;
        }

        @keyframes supplierGlow {
            0% { text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1), 0 0 10px rgba(255, 255, 255, 0.2); }
            50% { text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1), 0 0 30px rgba(255, 255, 255, 0.6), 0 0 45px rgba(255, 255, 255, 0.4); }
            100% { text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1), 0 0 10px rgba(255, 255, 255, 0.2); }
        }

        /* Supplier Icon */
        .supplier-icon {
            font-size: 6.5rem;
            margin-bottom: 1.2rem;
            z-index: 1;
            position: relative;
        }

        .system-title {
            font-weight: 600;
            font-size: 1.4rem;
            margin-bottom: 1rem;
            z-index: 1;
            position: relative;
            letter-spacing: 1px;
        }

        .login-left p {
            font-weight: 300;
            font-size: 0.9rem;
            text-align: center;
            line-height: 1.6;
            opacity: 0.9;
            z-index: 1;
            position: relative;
            margin-bottom: 2rem;
            padding: 0 10px;
        }

        /* Supplier Stats Animation */
        .supplier-stats {
            display: flex;
            flex-direction: column;
            gap: 0.6rem;
            z-index: 1;
            position: relative;
            width: 100%;
            max-width: 240px;
            margin-top: 1rem;
        }

        .stat-item {
            display: flex;
            align-items: center;
            gap: 0.6rem;
            padding: 0.5rem 0.8rem;
            background: rgba(255, 255, 255, 0.08);
            border-radius: 8px;
            backdrop-filter: blur(8px);
            border: 1px solid rgba(255, 255, 255, 0.15);
            animation: statSlideIn 0.6s ease forwards;
            opacity: 0;
            transform: translateX(-30px);
        }

        .stat-item i {
            font-size: 1rem;
            color: rgba(255, 255, 255, 0.85);
        }

        .stat-item span {
            font-size: 0.7rem;
            font-weight: 500;
            color: rgba(255, 255, 255, 0.9);
        }

        @keyframes statSlideIn {
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        /* Right Side - Login Form */
        .login-right {
            flex: 1;
            padding: 20px 30px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            height: 100%;
            overflow: hidden;
        }

        .logo-section {
            text-align: center;
            margin-bottom: 1.5rem;
        }

        .logo-section img {
            height: 70px;
            margin-bottom: 0.8rem;
        }

        .welcome-title {
            color: #f26b37;
            font-weight: 600;
            font-size: 1.6rem;
            margin: 0;
        }

        .welcome-subtitle {
            color: #6c757d;
            font-weight: 400;
            font-size: 0.85rem;
            margin-top: 0.3rem;
            margin-bottom: 1.5rem;
        }

        /* Form Styles */
        .form-group {
            margin-bottom: 1rem;
            position: relative;
        }

        .floating-label {
            position: relative;
            margin-bottom: 1.2rem;
        }

        .floating-label .form-control {
            padding: 12px 12px 12px 12px;
            height: 50px;
            background-color: #f8f9fa;
            border: 2px solid #e9ecef;
            border-radius: 12px;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            box-sizing: border-box;
        }

        .floating-label .form-control:focus {
            border-color: #f26b37;
            box-shadow: 0 0 0 0.15rem rgba(242, 107, 55, 0.15);
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
            font-size: 0.9rem;
            font-weight: 400;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            pointer-events: none;
            z-index: 2;
            padding: 0 4px;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .floating-label-text i {
            font-size: 0.85rem;
        }

        .floating-label .form-control:focus + .floating-label-text,
        .floating-label-text.active {
            top: 0;
            transform: translateY(-50%);
            font-size: 0.75rem;
            color: #f26b37;
            font-weight: 500;
            background-color: #ffffff;
        }

        /* Password Toggle */
        .password-input-group {
            position: relative;
        }

        .password-toggle {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #6c757d;
            z-index: 10;
            padding: 5px;
            transition: color 0.3s ease;
        }

        .password-toggle:hover {
            color: #f26b37;
        }

        .password-input-group .form-control {
            padding-right: 45px;
        }

        /* Login Button */
        .btn-login {
            background: linear-gradient(135deg, #f26b37 0%, #e55827 100%);
            color: white;
            border-radius: 12px;
            height: 55px;
            border: none;
            font-weight: 600;
            font-size: 1rem;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .btn-login::before {
            content: "";
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .btn-login:hover {
            background: linear-gradient(135deg, #e55827 0%, #d44a1a 100%);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(242, 107, 55, 0.3);
            color: white;
        }

        .btn-login:hover::before {
            left: 100%;
        }

        .btn-login:active {
            transform: translateY(0);
        }

        /* Security Notice */
        .security-notice {
            background-color: #f8f9fa;
            border: 1px solid #e9ecef;
            border-radius: 10px;
            padding: 1rem;
            margin: 1.5rem 0;
            display: flex;
            align-items: flex-start;
            gap: 0.8rem;
        }

        .security-notice i {
            color: #f26b37;
            font-size: 1.1rem;
            margin-top: 0.1rem;
        }

        .security-notice small {
            color: #6c757d;
            line-height: 1.4;
            font-size: 0.8rem;
        }

        /* Alert Styles */
        .alert {
            border-radius: 12px;
            border: none;
            padding: 1rem 1.5rem;
            margin-bottom: 1.5rem;
            font-weight: 500;
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
        }

        /* Responsive Design */
        @media (max-width: 992px) {
            .login-card {
                flex-direction: column;
                max-width: 600px;
                height: auto;
                min-height: auto;
            }

            .login-left {
                padding: 30px 25px;
            }

            .supplier-stats {
                flex-direction: row;
                flex-wrap: wrap;
            }

            .stat-item {
                flex: 1;
                min-width: 120px;
            }

            .login-right {
                padding: 30px 25px;
                height: auto;
                overflow: hidden;
            }
        }

        @media (max-width: 480px) {
            .login-container {
                padding: 10px;
            }

            .login-left,
            .login-right {
                padding: 25px 20px;
            }

            .supplier-stats {
                flex-direction: column;
            }
        }

        /* Animation for form elements */
        .form-group {
            animation: slideInUp 0.6s ease forwards;
            opacity: 0;
            transform: translateY(20px);
        }

        .form-group:nth-child(1) { animation-delay: 0.1s; }
        .form-group:nth-child(2) { animation-delay: 0.2s; }
        .form-group:nth-child(3) { animation-delay: 0.3s; }
        .form-group:nth-child(4) { animation-delay: 0.4s; }

        @keyframes slideInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .login-card {
            animation: fadeInScale 0.8s ease forwards;
            opacity: 0;
            transform: scale(0.9);
        }

        @keyframes fadeInScale {
            to {
                opacity: 1;
                transform: scale(1);
            }
        }
    </style>
</head>
<<body>
    <div class="container login-container">
        <div class="login-card">
            <!-- Left Side - Purple Supplier Section -->
            <div class="login-left text-center">
                <h2 class="mb-4">MyYOGYA</h2>
                <div class="supplier-icon">
                    <i class="fas fa-truck"></i>
                </div>
                <h3 class="system-title">Supplier Portal</h3>
                <p class="mb-0">Portal terintegrasi untuk mitra supplier dalam mengelola produk, pesanan, dan kerjasama bisnis dengan Yogya Toserba secara efisien.</p>
                
                <!-- Supplier Stats Animation -->
                <div class="supplier-stats">
                    <div class="stat-item">
                        <i class="fas fa-handshake"></i>
                        <span>Partnership Management</span>
                    </div>
                    <div class="stat-item">
                        <i class="fas fa-shopping-cart"></i>
                        <span>Order Processing</span>
                    </div>
                    <div class="stat-item">
                        <i class="fas fa-comments"></i>
                        <span>Chat Real-time</span>
                    </div>
                </div>
            </div>

            <!-- Right Side - Login Form -->
            <div class="login-right">
                <div class="logo-section text-center">
                    <img src="{{ asset('image/logo_yogya.png') }}" alt="Yogya Logo">
                    <h2 class="welcome-title">Portal Supplier</h2>
                    <p class="welcome-subtitle">Akses sistem manajemen supplier</p>
                </div>

                @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('supplier.authenticate') }}" id="supplierLoginForm">
                    @csrf
                    
                    <div class="form-group floating-label">
                        <input type="text" name="login" class="form-control @error('login') is-invalid @enderror" 
                               value="{{ old('login') }}" required autofocus>
                        <label class="floating-label-text">
                            <i class="fas fa-user"></i>
                            Username atau Email
                        </label>
                    </div>
                    
                    <div class="form-group floating-label password-input-group">
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required>
                        <label class="floating-label-text">
                            <i class="fas fa-lock"></i>
                            Kata Sandi
                        </label>
                        <span class="password-toggle" onclick="togglePassword('password')">
                            <i class="fas fa-eye" id="password-eye"></i>
                        </span>
                    </div>
                    
                    <div class="form-group">
                        <button type="submit" class="btn btn-login w-100">
                            <i class="fas fa-sign-in-alt"></i>
                            Masuk ke Portal Supplier
                        </button>
                    </div>
                </form>

                <!-- Security Notice -->
                <div class="security-notice">
                    <i class="fas fa-shield-alt"></i>
                    <small>Portal ini hanya untuk mitra supplier yang terdaftar. Semua aktivitas tercatat dan dipantau demi keamanan bersama.</small>
                </div>

                <!-- Registration Notice -->
                <div class="text-center">
                    <small class="text-muted">
                        Belum punya akun? Hubungi administrator untuk mendaftarkan perusahaan Anda.
                    </small>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Enhanced floating label functionality
        document.addEventListener('DOMContentLoaded', function() {
            const floatingInputs = document.querySelectorAll('.floating-label .form-control');
            
            floatingInputs.forEach(input => {
                // Add event listeners
                input.addEventListener('focus', () => {
                    const label = input.nextElementSibling;
                    label.classList.add('active');
                });
                
                input.addEventListener('blur', () => {
                    const label = input.nextElementSibling;
                    if (input.value.length === 0) {
                        label.classList.remove('active');
                    }
                });
                
                // Check if input has value on page load
                if (input.value.length > 0) {
                    const label = input.nextElementSibling;
                    label.classList.add('active');
                }
            });
        });

        // Password toggle functionality
        function togglePassword(fieldName) {
            const passwordField = document.querySelector(`input[name="${fieldName}"]`);
            const eyeIcon = document.getElementById(`${fieldName}-eye`);
            
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            } else {
                passwordField.type = 'password';
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
            }
        }

        // Form validation and submission
        document.getElementById('supplierLoginForm').addEventListener('submit', function(e) {
            const login = document.querySelector('input[name="login"]').value.trim();
            const password = document.querySelector('input[name="password"]').value;
            
            if (!login) {
                e.preventDefault();
                alert('Mohon masukkan username atau email Anda.');
                return false;
            }
            
            if (!password) {
                e.preventDefault();
                alert('Mohon masukkan password Anda.');
                return false;
            }
        });
    </script>
</body>
</html>
