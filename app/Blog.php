<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = [
        'title',
        'category',
        'description',
        'photo',
        'user_id'
    ];
}
