@extends('layouts.customer')

@section('title', 'Profile Saya - MyYOGYA')

@section('content')
<style>
    .profile-header {
        background: linear-gradient(135deg, #f26b37 0%, #e55827 100%);
        color: white;
        padding: 40px 0;
        border-radius: 0 0 20px 20px;
        margin-bottom: 30px;
    }

    .profile-avatar {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        background: rgba(255,255,255,0.2);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 3rem;
        margin: 0 auto 20px;
        border: 4px solid rgba(255,255,255,0.3);
    }

    .profile-info h3 {
        margin-bottom: 5px;
        font-weight: 600;
    }

    .membership-badge {
        background: rgba(255,255,255,0.2);
        padding: 5px 15px;
        border-radius: 20px;
        font-size: 0.9rem;
        display: inline-block;
        margin-top: 10px;
    }

    .profile-tabs {
        background: white;
        border-radius: 15px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        overflow: hidden;
        margin-bottom: 30px;
    }

    .nav-tabs {
        border-bottom: none;
        background: #f8f9fa;
    }

    .nav-tabs .nav-link {
        border: none;
        color: #6c757d;
        font-weight: 500;
        padding: 15px 25px;
        transition: all 0.3s ease;
    }

    .nav-tabs .nav-link.active {
        background: white;
        color: #f26b37;
        border-bottom: 3px solid #f26b37;
    }

    .tab-content {
        padding: 30px;
    }

    .form-floating {
        margin-bottom: 20px;
    }

    .form-floating label {
        color: #6c757d;
    }

    .form-control:focus {
        border-color: #f26b37;
        box-shadow: 0 0 0 0.2rem rgba(242, 107, 55, 0.25);
    }

    .btn-primary {
        background: linear-gradient(135deg, #f26b37 0%, #e55827 100%);
        border: none;
        padding: 12px 30px;
        border-radius: 25px;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(242, 107, 55, 0.3);
    }

    .stats-card {
        background: white;
        border-radius: 15px;
        padding: 25px;
        text-align: center;
        box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        margin-bottom: 20px;
        transition: all 0.3s ease;
    }

    .stats-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0,0,0,0.15);
    }

    .stats-icon {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 15px;
        font-size: 1.5rem;
        color: white;
    }

    .stats-number {
        font-size: 2rem;
        font-weight: 700;
        color: #2c3e50;
        margin-bottom: 5px;
    }

    .stats-label {
        color: #6c757d;
        font-size: 0.9rem;
    }

    .gender-options {
        display: flex;
        gap: 20px;
        margin-top: 10px;
    }

    .gender-option {
        flex: 1;
    }

    .gender-option input[type="radio"] {
        display: none;
    }

    .gender-option label {
        display: block;
        padding: 12px;
        border: 2px solid #e9ecef;
        border-radius: 8px;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s ease;
        background: white;
    }

    .gender-option input[type="radio"]:checked + label {
        border-color: #f26b37;
        background: rgba(242, 107, 55, 0.1);
        color: #f26b37;
    }

    .alert {
        border-radius: 12px;
        border: none;
    }

    .alert-success {
        background: rgba(40, 167, 69, 0.1);
        color: #28a745;
    }

    .alert-danger {
        background: rgba(220, 53, 69, 0.1);
        color: #dc3545;
    }

    @media (max-width: 768px) {
        .profile-header {
            padding: 30px 0;
        }
        
        .profile-avatar {
            width: 80px;
            height: 80px;
            font-size: 2rem;
        }
        
        .tab-content {
            padding: 20px;
        }
        
        .nav-tabs .nav-link {
            padding: 12px 15px;
            font-size: 0.9rem;
        }
    }
</style>

