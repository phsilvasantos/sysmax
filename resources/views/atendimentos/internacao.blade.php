@extends('layouts.template')

@section('content')



    <div class="row">



    <div class="col-md-12">
        <div class="card code-table">
            <div class="card-header">
                <h5><I class="feather icon-activity"></I> INTERNAÇÃO</h5>
                <div class="card-header-right">

                    <div id="reportrange" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
                        <i class="fa fa-calendar"></i>&nbsp;
                        <span></span> <i class="fa fa-caret-down"></i>
                    </div>

                    <form id="pesquisa" name="pesquisa" method="get" action="{{route('atendimento.internacao')}}">
                        @csrf
                        <input type="hidden" name="data_ini" id="data_ini">
                        <input type="hidden" name="data_fim" id="data_fim">


                    </form>

                </div>
            </div>
            <div class="card-block pb-0">

                <ul class="nav nav-tabs" id="myTab" role="tablist">


                    <li class="nav-item"><a class="nav-link text-left active" id="v-pills-peso-tab" data-toggle="pill" href="#v-pills-peso" role="tab" aria-controls="v-pills-peso" aria-selected="true"> Internados</a></li>
                    <li class="nav-item"><a class="nav-link text-left "  id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">Com Alta</a></li>


                </ul>


                <div class="tab-content" id="v-pills-tabContent">




                    <div class="tab-pane fade show active" id="v-pills-peso" role="tabpanel" aria-labelledby="v-pills-peso-tab">

                        <div class="table-responsive">
                            <table class="table table-hover  table-list" id="myTable">
                                <thead>
                                <tr>

                                    <th>Animal</th>
                                    <th>Tutor</th>
                                    <th>Admissão</th>
                                    <th>Tempo Internação</th>
                                    <th>Leito</th>
                                    <th>Veterinário</th>
                                    <th style="width:40px;">Status</th>


                                </tr></thead>
                                <tbody>



                                @if(isset($registros))
                                @foreach($registros as $atendimento)

                                    @if($atendimento->status == 'Em Atendimento')

                                        <?php

                                        $data1 = new DateTime( date('Y-m-d', strtotime($atendimento->created_at)) );
                                        $data2 = new DateTime( date('Y-m-d') );

                                        $intervalo = $data1->diff( $data2 );

                                        ?>

                                     <tr onclick="window.location='{{route("atendimentos.edit", $atendimento->id)}}'">
                                         <td>{{$atendimento->Animal->nome}} </td>
                                         <td>{{$atendimento->Animal->Cliente->nome}} </td>
                                         <td style="padding-left:10px;"> {{date('d/m/Y', strtotime($atendimento->created_at))}} </td>
                                         <td style="padding-left:10px;"> <?php  echo($intervalo->m > 0 ? $intervalo->d . 'mês(es)' : '');  ?> e {{$intervalo->d}} dia(s) </td>
                                         <td>{{$atendimento->Leito->nome}} </td>
                                         <td>{{$atendimento->Veterinario->name}} </td>
                                        <td>

                                            @if($atendimento->status == 'Aguardando')
                                                <label class="label label-warning"> {{$atendimento->status}} </label>
                                            @elseif($atendimento->status == 'Atendido')
                                                <label class="label label-success"> {{$atendimento->status}} </label>
                                            @else
                                                <label class="label label-primary"> {{$atendimento->status}} </label>
                                            @endif
                                        </td>


                                    </tr>

                                    @endif

                                @endforeach
                                @endif

                                </tbody>
                            </table>
                        </div>


                    </div>

                    <div class="tab-pane fade show" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">


                        <div class="table-responsive">
                            <table class="table table-hover  table-list" id="myTable5">
                                <thead>
                                <tr>

                                    <th>Animal</th>
                                    <th>Tutor</th>
                                    <th>Admissão</th>
                                    <th>Tempo Internação</th>
                                    <th>Leito</th>
                                    <th>Veterinário</th>
                                    <th style="width:40px;">Status</th>


                                </tr></thead>
                                <tbody>



                                @if(isset($registros_alta))
                                    @foreach($registros_alta as $atendimento)

                                        @if($atendimento->status == 'Atendido')

                                            <?php

                                            $data1 = new DateTime( date('Y-m-d', strtotime($atendimento->created_at)) );
                                            $data2 = new DateTime( date('Y-m-d', strtotime($atendimento->data_encerramento)) );

                                            $intervalo = $data1->diff( $data2 );

                                            ?>

                                            <tr onclick="window.location='{{route("atendimentos.edit", $atendimento->id)}}'">
                                                <td>{{$atendimento->Animal->nome}} </td>
                                                <td>{{$atendimento->Animal->Cliente->nome}} </td>
                                                <td style="padding-left:10px;"> {{date('d/m/Y', strtotime($atendimento->created_at))}} </td>
                                                <td style="padding-left:10px;">  {{$intervalo->d}} dias </td>
                                                <td>{{$atendimento->Leito->nome}} </td>
                                                <td>{{$atendimento->Veterinario->name}} </td>
                                                <td>

                                                    @if($atendimento->status == 'Aguardando')
                                                        <label class="label label-warning"> {{$atendimento->status}} </label>
                                                    @elseif($atendimento->status == 'Atendido')
                                                        <label class="label label-success"> {{$atendimento->status}} </label>
                                                    @else
                                                        <label class="label label-primary"> {{$atendimento->status}} </label>
                                                    @endif
                                                </td>


                                            </tr>

                                        @endif

                                    @endforeach
                                @endif

                                </tbody>
                            </table>
                        </div>

                    </div>



                </div>

            </div>
        </div>
    </div>

    </div>


    <form action="{{route('atendimento.filtrar')}}" id="data_form" method="POST">

        @csrf

        <input type="hidden" name="data" value="" id="data">


    </form>



@endsection

@section('posScript')


    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />


    <script type="text/javascript">


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
