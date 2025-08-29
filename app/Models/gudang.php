<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Gudang extends Authenticatable
{
    use Notifiable;

    protected $table = 'gudang';
    protected $primaryKey = 'id'; // Use 'id' as primary key, not 'id_gudang'
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
        'status' => 'string', // status is enum, not boolean
    ];
}
