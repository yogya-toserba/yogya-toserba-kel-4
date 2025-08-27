<head>
    <title>Dashboard Inventory</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #ff9800;
            --secondary-color: #f57c00;
        }
        
        body {
            background: #f8f9fa;
            font-family: 'Arial', sans-serif;
        }
        
        .dashboard-container {
            padding: 2rem;
        }
        
        .dashboard-header {
            background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
            color: white;
            padding: 2rem;
            border-radius: 10px;
            margin-bottom: 2rem;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        
        .stats-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }
        
        .stat-card {
            font-weight: bold;
            background: white;
            padding: 1.5rem;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
            transition: transform 0.3s ease;
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
        }
        
        .data-table {
            background: white;
            border-radius: 10px;
            padding: 1.5rem;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }
        
        .table {
            margin: 0;
        }
        
        .btn-action {
            padding: 0.375rem 0.75rem;
            border-radius: 5px;
            transition: all 0.3s ease;
        }
        
        .btn-edit {
            background: var(--primary-color);
            color: white;
            border: none;
        }
        
        .btn-delete {
            background: #dc3545;
            color: white;
            border: none;
        }
        
        .product-image {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 5px;
        }
        
        .status-badge {
            padding: 0.25rem 0.5rem;
            border-radius: 15px;
            font-size: 0.875rem;
        }

        .status-inactive {
            background: #dc3545;
            color: white;
        }
        h2 , h3 {
            font-weight: bold;
        }

        .stat-card-red {
        background: #dc3545; 
        color: #ffffffff;
        
    }
    
    .stat-card-blue {
        background: #0d6efd; 
        color: #ffffffff;
        }

        .stat-card-yellow {
            background: #ffc107; 
            color: #ffffffff; 
        }

        .stat-card h3 {
            font-size: 1.1rem;
            margin-bottom: 1rem;
        }

        .stat-card h2 {
            font-size: 1.8rem;
            margin: 0;
        }
    </style>
</head>
<body>
        <div class="dashboard-container">
            <div class="stats-container">
        <div class="stat-card stat-card-red">
            <h3>Total Produk</h3>
            <h2>150</h2>
        </div>
        <div class="stat-card stat-card-blue">
            <h3>Produk Aktif</h3>
            <h2>120</h2>
        </div>
        <div class="stat-card stat-card-yellow">
            <h3>Total Nilai Inventory</h3>
            <h2>Rp 25.000.000</h2>
        </div>
    </div>

        <div class="data-table">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Daftar Produk</h2>
                <a href="{{route('gudang.produk.create')}}" class="btn btn-primary">
                    <i class="fas fa-plus me-2"></i>Tambah Produk
                </a>
            </div>

            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Produk</th>
                            <th>SKU</th>
                            <th>Unit</th>
                            <th>Harga Beli</th>
                            <th>Harga Jual</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
    @foreach($produks as $produk)
    <tr>
        <td>
            <div class="d-flex align-items-center">
                <img src="{{ $produk->gambar ? asset('storage/'.$produk->gambar) : asset('image/noimage.png') }}" class="product-image me-3">
                <div>
                    <h6 class="mb-0">{{ $produk->nama }}</h6>
                    <small class="text-muted">{{ $produk->deskripsi }}</small>
                </div>
            </div>
        </td>
        <td>{{ $produk->sku }}</td>
        <td>{{ $produk->unit }}</td>
        <td>Rp {{ number_format($produk->harga_beli, 0, ',', '.') }}</td>
        <td>Rp {{ number_format($produk->harga_jual, 0, ',', '.') }}</td>
        <td>
            <span class="status-badge {{ $produk->status == 'aktif' ? 'status-active' : 'status-inactive' }}">
                {{ ucfirst($produk->status) }}
            </span>
        </td>
        <td>
            <div class="btn-group">
                <a href="{{ route('gudang.produk.edit', $produk->id) }}" class="btn btn-warning">Edit</a>

                <form action="{{ route('gudang.produk.destroy', $produk->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Hapus</button>
            </form>
            </div>
        </td>
    </tr>
    @endforeach
</tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>