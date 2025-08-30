@extends('layouts.appGudang')

@section('title', 'Detail Stok - ' . $stok->nama_produk)

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-semibold">Detail Produk Stok</h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('gudang.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('gudang.stok.index') }}">Stok Gudang</a></li>
                    <li class="breadcrumb-item active">{{ $stok->nama_produk }}</li>
                </ol>
            </nav>
        </div>
        <div>
            <a href="{{ route('gudang.stok.index') }}" class="btn btn-outline-secondary me-2">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
            <a href="{{ route('gudang.stok.edit', $stok) }}" class="btn btn-warning">
                <i class="fas fa-edit"></i> Edit
            </a>
        </div>
    </div>

    <div class="row">
        <!-- Product Image and Basic Info -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-body text-center">
                    @if($stok->foto)
                        <img src="{{ asset($stok->foto) }}" 
                             alt="{{ $stok->nama_produk }}" 
                             class="img-fluid rounded mb-3" 
                             style="max-height: 300px; object-fit: cover;"
                             onerror="this.src='{{ asset('images/produk/default-product.svg') }}'">
                    @else
                        <div class="bg-light rounded d-flex align-items-center justify-content-center mb-3" 
                             style="height: 300px;">
                            <i class="fas fa-image fa-4x text-muted"></i>
                        </div>
                    @endif
                    
                    <h4 class="fw-bold">{{ $stok->nama_produk }}</h4>
                    <p class="text-muted">ID: {{ $stok->id_produk }}</p>
                    
                    <!-- Stock Status -->
                    <div class="mt-3">
                        @if($stok->jumlah <= 0)
                            <span class="badge bg-danger fs-6">Stok Habis</span>
                        @elseif($stok->jumlah <= 10)
                            <span class="badge bg-warning fs-6">Stok Rendah</span>
                        @elseif($stok->jumlah <= 50)
                            <span class="badge bg-info fs-6">Stok Sedang</span>
                        @else
                            <span class="badge bg-success fs-6">Stok Tinggi</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Product Details -->
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Informasi Produk</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <td class="fw-bold">Nama Produk:</td>
                                    <td>{{ $stok->nama_produk }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Kategori:</td>
                                    <td>{{ $stok->kategori }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Deskripsi:</td>
                                    <td>{{ $stok->deskripsi ?: '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Satuan:</td>
                                    <td>{{ $stok->satuan }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Jumlah Stok:</td>
                                    <td>
                                        <span class="fs-4 fw-bold text-primary">{{ number_format($stok->jumlah) }}</span>
                                        <small class="text-muted">{{ $stok->satuan }}</small>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <td class="fw-bold">Harga Beli:</td>
                                    <td>{{ $stok->harga_beli ? 'Rp ' . number_format($stok->harga_beli, 0, ',', '.') : '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Harga Jual:</td>
                                    <td>{{ $stok->harga_jual ? 'Rp ' . number_format($stok->harga_jual, 0, ',', '.') : '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Margin:</td>
                                    <td>
                                        @if($stok->harga_beli && $stok->harga_jual && $stok->harga_beli > 0)
                                            @php
                                                $margin = (($stok->harga_jual - $stok->harga_beli) / $stok->harga_beli) * 100;
                                            @endphp
                                            <span class="badge bg-info">{{ number_format($margin, 1) }}%</span>
                                        @else
                                            -
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Kedaluwarsa:</td>
                                    <td>
                                        @if($stok->expired)
                                            {{ $stok->expired->format('d/m/Y') }}
                                            @php
                                                $daysUntilExpiry = now()->diffInDays($stok->expired, false);
                                            @endphp
                                            @if($daysUntilExpiry < 0)
                                                <span class="badge bg-danger ms-2">Expired</span>
                                            @elseif($daysUntilExpiry <= 7)
                                                <span class="badge bg-warning ms-2">{{ $daysUntilExpiry }} hari lagi</span>
                                            @elseif($daysUntilExpiry <= 30)
                                                <span class="badge bg-info ms-2">{{ $daysUntilExpiry }} hari lagi</span>
                                            @else
                                                <span class="badge bg-success ms-2">{{ $daysUntilExpiry }} hari lagi</span>
                                            @endif
                                        @else
                                            -
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Metadata Card -->
            <div class="card mt-4">
                <div class="card-header bg-light">
                    <h6 class="mb-0">Informasi Sistem</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <small class="text-muted">Gudang:</small>
                            <p class="mb-2">{{ $gudang->nama_gudang }} ({{ $gudang->lokasi }})</p>
                            
                            <small class="text-muted">Ditambahkan:</small>
                            <p class="mb-2">{{ $stok->created_at ? $stok->created_at->format('d/m/Y H:i') : '-' }}</p>
                        </div>
                        <div class="col-md-6">
                            <small class="text-muted">Terakhir Diubah:</small>
                            <p class="mb-2">{{ $stok->updated_at ? $stok->updated_at->format('d/m/Y H:i') : '-' }}</p>
                            
                            @if($stok->harga_beli && $stok->harga_jual)
                                <small class="text-muted">Total Nilai Stok:</small>
                                <p class="mb-2 fw-bold text-success">
                                    Rp {{ number_format($stok->jumlah * $stok->harga_jual, 0, ',', '.') }}
                                </p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="d-flex justify-content-center gap-3">
                <a href="{{ route('gudang.stok.edit', $stok) }}" class="btn btn-warning">
                    <i class="fas fa-edit"></i> Edit Produk
                </a>
                <button type="button" class="btn btn-danger" onclick="deleteStock()">
                    <i class="fas fa-trash"></i> Hapus Produk
                </button>
                <a href="{{ route('gudang.stok.index') }}" class="btn btn-secondary">
                    <i class="fas fa-list"></i> Kembali ke Daftar
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Konfirmasi Hapus Produk</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <i class="fas fa-exclamation-triangle fa-3x text-warning mb-3"></i>
                    <h5>Apakah Anda yakin?</h5>
                    <p>Produk <strong>{{ $stok->nama_produk }}</strong> akan dihapus dari stok gudang. Tindakan ini tidak dapat dibatalkan.</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <form action="{{ route('gudang.stok.destroy', $stok) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash"></i> Ya, Hapus Produk
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    function deleteStock() {
        new bootstrap.Modal(document.getElementById('deleteModal')).show();
    }
</script>
@endpush
