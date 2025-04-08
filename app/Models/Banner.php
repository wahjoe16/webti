<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $fillable = [
        'caption', 'link', 'image_1', 'image_2', 'image_3,image_4'
    ];
}
