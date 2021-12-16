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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', 'Api\AuthController@register');
Route::post('login', 'Api\AuthController@login');

Route::get('email/verify/{id}', 'Api\VerificationController@verify')->name('verificationapi.verify');
Route::get('email/resend', 'Api\VerificationController@resend')->name('verificationapi.resend');

Route::group(['middleware' => 'auth:api'], function() {
    Route::get('kamar', 'Api\KamarController@index');
    Route::get('kamar/{email}', 'Api\KamarController@indexByEmail');
    Route::get('kamar/{id}', 'Api\KamarController@show');
    Route::post('kamar', 'Api\KamarController@store');
    Route::put('kamar/{id}', 'Api\KamarController@update');
    Route::delete('kamar/{id}', 'Api\KamarController@destroy');

    Route::get('review', 'Api\ReviewController@index');
    Route::get('review/{id}', 'Api\ReviewController@show');
    Route::post('review', 'Api\ReviewController@store');
    Route::put('review/{id}', 'Api\ReviewController@update');
    Route::delete('review/{id}', 'Api\ReviewController@destroy');

    Route::get('fasilitas', 'Api\FasilitasController@index');
    Route::get('fasilitas/{email}', 'Api\FasilitasController@indexByEmail');
    Route::get('fasilitas/{id}', 'Api\FasilitasController@show');
    Route::post('fasilitas', 'Api\FasilitasController@store');
    Route::put('fasilitas/{id}', 'Api\FasilitasController@update');
    Route::delete('fasilitas/{id}', 'Api\FasilitasController@destroy');

    Route::get('user', 'Api\UserController@index');
    Route::get('user/{id}', 'Api\UserController@show');
    Route::put('user/{id}', 'Api\UserController@update');
});