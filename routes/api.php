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
