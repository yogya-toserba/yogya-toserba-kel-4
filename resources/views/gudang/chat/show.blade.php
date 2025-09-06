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
/* Fixed Layout - No Page Scroll */
.chat-page-container {
    height: calc(100vh - 120px); /* Reduced height to prevent scrolling */
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

/* Modern Request Button */
.btn-request-modern {
    background: rgba(255, 255, 255, 0.95) !important;
    border: 1px solid rgba(255, 255, 255, 0.95) !important;
    color: #f26b37 !important;
    border-radius: 20px !important;
    font-weight: 600 !important;
    transition: all 0.3s ease !important;
    backdrop-filter: blur(10px);
}

.btn-request-modern:hover {
    background: white !important;
    border-color: white !important;
    color: #e55827 !important;
    transform: translateY(-1px);
    box-shadow: 0 4px 15px rgba(255, 255, 255, 0.3);
}

.btn-request-modern:focus,
.btn-request-modern:active {
    background: rgba(255, 255, 255, 0.98) !important;
    border-color: rgba(255, 255, 255, 0.98) !important;
    color: #f26b37 !important;
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

/* Sidebar Modern Request Button */
.chat-sidebar .btn-request-modern {
    background: rgba(242, 107, 55, 0.9) !important;
    border: 1px solid rgba(242, 107, 55, 0.9) !important;
    color: white !important;
    border-radius: 20px !important;
    font-weight: 600 !important;
    transition: all 0.3s ease !important;
    backdrop-filter: blur(10px);
    width: 100%;
    text-align: center;
}

.chat-sidebar .btn-request-modern:hover {
    background: rgba(229, 88, 39, 0.95) !important;
    border-color: rgba(229, 88, 39, 0.95) !important;
    color: white !important;
    transform: translateY(-1px);
    box-shadow: 0 4px 15px rgba(242, 107, 55, 0.3);
}

.chat-sidebar .btn-request-modern:focus,
.chat-sidebar .btn-request-modern:active {
    background: rgba(242, 107, 55, 0.85) !important;
    border-color: rgba(242, 107, 55, 0.85) !important;
    color: white !important;
    box-shadow: 0 0 0 0.2rem rgba(242, 107, 55, 0.25);
}

.btn-modern {
    background: linear-gradient(135deg, #f26b37, #e55827);
    color: white;
    border: none;
    padding: 6px 12px;
    border-radius: 6px;
    font-weight: 500;
    font-size: 0.85rem;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    gap: 4px;
}

.btn-modern:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(242, 107, 55, 0.4);
    color: white;
}

.btn-outline-modern {
    background: rgba(248, 250, 252, 0.8);
    color: #64748b;
    border: 1px solid rgba(148, 163, 184, 0.5);
    padding: 6px 12px;
    border-radius: 20px; /* Rounded like other modern buttons */
    font-weight: 500;
    font-size: 0.85rem;
    transition: all 0.3s ease;
    backdrop-filter: blur(10px);
}

.btn-outline-modern:hover {
    background: rgba(241, 245, 249, 0.9);
    color: #475569;
    border-color: rgba(148, 163, 184, 0.7);
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(148, 163, 184, 0.2);
}

/* Dark mode for outline buttons */
body.dark-mode .btn-outline-modern {
    background: rgba(45, 55, 72, 0.8) !important;
    color: #cbd5e0 !important;
    border-color: rgba(113, 128, 150, 0.5) !important;
}

body.dark-mode .btn-outline-modern:hover {
    background: rgba(45, 55, 72, 0.9) !important;
    color: #e2e8f0 !important;
    border-color: rgba(113, 128, 150, 0.7) !important;
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

/* Chat Container - Fixed Height */
.chat-container {
    flex: 1;
    overflow-y: auto;
    padding: 15px;
    background: #f8fafc;
    scrollbar-width: thin;
    scrollbar-color: #f26b37 #e2e8f0;
    max-height: calc(100vh - 350px); /* Reduced max height */
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
    .chat-page-container {
        height: calc(100vh - 80px);
        margin: 10px 0;
    }
    
    .chat-sidebar {
        display: none;
    }
    
    .chat-header-main {
        padding: 15px 20px;
    }
    
    .chat-header-main h1 {
        font-size: 1.4rem;
    }
    
    .chat-header-main .chat-subtitle {
        font-size: 0.85rem;
    }
    
    .chat-header-buttons {
        flex-direction: column;
        gap: 8px !important;
    }
    
    .chat-header-buttons .btn {
        font-size: 0.85rem !important;
        padding: 6px 12px !important;
        border-width: 1.5px !important;
    }
    
    .message-bubble {
        max-width: 90%;
    }
    
    .chat-container {
        max-height: calc(100vh - 280px);
        padding: 10px;
    }
    
    .quick-messages-section .d-flex {
        flex-wrap: wrap;
        gap: 5px;
    }
    
    .quick-messages-section .btn {
        font-size: 0.8rem;
        padding: 4px 8px;
    }
    
    .message-input-section {
        padding: 10px;
    }
}
</style>

<div class="permintaan-container">
    <!-- Chat Container dengan Layout Fixed -->
    <div class="chat-page-container">
        <!-- Chat Header Main -->
        <div class="chat-header-main">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1><i class="fas fa-comments me-2"></i>{{ $chatRoom->nama_room }}</h1>
                    <p class="chat-subtitle">
                        <i class="fas fa-building me-1"></i> {{ $chatRoom->pemasok->nama_perusahaan }}
                        @if($chatRoom->deskripsi)
                            • {{ $chatRoom->deskripsi }}
                        @endif
                    </p>
                </div>
                <div class="d-flex gap-2 chat-header-buttons"> <!-- Reduced gap for better spacing -->
                    <a href="{{ route('gudang.chat.index') }}" class="btn btn-back-modern">
                        <i class="fas fa-arrow-left me-2"></i>Kembali
                    </a>
                    <a href="{{ route('gudang.chat.request-product', $chatRoom->id) }}" class="btn btn-request-modern">
                        <i class="fas fa-plus me-2"></i>Request Produk
                    </a>
                </div>
            </div>
        </div>

        <div class="chat-content-wrapper">
            <!-- Main Chat Area -->
            <div class="chat-main">
                <!-- Chat Messages -->
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
                
                <!-- Quick Messages Section -->
                <div class="quick-messages-section">
                    <div class="d-flex gap-2 flex-wrap">
                        <button class="btn btn-outline-secondary btn-sm" onclick="insertQuickMessage('Halo, saya butuh informasi produk')">
                            <i class="fas fa-info-circle me-1"></i>Info Produk
                        </button>
                        <button class="btn btn-outline-secondary btn-sm" onclick="insertQuickMessage('Mohon informasi harga dan stok')">
                            <i class="fas fa-dollar-sign me-1"></i>Harga & Stok
                        </button>
                        <button class="btn btn-outline-secondary btn-sm" onclick="insertQuickMessage('Kapan pengiriman bisa dilakukan?')">
                            <i class="fas fa-truck me-1"></i>Pengiriman
                        </button>
                        <button class="btn btn-outline-secondary btn-sm" onclick="insertQuickMessage('Terima kasih')">
                            <i class="fas fa-heart me-1"></i>Terima Kasih
                        </button>
                    </div>
                </div>

                <!-- Message Input -->
                <div class="message-input-section">
                    <form id="messageForm" action="{{ route('gudang.chat.message', $chatRoom->id) }}" method="POST" onsubmit="return false;">
                        @csrf
                        <div class="d-flex gap-2">
                            <textarea class="form-control message-input flex-grow-1" name="message" id="messageInput" 
                                    placeholder="Ketik pesan Anda..." rows="1" required 
                                    style="resize: none;" onkeypress="handleKeyPress(event)"></textarea>
                            <button type="button" id="sendBtn" class="btn btn-modern d-flex align-items-center">
                                <i class="fas fa-paper-plane"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Chat Sidebar -->
            <div class="chat-sidebar">
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
            <div class="info-card">
                <div class="info-card-header">
                    <h6 class="mb-0">
                        <i class="fas fa-bolt" style="color: #f26b37; margin-right: 8px;"></i>
                        Quick Actions
                    </h6>
                </div>
                <div class="info-card-body">
                    <div class="d-grid gap-1">
                        <a href="{{ route('gudang.chat.request-product', $chatRoom->id) }}" class="btn btn-request-modern btn-sm">
                            <i class="fas fa-box"></i>
                            Request Produk Baru
                        </a>
                        <button class="btn btn-outline-modern btn-sm" onclick="clearMessages()">
                            <i class="fas fa-eraser"></i>
                            Clear Messages
                        </button>
                        <button class="btn btn-outline-modern btn-sm" onclick="exportChat()">
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
    
    // Initialize auto-refresh system
    let autoRefreshInterval;
    let lastMessageId = {{ $chatRoom->messages->max('id') ?? 0 }};
    let isTyping = false;
    
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
                    
                    // Add new message to chat immediately
                    appendNewMessage(response.message);
                    
                    // Scroll to bottom
                    scrollToBottom();
                    
                    // Update last message ID
                    lastMessageId = Math.max(lastMessageId, response.message.id);
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
    
    // Function to append new message to chat (for sent messages)
    function appendNewMessage(messageData) {
        const senderIcon = messageData.sender_type === 'gudang' ? 'fa-warehouse' : (messageData.sender_type === 'pemasok' ? 'fa-truck' : 'fa-user');
        const senderName = messageData.sender ? (messageData.sender.nama || messageData.sender.name || 'Unknown') : 'Unknown';
        const messageClass = messageData.sender_type === 'gudang' ? 'message-sent' : 'message-received';
        
        const messageHtml = `
            <div class="message-bubble ${messageClass}">
                <div class="message-header">
                    <span class="sender-name">
                        <i class="fas ${senderIcon}"></i> ${senderName}
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
    
    // Auto-refresh functionality - integrated with main function
    
    // Function to load new messages
    function loadNewMessages() {
        $.ajax({
            url: '{{ route("gudang.chat.messages", $chatRoom->id) }}',
            method: 'GET',
            data: {
                after: lastMessageId
            },
            success: function(response) {
                if (response.success && response.messages.length > 0) {
                    response.messages.forEach(function(message) {
                        appendNewMessage(message);
                        lastMessageId = Math.max(lastMessageId, message.id);
                    });
                    
                    // Scroll to bottom if user is near bottom
                    const chatContainer = document.getElementById('chatContainer');
                    const isNearBottom = chatContainer.scrollTop >= (chatContainer.scrollHeight - chatContainer.clientHeight - 100);
                    if (isNearBottom) {
                        scrollToBottom();
                    }
                    
                    // Show notification for new messages
                    if (response.messages.length > 0) {
                        showNotification('Pesan baru diterima', 'success');
                    }
                }
            },
            error: function() {
                console.log('Error loading new messages');
            }
        });
    }
    
    // Typing detection
    $('#messageInput').on('input', function() {
        isTyping = true;
        setTimeout(() => { isTyping = false; }, 2000);
    });
    
    // Start auto-refresh when ready
    startAutoRefresh();
    
    // Auto-refresh functionality
    function startAutoRefresh() {
        autoRefreshInterval = setInterval(function() {
            if (!isTyping) {
                loadNewMessages();
            }
        }, 3000);
    }
    
    function stopAutoRefresh() {
        if (autoRefreshInterval) {
            clearInterval(autoRefreshInterval);
        }
    }
    
    // Function to scroll to bottom  
    function scrollToBottom() {
        const chatContainer = document.getElementById('chatContainer');
        chatContainer.scrollTop = chatContainer.scrollHeight;
    }
});

// Handle key press in message input
function handleKeyPress(event) {
    if (event.key === 'Enter' && !event.shiftKey) {
        event.preventDefault();
        sendMessage();
    }
}

// Insert quick message function
function insertQuickMessage(message) {
    const messageInput = document.getElementById('messageInput');
    messageInput.value = message;
    messageInput.focus();
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
