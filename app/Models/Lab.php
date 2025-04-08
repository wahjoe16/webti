<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lab extends Model
{
    protected $fillable = [
        'name', 'location', 'user_id',
        'description', 'image_1', 'image_2',
        'image_3', 'image_4', 'image_5',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
