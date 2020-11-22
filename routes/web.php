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

Route::get('/kategori', 'Api\ObatPageController@showAll');
Route::get('/kategori/{slug}', 'Api\ObatPageController@showDetail');
Route::get('/artikel/getTag/{id}', 'Api\ArtikelController@tagArtikel');

Route::get('/obat/getDetail/{id}', 'Api\ObatController@getDetail');

Route::get('/obat/getRelated/{id}', 'Api\ObatController@getRelated');


Route::get('/tag/{id_tag}', 'Api\ArtikelPageController@showDetail');
Route::get('/artikel/{slug}', 'Api\ArtikelPageController@showContent');

Route::post('/register', 'Api\UserController@register');
Route::post('/login', 'Api\UserController@login');
Route::get('/home', 'Api\UserController@home');
Route::get('/produk', 'Api\ObatController@show');

Route::get('/getDtrans/{id}', 'Api\ProfilController@getDtrans');
Route::post('/profilUser/update', 'Api\ProfilController@profilUpdate');
Route::post('/addJumlahCart', 'Api\CartPageController@addJumlah');
Route::post('/minJumlahCart', 'Api\CartPageController@minJumlah');
Route::post('/deleteCart', 'Api\CartPageController@deleteCart');



Route::get('/{any}', function () {
    return view('main');
})->where('any', '.*');
