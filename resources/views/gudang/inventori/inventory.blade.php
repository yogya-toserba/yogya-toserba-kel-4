@extends('layouts.appInventori')

@section('head')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')
<style>
/* Styling khusus untuk halaman inventory dengan tema oranye */
.dashboard-container {
    /* background: linear-gradient(135deg, #fff8f0 0%, #fff3e0 100%); */
    min-height: 100vh;
    padding: 2rem;
}

.form-container {
    min-height: 100vh;
    background: linear-gradient(135deg, #fff8f0 0%, #fff3e0 100%);
}

.form-container .dashboard-container {
    background: transparent;
}

.header-card {
    /* background: linear-gradient(45deg, #ff9800, #ff6f00); */
    background: linear-gradient(135deg, #f26b37, #e55827);
    border-radius: 16px;
    padding: 2rem;
    margin-bottom: 2rem;
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
    background: white;
    box-shadow: 0 20px 50px rgba(0, 0, 0, 0.3);
}

.modal-orange::backdrop {
    background: rgba(0, 0, 0, 0.5);
    backdrop-filter: blur(4px);
}

.modal-orange {
    background: rgba(0, 0, 0, 0.5);
    backdrop-filter: blur(4px);
}

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

/* Additional modal styling */
.modal-box h3 {
    color: #f26b37;
}

.modal-box label {
    color: #374151;
    font-weight: 600;
}

.modal-action .btn-orange {
    background: linear-gradient(135deg, #f26b37, #e55827);
}

/* File input styling untuk modal */
.file-input-orange {
    border: 2px solid #fff3e0;
    border-radius: 8px;
    transition: all 0.3s ease;
}

.file-input-orange:focus {
    border-color: #ff9800;
    box-shadow: 0 0 0 3px rgba(255, 152, 0, 0.1);
    outline: none;
}

/* Animation untuk success message */
.animate-fade-in {
    animation: fadeInSlideDown 0.6s ease-out;
}

@keyframes fadeInSlideDown {
    from {
        opacity: 0;
        transform: translateY(-20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Enhanced success message styling */
.alert-success {
    border-left-width: 5px !important;
    box-shadow: 0 4px 12px rgba(34, 197, 94, 0.15);
}

.alert-success:hover {
    box-shadow: 0 6px 16px rgba(34, 197, 94, 0.2);
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

    <!-- Pesan Success untuk Barang Terkirim -->
    @if (session('barang_terkirim'))
        <div class="alert alert-success bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4 animate-fade-in">
            <div class="flex items-center">
                <i class="fas fa-truck text-green-600 mr-3 text-lg"></i>
                <div>
                    <strong class="font-semibold">Barang Berhasil Dikirim!</strong>
                    <p class="text-sm mt-1">{{ session('barang_terkirim') }}</p>
                </div>
            </div>
        </div>
    @endif

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
                                <button class="btn-orange" id="btnTambahProduk">
                    <i class="fas fa-plus mr-2"></i>Tambah Produk
                </button>
            </div>
        </div>

<!-- Modal Tambah Produk Baru -->
<dialog id="my_modal_5" class="modal modal-middle modal-orange">
  <div class="modal-box max-w-4xl">
    <form method="POST" action="{{ route('gudang.inventori.store') }}" enctype="multipart/form-data" id="tambahProdukFormModal">
      @csrf
      <h3 class="font-bold text-lg mb-4 text-orange-600">
        <i class="fas fa-plus-circle mr-2"></i>Tambah Produk Baru
      </h3>
      
      <!-- Grid Layout untuk Form -->
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Kolom Kiri -->
        <div class="space-y-4">
          <!-- Nama Barang -->
          <div>
            <label class="label">
              <span class="label-text font-semibold">Nama Barang *</span>
            </label>
            <input type="text" name="nama_barang" placeholder="Masukkan nama barang" 
                   class="form-input-orange input input-bordered w-full" required>
          </div>

          <!-- Kategori (dipindah ke atas untuk SKU otomatis) -->
          <div>
            <label class="label">
              <span class="label-text font-semibold">Kategori *</span>
            </label>
            <select name="kategori" id="kategoriSelectModal" class="form-input-orange select select-bordered w-full" onchange="generateSKUModal()" required>
              <option disabled selected>Pilih kategori</option>
              <option value="makanan">Makanan</option>
              <option value="minuman">Minuman</option>
              <option value="elektronik">Elektronik</option>
              <option value="fashion">Fashion</option>
              <option value="kesehatan">Kesehatan</option>
              <option value="rumah_tangga">Rumah Tangga</option>
              <option value="olahraga">Olahraga</option>
              <option value="lainnya">Lainnya</option>
            </select>
          </div>

          <!-- SKU (otomatis berdasarkan kategori) -->
          <div>
            <label class="label">
              <span class="label-text font-semibold">SKU *</span>
            </label>
            <input type="text" name="sku" id="skuInputModal" placeholder="SKU akan dibuat otomatis" 
                   class="form-input-orange input input-bordered w-full" readonly required>
            <div class="label">
              <span class="label-text-alt text-gray-500">SKU akan dibuat otomatis berdasarkan kategori dan urutan produk</span>
            </div>
          </div>

          <!-- Deskripsi -->
          <div>
            <label class="label">
              <span class="label-text font-semibold">Deskripsi</span>
            </label>
            <textarea name="deskripsi" rows="3" placeholder="Deskripsi produk (opsional)" 
                      class="form-input-orange textarea textarea-bordered w-full"></textarea>
          </div>
        </div>
        
        <!-- Kolom Kanan -->
        <div class="space-y-4">
          <!-- Harga Beli -->
          <div>
            <label class="label">
              <span class="label-text font-semibold">Harga Beli *</span>
            </label>
            <input type="number" name="harga_beli" placeholder="0" step="0.01" 
                   class="form-input-orange input input-bordered w-full" required>
          </div>

          <!-- Harga Jual -->
          <div>
            <label class="label">
              <span class="label-text font-semibold">Harga Jual *</span>
            </label>
            <input type="number" name="harga_jual" placeholder="0" step="0.01" 
                   class="form-input-orange input input-bordered w-full" required>
          </div>

          <!-- Stok -->
          <div>
            <label class="label">
              <span class="label-text font-semibold">Stok Awal *</span>
            </label>
            <input type="number" name="stok" placeholder="0" 
                   class="form-input-orange input input-bordered w-full" required>
          </div>

          <!-- Upload Foto -->
          <div>
            <label class="label">
              <span class="label-text font-semibold">Foto Produk</span>
            </label>
            <input type="file" name="foto" accept="image/*" 
                   class="file-input file-input-bordered file-input-orange w-full">
            <div class="label">
              <span class="label-text-alt text-gray-500">Format: JPG, PNG, maksimal 2MB</span>
            </div>
          </div>
        </div>
      </div>

      <!-- Action Buttons -->
      <div class="modal-action">
        <button type="button" class="btn btn-ghost" onclick="my_modal_5.close()">
          <i class="fas fa-times mr-2"></i>Batal
        </button>
        <button type="submit" class="btn-orange">
          <i class="fas fa-save mr-2"></i>Simpan Produk
        </button>
      </div>
    </form>
  </div>
</dialog>

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
                                        style="margin: 0;" class="delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="delete-btn" onclick="confirmDelete(this.form, '{{ $product->nama_barang }}')">
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

<!-- Inline Script untuk Global Functions -->
<script>
    // Add CSRF token if not exists
    if (!document.querySelector('meta[name="csrf-token"]')) {
        const meta = document.createElement('meta');
        meta.name = 'csrf-token';
        meta.content = '{{ csrf_token() }}';
        document.head.appendChild(meta);
    }

    // ============= GLOBAL FUNCTIONS YANG PERLU DIAKSES DARI HTML =============
    // Function untuk membuka modal dengan persiapan yang benar
    window.openTambahProdukModal = function() {
        console.log('Opening modal...');
        
        // Reset form
        const form = document.getElementById('tambahProdukFormModal');
        if (form) {
            form.reset();
            console.log('Form reset');
        }
        
        // Reset SKU field
        const skuInput = document.getElementById('skuInputModal');
        if (skuInput) {
            skuInput.value = '';
            skuInput.style.backgroundColor = '#f9fafb';
            skuInput.style.color = '#6b7280';
            skuInput.style.fontWeight = 'normal';
            console.log('SKU field reset');
        }
        
        // Open modal
        const modal = document.getElementById('my_modal_5');
        if (modal) {
            modal.showModal();
            console.log('Modal opened');
        }
    };

    // Fungsi untuk modal baru (my_modal_5) - auto generate SKU berdasarkan database
    window.generateSKUModal = function() {
        console.log('generateSKUModal called');
        const kategoriSelect = document.getElementById('kategoriSelectModal');
        const skuInput = document.getElementById('skuInputModal');
        
        if (!kategoriSelect || !skuInput) {
            console.error('Element kategori atau SKU modal tidak ditemukan');
            return;
        }
        
        const selectedKategori = kategoriSelect.value;
        console.log('Selected kategori modal:', selectedKategori);
        
        // Define kategoriToSKU
        const kategoriToSKU = {
            'makanan': 'MKN',
            'minuman': 'MNM', 
            'elektronik': 'ELK',
            'fashion': 'FSH',
            'kesehatan': 'KSH',
            'rumah_tangga': 'RMH',
            'olahraga': 'OLH',
            'lainnya': 'LNY'
        };
        
        if (selectedKategori && kategoriToSKU[selectedKategori]) {
            // Check if CSRF token exists
            const csrfToken = document.querySelector('meta[name="csrf-token"]');
            if (!csrfToken) {
                console.error('CSRF token not found');
                // Fallback ke nomor urut sederhana
                const prefix = kategoriToSKU[selectedKategori];
                const sku = prefix + '-0001';
                skuInput.value = sku;
                skuInput.style.backgroundColor = '#ecfdf5';
                skuInput.style.color = '#065f46';
                skuInput.style.fontWeight = 'bold';
                return;
            }
            
            // Fetch jumlah produk dari server untuk mendapatkan ID berikutnya
            fetch('/gudang/inventori/get-next-id', {
                method: 'GET',
                headers: {
                    'X-CSRF-TOKEN': csrfToken.getAttribute('content'),
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                }
            })
            .then(function(response) {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(function(data) {
                const prefix = kategoriToSKU[selectedKategori];
                const nextId = data.next_id || 1;
                const sku = prefix + '-' + nextId.toString().padStart(4, '0');
                
                skuInput.value = sku;
                console.log('Generated SKU modal:', sku);
                
                // Visual feedback
                skuInput.style.backgroundColor = '#ecfdf5';
                skuInput.style.color = '#065f46';
                skuInput.style.fontWeight = 'bold';
            })
            .catch(function(error) {
                console.error('Error fetching next ID:', error);
                // Fallback ke nomor urut sederhana
                const prefix = kategoriToSKU[selectedKategori];
                const sku = prefix + '-0001';
                skuInput.value = sku;
                skuInput.style.backgroundColor = '#ecfdf5';
                skuInput.style.color = '#065f46';
                skuInput.style.fontWeight = 'bold';
            });
        } else {
            console.warn('Kategori tidak valid atau tidak ditemukan:', selectedKategori);
            skuInput.value = '';
            skuInput.style.backgroundColor = '#f9fafb';
            skuInput.style.color = '#6b7280';
            skuInput.style.fontWeight = 'normal';
        }
    };

    // Setup event listener untuk button tambah produk
    document.addEventListener('DOMContentLoaded', function() {
        const btnTambahProduk = document.getElementById('btnTambahProduk');
        if (btnTambahProduk) {
            btnTambahProduk.addEventListener('click', function() {
                console.log('Button tambah produk clicked');
                window.openTambahProdukModal();
            });
        }
    });
</script>





<!-- Modal Edit Produk -->
<dialog id="modalEdit" class="modal modal-middle modal-orange">
  <div class="modal-box" id="editModalContent">
    <div class="flex items-center justify-center py-8">
        <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-orange-600"></div>
        <span class="ml-3 text-gray-600">Memuat data...</span>
    </div>
  </div>
</dialog>

<!-- Include Alert Konfirmasi -->
@include('components.confirm-alert')

@endsection

@push('scripts')
<script>
    // ============= ALERT KONFIRMASI UNIVERSAL =============
    let confirmCallback = null;

    function showConfirmAlert(options = {}) {
        const {
            title = 'Konfirmasi Aksi',
            message = 'Apakah Anda yakin ingin melanjutkan aksi ini?',
            details = 'Pastikan data yang Anda masukkan sudah benar sebelum melanjutkan.',
            confirmText = 'Lanjutkan',
            cancelText = 'Batalkan',
            icon = 'fas fa-question-circle',
            iconColor = 'text-orange-500',
            confirmColor = 'bg-orange-500 hover:bg-orange-600',
            onConfirm = null
        } = options;

        // Set content
        document.getElementById('confirmTitle').textContent = title;
        document.getElementById('confirmMessage').textContent = message;
        document.getElementById('confirmDetails').textContent = details;
        document.getElementById('confirmButtonText').textContent = confirmText;
        document.getElementById('cancelText').textContent = cancelText;
        
        // Set icon
        const iconElement = document.getElementById('confirmIcon');
        iconElement.className = `${icon} ${iconColor} text-lg`;
        
        // Set button colors
        const confirmButton = document.getElementById('confirmButton');
        confirmButton.className = `px-4 py-2 ${confirmColor} text-white rounded-lg transition-colors duration-200`;
        
        // Store callback
        confirmCallback = onConfirm;
        
        // Show modal
        const alertElement = document.getElementById('confirmAlert');
        const modalElement = document.getElementById('confirmModal');
        
        alertElement.classList.remove('hidden');
        
        // Animate in
        setTimeout(() => {
            modalElement.classList.remove('scale-95', 'opacity-0');
            modalElement.classList.add('scale-100', 'opacity-100');
        }, 10);
    }

    function hideConfirmAlert() {
        const alertElement = document.getElementById('confirmAlert');
        const modalElement = document.getElementById('confirmModal');
        
        // Animate out
        modalElement.classList.remove('scale-100', 'opacity-100');
        modalElement.classList.add('scale-95', 'opacity-0');
        
        setTimeout(() => {
            alertElement.classList.add('hidden');
            confirmCallback = null;
        }, 300);
    }

    // Event listeners untuk tombol konfirmasi
    document.getElementById('confirmButton').addEventListener('click', function() {
        if (confirmCallback) {
            confirmCallback();
        }
        hideConfirmAlert();
    });

    // Close modal when clicking backdrop
    document.getElementById('confirmAlert').addEventListener('click', function(e) {
        if (e.target === this) {
            hideConfirmAlert();
        }
    });

    // ESC key to close modal
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            hideConfirmAlert();
        }
    });

    // ============= FORM SUBMISSIONS WITH CONFIRMATION =============
    
    // ============= AUTO-GENERATE SKU =============
    const kategoriToSKU = {
        'makanan': 'MKN',
        'minuman': 'MNM',
        'elektronik': 'ELK',
        'fashion': 'FSH',
        'kesehatan': 'KSH',
        'rumah_tangga': 'RMH',
        'olahraga': 'OLH',
        'lainnya': 'LNY'
    };

    // ============= DOCUMENT READY =============
    document.addEventListener('DOMContentLoaded', function() {

    // Simpan counter SKU untuk setiap kategori di localStorage
    function getNextSKUNumber(kategori) {
        const storageKey = `sku_counter_${kategori}`;
        let counter = localStorage.getItem(storageKey);
        
        if (!counter) {
            counter = 1;
        } else {
            counter = parseInt(counter) + 1;
        }
        
        localStorage.setItem(storageKey, counter);
        return counter.toString().padStart(4, '0');
    }

    // Generate SKU berdasarkan kategori
    function generateSKU(kategori) {
        if (!kategori || !kategoriToSKU[kategori]) {
            return '';
        }
        
        const prefix = kategoriToSKU[kategori];
        const number = getNextSKUNumber(kategori);
        return `${prefix}-${number}`;
    }

    // Event listener untuk perubahan kategori di inventory
    const kategoriSelectInventory = document.getElementById('kategoriSelectInventory');
    const skuInputInventory = document.getElementById('skuInputInventory');
    
    if (kategoriSelectInventory && skuInputInventory) {
        kategoriSelectInventory.addEventListener('change', function() {
            const selectedKategori = this.value;
            
            if (selectedKategori && selectedKategori !== '') {
                const newSKU = generateSKU(selectedKategori);
                skuInputInventory.value = newSKU;
                skuInputInventory.style.backgroundColor = '#f0f9ff'; // Light blue background
                skuInputInventory.style.color = '#1e40af'; // Blue text
                
                // Tambahkan efek animasi
                skuInputInventory.classList.add('animate-pulse');
                setTimeout(() => {
                    skuInputInventory.classList.remove('animate-pulse');
                }, 1000);
            } else {
                skuInputInventory.value = '';
                skuInputInventory.style.backgroundColor = '#f9fafb'; // Default gray
                skuInputInventory.style.color = '#6b7280'; // Default gray text
            }
        });
    }


    
        });
    
    // ============= DOCUMENT READY =============
    document.addEventListener('DOMContentLoaded', function() {

    // Notification helper
    function showNotification(message, type = 'info') {
        // Create notification element
        const notification = document.createElement('div');
        notification.className = `fixed top-4 right-4 z-50 p-4 rounded-lg shadow-lg transition-all duration-300 ${
            type === 'success' ? 'bg-green-500 text-white' : 
            type === 'error' ? 'bg-red-500 text-white' : 
            'bg-blue-500 text-white'
        }`;
        notification.innerHTML = `
            <div class="flex items-center">
                <i class="fas ${type === 'success' ? 'fa-check-circle' : type === 'error' ? 'fa-exclamation-circle' : 'fa-info-circle'} mr-2"></i>
                ${message}
            </div>
        `;
        
        document.body.appendChild(notification);
        
        // Auto remove after 3 seconds
        setTimeout(() => {
            notification.style.opacity = '0';
            notification.style.transform = 'translateX(100%)';
            setTimeout(() => {
                if (notification.parentNode) {
                    notification.parentNode.removeChild(notification);
                }
            }, 300);
        }, 3000);
    }

    // ============= FORM SUBMIT HANDLER =============
    // Event listener untuk form baru
    document.addEventListener('DOMContentLoaded', function() {
        console.log('DOM Content Loaded - Setting up event listeners');
        
        // Event listener untuk kategori select (auto generate SKU)
        const kategoriSelect = document.getElementById('kategoriSelect');
        if (kategoriSelect) {
            kategoriSelect.addEventListener('change', function() {
                console.log('Kategori changed to:', this.value);
                generateSKU();
            });
            console.log('Kategori select event listener added');
        }
        
        // Event listener untuk form modal baru (my_modal_5)
        const formModal = document.getElementById('tambahProdukFormModal');
        if (formModal) {
            formModal.addEventListener('submit', function(e) {
                e.preventDefault();
                console.log('Form submission intercepted!');
                
                // Debug: Check form elements
                const skuInputElement = document.getElementById('skuInputModal');
                console.log('SKU input element:', skuInputElement);
                console.log('SKU input value:', skuInputElement ? skuInputElement.value : 'NOT FOUND');
                
                // Ambil data form untuk preview
                const formData = new FormData(this);
                const namaBarang = formData.get('nama_barang');
                const kategori = formData.get('kategori');
                const stok = formData.get('stok');
                const hargaJual = formData.get('harga_jual');
                const sku = formData.get('sku');
                
                console.log('Form data:', {
                    namaBarang, kategori, stok, hargaJual, sku
                });
                
                console.log('All form fields:');
                for (let pair of formData.entries()) {
                    console.log(pair[0] + ': ' + pair[1]);
                }
                
                // Validasi SKU - lebih detail
                if (!sku || sku.trim() === '') {
                    console.error('SKU kosong atau tidak valid!');
                    showNotification('Silakan pilih kategori untuk generate SKU', 'error');
                    return;
                }
                
                showConfirmAlert({
                    title: 'Tambah Produk Baru',
                    message: `Apakah Anda yakin ingin menambahkan produk "${namaBarang}" ke inventori?`,
                    details: `SKU: ${sku} • Kategori: ${kategori} • Stok: ${stok} unit • Harga: Rp ${parseInt(hargaJual).toLocaleString('id-ID')}`,
                    confirmText: 'Tambah Produk',
                    cancelText: 'Batalkan',
                    icon: 'fas fa-plus-circle',
                    iconColor: 'text-green-500',
                    confirmColor: 'bg-green-500 hover:bg-green-600',
                    onConfirm: function() {
                        console.log('User confirmed submission, submitting form...');
                        // Submit form
                        formModal.submit();
                    }
                });
            });
            console.log('Modal form event listener added');
        }
        
        // Event listener untuk kategori select modal (auto generate SKU)
        const kategoriSelectModal = document.getElementById('kategoriSelectModal');
        if (kategoriSelectModal) {
            kategoriSelectModal.addEventListener('change', function() {
                console.log('Kategori modal changed to:', this.value);
                generateSKUModal();
            });
            console.log('Kategori select modal event listener added');
        }
        
        // Reset modal when closed
        const modal5 = document.getElementById('my_modal_5');
        if (modal5) {
            modal5.addEventListener('close', function() {
                // Reset form
                const form = document.getElementById('tambahProdukFormModal');
                if (form) {
                    form.reset();
                    const skuInputModal = document.getElementById('skuInputModal');
                    if (skuInputModal) {
                        skuInputModal.value = '';
                        skuInputModal.style.backgroundColor = '#f9fafb';
                        skuInputModal.style.color = '#6b7280';
                        skuInputModal.style.fontWeight = 'normal';
                    }
                }
            });
            console.log('Modal close event listener added');
        }
    });

    // Edit Form Handler (akan dipanggil dari modal edit)
    function submitEditForm(formElement) {
        showConfirmAlert({
            title: 'Simpan Perubahan',
            message: 'Apakah Anda yakin ingin menyimpan perubahan pada produk ini?',
            details: 'Data produk akan diperbarui dengan informasi baru yang Anda masukkan.',
            confirmText: 'Simpan Perubahan',
            cancelText: 'Batalkan',
            icon: 'fas fa-edit',
            iconColor: 'text-blue-500',
            confirmColor: 'bg-blue-500 hover:bg-blue-600',
            onConfirm: function() {
                formElement.submit();
            }
        });
    }

    // Delete Form Handler
    function confirmDelete(form, productName) {
        showConfirmAlert({
            title: 'Hapus Produk',
            message: `Apakah Anda yakin ingin menghapus produk "${productName}"?`,
            details: 'Tindakan ini tidak dapat dibatalkan. Semua data terkait produk ini akan dihapus permanen.',
            confirmText: 'Ya, Hapus',
            cancelText: 'Batalkan',
            icon: 'fas fa-trash',
            iconColor: 'text-red-500',
            confirmColor: 'bg-red-500 hover:bg-red-600',
            onConfirm: function() {
                form.submit();
            }
        });
    }

    // Auto-hide success message untuk barang terkirim
    document.addEventListener('DOMContentLoaded', function() {
        const successAlert = document.querySelector('.alert-success.animate-fade-in');
        if (successAlert) {
            // Auto hide after 5 seconds
            setTimeout(function() {
                successAlert.style.opacity = '0';
                successAlert.style.transform = 'translateY(-20px)';
                setTimeout(function() {
                    successAlert.style.display = 'none';
                }, 300);
            }, 5000);
            
            // Add close button functionality
            const closeBtn = document.createElement('button');
            closeBtn.innerHTML = '<i class="fas fa-times"></i>';
            closeBtn.className = 'absolute top-2 right-2 text-green-600 hover:text-green-800 p-1 rounded-full hover:bg-green-200 transition-colors';
            closeBtn.onclick = function() {
                successAlert.style.opacity = '0';
                successAlert.style.transform = 'translateY(-20px)';
                setTimeout(function() {
                    successAlert.style.display = 'none';
                }, 300);
            };
            
            // Make alert relative positioned and add close button
            successAlert.style.position = 'relative';
            successAlert.appendChild(closeBtn);
        }
    });

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
        console.log('toggleDropdown called', element); // Debug log
        event.stopPropagation();
        
        try {
            // Tutup dropdown lain yang terbuka
            document.querySelectorAll('.dropdown-orange.show').forEach(dropdown => {
                if (dropdown !== element) {
                    dropdown.classList.remove('show');
                }
            });

            // Toggle dropdown saat ini
            element.classList.toggle('show');
            console.log('Dropdown toggled, show class:', element.classList.contains('show')); // Debug log

            // Positioning dropdown
            if (element.classList.contains('show')) {
                const button = element.querySelector('.dropbtn');
                const dropdown = element.querySelector('.dropdown-content');
                
                if (button && dropdown) {
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
                    console.log('Dropdown positioned'); // Debug log
                } else {
                    console.error('Button atau dropdown content tidak ditemukan');
                }
            }
        } catch (error) {
            console.error('Error in toggleDropdown:', error);
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
    