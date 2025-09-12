<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Kode - MyYOGYA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap');
        
        * {
            font-family: 'Montserrat', sans-serif;
        }
        
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            margin: 0;
            padding: 0;
            min-height: 100vh;
        }

        .verify-container {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 15px;
        }

        .verify-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            padding: 2rem;
            width: 100%;
            max-width: 450px;
            text-align: center;
        }

        .logo-section {
            margin-bottom: 2rem;
        }

        .logo {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            font-size: 2rem;
            color: white;
        }

        .verify-title {
            color: #333;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .verify-subtitle {
            color: #666;
            font-size: 0.9rem;
            margin-bottom: 1rem;
        }

        .code-input {
            width: 100%;
            padding: 15px;
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            font-size: 1.5rem;
            text-align: center;
            letter-spacing: 0.5rem;
            margin-bottom: 1rem;
            font-weight: 600;
        }

        .code-input:focus {
            border-color: #667eea;
            outline: none;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .btn-verify {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            color: white;
            padding: 15px;
            border-radius: 10px;
            font-weight: 600;
            width: 100%;
            margin-bottom: 1rem;
        }

        .btn-verify:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
        }

        .resend-link {
            color: #667eea;
            text-decoration: none;
            font-weight: 500;
        }

        .resend-link:hover {
            text-decoration: underline;
        }

        .alert {
            border-radius: 10px;
            margin-bottom: 1rem;
        }

        .email-info {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 1rem;
            margin-bottom: 1rem;
            font-size: 0.9rem;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="verify-container">
        <div class="verify-card">
            <div class="logo-section">
                <div class="logo">
                    <i class="fas fa-shield-alt"></i>
                </div>
                <h4 class="verify-title">Verifikasi Kode OTP</h4>
                <p class="verify-subtitle">Masukkan kode 6 digit yang telah dikirim ke email Anda</p>
            </div>

            @if(session('status'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>
                    {{ session('status') }}
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

            <div class="email-info">
                <i class="fas fa-envelope me-2"></i>
                Kode dikirim ke: <strong>{{ $email ?? 'Email Anda' }}</strong>
            </div>

            <form action="{{ route('password.verify') }}" method="POST">
                @csrf
                <input type="hidden" name="email" value="{{ $email }}">
                
                <div class="mb-3">
                    <input type="text" 
                           class="form-control code-input @error('code') is-invalid @enderror" 
                           id="code" 
                           name="code" 
                           maxlength="6"
                           placeholder="000000"
                           required 
                           autofocus>
                    
                    @error('code')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-verify">
                    <i class="fas fa-check me-2"></i>Verifikasi Kode
                </button>
            </form>

            <div class="text-center">
                <p class="mb-2">Tidak menerima kode?</p>
                <a href="{{ route('password.request') }}" class="resend-link">
                    <i class="fas fa-redo me-1"></i>Kirim Ulang Kode
                </a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Auto-format code input
        document.getElementById('code').addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length > 6) {
                value = value.substring(0, 6);
            }
            e.target.value = value;
        });

        // Auto submit when 6 digits entered
        document.getElementById('code').addEventListener('keyup', function(e) {
            if (e.target.value.length === 6) {
                // Auto submit after short delay
                setTimeout(() => {
                    document.querySelector('form').submit();
                }, 500);
            }
        });
    </script>
</body>
</html>
