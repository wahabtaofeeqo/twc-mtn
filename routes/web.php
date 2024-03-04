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
Route::get('export', 'IndexController@export');
Route::get('emails', 'IndexController@sendEmail');
Route::get('clock-in', 'IndexController@welcome');
Route::get('clock-in-2', 'IndexController@metaView');
Route::get('login', 'IndexController@login')->name('login');
Route::post('login', 'IndexController@authenticate')->name('login');
Route::get('profile', 'IndexController@profile')->name('profile')->middleware('auth');
Route::get('dashboard', 'IndexController@dashboard')->name('dashboard')->middleware('auth');
