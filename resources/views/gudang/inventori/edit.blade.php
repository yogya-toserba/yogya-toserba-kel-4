<style>
.form-input-orange {
    border: 2px solid #fff3e0;
    border-radius: 8px;
    padding: 0.75rem;
    transition: all 0.3s ease;
    background: white;
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
</style>

<h3 class="font-bold text-2xl mb-6 text-orange-600">
    <i class="fas fa-edit mr-2"></i>Edit Produk
</h3>

<!-- Display Validation Errors -->
@if ($errors->any())
    <div class="alert alert-error mb-4">
        <ul class="list-disc list-inside">
            @foreach ($errors->all() as $error)
                <li class="text-red-600 text-sm">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('gudang.inventori.update', $product->id_produk) }}" method="POST" enctype="multipart/form-data" id="editProdukForm" onsubmit="event.preventDefault(); submitEditForm(this)">
    @csrf
    @method('PUT')
    <div class="space-y-4">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Nama Barang</label>
            <input type="text" name="nama_barang" value="{{ $product->nama_barang }}" placeholder="Masukkan nama barang" 
                   class="form-input-orange w-full" required>
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Jumlah Barang</label>
                <input type="number" name="jumlah_barang" value="{{ $product->jumlah_barang }}" placeholder="100" 
                       class="form-input-orange w-full" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Stok</label>
                <input type="number" name="stok" value="{{ $product->stok }}" placeholder="50" 
                       class="form-input-orange w-full" required>
            </div>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Harga Jual</label>
            <input type="number" name="harga_jual" value="{{ $product->harga_jual }}" placeholder="200000" 
                   class="form-input-orange w-full" required>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Foto Produk</label>
            @if($product->foto)
                <div class="mb-3">
                    <img src="{{ asset('storage/'.$product->foto) }}" alt="Current photo" class="w-20 h-20 object-cover rounded border">
                    <p class="text-xs text-gray-500 mt-1">Foto saat ini</p>
                </div>
            @endif
            <input type="file" name="foto" accept="image/*" 
                   class="form-input-orange w-full">
            <p class="text-xs text-gray-500 mt-1">Kosongkan jika tidak ingin mengubah foto</p>
        </div>
    </div>
    <div class="modal-action mt-8">
        <button type="submit" class="btn-orange">
            <i class="fas fa-save mr-2"></i>Simpan Perubahan
        </button>
        <button type="button" class="btn bg-gray-300 hover:bg-gray-400 text-gray-700 px-6 py-2 rounded-lg" 
                onclick="modalEdit.close()">
            <i class="fas fa-times mr-2"></i>Batal
        </button>
    </div>
</form>
