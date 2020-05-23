@extends('layouts.template')

@section('content')

    <div class="row">



        <div class="col-xl-3 col-lg-12">
            <div class="card task-board-left">
                <div class="card-header">
                    <h5>Localizar</h5>
                    <div class="card-header-right">
                        <a href="#" data-toggle="modal" data-target="#exampleModal9" class="btn btn-sm btn-primary text-white ">NOVO</a>
                    </div>
                </div>
                <div class="card-block "  style="padding:25px;">

                    <form method="post" action="{{route('clientes.pesquisar')}}">

                        @csrf


                    <div class="input-group mb-3">
                        <select class="form-control" name="campo">
                            <option value="nome_cliente">Cliente</option>
                            <option value="CPF">CPF/CNPJ</option>
                            <option value="id">ID</option>
                            <option value="nome_animal">Animal</option>
                        </select>

                    </div>

                    <div class="input-group mb-3">
                        <input type="text" name="descricao" class="form-control form-control-sm add_task_todo" placeholder="Pesquisar por..." required="">

                    </div>

                    <div class="input-group mb-3">


                            <button class="btn btn-primary btn-block" type="submit"><i class="fas fa-search"></i> Localizar</button>

                    </div>

                    </form>

                </div>
            </div>
        </div>




    <div class="col-md-9">
        <div class="card Recent-Users">
            <div class="card-header">
                <h5>Listagem de Clientes</h5>

            </div>
            <div class="card-block" style="padding:0px;">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <tbody>
                        @foreach($registros as $registro)
                            <tr class="unread">
                            <td class="col-auto">
                                @if($registro->sexo == 'F')
                                    <img class="rounded-circle" style="width:40px;margin-left: 20px;" src="{{url('dattaable/assets/images/user/avatar-3.jpg')}}" alt="activity-user">
                                @else
                                    <img class="rounded-circle" style="width:40px;margin-left: 20px;" src="{{url('dattaable/assets/images/user/avatar-4.jpg')}}" alt="activity-user">
                                @endif
                            </td>
                            <td>
                                <h6 class="mb-1">{{$registro->id}} - {{$registro->nome}}</h6>
                                <p class="m-0">{{$registro->cpf_cnpj}} - @if(count($registro->categorias)){{  $registro->categorias[0]->categoria }} @endif</p>
                            </td>
                            <td>

                                <h6 class="text-muted"> @foreach($registro->animais as $animal) {{$animal->nome}} <br> @endforeach</h6>
                            </td>
                            <td style="text-align:right;">



                                <a href="{{route('clientes.edit', $registro->id)}}" class="label theme-bg text-white f-12" style="margin-right:20px;">Acessar</a>





                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    </div>


    <div class="modal fade" id="exampleModal9" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Selecione o Tipo de Cliente</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form id="internacao-form" action="{{ route('atendimento.internar') }}" method="post">

                    @csrf






                    <div class="modal-body">

                        <div class="form-group col-md-12" style="text-align: center">
                            <div class="card-block"  style="text-align: center">
                                <div class="btn-group btn-group-toggle" data-toggle="buttons"   style="text-align: center">
                                    <label class="btn btn-secondary active" onclick="disable_cpf()">
                                    <input type="radio" name="tipo" id="tipo1" checked="" > Pessoa Física</label>
                                    <label class="btn btn-secondary" onclick="enable_cpf()">
                                    <input type="radio" name="tipo" id="tipo2" > Pessoa Jurídica</label>
                                </div>
                            </div>
                        </div>


                        <div class="form-group col-md-12">
                            <label for="nome" class="control-label">CPF/CNPJ:</label>

                            <input type="text" class="form-control form-control-sm" name="cpf_cnpj" onblur="valida_cpf()" id="cpf" required>


                        </div>


                    </div>
                    <div class="modal-footer">
                        <a href="{{route('clientes.create')}}" style="display: none" id="btn_cpf" disabled  class="btn btn-primary">Salvar</a>



                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Voltar</button>
                    </div>

                </form>

            </div>
        </div>
    </div>

    <script>

        function valida_cpf(){


            tipo = document.getElementById('tipo1').checked == true
            var vcpf = document.getElementById('cpf').value;


            if(tipo){
                if(!cpf(vcpf)){
                    alert('Este CPF não é Válido!');
                }else{

                    valida(vcpf);
                }

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


            var _token = "{{csrf_token()}}";

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


                    }else{

                        enable_cpf()

                    }


                },
                error:function() {
                    enable_cpf()
                }

            });




            }


            function disable_cpf(){

               document.getElementById('btn_cpf').style.display = 'none'



            }


            function enable_cpf(){

              document.getElementById('btn_cpf').style.display = 'block'



            }

    </script>

@endsection
