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
Route::any('/cliente/validar','ClienteController@validar')->name('cliente.validar');
Route::post('/clientes/pesquisar','ClienteController@pesquisar')->name('clientes.pesquisar');
Route::post('/fornecedores/pesquisar','FornecedorController@pesquisar')->name('fornecedores.pesquisar');
Route::any('/product/localizar/{id}','ProdutoController@localizar_id')->name('produto.localizar_id');
Route::get('/clientes/{id}/ficha', 'ClienteController@ficha')->name('cliente.ficha');
Route::post('/clientes/desassociar', 'ClienteController@desassociar')->name('cliente.desassociar');
Route::any('/dynamic_dependent/fetch', 'RacaController@fetch')->name('dynamicdependent.fetch');
Route::any('/dynamic_dependent/fetch2', 'RacaController@fetch2')->name('dynamicdependent.fetch2');
Route::get('/nfce/{venda_id}', 'NfceController@gerar')->name('nfce.gerar');
Route::get('/nfce/regerar/{venda_id}', 'NfceController@regerar')->name('nfce.regerar');
Route::get('/nfce/consulta_recibo/{venda_id}', 'NfceController@consulta_recibo')->name('nfce.consulta');
Route::get('/nfce/consulta_chave/{venda_id}', 'NfceController@consulta_chave')->name('nfce.consulta_chave');
Route::get('/nfce/download/{venda_id}', 'NfceController@download')->name('nfce.download');
Route::get('/nfce/assina/{empresa}/{venda}', 'NfceController@assina')->name('nfce.assina');
Route::get('/nfce/detalhes/{nfce_id}', 'NfceDetalheController@detalhes')->name('nfce.detalhes');
Route::get('/atendimento/imprimir/{id}', 'AtendimentoController@imprimir')->name('atendimento.imprimir');
Route::post('/atendimentos/filtrar', 'AtendimentoController@filtrar')->name('atendimento.filtrar');
Route::post('/atendimentos/internar', 'AtendimentoController@internar')->name('atendimento.internar');
Route::get('/atendimentos/internacao', 'AtendimentoController@internacao')->name('atendimento.internacao');
Route::get('/relatorios/caixa', 'RelatorioController@caixa')->name('relatorio.caixa');
Route::post('/relatorios/caixa', 'RelatorioController@caixa')->name('relatorio.caixa');
Route::post('/vendas/pesquisar', 'VendaController@pesquisar')->name('vendas.pesquisar');
Route::get('/vendas/pre', 'VendaController@prevenda')->name('vendas.pre');
Route::any('/vendas/fechamento', 'VendaController@fechamento')->name('vendas.fechamento');
Route::put('/users/password/{id}', 'UserController@password')->name('users.password');
Route::get('/receber/baixarapida/{id}', 'ReceberController@baixaRapida')->name('receber.baixaRapida');


Route::resource('/empresas', 'EmpresaController');
Route::resource('/categorias', 'CategoriaController');
Route::resource('/produtos', 'ProdutoController');
Route::resource('/clientes', 'ClienteController');
Route::resource('/fornecedores', 'FornecedorController');
Route::resource('/animais', 'AnimalController');
Route::resource('/racas', 'RacaController');
Route::resource('/vendas', 'VendaController');
Route::resource('/forma_pagamentos', 'FormaPagamentoController');
Route::resource('/items', 'ItemController');
Route::resource('/pagamentos', 'PagamentoController');
Route::resource('/nfces', 'NfceController');
Route::resource('/atendimentos', 'AtendimentoController');
Route::resource('/atendimento_detalhes', 'AtendimentoDetalhesController');
Route::resource('/vacinas', 'VacinaController');
Route::resource('/associacao', 'AssociacaoController');
Route::resource('/planos', 'PlanoController');
Route::resource('/receber', 'ReceberController');
Route::resource('/setores', 'SetorController');

Route::resource('/permissions', 'PermissionController');
Route::resource('/roles', 'RoleController');
Route::resource('/users', 'UserController');
Route::resource('/leitos', 'LeitoController');
Route::resource('/itens_prescricao', 'ItensPrescricaoController');
Route::resource('/prescricao', 'PrescricaoController');




