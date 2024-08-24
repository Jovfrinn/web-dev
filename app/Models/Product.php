<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'product';
    use HasFactory;
    protected $fillable = ['name_product','description_product', 'price', 'stock_quantity', 'category_id', 'timestamp'];
}
