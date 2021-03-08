<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('login', [
    'as' => 'login', function () {
        return view('login');
    }
]);

Route::post('login', [
    'as' => 'submit', 'uses' => '\App\Http\Controllers\AuthController@authenticate'
]);

Route::group(['middleware' => 'auth','namespace'=>'\App\Http\Controllers'], function()
{
    Route::get('/', function()
    {
        return view('index');
    });

    Route::get('profile', function()
    {
        return view('profile');
    });

    Route::get('store', function()
    {
        return view('store');
    });

    Route::post('store', 'PostController@store');

    Route::get('posts', 'PostController@index');

    Route::get('posts/example', function()
    {
        return view('index_example');
    });

    Route::get('logout', 'AuthController@logout');
});



