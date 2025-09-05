<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class PemasokUser extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'pemasok_users';

    protected $fillable = [
        'pemasok_id',
        'username',
        'email',
        'password',
        'nama_lengkap',
        'telepon',
        'status',
        'last_login'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'last_login' => 'datetime',
        'password' => 'hashed',
    ];

    // Relasi dengan pemasok
    public function pemasok()
    {
        return $this->belongsTo(Pemasok::class, 'pemasok_id', 'id_pemasok');
    }

    // Relasi dengan chat rooms
    public function chatRooms()
    {
        return $this->hasMany(ChatRoom::class, 'pemasok_id', 'pemasok_id');
    }

    // Scope untuk filter status
    public function scopeAktif($query)
    {
        return $query->where('status', 'aktif');
    }

    public function scopeNonAktif($query)
    {
        return $query->where('status', 'non-aktif');
    }
}
