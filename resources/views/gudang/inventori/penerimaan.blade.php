@extends('layouts.appInventori')

@section('title', 'Penerimaan - MyYOGYA Inventori')

@push('head')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@section('content')
<style>
/* Modern Penerimaan Styles - Sama dengan Permintaan */
.penerimaan-header {
    background: linear-gradient(135deg, #16a34a 0%, #15803d 100%);
    color: white;
    padding: 25px 30px;
    border-radius: 12px;
    margin-bottom: 25px;
    box-shadow: 0 4px 15px rgba(22, 163, 74, 0.3);
}

.penerimaan-header h2 {
    font-size: 1.8rem;
    font-weight: 700;
    margin: 0;
}

.penerimaan-header p {
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
    border-left: 4px solid #16a34a;
    transition: transform 0.3s ease;
}

body.dark-mode .stat-card {
    background: #2a2d3f;
    border-left-color: #16a34a;
    color: #e2e8f0;
}

.stat-card:hover {
    transform: translateY(-2px);
}

.stat-number {
    font-size: 1.8rem;
    font-weight: 700;
    color: #16a34a;
    margin-bottom: 5px;
}

.stat-label {
    font-size: 0.9rem;
    color: #64748b;
    font-weight: 500;
}

body.dark-mode .stat-label {
    color: #94a3b8;
}

.modern-card {
    background: white;
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    border: 1px solid #e2e8f0;
    overflow: hidden;
}

body.dark-mode .modern-card {
    background: #2a2d3f;
    border-color: #3a3d4a;
}

.card-header-modern {
    background: #f8fafc;
    padding: 20px 25px;
    border-bottom: 1px solid #e2e8f0;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

body.dark-mode .card-header-modern {
    background: #252837;
    border-bottom-color: #3a3d4a;
}

.modern-table {
    margin: 0;
    border-collapse: collapse;
    width: 100%;
}

.modern-table th {
    background: #f8fafc;
    border: none;
    padding: 15px 20px;
    font-weight: 600;
    color: #374151;
    font-size: 0.875rem;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    border-bottom: 2px solid #e5e7eb;
}

body.dark-mode .modern-table th {
    background: #252837;
    color: #e2e8f0;
    border-bottom-color: #3a3d4a;
}

.modern-table td {
    padding: 15px 20px;
    border-bottom: 1px solid #f1f5f9;
    vertical-align: middle;
}

body.dark-mode .modern-table td {
    border-bottom-color: #334155;
}

.modern-table tbody tr:hover {
    background: #f8fafc;
}

body.dark-mode .modern-table tbody tr:hover {
    background: #334155;
}

/* Action Dropdown Styles - sama dengan permintaan */
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
    justify-content: center;
    min-width: 35px;
    height: 35px;
}

.action-btn:hover {
    background: #16a34a;
    color: white;
    border-color: #16a34a;
}

body.dark-mode .action-btn {
    background: #252837;
    border-color: #3a3d4a;
    color: #e2e8f0;
}

body.dark-mode .action-btn:hover {
    background: #16a34a;
    color: white;
    border-color: #16a34a;
}

.action-dropdown-menu {
    position: absolute;
    top: 100%;
    right: 0;
    background: white;
    border: 1px solid #e5e7eb;
    border-radius: 8px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.15);
    min-width: 160px;
    opacity: 0;
    visibility: hidden;
    transform: translateY(-10px);
    transition: all 0.3s ease;
    z-index: 1000;
}

body.dark-mode .action-dropdown-menu {
    background: #374151;
    border-color: #4b5563;
}

.action-dropdown.active .action-dropdown-menu {
    opacity: 1;
    visibility: visible;
    transform: translateY(0);
}

.action-dropdown-item {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 10px 15px;
    color: #374151;
    text-decoration: none;
    font-size: 0.875rem;
    transition: all 0.2s ease;
    border-bottom: 1px solid #f1f5f9;
}

.action-dropdown-item:last-child {
    border-bottom: none;
}

.action-dropdown-item:hover {
    background: #f8fafc;
    color: #16a34a;
    text-decoration: none;
}

body.dark-mode .action-dropdown-item {
    color: #e2e8f0;
    border-bottom-color: #4b5563;
}

body.dark-mode .action-dropdown-item:hover {
    background: #4b5563;
    color: #16a34a;
}

