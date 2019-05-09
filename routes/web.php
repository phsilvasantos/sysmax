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

Route::get('/home', 'HomeController@index')->name('home');


Route::resource('/modulos', 'ModuloController');



Route::any('/product/localizar','ProdutoController@localizar')->name('produto.localizar');
Route::any('/cliente/localizar','ClienteController@localizar')->name('cliente.localizar');
Route::any('/product/localizar/{id}','ProdutoController@localizar_id')->name('produto.localizar_id');
Route::get('/clientes/{id}/ficha', 'ClienteController@ficha')->name('cliente.ficha');
Route::post('/clientes/desassociar', 'ClienteController@desassociar')->name('cliente.desassociar');
Route::any('/dynamic_dependent/fetch', 'RacaController@fetch')->name('dynamicdependent.fetch');
Route::get('/nfce/{venda_id}', 'NfceController@gerar')->name('nfce.gerar');
Route::get('/nfce/assina/{empresa}/{venda}', 'NfceController@assina')->name('nfce.assina');


Route::resource('/empresas', 'EmpresaController');
Route::resource('/categorias', 'CategoriaController');
Route::resource('/produtos', 'ProdutoController');
Route::resource('/clientes', 'ClienteController');
Route::resource('/animais', 'AnimalController');
Route::resource('/racas', 'RacaController');
Route::resource('/vendas', 'VendaController');
Route::resource('/forma_pagamentos', 'FormaPagamentoController');
Route::resource('/items', 'ItemController');
Route::resource('/pagamentos', 'PagamentoController');
Route::resource('/nfces', 'NfceController');



