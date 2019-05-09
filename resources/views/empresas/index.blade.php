@extends('layouts.template')

@section('content')

    <div class="row">

    <div class="col-md-12">
        <div class="card Recent-Users">
            <div class="card-header">
                <h5>Listagem das Empresas</h5>
                <div class="card-header-right">
                    <a href="{{route('empresas.create')}}" class="btn btn-rounded btn-sm btn-primary text-white ">NOVO</a>
                </div>
            </div>
            <div class="card-block px-0 py-3">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <tbody>
                        @foreach($registros as $empresa)
                            <tr class="unread">
                            <td class="col-auto"><img class="rounded-circle" style="width:40px;margin-left: 20px;" src="{{url('dattaable/assets/images/user/avatar-7.jpg')}}" alt="activity-user"></td>
                            <td>
                                <h6 class="mb-1">{{$empresa->nome_fantasia}}</h6>
                                <p class="m-0">{{$empresa->razao_social}}</p>
                            </td>
                            <td>
                                <h6 class="text-muted"><i class="fas fa-circle text-c-green f-10 m-r-15"></i>{{$empresa->cnpj}}</h6>
                            </td>
                            <td style="text-align:right;">



                                <a href="{{route('empresas.edit', $empresa->id)}}" class="label theme-bg text-white f-12" style="margin-right:20px;">Acessar</a>





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
