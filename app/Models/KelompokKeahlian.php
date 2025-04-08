<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KelompokKeahlian extends Model
{
    protected $table = 'kelompok_keahlian';
    protected $fillable = ['nama_kelompok', 'description'];
}
