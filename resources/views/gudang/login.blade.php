<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Gudang - MyYOGYA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('css/gudang/login.css') }}" rel="stylesheet">
</head>

<body>
    <div class="container login-container">
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

                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                <form action="" method="POST" id="gudangLoginForm">
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

        // Form validation with warehouse-specific messages
        document.getElementById('gudangLoginForm').addEventListener('submit', function(e) {
            const idGudang = document.querySelector('input[name="id_gudang"]').value;
            const password = document.querySelector('input[name="password"]').value;
            
            if (!idGudang || !password) {
                e.preventDefault();
                alert('Mohon lengkapi ID Gudang dan password untuk mengakses sistem gudang.');
                return false;
            }
            
            // Validate ID Gudang format (4-8 digits)
            if (!/^[0-9]{4,8}$/.test(idGudang)) {
                e.preventDefault();
                alert('ID Gudang harus berupa 4-8 digit angka.');
                document.querySelector('input[name="id_gudang"]').focus();
                return false;
            }
            
            // Add loading state to button
            const submitBtn = document.querySelector('.btn-login');
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Memverifikasi akses...';
            submitBtn.disabled = true;
        });
    </script>
</body>
</html>
