<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [

        'title',
        'price',
        'location',
        'category',
        'description',
        'phone',
        'rating',
        'photo',
        'meeting_date_start',
        'meeting_date_end',
        'meeting_time',
        'user_id'
    ];


}
