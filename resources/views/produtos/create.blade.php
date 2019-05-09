@extends('layouts.template')

@section('content')

    @if (session('status'))

    @endif

    <form action="{{route('produtos.store')}}" method="post" name="form1">

        @csrf
        <input type="hidden" id="origem" name="origem" value="">


        <div class="kt-portlet kt-portlet--tabs">

            <div class="row">

                <div class="col-md-12">
                    <div class="card loction-user">
                        <div class="card-block p-0">
                            <div class="row align-items-center justify-content-center">
                                <div class="col-auto">
                                    <div><i class="fas fa-box-open m-r-5" style="font-size:38px"></i></div>
                                </div>
                                <div class="col">
                                    <h5>Produto</h5>
                                    <span>Descrição</span>
                                </div>
                                <div class="col text-right">
                                    <a href="{{route('produtos.index')}}"> <button type="button" class="btn btn-sm btn-default btn-shadow-1 btn-rounded"><i class="feather icon-arrow-left"></i>Voltar</button></a>

                                    <div class="btn-group mb-2 mr-2  btn-rounded">
                                        <button type="submit" class="btn btn-primary btn-rounded">Salvar</button>
                                        <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split  btn-rounded" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="sr-only">Toggle Dropdown</span></button>
                                        <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(92px, 43px, 0px);">
                                            <a class="dropdown-item" href="#!" onclick="salvar('novo')">Salvar e Novo</a>
                                            <a class="dropdown-item" href="#!" onclick="salvar('salvar')">Salvar e Voltar</a>

                                        </div>
                                    </div>


                                </div>
                            </div>
                            <div class="border-top"></div>

                            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist" style="margin-bottom: 0px !important;">
                                <li class="nav-item">
                                    <a class="nav-link active show" id="pills-home-tab" data-toggle="pill" href="#kt_portlet_base_demo_1_1_tab_content" role="tab" aria-controls="pills-home" aria-selected="true">Geral</a>
                                </li>


                            </ul>

                        </div>
                    </div>
                </div>

            </div>


            <div class="kt-portlet__body"  style="margin-top: -20px;">


                <div class="tab-content">
                    <div class="tab-pane active" id="kt_portlet_base_demo_1_1_tab_content" role="tabpanel">
                        <h5>Dados Gerais</h5>
                        <hr>

                        <div class="row">

                            <div class="form-group col-md-8">
                                <label for="nome" class="control-label">Produto/Serviço</label>


                                <input type="text" class="form-control form-control-sm" id="nome" name="nome" placeholder="Nome" required="" >

                            </div>
                            <div class="form-group col-md-4">
                                <label for="tipo" class="control-label">Tipo</label>


                                <select class="form-control form-control-sm" id="tipo" name="tipo" required="" >
                                    <option value="Produto">Produto</option>
                                    <option value="Serviço">Serviço</option>
                                </select>

                            </div>


                        </div>

                        <div class="row">

                            <div class="form-group col-md-4">
                                <label for="categoria_id" class="control-label">Categoria</label>


                                <select class="form-control form-control-sm" name="categoria_id">@foreach($instace->TodasCategorias() as $categoria)<option value="{{$categoria->id}}">{{$categoria->categoria}}</option>@endforeach</select>

                            </div>


                            <div class="form-group col-md-4">
                                <label for="unidade" class="control-label">Unidade</label>


                                <input type="text" class="form-control form-control-sm" id="unidade" name="unidade" placeholder="Unidade" required="" >

                            </div>

                            <div class="form-group col-md-4">
                                <label for="cod_barras" class="control-label">Codigo de Barras</label>


                                <input type="text" class="form-control form-control-sm" id="cod_barras" name="cod_barras" placeholder="Codigo de Barras">

                            </div>

                        </div>

                        <div class="row">


                            <div class="form-group col-md-4">
                                <label for="cod_ncm" class="control-label">Código NCM</label>


                                <input class="form-control form-control-sm" id="codigo_ncm" name="codigo_ncm" placeholder="Código NCM">

                            </div>
                            <div class="form-group col-md-4">
                                <label for="cod_ex_tipi" class="control-label">Código EX TIPI</label>


                                <input type="text" class="form-control form-control-sm" id="codigo_extipi" name="codigo_extipi" placeholder="Código EX TIPI">

                            </div>

                            <div class="form-group col-md-4">
                                <label for="CFOP" class="control-label">CFOP</label>


                                <select  class="form-control form-control-sm" id="codigo_cfop" name="codigo_cfop">
                                    <option value="5101">5101 - Venda de produção do estabelecimento</option>
                                    <option value="5102">5102 - Venda de mercadoria de terceiros</option>
                                    <option value="5115">5115 - Venda de mercadoria de terceiros, recebida anteriormente em consignação mercantil</option>
                                    <option value="5401">5401 - Venda de produção do estabelecimento em operação  com produto sujeito a ST, como contribuinte substituto</option>
                                    <option value="5403">5403 - Venda de mercadoria de terceiros em operação com mercadoria sujeita a ST, como contribuinte substituto</option>
                                    <option value="5405">5405 - Venda de mercadoria de terceiros, sujeita a ST, como contribuinte substituído</option>
                                    <option value="5656">5656 - Venda de combustível ou lubrificante de terceiros, para consumidor final</option>
                                    <option value="5933">5933 - Prestação de serviço tributado pelo ISSQN (Nota Fiscal conjugada)</option>
                                </select>

                            </div>

                        </div>

                        <hr>

                        <div class="row">

                            <div class="form-group col-md-2">
                                <label for="custo" class="control-label">Custo Médio</label>


                                <input class="form-control form-control-sm" id="custo" name="custo" placeholder="Preço de Custo">

                            </div>
                           {{-- <div class="form-group col-md-2">
                                <label for="margem_lucro" class="control-label">Margem de Lucro</label>


                                <div class="input-group">
                                    <input type="number" class="form-control form-control-sm" id="margem_lucro"  onchange=Calc()  name="margem_lucro" placeholder="Margem de Lucro">

                                </div>

                            </div>


                            <div class="form-group col-md-2">
                                <label for="preco_sugerido" class="control-label">Preço Sugerido</label>


                                <input class="form-control form-control-sm" id="preco_sugerido" name="preco_sugerido" placeholder="Preço Sugerido" disabled="">

                            </div>--}}


                            <div class="form-group col-md-2">
                                <label for="preco_venda" class="control-label">Preço Venda</label>


                                <input class="form-control form-control-sm" id="preco" name="preco" placeholder="Preço de Venda">

                            </div>

                            <div class="form-group col-md-2">
                                <label for="comissao" class="control-label">Comissão</label>


                                <div class="input-group">
                                    <input type="number" class="form-control form-control-sm" id="comissao" name="comissao" placeholder="Comissão">

                                </div>




                            </div>

                            <div class="form-group col-md-2">
                                <label for="estoque_minimo" class="control-label">Estoque Mínimo</label>


                                <input type="number" class="form-control form-control-sm" id="estoque_minimo" name="estoque_minimo" placeholder="Estoque Mínimo">

                            </div>


                            <div class="form-group col-md-2">
                                <label for="estoque_maximo" class="control-label">Estoque Máximo</label>


                                <input type="number" class="form-control form-control-sm" id="estoque_maximo" name="estoque_maximo" placeholder="Estoque Máximo">

                            </div>

                            <div class="form-group col-md-2">
                                <label for="estoque_atual" class="control-label">Estoque Atual</label>


                                <input class="form-control form-control-sm" id="estoque_atual" name="estoque_atual" placeholder="Estoque Atual">

                            </div>


                            {{--<div class="form-group col-md-2">
                                <label for="tabela_id" class="control-label">Tabela</label>


                                <select class="form-control form-control-sm" id="tabela_id" name="tabela_id" required="" >



                                </select>

                            </div>--}}


                        </div>

                        {{--<div class="row">

                            <div class="form-group col-md-2">
                                <label for="permite_alterar_preco_venda" class="control-label">Permite Alterar Preço</label>


                                <div id="permite_alterar_preco_venda" class="btn-group" data-toggle="buttons">
                                    <label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                                        <input type="radio" name="permite_alterar_preco_venda" value="1" data-parsley-multiple="permite_alterar_preco_venda" data-parsley-id="12" required=""> &nbsp; Sim &nbsp;
                                    </label>
                                    <label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                                        <input type="radio" name="permite_alterar_preco_venda" value="0" data-parsley-multiple="permite_alterar_preco_venda"> Não
                                    </label>
                                </div>



                            </div>
                            <div class="form-group col-md-2">
                                <label for="controla_estoque" class="control-label">Controla Estoque</label>


                                <div id="controla_estoque" class="btn-group" data-toggle="buttons">
                                    <label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                                        <input type="radio" name="controla_estoque" value="1" data-parsley-multiple="controla_estoque" data-parsley-id="12" required=""> &nbsp; Sim &nbsp;
                                    </label>
                                    <label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                                        <input type="radio" name="controla_estoque" value="0" data-parsley-multiple="controla_estoque"> Não
                                    </label>
                                </div>

                            </div>



                            --}}{{--<div class="form-group col-md-2">
                                <label for="data_validade" class="control-label">Data Validade</label>


                                <input type="date" class="form-control form-control-sm" id="data_validade" name="data_validade" placeholder="Validade">

                            </div>--}}{{--





                        </div>--}}


                    </div>
                    <div class="tab-pane" id="kt_portlet_base_demo_1_2_tab_content" role="tabpanel">

                        <div class="card code-table" style="margin: -25px;">
                            <div class="card-header">
                                <h5>Categorias</h5>
                                <div class="card-header-right">

                                    <button type="button" class="btn btn-primary btn-sm btn-rounded" onclick="addRow();">+ Nova</button>


                                    {{--<div class="btn-group card-option">
                                        <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="feather icon-more-horizontal"></i>
                                        </button>
                                        <ul class="list-unstyled card-option dropdown-menu dropdown-menu-right">
                                            <li class="dropdown-item full-card"><a href="#!"><span><i class="feather icon-maximize"></i> maximize</span><span style="display:none"><i class="feather icon-minimize"></i> Restore</span></a></li>
                                            <li class="dropdown-item minimize-card"><a href="#!"><span><i class="feather icon-minus"></i> collapse</span><span style="display:none"><i class="feather icon-plus"></i> expand</span></a></li>
                                            <li class="dropdown-item reload-card"><a href="#!"><i class="feather icon-refresh-cw"></i> reload</a></li>
                                            <li class="dropdown-item close-card"><a href="#!"><i class="feather icon-trash"></i> remove</a></li>
                                        </ul>

                                    </div>--}}
                                </div>
                            </div>
                            <div class="card-block pb-0">
                                <div class="table-responsive">
                                    <table class="table table-hover  table-list" id="myTable">
                                        <thead>
                                        <tr>

                                            <th>Categoria</th>


                                            <th>Opções</th>

                                        </tr></thead>
                                        <tbody>




                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>

    </form>

    <script type="text/javascript">
        var count = 0;


        function addRow() {
            $('table#myTable').dataTable().fnAddData( [

                '<select class="form-control form-control-sm" name="categoria_id[' + count +']"></select>',
                '<button type="button" class="btn btn-danger btn-sm btn-rounded" onclick="deleteRow(this.parentNode.parentNode.rowIndex);">- Excluir</button>' ] );

            count++;
        }

        function deleteRow (linha) {



            if (count != 0) {
                $("table#myTable").dataTable().fnDeleteRow(linha - 1);

                count--;
            }
        }
    </script>

@endsection

