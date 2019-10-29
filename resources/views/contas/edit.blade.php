@extends('layouts.template')

@section('content')

    @if (session('status'))

    @endif

    <form action="{{route('contas.update', $registro->id)}}" method="post" name="form1">

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
                            <span>{{$registro->tipo}}</span>
                        </div>
                        <div class="col text-right">
                            <a href="{{route('contas.index')}}"> <button type="button" class="btn btn-sm btn-default btn-shadow-1 btn-rounded"><i class="feather icon-arrow-left"></i>Voltar</button></a>


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

                        <div class="col-md-8">
                            <div class="form-group">
                                <label>Nome da Conta</label>
                                <input type="text" class="form-control form-control-sm" name="nome"  required  value="{{$registro->nome}}">
                            </div>
                        </div>


                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Categoria</label>
                                <select  class="form-control form-control-sm" name="tipo" >
                                    <option value="corrente" @if($registro->tipo == 'corrente') selected @endif>Conta Corrente</option>
                                    <option value="aplicacao" @if($registro->tipo == 'aplicacao') selected @endif>Conta Aplicação</option>
                                    <option value="caixa" @if($registro->tipo == 'caixa') selected @endif>Conta Caixa</option>
                                    <option value="cartao" @if($registro->tipo == 'cartao') selected @endif>Cartão de Crédito</option>

                                </select>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Banco</label>
                                <input type="text" class="form-control form-control-sm" name="banco"  required   value="{{$registro->banco}}">
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Agência</label>
                                <input type="text" class="form-control form-control-sm" name="agencia"  required   value="{{$registro->agencia}}">
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Conta</label>
                                <input type="text" class="form-control form-control-sm" name="conta"  required   value="{{$registro->conta}}">
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Saldo Inicial</label>
                                <input type="text" class="form-control form-control-sm" name="saldo_inicial"  required   value="{{$registro->saldo_inicial}}">
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Data Saldo</label>
                                <input type="date" class="form-control form-control-sm" name="data_saldo"  required   value="{{$registro->data_saldo}}">
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Observações</label>
                                <textarea class="form-control" lin="5" name="descricao">  {{$registro->observacao}}</textarea>
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
                    <a href="{{route('contas.destroy', $registro->id)}}" class="btn btn-danger" onclick="event.preventDefault();
                                                     document.getElementById('delete-form').submit();">Desativar</a>

                    <form id="delete-form" action="{{ route('contas.destroy', $registro->id) }}" method="POST" style="display: none;">
                        @csrf
                        <input type="hidden" name="_method" value="DELETE">
                    </form>



                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Voltar</button>
                </div>
            </div>
        </div>
    </div>



@endsection
