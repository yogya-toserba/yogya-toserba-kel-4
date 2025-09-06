@extends('layouts.appInventori')

@section('title', 'Penerimaan - MyYOGYA Inventori')

@section('content')
<div class="container-fluid">
    <!-- Modern Minimal Styles -->
    <style>
    .main-content {
        padding: 1.5rem;
        background: #f8fafc;
        min-height: 100vh;
    }
    
    .page-title {
        margin-bottom: 2rem;
    }
    
    .page-title h1 {
        font-size: 1.75rem;
        font-weight: 600;
        color: #1e293b;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }
    
    .page-title p {
        color: #64748b;
        margin: 0.5rem 0 0 0;
        font-size: 0.95rem;
    }
    
    .metric-card {
        background: white;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        padding: 1.5rem;
        transition: all 0.2s ease;
        height: 100%;
    }
    
    .metric-card:hover {
        border-color: #cbd5e1;
        box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1);
    }
    
    .metric-icon {
        width: 48px;
        height: 48px;
        border-radius: 6px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1rem;
        font-size: 1.25rem;
    }
    
    .metric-icon.success { background: #f0fdf4; color: #16a34a; }
    .metric-icon.warning { background: #fefce8; color: #ca8a04; }
    .metric-icon.primary { background: #eff6ff; color: #2563eb; }
    .metric-icon.info { background: #f0f9ff; color: #0284c7; }
    
    .metric-value {
        font-size: 2rem;
        font-weight: 700;
        color: #0f172a;
        margin: 0;
        line-height: 1;
    }
    
    .metric-label {
        color: #64748b;
        font-size: 0.875rem;
        margin: 0.5rem 0 0 0;
        font-weight: 500;
    }
    
    .content-card {
        background: white;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        margin-bottom: 1.5rem;
    }
    
    .card-header {
        padding: 1.25rem 1.5rem;
        border-bottom: 1px solid #e2e8f0;
        background: #f8fafc;
        border-radius: 8px 8px 0 0;
    }
    
    .card-header h6 {
        margin: 0;
        font-size: 0.875rem;
        font-weight: 600;
        color: #374151;
        text-transform: uppercase;
        letter-spacing: 0.025em;
    }
    
    .card-body {
        padding: 1.5rem;
    }
    
    .form-group {
        margin-bottom: 1rem;
    }
    
    .form-label {
        display: block;
        font-size: 0.875rem;
        font-weight: 500;
        color: #374151;
        margin-bottom: 0.5rem;
    }
    
    .form-control, .form-select {
        width: 100%;
        padding: 0.625rem 0.75rem;
        border: 1px solid #d1d5db;
        border-radius: 6px;
        font-size: 0.875rem;
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        background: white;
    }
    
    .form-control:focus, .form-select:focus {
        outline: none;
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }
    
    .btn {
        padding: 0.625rem 1rem;
        border-radius: 6px;
        font-size: 0.875rem;
        font-weight: 500;
        border: 1px solid transparent;
        cursor: pointer;
        transition: all 0.15s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        text-decoration: none;
    }
    
    .btn-primary {
        background: #3b82f6;
        color: white;
        border-color: #3b82f6;
    }
    
    .btn-primary:hover {
        background: #2563eb;
        border-color: #2563eb;
        color: white;
    }
    
    .btn-outline {
        background: white;
        color: #6b7280;
        border-color: #d1d5db;
    }
    
    .btn-outline:hover {
        background: #f9fafb;
        color: #374151;
        border-color: #9ca3af;
    }
    
    .table-container {
        background: white;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        overflow: hidden;
    }
    
    .table {
        margin: 0;
        font-size: 0.875rem;
    }
    
    .table th {
        background: #f8fafc;
        border: none;
        padding: 0.75rem;
        font-weight: 600;
        color: #374151;
        font-size: 0.8125rem;
        text-transform: uppercase;
        letter-spacing: 0.025em;
        border-bottom: 1px solid #e2e8f0;
    }
    
    .table td {
        padding: 1rem 0.75rem;
        border: none;
        border-bottom: 1px solid #f1f5f9;
        vertical-align: middle;
    }
    
    .table tbody tr:hover {
        background: #f8fafc;
    }
    
    .table tbody tr:last-child td {
        border-bottom: none;
    }
    
    .badge {
        padding: 0.25rem 0.625rem;
        border-radius: 4px;
        font-size: 0.75rem;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.025em;
    }
    
    .badge.status-warning { background: #fef3c7; color: #92400e; }
    .badge.status-success { background: #d1fae5; color: #065f46; }
    .badge.status-primary { background: #dbeafe; color: #1e40af; }
    .badge.qty { background: #ecfdf5; color: #047857; }
    
    .dropdown-toggle::after {
        display: none;
    }
    
    .dropdown-menu {
        border: 1px solid #e2e8f0;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        border-radius: 6px;
        padding: 0.5rem 0;
    }
    
    .dropdown-item {
        padding: 0.5rem 1rem;
        font-size: 0.875rem;
        color: #374151;
        transition: background-color 0.15s ease;
    }
    
    .dropdown-item:hover {
        background: #f3f4f6;
        color: #111827;
    }
    
    .empty-state {
        padding: 3rem 1rem;
        text-align: center;
        color: #9ca3af;
    }
    
    .empty-state i {
        font-size: 3rem;
        margin-bottom: 1rem;
        opacity: 0.5;
    }
    
    .filter-form {
        display: grid;
        grid-template-columns: 2fr 1fr 1fr 1fr auto;
        gap: 1rem;
        align-items: end;
    }
    
    @media (max-width: 768px) {
        .filter-form {
            grid-template-columns: 1fr;
        }
        
        .main-content {
            padding: 1rem;
        }
    }
    </style>

    <div class="main-content">
        <!-- Page Header -->
        <div class="page-title">
            <h1>
                <i class="fas fa-truck-loading"></i>
                Penerimaan
            </h1>
            <p>Kelola penerimaan produk dari pengiriman</p>
        </div>

        <!-- Metrics -->
        <div class="row mb-4">
            <div class="col-lg-3 col-md-6 mb-3">
                <div class="metric-card">
                    <div class="metric-icon success">
                        <i class="fas fa-boxes"></i>
                    </div>
                    <div class="metric-value">{{ number_format($totalPenerimaan) }}</div>
                    <div class="metric-label">Total Penerimaan</div>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6 mb-3">
                <div class="metric-card">
                    <div class="metric-icon warning">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div class="metric-value">{{ number_format($menunggu) }}</div>
                    <div class="metric-label">Dalam Perjalanan</div>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6 mb-3">
                <div class="metric-card">
                    <div class="metric-icon primary">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div class="metric-value">{{ number_format($diterima) }}</div>
                    <div class="metric-label">Diterima</div>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6 mb-3">
                <div class="metric-card">
                    <div class="metric-icon info">
                        <i class="fas fa-check-double"></i>
                    </div>
                    <div class="metric-value">{{ number_format($selesai) }}</div>
                    <div class="metric-label">Selesai</div>
                </div>
            </div>
        </div>

        <!-- Filter -->
        <div class="content-card">
            <div class="card-header">
                <h6>Filter Data</h6>
            </div>
            <div class="card-body">
                <form method="GET" action="{{ route('gudang.inventori.penerimaan.index') }}">
                    <div class="filter-form">
                        <div class="form-group">
                            <label class="form-label">Cari</label>
                            <input type="text" name="search" class="form-control" 
                                   placeholder="Nama produk atau tujuan..." 
                                   value="{{ request('search') }}">
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select">
                                <option value="">Semua</option>
                                @foreach($statusOptions as $value => $label)
                                    <option value="{{ $value }}" 
                                            {{ request('status') == $value ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Dari</label>
                            <input type="date" name="tanggal_dari" class="form-control" 
                                   value="{{ request('tanggal_dari') }}">
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Sampai</label>
                            <input type="date" name="tanggal_sampai" class="form-control" 
                                   value="{{ request('tanggal_sampai') }}">
                        </div>
                        
                        <div class="form-group">
                            <div style="display: flex; gap: 0.5rem;">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-search"></i>
                                    Filter
                                </button>
                                <a href="{{ route('gudang.inventori.penerimaan.index') }}" class="btn btn-outline">
                                    <i class="fas fa-times"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Data Table -->
        <div class="table-container">
            <table class="table">
                <thead>
                    <tr>
                        <th style="width: 60px;">No</th>
                        <th>Produk</th>
                        <th>Tujuan</th>
                        <th style="width: 100px;">Jumlah</th>
                        <th style="width: 120px;">Tgl Kirim</th>
                        <th style="width: 120px;">Tgl Terima</th>
                        <th style="width: 140px;">Status</th>
                        <th style="width: 80px;" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($sessionPenerimaan as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>
                            <div style="font-weight: 600; color: #1f2937;">
                                {{ $item['nama_produk'] ?? 'N/A' }}
                            </div>
                        </td>
                        <td>
                            <div style="color: #6b7280;">
                                {{ $item['tujuan'] ?? 'N/A' }}
                            </div>
                        </td>
                        <td>
                            <span class="badge qty">{{ number_format($item['jumlah'] ?? 0) }}</span>
                        </td>
                        <td>
                            <div style="font-size: 0.8125rem; color: #6b7280;">
                                {{ isset($item['tanggal_kirim']) ? \Carbon\Carbon::parse($item['tanggal_kirim'])->format('d/m/Y') : '-' }}
                            </div>
                        </td>
                        <td>
                            <div style="font-size: 0.8125rem; color: #6b7280;">
                                {{ isset($item['tanggal_terima']) ? \Carbon\Carbon::parse($item['tanggal_terima'])->format('d/m/Y') : '-' }}
                            </div>
                        </td>
                        <td>
                            <div class="dropdown">
                                <button class="btn p-0 border-0 bg-transparent" 
                                        type="button" data-bs-toggle="dropdown">
                                    @php
                                        $status = $item['status'] ?? 'Dalam Perjalanan';
                                        $statusClass = [
                                            'Dalam Perjalanan' => 'status-warning',
                                            'Diterima' => 'status-success',
                                            'Selesai' => 'status-primary'
                                        ][$status] ?? 'status-warning';
                                    @endphp
                                    <span class="badge {{ $statusClass }}">{{ $status }}</span>
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
                        <td class="text-center">
                            <div class="dropdown">
                                <button class="btn p-0 border-0 bg-transparent" 
                                        type="button" 
                                        data-bs-toggle="dropdown" 
                                        style="color: #6b7280;">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                                <ul class="dropdown-menu">
                                    @if(($item['status'] ?? 'Dalam Perjalanan') === 'Dalam Perjalanan')
                                        <li>
                                            <a class="dropdown-item" 
                                               href="#" 
                                               onclick="terimaPenerimaan({{ $index }})"
                                               style="color: #16a34a;">
                                                <i class="fas fa-check me-2"></i>Terima
                                            </a>
                                        </li>
                                    @endif
                                    @if(($item['status'] ?? 'Dalam Perjalanan') === 'Diterima')
                                        <li>
                                            <a class="dropdown-item" 
                                               href="#" 
                                               onclick="selesaikanPenerimaan({{ $index }})"
                                               style="color: #2563eb;">
                                                <i class="fas fa-check-double me-2"></i>Selesaikan
                                            </a>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8">
                            <div class="empty-state">
                                <i class="fas fa-inbox"></i>
                                <div style="font-size: 1.125rem; font-weight: 500; margin: 1rem 0 0.5rem 0; color: #374151;">
                                    Tidak ada data penerimaan
                                </div>
                                <div style="font-size: 0.875rem;">
                                    Data akan muncul setelah ada pengiriman yang dikirim
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            
            @if($penerimaan->hasPages())
            <div style="padding: 1rem 1.5rem; border-top: 1px solid #e2e8f0; background: #f8fafc;">
                <div class="d-flex justify-content-between align-items-center">
                    <div style="color: #6b7280; font-size: 0.875rem;">
                        {{ $penerimaan->firstItem() ?? 0 }} - {{ $penerimaan->lastItem() ?? 0 }} 
                        dari {{ $penerimaan->total() }}
                    </div>
                    {{ $penerimaan->links() }}
                </div>
            </div>
            @endif
        </div>
    </div>

<script>
function terimaPenerimaan(index) {
    if (confirm('Apakah Anda yakin ingin menerima penerimaan ini?')) {
        $.post('{{ route("gudang.inventori.penerimaan.terima") }}', {
            _token: '{{ csrf_token() }}',
            index: index
        })
        .done(function(response) {
            if (response.success) {
                alert('Penerimaan berhasil diterima!');
                location.reload();
            } else {
                alert('Error: ' + response.message);
            }
        })
        .fail(function() {
            alert('Terjadi kesalahan sistem!');
        });
    }
}

function selesaikanPenerimaan(index) {
    if (confirm('Apakah Anda yakin ingin menyelesaikan penerimaan ini?')) {
        $.post('{{ route("gudang.inventori.penerimaan.update-status") }}', {
            _token: '{{ csrf_token() }}',
            index: index,
            status: 'Selesai'
        })
        .done(function(response) {
            if (response.success) {
                alert('Penerimaan berhasil diselesaikan!');
                location.reload();
            } else {
                alert('Error: ' + response.message);
            }
        })
        .fail(function() {
            alert('Terjadi kesalahan sistem!');
        });
    }
}

$(document).ready(function() {
    // Update status dropdown
    $('.update-status').click(function(e) {
        e.preventDefault();
        
        var index = $(this).data('index');
        var status = $(this).data('status');
        
        $.post('{{ route("gudang.inventori.penerimaan.update-status") }}', {
            _token: '{{ csrf_token() }}',
            index: index,
            status: status
        })
        .done(function(response) {
            if (response.success) {
                location.reload();
            } else {
                alert('Error: ' + response.message);
            }
        })
        .fail(function() {
            alert('Terjadi kesalahan sistem!');
        });
    });
});
</script>
@endsection
