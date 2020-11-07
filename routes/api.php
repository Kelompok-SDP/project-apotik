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

Route::group(['prefix' => 'admin/user'], function () {
    Route::get('/', 'Api\UserController@showAll');
    Route::get('/changePaginate/{jumlah}', 'Api\UserController@changePaginate');
    Route::post('/search/{keyword}/{jumlah}', 'Api\UserController@UnbannedUser');
    Route::post('/ban', 'Api\UserController@bannedUser');
    Route::post('/unban', 'Api\UserController@UnbannedUser');
});


Route::group(['prefix' => 'admin/obatracikan'], function () {
    Route::get('/', 'Api\ObatRacikansController@showAll');
    Route::get('/changePaginate/{jumlah}', 'Api\ObatRacikansController@changePaginate');
    Route::get('/showDetail/{id}', 'Api\ObatRacikansController@showDetail');
    Route::get('/showObat', 'Api\ObatRacikansController@showAllObat');
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
});

Route::group(['prefix' => 'admin/info'], function () {
    Route::post('/', 'Api\InfoController@create');
});

Route::group(['prefix' => 'admin/artikel'], function () {
    Route::post('/', 'Api\ArtikelController@create');
    Route::get('/', 'Api\ArtikelController@showAll');
    Route::get('/changePaginate/{jumlah}', 'Api\ArtikelController@changePaginate');
    Route::get('/search/{keywords}/{jumlah}', 'Api\ArtikelController@search');
    Route::post('/generate', 'Api\ArtikelController@generate');
    Route::post('/update', 'Api\ArtikelController@update');
    Route::post('/delete', 'Api\ArtikelController@delete');
    Route::get('/tag', 'Api\ArtikelController@showAlltag');
    Route::get('/getTag/{id}', 'Api\ArtikelController@getTag');
});

Route::post('/register', 'Api\UserController@register');
Route::post('/login', 'Api\UserController@login');
Route::get('/home', 'Api\UserController@home');
