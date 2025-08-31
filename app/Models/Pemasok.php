<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemasok extends Model
{
    use HasFactory;
    
    protected $table = 'pemasok';
    protected $primaryKey = 'id_pemasok';
    
    protected $fillable = [
        'nama_perusahaan',
        'kontak_person', 
        'telepon',
        'email',
        'alamat',
        'kota',
        'kategori_produk',
        'tanggal_kerjasama',
        'status',
        'catatan',
        'rating'
    ];
    
    protected $casts = [
        'tanggal_kerjasama' => 'date',
        'rating' => 'decimal:1'
    ];
    
    // Scope untuk filter status
    public function scopeAktif($query)
    {
        return $query->where('status', 'aktif');
    }
    
    public function scopeNonAktif($query)
    {
        return $query->where('status', 'non-aktif');
    }
    
    // Scope untuk search
    public function scopeSearch($query, $search)
    {
        return $query->where(function($q) use ($search) {
            $q->where('nama_perusahaan', 'like', "%{$search}%")
              ->orWhere('kontak_person', 'like', "%{$search}%")
              ->orWhere('kategori_produk', 'like', "%{$search}%")
              ->orWhere('kota', 'like', "%{$search}%");
        });
    }
    
    // Scope untuk filter kategori
    public function scopeKategori($query, $kategori)
    {
        return $query->where('kategori_produk', 'like', "%{$kategori}%");
    }
}
