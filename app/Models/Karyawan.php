<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Karyawan extends Model
{
    use HasFactory;

    protected $table = 'karyawan';
    protected $primaryKey = 'id_karyawan';

    protected $fillable = [
        'nama',
        'divisi',
        'alamat',
        'email',
        'tanggal_lahir',
        'nomer_telepon',
        'id_shift',
        'status'
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
    ];

    // Relationship with Shift table (commented until Shift model is created)
    // public function shift()
    // {
    //     return $this->belongsTo(Shift::class, 'id_shift', 'id_shift');
    // }

    // Accessor for formatted phone number
    public function getFormattedPhoneAttribute()
    {
        return '+62 ' . substr($this->nomer_telepon, 1);
    }

    // Accessor for age calculation
    public function getAgeAttribute()
    {
        return Carbon::parse($this->tanggal_lahir)->age;
    }
}
