<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImagesProduct extends Model
{
    protected $table = 'images_products';
    use HasFactory;
    protected $fillable =['imageName','is_thumb', 'id_product', 'timestamp'];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}

