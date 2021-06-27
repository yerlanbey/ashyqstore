<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{

    use SoftDeletes, Sluggable;
    protected $fillable = ['name','slug','category_id','description','image','price',
        'hit','new','recommend','draft','sales','size','color','user_id','count','shop_id'];

    protected $casts = [
        'color' => 'array',
        'size' => 'array',
    ];
    /**
     * @var mixed
     */


    // Eloquent connections

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function photos()
    {
        return $this->hasMany(Photo::class);
    }

    public function likes()
    {
        return $this->morphMany('App\Like','likeable');
    }

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    // Mutator's
    public function setDraftAttribute($value)
    {
        $this->attributes['draft'] = $value === 'on' ? 1 : 0;
    }

    public function setNewAttribute($value)
    {
        $this->attributes['new'] = $value === 'on' ? 1 : 0;
    }

    public function setHitAttribute($value)
    {
        $this->attributes['hit'] = $value === 'on' ? 1 : 0;
    }

    public function setRecommendAttribute($value)
    {
        $this->attributes['recommend'] = $value === 'on' ? 1 : 0;
    }

    // Checking

    public function isAvailable()
    {
        return !$this->trashed() && $this->count > 0;
    }

    public function isNew()
    {
        return $this->new === 1;
    }
    public function isHit()
    {
        return $this->hit === 1;
    }
    public function isRecommend()
    {
        return $this->recommend === 1;
    }


    // Price Calculation

    public function getPriceForCount()
    {
        if(!is_null($this->pivot))
        {
            return $this->pivot->count * $this->price;
        }
        return $this->price;
    }

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
}
