<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi OTP - MyYOGYA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            background: #ffffff;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 10px;
            margin: 0;
        }
        
        .verification-container {
            width: 100%;
            max-width: 450px;
        }
        
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 15px 35px rgba(242, 107, 55, 0.15);
            background: #ffffff;
            overflow: hidden;
        }
        
        .card-header {
            background: linear-gradient(135deg, #F26B37 0%, #E55827 100%);
            color: white;
            padding: 25px 25px;
            text-align: center;
            border: none;
        }
        
        .logo {
            width: 50px;
            height: 50px;
            margin: 0 auto 15px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 20px;
        }
        
        .card-body {
            padding: 25px 25px;
        }
        
        .email-display {
            background: linear-gradient(135deg, #fff5f0 0%, #fff8f5 100%);
            padding: 12px 15px;
            border-radius: 10px;
            border-left: 4px solid #F26B37;
            margin-bottom: 20px;
        }
        
        .email-display small {
            color: #E55827;
            font-weight: 500;
        }
        
        .form-label {
            color: #F26B37;
            font-weight: 600;
            margin-bottom: 8px;
        }
        
        .form-control {
            border: 2px solid #e9ecef;
            border-radius: 10px;
            padding: 12px 15px;
            font-size: 1.3rem;
            letter-spacing: 0.3em;
            text-align: center;
            font-weight: 600;
            transition: all 0.3s ease;
            background: #f8f9fa;
        }
        
        .form-control:focus {
            border-color: #F26B37;
            box-shadow: 0 0 0 0.2rem rgba(242, 107, 55, 0.25);
            background: #ffffff;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #F26B37 0%, #E55827 100%);
            border: none;
            border-radius: 10px;
            padding: 12px 25px;
            font-weight: 600;
            font-size: 15px;
            transition: all 0.3s ease;
            box-shadow: 0 6px 15px rgba(242, 107, 55, 0.3);
        }
        
        .btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 10px 20px rgba(242, 107, 55, 0.4);
        }
        
        .btn-outline-secondary {
            border: 2px solid #F26B37;
            color: #F26B37;
            border-radius: 10px;
            padding: 8px 20px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .btn-outline-secondary:hover {
            background: #F26B37;
            color: white;
        }
        
        .countdown {
            font-size: 1.1rem;
            font-weight: bold;
            color: #F26B37;
        }
        
        .alert-success {
            background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
            border: 1px solid #28a745;
            border-radius: 10px;
        }
        
        .alert-danger {
            background: linear-gradient(135deg, #f8d7da 0%, #f5c6cb 100%);
            border: 1px solid #dc3545;
            border-radius: 10px;
        }
        
        .back-link {
            color: #F26B37;
            text-decoration: none;
            font-weight: 500;
        }
        
        .back-link:hover {
            color: #E55827;
        }
        
        .footer-text {
            color: #6c757d;
            margin-top: 15px;
            text-align: center;
        }
        
        @media (max-width: 576px) {
            .card-header {
                padding: 20px 15px;
            }
            
            .card-body {
                padding: 20px 15px;
            }
            
            .form-control {
                font-size: 1.1rem;
                padding: 10px 12px;
            }
        }
    </style>
</head>
<body>
    <div class="verification-container">
        <div class="card">
            <div class="card-header">
                <div class="logo">
                    <i class="fas fa-shield-alt"></i>
                </div>
                <h4 class="mb-1" style="font-weight: 700; font-size: 24px;">Verifikasi OTP</h4>
                <p class="mb-0" style="opacity: 0.9; font-weight: 300; font-size: 14px;">Masukkan kode 6 digit yang telah dikirim ke email Anda</p>
            </div>

            <div class="card-body">
                <div class="email-display">
                    <small>Kode dikirim ke:</small><br>
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
                        <div class="form-text mt-1">
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

                <div class="text-center mb-2">
                    <p class="text-muted mb-1">Tidak menerima kode?</p>
                    <form action="{{ route('password.resend.otp') }}" method="POST" style="display: inline;">
                        @csrf
                        <input type="hidden" name="email" value="{{ session('email') }}">
                        <button type="submit" class="btn btn-outline-secondary btn-sm" id="resendBtn">
                            <i class="fas fa-redo me-1"></i>Kirim Ulang
                        </button>
                    </form>
                </div>

                <div class="text-center">
                    <a href="{{ route('pelanggan.password.request') }}" class="back-link">
                        <i class="fas fa-arrow-left me-1"></i>Kembali
                    </a>
                </div>
            </div>
        </div>

        <div class="footer-text">
            <p>
                <small>&copy; {{ date('Y') }} MyYOGYA. Semua hak dilindungi.</small>
            </p>
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
