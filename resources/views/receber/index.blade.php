@extends('layouts.template')

@section('content')

    <div class="row">

    <div class="col-md-12">
        <div class="card code-table">
            <div class="card-header">
                <h5>Contas a Receber/Pagar</h5>
                <div class="card-header-right">

                    <a href="{{route('receber.create')}}" ><button type="button" class="btn btn-primary btn-sm btn-rounded">+ Nova</button></a>



                </div>
            </div>
            <div class="card-block pb-0">
                <div class="table-responsive">
                    <table class="table table-hover  table-list" id="myTable">
                        <thead>
                        <tr>

                            <th>ID</th>
                            <th>Tipo</th>
                            <th>Vencimento</th>
                            <th>Cliente</th>
                            <th>Valor</th>
                            <th>Status</th>
                            <th width="50">Opção</th>

                        </tr></thead>
                        <tbody>



                            @foreach($registros as $conta)

                            <tr>
                                <td style="padding-left:10px;"> {{ $conta->id}} </td>
                                <td style="padding-left:10px;"> {{ ($conta->tipo == 'credito') ? 'Receber' : 'Pagar' }} </td>
                                <td> {{date('d/m/Y', strtotime($conta->data_vencimento))}} </td>
                                @if(isset($conta->Cliente->nome))
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

    <form action="{{route('receber.baixaGrupo')}}" method="post" id="vendas-form">

    <div class="modal fade" id="exampleModal7" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fa fa-edit"></i> Confirma a baixa destes registros ?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                @csrf


                <div class="modal-body">

                    <div class="row">

                        <div class="col-md-12">


                            <input type="hidden" name="registros" id="registros">


                            <br>

                            <div class="input-group-sm col-sm-12">
                                <i class="fa fa-dollar-sign"></i><label for="valor"> Data da Baixa</label>
                                <input type="date"   class="form-control form-control-sm" name="data" id="data" required>
                            </div>

                            <br>
                            <div class="input-group-sm col-sm-12">
                                <i class="fa fa-dollar-sign"></i><label for="valor"> Historico</label>
                                <input type="text"   class="form-control form-control-sm" name="historico" id="historico" required>
                            </div>


                        </div>

                    </div>

                </div>
                <div class="modal-footer">

                    <button type="submit" class="btn btn-primary" >Confirmar</button>
                </div>



            </div>
        </div>
    </div>

    </form>


@endsection
