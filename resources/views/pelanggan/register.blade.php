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

                    <form action="" method="POST" id="registerForm">
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
                        <div class="form-group floating-label">
                            <input type="tel" name="no_telp" class="form-control" pattern="[0-9\-]*" title="Masukkan nomor telepon yang valid" required>
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
                                    <input type="radio" na  me="jenis_kelamin" value="N" id="tidak_ingin" required>
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
            const floatingInputs = document.querySelectorAll('.floating-label .form-control');
            
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

            // Phone number validation with auto formatting - allow all numbers including starting with 0
            const phoneInput = document.querySelector('input[name="no_telp"]');
            if (phoneInput) {
                phoneInput.addEventListener('input', function(e) {
                    // Remove all non-numeric characters
                    let value = this.value.replace(/[^0-9]/g, '');
                    
                    // Clear any previous validation messages
                    this.setCustomValidity('');
                    
                    // Auto format with dashes: XXXX-XXXX-XXXX (flexible length)
                    let formattedValue = '';
                    if (value.length > 0) {
                        if (value.length <= 4) {
                            formattedValue = value;
                        } else if (value.length <= 8) {
                            formattedValue = value.slice(0, 4) + '-' + value.slice(4);
                        } else {
                            formattedValue = value.slice(0, 4) + '-' + value.slice(4, 8) + '-' + value.slice(8);
                        }
                    }
                    
                    this.value = formattedValue;
                    
                    // Handle floating label for phone input
                    const label = this.closest('.floating-label').querySelector('.floating-label-text');
                    if (this.value.length > 0) {
                        label.classList.add('active');
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

            // Age validation - minimum 17 years old
            const dateInput = document.querySelector('input[name="tanggal_lahir"]');
            if (dateInput) {
                function validateAge() {
                    const birthDate = new Date(dateInput.value);
                    const today = new Date();
                    const age = today.getFullYear() - birthDate.getFullYear();
                    const monthDiff = today.getMonth() - birthDate.getMonth();
                    
                    // Calculate exact age
                    let exactAge = age;
                    if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
                        exactAge--;
                    }
                    
                    if (dateInput.value && exactAge < 17) {
                        dateInput.setCustomValidity('Anda harus berumur minimal 17 tahun untuk mendaftar');
                        return false;
                    } else {
                        dateInput.setCustomValidity('');
                        return true;
                    }
                }
                
                dateInput.addEventListener('change', validateAge);
                dateInput.addEventListener('blur', validateAge);
                
                // Set max date to today minus 17 years for better UX
                const maxDate = new Date();
                maxDate.setFullYear(maxDate.getFullYear() - 17);
                dateInput.max = maxDate.toISOString().split('T')[0];
            }

            // Form submission validation
            const registerForm = document.getElementById('registerForm');
            if (registerForm) {
                registerForm.addEventListener('submit', function(e) {
                    // Check age validation
                    const dateInput = document.querySelector('input[name="tanggal_lahir"]');
                    if (dateInput && dateInput.value) {
                        const birthDate = new Date(dateInput.value);
                        const today = new Date();
                        const age = today.getFullYear() - birthDate.getFullYear();
                        const monthDiff = today.getMonth() - birthDate.getMonth();
                        
                        let exactAge = age;
                        if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
                            exactAge--;
                        }
                        
                        if (exactAge < 17) {
                            e.preventDefault();
                            alert('Anda harus berumur minimal 17 tahun untuk mendaftar akun.');
                            dateInput.focus();
                            return false;
                        }
                    }
                    
                    // Check if all required fields are filled and valid
                    const requiredFields = registerForm.querySelectorAll('[required]');
                    for (let field of requiredFields) {
                        if (!field.value || !field.checkValidity()) {
                            e.preventDefault();
                            field.focus();
                            return false;
                        }
                    }
                });
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
