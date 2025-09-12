<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gaji Saya - Yogya Group Toserba</title>
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
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            color: white;
        }

        .gaji-card {
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

        .search-box {
            border-radius: 15px;
            border: 2px solid #e9ecef;
        }

        .search-box:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }

        .page-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 15px;
            padding: 2rem;
            margin-bottom: 2rem;
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
                        <a class="nav-link active" href="{{ route('karyawan.gaji.index') }}">
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
                        <i class="fas fa-money-bill-wave me-2"></i>
                        Gaji Saya
                    </h2>
                    <p class="mb-0">{{ $karyawan->nama }} -
                        {{ $karyawan->jabatan->nama_jabatan ?? 'Tidak ada jabatan' }}</p>
                </div>
                <div class="col-md-4 text-end">
                    <i class="fas fa-coins fa-4x opacity-75"></i>
                </div>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="row mb-4">
            <div class="col-md-3 mb-3">
                <div class="card stats-card">
                    <div class="card-body text-center">
                        <div class="stats-icon mx-auto mb-2"
                            style="background: linear-gradient(135deg, #28a745, #20c997);">
                            <i class="fas fa-money-bill-wave"></i>
                        </div>
                        <h6 class="card-title">Total Gaji</h6>
                        <h5 class="text-success mb-0">Rp {{ number_format($totalGaji, 0, ',', '.') }}</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card stats-card">
                    <div class="card-body text-center">
                        <div class="stats-icon mx-auto mb-2"
                            style="background: linear-gradient(135deg, #007bff, #6610f2);">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <h6 class="card-title">Terbayar</h6>
                        <h5 class="text-primary mb-0">Rp {{ number_format($totalPaid, 0, ',', '.') }}</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card stats-card">
                    <div class="card-body text-center">
                        <div class="stats-icon mx-auto mb-2"
                            style="background: linear-gradient(135deg, #ffc107, #fd7e14);">
                            <i class="fas fa-clock"></i>
                        </div>
                        <h6 class="card-title">Pending</h6>
                        <h5 class="text-warning mb-0">Rp {{ number_format($totalPending, 0, ',', '.') }}</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card stats-card">
                    <div class="card-body text-center">
                        <div class="stats-icon mx-auto mb-2"
                            style="background: linear-gradient(135deg, #17a2b8, #6f42c1);">
                            <i class="fas fa-calendar-year"></i>
                        </div>
                        <h6 class="card-title">Tahun Ini</h6>
                        <h5 class="text-info mb-0">Rp {{ number_format($totalGajiThisYear, 0, ',', '.') }}</h5>
                    </div>
                </div>
            </div>
        </div>

        <!-- Gaji Table -->
        <div class="card gaji-card">
            <div class="card-header bg-white">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <h5 class="mb-0">
                            <i class="fas fa-list me-2"></i>
                            Riwayat Gaji
                        </h5>
                    </div>
                    <div class="col-md-6">
                        <form method="GET" action="{{ route('karyawan.gaji.index') }}">
                            <div class="input-group">
                                <input type="text" class="form-control search-box" name="search"
                                    value="{{ $search }}"
                                    placeholder="Cari periode, status, atau keterangan...">
                                <button class="btn btn-outline-primary" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                                @if ($search)
                                    <a href="{{ route('karyawan.gaji.index') }}" class="btn btn-outline-secondary">
                                        <i class="fas fa-times"></i>
                                    </a>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="card-body">
                @if ($gajiData->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Periode</th>
                                    <th>Gaji Pokok</th>
                                    <th>Tunjangan</th>
                                    <th>Bonus</th>
                                    <th>Potongan</th>
                                    <th>Total Gaji</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($gajiData as $gaji)
                                    <tr>
                                        <td>
                                            <strong>{{ date('F Y', strtotime($gaji->periode_gaji)) }}</strong>
                                            <br>
                                            <small
                                                class="text-muted">{{ date('d M Y', strtotime($gaji->created_at)) }}</small>
                                        </td>
                                        <td>Rp {{ number_format($gaji->gaji_pokok, 0, ',', '.') }}</td>
                                        <td>Rp {{ number_format($gaji->tunjangan, 0, ',', '.') }}</td>
                                        <td>Rp {{ number_format($gaji->bonus, 0, ',', '.') }}</td>
                                        <td>Rp {{ number_format($gaji->potongan, 0, ',', '.') }}</td>
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
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('karyawan.gaji.detail', $gaji->id_gaji) }}"
                                                    class="btn btn-sm btn-outline-primary" title="Lihat Detail">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                @if ($gaji->status_pembayaran == 'paid')
                                                    <a href="{{ route('karyawan.gaji.slip', $gaji->id_gaji) }}"
                                                        class="btn btn-sm btn-outline-success" target="_blank"
                                                        title="Download Slip Gaji">
                                                        <i class="fas fa-download"></i>
                                                    </a>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <div>
                            <span class="text-muted">
                                Menampilkan {{ $gajiData->firstItem() }} sampai {{ $gajiData->lastItem() }}
                                dari {{ $gajiData->total() }} data
                            </span>
                        </div>
                        <div>
                            {{ $gajiData->appends(request()->input())->links() }}
                        </div>
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="fas fa-inbox fa-4x text-muted mb-4"></i>
                        <h4 class="text-muted">
                            @if ($search)
                                Tidak ada data gaji yang sesuai dengan pencarian "{{ $search }}"
                            @else
                                Belum ada data gaji
                            @endif
                        </h4>
                        <p class="text-muted">
                            @if ($search)
                                Coba gunakan kata kunci pencarian yang berbeda
                            @else
                                Data gaji akan muncul setelah admin memproses penggajian
                            @endif
                        </p>
                        @if ($search)
                            <a href="{{ route('karyawan.gaji.index') }}" class="btn btn-outline-primary">
                                <i class="fas fa-refresh me-1"></i>Tampilkan Semua Data
                            </a>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
