@extends('layouts.template')

@section('content')

    <div class="row">

    <div class="col-md-9">
        <div class="card code-table">
            <div class="card-header">
                <h5>Detalhes da NFCE</h5>
                <div class="card-header-right">

                    


                </div>
            </div>
            <div class="card-block pb-0">
                <div class="table-responsive">
                    <table class="table table-hover  table-list" id="myTable">
                        <thead>
                        <tr>

                            <th>Data</th>
                            <th>Status</th>
                            <th>Descrição</th>


                        </tr></thead>
                        <tbody>



                            @foreach($registros as $registro)

                            <tr>
                                <td style="padding-left:10px;"> {{date('d/m/Y H:m:s', strtotime($registro->created_at))}} </td>
                                <td>{{$registro->status}} </td>
                                <td > <input type="text" class="form-control" value="{{$registro->descricao}}">   </td>

                            </tr>

                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card theme-bg2 assets-value">
            <div class="bg-img"></div>
            <div class="card-block  text-center" style="padding:30px">
                <i class="fas fa-chart-line text-white f-30 m-b-20"></i>
                <h5 class="text-white m-b-12">Nota Fiscal</h5>
                <h3 class="text-white f-w-300">R$ {{$registros[0]->Nfce->valor}}</h3>
                <span class="text-white">{{$registros[0]->Nfce->status}}</span>
            </div>
        </div>

        <div class="card" style="background:#f4f7fa; box-shadow:0 0 0 0;-webkit-box-shadow:0 0 0 0;">
            <span class="label theme-bg text-white f-14 f-w-400 float-right btn-rounded btn-block" style="padding:10px"   onclick="pagamento()">
                <i class="fa fa-edit"></i>
                <a href="{{route('nfce.regerar',$registros[0]->Nfce->venda_id )}}" class="float-right" style="color:white;">Regerar XML</a>
            </span>
            <span class="label theme-bg text-white f-14 f-w-400 float-right btn-rounded btn-block" style="padding:10px" onclick="lancar()">
                        <i class="fa fa-edit"></i>
                        <a href="{{route('nfce.consulta',$registros[0]->Nfce->venda_id )}}" target="_blank" class="float-right" style="color:white;" >Consulta Recibo</a>
                    </span>

            <span class="label theme-bg text-white f-14 f-w-400 float-right btn-rounded btn-block" style="padding:10px" onclick="lancar()">
                        <i class="fa fa-edit"></i>
                        <a href="{{route('nfce.consulta_chave',$registros[0]->Nfce->venda_id )}}" target="_blank" class="float-right" style="color:white;" >Consulta Chave</a>
                    </span>


        </div>

    </div>

    </div>

@endsection
