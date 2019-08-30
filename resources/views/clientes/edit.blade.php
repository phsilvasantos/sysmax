@extends('layouts.template')

@section('content')

    @if (session('status'))

    @endif

    <form action="{{route('clientes.update', $registro->id)}}" method="post" name="form1">

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
                                    <span>@if(count($registro->categorias)){{  $registro->categorias[0]->categoria }} @endif</span>
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
                                    <a class="nav-link @if(Session::get('status') != 'Animal Incluido') active @endif  show" id="pills-home-tab" data-toggle="pill" href="#kt_portlet_base_demo_1_1_tab_content" role="tab" aria-controls="pills-home" aria-selected="true">Geral</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link show" id="pills-profile-tab" data-toggle="pill" href="#kt_portlet_base_demo_1_2_tab_content" role="tab" aria-controls="pills-profile" aria-selected="false">Associação</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link @if(Session::get('status') == 'Animal Incluido') active @endif  show" id="pills-contact-tab" data-toggle="pill" href="#kt_portlet_base_demo_1_3_tab_content" role="tab" aria-controls="pills-contact" aria-selected="false"> Animais</a>
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
                                    <label>Nascimento</label>
                                    <input type="date" class="form-control form-control-sm" name="nascimento"    value="{{$registro->nascimento}}" >
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Tipo</label>
                                    <select  class="form-control form-control-sm" name="tipo" >
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

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>RG</label>
                                    <input type="text" class="form-control form-control-sm" name="rg"    value="{{$registro->rg}}" >
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Emissor</label>
                                    <input type="text" class="form-control form-control-sm" name="emissor"    value="{{$registro->emissor}}" >
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

                            <div class="col-md-3">
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
                    <div class="tab-pane" id="kt_portlet_base_demo_1_2_tab_content" role="tabpanel">

                        <div class="card code-table" style="margin: -25px;">
                            <div class="card-header">
                                <h5>Associação</h5>
                                <div class="card-header-right">

                                    <button type="button" class="btn btn-primary btn-sm btn-rounded" onclick="addRow();">+ Nova</button>



                                </div>
                            </div>
                            <div class="card-block pb-0">
                                <div class="table-responsive">
                                    <table class="table table-hover  table-list" id="myTable">
                                        <thead>
                                        <tr>

                                            <th>Categoria</th>


                                            <th>Inclusão</th>
                                            <th width="50">Opção</th>

                                        </tr></thead>
                                        <tbody>

                                        @foreach($registro->categorias as $categ)

                                            <tr>
                                                <td style="padding-left:10px;">  {{$categ->categoria}}</td>
                                                <td> {{ date('d/m/Y', strtotime($categ->pivot->created_at))}}</td>
                                                <td> <a href="{{route('cliente.ficha', $registro->id)}}" target="_blank"> <button type="button" class="btn btn-success btn-sm btn-rounded" onclick=""> Imprimir</button> </a>  <a href="" class="btn btn-danger btn-sm btn-rounded"  data-toggle="modal" data-target="#exampleModal" onclick="setar_categoria({{$categ->id}})"> Cancelar</a>  </td>

                                            </tr>
                                        @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="tab-pane @if(Session::get('status') == 'Animal Incluido') active @endif" id="kt_portlet_base_demo_1_3_tab_content" role="tabpanel">


                            @if(count($registro->animais))

                                <div style="text-align: right">

                                    <a href="" class="btn btn-primary btn-sm btn-rounded pull-right"  data-toggle="modal" data-target="#exampleModal2" onclick="reset_form()"> Novo Animal</a>

                                    <hr>
                                </div>

                                <div class="row">

                                @foreach($registro->animais  as $key => $animal)

                                <div class="col-xl-4 col-md-6">
                                    <div class="card @if($animal->status == 'Obito') card-border-c-red @endif">
                                        <div class="card-block p-0">
                                            <div class="text-center project-main">


                                                <i class="fa fa-paw" style="font-size:60px;"></i>
                                                <h5 class="mt-4">{{$animal->nome}}</h5>
                                                <span>{{$animal->nome}}</span><br><br>

                                                @if(isset($animal->Atendimentos[0]))

                                                    @if($animal->Atendimentos[0]->data_encerramento)

                                                    @else

                                                        <div class="alert alert-danger" role="alert">
                                                             @if($animal->Atendimentos[0]->tipo == 'Internacao')<H6> PET INTERNADO</H6> @else<H6> ATENDIMENTO EM ABERTO DESDE DE {{ date('d/m/Y', strtotime($animal->Atendimentos[0]->created_at))}} </H6>@endif
                                                        </div>



                                                    @endif


                                                @endif



                                                @if($animal->status == 'Obito')

                                                    <div class="alert alert-danger" role="alert">
                                                        <H6> ÓBITO </H6>
                                                    </div>


                                                @endif

                                                <div class="row m-t-30">
                                                    @if($animal->status != 'Obito')
                                                    <div class="col-6 p-r-0">


                                                        @if(isset($animal->Atendimentos[0]))

                                                            @if($animal->Atendimentos[0]->data_encerramento)

                                                            <a href="#!" class="btn  border btn-block btn-outline-secondary" onclick="incluir_fila({{$animal->id}})">Atendimento</a>

                                                            @else

                                                                <a href="#!" class="btn  border btn-block btn-outline-secondary" onclick="alert('Este pet está com um registro de atendimento em aberto! Acesse o Prontuário!')">Atendimento</a>

                                                            @endif

                                                        @else

                                                            <a href="#!" class="btn  border btn-block btn-outline-secondary" onclick="incluir_fila({{$animal->id}})">Atendimento</a>

                                                        @endif



                                                            @if(isset($animal->Atendimentos[0]))

                                                                @if($animal->Atendimentos[0]->data_encerramento)

                                                                    <a href="#!" class="btn  border btn-block btn-outline-secondary" onclick="internar({{$animal->id}})">Internar</a>

                                                                @else

                                                                    <a href="#!" class="btn  border btn-block btn-outline-secondary" onclick="alert('Este pet está com um registro de atendimento em aberto! Acesse o Prontuário!')">Internar</a>

                                                                @endif

                                                            @else


                                                                <a href="#!" class="btn  border btn-block btn-outline-secondary" onclick="internar({{$animal->id}})">Internar</a>

                                                            @endif

                                                    </div>
                                                    @endif
                                                    <div class="col-6">
                                                        @if(isset($animal->Atendimentos[0]))
                                                            <a href="{{route('atendimentos.edit', $animal->Atendimentos[0]->id)}}" class="btn  border btn-block btn-outline-secondary">Prontuário</a>
                                                        @else
                                                            <a href="#" class="btn  border btn-block btn-outline-secondary" onclick="alert('Não é possivel acessar o prontuário pois esse animal não possui nenhum atendimento registrado!')">Prontuário</a>
                                                        @endif

                                                            @if($animal->status != 'Obito')

                                                                <a href="#!" class="btn @if($animal->status != 'Obito') btn-primary @else btn-danger  @endif  btn-block" onclick="editar_animal({{$animal->id}})">Editar</a>

                                                            @endif

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="border-top"></div>
                                            <div class="project-main" style="padding: 0px">
                                                <div class="row text-center">
                                                    <div class="col-12">

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                @endforeach

                            @else

                                <div class="col-md-12">

                                    <div class="card text-center">
                                        <div class="card-body">
                                            <div><i class="fas fa-paw m-r-5" style="font-size:68px; padding:50px"></i></div>

                                            <h5 class="card-title">Cliente sem Animais Cadastrados</h5>
                                            <p class="card-text">Este cliente não possui nenhum animal cadastrado. Clique no botão abaixo para cadastrar.</p>
                                            <a href="" class="btn btn-primary btn-sm btn-rounded"  data-toggle="modal" data-target="#exampleModal2" onclick=""> Novo Animal</a>
                                        </div>
                                    </div>
                                </div>

                        </div>

                            @endif



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
                    <p>Ao confirmar este usuário não será mais associado a esta categoria. Voce confirma essa operação?</p>
                </div>
                <div class="modal-footer">
                    <a href="{{route('cliente.desassociar', $registro->id)}}" class="btn btn-danger" onclick="event.preventDefault();
                                                     document.getElementById('delete-form').submit();">Confirmar</a>

                    <form id="delete-form" action="{{ route('cliente.desassociar', $registro->id) }}" method="POST" style="display: none;">
                        @csrf

                        <input type="hidden" name="categoria_id" id="categoria_id" value="">
                        <input type="hidden" name="cliente_id" id="cliente_id" value="{{$registro->id}}">
                    </form>



                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Voltar</button>
                </div>
            </div>
        </div>
    </div>



    <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Cadastrar Animal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form id="animal-form" action="{{ route('animais.store') }}" method="post">

                    @csrf


                    <div class="modal-body">
                        @include('clientes.animais')
                    </div>
                    <div class="modal-footer">
                        <a href="{{route('animais.store')}}" class="btn btn-primary" onclick="event.preventDefault();
                                                         document.getElementById('animal-form').submit();">Salvar</a>



                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Voltar</button>
                    </div>

                </form>

            </div>
        </div>
    </div>


    <div class="modal fade" id="exampleModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Iniciar Atendimento</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form id="atendimento-form" action="{{ route('atendimentos.store') }}" method="post">

                    @csrf


                    <div class="modal-body">


                        <div class="form-group col-md-12">
                            <label for="nome" class="control-label">Selecione o Profissional:</label>

                            <select class="form-control form-control-sm" name="user_id" id="user_id">
                                @foreach(\App\User::all() as $user)
                                    @if($user->roles->contains('name', 'Veterinário'))
                                        <option value="{{$user->id}}">{{$user->name}}</option>
                                    @endif
                                @endforeach()
                            </select>
                        </div>

                        <div class="form-group col-md-12">
                            <label for="nome" class="control-label">Informe o Peso do Animal:</label>


                                <input type="text" name="peso" class="form-control">

                        </div>

                        <input type="hidden" name="animal_id" id="animal_id" value="">
                        <input type="hidden" name="data_recepcao" value="{{now()}}">
                        <input type="hidden" name="atendente_id" value="{{Auth::user()->id}}">


                    </div>
                    <div class="modal-footer">
                        <a href="{{route('atendimentos.store')}}" class="btn btn-primary" onclick="event.preventDefault();
                                                         document.getElementById('atendimento-form').submit();">Salvar</a>



                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Voltar</button>
                    </div>

                </form>

            </div>
        </div>
    </div>


    <div class="modal fade" id="exampleModal9" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Internar</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form id="internacao-form" action="{{ route('atendimento.internar') }}" method="post">

                    @csrf


                    <div class="modal-body">


                        <div class="form-group col-md-12">
                            <label for="nome" class="control-label">Selecione o Profissional:</label>

                            <select class="form-control form-control-sm" name="user_id" id="user_id" required>
                                @foreach(\App\User::all() as $user)
                                    @if($user->roles->contains('name', 'Veterinário'))
                                        <option value="{{$user->id}}">{{$user->name}}</option>
                                    @endif
                                @endforeach()
                            </select>
                        </div>

                        <div class="form-group col-md-12">
                            <label for="nome" class="control-label">Selecione o Leito:</label>


                            <select class="form-control form-control-sm" name="leito_id" id="leito_id" required>
                                @foreach(\App\Models\Leitos\Leito::all() as $leito)

                                        <option value="{{$leito->id}}">{{$leito->nome}}</option>

                                @endforeach()
                            </select>

                        </div>

                        <input type="hidden" name="atendimento_id"  value="{{$registro->id}}">
                        <input type="hidden" name="animal_id1" id="animal_id1" value="">
                        <input type="hidden" name="data_recepcao" value="{{now()}}">
                        <input type="hidden" name="tipo" value="Internacao">
                        <input type="hidden" name="status" value="Em Atendimento">
                        <input type="hidden" name="atendente_id" value="{{Auth::user()->id}}">


                    </div>
                    <div class="modal-footer">
                        <a href="{{route('atendimento.internar')}}" class="btn btn-primary" onclick="event.preventDefault();
                                                         document.getElementById('internacao-form').submit();">Salvar</a>



                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Voltar</button>
                    </div>

                </form>

            </div>
        </div>
    </div>




