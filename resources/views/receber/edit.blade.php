@extends('layouts.template')

@section('content')

    @if (session('status'))

    @endif

    <form action="{{route('receber.update', $registro->id)}}" method="post" name="form1">

        @csrf
        <input type="hidden" id="_method" name="_method" value="PUT">
        <input type="hidden" id="origem" name="origem" value="">


        <div class="kt-portlet kt-portlet--tabs">

            <div class="row">

                <div class="col-md-9">

                    <div class="kt-portlet__body">


                        <div class="tab-content">
                            <div class="tab-pane @if(Session::get('status') != 'Animal Incluido') active @endif" id="kt_portlet_base_demo_1_1_tab_content" role="tabpanel">


                                <h5 class="text-c-blue"><i class="fa fa-cart-plus m-r-5 text-c-blue" style="font-size:28px"></i>  Contas a Receber</h5>

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
                                            <input type="text" class="form-control form-control-sm" name="resumo"   value="{{$registro->resumo}}">
                                        </div>
                                    </div>


                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Valor Original</label>
                                            <input type="number" step="0.01" class="form-control form-control-sm" name="valor_original"   value="{{$registro->valor_original}}">
                                        </div>

                                    </div>


                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Cliente</label>
                                            <select class="form-control form-control-sm js-select" name="cliente_id" id="cliente_id">
                                                <option value="{{$registro->cliente_id}}"  selected="selected">{{$registro->Cliente->nome}}</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Plano de Contas</label>
                                            <select  class="form-control form-control-sm" name="tipo" >
                                                @foreach($registro->TodasCategorias() as $categoria)
                                                    <option value="{{$categoria->id}}" @if($categoria->id == $registro->categoria_id) selected @endif>{{$categoria->categoria}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Data Vencimento</label>
                                            <input type="date" class="form-control form-control-sm" name="data_vencimento"    value="{{$registro->data_vencimento}}" >
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Data Emissão</label>
                                            <input type="date" class="form-control form-control-sm" name="data_emissao"    value="{{$registro->data_emissao}}" >
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Numero Documento</label>
                                            <input type="text" class="form-control form-control-sm" name="documento"   value="{{$registro->documento}}">
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Observações</label>
                                            <textarea  class="form-control form-control-sm" name="descricao" rows="5">{{$registro->documento}}</textarea>
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


                </div>

                <div class="col-md-3">


                    <div class="accordion" id="accordionExample">
                        <div class="card" style="margin-bottom:10px">
                            <div class="card-header" style="padding:15px 25px" id="headingOne">
                                <h5 class="mb-0"><a href="#!" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" class="collapsed">Opções</a></h5>
                            </div>
                            <div id="collapseOne" class="card-body collapse show" aria-labelledby="headingOne" data-parent="#accordionExample" style="">

                                <button type="button" class="btn btn-outline-primary btn-block"><i class="fa fa-check"></i>Salvar</button>
                                <a href="{{route('receber.index')}}"> <button type="button" class="btn btn-outline-secondary btn-block"><i class="fa fa-angle-left"></i>Voltar</button></a>
                                <button type="button" class="btn btn-outline-danger btn-block"><i class="fa fa-ban"></i>Cancelar</button>

                            </div>
                        </div>
                        <div class="card" style="margin-bottom:10px">
                            <div class="card-header" id="headingTwo"  style="padding:15px 25px">
                                <h5 class="mb-0"><a href="#!" class="collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">Parcelas</a></h5>
                            </div>
                            <div id="collapseTwo" class="card-body collapse" aria-labelledby="headingTwo" data-parent="#accordionExample" style="">



                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header" id="headingThree"  style="padding:15px 25px">
                                <h5 class="mb-0"><a href="#!" class="collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">Pagamentos</a></h5>
                            </div>
                            <div id="collapseThree" class="card-body collapse" aria-labelledby="headingThree" data-parent="#accordionExample" style="">

                                    <div class="card-block">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Data Pagamento</label>
                                                    <input type="date"  class="form-control form-control-sm" name="data_pagamento"   value="{{$registro->data_pagamento}}">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Descontos</label>
                                                    <input type="number" step="0.01" class="form-control form-control-sm" name="valor_original"   value="{{$registro->valor_desconto}}">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Juros</label>
                                                    <input type="number" step="0.01" class="form-control form-control-sm" name="valor_original"   value="{{$registro->valor_juros}}">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Multas</label>
                                                    <input type="number" step="0.01" class="form-control form-control-sm" name="valor_original"   value="{{$registro->valor_multa}}">
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Valor Pagamento</label>
                                                    <input type="number" step="0.01" class="form-control form-control-sm" name="valor_original"   value="{{$registro->valor_pago}}">
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group">

                                                    <button type="button" class="btn btn-primary btn-block" >Efetuar Pagamento</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                            </div>
                        </div>
                    </div>







                </div>

            </div>



        </div>

    </form>











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

    </script>

@endsection
