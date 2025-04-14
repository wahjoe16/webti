<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title', 'slug', 'post_date', 'description' ,'content', 'status', 'featured_image', 'tags', 'meta_keywords', 'meta_description', 'visibility', 'user_id', 'category_id'];

    public function categories()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
