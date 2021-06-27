<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['name', 'comment', 'user_id', 'product_code', 'food_code','dish_code'];

    public function productWithComment()
    {
        return $this->belongsTo(Product::class);
    }

    public function IsUser()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_code', 'slug');
    }

    public function food()
    {
        return$this->belongsTo(Food::class, 'food_code', 'slug');
    }

    public function dish()
    {
        return $this->belongsTo(Dish::class,'dish_code', 'slug');
    }
    public function replies()
    {
        return $this->hasMany(Reply::class);
    }
}
