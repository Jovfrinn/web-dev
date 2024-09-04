<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Checkout extends Model
{
    protected $table = 'checkout';
    use HasFactory;
    protected $fillable = ['checkout_id', 'product_id', 'quantity', 'price'];

    public function User(){
        return $this->belongsTo(User::class);
    }

    public function product(){
        return $this->belongsTo(Product::class);
    }
}
