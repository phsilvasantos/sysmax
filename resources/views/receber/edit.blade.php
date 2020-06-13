@extends('layouts.template')

@section('content')

    @if (session('status'))

    @endif

    <form action="{{route('receber.update', $registro->id)}}" method="post" name="form1" id="form1">

        @csrf
        <input type="hidden" id="_method" name="_method" value="PUT">
        <input type="hidden" id="origem" name="origem" value="">


        <div class="kt-portlet kt-portlet--tabs">

            <div class="row">

                <div class="col-md-9 filter-bar">

                    <nav class="navbar m-b-10 p-10">
                        <ul class="nav">
                            @if($registro->status != 'Quitado')
                            <li class="nav-item f-text active">
                                <a class="nav-link text-secondary" href="#" onclick="document.getElementById('form1').submit()"><i class="fa fa-check"></i> Salvar <span class="sr-only">(current)</span></a>
                            </li>
                            @endif
                            <li class="nav-item dropdown">
                                <a class="nav-link text-secondary" href="{{route('receber.index')}}" ><i class="fa fa-angle-left"></i> Voltar</a>

                            </li>

                            <li class="nav-item dropdown">
                                <a class="nav-link text-secondary" href="#"  onclick="document.getElementById('form1').reset()"><i class="fa fa-ban"></i> Cancelar</a>

                            </li>

                            <li class="nav-item dropdown">
                                <a class="nav-link text-secondary" href="{{route('receber.create')}}"><i class="fa fa-plus"></i> Novo</a>

                            </li>

                            @if(auth()->user()->hasPermissionThroughRole('delete-receber'))
                            <li onclick="excluir_receber({{$registro->id}})"  class="nav-link text-secondary"><a class="text-danger" href="#!"><i class="feather icon-trash"></i> Excluir</a></li>
                            @endif

                        </ul>
                        <div class="nav-item nav-grid f-view">
                            <div class="form-group d-inline">
                                <div class="radio radio-primary radio-fill d-inline">
                                    <input type="radio" name="tipo" id="radio-infill-1" @if($registro->tipo == 'credito') checked="" @endif value="credito" onclick="credito();">
                                    <label for="radio-infill-1" class="cr">Receber</label>
                                </div>
                            </div>
                            <div class="form-group d-inline">
                                <div class="radio radio-danger radio-fill d-inline">
                                    <input type="radio" name="tipo" id="radio-infill-2" @if($registro->tipo == 'debito') checked="" @endif value="debito" onclick="debito();">
                                    <label for="radio-infill-2" class="cr">Pagar</label>
                                </div>
                            </div>
                        </div>
                    </nav>

                    <div class="kt-portlet__body">


                        <div class="tab-content">
                            <div class="tab-pane @if(Session::get('status') != 'Animal Incluido') active @endif" id="kt_portlet_base_demo_1_1_tab_content" role="tabpanel">


                                <div id="titulo_recebe" @if($registro->tipo == 'credito') style="display:block;" @else  style="display:none;" @endif> <h5 class="text-c-blue"><i class="fa fa-cart-plus m-r-5 text-c-blue" style="font-size:28px"></i>  Contas a Receber</h5></div>
                                <div id="titulo_paga" @if($registro->tipo == 'credito') style="display:none;" @else  style="display:block;" @endif><h5 class="text-c-red"><i class="fa fa-cart-plus m-r-5 text-c-red" style="font-size:28px"></i>  Contas a Pagar</h5></div>


                                <div class="float-right" style="background-color:white; padding-left:10px;">
                                    Parcela {{$registro->numero_parcela}} de {{$registro->parcelas}}
                                </div>



                                <hr>


                                <div class="row">

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>ID</label>
                                            <input type="text" class="form-control form-control-sm" name="id" disabled value="{{$registro->id}}">
                                        </div>
                                    </div>

                                    <div class="col-md-7">
                                        <div class="form-group">
                                            <label>Descrição</label>
                                            <input type="text" class="form-control form-control-sm" name="resumo"   value="{{$registro->resumo}}"  @if($registro->resumo == 'Antecipação de Vendas') readonly @endif>
                                        </div>
                                    </div>


                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Valor Original</label>
                                            <input id="valor_original" type="number" step="0.01" class="form-control form-control-sm" name="valor_original"   value="{{$registro->valor_original}}">
                                        </div>

                                    </div>


                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Cliente</label>
                                            <select class="form-control form-control-sm js-select" name="cliente_id" id="cliente_id">
                                                @if(isset($registro->Cliente->nome))
                                                    <option value="{{$registro->cliente_id}}"  selected="selected">{{$registro->Cliente->nome}}</option>
                                                @endif
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Plano de Contas</label>
                                            <select  class="form-control form-control-sm" name="categoria_id" >
                                                @foreach($registro->TodasCategorias() as $categoria)
                                                    <option value="{{$categoria->id}}" @if($categoria->id == $registro->categoria_id) selected @endif>{{$categoria->categoria}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Data Vencimento</label>
                                            <input type="date" class="form-control form-control-sm" name="data_vencimento"    value="{{$registro->data_vencimento}}" >
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Setor</label>
                                            <select  class="form-control form-control-sm" name="setor_id" >
                                                <option value=""></option>
                                                @foreach(\App\Models\Setores\Setor::all() as $setor)
                                                    <option value="{{$setor->id}}" @if($setor->id == $registro->setor_id) selected @endif>{{$setor->nome}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Data Emissão</label>
                                            <input type="date" class="form-control form-control-sm" name="data_emissao"    value="{{$registro->data_emissao}}" >
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Numero Documento/Venda</label>
                                            <input type="text" class="form-control form-control-sm" name="documento"   value="{{$registro->documento}}" @if($registro->resumo == 'Antecipação de Vendas') readonly @endif>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Observações</label>
                                            <textarea  class="form-control form-control-sm" name="descricao" rows="2">{{$registro->observacao}}</textarea>
                                        </div>
                                    </div>







                                </div>




                            </div>
                            <div class="tab-pane" id="kt_portlet_base_demo_1_2_tab_content" role="tabpanel">

                                Outras Parcelas

                            </div>
                            <div class="tab-pane @if(Session::get('status') == 'Animal Incluido') active @endif" id="kt_portlet_base_demo_1_3_tab_content" role="tabpanel">






                            </div>

                        </div>
                    </div>

                    <div class="kt-portlet__body" style="margin-top:15px">


                        <div class="tab-content">
                            <div class="tab-pane @if(Session::get('status') != 'Animal Incluido') active @endif" id="kt_portlet_base_demo_1_1_tab_content" role="tabpanel">


                                <h5 class="text-c-grey"><i class="fa fa-dollar-sign m-r-5 text-c-grey" style="font-size:28px"></i>  Parcelas</h5>



                                <div class="row table-responsive" style="padding:0px 20px">



                                    <table class="table table-hover  table-list" id="myTable2">
                                    <thead>
                                        <tr>
                                            <th style="padding:5px">Parcela</th>
                                            <th style="padding:5px">Vencimento</th>
                                            <th style="padding:5px">Valor Documento</th>
                                            <th style="padding:5px">Valor Parcela</th>
                                            <th style="padding:5px">Data Pagamento/Recebimento</th>
                                            <th style="padding:5px">Valor Liquído</th>
                                            <th style="padding:5px">Status</th>
                                            <th style="padding:5px">Opções</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                          @foreach($parcelas as $parcela)

                                            <tr>

                                                  <td>{{$parcela->numero_parcela}}</td>
                                                  <td>{{date('d/m/y',strtotime($parcela->data_vencimento))}}</td>
                                                <td>{{$parcela->valor_documento}}</td>
                                                <td>{{$parcela->valor_original}}</td>
                                                  <td>{{

                                                ($parcela->data_pagamento) ? date('d/m/y',strtotime($parcela->data_pagamento)) : ''


                                                }}


                                                </td>
                                                <td>{{$parcela->valor_pago}}</td>
                                                <td><a href="{{route('receber.edit', $parcela->id)}}">{{$parcela->status}} </a></td>
                                                  <td>
                                                      @if($parcela->status != 'Quitado')
                                                      <a class="text-white label theme-bg" href="{{Route('receber.baixaRapida',[$parcela->id])}}">Baixa Rápida</a>
                                                      @endif
                                                  </td>

                                            </tr>

                                          @endforeach
                                    </tbody>
                                </table>


                                </div>




                            </div>

                        </div>
                    </div>


                </div>

                <div class="col-md-3">



                    <div class="accordion" id="accordionExample">
                        <div class="card" style="margin-bottom:10px">
                            <div class="card-header" style="padding:15px 25px" id="headingOne">
                                <h5 class="mb-0"><a href="#!" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" class="collapsed" style="color:grey;">Baixa Manual</a></h5>
                            </div>
                            <div id="collapseOne" class="card-body collapse show" aria-labelledby="headingOne" data-parent="#accordionExample" style="">
                                <div class="card-block">
                                    <div class="row">

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Conta</label>
                                                <select  class="form-control form-control-sm" name="conta_id">

                                                    @foreach(\App\Models\Contas\Conta::all() as $conta)
                                                        <option value="{{$conta->id}}" @if($conta->id == $registro->conta_id) selected @endif>{{$conta->nome}} - {{$conta->conta}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Data Pagamento/Recebimento</label>
                                                <input type="date"  class="form-control form-control-sm" name="data_pagamento" id="data_pagamento"   value="{{($registro->data_pagamento) ? $registro->data_pagamento : ''}}">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Forma Pagamento/Recebimento</label>
                                                <select  class="form-control form-control-sm" name="forma_pagamento">

                                                    @foreach(\App\Models\Forma_Pagamentos\Forma_Pagamento::all() as $forma)
                                                        <option value="{{$forma->nome}}" @if($registro->forma_pagamento == $forma->nome) selected @endif>{{$forma->nome}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Descontos/Taxas</label>
                                                <input type="number" step="0.01" class="form-control form-control-sm" name="valor_desconto"   value="{{$registro->valor_desconto}}">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Juros</label>
                                                <input type="number" step="0.01" class="form-control form-control-sm" name="valor_juros"   value="{{$registro->valor_juros}}">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Multas</label>
                                                <input type="number" step="0.01" class="form-control form-control-sm" name="valor_multa"   value="{{$registro->valor_multa}}">
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Valor Liquido</label>
                                                <input id="valor_pago" type="number" step="0.01" class="form-control form-control-sm" name="valor_pago"   value="{{$registro->valor_pago}}" >
                                            </div>
                                        </div>

                                        @if($registro->status != 'Quitado')

                                        <div class="col-md-12">
                                            <div class="form-group">

                                                <button class="btn btn-primary btn-block" onclick="event.preventDefault();valida()"  >Baixar</button>
                                            </div>
                                        </div>

                                        @endif

                                    </div>
                                </div>

                            </div>
                        </div>


                    </div>



                    <input type="hidden" name="status" value="{{$registro->status}}" id="status">



                </div>

            </div>



        </div>

    </form>




    <div id="modal_baixa" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLiveLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLiveLabel">Divergência de Valores</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <p>O valor de pagamento está diferente do valor do título. Confirma a Baixa?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-danger" onclick="baixa()">Confirmar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModal9" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fa fa-edit"></i> Excluir Conta?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                @csrf


                <div class="modal-body">

                    <div class="row">

                        <div class="col-md-12">

                            <form id="form_excluir_receber" method="POST" action="{{route('receber.delete')}}">
                                @csrf
                                <h3 class="text-danger" style="text-align: center"><i class="fa fa-trash"></i><br>  Esta ação irá excluir todas as parcelas <u><i>EM ABERTO</i></u> vinculadas a esta conta. Você confirma esta operação?</h3>
                                <input type="hidden" name="registro_id" id="registro_id">
                            </form>







                        </div>

                    </div>

                </div>
                <div class="modal-footer">

                    <input  type="submit" form="form_excluir_receber" class="btn btn-danger" value="Confirmar">
                    {{--<button type="submit" class="btn btn-primary">Confirmar</button>--}}
                </div>



            </div>
        </div>
    </div>




@endsection


@section('posScript')



    <script>

        function excluir_receber(id){

        document.getElementById('registro_id').value = id

        $("#exampleModal9").modal();

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


        function debito() {

            document.getElementById('titulo_paga').style.display = 'block';
            document.getElementById('titulo_recebe').style.display = 'none';

        }

        function credito() {

            document.getElementById('titulo_paga').style.display = 'none';
            document.getElementById('titulo_recebe').style.display = 'block';

        }

        function valida() {

            var pago = document.getElementById('valor_pago').value;
            var original = document.getElementById('valor_original').value;
            var data_pag = document.getElementById('data_pagamento').value;


            if(data_pag == ''){
                alert('É necessário informar a data de pagamento para realizar a Baixa!')
            }else{

                if(pago != original){

                $('#modal_baixa').modal('show');
                }else{
                baixa();
                }

            }



        }


        function baixa(){

            $('#status').val('Quitado');
            $('#form1').submit();
        }


    </script>

@endsection
