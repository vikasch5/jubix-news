<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ads extends Model
{
    protected $fillable = [
        'title',
        'link',
        'position',
        'image',
        'status',
    ];
}
