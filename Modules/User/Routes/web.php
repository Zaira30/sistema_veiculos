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

Route::group(['middleware' => 'auth'], function () {
    Route::prefix('user')->group(function() {
        Route::get('/', 'UserController@index');
        Route::get('/create', 'UserController@create');
        Route::post('/create', 'UserController@store');
        Route::get('data/store', ['as' => 'user.data', 'uses' => 'UserController@datatable']);
        Route::get('/{id}/edit', ['as' => 'user.edit', 'uses' => 'UserController@edit']);
        Route::patch('/{id}', 'UserController@update');
        Route::delete('/{id}',  'UserController@destroy');
    });

});

