<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi OTP - MyYOGYA</title>
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
        .btn-outline-secondary {
            border-radius: 25px;
            padding: 12px 30px;
        }
        .form-control {
            border-radius: 10px;
            border: 2px solid #e9ecef;
            padding: 12px 15px;
            font-size: 1.2rem;
            letter-spacing: 0.5em;
            text-align: center;
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
        .countdown {
            font-size: 1.1rem;
            font-weight: bold;
            color: #dc3545;
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
                                <i class="fas fa-shield-alt"></i>
                            </div>
                            <h4 class="card-title mb-2">Verifikasi OTP</h4>
                            <p class="text-muted">Masukkan kode 6 digit yang telah dikirim ke email Anda</p>
                        </div>

                        <div class="email-display mb-4">
                            <small class="text-muted">Kode dikirim ke:</small><br>
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

                        <form action="{{ route('password.verify.otp') }}" method="POST" id="otpForm">
                            @csrf
                            <input type="hidden" name="email" value="{{ session('email') }}">
                            
                            <div class="mb-3">
                                <label for="otp" class="form-label">
                                    <i class="fas fa-lock me-1"></i>Kode OTP
                                </label>
                                <input type="text" class="form-control @error('otp') is-invalid @enderror" 
                                       id="otp" name="otp" value="{{ old('otp') }}" 
                                       placeholder="000000" maxlength="6" pattern="[0-9]{6}" required>
                                @error('otp')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">
                                    <i class="fas fa-info-circle me-1"></i>
                                    Kode akan kedaluwarsa dalam <span class="countdown" id="countdown">15:00</span>
                                </div>
                            </div>

                            <div class="d-grid mb-3">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-check me-2"></i>Verifikasi Kode
                                </button>
                            </div>
                        </form>

                        <div class="text-center mb-3">
                            <p class="text-muted mb-2">Tidak menerima kode?</p>
                            <form action="{{ route('password.resend.otp') }}" method="POST" style="display: inline;">
                                @csrf
                                <input type="hidden" name="email" value="{{ session('email') }}">
                                <button type="submit" class="btn btn-outline-secondary btn-sm" id="resendBtn">
                                    <i class="fas fa-redo me-1"></i>Kirim Ulang
                                </button>
                            </form>
                        </div>

                        <div class="text-center">
                            <a href="{{ route('password.request') }}" class="text-decoration-none">
                                <i class="fas fa-arrow-left me-1"></i>Kembali
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
        // Auto-format OTP input
        document.getElementById('otp').addEventListener('input', function(e) {
            // Only allow numbers
            this.value = this.value.replace(/[^0-9]/g, '');
            
            // Auto submit when 6 digits entered
            if (this.value.length === 6) {
                document.getElementById('otpForm').submit();
            }
        });

        // Countdown timer
        let timeLeft = 15 * 60; // 15 minutes in seconds
        const countdownElement = document.getElementById('countdown');
        const resendBtn = document.getElementById('resendBtn');

        function updateCountdown() {
            const minutes = Math.floor(timeLeft / 60);
            const seconds = timeLeft % 60;
            
            countdownElement.textContent = 
                String(minutes).padStart(2, '0') + ':' + 
                String(seconds).padStart(2, '0');
            
            if (timeLeft <= 0) {
                countdownElement.textContent = '00:00';
                countdownElement.style.color = '#dc3545';
                resendBtn.disabled = false;
                resendBtn.innerHTML = '<i class="fas fa-redo me-1"></i>Kirim Ulang (Kode Kedaluwarsa)';
                clearInterval(timer);
            } else if (timeLeft <= 60) {
                countdownElement.style.color = '#dc3545';
            }
            
            timeLeft--;
        }

        // Start countdown
        const timer = setInterval(updateCountdown, 1000);
        updateCountdown(); // Run immediately

        // Disable resend button initially
        resendBtn.disabled = false; // Allow immediate resend for testing
    </script>
</body>
</html>
