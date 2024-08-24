<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImagesProduct extends Model
{
    protected $table = 'imagesproduct';
    use HasFactory;
    protected $fillable =['imageName', 'id_product', 'timestamp'];
}

