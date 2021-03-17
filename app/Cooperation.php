<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cooperation extends Model
{
    protected $fillable =['first_name','phone_number'];
    protected $table = 'cooperations';
}
