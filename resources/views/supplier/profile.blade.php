@extends('supplier.layout')

@section('title', 'Profil Supplier')
@section('page-title', 'Profil Saya')

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="fas fa-user-edit"></i> Edit Profil</h5>
            </div>
            <div class="card-body">
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('supplier.profile.update') }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="nama_lengkap" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('nama_lengkap') is-invalid @enderror" 
                                       id="nama_lengkap" name="nama_lengkap" value="{{ old('nama_lengkap', $supplier->nama_lengkap) }}" required>
                                @error('nama_lengkap')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="telepon" class="form-label">Telepon</label>
                                <input type="text" class="form-control @error('telepon') is-invalid @enderror" 
                                       id="telepon" name="telepon" value="{{ old('telepon', $supplier->telepon) }}">
                                @error('telepon')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" 
                               id="email" name="email" value="{{ old('email', $supplier->email) }}" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <hr class="my-4">

                    <h6 class="text-secondary mb-3"><i class="fas fa-lock"></i> Ubah Password</h6>
                    <p class="text-muted small">Kosongkan jika tidak ingin mengubah password</p>

                    <div class="mb-3">
                        <label for="current_password" class="form-label">Password Saat Ini</label>
                        <input type="password" class="form-control @error('current_password') is-invalid @enderror" 
                               id="current_password" name="current_password">
                        @error('current_password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="password" class="form-label">Password Baru</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                       id="password" name="password">
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">Konfirmasi Password Baru</label>
                                <input type="password" class="form-control" 
                                       id="password_confirmation" name="password_confirmation">
                            </div>
                        </div>
                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('supplier.dashboard') }}" class="btn btn-secondary me-md-2">
                            <i class="fas fa-times"></i> Batal
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <!-- Current Info -->
        <div class="card border-0 shadow-sm mb-3">
            <div class="card-header bg-info text-white">
                <h6 class="mb-0"><i class="fas fa-info-circle"></i> Informasi Akun</h6>
            </div>
            <div class="card-body">
                <table class="table table-borderless table-sm">
                    <tr>
                        <td><strong>Username:</strong></td>
                        <td>{{ $supplier->username }}</td>
                    </tr>
                    <tr>
                        <td><strong>Status:</strong></td>
                        <td>
                            <span class="badge bg-{{ $supplier->status === 'aktif' ? 'success' : 'danger' }}">
                                {{ ucfirst($supplier->status) }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Bergabung:</strong></td>
                        <td>{{ $supplier->created_at->format('d/m/Y') }}</td>
                    </tr>
                    <tr>
                        <td><strong>Login Terakhir:</strong></td>
                        <td>{{ $supplier->last_login ? $supplier->last_login->format('d/m/Y H:i') : 'Belum pernah' }}</td>
                    </tr>
                </table>
            </div>
        </div>

        <!-- Company Info -->
        @if($supplier->pemasok)
        <div class="card border-0 shadow-sm mb-3">
            <div class="card-header bg-success text-white">
                <h6 class="mb-0"><i class="fas fa-building"></i> Informasi Perusahaan</h6>
            </div>
            <div class="card-body">
                <table class="table table-borderless table-sm">
                    <tr>
                        <td><strong>Nama:</strong></td>
                        <td>{{ $supplier->pemasok->nama_perusahaan }}</td>
                    </tr>
                    <tr>
                        <td><strong>Alamat:</strong></td>
                        <td>{{ $supplier->pemasok->alamat }}</td>
                    </tr>
                    <tr>
                        <td><strong>Kota:</strong></td>
                        <td>{{ $supplier->pemasok->kota }}</td>
                    </tr>
                    <tr>
                        <td><strong>Kategori:</strong></td>
                        <td>
                            <span class="badge bg-primary">{{ $supplier->pemasok->kategori_produk }}</span>
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Rating:</strong></td>
                        <td>
                            @for($i = 1; $i <= 5; $i++)
                                <i class="fas fa-star {{ $i <= ($supplier->pemasok->rating ?? 0) ? 'text-warning' : 'text-muted' }}"></i>
                            @endfor
                            <small class="text-muted">({{ $supplier->pemasok->rating ?? 0 }}/5)</small>
                        </td>
                    </tr>
                </table>
                
                <hr>
                
                <small class="text-muted">
                    <i class="fas fa-info-circle"></i> 
                    Untuk mengubah informasi perusahaan, hubungi administrator.
                </small>
            </div>
        </div>
        @endif

        <!-- Security Tips -->
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-warning text-dark">
                <h6 class="mb-0"><i class="fas fa-shield-alt"></i> Tips Keamanan</h6>
            </div>
            <div class="card-body">
                <ul class="list-unstyled mb-0 small">
                    <li class="mb-2">
                        <i class="fas fa-check text-success"></i> 
                        Gunakan password yang kuat (min 8 karakter)
                    </li>
                    <li class="mb-2">
                        <i class="fas fa-check text-success"></i> 
                        Kombinasikan huruf besar, kecil, angka, dan simbol
                    </li>
                    <li class="mb-2">
                        <i class="fas fa-check text-success"></i> 
                        Jangan bagikan password kepada siapapun
                    </li>
                    <li class="mb-2">
                        <i class="fas fa-check text-success"></i> 
                        Logout dari akun setelah selesai menggunakan
                    </li>
                    <li class="mb-0">
                        <i class="fas fa-check text-success"></i> 
                        Ubah password secara berkala
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // Password strength indicator
        $('#password').on('input', function() {
            const password = $(this).val();
            const strength = calculatePasswordStrength(password);
            
            // Remove existing indicators
            $(this).next('.password-strength').remove();
            
            if (password.length > 0) {
                let strengthClass = '';
                let strengthText = '';
                
                if (strength < 2) {
                    strengthClass = 'text-danger';
                    strengthText = 'Lemah';
                } else if (strength < 4) {
                    strengthClass = 'text-warning';
                    strengthText = 'Sedang';
                } else {
                    strengthClass = 'text-success';
                    strengthText = 'Kuat';
                }
                
                $(this).after(`<small class="password-strength ${strengthClass}">${strengthText}</small>`);
            }
        });

        // Password confirmation validation
        $('#password_confirmation').on('input', function() {
            const password = $('#password').val();
            const confirmation = $(this).val();
            
            // Remove existing indicators
            $(this).next('.password-match').remove();
            
            if (confirmation.length > 0) {
                if (password === confirmation) {
                    $(this).after('<small class="password-match text-success">Password cocok</small>');
                } else {
                    $(this).after('<small class="password-match text-danger">Password tidak cocok</small>');
                }
            }
        });

        // Form validation
        $('form').on('submit', function(e) {
            const password = $('#password').val();
            const currentPassword = $('#current_password').val();
            const confirmation = $('#password_confirmation').val();

            // If password fields are filled, validate them
            if (password || currentPassword || confirmation) {
                if (!currentPassword) {
                    e.preventDefault();
                    alert('Mohon masukkan password saat ini untuk mengubah password');
                    $('#current_password').focus();
                    return false;
                }

                if (password !== confirmation) {
                    e.preventDefault();
                    alert('Konfirmasi password tidak cocok');
                    $('#password_confirmation').focus();
                    return false;
                }

                if (password.length < 8) {
                    e.preventDefault();
                    alert('Password baru minimal 8 karakter');
                    $('#password').focus();
                    return false;
                }
            }

            // Show loading state
            $(this).find('button[type="submit"]')
                   .prop('disabled', true)
                   .html('<i class="fas fa-spinner fa-spin"></i> Menyimpan...');
        });

        // Auto-format phone number
        $('#telepon').on('input', function() {
            let value = $(this).val().replace(/\D/g, ''); // Remove non-digits
            
            // Basic Indonesian phone number formatting
            if (value.startsWith('0')) {
                value = '+62' + value.substring(1);
            } else if (!value.startsWith('+62') && !value.startsWith('62')) {
                if (value.length > 0) {
                    value = '+62' + value;
                }
            }
            
            $(this).val(value);
        });
    });

    function calculatePasswordStrength(password) {
        let strength = 0;
        
        // Length check
        if (password.length >= 8) strength++;
        if (password.length >= 12) strength++;
        
        // Character variety checks
        if (/[a-z]/.test(password)) strength++;
        if (/[A-Z]/.test(password)) strength++;
        if (/[0-9]/.test(password)) strength++;
        if (/[^A-Za-z0-9]/.test(password)) strength++;
        
        return strength;
    }
</script>
@endpush
