<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable;

    protected $guard = 'admin';
    protected $table = 'admin';
    protected $fillable = [
        'name',
        'username',
        'email',
        'phone',
        'position',
        'bio',
        'avatar',
        'password',
        'last_login',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}