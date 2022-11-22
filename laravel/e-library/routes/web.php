<?php

use Illuminate\Support\Facades\Route;

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
Auth::routes();

Route::get('/admin/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/admin/login', 'Auth\LoginController@login')->name('login');

Route::post('/admin/logout', 'Auth\LoginController@logout')->name('logout')->middleware('admin');;

Route::post('admin/login_submit','Auth\LoginController@login_submit')->name('login_submit');

//register
Route::post('register_member','Auth\LoginController@register')->name('register_member');



Route::get('admin/home',function(){
    return view('backend.dashboard.index');
});
Route::get('/dashboard', function () {
    return view('backend.dashboard.index');
})->middleware('auth');

  
Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {

    Route::get('/dashboard', function () {
        return view('backend.dashboard.index');
    });

    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    
    //author
    Route::resource('authors','AuthorController');

    //e_book
    Route::resource('e_books','EbookController');

    Route::get('/e_books/delete/{id}', 'EbookController@destroy')
         ->name('e_books.destroy');

    //member
    Route::resource('member','MemberController');

    //category
    Route::resource('categories','CategoryController');

    //rack
    Route::resource('rack','RackController');

    //physical book
    Route::resource('physical_books','PhysicalBookController');

    // book issue
    Route::resource('bookissue','BookIssueController');

    //sliders
    Route::resource('sliders','SliderController');

    //slider status
    Route::get('change_slider_status','SliderController@change_slider_status')->name('change_slider_status');

    Route::get('/bookissue/renewandreturn','BookIssueController@renew');

    //ebook rent
    Route::resource('ebook_rents','EbookRentController');

    //qr generate
    Route::get('qr_generate/{id}','BookIssueController@qr_generate')->name('qr_generate');

    //download qr
    Route::get('downloadQR/{id}','BookIssueController@downloadQR')->name('downloadQR');

    //generate book code
    Route::get('generate_book_code','PhysicalBookController@generate_book_code')->name('generate_book_code');

    //get_member_data
    Route::get('get_member_data','PhysicalBookController@get_member_data')->name('get_member_data');

    //get_book_data
    Route::get('get_book_data','PhysicalBookController@get_book_data')->name('get_book_data');

    //favourite
    Route::resource('favourites','FavouriteController');

    //request book
    Route::resource('request_books','RequestBookController');
});

//frontend
Route::get('/','FrontendController@index')->name('frontend_home');

Route::get('category_detail/{id}','FrontendController@category_detail')->name('category_detail');

Route::get('cat_detail','FrontendController@cat_detail')->name('cat_detail');

Route::get('category_list_view/{id}','FrontendController@category_list_view')->name('category_list_view');

Route::get('ebook_view_detail/{id}','FrontendController@ebook_view_detail')->name('ebook_view_detail');

Route::get('/sign_in',function(){
    return view('frontend.auth.sign_in');
});

Route::get('/sign_up',function(){
    return view('frontend.auth.sign_up');
});

Route::post('register','FrontendAuthController@register')->name('register');

Route::post('sign_in','FrontendAuthController@sign_in')->name('sign_in');

Route::get('ebooks_list','FrontendController@ebook_list');

Route::get('member_ebooks','FrontendController@member_ebooks')->name('member_ebooks');

Route::get('edit_profile','FrontendController@edit_profile')->name('edit_profile');

Route::put('update_profile/{id}','FrontendController@update_profile')->name('update_profile');

Route::get('member_logout', 'FrontendAuthController@logout');

Route::get('rent_book/{id}','FrontendController@rent_book')->name('rent_book');

Route::get('author_detail/{id}','FrontendController@author_detail')->name('author_deail');

Route::post('add_ebook_list','FrontendController@add_ebook_list')->name('add_ebook_list');

Route::get('favourite_list/{id}','FrontendController@favourite_list')->name('favourite_list');

Route::delete('favourite_delete/{id}','FrontendController@favourite_delete')->name('favourites.destroy');

Route::get('about_us','FrontendController@about_us')->name('about_us');

Route::get('contact_us','FrontendController@contact_us')->name('contact_us');

Route::post('contact_mail','FrontendController@contact_mail')->name('contact_mail');

Route::get('request_book','FrontendController@request_book')->name('request');

Route::post('create_request_book','FrontendController@create_request_book')->name('create_request_book');

Route::get('my_request_list/{id}','FrontendController@my_request_list')->name('my_request_list');

