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

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');;
Route::get('/import-data', 'HomeController@importData');
Route::post('/import-data', 'HomeController@importDataStore')->name('import.data');
Route::get('/import-data-force', 'HomeController@importDataForce');
