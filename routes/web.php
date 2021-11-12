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

// ユーザ登録
Route::get('signup', 'Auth\RegisterController@showRegistrationForm')->name('signup.get');
Route::post('signup', 'Auth\RegisterController@register')->name('signup.post');
Route::get('signup/complete', function () { return view('auth/complete'); });

// 認証
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('login.post');
Route::get('logout', 'Auth\LoginController@logout')->name('logout.get');

// ユーザ詳細
Route::group(['middleware' => ['auth']], function () {
    Route::resource('users', 'UsersController', ['only' => ['index', 'edit', 'update']]);
    
    Route::get('favorite/index', 'FavoritesController@index')->name('favorites.index');
    Route::group(['prefix' => 'souvenirs/{id}'], function () {
        Route::post('favorite', 'FavoritesController@store')->name('favorites.favorite');
        Route::delete('unfavorite', 'FavoritesController@destroy')->name('favorites.unfavorite');
    });
    
    Route::get('souvenirs/registered', 'SouvenirsController@registered')->name('souvenirs.registered');
    Route::get('souvenirs/registered/{souvenir}', 'SouvenirsController@registered_show')->name('souvenirs.registered_show');
    Route::get('souvenirs/', 'SouvenirsController@create')->name('souvenirs.create');
    Route::post('souvenirs/', 'SouvenirsController@store')->name('souvenirs.store');
    Route::get('souvenirs/{souvenir}/edit', 'SouvenirsController@edit')->name('souvenirs.edit');
    Route::put('souvenirs/{souvenir}', 'SouvenirsController@update')->name('souvenirs.update');
    Route::delete('souvenirs/{souvenir}', 'SouvenirsController@delete')->name('souvenirs.destroy');
    
    Route::get('review', 'ReviewsController@show');
    Route::post('review', 'ReviewsController@store')->name('review.store');
});

// お土産一覧
Route::get('souvenirs/{prefecture}/index', 'SouvenirsController@index')->name('souvenirs.index');
Route::get('souvenirs/search/', 'SouvenirsController@search')->name('souvenirs.search');
Route::get('souvenirs/{souvenir}', 'SouvenirsController@show')->name('souvenirs.show');