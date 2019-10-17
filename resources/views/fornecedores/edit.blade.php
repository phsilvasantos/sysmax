@extends('layouts.template')

@section('content')

    @if (session('status'))

    @endif

    <form action="{{route('fornecedores.update', $registro->id)}}" method="post" name="form1">

        @csrf
        <input type="hidden" id="_method" name="_method" value="PUT">
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
                                    <h5>{{ strtoupper($registro->nome)}}</h5>

                                </div>
                                <div class="col text-right">
                                    <a href="{{route('fornecedores.index')}}"> <button type="button" class="btn btn-sm btn-default btn-shadow-1 btn-rounded"><i class="feather icon-arrow-left"></i>Voltar</button></a>
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
                                    <a class="nav-link @if(Session::get('status') != 'Animal Incluido') active @endif  show" id="pills-home-tab" data-toggle="pill" href="#kt_portlet_base_demo_1_1_tab_content" role="tab" aria-controls="pills-home" aria-selected="true">Geral</a>
                                </li>


                            </ul>

                        </div>
                    </div>
                </div>

            </div>


            <div class="kt-portlet__body"  style="margin-top: -20px;">


                <div class="tab-content">
                    <div class="tab-pane @if(Session::get('status') != 'Animal Incluido') active @endif" id="kt_portlet_base_demo_1_1_tab_content" role="tabpanel">
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
                                    <label>Nome</label>
                                    <input type="text" class="form-control form-control-sm" name="nome"   value="{{$registro->nome}}">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Tipo</label>
                                    <select  class="form-control form-control-sm" name="tipo" onchange="ocultar(this.value)">
                                        <option value="Fisica"  @if($registro->tipo == 'Fisica') selected="" @endif>Física</option>
                                        <option value="Juridica"  @if($registro->tipo == 'Juridica') selected="" @endif>Jurídica</option>
                                    </select>
                                </div>
                            </div>


                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>CPF/CNPJ</label>
                                    <input type="text" class="form-control form-control-sm" name="cpf_cnpj"   value="{{$registro->cpf_cnpj}}"  required id="cpf" onblur="valida_cpf()">
                                </div>
                            </div>


                            <div class="col-md-6" id="gru_razao">
                                <div class="form-group">
                                    <label>Razão Social</label>
                                    <input type="text" class="form-control form-control-sm" name="razao_social"  required value="{{$registro->razao_social}}" >
                                </div>
                            </div>

                            <div class="col-md-3" id="gru_inscricao">
                                <div class="form-group">
                                    <label>Inscricao Estadual</label>
                                    <input type="text" class="form-control form-control-sm" name="inscricao_estadual"   required value="{{$registro->inscricao_estadual}}" >
                                </div>
                            </div>

                            <div class="col-md-3" id="gru_categoria">
                                <div class="form-group">
                                    <label>Categoria</label>
                                    <select  class="form-control form-control-sm" name="categoria" >
                                        @foreach(\App\Models\Categorias\Categoria::where('categoria_type','Fornecedores')->get() as $categoria)
                                            <option value="{{$categoria->categoria}}"   @if($registro->categoria == $categoria->categoria) selected="" @endif>{{$categoria->categoria}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-2"   id="gru_nascimento">
                                <div class="form-group">
                                    <label>Nascimento</label>
                                    <input type="date" class="form-control form-control-sm" name="nascimento"    value="{{$registro->nascimento}}" >
                                </div>
                            </div>





                            <div class="col-md-2"   id="gru_rg">
                                <div class="form-group">
                                    <label>RG</label>
                                    <input type="text" class="form-control form-control-sm" name="rg"    value="{{$registro->rg}}" >
                                </div>
                            </div>

                            <div class="col-md-2"   id="gru_emissor">
                                <div class="form-group">
                                    <label>Emissor</label>
                                    <input type="text" class="form-control form-control-sm" name="emissor"    value="{{$registro->emissor}}" >
                                </div>
                            </div>


                            <div class="col-md-3"   id="gru_sexo">
                                <label>Sexo</label><br>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="customRadioInline2" name="sexo" class="custom-control-input" value="M" @if($registro->sexo == 'M') checked="checked" @endif>
                                    <label class="custom-control-label" for="customRadioInline2">Masculino</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="customRadioInline1" name="sexo" class="custom-control-input" value="F" @if($registro->sexo == 'F') checked="checked" @endif>
                                    <label class="custom-control-label" for="customRadioInline1">Feminino</label>
                                </div>

                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Telefone</label>
                                    <input type="text" class="form-control form-control-sm telefone" name="telefone"    value="{{$registro->telefone}}" >
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Celular</label>
                                    <input type="text" class="form-control form-control-sm telefone" name="celular"   value="{{$registro->celular}}"  >
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" class="form-control form-control-sm" name="email"   value="{{$registro->email}}"  >
                                </div>
                            </div>

                            <div class="col-md-3"   id="gru_profissao">
                                <div class="form-group">
                                    <label>Profissão</label>
                                    <input type="text" class="form-control form-control-sm" name="profissao"   value="{{$registro->profissao}}"  >
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
                                        <input type="text" class="form-control" name="cep" id="cep"   value="{{$registro->cep}}" onblur="pesquisar_cep()">
                                        <div class="input-group-append"><span class="input-group-text" id="basic-addon2"><i class="fa fa-search"></i></span></div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-10">
                                <div class="form-group">
                                    <label>Endereço</label>
                                    <input type="text" class="form-control form-control-sm" name="endereco"   value="{{$registro->endereco}}" id="endereco">
                                </div>
                            </div>

                            <div class="col-md-1">
                                <div class="form-group">
                                    <label>Número</label>
                                    <input type="text" class="form-control form-control-sm" name="numero"    value="{{$registro->numero}}" id="numero">
                                </div>
                            </div>

                            <div class="col-md-5">
                                <div class="form-group">
                                    <label>Complemento</label>
                                    <input type="text" class="form-control form-control-sm" name="complemento"   value="{{$registro->complemento}}"  id="complemento">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Bairro</label>
                                    <input type="text" class="form-control form-control-sm" name="bairro"    value="{{$registro->bairro}}" id="bairro">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Cidade</label>
                                    <input type="text" class="form-control form-control-sm" name="cidade"   value="{{$registro->cidade}}" id="cidade">
                                </div>
                            </div>

                            <div class="col-md-1">
                                <div class="form-group">
                                    <label>Estado</label>
                                    <input type="text" class="form-control form-control-sm" name="estado"   value="{{$registro->estado}}" id="estado">
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

        function valida_cpf(){

            var vcpf = document.getElementById('cpf').value;

            if(!cpf(vcpf)){
                alert('Este CPF não é Válido!');
            }

        }


        function ocultar(tipo){

            if(tipo == 'Juridica'){

                $('#gru_sexo').hide();
                $('#gru_nascimento').hide();
                $('#gru_emissor').hide();
                $('#gru_profissao').hide();
                $('#gru_rg').hide();

                $('#gru_categoria').show();
                $('#gru_inscricao').show();
                $('#gru_razao').show();

            }else{

                $('#gru_sexo').show();
                $('#gru_nascimento').show();
                $('#gru_emissor').show();
                $('#gru_profissao').show();
                $('#gru_rg').show();

                $('#gru_categoria').hide();
                $('#gru_inscricao').hide();
                $('#gru_razao').hide();
            }


        }

        $(document).ready( function () {

            ocultar('{{$registro->tipo}}');
        });

    </script>

@endsection


