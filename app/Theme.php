<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Theme extends Model
{
    protected $fillable = ['id','code','name','description'];
    public function shops()
    {
        return $this->hasMany(Shop::class,'theme_code','code');
    }
}
