@extends('layouts.template')

@section('content')

    <div class="row">

        <div class="col-xl-3 col-lg-12">
            <div class="card task-board-left">
                <div class="card-header">
                    <h5>Filtrar</h5>

                </div>
                <div class="card-block "  style="padding:25px;">

                    <form method="post" action="{{route('relatorio.caixa')}}" id="data_form">

                        @csrf


                        <div class="input-group mb-3">
                            <input type="hidden" name="data" id="data" class="form-control form-control-sm add_task_todo"  required="">

                        </div>

                        <div class="input-group mb-3">
                            <div id="calendar" align="center"></div>

                        </div>



                    </form>

                </div>
            </div>
        </div>

    <div class="col-md-9">
        <div class="card code-table">
            <div class="card-header">
                <h5>Vendas</h5>
                <div class="card-header-right">



                </div>
            </div>
            <div class="card-block pb-0">
                <div class="table-responsive">
                    <table class="table table-hover  table-list" id="myTable3">
                        <thead>
                        <tr>

                            <th>Data</th>
                            <th>Venda</th>
                            <th>Cliente</th>
                            <th>Valor</th>
                            <th>Forma</th>

                        </tr></thead>
                        <tbody>

                        <?php   $formas[] = 0; ?>

                            @foreach($registros as $venda)

                            <tr>
                                <td style="padding-left:10px;"> {{date('d/m/Y', strtotime($venda->created_at))}} </td>
                                <td>{{$venda->id}} </td>
                                <td>{{$venda->Cliente->nome}} </td>
                                <td>{{$venda->total_venda_liquido}} </td>
                                <td style="padding:8px">

                                    @foreach($venda->Pagamentos as $forma)
                                        {{ $forma->Formas->nome }} = {{$forma->valor}} </br>


                                    @endforeach



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
