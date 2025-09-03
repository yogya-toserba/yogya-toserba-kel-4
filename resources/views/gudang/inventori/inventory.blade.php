@extends('layouts.appInventori')

@section('content')
<style>
/* Styling khusus untuk halaman inventory dengan tema oranye */
.dashboard-container {
    /* background: linear-gradient(135deg, #fff8f0 0%, #fff3e0 100%); */
    min-height: 100vh;
    padding: 2rem;
}

.header-card {
    background: linear-gradient(45deg, #ff9800, #ff6f00);
    border-radius: 16px;
    padding: 2rem;
    margin-bottom: 2rem;
    box-shadow: 0 8px 32px rgba(255, 152, 0, 0.3);
    color: white;
}

.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 1.5rem;
    margin-bottom: 2rem;
}

.stat-card {
    background: white;
    border-radius: 12px;
    padding: 1.5rem;
    box-shadow: 0 4px 16px rgba(255, 152, 0, 0.1);
    border-left: 4px solid #ff9800;
    transition: transform 0.3s ease;
}

.stat-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 24px rgba(255, 152, 0, 0.2);
}

.table-card {
    background: white;
    border-radius: 16px;
    padding: 1.5rem;
    box-shadow: 0 4px 24px rgba(255, 152, 0, 0.1);
    overflow: hidden;
}

.table-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1.5rem;
    padding-bottom: 1rem;
    border-bottom: 2px solid #fff3e0;
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

.table-custom {
    width: 100%;
    border-collapse: collapse;
    background: white;
    box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    border-radius: 8px;
    overflow: hidden;
}

.table-custom th {
    background: #f8fafc;
    color: #374151;
    font-weight: 600;
    padding: 16px 12px;
    text-align: center;
    font-size: 14px;
    letter-spacing: 0.5px;
    border: none;
    border-bottom: 2px solid #e5e7eb;
}

.table-custom th:first-child {
    border-top-left-radius: 8px;
}

.table-custom th:last-child {
    border-top-right-radius: 8px;
}

.table-custom td {
    padding: 14px 12px;
    border-bottom: 1px solid #e5e7eb;
    vertical-align: middle;
    font-size: 14px;
    color: #374151;
}

.table-custom td:nth-child(1), 
.table-custom td:nth-child(4),
.table-custom td:nth-child(5),
.table-custom td:nth-child(6),
.table-custom td:nth-child(7),
.table-custom td:nth-child(8),
.table-custom td:nth-child(9) {
    text-align: center;
}

.table-custom td:nth-child(2) {
    text-align: left;
}

.table-custom td:nth-child(3) {
    text-align: center;
}

.table-custom tbody tr {
    background: white;
    transition: all 0.2s ease;
}

.table-custom tbody tr:hover {
    background: #f8fafc;
    box-shadow: 0 2px 4px rgba(0,0,0,0.05);
}

.table-custom tbody tr:nth-child(even) {
    background: #f9fafb;
}

.table-custom tbody tr:nth-child(even):hover {
    background: #f1f5f9;
}

.dropdown-orange {
    position: relative;
    display: inline-block;
}

.dropdown-orange .dropbtn {
    background: #6b7280;
    color: white;
    border: none;
    border-radius: 6px;
    width: 36px;
    height: 32px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.3s ease;
    font-weight: bold;
}

.dropdown-orange .dropbtn:hover {
    background: #4b5563;
    transform: translateY(-1px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.2);
}

.dropdown-orange .dropdown-content {
    display: none;
    position: fixed;
    right: auto;
    min-width: 150px;
    background: white;
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
    border-radius: 8px;
    z-index: 9999;
    border: 1px solid #e5e7eb;
    overflow: hidden;
}

.dropdown-orange.show .dropdown-content {
    display: block;
}

/* Dropdown yang muncul ke bawah */
.dropdown-orange.dropdown-down .dropdown-content {
    top: auto;
    bottom: auto;
}

.dropdown-orange .dropdown-content a,
.dropdown-orange .dropdown-content button {
    color: #374151;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
    transition: all 0.2s ease;
    border: none;
    background: none;
    width: 100%;
    text-align: left;
    font-size: 14px;
}

.dropdown-orange .dropdown-content a:hover,
.dropdown-orange .dropdown-content button:hover {
    background: #f3f4f6;
    color: #1f2937;
}

.dropdown-orange .dropdown-content button.delete-btn:hover {
    background: #fef2f2;
    color: #dc2626;
}

.modal-orange .modal-box {
    border-radius: 16px;
    border-top: 4px solid #ff9800;
}

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

@media (max-width: 768px) {
    .dashboard-container {
        padding: 1rem;
    }
    
    .table-header {
        flex-direction: column;
        gap: 1rem;
    }
}
</style>

