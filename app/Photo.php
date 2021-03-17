<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $fillable = ['name','product_id','image'];

//    public function products(){
//        return $this->belongsTo(Product::class,'product_id');
//
//    }
}
