<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassifiedAds extends Model
{
    protected $fillable = [
        'title',
        'link',
        'image',
        'status',
    ];
}
