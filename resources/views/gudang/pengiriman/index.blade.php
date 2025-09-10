@extends('layouts.appGudang')

@section('title', 'Pengiriman - MyYOGYA')

@section('content')
<style>
/* Modern Pengiriman Styles - Same as Permintaan */
.pengiriman-header {
    background: linear-gradient(135deg, #f26b37 0%, #e55827 100%);
    color: white;
    padding: 25px 30px;
    border-radius: 12px;
    margin-bottom: 25px;
    box-shadow: 0 4px 15px rgba(242, 107, 55, 0.3);
}

.pengiriman-header h2 {
    font-size: 1.8rem;
    font-weight: 700;
    margin: 0;
}

.pengiriman-header p {
    font-size: 1rem;
    opacity: 0.9;
    margin: 8px 0 0 0;
}

.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 20px;
    margin-bottom: 25px;
}

.stat-card {
    background: white;
    padding: 20px;
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    border-left: 4px solid #f26b37;
    transition: transform 0.3s ease;
}

body.dark-mode .stat-card {
    background: #2a2d3f;
    border-left-color: #f26b37;
}

.stat-card:hover {
    transform: translateY(-2px);
}

.stat-number {
    font-size: 2rem;
    font-weight: bold;
    color: #f26b37;
    margin-bottom: 5px;
}

.stat-label {
    color: #64748b;
    font-size: 0.9rem;
    font-weight: 500;
}

body.dark-mode .stat-label {
    color: #94a3b8;
}

.modern-card {
    background: white;
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    border: 1px solid #f1f5f9;
    margin-bottom: 25px;
}

body.dark-mode .modern-card {
    background: #2a2d3f;
    border-color: #3a3d4a;
}

