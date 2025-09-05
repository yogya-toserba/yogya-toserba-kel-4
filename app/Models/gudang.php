<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Gudang extends Authenticatable
{
    use Notifiable;

    protected $table = 'gudang';
    protected $primaryKey = 'id_gudang'; // Use 'id_gudang' as primary key
    protected $keyType = 'string'; // Since id_gudang is string
    public $incrementing = false; // Since it's not auto-increment
    protected $guard = 'gudang';

    // Define the username field for authentication
    public function getAuthIdentifierName()
    {
        return 'id_gudang'; // Use id_gudang for login
    }

    protected $fillable = [
        'id_gudang',
        'nama_gudang',
        'password',
        'lokasi',
        'kapasitas',
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
