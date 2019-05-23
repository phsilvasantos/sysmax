@extends('layouts.template')

@section('content')

    <div class="row">



        <div class="col-xl-3 col-lg-12">
            <div class="card task-board-left">
                <div class="card-header">
                    <h5>Localizar</h5>
                    <div class="card-header-right">
                        <a href="{{route('clientes.create')}}" class="btn btn-sm btn-primary text-white ">NOVO</a>
                    </div>
                </div>
                <div class="card-block "  style="padding:25px;">

                    <form method="post" action="{{route('clientes.pesquisar')}}">

                        @csrf

                    <div class="input-group mb-3">
                        <select class="form-control" name="campo">
                            <option value="nome_cliente">Cliente</option>
                            <option value="CPF">CPF/CNPJ</option>
                            {{--<option value="nascimento">Data Nascimento</option>--}}
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
                            <td class="col-auto"><img class="rounded-circle" style="width:40px;margin-left: 20px;" src="{{url('dattaable/assets/images/user/avatar-4.jpg')}}" alt="activity-user"></td>
                            <td>
                                <h6 class="mb-1">{{$registro->nome}}</h6>
                                <p class="m-0">{{$registro->cpf_cnpj}}</p>
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

@endsection
