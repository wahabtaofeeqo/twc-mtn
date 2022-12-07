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

Route::get('/', 'IndexController@index');
Route::get('/clock-in', 'IndexController@welcome');
Route::get('/verify/{code}', 'IndexController@verify');

Route::get('/import', 'IndexController@store');
Route::get('/send-email', 'IndexController@sendEmail');
Route::get('/send-stats', 'IndexController@sendStats');
