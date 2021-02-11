<?php

namespace App\Http\Controllers;

use App\Events\VideoViewer;
use App\Models\Video;
use Illuminate\Http\Request;

class ViewController extends Controller
{
    public function gitVideo(){
       $video =  Video::first();

       event(new VideoViewer($video) );
        return view('video')-> with('video',$video);
    }
}
