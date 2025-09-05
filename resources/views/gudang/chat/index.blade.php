@extends('layouts.appGudang')

@section('title', 'Chat dengan Supplier')

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="fas fa-comments"></i> Daftar Chat Rooms</h5>
            </div>
            <div class="card-body">
                @if($chatRooms->count() > 0)
                    <div class="row">
                        @foreach($chatRooms as $room)
                        <div class="col-md-6 mb-3">
                            <div class="card border-start border-primary border-3 h-100">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <h6 class="card-title mb-0">{{ $room->nama_room }}</h6>
                                        @if($room->unreadMessagesCount('gudang', $gudang->id_gudang) > 0)
                                            <span class="badge bg-danger">{{ $room->unreadMessagesCount('gudang', $gudang->id_gudang) }}</span>
                                        @endif
                                    </div>
                                    
                                    <div class="mb-2">
                                        <small class="text-muted">
                                            <i class="fas fa-building"></i> {{ $room->pemasok->nama_perusahaan }}
                                        </small>
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
                                        <a href="{{ route('gudang.chat.show', $room->id) }}" class="btn btn-primary btn-sm">
                                            <i class="fas fa-comment"></i> Buka Chat
                                        </a>
                                        <a href="{{ route('gudang.chat.request-product', $room->id) }}" class="btn btn-success btn-sm">
                                            <i class="fas fa-box"></i> Request Produk
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="fas fa-comments fa-4x text-muted mb-3"></i>
                        <h5 class="text-muted">Belum Ada Chat Room</h5>
                        <p class="text-muted">Chat room akan dibuat otomatis ketika Anda menambahkan pemasok baru.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <!-- Quick Stats -->
        <div class="card mb-3">
            <div class="card-header bg-info text-white">
                <h6 class="mb-0"><i class="fas fa-chart-bar"></i> Statistik Chat</h6>
            </div>
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-6">
                        <h4 class="text-primary">{{ $chatRooms->count() }}</h4>
                        <small class="text-muted">Total Rooms</small>
                    </div>
                    <div class="col-6">
                        <h4 class="text-danger">
                            {{ $chatRooms->sum(function($room) use ($gudang) { 
                                return $room->unreadMessagesCount('gudang', $gudang->id_gudang); 
                            }) }}
                        </h4>
                        <small class="text-muted">Unread Messages</small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Create New Chat Room -->
        <div class="card">
            <div class="card-header bg-success text-white">
                <h6 class="mb-0"><i class="fas fa-plus"></i> Buat Chat Room Baru</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('gudang.chat.create') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="pemasok_id" class="form-label">Pilih Pemasok</label>
                        <select class="form-select" name="pemasok_id" id="pemasok_id" required>
                            <option value="">Pilih Pemasok...</option>
                            @foreach(\App\Models\Pemasok::where('status', 'aktif')->get() as $pemasok)
                                <option value="{{ $pemasok->id_pemasok }}">{{ $pemasok->nama_perusahaan }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label for="nama_room" class="form-label">Nama Room</label>
                        <input type="text" class="form-control" name="nama_room" id="nama_room" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <textarea class="form-control" name="deskripsi" id="deskripsi" rows="3"></textarea>
                    </div>
                    
                    <div class="d-grid">
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-plus"></i> Buat Room
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // Auto-generate room name based on selected pemasok
        $('#pemasok_id').on('change', function() {
            const selectedOption = $(this).find('option:selected');
            if (selectedOption.val()) {
                const pemasokName = selectedOption.text();
                $('#nama_room').val('Chat dengan ' + pemasokName);
            } else {
                $('#nama_room').val('');
            }
        });

        // Auto refresh untuk update unread count
        setInterval(function() {
            // location.reload();
        }, 30000);
    });
</script>
@endpush
