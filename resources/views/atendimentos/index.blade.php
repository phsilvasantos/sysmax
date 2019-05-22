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



                            @foreach($registros as $atendimento)

                            <tr>
                                <td style="padding-left:10px;"> {{date('H:m', strtotime($atendimento->created_at))}} </td>
                                <td>{{$atendimento->Animal->Cliente->nome}} </td>
                                <td>{{$atendimento->Animal->nome}} </td>
                                <td>{{$atendimento->status}} </td>
                                <td style="padding:10px">  <a class="text-white label theme-bg" href="{{route('atendimentos.edit', $atendimento->id)}}">Acessar</a>  </td>

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

@section('posScript')

    <script type="text/javascript">


        $('#calendar').datepicker({
            language: "pt-BR",
            todayHighlight: true
        });





    </script>


@endsection
