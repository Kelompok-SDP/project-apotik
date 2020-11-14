<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['ValidAdmin']], function () {
    Route::get('/{param1}/{param2?}', function () {
        return view('main');
    })->where(['param1' => 'admin', 'param2' => '.*']);
});

Route::group(['middleware' => ['validLogin']], function () {
    Route::post('/addCart', 'Api\ObatPageController@addCart');
    Route::get('/profile', function () {
        return view('main');
    });
});

Route::get('/kategori', 'Api\ObatPageController@showAll');
Route::get('/kategori/{slug}', 'Api\ObatPageController@showDetail');

Route::post('/register', 'Api\UserController@register');
Route::post('/login', 'Api\UserController@login');
Route::get('/home', 'Api\UserController@home');


Route::get('/{any}', function () {
    return view('main');
})->where('any', '.*');
