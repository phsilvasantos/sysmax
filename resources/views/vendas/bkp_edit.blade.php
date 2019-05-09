@extends('layouts.template')

@section('content')

    {{--<div  id="carregando" align="center" style="margin-bottom:300px; margin-top:100px;">

    <img src="{{url('/dattaable/assets/images/carregando.gif')}}">

    </div>--}}


    @if (session('status'))

    @endif

    <form action="{{route('vendas.update', $venda[0]->id)}}" method="post" id="vendas-form">

        @csrf
        <input type="hidden" name="origem" value="">
        <input type="hidden" name="_method" value="PUT">
        <input type="hidden" id="venda_id" name="venda_id" value="{{$venda[0]->id}}">

        <div class="row">
            <div class="col-md-9">
                <div class="kt-portlet__body">
                    <div class="tab-content">
                        <div class="tab-pane active" id="kt_portlet_base_demo_1_1_tab_content" role="tabpanel">
                            <h5>Cliente</h5>
                            <hr>

                            <div class="row">



                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Cliente</label>
                                        <input type="text" class="form-control form-control-sm" name="cliente_id" value="Cliente Não Identificado">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Vendedor</label>
                                        <input type="text" class="form-control form-control-sm" name="vendedor_id" value="usuário padrão">
                                    </div>
                                </div>


                            </div>



                        </div>

                    </div>
                </div>

                <div class="card code-table" style="margin-top:25px">
                    <div class="card-header">
                        <h5>Produtos/Serviços</h5>
                        <div class="card-header-right">

                            <label  class="label theme-bg text-white f-14 f-w-400 float-right btn-rounded" onclick="addRow();">+ Incluir</label>



                        </div>
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
                                    <th width="100px">Total</th>
                                    <th width="100px">Desconto</th>
                                    <th width="100px">Liquido</th>

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
                <div class="card theme-bg bitcoin-wallet" style="padding:15px 20px; margin-bottom:-0px">
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
                    <span class="label theme-bg text-white f-14 f-w-400 float-right btn-rounded btn-block" style="padding:10px">
                        <i class="fa fa-edit"></i>
                        <a href="#!" class="float-right" style="color:white;">Salvar Venda</a>
                    </span>


                </div>

                <hr>

                <div class="card profit-bar">
                    <div class="card-block" style="padding: 25px;">


                        <h6 class="text-muted f-w-300 mt-4">Total Bruto <span class="float-right">340</span></h6>
                        <h6 class="text-muted f-w-300 mt-4">Desconto <span class="float-right">340</span></h6>
                        <h6 class="text-muted f-w-300 mt-4">Total Líquido <span class="float-right">340</span></h6>

                    </div>
                </div>
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

                                                <td>{{$formas->nome}} <input type="hidden" value="{{$formas->id}}" name="forma_pagamento_id[]"> </td>
                                                <td><input type="number" class="form-control" value="1" name="parcelas[]"></td>
                                                <td><input type="number" step="0.01" class="form-control" id="forma_pag" name="valor_parcela[]"></td>


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
                    <h5 class="modal-title">Aplicar Desconto</h5>
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

                                    <div class="btn-group btn-group-toggle btn-auth-gen mb-4" data-toggle="buttons">
                                        <label class="btn btn-outline-theme2 btn-icon active" style="width: 140px;height: 50px;">
                                            <input type="radio"  id="customRadioInline1" checked="" name="customRadioInline1"><span><i class="fas fa-percent"></i><small class="d-block">Percentual</small></span>
                                        </label>
                                        <label class="btn btn-outline-theme2 btn-icon" style="width: 140px;height: 50px;">
                                            <input type="radio" id="customRadioInline2" name="customRadioInline1"> <span><i class="fas fa-dollar-sign"></i><small class="d-block">Valor</small></span>
                                        </label>
                                    </div>


                                </div>


                                </div>


                                <div class="input-group-sm col-sm-12">
                                    <label for="valor">Preço</label>
                                    <input type="number" step="0.01" disabled class="form-control form-control-sm" name="valor" id="calc_preco" >
                                </div>

                                <div class="input-group-sm col-sm-12">
                                    <label for="valor">Desconto</label>
                                    <input type="number" step="0.01"  class="form-control form-control-sm" name="valor" id="calc_desconto" onblur="calcula_desconto()">
                                </div>

                                <div class="input-group-sm col-sm-12">
                                    <label for="valor">Liquido</label>
                                    <input type="number" step="0.01" disabled class="form-control form-control-sm" name="valor" id="calc_liquido">
                                </div>

                            </div>

                        </div>

                    </div>
                    <div class="modal-footer">

                        <button type="button" class="btn btn-primary" data-dismiss="modal">Confirmar</button>
                    </div>



            </div>
        </div>
    </div>



    <div class="modal fade" id="exampleModal4" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Excluir Registro</h5>
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

                    <button type="button" class="btn btn-primary"  onclick="confirmar_exclusao()">Aplicar</button>
                </div>



            </div>
        </div>
    </div>



    <script type="text/javascript">

        var count = 0;

        //var count = {{count($venda[0]->Itens)}};

        function addRow() {
            $('table#myTable').dataTable().fnAddData( [


                '<select data-custom-attribute="" class="form-control form-control-sm js-example-data-ajax" name="produto_id[]" id="produto_id-' + count + '"></select>',
                '<select  class="form-control form-control-sm" name="user_id[]" id="user_id-' + count + '">@foreach($instace->TodosUsuarios() as $usuario)<option value="{{$usuario->id}}">{{$usuario->name}}</option>@endforeach</select>',
                '<input type="number" value="1" step="1" value="1" class="form-control form-control-sm valor-qtd" name="qtd[]" id="qtd-' + count + '" onchange="calcula(' + count + ');">',
                '<input type="number" value="0.00" step="0.01" readonly class="form-control form-control-sm valor-preco" name="preco[]" id="preco-' + count + '">',
                '<input type="number" value="0.00" step="0.01" readonly class="form-control form-control-sm valor-bruto" name="bruto[]" id="bruto-' + count + '">',
                '<div class="input-group input-group-sm"><input type="number" step="0.01" class="form-control form-control-sm valor-desconto" readonly name="desconto[]" id="desconto-' + count + '" value="0.00"><div class="input-group-append"  onclick="desconto(' + count + ');">\n' +
                '                                                            <button class="btn btn-default" type="button">$</button>\n' +
                '                                                        </div></div>',
                '<input type="number" step="0.01" value="0.00"  readonly class="form-control form-control-sm valor-liquido" name="valor_liquido[]" id="valor_liquido-' + count + '">',

                '<a href="#!" class="label theme-bg2 text-white f-12" onclick="deleteRow(this.parentNode.parentNode.rowIndex);">Excluir</a>' ] );


            procurar(count);

            count++;




        }



        function addInitialRow(venda_id) {



            $('table#myTable').dataTable().fnAddData( [



                '<input type="hidden" name="item_id[]" id="item_id-' + count + '" value=""><select data-custom-attribute="" class="form-control form-control-sm js-example-data-ajax" name="produto_id[]" id="produto_id-' + count + '"></select>',
                '<select  class="form-control form-control-sm" name="user_id[]" id="user_id-' + count + '">@foreach($instace->TodosUsuarios() as $usuario)<option value="{{$usuario->id}}">{{$usuario->name}}</option>@endforeach</select>',
                '<input type="number" value="1" step="1" value="1" class="form-control form-control-sm valor-qtd" name="qtd[]" id="qtd-' + count + '" onchange="calcula(' + count + ');">',
                '<input type="number" value="{{$venda[0]->Itens[0]->valor_unitario}}" step="0.01" readonly class="form-control form-control-sm valor-preco" name="preco[]" id="preco-' + count + '">',
                '<input type="number" value="0.00" step="0.01" readonly class="form-control form-control-sm valor-bruto" name="bruto[]" id="bruto-' + count + '">',
                '<div class="input-group input-group-sm"><input type="number" step="0.01" class="form-control valor-desconto" readonly name="desconto[]" id="desconto-' + count + '" value="0.00"><div class="input-group-append"  onclick="desconto(' + count + ');">\n' +
                '                                                            <button class="btn btn-default" type="button">$</button>\n' +
                '                                                        </div></div>',
                '<input type="number" step="0.01" value="0.00"  readonly class="form-control form-control-sm valor-liquido" name="valor_liquido[]" id="valor_liquido-' + count + '">',

                '<a href="#!" class="label theme-bg2 text-white f-12" onclick="excluir_item(this.parentNode.parentNode.rowIndex, this);" value="'+count+'">Excluir</a>' ] );


            procurarItem(count, venda_id);

            count++;


        }



        function deleteRow (linha) {



            if (count != 0) {
                $("table#myTable").dataTable().fnDeleteRow(linha - 1);

                count--;
                calcula_total();
            }


        }



        function procurar(count) {



            $("#produto_id-" + count).select2({
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
                        // parse the results into the format expected by Select2
                        // since we are using custom formatting functions we do not need to
                        // alter the remote JSON data, except to indicate that infinite
                        // scrolling can be used
                        //params.page = params.page || 1;

                        return {
                            results: data.items

                        };
                    },
                    cache: true
                },
                placeholder: 'Digite pelo menos 3 caracteres',
                escapeMarkup: function (markup) { return markup; }, // let our custom formatter work
                minimumInputLength: 3,
                templateResult: formatRepo,
                templateSelection: formatRepoSelection





            });




            function formatRepo (repo) {
                if (repo.loading) {
                    return repo.nome;
                }

                var markup = "<div class='select2-result-repository clearfix'>" +
                    "<div class='select2-result-repository__title'>" + repo.nome + "</div>";


                return markup;
            }

            function formatRepoSelection (repo) {


                return repo.nome || repo.nome;

            };



            $("#produto_id-" + count).on('select2:select', function (e) {
                var data = e.params.data;

                calcula_total();

                document.getElementById('preco-'+ count).value =  data.preco;
                document.getElementById('valor_liquido-'+ count).value =  data.preco;
                document.getElementById('bruto-'+ count).value =  data.preco;
                //document.getElementById('permite_desconto').value =  data.preco;
                //document.getElementById('desconto_maximo').value =  data.preco;



            });


        };


        function procurarItem(count, venda_id) {





            // Fetch the preselected item, and add to the control
            var produto = $("#produto_id-" + count);
            $.ajax({
                type: 'GET',
                url: "http://localhost/projetos/sysmax/public/product/localizar/" + venda_id
            }).then(function (data) {
                // create the option and append to Select2

                var option = new Option(data.items[count].nome,data.items[count].id);
                produto.append(option).trigger('change');

                // manually trigger the `select2:select` event
                produto.trigger({
                    type: 'select2:select',
                    params: {
                        data: data.items[count]
                    }
                });
            });









            $("#produto_id-" + count).on('select2:select', function (e) {
                var data = e.params.data;


                document.getElementById('preco-'+ count).value =  data.preco;
                document.getElementById('qtd-'+ count).value =  data.qtd;
                document.getElementById('valor_liquido-'+ count).value =  data.valor_total;
                document.getElementById('bruto-'+ count).value =  data.sub_total;
                document.getElementById('desconto-'+ count).value =  data.desconto;
                document.getElementById('item_id-'+ count).value =  data.item_id;
                //document.getElementById('permite_desconto').value =  data.preco;
                //document.getElementById('desconto_maximo').value =  data.preco;

                calcula_total();


                $("#produto_id-" + count).select2({
                    data: [{id: data.id,text: data.nome}]
                });


            });


        };



        function desconto(linha){

            var qtd = document.getElementById('qtd-' + linha).value;
            var preco = document.getElementById('preco-' + linha).value;

            var bruto = preco * qtd;

            document.getElementById('calc_preco').value = bruto.toFixed(2);
            document.getElementById('calc_desconto').value = null;
            document.getElementById('calc_liquido').value = null;
            document.getElementById('linha').value = linha;


            $("#exampleModal2").modal();
        };


        function calcula_desconto(){

            var linha = document.getElementById('linha').value;

            var opcao = document.getElementById('customRadioInline1').checked;
            var calc_preco = parseFloat(document.getElementById('calc_preco').value);
            var calc_desconto = parseFloat(document.getElementById('calc_desconto').value);
            var calc_liquido = 0;

            if(opcao) {


                var desconto = calc_desconto/100;
                var preco = calc_preco;

                calc_desconto = (desconto * preco);
                calc_liquido = calc_preco - calc_desconto;


                document.getElementById('calc_liquido').value = calc_liquido.toFixed(2);

                document.getElementById('desconto-' + linha).value = calc_desconto.toFixed(2);
                document.getElementById('valor_liquido-' + linha).value = calc_liquido.toFixed(2);

            }else{

                var desconto = calc_desconto;
                var preco = calc_preco;

                calc_liquido = preco - desconto;


                document.getElementById('calc_liquido').value = calc_liquido.toFixed(2);

                document.getElementById('desconto-' + linha).value = desconto.toFixed(2);
                document.getElementById('valor_liquido-' + linha).value = calc_liquido.toFixed(2);

            }

            calcula_total();


        };


        function calcula(linha){

            var preco = document.getElementById('preco-' + linha).value;
            var desconto = document.getElementById('desconto-' + linha).value;
            var qtd = document.getElementById('qtd-' + linha).value;

            var liquido = (preco * qtd) - desconto;
            var bruto = (preco * qtd);

            document.getElementById('valor_liquido-' + linha).value = liquido.toFixed(2);
            document.getElementById('bruto-' + linha).value = bruto.toFixed(2);

            calcula_total();


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


                $(".valor-bruto").each(function () {

                    valorCalculado += parseFloat($(this)[0].value);
                });

                var valorCalculado = valorCalculado.toLocaleString('pt-br',{style: 'currency', currency: 'BRL'});

                $("#total_bruto").text(valorCalculado);

            });


            $(function () {

                var valorCalculado = 0;


                $(".valor-desconto").each(function () {

                    valorCalculado += parseFloat($(this)[0].value);
                });

                var valorCalculado = valorCalculado.toLocaleString('pt-br',{style: 'currency', currency: 'BRL'});

                $("#total_desconto").text(valorCalculado);

            });



        }

        function pagamento(){

            $("#exampleModal3").modal();
        }

        function excluir_item(linha, obj){

            lin = obj.getAttribute("value")

            var item = 'item_id-' + lin

            var item_id = document.getElementById(item).value

            document.getElementById('linha').value = linha


            var url = "{{url('items')}}" + "/" +  item_id

            document.items_form.action = url;



            $("#exampleModal4").modal();

        }




        window.onload = function() {


            calcula_total();






        };




    </script>

@endsection



@section('posScript')

    <script>
        $(document).ready(function () {


                var count2 = {{count($venda[0]->Itens)}};
                var venda_id = document.getElementById('venda_id').value;

                var i;
                for (i = 0; i < count2; i++) {

                    addInitialRow(venda_id);


                };






            }


        );

        function confirmar_exclusao(){

            var url = document.items_form.action
            var linha = document.getElementById('linha').value


                var dados = $('#items_form').serialize();

                jQuery.ajax({
                    type: "DELETE",
                    url: url,
                    data: dados,
                    success: function( data )
                    {
                        deleteRow(linha);
                        $("#exampleModal4").modal('hide');
                        location.reload();
                    }
                });





        };

    </script>

@endsection

