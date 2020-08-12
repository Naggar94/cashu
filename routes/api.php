<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('our-hotels','Api\HotelsController@ourHotels')->name('our-hotels');
Route::get('best-hotels','Api\HotelsController@bestHotels')->name('best-hotels');
Route::get('top-hotels','Api\HotelsController@topHotels')->name('top-hotels');
