@extends('layouts.navbar_admin')

@section('title', 'Data Karyawan - MyYOGYA Admin')

@section('content')
<style>
/* Clean CSS Reset */
.main-content {
    margin-left: 250px;
    padding: 25px 35px;
    background: #f8fafc;
    min-height: 100vh;
    width: calc(100% - 250px);
}

/* Stats Cards */
.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
    margin-bottom: 30px;
}

.stat-card {
    background: white;
    padding: 20px;
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

.stat-icon {
    width: 50px;
    height: 50px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 15px;
}

.stat-title {
    font-size: 0.85rem;
    color: #64748b;
    margin-bottom: 5px;
}

.stat-value {
    font-size: 2rem;
    font-weight: bold;
    color: #1e293b;
}

/* Search and Filter */
.search-filter-container {
    background: white;
    padding: 20px;
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    margin-bottom: 20px;
}

.search-row {
    display: flex;
    gap: 15px;
    align-items: center;
    flex-wrap: wrap;
}

.search-group {
    flex: 1;
    min-width: 250px;
}

.search-input, .filter-select {
    width: 100%;
    padding: 12px;
    border: 1px solid #e2e8f0;
    border-radius: 8px;
    font-size: 0.9rem;
}

.btn-search {
    background: #3b82f6;
    color: white;
    padding: 12px 24px;
    border: none;
    border-radius: 8px;
    cursor: pointer;
}

/* Table */
.table-container {
    background: white;
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    overflow: hidden;
}

.table {
    width: 100%;
    border-collapse: collapse;
}

.table th {
    background: #f8fafc;
    padding: 15px;
    text-align: left;
    font-weight: 600;
    color: #64748b;
    border-bottom: 1px solid #e2e8f0;
}

.table td {
    padding: 15px;
    border-bottom: 1px solid #f1f5f9;
}

.table tr:hover {
    background: #f8fafc;
}

/* Badges */
.badge-department {
    background: #e0f2fe;
    color: #0369a1;
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 500;
}

.badge-active {
    background: #dcfce7;
    color: #166534;
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 500;
}

/* Action Dropdown */
.action-dropdown {
    position: relative;
}

.action-dropdown-btn {
    background: none;
    border: none;
    padding: 8px;
    border-radius: 6px;
    cursor: pointer;
    color: #64748b;
}

.action-dropdown-btn:hover {
    background: #f1f5f9;
}

.action-dropdown-menu {
    display: none;
    position: absolute;
    right: 0;
    top: 100%;
    background: white;
    border: 1px solid #e2e8f0;
    border-radius: 8px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    z-index: 1000;
    min-width: 150px;
}

.action-dropdown-menu.show {
    display: block;
}

.action-dropdown-item {
    display: flex;
    align-items: center;
    width: 100%;
    padding: 10px 15px;
    border: none;
    background: none;
    text-align: left;
    cursor: pointer;
    font-size: 0.85rem;
}

.action-dropdown-item:hover {
    background: #f8fafc;
}

/* Pagination */
.pagination-container {
    display: flex;
    justify-content: between;
    align-items: center;
    padding: 20px;
    background: white;
}

/* Responsive */
@media (max-width: 768px) {
    .main-content {
        margin-left: 0;
        width: 100%;
        padding: 15px;
    }
    
    .stats-grid {
        grid-template-columns: 1fr;
    }
    
    .search-row {
        flex-direction: column;
    }
    
    .search-group {
        min-width: 100%;
    }
}
</style>

<div class="main-content">
    <!-- Header -->
    <div style="margin-bottom: 30px;">
        <h1 style="font-size: 1.75rem; font-weight: bold; color: #1e293b; margin-bottom: 8px;">Data Karyawan</h1>
        <p style="color: #64748b;">Kelola data karyawan Yogya Toserba</p>
    </div>

    <!-- Stats Cards -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon" style="background: #e0f2fe;">
                <i class="fas fa-users" style="color: #0369a1;"></i>
            </div>
            <div class="stat-title">Total Karyawan</div>
            <div class="stat-value">{{ $totalKaryawan }}</div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon" style="background: #dcfce7;">
                <i class="fas fa-user-check" style="color: #166534;"></i>
            </div>
            <div class="stat-title">Karyawan Aktif</div>
            <div class="stat-value">{{ $karyawanAktif }}</div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon" style="background: #fef3c7;">
                <i class="fas fa-building" style="color: #d97706;"></i>
            </div>
            <div class="stat-title">Total Departemen</div>
            <div class="stat-value">{{ $totalDepartemen }}</div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon" style="background: #f3e8ff;">
                <i class="fas fa-calendar-check" style="color: #7c3aed;"></i>
            </div>
            <div class="stat-title">Hadir Hari Ini</div>
            <div class="stat-value">{{ $hadirHariIni }}</div>
        </div>
    </div>

    <!-- Search and Filter -->
    <div class="search-filter-container">
        <form method="GET" action="{{ route('data-karyawan') }}">
            <div class="search-row">
                <div class="search-group">
                    <input type="text" name="search" class="search-input" placeholder="Cari nama, email, atau divisi..." value="{{ request('search') }}">
                </div>
                <div class="search-group" style="flex: 0.5;">
                    <select name="divisi" class="filter-select">
                        <option value="">Semua Divisi</option>
                        @foreach($divisiList as $divisi)
                            <option value="{{ $divisi }}" {{ request('divisi') == $divisi ? 'selected' : '' }}>{{ $divisi }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn-search">
                    <i class="fas fa-search me-2"></i>Cari
                </button>
            </div>
        </form>
    </div>

    <!-- Table -->
    <div class="table-container">
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Foto</th>
                    <th>Nama Karyawan</th>
                    <th>Divisi</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Bergabung</th>
                    <th style="text-align: center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($karyawan as $index => $emp)
                <tr>
                    <td>{{ $karyawan->firstItem() + $index }}</td>
                    <td>
                        <img src="/image/default-avatar.png" alt="Foto" style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover;">
                    </td>
                    <td>
                        <div>
                            <strong style="color: #1e293b;">{{ $emp->nama }}</strong>
                            <br>
                            <small style="color: #64748b;">{{ $emp->nomer_telepon }}</small>
                        </div>
                    </td>
                    <td>
                        <span class="badge-department">{{ $emp->divisi }}</span>
                    </td>
                    <td>{{ $emp->email }}</td>
                    <td>
                        <span class="badge-active">Aktif</span>
                    </td>
                    <td>
                        <small style="color: #64748b;">{{ $emp->created_at->format('d M Y') }}</small>
                    </td>
                    <td style="text-align: center;">
                        <div class="action-dropdown">
                            <button class="action-dropdown-btn" onclick="toggleDropdown(this)">
                                <i class="fas fa-ellipsis-v"></i>
                            </button>
                            <div class="action-dropdown-menu">
                                <button class="action-dropdown-item" onclick="viewEmployee({{ $emp->id_karyawan }})">
                                    <i class="fas fa-eye me-2"></i>Detail
                                </button>
                                <button class="action-dropdown-item" onclick="editEmployee({{ $emp->id_karyawan }})">
                                    <i class="fas fa-edit me-2"></i>Edit
                                </button>
                                <button class="action-dropdown-item" onclick="deleteEmployee({{ $emp->id_karyawan }})">
                                    <i class="fas fa-trash me-2"></i>Hapus
                                </button>
                            </div>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" style="text-align: center; padding: 40px; color: #64748b;">
                        <i class="fas fa-users fa-2x mb-3" style="opacity: 0.3;"></i>
                        <br>
                        Tidak ada data karyawan
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Pagination -->
        @if($karyawan->hasPages())
        <div class="pagination-container">
            <div style="color: #64748b; font-size: 0.9rem;">
                Menampilkan {{ $karyawan->firstItem() }}-{{ $karyawan->lastItem() }} dari {{ $karyawan->total() }} karyawan
            </div>
            <div>
                {{ $karyawan->links() }}
            </div>
        </div>
        @endif
    </div>
</div>

<script>
// Toggle dropdown
function toggleDropdown(btn) {
    const menu = btn.nextElementSibling;
    const allMenus = document.querySelectorAll('.action-dropdown-menu');
    
    // Close all other menus
    allMenus.forEach(m => {
        if (m !== menu) m.classList.remove('show');
    });
    
    // Toggle current menu
    menu.classList.toggle('show');
}

// Close dropdown when clicking outside
document.addEventListener('click', function(e) {
    if (!e.target.closest('.action-dropdown')) {
        document.querySelectorAll('.action-dropdown-menu').forEach(menu => {
            menu.classList.remove('show');
        });
    }
});

// Action functions
function viewEmployee(id) {
    alert('View employee with ID: ' + id);
}

function editEmployee(id) {
    alert('Edit employee with ID: ' + id);
}

function deleteEmployee(id) {
    if (confirm('Apakah Anda yakin ingin menghapus karyawan ini?')) {
        alert('Delete employee with ID: ' + id);
    }
}
</script>
@endsection
