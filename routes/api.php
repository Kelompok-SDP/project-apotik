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
Route::post('/admin/kategori', 'Api\KategoriController@addKategori');
Route::post('/admin/kategori/generateID', 'Api\KategoriController@generateID');
Route::post('/admin/kategori/update', 'Api\KategoriController@update');
Route::post('/admin/kategori/delete', 'Api\KategoriController@delete');

Route::group(['prefix' => 'admin/obat'], function () {
    Route::post('/', 'Api\ObatController@create');
    Route::get('/', 'Api\ObatController@showAll');
    Route::post('/generateID', 'Api\ObatController@generateID');

});

Route::group(['prefix' => 'admin/info'], function () {
    Route::post('/', 'Api\InfoController@create');
});

Route::group(['prefix' => 'admin/artikel'], function () {
    Route::post('/', 'Api\ArtikelController@create');
    Route::get('/', 'Api\ArtikelController@show');
    Route::post('/generate', 'Api\ArtikelController@generate');
    Route::post('/update', 'Api\ArtikelController@update');
    Route::post('/delete', 'Api\ArtikelController@delete');
    Route::get('/tag', 'Api\ArtikelController@showAlltag');
});
