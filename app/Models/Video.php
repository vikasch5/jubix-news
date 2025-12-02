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

    public function views()
    {
        return $this->hasMany(View::class, 'item_id')
            ->where('type', 'video');
    }

    public function totalViews()
    {
        return $this->views()->count();
    }
}
