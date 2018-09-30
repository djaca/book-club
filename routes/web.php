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

//auth()->login(\App\User::first());

Route::get('/', 'HomeController@index')->name('home');
Route::get('requests', 'TradeController@requests')->name('requests');

Route::get('profile/{user}', 'ProfileController@index')->name('profile');

Route::group(['middleware' => 'auth'], function () {
    Route::post('books', 'BookController@store')->name('books.store');
    Route::delete('books/{book}', 'BookController@destroy')->name('books.destroy');

    Route::post('trade', 'TradeController@store')->name('trade');
    Route::delete('trade/{trade}', 'TradeController@destroy')->name('trade.destroy');

    Route::post('trade/{trade}/review', 'TradeController@review')->name('trade.review');

    Route::patch('profile/{user}/update', 'ProfileController@update')->name('profile.update');
});

Route::get('books/{book}', 'HomeController@modal')->name('book');

Auth::routes();

