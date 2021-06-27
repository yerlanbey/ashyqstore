<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dish extends Model
{
    use SoftDeletes;
    protected $table = 'dishes';
    protected $fillable = ['category_id','name','slug','description','image',
        'price','user_id','count','restaurant_id','draft'];

    // Price Calculation

    public function getPriceForCount()
    {
        if(!is_null($this->pivot))
        {
            return $this->pivot->count * $this->price;
        }
        return $this->price;
    }
    public function setDraftAttribute($value)
    {
        $this->attributes['draft'] = $value === 'on' ? 1 : 0;
    }
    // Eloquent connections

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function photos()
    {
        return $this->hasMany(Photo::class);
    }

    public function likes()
    {
        return $this->morphMany('App\Like','likeable');
    }

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function isAvailable()
    {
        return !$this->trashed() && $this->count > 0;
    }

}
