@extends('layouts.template')

@section('content')

    @if (session('status'))

    @endif

    <form action="{{route('forma_pagamentos.update', $registro->id)}}" method="post" name="form1">

        @csrf
        <input type="hidden" name="_method" value="put">
        <input type="hidden" id="origem" name="origem" value="">

    <div class="kt-portlet kt-portlet--tabs">

        <div class="row">

        <div class="col-md-12">
            <div class="card loction-user">
                <div class="card-block p-0">
                    <div class="row align-items-center justify-content-center">
                        <div class="col-auto">
                            <div><i class="fas fa-list m-r-5" style="font-size:38px"></i></div>
                        </div>
                        <div class="col">
                            <h5>{{$registro->nome}}</h5>
                            <span>{{$registro->nome}}</span>
                        </div>
                        <div class="col text-right">
                            <a href="{{route('forma_pagamentos.index')}}"> <button type="button" class="btn btn-sm btn-default btn-shadow-1 btn-rounded"><i class="feather icon-arrow-left"></i>Voltar</button></a>


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


                </div>
            </div>
        </div>

        </div>


        <div class="kt-portlet__body" style="margin-top: -20px;">
            <div class="tab-content">
                <div class="tab-pane active" id="kt_portlet_base_demo_1_1_tab_content" role="tabpanel">
                    <h5>Dados Gerais</h5>
                    <hr>

                    <div class="row">

                        <div class="col-md-1">
                            <div class="form-group">
                                <label>ID</label>
                                <input type="text" class="form-control form-control-sm" name="id" disabled value="{{$registro->id}}">
                            </div>
                        </div>

                        <div class="col-md-11">
                            <div class="form-group">
                                <label>Nome</label>
                                <input type="text" class="form-control form-control-sm" name="nome"  value="{{$registro->nome}}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Bandeira</label>
                                <select  class="form-control form-control-sm" name="tBand" id="tBand">

                                    <option value="01" @if($registro->tBand == '01') selected  @endif>Visa</option>
                                    <option value="02" @if($registro->tBand == '02') selected  @endif>Master</option>
                                    <option value="03" @if($registro->tBand == '03') selected  @endif>American Express</option>
                                    <option value="04" @if($registro->tBand == '04') selected  @endif>Sorocred</option>
                                    <option value="99" @if($registro->tBand == '99') selected  @endif>Outros </option>

                                </select>
                            </div>
                        </div>



                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Forma Pagamento</label>
                                <select  class="form-control form-control-sm" name="tPag" id="tPag">

                                    <option value="01" @if($registro->tPag == '01') selected  @endif>Dinheiro</option>
                                    <option value="02" @if($registro->tPag == '02') selected  @endif>Cheque</option>
                                    <option value="03" @if($registro->tPag == '03') selected  @endif>Cartão de Crédito</option>
                                    <option value="04" @if($registro->tPag == '04') selected  @endif>Cartão de Débito</option>
                                    <option value="05" @if($registro->tPag == '05') selected  @endif>Crédito Loja</option>
                                    <option value="10" @if($registro->tPag == '10') selected  @endif>Vale Alimentação</option>
                                    <option value="11" @if($registro->tPag == '11') selected  @endif>Vale Refeição</option>
                                    <option value="12" @if($registro->tPag == '12') selected  @endif>Vale Presente</option>
                                    <option value="13" @if($registro->tPag == '13') selected  @endif>Vale Combustível</option>
                                    <option value="99" @if($registro->tPag == '99') selected  @endif>Outros </option>

                                </select>
                            </div>
                        </div>



                    </div>



                </div>

            </div>
        </div>
    </div>

    </form>


    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirma Desativação</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Confirma a Desativação Deste Empresa?</p>
                </div>
                <div class="modal-footer">
                    <a href="{{route('forma_pagamentos.destroy', $registro->id)}}" class="btn btn-danger" onclick="event.preventDefault();
                                                     document.getElementById('delete-form').submit();">Desativar</a>

                    <form id="delete-form" action="{{ route('forma_pagamentos.destroy', $registro->id) }}" method="POST" style="display: none;">
                        @csrf
                        <input type="hidden" name="_method" value="DELETE">
                    </form>



                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Voltar</button>
                </div>
            </div>
        </div>
    </div>



@endsection
