@extends('layouts.template')

@section('content')


    <div class="row">
        <div class="col-md-12">

            <div class="row">

                <div class="col-md-3 col-sm-12">

                    <button type="button" class="btn btn-danger btn-block"><i class="feather icon-slash"></i>Finalizar Atendimento</button>

                    <br>


                    <ul class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">

                        <div class="text-center m-b-30" style="padding-top:20px">
                            <i class="fa fa-paw" style="font-size:60px;"></i>
                            <h5 class="mt-3">{{$registro->Animal->nome}}</h5>
                            <span class="d-block">{{$registro->Animal->Cliente->nome}}</span>
                        </div>



                        <li><a class="nav-link text-left @if(Session::get('status') != 'Evolução' and Session::get('status') != 'Receituário' and Session::get('status') != 'Vacina' and Session::get('status') != 'Ocorrência' and Session::get('status') != 'Anexo') active @endif " id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true"> Dados Cadastrais</a></li>
                        <li><a class="nav-link text-left @if(Session::get('status') == 'Evolução') active @endif "  id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">Evolução</a></li>
                        <li><a class="nav-link text-left @if(Session::get('status') == 'Receituário') active @endif " id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false">Receituario</a></li>
                        <li><a class="nav-link text-left @if(Session::get('status') == 'Vacina') active @endif " id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settings" role="tab" aria-controls="v-pills-settings" aria-selected="false">Vacinas</a></li>
                        <li><a class="nav-link text-left @if(Session::get('status') == 'Ocorrência') active @endif " id="v-pills-ocorrencia-tab" data-toggle="pill" href="#v-pills-ocorrencia" role="tab" aria-controls="v-pills-ocorrencia" aria-selected="false">Ocorrências</a></li>
                        <li><a class="nav-link text-left @if(Session::get('status') == 'Anexo') active @endif " id="v-pills-anexo-tab" data-toggle="pill" href="#v-pills-anexo" role="tab" aria-controls="v-pills-anexo" aria-selected="false">Anexos</a></li>
                        <li><a class="nav-link text-left " id="v-pills-historico-tab" data-toggle="pill" href="#v-pills-historico" role="tab" aria-controls="v-pills-historico" aria-selected="false">Historico</a></li>
                    </ul>
                </div>
                <div class="col-md-9 col-sm-12">

                    <div class="card-block text-right">
                        <button type="button" class="btn btn-primary" onclick="adicionar('evolucao');"><i class="feather icon-thumbs-up"></i>Evolução</button>
                        <button type="button" class="btn btn-success" onclick="adicionar('receituario');"><i class="feather icon-check-circle"></i>Receituário</button>
                        <button type="button" class="btn btn-secondary"  onclick="adicionar('vacina');"><i class="feather icon-camera"></i>Vacina</button>
                        <button type="button" class="btn btn-warning"   onclick="adicionar('ocorrencia');"><i class="feather icon-alert-triangle"></i>Ocorrência</button>
                        <button type="button" class="btn btn-info"  onclick="adicionar('anexo');"><i class="feather icon-info"></i>Anexos</button>
                    </div>

                    <br>

                    <div class="tab-content" id="v-pills-tabContent">
                        <div class="tab-pane fade show @if(Session::get('status') != 'Evolução' and Session::get('status') != 'Receituário' and Session::get('status') != 'Vacina'  and Session::get('status') != 'Ocorrência' and Session::get('status') != 'Anexo') active @endif " id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">


                                <h5><i class="fa fa-user"></i>  Dados do Tutor</h5>
                                <hr>

                                <div class="row">


                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Nome</label>
                                            <h6 style="color:darkgrey">{{$registro->Animal->Cliente->nome}}</h6>
                                        </div>
                                    </div>




                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>CPF/CNPJ</label>
                                            <h6 style="color:darkgrey">{{$registro->Animal->Cliente->cpf_cnpj}}</h6>
                                        </div>
                                    </div>


                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Celular</label>
                                            <h6 style="color:darkgrey">{{$registro->Animal->Cliente->celular}}</h6>
                                        </div>
                                    </div>



                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Telefone</label>
                                            <h6 style="color:darkgrey">{{$registro->Animal->Cliente->telefone}}</h6>
                                        </div>
                                    </div>



                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <h6 style="color:darkgrey">{{$registro->Animal->Cliente->email}}</h6>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Número</label>
                                            <h6 style="color:darkgrey">{{$registro->Animal->Cliente->numero}}</h6>
                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Endereço</label>
                                            <h6 style="color:darkgrey">{{$registro->Animal->Cliente->endereco}}</h6>
                                        </div>
                                    </div>



                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Bairro</label>
                                            <h6 style="color:darkgrey">{{$registro->Animal->Cliente->bairro}}</h6>

                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Cidade</label>
                                            <h6 style="color:darkgrey">{{$registro->Animal->Cliente->cidade}}</h6>
                                            
                                        </div>
                                    </div>


                                </div>

                                <h5 style="margin-top: 20px;"><i class="fa fa-paw"></i>  Dados do Animal</h5>
                                <hr>

                                <div class="row">


                                    <div class="form-group col-md-4">
                                        <label for="nome" class="control-label">Nome</label>

                                        <h6 style="color:darkgrey">{{$registro->Animal->nome}}</h6>


                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="sexo" class="control-label">Sexo</label>


                                        <h6 style="color:darkgrey">{{$registro->Animal->sexo}}</h6>

                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="nascimento" class="control-label">Data Nascimento</label>


                                        <h6 style="color:darkgrey">{{ date('d/m/Y', strtotime($registro->Animal->nascimento))}}</h6>

                                    </div>


                                </div>

                                <div class="row">


                                    <div class="form-group col-md-4">
                                        <label for="porte" class="control-label">Porte</label>


                                        <h6 style="color:darkgrey">{{$registro->Animal->porte}}</h6>

                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="especie" class="control-label dynamic">Espécie</label>


                                        <h6 style="color:darkgrey">{{$registro->Animal->especie}}</h6>

                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="raca_id" class="control-label">Raça</label>


                                        <h6 style="color:darkgrey">{{$registro->Animal->Raca->raca_id}}</h6>

                                    </div>



                                </div>




                        </div>
                        <div class="tab-pane fade show @if(Session::get('status') == 'Evolução') active @endif " id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">



                                <div class="card code-table" style="margin: -25px;">
                                    <div class="card-header">
                                        <h5>Evoluções</h5>
                                        <div class="card-header-right">


                                        </div>
                                    </div>
                                    <div class="card-block pb-0">
                                        <div class="table-responsive">
                                            <div id="myTable_wrapper" class="dataTables_wrapper no-footer">
                                                <table class="table table-hover table-list dataTable no-footer" id="myTable" role="grid">
                                                    <thead>
                                                    <tr role="row">
                                                        <th >Data/Hora</th>
                                                        <th >Profissional</th>
                                                        <th >Descrição</th>
                                                        <th >Opções</th>

                                                    </tr>
                                                    </thead>
                                                    <tbody>

                                                    @foreach($registro->Animal->Detalhes as $detalhe)

                                                        @if($detalhe->categoria == 'Evolução')
                                                            <tr role="row" class="odd">
                                                                <td> {{ date('d/m/y H:m', strtotime($detalhe->created_at)) }}</td>
                                                                <td > {{$detalhe->Usuario->name}}</td>
                                                                <td > {{ substr($detalhe->descricao,0,40) }} ...</td>
                                                                <td> <i class="fa fa-print" style="font-size:18px;padding:5px"></i> <i class="fa fa-edit" style="font-size:18px;padding:5px" onclick="editar_evolucao({{$detalhe->id}}, 'evolucao')"></i> </td>

                                                            </tr>
                                                        @endif
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>




                        </div>
                        <div class="tab-pane fade show @if(Session::get('status') == 'Receituário') active @endif " id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">


                            <div class="card code-table" style="margin: -25px;">
                                <div class="card-header">
                                    <h5>Receituários</h5>
                                    <div class="card-header-right">


                                    </div>
                                </div>
                                <div class="card-block pb-0">
                                    <div class="table-responsive">
                                        <div id="myTable_wrapper" class="dataTables_wrapper no-footer">
                                            <table class="table table-hover table-list dataTable no-footer" id="myTable" role="grid">
                                                <thead>
                                                <tr role="row">
                                                    <th >Data/Hora</th>
                                                    <th >Profissional</th>
                                                    <th >Descrição</th>
                                                    <th >Opções</th>

                                                </tr>
                                                </thead>
                                                <tbody>

                                                @foreach($registro->Animal->Detalhes as $detalhe)

                                                    @if($detalhe->categoria == 'Receituário')
                                                        <tr role="row" class="odd">
                                                            <td> {{ date('d/m/y H:m', strtotime($detalhe->created_at)) }}</td>
                                                            <td > {{$detalhe->Usuario->name}}</td>
                                                            <td > {{ substr($detalhe->descricao,0,40) }} ...</td>
                                                            <td> <i class="fa fa-print" style="font-size:18px;padding:5px"></i> <i class="fa fa-edit" style="font-size:18px;padding:5px" onclick="editar_evolucao({{$detalhe->id}}, 'receituario')"></i> </td>

                                                        </tr>
                                                    @endif


                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                        <div class="tab-pane fade show @if(Session::get('status') == 'Vacina') active @endif " id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">


                            <div class="card code-table" style="margin: -25px;">
                                <div class="card-header">
                                    <h5>Vacinas</h5>
                                    <div class="card-header-right">


                                    </div>
                                </div>
                                <div class="card-block pb-0">
                                    <div class="table-responsive">
                                        <div id="myTable_wrapper" class="dataTables_wrapper no-footer">
                                            <table class="table table-hover table-list dataTable no-footer" id="myTable" role="grid">
                                                <thead>
                                                <tr role="row">
                                                    <th >Data/Hora</th>
                                                    <th >Profissional</th>
                                                    <th >Descrição</th>
                                                    <th >Opções</th>

                                                </tr>
                                                </thead>
                                                <tbody>

                                                @foreach($registro->Animal->Detalhes as $detalhe)

                                                    @if($detalhe->categoria == 'Vacina')
                                                        <tr role="row" class="odd">
                                                            <td> {{ date('d/m/y H:m', strtotime($detalhe->created_at)) }}</td>
                                                            <td > {{$detalhe->Usuario->name}}</td>
                                                            <td > {{ substr($detalhe->descricao,0,40) }}</td>
                                                            <td> <i class="fa fa-print" style="font-size:18px;padding:5px"></i> <i class="fa fa-edit" style="font-size:18px;padding:5px" onclick="editar_evolucao({{$detalhe->id}},'vacina')"></i> </td>

                                                        </tr>
                                                    @endif


                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                        <div class="tab-pane fade show @if(Session::get('status') == 'Ocorrência') active @endif " id="v-pills-ocorrencia" role="tabpanel" aria-labelledby="v-pills-ocorrencia-tab">


                            <div class="card code-table" style="margin: -25px;">
                                <div class="card-header">
                                    <h5>Ocorrências</h5>
                                    <div class="card-header-right">


                                    </div>
                                </div>
                                <div class="card-block pb-0">
                                    <div class="table-responsive">
                                        <div id="myTable_wrapper" class="dataTables_wrapper no-footer">
                                            <table class="table table-hover table-list dataTable no-footer" id="myTable" role="grid">
                                                <thead>
                                                <tr role="row">
                                                    <th >Data/Hora</th>
                                                    <th >Profissional</th>
                                                    <th >Descrição</th>
                                                    <th >Opções</th>

                                                </tr>
                                                </thead>
                                                <tbody>

                                                @foreach($registro->Animal->Detalhes as $detalhe)

                                                    @if($detalhe->categoria == 'Ocorrência')
                                                        <tr role="row" class="odd">
                                                            <td> {{ date('d/m/y H:m', strtotime($detalhe->created_at)) }}</td>
                                                            <td > {{$detalhe->Usuario->name}}</td>
                                                            <td > {{ substr($detalhe->descricao,0,40) }} ...</td>
                                                            <td> <i class="fa fa-print" style="font-size:18px;padding:5px"></i> <i class="fa fa-edit" style="font-size:18px;padding:5px" onclick="editar_evolucao({{$detalhe->id}}, 'ocorrencia')"></i> </td>

                                                        </tr>
                                                    @endif


                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                        <div class="tab-pane fade show @if(Session::get('status') == 'Anexo') active @endif " id="v-pills-anexo" role="tabpanel" aria-labelledby="v-pills-anexo-tab">


                            <div class="card code-table" style="margin: -25px;">
                                <div class="card-header">
                                    <h5>Anexos</h5>
                                    <div class="card-header-right">


                                    </div>
                                </div>
                                <div class="card-block pb-0">
                                    <div class="table-responsive">
                                        <div id="myTable_wrapper" class="dataTables_wrapper no-footer">
                                            <table class="table table-hover table-list dataTable no-footer" id="myTable" role="grid">
                                                <thead>
                                                <tr role="row">
                                                    <th >Data/Hora</th>
                                                    <th >Profissional</th>
                                                    <th >Descrição</th>
                                                    <th >Opções</th>

                                                </tr>
                                                </thead>
                                                <tbody>

                                                @foreach($registro->Animal->Detalhes as $detalhe)

                                                    @if($detalhe->categoria == 'Anexo')
                                                        <tr role="row" class="odd">
                                                            <td> {{ date('d/m/y H:m', strtotime($detalhe->created_at)) }}</td>
                                                            <td > {{$detalhe->Usuario->name}}</td>
                                                            <td > <a href="{{url('storage/arquivos/empresa_id_'. $detalhe->empresa_id.'/'.$detalhe->descricao)}}" target="_blank">   {{ substr($detalhe->descricao,0,40) }} </a></td>
                                                            <td>  <i class="fa fa-edit" style="font-size:18px;padding:5px" onclick="editar_evolucao({{$detalhe->id}}, 'anexo')"></i> </td>

                                                        </tr>
                                                    @endif


                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                        <div class="tab-pane fade show " id="v-pills-historico" role="tabpanel" aria-labelledby="v-pills-historico-tab">


                            <div class="card" style="padding:30px;margin:-25px">
                                <div class="card-block">
                                    <div class="row align-items-center justify-content-center">
                                        <div class="col-auto">

                                        </div>
                                        <div class="col">
                                            <h5>{{$registro->Animal->nome}}</h5>
                                            <span>{{$registro->Animal->Cliente->nome}}</span>
                                        </div>
                                    </div>
                                    <ul class="task-list">


                                        @foreach($registro->Animal->Detalhes as $detalhe)
                                        <li>
                                            <i class="task-icon bg-c-green"></i>
                                            <h6> {{$detalhe->categoria}} - {{$detalhe->Usuario->name}}<span class="float-right text-muted">{{ date('d/m/y H:m', strtotime($detalhe->created_at)) }}</span></h6>
                                            <p class="text-muted">{{ substr($detalhe->descricao,0,255) }}</p>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>




    <div class="modal fade" id="exampleModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="titulo">Registrar</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form id="atendimento-form" action="{{ route('atendimento_detalhes.store') }}" method="post" enctype="multipart/form-data">

                    @csrf


                    <div class="modal-body">



                        <div class="row">

                        <div class="form-group col-md-12">
                            <label for="nome" class="control-label">Descrição:</label>

                            <select  class="form-control" name="descricao" id="descricao2">
                                @foreach(\App\Models\Vacinas\Vacina::all() as $vacina)
                                    <option value="{{$vacina->nome}}">{{$vacina->nome}}</option>
                                @endforeach
                            </select>
                            <textarea class="form-control" name="descricao" id="descricao1" rows="16"></textarea>
                            <input type="file" name="descricao" id="descricao3" class="form-control">



                        </div>

                        <div class="form-group col-md-12">
                            <label for="resumo" class="control-label">Observações:</label>
                            <input type="text" name="resumo" id="resumo" class="form-control">
                        </div>



                        </div>

                        <div class="row">

                        <div class="form-group col-md-6">
                            <label for="nome" class="control-label">Profissional:</label>

                            <input type class="form-control"  id="profissional" readonly value="{{Auth::User()->name}}"></input>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="nome" class="control-label">Data Hora:</label>

                            <input type="text" class="form-control" id="data_hora" readonly value="{{date('d/m/y H:m', strtotime(now()))}}"></input>

                        </div>

                        </div>


                        <input type="hidden" name="atendimento_id" value="{{$registro->id}}">
                        <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                        <input type="hidden" name="categoria" id="categoria" value="Evolução">
                        <input type="hidden" name="_method" id="method" value="">
                        <input type="hidden" name="animal_id" id="animal_id" value="{{$registro->animal_id}}">


                    </div>
                    <div class="modal-footer">
                        <a href="{{route('atendimento_detalhes.store')}}" class="btn btn-primary" onclick="event.preventDefault();
                                                         document.getElementById('atendimento-form').submit();">Salvar</a>



                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Voltar</button>
                    </div>

                </form>

            </div>
        </div>
    </div>


