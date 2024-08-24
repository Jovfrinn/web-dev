<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class shopping_cart extends Model
{
    protected $table = 'shopping_cart';
    use HasFactory;
    protected $fillable =['user_id','product_id','quantity','price','total_price','status'];
}
