<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use Sluggable;

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'code',
        'name',
        'description',
        'image',
        'category_id'
    ];
    //Elequent Connection
    public function products()
    {
        return $this->hasMany(Product::class);
    }
    public function foods()
    {
        return $this->hasMany(Food::class);
    }
    public function dishes()
    {
        return $this->hasMany(Dish::class);
    }

    public function parentCategory()
    {
        return $this->belongsTo(Category::class, 'category_id');

    }

    public function childCategories()
    {
        return $this->hasMany(Category::class, 'category_id');

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


