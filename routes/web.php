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

Route::get('/', 'Web\HomeController@index')->name('home');

// Authentication Routes
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

Route::middleware(['auth'])->group(function () {
    Route::resources([
        'profile' => 'Web\ProfileController',
    ]);    

    Route::resource('batches', 'Web\BatchController')->only(['index', 'show', 'create', 'store']);

    Route::middleware(['role:admin'])->group(function () {
        Route::get('/configurations', 'Web\ConfigurationController@index')->name('configurations');    
        Route::post('/configurations', 'Web\ConfigurationController@store')->name('configurations.store');  
        Route::patch('/configurations/{id}', 'Web\ConfigurationController@update')->name('configurations.update');      
        Route::post('/sensors', 'Web\SensorController@store')->name('sensors.store');  //@todo include this in sensors resource
            
        Route::resources([
          'users' => 'Web\UserController',
          'roles' => 'Web\RoleController',
        ]);  
        
        Route::resource('batches', 'Web\BatchController')->only(['edit', 'update', 'destroy']);
        Route::resource('sensors', 'Web\SensorController')->only(['edit', 'update']);

    });
});
