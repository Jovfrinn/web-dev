<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CheckoutDetail extends Model
{
    protected $table = 'checkout_details';
    use HasFactory;
    protected $fillable = ['checkout_id', 'product_id','quantity','price','sub_total'];
    public function checkout()
    {
        return $this->belongsTo(Checkout::class);
    }
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
