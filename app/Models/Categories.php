<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    protected $table = 'categories';

    use HasFactory;

    protected $fillable = ['name_categories', 'timestamp'];


    public function products()
    {
        return $this->hasMany(Product::class,'category_id');
    }
}
