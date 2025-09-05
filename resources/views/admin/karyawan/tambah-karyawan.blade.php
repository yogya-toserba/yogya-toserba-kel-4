@extends('layouts.navbar_admin')

@section('title', 'Tambah Karyawan - MyYOGYA Admin')

@section('content')
<style>
    .orange-theme {
        --orange-primary: rgb(242, 112, 61);
        --orange-light: rgba(242, 112, 61, 0.1);
        --orange-dark: rgb(220, 95, 50);
    }
    
    .btn-orange {
        background-color: var(--orange-primary);
        border-color: var(--orange-primary);
        color: white;
    }
    
    .btn-orange:hover {
        background-color: var(--orange-dark);
        border-color: var(--orange-dark);
        color: white;
    }
    
    .text-orange {
        color: var(--orange-primary) !important;
    }
    
    .border-orange {
        border-color: var(--orange-primary) !important;
    }
    
    .bg-orange-light {
        background-color: var(--orange-light);
    }
    
    .form-control:focus {
        border-color: var(--orange-primary);
        box-shadow: 0 0 0 0.2rem rgba(242, 112, 61, 0.25);
    }
    
    .form-select:focus {
        border-color: var(--orange-primary);
        box-shadow: 0 0 0 0.2rem rgba(242, 112, 61, 0.25);
    }
    
    .full-height-container {
        min-height: calc(100vh - 70px);
        display: flex;
        flex-direction: column;
    }
    
    .content-wrapper {
        flex: 1;
        display: flex;
        flex-direction: column;
    }
</style>

