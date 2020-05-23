@extends('layouts.template')

@section('content')

    @if (session('status'))

    @endif

    <form action="{{route('clientes.store')}}" method="post" name="form1">

        @csrf
        <input type="hidden" id="origem" name="origem" value="">


        <div class="kt-portlet kt-portlet--tabs">

            <div class="row">

                <div class="col-md-12">
                    <div class="card loction-user">
                        <div class="card-block p-0">
                            <div class="row align-items-center justify-content-center">
                                <div class="col-auto">
                                    <img class="img-fluid rounded-circle" style="width:40px;" src="{{url('dattaable/assets/images/user/avatar-4.jpg')}}" alt="dashboard-user">
                                </div>
                                <div class="col">
                                    <h5>Nome</h5>
                                    <span>Categoria Principal</span>
                                </div>
                                <div class="col text-right">
                                    <a href="{{route('clientes.index')}}"> <button type="button" class="btn btn-sm btn-default btn-shadow-1 btn-rounded"><i class="feather icon-arrow-left"></i>Voltar</button></a>

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

                            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist" style="margin-bottom: 0px !important;">
                                <li class="nav-item">
                                    <a class="nav-link active show" id="pills-home-tab" data-toggle="pill" href="#kt_portlet_base_demo_1_1_tab_content" role="tab" aria-controls="pills-home" aria-selected="true">Geral</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link show" id="pills-profile-tab" data-toggle="pill" href="#kt_portlet_base_demo_1_2_tab_content" role="tab" aria-controls="pills-profile" aria-selected="false">Categorias</a>
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

                            <div class="col-md-8">
                                <div class="form-group">
                                    <label>Nome</label>
                                    <input type="text" class="form-control form-control-sm" name="nome"  >
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="text-danger">Tipo</label>
                                <select  class="form-control form-control-sm" name="tipo" id="tipo" v-model="tipo" >
                                        <option value="Fisica">Física</option>
                                        <option value="Juridica">Jurídica</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="text-danger">CPF/CNPJ</label>
                                    <input type="text" class="form-control form-control-sm" name="cpf_cnpj" id="cpf" onblur="valida_cpf()" required>
                                </div>
                            </div>


                            <div class="col-md-3" v-show="tipo == 'Fisica'">
                                <div class="form-group">
                                    <label>Nascimento</label>
                                    <input type="date" class="form-control form-control-sm" name="nascimento"  >
                                </div>
                            </div>


                            <div class="col-md-2" v-show="tipo == 'Fisica'">
                                <div class="form-group">
                                    <label>RG</label>
                                    <input type="text" class="form-control form-control-sm" name="rg"  >
                                </div>
                            </div>

                            <div class="col-md-2" v-show="tipo == 'Fisica'">
                                <div class="form-group">
                                    <label>Emissor</label>
                                    <input type="text" class="form-control form-control-sm" name="emissor"  >
                                </div>
                            </div>


                            <div class="col-md-2" v-show="tipo == 'Fisica'">
                                <label>Sexo</label><br>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="customRadioInline2" name="sexo" class="custom-control-input" value="M">
                                    <label class="custom-control-label" for="customRadioInline2">Masculino</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="customRadioInline1" name="sexo" class="custom-control-input" value="F">
                                    <label class="custom-control-label" for="customRadioInline1">Feminino</label>
                                </div>

                            </div>







                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Telefone</label>
                                    <input type="text" class="form-control form-control-sm telefone" name="telefone"  >
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Celular</label>
                                    <input type="text" class="form-control form-control-sm telefone" name="celular"  >
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" class="form-control form-control-sm" name="email"  >
                                </div>
                            </div>

                            <div class="col-md-3" v-show="tipo == 'Fisica'">
                                <div class="form-group">
                                    <label>Profissão</label>
                                    <input type="text" class="form-control form-control-sm" name="profissao"  >
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
                                        <input type="text" class="form-control" id="cep" name="cep" onblur="pesquisar_cep()">
                                        <div class="input-group-append"><span class="input-group-text" id="basic-addon2"><i class="fa fa-search"></i></span></div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-10">
                                <div class="form-group">
                                    <label>Endereço</label>
                                    <input type="text" class="form-control form-control-sm" name="endereco" id="endereco">
                                </div>
                            </div>

                            <div class="col-md-1">
                                <div class="form-group">
                                    <label>Número</label>
                                    <input type="text" class="form-control form-control-sm" name="numero"  id="numero">
                                </div>
                            </div>

                            <div class="col-md-5">
                                <div class="form-group">
                                    <label>Complemento</label>
                                    <input type="text" class="form-control form-control-sm" name="complemento"  id="complemento">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Bairro</label>
                                    <input type="text" class="form-control form-control-sm" name="bairro"  id="bairro">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Cidade</label>
                                    <input type="text" class="form-control form-control-sm" name="cidade" id="cidade">
                                </div>
                            </div>

                            <div class="col-md-1">
                                <div class="form-group">
                                    <label>Estado</label>
                                    <input type="text" class="form-control form-control-sm" name="estado" id="estado">
                                </div>
                            </div>

                        </div>


                    </div>
                    <div class="tab-pane" id="kt_portlet_base_demo_1_2_tab_content" role="tabpanel">

                        <div class="card code-table" style="margin: -25px;">
                            <div class="card-header">
                                <h5>Categorias</h5>
                                <div class="card-header-right">

                                    <button type="button" class="btn btn-primary btn-sm btn-rounded" onclick="addRow();">+ Nova</button>


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

                                            <th>Categoria</th>


                                            <th>Opções</th>

                                        </tr></thead>
                                        <tbody>

                                        {{--<select class="form-control form-control-sm" name="categoria_id">
                                            @foreach($instace->TodasCategorias() as $categoria)
                                                <option value="{{$categoria->id}}">{{$categoria->categoria}}</option>
                                            @endforeach
                                        </select>--}}


                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>

        <input type="hidden" name="clifor" value="clientes">

    </form>

    <script type="text/javascript">
        var count = 0;


        function addRow() {
            $('table#myTable').dataTable().fnAddData( [

                '<select class="form-control form-control-sm" name="categoria_id[' + count +']">@foreach($instace->TodasCategorias() as $categoria)<option value="{{$categoria->id}}">{{$categoria->categoria}}</option>@endforeach</select>',
                '<button type="button" class="btn btn-danger btn-sm btn-rounded" onclick="deleteRow(this.parentNode.parentNode.rowIndex);">- Excluir</button>' ] );

            count++;
        }

        function deleteRow (linha) {



            if (count != 0) {
                $("table#myTable").dataTable().fnDeleteRow(linha - 1);

                count--;
            }
        }

        function cpf(cpf){
            cpf = cpf.replace(/\D/g, '');
            if(cpf.toString().length != 11 || /^(\d)\1{10}$/.test(cpf)) return false;
            var result = true;
            [9,10].forEach(function(j){
                var soma = 0, r;
                cpf.split(/(?=)/).splice(0,j).forEach(function(e, i){
                    soma += parseInt(e) * ((j+2)-(i+1));
                });
                r = soma % 11;
                r = (r <2)?0:11-r;
                if(r != cpf.substring(j, j+1)) result = false;
            });
            return result;
        }


        function valida(cpf){

            var cpf = cpf;


            var _token = $('input[name="_token"]').val();

            $.ajax({
                url: '{{url('cliente/validar')}}',
                method:"GET",
                data:{cpf:cpf, _token:_token},
                success:function(result)
                {


                    if(result.id){

                        var direciona = alert('Este CPF já está cadastrado no sistema, Cliente:' + result.nome +' Você será direcionado para a tela de edição do cliente.');


                            var local = "{{route('clientes.index')}}" + '/' + result.id + '/edit'

                            window.location.href = local




                    }


                },
                error:function() {
                    console.log('pode cadastrar');

                }

            });




        }


        function valida_cpf(){



            var vcpf = document.getElementById('cpf').value;
            var tipo = document.getElementById('tipo').value;



            if(tipo == 'Fisica'){
                if(!cpf(vcpf)){
                    alert('Este CPF não é Válido!');
                }else{

                    valida(vcpf);
                }

            }




        }


    </script>

@endsection

