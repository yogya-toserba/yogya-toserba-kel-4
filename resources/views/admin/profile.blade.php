@extends('layouts.navbar_admin')

@section('title', 'Profil Admin')

@section('content')
<div class="container-fluid">
  <div class="row g-4">
    <div class="col-lg-4">
      <div class="card shadow-sm">
        <div class="card-body text-center">
          <div class="mb-3">
            <i class="fas fa-user-circle" style="font-size: 88px; color: #16a34a"></i>
          </div>
          <h5 class="mb-1">{{ $admin->name }}</h5>
          <div class="text-muted small">{{ $admin->email }}</div>
        </div>
      </div>
    </div>
    <div class="col-lg-8">
      <div class="card shadow-sm">
        <div class="card-body">
          <h5 class="mb-3">Update Profil</h5>
          <form method="POST" action="{{ route('admin.profile.update') }}">
            @csrf
            <div class="mb-3">
              <label class="form-label">Nama</label>
              <input type="text" name="name" class="form-control" value="{{ old('name', $admin->name) }}" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Email</label>
              <input type="email" name="email" class="form-control" value="{{ old('email', $admin->email) }}" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Password (opsional)</label>
              <input type="password" name="password" class="form-control" placeholder="Minimal 8 karakter">
            </div>
            <div class="mb-3">
              <label class="form-label">Konfirmasi Password</label>
              <input type="password" name="password_confirmation" class="form-control" placeholder="Ulangi password">
            </div>
            <div class="d-flex gap-2">
              <button class="btn btn-success" type="submit"><i class="fas fa-save me-2"></i>Simpan</button>
              <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary">Batal</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
