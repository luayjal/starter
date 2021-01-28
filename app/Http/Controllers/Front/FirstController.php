<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
class FirstController extends Controller
{
    public function showString(){
        return 'static string';
    }
    

    public function getIndex(){

        $data=[];
        $data['id']=2;
        $data['name']= 'Loay Abu Jalhoum';
        return view('welcome',$data);
    }

    public function LandingFunc(){
        return view('front/landing');
    }
}
