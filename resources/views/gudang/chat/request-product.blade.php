@extends('layouts.appGudang')

@section('title', 'Request Produk - ' . $chatRoom->nama_room)

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-success text-white">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                        <i class="fas fa-box"></i> Form Request Produk
                    </h5>
                    <a href="{{ route('gudang.chat.show', $chatRoom->id) }}" class="btn btn-light btn-sm">
                        <i class="fas fa-arrow-left"></i> Kembali ke Chat
                    </a>
                </div>
            </div>
            
            <div class="card-body">
                <!-- Supplier Info -->
                <div class="alert alert-info">
                    <div class="row">
                        <div class="col-md-6">
                            <strong><i class="fas fa-building"></i> {{ $chatRoom->pemasok->nama_perusahaan }}</strong><br>
                            <small>{{ $chatRoom->pemasok->kontak_person }} - {{ $chatRoom->pemasok->telepon }}</small>
                        </div>
                        <div class="col-md-6 text-end">
                            <span class="badge bg-primary">{{ $chatRoom->pemasok->kategori_produk }}</span><br>
                            <small class="text-muted">{{ $chatRoom->pemasok->kota }}</small>
                        </div>
                    </div>
                </div>

                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('gudang.chat.send-product-request', $chatRoom->id) }}" method="POST">
                    @csrf
                    
                    <div class="row">
                        <!-- Informasi Produk -->
                        <div class="col-md-6">
                            <h6 class="text-primary mb-3"><i class="fas fa-info-circle"></i> Informasi Produk</h6>
                            
                            <div class="mb-3">
                                <label for="nama_produk" class="form-label">Nama Produk <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('nama_produk') is-invalid @enderror" 
                                       id="nama_produk" name="nama_produk" value="{{ old('nama_produk') }}" required>
                                @error('nama_produk')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="kategori" class="form-label">Kategori <span class="text-danger">*</span></label>
                                <select class="form-select @error('kategori') is-invalid @enderror" id="kategori" name="kategori" required>
                                    <option value="">Pilih Kategori...</option>
                                    <option value="Makanan & Minuman" {{ old('kategori') == 'Makanan & Minuman' ? 'selected' : '' }}>Makanan & Minuman</option>
                                    <option value="Perawatan Tubuh" {{ old('kategori') == 'Perawatan Tubuh' ? 'selected' : '' }}>Perawatan Tubuh</option>
                                    <option value="Rumah Tangga" {{ old('kategori') == 'Rumah Tangga' ? 'selected' : '' }}>Rumah Tangga</option>
                                    <option value="Elektronik" {{ old('kategori') == 'Elektronik' ? 'selected' : '' }}>Elektronik</option>
                                    <option value="Fashion" {{ old('kategori') == 'Fashion' ? 'selected' : '' }}>Fashion</option>
                                    <option value="Kesehatan" {{ old('kategori') == 'Kesehatan' ? 'selected' : '' }}>Kesehatan</option>
                                    <option value="Olahraga" {{ old('kategori') == 'Olahraga' ? 'selected' : '' }}>Olahraga</option>
                                    <option value="Lainnya" {{ old('kategori') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                                </select>
                                @error('kategori')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="spesifikasi" class="form-label">Spesifikasi / Deskripsi</label>
                                <textarea class="form-control @error('spesifikasi') is-invalid @enderror" 
                                          id="spesifikasi" name="spesifikasi" rows="4" 
                                          placeholder="Contoh: Ukuran, warna, merk, bahan, dll...">{{ old('spesifikasi') }}</textarea>
                                @error('spesifikasi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Detail Permintaan -->
                        <div class="col-md-6">
                            <h6 class="text-primary mb-3"><i class="fas fa-clipboard-list"></i> Detail Permintaan</h6>
                            
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="mb-3">
                                        <label for="jumlah" class="form-label">Jumlah <span class="text-danger">*</span></label>
                                        <input type="number" class="form-control @error('jumlah') is-invalid @enderror" 
                                               id="jumlah" name="jumlah" value="{{ old('jumlah') }}" min="1" required>
                                        @error('jumlah')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="satuan" class="form-label">Satuan <span class="text-danger">*</span></label>
                                        <select class="form-select @error('satuan') is-invalid @enderror" id="satuan" name="satuan" required>
                                            <option value="">Pilih...</option>
                                            <option value="pcs" {{ old('satuan') == 'pcs' ? 'selected' : '' }}>Pcs</option>
                                            <option value="box" {{ old('satuan') == 'box' ? 'selected' : '' }}>Box</option>
                                            <option value="karton" {{ old('satuan') == 'karton' ? 'selected' : '' }}>Karton</option>
                                            <option value="kg" {{ old('satuan') == 'kg' ? 'selected' : '' }}>Kg</option>
                                            <option value="liter" {{ old('satuan') == 'liter' ? 'selected' : '' }}>Liter</option>
                                            <option value="meter" {{ old('satuan') == 'meter' ? 'selected' : '' }}>Meter</option>
                                            <option value="pack" {{ old('satuan') == 'pack' ? 'selected' : '' }}>Pack</option>
                                            <option value="lusin" {{ old('satuan') == 'lusin' ? 'selected' : '' }}>Lusin</option>
                                        </select>
                                        @error('satuan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="harga_maksimal" class="form-label">Harga Maksimal (per satuan)</label>
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input type="number" class="form-control @error('harga_maksimal') is-invalid @enderror" 
                                           id="harga_maksimal" name="harga_maksimal" value="{{ old('harga_maksimal') }}" 
                                           min="0" step="0.01" placeholder="Opsional">
                                </div>
                                <small class="text-muted">Kosongkan jika tidak ada batasan harga</small>
                                @error('harga_maksimal')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="tanggal_dibutuhkan" class="form-label">Tanggal Dibutuhkan</label>
                                <input type="date" class="form-control @error('tanggal_dibutuhkan') is-invalid @enderror" 
                                       id="tanggal_dibutuhkan" name="tanggal_dibutuhkan" value="{{ old('tanggal_dibutuhkan') }}" 
                                       min="{{ date('Y-m-d', strtotime('+1 day')) }}">
                                @error('tanggal_dibutuhkan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="catatan" class="form-label">Catatan Tambahan</label>
                                <textarea class="form-control @error('catatan') is-invalid @enderror" 
                                          id="catatan" name="catatan" rows="3" 
                                          placeholder="Informasi tambahan, syarat khusus, dll...">{{ old('catatan') }}</textarea>
                                @error('catatan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Priority Level -->
                    <div class="row mt-3">
                        <div class="col-12">
                            <h6 class="text-primary mb-3"><i class="fas fa-exclamation-triangle"></i> Tingkat Prioritas</h6>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="prioritas" id="prioritas_rendah" value="rendah" {{ old('prioritas', 'normal') == 'rendah' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="prioritas_rendah">
                                            <span class="badge bg-secondary">Rendah</span> - Tidak mendesak
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="prioritas" id="prioritas_normal" value="normal" {{ old('prioritas', 'normal') == 'normal' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="prioritas_normal">
                                            <span class="badge bg-primary">Normal</span> - Standar
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="prioritas" id="prioritas_tinggi" value="tinggi" {{ old('prioritas') == 'tinggi' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="prioritas_tinggi">
                                            <span class="badge bg-danger">Tinggi</span> - Mendesak
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="my-4">

                    <!-- Action Buttons -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="d-grid">
                                <a href="{{ route('gudang.chat.show', $chatRoom->id) }}" class="btn btn-secondary">
                                    <i class="fas fa-times"></i> Batal
                                </a>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-grid">
                                <button type="submit" class="btn btn-success">
                                    <i class="fas fa-paper-plane"></i> Kirim Request Produk
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <!-- Help Panel -->
    <div class="col-md-4">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-info text-white">
                <h6 class="mb-0"><i class="fas fa-question-circle"></i> Bantuan</h6>
            </div>
            <div class="card-body">
                <h6 class="text-primary">Tips Mengisi Form Request:</h6>
                <ul class="list-unstyled small">
                    <li><i class="fas fa-check text-success"></i> Sertakan spesifikasi yang detail</li>
                    <li><i class="fas fa-check text-success"></i> Tentukan jumlah dan satuan dengan tepat</li>
                    <li><i class="fas fa-check text-success"></i> Berikan batasan harga jika ada</li>
                    <li><i class="fas fa-check text-success"></i> Tentukan deadline yang realistis</li>
                    <li><i class="fas fa-check text-success"></i> Pilih prioritas sesuai kebutuhan</li>
                </ul>
                
                <hr>
                
                <h6 class="text-warning">Contoh Spesifikasi yang Baik:</h6>
                <div class="bg-light p-2 rounded small">
                    <strong>Nama:</strong> Minyak Goreng<br>
                    <strong>Spesifikasi:</strong> Merk Bimoli, kemasan 2 liter, botol plastik, tanpa pengawet<br>
                    <strong>Jumlah:</strong> 50 botol<br>
                    <strong>Harga Max:</strong> Rp 35.000/botol
                </div>
            </div>
        </div>

        <!-- Recent Requests -->
        <div class="card border-0 shadow-sm mt-3">
            <div class="card-header bg-secondary text-white">
                <h6 class="mb-0"><i class="fas fa-history"></i> Request Terakhir</h6>
            </div>
            <div class="card-body">
                @php
                    $recentRequests = $chatRoom->messages()
                        ->where('message_type', 'product_request')
                        ->latest()
                        ->take(3)
                        ->get();
                @endphp
                
                @if($recentRequests->count() > 0)
                    @foreach($recentRequests as $request)
                        <div class="border-bottom pb-2 mb-2">
                            <small class="text-muted">{{ $request->created_at->format('d/m/Y') }}</small>
                            @if($request->product_data && isset($request->product_data['nama_produk']))
                                <div><strong>{{ $request->product_data['nama_produk'] }}</strong></div>
                                @if(isset($request->product_data['jumlah']) && isset($request->product_data['satuan']))
                                    <small class="text-muted">{{ $request->product_data['jumlah'] }} {{ $request->product_data['satuan'] }}</small>
                                @endif
                            @endif
                        </div>
                    @endforeach
                @else
                    <small class="text-muted">Belum ada request sebelumnya</small>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // Auto-fill some fields based on previous data
        $('#kategori').on('change', function() {
            // You can add logic here to suggest common products for the category
        });

        // Format currency input
        $('#harga_maksimal').on('input', function() {
            let value = $(this).val();
            if (value) {
                // Simple number formatting
                $(this).attr('title', 'Rp ' + parseInt(value).toLocaleString('id-ID'));
            }
        });

        // Set minimum date to tomorrow
        const tomorrow = new Date();
        tomorrow.setDate(tomorrow.getDate() + 1);
        $('#tanggal_dibutuhkan').attr('min', tomorrow.toISOString().split('T')[0]);

        // Form validation enhancement
        $('form').on('submit', function(e) {
            const jumlah = $('#jumlah').val();
            const satuan = $('#satuan').val();
            const namaProduk = $('#nama_produk').val();

            if (!namaProduk || !jumlah || !satuan) {
                e.preventDefault();
                alert('Mohon lengkapi minimal Nama Produk, Jumlah, dan Satuan');
                return false;
            }

            // Show loading state
            $(this).find('button[type="submit"]')
                   .prop('disabled', true)
                   .html('<i class="fas fa-spinner fa-spin"></i> Mengirim Request...');
        });

        // Quick fill buttons for common products
        $('.quick-fill').on('click', function() {
            const data = $(this).data();
            $('#nama_produk').val(data.nama || '');
            $('#kategori').val(data.kategori || '');
            $('#satuan').val(data.satuan || '');
            if (data.jumlah) $('#jumlah').val(data.jumlah);
        });
    });

    // Function to add quick fill buttons (can be called dynamically)
    function addQuickFillSuggestion(nama, kategori, satuan) {
        const suggestion = `
            <button type="button" class="btn btn-outline-primary btn-sm me-1 mb-1 quick-fill" 
                    data-nama="${nama}" data-kategori="${kategori}" data-satuan="${satuan}">
                ${nama}
            </button>
        `;
        
        if (!$('#quick-suggestions').length) {
            $('#nama_produk').after('<div id="quick-suggestions" class="mt-2"></div>');
        }
        
        $('#quick-suggestions').append(suggestion);
    }
</script>
@endpush