<div class="dashboard-container">
    <!-- Header Card -->
    <div class="header-card">
        <h1 class="text-3xl font-bold mb-2">
            <i class="fas fa-warehouse mr-3"></i>Dashboard Inventori
        </h1>
        <p class="text-orange-100">Kelola produk dan stok dengan mudah</p>
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

    <!-- Stats Grid -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="flex items-center">
                <div class="bg-orange-100 p-3 rounded-full mr-4">
                    <i class="fas fa-box text-orange-600 text-xl"></i>
                </div>
                <div>
                    <h3 class="text-2xl font-bold text-gray-800">{{ $products->count() ?? 0 }}</h3>
                    <p class="text-gray-600">Total Produk</p>
                </div>
            </div>
        </div>
        
        <div class="stat-card">
            <div class="flex items-center">
                <div class="bg-green-100 p-3 rounded-full mr-4">
                    <i class="fas fa-check-circle text-green-600 text-xl"></i>
                </div>
                <div>
                    <h3 class="text-2xl font-bold text-gray-800">{{ $products->where('status', 'aktif')->count() ?? 0 }}</h3>
                    <p class="text-gray-600">Produk Aktif</p>
                </div>
            </div>
        </div>
        
        <div class="stat-card">
            <div class="flex items-center">
                <div class="bg-blue-100 p-3 rounded-full mr-4">
                    <i class="fas fa-chart-line text-blue-600 text-xl"></i>
                </div>
                <div>
                    <h3 class="text-2xl font-bold text-gray-800">Rp {{ number_format($products->sum('harga_beli') ?? 0, 0, ',', '.') }}</h3>
                    <p class="text-gray-600">Total Nilai</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Table Card -->
    <div class="table-card">
        <div class="table-header">
            <div>
                <h2 class="text-3xl font-bold bg-gradient-to-r from-orange-600 to-orange-800 bg-clip-text text-transparent mb-2">
                    <i class="fas fa-list-alt mr-3 text-orange-600"></i>Daftar Produk
                </h2>
                <p class="text-gray-600 text-lg">
                    <i class="fas fa-info-circle mr-2 text-orange-500"></i>
                    Kelola dan pantau semua produk inventori Anda
                </p>
            </div>
            <div class="flex items-center space-x-3">
                <button class="bg-white border-2 border-orange-300 text-orange-600 px-4 py-2 rounded-lg hover:bg-orange-50 transition-all duration-300">
                    <i class="fas fa-filter mr-2"></i>Filter
                </button>
                <button class="btn-orange" onclick="modalTambah.showModal()">
                    <i class="fas fa-plus-circle mr-2"></i>Tambah Produk
                </button>
            </div>
        </div>

        <div class="overflow-x-auto rounded-lg shadow-lg">
            <table class="table-custom">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>NAMA BARANG</th>
                        <th>GAMBAR</th>
                        <th>SKU</th>
                        <th>JUMLAH</th>
                        <th>STOK</th>
                        <th>HARGA JUAL</th>
                        <th>STATUS</th>
                        <th>AKSI</th>
                    </tr>
                </thead>
                <tbody>
                @forelse($products as $product)
                    <tr>
                        <td class="font-bold text-gray-900">#{{ $product->id_produk }}</td>
                        <td class="font-semibold text-gray-800">{{ $product->nama_barang }}</td>
                        <td>
                            @if($product->foto)
                                <div class="flex justify-center">
                                    <img src="{{ asset('storage/'.$product->foto) }}" 
                                         alt="gambar {{ $product->nama_barang }}" 
                                         class="w-12 h-12 object-cover rounded-lg shadow-sm border">
                                </div>
                            @else
                                <div class="flex justify-center">
                                    <div class="w-12 h-12 bg-gray-100 rounded-lg flex items-center justify-center">
                                        <i class="fas fa-image text-gray-400"></i>
                                    </div>
                                </div>
                            @endif
                        </td>
                        <td class="font-mono text-sm bg-gray-50 px-2 py-1 rounded text-gray-600">{{ $product->sku }}</td>
                        <td class="font-semibold">{{ $product->jumlah_barang }}</td>
                        <td class="font-semibold">{{ $product->stok }}</td>
                        <td class="font-bold text-blue-600">Rp {{ number_format($product->harga_jual, 0, ',', '.') }}</td>
                        <td>
                            @if($product->stok > 0)
                                <span class="inline-flex px-3 py-1 text-xs font-semibold text-green-800 bg-green-100 rounded-full">
                                    Aktif
                                </span>
                            @else
                                <span class="inline-flex px-3 py-1 text-xs font-semibold text-red-800 bg-red-100 rounded-full">
                                    Nonaktif
                                </span>
                            @endif
                        </td>
                        <td class="text-center">
                            <div class="dropdown-orange" onclick="toggleDropdown(this)">
                                <button class="dropbtn" type="button">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                                <div class="dropdown-content">
                                    <a href="javascript:void(0);" onclick="openEditModal({{ $product->id_produk }})">
                                        <i class="fas fa-edit mr-2 text-blue-500"></i>Edit
                                    </a>
                                    <form action="{{ route('gudang.inventori.destroy',$product->id_produk) }}" method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus produk ini?')" style="margin: 0;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="delete-btn">
                                            <i class="fas fa-trash mr-2 text-red-500"></i>Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="text-center py-8">
                            <div class="flex flex-col items-center">
                                <i class="fas fa-box-open text-6xl text-orange-300 mb-4"></i>
                                <p class="text-xl text-gray-500 mb-2">Belum ada produk</p>
                                <p class="text-gray-400">Klik tombol "Tambah Produk" untuk mulai menambahkan produk</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if(isset($products) && method_exists($products, 'links'))
        <div class="mt-6 flex justify-center">
            {{ $products->links() }}
        </div>
        @endif
    </div>