.action-dropdown-item.text-success {
    color: #16a34a !important;
}

.action-dropdown-item.text-danger {
    color: #dc2626 !important;
}

.action-dropdown-item.text-warning {
    color: #d97706 !important;
}

/* Status Badge Styles */
.status-badge {
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.025em;
    border: none;
    cursor: pointer;
    transition: all 0.2s ease;
}

.status-dalam-perjalanan {
    background: linear-gradient(135deg, #f59e0b, #d97706);
    color: white;
}

.status-diterima {
    background: linear-gradient(135deg, #16a34a, #15803d);
    color: white;
}

.status-selesai {
    background: linear-gradient(135deg, #2563eb, #1d4ed8);
    color: white;
}

.btn-modern {
    background: linear-gradient(135deg, #16a34a, #15803d);
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
    box-shadow: 0 4px 12px rgba(22, 163, 74, 0.4);
    color: white;
}

/* Filter Section */
.filter-container {
    background: white;
    border-radius: 12px;
    padding: 25px;
    margin-bottom: 25px;
    box-shadow: 0 2px 12px rgba(0,0,0,0.08);
    border: 1px solid #e5e7eb;
}

body.dark-mode .filter-container {
    background: #2a2d3f;
    border-color: #3a3d4a;
}

.filter-row {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    align-items: end;
}

.filter-col {
    flex: 1;
    min-width: 200px;
}

.filter-col-auto {
    flex: 0 0 auto;
    min-width: 140px;
}

.filter-label {
    display: block;
    font-weight: 600;
    color: #374151;
    margin-bottom: 8px;
    font-size: 0.9rem;
}

body.dark-mode .filter-label {
    color: #e2e8f0;
}

.filter-input, .filter-select {
    width: 100%;
    padding: 10px 12px;
    border: 2px solid #e5e7eb;
    border-radius: 8px;
    font-size: 0.95rem;
    transition: all 0.3s ease;
    background: white;
}

.filter-input:focus, .filter-select:focus {
    outline: none;
    border-color: #16a34a;
    box-shadow: 0 0 0 3px rgba(22, 163, 74, 0.1);
}

body.dark-mode .filter-input,
body.dark-mode .filter-select {
    background: #252837;
    border-color: #3a3d4a;
    color: #e2e8f0;
}

.filter-btn {
    background: linear-gradient(135deg, #16a34a, #15803d);
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 8px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    height: 44px;
}

.filter-btn:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(22, 163, 74, 0.3);
}

.filter-btn-secondary {
    background: white;
    color: #374151;
    border: 2px solid #e5e7eb;
    padding: 8px 16px;
    border-radius: 8px;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.3s ease;
    height: 44px;
}

.filter-btn-secondary:hover {
    background: #e5e7eb;
    color: #374151;
}

body.dark-mode .filter-btn-secondary {
    background: #374151;
    color: #d1d5db;
    border-color: #4b5563;
}

body.dark-mode .filter-btn-secondary:hover {
    background: #4b5563;
    color: #e5e7eb;
}

/* Modal Styles untuk Detail */
.modal-content {
    border-radius: 12px;
    border: none;
    box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
}

.modal-header {
    background: linear-gradient(135deg, #16a34a, #15803d);
    color: white;
    border-radius: 12px 12px 0 0;
    border: none;
    padding: 20px 25px;
}

.modal-title {
    font-weight: 600;
    font-size: 1.25rem;
}

.btn-close {
    filter: brightness(0) invert(1);
}

.modal-body {
    padding: 25px;
}

.detail-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
}

.detail-item {
    padding: 15px;
    background: #f8fafc;
    border-radius: 8px;
    border-left: 4px solid #16a34a;
}

body.dark-mode .detail-item {
    background: #252837;
}

.detail-label {
    font-size: 0.875rem;
    color: #6b7280;
    font-weight: 500;
    margin-bottom: 4px;
}

.detail-value {
    font-size: 1rem;
    color: #111827;
    font-weight: 600;
}

body.dark-mode .detail-value {
    color: #e2e8f0;
}

/* Table responsive */
.table-responsive {
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
}

/* Animation untuk dropdown */
@keyframes dropdownFadeIn {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.action-dropdown.active .action-dropdown-menu {
    animation: dropdownFadeIn 0.3s ease;
}
</style>

<div class="container-fluid px-4">
    <!-- Header Section -->
    <div class="penerimaan-header">
        <h2><i class="fas fa-inbox me-3"></i>Penerimaan Barang</h2>
        <p>Kelola dan pantau penerimaan barang dari pengiriman cabang</p>
    </div>
    <!-- Statistics Cards -->
    <div class="stats-grid">
        @php
            $totalItems = count($sessionPenerimaan ?? []);
            $dalamPerjalanan = collect($sessionPenerimaan ?? [])->where('status', 'Dalam Perjalanan')->count();
            $diterima = collect($sessionPenerimaan ?? [])->where('status', 'Diterima')->count();
            $selesai = collect($sessionPenerimaan ?? [])->where('status', 'Selesai')->count();
        @endphp
        
        <div class="stat-card">
            <div class="stat-number">{{ $totalItems }}</div>
            <div class="stat-label">Total Penerimaan</div>
        </div>
        
        <div class="stat-card">
            <div class="stat-number">{{ $dalamPerjalanan }}</div>
            <div class="stat-label">Dalam Perjalanan</div>
        </div>
        
        <div class="stat-card">
            <div class="stat-number">{{ $diterima }}</div>
            <div class="stat-label">Diterima</div>
        </div>
        
        <div class="stat-card">
            <div class="stat-number">{{ $selesai }}</div>
            <div class="stat-label">Selesai</div>
        </div>
    </div>

    <!-- Filter Section -->
    <div class="filter-container">
        <form method="GET" action="{{ route('gudang.inventori.penerimaan.index') }}">
            <div class="filter-row">
                <div class="filter-col">
                    <label class="filter-label">Cari Cabang</label>
                    <input type="text" name="search" class="filter-input" 
                           placeholder="Masukkan nama cabang..." 
                           value="{{ request('search') }}">
                </div>
                
                <div class="filter-col">
                    <label class="filter-label">Status</label>
                    <select name="status" class="filter-select">
                        <option value="">Semua Status</option>
                        <option value="Dalam Perjalanan" {{ request('status') === 'Dalam Perjalanan' ? 'selected' : '' }}>Dalam Perjalanan</option>
                        <option value="Diterima" {{ request('status') === 'Diterima' ? 'selected' : '' }}>Diterima</option>
                        <option value="Selesai" {{ request('status') === 'Selesai' ? 'selected' : '' }}>Selesai</option>
                    </select>
                </div>
                
                <div class="filter-col">
                    <label class="filter-label">Dari Tanggal</label>
                    <input type="date" name="tanggal_dari" class="filter-input" 
                           value="{{ request('tanggal_dari') }}">
                </div>
                
                <div class="filter-col">
                    <label class="filter-label">Sampai Tanggal</label>
                    <input type="date" name="tanggal_sampai" class="filter-input" 
                           value="{{ request('tanggal_sampai') }}">
                </div>
                
                <div class="filter-col-auto">
                    <button type="submit" class="filter-btn">
                        <i class="fas fa-search me-2"></i>Filter
                    </button>
                </div>
                
                <div class="filter-col-auto">
                    <a href="{{ route('gudang.inventori.penerimaan.index') }}" class="filter-btn-secondary">
                        <i class="fas fa-refresh me-2"></i>Reset
                    </a>
                </div>
            </div>
        </form>
    </div>

    <!-- Main Data Table -->
    <div class="modern-card">
        <div class="card-header-modern">
            <h5 class="mb-0">
                <i class="fas fa-list me-2"></i>Data Penerimaan Barang
            </h5>
            <div class="d-flex gap-2">
                <button class="btn btn-modern" onclick="refreshData()">
                    <i class="fas fa-sync-alt"></i>
                    Refresh
                </button>
            </div>
        </div>
        
        <div class="table-responsive">
            <table class="table modern-table">
                <thead>
                    <tr>
                        <th>ID Penerimaan</th>
                        <th>Cabang Pengirim</th>
                        <th>Tanggal</th>
                        <th>Total Item</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($sessionPenerimaan as $index => $item)
                    <tr>
                        <td>
                            <div class="fw-semibold">{{ $item['id_pengiriman'] ?? 'PEN-' . ($index + 1) }}</div>
                            <small class="text-muted">{{ $item['id'] ?? 'ID-' . ($index + 1) }}</small>
                        </td>
                        <td>
                            <div class="fw-semibold">{{ $item['tujuan'] ?? 'Unknown Branch' }}</div>
                            <small class="text-muted">{{ $item['nama_produk'] ?? 'Tidak diketahui' }}</small>
                        </td>
                        <td>
                            <div>{{ isset($item['tanggal_kirim']) ? \Carbon\Carbon::parse($item['tanggal_kirim'])->format('d/m/Y') : date('d/m/Y') }}</div>
                            <small class="text-muted">{{ isset($item['tanggal_kirim_aktual']) ? \Carbon\Carbon::parse($item['tanggal_kirim_aktual'])->format('H:i') : date('H:i') }}</small>
                        </td>
                        <td>
                            <span class="fw-semibold">{{ number_format($item['jumlah'] ?? 0) }} Item</span>
                        </td>
                        <td>
                            @php
                                $status = $item['status'] ?? 'Dalam Perjalanan';
                                $statusClass = match($status) {
                                    'Dalam Perjalanan' => 'status-dalam-perjalanan',
                                    'Diterima' => 'status-diterima',
                                    'Selesai' => 'status-selesai',
                                    default => 'status-dalam-perjalanan'
                                };
                            @endphp
                            
                            <div class="dropdown">
                                <button class="status-badge {{ $statusClass }}" 
                                        type="button" data-bs-toggle="dropdown">
                                    {{ $status }}
                                    <i class="fas fa-chevron-down ms-1" style="font-size: 0.7rem;"></i>
                                </button>
                                <ul class="dropdown-menu">
                                    @foreach($statusOptions as $value => $label)
                                        <li>
                                            <a class="dropdown-item update-status" 
                                               href="#" 
                                               data-index="{{ $index }}" 
                                               data-status="{{ $value }}">
                                                {{ $label }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </td>
                        <td>
                            <!-- Dropdown Menu with Three Dots -->
                            <div class="action-dropdown">
                                <button class="action-btn">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                                <div class="action-dropdown-menu">
                                    <a href="#" class="action-dropdown-item" data-bs-toggle="modal" data-bs-target="#detailModal{{ $index }}">
                                        <i class="fas fa-eye"></i>
                                        Lihat Detail
                                    </a>
                                    
                                    @if(($item['status'] ?? 'Dalam Perjalanan') === 'Dalam Perjalanan')
                                        <a href="#" class="action-dropdown-item text-success" 
                                           onclick="terimaPenerimaan({{ $index }})">
                                            <i class="fas fa-check"></i>
                                            Terima Barang
                                        </a>
                                    @endif
                                    
                                    @if(($item['status'] ?? 'Dalam Perjalanan') === 'Diterima')
                                        <a href="#" class="action-dropdown-item text-warning" 
                                           onclick="selesaikanPenerimaan({{ $index }})">
                                            <i class="fas fa-check-double"></i>
                                            Selesaikan
                                        </a>
                                    @endif
                                    
                                    <a href="#" class="action-dropdown-item text-danger" 
                                       onclick="hapusPenerimaan({{ $index }})">
                                        <i class="fas fa-trash"></i>
                                        Hapus
                                    </a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-4">
                            <div class="text-muted">
                                <i class="fas fa-inbox fa-3x mb-3"></i>
                                <h6>Tidak ada data penerimaan</h6>
                                <p class="mb-0">Data penerimaan akan muncul ketika ada pengiriman dari cabang</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Detail Modals -->
    @foreach($sessionPenerimaan as $index => $item)
    <div class="modal fade" id="detailModal{{ $index }}" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fas fa-info-circle me-2"></i>
                        Detail Penerimaan - {{ $item['id_pengiriman'] ?? 'PEN-' . ($index + 1) }}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="detail-grid">
                        <div class="detail-item">
                            <div class="detail-label">ID Pengiriman</div>
                            <div class="detail-value">{{ $item['id_pengiriman'] ?? 'PEN-' . ($index + 1) }}</div>
                        </div>
                        
                        <div class="detail-item">
                            <div class="detail-label">Cabang Pengirim</div>
                            <div class="detail-value">{{ $item['tujuan'] ?? 'Unknown Branch' }}</div>
                        </div>
                        
                        <div class="detail-item">
                            <div class="detail-label">Nama Produk</div>
                            <div class="detail-value">{{ $item['nama_produk'] ?? 'Tidak diketahui' }}</div>
                        </div>
                        
                        <div class="detail-item">
                            <div class="detail-label">Jumlah</div>
                            <div class="detail-value">{{ number_format($item['jumlah'] ?? 0) }} Item</div>
                        </div>
                        
                        <div class="detail-item">
                            <div class="detail-label">Tanggal Kirim</div>
                            <div class="detail-value">{{ isset($item['tanggal_kirim']) ? \Carbon\Carbon::parse($item['tanggal_kirim'])->format('d F Y') : '-' }}</div>
                        </div>
                        
                        <div class="detail-item">
                            <div class="detail-label">Waktu Kirim Aktual</div>
                            <div class="detail-value">{{ isset($item['tanggal_kirim_aktual']) ? \Carbon\Carbon::parse($item['tanggal_kirim_aktual'])->format('d F Y H:i') : '-' }}</div>
                        </div>
                        
                        <div class="detail-item">
                            <div class="detail-label">Status</div>
                            <div class="detail-value">
                                @php
                                    $status = $item['status'] ?? 'Dalam Perjalanan';
                                    $statusClass = match($status) {
                                        'Dalam Perjalanan' => 'status-dalam-perjalanan',
                                        'Diterima' => 'status-diterima',
                                        'Selesai' => 'status-selesai',
                                        default => 'status-dalam-perjalanan'
                                    };
                                @endphp
                                <span class="status-badge {{ $statusClass }}">{{ $status }}</span>
                            </div>
                        </div>
                        
                        <div class="detail-item">
                            <div class="detail-label">Tanggal Dibuat</div>
                            <div class="detail-value">{{ isset($item['created_at']) ? \Carbon\Carbon::parse($item['created_at'])->format('d F Y H:i') : date('d F Y H:i') }}</div>
                        </div>
                    </div>
                    
                    @if(isset($item['products']) && is_array($item['products']))
                    <div class="mt-4">
                        <h6><i class="fas fa-list me-2"></i>Detail Produk yang Dikirim</h6>
                        <div class="table-responsive">
                            <table class="table modern-table mb-0">
                                <thead>
                                    <tr>
                                        <th>Nama Produk</th>
                                        <th>Kategori</th>
                                        <th>Jumlah</th>
                                        <th>Satuan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($item['products'] as $product)
                                    <tr>
                                        <td>{{ $product['nama'] ?? 'Unknown Product' }}</td>
                                        <td>{{ $product['kategori'] ?? 'Uncategorized' }}</td>
                                        <td>{{ number_format($product['jumlah'] ?? 0) }}</td>
                                        <td>{{ $product['satuan'] ?? 'pcs' }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @else
                    <div class="mt-4">
                        <h6><i class="fas fa-list me-2"></i>Detail Produk yang Dikirim</h6>
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle me-2"></i>
                            Detail produk tidak tersedia untuk item ini.
                        </div>
                    </div>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    @if(($item['status'] ?? 'Dalam Perjalanan') === 'Dalam Perjalanan')
                        <button type="button" class="btn btn-success" onclick="terimaPenerimaan({{ $index }})">
                            <i class="fas fa-check me-2"></i>Terima Barang
                        </button>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
<script>
$(document).ready(function() {
    // Action dropdown toggle
    $(document).on('click', '.action-btn', function(e) {
        e.preventDefault();
        e.stopPropagation();
        
        // Close all other dropdowns
        $('.action-dropdown').not($(this).closest('.action-dropdown')).removeClass('active');
        
        // Toggle current dropdown
        $(this).closest('.action-dropdown').toggleClass('active');
    });
    
    // Close dropdown when clicking outside
    $(document).on('click', function(e) {
        if (!$(e.target).closest('.action-dropdown').length) {
            $('.action-dropdown').removeClass('active');
        }
    });
    
    // Prevent dropdown from closing when clicking on dropdown menu
    $(document).on('click', '.action-dropdown-menu', function(e) {
        e.stopPropagation();
    });
    
    // Update status handler
    $(document).on('click', '.update-status', function(e) {
        e.preventDefault();
        
        var index = $(this).data('index');
        var status = $(this).data('status');
        
        // Close dropdown
        $('.action-dropdown').removeClass('active');
        
        // Show confirmation
        Swal.fire({
            title: 'Update Status?',
            text: 'Apakah Anda yakin ingin mengubah status penerimaan ini?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#16a34a',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Ya, Update!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                updateStatus(index, status);
            }
        });
    });
    
    // Functions untuk aksi penerimaan
    window.terimaPenerimaan = function(index) {
        $('.action-dropdown').removeClass('active');
        
        Swal.fire({
            title: 'Terima Penerimaan?',
            text: 'Barang akan ditandai sebagai diterima di gudang',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#16a34a',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Ya, Terima!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                updateStatus(index, 'Diterima');
            }
        });
    };
    
    window.selesaikanPenerimaan = function(index) {
        $('.action-dropdown').removeClass('active');
        
        Swal.fire({
            title: 'Selesaikan Penerimaan?',
            text: 'Penerimaan akan ditandai selesai dan diarsipkan',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#2563eb',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Ya, Selesaikan!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                updateStatus(index, 'Selesai');
            }
        });
    };
    
    window.hapusPenerimaan = function(index) {
        $('.action-dropdown').removeClass('active');
        
        Swal.fire({
            title: 'Hapus Penerimaan?',
            text: 'Data penerimaan akan dihapus permanen!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc2626',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                hapusData(index);
            }
        });
    };
    
    window.refreshData = function() {
        Swal.fire({
            title: 'Refresh Data?',
            text: 'Data akan dimuat ulang',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#16a34a',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Ya, Refresh!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                location.reload();
            }
        });
    };
    
    // Function untuk update status
    function updateStatus(index, status) {
        // Show loading
        Swal.fire({
            title: 'Memproses...',
            text: 'Sedang mengupdate status penerimaan',
            allowOutsideClick: false,
            allowEscapeKey: false,
            showConfirmButton: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });
        
        $.ajax({
            url: '{{ route("gudang.inventori.penerimaan.updateStatus") }}',
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                index: index,
                status: status
            },
            success: function(response) {
                if (response.success) {
                    Swal.fire({
                        title: 'Berhasil!',
                        text: response.message || 'Status berhasil diupdate!',
                        icon: 'success',
                        timer: 1500,
                        showConfirmButton: false
                    }).then(() => {
                        location.reload();
                    });
                } else {
                    Swal.fire({
                        title: 'Error!',
                        text: response.message || 'Terjadi kesalahan!',
                        icon: 'error'
                    });
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX error:', xhr, status, error);
                Swal.fire({
                    title: 'Error!',
                    text: 'Terjadi kesalahan sistem!',
                    icon: 'error'
                });
            }
        });
    }
    
    // Function untuk hapus data
    function hapusData(index) {
        // Show loading
        Swal.fire({
            title: 'Menghapus...',
            text: 'Sedang menghapus data penerimaan',
            allowOutsideClick: false,
            allowEscapeKey: false,
            showConfirmButton: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });
        
        $.ajax({
            url: '{{ route("gudang.inventori.penerimaan.hapus") }}',
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                index: index
            },
            success: function(response) {
                if (response.success) {
                    Swal.fire({
                        title: 'Berhasil!',
                        text: 'Data berhasil dihapus!',
                        icon: 'success',
                        timer: 1500,
                        showConfirmButton: false
                    }).then(() => {
                        location.reload();
                    });
                } else {
                    Swal.fire({
                        title: 'Error!',
                        text: response.message || 'Terjadi kesalahan!',
                        icon: 'error'
                    });
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX error:', xhr, status, error);
                Swal.fire({
                    title: 'Error!',
                    text: 'Terjadi kesalahan sistem!',
                    icon: 'error'
                });
            }
        });
    }
    
    // Show success message if redirected from pengiriman
    @if(session('from_pengiriman'))
        Swal.fire({
            title: 'Pengiriman Berhasil!',
            text: 'Pengiriman telah masuk ke sistem penerimaan',
            icon: 'success',
            timer: 2000,
            showConfirmButton: false
        });
    @endif
    
    // Auto close dropdowns after 5 seconds of inactivity
    let dropdownTimer;
    $(document).on('click', '.action-btn', function() {
        clearTimeout(dropdownTimer);
        dropdownTimer = setTimeout(function() {
            $('.action-dropdown').removeClass('active');
        }, 5000);
    });
});
</script>
@endsection
