<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

class VideoController
{
    public function index(){
        return view("backend.pages.video-list");
    }
}
