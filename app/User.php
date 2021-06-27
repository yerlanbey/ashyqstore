<?php

namespace App;

use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Notifications\Notifiable;
use App\Order;
use App\Like;
class User extends Authenticatable implements MustVerifyEmail, CanResetPassword
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    public $table = 'users';
    protected $fillable = [
        'name',
        'email',
        'password',
        'created_at',
        'updated_at',
        'deleted_at',
        'remember_token',
        'email_verified_at',
        'is_admin',
        'image'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        self::created(function (User $user) {
            $registrationRole = 3;
            if (!$user->roles()->get()->contains($registrationRole)) {
                $user->roles()->attach($registrationRole);
            }
        });
    }
    public function MainAdmin()
    {
        return $this->is_admin === 2;
    }

    public function isAdmin() {
      return $this->is_admin === 1;
    }

    public function likes()
    {
      return $this->hasMany('App\Like', 'user_id');
    }

    public function orders()
    {
      return $this->hasMany(Order::class,'user_id');
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function shops()
    {
        return $this->hasMany(Shop::class);
    }

    public function markets()
    {
        return $this->hasMany(Market::class);
    }

    public function restaurants()
    {
        return$this->hasMany(Restaurant::class);
    }
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function comments(){
      return $this->hasMany(Comment::class);
    }

    public function hasLikedProduct(Product $product)
    {
      return (bool) $product->likes
      ->where('likeable_id', $product->id)
      ->where('likeable_type', get_class($product))
      ->where('user_id', $this->id)
      ->count();
    }

}
