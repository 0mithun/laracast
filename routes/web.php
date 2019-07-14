<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Auth::routes(['verify' => true, 'register'=>'false']);

Route::get('/login',function(){
   return redirect('/');
});

Route::get('/home', 'HomeController@index')->name('home');


Route::group(['middleware' => ['admin'], 'prefix' => 'admin'] , function () {
    Route::resource('series', 'SeriesController');
});