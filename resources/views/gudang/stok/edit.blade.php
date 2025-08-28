@extends('layouts.appGudang')

@section('title', 'Edit Stok - ' . $stok->nama_produk)

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-semibold">Edit Produk Stok</h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('gudang.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('gudang.stok.index') }}">Stok Gudang</a></li>
                    <li class="breadcrumb-item active">Edit: {{ $stok->nama_produk }}</li>
                </ol>
            </nav>
        </div>
        <a href="{{ route('gudang.stok.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    @if($errors->any())
        <div class="alert alert-danger">
            <h6>Terdapat kesalahan:</h6>
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card">
        <div class="card-header bg-warning text-dark">
            <h5 class="card-title mb-0">Form Edit Produk</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('gudang.stok.update', $stok) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="nama_produk" class="form-label">Nama Produk <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('nama_produk') is-invalid @enderror" 
                                   id="nama_produk" name="nama_produk" 
                                   value="{{ old('nama_produk', $stok->nama_produk) }}" required>
                            @error('nama_produk')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="kategori" class="form-label">Kategori <span class="text-danger">*</span></label>
                            <select class="form-select @error('kategori') is-invalid @enderror" 
                                    id="kategori" name="kategori" required>
                                <option value="">Pilih Kategori</option>
                                <option value="Sembako" {{ old('kategori', $stok->kategori) == 'Sembako' ? 'selected' : '' }}>Sembako</option>
                                <option value="Makanan" {{ old('kategori', $stok->kategori) == 'Makanan' ? 'selected' : '' }}>Makanan</option>
                                <option value="Minuman" {{ old('kategori', $stok->kategori) == 'Minuman' ? 'selected' : '' }}>Minuman</option>
                                <option value="Perawatan" {{ old('kategori', $stok->kategori) == 'Perawatan' ? 'selected' : '' }}>Perawatan</option>
                                <option value="Rumah Tangga" {{ old('kategori', $stok->kategori) == 'Rumah Tangga' ? 'selected' : '' }}>Rumah Tangga</option>
                            </select>
                            @error('kategori')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <textarea class="form-control @error('deskripsi') is-invalid @enderror" 
                                      id="deskripsi" name="deskripsi" rows="3">{{ old('deskripsi', $stok->deskripsi) }}</textarea>
                            @error('deskripsi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="satuan" class="form-label">Satuan <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('satuan') is-invalid @enderror" 
                                   id="satuan" name="satuan" 
                                   value="{{ old('satuan', $stok->satuan) }}" 
                                   placeholder="Contoh: Pcs, Kg, Liter, Dus" required>
                            @error('satuan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="jumlah" class="form-label">Jumlah Stok <span class="text-danger">*</span></label>
                            <input type="number" class="form-control @error('jumlah') is-invalid @enderror" 
                                   id="jumlah" name="jumlah" 
                                   value="{{ old('jumlah', $stok->jumlah) }}" 
                                   min="0" required>
                            @error('jumlah')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="harga_beli" class="form-label">Harga Beli</label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="number" class="form-control @error('harga_beli') is-invalid @enderror" 
                                       id="harga_beli" name="harga_beli" 
                                       value="{{ old('harga_beli', $stok->harga_beli) }}" 
                                       min="0" step="0.01">
                                @error('harga_beli')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="harga_jual" class="form-label">Harga Jual</label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="number" class="form-control @error('harga_jual') is-invalid @enderror" 
                                       id="harga_jual" name="harga_jual" 
                                       value="{{ old('harga_jual', $stok->harga_jual) }}" 
                                       min="0" step="0.01">
                                @error('harga_jual')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="expired" class="form-label">Tanggal Kedaluwarsa</label>
                            <input type="date" class="form-control @error('expired') is-invalid @enderror" 
                                   id="expired" name="expired" 
                                   value="{{ old('expired', $stok->expired ? $stok->expired->format('Y-m-d') : '') }}" 
                                   min="{{ date('Y-m-d') }}">
                            @error('expired')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="foto" class="form-label">Foto Produk</label>
                            
                            <!-- Current Photo -->
                            @if($stok->foto)
                                <div class="mb-2">
                                    <small class="text-muted">Foto saat ini:</small>
                                    <div>
                                        <img src="{{ asset('storage/' . $stok->foto) }}" 
                                             alt="{{ $stok->nama_produk }}" 
                                             class="img-thumbnail" style="max-width: 200px;">
                                    </div>
                                </div>
                            @endif
                            
                            <input type="file" class="form-control @error('foto') is-invalid @enderror" 
                                   id="foto" name="foto" 
                                   accept="image/*" onchange="previewImage(this)">
                            <small class="text-muted">Format: JPG, PNG, maksimal 2MB. Kosongkan jika tidak ingin mengubah foto.</small>
                            @error('foto')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            
                            <!-- New Image Preview -->
                            <div id="imagePreview" class="mt-2" style="display: none;">
                                <small class="text-muted">Preview foto baru:</small>
                                <div>
                                    <img id="preview" src="" alt="Preview" class="img-thumbnail" style="max-width: 200px;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <hr>
                
                <div class="row">
                    <div class="col-12">
                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('gudang.stok.index') }}" class="btn btn-secondary">
                                <i class="fas fa-times"></i> Batal
                            </a>
                            <a href="{{ route('gudang.stok.show', $stok) }}" class="btn btn-info">
                                <i class="fas fa-eye"></i> Lihat Detail
                            </a>
                            <button type="submit" class="btn btn-warning">
                                <i class="fas fa-save"></i> Update Produk
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    function previewImage(input) {
        const preview = document.getElementById('preview');
        const previewContainer = document.getElementById('imagePreview');
        
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                preview.src = e.target.result;
                previewContainer.style.display = 'block';
            }
            
            reader.readAsDataURL(input.files[0]);
        } else {
            previewContainer.style.display = 'none';
        }
    }

    // Auto calculate margin
    document.getElementById('harga_beli').addEventListener('input', function() {
        const hargaBeli = parseFloat(this.value) || 0;
        const hargaJualCurrent = parseFloat(document.getElementById('harga_jual').value) || 0;
        
        // Only auto-calculate if harga_jual is empty or very close to calculated value
        if (hargaJualCurrent === 0) {
            const margin = 0.2; // 20% margin
            const hargaJual = Math.round(hargaBeli * (1 + margin));
            document.getElementById('harga_jual').value = hargaJual;
        }
    });
</script>
@endpush
