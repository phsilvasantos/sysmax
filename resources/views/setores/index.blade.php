@extends('layouts.template')

@section('content')

    <div class="row">

    <div class="col-md-12">
        <div class="card Recent-Users">
            <div class="card-header">
                <h5>Listagem dos Setores</h5>
                <div class="card-header-right">
                    <a href="{{route('setores.create')}}" class="btn btn-rounded btn-sm btn-primary text-white ">NOVO</a>
                </div>
            </div>
            <div class="card-block px-0 py-3">
                <div class="table-responsive">
                    <table class="table table-hover   table-list" id="myTable">
                        <thead>
                            <tr>
                                <td>#</td>
                                <td>Nome</td>
                                <td>Opções</td>
                            </tr>
                        </thead>

                        <tbody>
                        @foreach($registros as $registro)
                            <tr class="unread">
                            <td class="col-auto"><div><i class="fas fa-archive m-r-5" style="font-size:38px;margin-left: 20px;"></i></div></td>
                            <td>
                                <h6 class="mb-1">{{$registro->nome}}</h6>
                                {{--<p class="m-0">{{$registro->categoria}}</p>--}}
                            </td>

                            <td style="text-align:right;">



                                <a href="{{route('setores.edit', $registro->id)}}" class="label theme-bg text-white f-12"  style="margin-right:20px;">Acessar</a>





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
