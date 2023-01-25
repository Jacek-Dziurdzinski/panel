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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/status', 'StatusController@index')->name('status');
Route::get('/allegro', 'AllegroController@connect')->name('allegro');
Route::post('/allegro', 'AllegroController@connect')->name('allegro');
Route::get('/allegro/{name}', 'AllegroController@select')->name('allegro');

Route::get('/rest', 'AllegroController@request')->name('rest_get');

Route::get('/profile', 'ProfileController@index')->name('profile');
Route::put('/profile', 'ProfileController@update')->name('profile.update');


