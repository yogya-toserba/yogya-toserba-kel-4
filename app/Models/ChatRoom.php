<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatRoom extends Model
{
    use HasFactory;

    protected $fillable = [
        'pemasok_id',
        'admin_id',
        'gudang_id',
        'nama_room',
        'deskripsi',
        'status',
        'last_message_at'
    ];

    protected $casts = [
        'last_message_at' => 'datetime',
    ];

    // Relasi dengan pemasok
    public function pemasok()
    {
        return $this->belongsTo(Pemasok::class, 'pemasok_id', 'id_pemasok');
    }

    // Relasi dengan admin
    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id', 'id');
    }

    // Relasi dengan gudang
    public function gudang()
    {
        return $this->belongsTo(Gudang::class, 'gudang_id', 'id_gudang');
    }

    // Relasi dengan messages
    public function messages()
    {
        return $this->hasMany(ChatMessage::class)->orderBy('created_at', 'asc');
    }

    // Last message
    public function lastMessage()
    {
        return $this->hasOne(ChatMessage::class)->latest();
    }

    // Unread messages count
    public function unreadMessagesCount($userType, $userId)
    {
        return $this->messages()
            ->where('sender_type', '!=', $userType)
            ->where('sender_id', '!=', $userId)
            ->where('is_read', false)
            ->count();
    }

    // Scope untuk filter status
    public function scopeAktif($query)
    {
        return $query->where('status', 'aktif');
    }
}
