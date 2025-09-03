<style>
.form-input-orange {
    border: 2px solid #fff3e0;
    border-radius: 8px;
    padding: 0.75rem;
    transition: all 0.3s ease;
}

.form-input-orange:focus {
    border-color: #ff9800;
    box-shadow: 0 0 0 3px rgba(255, 152, 0, 0.1);
    outline: none;
}

.btn-orange {
    background: linear-gradient(45deg, #ff9800, #ff6f00);
    color: white;
    border: none;
    border-radius: 8px;
    padding: 0.75rem 1.5rem;
    font-weight: 600;
    transition: all 0.3s ease;
    box-shadow: 0 2px 8px rgba(255, 152, 0, 0.3);
}

.btn-orange:hover {
    background: linear-gradient(45deg, #ff6f00, #e65100);
    transform: translateY(-2px);
    box-shadow: 0 4px 16px rgba(255, 152, 0, 0.4);
}
</style>

<h3 class="font-bold text-2xl mb-6 text-orange-600">
    <i class="fas fa-edit mr-2"></i>Edit Produk
</h3>
<form action="{{ route('gudang.inventori.update', $produk->id_produk) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="space-y-4">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Nama Barang</label>
            <input type="text" name="nama_barang" value="{{ $produk->nama_barang }}" 
                   class="form-input-orange w-full" required>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Jumlah Barang</label>
                <input type="number" name="jumlah_barang" value="{{ $produk->jumlah_barang }}" 
                       class="form-input-orange w-full" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Stok</label>
                <input type="number" name="stok" value="{{ $produk->stok }}" 
                       class="form-input-orange w-full" required>
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Harga Jual</label>
            <input type="number" name="harga_jual" value="{{ $produk->harga_jual }}" 
                   class="form-input-orange w-full" required>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Foto Produk</label>
            <input type="file" name="foto" accept="image/*" 
                   class="form-input-orange w-full">
            @if($produk->foto)
                <div class="mt-3">
                    <img src="{{ asset('storage/'.$produk->foto) }}" 
                         alt="gambar {{ $produk->nama_barang }}" 
                         class="w-20 h-20 object-cover rounded-lg shadow-md border-2 border-orange-200">
                </div>
            @endif
        </div>
    </div>

    <div class="modal-action mt-8">
        <button type="submit" class="btn-orange">
            <i class="fas fa-save mr-2"></i>Update Produk
        </button>
        <button type="button" class="btn bg-gray-300 hover:bg-gray-400 text-gray-700 px-6 py-2 rounded-lg" 
                onclick="modalEdit.close()">
            <i class="fas fa-times mr-2"></i>Batal
        </button>
    </div>
</form>