.card-header-modern {
    padding: 20px 25px;
    border-bottom: 1px solid #f1f5f9;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

body.dark-mode .card-header-modern {
    border-bottom-color: #3a3d4a;
}

.card-title-modern {
    font-size: 1.1rem;
    font-weight: 600;
    color: #1e293b;
    margin: 0;
}

body.dark-mode .card-title-modern {
    color: #e2e8f0;
}

.modern-table {
    margin: 0;
}

.modern-table th {
    background: #f8fafc;
    border: none;
    padding: 15px;
    font-weight: 600;
    color: #374151;
    font-size: 0.9rem;
}

body.dark-mode .modern-table th {
    background: #252837;
    color: #e2e8f0;
}

.modern-table td {
    padding: 15px;
    border: none;
    border-bottom: 1px solid #f1f5f9;
    color: #374151;
}

body.dark-mode .modern-table td {
    border-bottom-color: #3a3d4a;
    color: #ffffff !important;
    background-color: #1e2139;
}

/* Enhanced Dark Mode Text Visibility */
body.dark-mode .modern-table td .fw-semibold,
body.dark-mode .modern-table td .fw-bold {
    color: #ffffff !important;
}

/* Status Badge Styles */
.status-badge {
    padding: 5px 12px;
    border-radius: 20px;
    font-weight: 500;
    font-size: 0.8rem;
    text-transform: uppercase;
}

.status-badge.status-pending {
    background: linear-gradient(135deg, #fbbf24, #f59e0b);
    color: white;
}

.status-badge.status-dikirim {
    background: linear-gradient(135deg, #60a5fa, #3b82f6);
    color: white;
}

.status-badge.status-selesai {
    background: linear-gradient(135deg, #34d399, #10b981);
    color: white;
}

.status-badge.status-dibatalkan {
    background: linear-gradient(135deg, #f87171, #ef4444);
    color: white;
}

/* Status Badge Dark Mode Improvements */
body.dark-mode .status-badge.status-pending {
    background: linear-gradient(135deg, #f59e0b, #d97706) !important;
    color: #ffffff !important;
}

body.dark-mode .status-badge.status-dikirim {
    background: linear-gradient(135deg, #3b82f6, #2563eb) !important;
    color: #ffffff !important;
}

body.dark-mode .status-badge.status-selesai {
    background: linear-gradient(135deg, #059669, #047857) !important;
    color: #ffffff !important;
}

body.dark-mode .status-badge.status-dibatalkan {
    background: linear-gradient(135deg, #dc2626, #b91c1c) !important;
    color: #ffffff !important;
}

.btn-modern {
    background: linear-gradient(135deg, #f26b37, #e55827);
    color: white;
    border: none;
    padding: 8px 16px;
    border-radius: 8px;
    font-weight: 500;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    gap: 6px;
}

.btn-modern:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(242, 107, 55, 0.4);
    color: white;
}

.btn-outline-modern {
    background: transparent;
    color: #f26b37;
    border: 2px solid #f26b37;
    padding: 8px 16px;
    border-radius: 8px;
    font-weight: 500;
    transition: all 0.3s ease;
}

.btn-outline-modern:hover {
    background: #f26b37;
    color: white;
}

.filter-section {
    background: white;
    border-radius: 12px;
    padding: 20px 25px;
    margin-bottom: 25px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    border: 1px solid #f1f5f9;
}

body.dark-mode .filter-section {
    background: #2a2d3f;
    border-color: #3a3d4a;
}

.filter-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 15px;
    align-items: end;
}

.form-label-modern {
    font-weight: 600;
    color: #374151;
    margin-bottom: 8px;
}

body.dark-mode .form-label-modern {
    color: #e2e8f0;
}

.form-control-modern {
    border: 2px solid #e5e7eb;
    border-radius: 8px;
    padding: 10px 12px;
    transition: all 0.3s ease;
    height: 48px;
}

.form-control-modern:focus {
    border-color: #f26b37;
    box-shadow: 0 0 0 3px rgba(242, 107, 55, 0.1);
}

body.dark-mode .form-control-modern {
    background: #252837;
    border-color: #3a3d4a;
    color: #e2e8f0;
}

/* Action Dropdown Styles */
.action-dropdown {
    position: relative;
    display: inline-block;
}

.action-btn {
    background: #f8fafc;
    border: 2px solid #e5e7eb;
    color: #374151;
    padding: 6px 10px;
    border-radius: 6px;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 4px;
}

.action-btn:hover {
    border-color: #f26b37;
    color: #f26b37;
}

body.dark-mode .action-btn {
    background: #252837;
    border-color: #3a3d4a;
    color: #e2e8f0;
}

body.dark-mode .action-btn:hover {
    border-color: #f26b37;
    color: #f26b37;
}

.action-dropdown-menu {
    position: absolute;
    top: 100%;
    right: 0;
    background: white;
    border: 1px solid #e5e7eb;
    border-radius: 8px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    min-width: 150px;
    z-index: 1000;
    opacity: 0;
    visibility: hidden;
    transform: translateY(-10px);
    transition: all 0.3s ease;
}

body.dark-mode .action-dropdown-menu {
    background: #2a2d3f;
    border-color: #3a3d4a;
}

.action-dropdown.active .action-dropdown-menu {
    opacity: 1;
    visibility: visible;
    transform: translateY(0);
    display: block;
}

.action-dropdown-item {
    padding: 10px 15px;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 8px;
    color: #374151;
    text-decoration: none;
    border-bottom: 1px solid #f1f5f9;
}

.action-dropdown-item:last-child {
    border-bottom: none;
}

.action-dropdown-item:hover {
    background: #f8fafc;
    color: #f26b37;
}

body.dark-mode .action-dropdown-item {
    color: #e2e8f0;
    border-bottom-color: #3a3d4a;
}

body.dark-mode .action-dropdown-item:hover {
    background: #252837;
    color: #f26b37;
}

.action-dropdown-item i {
    width: 16px;
    text-align: center;
}

@media (max-width: 768px) {
    .stats-grid {
        grid-template-columns: 1fr;
    }
    
    .filter-grid {
        grid-template-columns: 1fr;
    }
    
    .card-header-modern {
        padding: 15px 20px;
        flex-direction: column;
        gap: 10px;
    }
}
</style>

<div class="pengiriman-container">
    <!-- Header Section -->
    <div class="pengiriman-header">
        <h2>Manajemen Pengiriman</h2>
        <p>Kelola pengiriman produk ke berbagai cabang</p>
    </div>

    <!-- Stats Section -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-number">{{ $totalPengiriman ?? 0 }}</div>
            <div class="stat-label">Total Pengiriman</div>
        </div>
        <div class="stat-card">
            <div class="stat-number">{{ $pendingPengiriman ?? 0 }}</div>
            <div class="stat-label">Pending</div>
        </div>
        <div class="stat-card">
            <div class="stat-number">{{ $dikirimPengiriman ?? 0 }}</div>
            <div class="stat-label">Dikirim</div>
        </div>
        <div class="stat-card">
            <div class="stat-number">{{ $selesaiPengiriman ?? 0 }}</div>
            <div class="stat-label">Selesai</div>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0">Daftar Pengiriman</h4>
        <a href="{{ route('gudang.pengiriman.create') }}" class="btn btn-modern">
            <i class="fas fa-plus"></i>
            Tambah Pengiriman
        </a>
    </div>

    <!-- Filter Section -->
    <div class="filter-section">
        <form id="filter-form" method="GET" action="{{ route('gudang.pengiriman.index') }}">
            <div class="filter-grid">
                <div>
                    <label class="form-label-modern">Status</label>
                    <select name="status" class="form-control form-control-modern">
                        <option value="">Semua Status</option>
                        <option value="Menunggu" {{ request('status') == 'Menunggu' ? 'selected' : '' }}>Menunggu</option>
                        <option value="Siap Kirim" {{ request('status') == 'Siap Kirim' ? 'selected' : '' }}>Siap Kirim</option>
                        <option value="Dikirim" {{ request('status') == 'Dikirim' ? 'selected' : '' }}>Dikirim</option>
                        <option value="Selesai" {{ request('status') == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                    </select>
                </div>
                <div>
                    <label class="form-label-modern">Tanggal Dari</label>
                    <input type="date" name="tanggal_dari" value="{{ request('tanggal_dari') }}" class="form-control form-control-modern">
                </div>
                <div>
                    <label class="form-label-modern">Tanggal Sampai</label>
                    <input type="date" name="tanggal_sampai" value="{{ request('tanggal_sampai') }}" class="form-control form-control-modern">
                </div>
                <div>
                    <label class="form-label-modern">&nbsp;</label>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-modern flex-fill" style="height: 48px;">
                            <i class="fas fa-search"></i>
                            Filter
                        </button>
                        <button type="button" onclick="resetFilter()" class="btn btn-outline-modern" style="height: 48px;">
                            <i class="fas fa-refresh"></i>
                            Reset
                        </button>
                    </div>
                </div>
            </div>
        </form>
        
        <!-- Filter Indicators -->
        @if(request()->hasAny(['status', 'tanggal_dari', 'tanggal_sampai']))
        <div class="mt-3">
            <div class="d-flex align-items-center gap-2 flex-wrap">
                <small class="text-muted">Filter aktif:</small>
                @if(request('status'))
                    <span class="badge bg-primary">Status: {{ request('status') }}</span>
                @endif
                @if(request('tanggal_dari'))
                    <span class="badge bg-info">Dari: {{ request('tanggal_dari') }}</span>
                @endif
                @if(request('tanggal_sampai'))
                    <span class="badge bg-info">Sampai: {{ request('tanggal_sampai') }}</span>
                @endif
                <button type="button" onclick="resetFilter()" class="btn btn-sm btn-outline-secondary">
                    <i class="fas fa-times"></i> Hapus Filter
                </button>
            </div>
        </div>
        @endif
    </div>

    <!-- Data Table -->
    <div class="new-card">
        <div class="new-card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="border-0 ps-4">No</th>
                            <th class="border-0">Produk</th>
                            <th class="border-0">Tujuan</th>
                            <th class="border-0">Jumlah</th>
                            <th class="border-0">Tanggal Kirim</th>
                            <th class="border-0">Status</th>
                            <th class="border-0 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($sessionPengiriman as $index => $item)
                        <tr>
                            <td class="ps-4">{{ $index + 1 }}</td>
                            <td>
                                <div class="fw-medium">{{ $item['nama_produk'] ?? 'N/A' }}</div>
                            </td>
                            <td>
                                <div class="fw-medium">{{ $item['tujuan'] ?? 'N/A' }}</div>
                            </td>
                            <td>
                                <span class="badge bg-primary">{{ number_format($item['jumlah'] ?? 0) }} pcs</span>
                            </td>
                            <td>
                                {{ isset($item['tanggal_kirim']) ? \Carbon\Carbon::parse($item['tanggal_kirim'])->format('d M Y') : date('d M Y') }}
                            </td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-sm p-0 border-0 bg-transparent" 
                                            type="button" data-bs-toggle="dropdown">
                                        @php
                                            $status = $item['status'] ?? 'Menunggu';
                                            $statusClass = [
                                                'Menunggu' => 'bg-warning text-dark',
                                                'Siap Kirim' => 'bg-info text-white',
                                                'Dalam Perjalanan' => 'bg-primary text-white',
                                                'Dikirim' => 'bg-success text-white',
                                                'Diterima' => 'bg-success text-white'
                                            ][$status] ?? 'bg-secondary text-white';
                                        @endphp
                                        <span class="badge {{ $statusClass }}">{{ $status }}</span>
                                    </button>
                                    <ul class="dropdown-menu">
                                        @foreach($statusOptions as $value => $label)
                                            <li>
                                                <a class="dropdown-item update-status" 
                                                   href="#" 
                                                   data-id="{{ $index }}" 
                                                   data-status="{{ $value }}">
                                                    {{ $label }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </td>
                            <td class="text-center">
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-outline-secondary" 
                                            type="button" 
                                            data-bs-toggle="dropdown" 
                                            aria-expanded="false">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a class="dropdown-item" href="#" onclick="lihatDetail({{ $index }})">
                                                <i class="fas fa-eye me-2"></i>Lihat Detail
                                            </a>
                                        </li>
                                        @if(($item['status'] ?? 'Menunggu') === 'Siap Kirim')
                                            <li>
                                                <a class="dropdown-item text-primary" 
                                                   href="#" 
                                                   onclick="kirimPengiriman({{ $index }})">
                                                    <i class="fas fa-shipping-fast me-2"></i>Kirim
                                                </a>
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-5">
                                <div class="text-muted">
                                    <i class="fas fa-inbox fa-3x mb-3"></i>
                                    <p class="mb-0">Tidak ada data pengiriman</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                </thead>
                <tbody>
                    @if($pengiriman->count() > 0)
                        @foreach($pengiriman as $index => $item)
                        <tr>
                            <td>
                                <div class="fw-semibold">{{ $pengiriman->firstItem() + $index }}</div>
                            </td>
                            <td>
                                <div class="fw-semibold">{{ $item->nama_produk }}</div>
                                <small class="text-muted">{{ $item->kategori ?? 'Produk' }}</small>
                            </td>
                            <td>
                                <div class="fw-semibold">{{ $item->tujuan }}</div>
                                <small class="text-muted">{{ $item->alamat ?? 'Alamat lengkap' }}</small>
                            </td>
                            <td>
                                <div class="fw-semibold">{{ number_format($item->jumlah) }} pcs</div>
                                <small class="text-muted">{{ $item->satuan ?? 'unit' }}</small>
                            </td>
                            <td>
                                <div class="fw-semibold">{{ \Carbon\Carbon::parse($item->tanggal_kirim)->format('d/m/Y') }}</div>
                                <small class="text-muted">{{ \Carbon\Carbon::parse($item->tanggal_kirim)->format('H:i') }}</small>
                            </td>
                            <td>
                                @php
                                    $statusClass = '';
                                    switch(strtolower($item->status)) {
                                        case 'pending': $statusClass = 'status-pending'; break;
                                        case 'dikirim': $statusClass = 'status-dikirim'; break;
                                        case 'selesai': $statusClass = 'status-selesai'; break;
                                        case 'dibatalkan': $statusClass = 'status-dibatalkan'; break;
                                        default: $statusClass = 'status-pending';
                                    }
                                @endphp
                                <span class="status-badge {{ $statusClass }}">{{ $item->status }}</span>
                            </td>
                            <td>
                                <div class="action-dropdown">
                                    <button class="action-btn" onclick="toggleDropdown(this)">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                    <div class="action-dropdown-menu">
                                        <a href="{{ route('gudang.pengiriman.show', $item->id) }}" class="action-dropdown-item">
                                            <i class="fas fa-eye"></i>
                                            Detail
                                        </a>
                                        <a href="{{ route('gudang.pengiriman.edit', $item->id) }}" class="action-dropdown-item">
                                            <i class="fas fa-edit"></i>
                                            Edit
                                        </a>
                                        <a href="#" class="action-dropdown-item">
                                            <i class="fas fa-print"></i>
                                            Cetak Label
                                        </a>
                                        <a href="#" class="action-dropdown-item">
                                            <i class="fas fa-truck"></i>
                                            Lacak
                                        </a>
                                        <a href="#" class="action-dropdown-item text-danger" onclick="confirmDelete({{ $item->id }})">
                                            <i class="fas fa-trash"></i>
                                            Hapus
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
        
        @if($pengiriman->hasPages())
        <div style="padding: 20px 25px; border-top: 1px solid #f1f5f9;">
            {{ $pengiriman->links() }}
        </div>
        @endif
    </div>
</div>

<script>
// Toggle dropdown function
function toggleDropdown(button) {
    const dropdown = button.closest('.action-dropdown');
    const isActive = dropdown.classList.contains('active');
    
    // Close all other dropdowns
    document.querySelectorAll('.action-dropdown').forEach(d => d.classList.remove('active'));
    
    // Toggle current dropdown
    if (!isActive) {
        dropdown.classList.add('active');
    }
}

// Delete confirmation
    $('.delete-btn').on('click', function() {
        var id = $(this).data('id');
        var form = $('#deleteForm');
        form.attr('action', '{{ route("gudang.pengiriman.destroy", ":id") }}'.replace(':id', id));
        $('#deleteModal').modal('show');
    });

    // Update status
    $('.update-status').on('click', function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        var status = $(this).data('status');
        
        $.ajax({
            url: '{{ route("gudang.pengiriman.updateStatus", ":id") }}'.replace(':id', id),
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                status: status
            },
            success: function(response) {
                if(response.success) {
                    Swal.fire({
                        title: 'Berhasil!',
                        text: response.message,
                        icon: 'success',
                        timer: 1500,
                        showConfirmButton: false
                    }).then(() => {
                        location.reload();
                    });
                }
            },
            error: function() {
                Swal.fire({
                    title: 'Error!',
                    text: 'Terjadi kesalahan saat mengupdate status',
                    icon: 'error'
                });
            }
        });
    });
});

// Function untuk terima pengiriman
function terimaPengiriman(id) {
    Swal.fire({
        title: 'Terima Pengiriman?',
        text: 'Apakah Anda yakin ingin menerima pengiriman ini?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#28a745',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya, Terima',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            updateStatus(id, 'dikirim', 'Pengiriman berhasil diterima!');
        }
    });
}

// Function untuk tolak pengiriman
function tolakPengiriman(id) {
    Swal.fire({
        title: 'Tolak Pengiriman?',
        text: 'Masukkan alasan penolakan:',
        input: 'textarea',
        inputPlaceholder: 'Alasan penolakan...',
        showCancelButton: true,
        confirmButtonColor: '#dc3545',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya, Tolak',
        cancelButtonText: 'Batal',
        inputValidator: (value) => {
            if (!value) {
                return 'Alasan penolakan harus diisi!'
            }
        }
    }).then((result) => {
        if (result.isConfirmed) {
            updateStatusWithReason(id, 'ditolak', result.value, 'Pengiriman berhasil ditolak!');
        }
    });
}

// Function untuk update status
function updateStatus(id, status, successMessage) {
    $.ajax({
        url: '/gudang/pengiriman/' + id + '/update-status',
        type: 'POST',
        data: {
            _token: '{{ csrf_token() }}',
            status: status
        },
        success: function(response) {
            if(response.success) {
                Swal.fire({
                    title: 'Berhasil!',
                    text: successMessage,
                    icon: 'success',
                    timer: 1500,
                    showConfirmButton: false
                }).then(() => {
                    location.reload();
                });
            }
        },
        error: function() {
            Swal.fire({
                title: 'Error!',
                text: 'Terjadi kesalahan saat mengupdate status',
                icon: 'error'
            });
        }
    });
}

// Function untuk update status dengan alasan
function updateStatusWithReason(id, status, reason, successMessage) {
    $.ajax({
        url: '/gudang/pengiriman/' + id + '/update-status',
        type: 'POST',
        data: {
            _token: '{{ csrf_token() }}',
            status: status,
            reason: reason
        },
        success: function(response) {
            if(response.success) {
                Swal.fire({
                    title: 'Berhasil!',
                    text: successMessage,
                    icon: 'success',
                    timer: 1500,
                    showConfirmButton: false
                }).then(() => {
                    location.reload();
                });
            }
        },
        error: function() {
            Swal.fire({
                title: 'Error!',
                text: 'Terjadi kesalahan saat mengupdate status',
                icon: 'error'
            });
        }
    });
}

function kirimPengiriman(index) {
    Swal.fire({
        title: 'Kirim Pengiriman?',
        text: 'Pengiriman akan dikirim dan masuk ke sistem penerimaan',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#28a745',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya, Kirim!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '{{ route("gudang.pengiriman.kirim") }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    index: index
                },
                success: function(response) {
                    if (response.success) {
                        Swal.fire({
                            title: 'Berhasil!',
                            text: response.message,
                            icon: 'success',
                            timer: 2000,
                            showConfirmButton: false
                        }).then(() => {
                            if (response.redirect) {
                                window.location.href = response.redirect;
                            } else {
                                location.reload();
                            }
                        });
                    } else {
                        Swal.fire({
                            title: 'Error!',
                            text: response.message,
                            icon: 'error'
                        });
                    }
                },
                error: function() {
                    Swal.fire({
                        title: 'Error!',
                        text: 'Terjadi kesalahan saat mengirim pengiriman',
                        icon: 'error'
                    });
                }
            });
        }
    });
}

function lihatDetail(index) {
    alert('Detail untuk item index: ' + index);
}

// Show success/error messages
@if(session('success'))
    Swal.fire({
        title: 'Berhasil!',
        text: '{{ session("success") }}',
        icon: 'success',
        timer: 3000,
        showConfirmButton: false
    });
@endif

@if(session('error'))
    Swal.fire({
        title: 'Error!',
        text: '{{ session("error") }}',
        icon: 'error'
    });
@endif

// Close dropdown when clicking outside
document.addEventListener('click', function(event) {
    if (!event.target.closest('.action-dropdown')) {
        document.querySelectorAll('.action-dropdown').forEach(d => d.classList.remove('active'));
    }
});

// Close dropdown when pressing escape
document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
        document.querySelectorAll('.action-dropdown').forEach(d => d.classList.remove('active'));
    }
});

