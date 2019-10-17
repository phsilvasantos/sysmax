@extends('layouts.template')

@section('content')

    @if (session('status'))

    @endif

    <form action="{{route('categorias.store')}}" method="post" name="form1">

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
                                    <h5>Categoria</h5>
                                    <span>Tipo</span>
                                </div>
                                <div class="col text-right">
                                    <a href="{{route('categorias.index')}}"> <button type="button" class="btn btn-sm btn-default btn-shadow-1 btn-rounded"><i class="feather icon-arrow-left"></i>Voltar</button></a>


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

                            <div class="col-md-1">
                                <div class="form-group">
                                    <label>ID</label>
                                    <input type="text" class="form-control form-control-sm" name="id" disabled >
                                </div>
                            </div>

                            <div class="col-md-8">
                                <div class="form-group">
                                    <label>Nome da Categoria</label>
                                    <input type="text" class="form-control form-control-sm" name="categoria"  required>
                                </div>
                            </div>


                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Tipo</label>
                                    <select  class="form-control form-control-sm" name="categoria_type" >
                                        <option value="Produtos">Produtos</option>
                                        <option value="Clientes">Clientes</option>
                                        <option value="Fornecedores">Fornecedores</option>
                                        <option value="Receber">Contas a Receber</option>
                                        <option value="Pagar">Contas a Pagar</option>
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



@endsection
