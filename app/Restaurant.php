<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use Sluggable;

    protected $fillable = ['slug','name','user_id','image','theme_code', 'active', 'phone', 'address','work_time'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function themes()
    {
        return $this->belongsTo(Theme::class, 'theme_code', 'code');
    }

    public function dishes()
    {
        return $this->hasMany(Dish::class);
    }

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
}