@endsection

@section('posScript')

    <script type="text/javascript">


        $('#calendar').datepicker({
            language: "pt-BR",
            todayHighlight: true
        });


     function adicionar(categoria){

         var form = document.getElementById("atendimento-form");
         form.reset();

         if(categoria == 'evolucao'){

             exibir('evolucao');
             document.getElementById('titulo').innerHTML = "Evolução";
             document.getElementById('categoria').value = "Evolução";

         }else if(categoria == 'receituario'){

             exibir('receituario');
             document.getElementById('titulo').innerHTML = "Receituário";
             document.getElementById('categoria').value = "Receituário";

         }else if(categoria == 'ocorrencia'){

             exibir('ocorrencia');
             document.getElementById('titulo').innerHTML = "Ocorrência";
             document.getElementById('categoria').value = "Ocorrência";

         }else if(categoria == 'anexo'){

             exibir('anexo');
             document.getElementById('titulo').innerHTML = "Anexo";
             document.getElementById('categoria').value = "Anexo";

         }else if(categoria == 'vacina'){

             exibir('vacina');
             document.getElementById('titulo').innerHTML = "Vacina";
             document.getElementById('categoria').value = "Vacina";
         }



         $("#exampleModal3").modal();

     }


     function exibir(opcao){

        if(opcao == 'receituario' || opcao == 'evolucao' || opcao == 'ocorrencia'){

            document.getElementById('descricao2').style.display = 'none';
            document.getElementById('descricao2').name = '';

            document.getElementById('descricao3').style.display = 'none';
            document.getElementById('descricao3').name = '';

            document.getElementById('descricao1').style.display = 'block';
            document.getElementById('descricao1').name = 'descricao';

        }else if(opcao == 'vacina'){

             document.getElementById('descricao2').style.display = 'block';
             document.getElementById('descricao2').name = 'descricao';

             document.getElementById('descricao1').style.display = 'none';
             document.getElementById('descricao1').name = '';

            document.getElementById('descricao3').style.display = 'none';
            document.getElementById('descricao3').name = '';

         }else{

            document.getElementById('descricao2').style.display = 'none';
            document.getElementById('descricao2').name = '';

            document.getElementById('descricao1').style.display = 'none';
            document.getElementById('descricao1').name = '';

            document.getElementById('descricao3').style.display = 'block';
            document.getElementById('descricao3').name = 'descricao';



        }


     }


        function editar_evolucao(id,opcao){

            var form = document.getElementById("atendimento-form");

            form.reset();
            exibir(opcao);

            form.action = '{{url('atendimento_detalhes/')}}' + '/' + id ;


            document.getElementById('method').value = 'PUT';

            var cod = id;
            var _token = $('input[name="_token"]').val();



            $.ajax({
                url: '{{url('atendimento_detalhes/')}}' + '/' + id + '/edit',
                method:"GET",
                data:{id:id, _token:_token},
                success:function(result)
                {

                    var obj = JSON.parse(result);

                    console.log(result);

                    document.getElementById('descricao1').value = obj.descricao;
                    document.getElementById('descricao2').value = obj.descricao;
                    document.getElementById('profissional').value = obj.usuario.name;
                    document.getElementById('data_hora').value = obj.created_at;
                    document.getElementById('categoria').value = obj.categoria;
                    document.getElementById('titulo').innerHTML = obj.categoria;






                }

            });




            $("#exampleModal3").modal();




        };



    </script>


@endsection
