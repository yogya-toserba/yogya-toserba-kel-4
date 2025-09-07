<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - MyYOGYA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
        }
        .card {
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            backdrop-filter: blur(10px);
            background: rgba(255,255,255,0.95);
        }
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 25px;
            padding: 12px 30px;
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }
        .form-control {
            border-radius: 10px;
            border: 2px solid #e9ecef;
            padding: 12px 15px;
        }
        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }
        .logo {
            width: 80px;
            height: 80px;
            margin: 0 auto 20px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 2rem;
        }
        .password-strength {
            height: 5px;
            border-radius: 3px;
            transition: all 0.3s ease;
        }
        .strength-weak { background: #dc3545; }
        .strength-medium { background: #ffc107; }
        .strength-strong { background: #28a745; }
        .password-toggle {
            cursor: pointer;
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            z-index: 10;
        }
        .password-input-wrapper {
            position: relative;
        }
        .email-display {
            background: #e3f2fd;
            padding: 10px 15px;
            border-radius: 8px;
            border-left: 4px solid #667eea;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <div class="card">
                    <div class="card-body p-5">
                        <div class="text-center mb-4">
                            <div class="logo">
                                <i class="fas fa-lock"></i>
                            </div>
                            <h4 class="card-title mb-2">Reset Password</h4>
                            <p class="text-muted">Masukkan password baru untuk akun Anda</p>
                        </div>

                        <div class="email-display mb-4">
                            <small class="text-muted">Reset password untuk:</small><br>
                            <strong>{{ session('email') }}</strong>
                        </div>

                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="fas fa-check-circle me-2"></i>
                                {{ session('success') }}
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

                        <form action="{{ route('password.reset') }}" method="POST" id="resetForm">
                            @csrf
                            <input type="hidden" name="email" value="{{ session('email') }}">
                            
                            <div class="mb-3">
                                <label for="password" class="form-label">
                                    <i class="fas fa-key me-1"></i>Password Baru
                                </label>
                                <div class="password-input-wrapper">
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                           id="password" name="password" 
                                           placeholder="Masukkan password baru" required>
                                    <i class="fas fa-eye password-toggle" id="togglePassword"></i>
                                </div>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="mt-2">
                                    <div class="password-strength" id="strengthBar"></div>
                                    <small class="form-text text-muted" id="strengthText">
                                        Password harus minimal 8 karakter
                                    </small>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">
                                    <i class="fas fa-key me-1"></i>Konfirmasi Password
                                </label>
                                <div class="password-input-wrapper">
                                    <input type="password" class="form-control" 
                                           id="password_confirmation" name="password_confirmation" 
                                           placeholder="Konfirmasi password baru" required>
                                    <i class="fas fa-eye password-toggle" id="togglePasswordConfirm"></i>
                                </div>
                                <div class="form-text" id="passwordMatch"></div>
                            </div>

                            <div class="d-grid mb-3">
                                <button type="submit" class="btn btn-primary" id="submitBtn">
                                    <i class="fas fa-check me-2"></i>Reset Password
                                </button>
                            </div>
                        </form>

                        <div class="text-center">
                            <a href="{{ route('pelanggan.login') }}" class="text-decoration-none">
                                <i class="fas fa-arrow-left me-1"></i>Kembali ke Login
                            </a>
                        </div>
                    </div>
                </div>

                <div class="text-center mt-4">
                    <p class="text-white-50">
                        <small>&copy; {{ date('Y') }} MyYOGYA. Semua hak dilindungi.</small>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Password toggle functionality
        document.getElementById('togglePassword').addEventListener('click', function() {
            const password = document.getElementById('password');
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            this.classList.toggle('fa-eye');
            this.classList.toggle('fa-eye-slash');
        });

        document.getElementById('togglePasswordConfirm').addEventListener('click', function() {
            const password = document.getElementById('password_confirmation');
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            this.classList.toggle('fa-eye');
            this.classList.toggle('fa-eye-slash');
        });

        // Password strength checker
        document.getElementById('password').addEventListener('input', function() {
            const password = this.value;
            const strengthBar = document.getElementById('strengthBar');
            const strengthText = document.getElementById('strengthText');
            
            let strength = 0;
            
            if (password.length >= 8) strength++;
            if (password.match(/[a-z]/)) strength++;
            if (password.match(/[A-Z]/)) strength++;
            if (password.match(/[0-9]/)) strength++;
            if (password.match(/[^a-zA-Z0-9]/)) strength++;
            
            strengthBar.className = 'password-strength';
            
            if (strength < 2) {
                strengthBar.classList.add('strength-weak');
                strengthText.textContent = 'Password lemah - gunakan kombinasi huruf, angka, dan simbol';
                strengthText.className = 'form-text text-danger';
            } else if (strength < 4) {
                strengthBar.classList.add('strength-medium');
                strengthText.textContent = 'Password sedang - tambahkan huruf besar/kecil dan simbol';
                strengthText.className = 'form-text text-warning';
            } else {
                strengthBar.classList.add('strength-strong');
                strengthText.textContent = 'Password kuat';
                strengthText.className = 'form-text text-success';
            }
            
            checkPasswordMatch();
        });

        // Password confirmation checker
        document.getElementById('password_confirmation').addEventListener('input', checkPasswordMatch);

        function checkPasswordMatch() {
            const password = document.getElementById('password').value;
            const confirm = document.getElementById('password_confirmation').value;
            const matchDiv = document.getElementById('passwordMatch');
            const submitBtn = document.getElementById('submitBtn');
            
            if (confirm.length > 0) {
                if (password === confirm) {
                    matchDiv.innerHTML = '<i class="fas fa-check text-success me-1"></i>Password cocok';
                    matchDiv.className = 'form-text text-success';
                    submitBtn.disabled = false;
                } else {
                    matchDiv.innerHTML = '<i class="fas fa-times text-danger me-1"></i>Password tidak cocok';
                    matchDiv.className = 'form-text text-danger';
                    submitBtn.disabled = true;
                }
            } else {
                matchDiv.innerHTML = '';
                submitBtn.disabled = password.length < 8;
            }
        }
    </script>
</body>
</html>
