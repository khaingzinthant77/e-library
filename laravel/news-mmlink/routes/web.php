<?php


Auth::routes();

Route::post('loginrequest','admin\LoginApiController@loginrequest')->name('loginrequest');

Route::get('otp','admin\LoginApiController@otpPassword')->name('otpPassword');

Route::post('apiLogin','admin\LoginApiController@apiLogin')->name('apiLogin');

Route::post('/logout','admin\LoginApiController@logout')->name('logout');


Route::get('/','NewsController@index' )->name('news');

Route::resource('/news','NewsController');

Route::get('change-status-news', 'NewsController@changestatus')->name('change-status-news');

Route::get('change-status-popup','PopupAdController@changestatus')->name('change-status-popup');

Route::get('change-status-url','SettingController@change_status_url')->name('change-status-url');

Route::get('/contract','NewsController@contract');

Route::get('/action_logs','admin\ActionLogController@action_lists')->name('action.log');

Route::get('/token','NewsController@tokenlist')->name('tokenlist');

Route::resource('/popup_ads','PopupAdController');

Route::delete('/tokendestory/{id}','NewsController@tokendestory')->name('tokendestory');

// rating
Route::resource('rating','RatingController');

//billing contact
Route::resource('billing_contact','BillingContactController');

//setting url
Route::resource('setting_url','SettingController');
