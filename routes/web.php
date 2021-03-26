<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', function () {
    $data=[];
    $data['id']=2;
    $data['name']= 'Loay Abu Jalhoum';
    return view('welcome',$data);
});

Route::get('index','Front\FirstController@getIndex');

Route::get('/dash', function () {
    return 'Not adualt';
}) -> name('not.adult');

//route name

Route::namespace('Front')->group(function(){

    Route::get('first','FirstController@showString');
});

//Route::get('first','Front\FirstController@showString');

/*
|*****************|
 |***middleware***|
|*****************|

Route::get('first','Front\FirstController@showString')->middleware('auth);

Route::group(['middleware' => 'auth'],function(){
    Route::get('users','Controller@showString');
});

*/

Route::resource('news','NewsController');

//Routing Landing Page
Route::get('/landing','Front\FirstController@LandingFunc' );
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home') ->middleware('verified');

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/redirect/{service}', 'socialController@redirect');
Route::get('/callback/{service}', 'socialController@callback');


   /*  Route::get('store','CrudController@store' ); */
    Route::group(
        [
        'prefix' => LaravelLocalization::setLocale() ,
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
        ],
         function () {
            Route::group(['prefix' => 'offers'], function () {

                Route::get('create', 'CrudController@create');
                Route::post('store','CrudController@store' ) -> name('offers.store');

                Route::get('edit/{offer_id}', 'CrudController@editOffer');
                Route::post('update/{offer_id}','CrudController@updateOffer' )->name('offers.update');
                Route::get('delete/{offer_id}','CrudController@delete' )->name('offers.delete');

                Route::get('all', 'CrudController@getAllOffers') ->name('offers.all');

             });
             Route::get('youtube','ViewController@gitVideo') ->middleware('auth');
    });

/*#############  Begin Ajax routes  #################*/
Route::group(['prefix'=>'ajaxoffer'],function () {
    Route::get('create','OfferController@create');
    Route::post('store','OfferController@store')->name('ajax.offers.store');
    Route::get('all', 'OfferController@showAllOffers') ->name('ajax.offers.all');
    Route::post('delete','OfferController@delete' )->name('ajax.offers.delete');
    Route::get('edit/{offer_id}', 'OfferController@edit')->name('ajax.offers.edit');
    Route::post('update','OfferController@update' )->name('ajax.offers.update');
});

/*##############  End Ajax routes  ###############*/

################ Start Authentication && Guards################

Route::group([ 'middleware' => 'checkAge','namespace' => 'Auth'],function(){
    Route::get('adults','CustomAuthContoller@adualt') -> name('adult');
});

Route::group(['namespace' => 'Auth'],function () {
    Route::get('site','CustomAuthContoller@site') ->middleware('auth:web') -> name('site');
    Route::get('admin','CustomAuthContoller@admin')->middleware('auth:admin') -> name('admin');
    Route::get('admin/login','CustomAuthContoller@adminLogin') -> name('admin.login');
    Route::post('admin/login','CustomAuthContoller@checkAdminLogin') -> name('save.admin.login');
});


################## End Authentication && Guards################

################ Start Relations Routes ######################
Route::get('hospital-has-many','Realtion\RelationsController@getHospitalDoctors');
Route::get('hospitals','Realtion\RelationsController@hospitals');
Route::get('hospitals/{hospital_id}','Realtion\RelationsController@deleteHospital')->name('hospital.delete');
Route::get('doctors/{hospital_id}','Realtion\RelationsController@doctors')->name('hospital.doctors');
Route::get('hospitals-has-doctors','Realtion\RelationsController@hospitalHasDoctor');
Route::get('hospitals-has-doctors-male','Realtion\RelationsController@hospitalHasOnlyMaleDoctors');
Route::get('hospitals-not-has-doctors','Realtion\RelationsController@hospitalNotHasDoctors');
################ End Relations Routes ######################
