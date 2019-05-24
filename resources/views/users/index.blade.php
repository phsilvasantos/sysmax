@extends('layouts.template')

@section('content')

    <div class="row">

    <div class="col-md-12">
        <div class="card Recent-Users">
            <div class="card-header">
                <h5>Listagem de Usuários</h5>
                <div class="card-header-right">
                    <a href="{{route('users.create')}}" class="btn btn-rounded btn-sm btn-primary text-white ">NOVO</a>
                </div>
            </div>
            <div class="card-block" style="padding:0px;">
                <div class="table-responsive">
                    <table class="table table-hover" id="myTable">

                        <tbody>
                        @foreach($registros as $registro)
                            <tr class="unread">
                            <td class="col-auto"><div><img class="rounded-circle" style="width:40px;margin-left: 20px;" src="{{url('dattaable/assets/images/user/avatar-2.jpg')}}" alt="activity-user"></div></td>
                            <td>
                                <h6 class="mb-1">{{$registro->name}}</h6>
                                <p class="m-0">{{isset($registro->roles[0]->name) }}</p>
                            </td>
                            <td>
                                {{--<h6 class="text-muted"><i class="fas fa-circle text-c-green f-10 m-r-15"></i>{{$registro->especie}}</h6>--}}
                            </td>
                            <td style="text-align:right;">



                                <a href="{{route('users.edit', $registro->id)}}" class="label theme-bg text-white f-12"  style="margin-right:20px;">Acessar</a>





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

@section('posScript')
    <script>

    </script>
@endsection
