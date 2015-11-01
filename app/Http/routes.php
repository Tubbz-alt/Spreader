<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function() {
    if ($user = \Request::user()) {
        switch ($user->role) {
            case 1: return \Redirect::to('internal');
            case 2: return \Redirect::to('analytics');
            case 3: return \Redirect::to('auth/logout');
        }
    } else {
        return \Redirect::to('auth/login');
    }
});

Route::get('redirect/{project}/{activity}/{task?}', 'DispatchController@redirect');

Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

Route::group(['prefix' => 'analytics', 'namespace' => 'Analytics', 'middleware' => 'auth.company'], function() {
    Route::get('/', 'DashboardController@Index');
    Route::get('dashboard', 'DashboardController@Index');
    Route::get('dashboard/index', 'DashboardController@Index');
    Route:;get('dashboard/hightcharts', 'DashboardController@getHightChartsConfig');
});

Route::group(['prefix' => 'internal', 'namespace' => 'Internal', 'middleware' => 'auth.admin'], function() {
    Route::get('/', 'DashboardController@Index');
    Route::get('dashboard', 'DashboardController@Index');
    Route::get('dashboard/index', 'DashboardController@Index');

    Route::resource('companies', 'CompaniesController');
    Route::get('amigos/getAmigos', 'AmigosController@getAmigos');
    Route::resource('amigos', 'AmigosController');

    Route::get('terms/getTerms', 'TermsController@getTerms');
    Route::resource('terms', 'TermsController');

    Route::resource('projects', 'ProjectsController');
    Route::resource('projects.activities', 'ProjectsActivitiesController');
});
