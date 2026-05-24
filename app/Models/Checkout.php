<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Checkout extends Model
{
    protected $table = 'checkouts';
    use HasFactory;

    protected $fillable = [
        'user_id',
        'grand_total',
        'status',
        'shipping_address',
        'notes',
    ];

    /**
     * Relasi ke User
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Relasi ke CheckoutDetail
     */
    public function checkoutDetails()
    {
        return $this->hasMany(CheckoutDetail::class, 'checkout_id');
    }

    /**
     * Label status dalam Bahasa Indonesia
     */
    public function getStatusLabelAttribute(): string
    {
        return match($this->status) {
            'pending'    => 'Menunggu Pembayaran',
            'processing' => 'Sedang Diproses',
            'shipped'    => 'Sedang Dikirim',
            'delivered'  => 'Pesanan Selesai',
            'cancelled'  => 'Dibatalkan',
            default      => 'Menunggu Pembayaran',
        };
    }

    /**
     * CSS badge class untuk status
     */
    public function getStatusClassAttribute(): string
    {
        return match($this->status) {
            'pending'    => 'pending',
            'processing' => 'processing',
            'shipped'    => 'shipped',
            'delivered'  => 'delivered',
            'cancelled'  => 'cancelled',
            default      => 'pending',
        };
    }
}
