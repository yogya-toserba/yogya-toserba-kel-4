<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'chat_room_id',
        'sender_type',
        'sender_id',
        'message',
        'message_type',
        'attachments',
        'product_data',
        'is_read',
        'read_at'
    ];

    protected $casts = [
        'attachments' => 'array',
        'product_data' => 'array',
        'is_read' => 'boolean',
        'read_at' => 'datetime',
    ];

    // Relasi dengan chat room
    public function chatRoom()
    {
        return $this->belongsTo(ChatRoom::class);
    }

    // Polymorphic relations untuk sender
    public function senderPemasok()
    {
        return $this->belongsTo(PemasokUser::class, 'sender_id');
    }

    public function senderAdmin()
    {
        return $this->belongsTo(Admin::class, 'sender_id', 'id_admin');
    }

    public function senderGudang()
    {
        return $this->belongsTo(Gudang::class, 'sender_id', 'id_gudang');
    }

    // Get sender data based on type
    public function getSenderAttribute()
    {
        switch ($this->sender_type) {
            case 'pemasok':
                return $this->senderPemasok;
            case 'admin':
                return $this->senderAdmin;
            case 'gudang':
                return $this->senderGudang;
            default:
                return null;
        }
    }

    // Get sender name
    public function getSenderNameAttribute()
    {
        switch ($this->sender_type) {
            case 'pemasok':
                $sender = $this->senderPemasok ?? PemasokUser::find($this->sender_id);
                return $sender ? $sender->nama_lengkap : 'Pemasok';
            case 'admin':
                $sender = $this->senderAdmin ?? Admin::find($this->sender_id);
                return $sender ? ($sender->name ?? 'Admin') : 'Admin';
            case 'gudang':
                $sender = $this->senderGudang ?? Gudang::find($this->sender_id);
                return $sender ? ($sender->nama_gudang ?? 'Gudang') : 'Gudang';
            default:
                return 'Unknown';
        }
    }

    // Mark as read
    public function markAsRead()
    {
        $this->update([
            'is_read' => true,
            'read_at' => now()
        ]);
    }

    // Scope untuk unread messages
    public function scopeUnread($query)
    {
        return $query->where('is_read', false);
    }
}
