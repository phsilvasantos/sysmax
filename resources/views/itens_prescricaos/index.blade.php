@extends('layouts.template')

@section('content')

    <div class="row">

    <div class="col-md-12">
        <div class="card Recent-Users">
            <div class="card-header">
                <h5>Listagem dos Itens de Prescrição</h5>
                <div class="card-header-right">
                    <a href="{{route('itens_prescricao.create')}}" class="btn btn-rounded btn-sm btn-primary text-white ">NOVO</a>
                </div>
            </div>
            <div class="card-block px-0">
                <div class="table-responsive">
                    <table class="table table-hover  table-list" id="myTable5">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Item de Prescrição</th>
                            <th>Tipo</th>
                            <th  style="text-align:right">Opções</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($registros as $registro)
                            <tr class="unread">
                            <td class="col-auto"><div><i class="fas fa-list m-r-5" style="font-size:38px;margin-left: 20px;"></i></div></td>
                            <td>
                                <h6 class="mb-1">{{$registro->item}}</h6>
                                {{--<p class="m-0">{{$registro->categoria}}</p>--}}
                            </td>
                            <td>
                                <h6 class="text-muted"><i class="fas fa-circle text-c-green f-10 m-r-15"></i>{{$registro->tipo}}</h6>
                            </td>
                            <td style="text-align:right;">



                                <a href="{{route('itens_prescricao.edit', $registro->id)}}" class="label theme-bg text-white f-12"  style="margin-right:20px;">Acessar</a>





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
