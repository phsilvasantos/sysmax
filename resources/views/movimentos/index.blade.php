@extends('layouts.template')

@section('content')

    <form id="pesquisa" action="{{route('movimentos.pesquisa')}}" method="POST">
        @CSRF
        <input type="hidden" name="data_ini" id="data_ini">
        <input type="hidden" name="data_fim" id="data_fim">

    <div class="row">



        <div class="col-md-12">
            <div class="card loction-user">
                <div class="card-block p-0">
                    <div class="row align-items-center justify-content-center">

                        <div class="col-md-3">
                            <h5>Conta</h5>
                            <select class="form-control form-control-sm" name="conta_id">
                                <option value="todas">Todas as Contas</option>
                                @foreach(\App\Models\Contas\Conta::all() as $conta)
                                    <option value="{{$conta->id}}" @if($conta->id == $conta_id) selected @endif> {{$conta->nome}} - {{$conta->conta}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-3">
                            <h5>Data</h5>
                            <div id="reportrange" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
                                <i class="fa fa-calendar"></i>&nbsp;
                                <span></span> <i class="fa fa-caret-down"></i>
                            </div>
                        </div>

                        <div class="col">
                            <h5>Saldo Inicial</h5>
                            R$ {{$saldo_inicial}}
                        </div>

                        <div class="col text-primary">
                            <h5>Créditos</h5>
                            R$ {{$creditos}}
                        </div>

                        <div class="col text-danger">
                            <h5>Débitos</h5>
                            R$ {{$debitos}}
                        </div>


                        <div class="col">
                            <h5>Saldo Final</h5>
                            R$ {{$saldo_inicial + $creditos + $debitos}}
                        </div>


                        {{--<div class="col text-right">
                            <a href="{{route('movimentos.index')}}"> <button type="button" class="btn btn-sm btn-default btn-shadow-1 btn-rounded">Atualizar</button></a>


                        </div>--}}
                    </div>
                    <div class="border-top"></div>


                </div>
            </div>
        </div>



    </div>


    </form>

    <div class="row">

    <div class="col-md-12">
        <div class="card Recent-Users">
            <div class="card-header">
                <h5>Extrato de Movimentações</h5>
                <div class="card-header-right">
                    <a href="{{route('movimentos.create')}}" class="btn btn-rounded btn-sm btn-primary text-white ">NOVO</a>
                </div>
            </div>
            <div class="card-block px-0">
                <div class="table-responsive">
                    <table class="table table-hover  table-list" id="myTable7">
                        <thead>
                        <tr>
                            <th></th>
                            <th>Mov ID</th>
                            <th>Conta</th>
                            <th>Data</th>
                            <th>Historico</th>
                            <th>Valor</th>
                            <th>Opções</th>

                        </tr>
                        </thead>
                        <tbody>



                        @forelse($registros as $registro)
                            <tr class="unread">
                            <td width="20">@if($registro->receber_id > 0) <i class="fa fa-copyright pl-2"></i> @endif</td>
                            <td class="col-auto">{{$registro->id}}</td>
                            <td class="col-auto">{{$registro->conta->nome}}</td>
                            <td class="col-auto">{{date('d/m/Y', strtotime($registro->data))}}</td>
                            <td>
                                <h6 class="mb-1">{{$registro->historico}}</h6>
                                {{--<p class="m-0">{{$registro->categoria}}</p>--}}
                            </td>
                            <td>
                                <h6 class="text-muted"><i class="fas fa-circle @if($registro->valor > 0) text-c-green @else text-c-red @endif f-10 m-r-15"></i>{{$registro->valor}}</h6>
                            </td>
                             <td><a href="{{route('movimentos.edit', $registro->id)}}"><i class="fa fa-edit fa-2x"></button> </a></td>

                        </tr>
                        @empty


                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    </div>

@endsection

@section('posScript')




    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

    <script>

        $(function() {


            var start = {{$data_ini}};
            var end = {{$data_fim}};



            function cb(start, end) {
                $('#reportrange span').html('{{date('d/m/Y',strtotime($data_ini))}}' + ' - ' + '{{date('d/m/Y', strtotime($data_fim))}}');
            }

            $('#reportrange').daterangepicker({
                startDate: start,
                endDate: end,
                ranges: {
                    'Hoje': [moment(), moment()],
                    'Ontem': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Ultimos 7 Dias': [moment().subtract(6, 'days'), moment()],
                    'Ultimos 30 Dias': [moment().subtract(29, 'days'), moment()],
                    'Este Mês': [moment().startOf('month'), moment().endOf('month')],
                    'Mês Passado': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                }
            }, cb);

            cb(start, end);

        });


        $('#reportrange').on('apply.daterangepicker', function(ev, picker) {

            document.getElementById('data_ini').value = picker.startDate.format('YYYY-MM-DD');
            document.getElementById('data_fim').value = picker.endDate.format('YYYY-MM-DD');

            document.getElementById("pesquisa").submit();

        });


    </script>

@endsection
