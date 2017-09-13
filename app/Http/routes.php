<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => 'web'], function () {
    Route::auth();

    /*General*/
    Route::get('/','UsersController@index');
    Route::get('/managers','ManagerController@managers');
    Route::get('/employees','EmployeeController@employees');
    Route::get('/manager/{id}','ManagerController@showManager');
    Route::get('/employee/{id}','EmployeeController@showEmployee');


    /*Authorized*/
    Route::group(['middleware' => 'auth'], function () {
        Route::get('self', 'UsersController@self');
        Route::post('self', 'UsersController@update');
        Route::post('/manager/{id}','ManagerController@updateManager');
        Route::post('/employee/{id}','EmployeeController@updateEmployee');
    });
});