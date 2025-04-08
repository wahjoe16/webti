<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailUserDosen extends Model
{
    protected $table = 'detail_user_dosen';
    protected $fillable = [
        'user_id', 'jabatan', 'pendidikan', 'fungsional', 'level', 'kelompok_keahlian_id'
    ];
}
