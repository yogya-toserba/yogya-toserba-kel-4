@extends('layouts.appGudang')

@section('title', 'Chat dengan Supplier - MyYOGYA')

@push('head')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@section('content')
<style>
/* Modern Chat Styles - Based on Permintaan Layout */
.permintaan-header {
    background: linear-gradient(135deg, #f26b37 0%, #e55827 100%);
    color: white;
    padding: 25px 30px;
    border-radius: 12px;
    margin-bottom: 25px;
    box-shadow: 0 4px 15px rgba(242, 107, 55, 0.3);
}

.permintaan-header h2 {
    font-size: 1.8rem;
    font-weight: 700;
    margin: 0;
}

.permintaan-header p {
    font-size: 1rem;
    opacity: 0.9;
    margin: 8px 0 0 0;
}

.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 20px;
    margin-bottom: 25px;
}

.stat-card {
    background: white;
    padding: 20px;
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    border-left: 4px solid #f26b37;
    transition: transform 0.3s ease;
}

body.dark-mode .stat-card {
    background: #2a2d3f;
    border-left-color: #f26b37;
    color: #e2e8f0;
}

.stat-card:hover {
    transform: translateY(-2px);
}

.stat-number {
    font-size: 1.8rem;
    font-weight: 700;
    color: #f26b37;
    margin-bottom: 5px;
}

.stat-label {
    font-size: 0.9rem;
    color: #64748b;
    font-weight: 500;
}

body.dark-mode .stat-label {
    color: #94a3b8;
}

.modern-card {
    background: white;
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    border: 1px solid #e2e8f0;
    overflow: hidden;
}

body.dark-mode .modern-card {
    background: #2a2d3f;
    border-color: #3a3d4a;
}

