<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    protected $fillable = [
        'comment_id',
        'name',
        'reply',
        'user_id'
    ];
    public function comment()
    {
        return $this->belongsTo(Comment::class);
    }
}
