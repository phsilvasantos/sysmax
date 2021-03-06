@extends('layouts.template')

@section('content')

    @if (session('status'))

    @endif

    <form action="{{route('movimentos.store')}}" method="post" name="form1">

        @csrf
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
                                    <h5>Conta</h5>
                                    <select class="form-control form-control-sm" name="conta_id">
                                        @foreach(\App\Models\Contas\Conta::all() as $conta)
                                            <option value="{{$conta->id}}"> {{$conta->nome}} - {{$conta->conta}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col text-right">
                                    <a href="{{route('movimentos.index')}}"> <button type="button" class="btn btn-sm btn-default btn-shadow-1 btn-rounded"><i class="feather icon-arrow-left"></i>Voltar</button></a>


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


            <div class="kt-portlet__body"  style="margin-top: -20px;">
                <div class="tab-content">
                    <div class="tab-pane active" id="kt_portlet_base_demo_1_1_tab_content" role="tabpanel">
                        <h5>Dados Gerais</h5>
                        <hr>

                        <div class="row">

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Data</label>
                                    <input type="date" class="form-control form-control-sm" name="data"  >
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Historico</label>
                                    <input type="text" class="form-control form-control-sm" name="historico"  required>
                                </div>
                            </div>


                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Documento</label>
                                    <input type="text" class="form-control form-control-sm" name="documento"  required>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Valor</label>
                                    <input type="text" class="form-control form-control-sm" name="valor"  required>
                                </div>
                            </div>





                        </div>


                    </div>

                </div>
            </div>
        </div>

    </form>



@endsection
