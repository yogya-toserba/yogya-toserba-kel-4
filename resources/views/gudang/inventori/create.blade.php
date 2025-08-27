@extends('layouts.side_bar_inventory')

@section('content')
<div class="container">
    <h2>Tambah Produk</h2>
    <form action="{{ route('gudang.produk.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label>Nama Produk</label>
            <input type="text" name="nama" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>SKU</label>
            <input type="text" name="sku" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Unit</label>
            <input type="number" name="unit" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Harga Beli</label>
            <input type="number" name="harga_beli" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Harga Jual</label>
            <input type="number" name="harga_jual" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="form-control"></textarea>
        </div>
        <div class="mb-3">
            <label>Gambar Produk</label>
            <input type="file" name="gambar" class="form-control">
        </div>
        <button class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
