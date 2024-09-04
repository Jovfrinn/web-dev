<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class shopping_cart extends Model
{
    protected $table = 'shopping_carts';
    use HasFactory;
    protected $fillable =['user_id','product_id','quantity','sub_total'];

    public function user()
{
    return $this->belongsTo(User::class);
}

public function product()
{
    return $this->belongsTo(Product::class);
}
public function checkout()
{
    return $this->belongsTo(Checkout::class);
}

}
