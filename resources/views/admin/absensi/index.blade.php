@extends('layouts.navbar_admin')

@section('title', 'Kelola Absensi Karyawan')

@push('styles')
    <style>
        .stats-card {
            background: white;
            border-radius: 16px;
            padding: 30px 25px;
            text-align: left;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            border: 1px solid rgba(0, 0, 0, 0.05);
            position: relative;
            overflow: hidden;
            height: 160px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .stats-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
        }

        .stats-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
            color: white;
            font-size: 24px;
        }

        .stats-content {
            flex: 1;
        }

        .stats-number {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 4px;
            color: #2d3748;
            line-height: 1;
        }

        .stats-label {
            font-size: 1rem;
            font-weight: 500;
            color: #718096;
            margin-bottom: 8px;
        }

        .stats-status {
            display: flex;
            align-items: center;
            gap: 5px;
            font-size: 0.85rem;
            font-weight: 600;
        }

        .stats-status.active {
            color: #10b981;
        }

        .stats-status.warning {
            color: #f59e0b;
        }

        .stats-status.info {
            color: #3b82f6;
        }

        .stats-status.secondary {
            color: #6b7280;
        }

        /* Icon colors */
        .icon-users {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .icon-user-x {
            background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
        }

        .icon-calendar {
            background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%);
        }

        .icon-heart {
            background: linear-gradient(135deg, #ffecd2 0%, #fcb69f 100%);
        }

        .stats-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
        }

        /* Enhanced responsive design for stats cards */
        @media (max-width: 768px) {
            .stats-card {
                border-radius: 12px;
                padding: 20px 18px;
                height: 140px;
            }

            .stats-icon {
                width: 40px;
                height: 40px;
                font-size: 20px;
                margin-bottom: 15px;
            }

            .stats-number {
                font-size: 2.2rem;
            }

            .stats-label {
                font-size: 0.9rem;
            }

            .stats-status {
                font-size: 0.8rem;
            }
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

        /* Pagination Styling */
        .pagination-container {
            background-color: #f8f9fc;
            border-radius: 8px;
            padding: 15px;
            margin-top: 20px;
        }

        .pagination-info {
            color: #6c757d;
            font-size: 0.9rem;
            font-weight: 500;
        }

        .pagination .page-link {
            color: #667eea;
            border: 1px solid #e3e6f0;
            padding: 8px 12px;
            font-size: 0.875rem;
            font-weight: 500;
            border-radius: 6px;
            margin: 0 2px;
        }

        .pagination .page-link:hover {
            color: #764ba2;
            background-color: #f8f9fc;
            border-color: #667eea;
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
            border-color: #e3e6f0;
        }

        /* Per page selector */
        .per-page-selector {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .per-page-selector select {
            width: auto;
            min-width: 80px;
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
                <div class="stats-card">
                    <div class="stats-icon icon-users">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="stats-content">
                        <div class="stats-number">{{ $stats['total_hadir'] ?? 0 }}</div>
                        <div class="stats-label">Total Hadir</div>
                        <div class="stats-status active">
                            <i class="fas fa-arrow-up"></i> Aktif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 col-6 mb-3">
                <div class="stats-card">
                    <div class="stats-icon icon-user-x">
                        <i class="fas fa-user-times"></i>
                    </div>
                    <div class="stats-content">
                        <div class="stats-number">{{ $stats['total_alfa'] ?? 0 }}</div>
                        <div class="stats-label">Total Alfa</div>
                        <div class="stats-status warning">
                            <i class="fas fa-exclamation-triangle"></i> Warning
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 col-6 mb-3">
                <div class="stats-card">
                    <div class="stats-icon icon-calendar">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                    <div class="stats-content">
                        <div class="stats-number">{{ $stats['total_izin'] ?? 0 }}</div>
                        <div class="stats-label">Total Izin</div>
                        <div class="stats-status info">
                            <i class="fas fa-info-circle"></i> Approved
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 col-6 mb-3">
                <div class="stats-card">
                    <div class="stats-icon icon-heart">
                        <i class="fas fa-heart"></i>
                    </div>
                    <div class="stats-content">
                        <div class="stats-number">{{ $stats['total_sakit'] ?? 0 }}</div>
                        <div class="stats-label">Total Sakit</div>
                        <div class="stats-status secondary">
                            <i class="fas fa-clock"></i> Care
                        </div>
                    </div>
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
                                                {{ strtoupper(substr($item->karyawan->nama ?? 'N/A', 0, 2)) }}
                                            </div>
                                            <div>
                                                <div class="fw-bold">{{ $item->karyawan->nama ?? 'N/A' }}
                                                </div>
                                                <small
                                                    class="text-muted">{{ $item->karyawan->jabatan->nama_jabatan ?? 'N/A' }}</small>
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
                                                data-action="view-detail" 
                                                data-id="{{ $item->id_absensi }}">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button type="button" class="btn btn-sm btn-outline-success"
                                                data-action="edit-absensi" 
                                                data-id="{{ $item->id_absensi }}">
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
                <div class="pagination-container">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="pagination-info">
                            <span class="badge bg-primary">
                                Menampilkan {{ $absensi->firstItem() ?? 0 }} - {{ $absensi->lastItem() ?? 0 }} dari
                                {{ $absensi->total() }} data
                            </span>
                        </div>
                        <div class="d-flex align-items-center gap-3">
                            <div class="per-page-selector">
                                <span class="text-muted">Per halaman:</span>
                                <select class="form-select form-select-sm" onchange="changePerPage(this.value)">
                                    <option value="10" {{ request('per_page', 15) == 10 ? 'selected' : '' }}>10
                                    </option>
                                    <option value="15" {{ request('per_page', 15) == 15 ? 'selected' : '' }}>15
                                    </option>
                                    <option value="25" {{ request('per_page', 15) == 25 ? 'selected' : '' }}>25
                                    </option>
                                    <option value="50" {{ request('per_page', 15) == 50 ? 'selected' : '' }}>50
                                    </option>
                                    <option value="100" {{ request('per_page', 15) == 100 ? 'selected' : '' }}>100
                                    </option>
                                </select>
                            </div>
                            <div>
                                {{ $absensi->appends(request()->query())->links('pagination.custom') }}
                            </div>
                        </div>
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
        // Setup event delegation for absensi actions
        document.addEventListener('DOMContentLoaded', function() {
            console.log('Absensi page loaded, setting up event handlers...');
            
            // Event delegation for action buttons
            document.addEventListener('click', function(e) {
                const target = e.target.closest('[data-action]');
                if (!target) return;
                
                e.preventDefault();
                e.stopPropagation();
                
                const action = target.getAttribute('data-action');
                const id = target.getAttribute('data-id');
                
                console.log(`Absensi action clicked: ${action}, ID: ${id}`);
                
                switch(action) {
                    case 'view-detail':
                        viewDetail(id);
                        break;
                    case 'edit-absensi':
                        editAbsensi(id);
                        break;
                    default:
                        console.warn('Unknown action:', action);
                }
            });
        });

        function viewDetail(id) {
            console.log('viewDetail function called with ID:', id);
            
            if (!id) {
                alert('ID absensi tidak valid');
                return;
            }
            
            const modalElement = document.getElementById('viewDetailModal');
            if (!modalElement) {
                alert('Modal detail tidak ditemukan');
                return;
            }
            
            try {
                const modal = new bootstrap.Modal(modalElement);
                const content = document.getElementById('modalDetailContent');
                
                // Show loading
                content.innerHTML = `
                    <div class="text-center py-4">
                        <i class="fas fa-spinner fa-spin fa-2x text-primary mb-3"></i>
                        <h5 class="text-muted">Memuat detail absensi...</h5>
                    </div>
                `;
                
                modal.show();
                
                // Fetch detail data via API
                fetch(`/admin/absensi/api/${id}/detail`, {
                    method: 'GET',
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => {
                    console.log('Detail API response status:', response.status);
                    if (!response.ok) {
                        throw new Error(`HTTP ${response.status}: ${response.statusText}`);
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Detail API response:', data);
                    if (data.success) {
                        content.innerHTML = data.html;
                    } else {
                        content.innerHTML = '<div class="alert alert-danger">Gagal memuat detail: ' + (data.message || 'Unknown error') + '</div>';
                    }
                })
                .catch(error => {
                    console.error('Detail fetch error:', error);
                    content.innerHTML = '<div class="alert alert-danger">Terjadi kesalahan: ' + error.message + '</div>';
                });
                
            } catch (error) {
                console.error('Modal error:', error);
                alert('Gagal membuka modal: ' + error.message);
            }
        }

        function editAbsensi(id) {
            console.log('editAbsensi function called with ID:', id);
            
            if (!id) {
                alert('ID absensi tidak valid');
                return;
            }
            
            const modalElement = document.getElementById('editAbsensiModal');
            if (!modalElement) {
                alert('Modal edit tidak ditemukan');
                return;
            }
            
            try {
                const modal = new bootstrap.Modal(modalElement);
                const content = document.getElementById('modalEditContent');
                
                // Show loading
                content.innerHTML = `
                    <div class="text-center py-4">
                        <i class="fas fa-spinner fa-spin fa-2x text-primary mb-3"></i>
                        <h5 class="text-muted">Memuat form edit...</h5>
                    </div>
                `;
                
                modal.show();
                
                // Fetch edit form via API
                fetch(`/admin/absensi/api/${id}/edit`, {
                    method: 'GET',
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => {
                    console.log('Edit API response status:', response.status);
                    if (!response.ok) {
                        throw new Error(`HTTP ${response.status}: ${response.statusText}`);
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Edit API response:', data);
                    if (data.success) {
                        content.innerHTML = data.html;
                        
                        // Setup form submission
                        const form = content.querySelector('#editAbsensiForm');
                        if (form) {
                            form.addEventListener('submit', function(e) {
                                e.preventDefault();
                                submitEditForm(id, new FormData(form));
                            });
                        }
                    } else {
                        content.innerHTML = '<div class="alert alert-danger">Gagal memuat form: ' + (data.message || 'Unknown error') + '</div>';
                    }
                })
                .catch(error => {
                    console.error('Edit fetch error:', error);
                    content.innerHTML = '<div class="alert alert-danger">Terjadi kesalahan: ' + error.message + '</div>';
                });
                
            } catch (error) {
                console.error('Modal error:', error);
                alert('Gagal membuka modal: ' + error.message);
            }
        }

        function submitEditForm(id, formData) {
            console.log('Submitting edit form for ID:', id);
            
            fetch(`/admin/absensi/${id}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                },
                body: formData
            })
            .then(response => {
                console.log('Update response status:', response.status);
                return response.json();
            })
            .then(data => {
                console.log('Update response:', data);
                if (data.success) {
                    alert('Data absensi berhasil diperbarui');
                    bootstrap.Modal.getInstance(document.getElementById('editAbsensiModal')).hide();
                    location.reload();
                } else {
                    alert('Gagal memperbarui data: ' + (data.message || 'Unknown error'));
                }
            })
            .catch(error => {
                console.error('Update error:', error);
                alert('Terjadi kesalahan: ' + error.message);
            });
        }

        function changePerPage(value) {
            // Get current URL parameters
            const urlParams = new URLSearchParams(window.location.search);

            // Update per_page parameter
            urlParams.set('per_page', value);

            // Remove page parameter to go back to first page
            urlParams.delete('page');

            // Redirect to new URL
            window.location.href = window.location.pathname + '?' + urlParams.toString();
        }

        // Make functions globally available
        window.viewDetail = viewDetail;
        window.editAbsensi = editAbsensi;
        window.changePerPage = changePerPage;
    </script>
@endpush
