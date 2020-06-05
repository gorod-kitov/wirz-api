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


Route::post('/login', 'AuthController@authenticate');
Route::post('/signup', 'AuthController@signup');

Route::middleware(['auth.token'])->group(function() {
	Route::get('/account', 'Api\V1\AccountController@getAccountData');
	Route::post('/campaign/metrics1', 'Api\V1\CampaignController@addMetrics1');
	Route::post('/campaign/metrics2', 'Api\V1\CampaignController@addMetrics2');
	Route::get('/campaign/{id}/metrics1', 'Api\V1\CampaignController@getMetrics1'); 
	Route::get('/campaign/{id}/metrics2', 'Api\V1\CampaignController@getMetrics2');
});
