<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
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



Route::group(['prefix' => 'admin/user'], function () {
    Route::get('/', 'Api\UserController@showAll');
    Route::get('/changePaginate/{jumlah}', 'Api\UserController@changePaginate');
    Route::get('/search/{keyword}/{jumlah}', 'Api\UserController@search');
    Route::post('/ban', 'Api\UserController@bannedUser');
    Route::post('/unban', 'Api\UserController@UnbannedUser');
});


Route::group(['prefix' => 'admin/obatracikan'], function () {
    Route::get('/', 'Api\ObatRacikansController@showAll');
    Route::get('/changePaginate/{jumlah}', 'Api\ObatRacikansController@changePaginate');
    Route::get('/showDetail/{id}', 'Api\ObatRacikansController@showDetail');
    Route::get('/showObat', 'Api\ObatRacikansController@showAllObat');
    Route::get('/search/{keyword}/{jumlah}', 'Api\ObatRacikansController@search');
    Route::post('/generate', 'Api\ObatRacikansController@generate');
    Route::post('/create', 'Api\ObatRacikansController@insert');
});


Route::get('/admin/kategori', 'Api\KategoriController@showAll');
Route::get('/admin/kategori/changePaginate/{jumlah}', 'Api\KategoriController@changePaginate');
Route::get('/admin/kategori/search/{keywords}/{jumlah}', 'Api\KategoriController@search');
Route::post('/admin/kategori', 'Api\KategoriController@addKategori');
Route::post('/admin/kategori/generateID', 'Api\KategoriController@generateID');
Route::post('/admin/kategori/update', 'Api\KategoriController@update');
Route::post('/admin/kategori/delete', 'Api\KategoriController@delete');

Route::group(['prefix' => 'admin/obat'], function () {
    Route::post('/', 'Api\ObatController@create');
    Route::get('/', 'Api\ObatController@showAll');
    Route::get('/changePaginate/{jumlah}', 'Api\ObatController@changePaginate');
    Route::get('/search/{keywords}/{jumlah}', 'Api\ObatController@search');
    Route::post('/delete', 'Api\ObatController@delete');
    Route::post('/update', 'Api\ObatController@update');
    Route::post('/generateID', 'Api\ObatController@generateID');
    Route::get('/kategori', 'Api\ObatController@showAllkategori');
    Route::get('/getKategori/{id}', 'Api\ObatController@getKategori');
});

Route::group(['prefix' => 'admin/tag'], function () {
    Route::get('/', 'Api\TagController@showAll');
    Route::get('/changePaginate/{jumlah}', 'Api\TagController@changePaginate');
    Route::get('/search/{keywords}/{jumlah}', 'Api\TagController@search');

    Route::post('/delete', 'Api\TagController@delete');
    Route::post('/', 'Api\TagController@addTag');
    Route::post('/generateID', 'Api\TagController@generateID');
    Route::post('/update', 'Api\TagController@update');
});

Route::group(['prefix' => 'admin/alatkesehatan'], function () {
    Route::get('/', 'Api\AlatKesehatanController@showAll');
    Route::get('/changePaginate/{jumlah}', 'Api\AlatKesehatanController@changePaginate');
    Route::get('/search/{keywords}/{jumlah}', 'Api\AlatKesehatanController@search');

    Route::post('/', 'Api\AlatKesehatanController@create');
    Route::post('/delete', 'Api\AlatKesehatanController@delete');
    Route::post('/generateID', 'Api\AlatKesehatanController@generateID');
    Route::post('/update', 'Api\AlatKesehatanController@update');
});

Route::group(['prefix' => 'admin/info'], function () {
    Route::post('/', 'Api\InfoController@create');
});

Route::group(['prefix' => 'admin/artikel'], function () {
    Route::post('/', 'Api\ArtikelController@create');
    Route::get('/', 'Api\ArtikelController@showLatest');
    Route::get('/changePaginate/{jumlah}', 'Api\ArtikelController@changePaginate');
    Route::get('/search/{keywords}/{jumlah}', 'Api\ArtikelController@search');
    Route::post('/generate', 'Api\ArtikelController@generate');
    Route::post('/update', 'Api\ArtikelController@update');
    Route::post('/delete', 'Api\ArtikelController@delete');
    Route::get('/tag', 'Api\ArtikelController@showAlltag');
    Route::get('/getTag/{id}', 'Api\ArtikelController@getTag');
});

Route::group(['prefix' => 'admin/info'], function () {
    Route::get('/', 'Api\InfoController@show');
    Route::post('/addInfo', 'Api\InfoController@create');
    Route::post('/updateInfo', 'Api\InfoController@updateInfo');
});

Route::group(['prefix' => 'alat'], function () {

    Route::get('/produk', 'Api\AlatKesehatanController@show');
    Route::get('/getDetail/{id}', 'Api\AlatKesehatanController@getDetail');
    Route::get('/kategori', 'Api\AlatKesehatanController@showsAll');
    Route::get('/kategori/{slug}', 'Api\AlatKesehatanController@showDetail');
});
Route::group(['prefix'=> 'admin/laporan'], function(){
    Route::get('/changePaginate/{jumlah}/{tipe}/{secara}/{orderby}/{tanggalhari}/{tipedata}/{tipeChart}', 'Api\LaporanController@changePaginate');
    Route::get('/search/{jumlah}/{tipe}/{secara}/{orderby}/{tanggalhari}/{tipedata}/{search}/{keyword}', 'Api\LaporanController@search');
});
Route::post('/addCart', 'Api\ObatPageController@addCart');
Route::post('/makeTransaction', 'Api\CartPageController@makeTransaction');
Route::get('/lihatCart', 'Api\CartPageController@show');
Route::get('/profilUser', 'Api\ProfilController@profil');
Route::get('/notifUser', 'NotifPageController@showUnread');
Route::get('/notifHeader', 'NotifPageController@showHeader');
Route::get('/notifDetail/{id}', 'NotifPageController@showDetail');
Route::get('/readDetail/{id}', 'NotifPageController@readDetail');
Route::get('/logout', 'Api\UserController@logout');

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
Route::get('/carousel', 'Api\ObatController@carousel');

Route::get('/getDtrans/{id}', 'Api\ProfilController@getDtrans');
Route::post('/profilUser/update', 'Api\ProfilController@profilUpdate');
Route::post('/addJumlahCart', 'Api\CartPageController@addJumlah');
Route::post('/minJumlahCart', 'Api\CartPageController@minJumlah');
Route::post('/deleteCart', 'Api\CartPageController@deleteCart');
