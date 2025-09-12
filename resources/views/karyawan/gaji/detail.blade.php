<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Gaji - Yogya Group Toserba</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .navbar-brand {
            font-weight: bold;
        }

        .detail-card {
            border-radius: 15px;
            border: none;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        }

        .info-item {
            border-bottom: 1px solid #e9ecef;
            padding: 1rem 0;
        }

        .info-item:last-child {
            border-bottom: none;
        }

        .info-label {
            font-weight: 600;
            color: #6c757d;
        }

        .info-value {
            font-weight: 500;
            color: #212529;
        }

        .amount-highlight {
            font-size: 1.2rem;
            font-weight: bold;
        }

        .page-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 15px;
            padding: 2rem;
            margin-bottom: 2rem;
        }

        .calculation-section {
            background-color: #f8f9fa;
            border-radius: 10px;
            padding: 1.5rem;
            margin: 1rem 0;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="fas fa-store me-2"></i>
                Yogya Group Toserba
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('karyawan.dashboard') }}">
                            <i class="fas fa-tachometer-alt me-1"></i>Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('karyawan.gaji.index') }}">
                            <i class="fas fa-money-bill-wave me-1"></i>Gaji Saya
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('karyawan.absensi.index') }}">
                            <i class="fas fa-clock me-1"></i>Absensi
                        </a>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown">
                            <i class="fas fa-user me-1"></i>{{ session('karyawan_nama') }}
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <form method="POST" action="{{ route('karyawan.logout') }}" class="d-inline">
                                    @csrf
                                    <button type="submit" class="dropdown-item">
                                        <i class="fas fa-sign-out-alt me-1"></i>Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h2 class="mb-2">
                        <i class="fas fa-file-invoice-dollar me-2"></i>
                        Detail Gaji
                    </h2>
                    <p class="mb-0">Periode: {{ date('F Y', strtotime($gaji->periode_gaji)) }}</p>
                </div>
                <div class="col-md-4 text-end">
                    <a href="{{ route('karyawan.gaji.index') }}" class="btn btn-light">
                        <i class="fas fa-arrow-left me-1"></i>Kembali
                    </a>
                    @if ($gaji->status_pembayaran == 'paid')
                        <a href="{{ route('karyawan.gaji.slip', $gaji->id_gaji) }}" class="btn btn-success"
                            target="_blank">
                            <i class="fas fa-download me-1"></i>Download Slip
                        </a>
                    @endif
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Informasi Karyawan -->
            <div class="col-md-6 mb-4">
                <div class="card detail-card">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">
                            <i class="fas fa-user me-2"></i>
                            Informasi Karyawan
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="info-item">
                            <div class="row">
                                <div class="col-sm-5 info-label">Nama</div>
                                <div class="col-sm-7 info-value">{{ $gaji->karyawan->nama }}</div>
                            </div>
                        </div>
                        <div class="info-item">
                            <div class="row">
                                <div class="col-sm-5 info-label">Jabatan</div>
                                <div class="col-sm-7 info-value">
                                    {{ $gaji->karyawan->jabatan->nama_jabatan ?? 'Tidak ada jabatan' }}</div>
                            </div>
                        </div>
                        <div class="info-item">
                            <div class="row">
                                <div class="col-sm-5 info-label">Cabang</div>
                                <div class="col-sm-7 info-value">
                                    {{ $gaji->karyawan->cabang->nama_cabang ?? 'Tidak ada cabang' }}</div>
                            </div>
                        </div>
                        <div class="info-item">
                            <div class="row">
                                <div class="col-sm-5 info-label">Email</div>
                                <div class="col-sm-7 info-value">{{ $gaji->karyawan->email }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Status Pembayaran -->
            <div class="col-md-6 mb-4">
                <div class="card detail-card">
                    <div class="card-header bg-info text-white">
                        <h5 class="mb-0">
                            <i class="fas fa-info-circle me-2"></i>
                            Status Pembayaran
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="info-item">
                            <div class="row">
                                <div class="col-sm-5 info-label">Periode Gaji</div>
                                <div class="col-sm-7 info-value">{{ date('F Y', strtotime($gaji->periode_gaji)) }}
                                </div>
                            </div>
                        </div>
                        <div class="info-item">
                            <div class="row">
                                <div class="col-sm-5 info-label">Tanggal Dibuat</div>
                                <div class="col-sm-7 info-value">{{ date('d F Y H:i', strtotime($gaji->created_at)) }}
                                </div>
                            </div>
                        </div>
                        <div class="info-item">
                            <div class="row">
                                <div class="col-sm-5 info-label">Status</div>
                                <div class="col-sm-7">
                                    @if ($gaji->status_pembayaran == 'paid')
                                        <span class="badge bg-success fs-6">
                                            <i class="fas fa-check me-1"></i>Terbayar
                                        </span>
                                    @elseif($gaji->status_pembayaran == 'pending')
                                        <span class="badge bg-warning fs-6">
                                            <i class="fas fa-clock me-1"></i>Pending
                                        </span>
                                    @else
                                        <span class="badge bg-secondary fs-6">
                                            <i
                                                class="fas fa-question me-1"></i>{{ ucfirst($gaji->status_pembayaran) }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="info-item">
                            <div class="row">
                                <div class="col-sm-5 info-label">Keterangan</div>
                                <div class="col-sm-7 info-value">{{ $gaji->keterangan ?: 'Tidak ada keterangan' }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Rincian Gaji -->
        <div class="card detail-card">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0">
                    <i class="fas fa-calculator me-2"></i>
                    Rincian Gaji
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8">
                        <div class="calculation-section">
                            <h6 class="text-primary mb-3">
                                <i class="fas fa-plus-circle me-1"></i>
                                Komponen Positif
                            </h6>
                            <div class="row mb-2">
                                <div class="col-sm-6 info-label">Gaji Pokok</div>
                                <div class="col-sm-6 info-value text-end">Rp
                                    {{ number_format($gaji->gaji_pokok, 0, ',', '.') }}</div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-sm-6 info-label">Tunjangan</div>
                                <div class="col-sm-6 info-value text-end">Rp
                                    {{ number_format($gaji->tunjangan, 0, ',', '.') }}</div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-6 info-label">Bonus</div>
                                <div class="col-sm-6 info-value text-end">Rp
                                    {{ number_format($gaji->bonus, 0, ',', '.') }}</div>
                            </div>

                            <hr class="my-3">

                            <h6 class="text-danger mb-3">
                                <i class="fas fa-minus-circle me-1"></i>
                                Komponen Negatif
                            </h6>
                            <div class="row mb-3">
                                <div class="col-sm-6 info-label">Potongan</div>
                                <div class="col-sm-6 info-value text-end text-danger">- Rp
                                    {{ number_format($gaji->potongan, 0, ',', '.') }}</div>
                            </div>

                            <hr class="my-3">

                            <div class="row">
                                <div class="col-sm-6">
                                    <h5 class="text-success mb-0">Total Gaji Bersih</h5>
                                </div>
                                <div class="col-sm-6 text-end">
                                    <h4 class="text-success amount-highlight mb-0">
                                        Rp {{ number_format($gaji->jumlah_gaji, 0, ',', '.') }}
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="text-center p-4">
                            <div class="bg-success text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                                style="width: 80px; height: 80px;">
                                <i class="fas fa-money-bill-wave fa-2x"></i>
                            </div>
                            <h6 class="text-muted">Total Gaji</h6>
                            <h3 class="text-success amount-highlight">
                                Rp {{ number_format($gaji->jumlah_gaji, 0, ',', '.') }}
                            </h3>

                            @if ($gaji->is_auto_generated)
                                <div class="mt-3">
                                    <span class="badge bg-info">
                                        <i class="fas fa-robot me-1"></i>
                                        Auto Generated
                                    </span>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="text-center mt-4 mb-5">
            <a href="{{ route('karyawan.gaji.index') }}" class="btn btn-outline-secondary btn-lg me-3">
                <i class="fas fa-arrow-left me-2"></i>
                Kembali ke Daftar Gaji
            </a>
            @if ($gaji->status_pembayaran == 'paid')
                <a href="{{ route('karyawan.gaji.slip', $gaji->id_gaji) }}" class="btn btn-success btn-lg"
                    target="_blank">
                    <i class="fas fa-download me-2"></i>
                    Download Slip Gaji
                </a>
            @else
                <button class="btn btn-secondary btn-lg" disabled>
                    <i class="fas fa-download me-2"></i>
                    Slip Belum Tersedia
                </button>
            @endif
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
