@extends('supplier.layout')

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
/* Fixed Layout - No Page Scroll */
.chat-page-container {
    height: calc(100vh - 120px);
    overflow: hidden;
    display: flex;
    flex-direction: column;
    margin: 20px 0;
    border-radius: 12px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.1);
    background: white;
}

body.dark-mode .chat-page-container {
    background: #2a2d3f;
}

/* Chat Header Styling */
.chat-header-main {
    background: linear-gradient(135deg, #f26b37 0%, #e55827 100%);
    color: white;
    padding: 20px 25px;
    border-radius: 12px 12px 0 0;
    box-shadow: 0 2px 8px rgba(242, 107, 55, 0.3);
    flex-shrink: 0;
}

.chat-header-main h1 {
    font-size: 1.8rem;
    font-weight: 700;
    margin: 0 0 5px 0;
    color: white;
}

.chat-header-main .chat-subtitle {
    font-size: 0.95rem;
    opacity: 0.9;
    margin: 0;
    color: rgba(255,255,255,0.9);
}

/* Header Buttons Styling - Modern Glassmorphism */
.chat-header-buttons .btn {
    border-radius: 20px;
    padding: 8px 16px;
    font-weight: 500;
    font-size: 0.85rem;
    transition: all 0.3s ease;
    backdrop-filter: blur(10px);
    text-decoration: none;
    border: 1px solid rgba(255, 255, 255, 0.3);
}

/* Modern Back Button */
.btn-back-modern {
    background: rgba(255, 255, 255, 0.2) !important;
    border: 1px solid rgba(255, 255, 255, 0.3) !important;
    color: white !important;
    border-radius: 20px !important;
    font-weight: 500 !important;
    transition: all 0.3s ease !important;
    backdrop-filter: blur(10px);
}

.btn-back-modern:hover {
    background: rgba(255, 255, 255, 0.3) !important;
    border-color: rgba(255, 255, 255, 0.5) !important;
    color: white !important;
    transform: translateY(-1px);
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
}

.btn-back-modern:focus,
.btn-back-modern:active {
    background: rgba(255, 255, 255, 0.25) !important;
    border-color: rgba(255, 255, 255, 0.4) !important;
    color: white !important;
    box-shadow: 0 0 0 0.2rem rgba(255, 255, 255, 0.25);
}

.chat-content-wrapper {
    flex: 1;
    display: flex;
    overflow: hidden;
}

.chat-main {
    flex: 1;
    display: flex;
    flex-direction: column;
    overflow: hidden;
}

.chat-sidebar {
    width: 320px;
    flex-shrink: 0;
    overflow: visible;
    background: #f8fafc;
    border-left: 1px solid #e2e8f0;
    padding: 15px;
    display: flex;
    flex-direction: column;
    justify-content: flex-start;
}

body.dark-mode .chat-sidebar {
    background: #1e2139;
    border-left-color: #3a3d4a;
}

.modern-card {
    background: white;
    border-radius: 0;
    box-shadow: none;
    border: none;
    height: 100%;
    display: flex;
    flex-direction: column;
}

body.dark-mode .modern-card {
    background: #2a2d3f;
    border-color: #3a3d4a;
}

.card-header-modern {
    background: #f8fafc;
    padding: 15px 20px;
    border-bottom: 1px solid #e2e8f0;
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-shrink: 0;
}

body.dark-mode .card-header-modern {
    background: #252837;
    border-bottom-color: #3a3d4a;
}

.card-title-modern {
    font-size: 1rem;
    font-weight: 600;
    color: #1e293b;
    margin: 0;
}

body.dark-mode .card-title-modern {
    color: #e2e8f0;
}

/* Chat Container - Fixed Height */
.chat-container {
    flex: 1;
    overflow-y: auto;
    padding: 15px;
    background: #f8fafc;
    scrollbar-width: thin;
    scrollbar-color: #f26b37 #e2e8f0;
    max-height: calc(100vh - 350px);
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

/* Message Input Section - Fixed Bottom */
.message-input-section {
    background: white;
    padding: 12px 15px;
    border-top: 1px solid #e2e8f0;
    flex-shrink: 0;
    margin-top: 0;
}

body.dark-mode .message-input-section {
    background: #2a2d3f;
    border-top-color: #3a3d4a;
}

.quick-messages-section {
    background: #f8fafc;
    padding: 8px 15px;
    border-top: 1px solid #e2e8f0;
    flex-shrink: 0;
    margin-top: 0;
}

body.dark-mode .quick-messages-section {
    background: #252837;
    border-top-color: #3a3d4a;
}

/* Message Bubbles - WhatsApp Style */
.message-bubble {
    max-width: 75%;
    margin-bottom: 12px;
    animation: slideIn 0.2s ease;
    position: relative;
}

.message-sent {
    margin-left: auto;
    background: #f26b37;
    color: white;
    border-radius: 15px 15px 4px 15px;
    padding: 8px 12px;
}

.message-received {
    margin-right: auto;
    background: white;
    color: #374151;
    border-radius: 15px 15px 15px 4px;
    border: 1px solid #e2e8f0;
    padding: 8px 12px;
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
    margin-bottom: 4px;
    font-size: 11px;
    opacity: 0.8;
}

.sender-name {
    font-weight: 600;
    font-size: 11px;
}

.message-time {
    font-size: 10px;
    opacity: 0.7;
}

.message-content {
    line-height: 1.4;
    word-wrap: break-word;
    font-size: 14px;
}

.product-request-badge {
    background: rgba(251, 191, 36, 0.2);
    color: #d97706;
    padding: 3px 8px;
    border-radius: 12px;
    font-size: 10px;
    font-weight: 600;
    margin-bottom: 6px;
    display: inline-block;
}

body.dark-mode .product-request-badge {
    background: rgba(217, 119, 6, 0.3);
    color: #fbbf24;
}

.product-details {
    background: rgba(242, 107, 55, 0.05);
    border: 1px solid rgba(242, 107, 55, 0.2);
    border-radius: 6px;
    padding: 8px;
    margin-top: 6px;
    font-size: 12px;
}

body.dark-mode .product-details {
    background: rgba(242, 107, 55, 0.1);
    border-color: rgba(242, 107, 55, 0.3);
}

.product-details h6 {
    color: #f26b37;
    margin-bottom: 6px;
    font-size: 12px;
}

.read-indicator {
    text-align: right;
    margin-top: 4px;
    font-size: 10px;
    color: #10b981;
}

.message-input {
    border: 1px solid #e2e8f0;
    border-radius: 8px;
    padding: 8px 12px;
    resize: none;
    transition: all 0.3s ease;
    font-size: 14px;
}

.message-input:focus {
    border-color: #f26b37;
    box-shadow: 0 0 0 2px rgba(242, 107, 55, 0.1);
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

/* Sidebar Cards */
.info-card {
    background: white;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.06);
    border: 1px solid #e2e8f0;
    margin-bottom: 12px;
    overflow: hidden;
    flex-shrink: 0;
}

body.dark-mode .info-card {
    background: #2a2d3f;
    border-color: #3a3d4a;
}

.info-card-header {
    background: #f8fafc;
    padding: 8px 12px;
    border-bottom: 1px solid #e2e8f0;
    font-size: 13px;
    font-weight: 600;
}

body.dark-mode .info-card-header {
    background: #252837;
    border-bottom-color: #3a3d4a;
    color: #e2e8f0;
}

.info-card-body {
    padding: 10px 12px;
}

.info-table {
    margin: 0;
    font-size: 12px;
}

.info-table td {
    padding: 4px 0;
    border: none;
    border-bottom: 1px solid #f1f5f9;
    vertical-align: top;
}

body.dark-mode .info-table td {
    border-bottom-color: #3a3d4a;
    color: #e2e8f0;
}

.info-table td:first-child {
    font-weight: 600;
    color: #64748b;
    width: 35%;
}

body.dark-mode .info-table td:first-child {
    color: #94a3b8;
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
    padding: 6px 12px;
    border-radius: 6px;
    font-weight: 500;
    transition: all 0.3s ease;
    font-size: 12px;
}

.btn-outline-modern:hover {
    background: #f26b37;
    color: white;
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
</style>

<div class="chat-page-container">
    <!-- Chat Header -->
    <div class="chat-header-main">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1><i class="fas fa-comments me-2"></i>{{ $chatRoom->nama_room }}</h1>
                <p class="chat-subtitle">Chat dengan CV sSumber Rejeki</p>
            </div>
            <div class="chat-header-buttons">
                <a href="{{ route('supplier.dashboard') }}" class="btn btn-back-modern">
                    <i class="fas fa-arrow-left me-1"></i>Kembali
                </a>
            </div>
        </div>
    </div>

    <!-- Chat Content -->
    <div class="chat-content-wrapper">
        <!-- Main Chat Area -->
        <div class="chat-main">
            <div class="modern-card">
                <!-- Chat Messages Container -->
                <div class="chat-container" id="chatContainer">
                    @forelse($chatRoom->messages as $message)
                        <div class="message-bubble {{ $message->sender_type === 'pemasok' ? 'message-sent' : 'message-received' }}">
                            <div class="message-header">
                                <span class="sender-name">{{ $message->sender_name }}</span>
                                <span class="message-time">{{ $message->created_at->format('H:i') }}</span>
                            </div>
                            
                            @if($message->message_type === 'product_request')
                                <div class="product-request-badge">
                                    <i class="fas fa-box"></i> REQUEST PRODUK
                                </div>
                            @endif
                            
                            <div class="message-content">{!! nl2br(e($message->message)) !!}</div>
                            
                            @if($message->product_data)
                                <div class="product-details">
                                    <h6><i class="fas fa-box"></i> Data Produk:</h6>
                                    <pre class="mb-0">{{ json_encode($message->product_data, JSON_PRETTY_PRINT) }}</pre>
                                </div>
                            @endif
                        </div>
                    @empty
                        <div class="no-messages-state">
                            <div class="no-messages-icon">
                                <i class="fas fa-comment"></i>
                            </div>
                            <h5>Belum ada pesan</h5>
                            <p>Mulai percakapan dengan mengirim pesan pertama!</p>
                        </div>
                    @endforelse
                </div>

                <!-- Message Input -->
                <div class="message-input-section">
                    <form id="messageForm" action="{{ route('supplier.chat.message', $chatRoom->id) }}" method="POST">
                        @csrf
                        <div class="input-group">
                            <textarea class="form-control message-input" name="message" id="messageInput" 
                                    placeholder="Ketik pesan Anda..." rows="2" required></textarea>
                            <button type="submit" class="btn btn-modern ms-2">
                                <i class="fas fa-paper-plane"></i> Kirim
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="chat-sidebar">
            <!-- Chat Info Card -->
            <div class="info-card">
                <div class="info-card-header">
                    <i class="fas fa-info-circle me-1"></i> Informasi Chat
                </div>
                <div class="info-card-body">
                    <table class="info-table">
                        <tr>
                            <td><strong>Nama Room:</strong></td>
                            <td>{{ $chatRoom->nama_room }}</td>
                        </tr>
                        <tr>
                            <td><strong>Status:</strong></td>
                            <td>
                                <span class="badge bg-{{ $chatRoom->status === 'aktif' ? 'success' : 'danger' }}">
                                    {{ ucfirst($chatRoom->status) }}
                                </span>
                            </td>
                        </tr>
                        @if($chatRoom->gudang)
                        <tr>
                            <td><strong>Gudang:</strong></td>
                            <td>{{ $chatRoom->gudang->nama_gudang }}</td>
                        </tr>
                        @endif
                        <tr>
                            <td><strong>Dibuat:</strong></td>
                            <td>{{ $chatRoom->created_at->format('d/m/Y H:i') }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <!-- Quick Actions Card -->
            <div class="info-card">
                <div class="info-card-header">
                    <i class="fas fa-bolt me-1"></i> Salam Pagi
                </div>
                <div class="info-card-body">
                    <button type="button" class="btn btn-outline-modern w-100 mb-2" onclick="insertQuickMessage('🌅 Salam Pagi')">
                        <i class="fas fa-sun"></i> Salam Pagi
                    </button>
                </div>
            </div>

            <div class="info-card">
                <div class="info-card-header">
                    <i class="fas fa-thumbs-up me-1"></i> Konfirmasi Terima
                </div>
                <div class="info-card-body">
                    <button type="button" class="btn btn-outline-modern w-100 mb-2" onclick="insertQuickMessage('✅ Konfirmasi Terima')">
                        <i class="fas fa-check"></i> Konfirmasi Terima
                    </button>
                </div>
            </div>

            <div class="info-card">
                <div class="info-card-header">
                    <i class="fas fa-box me-1"></i> Produk Tersedia
                </div>
                <div class="info-card-body">
                    <button type="button" class="btn btn-outline-modern w-100 mb-2" onclick="insertQuickMessage('📦 Produk Tersedia')">
                        <i class="fas fa-check-circle"></i> Produk Tersedia
                    </button>
                </div>
            </div>

            <div class="info-card">
                <div class="info-card-header">
                    <i class="fas fa-exclamation-triangle me-1"></i> Tidak Tersedia
                </div>
                <div class="info-card-body">
                    <button type="button" class="btn btn-outline-modern w-100" onclick="insertQuickMessage('❌ Tidak Tersedia')">
                        <i class="fas fa-times-circle"></i> Tidak Tersedia
                    </button>
                </div>
            </div>

            <!-- Tips Card -->
            <div class="info-card">
                <div class="info-card-header">
                    <i class="fas fa-lightbulb me-1"></i> Tips
                </div>
                <div class="info-card-body">
                    <ul class="list-unstyled mb-0" style="font-size: 11px;">
                        <li class="mb-1"><i class="fas fa-check text-success me-1"></i> Respond cepat untuk kepuasan pelanggan</li>
                        <li class="mb-1"><i class="fas fa-check text-success me-1"></i> Berikan informasi yang detail dan akurat</li>
                        <li class="mb-1"><i class="fas fa-check text-success me-1"></i> Konfirmasi ketersediaan produk</li>
                        <li><i class="fas fa-check text-success me-1"></i> Tawarkan alternatif jika produk tidak tersedia</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    let isAutoRefreshing = true;
    let lastMessageId = 0;
    let autoRefreshInterval;
    
    // Get last message ID
    const lastMessage = $('#chatContainer .message-bubble').last();
    if (lastMessage.length && lastMessage.data('message-id')) {
        lastMessageId = lastMessage.data('message-id');
    }

    // Auto scroll to bottom
    function scrollToBottom() {
        const chatContainer = document.getElementById('chatContainer');
        if (chatContainer) {
            chatContainer.scrollTop = chatContainer.scrollHeight;
        }
    }
    
    scrollToBottom();

    // Load new messages
    function loadNewMessages() {
        if (!isAutoRefreshing) return;
        
        $.ajax({
            url: '{{ route("supplier.chat.show", $chatRoom->id) }}',
            method: 'GET',
            data: { 
                ajax: 1,
                last_message_id: lastMessageId 
            },
            success: function(response) {
                if (response.messages && response.messages.length > 0) {
                    response.messages.forEach(function(message) {
                        if (message.id > lastMessageId) {
                            const messageClass = message.sender_type === 'pemasok' ? 'message-sent' : 'message-received';
                            let productBadge = '';
                            let productDetails = '';
                            
                            if (message.message_type === 'product_request') {
                                productBadge = '<div class="product-request-badge"><i class="fas fa-box"></i> REQUEST PRODUK</div>';
                            }
                            
                            if (message.product_data) {
                                productDetails = `
                                    <div class="product-details">
                                        <h6><i class="fas fa-box"></i> Data Produk:</h6>
                                        <pre class="mb-0">${JSON.stringify(message.product_data, null, 2)}</pre>
                                    </div>
                                `;
                            }
                            
                            const messageHtml = `
                                <div class="message-bubble ${messageClass}" data-message-id="${message.id}">
                                    <div class="message-header">
                                        <span class="sender-name">${message.sender_name}</span>
                                        <span class="message-time">${message.time}</span>
                                    </div>
                                    ${productBadge}
                                    <div class="message-content">${message.message.replace(/\n/g, '<br>')}</div>
                                    ${productDetails}
                                </div>
                            `;
                            
                            $('#chatContainer').append(messageHtml);
                            lastMessageId = message.id;
                        }
                    });
                    
                    scrollToBottom();
                }
            },
            error: function(xhr) {
                console.log('Auto refresh error:', xhr);
            }
        });
    }

    // Handle form submission with AJAX
    $('#messageForm').on('submit', function(e) {
        e.preventDefault();
        
        const form = $(this);
        const messageInput = $('#messageInput');
        const message = messageInput.val().trim();
        
        if (!message) return;
        
        // Disable submit button
        const submitBtn = form.find('button[type="submit"]');
        submitBtn.prop('disabled', true);
        
        $.ajax({
            url: form.attr('action'),
            method: 'POST',
            data: form.serialize(),
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.success) {
                    // Add message to chat immediately
                    const currentTime = new Date().toLocaleTimeString('id-ID', {hour: '2-digit', minute: '2-digit'});
                    const messageHtml = `
                        <div class="message-bubble message-sent" data-message-id="${response.message.id}">
                            <div class="message-header">
                                <span class="sender-name">{{ $supplier->nama_lengkap ?? 'Saya' }}</span>
                                <span class="message-time">${currentTime}</span>
                            </div>
                            <div class="message-content">${message.replace(/\n/g, '<br>')}</div>
                        </div>
                    `;
                    
                    $('#chatContainer').append(messageHtml);
                    messageInput.val('');
                    scrollToBottom();
                    
                    // Update last message ID
                    if (response.message.id) {
                        lastMessageId = response.message.id;
                    }
                }
            },
            error: function(xhr) {
                console.log('Send message error:', xhr);
                alert('Gagal mengirim pesan. Silakan coba lagi.');
            },
            complete: function() {
                // Re-enable submit button
                submitBtn.prop('disabled', false);
                messageInput.focus();
            }
        });
    });

    // Enter key to submit (Shift+Enter for new line)
    $('#messageInput').on('keydown', function(e) {
        if (e.key === 'Enter' && !e.shiftKey) {
            e.preventDefault();
            $('#messageForm').submit();
        }
    });

    // Start auto refresh
    function startAutoRefresh() {
        autoRefreshInterval = setInterval(loadNewMessages, 3000);
    }

    // Stop auto refresh
    function stopAutoRefresh() {
        if (autoRefreshInterval) {
            clearInterval(autoRefreshInterval);
        }
    }

    // Handle visibility change (pause when tab not active)
    document.addEventListener('visibilitychange', function() {
        if (document.hidden) {
            stopAutoRefresh();
            isAutoRefreshing = false;
        } else {
            isAutoRefreshing = true;
            loadNewMessages(); // Load immediately when tab becomes active
            startAutoRefresh();
        }
    });

    // Start auto refresh
    startAutoRefresh();

    // Cleanup on page unload
    $(window).on('beforeunload', function() {
        stopAutoRefresh();
    });
});

// Quick message function
function insertQuickMessage(message) {
    $('#messageInput').val(message);
    $('#messageInput').focus();
}
</script>
@endpush
