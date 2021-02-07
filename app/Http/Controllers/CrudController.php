<?php

namespace App\Http\Controllers;

use App\Http\Requests\OfferRequest;
use App\Http\Requests\updateRequest;
use App\Models\Offer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use LaravelLocalization;

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

    public function store(OfferRequest $request){

     /* //validate data before insert to database
        $rules =$this-> getRules();
       $messages = $this->getmessages();
        $validator = Validator::make($request->all(), $rules, $messages) ;

        if ($validator -> fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }
     */


        // insert
        Offer::create([
        'name_ar' => $request -> name_ar,
        'name_en' => $request -> name_en,
        'price'=>$request -> price,
        'details_ar'=> $request -> details_ar,
        'details_en'=> $request -> details_en,
       ]);

        return redirect()->back()->with(['success'=>'Success Add Offer']);

    }
    /* protected function getmessages(){
       return $messages = [
            'name.required' => __('messages.offer name'),
            'name.unique' => __('messages.offer nameun'),
            'name.max' => __('messages.offer namemx'),
            'price.required' =>__('messages.offer price req'),
            'price.numeric' =>__('messages.offer price num'),
            'details.required' => __('messages.offer details'),
        ];
    }

    protected function getRules(){
        return $rules =[
            'name' =>  'required|max:100|unique:offers,name',
            'price' =>  'required|numeric',
            'details' =>  'required',
           ];
    } */

    public function getAllOffers(){

        $offers = Offer::select('id','price','name_'.LaravelLocalization::getCurrentLocale().' as name','details_'.LaravelLocalization::getCurrentLocale().' as details')->get();
        return view('offers.all',compact('offers'));
    }

    public function editOffer($offer_id){
        //Offer::findOrFail($offer_id);
        $offer = Offer::find($offer_id);
        if (!$offer)
            return redirect() -> back();
        $offer = Offer::select('id','name_ar','name_en','price','details_ar','details_en') -> find($offer_id);
        return view('offers.edit',compact('offer'));

    }

    public function updateOffer(updateRequest $request,$offer_id){
        //check if offer is exisit
        $offer = Offer::find($offer_id);
        if (!$offer)
             return redirect() -> back();

        // update data
        $offer -> update($request -> all());

        return redirect()->back()-> with(['success' => __('messages.message success')]);

       /*  $offer -> update([
            'name_ar'=>$request->name_ar,
            'price'=> $request->price
        ]); */
    }
}
