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

    Route::prefix('budget')->group(function() {
        Route::get('/', 'BudgetController@index');
        Route::get('/create', 'BudgetController@create');
        Route::post('/create', 'BudgetController@store');
        Route::get('data/store', ['as' => 'budget.data', 'uses' => 'BudgetController@datatable']);
        Route::get('/{id}/edit', ['as' => 'budget.edit', 'uses' => 'BudgetController@edit']);
        Route::patch('/{id}', 'BudgetController@update');
        Route::delete('/{id}',  'BudgetController@destroy');
        Route::get('getproducts', ['as' => 'budget.getproducts', 'uses' => 'BudgetController@getProducts']);
        Route::get('getDataProduto', ['as' => 'budget.getDataProduto', 'uses' => 'BudgetController@getDataProduto']);
        Route::get('getCpf', ['as' => 'budget.getCpf', 'uses' => 'BudgetController@getCpf']);

        Route::get('/gerarpdf', 'BudgetController@gerarpdf');
        Route::get('pdf/{id}', 'BudgetController@downloadPdf');
       // Route::get('pdf/{id}', 'BudgetController@pdf');
       // Route::get('pdf', 'BudgetController@pdf');
    });
});

