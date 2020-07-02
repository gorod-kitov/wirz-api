<?php

use Illuminate\Http\Request;

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


//Route::post('/login', 'AuthController@authenticate');
//Route::post('/signup', 'AuthController@signup');
Route::post('/campaign/metrics1', 'Api\V1\CampaignController@addMetrics1');
Route::get('campaign/filter/metrics1', 'Api\V1\CampaignController@filterMetrics1');
Route::get('campaign/filter/metrics2', 'Api\V1\CampaignController@filterMetrics2');
Route::post('/campaign/metrics2', 'Api\V1\CampaignController@addMetrics2');

Route::get('/campaign/{id}/metrics1', 'Api\V1\CampaignController@getMetrics1');

Route::middleware(['auth.token'])->group(function() {
	Route::get('/account', 'Api\V1\AccountController@getAccountData');

	Route::get('/campaign/{id}/metrics2', 'Api\V1\CampaignController@getMetrics2');
});


Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');

});

Route::post('add_creatives', 'Api\CreativeController@addCreatives');
Route::get('creatives', 'Api\CreativeController@index');
Route::delete('creatives/{id}/delete', 'Api\CreativeController@delete');

Route::post('user/create', 'Api\V1\AdminController@store');
Route::get('get/users', 'Api\V1\AdminController@getUsers');
Route::get('get/user/{id}', 'Api\V1\AdminController@getUser');
