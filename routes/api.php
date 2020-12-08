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

Route::get('posts', 'PostController@index');
Route::group(['prefix' => 'post'], function () {
    Route::post('add', 'PostController@create');
    Route::get('edit/{id}', 'PostController@edit');
    Route::post('update/{id}', 'PostController@update');
    Route::delete('delete/{id}', 'PostController@destroy');
});
Route::get('test-cv', 'CVFileController@index');
Route::group(['prefix' => 'uploadCVFile'], function () {
    Route::post('add', 'CVFileController@create');
    Route::get('edit/{id}', 'CVFileController@edit');
    Route::post('update/{id}', 'CVFileController@update');
    Route::delete('delete/{id}', 'CVFileController@destroy');
});


