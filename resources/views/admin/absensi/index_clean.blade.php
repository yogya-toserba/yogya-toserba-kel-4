@extends('layouts.navbar_admin')

@section('title', 'Kelola Absensi Karyawan')

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
                <i class="fas fa-clock text-primary"></i> Kelola Absensi Karyawan
            </h1>
        </div>

        <!-- Statistik Cards -->
        <div class="row mb-4">
            <div class="col-xl-3 col-md-6 col-6 mb-3">
                <div class="stats-card" style="background: linear-gradient(135deg, #28a745 0%, #20c997 100%);">
                    <div class="stats-number">{{ $stats['total_hadir'] ?? 0 }}</div>
                    <div class="stats-label">Hadir</div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 col-6 mb-3">
                <div class="stats-card" style="background: linear-gradient(135deg, #dc3545 0%, #e83e8c 100%);">
                    <div class="stats-number">{{ $stats['total_alfa'] ?? 0 }}</div>
                    <div class="stats-label">Alfa</div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 col-6 mb-3">
                <div class="stats-card" style="background: linear-gradient(135deg, #17a2b8 0%, #6f42c1 100%);">
                    <div class="stats-number">{{ $stats['total_izin'] ?? 0 }}</div>
                    <div class="stats-label">Izin</div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 col-6 mb-3">
                <div class="stats-card" style="background: linear-gradient(135deg, #6c757d 0%, #495057 100%);">
                    <div class="stats-number">{{ $stats['total_sakit'] ?? 0 }}</div>
                    <div class="stats-label">Sakit</div>
                </div>
            </div>
        </div>

        <!-- Filter & Search -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Filter Data Absensi</h6>
            </div>
            <div class="card-body">
                <form method="GET" action="{{ route('admin.absensi.index') }}">
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label for="tanggal" class="form-label">Tanggal</label>
                            <input type="date" class="form-control" id="tanggal" name="tanggal"
                                value="{{ request('tanggal') }}">
                        </div>
                        <div class="col-md-2 mb-3">
                            <label for="bulan" class="form-label">Bulan</label>
                            <select class="form-control" id="bulan" name="bulan">
                                @for ($i = 1; $i <= 12; $i++)
                                    <option value="{{ $i }}"
                                        {{ request('bulan', now()->month) == $i ? 'selected' : '' }}>
                                        {{ DateTime::createFromFormat('!m', $i)->format('F') }}
                                    </option>
                                @endfor
                            </select>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label for="tahun" class="form-label">Tahun</label>
                            <select class="form-control" id="tahun" name="tahun">
                                @for ($year = 2020; $year <= now()->year + 1; $year++)
                                    <option value="{{ $year }}"
                                        {{ request('tahun', now()->year) == $year ? 'selected' : '' }}>
                                        {{ $year }}
                                    </option>
                                @endfor
                            </select>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="karyawan_id" class="form-label">Karyawan</label>
                            <select class="form-control" id="karyawan_id" name="karyawan_id">
                                <option value="">Semua Karyawan</option>
                                @foreach ($karyawanList as $karyawan)
                                    <option value="{{ $karyawan->id_karyawan }}"
                                        {{ request('karyawan_id') == $karyawan->id_karyawan ? 'selected' : '' }}>
                                        {{ $karyawan->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label class="form-label">&nbsp;</label>
                            <div>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-search"></i> Filter
                                </button>
                                <a href="{{ route('admin.absensi.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-refresh"></i> Reset
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Data Table -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Data Absensi</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th width="5%">No</th>
                                <th width="15%">Nama Karyawan</th>
                                <th width="10%">Tanggal</th>
                                <th width="8%">Masuk</th>
                                <th width="8%">Keluar</th>
                                <th width="10%">Status</th>
                                <th width="10%">Shift</th>
                                <th width="20%">Keterangan</th>
                                <th width="14%">Aksi</th>
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
                                                {{ strtoupper(substr($item->jadwalKerja->karyawan->nama ?? 'N/A', 0, 2)) }}
                                            </div>
                                            <div>
                                                <div class="fw-bold">{{ $item->jadwalKerja->karyawan->nama ?? 'N/A' }}
                                                </div>
                                                <small
                                                    class="text-muted">{{ $item->jadwalKerja->karyawan->jabatan->nama_jabatan ?? 'N/A' }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d/m/Y') }}</td>
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
                                        @php
                                            $statusClass = 'status-hadir';
                                            switch (strtolower($item->status)) {
                                                case 'alfa':
                                                case 'alpa':
                                                    $statusClass = 'status-alfa';
                                                    break;
                                                case 'izin':
                                                    $statusClass = 'status-izin';
                                                    break;
                                                case 'sakit':
                                                    $statusClass = 'status-sakit';
                                                    break;
                                            }
                                        @endphp
                                        <span class="status-badge {{ $statusClass }}">{{ $item->status }}</span>
                                    </td>
                                    <td>
                                        @if ($item->jadwalKerja && $item->jadwalKerja->shift)
                                            <span class="badge bg-info">{{ $item->jadwalKerja->shift->nama_shift }}</span>
                                        @else
                                            <span class="badge bg-secondary">N/A</span>
                                        @endif
                                    </td>
                                    <td>
                                        <small>{{ $item->keterangan ?? '-' }}</small>
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <button type="button" class="btn btn-sm btn-outline-primary"
                                                onclick="viewDetail({{ $item->id_absensi }})">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button type="button" class="btn btn-sm btn-outline-success"
                                                onclick="editAbsensi({{ $item->id_absensi }})">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="text-center py-4">
                                        <i class="fas fa-inbox fa-2x text-muted mb-2"></i>
                                        <p class="text-muted mb-0">Tidak ada data absensi</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-between align-items-center mt-3">
                    <div class="pagination-info">
                        Menampilkan {{ $absensi->firstItem() ?? 0 }} - {{ $absensi->lastItem() ?? 0 }} dari
                        {{ $absensi->total() }} data
                    </div>
                    <div>
                        {{ $absensi->appends(request()->query())->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- View Detail Modal -->
    <div class="modal fade" id="viewDetailModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detail Absensi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body" id="modalDetailContent">
                    <!-- Content will be loaded here -->
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Absensi Modal -->
    <div class="modal fade" id="editAbsensiModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Absensi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body" id="modalEditContent">
                    <!-- Content will be loaded here -->
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function viewDetail(id) {
            // Load detail content via AJAX
            console.log('View detail for ID:', id);
            $('#viewDetailModal').modal('show');
        }

        function editAbsensi(id) {
            // Load edit form via AJAX
            console.log('Edit absensi for ID:', id);
            $('#editAbsensiModal').modal('show');
        }
    </script>
@endpush
