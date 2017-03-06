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

Route::get('statistic', 'Web\StatisticController@index');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', 'Web\HomeController@index');
    Route::group(['prefix' => 'users'], function() {
        Route::post('filter', 'Web\UserController@filter');
        Route::get('assign-permission/{id}', 'Web\UserController@assignPermission');
        Route::post('update-permission/{id}', 'Web\UserController@updatePermission');
        Route::get('assign-manager/{id}', 'Web\UserController@assignManager');
        Route::resource('/', 'Web\UserController');
    });
    Route::resource('settings', 'Web\SettingController', [
        'only' => [
            'index',
            'update',
        ],
    ]);
});

Route::group(['middleware' => 'register'], function () {
    Route::get('register', 'Auth\RegisterController@showRegistrationForm');
    Route::post('register', 'Auth\RegisterController@register');
});

Route::resource('interview-room', 'Web\ScheduleController');
Route::resource('settings', 'Web\SettingController');
