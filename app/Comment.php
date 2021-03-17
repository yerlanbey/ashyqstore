<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['name','comment', 'user_id','product_code'];

//    public function productWithComment()
//    {
//        return $this->belongsTo(Product::class);
//    }

    public function IsUser(){
        return $this->belongsTo(User::class, 'user_id');
    }

//    public function product()
//    {
//        return $this->belongsTo(Product::class,'product_code','code');
//    }
    public function replies()
    {
        return $this->hasMany(Reply::class);
    }
}
