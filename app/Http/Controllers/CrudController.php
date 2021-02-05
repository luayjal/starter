<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CrudController extends Controller
{
    public function getOffers(){
        return Offer::select();
    }

    /* public function store(){
        Offer::create([
            'name' => 'Mobile2',
            'price'=>'200',
            'details'=> 'details mobile',
        ]);
    } */

    public function create(){
        return view('offers.create');
    }

    public function store(Request $request){

       //validate data before insert to database
       $rules =[
        'name' =>  'required|max:100|unique:offers,name',
        'price' =>  'required|numeric',
        'details' =>  'required',
       ];

       $messages = [
        'name.required' => __('messages.offer name'),
        'name.unique' => __('messages.offer nameun'),
        'name.max' => __('messages.offer namemx'),
        'price.required' =>__('messages.offer price req'),
        'price.numeric' =>__('messages.offer price num'),
        'details.required' => __('messages.offer details'),
    ];
        $validator = Validator::make($request->all(), $rules, $messages) ;

        if ($validator -> fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

       // insert
       Offer::create([
        'name' => $request -> name,
        'price'=>$request -> price,
        'details'=> $request -> details,
       ]);

        return redirect()->back()->with(['success'=>'Success Add Offer']);

    }
}
