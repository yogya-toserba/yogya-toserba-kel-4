<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - MyYOGYA</title>
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

        .login-container {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 15px;
        }

        .login-card {
            display: flex;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
            max-width: 1000px;
            min-height: 85vh;
            width: 100%;
            background-color: #fff;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .login-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 35px 60px rgba(0, 0, 0, 0.2);
        }

        .login-left {
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

        .login-left::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200"><circle cx="30" cy="40" r="2" fill="rgba(255,255,255,0.15)"/><circle cx="150" cy="60" r="1.5" fill="rgba(255,255,255,0.1)"/><circle cx="80" cy="120" r="2.5" fill="rgba(255,255,255,0.12)"/><circle cx="170" cy="140" r="1" fill="rgba(255,255,255,0.08)"/><circle cx="50" cy="160" r="1.8" fill="rgba(255,255,255,0.13)"/><circle cx="120" cy="30" r="1.2" fill="rgba(255,255,255,0.09)"/><circle cx="40" cy="90" r="3" fill="rgba(255,255,255,0.16)"/><circle cx="180" cy="100" r="1.3" fill="rgba(255,255,255,0.11)"/><circle cx="90" cy="180" r="2.2" fill="rgba(255,255,255,0.14)"/><circle cx="160" cy="20" r="1.7" fill="rgba(255,255,255,0.1)"/></svg>');
            animation: float 25s infinite linear;
        }

        .login-left::after {
            content: '';
            position: absolute;
            top: -30%;
            left: -30%;
            width: 160%;
            height: 160%;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 150 150"><circle cx="20" cy="20" r="1" fill="rgba(255,255,255,0.06)"/><circle cx="100" cy="50" r="2" fill="rgba(255,255,255,0.08)"/><circle cx="60" cy="100" r="1.5" fill="rgba(255,255,255,0.07)"/><circle cx="130" cy="120" r="1.2" fill="rgba(255,255,255,0.05)"/><circle cx="40" cy="140" r="1.8" fill="rgba(255,255,255,0.09)"/></svg>');
            animation: floatReverse 30s infinite linear;
            z-index: 0;
        }

        @keyframes float {
            0% { 
                transform: translate(-50%, -50%) rotate(0deg) scale(1);
                opacity: 0.8;
            }
            50% { 
                opacity: 1;
                transform: translate(-50%, -50%) rotate(180deg) scale(1.1);
            }
            100% { 
                transform: translate(-50%, -50%) rotate(360deg) scale(1);
                opacity: 0.8;
            }
        }

        @keyframes floatReverse {
            0% { 
                transform: translate(-30%, -30%) rotate(360deg) scale(0.8);
                opacity: 0.5;
            }
            50% { 
                opacity: 0.8;
                transform: translate(-30%, -30%) rotate(180deg) scale(1.2);
            }
            100% { 
                transform: translate(-30%, -30%) rotate(0deg) scale(0.8);
                opacity: 0.5;
            }
        }

        .login-left h2 {
            font-weight: 700;
            font-size: 2.2rem;
            margin-bottom: 1.5rem;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            z-index: 1;
            position: relative;
        }

        .login-left img {
            z-index: 1;
            position: relative;
            margin-bottom: 1.5rem;
            max-height: 320px !important;
            width: auto;
            max-width: 95%;
        }

        .login-left p {
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

        .login-right {
            flex: 1.1;
            padding: 20px 25px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            max-height: 85vh;
            overflow-y: auto;
        }

        .logo-section {
            text-align: center;
            margin-bottom: 1.2rem;
        }

        .logo-section img {
            height: 80px;
            margin-bottom: 0.8rem;
            filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.1));
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
            font-size: 0.8rem;
            margin-top: 0.2rem;
        }

        .form-group {
            margin-bottom: 0.6rem;
            position: relative;
        }

        /* Floating Label Styles */
        .floating-label {
            position: relative;
            margin-bottom: 0.8rem;
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
            box-shadow: 0 0 0 0.2rem rgba(242, 107, 55, 0.25);
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

        .floating-label .form-control:focus + .floating-label-text {
            color: #F26B37;
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
            color: #F26B37;
        }

        .password-toggle i {
            font-size: 16px;
        }

        /* Special padding for password inputs to make room for toggle icon */
        .password-input-group .form-control {
            padding-right: 45px;
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
            box-shadow: 0 0 0 0.2rem rgba(242, 107, 55, 0.25);
            background-color: #ffffff;
            outline: none;
        }

        .form-control::placeholder {
            color: #adb5bd;
            font-weight: 400;
        }

        .btn-login {
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

        .btn-login::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .btn-login:hover {
            background: linear-gradient(135deg, #E55827 0%, #D44A1A 100%);
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

        .divider {
            display: flex;
            align-items: center;
            margin: 0.6rem 0;
        }

        .divider hr {
            flex: 1;
            border: none;
            height: 1px;
            background-color: #e9ecef;
        }

        .divider span {
            padding: 0 1rem;
            color: #6c757d;
            font-weight: 500;
            font-size: 0.9rem;
        }

        .btn-google {
            border: 2px solid #e9ecef;
            background-color: #ffffff;
            color: #495057;
            border-radius: 10px;
            height: 45px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
            margin-bottom: 0.8rem;
            width: 100%;
            font-size: 0.85rem;
        }

        .btn-google:hover {
            border-color: #db4437;
            color: #db4437;
            background-color: #fff5f5;
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(219, 68, 55, 0.15);
            text-decoration: none;
        }

        .btn-google img {
            margin-right: 0.5rem;
            width: 18px;
            height: 18px;
        }

        .register-link {
            text-align: center;
            margin-top: 0.5rem;
        }

        .register-link small {
            color: #6c757d;
            font-weight: 400;
        }

        .register-link a {
            color: #F26B37;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .register-link a:hover {
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

        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .login-card {
                flex-direction: column;
                margin: 20px;
                max-width: none;
            }
            
            .login-left {
                padding: 40px 30px;
            }
            
            .login-left h2 {
                font-size: 2rem;
            }
            
            .login-right {
                padding: 40px 30px;
            }
            
            .welcome-title {
                font-size: 1.5rem;
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

<body>
    <div class="container login-container">
        <div class="login-card">
            <!-- Left Side -->
            <div class="login-left text-center">
                <h2 class="mb-4">MyYOGYA</h2>
                <img src="{{ asset('image/shopping.png') }}" alt="Shopping Illustration" class="img-fluid">
                <p class="mb-0">Selamat datang di platform belanja online terpercaya. Masuk untuk pengalaman berbelanja yang lebih personal.</p>
            </div>

            <!-- Right Side -->
            <div class="login-right">
                <div class="logo-section text-center">
                    <img src="{{ asset('image/logo_yogya.png') }}" alt="Yogya Logo">
                    <h2 class="welcome-title">AyoMasuk</h2>
                    <p class="welcome-subtitle">Silakan masuk ke akun Anda</p>
                </div>

                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                <form action="" method="POST">
                    @csrf
                    <div class="form-group floating-label">
                        <input type="text" name="username" class="form-control" required autofocus>
                        <label class="floating-label-text">Username atau Email</label>
                    </div>
                    <div class="form-group floating-label password-input-group">
                        <input type="password" name="password" class="form-control" required>
                        <label class="floating-label-text">Kata Sandi</label>
                        <span class="password-toggle" onclick="togglePassword('password')">
                            <i class="fas fa-eye" id="password-eye"></i>
                        </span>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-login w-100">Masuk Sekarang</button>
                    </div>
                </form>

                <!-- Divider -->
                <div class="divider">
                    <hr>
                    <span>atau</span>
                    <hr>
                </div>

                <!-- Google Login Button -->
                <a href="" class="btn-google w-100">
                    <img src="https://www.svgrepo.com/show/475656/google-color.svg" alt="Google" width="18">
                    Masuk dengan Google
                </a>

                <div class="register-link">
                    <small>Belum punya akun? <a href="{{ route('pelanggan.register') }}">Daftar sekarang juga!</a></small>
                </div>
            </div>
        </div>
    </div>

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
                
                input.addEventListener('input', () => {
                    const label = input.nextElementSibling;
                    if (input.value.length > 0) {
                        label.classList.add('active');
                    }
                });
            });
        });

        // Toggle password visibility
        function togglePassword(inputName) {
            const input = document.querySelector(`input[name="${inputName}"]`);
            const eye = document.getElementById(`${inputName}-eye`);
            
            if (input.type === 'password') {
                input.type = 'text';
                eye.classList.remove('fa-eye');
                eye.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                eye.classList.remove('fa-eye-slash');
                eye.classList.add('fa-eye');
            }
        }
    </script>
</body>

</html>