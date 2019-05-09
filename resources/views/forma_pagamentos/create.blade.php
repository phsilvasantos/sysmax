@extends('layouts.template')

@section('content')

    @if (session('status'))

    @endif

    <form action="{{route('forma_pagamentos.store')}}" method="post" name="form1">

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
                                    <h5>Forma de Pagamento</h5>
                                    <span>Tipo</span>
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
                                    <label>Nome</label>
                                    <input type="text" class="form-control form-control-sm" name="nome"  required>
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Bandeira</label>
                                    <select  class="form-control form-control-sm" name="tBand" id="tBand">

                                        <option value="01" >Visa</option>
                                        <option value="02" >Master</option>
                                        <option value="03" >American Express</option>
                                        <option value="04" >Sorocred</option>
                                        <option value="99" >Outros </option>

                                    </select>
                                </div>
                            </div>



                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Forma Pagamento</label>
                                    <select  class="form-control form-control-sm" name="tPag" id="tPag">

                                        <option value="01" >Dinheiro</option>
                                        <option value="02" >Cheque</option>
                                        <option value="03" >Cartão de Crédito</option>
                                        <option value="04" >Cartão de Débito</option>
                                        <option value="05" >Crédito Loja</option>
                                        <option value="10" >Vale Alimentação</option>
                                        <option value="11" >Vale Refeição</option>
                                        <option value="12" >Vale Presente</option>
                                        <option value="13" >Vale Combustível</option>
                                        <option value="99" >Outros </option>

                                    </select>
                                </div>
                            </div>





                        </div>


                    </div>

                </div>
            </div>
        </div>

    </form>



@endsection
