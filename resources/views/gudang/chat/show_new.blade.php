@extends('layouts.appGudang')

@section('title', 'Chat - ' . $chatRoom->nama_room)

@push('meta')
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
@endpush

@push('head')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@section('content')
<style>
/* Modern Chat Show Styles */
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

/* Chat Container */
.chat-container {
    height: 500px;
    overflow-y: auto;
    padding: 20px;
    background: #f8fafc;
    scrollbar-width: thin;
    scrollbar-color: #f26b37 #e2e8f0;
}

body.dark-mode .chat-container {
    background: #1e2139;
}

.chat-container::-webkit-scrollbar {
    width: 6px;
}

.chat-container::-webkit-scrollbar-track {
    background: #e2e8f0;
    border-radius: 3px;
}

.chat-container::-webkit-scrollbar-thumb {
    background: #f26b37;
    border-radius: 3px;
}

.chat-container::-webkit-scrollbar-thumb:hover {
    background: #e55827;
}

/* Message Bubbles */
.message-bubble {
    max-width: 80%;
    margin-bottom: 20px;
    animation: slideIn 0.3s ease;
}

.message-sent {
    margin-left: auto;
    background: linear-gradient(135deg, #f26b37, #e55827);
    color: white;
    border-radius: 18px 18px 4px 18px;
}

.message-received {
    margin-right: auto;
    background: white;
    color: #374151;
    border-radius: 18px 18px 18px 4px;
    border: 1px solid #e2e8f0;
}

body.dark-mode .message-received {
    background: #2a2d3f;
    color: #e2e8f0;
    border-color: #3a3d4a;
}

.message-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 8px;
    opacity: 0.8;
}

.sender-name {
    font-weight: 600;
    font-size: 0.9rem;
}

.message-time {
    font-size: 0.75rem;
    opacity: 0.7;
}

.message-content {
    line-height: 1.5;
    word-wrap: break-word;
}

.product-request-badge {
    background: rgba(251, 191, 36, 0.2);
    color: #d97706;
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 600;
    margin-bottom: 10px;
    display: inline-block;
}

body.dark-mode .product-request-badge {
    background: rgba(217, 119, 6, 0.3);
    color: #fbbf24;
}

.product-details {
    background: rgba(242, 107, 55, 0.05);
    border: 1px solid rgba(242, 107, 55, 0.2);
    border-radius: 8px;
    padding: 15px;
    margin-top: 10px;
}

body.dark-mode .product-details {
    background: rgba(242, 107, 55, 0.1);
    border-color: rgba(242, 107, 55, 0.3);
}

.product-details h6 {
    color: #f26b37;
    margin-bottom: 12px;
}

.product-detail-item {
    margin-bottom: 8px;
}

.product-detail-label {
    color: #64748b;
    font-size: 0.8rem;
    margin-bottom: 2px;
}

body.dark-mode .product-detail-label {
    color: #94a3b8;
}

.product-detail-value {
    font-weight: 600;
    color: #1e293b;
}

body.dark-mode .product-detail-value {
    color: #e2e8f0;
}

.read-indicator {
    text-align: right;
    margin-top: 8px;
    font-size: 0.75rem;
    color: #10b981;
}

/* Message Input */
.message-input-section {
    background: white;
    padding: 20px;
    border-top: 1px solid #e2e8f0;
}

body.dark-mode .message-input-section {
    background: #2a2d3f;
    border-top-color: #3a3d4a;
}

.message-input {
    border: 2px solid #e2e8f0;
    border-radius: 12px;
    padding: 12px 16px;
    resize: none;
    transition: all 0.3s ease;
}

.message-input:focus {
    border-color: #f26b37;
    box-shadow: 0 0 0 3px rgba(242, 107, 55, 0.1);
}

body.dark-mode .message-input {
    background: #252837;
    border-color: #3a3d4a;
    color: #e2e8f0;
}

.no-messages-state {
    text-align: center;
    padding: 60px 20px;
    color: #64748b;
}

body.dark-mode .no-messages-state {
    color: #94a3b8;
}

.no-messages-icon {
    font-size: 4rem;
    color: #e2e8f0;
    margin-bottom: 20px;
}

body.dark-mode .no-messages-icon {
    color: #3a3d4a;
}

.info-card {
    background: white;
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    border: 1px solid #e2e8f0;
    overflow: hidden;
}

body.dark-mode .info-card {
    background: #2a2d3f;
    border-color: #3a3d4a;
}

.info-card-header {
    background: #f8fafc;
    padding: 15px 20px;
    border-bottom: 1px solid #e2e8f0;
}

body.dark-mode .info-card-header {
    background: #252837;
    border-bottom-color: #3a3d4a;
}

.info-card-body {
    padding: 20px;
}

.info-table {
    margin: 0;
}

.info-table td {
    padding: 8px 0;
    border: none;
    border-bottom: 1px solid #f1f5f9;
}

