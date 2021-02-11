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

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $data=[];
    $data['id']=2;
    $data['name']= 'Loay Abu Jalhoum';
    return view('welcome',$data);
});

Route::get('index','Front\FirstController@getIndex');

Route::get('/test1', function () {
    return 'welcome';
});

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

                Route::get('all', 'CrudController@getAllOffers');

             });
             Route::get('youtube','ViewController@gitVideo');
    });

