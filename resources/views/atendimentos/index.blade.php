@extends('layouts.template')

@section('content')

    <div class="row">

    <div class="col-md-3">
        <div class="card text-center">
            <div class="card-body" style="padding:20px 0px">
                <div id="calendar" align="center"></div>
            </div>
        </div>
    </div>


    <div class="col-md-9">
        <div class="card code-table">
            <div class="card-header">
                <h5>Atendimentos</h5>
                <div class="card-header-right">



                </div>
            </div>
            <div class="card-block pb-0">

                <ul class="nav nav-tabs" id="myTab" role="tablist">

                    <li class="nav-item"><a class="nav-link text-left " id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true"> Todos</a></li>
                    <li class="nav-item"><a class="nav-link text-left active" id="v-pills-peso-tab" data-toggle="pill" href="#v-pills-peso" role="tab" aria-controls="v-pills-peso" aria-selected="true"> Aguardando</a></li>
                    <li class="nav-item"><a class="nav-link text-left "  id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">Em Atendimento</a></li>
                    <li class="nav-item"><a class="nav-link text-left " id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false">Atendido</a></li>

                </ul>


                <div class="tab-content" id="v-pills-tabContent">

                    <div class="tab-pane fade show " id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">


                        <div class="table-responsive">
                    <table class="table table-hover  table-list" id="myTable">
                        <thead>
                        <tr>

                            <th>Hora</th>
                            <th>Cliente</th>
                            <th>Animal</th>
                            <th>Status</th>
                            <th width="50">Opção</th>

                        </tr></thead>
                        <tbody>

                            @if(isset($registros))

                            @foreach($registros as $atendimento)

                            <tr>
                                <td style="padding-left:10px;"> {{date('H:m', strtotime($atendimento->created_at))}} </td>
                                <td>{{$atendimento->Animal->Cliente->nome}} </td>
                                <td>{{$atendimento->Animal->nome}} </td>
                                <td>

                                    @if($atendimento->status == 'Aguardando')
                                        <label class="label label-warning"> {{$atendimento->status}} </label>
                                    @elseif($atendimento->status == 'Atendido')
                                        <label class="label label-success"> {{$atendimento->status}} </label>
                                    @else
                                        <label class="label label-primary"> {{$atendimento->status}} </label>
                                    @endif
                                </td>
                                <td style="padding:10px">  <a class="text-white label theme-bg" href="{{route('atendimentos.edit', $atendimento->id)}}">Acessar</a>  </td>

                            </tr>

                            @endforeach

                            @endforeach

                        </tbody>
                    </table>
                </div>


                    </div>


                    <div class="tab-pane fade show active" id="v-pills-peso" role="tabpanel" aria-labelledby="v-pills-peso-tab">

                        <div class="table-responsive">
                            <table class="table table-hover  table-list" id="myTables">
                                <thead>
                                <tr>

                                    <th>Hora</th>
                                    <th>Cliente</th>
                                    <th>Animal</th>
                                    <th>Status</th>
                                    <th width="50">Opção</th>

                                </tr></thead>
                                <tbody>


                                @if(isset($registros))
                                @foreach($registros as $atendimento)

                                    @if($atendimento->status == 'Aguardando')

                                    <tr>
                                        <td style="padding-left:10px;"> {{date('H:m', strtotime($atendimento->created_at))}} </td>
                                        <td>{{$atendimento->Animal->Cliente->nome}} </td>
                                        <td>{{$atendimento->Animal->nome}} </td>
                                        <td>

                                            @if($atendimento->status == 'Aguardando')
                                                <label class="label label-warning"> {{$atendimento->status}} </label>
                                            @elseif($atendimento->status == 'Atendido')
                                                <label class="label label-success"> {{$atendimento->status}} </label>
                                            @else
                                                <label class="label label-primary"> {{$atendimento->status}} </label>
                                            @endif
                                        </td>
                                        <td style="padding:10px">  <a class="text-white label theme-bg" href="{{route('atendimentos.edit', $atendimento->id)}}">Acessar</a>  </td>

                                    </tr>

                                    @endif

                                @endforeach
                                    @endforeach

                                </tbody>
                            </table>
                        </div>


                    </div>

                    <div class="tab-pane fade show" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">


                        <div class="table-responsive">
                            <table class="table table-hover  table-list" id="myTables">
                                <thead>
                                <tr>

                                    <th>Hora</th>
                                    <th>Cliente</th>
                                    <th>Animal</th>
                                    <th>Status</th>
                                    <th width="50">Opção</th>

                                </tr></thead>
                                <tbody>


                                @if(isset($registros))
                                @foreach($registros as $atendimento)

                                    @if($atendimento->status == 'Em Atendimento')

                                        <tr>
                                            <td style="padding-left:10px;"> {{date('H:m', strtotime($atendimento->created_at))}} </td>
                                            <td>{{$atendimento->Animal->Cliente->nome}} </td>
                                            <td>{{$atendimento->Animal->nome}} </td>
                                            <td>

                                                @if($atendimento->status == 'Aguardando')
                                                    <label class="label label-warning"> {{$atendimento->status}} </label>
                                                @elseif($atendimento->status == 'Atendido')
                                                    <label class="label label-success"> {{$atendimento->status}} </label>
                                                @else
                                                    <label class="label label-primary"> {{$atendimento->status}} </label>
                                                @endif
                                            </td>
                                            <td style="padding:10px">  <a class="text-white label theme-bg" href="{{route('atendimentos.edit', $atendimento->id)}}">Acessar</a>  </td>

                                        </tr>

                                    @endif

                                @endforeach
                                    @endforeach

                                </tbody>
                            </table>
                        </div>

                    </div>

                    <div class="tab-pane fade show" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">

                        <div class="table-responsive">
                            <table class="table table-hover  table-list" id="myTables">
                                <thead>
                                <tr>

                                    <th>Hora</th>
                                    <th>Cliente</th>
                                    <th>Animal</th>
                                    <th>Status</th>
                                    <th width="50">Opção</th>

                                </tr></thead>
                                <tbody>


                                @if(isset($registros))
                                @foreach($registros as $atendimento)

                                    @if($atendimento->status == 'Atendido')

                                        <tr>
                                            <td style="padding-left:10px;"> {{date('H:m', strtotime($atendimento->created_at))}} </td>
                                            <td>{{$atendimento->Animal->Cliente->nome}} </td>
                                            <td>{{$atendimento->Animal->nome}} </td>
                                            <td>

                                                @if($atendimento->status == 'Aguardando')
                                                    <label class="label label-warning"> {{$atendimento->status}} </label>
                                                @elseif($atendimento->status == 'Atendido')
                                                    <label class="label label-success"> {{$atendimento->status}} </label>
                                                @else
                                                    <label class="label label-primary"> {{$atendimento->status}} </label>
                                                @endif
                                            </td>
                                            <td style="padding:10px">  <a class="text-white label theme-bg" href="{{route('atendimentos.edit', $atendimento->id)}}">Acessar</a>  </td>

                                        </tr>

                                    @endif

                                @endforeach
                                    @endforeach

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

    <script type="text/javascript">



        $('#calendar').datepicker({
            language: "pt-BR",
            todayHighlight: true
        })
            .on('changeDate', function(e) {
                // `e` here contains the extra attributes
                mudar_data(e.format(0,'yyyy-mm-dd'));




            });




        function mudar_data(data){

            document.getElementById('data').value = data;

           document.getElementById('data_form').submit();


        };



    </script>


@endsection
