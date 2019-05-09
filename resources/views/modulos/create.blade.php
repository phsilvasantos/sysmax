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
                                    <div><i class="fas fa-tasks m-r-5" style="font-size:38px"></i></div>
                                </div>
                                <div class="col">
                                    <h5>Nome do Módulo</h5>
                                    <span> Descrição</span>
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
                                    <a class="nav-link show" id="pills-profile-tab" data-toggle="pill" href="#kt_portlet_base_demo_1_2_tab_content" role="tab" aria-controls="pills-profile" aria-selected="false">Campos</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link show" id="pills-contact-tab" data-toggle="pill" href="#kt_portlet_base_demo_1_3_tab_content" role="tab" aria-controls="pills-contact" aria-selected="false">DataTable</a>
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

                            <div class="col-md-11">
                                <div class="form-group">
                                    <label>Nome</label>
                                    <input type="text" class="form-control form-control-sm" name="nome"  >
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Descrição</label>
                                    <input type="text" class="form-control form-control-sm" name="descricao"  >
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Model</label>
                                    <input type="text" class="form-control form-control-sm" name="Model"  >
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Table</label>
                                    <input type="text" class="form-control form-control-sm" name="table"  >
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Controller</label>
                                    <input type="text" class="form-control form-control-sm" name="controller"  >
                                </div>
                            </div>


                        </div>




                    </div>
                    <div class="tab-pane" id="kt_portlet_base_demo_1_2_tab_content" role="tabpanel">


                            <div class="card code-table" style="margin: -25px;">
                                <div class="card-header">
                                    <h5>Relação de Campos</h5>
                                    <div class="card-header-right">
                                        <div class="btn-group card-option">
                                            <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="feather icon-more-horizontal"></i>
                                            </button>
                                            <ul class="list-unstyled card-option dropdown-menu dropdown-menu-right">
                                                <li class="dropdown-item full-card"><a href="#!"><span><i class="feather icon-maximize"></i> maximize</span><span style="display:none"><i class="feather icon-minimize"></i> Restore</span></a></li>
                                                <li class="dropdown-item minimize-card"><a href="#!"><span><i class="feather icon-minus"></i> collapse</span><span style="display:none"><i class="feather icon-plus"></i> expand</span></a></li>
                                                <li class="dropdown-item reload-card"><a href="#!"><i class="feather icon-refresh-cw"></i> reload</a></li>
                                                <li class="dropdown-item close-card"><a href="#!"><i class="feather icon-trash"></i> remove</a></li>
                                            </ul>

                                        </div>
                                    </div>
                                </div>
                                <div class="card-block pb-0">
                                    <div class="table-responsive">
                                        <table class="table table-hover table-list">
                                            <thead>
                                            <tr>
                                                <th>Nome</th>
                                                <th>Label</th>
                                                <th>Tipo</th>
                                                <th>Tamanho</th>
                                                <th>Visivel</th>
                                                <th>Obriga</th>
                                                <th>Opções</th>
                                                <th>Validação</th>

                                            </tr></thead>
                                            <tbody>

                                            <tr>
                                                <td>
                                                    <input type="text" disabled="" class="form-control form-control-sm" name="name"  >
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control form-control-sm" name="label"  >
                                                </td>
                                                <td>
                                                    <select class="form-control form-control-sm" name="type">
                                                        <option value="text">Texto</option>
                                                        <option value="date">Data</option>
                                                        <option value="datetime">Data e Hora</option>
                                                        <option value="time">Hora</option>
                                                        <option value="number">Numero</option>
                                                        <option value="email">Email</option>
                                                        <option value="boolean">Booleano</option>
                                                        <option value="select">Select</option>
                                                        <option value="file">Arquivo</option>
                                                        <option value="image">Imagem</option>
                                                        <option value="real">Real(R$)</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <input type="number" class="form-control form-control-sm" name="tamanho" style="width:60px" value="6">
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <div class="switch switch-primary d-inline m-r-10">
                                                            <input type="checkbox" id="switch-p-1" checked="" name="visivel">
                                                            <label for="switch-p-1" class="cr"></label>
                                                        </div>
                                                        <label></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <div class="switch switch-primary d-inline m-r-10">
                                                            <input type="checkbox" id="switch-p-2" checked=""  name="obriga">
                                                            <label for="switch-p-2" class="cr"></label>
                                                        </div>
                                                        <label></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control form-control-sm" name="opcoes"  >
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control form-control-sm" name="validacao"  >
                                                </td>

                                            </tr>







                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>



                    </div>
                    <div class="tab-pane" id="kt_portlet_base_demo_1_3_tab_content" role="tabpanel">



                        <div class="card code-table" style="margin: -25px;">
                            <div class="card-header">
                                <h5>Relação de Campos</h5>
                                <div class="card-header-right">

                                    <button type="button" class="btn btn-primary btn-sm" onclick="addRow();">+</button>
                                    <button type="button" class="btn btn-danger btn-sm" onclick="deleteRow();">-</button>

                                    {{--<div class="btn-group card-option">
                                        <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="feather icon-more-horizontal"></i>
                                        </button>
                                        <ul class="list-unstyled card-option dropdown-menu dropdown-menu-right">
                                            <li class="dropdown-item full-card"><a href="#!"><span><i class="feather icon-maximize"></i> maximize</span><span style="display:none"><i class="feather icon-minimize"></i> Restore</span></a></li>
                                            <li class="dropdown-item minimize-card"><a href="#!"><span><i class="feather icon-minus"></i> collapse</span><span style="display:none"><i class="feather icon-plus"></i> expand</span></a></li>
                                            <li class="dropdown-item reload-card"><a href="#!"><i class="feather icon-refresh-cw"></i> reload</a></li>
                                            <li class="dropdown-item close-card"><a href="#!"><i class="feather icon-trash"></i> remove</a></li>
                                        </ul>

                                    </div>--}}
                                </div>
                            </div>
                            <div class="card-block pb-0">
                                <div class="table-responsive">
                                    <table class="table table-hover  table-list" id="myTable">
                                        <thead>
                                        <tr>
                                            <th>Nome</th>
                                            <th>Label</th>


                                            <th>Validação</th>

                                        </tr></thead>
                                        <tbody>




                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>



                    </div>
                </div>
            </div>
        </div>

    </form>


    <script type="text/javascript">
        var count = 0;


        function addRow() {
            $('table#myTable').dataTable().fnAddData( [
                '<input type="text" class="form-control form-control-sm" name="nome' + count + '">',
                '<input type="text" class="form-control form-control-sm" name="formato' + count + '">',
                '<input type="text" class="form-control form-control-sm" name="last_name_' + count + '">' ] );

            count++;
        }

        function deleteRow () {
            if (count != 1) {
                $("table#myTable").dataTable().fnDeleteRow(count - 1);

                count--;
            }
        }
    </script>

@endsection
