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

                            <th>Tipo</th>
                            <th>Vencimento</th>
                            <th>Cliente</th>
                            <th>Valor</th>
                            <th>Status</th>
                            <th width="50">Opção</th>

                        </tr></thead>
                        <tbody>



                            @foreach($registros as $conta)

                            <tr @if($conta->tipo == 'credito') class="table-success" @else class="table-danger" @endif>
                                <td style="padding-left:10px;"> {{ $conta->tipo }} </td>
                                <td> {{date('d/m/Y', strtotime($conta->data_vencimento))}} </td>
                                @if(isset($registro->Cliente->nome))
                                    <td>{{$conta->Cliente->nome}} </td>
                                @else
                                    <td> Cliente não Identificado </td>
                                @endif
                                <td>{{$conta->valor_original}} </td>
                                <td>{{$conta->status}} </td>
                                <td style="padding:8px">


                                    <div class="btn-group card-option">
                                        <a  class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            <i class="feather icon-more-horizontal"></i>
                                        </a>
                                        <ul class="list-unstyled card-option dropdown-menu dropdown-menu-right" x-placement="top-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(-106px, -168px, 0px);">
                                            <li class="dropdown-item"><a href="{{route('receber.edit', $conta->id)}}"><span><i class="feather icon-maximize"></i> Acessar</span></a></li>
                                            @if($conta->status != 'Quitado')
                                            <li class="dropdown-item"><a href="{{Route('receber.baixaRapida',[$conta->id])}}"><span><i class="feather icon-minus"></i> Baixa Rápida</span></a></li>
                                            @endif
                                            {{--<li class="dropdown-item reload-card"><a href="#!"><i class="feather icon-refresh-cw"></i> reload</a></li>--}}
                                            @if(\Illuminate\Support\Facades\Auth::user()->id == '1')
                                            <li class="dropdown-item"><a href="#!"><i class="feather icon-trash"></i> Excluir</a></li>
                                            @endif
                                        </ul>
                                    </div>

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