<div class="container-fluid">
    <!-- Profile Header -->
    <div class="profile-header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-3 text-center">
                    <div class="profile-avatar">
                        <i class="fas fa-user"></i>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="profile-info">
                        <h3>{{ $pelanggan->nama_pelanggan }}</h3>
                        <p class="mb-2">{{ $pelanggan->email }}</p>
                        <p class="mb-0">{{ $pelanggan->nomer_telepon }}</p>
                        <span class="membership-badge">
                            <i class="fas fa-crown me-1"></i>{{ $pelanggan->level_membership }} Member
                        </span>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="text-center">
                        <h6>Member Sejak</h6>
                        <p class="mb-0">{{ \Carbon\Carbon::parse($pelanggan->created_at)->format('d M Y') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <!-- Statistics Cards -->
            <div class="col-lg-3 col-md-6">
                <div class="stats-card">
                    <div class="stats-icon" style="background: linear-gradient(135deg, #28a745, #20c997);">
                        <i class="fas fa-shopping-bag"></i>
                    </div>
                    <div class="stats-number">0</div>
                    <div class="stats-label">Total Pembelian</div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="stats-card">
                    <div class="stats-icon" style="background: linear-gradient(135deg, #007bff, #6f42c1);">
                        <i class="fas fa-heart"></i>
                    </div>
                    <div class="stats-number">0</div>
                    <div class="stats-label">Wishlist</div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="stats-card">
                    <div class="stats-icon" style="background: linear-gradient(135deg, #ffc107, #fd7e14);">
                        <i class="fas fa-star"></i>
                    </div>
                    <div class="stats-number">0</div>
                    <div class="stats-label">Poin Rewards</div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="stats-card">
                    <div class="stats-icon" style="background: linear-gradient(135deg, #dc3545, #e83e8c);">
                        <i class="fas fa-gift"></i>
                    </div>
                    <div class="stats-number">0</div>
                    <div class="stats-label">Voucher Aktif</div>
                </div>
            </div>
        </div>

        <!-- Profile Tabs -->
        <div class="profile-tabs">
            <ul class="nav nav-tabs" id="profileTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab">
                        <i class="fas fa-user me-2"></i>Informasi Profile
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="password-tab" data-bs-toggle="tab" data-bs-target="#password" type="button" role="tab">
                        <i class="fas fa-lock me-2"></i>Ubah Password
                    </button>
                </li>
            </ul>
            
            <div class="tab-content" id="profileTabsContent">
                <!-- Profile Information Tab -->
                <div class="tab-pane fade show active" id="profile" role="tabpanel">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <form action="{{ route('pelanggan.profile.update') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="nama_pelanggan" name="nama_pelanggan" 
                                           value="{{ old('nama_pelanggan', $pelanggan->nama_pelanggan) }}" required>
                                    <label for="nama_pelanggan">Nama Lengkap</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="email" class="form-control" id="email" name="email" 
                                           value="{{ old('email', $pelanggan->email) }}" required>
                                    <label for="email">Email</label>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="tel" class="form-control" id="nomer_telepon" name="nomer_telepon" 
                                           value="{{ old('nomer_telepon', $pelanggan->nomer_telepon) }}" required>
                                    <label for="nomer_telepon">Nomor Telepon</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" 
                                           value="{{ old('tanggal_lahir', $pelanggan->tanggal_lahir) }}" required>
                                    <label for="tanggal_lahir">Tanggal Lahir</label>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <label class="form-label">Jenis Kelamin</label>
                                <div class="gender-options">
                                    <div class="gender-option">
                                        <input type="radio" id="pria" name="jenis_kelamin" value="L" 
                                               {{ old('jenis_kelamin', $pelanggan->jenis_kelamin) == 'L' ? 'checked' : '' }}>
                                        <label for="pria">
                                            <i class="fas fa-mars me-1"></i>Pria
                                        </label>
                                    </div>
                                    <div class="gender-option">
                                        <input type="radio" id="wanita" name="jenis_kelamin" value="P" 
                                               {{ old('jenis_kelamin', $pelanggan->jenis_kelamin) == 'P' ? 'checked' : '' }}>
                                        <label for="wanita">
                                            <i class="fas fa-venus me-1"></i>Wanita
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <textarea class="form-control" id="alamat" name="alamat" style="height: 100px" required>{{ old('alamat', $pelanggan->alamat) }}</textarea>
                                    <label for="alamat">Alamat Lengkap</label>
                                </div>
                            </div>
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Change Password Tab -->
                <div class="tab-pane fade" id="password" role="tabpanel">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if($errors->has('current_password') || $errors->has('password'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            @if($errors->has('current_password'))
                                {{ $errors->first('current_password') }}
                            @endif
                            @if($errors->has('password'))
                                {{ $errors->first('password') }}
                            @endif
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <form action="{{ route('pelanggan.profile.password') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-floating mb-3">
                                    <input type="password" class="form-control" id="current_password" name="current_password" required>
                                    <label for="current_password">Password Saat Ini</label>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="password" class="form-control" id="password" name="password" required minlength="8">
                                    <label for="password">Password Baru</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                                    <label for="password_confirmation">Konfirmasi Password Baru</label>
                                </div>
                            </div>
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-key me-2"></i>Update Password
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Password visibility toggle
    const toggleButtons = document.querySelectorAll('.toggle-password');
    toggleButtons.forEach(button => {
        button.addEventListener('click', function() {
            const input = this.parentNode.querySelector('input');
            const icon = this.querySelector('i');
            
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        });
    });

    // Form validation
    const forms = document.querySelectorAll('form');
    forms.forEach(form => {
        form.addEventListener('submit', function(e) {
            const requiredFields = form.querySelectorAll('[required]');
            let isValid = true;

            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    isValid = false;
                    field.classList.add('is-invalid');
                } else {
                    field.classList.remove('is-invalid');
                }
            });

            if (!isValid) {
                e.preventDefault();
                alert('Mohon lengkapi semua field yang wajib diisi');
            }
        });
    });
});
</script>
@endsection
