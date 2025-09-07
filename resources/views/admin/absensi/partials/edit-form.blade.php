<form id="editAbsensiForm" method="POST">
    @csrf
    @method('PUT')

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h6 class="card-title mb-0">Data Karyawan</h6>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Nama Karyawan</label>
                        <input type="text" class="form-control" value="{{ $absensi->karyawan->nama ?? 'N/A' }}"
                            readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">ID Karyawan</label>
                        <input type="text" class="form-control"
                            value="{{ $absensi->karyawan->id_karyawan ?? 'N/A' }}" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Tanggal</label>
                        <input type="text" class="form-control"
                            value="{{ \Carbon\Carbon::parse($absensi->tanggal)->format('d F Y') }}" readonly>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h6 class="card-title mb-0">Edit Data Absensi</h6>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="jam_masuk" class="form-label">Jam Masuk</label>
                        <input type="time" class="form-control" id="jam_masuk" name="jam_masuk"
                            value="{{ $absensi->jam_masuk }}">
                    </div>

                    <div class="mb-3">
                        <label for="jam_keluar" class="form-label">Jam Keluar</label>
                        <input type="time" class="form-control" id="jam_keluar" name="jam_keluar"
                            value="{{ $absensi->jam_keluar }}">
                    </div>

                    <div class="mb-3">
                        <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                        <select class="form-select" id="status" name="status" required>
                            <option value="hadir" {{ $absensi->status == 'hadir' ? 'selected' : '' }}>Hadir</option>
                            <option value="terlambat" {{ $absensi->status == 'terlambat' ? 'selected' : '' }}>Terlambat
                            </option>
                            <option value="alpha" {{ $absensi->status == 'alpha' ? 'selected' : '' }}>Alpha</option>
                            <option value="izin" {{ $absensi->status == 'izin' ? 'selected' : '' }}>Izin</option>
                            <option value="sakit" {{ $absensi->status == 'sakit' ? 'selected' : '' }}>Sakit</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="keterangan" class="form-label">Keterangan</label>
                        <textarea class="form-control" id="keterangan" name="keterangan" rows="3"
                            placeholder="Masukkan keterangan (opsional)">{{ $absensi->keterangan }}</textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-12">
            <div class="d-flex justify-content-end gap-2">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-1"></i>
                    Batal
                </button>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-1"></i>
                    Simpan Perubahan
                </button>
            </div>
        </div>
    </div>
</form>
