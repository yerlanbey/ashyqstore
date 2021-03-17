<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    protected $table = 'colors';
    protected $fillable = ['name', 'code'];

    public function products()
    {
        return $this->belongsToMany(Product::class)->withTimestamps();
    }
}
