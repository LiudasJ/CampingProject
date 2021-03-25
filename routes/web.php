<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

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
    return auth()->user();
});

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::post('/add', 'App\Http\Controllers\CampsiteController@store');
    Route::get('/admin/edit/{id}', 'App\Http\Controllers\AdminController@edit');
    Route::get('/admin', 'App\Http\Controllers\AdminController@index');
    Route::get('/admin/all', 'App\Http\Controllers\AdminController@all');
    Route::post('/admin/delete/{id}', 'App\Http\Controllers\AdminController@delete');
});

Route::get('/', 'App\Http\Controllers\CampsiteController@all');
Route::get('/campings/top', 'App\Http\Controllers\CampsiteController@topRated');
Route::get('/campings/latest', 'App\Http\Controllers\CampsiteController@latest');
Route::get('/campings/{id}', 'App\Http\Controllers\CampsiteController@readMore');
Route::post('/campings/{id}/rate', 'App\Http\Controllers\CampsiteController@rate');

Route::post('/login', 'App\Http\Controllers\AuthenticationController@login');
Route::post('/register', 'App\Http\Controllers\AuthenticationController@register');
Route::get('/logout', 'App\Http\Controllers\AuthenticationController@logout');

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::get('/register', function () {
    return view('register');
});