body.dark-mode .info-table td {
    border-bottom-color: #3a3d4a;
    color: #e2e8f0;
}

.info-table td:first-child {
    font-weight: 600;
    color: #64748b;
    width: 30%;
}

body.dark-mode .info-table td:first-child {
    color: #94a3b8;
}

@keyframes slideIn {
    from {
        opacity: 0;
        transform: translateY(10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@media (max-width: 768px) {
    .message-bubble {
        max-width: 95%;
    }
    
    .chat-container {
        height: 400px;
    }
}
</style>

<div class="permintaan-container">
    <!-- Header Section -->
    <div class="permintaan-header">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h2>{{ $chatRoom->nama_room }}</h2>
                <p>
                    <i class="fas fa-building"></i> {{ $chatRoom->pemasok->nama_perusahaan }}
                    @if($chatRoom->deskripsi)
                        • {{ $chatRoom->deskripsi }}
                    @endif
                </p>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('gudang.chat.request-product', $chatRoom->id) }}" class="btn btn-outline-modern">
                    <i class="fas fa-box"></i> Request Produk
                </a>
                <a href="{{ route('gudang.chat.index') }}" class="btn btn-outline-modern">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Chat Messages -->
        <div class="col-lg-8">
            <div class="modern-card">
                <div class="card-header-modern">
                    <h5 class="card-title-modern">
                        <i class="fas fa-comments" style="color: #f26b37; margin-right: 10px;"></i>
                        Percakapan
                    </h5>
                    <div class="d-flex gap-2">
                        <button class="btn btn-outline-modern btn-sm" onclick="scrollToBottom()">
                            <i class="fas fa-arrow-down"></i>
                            Scroll Bawah
                        </button>
                        <button class="btn btn-modern btn-sm" onclick="location.reload()">
                            <i class="fas fa-sync-alt"></i>
                            Refresh
                        </button>
                    </div>
                </div>
                
                <!-- Chat Container -->
                <div class="chat-container" id="chatContainer">
                    @forelse($chatRoom->messages as $message)
                        <div class="message-bubble {{ $message->sender_type === 'gudang' ? 'message-sent' : 'message-received' }}">
                            <div class="message-header">
                                <span class="sender-name">
                                    @if($message->sender_type === 'gudang')
                                        <i class="fas fa-warehouse"></i> {{ $message->sender_name }}
                                    @elseif($message->sender_type === 'pemasok')
                                        <i class="fas fa-truck"></i> {{ $message->sender_name }}
                                    @else
                                        <i class="fas fa-user"></i> {{ $message->sender_name }}
                                    @endif
                                </span>
                                <span class="message-time">
                                    {{ $message->created_at->format('d/m/Y H:i') }}
                                </span>
                            </div>
                            
                            @if($message->message_type === 'product_request')
                                <div class="product-request-badge">
                                    <i class="fas fa-box"></i> REQUEST PRODUK
                                </div>
                            @endif
                            
                            <div class="message-content">{!! nl2br(e($message->message)) !!}</div>
                            
                            @if($message->product_data)
                                <div class="product-details">
                                    <h6><i class="fas fa-info-circle"></i> Detail Produk</h6>
                                    <div class="row">
                                        @foreach($message->product_data as $key => $value)
                                            @if($value)
                                                <div class="col-md-6 product-detail-item">
                                                    <div class="product-detail-label">{{ ucwords(str_replace('_', ' ', $key)) }}</div>
                                                    <div class="product-detail-value">{{ $value }}</div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                            
                            @if($message->is_read && $message->sender_type === 'gudang')
                                <div class="read-indicator">
                                    <i class="fas fa-check-double"></i> Dibaca
                                </div>
                            @endif
                        </div>
                    @empty
                        <div class="no-messages-state">
                            <i class="fas fa-comment no-messages-icon"></i>
                            <h5>Belum ada pesan</h5>
                            <p>Mulai percakapan dengan mengirim pesan atau request produk!</p>
                        </div>
                    @endforelse
                </div>
                
                <!-- Message Input -->
                <div class="message-input-section">
                    <form id="messageForm" action="{{ route('gudang.chat.message', $chatRoom->id) }}" method="POST" onsubmit="return false;">
                        @csrf
                        <div class="input-group">
                            <textarea class="form-control message-input" name="message" id="messageInput" 
                                    placeholder="Ketik pesan Anda..." rows="2" required></textarea>
                            <button type="button" id="sendBtn" class="btn btn-modern">
                                <i class="fas fa-paper-plane"></i>
                                Kirim
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Chat Info Sidebar -->
        <div class="col-lg-4">
            <div class="info-card">
                <div class="info-card-header">
                    <h6 class="mb-0">
                        <i class="fas fa-info-circle" style="color: #f26b37; margin-right: 10px;"></i>
                        Informasi Chat
                    </h6>
                </div>
                <div class="info-card-body">
                    <table class="info-table table">
                        <tr>
                            <td>Nama Room</td>
                            <td>{{ $chatRoom->nama_room }}</td>
                        </tr>
                        @if($chatRoom->deskripsi)
                        <tr>
                            <td>Deskripsi</td>
                            <td>{{ $chatRoom->deskripsi }}</td>
                        </tr>
                        @endif
                        <tr>
                            <td>Status</td>
                            <td>
                                <span class="badge bg-{{ $chatRoom->status === 'aktif' ? 'success' : 'danger' }}">
                                    {{ ucfirst($chatRoom->status) }}
                                </span>
                            </td>
                        </tr>
                        @if($chatRoom->admin)
                        <tr>
                            <td>Admin</td>
                            <td>{{ $chatRoom->admin->name }}</td>
                        </tr>
                        @endif
                        @if($chatRoom->gudang)
                        <tr>
                            <td>Gudang</td>
                            <td>{{ $chatRoom->gudang->nama_gudang }}</td>
                        </tr>
                        @endif
                        <tr>
                            <td>Pemasok</td>
                            <td>{{ $chatRoom->pemasok->nama_perusahaan }}</td>
                        </tr>
                        <tr>
                            <td>Total Pesan</td>
                            <td>{{ $chatRoom->messages->count() }}</td>
                        </tr>
                        <tr>
                            <td>Dibuat</td>
                            <td>{{ $chatRoom->created_at->format('d/m/Y H:i') }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="info-card mt-4">
                <div class="info-card-header">
                    <h6 class="mb-0">
                        <i class="fas fa-bolt" style="color: #f26b37; margin-right: 10px;"></i>
                        Quick Actions
                    </h6>
                </div>
                <div class="info-card-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('gudang.chat.request-product', $chatRoom->id) }}" class="btn btn-modern">
                            <i class="fas fa-box"></i>
                            Request Produk Baru
                        </a>
                        <button class="btn btn-outline-modern" onclick="clearMessages()">
                            <i class="fas fa-eraser"></i>
                            Clear Messages
                        </button>
                        <button class="btn btn-outline-modern" onclick="exportChat()">
                            <i class="fas fa-download"></i>
                            Export Chat
                        </button>
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
    // Auto-scroll to bottom when page loads
    scrollToBottom();
    
    // Handle form submission
    $('#sendBtn').on('click', function() {
        sendMessage();
    });
    
    // Handle Enter key (Shift+Enter for new line)
    $('#messageInput').on('keydown', function(e) {
        if (e.key === 'Enter' && !e.shiftKey) {
            e.preventDefault();
            sendMessage();
        }
    });
    
    // Send message function
    function sendMessage() {
        const message = $('#messageInput').val().trim();
        if (!message) return;
        
        const $sendBtn = $('#sendBtn');
        const originalText = $sendBtn.html();
        
        // Show loading
        $sendBtn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Mengirim...');
        
        $.ajax({
            url: $('#messageForm').attr('action'),
            method: 'POST',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                message: message
            },
            success: function(response) {
                if (response.success) {
                    // Clear input
                    $('#messageInput').val('');
                    
                    // Add new message to chat
                    appendMessage(response.message);
                    
                    // Scroll to bottom
                    scrollToBottom();
                } else {
                    alert('Gagal mengirim pesan: ' + response.message);
                }
            },
            error: function(xhr) {
                console.error('Error:', xhr);
                alert('Terjadi kesalahan saat mengirim pesan.');
            },
            complete: function() {
                // Restore button
                $sendBtn.prop('disabled', false).html(originalText);
                $('#messageInput').focus();
            }
        });
    }
    
    // Append new message to chat
    function appendMessage(messageData) {
        const messageHtml = `
            <div class="message-bubble message-sent">
                <div class="message-header">
                    <span class="sender-name">
                        <i class="fas fa-warehouse"></i> ${messageData.sender_name}
                    </span>
                    <span class="message-time">
                        ${new Date().toLocaleDateString('id-ID')} ${new Date().toLocaleTimeString('id-ID', {hour: '2-digit', minute: '2-digit'})}
                    </span>
                </div>
                <div class="message-content">${messageData.message.replace(/\n/g, '<br>')}</div>
            </div>
        `;
        
        $('#chatContainer').append(messageHtml);
    }
    
    // Auto-refresh messages every 5 seconds
    setInterval(function() {
        // Only refresh if there are no unread messages
        // You can implement this based on your needs
    }, 5000);
});

// Scroll to bottom function
function scrollToBottom() {
    const chatContainer = document.getElementById('chatContainer');
    chatContainer.scrollTop = chatContainer.scrollHeight;
}

// Clear messages function
function clearMessages() {
    if (confirm('Apakah Anda yakin ingin menghapus semua pesan di chat ini?')) {
        // Implement clear messages functionality
        alert('Fitur ini belum diimplementasikan.');
    }
}

// Export chat function
function exportChat() {
    // Implement export chat functionality
    alert('Fitur export akan segera tersedia.');
}
</script>
@endpush
