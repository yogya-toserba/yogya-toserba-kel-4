@extends('layouts.appGudang')

@section('title', 'Chat - ' . $chatRoom->nama_room)

@push('meta')
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
@endpush

@section('content')
<div class="row">
    <div class="col-md-8">
        <!-- Chat Messages -->
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-primary text-white">
                <div class="d-flex justify-content-between align-items-center">
                    <h6 class="mb-0">
                        <i class="fas fa-comments"></i> {{ $chatRoom->nama_room }}
                        <small class="ms-2 opacity-75">{{ $chatRoom->pemasok->nama_perusahaan }}</small>
                    </h6>
                    <div>
                        <a href="{{ route('gudang.chat.request-product', $chatRoom->id) }}" class="btn btn-success btn-sm me-2">
                            <i class="fas fa-box"></i> Request Produk
                        </a>
                        <a href="{{ route('gudang.chat.index') }}" class="btn btn-light btn-sm">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="card-body p-0">
                <div class="chat-container p-3" id="chatContainer" style="height: 500px; overflow-y: auto;">
                    @forelse($chatRoom->messages as $message)
                        <div class="message-bubble {{ $message->sender_type === 'gudang' ? 'message-sent' : 'message-received' }} p-3 rounded mb-3">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <strong>
                                    @if($message->sender_type === 'gudang')
                                        <i class="fas fa-warehouse text-primary"></i> {{ $message->sender_name }}
                                    @elseif($message->sender_type === 'pemasok')
                                        <i class="fas fa-truck text-success"></i> {{ $message->sender_name }}
                                    @else
                                        <i class="fas fa-user text-info"></i> {{ $message->sender_name }}
                                    @endif
                                </strong>
                                <small class="opacity-75">
                                    {{ $message->created_at->format('d/m/Y H:i') }}
                                </small>
                            </div>
                            
                            @if($message->message_type === 'product_request')
                                <div class="bg-warning bg-opacity-25 p-2 rounded mb-2">
                                    <small class="text-warning"><i class="fas fa-box"></i> <strong>REQUEST PRODUK</strong></small>
                                </div>
                            @endif
                            
                            <div class="message-content">{!! nl2br(e($message->message)) !!}</div>
                            
                            @if($message->product_data)
                                <div class="mt-2 p-3 bg-light rounded border-start border-primary border-3">
                                    <h6 class="text-primary mb-2"><i class="fas fa-info-circle"></i> Detail Produk</h6>
                                    <div class="row">
                                        @foreach($message->product_data as $key => $value)
                                            @if($value)
                                                <div class="col-md-6 mb-2">
                                                    <small class="text-muted">{{ ucwords(str_replace('_', ' ', $key)) }}:</small>
                                                    <div><strong>{{ $value }}</strong></div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                            
                            @if($message->is_read)
                                <div class="text-end mt-2">
                                    <small class="text-success"><i class="fas fa-check-double"></i> Dibaca</small>
                                </div>
                            @endif
                        </div>
                    @empty
                        <div class="text-center py-5">
                            <i class="fas fa-comment fa-3x text-muted mb-3"></i>
                            <h5 class="text-muted">Belum ada pesan</h5>
                            <p class="text-muted">Mulai percakapan dengan mengirim pesan atau request produk!</p>
                        </div>
                    @endforelse
                </div>
            </div>
            
            <!-- Message Input -->
            <div class="card-footer">
                <form id="messageForm" action="{{ route('gudang.chat.message', $chatRoom->id) }}" method="POST" onsubmit="return false;">
                    @csrf
                    <div class="input-group">
                        <textarea class="form-control" name="message" id="messageInput" 
                                placeholder="Ketik pesan Anda..." rows="2" required></textarea>
                        <button type="button" id="sendBtn" class="btn btn-primary">
                            <i class="fas fa-paper-plane"></i> Kirim
                        </button>
                    </div>
                </form>
                
                <!-- Quick Actions Row -->
                <div class="mt-2">
                    <div class="btn-group btn-group-sm" role="group">
                        <button type="button" class="btn btn-outline-secondary" onclick="insertQuickMessage('Selamat pagi! Ada kebutuhan produk hari ini?')">
                            <i class="fas fa-sun"></i> Salam Pagi
                        </button>
                        <button type="button" class="btn btn-outline-secondary" onclick="insertQuickMessage('Mohon informasi ketersediaan dan harga untuk produk yang dibutuhkan.')">
                            <i class="fas fa-question-circle"></i> Tanya Ketersediaan
                        </button>
                        <button type="button" class="btn btn-outline-secondary" onclick="insertQuickMessage('Terima kasih atas responnya. Kami akan proses segera.')">
                            <i class="fas fa-thumbs-up"></i> Terima Kasih
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <!-- Supplier Info -->
        <div class="card border-0 shadow-sm mb-3">
            <div class="card-header bg-info text-white">
                <h6 class="mb-0"><i class="fas fa-building"></i> Info Supplier</h6>
            </div>
            <div class="card-body">
                <table class="table table-borderless table-sm">
                    <tr>
                        <td><strong>Perusahaan:</strong></td>
                        <td>{{ $chatRoom->pemasok->nama_perusahaan }}</td>
                    </tr>
                    <tr>
                        <td><strong>Kontak:</strong></td>
                        <td>{{ $chatRoom->pemasok->kontak_person }}</td>
                    </tr>
                    <tr>
                        <td><strong>Telepon:</strong></td>
                        <td>{{ $chatRoom->pemasok->telepon }}</td>
                    </tr>
                    <tr>
                        <td><strong>Email:</strong></td>
                        <td>{{ $chatRoom->pemasok->email }}</td>
                    </tr>
                    <tr>
                        <td><strong>Kategori:</strong></td>
                        <td>
                            <span class="badge bg-primary">{{ $chatRoom->pemasok->kategori_produk }}</span>
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Rating:</strong></td>
                        <td>
                            @for($i = 1; $i <= 5; $i++)
                                <i class="fas fa-star {{ $i <= ($chatRoom->pemasok->rating ?? 0) ? 'text-warning' : 'text-muted' }}"></i>
                            @endfor
                            ({{ $chatRoom->pemasok->rating ?? 0 }}/5)
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <!-- Chat Statistics -->
        <div class="card border-0 shadow-sm mb-3">
            <div class="card-header bg-success text-white">
                <h6 class="mb-0"><i class="fas fa-chart-line"></i> Statistik Chat</h6>
            </div>
            <div class="card-body text-center">
                <div class="row">
                    <div class="col-6">
                        <h4 class="text-primary">{{ $chatRoom->messages->count() }}</h4>
                        <small class="text-muted">Total Pesan</small>
                    </div>
                    <div class="col-6">
                        <h4 class="text-success">{{ $chatRoom->messages->where('sender_type', 'pemasok')->count() }}</h4>
                        <small class="text-muted">Dari Supplier</small>
                    </div>
                </div>
                <hr>
                <small class="text-muted">
                    <i class="fas fa-clock"></i> 
                    Dibuat: {{ $chatRoom->created_at->format('d/m/Y H:i') }}
                </small>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-warning text-dark">
                <h6 class="mb-0"><i class="fas fa-lightning"></i> Quick Actions</h6>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="{{ route('gudang.chat.request-product', $chatRoom->id) }}" class="btn btn-success btn-sm">
                        <i class="fas fa-box"></i> Request Produk Baru
                    </a>
                    <button type="button" class="btn btn-info btn-sm" onclick="exportChat()">
                        <i class="fas fa-download"></i> Export Chat
                    </button>
                    <button type="button" class="btn btn-secondary btn-sm" onclick="markAllRead()">
                        <i class="fas fa-check-double"></i> Tandai Semua Dibaca
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .chat-container {
        background: linear-gradient(to bottom, #f8f9fa, #e9ecef);
    }
    
    .message-bubble {
        max-width: 75%;
        border-radius: 18px !important;
        position: relative;
    }
    
    .message-sent {
        margin-left: auto;
        background: linear-gradient(135deg, #007bff, #0056b3);
        color: white;
    }
    
    .message-sent::before {
        content: '';
        position: absolute;
        right: -8px;
        top: 15px;
        width: 0;
        height: 0;
        border-left: 8px solid #007bff;
        border-top: 8px solid transparent;
        border-bottom: 8px solid transparent;
    }
    
    .message-received {
        margin-right: auto;
        background: white;
        color: #333;
        border: 1px solid #e9ecef;
    }
    
    .message-received::before {
        content: '';
        position: absolute;
        left: -8px;
        top: 15px;
        width: 0;
        height: 0;
        border-right: 8px solid white;
        border-top: 8px solid transparent;
        border-bottom: 8px solid transparent;
    }
    
    .message-content {
        line-height: 1.4;
    }
    
    #messageInput {
        border-radius: 20px;
        resize: none;
    }
    
    .typing-indicator {
        display: none;
        padding: 10px;
        font-style: italic;
        color: #666;
    }
</style>
@endpush

@push('scripts')
<script>
    // Data untuk JavaScript
    const gudangData = {
        nama: '{{ $gudang->nama_gudang }}',
        id: '{{ $gudang->id_gudang }}'
    };
    
    $(document).ready(function() {
        // Prevent form resubmission on page refresh
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
        
        // Handle page unload to prevent resubmission
        window.addEventListener('beforeunload', function() {
            if (window.history.replaceState) {
                window.history.replaceState(null, null, window.location.href);
            }
        });
        
        // Handle popstate (back/forward buttons)
        window.addEventListener('popstate', function(event) {
            if (window.history.replaceState) {
                window.history.replaceState(null, null, window.location.href);
            }
        });
        
        // Auto scroll to bottom
        function scrollToBottom() {
            const chatContainer = document.getElementById('chatContainer');
            chatContainer.scrollTop = chatContainer.scrollHeight;
        }
        
        scrollToBottom();

        // Handle form submission with AJAX
        $('#sendBtn').on('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            sendMessage();
        });
        
        $('#messageForm').on('submit', function(e) {
            e.preventDefault();
            e.stopPropagation();
            sendMessage();
            return false;
        });
        
        function sendMessage() {
            console.log('Sending message via AJAX'); // Debug log
            
            const form = $('#messageForm');
            const messageInput = $('#messageInput');
            const message = messageInput.val().trim();
            
            if (!message) {
                console.log('Empty message, returning'); // Debug log
                return false;
            }
            
            // Disable submit button
            const submitBtn = $('#sendBtn');
            submitBtn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Mengirim...');
            
            $.ajax({
                url: form.attr('action'),
                method: 'POST',
                data: form.serialize(),
                dataType: 'json', // Explicitly expect JSON
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'Accept': 'application/json',
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                success: function(response) {
                    console.log('AJAX Success:', response); // Debug log
                    if (response.success) {
                        // Add message to chat
                        const now = new Date();
                        const timeString = now.toLocaleDateString('id-ID') + ' ' + 
                                         now.toLocaleTimeString('id-ID', {hour: '2-digit', minute: '2-digit'});
                        
                        const messageHtml = `
                            <div class="message-bubble message-sent p-3 rounded mb-3">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <strong>
                                        <i class="fas fa-warehouse text-primary"></i> ${gudangData.nama}
                                    </strong>
                                    <small class="opacity-75">${timeString}</small>
                                </div>
                                <div class="message-content">${message.replace(/\n/g, '<br>')}</div>
                                <div class="text-end mt-2">
                                    <small class="text-success"><i class="fas fa-check"></i> Terkirim</small>
                                </div>
                            </div>
                        `;
                        
                        $('#chatContainer').append(messageHtml);
                        messageInput.val('');
                        scrollToBottom();
                        
                        // Update statistics
                        const totalMessages = parseInt($('.text-primary h4').first().text()) + 1;
                        $('.text-primary h4').first().text(totalMessages);
                        
                        // Prevent form resubmission by updating history
                        if (window.history.replaceState) {
                            window.history.replaceState(null, null, window.location.href);
                        }
                        
                        showToast('success', 'Pesan berhasil dikirim!');
                    } else {
                        showToast('error', 'Gagal mengirim pesan: ' + (response.message || 'Unknown error'));
                    }
                },
                error: function(xhr, status, error) {
                    console.log('AJAX Error:', xhr, status, error); // Debug log
                    let errorMessage = 'Gagal mengirim pesan. Silakan coba lagi.';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMessage = xhr.responseJSON.message;
                    } else if (xhr.responseJSON && xhr.responseJSON.error) {
                        errorMessage = xhr.responseJSON.error;
                    }
                    
                    // Show error toast
                    showToast('error', errorMessage);
                },
                complete: function() {
                    // Re-enable submit button
                    submitBtn.prop('disabled', false).html('<i class="fas fa-paper-plane"></i> Kirim');
                    messageInput.focus();
                }
            });
            
            return false;
        }

        // Enter key to submit (Shift+Enter for new line)
        $('#messageInput').on('keydown', function(e) {
            if (e.key === 'Enter' && !e.shiftKey) {
                e.preventDefault();
                sendMessage();
            }
        });

        // Auto refresh messages every 15 seconds
        setInterval(function() {
            refreshMessages();
        }, 15000);
        
        // Auto-resize textarea
        $('#messageInput').on('input', function() {
            this.style.height = 'auto';
            this.style.height = (this.scrollHeight) + 'px';
        });
    });

    // Quick message function
    function insertQuickMessage(message) {
        $('#messageInput').val(message);
        $('#messageInput').focus();
        $('#messageInput').trigger('input'); // Trigger auto-resize
    }

    // Refresh messages without full page reload
    function refreshMessages() {
        // Simple implementation - in production you might want to use WebSockets
        // For now, just reload the page quietly
        window.location.reload();
    }

    // Mark all messages as read
    function markAllRead() {
        // Implementation for marking all messages as read
        $.ajax({
            url: '{{ route("gudang.chat.show", $chatRoom->id) }}',
            method: 'GET',
            success: function() {
                $('.text-danger h4').text('0'); // Reset unread count
                showToast('success', 'Semua pesan telah ditandai sebagai dibaca');
            }
        });
    }

    // Export chat functionality
    function exportChat() {
        // Implementation for exporting chat
        showToast('info', 'Fitur export chat akan segera tersedia');
    }

    // Toast notification function
    function showToast(type, message) {
        const alertClass = type === 'error' ? 'alert-danger' : 
                          type === 'success' ? 'alert-success' : 'alert-info';
        
        const toast = `
            <div class="alert ${alertClass} alert-dismissible fade show position-fixed" 
                 style="top: 20px; right: 20px; z-index: 9999;" role="alert">
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        `;
        
        $('body').append(toast);
        
        // Auto remove after 5 seconds
        setTimeout(function() {
            $('.alert').fadeOut();
        }, 5000);
    }
</script>
@endpush
