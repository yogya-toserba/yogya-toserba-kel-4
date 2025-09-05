@extends('layouts.admin')

@section('title', 'Manajemen Jabatan & Gaji')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="card-title">Manajemen Jabatan & Gaji</h3>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addJabatanModal">
                            <i class="fas fa-plus"></i> Tambah Jabatan
                        </button>
                    </div>
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Jabatan</th>
                                        <th>Gaji Pokok</th>
                                        <th>Tunjangan Jabatan</th>
                                        <th>Tunjangan Kehadiran</th>
                                        <th>Min. Hari Kerja</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($jabatanList as $index => $jabatan)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $jabatan->nama_jabatan }}</td>
                                            <td>Rp {{ number_format($jabatan->gaji_pokok, 0, ',', '.') }}</td>
                                            <td>Rp {{ number_format($jabatan->tunjangan_jabatan, 0, ',', '.') }}</td>
                                            <td>Rp {{ number_format($jabatan->bonus_kehadiran_per_hari, 0, ',', '.') }}</td>
                                            <td>{{ $jabatan->minimal_hari_kerja }} hari</td>
                                            <td>
                                                <span class="badge bg-{{ $jabatan->status ? 'success' : 'danger' }}">
                                                    {{ $jabatan->status ? 'Aktif' : 'Tidak Aktif' }}
                                                </span>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                                    data-bs-target="#editJabatanModal{{ $jabatan->id }}">
                                                    <i class="fas fa-edit"></i> Edit
                                                </button>
                                                <form method="POST"
                                                    action="{{ route('admin.jabatan-gaji.delete', $jabatan->id) }}"
                                                    style="display:inline-block;"
                                                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus jabatan ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">
                                                        <i class="fas fa-trash"></i> Hapus
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-center">Tidak ada data jabatan</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Jabatan Modal -->
    <div class="modal fade" id="addJabatanModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Jabatan Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form method="POST" action="{{ route('admin.jabatan-gaji.store') }}">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="nama_jabatan" class="form-label">Nama Jabatan</label>
                            <input type="text" class="form-control" id="nama_jabatan" name="nama_jabatan" required>
                        </div>
                        <div class="mb-3">
                            <label for="gaji_pokok" class="form-label">Gaji Pokok</label>
                            <input type="number" class="form-control" id="gaji_pokok" name="gaji_pokok" min="0"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="tunjangan_jabatan" class="form-label">Tunjangan Jabatan</label>
                            <input type="number" class="form-control" id="tunjangan_jabatan" name="tunjangan_jabatan"
                                min="0" value="0">
                        </div>
                        <div class="mb-3">
                            <label for="tunjangan_kehadiran" class="form-label">Bonus Kehadiran per Hari</label>
                            <input type="number" class="form-control" id="tunjangan_kehadiran"
                                name="bonus_kehadiran_per_hari" min="0" value="0">
                        </div>
                        <div class="mb-3">
                            <label for="minimal_hari_kerja" class="form-label">Minimal Hari Kerja</label>
                            <input type="number" class="form-control" id="minimal_hari_kerja" name="minimal_hari_kerja"
                                min="1" max="31" value="22">
                        </div>
                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="status" name="status"
                                    value="1" checked>
                                <label class="form-check-label" for="status">
                                    Status Aktif
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Jabatan Modals -->
    @foreach ($jabatanList as $jabatan)
        <div class="modal fade" id="editJabatanModal{{ $jabatan->id }}" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Jabatan: {{ $jabatan->nama_jabatan }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <form method="POST" action="{{ route('admin.jabatan-gaji.update', $jabatan->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="edit_nama_jabatan{{ $jabatan->id }}" class="form-label">Nama Jabatan</label>
                                <input type="text" class="form-control" id="edit_nama_jabatan{{ $jabatan->id }}"
                                    name="nama_jabatan" value="{{ $jabatan->nama_jabatan }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="edit_gaji_pokok{{ $jabatan->id }}" class="form-label">Gaji Pokok</label>
                                <input type="number" class="form-control" id="edit_gaji_pokok{{ $jabatan->id }}"
                                    name="gaji_pokok" value="{{ $jabatan->gaji_pokok }}" min="0" required>
                            </div>
                            <div class="mb-3">
                                <label for="edit_tunjangan_jabatan{{ $jabatan->id }}" class="form-label">Tunjangan
                                    Jabatan</label>
                                <input type="number" class="form-control"
                                    id="edit_tunjangan_jabatan{{ $jabatan->id }}" name="tunjangan_jabatan"
                                    value="{{ $jabatan->tunjangan_jabatan }}" min="0">
                            </div>
                            <div class="mb-3">
                                <label for="edit_tunjangan_kehadiran{{ $jabatan->id }}" class="form-label">Bonus
                                    Kehadiran per Hari</label>
                                <input type="number" class="form-control"
                                    id="edit_tunjangan_kehadiran{{ $jabatan->id }}" name="bonus_kehadiran_per_hari"
                                    value="{{ $jabatan->bonus_kehadiran_per_hari }}" min="0">
                            </div>
                            <div class="mb-3">
                                <label for="edit_minimal_hari_kerja{{ $jabatan->id }}" class="form-label">Minimal Hari
                                    Kerja</label>
                                <input type="number" class="form-control"
                                    id="edit_minimal_hari_kerja{{ $jabatan->id }}" name="minimal_hari_kerja"
                                    value="{{ $jabatan->minimal_hari_kerja }}" min="1" max="31">
                            </div>
                            <div class="mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="edit_status{{ $jabatan->id }}"
                                        name="status" value="1" {{ $jabatan->status ? 'checked' : '' }}>
                                    <label class="form-check-label" for="edit_status{{ $jabatan->id }}">
                                        Status Aktif
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

@endsection

@push('scripts')
    <script>
        // Auto dismiss alerts after 5 seconds
        setTimeout(function() {
            $('.alert').fadeOut('slow');
        }, 5000);
    </script>
@endpush
