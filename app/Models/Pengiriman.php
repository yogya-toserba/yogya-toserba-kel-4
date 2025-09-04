<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengiriman extends Model
{
  use HasFactory;

  protected $table = 'simple_pengiriman_produk';

  protected $fillable = [
    'id_produk',
    'nama_produk',
    'tujuan',
    'jumlah',
    'tanggal_kirim',
    'status'
  ];

  protected $dates = [
    'tanggal_kirim',
    'created_at',
    'updated_at'
  ];

  // Status constants
  const STATUS_PENDING = 'pending';
  const STATUS_DIKIRIM = 'dikirim';
  const STATUS_SELESAI = 'selesai';

  public static function getStatusOptions()
  {
    return [
      self::STATUS_PENDING => 'Pending',
      self::STATUS_DIKIRIM => 'Dikirim',
      self::STATUS_SELESAI => 'Selesai'
    ];
  }

  public function getStatusLabelAttribute()
  {
    $statusLabels = [
      self::STATUS_PENDING => '<span class="badge bg-warning">Pending</span>',
      self::STATUS_DIKIRIM => '<span class="badge bg-info">Dikirim</span>',
      self::STATUS_SELESAI => '<span class="badge bg-success">Selesai</span>'
    ];

    return $statusLabels[$this->status] ?? '<span class="badge bg-secondary">Unknown</span>';
  }

  public function stok()
  {
    return $this->belongsTo(\App\Models\StokGudangPusat::class, 'id_produk', 'id_produk');
  }
}
