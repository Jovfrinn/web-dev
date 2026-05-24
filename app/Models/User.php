<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable {
    protected $table = 'users';
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = ['name', 'email', 'password', 'id_role', 'phone', 'address', 'avatar'];
    protected $hidden = ['password', 'remember_token'];
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function role() { return $this->belongsTo(role::class, 'id_role'); }
    public function wishlists() { return $this->hasMany(Wishlist::class); }
    public function reviews() { return $this->hasMany(Review::class); }
    public function shoppingCarts() { return $this->hasMany(shopping_cart::class, 'user_id'); }
    public function checkouts() { return $this->hasMany(Checkout::class, 'user_id'); }
    
    public function isAdmin() { return in_array($this->id_role, [1, 2]); }
    public function isSuperAdmin() { return $this->id_role == 1; }
}
