<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class View extends Model
{
     protected $fillable = ['type', 'item_id', 'ip', 'user_agent'];
}
