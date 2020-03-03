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

    Route::prefix('store')->group(function() {
        Route::get('/', 'StoreController@index');
        Route::get('/create', 'StoreController@create');
        Route::post('/create', 'StoreController@store');
        Route::get('data/store', ['as' => 'store.data', 'uses' => 'StoreController@datatable']);
        Route::get('/{id}/edit', ['as' => 'store.edit', 'uses' => 'StoreController@edit']);
        Route::patch('/{id}', 'StoreController@update');
        Route::delete('/{id}',  'StoreController@destroy');
    });

});