// Confirm delete function
function confirmDelete(id) {
    if (confirm('Apakah Anda yakin ingin menghapus pengiriman ini?')) {
        // Create form and submit
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = `/gudang/pengiriman/${id}`;
        
        const csrfToken = document.createElement('input');
        csrfToken.type = 'hidden';
        csrfToken.name = '_token';
        csrfToken.value = '{{ csrf_token() }}';
        
        const methodInput = document.createElement('input');
        methodInput.type = 'hidden';
        methodInput.name = '_method';
        methodInput.value = 'DELETE';
        
        form.appendChild(csrfToken);
        form.appendChild(methodInput);
        document.body.appendChild(form);
        form.submit();
    }
}

// Filter functionality
function applyFilter() {
    const form = document.querySelector('#filter-form');
    if (form) {
        form.submit();
    }
}

function resetFilter() {
    // Clear all form inputs
    document.querySelector('select[name="status"]').value = '';
    document.querySelector('input[name="tanggal_dari"]').value = '';
    document.querySelector('input[name="tanggal_sampai"]').value = '';
    
    // Submit form to clear filters
    const form = document.querySelector('#filter-form');
    if (form) {
        // Remove all query parameters by submitting form without data
        window.location.href = form.action;
    }
}

// Real-time filter on change
document.addEventListener('DOMContentLoaded', function() {
    // Auto-submit on status change
    const statusSelect = document.querySelector('select[name="status"]');
    if (statusSelect) {
        statusSelect.addEventListener('change', function() {
            applyFilter();
        });
    }
    
    // Auto-submit on date change
    const dateInputs = document.querySelectorAll('input[name="tanggal_dari"], input[name="tanggal_sampai"]');
    dateInputs.forEach(function(input) {
        input.addEventListener('change', function() {
            applyFilter();
        });
    });
});
</script>
@endsection
