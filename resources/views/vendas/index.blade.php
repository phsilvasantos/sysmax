@extends('layouts.template')

@section('content')

    <div class="row">

    <div class="col-md-12">
        <div class="card code-table">
            <div class="card-header">
                <h5>Vendas</h5>
                <div class="card-header-right">

                    <a href="{{route('vendas.create')}}" ><button type="button" class="btn btn-primary btn-sm btn-rounded">+ Nova</button></a>



                </div>
            </div>
            <div class="card-block pb-0">
                <div class="table-responsive">
                    <table class="table table-hover  table-list" id="myTable">
                        <thead>
                        <tr>

                            <th>Data</th>
                            <th>Cliente</th>
                            <th>Valor</th>
                            <th width="50">Opção</th>

                        </tr></thead>
                        <tbody>



                            @foreach($registros as $venda)

                            <tr>
                                <td style="padding-left:10px;"> {{date('d/m/Y', strtotime($venda->created_at))}} </td>
                                <td>{{$venda->Cliente->nome}} </td>
                                <td>{{$venda->total_venda_liquido}} </td>
                                <td> <a href="{{route('vendas.edit', $venda->id)}}" > <button type="button" class="btn btn-success btn-sm btn-rounded" onclick=""> Acessar </button> </a>    </td>

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
