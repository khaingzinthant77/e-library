<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//post api
Route::get('news', 'Api\PostApiController@index');

Route::post('news', 'Api\PostApiController@store');

Route::post('newsupdate/{id}', 'Api\PostApiController@update');

Route::delete('news/{id}','Api\PostApiController@destroy');

Route::post('token_create','Api\TokenApiController@token_create');

Route::get('get_noti', 'Api\PostApiController@getNoti');

Route::get('popup_ad','Api\PopupAdApiController@getPopup_ad');

Route::post('rating','Api\TokenApiController@rating');

Route::get('billing_contact','Api\PostApiController@billing_contact')->name('billing_contact');

Route::get('setting_url','Api\PostApiController@setting_url')->name('setting_url');
/*
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
*/