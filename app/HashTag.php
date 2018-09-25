<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hashtag extends Model
{
    protected $fillable = ['hashtag','messages'];
    protected $guarded = ['id', 'created_at', 'update_at'];
    protected $table = 'hashtags';
}
