@extends('supplier.layout')

@section('title', 'Chat - ' . $chatRoom->nama_room)
@section('page-title', $chatRoom->nama_room)

@section('content')
<div class="row">
    <div class="col-md-8">
        <!-- Chat Messages -->
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-primary text-white">
                <div class="d-flex justify-content-between align-items-center">
                    <h6 class="mb-0">
                        <i class="fas fa-comments"></i> {{ $chatRoom->nama_room }}
                    </h6>
                    <a href="{{ route('supplier.dashboard') }}" class="btn btn-light btn-sm">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </div>
            
            <div class="card-body p-0">
                <div class="chat-container p-3" id="chatContainer">
                    @forelse($chatRoom->messages as $message)
                        <div class="message-bubble {{ $message->sender_type === 'pemasok' ? 'message-sent' : 'message-received' }} p-3 rounded">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <strong>{{ $message->sender_name }}</strong>
                                <small class="opacity-75">{{ $message->created_at->format('H:i') }}</small>
                            </div>
                            
                            @if($message->message_type === 'product_request')
                                <div class="bg-light p-2 rounded mb-2">
                                    <small class="text-primary"><i class="fas fa-box"></i> REQUEST PRODUK</small>
                                </div>
                            @endif
                            
                            <div>{!! nl2br(e($message->message)) !!}</div>
                            
                            @if($message->product_data)
                                <div class="mt-2 p-2 bg-light rounded">
                                    <small><strong>Data Produk:</strong></small>
                                    <pre class="mb-0 small">{{ json_encode($message->product_data, JSON_PRETTY_PRINT) }}</pre>
                                </div>
                            @endif
                        </div>
                    @empty
                        <div class="text-center py-5">
                            <i class="fas fa-comment fa-3x text-muted mb-3"></i>
                            <h5 class="text-muted">Belum ada pesan</h5>
                            <p class="text-muted">Mulai percakapan dengan mengirim pesan pertama!</p>
                        </div>
                    @endforelse
                </div>
            </div>
            
            <!-- Message Input -->
            <div class="card-footer">
                <form id="messageForm" action="{{ route('supplier.chat.message', $chatRoom->id) }}" method="POST">
                    @csrf
                    <div class="input-group">
                        <textarea class="form-control" name="message" id="messageInput" 
                                placeholder="Ketik pesan Anda..." rows="2" required></textarea>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-paper-plane"></i> Kirim
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <!-- Chat Info -->
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-info text-white">
                <h6 class="mb-0"><i class="fas fa-info-circle"></i> Informasi Chat</h6>
            </div>
            <div class="card-body">
                <table class="table table-borderless table-sm">
                    <tr>
                        <td><strong>Nama Room:</strong></td>
                        <td>{{ $chatRoom->nama_room }}</td>
                    </tr>
                    @if($chatRoom->deskripsi)
                    <tr>
                        <td><strong>Deskripsi:</strong></td>
                        <td>{{ $chatRoom->deskripsi }}</td>
                    </tr>
                    @endif
                    <tr>
                        <td><strong>Status:</strong></td>
                        <td>
                            <span class="badge bg-{{ $chatRoom->status === 'aktif' ? 'success' : 'danger' }}">
                                {{ ucfirst($chatRoom->status) }}
                            </span>
                        </td>
                    </tr>
                    @if($chatRoom->admin)
                    <tr>
                        <td><strong>Admin:</strong></td>
                        <td>{{ $chatRoom->admin->name }}</td>
                    </tr>
                    @endif
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

        <!-- Quick Actions -->
        <div class="card border-0 shadow-sm mt-3">
            <div class="card-header bg-success text-white">
                <h6 class="mb-0"><i class="fas fa-lightning"></i> Quick Actions</h6>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <button type="button" class="btn btn-outline-primary btn-sm" onclick="insertQuickMessage('Selamat pagi! Ada yang bisa kami bantu?')">
                        <i class="fas fa-sun"></i> Salam Pagi
                    </button>
                    <button type="button" class="btn btn-outline-primary btn-sm" onclick="insertQuickMessage('Terima kasih atas inquiry-nya. Kami akan segera merespons permintaan Anda.')">
                        <i class="fas fa-thumbs-up"></i> Konfirmasi Terima
                    </button>
                    <button type="button" class="btn btn-outline-primary btn-sm" onclick="insertQuickMessage('Produk yang diminta tersedia. Mohon konfirmasi untuk detail lebih lanjut.')">
                        <i class="fas fa-check-circle"></i> Produk Tersedia
                    </button>
                    <button type="button" class="btn btn-outline-warning btn-sm" onclick="insertQuickMessage('Maaf, untuk produk tersebut saat ini sedang tidak tersedia. Apakah ada alternatif lain?')">
                        <i class="fas fa-exclamation-circle"></i> Tidak Tersedia
                    </button>
                </div>
            </div>
        </div>

        <!-- Tips -->
        <div class="card border-0 shadow-sm mt-3">
            <div class="card-header bg-warning text-dark">
                <h6 class="mb-0"><i class="fas fa-lightbulb"></i> Tips</h6>
            </div>
            <div class="card-body">
                <ul class="list-unstyled mb-0 small">
                    <li><i class="fas fa-check text-success"></i> Respond cepat untuk kepuasan pelanggan</li>
                    <li><i class="fas fa-check text-success"></i> Berikan informasi yang detail dan akurat</li>
                    <li><i class="fas fa-check text-success"></i> Konfirmasi ketersediaan produk</li>
                    <li><i class="fas fa-check text-success"></i> Tawarkan alternatif jika produk tidak tersedia</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // Auto scroll to bottom
        function scrollToBottom() {
            const chatContainer = document.getElementById('chatContainer');
            chatContainer.scrollTop = chatContainer.scrollHeight;
        }
        
        scrollToBottom();

        // Handle form submission with AJAX
        $('#messageForm').on('submit', function(e) {
            e.preventDefault();
            
            const form = $(this);
            const messageInput = $('#messageInput');
            const message = messageInput.val().trim();
            
            if (!message) return;
            
            // Disable submit button
            form.find('button[type="submit"]').prop('disabled', true);
            
            $.ajax({
                url: form.attr('action'),
                method: 'POST',
                data: form.serialize(),
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response.success) {
                        // Add message to chat
                        const messageHtml = `
                            <div class="message-bubble message-sent p-3 rounded">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <strong>{{ $supplier->nama_lengkap }}</strong>
                                    <small class="opacity-75">${new Date().toLocaleTimeString('id-ID', {hour: '2-digit', minute: '2-digit'})}</small>
                                </div>
                                <div>${message.replace(/\n/g, '<br>')}</div>
                            </div>
                        `;
                        
                        $('#chatContainer').append(messageHtml);
                        messageInput.val('');
                        scrollToBottom();
                    }
                },
                error: function(xhr) {
                    alert('Gagal mengirim pesan. Silakan coba lagi.');
                },
                complete: function() {
                    // Re-enable submit button
                    form.find('button[type="submit"]').prop('disabled', false);
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

        // Auto refresh messages every 10 seconds
        setInterval(function() {
            location.reload();
        }, 10000);
    });

    // Quick message function
    function insertQuickMessage(message) {
        $('#messageInput').val(message);
        $('#messageInput').focus();
    }
</script>
@endpush
