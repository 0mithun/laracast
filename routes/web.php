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

Route::get('/','FrontendController@welcome');

Auth::routes();
Auth::routes(['verify' => true, 'register'=>'false']);

Route::get('/login',function(){
   return redirect('/');
});

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/series/{series}', 'FrontendController@series')->name('series');

Route::group(['middleware' => ['auth']], function () {
    
   Route::post('/series/completed-lesson/{lesson}','WatchSeriesController@completeLesson');

   Route::get('profile/{user}','ProfileController@index')->name('profile');
   Route::get('/watch-series/{series}','WatchSeriesController@index')->name('series.learning');

   Route::get('/series/{series}/lesson/{lesson}', 'WatchSeriesController@showLesson')->name('series.watch');

   Route::get('subscribe', 'SubscriptionsController@showSubscribe')->name('subscribe.show');

   Route::post('subscribe', 'SubscriptionsController@saveSubscribe')->name('subscribe.save');


   Route::post('subscribe/change', 'SubscriptionsController@change')->name('subscriptions.change');

   Route::post('card/update', 'SubscriptionsController@cardUpdate')->name('card.update');


});