@endsection


@section('posScript')


    <script type="text/javascript">
        var count = 0;


        function addRow() {
            $('table#myTable').dataTable().fnAddData( [

                '<select class="form-control form-control-sm" name="categoria_id[' + count +']">@foreach($registro->TodasCategorias() as $categoria)<option value="{{$categoria->id}}">{{$categoria->categoria}}</option>@endforeach</select>',
                '',
                '<button type="button" class="btn btn-danger btn-sm btn-rounded" onclick="deleteRow(this.parentNode.parentNode.rowIndex);">- Excluir</button>' ] );

            count++;
        }

        function deleteRow (linha) {



            if (count != 0) {
                $("table#myTable").dataTable().fnDeleteRow(linha - 1);

                count--;
            }
        }

        function setar_categoria(id){

            document.getElementById('categoria_id').value = id;
        }

    </script>


    <script>
        function atualiza_raca(){


                if($('#especie').val() != '')
                {
                    var select = $('#especie').attr("id");
                    console.log(select);
                    var value = $('#especie').val();
                    console.log(value);
                    var dependent = $('#especie').data('dependent');
                    console.log(dependent);
                    var _token = $('input[name="_token"]').val();
                    console.log(_token);
                    $.ajax({
                        url:"{{ route('dynamicdependent.fetch') }}",
                        method:"POST",
                        data:{select:select, value:value, _token:_token, dependent:dependent},
                        success:function(result)
                        {

                            $('#'+dependent).html(result);
                        }

                    })
                }



            $('#especie').change(function(){
                $('#raca_id').val('');
            });


        };



        function editar_animal(id){

            var form = document.getElementById("animal-form");

            form.reset();

            form.action = '{{url('animais/')}}' + '/' + id ;


            document.getElementById('method').value = 'PUT';

            var cod = id;
            var _token = $('input[name="_token"]').val();



            $.ajax({
                url: '{{url('animais/')}}' + '/' + id + '/edit',
                method:"GET",
                data:{id:id, _token:_token},
                success:function(result)
                {

                    var obj = JSON.parse(result);

                    console.log(result);

                    $.each(obj, function(index, value) {

                        if(value != null & index != 'created_at' & index != 'updated_at') {


                            console.log(index, value);
                            document.getElementById(index).value = value;

                            if(index == 'raca_id'){
                                atualiza_raca();
                                setTimeout(function(){ document.getElementById(index).value = value; }, 1000);

                            }

                        }
                    });






                }

            });




            $("#exampleModal2").modal();




        };


        function reset_form(){

            var form = document.getElementById("animal-form");

            form.reset();

            form.action = '{{route('animais.store')}}' ;


            document.getElementById('method').value = 'POST';


        }


        function incluir_fila(animal_id){

            document.getElementById('animal_id').value = animal_id;

            $("#exampleModal3").modal();
        }


        function internar(animal_id){

            document.getElementById('animal_id1').value = animal_id;

            $("#exampleModal9").modal();
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

        function valida_cpf(){

            var vcpf = document.getElementById('cpf').value;

            if(!cpf(vcpf)){
                alert('Este CPF não é Válido!');
            }

        }


    </script>

@endsection
