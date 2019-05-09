@extends('layouts.template')

@section('content')

    @if (session('status'))

    @endif

    <form action="{{route('empresas.store')}}" method="post" name="form1">

        @csrf


        <div class="kt-portlet kt-portlet--tabs">

            <div class="row">

                <div class="col-md-12">
                    <div class="card loction-user">
                        <div class="card-block p-0">
                            <div class="row align-items-center justify-content-center">
                                <div class="col-auto">
                                    <img class="img-fluid rounded-circle" style="width:80px;" src="{{url('dattaable/assets/images/user/avatar-7.jpg')}}" alt="dashboard-user">
                                </div>
                                <div class="col">
                                    <h5>Nome da Empresa</h5>
                                    <span><i class="fas fa-map-marker-alt f-18 m-r-5"></i> Razão Social</span>
                                </div>
                                <div class="col text-right">
                                    <a href="{{route('empresas.index')}}"> <button type="button" class="btn btn-sm btn-default btn-shadow-1 btn-rounded"><i class="feather icon-arrow-left"></i>Voltar</button></a>
                                    <button type="submit" class="btn btn-sm btn-primary btn-shadow-1 btn-rounded"><i class="feather icon-thumbs-up"></i>Salvar</button>

                                </div>
                            </div>
                            <div class="border-top"></div>

                            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist" style="margin-bottom: 0px !important;">
                                <li class="nav-item">
                                    <a class="nav-link active show" id="pills-home-tab" data-toggle="pill" href="#kt_portlet_base_demo_1_1_tab_content" role="tab" aria-controls="pills-home" aria-selected="true">Geral</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link show" id="pills-profile-tab" data-toggle="pill" href="#kt_portlet_base_demo_1_2_tab_content" role="tab" aria-controls="pills-profile" aria-selected="false">NFCE</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link show" id="pills-contact-tab" data-toggle="pill" href="#kt_portlet_base_demo_1_3_tab_content" role="tab" aria-controls="pills-contact" aria-selected="false">Complemento</a>
                                </li>
                            </ul>

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

                            <div class="col-md-5">
                                <div class="form-group">
                                    <label>Nome Fantasia</label>
                                    <input type="text" class="form-control form-control-sm" name="nome_fantasia"  >
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Razão Social</label>
                                    <input type="text" class="form-control form-control-sm" name="razao_social"  >
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Sigla</label>
                                    <input type="text" class="form-control form-control-sm" name="sigla"  >
                                </div>
                            </div>

                            <div class="col-md-5">
                                <div class="form-group">
                                    <label>CNPJ</label>
                                    <input type="text" class="form-control form-control-sm" name="cnpj"  >
                                </div>
                            </div>

                            <div class="col-md-5">
                                <div class="form-group">
                                    <label>I.E</label>
                                    <input type="text" class="form-control form-control-sm" name="ie"  >
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Telefone</label>
                                    <input type="text" class="form-control form-control-sm" name="telefone"  >
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Site</label>
                                    <input type="text" class="form-control form-control-sm" name="site"  >
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" class="form-control form-control-sm" name="email"  >
                                </div>
                            </div>

                        </div>

                        <h5 style="margin-top: 20px;">Endereço</h5>
                        <hr>

                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>CEP</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="cep" >
                                        <div class="input-group-append"><span class="input-group-text" id="basic-addon2"><i class="fa fa-search"></i></span></div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-10">
                                <div class="form-group">
                                    <label>Endereço</label>
                                    <input type="text" class="form-control form-control-sm" name="endereco" >
                                </div>
                            </div>

                            <div class="col-md-1">
                                <div class="form-group">
                                    <label>Número</label>
                                    <input type="text" class="form-control form-control-sm" name="numero"  >
                                </div>
                            </div>

                            <div class="col-md-5">
                                <div class="form-group">
                                    <label>Complemento</label>
                                    <input type="text" class="form-control form-control-sm" name="complemento"  >
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Bairro</label>
                                    <input type="text" class="form-control form-control-sm" name="bairro"  >
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Cidade</label>
                                    <input type="text" class="form-control form-control-sm" name="cidade" >
                                </div>
                            </div>

                            <div class="col-md-1">
                                <div class="form-group">
                                    <label>Estado</label>
                                    <input type="text" class="form-control form-control-sm" name="estado" >
                                </div>
                            </div>

                        </div>


                    </div>
                    <div class="tab-pane" id="kt_portlet_base_demo_1_2_tab_content" role="tabpanel">
                        <h5>Dados para NFE e NFCE</h5>
                        <hr>

                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>CEP</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="cep" >
                                        <div class="input-group-append"><span class="input-group-text" id="basic-addon2"><i class="fa fa-search"></i></span></div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-10">
                                <div class="form-group">
                                    <label>Endereço</label>
                                    <input type="text" class="form-control form-control-sm" name="endereco" >
                                </div>
                            </div>

                            <div class="col-md-1">
                                <div class="form-group">
                                    <label>Número</label>
                                    <input type="text" class="form-control form-control-sm" name="numero"  >
                                </div>
                            </div>

                            <div class="col-md-5">
                                <div class="form-group">
                                    <label>Complemento</label>
                                    <input type="text" class="form-control form-control-sm" name="complemento"  >
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Bairro</label>
                                    <input type="text" class="form-control form-control-sm" name="bairro" >
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Cidade</label>
                                    <input type="text" class="form-control form-control-sm" name="cidade"  >
                                </div>
                            </div>

                            <div class="col-md-1">
                                <div class="form-group">
                                    <label>Estado</label>
                                    <input type="text" class="form-control form-control-sm" name="estado"  >
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="tab-pane" id="kt_portlet_base_demo_1_3_tab_content" role="tabpanel">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Observações</label>
                                    <input type="text" class="form-control form-control-sm" name="observacoes"  >
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Logo</label>
                                    <input type="text" class="form-control form-control-sm" name="logo"  >
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </form>

@endsection