</div>

<!-- Modal Tambah Produk -->
<dialog id="modalTambah" class="modal modal-middle modal-orange">
  <div class="modal-box">
    <h3 class="font-bold text-2xl mb-6 text-orange-600">
        <i class="fas fa-plus-circle mr-2"></i>Tambah Produk Baru
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
    
    <form action="{{ route('gudang.inventori.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Nama Barang</label>
                <input type="text" name="nama_barang" placeholder="Masukkan nama barang" 
                       class="form-input-orange w-full" required>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Jumlah Barang</label>
                    <input type="number" name="jumlah_barang" placeholder="100" 
                           class="form-input-orange w-full" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Stok</label>
                    <input type="number" name="stok" placeholder="50" 
                           class="form-input-orange w-full" required>
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Harga Jual</label>
                <input type="number" name="harga_jual" placeholder="200000" 
                       class="form-input-orange w-full" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Foto Produk</label>
                <input type="file" name="foto" accept="image/*" 
                       class="form-input-orange w-full">
            </div>
        </div>
        <div class="modal-action mt-8">
            <button type="submit" class="btn-orange">
                <i class="fas fa-save mr-2"></i>Simpan Produk
            </button>
            <button type="button" class="btn bg-gray-300 hover:bg-gray-400 text-gray-700 px-6 py-2 rounded-lg" 
                    onclick="modalTambah.close()">
                <i class="fas fa-times mr-2"></i>Batal
            </button>
        </div>
    </form>
  </div>
</dialog>

<!-- Modal Edit Produk -->
<dialog id="modalEdit" class="modal modal-middle modal-orange">
  <div class="modal-box" id="editModalContent">
    <div class="flex items-center justify-center py-8">
        <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-orange-600"></div>
        <span class="ml-3 text-gray-600">Memuat data...</span>
    </div>
  </div>
</dialog>
@endsection

@push('scripts')
<script>
    // Tutup dropdown ketika klik di luar
    document.addEventListener('click', function(event) {
        const dropdowns = document.querySelectorAll('.dropdown-orange');
        dropdowns.forEach(dropdown => {
            if (!dropdown.contains(event.target)) {
                dropdown.classList.remove('show');
            }
        });
    });

    function toggleDropdown(element) {
        event.stopPropagation();
        
        // Tutup dropdown lain yang terbuka
        document.querySelectorAll('.dropdown-orange.show').forEach(dropdown => {
            if (dropdown !== element) {
                dropdown.classList.remove('show');
            }
        });

        // Toggle dropdown saat ini
        element.classList.toggle('show');

        // Positioning dropdown
        if (element.classList.contains('show')) {
            const button = element.querySelector('.dropbtn');
            const dropdown = element.querySelector('.dropdown-content');
            const buttonRect = button.getBoundingClientRect();
            const windowHeight = window.innerHeight;
            const dropdownHeight = 100; // Perkiraan tinggi dropdown
            
            // Reset positioning classes
            element.classList.remove('dropdown-up', 'dropdown-down');
            
            // Jika ada cukup ruang di bawah, tampilkan ke bawah
            if (windowHeight - buttonRect.bottom > dropdownHeight + 20) {
                dropdown.style.top = (buttonRect.bottom + 5) + 'px';
                dropdown.style.left = (buttonRect.left - 75) + 'px'; // Center dropdown relative to button
                element.classList.add('dropdown-down');
            } else {
                // Tampilkan ke atas
                dropdown.style.top = (buttonRect.top - dropdownHeight - 5) + 'px';
                dropdown.style.left = (buttonRect.left - 75) + 'px';
                element.classList.add('dropdown-up');
            }
        }
    }

    function openEditModal(id) {
        let url = "{{ route('gudang.inventori.edit', ':id') }}";
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
    