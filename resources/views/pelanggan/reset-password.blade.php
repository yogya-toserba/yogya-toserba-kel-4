<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - Yogya Toserba</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .reset-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            overflow: hidden;
            max-width: 450px;
            width: 100%;
        }
        .card-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            text-align: center;
            padding: 2rem 1.5rem 1.5rem;
            border: none;
        }
        .card-body {
            padding: 2rem 1.5rem;
        }
        .form-control {
            border-radius: 10px;
            border: 2px solid #e1e5e9;
            padding: 12px 16px;
            font-size: 16px;
            transition: all 0.3s ease;
        }
        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 10px;
            padding: 12px 30px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s ease;
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(102, 126, 234, 0.4);
        }
        .alert {
            border-radius: 10px;
            border: none;
        }
        .back-link {
            color: #667eea;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        .back-link:hover {
            color: #764ba2;
            text-decoration: underline;
        }
        .icon-large {
            font-size: 3rem;
            margin-bottom: 1rem;
        }
        .password-requirements {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 1rem;
            margin-bottom: 1.5rem;
            border-left: 4px solid #28a745;
        }
        .password-strength {
            margin-top: 0.5rem;
        }
        .password-strength-bar {
            height: 4px;
            border-radius: 2px;
            background: #e9ecef;
            overflow: hidden;
        }
        .password-strength-fill {
            height: 100%;
            transition: all 0.3s ease;
            border-radius: 2px;
        }
        .strength-weak { background: #dc3545; width: 25%; }
        .strength-fair { background: #fd7e14; width: 50%; }
        .strength-good { background: #ffc107; width: 75%; }
        .strength-strong { background: #28a745; width: 100%; }
    </style>
</head>
<body>
    <div class="container">
        <div class="reset-card mx-auto">
            <div class="card-header">
                <i class="fas fa-lock icon-large"></i>
                <h3 class="mb-0">Reset Password</h3>
                <p class="mb-0 mt-2 opacity-75">Masukkan password baru Anda</p>
            </div>
            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        <i class="fas fa-check-circle me-2"></i>
                        {{ session('status') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger" role="alert">
                        <i class="fas fa-exclamation-circle me-2"></i>
                        @foreach ($errors->all() as $error)
                            {{ $error }}<br>
                        @endforeach
                    </div>
                @endif

                <div class="password-requirements">
                    <i class="fas fa-info-circle text-success me-2"></i>
                    <small class="text-muted">
                        <strong>Persyaratan Password:</strong><br>
                        • Minimal 8 karakter<br>
                        • Kombinasi huruf dan angka direkomendasikan
                    </small>
                </div>

                <form method="POST" action="{{ route('pelanggan.password.update') }}">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                    <input type="hidden" name="email" value="{{ $email }}">

                    <div class="mb-4">
                        <label for="email_display" class="form-label">
                            <i class="fas fa-envelope me-2"></i>Email
                        </label>
                        <input type="email" class="form-control" value="{{ $email }}" readonly>
                    </div>

                    <div class="mb-4">
                        <label for="password" class="form-label">
                            <i class="fas fa-lock me-2"></i>Password Baru
                        </label>
                        <div class="position-relative">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" 
                                   name="password" required autocomplete="new-password"
                                   placeholder="Masukkan password baru">
                            <button type="button" class="btn btn-outline-secondary position-absolute end-0 top-0" 
                                    style="border-top-left-radius: 0; border-bottom-left-radius: 0; height: 100%;"
                                    onclick="togglePassword('password')">
                                <i class="fas fa-eye" id="password-eye"></i>
                            </button>
                        </div>
                        <div class="password-strength">
                            <div class="password-strength-bar">
                                <div class="password-strength-fill" id="password-strength-fill"></div>
                            </div>
                            <small class="text-muted" id="password-strength-text">Masukkan password</small>
                        </div>
                        @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="password-confirm" class="form-label">
                            <i class="fas fa-lock me-2"></i>Konfirmasi Password
                        </label>
                        <div class="position-relative">
                            <input id="password-confirm" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" 
                                   name="password_confirmation" required autocomplete="new-password"
                                   placeholder="Ulangi password baru">
                            <button type="button" class="btn btn-outline-secondary position-absolute end-0 top-0" 
                                    style="border-top-left-radius: 0; border-bottom-left-radius: 0; height: 100%;"
                                    onclick="togglePassword('password-confirm')">
                                <i class="fas fa-eye" id="password-confirm-eye"></i>
                            </button>
                        </div>
                        @error('password_confirmation')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="d-grid mb-4">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>
                            Reset Password
                        </button>
                    </div>
                </form>

                <div class="text-center">
                    <a href="{{ route('pelanggan.login') }}" class="back-link">
                        <i class="fas fa-arrow-left me-2"></i>
                        Kembali ke Login
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function togglePassword(fieldId) {
            const field = document.getElementById(fieldId);
            const eyeIcon = document.getElementById(fieldId + '-eye');
            
            if (field.type === 'password') {
                field.type = 'text';
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            } else {
                field.type = 'password';
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
            }
        }

        // Password strength checker
        document.getElementById('password').addEventListener('input', function(e) {
            const password = e.target.value;
            const strengthFill = document.getElementById('password-strength-fill');
            const strengthText = document.getElementById('password-strength-text');
            
            let strength = 0;
            let text = 'Lemah';
            let className = 'strength-weak';
            
            if (password.length >= 8) strength++;
            if (/[a-z]/.test(password)) strength++;
            if (/[A-Z]/.test(password)) strength++;
            if (/[0-9]/.test(password)) strength++;
            if (/[^A-Za-z0-9]/.test(password)) strength++;
            
            switch(strength) {
                case 0:
                case 1:
                    text = 'Sangat Lemah';
                    className = 'strength-weak';
                    break;
                case 2:
                    text = 'Lemah';
                    className = 'strength-weak';
                    break;
                case 3:
                    text = 'Cukup';
                    className = 'strength-fair';
                    break;
                case 4:
                    text = 'Kuat';
                    className = 'strength-good';
                    break;
                case 5:
                    text = 'Sangat Kuat';
                    className = 'strength-strong';
                    break;
            }
            
            strengthFill.className = 'password-strength-fill ' + className;
            strengthText.textContent = text;
        });
    </script>
</body>
</html>
