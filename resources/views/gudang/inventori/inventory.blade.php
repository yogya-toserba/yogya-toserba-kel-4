@extends('layouts.appInventori')

@section('content')
<div class="dashboard-container">

    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-semibold">Daftar Produk</h2>
        <button class="btn btn-primary btn-sm" onclick="modalTambah.showModal()">
            + Tambah Produk
        </button>
    </div>

    <div class="overflow-x-auto shadow rounded-lg">
        <table class="table w-full bg-gray-50">
            <thead class="bg-gray-200">
                <tr>
                    <th>ID <i class="fas fa-sort text-xs"></i></th>
                    <th>NAMA BARANG <i class="fas fa-sort text-xs"></i></th>
                    <th>GAMBAR</th>
                    <th>SKU <i class="fas fa-sort text-xs"></i></th>
                    <th>UNIT <i class="fas fa-sort text-xs"></i></th>
                    <th>HARGA BELI</th>
                    <th>HARGA JUAL</th>
                    <th>STATUS</th>
                    <th>AKSI</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->nama_barang }}</td>
                        <td>
                            @if($product->image)
                                <img src="{{ asset('storage/'.$product->image) }}" 
                                     alt="gambar {{ $product->nama_barang }}" 
                                     class="w-14 h-14 object-cover rounded-md">
                            @else
                                <span class="text-gray-400">-</span>
                            @endif
                        </td>
                        <td>{{ $product->sku }}</td>
                        <td>{{ $product->unit }}</td>
                        <td>Rp {{ number_format($product->harga_beli, 0, ',', '.') }}</td>
                        <td>Rp {{ number_format($product->harga_jual, 0, ',', '.') }}</td>
                        <td>
                            <span class="px-2 py-1 text-xs rounded-full 
                                {{ $product->status == 'aktif' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                {{ ucfirst($product->status) }}
                            </span>
                        </td>
                        <td class="text-center">
                            <div class="dropdown dropdown-end">
                                <label tabindex="0" class="btn btn-sm btn-ghost">⋮</label>
                                <ul tabindex="0" class="dropdown-content menu p-2 shadow bg-white rounded-box w-32">
                                    <li>
                                        <a href="javascript:void(0);" onclick="openEditModal({{ $product->id }})">Edit</a>
                                    </li>
                                    <li>
                                        <form action="{{ route('gudang.produk.destroy',$product->id) }}" method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500">Hapus</button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="text-center text-gray-400">Belum ada produk</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $products->links() }}
    </div>
</div>

<!-- Modal Tambah Produk -->
<dialog id="modalTambah" class="modal modal-middle">
  <div class="modal-box">
    <h3 class="font-bold text-lg mb-4">Tambah Produk</h3>
    <form action="{{ route('gudang.produk.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="space-y-3">
            <input type="text" name="nama_barang" placeholder="Nama Barang" class="input input-bordered w-full" required>
            <input type="text" name="sku" placeholder="SKU" class="input input-bordered w-full" required>
            <input type="number" name="unit" placeholder="Unit" class="input input-bordered w-full" required>
            <input type="number" name="harga_beli" placeholder="Harga Beli" class="input input-bordered w-full" required>
            <input type="number" name="harga_jual" placeholder="Harga Jual" class="input input-bordered w-full" required>
            <select name="status" class="select select-bordered w-full" required>
                <option value="aktif">Aktif</option>
                <option value="nonaktif">Nonaktif</option>
            </select>
            <input type="file" name="image" class="file-input file-input-bordered w-full">
        </div>
        <div class="modal-action">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <button type="button" class="btn" onclick="modalTambah.close()">Batal</button>
        </div>
    </form>
  </div>
</dialog>

<!-- Modal Edit Produk (dynamic via JS) -->
<dialog id="modalEdit" class="modal modal-middle">
  <div class="modal-box" id="editModalContent">
    <!-- isi form edit akan diisi lewat AJAX -->
  </div>
</dialog>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('.dropdown').forEach(drop => {
            drop.addEventListener('click', function () {
                const rect = drop.getBoundingClientRect();
                const windowHeight = window.innerHeight;

                // kalau jarak ke bawah < 200px, buka ke atas
                if (windowHeight - rect.bottom < 200) {
                    drop.classList.add('dropdown-top');
                } else {
                    drop.classList.remove('dropdown-top');
                }
            });
        });
    });

    function openEditModal(id) {
        let url = "{{ route('gudang.produk.edit', ':id') }}";
        url = url.replace(':id', id);

        fetch(url)
            .then(res => res.text())
            .then(html => {
                document.getElementById('editModalContent').innerHTML = html;
                modalEdit.showModal();
            });
    }
</script>
@endpush
    