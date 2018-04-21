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

/*
 * @todo implement authentication, OAuth2 maybe?
 *
 */
Route::get('/', function() {
    return response()->json(['name' => 'Enartis API', 'author' => 'aztera']);
});

Route::prefix('v1')->group(function () {

    Route::get('/', function() {
        return response()->json(['name' => 'Enartis API', 'version' => '0.0.1']);
    });

    //Route::group(['middleware' => 'auth:api'], function() {
        Route::resources([
            'users' => 'Api\UserController',
            'batches' => 'Api\BatchController',
            'sensors' => 'Api\SensorController',
            'sensor-commands' => 'Api\SensorCommandController',
            'batch-analyses' => 'Api\BatchAnalysisController',
            'sensor-readings' => 'Api\SensorReadingController',
            'sensor-states' => 'Api\SensorStateController',
        ]);
    //});

});