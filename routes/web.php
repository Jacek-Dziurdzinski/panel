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
Route::post('/status', 'StatusController@add')->name('status');
Route::get('/allegro/{name}', 'AllegroController@select')->name('allegro');
Route::get('/allegro_api', 'AllegroApiController@main')->name('allegro_api');
Route::get('/allegro_download', 'AllegroDownloadController@download_offer')->name('allegro_download');



Route::get('/rest', 'AllegroController@request')->name('rest_get');

Route::get('/profile', 'ProfileController@index')->name('profile');
Route::put('/profile', 'ProfileController@update')->name('profile.update');


