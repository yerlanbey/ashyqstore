<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Food extends Model
{
    use SoftDeletes;
    protected $fillable = ['category_id','name','slug', 'description','image',
        'price','user_id','count','market_id', 'draft'];

    protected $table = 'foods';
    // Price Calculation

    public function getPriceForCount()
    {
        if(!is_null($this->pivot))
        {
            return $this->pivot->count * $this->price;
        }
        return $this->price;
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

    public function market()
    {
        return $this->belongsTo(Market::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function isAvailable()
    {
        return !$this->trashed() && $this->count > 0;
    }

    public function setDraftAttribute($value)
    {
        $this->attributes['draft'] = $value === 'on' ? 1 : 0;
    }
}