<div class="container-fluid orange-theme full-height-container">
    <div class="content-wrapper">
        <!-- Header Section -->
        <div class="row mb-3">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center py-3">
                    <div>
                        <h1 class="h3 mb-1 text-orange">Tambah Karyawan</h1>
                        <p class="text-muted mb-0">Tambahkan karyawan baru ke sistem MyYOGYA</p>
                    </div>
                    <div>
                        <a href="{{ route('admin.data-karyawan') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Error Messages -->
        @if($errors->any())
            <div class="row mb-3">
                <div class="col-12">
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <h6><i class="fas fa-exclamation-triangle me-2"></i>Terdapat kesalahan:</h6>
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                </div>
            </div>
        @endif

        <!-- Main Form Card - Full Screen -->
        <div class="row flex-grow-1">
            <div class="col-12">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header bg-orange-light border-orange">
                        <h5 class="mb-0 text-orange">
                            <i class="fas fa-user-plus me-2"></i>Form Tambah Karyawan
                        </h5>
                    </div>
                    <div class="card-body p-4 overflow-auto">
                        <form action="{{ route('admin.data-karyawan.store') }}" method="POST" id="tambahKaryawanForm">
                            @csrf
                            
                            <div class="row h-100">
                                <!-- Left Column - Personal Information -->
                                <div class="col-lg-6">
                                    <div class="mb-4">
                                        <h6 class="text-orange border-bottom border-orange pb-2 mb-3">
                                            <i class="fas fa-user me-2"></i>Informasi Personal
                                        </h6>
                                    </div>

                                    <!-- Nama -->
                                    <div class="mb-3">
                                        <label for="nama" class="form-label fw-semibold">Nama Lengkap <span class="text-danger">*</span></label>
                                        <input type="text" 
                                               class="form-control @error('nama') is-invalid @enderror" 
                                               id="nama" 
                                               name="nama" 
                                               value="{{ old('nama') }}" 
                                               placeholder="Masukkan nama lengkap"
                                               required>
                                        @error('nama')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Email -->
                                    <div class="mb-3">
                                        <label for="email" class="form-label fw-semibold">Email <span class="text-danger">*</span></label>
                                        <input type="email" 
                                               class="form-control @error('email') is-invalid @enderror" 
                                               id="email" 
                                               name="email" 
                                               value="{{ old('email') }}" 
                                               placeholder="contoh@email.com"
                                               required>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Tanggal Lahir -->
                                    <div class="mb-3">
                                        <label for="tanggal_lahir" class="form-label fw-semibold">Tanggal Lahir <span class="text-danger">*</span></label>
                                        <input type="date" 
                                               class="form-control @error('tanggal_lahir') is-invalid @enderror" 
                                               id="tanggal_lahir" 
                                               name="tanggal_lahir" 
                                               value="{{ old('tanggal_lahir') }}" 
                                               max="{{ date('Y-m-d', strtotime('-17 years')) }}"
                                               required>
                                        @error('tanggal_lahir')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Nomor Telepon -->
                                    <div class="mb-3">
                                        <label for="nomer_telepon" class="form-label fw-semibold">Nomor Telepon <span class="text-danger">*</span></label>
                                        <input type="tel" 
                                               class="form-control @error('nomer_telepon') is-invalid @enderror" 
                                               id="nomer_telepon" 
                                               name="nomer_telepon" 
                                               value="{{ old('nomer_telepon') }}" 
                                               placeholder="08xxxxxxxxxx"
                                               pattern="[0-9]{10,15}"
                                               required>
                                        @error('nomer_telepon')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Alamat -->
                                    <div class="mb-3">
                                        <label for="alamat" class="form-label fw-semibold">Alamat Lengkap <span class="text-danger">*</span></label>
                                        <textarea class="form-control @error('alamat') is-invalid @enderror" 
                                                  id="alamat" 
                                                  name="alamat" 
                                                  rows="4" 
                                                  placeholder="Masukkan alamat lengkap"
                                                  required>{{ old('alamat') }}</textarea>
                                        @error('alamat')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Right Column - Work Information -->
                                <div class="col-lg-6">
                                    <div class="mb-4">
                                        <h6 class="text-orange border-bottom border-orange pb-2 mb-3">
                                            <i class="fas fa-briefcase me-2"></i>Informasi Pekerjaan
                                        </h6>
                                    </div>

                                    <!-- Divisi -->
                                    <div class="mb-3">
                                        <label for="divisi" class="form-label fw-semibold">Divisi <span class="text-danger">*</span></label>
                                        <select class="form-select @error('divisi') is-invalid @enderror" 
                                                id="divisi" 
                                                name="divisi" 
                                                required>
                                            <option value="">Pilih Divisi</option>
                                            <option value="Manager" {{ old('divisi') == 'Manager' ? 'selected' : '' }}>Manager</option>
                                            <option value="Supervisor" {{ old('divisi') == 'Supervisor' ? 'selected' : '' }}>Supervisor</option>
                                            <option value="Kasir" {{ old('divisi') == 'Kasir' ? 'selected' : '' }}>Kasir</option>
                                            <option value="Gudang" {{ old('divisi') == 'Gudang' ? 'selected' : '' }}>Gudang</option>
                                            <option value="Customer Service" {{ old('divisi') == 'Customer Service' ? 'selected' : '' }}>Customer Service</option>
                                            <option value="Security" {{ old('divisi') == 'Security' ? 'selected' : '' }}>Security</option>
                                            <option value="Cleaning Service" {{ old('divisi') == 'Cleaning Service' ? 'selected' : '' }}>Cleaning Service</option>
                                            <option value="IT Support" {{ old('divisi') == 'IT Support' ? 'selected' : '' }}>IT Support</option>
                                            <option value="HRD" {{ old('divisi') == 'HRD' ? 'selected' : '' }}>HRD</option>
                                            <option value="Finance" {{ old('divisi') == 'Finance' ? 'selected' : '' }}>Finance</option>
                                        </select>
                                        @error('divisi')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Shift -->
                                    <div class="mb-4">
                                        <label for="id_shift" class="form-label fw-semibold">Shift Kerja <span class="text-danger">*</span></label>
                                        <select class="form-select @error('id_shift') is-invalid @enderror" 
                                                id="id_shift" 
                                                name="id_shift" 
                                                required>
                                            <option value="">Pilih Shift</option>
                                            <option value="1" {{ old('id_shift') == '1' ? 'selected' : '' }}>Shift 1 (Pagi: 07:00-15:00)</option>
                                            <option value="2" {{ old('id_shift') == '2' ? 'selected' : '' }}>Shift 2 (Siang: 15:00-23:00)</option>
                                            <option value="3" {{ old('id_shift') == '3' ? 'selected' : '' }}>Shift 3 (Malam: 23:00-07:00)</option>
                                        </select>
                                        @error('id_shift')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Preview Card -->
                                    <div class="card bg-orange-light border-orange">
                                        <div class="card-header bg-transparent border-orange">
                                            <h6 class="mb-0 text-orange">
                                                <i class="fas fa-eye me-2"></i>Preview Data
                                            </h6>
                                        </div>
                                        <div class="card-body">
                                            <div id="previewContent">
                                                <p class="text-muted mb-2"><small>Data akan ditampilkan saat form diisi</small></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Submit Buttons - Fixed at bottom -->
                            <div class="row mt-4 pt-3 border-top">
                                <div class="col-12">
                                    <div class="d-flex justify-content-end gap-2">
                                        <a href="{{ route('admin.data-karyawan') }}" class="btn btn-outline-secondary">
                                            <i class="fas fa-times me-2"></i>Batal
                                        </a>
                                        <button type="submit" class="btn btn-orange">
                                            <i class="fas fa-save me-2"></i>Simpan Karyawan
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript for Form Enhancement -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Phone number formatting
    const phoneInput = document.getElementById('nomer_telepon');
    phoneInput.addEventListener('input', function(e) {
        // Remove all non-numeric characters
        let value = e.target.value.replace(/\D/g, '');
        
        // Limit to 15 digits
        if (value.length > 15) {
            value = value.slice(0, 15);
        }
        
        e.target.value = value;
        updatePreview();
    });

    // Real-time preview update
    function updatePreview() {
        const nama = document.getElementById('nama').value;
        const email = document.getElementById('email').value;
        const divisi = document.getElementById('divisi').value;
        const shift = document.getElementById('id_shift');
        const shiftText = shift.selectedOptions[0]?.text || '';
        
        const previewContent = document.getElementById('previewContent');
        
        if (nama || email || divisi || shiftText) {
            previewContent.innerHTML = `
                <div class="small">
                    ${nama ? `<p class="mb-1"><strong>Nama:</strong> ${nama}</p>` : ''}
                    ${email ? `<p class="mb-1"><strong>Email:</strong> ${email}</p>` : ''}
                    ${divisi ? `<p class="mb-1"><strong>Divisi:</strong> ${divisi}</p>` : ''}
                    ${shiftText ? `<p class="mb-1"><strong>Shift:</strong> ${shiftText}</p>` : ''}
                </div>
            `;
        } else {
            previewContent.innerHTML = '<p class="text-muted mb-2"><small>Data akan ditampilkan saat form diisi</small></p>';
        }
    }

    // Add event listeners for preview update
    document.getElementById('nama').addEventListener('input', updatePreview);
    document.getElementById('email').addEventListener('input', updatePreview);
    document.getElementById('divisi').addEventListener('change', updatePreview);
    document.getElementById('id_shift').addEventListener('change', updatePreview);

    // Form validation enhancement
    const form = document.getElementById('tambahKaryawanForm');
    form.addEventListener('submit', function(e) {
        let isValid = true;
        
        // Add loading state to submit button
        const submitBtn = this.querySelector('button[type="submit"]');
        const originalText = submitBtn.innerHTML;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Menyimpan...';
        submitBtn.disabled = true;
        
        // Check required fields
        const requiredFields = form.querySelectorAll('[required]');
        requiredFields.forEach(field => {
            if (!field.value.trim()) {
                field.classList.add('is-invalid');
                isValid = false;
            } else {
                field.classList.remove('is-invalid');
            }
        });
        
        // Validate email format
        const email = document.getElementById('email');
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (email.value && !emailRegex.test(email.value)) {
            email.classList.add('is-invalid');
            isValid = false;
        }
        
        // Validate phone number
        const phone = document.getElementById('nomer_telepon');
        if (phone.value && (phone.value.length < 10 || phone.value.length > 15)) {
            phone.classList.add('is-invalid');
            isValid = false;
        }
        
        if (!isValid) {
            e.preventDefault();
            submitBtn.innerHTML = originalText;
            submitBtn.disabled = false;
            alert('Mohon periksa kembali data yang Anda masukkan.');
            
            // Scroll to first error
            const firstError = form.querySelector('.is-invalid');
            if (firstError) {
                firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
                firstError.focus();
            }
        }
    });

    // Real-time validation
    const inputs = form.querySelectorAll('input, select, textarea');
    inputs.forEach(input => {
        input.addEventListener('blur', function() {
            if (this.hasAttribute('required') && !this.value.trim()) {
                this.classList.add('is-invalid');
            } else {
                this.classList.remove('is-invalid');
            }
        });
        
        input.addEventListener('input', function() {
            if (this.classList.contains('is-invalid') && this.value.trim()) {
                this.classList.remove('is-invalid');
            }
        });
    });
    
    // Auto-focus first field
    document.getElementById('nama').focus();
});
</script>
@endsection
