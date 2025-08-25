<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Yogya Toserba</title>
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
            max-width: 900px;
            min-height: 600px;
            height: max-content;
            width: 100%;
            background-color: #fff;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .login-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 35px 60px rgba(0, 0, 0, 0.2);
        }

        .login-left {
            background: linear-gradient(135deg, #00539B 0%, #003D75 100%);
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
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 400 400"><text x="50" y="60" fill="rgba(255,255,255,0.15)" font-size="20">👩‍💼</text><text x="200" y="100" fill="rgba(255,255,255,0.12)" font-size="18">⚡</text><text x="120" y="180" fill="rgba(255,255,255,0.14)" font-size="22">💻</text><text x="300" y="150" fill="rgba(255,255,255,0.10)" font-size="16">📊</text><text x="80" y="250" fill="rgba(255,255,255,0.13)" font-size="19">🔑</text><text x="250" y="220" fill="rgba(255,255,255,0.11)" font-size="17">🛍️</text><text x="150" y="320" fill="rgba(255,255,255,0.12)" font-size="20">💼</text><text x="350" y="280" fill="rgba(255,255,255,0.09)" font-size="15">📱</text><text x="30" y="200" fill="rgba(255,255,255,0.16)" font-size="24">🔍</text><text x="320" y="80" fill="rgba(255,255,255,0.08)" font-size="14">⚙️</text></svg>');
            animation: float 37s infinite linear, wave 23s infinite ease-in-out;
            z-index: 0;
        }

        .login-left::after {
            content: '';
            position: absolute;
            top: -30%;
            left: -30%;
            width: 160%;
            height: 160%;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 300 300"><text x="40" y="50" fill="rgba(255,255,255,0.08)" font-size="16">📈</text><text x="180" y="80" fill="rgba(255,255,255,0.10)" font-size="18">💡</text><text x="100" y="150" fill="rgba(255,255,255,0.12)" font-size="20">🔐</text><text x="230" y="180" fill="rgba(255,255,255,0.09)" font-size="15">📋</text><text x="60" y="220" fill="rgba(255,255,255,0.11)" font-size="17">⚖️</text><text x="200" y="250" fill="rgba(255,255,255,0.07)" font-size="14">🎯</text><text x="140" y="280" fill="rgba(255,255,255,0.13)" font-size="19">📅</text></svg>');
            animation: floatReverse 43s infinite linear, pulse 17s infinite ease-in-out;
            z-index: 0;
        }

        @keyframes float {
            0% { 
                transform: translate(-50%, -50%) rotate(0deg) scale(1);
                opacity: 0.8;
            }
            50% { 
                transform: translate(-70%, -30%) rotate(270deg) scale(0.85);
                opacity: 0.7;
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
            50% { 
                transform: translate(-50%, -10%) rotate(-300deg) scale(0.9);
                opacity: 1;
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

        .login-left h2 {
            font-weight: 700;
            font-size: 2.2remw`;
            margin-bottom: 1.5rem;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            z-index: 1;
            position: relative;
        }

        .login-left img {
            z-index: 1;
            position: relative;
            margin: 1.5rem auto;
            max-height: 320px !important;
            width: auto;
            max-width: 95%;
            display: block;
            text-align: center;
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
            flex: 1;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            max-width: 450px;
            margin: 0 auto;
        }

        .logo-section {
            text-align: center;
            margin-bottom: 2rem;
        }

        .logo-section img {
            height: 60px;
            margin-bottom: 1rem;
            mix-blend-mode: multiply;
        }

        .welcome-title {
            color: #00539B;
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

        .floating-label {
            position: relative;
            margin-bottom: 1.2rem;
        }

        .floating-label .form-control {
            padding: 12px 16px;
            height: 50px;
            background-color: #f8f9fa;
            border: 2px solid #e9ecef;
            border-radius: 10px;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            width: 100%;
        }

        .floating-label .form-control:focus {
            border-color: #00539B;
            box-shadow: 0 0 0 0.1rem rgba(0, 83, 155, 0.15);
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
            color: #00539B;
            font-weight: 500;
            background-color: #ffffff;
        }

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
            color: #00539B;
        }

        .password-toggle i {
            font-size: 16px;
        }

        .password-input-group .form-control {
            padding-right: 45px;
        }

        .btn-login {
            background: linear-gradient(135deg, #00539B 0%, #003D75 100%);
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
            margin-top: 1rem;
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
            background: linear-gradient(135deg, #003D75 0%, #002952 100%);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 83, 155, 0.3);
            color: white;
        }

        .btn-login:hover::before {
            left: 100%;
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .form-check {
            margin: 1rem 0;
        }

        .form-check-input:checked {
            background-color: #00539B;
            border-color: #00539B;
        }

        .form-check-label {
            color: #6c757d;
            font-size: 0.85rem;
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
                <h2 class="mb-4">Admin Panel</h2>
                <svg class="mb-4" width="200" height="200" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 2C6.48 2 2 6.48 2 12C2 17.52 6.48 22 12 22C17.52 22 22 17.52 22 12C22 6.48 17.52 2 12 2ZM12 5C13.66 5 15 6.34 15 8C15 9.66 13.66 11 12 11C10.34 11 9 9.66 9 8C9 6.34 10.34 5 12 5ZM12 19.2C9.5 19.2 7.29 17.92 6 15.98C6.03 13.99 10 12.9 12 12.9C13.99 12.9 17.97 13.99 18 15.98C16.71 17.92 14.5 19.2 12 19.2Z" fill="white"/>
                </svg>
                <p class="mb-0" style="font-size: 1.1rem;">Selamat datang di panel admin Yogya Toserba. Silakan masuk untuk mengelola sistem.</p>
            </div>

            <!-- Right Side -->
            <div class="login-right">
                <div class="logo-section text-center">
                    <img src="{{ asset('image/logo_yogya.png') }}" alt="Yogya Logo" style="height: 60px; margin-bottom: 1rem;">
                    <h2 class="welcome-title mb-2">Admin Login</h2>
                    <p class="welcome-subtitle mb-4">Silakan masuk ke akun admin Anda</p>
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.login.submit') }}" method="POST">
                    @csrf
                    <div class="form-group floating-label">
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" 
                            value="{{ old('email') }}" required autofocus>
                        <label class="floating-label-text">Email Address</label>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group floating-label password-input-group">
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" 
                            required>
                        <label class="floating-label-text">Password</label>
                        <span class="password-toggle" onclick="togglePassword('password')">
                            <i class="fas fa-eye" id="password-eye"></i>
                        </span>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="remember" name="remember">
                        <label class="form-check-label" for="remember">Remember me</label>
                    </div>

                    <button type="submit" class="btn btn-login">Login to Admin Panel</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const floatingInputs = document.querySelectorAll('.floating-label .form-control');
            
            floatingInputs.forEach(input => {
                // Check initial state
                if (input.value !== '') {
                    input.nextElementSibling.classList.add('active');
                }

                // Add event listeners
                input.addEventListener('focus', () => {
                    input.nextElementSibling.classList.add('active');
                });
                
                input.addEventListener('blur', () => {
                    if (input.value === '') {
                        input.nextElementSibling.classList.remove('active');
                    }
                });
            });
        });

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