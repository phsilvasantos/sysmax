@extends('layouts.template')

@section('content')

    <div class="row">

    <div class="col-md-12">
        <div class="card code-table">
            <div class="card-header">
                <h5>Notas Fiscais ao Cosumidor</h5>
                <div class="card-header-right">




                </div>
            </div>
            <div class="card-block pb-0">
                <div class="table-responsive">
                    <table class="table table-hover  table-list" id="myTable">
                        <thead>
                        <tr>

                            <th>Data</th>
                            <th>Venda</th>
                            <th>Valor</th>
                            <th>XML</th>
                            <th>NFCE</th>
                            <th>Recibo</th>
                            <th>Status</th>
                            <th width="50">Opção</th>

                        </tr></thead>
                        <tbody>



                            @foreach($registros as $registro)

                            <tr>
                                <td style="padding-left:10px;"> {{date('d/m/Y', strtotime($registro->created_at))}} </td>
                                <td>{{$registro->venda_id}} </td>
                                <td>{{$registro->valor}} </td>
                                <td> <a href="{{ str_replace('public','storage',$registro->xml_autorizado)}}" download="" target="_blank"> <i class="fa fa-file-archive"></i> </a></td>
                                <td><a href="{{ str_replace('public','storage',$registro->nfce_pdf)}}" target="_blank"> <i class="fa fa-file-pdf"></i> </a> </td>
                                <td>{{$registro->recibo}} </td>
                                <td>{{$registro->status}} </td>
                                <td> <a href="{{route('nfce.detalhes', $registro->id)}}" > <button type="button" class="btn btn-success btn-sm btn-rounded" onclick=""> Acessar </button> </a>    </td>

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
