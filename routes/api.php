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
