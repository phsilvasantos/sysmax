@extends('layouts.template')

@section('content')

    @if (session('status'))

    @endif

    <form action="{{route('vendas.store')}}" method="post" id="vendas-form">

        @csrf
        <input type="hidden" id="origem" name="origem" value="">

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



                                <div class="col-md-6">
                                    <div class="form-group">
                                        <i class="fa fa-user"></i> <label>Cliente</label>

                                        <select class="form-control form-control-sm js-select" name="cliente_id" id="cliente_id" required>
                                            {{--<option value="0"  selected="selected">Cliente não Identificado</option>--}}
                                        </select>

                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <i class="fa fa-shopping-cart"></i> <label>Vendedor</label>

                                        <select class="form-control form-control-sm js-select" name="vendedor_id" id="vendedor_id">
                                            {{--<option value="0"  selected="selected">Vendedor Logado</option>--}}
                                            @foreach($vendedores as $vendedor)
                                                <option value="{{$vendedor->id}}">{{$vendedor->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>


                            </div>



                        </div>

                    </div>
                </div>



                <div class="card code-table" style="margin-top:25px">
                    <div class="card-header" style="padding-bottom:0px">

                        <h5>Lançamentos</h5>
                        <hr>

                        <div class="row">

                            <div class="col-md-1" style="padding:5px"><div class="form-group"><label>Qtd</label>
                                    <input type="number" value="1" step="1" value="1" class="form-control form-control-sm valor-qtd" name="qtd" id="qtd" onchange="calcula()" style="padding:4px 8px;">
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
                                <a href="#"  class="label theme-bg text-white f-14 f-w-400  btn-rounded" onclick="addRow();"> Lançar</a>
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

                                {{--@foreach($venda[0]->Itens as $key => $registro)

                                    <tr>

                                        <td><select data-custom-attribute="" class="form-control form-control-sm js-example-data-ajax" name="produto_id[]" id="produto_id-{{$key}}">
                                                <option value="{{$registro->produto_id}}">{{$registro->Produto->nome}}</option>
                                            </select></td>
                                        <td><select  class="form-control form-control-sm" name="user_id[]" id="user_id-{{$key}}">@foreach($instace->TodosUsuarios() as $usuario)<option value="{{$usuario->id}}">{{$usuario->name}}</option>@endforeach</select></td>
                                        <td><input type="number" value="{{$registro->qtd}}" step="1" value="1" class="form-control form-control-sm valor-qtd" name="qtd[]" id="qtd-{{$key}}" onchange="calcula({{$key}});"></td>
                                        <td><input type="number" value="{{$registro->valor_unitario}}" step="0.01" readonly class="form-control form-control-sm valor-preco" name="preco[]" id="preco-{{$key}}"></td>
                                        <td><input type="number" value="{{$registro->sub_total}}" step="0.01" readonly class="form-control form-control-sm valor-bruto" name="bruto[]" id="bruto-{{$key}}"></td>
                                        <td><div class="input-group input-group-sm"><input type="number" step="0.01" class="form-control form-control-sm valor-desconto" readonly name="desconto[]" id="desconto-{{$key}}" value="{{$registro->desconto}}"><div class="input-group-append"  onclick="desconto({{$key}});"><button class="btn btn-default" type="button">$</button></div></div></td>
                                        <td><input type="number" step="0.01" value="{{$registro->valor_total}}"  readonly class="form-control form-control-sm valor-liquido" name="valor_liquido[]" id="valor_liquido-{{$key}}"></td>

                                        <td><a href="#!" class="label theme-bg2 text-white f-12" onclick="deleteRow(this.parentNode.parentNode.rowIndex);">Excluir</a></td>

                                    </tr>

                                @endforeach--}}

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>


            </div>

            <div class="col-md-3">
                <div class="card theme-bg2" style="padding:15px 20px; margin-bottom:-0px">
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
                        <span class="text-muted f-w-300 mt-4">Total Pago <span class="float-right" id="total_pago">0,00</span></span><br>
                        <span class="text-muted f-w-300 mt-4">Total a Pagar <span class="float-right" id="total_a_pagar">0,00</span></span><br>

                    </div>


                </div>

                <div class="card" style="background:#f4f7fa; box-shadow:0 0 0 0;-webkit-box-shadow:0 0 0 0;">
                    <span class="label theme-bg text-white f-14 f-w-400 float-right btn-rounded btn-block" style="padding:10px"   onclick="pagamento()">
                        <i class="fa fa-edit"></i>
                        <a href="#!" class="float-right" style="color:white;">Registrar Pagamento</a>
                    </span>
                    <span class="label theme-bg text-white f-14 f-w-400 float-right btn-rounded btn-block" style="padding:10px" onclick="lancar()">
                        <i class="fa fa-edit"></i>
                        <a href="#!" class="float-right" style="color:white;" >Salvar Venda</a>
                    </span>


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

                        <button type="button" class="btn btn-primary btn-block" data-dismiss="modal" onclick="salvar_item()"><i class="fa fa-save"></i>  Salvar</button>
                    </div>



            </div>
        </div>
    </div>





@endsection

@section('posScript')

    <script>

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


            var count = 0;

            function addRow() {


                var produto = document.getElementById("produto_id").options[document.getElementById("produto_id").selectedIndex].text;
                var produto_id = document.getElementById("produto_id").value;
                var user = document.getElementById("user_id").options[document.getElementById("user_id").selectedIndex].text;
                var user_id = document.getElementById("user_id").value;
                var qtd = parseInt(document.getElementById("qtd").value);
                var preco =  parseFloat($("#preco").text());
                var total = (preco * qtd);

                 $('table#myTable').dataTable().fnAddData( [

                    '<input type="hidden" name="produto_id[]" id="produto_id-' + count + '" value="' + produto_id +'"> <input type="text" value="' + produto + '"  readonly class="form-control form-control-sm " name="produto_nome[]" id="produto_nome-' + count + '">',
                    '<input type="hidden" name="user_id[]" id="user_id-' + count + '" value="' + user_id +'"><input type="text" value="' + user + '" step="0.01" readonly class="form-control form-control-sm" name="user_nome[]" id="user_nome-' + count + '">',
                    '<input type="number" value="' + qtd + '" step="1" value="1" readonly class="form-control form-control-sm valor-qtd" name="qtd[]" id="qtd-' + count + '" onchange="calcula(' + count + ');">',
                    '<input type="number" value="' + preco + '" step="0.01" readonly class="form-control form-control-sm valor-preco" name="preco[]" id="preco-' + count + '">',
                    '<input type="number" step="0.01" class="form-control valor-desconto" readonly name="desconto[]" id="desconto-' + count + '" value="0.00">',
                    '<input type="number" value="' + total + '" step="0.01"  readonly class="form-control form-control-sm valor-liquido" name="valor_liquido[]" id="valor_liquido-' + count + '">',

                    '<i class="fa fa-edit f-18 text-c-yellow" onclick="editar('+ count + ')"></i><i class="fa fa-trash f-18 text-c-red"  style="padding-left:15px" onclick="deleteRow(this.parentNode.parentNode.rowIndex);"></i>' ] );

                count++;

                $('#produto_id').val(null).trigger('change');
                document.getElementById('qtd').value = 1;

                calcula_total();

            }


            function deleteRow (linha) {

                if (count != 0) {
                    $("table#myTable").dataTable().fnDeleteRow(linha - 1);

                    //count--;
                    calcula_total();
                }

            }

            function editar(linha){


                var produto = document.getElementById('produto_nome-' + linha).value;
                var qtd = document.getElementById('qtd-' + linha).value;
                var preco = document.getElementById('preco-' + linha).value;
                var desconto = document.getElementById('desconto-' + linha).value;
                var usuario_id = document.getElementById('user_id-' + linha).value;
                var valor_liquido = document.getElementById('valor_liquido-' + linha).value;


                $("#linha").val(linha);
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

                document.getElementById('qtd-' + linha).value = $("#edit_qtd").val();
                document.getElementById('desconto-' + linha).value = $('#edit_desconto').val();
                document.getElementById('user_id-' + linha).value = $('#edit_user').val();
                document.getElementById('user_nome-' + linha).value = document.getElementById("edit_user").options[document.getElementById("edit_user").selectedIndex].text;
                document.getElementById('valor_liquido-' + linha).value = $('#edit_liquido').val();

                $("#edit_produto").text('');
                $("#edit_preco").text('');
                $("#edit_qtd").val('');
                $('#edit_user').val('');
                $('#edit_desconto').val('');
                $('#edit_liquido').val('');


                $("#exampleModal2").modal().hide;

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


            }


            function pagamento(){

                $("#exampleModal3").modal();
            }


    </script>


@endsection

