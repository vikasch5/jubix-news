<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $fillable = [
        'id',
        'title',
        'description',
        'youtube_link',
        'meta_title',
        'meta_details',
        'meta_keyword',
        'status',
        'slug',
    ];
}
