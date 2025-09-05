@extends('layouts.navbar_admin')

@section('title', 'Profil Admin - MyYOGYA')

@section('page-title', 'Profil Administrator')

@section('content')
<style>
    .profile-container {
        max-width: 1000px;
        margin: 0 auto;
        padding: 20px;
    }

    .profile-header {
        background: linear-gradient(135deg, var(--yogya-orange) 0%, var(--yogya-orange-dark) 100%);
        color: white;
        border-radius: 20px;
        padding: 40px;
        margin-bottom: 30px;
        position: relative;
        overflow: hidden;
    }

    .profile-header::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -50%;
        width: 100%;
        height: 100%;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        transform: rotate(45deg);
    }

    .profile-header-content {
        position: relative;
        z-index: 2;
        display: flex;
        align-items: center;
        gap: 30px;
    }

    .profile-avatar-section {
        text-align: center;
    }

    .profile-avatar {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        border: 5px solid rgba(255, 255, 255, 0.3);
        object-fit: cover;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
    }

    .profile-info h2 {
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 8px;
    }

    .profile-info .position {
        font-size: 1.1rem;
        opacity: 0.9;
        margin-bottom: 5px;
    }

    .profile-info .last-login {
        font-size: 0.9rem;
        opacity: 0.8;
    }

    .profile-cards {
        display: grid;
        grid-template-columns: 1fr 2fr;
        gap: 30px;
        margin-bottom: 30px;
    }

    .profile-card {
        background: white;
        border-radius: 15px;
        padding: 30px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        border: 1px solid #e9ecef;
    }

    .card-title {
        font-size: 1.2rem;
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .card-icon {
        width: 35px;
        height: 35px;
        background: var(--yogya-gradient);
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 14px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-label {
        font-weight: 600;
        color: #495057;
        margin-bottom: 8px;
        display: block;
        font-size: 0.9rem;
    }

    .form-control {
        width: 100%;
        padding: 12px 15px;
        border: 2px solid #e9ecef;
        border-radius: 10px;
        font-size: 14px;
        transition: all 0.3s ease;
        background: #f8f9fa;
    }

    .form-control:focus {
        border-color: var(--yogya-orange);
        background: white;
        box-shadow: 0 0 0 3px rgba(242, 107, 55, 0.1);
        outline: none;
    }

    .textarea-control {
        min-height: 100px;
        resize: vertical;
    }

    .file-input-wrapper {
        position: relative;
        display: inline-block;
        cursor: pointer;
        width: 100%;
    }

    .file-input {
        position: absolute;
        opacity: 0;
        width: 100%;
        height: 100%;
        cursor: pointer;
    }

    .file-input-display {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px 15px;
        border: 2px dashed #dee2e6;
        border-radius: 10px;
        background: #f8f9fa;
        transition: all 0.3s ease;
    }

    .file-input-wrapper:hover .file-input-display {
        border-color: var(--yogya-orange);
        background: rgba(242, 107, 55, 0.05);
    }

    .btn-primary {
        background: var(--yogya-gradient);
        border: none;
        padding: 12px 30px;
        border-radius: 10px;
        color: white;
        font-weight: 600;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(242, 107, 55, 0.4);
    }

    .btn-secondary {
        background: #6c757d;
        border: none;
        padding: 12px 30px;
        border-radius: 10px;
        color: white;
        font-weight: 600;
        transition: all 0.3s ease;
        cursor: pointer;
        text-decoration: none;
        display: inline-block;
    }

    .btn-secondary:hover {
        background: #5a6268;
        color: white;
        text-decoration: none;
    }

    .alert {
        padding: 15px 20px;
        border-radius: 10px;
        margin-bottom: 20px;
        border: none;
    }

    .alert-success {
        background: #d4edda;
        color: #155724;
        border-left: 4px solid #28a745;
    }

    .alert-danger {
        background: #f8d7da;
        color: #721c24;
        border-left: 4px solid #dc3545;
    }

    .password-section {
        border-top: 2px solid #e9ecef;
        padding-top: 25px;
        margin-top: 25px;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        gap: 15px;
        margin-top: 20px;
    }

    .stat-item {
        text-align: center;
        padding: 15px;
        background: #f8f9fa;
        border-radius: 10px;
        border: 1px solid #e9ecef;
    }

    .stat-number {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--yogya-orange);
    }

    .stat-label {
        font-size: 0.8rem;
        color: #6c757d;
        margin-top: 5px;
    }

    @media (max-width: 768px) {
        .profile-cards {
            grid-template-columns: 1fr;
        }
        
        .profile-header-content {
            flex-direction: column;
            text-align: center;
            gap: 20px;
        }
        
        .profile-container {
            padding: 15px;
        }
    }
</style>

<div class="profile-container">
    <!-- Profile Header -->
    <div class="profile-header">
        <div class="profile-header-content">
            <div class="profile-avatar-section">
                @if($admin->avatar && file_exists(public_path('uploads/avatars/' . $admin->avatar)))
                    <img src="{{ asset('uploads/avatars/' . $admin->avatar) }}" alt="Avatar" class="profile-avatar">
                @else
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($admin->name) }}&background=f26b37&color=fff&size=120" alt="Avatar" class="profile-avatar">
                @endif
            </div>
            <div class="profile-info">
                <h2>{{ $admin->name ?? 'Administrator' }}</h2>
                <div class="position">{{ $admin->position ?? 'Administrator' }}</div>
                <div class="last-login">
                    <i class="fas fa-clock me-1"></i>
                    Login terakhir: {{ $admin->last_login ? \Carbon\Carbon::parse($admin->last_login)->diffForHumans() : 'Tidak diketahui' }}
                </div>
            </div>
        </div>
    </div>

    <!-- Alerts -->
    @if(session('success'))
        <div class="alert alert-success">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            <i class="fas fa-exclamation-triangle me-2"></i>{{ session('error') }}
        </div>
    @endif

    <!-- Profile Content -->
    <div class="profile-cards">
        <!-- Quick Stats -->
        <div class="profile-card">
            <h3 class="card-title">
                <div class="card-icon">
                    <i class="fas fa-chart-bar"></i>
                </div>
                Statistik Akun
            </h3>
            <div class="stats-grid">
                <div class="stat-item">
                    <div class="stat-number">{{ $admin->created_at ? \Carbon\Carbon::parse($admin->created_at)->diffInDays(now()) : 0 }}</div>
                    <div class="stat-label">Hari Bergabung</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">{{ $admin->updated_at ? \Carbon\Carbon::parse($admin->updated_at)->diffInDays($admin->created_at ?? now()) : 0 }}</div>
                    <div class="stat-label">Kali Update</div>
                </div>
            </div>
            
            <div style="margin-top: 25px;">
                <h5 style="color: #495057; margin-bottom: 15px;">Informasi Akun</h5>
                <div style="background: #f8f9fa; padding: 15px; border-radius: 8px; font-size: 0.9rem;">
                    <div style="margin-bottom: 8px;"><strong>Email:</strong> {{ $admin->email }}</div>
                    <div style="margin-bottom: 8px;"><strong>Username:</strong> {{ $admin->username ?? 'Belum diatur' }}</div>
                    <div style="margin-bottom: 8px;"><strong>Telepon:</strong> {{ $admin->phone ?? 'Belum diatur' }}</div>
                    <div><strong>Bergabung:</strong> {{ $admin->created_at ? \Carbon\Carbon::parse($admin->created_at)->format('d M Y') : 'Tidak diketahui' }}</div>
                </div>
            </div>
        </div>

        <!-- Edit Form -->
        <div class="profile-card">
            <h3 class="card-title">
                <div class="card-icon">
                    <i class="fas fa-user-edit"></i>
                </div>
                Edit Profile
            </h3>

            <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Avatar Upload -->
                <div class="form-group">
                    <label class="form-label">
                        <i class="fas fa-camera me-1"></i>Foto Profile
                    </label>
                    <div class="file-input-wrapper">
                        <input type="file" name="avatar" class="file-input" accept="image/*" id="avatarInput">
                        <div class="file-input-display">
                            <i class="fas fa-cloud-upload-alt" style="color: var(--yogya-orange);"></i>
                            <span id="fileName">Pilih foto profile baru (opsional)</span>
                        </div>
                    </div>
                    @error('avatar')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Basic Information -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name', $admin->name) }}" required>
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Username</label>
                            <input type="text" name="username" class="form-control" value="{{ old('username', $admin->username) }}" required>
                            @error('username')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email', $admin->email) }}" required>
                            @error('email')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">No. Telepon</label>
                            <input type="text" name="phone" class="form-control" value="{{ old('phone', $admin->phone) }}">
                            @error('phone')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Posisi/Jabatan</label>
                    <input type="text" name="position" class="form-control" value="{{ old('position', $admin->position) }}">
                    @error('position')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Bio</label>
                    <textarea name="bio" class="form-control textarea-control" placeholder="Ceritakan sedikit tentang diri Anda...">{{ old('bio', $admin->bio) }}</textarea>
                    @error('bio')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Password Section -->
                <div class="password-section">
                    <h5 style="color: #495057; margin-bottom: 20px;">
                        <i class="fas fa-lock me-2"></i>Ubah Password
                    </h5>
                    
                    <div class="form-group">
                        <label class="form-label">Password Saat Ini</label>
                        <input type="password" name="current_password" class="form-control" placeholder="Masukkan password saat ini untuk mengubah password">
                        @error('current_password')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Password Baru</label>
                                <input type="password" name="new_password" class="form-control" placeholder="Password baru (minimal 8 karakter)">
                                @error('new_password')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Konfirmasi Password Baru</label>
                                <input type="password" name="new_password_confirmation" class="form-control" placeholder="Ulangi password baru">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="d-flex gap-3 justify-content-end mt-4">
                    <a href="{{ route('admin.dashboard') }}" class="btn-secondary">
                        <i class="fas fa-times me-2"></i>Batal
                    </a>
                    <button type="submit" class="btn-primary">
                        <i class="fas fa-save me-2"></i>Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // File input handling
    const avatarInput = document.getElementById('avatarInput');
    const fileName = document.getElementById('fileName');
    
    if (avatarInput) {
        avatarInput.addEventListener('change', function(e) {
            if (e.target.files.length > 0) {
                fileName.textContent = e.target.files[0].name;
            } else {
                fileName.textContent = 'Pilih foto profile baru (opsional)';
            }
        });
    }
});
</script>
@endsection
