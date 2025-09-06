@extends('layouts.appGudang')

@section('title', 'Pengiriman - MyYOGYA Dashboard')

@section('content')
<div class="container-fluid py-4">
    <!-- Header Section -->
    <style>
    .page-header {
        background: linear-gradient(135deg, #f26b37 0%, #e55827 100%);
        color: #fff;
        padding: 22px;
        border-radius: 12px;
        margin-bottom: 20px;
        box-shadow: 0 8px 28px rgba(0,0,0,0.08);
    }
    .page-header h1 { margin: 0; font-size: 1.5rem; font-weight: 700; }
    .page-header p { margin: 0; opacity: 0.95; }
    .page-header .actions .btn { min-width: 140px; }
    </style>

    <div class="page-header d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1><i class="fas fa-shipping-fast me-2"></i>Manajemen Pengiriman</h1>
            <p class="mb-0">Kelola pengiriman produk ke berbagai cabang</p>
        </div>
        <div class="actions d-flex gap-2">
            <a href="{{ route('gudang.pengiriman.create') }}" class="btn btn-orange btn-lg shadow-sm">
                <i class="fas fa-plus me-2"></i>Tambah Pengiriman
            </a>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="bg-primary bg-opacity-10 rounded-3 p-3">
                                <i class="fas fa-boxes text-primary fs-4"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="text-muted fw-normal mb-1">Total Pengiriman</h6>
                            <h4 class="mb-0 fw-bold">{{ number_format($totalPengiriman) }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="bg-warning bg-opacity-10 rounded-3 p-3">
                                <i class="fas fa-clock text-warning fs-4"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="text-muted fw-normal mb-1">Pending</h6>
                            <h4 class="mb-0 fw-bold">{{ number_format($pending) }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="bg-info bg-opacity-10 rounded-3 p-3">
                                <i class="fas fa-truck text-info fs-4"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="text-muted fw-normal mb-1">Dikirim</h6>
                            <h4 class="mb-0 fw-bold">{{ number_format($dikirim) }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="bg-success bg-opacity-10 rounded-3 p-3">
                                <i class="fas fa-check-circle text-success fs-4"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="text-muted fw-normal mb-1">Selesai</h6>
                            <h4 class="mb-0 fw-bold">{{ number_format($selesai) }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter Section -->
    <div class="new-card mb-4">
        <div class="new-card-body">
            <form method="GET" action="{{ route('gudang.pengiriman.index') }}" id="filterForm">
                <div class="d-flex flex-wrap gap-3 align-items-end">
                    <div class="flex-fill" style="min-width: 250px;">
                        <label class="form-label fw-medium">Cari Pengiriman</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0">
                                <i class="fas fa-search text-muted"></i>
                            </span>
                            <input type="text" name="search" class="form-control border-start-0" 
                                   placeholder="Nama produk atau tujuan..." 
                                   value="{{ request('search') }}">
                        </div>
                    </div>
                    <div style="min-width: 150px;">
                        <label class="form-label fw-medium">Status</label>
                        <select name="status" class="form-select">
                            <option value="">Semua Status</option>
                            @foreach($statusOptions as $value => $label)
                                <option value="{{ $value }}" {{ request('status') == $value ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div style="min-width: 150px;">
                        <label class="form-label fw-medium">Tanggal Dari</label>
                        <input type="date" name="tanggal_dari" class="form-control" 
                               value="{{ request('tanggal_dari') }}">
                    </div>
                    <div style="min-width: 150px;">
                        <label class="form-label fw-medium">Tanggal Sampai</label>
                        <input type="date" name="tanggal_sampai" class="form-control" 
                               value="{{ request('tanggal_sampai') }}">
                    </div>
                    <div>
                        <button type="submit" class="btn btn-outline-primary">
                            <i class="fas fa-filter me-1"></i>Filter
                        </button>
                    </div>
                    <div>
                        <a href="{{ route('gudang.pengiriman.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-times me-1"></i>Reset
                        </a>
                    </div>
                </div>
            </form>
        </div>
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
            </div>
        </div>

        @if($pengiriman->hasPages())
        <div class="new-card-footer bg-transparent border-0">
            <div class="d-flex justify-content-between align-items-center">
                <div class="text-muted">
                    Menampilkan {{ $pengiriman->firstItem() }} - {{ $pengiriman->lastItem() }} 
                    dari {{ $pengiriman->total() }} data
                </div>
                {{ $pengiriman->links() }}
            </div>
        </div>
        @endif
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Konfirmasi Hapus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menghapus data pengiriman ini?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <form id="deleteForm" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$(document).ready(function() {
    // Tooltip initialization
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

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
</script>
@endpush
@endsection
