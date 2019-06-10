@extends('layouts.template')

@section('content')

    @if (session('status'))

    @endif

    <form action="{{route('vendas.update', $venda[0]->id)}}" method="post" id="vendas-form">

        @csrf
        <input type="hidden" name="origem" value="">
        <input type="hidden" name="_method" value="PUT">
        <input type="hidden" id="venda_id" name="venda_id" value="{{$venda[0]->id}}">

        <div class="row">
            <div class="col-md-12">

            </div>
        </div>



        <div class="row">
            <div class="col-md-9">
                <div class="kt-portlet__body">
                    <div class="tab-content" style="padding:20px">
                        <div class="tab-pane active" id="kt_portlet_base_demo_1_1_tab_content" role="tabpanel">




                            <div class="row">

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <i class="fa fa-bookmark"></i> <label>Venda</label>

                                        <h5>#{{$venda[0]->id}}</h5>


                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <i class="fa fa-calendar"></i> <label>Data</label>

                                        <h5>{{date('d/m/y', strtotime($venda[0]->created_at))}}</h5>


                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <i class="fa fa-user"></i> <label>Cliente</label>

                                        <div id="cli_nome" onclick="document.getElementById('cli_id').style.display = 'block';document.getElementById('cli_nome').style.display = 'none'">
                                        <h5>{{$venda[0]->Cliente->nome}}</h5>
                                        </div>


                                        <div id="cli_id" style="display:none">
                                        <select class="form-control form-control-sm js-select" name="cliente_id" id="cliente_id">
                                            <option value="{{$venda[0]->cliente_id}}"  selected="selected">{{$venda[0]->Cliente->nome}}</option>
                                        </select>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <i class="fa fa-shopping-cart"></i> <label>Vendedor</label>

                                        <div id="ven_nome" onclick="document.getElementById('ven_id').style.display = 'block';document.getElementById('ven_nome').style.display = 'none'">
                                        <h5>{{$venda[0]->Usuario->name}}</h5>
                                        </div>

                                        <div id="ven_id" style="display:none">
                                        <select class="form-control form-control-sm js-select" name="vendedor_id" id="vendedor_id">
                                            <option value="0"  selected="selected">Vendedor Logado</option>
                                            @foreach($vendedores as $vendedor)
                                                <option value="{{$vendedor->id}}" @if($vendedor->id == $venda[0]->user_id) selected @endif>{{$vendedor->name}}</option>
                                            @endforeach
                                        </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <i class="fa fa-shopping-cart"></i> <label>Status</label>

                                        <h5>{{$venda[0]->status}}</h5>


                                    </div>
                                </div>


                            </div>



                        </div>

                    </div>
                </div>


                @if($venda[0]->status != 'Quitada')

                <div class="card code-table" style="margin-top:25px">
                    <div class="card-header" style="padding-bottom:0px">

                        <h5>Lançamentos</h5>
                        <hr>

                        <div class="row">

                            <div class="col-md-1" style="padding:5px"><div class="form-group"><label>Qtd</label>
                                    <input type="number" value="1" step="1"  class="form-control form-control-sm valor-qtd" name="qtd" id="qtd" onchange="calcula()" style="padding:4px 8px;">
                                </div></div>

                            <div class="col-md-7" style="padding:5px"><div class="form-group"><label>Produto ou Serviço</label>
                                    <select class="form-control form-control-sm js-example-data-ajax" name="produto_id" id="produto_id"></select>

                                </div></div>

                            <div class="col-md-3" style="padding:5px"><div class="form-group"><label>Usuário</label>
                                    <select class="form-control form-control-sm js-select" name="user_id" id="user_id">
                                        @foreach($vendedores as $vendedor)
                                            <option value="{{$vendedor->id}}">{{$vendedor->name}}</option>
                                        @endforeach
                                    </select>
                                </div></div>

                            <div class="col-md-1" style="padding:5px; margin-top:5px;"><label></label>
                                <a href="#"  class="label theme-bg text-white f-14 f-w-400  btn-rounded" onclick="adicionar_item()"> Lançar</a>
                            </div>

                        </div>
                        <br>

                        <div class="row" style="display:none">
                            <div class="col-md-3">
                                Preço Unitário: <span class="" id="preco">0,00</span>
                            </div>
                            <div class="col-md-3">
                                Desconto: <span class="" id="desconto">0,00</span>
                            </div>
                            <div class="col-md-3">
                                <div class="float-right" style="font-size:18px">  Total: <span class="" id="valor_liquido">0,00</span> </div>
                            </div>
                        </div>


                    </div>
                    {{--<div class="card-block" style="display:none;">

                        <div class="col-md-12">

                        <div class="row" >








                            <div class="col-md-2" style="padding:5px"><div class="form-group"><label>Valor Unitário</label>
                                    <input type="number" step="0.01" value="0.00" readonly class="form-control form-control-sm valor-preco" name="preco" id="preco">
                                </div></div>

                            <div class="col-md-2" style="padding:5px"><div class="form-group"><label>Subtotal</label>
                                    <input type="number" value="0.00" step="0.01" readonly class="form-control form-control-sm valor-bruto" name="bruto" id="bruto">
                                </div></div>

                            <div class="col-md-2" style="padding:5px"><div class="form-group"><label>Desconto</label>
                                    <input type="number" step="0.01" class="form-control valor-desconto" readonly name="desconto" class="form-control" id="desconto" value="0.00">
                                </div></div>

                            <div class="col-md-2" style="padding:5px"><div class="form-group"><label>Total</label>
                                    <input type="number" step="0.01" value="0.00"  readonly class="form-control form-control-sm valor-liquido" name="valor_liquido" id="valor_liquido">
                                </div></div>





                        </div>

                        </div>

                    </div>--}}
                </div>

                @endif

                <div class="card code-table" style="margin-top:25px">
                    <div class="card-header">
                        <h5>Produtos/Serviços</h5>

                    </div>
                    <div class="card-block pb-0">
                        <div class="table-responsive">
                            <table class="table table-hover  table-list" id="myTable">
                                <thead>
                                <tr>

                                    <th  width="300px">Produto/Serviço</th>
                                    <th>Usuário</th>
                                    <th width="50px">Qtd</th>
                                    <th width="100px">Preço</th>
                                    <th width="100px">Desconto</th>
                                    <th width="100px">Total</th>

                                    <th width="50px">Opções</th>

                                </tr></thead>
                                <tbody>



                                @foreach($venda[0]->Itens as $key => $registro)


                                    <tr role="row" class="odd">

                                        <td class="sorting_1"><input type="hidden" id="item_id-{{$key}}" name="item_id[]" value="{{$registro->id}}"><input type="hidden" name="produto_id[]" id="produto_id-{{$key}}" value="{{$registro->produto_id}}"> <input type="text" value="{{$registro->Produto->nome}}" readonly="" class="form-control form-control-sm " name="produto_nome[]" id="produto_nome-{{$key}}"></td>
                                        <td><input type="hidden" name="user_id[]" id="user_id-{{$key}}" value="{{$registro->user_id}}"><input type="text" value="{{$registro->Usuario->name}}" step="0.01" readonly="" class="form-control form-control-sm" name="user_nome[]" id="user_nome-{{$key}}"></td>
                                        <td><input type="number" value="{{$registro->qtd}}" step="1" readonly="" class="form-control form-control-sm valor-qtd" name="qtd[]" id="qtd-{{$key}}" onchange="calcula();"></td>
                                        <td><input type="number" value="{{$registro->valor_unitario}}" step="0.01" readonly="" class="form-control form-control-sm valor-preco" name="preco[]" id="preco-{{$key}}"></td>
                                        <td><input type="number" step="0.01" class="form-control valor-desconto" readonly="" name="desconto[]" id="desconto-{{$key}}" value="{{$registro->desconto}}"></td>
                                        <td><input type="number" value="{{$registro->valor_total}}" step="0.01" readonly="" class="form-control form-control-sm valor-liquido" name="valor_liquido[]" id="valor_liquido-{{$key}}"></td>
                                        @if($venda[0]->status != 'Quitada')
                                        <td><i class="fa fa-edit f-18 text-c-yellow" onclick="editar({{$key}})"></i><i class="fa fa-trash f-18 text-c-red" style="padding-left:15px" onclick="alerta_exclusao(this.parentNode.parentNode.rowIndex, {{$registro->id}});"></i></td>
                                        @endif
                                    </tr>

                                @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>


                <div class="card code-table" style="margin-top:25px">
                    <div class="card-header">
                        <h5>Pagamentos</h5>

                    </div>
                    <div class="card-block pb-0">
                        <div class="table-responsive">
                            <table class="table table-hover  table-list" id="myTable3">
                                <thead>
                                <tr>

                                    <th>Data</th>
                                    <th  width="300px">Forma</th>
                                    <th>Usuário</th>
                                    <th width="50px">Parcelas</th>
                                    <th width="100px">Valor</th>
                                    <th width="50px">Opções</th>

                                </tr></thead>
                                <tbody>





                                @foreach($venda[0]->Pagamentos as $key => $registro)

                                    <tr role="row" class="odd">
                                        <td><input type="text" value="{{date('d/m/Y', strtotime($registro->created_at))}}"  readonly="" class="form-control form-control-sm" name="parcela_created_at[]" id="created_at-{{$key}}"></td>
                                        <td class="sorting_1"><input type="hidden" name="parcela_forma_pagamento_id[]" id="forma_pagamento_id-{{$key}}" value="{{$registro->forma_pagamento_id}}"> <input type="text" value="{{$registro->Formas->nome}}" readonly="" class="form-control form-control-sm " name="form_nome[]" id="form_nome-{{$key}}"></td>
                                        <td><input type="hidden" name="parcela_forma_user_id[]" id="forma_user_id-{{$key}}" value="{{$registro->user_id}}"><input type="text" value="{{$registro->Usuario->name}}"  readonly="" class="form-control form-control-sm" name="forma_user_nome[]" id="forma_user_nome-{{$key}}"></td>
                                        <td><input type="number" value="{{$registro->parcelas}}" step="1" readonly="" class="form-control form-control-sm" name="parcela_qtd_parcelas[]" id="parcelas-{{$key}}"></td>
                                        <td><input type="number" value="{{$registro->valor}}" step="0.01" readonly="" class="form-control form-control-sm valor_pago" name="parcela_valor[]" id="valor-{{$key}}"></td>
                                        @if($venda[0]->status != 'Quitada')
                                        <td><i class="fa fa-edit f-18 text-c-yellow" onclick="editar_pag({{$key}}, {{$registro->id}})"></i><i class="fa fa-trash f-18 text-c-red" style="padding-left:15px" onclick="alerta_exclusao_pag(this.parentNode.parentNode.rowIndex, {{$registro->id}});"></i></td>
                                        @endif
                                    </tr>

                                @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>

            <div class="col-md-3">
                <div class="card @if($venda[0]->status == 'Aberta')theme-bg2 @elseif($venda[0]->status == 'Parcialmente Quitada')  bg-c-blue bitcoin-wallet @else theme-bg bitcoin-wallet  @endif" style="padding:15px 20px; margin-bottom:-0px">
                    <div class="card-block">
                        <h5 class="text-white mb-2">Valor Total R$</h5>
                        <div class="text-white mb-3 f-w-300" style="font-size:35px" id="total">0,00</div>


                    </div>
                </div>

                <div class="card profit-bar">
                    <div class="card-block" style="padding: 20px; margin-top:0px">


                        <span class="text-muted f-w-300 mt-4">Total Bruto <span class="float-right" id="total_bruto">0,00</span></span><br>
                        <span class="text-muted f-w-300 mt-4">Desconto <span class="float-right" id="total_desconto">0,00</span></span><br>
                        <span class="text-muted f-w-300 mt-4">Total Líquido <span class="float-right" id="total_liquido">0,00</span></span><br>
                        <br>
                        <span class="text-primary  mt-4">Total Pago <span class="float-right" id="total_pago">0,00</span></span><br>
                        <span class="text-danger  mb-1">Total a Pagar <span class="float-right" id="total_a_pagar">0,00</span></span><br>

                    </div>


                </div>

                <div class="card" style="background:#f4f7fa; box-shadow:0 0 0 0;-webkit-box-shadow:0 0 0 0;">

                    @if($venda[0]->status != 'Quitada')
                    <span class="label theme-bg text-white f-14 f-w-400 float-right btn-rounded btn-block" style="padding:10px"   onclick="pagamento()">
                        <i class="fa fa-edit"></i>
                        <a href="#!" class="float-right" style="color:white;">Registrar Pagamento</a>
                    </span>
                    @endif

                    <?php dd($venda[0]->Nfce); ?>

                    @if($venda[0]->status == 'Quitada' and $venda[0]->Nfce->status == '4 - OK - Autorizado uso')

                            <span class="label theme-bg text-white f-14 f-w-400 float-right btn-rounded btn-block" style="padding:10px" >
                        <i class="fa fa-edit"></i>
                        <a href="#" class="float-right" style="color:white;" >Imprimir NFCE</a>

                     @else

                            <span class="label theme-bg text-white f-14 f-w-400 float-right btn-rounded btn-block" style="padding:10px" onclick="gerar_nfce()">
                            <i class="fa fa-edit"></i>
                            <a href="#" class="float-right" style="color:white;" >Gerar NFCE</a>
                        </span>



                    </span>

                    @endif


                </div>

                <hr>


            </div>



        </div>



        <div class="modal fade" id="exampleModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Registrar Pagamentos</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>






                    <div class="modal-body" style="padding:0px;">

                        <div class="row">

                            <div class="col-md-12">

                                <div class="table-responsive">
                                    <table class="table table-hover  table-list" id="myTable2">
                                        <thead>
                                        <tr>

                                            <th>Forma de Pagamento</th>
                                            <th width="50px">Parcelas</th>
                                            <th>Valor</th>


                                        </tr></thead>
                                        <tbody>
                                        @foreach($formaPagamentos as $key => $formas)
                                            <tr>

                                                <td style="padding:20px"><i class="fa fa-dollar-sign"></i> {{$formas->nome}} <input type="hidden" value="{{$formas->id}}" name="forma_pagamento_id[]"> </td>
                                                <td style="padding:10px"><input type="number" class="form-control" value="1" name="parcelas[]"></td>
                                                <td style="padding:10px"><input type="number" step="0.01" class="form-control" id="forma_pag" name="valor_parcela[]"></td>


                                            </tr>
                                        @endforeach

                                        </tbody>
                                    </table>
                                </div>



                            </div>

                        </div>

                    </div>
                    <div class="modal-footer">

                        <button type="submit" class="btn btn-primary" >Confirmar</button>
                    </div>



                </div>
            </div>
        </div>




    </form>


    <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fa fa-edit"></i> Produto/Serviço</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>


                <input type="hidden" id="linha" value="">
                <input type="hidden" id="item_id" value="">
                <input type="hidden" id="permite_desconto" value="">
                <input type="hidden" id="desconto_maximo" value="">
                @csrf


                <div class="modal-body">

                    <div class="row">

                        <div class="col-md-12">

                            <div class="input-group-sm col-sm-12">

                                <div align="center" class="">
                                    <h4 class="m-t-35" id="edit_produto">Nome do Produto</h4>
                                    <span class="text-muted">Valor Unitário: </span><span class="text-muted" id="edit_preco"></span>

                                </div>

                                <br>


                            </div>


                            <div class="input-group-sm col-sm-12">
                                <i class="fa fa-box-open"></i> <label for="valor"> Quantidade</label>
                                <input type="number" step="1"  class="form-control form-control-sm" name="edit_qtd" id="edit_qtd" onchange="calcula()" >
                            </div>

                            <br>

                            <div class="input-group-sm col-sm-12">
                                <i class="fa fa-shopping-cart"></i><label for="valor"> Usuário</label>
                                <select class="form-control form-control-sm js-select" name="edit_user" id="edit_user">
                                    @foreach($vendedores as $vendedor)
                                        <option value="{{$vendedor->id}}">{{$vendedor->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <br>

                            <div class="input-group-sm col-sm-12">
                                <i class="fa fa-percent"></i><label for="valor"> Desconto em R$</label>
                                <input type="number" step="0.01"  class="form-control form-control-sm" name="edit_desconto" id="edit_desconto" onblur="calcula()" onchange="calcula()">
                            </div>

                            <br>

                            <div class="input-group-sm col-sm-12">
                                <i class="fa fa-dollar-sign"></i><label for="valor"> Total</label>
                                <input type="number" step="0.01" disabled class="form-control form-control-sm" name="edit_liquido" id="edit_liquido">
                            </div>

                        </div>

                    </div>

                </div>
                <div class="modal-footer">

                    <button type="button" class="btn btn-primary btn-block"  onclick="salvar_item()"><i class="fa fa-save"></i>  Salvar</button>
                </div>



            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModal4" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-danger">Excluir Registro</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="" method="post" id="items_form" name="items_form">

                    <input type="hidden" name="_method" value="delete">
                    <input type="hidden" name="linha" id="linha" value="">
                    @csrf


                    <div class="modal-body">

                        <div class="row">

                            <div class="col-md-12">

                                <h4 class="text-danger mb-1"><i class="fa fa-trash"></i> Confirma a Exclusão deste Registro?</h4>



                            </div>

                        </div>

                    </div>
                    <div class="modal-footer">

                        <button type="button" class="btn btn-danger"  onclick="confirmar_exclusao()">Sim! Excluir</button>
                    </div>



            </div>
        </div>
    </div>


    <div class="modal fade" id="exampleModal5" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-danger">Excluir Registro</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="" method="post" id="items_form" name="items_form">

                    <input type="hidden" name="_method" value="delete">
                    <input type="hidden" id="pag_id" value="">
                    @csrf


                    <div class="modal-body">

                        <div class="row">

                            <div class="col-md-12">

                                <h4 class="text-danger mb-1"><i class="fa fa-trash"></i> Confirma a Exclusão deste Registro?</h4>



                            </div>

                        </div>

                    </div>
                    <div class="modal-footer">

                        <button type="button" class="btn btn-danger"  onclick="confirmar_exclusao_pag()">Sim! Excluir</button>
                    </div>



            </div>
        </div>
    </div>


    <div class="modal fade" id="exampleModal6" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fa fa-edit"></i> Pagamentos</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>




                <div class="modal-body">

                    <div class="row">

                        <div class="col-md-12">



                            <div class="input-group-sm col-sm-12">
                                <i class="fa fa-box-open"></i> <label for="valor"> Data</label>
                                <input type="text"   class="form-control form-control-sm" name="pg_ed_data" id="pg_ed_data" readonly >
                            </div>

                            <br>

                            <div class="input-group-sm col-sm-12">
                                <i class="fa fa-shopping-cart"></i><label for="valor"> Forma de Pagamento</label>
                                <select class="form-control form-control-sm js-select" name="pg_ed_forma_pagamento_id" id="pg_ed_forma_pagamento_id">
                                    @foreach($formaPagamentos as $forma)
                                        <option value="{{$forma->id}}">{{$forma->nome}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <br>

                            <div class="input-group-sm col-sm-12">
                                <i class="fa fa-percent"></i><label for="valor"> Parcelas</label>
                                <input type="number" step="1"  class="form-control form-control-sm" name="pg_ed_parcelas" id="pg_ed_parcelas">
                            </div>

                            <br>

                            <div class="input-group-sm col-sm-12">
                                <i class="fa fa-dollar-sign"></i><label for="valor"> Valor</label>
                                <input type="number" step="0.01"  class="form-control form-control-sm" name="pg_ed_valor" id="pg_ed_valor">
                            </div>

                        </div>

                    </div>

                </div>
                <div class="modal-footer">

                    <button type="button" class="btn btn-primary btn-block"  onclick="salvar_pag()"><i class="fa fa-save"></i>  Salvar</button>
                </div>



            </div>
        </div>
    </div>


    <div class="modal fade" id="exampleModal7" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fa fa-edit"></i> CPF na Nota ?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>




                <div class="modal-body">

                    <div class="row">

                        <div class="col-md-12">




                            <br>


                            <div class="input-group-sm col-sm-12">
                                <i class="fa fa-dollar-sign"></i><label for="valor"> CPF / CNPJ</label>
                                <input type="text"   class="form-control form-control-sm" name="nota_cpf" id="nota_cpf" value="{{$venda[0]->Cliente->cpf_cnpj}}" onblur="atualiza_link()">
                            </div>

                        </div>

                    </div>

                </div>
                <div class="modal-footer">

                    <a id="link_gerar" target="_blank" href="{{route('nfce.gerar', ['venda_id' => $venda[0]->id, 'cpf' => $venda[0]->Cliente->cpf_cnpj])}}" type="button" class="btn btn-primary btn-block" onclick="fechar_modal()" ><i class="fa fa-save"></i>  Gerar</a>
                </div>



            </div>
        </div>
    </div>



@endsection

@section('posScript')

    <script>

        $(document).ready(function () {

            calcula_total();

            });


        function atualiza_link(){

            var cpf = document.getElementById('nota_cpf').value;

            document.getElementById('link_gerar').href =  '{{url("nfce/".$venda[0]->id )}}' + '?cpf=' + cpf ;



        }


        //codigo para popular o combo de clientes dinamicamente
        $('#cliente_id').select2({
            ajax: {
                url: "{{route('cliente.localizar')}}",
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        q: params.term // search term
                    };
                },
                processResults: function (data, params) {
                    return {
                        results: data.results
                    };
                },
            },
            placeholder: 'Digite pelo menos 3 caracteres',
            minimumInputLength: 3,
        });


        //codigo para popular o combo de produtos dinamicamente
        $('#produto_id').select2({
            ajax: {
                url: "{{route('produto.localizar')}}",
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        q: params.term // search term
                    };
                },
                processResults: function (data, params) {
                    return {
                        results: data.results
                    };
                },
            },
            placeholder: 'Digite pelo menos 3 caracteres',
            minimumInputLength: 3,
        });


        $('#vendedor_id').select2();
        $('#user_id').select2();



        $('#produto_id').on('select2:select', function (e) {
            var data = e.params.data;

            $('#preco').text(data.preco);
            $('#valor_liquido').text(data.preco);
            $('#bruto').text(data.preco);

        });



        function calcula(){



            var preco =  parseFloat($("#preco").text());
            var desconto = parseFloat($("#desconto").text());
            var qtd = document.getElementById("qtd").value;


            var liquido = (preco * qtd) - desconto;
            var bruto = (preco * qtd);



            $("#valor_liquido").text(liquido);
            $("#bruto").text(bruto);




        };


        var count = '{{count($venda[0]->Itens)}}';


        function adicionar_item(){


            var produto_id = document.getElementById("produto_id").value;
            var venda_id = document.getElementById("venda_id").value;
            var user_id = document.getElementById("user_id").value;
            var qtd = parseInt(document.getElementById("qtd").value);
            var preco =  parseFloat($("#preco").text());
            var sub_total_a = (qtd * preco);
            var sub_total_b = sub_total_a.toFixed(2);
            var desconto = 0.00;
            var valor_total = sub_total_b;


            $.ajax({
                url: '{{route('items.store')}}',
                type: 'POST',
                data: 'produto_id='+produto_id+'&venda_id='+venda_id+'&user_id='+user_id+'&qtd='+qtd+'&valor_unitario='+preco+'&sub_total='+sub_total_b+'&desconto='+desconto+'&valor_total='+valor_total+'&_token={{csrf_token()}}',
                success: function(data){

                    var item_id = data.item_id;


                    addRow(item_id)
                },
                error: function(data){

                    alert('Erro ao tentar salvar o item!')
                }
            });


        }

        function addRow(item_id) {


            var produto = document.getElementById("produto_id").options[document.getElementById("produto_id").selectedIndex].text;
            var produto_id = document.getElementById("produto_id").value;
            var user = document.getElementById("user_id").options[document.getElementById("user_id").selectedIndex].text;
            var user_id = document.getElementById("user_id").value;
            var qtd = parseInt(document.getElementById("qtd").value);
            var preco =  parseFloat($("#preco").text());
            var total = (preco * qtd);
            var item_id = item_id;

            $('table#myTable').dataTable().fnAddData( [

                '<input type="hidden" id="item_id-' + count + '" name="item_id[]" value="'+ item_id +'"><input type="hidden" name="produto_id[]" id="produto_id-' + count + '" value="' + produto_id +'"> <input type="text" value="' + produto + '"  readonly class="form-control form-control-sm " name="produto_nome[]" id="produto_nome-' + count + '">',
                '<input type="hidden" name="user_id[]" id="user_id-' + count + '" value="' + user_id +'"><input type="text" value="' + user + '" step="0.01" readonly class="form-control form-control-sm" name="user_nome[]" id="user_nome-' + count + '">',
                '<input type="number" value="' + qtd + '" step="1" value="1" readonly class="form-control form-control-sm valor-qtd" name="qtd[]" id="qtd-' + count + '" onchange="calcula(' + count + ');">',
                '<input type="number" value="' + preco + '" step="0.01" readonly class="form-control form-control-sm valor-preco" name="preco[]" id="preco-' + count + '">',
                '<input type="number" step="0.01" class="form-control valor-desconto" readonly name="desconto[]" id="desconto-' + count + '" value="0.00">',
                '<input type="number" value="' + total + '" step="0.01"  readonly class="form-control form-control-sm valor-liquido" name="valor_liquido[]" id="valor_liquido-' + count + '">',

                '<i class="fa fa-edit f-18 text-c-yellow" onclick="editar('+ count + ')"></i><i class="fa fa-trash f-18 text-c-red"  style="padding-left:15px" onclick="alerta_exclusao(this.parentNode.parentNode.rowIndex, '+ item_id +');"></i>' ] );

            count++;

            $('#produto_id').val(null).trigger('change');
            document.getElementById('qtd').value = 1;

            calcula_total();

        }

        function confirmar_exclusao(){

            var item_id = $('#item_id').val();
            var linha = $('#linha').val();

            var url = '{{route('items.store')}}' + '/' + item_id

            $.ajax({
                url: url,
                type: 'DELETE',
                data: '_token={{csrf_token()}}',
                success: function(data){

                    deleteRow(linha)
                    $("#exampleModal4").modal('hide');
                },
                error: function(data){

                    alert('Erro ao tentar excluir o item!')
                }
            });

        }

        function confirmar_exclusao_pag(){

            var pag_id = $('#pag_id').val();
            var linha = $('#linha').val();

            var url = '{{route('pagamentos.store')}}' + '/' + pag_id

            $.ajax({
                url: url,
                type: 'DELETE',
                data: '_token={{csrf_token()}}',
                success: function(data){

                    deleteRow_pag(linha);
                    $("#exampleModal5").modal('hide');
                },
                error: function(data){

                    alert('Erro ao tentar excluir o item!')
                }
            });

        }


        function alerta_exclusao(linha, id){

            $('#linha').val(linha);
            $('#item_id').val(id);

            $("#exampleModal4").modal();
        }


        function alerta_exclusao_pag(linha, id){

            $('#linha').val(linha);
            $('#pag_id').val(id);

            $("#exampleModal5").modal();
        }



        function deleteRow (linha) {



            if (count != 0) {
                $("table#myTable").dataTable().fnDeleteRow(linha - 1);

                //count--;

                calcula_total();
            }

        }


        function deleteRow_pag (linha) {


                $("table#myTable3").dataTable().fnDeleteRow(linha - 1);

                calcula_total();

        }



        function editar(linha){

            var item_id = document.getElementById('item_id-' + linha).value;
            var produto = document.getElementById('produto_nome-' + linha).value;
            var qtd = document.getElementById('qtd-' + linha).value;
            var preco = document.getElementById('preco-' + linha).value;
            var desconto = document.getElementById('desconto-' + linha).value;
            var usuario_id = document.getElementById('user_id-' + linha).value;
            var valor_liquido = document.getElementById('valor_liquido-' + linha).value;



            $("#linha").val(linha);
            $("#item_id").val(item_id);
            $("#edit_produto").text(produto);
            $("#edit_preco").text(preco);
            $("#edit_qtd").val(qtd);
            $('#edit_user').val(usuario_id);
            $('#edit_desconto').val(desconto);
            $('#edit_liquido').val(valor_liquido);


            $("#exampleModal2").modal();
        }


        function salvar_item(){

            var linha = $("#linha").val();
            var id = $("#item_id").val();
            var preco = document.getElementById('preco-' + linha).value;
            var qtd = $("#edit_qtd").val();
            var desconto = $('#edit_desconto').val();
            var user_id = $('#edit_user').val();
            var valor_total = $('#edit_liquido').val();

            var sub_total_a = qtd * preco
            var sub_total_b = sub_total_a.toFixed(2);

            var url = '{{route('items.store')}}' + '/' + id



            $.ajax({
                url: url,
                type: 'PUT',
                data: '&user_id='+user_id+'&qtd='+qtd+'&sub_total='+sub_total_b+'&desconto='+desconto+'&valor_total='+valor_total+'&_token={{csrf_token()}}',
                success: function(data){

                    atualizar_item()
                },
                error: function(data){

                    alert('Erro ao tentar atualizar o item!')
                }
            });

        }


        function atualizar_item(){

            var linha = $("#linha").val();

            document.getElementById('qtd-' + linha).value = $("#edit_qtd").val();
            document.getElementById('desconto-' + linha).value = $('#edit_desconto').val();
            document.getElementById('user_id-' + linha).value = $('#edit_user').val();
            document.getElementById('user_nome-' + linha).value = document.getElementById("edit_user").options[document.getElementById("edit_user").selectedIndex].text;
            document.getElementById('valor_liquido-' + linha).value = $('#edit_liquido').val();

            $("#item_id").text('');
            $("#edit_produto").text('');
            $("#edit_preco").text('');
            $("#edit_qtd").val('');
            $('#edit_user').val('');
            $('#edit_desconto').val('');
            $('#edit_liquido').val('');



            $("#exampleModal2").modal('hide');

            calcula_total();

        }


        function calcula(){

            var preco = $("#edit_preco").text();
            var desconto = document.getElementById('edit_desconto').value;
            var qtd = document.getElementById('edit_qtd').value;

            var liquido = (preco * qtd) - desconto;

            $('#edit_liquido').val(liquido.toFixed(2));



        };


        function calcula_total() {

            $(function () {

                var valorCalculado = 0;

                $(".valor-liquido").each(function () {

                    valorCalculado += parseFloat($(this)[0].value);
                });

                var valorCalculado = valorCalculado.toLocaleString('pt-br',{style: 'currency', currency: 'BRL'});

                $("#total").text(valorCalculado);
                $("#total_liquido").text(valorCalculado);

            });



            $(function () {

                var valorCalculado = 0;


                $(".valor-desconto").each(function () {

                    valorCalculado += parseFloat($(this)[0].value);
                });

                var valorCalculado = valorCalculado.toLocaleString('pt-br',{style: 'currency', currency: 'BRL'});

                $("#total_desconto").text(valorCalculado);

            });


            $(function () {

                var valorCalculado = 0;


                $(".valor_pago").each(function () {

                    valorCalculado += parseFloat($(this)[0].value);
                });

                var valorCalculado = valorCalculado.toLocaleString('pt-br',{style: 'currency', currency: 'BRL'});

                $("#total_pago").text(valorCalculado);

            });


            $(function () {

                var liquido = $("#total_liquido").text();
                var desconto = $("#total_desconto").text();

                var v1 = liquido.replace('R$','');
                var v2 = desconto.replace('R$','');

                var v3 = v1.replace('.','');
                var v4 = v2.replace('.','');

                var v5 = parseFloat(v3.replace(',','.'));
                var v6 = parseFloat(v4.replace(',','.'));


                var valorCalculado1 = (v5 + v6);

                var valorCalculado = valorCalculado1.toLocaleString('pt-br',{style: 'currency', currency: 'BRL'});

                $("#total_bruto").text(valorCalculado);

            });


            $(function () {

                var liquido = $("#total_liquido").text();
                var pago = $("#total_pago").text();

                var v1 = liquido.replace('R$','');
                var v2 = pago.replace('R$','');

                var v3 = v1.replace('.','');
                var v4 = v2.replace('.','');

                var v5 = parseFloat(v3.replace(',','.'));
                var v6 = parseFloat(v4.replace(',','.'));


                var valorCalculado1 = (v5 - v6);

                var valorCalculado = valorCalculado1.toLocaleString('pt-br',{style: 'currency', currency: 'BRL'});

                $("#total_a_pagar").text(valorCalculado);

            });


        }


        function pagamento(){

            $("#exampleModal3").modal();
        }

        function gerar_nfce(){

            $("#exampleModal7").modal();
        }

        function fechar_modal(){

            $("#exampleModal7").modal('hide');
        }


        function editar_pag(linha, id){

            document.getElementById('pag_id').value = id;
            document.getElementById('linha').value = linha;

            var data = document.getElementById('created_at-' + linha ).value;
            var forma = document.getElementById('forma_pagamento_id-' + linha ).value;
            var parcela = document.getElementById('parcelas-' + linha ).value;
            var valor = document.getElementById('valor-' + linha ).value;


            document.getElementById('pg_ed_data').value = data;
            document.getElementById('pg_ed_forma_pagamento_id').value = forma;
            document.getElementById('pg_ed_parcelas').value = parcela;
            document.getElementById('pg_ed_valor').value = valor;



            $("#exampleModal6").modal();
        }


        function salvar_pag(){


            var id = $("#pag_id").val();

            var forma = $("#pg_ed_forma_pagamento_id").val();
            var parcela = $('#pg_ed_parcelas').val();
            var valor = $('#pg_ed_valor').val();


            var url = '{{route('pagamentos.store')}}' + '/' + id



            $.ajax({
                url: url,
                type: 'PUT',
                data: '&forma_pagamento_id='+forma+'&parcelas='+parcela+'&valor='+valor+'&_token={{csrf_token()}}',
                success: function(data){

                    atualizar_pag()
                },
                error: function(data){

                    alert('Erro ao tentar atualizar o pagamento!')
                }
            });

        }


        function atualizar_pag(){

            var id = document.getElementById('pag_id').value;
            var linha = document.getElementById('linha').value;

            var fom_name = document.getElementById("pg_ed_forma_pagamento_id").options[document.getElementById("pg_ed_forma_pagamento_id").selectedIndex].text;


            document.getElementById('forma_pagamento_id-' + linha ).value = document.getElementById('pg_ed_forma_pagamento_id').value;
            document.getElementById('form_nome-' + linha ).value = fom_name;
            document.getElementById('parcelas-' + linha ).value = document.getElementById('pg_ed_parcelas').value;
            document.getElementById('valor-' + linha ).value = document.getElementById('pg_ed_valor').value;

            calcula_total();

            $("#exampleModal6").modal('hide');
        }



    </script>


@endsection

