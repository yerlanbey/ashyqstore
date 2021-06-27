<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Theme extends Model
{
    use Sluggable;
    protected $fillable = ['id','code','name','description'];
    public function shops()
    {
        return $this->hasMany(Shop::class,'theme_code','code');
    }
    public function sluggable()
    {
        return [
            'code' => [
                'source' => 'name'
            ]
        ];
    }
}