.card-header-modern {
    background: #f8fafc;
    padding: 20px 25px;
    border-bottom: 1px solid #e2e8f0;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

body.dark-mode .card-header-modern {
    background: #252837;
    border-bottom-color: #3a3d4a;
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

.btn-modern {
    background: linear-gradient(135deg, #f26b37, #e55827);
    color: white;
    border: none;
    padding: 8px 16px;
    border-radius: 8px;
    font-weight: 500;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    gap: 6px;
}

.btn-modern:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(242, 107, 55, 0.4);
    color: white;
}

.btn-outline-modern {
    background: transparent;
    color: #f26b37;
    border: 2px solid #f26b37;
    padding: 8px 16px;
    border-radius: 8px;
    font-weight: 500;
    transition: all 0.3s ease;
}

.btn-outline-modern:hover {
    background: #f26b37;
    color: white;
}

/* Chat Room Cards - WhatsApp Style */
.chat-room-card {
    background: white;
    border-radius: 8px;
    border: 1px solid #e2e8f0;
    transition: all 0.2s ease;
    overflow: hidden;
    margin-bottom: 8px;
}

body.dark-mode .chat-room-card {
    background: #2a2d3f;
    border-color: #3a3d4a;
}

.chat-room-card:hover {
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    border-color: #f26b37;
}

.chat-room-item {
    display: flex;
    align-items: center;
    padding: 12px 16px;
    text-decoration: none;
    color: inherit;
    border-bottom: 1px solid #f1f5f9;
}

body.dark-mode .chat-room-item {
    border-bottom-color: #3a3d4a;
}

.chat-room-item:last-child {
    border-bottom: none;
}

.chat-room-item:hover {
    background: #f8fafc;
    text-decoration: none;
    color: inherit;
}

body.dark-mode .chat-room-item:hover {
    background: #252837;
}

.chat-avatar {
    width: 48px;
    height: 48px;
    border-radius: 50%;
    background: linear-gradient(135deg, #f26b37, #e55827);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: 600;
    font-size: 18px;
    margin-right: 12px;
    flex-shrink: 0;
}

.chat-content {
    flex: 1;
    min-width: 0;
}

.chat-room-name {
    font-weight: 600;
    font-size: 15px;
    color: #1e293b;
    margin-bottom: 2px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

body.dark-mode .chat-room-name {
    color: #e2e8f0;
}

.chat-company {
    font-size: 13px;
    color: #64748b;
    margin-bottom: 4px;
}

body.dark-mode .chat-company {
    color: #94a3b8;
}

.chat-last-message {
    font-size: 13px;
    color: #64748b;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    max-width: 200px;
}

body.dark-mode .chat-last-message {
    color: #94a3b8;
}

.chat-meta {
    display: flex;
    flex-direction: column;
    align-items: flex-end;
    gap: 4px;
    margin-left: 8px;
}

.chat-time {
    font-size: 11px;
    color: #64748b;
    white-space: nowrap;
}

body.dark-mode .chat-time {
    color: #94a3b8;
}

.unread-badge {
    background: #f26b37;
    color: white;
    border-radius: 50%;
    min-width: 20px;
    height: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 11px;
    font-weight: 600;
}

.quick-actions {
    display: flex;
    gap: 4px;
    margin-top: 4px;
}

.quick-btn {
    background: transparent;
    border: 1px solid #e2e8f0;
    color: #64748b;
    padding: 4px 8px;
    border-radius: 12px;
    font-size: 11px;
    transition: all 0.2s ease;
    text-decoration: none;
}

.quick-btn:hover {
    background: #f26b37;
    color: white;
    border-color: #f26b37;
    text-decoration: none;
}

body.dark-mode .quick-btn {
    border-color: #3a3d4a;
    color: #94a3b8;
}

body.dark-mode .quick-btn:hover {
    background: #f26b37;
    color: white;
    border-color: #f26b37;
}

/* Sidebar Cards with Better Spacing */
.sidebar-card {
    background: white;
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    border: 1px solid #e2e8f0;
    overflow: hidden;
    margin-bottom: 20px;
}

body.dark-mode .sidebar-card {
    background: #2a2d3f;
    border-color: #3a3d4a;
}

.sidebar-card-header {
    background: #f8fafc;
    padding: 16px 20px;
    border-bottom: 1px solid #e2e8f0;
}

body.dark-mode .sidebar-card-header {
    background: #252837;
    border-bottom-color: #3a3d4a;
}

.sidebar-card-title {
    font-size: 14px;
    font-weight: 600;
    color: #1e293b;
    margin: 0;
}

body.dark-mode .sidebar-card-title {
    color: #e2e8f0;
}

.sidebar-card-body {
    padding: 20px;
}

.form-group-spaced {
    margin-bottom: 16px;
}

.form-group-spaced:last-child {
    margin-bottom: 0;
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
}

.form-control-modern:focus {
    border-color: #f26b37;
    box-shadow: 0 0 0 3px rgba(242, 107, 55, 0.1);
}

body.dark-mode .form-control-modern {
    background: #252837;
    border-color: #3a3d4a;
    color: #e2e8f0;
}

.no-data-state {
    text-align: center;
    padding: 60px 20px;
    color: #64748b;
}

body.dark-mode .no-data-state {
    color: #94a3b8;
}

.no-data-icon {
    font-size: 4rem;
    color: #e2e8f0;
    margin-bottom: 20px;
}

body.dark-mode .no-data-icon {
    color: #3a3d4a;
}

@media (max-width: 768px) {
    .stats-grid {
        grid-template-columns: 1fr;
    }
    
    .card-header-modern {
        padding: 15px 20px;
        flex-direction: column;
        gap: 10px;
    }
}
</style>

<div class="permintaan-container">
    <!-- Header Section -->
    <div class="permintaan-header">
        <h2>Chat dengan Supplier</h2>
        <p>Kelola komunikasi dengan pemasok dan supplier MyYOGYA</p>
    </div>

    <!-- Stats Section -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-number">{{ $chatRooms->count() }}</div>
            <div class="stat-label">Total Chat Room</div>
        </div>
        <div class="stat-card">
            <div class="stat-number">
                {{ $chatRooms->sum(function($room) use ($gudang) { 
                    return $room->unreadMessagesCount('gudang', $gudang->id_gudang); 
                }) }}
            </div>
            <div class="stat-label">Pesan Belum Dibaca</div>
        </div>
        <div class="stat-card">
            <div class="stat-number">{{ $chatRooms->where('status', 'aktif')->count() }}</div>
            <div class="stat-label">Room Aktif</div>
        </div>
        <div class="stat-card">
            <div class="stat-number">
                {{ $chatRooms->filter(function($room) {
                    return $room->lastMessage && $room->lastMessage->created_at->isToday();
                })->count() }}
            </div>
            <div class="stat-label">Aktif Hari Ini</div>
        </div>
    </div>

    <div class="row">
        <!-- Chat Rooms List -->
        <div class="col-lg-8">
            <div class="modern-card">
                <div class="card-header-modern">
                    <h5 class="card-title-modern">
                        <i class="fas fa-comments" style="color: #f26b37; margin-right: 10px;"></i>
                        Daftar Chat Room
                    </h5>
                    <div class="d-flex gap-2">
                        <button class="btn btn-modern" onclick="location.reload()">
                            <i class="fas fa-sync-alt"></i>
                            Refresh
                        </button>
                    </div>
                </div>
                <div class="card-body p-0">
                    @if($chatRooms->count() > 0)
                        @foreach($chatRooms as $room)
                            <div class="chat-room-item d-flex align-items-center">
                                <div class="chat-avatar">
                                    {{ strtoupper(substr($room->pemasok->nama_perusahaan, 0, 2)) }}
                                </div>
                                <div class="chat-content">
                                    <div class="chat-room-name">{{ $room->nama_room }}</div>
                                    <div class="chat-company">
                                        <i class="fas fa-building me-1"></i> {{ $room->pemasok->nama_perusahaan }}
                                    </div>
                                    @if($room->lastMessage)
                                        <div class="chat-last-message">
                                            <strong>{{ $room->lastMessage->sender_name }}:</strong>
                                            {{ Str::limit($room->lastMessage->message, 40) }}
                                        </div>
                                    @else
                                        <div class="chat-last-message">Belum ada pesan</div>
                                    @endif
                                    <div class="quick-actions mt-2">
                                        <a href="{{ route('gudang.chat.show', $room->id) }}" class="quick-btn">
                                            <i class="fas fa-comment me-1"></i>Chat
                                        </a>
                                        <a href="{{ route('gudang.chat.request-product', $room->id) }}" class="quick-btn">
                                            <i class="fas fa-box me-1"></i>Request
                                        </a>
                                        <button class="quick-btn" onclick="sendQuickMessage({{ $room->id }}, 'Halo, saya butuh informasi produk')">
                                            <i class="fas fa-bolt me-1"></i>Quick
                                        </button>
                                    </div>
                                </div>
                                <div class="chat-meta">
                                    @if($room->lastMessage)
                                        <div class="chat-time">{{ $room->lastMessage->created_at->format('H:i') }}</div>
                                    @endif
                                    @if($room->unreadMessagesCount('gudang', $gudang->id_gudang) > 0)
                                        <div class="unread-badge">
                                            {{ $room->unreadMessagesCount('gudang', $gudang->id_gudang) }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="no-data-state">
                            <i class="fas fa-comments no-data-icon"></i>
                            <h5>Belum Ada Chat Room</h5>
                            <p>Chat room akan dibuat otomatis ketika Anda menambahkan pemasok baru.</p>
                            <a href="{{ route('gudang.pemasok.index') }}" class="btn btn-modern">
                                <i class="fas fa-plus"></i>
                                Kelola Pemasok
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Create Chat Room Sidebar -->
        <div class="col-lg-4">
            <div class="sidebar-card">
                <div class="sidebar-card-header">
                    <h6 class="sidebar-card-title">
                        <i class="fas fa-plus" style="color: #f26b37; margin-right: 8px;"></i>
                        Buat Chat Room Baru
                    </h6>
                </div>
                <div class="sidebar-card-body">
                    <form action="{{ route('gudang.chat.create') }}" method="POST">
                        @csrf
                        <div class="form-group-spaced">
                            <label for="pemasok_id" class="form-label-modern">Pilih Pemasok</label>
                            <select class="form-control form-control-modern" name="pemasok_id" id="pemasok_id" required>
                                <option value="">Pilih Pemasok...</option>
                                @foreach(\App\Models\Pemasok::where('status', 'aktif')->get() as $pemasok)
                                    <option value="{{ $pemasok->id_pemasok }}">{{ $pemasok->nama_perusahaan }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="form-group-spaced">
                            <label for="nama_room" class="form-label-modern">Nama Room</label>
                            <input type="text" class="form-control form-control-modern" name="nama_room" id="nama_room" required>
                        </div>
                        
                        <div class="form-group-spaced">
                            <label for="deskripsi" class="form-label-modern">Deskripsi</label>
                            <textarea class="form-control form-control-modern" name="deskripsi" id="deskripsi" rows="3"></textarea>
                        </div>
                        
                        <button type="submit" class="btn btn-modern w-100">
                            <i class="fas fa-plus"></i>
                            Buat Room
                        </button>
                    </form>
                </div>
            </div>

            <!-- Quick Stats Card -->
            <div class="sidebar-card">
                <div class="sidebar-card-header">
                    <h6 class="sidebar-card-title">
                        <i class="fas fa-chart-bar" style="color: #f26b37; margin-right: 8px;"></i>
                        Aktivitas Chat
                    </h6>
                </div>
                <div class="sidebar-card-body">
                    <div class="row text-center">
                        <div class="col-12 mb-3">
                            <div class="stat-number" style="font-size: 1.5rem;">
                                {{ $chatRooms->count() }}
                            </div>
                            <div class="stat-label">Total Chat Room</div>
                        </div>
                        <div class="col-6">
                            <div class="stat-number" style="font-size: 1.2rem; color: #dc2626;">
                                {{ $chatRooms->sum(function($room) use ($gudang) { 
                                    return $room->unreadMessagesCount('gudang', $gudang->id_gudang); 
                                }) }}
                            </div>
                            <div class="stat-label">Unread</div>
                        </div>
                        <div class="col-6">
                            <div class="stat-number" style="font-size: 1.2rem; color: #16a34a;">
                                {{ $chatRooms->where('status', 'aktif')->count() }}
                            </div>
                            <div class="stat-label">Aktif</div>
                        </div>
                    </div>
                </div>
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

        // Auto refresh untuk update unread count setiap 30 detik
        setInterval(function() {
            // Uncomment jika ingin auto refresh
            // location.reload();
        }, 30000);
    });

    // Quick message function
    function sendQuickMessage(roomId, message) {
        if (confirm('Kirim pesan: "' + message + '"?')) {
            const csrfToken = $('meta[name="csrf-token"]').attr('content');
            
            $.ajax({
                url: '/gudang/chat/' + roomId + '/message',
                method: 'POST',
                data: {
                    _token: csrfToken,
                    message: message
                },
                success: function(response) {
                    if (response.success) {
                        // Show success notification
                        showNotification('Pesan berhasil dikirim!', 'success');
                        
                        // Redirect to chat room
                        setTimeout(function() {
                            window.location.href = '/gudang/chat/' + roomId;
                        }, 1000);
                    } else {
                        showNotification('Gagal mengirim pesan: ' + response.message, 'error');
                    }
                },
                error: function(xhr) {
                    console.error('Error:', xhr);
                    showNotification('Terjadi kesalahan saat mengirim pesan.', 'error');
                }
            });
        }
    }

    // Simple notification function
    function showNotification(message, type) {
        const alertClass = type === 'success' ? 'alert-success' : 'alert-danger';
        const notification = `
            <div class="alert ${alertClass} alert-dismissible fade show position-fixed" 
                 style="top: 20px; right: 20px; z-index: 9999; min-width: 300px;" role="alert">
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        `;
        
        $('body').append(notification);
        
        // Auto remove after 3 seconds
        setTimeout(function() {
            $('.alert').fadeOut();
        }, 3000);
    }
</script>
@endpush
