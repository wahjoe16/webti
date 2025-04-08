<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VisiMisi extends Model
{
    protected $table = 'visi_misi';
    protected $fillable = ['content', 'image_1', 'image_2', 'image_3'];
}
