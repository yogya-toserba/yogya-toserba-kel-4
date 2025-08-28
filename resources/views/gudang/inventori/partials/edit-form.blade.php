<h3 class="font-bold text-lg mb-4">Edit Produk</h3>
<form action="{{ route('gudang.produk.update', $produk->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="space-y-3">
        <input type="text" name="nama_barang" value="{{ $produk->nama_barang }}" class="input input-bordered w-full" required>
        <input type="text" name="sku" value="{{ $produk->sku }}" class="input input-bordered w-full" required>
        <input type="number" name="unit" value="{{ $produk->unit }}" class="input input-bordered w-full" required>
        <input type="number" name="harga_beli" value="{{ $produk->harga_beli }}" class="input input-bordered w-full" required>
        <input type="number" name="harga_jual" value="{{ $produk->harga_jual }}" class="input input-bordered w-full" required>

        <select name="status" class="select select-bordered w-full" required>
            <option value="aktif" {{ $produk->status == 'aktif' ? 'selected' : '' }}>Aktif</option>
            <option value="nonaktif" {{ $produk->status == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
        </select>

        <div>
            <label>Gambar Produk</label>
            <input type="file" name="image" class="file-input file-input-bordered w-full">
            @if($produk->image)
                <img src="{{ asset('storage/'.$produk->image) }}" 
                     alt="gambar {{ $produk->nama_barang }}" 
                     class="w-20 h-20 mt-2 object-cover rounded-md">
            @endif
        </div>
    </div>

    <div class="modal-action">
        <button type="submit" class="btn btn-primary">Update</button>
        <button type="button" class="btn" onclick="modalEdit.close()">Batal</button>
    </div>
</form>
