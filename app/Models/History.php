<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    protected $fillable = ['description', 'content', 'image_1', 'image_2', 'image_3'];
}
