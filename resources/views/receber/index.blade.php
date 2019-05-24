@extends('layouts.template')

@section('content')

    <div class="row">

    <div class="col-md-12">
        <div class="card code-table">
            <div class="card-header">
                <h5>Contas a Receber</h5>
                <div class="card-header-right">

                    <a href="{{route('receber.create')}}" ><button type="button" class="btn btn-primary btn-sm btn-rounded">+ Nova</button></a>



                </div>
            </div>
            <div class="card-block pb-0">
                <div class="table-responsive">
                    <table class="table table-hover  table-list" id="myTable">
                        <thead>
                        <tr>

                            <th>Vencimento</th>
                            <th>Cliente</th>
                            <th>Valor</th>
                            <th>Status</th>
                            <th width="50">Opção</th>

                        </tr></thead>
                        <tbody>



                            @foreach($registros as $conta)

                            <tr>
                                <td style="padding-left:10px;"> {{date('d/m/Y', strtotime($conta->data_vencimento))}} </td>
                                <td>{{$conta->Cliente->nome}} </td>
                                <td>{{$conta->valor_original}} </td>
                                <td>{{$conta->status}} </td>
                                <td style="padding:8px"> <a class="text-white label theme-bg" href="{{route('receber.edit', $conta->id)}}">Acessar</a> </td>

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
