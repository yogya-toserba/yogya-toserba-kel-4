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

    <!-- Filter Section -->
    <div class="filter-section">
        <form method="GET" action="{{ route('gudang.pengiriman.index') }}">
            <div class="filter-grid">
                <div>
                    <label class="form-label-modern">Status</label>
                    <select name="status" class="form-control form-control-modern">
                        <option value="">Semua Status</option>
                        <option value="Pending" {{ request('status') == 'Pending' ? 'selected' : '' }}>Pending</option>
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
                    <button type="submit" class="btn btn-modern w-100 form-control-modern" style="height: 48px;">
                        <i class="fas fa-search"></i>
                        Filter
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- Main Table -->
    <div class="modern-card">
        <div class="card-header-modern">
            <h5 class="card-title-modern">
                <i class="fas fa-shipping-fast" style="color: #f26b37; margin-right: 10px;"></i>
                Daftar Pengiriman
            </h5>
            <div class="d-flex gap-2">
                <a href="{{ route('gudang.pengiriman.create') }}" class="btn btn-modern">
                    <i class="fas fa-plus"></i>
                    Buat Pengiriman
                </a>
                <button class="btn btn-outline-modern">
                    <i class="fas fa-download"></i>
                    Export
                </button>
                <button class="btn btn-modern">
                    <i class="fas fa-sync-alt"></i>
                    Refresh
                </button>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table modern-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Produk</th>
                        <th>Tujuan</th>
                        <th>Jumlah</th>
                        <th>Tanggal Kirim</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
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
                    @else
                        <tr>
                            <td colspan="7" class="text-center py-4">
                                <div class="text-muted">
                                    <i class="fas fa-box-open fa-3x mb-3"></i>
                                    <p>Belum ada data pengiriman</p>
                                    <a href="{{ route('gudang.pengiriman.create') }}" class="btn btn-modern">
                                        <i class="fas fa-plus"></i>
                                        Tambah Pengiriman Pertama
                                    </a>
                                </div>
                            </td>
                        </tr>
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
</script>
@endsection
