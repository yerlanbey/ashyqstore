<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $fillable = ['name','product_id','image'];

    public function products()
    {
        return $this->belongsTo(Product::class,'product_id');
    }

    public function foods()
    {
        return $this->belongsTo(Food::class, 'food_id');
    }

    public function dishes()
    {
        return $this->belongsTo(Dish::class, 'dish_id');
    }
}
