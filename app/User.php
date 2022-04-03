<?php

namespace App;

use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Notifications\Notifiable;
use App\Order;
use App\Like;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class User extends Authenticatable implements CanResetPassword
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
            $registrationRole = 2;
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
        return $this->hasMany(Restaurant::class);
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

    public static function activateOrganization($parameters, $user)
    {
        // Соединяем три коллекций в одну
        $relations = ($user->shops)->merge($user->markets)->merge($user->restaurants);

        //Проверяем есть ли массив 'active' в request
        if(isset($parameters['active'])){
            //Получаем ключи ( получаем slugs )
            $slugs = array_keys($parameters['active']);

            $relations->whereIn('slug', $slugs)->map(function ($query){
                $query->update([
                    'active' => 1
                ]);
            });
            $relations->whereNotIn('slug', $slugs)->map(function ($query){
                $query->update([
                    'active' => 0
                ]);
            });
        }else{
            $relations->map(function ($query) {
                return $query->update([
                    'active' => 0
                ]);
            });
        }
        return true;
    }


    public static function rolesChanges($request, $user)
    {
        if(isset($request->roles)){
            foreach($request->roles as $role){
                if(!($user->roles->contains($role))){
                    $user->roles()->update(['role_id' => $role]);
                }else{
                    unset($request->roles);
                }
            }
        }else{
            return redirect()->route('user.index', $user->id)->with('warning', 'Укажите роль пользователя');
        }
    }
}
