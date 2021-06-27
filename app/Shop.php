<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
        protected $fillable = ['slug','name','user_id','image','theme_code', 'active', 'phone', 'address','work_time'];

        protected $table = 'shops';
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function themes()
    {
        return $this->belongsTo(Theme::class, 'theme_code', 'code');
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

}
