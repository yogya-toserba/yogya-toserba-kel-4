@extends('supplier.layout')

@section('title', 'Dashboard Supplier')
@section('page-title', 'Dashboard')

@section('content')
<div class="row">
    <!-- Info Cards -->
    <div class="col-md-4 mb-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body text-center">
                <i class="fas fa-comments fa-3x text-primary mb-3"></i>
                <h5>Total Chat Rooms</h5>
                <h3 class="text-primary">{{ $chatRooms->count() }}</h3>
            </div>
        </div>
    </div>
    
    <div class="col-md-4 mb-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body text-center">
                <i class="fas fa-envelope fa-3x text-warning mb-3"></i>
                <h5>Pesan Belum Dibaca</h5>
                <h3 class="text-warning">{{ $unreadCount }}</h3>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body text-center">
                <i class="fas fa-building fa-3x text-success mb-3"></i>
                <h5>Perusahaan</h5>
                <h6 class="text-success">{{ $supplier->pemasok->nama_perusahaan ?? 'N/A' }}</h6>
            </div>
        </div>
    </div>
</div>

<!-- Informasi Supplier -->
<div class="row mb-4">
    <div class="col-md-6">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="fas fa-user"></i> Informasi Supplier</h5>
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <td><strong>Nama Lengkap:</strong></td>
                        <td>{{ $supplier->nama_lengkap }}</td>
                    </tr>
                    <tr>
                        <td><strong>Email:</strong></td>
                        <td>{{ $supplier->email }}</td>
                    </tr>
                    <tr>
                        <td><strong>Telepon:</strong></td>
                        <td>{{ $supplier->telepon ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td><strong>Perusahaan:</strong></td>
                        <td>{{ $supplier->pemasok->nama_perusahaan ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td><strong>Status:</strong></td>
                        <td>
                            <span class="badge bg-{{ $supplier->status === 'aktif' ? 'success' : 'danger' }}">
                                {{ ucfirst($supplier->status) }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Login Terakhir:</strong></td>
                        <td>{{ $supplier->last_login ? $supplier->last_login->format('d/m/Y H:i') : 'Belum pernah' }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-info text-white">
                <h5 class="mb-0"><i class="fas fa-building"></i> Informasi Perusahaan</h5>
            </div>
            <div class="card-body">
                @if($supplier->pemasok)
                <table class="table table-borderless">
                    <tr>
                        <td><strong>Nama Perusahaan:</strong></td>
                        <td>{{ $supplier->pemasok->nama_perusahaan }}</td>
                    </tr>
                    <tr>
                        <td><strong>Kontak Person:</strong></td>
                        <td>{{ $supplier->pemasok->kontak_person }}</td>
                    </tr>
                    <tr>
                        <td><strong>Kategori Produk:</strong></td>
                        <td>{{ $supplier->pemasok->kategori_produk }}</td>
                    </tr>
                    <tr>
                        <td><strong>Kota:</strong></td>
                        <td>{{ $supplier->pemasok->kota }}</td>
                    </tr>
                    <tr>
                        <td><strong>Rating:</strong></td>
                        <td>
                            @for($i = 1; $i <= 5; $i++)
                                <i class="fas fa-star {{ $i <= ($supplier->pemasok->rating ?? 0) ? 'text-warning' : 'text-muted' }}"></i>
                            @endfor
                            ({{ $supplier->pemasok->rating ?? 0 }}/5)
                        </td>
                    </tr>
                </table>
                @else
                <p class="text-muted">Informasi perusahaan tidak tersedia.</p>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Chat Rooms -->
<div class="card border-0 shadow-sm">
    <div class="card-header bg-success text-white">
        <h5 class="mb-0"><i class="fas fa-comments"></i> Chat Rooms</h5>
    </div>
    <div class="card-body">
        @if($chatRooms->count() > 0)
            <div class="row">
                @foreach($chatRooms as $room)
                <div class="col-md-6 mb-3">
                    <div class="card border-start border-primary border-3">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <h6 class="card-title mb-0">{{ $room->nama_room }}</h6>
                                @if($room->unreadMessagesCount('pemasok', $supplier->id) > 0)
                                    <span class="unread-badge">{{ $room->unreadMessagesCount('pemasok', $supplier->id) }}</span>
                                @endif
                            </div>
                            
                            @if($room->deskripsi)
                                <p class="card-text text-muted small">{{ Str::limit($room->deskripsi, 100) }}</p>
                            @endif
                            
                            @if($room->lastMessage)
                                <div class="mb-2">
                                    <small class="text-muted">
                                        <strong>{{ $room->lastMessage->sender_name }}:</strong>
                                        {{ Str::limit($room->lastMessage->message, 50) }}
                                    </small>
                                </div>
                                <small class="text-muted">
                                    {{ $room->lastMessage->created_at->diffForHumans() }}
                                </small>
                            @else
                                <small class="text-muted">Belum ada pesan</small>
                            @endif
                            
                            <div class="mt-3">
                                <a href="{{ route('supplier.chat.show', $room->id) }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-comment"></i> Buka Chat
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-4">
                <i class="fas fa-comments fa-4x text-muted mb-3"></i>
                <h5 class="text-muted">Belum Ada Chat Room</h5>
                <p class="text-muted">Chat room akan dibuat otomatis ketika admin/gudang memulai komunikasi dengan Anda.</p>
            </div>
        @endif
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Auto refresh untuk update unread count
    setInterval(function() {
        // Refresh halaman setiap 30 detik untuk update data real-time
        // Anda bisa mengubah ini menjadi AJAX request untuk performa yang lebih baik
        // window.location.reload();
    }, 30000);
</script>
@endpush
