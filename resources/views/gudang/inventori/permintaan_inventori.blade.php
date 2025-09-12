@extends('layouts.appInventori')

@section('title', 'Form Permintaan Stok - MyYOGYA')

@section('content')
<style>
    /* Ensure proper body and container background */
    body {
        background-color: #f8fafc !important;
    }
    
    .container {
        background-color: transparent !important;
        min-height: 100vh;
        padding: 20px;
    }
    
    /* Override any dark modal or dialog backgrounds */
    .modal, .modal-backdrop, dialog {
        background-color: rgba(0, 0, 0, 0.5) !important;
    }
    
    .modal-content, .modal-box {
        background-color: white !important;
    }

    .form-header {
        background: linear-gradient(135deg, #f26b37 0%, #e55827 100%);
        color: white;
        padding: 25px 30px;
        border-radius: 12px;
        margin-bottom: 25px;
        box-shadow: 0 4px 15px rgba(242, 107, 55, 0.3);
    }

    .form-header h2 {
        font-size: 1.8rem;
        font-weight: 700;
        margin: 0;
    }

    .form-header p {
        font-size: 1rem;
        opacity: 0.9;
        margin: 8px 0 0 0;
    }

    .modern-card {
        background: white !important;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        border: 1px solid #e2e8f0;
        overflow: hidden;
        margin-bottom: 25px;
        width: 100%;
    }

    body.dark-mode .modern-card {
        background: #2a2d3f !important;
        border-color: #3a3d4a;
    }

    .card-header-modern {
        background: #f8fafc !important;
        padding: 20px 25px;
        border-bottom: 1px solid #e2e8f0;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    body.dark-mode .card-header-modern {
        background: #252837 !important;
        border-bottom-color: #3a3d4a;
    }

    .card-body-modern {
        padding: 25px;
        background: white !important;
    }

    body.dark-mode .card-body-modern {
        background: #2a2d3f !important;
    }

    /* Form Layout - Membuat form memanjang ke samping */
    .form-row {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
        margin-bottom: 20px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group-full {
        grid-column: 1 / -1;
    }

    .card-title-modern {
        font-size: 1.1rem;
        font-weight: 600;
        color: #1e293b;
        margin: 0;
    }

    body.dark-mode .card-title-modern {
        color: #e2e8f0;
    }

    .form-label-modern {
        font-weight: 600;
        color: #374151;
        margin-bottom: 8px;
    }

    body.dark-mode .form-label-modern {
        color: #e2e8f0;
    }

    .form-control-modern {
        border: 2px solid #e5e7eb;
        border-radius: 8px;
        padding: 10px 12px;
        transition: all 0.3s ease;
        background: white !important;
        color: #374151 !important;
    }

    .form-control-modern:focus {
        border-color: #f26b37;
        box-shadow: 0 0 0 3px rgba(242, 107, 55, 0.1);
        background: white !important;
    }

    body.dark-mode .form-control-modern {
        background: #252837 !important;
        border-color: #3a3d4a;
        color: #e2e8f0 !important;
    }

    .btn-modern {
        background: linear-gradient(135deg, #f26b37, #e55827);
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 8px;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .btn-modern:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(242, 107, 55, 0.4);
    }

    .btn-outline-modern {
        background: transparent;
        color: #f26b37;
        border: 2px solid #f26b37;
        padding: 10px 20px;
        border-radius: 8px;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .btn-outline-modern:hover {
        background: #f26b37;
        color: white;
    }

    .modern-table {
        margin: 0;
        background: white !important;
    }

    .modern-table th {
        background: #f8fafc !important;
        border: none;
        padding: 15px;
        font-weight: 600;
        color: #374151;
        font-size: 0.9rem;
    }

    body.dark-mode .modern-table th {
        background: #252837 !important;
        color: #e2e8f0;
    }

    .modern-table td {
        padding: 15px;
        border: none;
        border-bottom: 1px solid #f1f5f9;
        color: #374151;
        vertical-align: middle;
        background: white !important;
    }

    body.dark-mode .modern-table td {
        border-bottom-color: #3a3d4a;
        color: #e2e8f0;
        background: #2a2d3f !important;
    }

    .form-section {
        padding: 20px;
        background: white !important;
    }

    body.dark-mode .form-section {
        background: #2a2d3f !important;
    }

    .input-group-text {
        background-color: #f8fafc;
        border: 2px solid #e5e7eb;
        border-right: none;
    }

    body.dark-mode .input-group-text {
        background-color: #252837;
        border-color: #3a3d4a;
        color: #e2e8f0;
    }

    /* Product List Styles */
    .product-row {
        margin-bottom: 10px;
        background-color: #f9fafb !important;
        border-radius: 8px;
        padding: 15px;
    }

    body.dark-mode .product-row {
        background-color: #252837 !important;
    }

    .product-row td {
        background-color: #f9fafb !important;
    }

    body.dark-mode .product-row td {
        background-color: #252837 !important;
    }

    .remove-product {
        color: #ef4444;
        cursor: pointer;
        transition: all 0.3s;
    }

    .remove-product:hover {
        color: #dc2626;
        transform: scale(1.1);
    }
    
    /* Success Alert */
    .alert-success-modern {
        background-color: #dcfce7;
        color: #16a34a;
        border: none;
        border-radius: 8px;
        padding: 15px 20px;
    }
    
    body.dark-mode .alert-success-modern {
        background-color: #132e1f;
        color: #4ade80;
    }
    
    /* Form validation styles */
    .form-control.is-invalid,
    .form-select.is-invalid {
        border-color: #dc3545;
        box-shadow: 0 0 0 3px rgba(220, 53, 69, 0.1);
    }
    
    .is-invalid:focus {
        border-color: #dc3545 !important;
        box-shadow: 0 0 0 3px rgba(220, 53, 69, 0.2) !important;
    }
</style>

<div class="container">
    <!-- Form Header -->
    <div class="form-header">
        <h2><i class="fas fa-clipboard-list me-2"></i> Formulir Permintaan Stok</h2>
        <p>Buat permintaan stok baru ke gudang pusat</p>
    </div>
    
    <!-- Success Alert (Initially Hidden) -->
    <div class="alert alert-success-modern mb-4" role="alert" id="successAlert" style="display: none;">
        <div class="d-flex align-items-center">
            <i class="fas fa-check-circle me-2" style="font-size: 1.5rem;"></i>
            <div>
                <h5 class="mb-0 fw-bold">Permintaan Berhasil Dikirim!</h5>
                <p class="mb-0">Permintaan stok Anda telah berhasil dikirim ke gudang pusat untuk diproses.</p>
            </div>
        </div>
    </div>

    <!-- Success Modal -->
    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border-radius: 12px; border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.2);">
                <div class="modal-header" style="background: linear-gradient(135deg, #10b981, #059669); color: white; border-radius: 12px 12px 0 0; border: none;">
                    <h5 class="modal-title fw-bold" id="successModalLabel">
                        <i class="fas fa-check-circle me-2"></i>
                        Permintaan Berhasil Dikirim!
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body" style="padding: 25px; text-align: center;">
                    <div class="mb-4">
                        <i class="fas fa-check-circle" style="font-size: 4rem; color: #10b981;"></i>
                    </div>
                    <h4 class="mb-3 fw-bold text-success" id="permintaanId">ID Permintaan: #REQ001</h4>
                    <p class="mb-3" id="permintaanDetail">
                        Permintaan stok Anda telah berhasil dikirim ke gudang pusat untuk diproses.
                    </p>
                    <div class="alert" style="background-color: #f0f9ff; border: 1px solid #0ea5e9; color: #0c4a6e; border-radius: 8px;">
                        <div class="fw-semibold mb-1">Langkah Selanjutnya:</div>
                        <small>• Tim gudang akan memproses permintaan Anda<br>
                        • Anda akan diberitahu melalui sistem ketika status berubah<br>
                        • Permintaan dapat dilihat di halaman Daftar Permintaan</small>
                    </div>
                </div>
                <div class="modal-footer" style="border: none; padding: 20px 25px;">
                    <button type="button" class="btn btn-modern" onclick="viewPermintaanList()">
                        <i class="fas fa-list me-1"></i> Lihat Daftar Permintaan
                    </button>
                    <button type="button" class="btn btn-outline-modern" data-bs-dismiss="modal" onclick="resetForm()">
                        <i class="fas fa-plus me-1"></i> Buat Permintaan Baru
                    </button>
                </div>
            </div>
        </div>
    </div>

                    <form method="POST" action="{{ route('gudang.permintaan.submit') }}" id="permintaanForm">
        @csrf
        
        <!-- Informasi Umum -->
        <div class="modern-card">
            <div class="card-header-modern">
                <h5 class="card-title-modern">
                    <i class="fas fa-info-circle me-2" style="color: #f26b37;"></i>
                    Informasi Permintaan
                </h5>
            </div>
            <div class="card-body-modern">
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label-modern">Cabang</label>
                        <select class="form-control form-control-modern" name="id_cabang" required>
                            <option value="">Pilih Cabang</option>
                            <option value="CB001">Cabang Bandung</option>
                            <option value="CB002">Cabang Jakarta</option>
                            <option value="CB003">Cabang Surabaya</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label-modern">Tanggal Dibutuhkan</label>
                        <input type="date" class="form-control form-control-modern" name="tanggal_dibutuhkan" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label-modern">Prioritas</label>
                        <select class="form-control form-control-modern" name="prioritas" required>
                            <option value="">Pilih Prioritas</option>
                            <option value="Tinggi">Tinggi</option>
                            <option value="Sedang">Sedang</option>
                            <option value="Rendah">Rendah</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label-modern">Penanggung Jawab</label>
                        <input type="text" class="form-control form-control-modern" name="penanggung_jawab" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group form-group-full">
                        <label class="form-label-modern">Catatan Umum</label>
                        <textarea class="form-control form-control-modern" name="catatan_umum" rows="3"></textarea>
                    </div>
                </div>
            </div>
        </div>

        <!-- Daftar Produk -->
        <div class="modern-card">
            <div class="card-header-modern">
                <h5 class="card-title-modern">
                    <i class="fas fa-boxes me-2" style="color: #f26b37;"></i>
                    Daftar Produk
                </h5>
                <button type="button" class="btn btn-modern" id="tambahProduk">
                    <i class="fas fa-plus me-1"></i> Tambah Produk
                </button>
            </div>
            <div class="form-section">
                <div class="table-responsive">
                    <table class="table modern-table" id="productTable">
                        <thead>
                            <tr>
                                <th>Kode Produk</th>
                                <th>Nama Barang</th>
                                <th>Kategori</th>
                                <th>Jumlah</th>
                                <th>Satuan</th>
                                <th>Stok Tersedia</th>
                                <th>Catatan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="productList">
                            <!-- Template untuk baris produk baru -->
                            <tr class="product-row">
                                <td>
                                    <input type="text" class="form-control form-control-modern" name="kode_produk[]" placeholder="Kode" required>
                                </td>
                                <td>
                                    <input type="text" class="form-control form-control-modern" name="nama_barang[]" placeholder="Nama Barang" required>
                                </td>
                                <td>
                                    <select class="form-control form-control-modern" name="kategori[]" required>
                                        <option value="">Pilih</option>
                                        <option value="Sembako">Sembako</option>
                                        <option value="Elektronik">Elektronik</option>
                                        <option value="Fashion">Fashion</option>
                                        <option value="Makanan">Makanan</option>
                                        <option value="Minuman">Minuman</option>
                                    </select>
                                </td>
                                <td>
                                    <input type="number" min="1" class="form-control form-control-modern" name="jumlah[]" placeholder="Jumlah" required>
                                </td>
                                <td>
                                    <select class="form-control form-control-modern" name="satuan[]" required>
                                        <option value="">Pilih</option>
                                        <option value="Pcs">Pcs</option>
                                        <option value="Box">Box</option>
                                        <option value="Lusin">Lusin</option>
                                        <option value="Kg">Kg</option>
                                        <option value="Liter">Liter</option>
                                    </select>
                                </td>
                                <td>
                                    <input type="number" class="form-control form-control-modern" name="stok_tersedia[]" placeholder="Stok" readonly>
                                </td>
                                <td>
                                    <textarea class="form-control form-control-modern" name="catatan[]" rows="1" placeholder="Catatan"></textarea>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-danger remove-product">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Form Actions -->
        <div class="d-flex justify-content-end gap-2 mb-4">
            <button type="button" class="btn btn-outline-modern" id="resetBtn">
                <i class="fas fa-redo me-1"></i> Reset
            </button>
            <button type="submit" class="btn btn-modern">
                <i class="fas fa-paper-plane me-1"></i> Kirim Permintaan
            </button>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Tambah produk baru
    document.getElementById('tambahProduk').addEventListener('click', function() {
        const productList = document.getElementById('productList');
        const firstRow = productList.querySelector('.product-row');
        const newRow = firstRow.cloneNode(true);
        
        // Reset nilai pada baris baru
        newRow.querySelectorAll('input, select, textarea').forEach(input => {
            input.value = '';
        });
        
        // Tambahkan event listener untuk tombol hapus
        const removeBtn = newRow.querySelector('.remove-product');
        removeBtn.addEventListener('click', function() {
            if (productList.children.length > 1) {
                this.closest('tr').remove();
            } else {
                alert('Minimal harus ada satu produk!');
            }
        });
        
        productList.appendChild(newRow);
    });
    
    // Event listener untuk tombol hapus pada baris pertama
    document.querySelector('.remove-product').addEventListener('click', function() {
        const productList = document.getElementById('productList');
        if (productList.children.length > 1) {
            this.closest('tr').remove();
        } else {
            alert('Minimal harus ada satu produk!');
        }
    });
    
    // Simulasi cek stok saat kode produk diisi
    document.getElementById('productList').addEventListener('change', function(e) {
        if (e.target && e.target.name && e.target.name.includes('kode_produk')) {
            const row = e.target.closest('tr');
            const stokInput = row.querySelector('input[name="stok_tersedia[]"]');
            
            // Simulasi data stok (dalam kasus nyata, ini akan mengambil dari API atau database)
            const kode = e.target.value.trim().toUpperCase();
            if (kode) {
                // Simulasi data stok
                const stokData = {
                    'PRD001': 250,
                    'PRD002': 75,
                    'PRD003': 120,
                    'PRD004': 30,
                    'PRD005': 0
                };
                
                stokInput.value = stokData[kode] || Math.floor(Math.random() * 200);
            }
        }
    });
    
    // Reset form
    document.getElementById('resetBtn').addEventListener('click', function() {
        resetForm();
    });
    
    // Function to reset form
    function resetForm() {
        if (confirm('Apakah Anda yakin ingin mereset formulir?')) {
            document.getElementById('permintaanForm').reset();
            
            // Hapus semua baris produk kecuali yang pertama
            const productList = document.getElementById('productList');
            while (productList.children.length > 1) {
                productList.removeChild(productList.lastChild);
            }
            
            // Reset nilai pada baris pertama
            const firstRow = productList.querySelector('.product-row');
            firstRow.querySelectorAll('input, select, textarea').forEach(input => {
                input.value = '';
                input.classList.remove('is-invalid');
            });
        }
    }
    
    // Function to redirect to permintaan list
    function viewPermintaanList() {
        window.location.href = "{{ route('gudang.permintaan') }}";
    }
    
    // Submit form dengan konfirmasi alert
    document.getElementById('permintaanForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const form = this;
        
        // Validasi form
        const required = this.querySelectorAll('[required]');
        let valid = true;
        
        required.forEach(field => {
            if (!field.value.trim()) {
                field.classList.add('is-invalid');
                valid = false;
            } else {
                field.classList.remove('is-invalid');
            }
        });
        
        if (!valid) {
            alert('Mohon lengkapi semua field yang diperlukan!');
            return;
        }

        // Hitung jumlah produk
        const productRows = document.querySelectorAll('#productList .product-row');
        const totalItems = productRows.length;
        const cabang = form.querySelector('[name="id_cabang"]').selectedOptions[0]?.text || 'Tidak dipilih';
        const prioritas = form.querySelector('[name="prioritas"]').value;
        const tanggalDibutuhkan = form.querySelector('[name="tanggal_dibutuhkan"]').value;

        // Tampilkan alert konfirmasi
        showConfirmAlert({
            title: 'Kirim Permintaan Stok',
            message: `Apakah Anda yakin ingin mengirim permintaan stok ini?`,
            details: `Permintaan untuk ${cabang} dengan ${totalItems} item akan dikirim ke gudang pusat. Prioritas: ${prioritas}, Dibutuhkan: ${tanggalDibutuhkan}`,
            confirmText: 'Kirim Permintaan',
            cancelText: 'Batalkan',
            icon: 'fas fa-paper-plane',
            iconColor: 'text-blue-500',
            confirmColor: 'bg-blue-500 hover:bg-blue-600',
            onConfirm: function() {
                // Disable submit button untuk mencegah double submit
                const submitBtn = form.querySelector('button[type="submit"]');
                const originalText = submitBtn.innerHTML;
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i> Mengirim...';
                
                // Kirim data dengan AJAX
                fetch(form.action, {
                    method: 'POST',
                    body: new FormData(form),
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => {
                    console.log('Response status:', response.status);
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Success response:', data);
                    if (data.success) {
                        // Update modal content dengan data response
                        document.getElementById('permintaanId').textContent = `ID Permintaan: ${data.data.id_permintaan}`;
                        document.getElementById('permintaanDetail').innerHTML = `
                            Permintaan untuk <strong>${data.data.nama_cabang}</strong> dengan 
                            <strong>${data.data.total_items} item</strong> telah berhasil dikirim.<br>
                            <small class="text-muted">Prioritas: ${data.data.prioritas} | Tanggal dibutuhkan: ${data.data.tanggal_dibutuhkan}</small>
                        `;
                        
                        // Tampilkan modal success
                        const successModal = new bootstrap.Modal(document.getElementById('successModal'));
                        successModal.show();
                    } else {
                        alert('Terjadi kesalahan: ' + (data.message || 'Gagal mengirim permintaan'));
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat mengirim permintaan. Silakan coba lagi.');
                })
                .finally(() => {
                    // Reset submit button
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = originalText;
                });
            }
        });
    });
});
</script>

<!-- Include Alert Konfirmasi -->
@include('components.confirm-alert')

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection
