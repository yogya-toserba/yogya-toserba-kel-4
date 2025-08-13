<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('css/gudang/iventory.css') }}" rel="stylesheet">
</head>
<body>
    <div class="header">MyYOGYA</div>
    <div class="container">
        <div class="sidebar">
            <div class="logo">
                <img src="{{ asset('image/logo_yogya.png') }}" alt="Yogya Logo" style="mix-blend-mode: multiply;">
            </div>
            <div class="menu">
                <div class="menu-title">DASHBOARD</div>
                <a href="#">TAMBAH BARANG</a>
                <a href="#">PENERIMAAN BARANG</a>
            </div>
        </div>
        <div class="content">
            <div class="inventory-box">
                <div class="inventory-header">
                    <div>
                        <div class="inventory-title">Tambah Produk</div>
                        <div style="font-size:0.95em;color:#888;">Data Produk</div>
                    </div>
                    <div class="inventory-actions">
                        <button class="btn" id="filterBtn">&#128269; Filters</button>
                        <a href="{{ route('gudang.inventory.create') }}">Tambah Produk</a>
                    </div>
                </div>
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>NAMA BARANG</th>
                                <th>IMAGE</th>
                                <th>DESKRIPSI</th>
                                <th>SKU</th>
                                <th>UNIT</th>
                                <th>HARGA BELI</th>
                                <th>HARGA JUAL</th>
                                <th>TANGGAL</th>
                                <th>STATUS</th>
                                <th>AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td>{{ $product->nama_barang }}</td>
                                <td>@if($product->image)<img src="{{ asset('storage/' . $product->image) }}" width="50">@endif</td>
                                <td>{{ $product->deskripsi }}</td>
                                <td>{{ $product->sku }}</td>
                                <td>{{ $product->unit }}</td>
                                <td>{{ number_format($product->harga_beli) }}</td>
                                <td>{{ number_format($product->harga_jual) }}</td>
                                <td>{{ $product->tanggal }}</td>
                                <td class="{{ $product->status == 'aktif' ? 'status-aktif' : '' }}">{{ $product->status }}</td>
                                <td>
                                    <div class="dropdown">
                                        <button class="dropbtn">⋮</button>
                                        <div class="dropdown-content">
                                            <a href="javascript:void(0)" class="edit" onclick="editProduct({{ $product->id }})">Edit</a>
                                            <a href="javascript:void(0)" class="delete" onclick="deleteProduct({{ $product->id }})">Hapus</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


