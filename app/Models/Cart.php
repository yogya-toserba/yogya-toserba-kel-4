<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [
        'id_pelanggan',
        'session_id',
        'id_produk',
        'quantity',
        'price',
        'product_options'
    ];

    protected $casts = [
        'product_options' => 'array',
        'price' => 'decimal:2'
    ];

    // Relationship with Pelanggan
    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'id_pelanggan', 'id_pelanggan');
    }

    // Relationship with StokProduk
    public function product()
    {
        return $this->belongsTo(StokProduk::class, 'id_produk', 'id_produk');
    }

    // Get subtotal for this cart item
    public function getSubtotalAttribute()
    {
        return $this->price * $this->quantity;
    }

    // Get formatted subtotal
    public function getFormattedSubtotalAttribute()
    {
        return 'Rp ' . number_format($this->subtotal, 0, ',', '.');
    }

    // Get formatted price
    public function getFormattedPriceAttribute()
    {
        return 'Rp ' . number_format((float) $this->price, 0, ',', '.');
    }

    // Scope for getting cart items by user (authenticated)
    public function scopeForUser($query, $userId)
    {
        return $query->where('id_pelanggan', $userId);
    }

    // Scope for getting cart items by session (guest)
    public function scopeForSession($query, $sessionId)
    {
        return $query->where('session_id', $sessionId)->whereNull('id_pelanggan');
    }

    // Scope for getting cart items (user or session)
    public function scopeForUserOrSession($query, $userId = null, $sessionId = null)
    {
        if ($userId) {
            return $query->forUser($userId);
        } elseif ($sessionId) {
            return $query->forSession($sessionId);
        }
        
        return $query->where('id', 0); // Return empty result
    }

    // Get cart total for user or session
    public static function getTotalForUserOrSession($userId = null, $sessionId = null)
    {
        $cartItems = self::forUserOrSession($userId, $sessionId)->get();
        return $cartItems->sum('subtotal');
    }

    // Get cart count for user or session
    public static function getCountForUserOrSession($userId = null, $sessionId = null)
    {
        return self::forUserOrSession($userId, $sessionId)->sum('quantity');
    }
}
