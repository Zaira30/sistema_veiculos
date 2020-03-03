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

    Route::prefix('products')->group(function() {
        Route::get('/', 'ProductsController@index');
        Route::get('/create', 'ProductsController@create');
        Route::post('/create', 'ProductsController@store');
        Route::get('data/store', ['as' => 'products.data', 'uses' => 'ProductsController@datatable']);
        Route::get('/{id}/edit', ['as' => 'products.edit', 'uses' => 'ProductsController@edit']);
        Route::patch('/{id}', 'ProductsController@update');
        Route::delete('/{id}',  'ProductsController@destroy');
    });
});

