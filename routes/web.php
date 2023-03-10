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

Route::get('/', 'HomeController@index')->name('home');
Auth::routes();

Route::get('/logout', 'Auth\LogoutController@index')->name('logout');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/status', 'StatusController@index')->name('status');
Route::post('/status', 'StatusController@add')->name('status');

Route::get('/allegro/{name}', 'AllegroController@select')->name('allegro');
Route::get('/allegro_api', 'AllegroApiController@main')->name('allegro_api');
Route::get('/allegro_download', 'AllegroDownloadController@download_offer')->name('allegro_download');


Route::get('/rest', 'AllegroController@request')->name('rest_get');

Route::get('/profile', 'ProfileController@index')->name('profile');
Route::put('/profile', 'ProfileController@update')->name('profile.update');

Route::resource('products', 'ProductsController')
    ->only([
        'index', 'show'
    ]);
Route::post('/products', 'ProductsController@update')->name('products.update');
 
 
 Route::get('/settings', 'ProductsController@settings')->name('products.settings');
 Route::post('/settings', 'ProductsController@settings_update')->name('settings.update');
 
 Route::get('/shopping', 'ShoppingController@index')->name('shopping');
 Route::get('/shopping/detail/{producerId}', 'ShoppingController@detail')->name('shopping.detail');
 Route::get('/shopping/export/{producerId}', 'ShoppingController@export')->name('shopping.export');


 Route::get('/test', 'TestController@index')->name('test');