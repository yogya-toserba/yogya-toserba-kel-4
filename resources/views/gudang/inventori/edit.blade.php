@extends('layouts.side_bar_inventory')

@section('content')
<div class="container mt-4">
    <h2>Edit Produk</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('gudang.produk.update', $produk->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Nama Produk</label>
            <input type="text" name="nama" class="form-control" value="{{ old('nama', $produk->nama) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">SKU</label>
            <input type="text" name="sku" class="form-control" value="{{ old('sku', $produk->sku) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Unit</label>
            <input type="number" name="unit" class="form-control" value="{{ old('unit', $produk->unit) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Harga Beli</label>
            <input type="number" name="harga_beli" class="form-control" value="{{ old('harga_beli', $produk->harga_beli) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Harga Jual</label>
            <input type="number" name="harga_jual" class="form-control" value="{{ old('harga_jual', $produk->harga_jual) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Deskripsi</label>
            <textarea name="deskripsi" class="form-control">{{ old('deskripsi', $produk->deskripsi) }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Status</label>
            <select name="status" class="form-select">
                <option value="aktif" {{ $produk->status == 'aktif' ? 'selected' : '' }}>Aktif</option>
                <option value="nonaktif" {{ $produk->status == 'nonaktif' ? 'selected' : '' }}>Non Aktif</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Gambar Produk</label><br>
            @if ($produk->gambar)
                <img src="{{ asset('storage/'.$produk->gambar) }}" alt="Gambar Produk" class="img-thumbnail mb-2" width="150">
            @endif
            <input type="file" name="gambar" class="form-control">
        </div>

        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('gudang.produk.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
