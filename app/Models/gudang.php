<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Gudang extends Authenticatable
{
    use Notifiable;

    protected $table = 'gudang';
    protected $primaryKey = 'id_gudang';
    protected $guard = 'gudang';

    protected $fillable = [
        'id_gudang',
        'nama_gudang', 
        'password',
        'lokasi',
        'status',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'password' => 'hashed',
        'status' => 'boolean',
    ];
}
