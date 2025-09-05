@extends('layouts.navbar_admin')

@section('title', 'Sistem Absensi Karyawan')

@push('styles')
    <style>
        .stats-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 10px;
            padding: 20px;
            text-align: center;
            transition: transform 0.3s ease;
        }

        .stats-card:hover {
            transform: translateY(-5px);
        }

        .stats-number {
            font-size: 2rem;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .stats-label {
            font-size: 0.9rem;
            opacity: 0.9;
        }

        .table-responsive {
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .table th {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            font-weight: 600;
            border: none;
            padding: 12px 8px;
            text-align: center;
            font-size: 0.85rem;
        }

        .table td {
            padding: 10px 8px;
            vertical-align: middle;
            border-color: #e3e6f0;
        }

        .table tbody tr:hover {
            background-color: #f8f9fc;
        }

        .status-badge {
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .status-hadir {
            background-color: #d4edda;
            color: #155724;
        }

        .status-terlambat {
            background-color: #fff3cd;
            color: #856404;
        }

        .status-alfa {
            background-color: #f8d7da;
            color: #721c24;
        }

        .status-izin {
            background-color: #d1ecf1;
            color: #0c5460;
        }

        .status-sakit {
            background-color: #e2e3e5;
            color: #383d41;
        }

        .filter-section {
            background-color: #f8f9fc;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
        }
    </style>
@endpush

@section('content')
    <div class="container-fluid">
        <!-- Header -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">
                <i class="fas fa-calendar-check text-primary"></i> Sistem Absensi Karyawan
            </h1>
            <div class="d-flex gap-2">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#checkInModal">
                    <i class="fas fa-sign-in-alt"></i> Check In
                </button>
                <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#checkOutModal">
                    <i class="fas fa-sign-out-alt"></i> Check Out
                </button>
                <button class="btn btn-success"
                    onclick="window.location.href='{{ route('admin.absensi.laporan-harian') }}'">
                    <i class="fas fa-file-alt"></i> Laporan
                </button>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-triangle"></i>
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- Statistics Cards -->
        <div class="row mb-4">
            <div class="col-xl-2 col-md-4 col-6 mb-3">
                <div class="stats-card" style="background: linear-gradient(135deg, #28a745 0%, #20c997 100%);">
                    <div class="stats-number">{{ $stats['total_hadir'] ?? 0 }}</div>
                    <div class="stats-label">Hadir</div>
                </div>
            </div>
            <div class="col-xl-2 col-md-4 col-6 mb-3">
                <div class="stats-card" style="background: linear-gradient(135deg, #ffc107 0%, #fd7e14 100%);">
                    <div class="stats-number">{{ $stats['total_terlambat'] ?? 0 }}</div>
                    <div class="stats-label">Terlambat</div>
                </div>
            </div>
            <div class="col-xl-2 col-md-4 col-6 mb-3">
                <div class="stats-card" style="background: linear-gradient(135deg, #dc3545 0%, #e83e8c 100%);">
                    <div class="stats-number">{{ $stats['total_alfa'] ?? 0 }}</div>
                    <div class="stats-label">Alfa</div>
                </div>
            </div>
            <div class="col-xl-2 col-md-4 col-6 mb-3">
                <div class="stats-card" style="background: linear-gradient(135deg, #17a2b8 0%, #6f42c1 100%);">
                    <div class="stats-number">{{ $stats['total_izin'] ?? 0 }}</div>
                    <div class="stats-label">Izin</div>
                </div>
            </div>
            <div class="col-xl-2 col-md-4 col-6 mb-3">
                <div class="stats-card" style="background: linear-gradient(135deg, #6c757d 0%, #495057 100%);">
                    <div class="stats-number">{{ $stats['total_sakit'] ?? 0 }}</div>
                    <div class="stats-label">Sakit</div>
                </div>
            </div>
            <div class="col-xl-2 col-md-4 col-6 mb-3">
                <div class="stats-card" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                    <div class="stats-number">{{ number_format($stats['rata_durasi_kerja'] ?? 0, 1) }}h</div>
                    <div class="stats-label">Avg. Kerja</div>
                </div>
            </div>
        </div>

        <!-- Filter & Search -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Filter & Pencarian Data Absensi</h6>
            </div>
            <div class="card-body">
                <form method="GET" action="{{ route('admin.absensi.index') }}" class="row g-3">
                    <div class="col-md-3">
                        <label for="tanggal_mulai" class="form-label">Tanggal Mulai</label>
                        <input type="date" class="form-control" id="tanggal_mulai" name="tanggal_mulai"
                            value="{{ request('tanggal_mulai') }}">
                    </div>
                    <div class="col-md-3">
                        <label for="tanggal_selesai" class="form-label">Tanggal Selesai</label>
                        <input type="date" class="form-control" id="tanggal_selesai" name="tanggal_selesai"
                            value="{{ request('tanggal_selesai') }}">
                    </div>
                    <div class="col-md-2">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select" id="status" name="status">
                            <option value="">Semua Status</option>
                            <option value="hadir" {{ request('status') == 'hadir' ? 'selected' : '' }}>Hadir</option>
                            <option value="terlambat" {{ request('status') == 'terlambat' ? 'selected' : '' }}>Terlambat
                            </option>
                            <option value="alfa" {{ request('status') == 'alfa' ? 'selected' : '' }}>Alfa</option>
                            <option value="izin" {{ request('status') == 'izin' ? 'selected' : '' }}>Izin</option>
                            <option value="sakit" {{ request('status') == 'sakit' ? 'selected' : '' }}>Sakit</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label for="karyawan" class="form-label">Karyawan</label>
                        <input type="text" class="form-control" id="karyawan" name="karyawan"
                            placeholder="Nama karyawan..." value="{{ request('karyawan') }}">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">&nbsp;</label>
                        <div class="d-grid gap-1">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-search"></i> Filter
                            </button>
                            <a href="{{ route('admin.absensi.index') }}" class="btn btn-outline-secondary btn-sm">
                                Reset
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Data Table -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Data Absensi Karyawan</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                        <thead class="table-dark">
                            <tr>
                                <th width="5%">No</th>
                                <th width="15%">Nama Karyawan</th>
                                <th width="10%">Tanggal</th>
                                <th width="8%">Jam Masuk</th>
                                <th width="8%">Jam Keluar</th>
                                <th width="8%">Durasi</th>
                                <th width="10%">Status</th>
                                <th width="10%">Keterlambatan</th>
                                <th width="15%">Keterangan</th>
                                <th width="11%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($absensi as $index => $item)
                                <tr>
                                    <td>{{ $absensi->firstItem() + $index }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-initial rounded-circle bg-primary text-white me-2"
                                                style="width: 30px; height: 30px; display: flex; align-items: center; justify-content: center; font-size: 12px;">
                                                {{ strtoupper(substr($item->karyawan->nama, 0, 2)) }}
                                            </div>
                                            <div>
                                                <div class="fw-bold">{{ $item->karyawan->nama }}</div>
                                                <small
                                                    class="text-muted">{{ $item->karyawan->jabatan->nama ?? 'N/A' }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}</td>
                                    <td>
                                        @if ($item->jam_masuk)
                                            <span
                                                class="badge bg-success">{{ \Carbon\Carbon::parse($item->jam_masuk)->format('H:i') }}</span>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($item->jam_keluar)
                                            <span
                                                class="badge bg-info">{{ \Carbon\Carbon::parse($item->jam_keluar)->format('H:i') }}</span>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($item->durasi_kerja)
                                            {{ number_format($item->durasi_kerja, 1) }}h
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        @php
                                            $statusColors = [
                                                'hadir' => 'success',
                                                'terlambat' => 'warning',
                                                'alfa' => 'danger',
                                                'izin' => 'info',
                                                'sakit' => 'secondary',
                                            ];
                                        @endphp
                                        <span class="badge bg-{{ $statusColors[$item->status] ?? 'secondary' }}">
                                            {{ ucfirst($item->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        @if ($item->keterlambatan > 0)
                                            <span class="text-warning fw-bold">{{ $item->keterlambatan }} menit</span>
                                        @else
                                            <span class="text-success">Tepat waktu</span>
                                        @endif
                                    </td>
                                    <td>{{ $item->keterangan ?? '-' }}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            @if (!$item->jam_keluar && $item->status == 'hadir')
                                                <button class="btn btn-warning btn-sm" title="Check Out"
                                                    onclick="checkOut('{{ $item->id }}')">
                                                    <i class="fas fa-sign-out-alt"></i>
                                                </button>
                                            @endif
                                            <button class="btn btn-info btn-sm" title="Detail"
                                                onclick="showDetail('{{ $item->id }}')">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button class="btn btn-danger btn-sm" title="Hapus"
                                                onclick="deleteAbsensi('{{ $item->id }}')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="10" class="text-center py-4">
                                        <div class="text-muted">
                                            <i class="fas fa-inbox fa-3x mb-3"></i>
                                            <p>Tidak ada data absensi ditemukan</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            @if ($absensi->hasPages())
                <div class="pagination-container">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="pagination-info">
                            Menampilkan {{ $absensi->firstItem() }} sampai {{ $absensi->lastItem() }}
                            dari {{ $absensi->total() }} data
                        </div>
                        <div class="pagination-controls">
                            {{ $absensi->appends(request()->query())->links('pagination.custom') }}
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
    }

    .pagination .page-item:last-child .page-link {
    border-top-right-radius: 6px;
    border-bottom-right-radius: 6px;
    }

    .pagination .page-link {
    color: #667eea;
    border: none;
    padding: 8px 12px;
    font-size: 0.875rem;
    font-weight: 500;
    border-right: 1px solid #e3e6f0;
    }

    .pagination .page-link:hover {
    color: #764ba2;
    background-color: #f8f9fc;
    z-index: 2;
    }

    .pagination .page-item.active .page-link {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-color: #667eea;
    color: white;
    font-weight: 600;
    }

    .pagination .page-item.disabled .page-link {
    color: #adb5bd;
    background-color: #f8f9fa;
    }

    /* Better responsive for pagination */
    @media (max-width: 768px) {
    .bulk-actions {
    padding: 15px;
    }

    .pagination-info {
    font-size: 0.8rem;
    padding: 6px 10px;
    }

    .pagination .page-link {
    padding: 6px 8px;
    font-size: 0.8rem;
    }
    }

    .info-badge {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 8px 15px;
    border-radius: 20px;
    font-size: 0.8rem;
    display: inline-block;
    margin-bottom: 10px;
    }

    /* Responsive table improvements */
    @media (max-width: 768px) {
    .table-responsive {
    font-size: 0.8rem;
    }

    .btn-group .btn {
    padding: 2px 6px;
    font-size: 0.7rem;
    }

    .table th,
    .table td {
    padding: 8px 4px;
    }
    }
    </style>

    <div class="container-fluid">
        <!-- Header -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Kelola Absensi Karyawan</h1>
            <div class="d-flex gap-2">
                <a href="{{ route('admin.absensi.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Tambah Absensi
                </a>
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#importModal">
                    <i class="fas fa-upload"></i> Import Data
                </button>
                <a href="{{ route('admin.absensi.export') }}?bulan={{ $bulan }}&tahun={{ $tahun }}"
                    class="btn btn-info">
                    <i class="fas fa-download"></i> Export
                </a>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- Filter dan Statistik -->
        <div class="row mb-4">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h6 class="m-0 font-weight-bold text-primary">Filter Data Absensi</h6>
                    </div>
                    <div class="card-body">
                        <form method="GET" action="{{ route('admin.absensi') }}" class="row g-3">
                            <div class="col-md-2">
                                <label for="tanggal" class="form-label">Tanggal</label>
                                <input type="date" name="tanggal" id="tanggal" class="form-control"
                                    value="{{ $tanggal }}">
                            </div>
                            <div class="col-md-2">
                                <label for="bulan" class="form-label">Bulan</label>
                                <select name="bulan" id="bulan" class="form-select">
                                    @for ($i = 1; $i <= 12; $i++)
                                        <option value="{{ $i }}" {{ $i == $bulan ? 'selected' : '' }}>
                                            {{ Carbon\Carbon::create(null, $i, 1)->format('F') }}
                                        </option>
                                    @endfor
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label for="tahun" class="form-label">Tahun</label>
                                <select name="tahun" id="tahun" class="form-select">
                                    @for ($year = date('Y') - 2; $year <= date('Y') + 1; $year++)
                                        <option value="{{ $year }}" {{ $year == $tahun ? 'selected' : '' }}>
                                            {{ $year }}
                                        </option>
                                    @endfor
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="karyawan_id" class="form-label">Karyawan</label>
                                <select name="karyawan_id" id="karyawan_id" class="form-select">
                                    <option value="">Semua Karyawan</option>
                                    @foreach ($karyawanList as $karyawan)
                                        <option value="{{ $karyawan->id_karyawan }}"
                                            {{ $karyawan->id_karyawan == $karyawan_id ? 'selected' : '' }}>
                                            {{ $karyawan->nama }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">&nbsp;</label>
                                <button type="submit" class="btn btn-primary d-block">
                                    <i class="fas fa-filter"></i> Filter
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h6 class="m-0 font-weight-bold text-primary">Statistik Absensi</h6>
                    </div>
                    <div class="card-body">
                        <div class="row text-center">
                            <div class="col-6">
                                <div class="mb-2">
                                    <small class="text-success">Hadir</small>
                                    <h6 class="mb-0 text-success">{{ $stats['total_hadir'] }}</h6>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-2">
                                    <small class="text-warning">Terlambat</small>
                                    <h6 class="mb-0 text-warning">{{ $stats['total_terlambat'] }}</h6>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-2">
                                    <small class="text-danger">Alpha</small>
                                    <h6 class="mb-0 text-danger">{{ $stats['total_alpha'] }}</h6>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-2">
                                    <small class="text-info">Izin</small>
                                    <h6 class="mb-0 text-info">{{ $stats['total_izin'] }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Data Absensi -->
        <div class="card">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-primary">Data Absensi</h6>
            </div>
            <div class="card-body">
                @if ($absensiList->count() > 0)
                    <!-- Info Badge -->
                    <div class="mb-3">
                        <span class="info-badge">
                            <i class="fas fa-list"></i>
                            Menampilkan {{ $absensiList->firstItem() }} - {{ $absensiList->lastItem() }}
                            dari {{ $absensiList->total() }} data
                        </span>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th style="width: 50px;">
                                        <input type="checkbox" id="selectAll" class="form-check-input">
                                    </th>
                                    <th style="width: 100px;">Tanggal</th>
                                    <th style="width: 180px;">Nama Karyawan</th>
                                    <th style="width: 120px;">Jabatan</th>
                                    <th style="width: 100px;">Shift</th>
                                    <th style="width: 90px;">Masuk</th>
                                    <th style="width: 90px;">Keluar</th>
                                    <th style="width: 80px;">Status</th>
                                    <th style="width: 150px;">Keterangan</th>
                                    <th style="width: 120px;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($absensiList as $absensi)
                                    <tr>
                                        <td class="text-center">
                                            <input type="checkbox" name="selected_ids[]"
                                                value="{{ $absensi->id_absensi }}" class="select-item form-check-input">
                                        </td>
                                        <td class="text-center">
                                            <strong>{{ Carbon\Carbon::parse($absensi->tanggal)->format('d/m/Y') }}</strong>
                                            <br>
                                            <small
                                                class="text-muted">{{ Carbon\Carbon::parse($absensi->tanggal)->format('l') }}</small>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-circle me-2"
                                                    style="width: 32px; height: 32px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-size: 0.8rem; font-weight: bold;">
                                                    {{ substr($absensi->karyawan->nama ?? 'N', 0, 1) }}
                                                </div>
                                                <div>
                                                    <strong>{{ $absensi->karyawan->nama ?? 'N/A' }}</strong>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <span
                                                class="badge bg-light text-dark">{{ $absensi->karyawan->jabatan->nama_jabatan ?? 'N/A' }}</span>
                                        </td>
                                        <td class="text-center">
                                            @if ($absensi->shift)
                                                <span class="badge bg-info">{{ $absensi->shift->nama_shift }}</span>
                                            @else
                                                <span class="badge bg-secondary">N/A</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if ($absensi->jam_masuk)
                                                <i class="fas fa-clock text-success me-1"></i>
                                                <strong>{{ Carbon\Carbon::parse($absensi->jam_masuk)->format('H:i') }}</strong>
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if ($absensi->jam_keluar)
                                                <i class="fas fa-clock text-danger me-1"></i>
                                                <strong>{{ Carbon\Carbon::parse($absensi->jam_keluar)->format('H:i') }}</strong>
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if ($absensi->status == 'Hadir')
                                                <span class="badge bg-success"><i class="fas fa-check"></i> Hadir</span>
                                            @elseif($absensi->status == 'Izin')
                                                <span class="badge bg-warning"><i class="fas fa-exclamation"></i>
                                                    Izin</span>
                                            @elseif($absensi->status == 'Sakit')
                                                <span class="badge bg-info"><i class="fas fa-thermometer"></i>
                                                    Sakit</span>
                                            @elseif($absensi->status == 'Alpa')
                                                <span class="badge bg-danger"><i class="fas fa-times"></i> Alpa</span>
                                            @else
                                                <span class="badge bg-secondary">{{ ucfirst($absensi->status) }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($absensi->keterangan)
                                                <small
                                                    class="text-muted">{{ Str::limit($absensi->keterangan, 30) }}</small>
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('admin.absensi.show', $absensi->id_absensi) }}"
                                                    class="btn btn-sm btn-outline-info" title="Lihat Detail">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('admin.absensi.edit', $absensi->id_absensi) }}"
                                                    class="btn btn-sm btn-outline-warning" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('admin.absensi.destroy', $absensi->id_absensi) }}"
                                                    method="POST" class="d-inline"
                                                    onsubmit="return confirm('Yakin hapus data ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger"
                                                        title="Hapus">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Bulk Actions & Pagination -->
                    <div class="bulk-actions">
                        <div class="row align-items-center">
                            <div class="col-lg-4 col-md-12 mb-3 mb-lg-0">
                                <form action="{{ route('admin.absensi.bulk-update') }}" method="POST" id="bulkForm">
                                    @csrf
                                    <div class="d-flex align-items-center gap-2 flex-wrap">
                                        <label class="form-label mb-0 fw-bold text-muted">Aksi Massal:</label>
                                        <select name="status" class="form-select form-select-sm" style="width: 130px;"
                                            required>
                                            <option value="">Pilih Status</option>
                                            <option value="Hadir">✅ Hadir</option>
                                            <option value="Izin">⚠️ Izin</option>
                                            <option value="Sakit">🌡️ Sakit</option>
                                            <option value="Alpa">❌ Alpa</option>
                                        </select>
                                        <button type="submit" class="btn btn-sm btn-primary"
                                            onclick="return confirmBulkAction()">
                                            <i class="fas fa-edit"></i> Update
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-lg-8 col-md-12">
                                <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                                    <div class="pagination-info">
                                        <small class="text-muted fw-bold">
                                            <i class="fas fa-info-circle text-primary"></i>
                                            Menampilkan
                                            <span class="badge bg-primary">{{ $absensiList->firstItem() ?? 0 }}</span> -
                                            <span class="badge bg-primary">{{ $absensiList->lastItem() ?? 0 }}</span>
                                            dari
                                            <span class="badge bg-success">{{ $absensiList->total() }}</span>
                                            data absensi
                                        </small>
                                    </div>
                                    <div class="pagination-controls d-flex align-items-center gap-3">
                                        @if ($absensiList->total() > 0)
                                            <div class="per-page-selector">
                                                <form method="GET" action="{{ route('admin.absensi') }}"
                                                    class="d-flex align-items-center gap-2">
                                                    @foreach (request()->query() as $key => $value)
                                                        @if ($key !== 'per_page')
                                                            <input type="hidden" name="{{ $key }}"
                                                                value="{{ $value }}">
                                                        @endif
                                                    @endforeach
                                                    <small class="text-muted">Per halaman:</small>
                                                    <select name="per_page" class="form-select form-select-sm"
                                                        style="width: 70px;" onchange="this.form.submit()">
                                                        <option value="10"
                                                            {{ request('per_page', 15) == 10 ? 'selected' : '' }}>10
                                                        </option>
                                                        <option value="15"
                                                            {{ request('per_page', 15) == 15 ? 'selected' : '' }}>15
                                                        </option>
                                                        <option value="25"
                                                            {{ request('per_page', 15) == 25 ? 'selected' : '' }}>25
                                                        </option>
                                                        <option value="50"
                                                            {{ request('per_page', 15) == 50 ? 'selected' : '' }}>50
                                                        </option>
                                                    </select>
                                                </form>
                                            </div>
                                        @endif
                                        @if ($absensiList->hasPages())
                                            <nav aria-label="Pagination Navigation">
                                                {{ $absensiList->appends(request()->query())->links('pagination.custom') }}
                                            </nav>
                                        @else
                                            <small class="text-muted">
                                                <i class="fas fa-layer-group text-info"></i> Halaman 1 dari 1
                                            </small>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="text-center py-5">
                        <div class="mb-4">
                            <div
                                style="width: 80px; height: 80px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto; box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);">
                                <i class="fas fa-calendar-times fa-2x text-white"></i>
                            </div>
                        </div>
                        <h4 class="text-muted mb-3">Belum ada data absensi</h4>
                        <p class="text-muted mb-4">
                            Data absensi karyawan untuk periode yang dipilih belum tersedia.<br>
                            Silakan tambah data absensi atau ubah filter pencarian.
                        </p>
                        <div class="d-flex justify-content-center gap-2">
                            <a href="{{ route('admin.absensi.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Tambah Absensi
                            </a>
                            <button type="button" class="btn btn-outline-secondary"
                                onclick="document.querySelector('form').reset(); document.querySelector('form').submit();">
                                <i class="fas fa-filter"></i> Reset Filter
                            </button>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Modal Import -->
    <div class="modal fade" id="importModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Import Data Absensi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('admin.absensi.import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="file" class="form-label">File CSV/Excel</label>
                            <input type="file" name="file" id="file" class="form-control"
                                accept=".csv,.xlsx,.xls" required>
                            <div class="form-text">
                                Format file: CSV atau Excel (.xlsx, .xls)
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-upload"></i> Import
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        // Select All functionality
        document.getElementById('selectAll').addEventListener('change', function() {
            const checkboxes = document.querySelectorAll('.select-item');
            checkboxes.forEach(checkbox => {
                checkbox.checked = this.checked;
            });
        });

        // Bulk action confirmation
        function confirmBulkAction() {
            const selectedItems = document.querySelectorAll('.select-item:checked');
            if (selectedItems.length === 0) {
                alert('Pilih minimal satu item untuk diupdate.');
                return false;
            }

            // Add selected IDs to form
            const form = document.getElementById('bulkForm');
            const existingInputs = form.querySelectorAll('input[name="selected_ids[]"]');
            existingInputs.forEach(input => input.remove());

            selectedItems.forEach(item => {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'selected_ids[]';
                input.value = item.value;
                form.appendChild(input);
            });

            return confirm(`Yakin ingin mengupdate status ${selectedItems.length} item yang dipilih?`);
        }

        // Auto-clear tanggal filter when bulan/tahun changed
        document.getElementById('bulan').addEventListener('change', function() {
            document.getElementById('tanggal').value = '';
        });

        document.getElementById('tahun').addEventListener('change', function() {
            document.getElementById('tanggal').value = '';
        });
    </script>

    <!-- Modal Check In -->
    <div class="modal fade" id="checkInModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Check In Karyawan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="checkInForm" method="POST" action="{{ route('admin.absensi.check-in') }}">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="karyawan_id" class="form-label">Karyawan</label>
                            <select class="form-select" id="karyawan_id" name="karyawan_id" required>
                                <option value="">Pilih Karyawan</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="jam_masuk" class="form-label">Jam Masuk</label>
                            <input type="time" class="form-control" id="jam_masuk" name="jam_masuk"
                                value="{{ now()->format('H:i') }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="keterangan_masuk" class="form-label">Keterangan</label>
                            <textarea class="form-control" id="keterangan_masuk" name="keterangan" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Check In</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Check Out -->
    <div class="modal fade" id="checkOutModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Check Out Karyawan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="checkOutForm" method="POST" action="{{ route('admin.absensi.check-out') }}">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="absensi_id" class="form-label">Karyawan Yang Belum Check Out</label>
                            <select class="form-select" id="absensi_id" name="absensi_id" required>
                                <option value="">Pilih Karyawan</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="jam_keluar" class="form-label">Jam Keluar</label>
                            <input type="time" class="form-control" id="jam_keluar" name="jam_keluar"
                                value="{{ now()->format('H:i') }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="keterangan_keluar" class="form-label">Keterangan</label>
                            <textarea class="form-control" id="keterangan_keluar" name="keterangan" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-warning">Check Out</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Detail -->
    <div class="modal fade" id="detailModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detail Absensi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body" id="detailContent">
                    <!-- Detail content akan diload via Ajax -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // JavaScript functions untuk absensi
        function checkOut(absensiId) {
            if (confirm('Yakin ingin check out karyawan ini?')) {
                $('#checkOutModal').modal('show');
                $('#absensi_id').val(absensiId);
            }
        }

        function showDetail(absensiId) {
            $('#detailModal').modal('show');
            $('#detailContent').html('<div class="text-center"><i class="fas fa-spinner fa-spin"></i> Loading...</div>');

            // Load detail via Ajax jika route tersedia
            setTimeout(function() {
                $('#detailContent').html(`
            <div class="row">
                <div class="col-md-6">
                    <h6>Informasi Karyawan</h6>
                    <p>Data detail absensi ID: ${absensiId}</p>
                </div>
            </div>
        `);
            }, 1000);
        }

        function deleteAbsensi(absensiId) {
            if (confirm('Yakin ingin menghapus data absensi ini?')) {
                // Form delete action
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = '/admin/absensi/' + absensiId;

                const methodField = document.createElement('input');
                methodField.type = 'hidden';
                methodField.name = '_method';
                methodField.value = 'DELETE';

                const tokenField = document.createElement('input');
                tokenField.type = 'hidden';
                tokenField.name = '_token';
                tokenField.value = '{{ csrf_token() }}';

                form.appendChild(methodField);
                form.appendChild(tokenField);
                document.body.appendChild(form);
                form.submit();
            }
        }
    </script>
@endsection
