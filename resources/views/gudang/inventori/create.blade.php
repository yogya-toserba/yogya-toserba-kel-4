@extends('layouts.appInventori')

@section('content')
<style>
/* Styling khusus untuk halaman create dengan tema oranye */
.dashboard-container {
    min-height: 100vh;
    padding: 2rem;
}

.header-card {
    background: linear-gradient(135deg, #f26b37, #e55827);
    border-radius: 16px;
    padding: 2rem;
    margin-bottom: 2rem;
    color: white;
}

.form-card {
    background: white;
    border-radius: 16px;
    padding: 2rem;
    box-shadow: 0 4px 24px rgba(255, 152, 0, 0.1);
    overflow: hidden;
}

.form-input-orange {
    border: 2px solid #fff3e0;
    border-radius: 8px;
    padding: 0.75rem;
    transition: all 0.3s ease;
    background: white;
    width: 100%;
}

.form-input-orange:focus {
    border-color: #ff9800;
    box-shadow: 0 0 0 3px rgba(255, 152, 0, 0.1);
    outline: none;
    background: white;
}

.btn-orange {
    background: linear-gradient(135deg, #f26b37, #e55827);
    color: white;
    border: none;
    border-radius: 8px;
    padding: 0.75rem 1.5rem;
    font-weight: 600;
    transition: all 0.3s ease;
    box-shadow: 0 2px 8px rgba(242, 107, 55, 0.3);
}

.btn-orange:hover {
    background: linear-gradient(135deg, #e55827, #d94519);
    transform: translateY(-2px);
    box-shadow: 0 4px 16px rgba(242, 107, 55, 0.4);
}

.btn-gray {
    background: #6b7280;
    color: white;
    border: none;
    border-radius: 8px;
    padding: 0.75rem 1.5rem;
    font-weight: 600;
    transition: all 0.3s ease;
}

.btn-gray:hover {
    background: #4b5563;
    transform: translateY(-2px);
}
</style>

<div class="dashboard-container">
    <!-- Header Card -->
    <div class="header-card">
        <h1 class="text-3xl font-bold mb-2">
            <i class="fas fa-plus-circle mr-3"></i>Tambah Produk Baru
        </h1>
        <p class="text-orange-100">Tambahkan produk baru ke sistem inventori</p>
    </div>

    <!-- Session Messages -->
    @if (session('success'))
        <div class="alert alert-success bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-error bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <i class="fas fa-exclamation-circle mr-2"></i>{{ session('error') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-error bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <i class="fas fa-exclamation-triangle mr-2"></i>
            <ul class="list-disc list-inside ml-4">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Form Card -->
    <div class="form-card">
        <form action="{{ route('gudang.inventori.store') }}" method="POST" enctype="multipart/form-data" id="tambahProdukForm">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-tag mr-1"></i>Nama Barang
                    </label>
                    <input type="text" name="nama_barang" value="{{ old('nama_barang') }}" 
                           placeholder="Masukkan nama barang" class="form-input-orange" required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-barcode mr-1"></i>SKU
                    </label>
                    <input type="text" name="sku" value="{{ old('sku') }}" 
                           placeholder="Masukkan SKU produk" class="form-input-orange" required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-boxes mr-1"></i>Jumlah Barang
                    </label>
                    <input type="number" name="jumlah_barang" value="{{ old('jumlah_barang') }}" 
                           placeholder="100" class="form-input-orange" required min="1">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-warehouse mr-1"></i>Stok
                    </label>
                    <input type="number" name="stok" value="{{ old('stok') }}" 
                           placeholder="50" class="form-input-orange" required min="0">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-shopping-cart mr-1"></i>Harga Beli
                    </label>
                    <input type="number" name="harga_beli" value="{{ old('harga_beli') }}" 
                           placeholder="150000" class="form-input-orange" required min="1">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-money-bill-wave mr-1"></i>Harga Jual
                    </label>
                    <input type="number" name="harga_jual" value="{{ old('harga_jual') }}" 
                           placeholder="200000" class="form-input-orange" required min="1">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-info-circle mr-1"></i>Status
                    </label>
                    <select name="status" class="form-input-orange" required>
                        <option value="">Pilih Status</option>
                        <option value="aktif" {{ old('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="expire" {{ old('status') == 'expire' ? 'selected' : '' }}>Expire</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-image mr-1"></i>Foto Produk
                    </label>
                    <input type="file" name="foto" accept="image/*" class="form-input-orange">
                    <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG, GIF (Max: 2MB)</p>
                </div>
            </div>

            <div class="mt-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-align-left mr-1"></i>Deskripsi
                </label>
                <textarea name="deskripsi" rows="4" placeholder="Masukkan deskripsi produk (opsional)" 
                          class="form-input-orange">{{ old('deskripsi') }}</textarea>
            </div>

            <div class="mt-8 flex justify-end space-x-4">
                <a href="{{ route('gudang.inventori.index') }}" class="btn-gray">
                    <i class="fas fa-arrow-left mr-2"></i>Kembali
                </a>
                <button type="submit" class="btn-orange">
                    <i class="fas fa-save mr-2"></i>Simpan Produk
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Include Alert Konfirmasi -->
@include('components.confirm-alert')

@endsection

@push('scripts')
<script>
    // Form submission dengan konfirmasi
    document.getElementById('tambahProdukForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const form = this;
        
        // Validasi form
        const required = this.querySelectorAll('[required]');
        let valid = true;
        
        required.forEach(field => {
            if (!field.value.trim()) {
                field.style.borderColor = '#ef4444';
                valid = false;
            } else {
                field.style.borderColor = '#fff3e0';
            }
        });
        
        if (!valid) {
            alert('Mohon lengkapi semua field yang diperlukan!');
            return;
        }

        // Ambil data untuk konfirmasi
        const namaBarang = form.querySelector('[name="nama_barang"]').value;
        const sku = form.querySelector('[name="sku"]').value;
        const stok = form.querySelector('[name="stok"]').value;
        const hargaJual = form.querySelector('[name="harga_jual"]').value;

        // Tampilkan alert konfirmasi
        showConfirmAlert({
            title: 'Tambah Produk Baru',
            message: `Apakah Anda yakin ingin menambahkan produk "${namaBarang}" ke inventori?`,
            details: `Produk dengan SKU: ${sku}, Stok: ${stok} unit, Harga Jual: Rp ${parseInt(hargaJual).toLocaleString('id-ID')} akan ditambahkan ke sistem.`,
            confirmText: 'Tambah Produk',
            cancelText: 'Batalkan',
            icon: 'fas fa-plus-circle',
            iconColor: 'text-green-500',
            confirmColor: 'bg-green-500 hover:bg-green-600',
            onConfirm: function() {
                form.submit();
            }
        });
    });

    // Auto-format input harga
    const hargaInputs = document.querySelectorAll('input[name="harga_beli"], input[name="harga_jual"]');
    hargaInputs.forEach(input => {
        input.addEventListener('input', function() {
            // Remove non-numeric characters except for the first digit
            this.value = this.value.replace(/[^\d]/g, '');
        });
    });

    // Preview gambar
    const fotoInput = document.querySelector('input[name="foto"]');
    if (fotoInput) {
        fotoInput.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                // Validasi ukuran file (2MB)
                if (file.size > 2 * 1024 * 1024) {
                    alert('Ukuran file terlalu besar! Maksimal 2MB.');
                    this.value = '';
                    return;
                }
                
                // Validasi tipe file
                if (!file.type.match('image.*')) {
                    alert('File harus berupa gambar!');
                    this.value = '';
                    return;
                }
            }
        });
    }
</script>
@endpush
