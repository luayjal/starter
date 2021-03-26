<?php

namespace App\Http\Controllers;

use App\Http\Requests\OfferRequest;
use App\Models\Offer;
use App\Traits\OfferTrait;
use Illuminate\Http\Request;
use LaravelLocalization;

class OfferController extends Controller
{
    use OfferTrait;

  /*   public function __construct()
    {
        $this->middleware('auth');
    } */
    public function create(){
        //view form to add this offer
        return view('ajaxoffers.create');

    }

    public function store(OfferRequest $request){
         // save offer into DB using Ajax

         //save image
     $file_name = $this->saveImage($request->offer_img ,'images/offers');

       // insert
      $offer =  Offer::create([
       'offer_img'=>$file_name,
       'name_ar' => $request -> name_ar,
       'name_en' => $request -> name_en,
       'price'=>$request -> price,
       'details_ar'=> $request -> details_ar,
       'details_en'=> $request -> details_en,
      ]);
        if($offer)
       return response()->json([
           'status'=> true,
           'msg'=>'تم الحفظ بنجاح',


           ]);
        else
            return response()->json([
                'status'=> false,
                'msg'=>'فشل الحفظ برجاء المحاولة مجددا',


            ]);
    }

    public function showAllOffers(){
        $offers = Offer::select('id',
            'price',
            'name_'.LaravelLocalization::getCurrentLocale().' as name',
            'details_'.LaravelLocalization::getCurrentLocale().' as details',
            'offer_img'
            )->get();

        return view('ajaxoffers.all',compact('offers'));

    }

    public function delete(Request $request){
        $offer = Offer::find($request -> id);
        if (!$offer)
        return response()->json(['error' => "العرض غير موجود "]);
        $offer->delete();
         return   response()->json(['
         success' => true,
         'msg' => 'تم الحذف بنجاح',
         'id' => $request->id

         ]);
    }

    public function edit(Request $request){
        //Offer::findOrFail($offer_id);
        $offer = Offer::find($request -> offer_id);
        if (!$offer)
        return response()->json(['error' => "العرض غير موجود "]);
        $offer = Offer::select('id','name_ar','name_en','price','details_ar','details_en') -> find($request -> offer_id);
        return view('ajaxoffers.edit',compact('offer'));

    }

    public function update(Request $request){
         //check if offer is exisit
         $offer = Offer::find($request -> offer_id);
         if (!$offer)
         return response()->json([
            'status' => false,
            'msg' => "العرض غير موجود "]);
         $offer->update($request->all());
          return   response()->json([
          'success' => true,
          'msg' => 'تم التعديل بنجاح',
          ]);

    }

     public function admin()
    {
        return view('admin');
    }
}
