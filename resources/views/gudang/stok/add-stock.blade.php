@extends('layouts.appGudang')

@section('title', 'Tambah Stok - MyYOGYA')

@section('content')
<style>
/* Modern Form Styles */
.add-stock-header {
    background: linear-gradient(135deg, #f26b37 0%, #e55827 100%);
    color: white;
    padding: 25px 30px;
    border-radius: 12px;
    margin-bottom: 25px;
    box-shadow: 0 4px 15px rgba(242, 107, 55, 0.3);
}

.add-stock-header h2 {
    font-size: 1.8rem;
    font-weight: 700;
    margin: 0;
}

.add-stock-header p {
    font-size: 1rem;
    opacity: 0.9;
    margin: 8px 0 0 0;
}

.modern-card {
    background: #ffffff;
    border-radius: 12px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    overflow: hidden;
    margin-bottom: 25px;
    border: 2px solid #f1f5f9;
}

.card-header-modern {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    padding: 20px 25px;
    border-bottom: 2px solid #dee2e6;
}

.card-title-modern {
    font-size: 1.3rem;
    font-weight: 700;
    color: #495057;
    margin: 0;
    display: flex;
    align-items: center;
}

.form-group-modern {
    margin-bottom: 25px;
}

.form-label-modern {
    color: #374151;
    font-weight: 600;
    margin-bottom: 8px;
    display: block;
}

.form-control-modern {
    border: 2px solid #e9ecef;
    border-radius: 8px;
    padding: 12px 16px;
    font-weight: 500;
    transition: all 0.3s ease;
    background: #ffffff;
}

.form-control-modern:focus {
    border-color: #f26b37;
    box-shadow: 0 0 0 0.2rem rgba(242, 107, 55, 0.25);
    outline: none;
}

.btn-modern {
    background: linear-gradient(135deg, #f26b37, #e55827);
    color: white;
    border: 2px solid #f26b37;
    padding: 12px 24px;
    border-radius: 8px;
    font-weight: 600;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    box-shadow: 0 2px 8px rgba(242, 107, 55, 0.3);
}

.btn-modern:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(242, 107, 55, 0.4);
    color: white;
    background: linear-gradient(135deg, #e55827, #d14d1f);
    border-color: #e55827;
}

.btn-outline-modern {
    background: transparent;
    color: #6c757d;
    border: 2px solid #dee2e6;
    padding: 12px 24px;
    border-radius: 8px;
    font-weight: 600;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    gap: 8px;
}

.btn-outline-modern:hover {
    background: #6c757d;
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(108, 117, 125, 0.3);
    border-color: #6c757d;
}

.product-info {
    background: #f8f9fa;
    border: 2px solid #e9ecef;
    border-radius: 12px;
    padding: 20px;
    margin-bottom: 25px;
}

.product-image {
    width: 80px;
    height: 80px;
    border-radius: 8px;
    overflow: hidden;
    border: 2px solid #dee2e6;
}

.product-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.stock-status {
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 0.85rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.stock-status.low {
    background: linear-gradient(135deg, #fef3c7, #fbbf24);
    color: #92400e;
    border: 1px solid #fbbf24;
}

.stock-status.empty {
    background: linear-gradient(135deg, #fee2e2, #ef4444);
    color: #991b1b;
    border: 1px solid #ef4444;
}

.stock-status.normal {
    background: linear-gradient(135deg, #d1fae5, #10b981);
    color: #065f46;
    border: 1px solid #10b981;
}

.alert-modern {
    border: none;
    border-radius: 8px;
    padding: 15px 20px;
    margin-bottom: 20px;
    font-weight: 500;
}

.alert-info-modern {
    background: linear-gradient(135deg, #dbeafe, #93c5fd);
    color: #1e40af;
    border-left: 4px solid #3b82f6;
}

@media (max-width: 768px) {
    .add-stock-header {
        padding: 20px;
        text-align: center;
    }
    
    .card-header-modern {
        padding: 15px 20px;
    }
    
    .product-info {
        text-align: center;
    }
    
    .product-info .row {
        flex-direction: column;
        align-items: center !important;
    }
}
</style>

<div class="add-stock-container">
    <!-- Header Section -->
    <div class="add-stock-header">
        <h2>Tambah Stok Barang</h2>
        <p>Tambahkan stok untuk produk yang sudah ada di gudang</p>
    </div>

    <!-- Alert Messages -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle"></i>
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Product Info Card -->
    <div class="modern-card">
        <div class="card-header-modern">
            <h5 class="card-title-modern">
                <i class="fas fa-info-circle" style="color: #f26b37; margin-right: 10px;"></i>
                Informasi Produk
            </h5>
        </div>
        <div class="card-body p-4">
            <div class="product-info">
                <div class="row align-items-center">
                    <div class="col-md-2 mb-3">
                        <div class="product-image">
                            <img src="{{ asset($stok->foto) }}" 
                                 alt="{{ $stok->nama_produk }}" 
                                 onerror="this.src='{{ asset('images/produk/default-product.svg') }}'">
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <h5 class="fw-bold mb-2">{{ $stok->nama_produk }}</h5>
                        <div class="text-muted mb-2">
                            <strong>Kode:</strong> #{{ str_pad($stok->id_produk, 3, '0', STR_PAD_LEFT) }}
                        </div>
                        <div class="text-muted mb-2">
                            <strong>Kategori:</strong> {{ $stok->kategori ?? 'Umum' }}
                        </div>
                        <div class="text-muted">
                            <strong>Satuan:</strong> {{ $stok->satuan }}
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="text-center">
                            <div class="display-6 fw-bold 
                                @if($stok->jumlah <= 0) text-danger 
                                @elseif($stok->jumlah <= 10) text-warning 
                                @else text-success @endif">
                                {{ $stok->jumlah }}
                            </div>
                            <div class="text-muted mb-2">Stok Saat Ini</div>
                            <span class="stock-status 
                                @if($stok->jumlah <= 0) empty
                                @elseif($stok->jumlah <= 10) low 
                                @else normal @endif">
                                @if($stok->jumlah <= 0) 
                                    Stok Habis
                                @elseif($stok->jumlah <= 10) 
                                    Stok Menipis
                                @else 
                                    Stok Aman
                                @endif
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Stock Form -->
    <div class="modern-card">
        <div class="card-header-modern">
            <h5 class="card-title-modern">
                <i class="fas fa-plus-circle" style="color: #f26b37; margin-right: 10px;"></i>
                Form Tambah Stok
            </h5>
        </div>
        <div class="card-body p-4">
            <div class="alert-modern alert-info-modern">
                <i class="fas fa-info-circle me-2"></i>
                <strong>Informasi:</strong> Stok yang ditambahkan akan langsung tersedia di sistem. Pastikan data yang dimasukkan sudah benar.
            </div>

            <form action="{{ route('gudang.stok.add-stock.submit', $stok) }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group-modern">
                            <label for="jumlah_tambah" class="form-label-modern">
                                <i class="fas fa-plus me-1"></i>
                                Jumlah Stok Ditambahkan *
                            </label>
                            <input type="number" 
                                   class="form-control form-control-modern @error('jumlah_tambah') is-invalid @enderror" 
                                   id="jumlah_tambah" 
                                   name="jumlah_tambah" 
                                   value="{{ old('jumlah_tambah') }}" 
                                   min="1" 
                                   required 
                                   placeholder="Masukkan jumlah stok yang akan ditambahkan">
                            @error('jumlah_tambah')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Minimal 1 unit</small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group-modern">
                            <label for="harga_beli" class="form-label-modern">
                                <i class="fas fa-tag me-1"></i>
                                Harga Beli Terbaru (Opsional)
                            </label>
                            <input type="number" 
                                   class="form-control form-control-modern @error('harga_beli') is-invalid @enderror" 
                                   id="harga_beli" 
                                   name="harga_beli" 
                                   value="{{ old('harga_beli', $stok->harga_beli) }}" 
                                   min="0" 
                                   step="0.01" 
                                   placeholder="Contoh: 15000">
                            @error('harga_beli')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Harga beli per unit dalam Rupiah</small>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group-modern">
                            <label for="expired" class="form-label-modern">
                                <i class="fas fa-calendar-alt me-1"></i>
                                Tanggal Kedaluwarsa (Opsional)
                            </label>
                            <input type="date" 
                                   class="form-control form-control-modern @error('expired') is-invalid @enderror" 
                                   id="expired" 
                                   name="expired" 
                                   value="{{ old('expired', $stok->expired?->format('Y-m-d')) }}" 
                                   min="{{ date('Y-m-d', strtotime('+1 day')) }}">
                            @error('expired')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Kosongkan jika produk tidak memiliki tanggal kedaluwarsa</small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group-modern">
                            <label for="keterangan" class="form-label-modern">
                                <i class="fas fa-sticky-note me-1"></i>
                                Keterangan (Opsional)
                            </label>
                            <textarea class="form-control form-control-modern @error('keterangan') is-invalid @enderror" 
                                      id="keterangan" 
                                      name="keterangan" 
                                      rows="3" 
                                      placeholder="Contoh: Pengadaan dari supplier ABC, batch baru, dll">{{ old('keterangan') }}</textarea>
                            @error('keterangan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Maksimal 500 karakter</small>
                        </div>
                    </div>
                </div>

                <!-- Preview Section -->
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="alert-modern alert-info-modern">
                            <h6><i class="fas fa-calculator me-2"></i>Ringkasan Penambahan Stok</h6>
                            <div class="row mt-3">
                                <div class="col-md-3">
                                    <div class="text-center">
                                        <div class="h4 text-primary">{{ $stok->jumlah }}</div>
                                        <small class="text-muted">Stok Saat Ini</small>
                                    </div>
                                </div>
                                <div class="col-md-2 text-center">
                                    <i class="fas fa-plus text-success" style="font-size: 1.5rem; margin-top: 8px;"></i>
                                </div>
                                <div class="col-md-3">
                                    <div class="text-center">
                                        <div class="h4 text-success" id="jumlah_preview">0</div>
                                        <small class="text-muted">Akan Ditambah</small>
                                    </div>
                                </div>
                                <div class="col-md-1 text-center">
                                    <i class="fas fa-equals text-info" style="font-size: 1.5rem; margin-top: 8px;"></i>
                                </div>
                                <div class="col-md-3">
                                    <div class="text-center">
                                        <div class="h4 text-info" id="total_preview">{{ $stok->jumlah }}</div>
                                        <small class="text-muted">Total Stok Baru</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="d-flex gap-3 justify-content-end mt-4">
                    <a href="{{ route('gudang.stok.index') }}" class="btn btn-outline-modern">
                        <i class="fas fa-arrow-left"></i>
                        Kembali
                    </a>
                    <button type="submit" class="btn btn-modern">
                        <i class="fas fa-plus-circle"></i>
                        Tambah Stok
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const jumlahInput = document.getElementById('jumlah_tambah');
    const jumlahPreview = document.getElementById('jumlah_preview');
    const totalPreview = document.getElementById('total_preview');
    const currentStock = {{ $stok->jumlah }};
    
    function updatePreview() {
        const tambah = parseInt(jumlahInput.value) || 0;
        jumlahPreview.textContent = tambah;
        totalPreview.textContent = currentStock + tambah;
    }
    
    jumlahInput.addEventListener('input', updatePreview);
    
    // Initial update
    updatePreview();
});
</script>
@endsection
