<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Kode - Yogya Toserba</title>
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
        .verify-card {
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
        .code-input {
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            letter-spacing: 8px;
            font-family: 'Courier New', monospace;
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
        .info-box {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 1rem;
            margin-bottom: 1.5rem;
            border-left: 4px solid #667eea;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="verify-card mx-auto">
            <div class="card-header">
                <i class="fas fa-shield-alt icon-large"></i>
                <h3 class="mb-0">Verifikasi Kode</h3>
                <p class="mb-0 mt-2 opacity-75">Masukkan kode verifikasi 6 digit yang telah dikirim ke email Anda</p>
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
                            {{ $error }}
                        @endforeach
                    </div>
                @endif

                <div class="info-box">
                    <i class="fas fa-info-circle text-primary me-2"></i>
                    <small class="text-muted">
                        Cek inbox email Anda untuk kode verifikasi 6 digit. Jika tidak ada, periksa folder spam.
                    </small>
                </div>

                <form method="POST" action="{{ route('pelanggan.verify.code') }}">
                    @csrf
                    <div class="mb-4">
                        <label for="email" class="form-label">
                            <i class="fas fa-envelope me-2"></i>Email Address
                        </label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" 
                               name="email" value="{{ old('email') }}" required autocomplete="email"
                               placeholder="Masukkan email Anda">
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="code" class="form-label">
                            <i class="fas fa-key me-2"></i>Kode Verifikasi
                        </label>
                        <input id="code" type="text" class="form-control code-input @error('code') is-invalid @enderror" 
                               name="code" value="{{ old('code') }}" required maxlength="6" 
                               placeholder="000000" pattern="[0-9]{6}">
                        @error('code')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        <div class="form-text">
                            <small>Masukkan 6 digit kode yang dikirim ke email Anda</small>
                        </div>
                    </div>

                    <div class="d-grid mb-4">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-check me-2"></i>
                            Verifikasi Kode
                        </button>
                    </div>
                </form>

                <div class="text-center">
                    <a href="{{ route('pelanggan.password.request') }}" class="back-link">
                        <i class="fas fa-redo me-2"></i>
                        Kirim Ulang Kode
                    </a>
                </div>

                <div class="text-center mt-3">
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
        // Auto format code input
        document.getElementById('code').addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '').substring(0, 6);
            e.target.value = value;
        });
    </script>
</body>
</html>
