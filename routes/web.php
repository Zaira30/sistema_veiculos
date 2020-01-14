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
    return redirect('/login');
});

Route::get('/esquecisenha', 'SenhaController@esqueciSenha');
Route::get('/novasenha', 'SenhaController@novaSenha');
Route::get('/password/reset', 'SenhaController@esqueciMinhaSenha');
Route::get('/recuperarsenha', 'SenhaController@alterarSenhe');
Route::get('/getSubCategorias', 'ProdutoController@getSubCategoria');


Route::group(['middleware' => 'auth'], function () {

    Route::get('/home', function() {
        return view('home');
    })->name('home');

    //usuarios
    Route::get('/usuarios', ['uses' => 'UsuarioController@index'])->name('usuarios');
    Route::get('/usuarios/create', ['uses' => 'UsuarioController@create']);
    Route::post('/usuarios/create', ['uses' => 'UsuarioController@store']);
    Route::get('data/usuarios', ['as' => 'usuarios.data', 'uses' => 'UsuarioController@datatable']);
    Route::get('usuarios/{id}/edit', ['as' => 'usuarios.edit', 'uses' => 'UsuarioController@edit']);
    Route::patch('usuarios/{id}', ['as' => 'usuarios.update', 'uses' => 'UsuarioController@update']);
    Route::delete('usuarios/{id}', ['as' => 'usuarios.destroy', 'uses' => 'UsuarioController@destroy']);
    Route::get('/validacaoCPFCNPJ', 'UsuarioController@validacaoCPFCNPJ');


    //menu
    Route::get('/menus', 'MenuController@index')->name('menus');
    Route::get('/menus/create', 'MenuController@create');
    Route::post('/menus/create', 'MenuController@store');
    Route::get('data/menus', ['as' => 'menus.data', 'uses' => 'MenuController@datatable']);
    Route::get('menus/{id}/edit', ['as' => 'menus.edit', 'uses' => 'MenuController@edit']);
    Route::patch('menus/{id}', ['as' => 'menus.update', 'uses' => 'MenuController@update']);
    Route::delete('menus/{id}', ['as' => 'menus.destroy', 'uses' => 'MenuController@destroy']);

    //montadores
    Route::get('/montadores', ['uses' => 'MontadoresController@index'])->name('montadores');
    Route::get('/montadores/create', ['uses' => 'MontadoresController@create']);
    Route::post('/montadores/create', ['uses' => 'MontadoresController@store']);
    Route::get('data/montadores', ['as' => 'montadores.data', 'uses' => 'MontadoresController@datatable']);
    Route::get('montadores/{id}/edit', ['as' => 'montadores.edit', 'uses' => 'MontadoresController@edit']);
    Route::patch('montadores/{id}', ['as' => 'montadores.update', 'uses' => 'MontadoresController@update']);
    Route::delete('montadores/{id}', ['as' => 'montadores.destroy', 'uses' => 'MontadoresController@destroy']);

    //Veiculos
    Route::get('/veiculos', ['uses' => 'VeiculosController@index'])->name('veiculos');
    Route::get('/veiculos/create', ['uses' => 'VeiculosController@create']);
    Route::post('/veiculos/create', ['uses' => 'VeiculosController@store']);
    Route::get('data/veiculos', ['as' => 'veiculos.data', 'uses' => 'VeiculosController@datatable']);
    Route::get('veiculos/{id}/edit', ['as' => 'veiculos.edit', 'uses' => 'VeiculosController@edit']);
    Route::patch('veiculos/{id}', ['as' => 'veiculos.update', 'uses' => 'VeiculosController@update']);
    Route::delete('veiculos/{id}', ['as' => 'veiculos.destroy', 'uses' => 'VeiculosController@destroy']);

    //Perfis
    Route::get('/perfis', ['uses' => 'PerfilController@index'])->name('perfis');
    Route::get('/perfis/create', ['uses' => 'PerfilController@create']);
    Route::post('/perfis/create', ['uses' => 'PerfilController@store']);
    Route::get('data/perfis', ['as' => 'perfis.data', 'uses' => 'PerfilController@datatable']);
    Route::get('perfis/{id}/edit', ['uses' => 'perfis.edit', 'uses' => 'PerfilController@edit']);
    Route::patch('perfis/{id}', ['uses' => 'perfis.update', 'uses' => 'PerfilController@update']);
    Route::delete('perfis/{id}', ['uses' => 'perfis.destroy', 'uses' => 'PerfilController@destroy']);





});

Auth::routes();

