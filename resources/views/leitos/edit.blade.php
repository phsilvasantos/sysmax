@extends('layouts.template')

@section('content')

    @if (session('status'))

    @endif

    <form action="{{route('leitos.update', $registro->id)}}" method="post" name="form1">

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
                            <span>{{$registro->setor->nome}}</span>
                        </div>
                        <div class="col text-right">
                            <a href="{{route('leitos.index')}}"> <button type="button" class="btn btn-sm btn-default btn-shadow-1 btn-rounded"><i class="feather icon-arrow-left"></i>Voltar</button></a>


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
                                <input type="text" class="form-control form-control-sm" name="id" disabled >
                            </div>
                        </div>

                        <div class="col-md-8">
                            <div class="form-group">
                                <label>Nome do Leito</label>
                                <input type="text" class="form-control form-control-sm" name="nome" value="{{$registro->nome}}"  required>
                            </div>
                        </div>


                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Setor</label>

                                <select  class="form-control form-control-sm" name="setor_id" >
                                    @foreach($setores as $setor)
                                        <option value="{{$setor->id}}" @if($registro->setor_id == $setor->id) selected  @endif>{{$setor->nome}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Porte</label>

                                <select  class="form-control form-control-sm" name="porte" required>
                                    <option value="Pequeno" @if($registro->porte == 'Pequeno') selected  @endif>Pequeno</option>
                                    <option value="Médio"  @if($registro->porte == 'Médio') selected  @endif>Médio</option>
                                    <option value="Grande"  @if($registro->porte == 'Grande') selected  @endif>Grande</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Vigência Inicial</label>
                                <input type="date" class="form-control form-control-sm" name="vigencia_inicial" value="{{$registro->vigencia_inicial}}"  required>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Vigência Final</label>
                                <input type="date" class="form-control form-control-sm" name="deleted_at" value="{{$registro->vigencia_final}}" >
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Status</label>

                                <select  class="form-control form-control-sm" name="status" required>
                                    <option value="Ativo"  @if($registro->status == 'Ativo') selected  @endif>Ativo</option>
                                    <option value="Em Manutenção"  @if($registro->status == 'Em Manutenção') selected  @endif>Em Manutenção</option>
                                    <option value="Desativado"  @if($registro->status == 'Desativado') selected  @endif>Desativado</option>

                                </select>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Descrição</label>
                                <textarea class="form-control" lin="5" name="descricao"></textarea>
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
                    <a href="{{route('leitos.destroy', $registro->id)}}" class="btn btn-danger" onclick="event.preventDefault();
                                                     document.getElementById('delete-form').submit();">Desativar</a>

                    <form id="delete-form" action="{{ route('leitos.destroy', $registro->id) }}" method="POST" style="display: none;">
                        @csrf
                        <input type="hidden" name="_method" value="DELETE">
                    </form>



                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Voltar</button>
                </div>
            </div>
        </div>
    </div>



@endsection
