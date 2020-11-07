<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['validLogin']], function () {
    Route::get('/{param1}/{param2?}', function () {
        return view('main');
    })->where(['param1' => 'admin', 'param2' => '.*']);
});

Route::post('/register', 'Api\UserController@register');
Route::post('/login', 'Api\UserController@login');
Route::get('/home', 'Api\UserController@home');



Route::get('/{any}', function () {
    return view('main');
})->where('any', '.*');
