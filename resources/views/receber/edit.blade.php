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
                            <li class="nav-item f-text active">
                                <a class="nav-link text-secondary" href="#" onclick="document.getElementById('form1').submit()"><i class="fa fa-check"></i> Salvar <span class="sr-only">(current)</span></a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link text-secondary" href="{{route('receber.index')}}" ><i class="fa fa-angle-left"></i> Voltar</a>

                            </li>

                            <li class="nav-item dropdown">
                                <a class="nav-link text-secondary" href="#"  onclick="document.getElementById('form1').reset()"><i class="fa fa-ban"></i> Cancelar</a>

                            </li>

                            <li class="nav-item dropdown">
                                <a class="nav-link text-secondary" href="{{route('receber.create')}}"><i class="fa fa-plus"></i> Novo</a>

                            </li>

                        </ul>
                        <div class="nav-item nav-grid f-view">
                            <ul class="nav">
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle text-secondary" href="#" id="bydate" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Opções</a>
                                    <div class="dropdown-menu" aria-labelledby="bydate">
                                        <a class="dropdown-item" href="#">Show all</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#">Today</a>
                                        <a class="dropdown-item" href="#">Yesterday</a>
                                        <a class="dropdown-item" href="#">This week</a>
                                        <a class="dropdown-item" href="#">This month</a>
                                        <a class="dropdown-item" href="#">This year</a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </nav>

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
                                            <select  class="form-control form-control-sm" name="tipo" >
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
                                                    <option value="{{$setor->id}}">{{$setor->nome}}</option>
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
                                            <label>Numero Documento</label>
                                            <input type="text" class="form-control form-control-sm" name="documento"   value="{{$registro->documento}}">
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Observações</label>
                                            <textarea  class="form-control form-control-sm" name="descricao" rows="2">{{$registro->documento}}</textarea>
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


                                <h5 class="text-c-blue"><i class="fa fa-dollar-sign m-r-5 text-c-blue" style="font-size:28px"></i>  Parcelas</h5>



                                <div class="row table-responsive" style="padding:0px 20px">



                                    <table class="table table-hover  table-list" id="myTable2">
                                    <thead>
                                        <tr>
                                            <th style="padding:5px">Parcela</th>
                                            <th style="padding:5px">Vencimento</th>
                                            <th style="padding:5px">Valor Parcela</th>
                                            <th style="padding:5px">Valor Documento</th>
                                            <th style="padding:5px">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                          @foreach($parcelas as $parcela)

                                            <tr>

                                                  <td>{{$parcela->numero_parcela}}</td>
                                                  <td>{{date('d/m/y',strtotime($parcela->data_vencimento))}}</td>
                                                  <td>{{$parcela->valor_original}}</td>
                                                  <td>{{$parcela->valor_documento}}</td>
                                                  <td><a href="{{route('receber.edit', $parcela->id)}}">{{$parcela->status}} </a></td>

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
                                <h5 class="mb-0"><a href="#!" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" class="collapsed">Pagamento</a></h5>
                            </div>
                            <div id="collapseOne" class="card-body collapse show" aria-labelledby="headingOne" data-parent="#accordionExample" style="">
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
                                                <label>Valor Pagamento</label>
                                                <input type="number" step="0.01" class="form-control form-control-sm" name="valor_pago"   value="{{$registro->valor_pago}}">
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
