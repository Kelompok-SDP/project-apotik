<?php

use Illuminate\Support\Facades\Route;


Route::group(['middleware' => ['ValidAdmin']], function () {
    Route::get('/{param1}/{param2?}', function () {
        return view('main');
    })->where(['param1' => 'admin', 'param2' => '.*']);
});



Route::group(['middleware' => ['validLogin']], function () {
    Route::post('/addCart', 'Api\ObatPageController@addCart');
    Route::post('/makeTransaction', 'Api\CartPageController@makeTransaction');
    Route::get('/lihatCart', 'Api\CartPageController@show');
    Route::get('/profilUser', 'Api\ProfilController@profil');
    Route::get('/notifUser', 'NotifPageController@showUnread');
    Route::get('/notifHeader', 'NotifPageController@showHeader');
    Route::get('/notifDetail/{id}', 'NotifPageController@showDetail');
    Route::get('/readDetail/{id}', 'NotifPageController@readDetail');
    Route::get('/logout', 'Api\UserController@logout');
});

Route::get('/{any}', function () {
    return view('main');
})->where('any', '.*');
