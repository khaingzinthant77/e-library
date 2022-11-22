<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//login
Route::get('login','Api\AuthApiController@login');

//category list
Route::get('categories','Api\CategoryApiController@get_all_category');

//book list by category
Route::get('category_book','Api\CategoryApiController@category_book_list');

//book detail
Route::get('book_detail','Api\BookApiController@book_detail');

//author list
Route::get('authors','Api\AuthorApiController@get_all_author');

//author detail
Route::get('author_detail','Api\AuthorApiController@author_detail');

//sing up
Route::post('sign_up','Api\AuthApiController@sign_up');

//home
Route::get('home','Api\BookApiController@home');

//book rating
Route::post('book_rating','Api\BookApiController@book_rating');

//ebook rent
Route::post('ebook_rent','Api\BookApiController@ebook_rent');

//my book api
Route::post('my_book','Api\BookApiController@my_book');

//author book
Route::post('author_books','Api\BookApiController@author_book');

//see all 
Route::post('home_book_list','Api\BookApiController@home_book_list');

//physical book rent list
Route::post('physical_rent_list','Api\PhysicalApiController@physical_rent_list');

//physical book rent
Route::post('physical_book_rent','Api\PhysicalApiController@physical_book_rent');

//physical book detail
Route::post('p_book_detail','Api\PhysicalApiController@p_book_detail');

//favourite
Route::post('add_favourite','Api\BookApiController@add_favourite');

//favourite list
Route::post('favourite_list','Api\BookApiController@favourite_list');

//all book api
Route::post('all_books','Api\BookApiController@all_books');

//create request book
Route::post('request_book','Api\BookApiController@request_book');

//request book list
Route::post('request_book_list','Api\BookApiController@request_book_list');

