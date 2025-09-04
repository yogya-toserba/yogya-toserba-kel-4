@extends('layouts.appGudang')

@section('title', 'Detail Pengiriman - MyYOGYA Dashboard')

@section('content')
<div class="container-fluid py-4">
    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="mb-0 fw-bold text-dark">
                                <i class="fas fa-eye text-info me-2"></i>
                                Detail Pengiriman
                            </h4>
                            <p class="text-muted mb-0 mt-1">Informasi lengkap pengiriman produk</p>
                        </div>
                        <div class="d-flex gap-2">
                            <a href="{{ route('gudang.pengiriman.edit', $pengiriman->id) }}" class="btn btn-warning">
                                <i class="fas fa-edit me-2"></i>Edit
                            </a>
                            <a href="{{ route('gudang.pengiriman.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left me-2"></i>Kembali
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Detail Section -->
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-0 py-3">
                    <h5 class="mb-0 fw-semibold">
                        <i class="fas fa-info-circle text-info me-2"></i>
                        Informasi Pengiriman
                    </h5>
                </div>
                <div class="card-body p-4">
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <div class="detail-item">
                                <label class="detail-label">ID Pengiriman</label>
                                <div class="detail-value">
                                    <span class="badge bg-primary fs-6">#{{ str_pad($pengiriman->id, 5, '0', STR_PAD_LEFT) }}</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6 mb-4">
                            <div class="detail-item">
                                <label class="detail-label">Status</label>
                                <div class="detail-value">
                                    {!! $pengiriman->status_label !!}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <div class="detail-item">
                                <label class="detail-label">Nama Produk</label>
                                <div class="detail-value">
                                    <i class="fas fa-box text-muted me-2"></i>
                                    {{ $pengiriman->nama_produk }}
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6 mb-4">
                            <div class="detail-item">
                                <label class="detail-label">Tujuan</label>
                                <div class="detail-value">
                                    <i class="fas fa-map-marker-alt text-muted me-2"></i>
                                    {{ $pengiriman->tujuan }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <div class="detail-item">
                                <label class="detail-label">Jumlah</label>
                                <div class="detail-value">
                                    <i class="fas fa-cubes text-muted me-2"></i>
                                    <span class="fw-bold text-primary">{{ number_format($pengiriman->jumlah) }} pcs</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6 mb-4">
                            <div class="detail-item">
                                <label class="detail-label">Tanggal Kirim</label>
                                <div class="detail-value">
                                    <i class="fas fa-calendar text-muted me-2"></i>
                                    {{ \Carbon\Carbon::parse($pengiriman->tanggal_kirim)->format('d F Y') }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <div class="detail-item">
                                <label class="detail-label">Dibuat Pada</label>
                                <div class="detail-value">
                                    <i class="fas fa-clock text-muted me-2"></i>
                                    {{ $pengiriman->created_at->format('d F Y, H:i') }}
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6 mb-4">
                            <div class="detail-item">
                                <label class="detail-label">Terakhir Diubah</label>
                                <div class="detail-value">
                                    <i class="fas fa-edit text-muted me-2"></i>
                                    {{ $pengiriman->updated_at->format('d F Y, H:i') }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="d-flex gap-2 pt-3 border-top">
                        <a href="{{ route('gudang.pengiriman.edit', $pengiriman->id) }}" class="btn btn-warning">
                            <i class="fas fa-edit me-2"></i>Edit Pengiriman
                        </a>
                        <button type="button" class="btn btn-danger" id="deleteBtn">
                            <i class="fas fa-trash me-2"></i>Hapus Pengiriman
                        </button>
                        <a href="{{ route('gudang.pengiriman.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-list me-2"></i>Kembali ke Daftar
                        </a>
                    </div>
                </div>
            </div>
        </div>
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
                <div class="alert alert-warning">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <strong>Perhatian:</strong> Data yang dihapus tidak dapat dikembalikan!
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <form action="{{ route('gudang.pengiriman.destroy', $pengiriman->id) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
.detail-item {
    background: #f8f9fa;
    border-radius: 8px;
    padding: 15px;
    height: 100%;
}

.detail-label {
    font-size: 0.875rem;
    font-weight: 600;
    color: #6c757d;
    margin-bottom: 8px;
    display: block;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.detail-value {
    font-size: 1rem;
    font-weight: 500;
    color: #212529;
    display: flex;
    align-items: center;
}

.card-header {
    border-bottom: 1px solid #e9ecef;
}

.badge {
    font-size: 0.875rem;
}
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$(document).ready(function() {
    // Delete confirmation
    $('#deleteBtn').on('click', function() {
        $('#deleteModal').modal('show');
    });

    // Show success message if redirected from create/update
    @if(session('success'))
        Swal.fire({
            title: 'Berhasil!',
            text: '{{ session("success") }}',
            icon: 'success',
            timer: 3000,
            showConfirmButton: false
        });
    @endif
});
</script>
@endpush
@endsection
