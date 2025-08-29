@extends('layouts.navbar_admin')

@section('title', 'Data Karyawan - MyYOGYA Admin')

@section('content')
<style>
    .orange-theme {
        --orange-primary: rgb(242, 112, 61);
        --orange-light: rgba(242, 112, 61, 0.1);
        --orange-dark: rgb(220, 95, 50);
    }
    
    .btn-orange {
        background-color: var(--orange-primary);
        border-color: var(--orange-primary);
        color: white;
    }
    
    .btn-orange:hover {
        background-color: var(--orange-dark);
        border-color: var(--orange-dark);
        color: white;
    }
    
    .text-orange {
        color: var(--orange-primary) !important;
    }
    
    /* Dropdown Action Styles */
    .dropdown-toggle {
        border: none;
        background: #f8f9fa;
        color: #6c757d;
        width: 32px;
        height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 6px;
    }
    
    .dropdown-toggle:hover {
        background: #e9ecef;
        color: #495057;
    }
    
    .dropdown-toggle:focus {
        box-shadow: 0 0 0 0.2rem rgba(242, 112, 61, 0.25);
    }
    
    .dropdown-menu {
        border: 1px solid #dee2e6;
        border-radius: 8px;
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        min-width: 150px;
    }
    
    .dropdown-item {
        padding: 0.5rem 1rem;
        font-size: 0.875rem;
    }
    
    .dropdown-item:hover {
        background-color: #f8f9fa;
    }
    
    .dropdown-item.text-danger:hover {
        background-color: #f8d7da;
    }
</style>

