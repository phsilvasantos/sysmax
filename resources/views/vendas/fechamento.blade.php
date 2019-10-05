@extends('layouts.template')


@section('content')




    <div class="row">


    <div class="col-md-12">
        <div class="card code-table">
            <div class="card-header">

                <div class="col-md-3">


                    <div id="reportrange" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
                        <i class="fa fa-calendar"></i>&nbsp;
                        <span></span> <i class="fa fa-caret-down"></i>
                    </div>

                    <form id="pesquisa" name="pesquisa" method="post" action="{{route('vendas.fechamento')}}">
                        @csrf
                        <input type="hidden" name="data_ini" id="data_ini">
                        <input type="hidden" name="data_fim" id="data_fim">


                    </form>

                </div>

                <div class="card-header-right">





                </div>
            </div>
            <div class="card-block pb-0">
                <div class="table-responsive">
                    <table class="table table-list" id="myTable6">
                        <thead>
                        <tr>

                            <th width="50">ID</th>
                            <th width="50">Status</th>
                            <th>Data Venda</th>
                            <th>Data Pagamento</th>
                            <th>Cliente</th>
                            <th>Pet</th>
                            <th>Forma</th>
                            <th>Valor</th>
                            <th>Parcelas</th>
                            <th>Contrib?</th>
                            <th width="50">Opção</th>

                        </tr></thead>
                        <tbody>



                            @foreach($registros as $venda)

                            <tr>

                                <td width="50">{{$venda->id}} </td>
                                <td width="50">{{$venda->status}} </td>
                                <td style="padding-left:10px;"> {{date('d/m/Y', strtotime($venda->created_at))}} </td>
                                <td style="padding-left:10px;"> {{date('d/m/Y', strtotime($venda->data_pagamentos))}} </td>
                                <td>{{$venda->Cliente->nome}} </td>
                                <td>

                                @if(isset($venda->Animal->nome))
                                   {{$venda->Animal->nome}}
                                @else
                                        Venda sem Pet
                                @endif

                                </td>
                                <td>{{$venda->forma}} </td>
                                <td>{{$venda->valor}} </td>
                                <td>{{$venda->parcelas}} </td>
                                <td>{{($venda->contribuicao >0)? 'S' : 'N'}} </td>
                                <td style="padding:8px"> <a class="text-white label theme-bg" href="{{route('vendas.edit', $venda->id)}}">Acessar</a> </td>

                            </tr>

                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

        {{--<div class="col-sm-6">
            <table class="table table-hover table-list">
                <thead>
                <th>Forma</th>
                <th>Valor</th>
                </thead>
                <tbody>

                @foreach($resumo as $res)
                <tr>
                    <td>{{$res->forma}}</td>
                    <td>{{$res->valor}}</td>
                </tr>
                @endforeach

                </tbody>
            </table>
        </div>--}}

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

            document.pesquisa.submit();

        });


    </script>

@endsection
