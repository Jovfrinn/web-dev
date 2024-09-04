<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Checkout extends Model
{
    protected $table = 'checkouts';
    use HasFactory;
    protected $fillable = ['user_id', 'grand_total'];

    public function details()
    {
        return $this->hasMany(CheckoutDetail::class);
    }
}
