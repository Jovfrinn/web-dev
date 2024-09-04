<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    use HasFactory;
    protected $fillable = ['name_product','description_product', 'price', 'stock', 'category_id', 'timestamp'];

    public function images()
    {
        return $this->hasMany(ImagesProduct::class, 'id_product');
    }

    public function category()
    {
        return $this->belongsTo(Categories::class);
    }


    public function increaseStock(int $amount)
    {
        $this->stock += $amount;
        $this->save();
    }

    public function decreaseStock(int $amount)
    {
        if ($this->stock >= $amount) {
            $this->stock -= $amount;
            $this->save();
        } else {
            throw new \Exception('Stok tidak cukup');
        }
    }
    public function checkout()
    {
        return $this->hasMany(Checkout::class);
    }
    public function checkoutDetails()
    {
        return $this->hasMany(CheckoutDetail::class, 'product_id');
    }
  
}

