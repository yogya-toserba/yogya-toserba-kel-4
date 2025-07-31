<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - MyYOGYA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('css/pelanggan/register.css') }}" rel="stylesheet">
</head>
<body>
    <div class="register-container">
        <div class="register-card">
            <!-- Left Side -->
            <div class="register-left text-center">
                <h2 class="mb-4">MyYOGYA</h2>
                <img src="{{ asset('image/shopping.png') }}" alt="Shopping Illustration" class="img-fluid">
                <p class="mb-0">Bergabunglah dengan jutaan pelanggan yang telah merasakan kemudahan berbelanja di platform kami. Daftar sekarang dan nikmati pengalaman berbelanja yang tak terlupakan!</p>
            </div>

            <!-- Right Side -->
            <div class="register-content">
                <div class="form-container">
                    <div class="logo-section">
                        <img src="{{ asset('image/logo_yogya.png') }}" alt="Yogya Logo">
                        <h2 class="welcome-title">Daftar Sekarang</h2>
                        <p class="welcome-subtitle">Buat akun baru untuk mulai berbelanja</p>
                    </div>

                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form action="" method="POST">
                        @csrf
                    
                    <!-- Nama Lengkap -->
                    <div class="form-group floating-label">
                        <input type="text" name="nama" class="form-control" required autofocus>
                        <label class="floating-label-text">Nama Lengkap</label>
                    </div>
                    
                    <!-- Email dan No Telepon -->
                    <div class="form-row">
                        <div class="form-group floating-label">
                            <input type="email" name="email" class="form-control" required>
                            <label class="floating-label-text">Alamat Email</label>
                        </div>
                        <div class="form-group floating-label phone-input-group">
                            <div class="phone-container">
                                <span class="country-code-fixed">🇮🇩 +62</span>
                                <input type="tel" name="no_telp" class="form-control phone-input" pattern="[1-9][0-9\-]*" title="Nomor tidak boleh dimulai dengan 0 setelah +62" required>
                            </div>
                            <label class="floating-label-text">No. Telp</label>
                        </div>
                    </div>
                    
                    <!-- Jenis Kelamin dan Tanggal Lahir -->
                    <div class="form-row">
                        <div class="form-group">
                            <label style="color: #6c757d; font-weight: 500; margin-bottom: 0.3rem; display: block; font-size: 0.9rem;">Jenis Kelamin</label>
                            <div class="gender-group-compact">
                                <div class="radio-option">
                                    <input type="radio" name="jenis_kelamin" value="L" id="laki" required>
                                    <label for="laki">Laki-laki</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" name="jenis_kelamin" value="P" id="perempuan" required>
                                    <label for="perempuan">Perempuan</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" name="jenis_kelamin" value="N" id="tidak_ingin" required>
                                    <label for="tidak_ingin">Tidak Ingin Memberitahukan</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group floating-label">
                            <input type="date" name="tanggal_lahir" class="form-control" required>
                            <label class="floating-label-text">Tanggal Lahir</label>
                        </div>
                    </div>
                    
                    <!-- Password dan Konfirmasi Password -->
                    <div class="form-row">
                        <div class="form-group floating-label password-input-group">
                            <input type="password" name="password" class="form-control" minlength="8" required>
                            <label class="floating-label-text">Kata Sandi (min. 8)</label>
                            <span class="password-toggle" onclick="togglePassword('password')">
                                <i class="fas fa-eye" id="password-eye"></i>
                            </span>
                        </div>
                        <div class="form-group floating-label password-input-group">
                            <input type="password" name="password_confirmation" class="form-control" minlength="8" required>
                            <label class="floating-label-text">Konfirmasi Kata Sandi</label>
                            <span class="password-toggle" onclick="togglePassword('password_confirmation')">
                                <i class="fas fa-eye" id="password_confirmation-eye"></i>
                            </span>
                        </div>
                    </div>
                    
                    <!-- Submit Button -->
                    <div class="form-group">
                        <button type="submit" class="btn btn-register">Daftar Sekarang</button>
                    </div>
                </form>

                <!-- Divider -->
                <div class="divider">
                    <hr>
                    <span>atau</span>
                    <hr>
                </div>

                <!-- Google Register Button -->
                <a href="" class="btn-google w-100">
                    <img src="https://www.svgrepo.com/show/475656/google-color.svg" alt="Google" width="18">
                    Daftar dengan Google
                </a>

                <div class="login-link">
                    <small>Sudah punya akun? <a href="{{ route('pelanggan.login') }}">Masuk sekarang!</a></small>
                </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Enhanced floating label functionality
        document.addEventListener('DOMContentLoaded', function() {
            const floatingInputs = document.querySelectorAll('.floating-label .form-control, .floating-label .phone-input');
            
            floatingInputs.forEach(input => {
                // Special handling for date inputs - label always stays on top
                if (input.type === 'date') {
                    const label = input.closest('.floating-label').querySelector('.floating-label-text');
                    label.classList.add('active');
                    return; // Skip other event listeners for date inputs
                }
                
                // Add event listeners for other inputs
                input.addEventListener('focus', () => {
                    const label = input.closest('.floating-label').querySelector('.floating-label-text');
                    label.classList.add('active');
                });
                
                input.addEventListener('blur', () => {
                    const label = input.closest('.floating-label').querySelector('.floating-label-text');
                    if (input.value.length === 0) {
                        label.classList.remove('active');
                    }
                });
                
                input.addEventListener('input', () => {
                    const label = input.closest('.floating-label').querySelector('.floating-label-text');
                    if (input.value.length > 0) {
                        label.classList.add('active');
                    }
                });
                
                input.addEventListener('change', () => {
                    const label = input.closest('.floating-label').querySelector('.floating-label-text');
                    if (input.value.length > 0) {
                        label.classList.add('active');
                    }
                });
            });

            // Phone number validation with auto formatting - only numbers and not starting with 0
            const phoneInput = document.querySelector('input[name="no_telp"]');
            if (phoneInput) {
                phoneInput.addEventListener('input', function(e) {
                    // Remove all non-numeric characters
                    let value = this.value.replace(/[^0-9]/g, '');
                    
                    // Prevent starting with 0
                    if (value.charAt(0) === '0') {
                        value = value.substring(1);
                        this.setCustomValidity('Nomor HP setelah +62 tidak boleh dimulai dengan 0');
                    } else {
                        this.setCustomValidity('');
                    }
                    
                    // Auto format with dashes: XXX-XXXX-XXXX (flexible length)
                    let formattedValue = '';
                    if (value.length > 0) {
                        if (value.length <= 3) {
                            formattedValue = value;
                        } else if (value.length <= 7) {
                            formattedValue = value.slice(0, 3) + '-' + value.slice(3);
                        } else {
                            formattedValue = value.slice(0, 3) + '-' + value.slice(3, 7) + '-' + value.slice(7);
                        }
                    }
                    
                    this.value = formattedValue;
                    
                    // Handle floating label for phone input
                    const label = this.closest('.floating-label').querySelector('.floating-label-text');
                    if (this.value.length > 0) {
                        label.classList.add('active');
                    }
                });
                
                // Handle focus and blur for phone input
                phoneInput.addEventListener('focus', function() {
                    const label = this.closest('.floating-label').querySelector('.floating-label-text');
                    label.classList.add('active');
                });
                
                phoneInput.addEventListener('blur', function() {
                    const label = this.closest('.floating-label').querySelector('.floating-label-text');
                    if (this.value.length === 0) {
                        label.classList.remove('active');
                    }
                    
                    // Final validation on blur
                    const numericValue = this.value.replace(/[^0-9]/g, '');
                    if (numericValue.length > 0 && numericValue.charAt(0) === '0') {
                        this.setCustomValidity('Nomor HP setelah +62 tidak boleh dimulai dengan 0');
                    }
                });
                
                // Handle keypress to prevent 0 as first character
                phoneInput.addEventListener('keypress', function(e) {
                    // Get current numeric value without formatting
                    const currentNumeric = this.value.replace(/[^0-9]/g, '');
                    
                    // If input is empty and user tries to type 0, prevent it
                    if (currentNumeric.length === 0 && e.key === '0') {
                        e.preventDefault();
                    }
                });
            }

            // Password validation
            const passwordInput = document.querySelector('input[name="password"]');
            const confirmPasswordInput = document.querySelector('input[name="password_confirmation"]');
            
            function validatePassword() {
                const password = passwordInput.value;
                const confirmPassword = confirmPasswordInput.value;
                
                // Check minimum length
                if (password.length > 0 && password.length < 8) {
                    passwordInput.setCustomValidity('Password harus minimal 8 karakter');
                } else {
                    passwordInput.setCustomValidity('');
                }
                
                // Check password match
                if (confirmPassword.length > 0 && password !== confirmPassword) {
                    confirmPasswordInput.setCustomValidity('Konfirmasi password tidak sesuai');
                } else {
                    confirmPasswordInput.setCustomValidity('');
                }
            }

            if (passwordInput) {
                passwordInput.addEventListener('input', validatePassword);
            }
            if (confirmPasswordInput) {
                confirmPasswordInput.addEventListener('input', validatePassword);
            }
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