<div class="container-fluid orange-theme">
    <!-- Welcome Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="h3 mb-1 text-orange">Data Karyawan</h1>
                    <p class="text-muted mb-0">Kelola data karyawan MyYOGYA</p>
                </div>
                <div class="text-end">
                    <small class="text-muted">{{ date('l, d F Y') }}</small>
                </div>
            </div>
        </div>
    </div>

    <!-- Success/Error Messages -->
    @if(session('success'))
        <div class="row mb-4">
            <div class="col-12">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="row mb-4">
            <div class="col-12">
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            </div>
        </div>
    @endif

    <!-- Main Content Card -->
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">
                            <i class="fas fa-users text-orange me-2"></i>Daftar Karyawan
                        </h5>
                        <a href="{{ route('admin.data-karyawan.tambah') }}" class="btn btn-orange">
                            <i class="fas fa-plus me-2"></i>Tambah Karyawan
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    @if($karyawan->count() > 0)
                        <!-- Search and Filter Bar -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-search"></i>
                                    </span>
                                    <input type="text" class="form-control" placeholder="Cari karyawan..." id="searchKaryawan">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <select class="form-select" id="filterDivisi">
                                    <option value="">Semua Divisi</option>
                                    @foreach($karyawan->unique('divisi') as $k)
                                        <option value="{{ $k->divisi }}">{{ $k->divisi }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Statistics Cards -->
                        <div class="row mb-4">
                            <div class="col-md-3">
                                <div class="card bg-primary text-white">
                                    <div class="card-body text-center">
                                        <i class="fas fa-users fa-2x mb-2"></i>
                                        <h4>{{ $karyawan->count() }}</h4>
                                        <small>Total Karyawan</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card bg-success text-white">
                                    <div class="card-body text-center">
                                        <i class="fas fa-building fa-2x mb-2"></i>
                                        <h4>{{ $karyawan->unique('divisi')->count() }}</h4>
                                        <small>Total Divisi</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card bg-info text-white">
                                    <div class="card-body text-center">
                                        <i class="fas fa-user-tie fa-2x mb-2"></i>
                                        <h4>{{ $karyawan->where('divisi', 'Manager')->count() }}</h4>
                                        <small>Manager</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card bg-warning text-white">
                                    <div class="card-body text-center">
                                        <i class="fas fa-birthday-cake fa-2x mb-2"></i>
                                        <h4>{{ $karyawan->filter(function($k) { return $k->tanggal_lahir->month == now()->month; })->count() }}</h4>
                                        <small>Ulang Tahun Bulan Ini</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Karyawan Table -->
                        <div class="table-responsive">
                            <table class="table table-hover align-middle" id="karyawanTable">
                                <thead class="table-light">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Divisi</th>
                                        <th>Email</th>
                                        <th>No. Telepon</th>
                                        <th>Umur</th>
                                        <th>Alamat</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($karyawan as $index => $k)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar-sm me-3">
                                                        <div class="bg-primary bg-opacity-10 text-primary rounded-circle p-2 d-flex align-items-center justify-content-center">
                                                            <i class="fas fa-user"></i>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <div class="fw-semibold">{{ $k->nama }}</div>
                                                        <small class="text-muted">ID: {{ $k->id_karyawan }}</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="badge bg-secondary">{{ $k->divisi }}</span>
                                            </td>
                                            <td>{{ $k->email }}</td>
                                            <td>{{ $k->formatted_phone }}</td>
                                            <td>{{ $k->age }} tahun</td>
                                            <td>{{ Str::limit($k->alamat, 30) }}</td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn btn-sm btn-light dropdown-toggle" type="button" id="dropdownMenuButton{{ $k->id_karyawan }}" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="fas fa-ellipsis-v"></i>
                                                    </button>
                                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton{{ $k->id_karyawan }}">
                                                        <li>
                                                            <a class="dropdown-item" href="#" onclick="viewEmployee({{ $k->id_karyawan }})">
                                                                <i class="fas fa-eye me-2 text-primary"></i>
                                                                Lihat Detail
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item" href="#" onclick="editEmployee({{ $k->id_karyawan }})">
                                                                <i class="fas fa-edit me-2 text-warning"></i>
                                                                Edit
                                                            </a>
                                                        </li>
                                                        <li><hr class="dropdown-divider"></li>
                                                        <li>
                                                            <a class="dropdown-item text-danger" href="#" onclick="deleteEmployee({{ $k->id_karyawan }}, '{{ $k->nama }}')">
                                                                <i class="fas fa-trash me-2"></i>
                                                                Hapus
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <!-- Empty State -->
                        <div class="text-center py-5">
                            <div class="mb-4">
                                <i class="fas fa-users fa-5x text-muted opacity-50"></i>
                            </div>
                            <h4 class="text-muted">Belum Ada Data Karyawan</h4>
                            <p class="text-muted">Tambahkan karyawan pertama untuk memulai</p>
                            <a href="{{ route('admin.data-karyawan.tambah') }}" class="btn btn-orange">
                                <i class="fas fa-plus me-2"></i>Tambah Karyawan Pertama
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript for Search and Filter -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchKaryawan');
    const filterDivisi = document.getElementById('filterDivisi');
    const table = document.getElementById('karyawanTable');
    
    if (searchInput && filterDivisi && table) {
        function filterTable() {
            const searchTerm = searchInput.value.toLowerCase();
            const selectedDivisi = filterDivisi.value.toLowerCase();
            const rows = table.getElementsByTagName('tbody')[0].getElementsByTagName('tr');
            
            Array.from(rows).forEach(row => {
                const nama = row.cells[1].textContent.toLowerCase();
                const email = row.cells[3].textContent.toLowerCase();
                const divisi = row.cells[2].textContent.toLowerCase();
                
                const matchesSearch = nama.includes(searchTerm) || email.includes(searchTerm);
                const matchesDivisi = selectedDivisi === '' || divisi.includes(selectedDivisi);
                
                if (matchesSearch && matchesDivisi) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }
        
        searchInput.addEventListener('keyup', filterTable);
        filterDivisi.addEventListener('change', filterTable);
    }
    
    // Dropdown Action Functions
    window.viewEmployee = function(id) {
        // For now, show an alert. In the future, this could open a modal or redirect to detail page
        alert('Melihat detail karyawan dengan ID: ' + id);
        // Future implementation:
        // window.location.href = '/admin/karyawan/' + id;
    };
    
    window.editEmployee = function(id) {
        // For now, show an alert. In the future, this could redirect to edit page
        alert('Edit karyawan dengan ID: ' + id);
        // Future implementation:
        // window.location.href = '/admin/karyawan/' + id + '/edit';
    };
    
    window.deleteEmployee = function(id, nama) {
        if (confirm('Apakah Anda yakin ingin menghapus karyawan "' + nama + '"?\n\nTindakan ini tidak dapat dibatalkan.')) {
            // For now, show an alert. In the future, this could send DELETE request
            alert('Menghapus karyawan: ' + nama + ' (ID: ' + id + ')');
            // Future implementation:
            // fetch('/admin/karyawan/' + id, {
            //     method: 'DELETE',
            //     headers: {
            //         'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            //     }
            // }).then(response => {
            //     if (response.ok) {
            //         location.reload();
            //     }
            // });
        }
    };
});
</script>
@endsection
