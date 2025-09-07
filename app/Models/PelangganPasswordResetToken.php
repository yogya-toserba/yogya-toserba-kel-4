<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PelangganPasswordResetToken extends Model
{
  protected $table = 'pelanggan_password_reset_tokens';

  protected $primaryKey = 'email';

  public $incrementing = false;

  protected $keyType = 'string';

  public $timestamps = false;

  protected $fillable = [
    'email',
    'token',
    'created_at'
  ];

  protected $dates = [
    'created_at'
  ];
}
