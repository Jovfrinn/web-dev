<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class role extends Model
{
    protected $table = 'role';
    use HasFactory;
    protected $fillable = ['name_role','timestamp'];
}
