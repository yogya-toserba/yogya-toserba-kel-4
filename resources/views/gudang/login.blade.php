<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login Gudang - MyYOGYA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('css/gudang/login.css') }}" rel="stylesheet">
    <style>
        /* Loading Overlay Styles */
        .loading-overlay, .success-overlay, .error-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.8);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            backdrop-filter: blur(5px);
        }

        .loading-content, .success-content, .error-content {
            background: white;
            padding: 2rem;
            border-radius: 15px;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            max-width: 400px;
            width: 90%;
        }

        /* Loading Spinner */
        .loading-spinner {
            position: relative;
            width: 80px;
            height: 80px;
            margin: 0 auto 1rem;
        }

        .spinner-ring {
            position: absolute;
            width: 100%;
            height: 100%;
            border: 4px solid transparent;
            border-top: 4px solid #F26B37;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        .spinner-ring:nth-child(2) {
            animation-delay: -0.25s;
            border-top-color: #00539B;
        }

        .spinner-ring:nth-child(3) {
            animation-delay: -0.5s;
            border-top-color: #28a745;
        }

        .spinner-ring:nth-child(4) {
            animation-delay: -0.75s;
            border-top-color: #ffc107;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Success Animation */
        .success-icon {
            color: #28a745;
            font-size: 4rem;
            margin-bottom: 1rem;
            animation: successBounce 0.6s ease-out;
        }

        @keyframes successBounce {
            0% { transform: scale(0); }
            50% { transform: scale(1.2); }
            100% { transform: scale(1); }
        }

        .progress-bar {
            width: 100%;
            height: 4px;
            background: #e9ecef;
            border-radius: 2px;
            overflow: hidden;
            margin-top: 1rem;
        }

        .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, #28a745, #20c997);
            width: 0;
            animation: progressFill 2s ease-out forwards;
        }

        @keyframes progressFill {
            0% { width: 0; }
            100% { width: 100%; }
        }

        /* Error Animation */
        .error-icon {
            color: #dc3545;
            font-size: 4rem;
            margin-bottom: 1rem;
            animation: errorShake 0.6s ease-out;
        }

        @keyframes errorShake {
            0%, 100% { transform: translateX(0); }
            10%, 30%, 50%, 70%, 90% { transform: translateX(-5px); }
            20%, 40%, 60%, 80% { transform: translateX(5px); }
        }

        /* Fade animations */
        .fade-in {
            animation: fadeIn 0.3s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .fade-out {
            animation: fadeOut 0.3s ease-out forwards;
        }

        @keyframes fadeOut {
            from { opacity: 1; transform: translateY(0); }
            to { opacity: 0; transform: translateY(20px); }
        }
    </style>
</head>

<body>
    <div class="container login-container">
        <!-- Loading Overlay -->
        <div id="loadingOverlay" class="loading-overlay">
            <div class="loading-content">
                <div class="loading-spinner">
                    <div class="spinner-ring"></div>
                    <div class="spinner-ring"></div>
                    <div class="spinner-ring"></div>
                    <div class="spinner-ring"></div>
                </div>
                <h4 id="loadingText">Memverifikasi akses...</h4>
                <p id="loadingSubtext">Mohon tunggu sebentar</p>
            </div>
        </div>

        <!-- Success Animation -->
        <div id="successOverlay" class="success-overlay">
            <div class="success-content">
                <div class="success-icon">
                    <i class="fas fa-check-circle"></i>
                </div>
                <h4>Login Berhasil!</h4>
                <p>Mengarahkan ke dashboard...</p>
                <div class="progress-bar">
                    <div class="progress-fill"></div>
                </div>
            </div>
        </div>

        <!-- Error Animation -->
        <div id="errorOverlay" class="error-overlay">
            <div class="error-content">
                <div class="error-icon">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
                <h4>Login Gagal!</h4>
                <p id="errorMessage">ID Gudang atau password tidak valid</p>
                <button class="btn btn-outline-danger" onclick="hideErrorOverlay()">
                    <i class="fas fa-redo"></i> Coba Lagi
                </button>
            </div>
        </div>
        <div class="login-card">
            <!-- Left Side - Orange Section -->
            <div class="login-left text-center">
                <h2 class="mb-4">MyYOGYA</h2>
                <div class="warehouse-icon">
                    <i class="fas fa-warehouse"></i>
                </div>
                <h3 class="system-title">Sistem Gudang</h3>
                <p class="mb-0">Sistem manajemen gudang terintegrasi untuk mengelola inventori, stok, dan distribusi barang dengan efisien dan akurat.</p>
                
                <!-- Warehouse Stats Animation -->
                <div class="warehouse-stats">
                    <div class="stat-item">
                        <i class="fas fa-boxes"></i>
                        <span>Inventori Real-time</span>
                    </div>
                    <div class="stat-item">
                        <i class="fas fa-truck"></i>
                        <span>Distribusi Otomatis</span>
                    </div>
                    <div class="stat-item">
                        <i class="fas fa-chart-line"></i>
                        <span>Analytics Dashboard</span>
                    </div>
                </div>
            </div>

            <!-- Right Side - Login Form -->
            <div class="login-right">
                <div class="logo-section text-center">
                    <img src="{{ asset('image/logo_yogya.png') }}" alt="Yogya Logo">
                    <h2 class="welcome-title">Portal Gudang</h2>
                    <p class="welcome-subtitle">Akses sistem manajemen gudang</p>
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            {{ $error }}
                        @endforeach
                    </div>
                @endif

                <form action="{{ route('gudang.login.submit') }}" method="POST" id="gudangLoginForm">
                    @csrf
                    <div class="form-group floating-label">
                        <input type="number" name="id_gudang" class="form-control" required autofocus pattern="[0-9]{4,8}" title="Masukkan ID Gudang (4-8 digit)">
                        <label class="floating-label-text">
                            <i class="fas fa-id-card"></i>
                            ID Gudang
                        </label>
                    </div>
                    
                    <div class="form-group floating-label password-input-group">
                        <input type="password" name="password" class="form-control" required>
                        <label class="floating-label-text">
                            <i class="fas fa-lock"></i>
                            Kata Sandi
                        </label>
                        <span class="password-toggle" onclick="togglePassword('password')">
                            <i class="fas fa-eye" id="password-eye"></i>
                        </span>
                    </div>

                    <!-- Forgot Password Section -->
                    <div class="form-options">
                        <a href="#" class="forgot-link">Lupa kata sandi?</a>
                    </div>
                    
                    <div class="form-group">
                        <button type="submit" class="btn btn-login w-100">
                            <i class="fas fa-sign-in-alt"></i>
                            Masuk ke Sistem Gudang
                        </button>
                    </div>
                </form>

                <!-- Security Notice -->
                <div class="security-notice">
                    <i class="fas fa-shield-alt"></i>
                    <small>Sistem ini hanya untuk staff gudang yang berwenang. Semua aktivitas tercatat dan dipantau.</small>
                </div>

                <!-- Quick Actions -->
                <div class="quick-actions">
                    <div class="quick-action-item">
                        <i class="fas fa-headset"></i>
                        <span>Bantuan IT</span>
                    </div>
                    <a href="{{ route('gudang.manual') }}" class="quick-action-item">
                        <i class="fas fa-book"></i>
                        <span>Manual Sistem</span>
                    </a>
                    <div class="quick-action-item">
                        <i class="fas fa-phone"></i>
                        <span>Kontak Admin</span>
                    </div>
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

            // Warehouse stats animation
            const statsItems = document.querySelectorAll('.stat-item');
            statsItems.forEach((item, index) => {
                item.style.animationDelay = `${index * 0.3}s`;
            });

            // Quick actions hover effect
            const quickActions = document.querySelectorAll('.quick-action-item');
            quickActions.forEach(action => {
                action.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-3px)';
                });
                
                action.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0)';
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

        // Form validation with warehouse-specific messages and animations
        document.getElementById('gudangLoginForm').addEventListener('submit', function(e) {
            const idGudang = document.querySelector('input[name="id_gudang"]').value;
            const password = document.querySelector('input[name="password"]').value;
            
            if (!idGudang || !password) {
                e.preventDefault();
                showErrorAnimation('Mohon lengkapi ID Gudang dan password untuk mengakses sistem gudang.');
                return false;
            }
            
            // Validate ID Gudang format (4-8 digits)
            if (!/^[0-9]{4,8}$/.test(idGudang)) {
                e.preventDefault();
                showErrorAnimation('ID Gudang harus berupa 4-8 digit angka.');
                document.querySelector('input[name="id_gudang"]').focus();
                return false;
            }
            
            // Show loading animation
            showLoadingAnimation();
            
            // Submit form via AJAX for better control
            e.preventDefault();
            submitLoginForm();
        });

        // Function to submit form via AJAX
        function submitLoginForm() {
            const form = document.getElementById('gudangLoginForm');
            const formData = new FormData(form);
            
            fetch(form.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || document.querySelector('input[name="_token"]').value
                }
            })
            .then(response => response.json())
            .then(data => {
                hideLoadingAnimation();
                
                if (data.success) {
                    showSuccessAnimation(data.message || 'Login berhasil!');
                    setTimeout(() => {
                        window.location.href = data.redirect || '{{ route("gudang.dashboard") }}';
                    }, 2000);
                } else {
                    showErrorAnimation(data.message || 'Login gagal. Periksa kembali ID Gudang dan password Anda.');
                }
            })
            .catch(error => {
                hideLoadingAnimation();
                
                // If AJAX fails, submit form normally but still show loading
                showLoadingAnimation();
                setTimeout(() => {
                    form.submit();
                }, 1000);
            });
        }

        // Animation functions
        function showLoadingAnimation() {
            const overlay = document.getElementById('loadingOverlay');
            overlay.style.display = 'flex';
            overlay.classList.add('fade-in');
        }

        function hideLoadingAnimation() {
            const overlay = document.getElementById('loadingOverlay');
            overlay.classList.add('fade-out');
            setTimeout(() => {
                overlay.style.display = 'none';
                overlay.classList.remove('fade-in', 'fade-out');
            }, 300);
        }

        function showSuccessAnimation(message = 'Login berhasil!') {
            const overlay = document.getElementById('successOverlay');
            const messageElement = overlay.querySelector('p');
            messageElement.textContent = message;
            
            overlay.style.display = 'flex';
            overlay.classList.add('fade-in');
        }

        function showErrorAnimation(message = 'Login gagal!') {
            const overlay = document.getElementById('errorOverlay');
            const messageElement = document.getElementById('errorMessage');
            messageElement.textContent = message;
            
            overlay.style.display = 'flex';
            overlay.classList.add('fade-in');
        }

        function hideErrorOverlay() {
            const overlay = document.getElementById('errorOverlay');
            overlay.classList.add('fade-out');
            setTimeout(() => {
                overlay.style.display = 'none';
                overlay.classList.remove('fade-in', 'fade-out');
            }, 300);
        }

        // Check for server-side errors and show error animation
        document.addEventListener('DOMContentLoaded', function() {
            const errorAlert = document.querySelector('.alert-danger');
            if (errorAlert) {
                const errorText = errorAlert.textContent.trim();
                showErrorAnimation(errorText);
                errorAlert.style.display = 'none';
            }
        });
    </script>
</body>
</html>
