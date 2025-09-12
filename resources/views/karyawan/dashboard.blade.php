<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Karyawan - Yogya Group Toserba</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .navbar-brand {
            font-weight: bold;
        }

        .stats-card {
            border-radius: 15px;
            border: none;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            transition: transform 0.3s ease;
        }

        .stats-card:hover {
            transform: translateY(-5px);
        }

        .stats-icon {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            color: white;
        }

        .recent-gaji-card {
            border-radius: 15px;
            border: none;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        }

        .table-hover tbody tr:hover {
            background-color: rgba(0, 123, 255, 0.1);
        }

        .badge-status {
            font-size: 0.75rem;
            padding: 0.25rem 0.5rem;
        }

        .welcome-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 15px;
            border: none;
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
                        <a class="nav-link active" href="{{ route('karyawan.dashboard') }}">
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
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- Welcome Card -->
        <div class="card welcome-card mb-4">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h3 class="mb-2">Selamat Datang, {{ $karyawan->nama }}!</h3>
                        <p class="mb-1"><i
                                class="fas fa-briefcase me-2"></i>{{ $karyawan->jabatan->nama_jabatan ?? 'Tidak ada jabatan' }}
                        </p>
                        <p class="mb-0"><i
                                class="fas fa-building me-2"></i>{{ $karyawan->cabang->nama_cabang ?? 'Tidak ada cabang' }}
                        </p>
                    </div>
                    <div class="col-md-4 text-end">
                        <i class="fas fa-user-tie fa-4x opacity-75"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="row mb-4">
            <div class="col-md-3 mb-3">
                <div class="card stats-card">
                    <div class="card-body text-center">
                        <div class="stats-icon mx-auto mb-3"
                            style="background: linear-gradient(135deg, #28a745, #20c997);">
                            <i class="fas fa-money-bill-wave"></i>
                        </div>
                        <h5 class="card-title">Total Gaji</h5>
                        <h3 class="text-success mb-0">Rp {{ number_format($totalGaji, 0, ',', '.') }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card stats-card">
                    <div class="card-body text-center">
                        <div class="stats-icon mx-auto mb-3"
                            style="background: linear-gradient(135deg, #007bff, #6610f2);">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <h5 class="card-title">Gaji Terbayar</h5>
                        <h3 class="text-primary mb-0">{{ $totalPaid }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card stats-card">
                    <div class="card-body text-center">
                        <div class="stats-icon mx-auto mb-3"
                            style="background: linear-gradient(135deg, #ffc107, #fd7e14);">
                            <i class="fas fa-clock"></i>
                        </div>
                        <h5 class="card-title">Gaji Pending</h5>
                        <h3 class="text-warning mb-0">{{ $totalPending }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card stats-card">
                    <div class="card-body text-center">
                        <div class="stats-icon mx-auto mb-3"
                            style="background: linear-gradient(135deg, #17a2b8, #6f42c1);">
                            <i class="fas fa-calendar-month"></i>
                        </div>
                        <h5 class="card-title">Gaji Bulan Ini</h5>
                        <h3 class="text-info mb-0">Rp {{ number_format($thisMonthGaji, 0, ',', '.') }}</h3>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Gaji -->
        <div class="card recent-gaji-card">
            <div class="card-header bg-white">
                <div class="row align-items-center">
                    <div class="col">
                        <h5 class="mb-0">
                            <i class="fas fa-history me-2"></i>
                            Riwayat Gaji Terbaru
                        </h5>
                    </div>
                    <div class="col-auto">
                        <a href="{{ route('karyawan.gaji.index') }}" class="btn btn-outline-primary btn-sm">
                            <i class="fas fa-eye me-1"></i>Lihat Semua
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                @if ($recentGaji->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Periode</th>
                                    <th>Gaji Pokok</th>
                                    <th>Tunjangan</th>
                                    <th>Total Gaji</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($recentGaji as $gaji)
                                    <tr>
                                        <td>
                                            <strong>{{ date('F Y', strtotime($gaji->periode_gaji)) }}</strong>
                                        </td>
                                        <td>Rp {{ number_format($gaji->gaji_pokok, 0, ',', '.') }}</td>
                                        <td>Rp {{ number_format($gaji->tunjangan, 0, ',', '.') }}</td>
                                        <td>
                                            <strong>Rp {{ number_format($gaji->jumlah_gaji, 0, ',', '.') }}</strong>
                                        </td>
                                        <td>
                                            @if ($gaji->status_pembayaran == 'paid')
                                                <span class="badge bg-success badge-status">
                                                    <i class="fas fa-check me-1"></i>Terbayar
                                                </span>
                                            @elseif($gaji->status_pembayaran == 'pending')
                                                <span class="badge bg-warning badge-status">
                                                    <i class="fas fa-clock me-1"></i>Pending
                                                </span>
                                            @else
                                                <span class="badge bg-secondary badge-status">
                                                    <i
                                                        class="fas fa-question me-1"></i>{{ ucfirst($gaji->status_pembayaran) }}
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('karyawan.gaji.detail', $gaji->id_gaji) }}"
                                                class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            @if ($gaji->status_pembayaran == 'paid')
                                                <a href="{{ route('karyawan.gaji.slip', $gaji->id_gaji) }}"
                                                    class="btn btn-sm btn-outline-success" target="_blank">
                                                    <i class="fas fa-download"></i>
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-4">
                        <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                        <h5 class="text-muted">Belum ada data gaji</h5>
                        <p class="text-muted">Data gaji akan muncul setelah admin memproses penggajian</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
