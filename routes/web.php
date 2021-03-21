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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/', 'App\Http\Controllers\CampsiteController@all');
Route::post('/login', 'App\Http\Controllers\AuthenticationController@login');
Route::post('/campings/{id}/rate', 'App\Http\Controllers\CampsiteController@rate');
Route::get('/campings/top', 'App\Http\Controllers\CampsiteController@topRated');
Route::get('/campings/latest', 'App\Http\Controllers\CampsiteController@latest');
Route::get('/campings/{id}', 'App\Http\Controllers\CampsiteController@readMore');

