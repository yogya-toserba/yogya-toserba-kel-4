@extends('layouts.navbar_admin')

@section('title', 'Pengaturan Sistem')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Pengaturan</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Pengaturan Sistem</h4>
                </div>
            </div>
        </div>

        <!-- Success/Error Messages -->
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Pengaturan Umum</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.pengaturan.update') }}" method="POST">
                            @csrf

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="system_name" class="form-label">Nama Sistem</label>
                                        <input type="text" class="form-control" id="system_name" name="system_name"
                                            value="Yogya Toserba - Sistem Penggajian" placeholder="Nama sistem">
                                    </div>

                                    <div class="mb-3">
                                        <label for="company_name" class="form-label">Nama Perusahaan</label>
                                        <input type="text" class="form-control" id="company_name" name="company_name"
                                            value="PT. Yogya Toserba" placeholder="Nama perusahaan">
                                    </div>

                                    <div class="mb-3">
                                        <label for="company_address" class="form-label">Alamat Perusahaan</label>
                                        <textarea class="form-control" id="company_address" name="company_address" rows="3"
                                            placeholder="Alamat lengkap perusahaan">Jl. Contoh No. 123, Jakarta</textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label for="company_phone" class="form-label">Telepon Perusahaan</label>
                                        <input type="text" class="form-control" id="company_phone" name="company_phone"
                                            value="021-12345678" placeholder="Nomor telepon">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="company_email" class="form-label">Email Perusahaan</label>
                                        <input type="email" class="form-control" id="company_email" name="company_email"
                                            value="info@yogyatoserba.com" placeholder="Email perusahaan">
                                    </div>

                                    <div class="mb-3">
                                        <label for="timezone" class="form-label">Zona Waktu</label>
                                        <select class="form-select" id="timezone" name="timezone">
                                            <option value="Asia/Jakarta" selected>Asia/Jakarta (WIB)</option>
                                            <option value="Asia/Makassar">Asia/Makassar (WITA)</option>
                                            <option value="Asia/Jayapura">Asia/Jayapura (WIT)</option>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="currency" class="form-label">Mata Uang</label>
                                        <select class="form-select" id="currency" name="currency">
                                            <option value="IDR" selected>IDR - Rupiah Indonesia</option>
                                            <option value="USD">USD - US Dollar</option>
                                            <option value="EUR">EUR - Euro</option>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="language" class="form-label">Bahasa</label>
                                        <select class="form-select" id="language" name="language">
                                            <option value="id" selected>Bahasa Indonesia</option>
                                            <option value="en">English</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="text-end">
                                <button type="button" class="btn btn-secondary me-2" onclick="window.history.back()">
                                    <i class="fas fa-arrow-left"></i> Kembali
                                </button>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> Simpan Pengaturan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .card {
            border: none;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
            border-radius: 0.375rem;
        }

        .card-header {
            background-color: #f8f9fa;
            border-bottom: 1px solid #dee2e6;
            padding: 1rem 1.25rem;
        }

        .form-label {
            font-weight: 600;
            color: #495057;
            margin-bottom: 0.5rem;
        }

        .form-control,
        .form-select {
            border: 1px solid #ced4da;
            border-radius: 0.375rem;
            padding: 0.75rem;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #80bdff;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        }

        .btn {
            padding: 0.75rem 1.5rem;
            border-radius: 0.375rem;
            font-weight: 500;
        }

        .alert {
            border: none;
            border-radius: 0.375rem;
        }
    </style>
@endsection
