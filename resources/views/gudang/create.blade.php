<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Tambah Produk</title>
</head>
<body>

<h1>Tambah Produk</h1>

<form action="{{ route('gudang.inventory.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <label>Nama Barang</label><br>
    <input type="text" name="nama_barang" required><br><br>

    <label>SKU</label><br>
    <input type="text" name="sku" required><br><br>

    <label>Unit</label><br>
    <input type="number" name="unit" required><br><br>

    <label>Harga Beli</label><br>
    <input type="number" name="harga_beli" required><br><br>

    <label>Harga Jual</label><br>
    <input type="number" name="harga_jual" required><br><br>

    <label>Status</label><br>
    <select name="status" required>
        <option value="aktif">Aktif</option>
        <option value="expire">Expire</option>
    </select><br><br>

    <label>Foto Produk</label><br>
    <input type="file" name="image" accept="image/*"><br><br>

    <label>Deskripsi</label><br>
    <textarea name="deskripsi"></textarea><br><br>

    <button type="submit">Simpan</button>
</form>

<br>
<a href="{{ route('gudang.inventory.index') }}">Kembali</a>

</body>
</html>
