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
Route::delete('/campaign/delete-engagament/', 'Api\V1\CampaignController@deleteEngagament');
Route::put('/campaign/update-engagament', 'Api\V1\CampaignController@updateEngagament');

Route::post('/campaign/add-engagament', 'Api\V1\CampaignController@addEngagament');
Route::get('campaign/filter/metrics1', 'Api\V1\CampaignController@filterMetrics1');
Route::get('campaign/get-engagements/{campaign_id}', 'Api\V1\CampaignController@getEngagements');
Route::get('campaign/filter/metrics2', 'Api\V1\CampaignController@filterMetrics2');
Route::post('/campaign/metrics2', 'Api\V1\CampaignController@addMetrics2');
Route::get('/campaign/{id}/metrics1', 'Api\V1\CampaignController@getMetrics1');
Route::get('/campaign/{id?}/metrics1/excel', 'Api\V1\CampaignController@metrics1Excel');
Route::get('/campaign/{id}/metrics2', 'Api\V1\CampaignController@getMetrics2');
Route::delete('/campaign/{id}/metrics', 'Api\V1\CampaignController@deleteMetrics');

Route::middleware(['auth.token'])->group(function() {
	Route::get('/account', 'Api\V1\AccountController@getAccountData');
});
Route::get('campaign/{id}/engagements', 'Api\V1\CampaignController@engagements');


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
Route::post('company/save', 'Api\V1\AdminController@storeCompany');
Route::get('get/users/{select?}', 'Api\V1\AdminController@getUsers');
Route::get('get/companies', 'Api\V1\AdminController@getCompanies');
Route::get('get/user/{id}', 'Api\V1\AdminController@getUser');
Route::get('get/company/{id}', 'Api\V1\AdminController@getCompany');


Route::post('client/toggle-show', 'Api\V1\AdminController@toggleShow');



Route::post('groups/edit/{id}', 'Api\V1\AdminController@editGroup');
Route::get('get/groups/', 'Api\V1\AdminController@getGroups');
Route::get('get/groups/filter', 'Api\V1\AdminController@getGroupFilter');
Route::post('group/create', 'Api\V1\AdminController@storeGroup');
Route::get('get/group/{id}', 'Api\V1\AdminController@getGroup');


