<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kas extends Model
{
    use HasFactory;
    
    protected $table = 'kas';
    protected $primaryKey = 'id_kas';
    
    protected $fillable = [
        'id_transaksi',
        'tanggal',
        'keterangan',
        'debit',
        'kredit',
        'saldo',
        'jenis_transaksi'
    ];
    
    protected $casts = [
        'tanggal' => 'date',
        'debit' => 'decimal:2',
        'kredit' => 'decimal:2',
        'saldo' => 'decimal:2',
    ];
    
    /**
     * Relasi ke transaksi
     */
    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class, 'id_transaksi', 'id_transaksi');
    }
    
    /**
     * Scope untuk transaksi debit
     */
    public function scopeDebit($query)
    {
        return $query->where('debit', '>', 0);
    }
    
    /**
     * Scope untuk transaksi kredit
     */
    public function scopeKredit($query)
    {
        return $query->where('kredit', '>', 0);
    }
    
    /**
     * Scope berdasarkan jenis transaksi
     */
    public function scopeJenis($query, $jenis)
    {
        return $query->where('jenis_transaksi', $jenis);
    }
}
