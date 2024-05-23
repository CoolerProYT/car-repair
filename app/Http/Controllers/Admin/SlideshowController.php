<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SlideshowController extends Controller
{
    public function slideshow(){
        return view('admin.slideshow');
    }
}
