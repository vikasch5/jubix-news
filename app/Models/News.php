<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $fillable = [
        'id',
        'title',
        'description',
        'category_id',
        'sub_category_id',
        'images',
        'slug',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'status',
        'show_on_home',
        'reporter_name',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function subCategory()
    {
        return $this->belongsTo(Category::class, 'sub_category_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'news_id');
    }
}
