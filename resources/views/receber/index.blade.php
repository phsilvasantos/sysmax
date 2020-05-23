@extends('layouts.template')

@section('content')

    <div class="row">

        <div class="col-md-3">
            <div class="card">
                <div class="card-header">
                    <h3>Filtros</h3>
                </div>

                <div class="card-body">
                    <form id="pesquisa" name="pesquisa" method="post" action="{{route('receber.pesquisar')}}">
                    <label>Data</label><br>
                    <div id="reportrange" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
                        <i class="fa fa-calendar"></i>&nbsp;
                        <span></span> <i class="fa fa-caret-down"></i>
                    </div>


                        @csrf
                        <input type="hidden" name="data_ini" id="data_ini" value="{{$data_ini}}">
                        <input type="hidden" name="data_fim" id="data_fim"  value="{{$data_fim}}">



                    <br>

                        <label>Tipo</label><br>
                        <select name="tipo" class="form-control" id="tipo" >
                            <option value="credito" @if($tipo == 'credito') selected @endif>Receber</option>
                            <option value="debito" @if($tipo == 'debito') selected @endif>Pagar</option>
                        </select>

                        <br>

                        <label>Cliente/Fornecedor</label><br>
                        <input type="text" name="clifor" class="form-control" value="{{$clifor}}">

                        <br>



                        <label>Forma Pagamento</label><br>
                        <select name="forma_pagamento" class="form-control" id="forma_pagamento" >
                            <option value="todas">Todas</option>
                            <option value="Débito em Conta" @if($formas == 'Débito em Conta') selected @endif>Débito em Conta</option>
                            @foreach(\App\Models\Forma_Pagamentos\Forma_Pagamento::all() as $forma)
                            <option value="{{$forma->nome}}" @if($formas == $forma->nome) selected @endif>{{$forma->nome}}</option>
                            @endforeach
                        </select>

                        <br>
                        <label>Status</label><br>
                        <select name="status" class="form-control" id="status" >
                            <option value="todos" @if($statu == 'todos') selected @endif>Todos</option>
                            <option value="quitado" @if($statu == 'quitado') selected @endif>Quitado</option>
                            <option value="aberto" @if($statu == 'aberto') selected @endif>Aberto</option>
                            <option value="parcialmente_quitado" @if($statu == 'parcialmente_quitado') selected @endif>Parcialmente Quitado</option>

                        </select>


                        <br>

                    <button type="button" class="btn btn-block btn-primary" onclick="pesquisar()">Filtrar</button>
                    </form>
                </div>
            </div>
        </div>

    <div class="col-md-9">
        <div class="card code-table">
            <div class="card-header">

                <h3>Contas a Pagar/Receber</h3>

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
                            <th>Mov ID</th>
                            <th>Tipo</th>
                            <th>Vencimento</th>
                            <th>Cliente/Fornecedor</th>
                            <th>Vlr Bruto</th>
                            <th>Vlr Liquido</th>
                            <th>F.Pagamento</th>
                            <th>Status</th>
                            <th width="50">Opção</th>

                        </tr></thead>
                        <tbody>



                            @foreach($registros as $conta)

                            <tr>
                                <td style="padding-left:10px;"> {{ $conta->id}} </td>
                                <td style="padding-left:10px;"> {{ $conta->movimento_id}} </td>
                                <td style="padding-left:10px;"> {{ ($conta->tipo == 'credito') ? 'Receber' : 'Pagar' }} </td>
                                <td> {{date('d/m/Y', strtotime($conta->data_vencimento))}} </td>
                                @if(isset($conta->Cliente->nome))
                                    <td>{{$conta->Cliente->nome}} </td>
                                @else
                                    <td> Cliente não Identificado </td>
                                @endif
                                <td>{{$conta->valor_original}} </td>
                                <td>{{$conta->valor_pago}} </td>
                                <td>{{$conta->forma_pagamento}} </td>
                                <td>{{$conta->status}} </td>
                                <td style="padding:8px">


                                    <div class="btn-group card-option">
                                        <a  class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            <i class="feather icon-more-horizontal"></i>
                                        </a>
                                        <ul class="list-unstyled card-option dropdown-menu dropdown-menu-right" x-placement="top-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(-106px, -168px, 0px);">
                                            <li class="dropdown-item"><a href="{{route('receber.edit', $conta->id)}}"><span><i class="feather icon-maximize"></i> Acessar</span></a></li>
                                            @if($conta->status != 'Quitado')
                                            <li onclick="baixarRapida({{$conta->id}})" class="dropdown-item"><a href="#"><span><i class="feather icon-minus"></i> Baixa Rápida</span></a></li>
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

                            <div class="input-group-sm col-sm-12">
                                <i class="fa fa-dollar-sign"></i><label for="valor"> Valor Total</label>
                                <input type="text"   class="form-control form-control-sm" name="valor_grupo" id="valor_grupo" disabled>
                            </div>


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

                    <button type="button" class="btn btn-primary" onclick="event.preventDefault(); baixarGrupo()">Confirmar</button>
                    {{--<button type="submit" class="btn btn-primary">Confirmar</button>--}}
                </div>



            </div>
        </div>
    </div>

    </form>



    <form action="{{route('receber.baixaAntecipacao')}}" method="post" id="vendas-form2">

        <div class="modal fade" id="exampleModal8" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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


                                <input type="hidden" name="registros_antecipacao" id="registros_antecipacao">


                                <br>

                                <div class="input-group-sm col-sm-12">
                                    <i class="fa fa-dollar-sign"></i><label for="valor"> Valor Total</label>
                                    <input type="text"   class="form-control form-control-sm" name="valor_antecipacao" id="valor_antecipacao" disabled>
                                </div>

                                <br>
                                <div class="input-group-sm col-sm-12">
                                    <i class="fa fa-dollar-sign"></i><label for="valor"> Data da Baixa</label>
                                    <input type="date"   class="form-control form-control-sm" name="data_antecipacao" id="data_antecipacao" required value="{{ date('Y-m-d') }}">
                                </div>

                                <br>
                                <div class="input-group-sm col-sm-12">
                                    <i class="fa fa-dollar-sign"></i><label for="valor"> Historico</label>
                                    <input type="text"   class="form-control form-control-sm" name="historico_antecipacao" id="historico_antecipacao" required value="Antecipação">
                                </div>


                            </div>

                        </div>

                    </div>
                    <div class="modal-footer">

                        <button type="button" class="btn btn-primary" onclick="event.preventDefault(); baixarAntecipacao()">Confirmar</button>
                        {{--<button type="submit" class="btn btn-primary">Confirmar</button>--}}
                    </div>



                </div>
            </div>
        </div>

    </form>


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



        });


        function pesquisar() {
            document.pesquisa.submit();
        }


        $(document).ready( function () {
            var table =  $('#myTable').DataTable({
                destroy: true,
                'bInfo': false,
                'lengthChange': false,
                dom: 'Bfrtip',
                select: true,
                buttons: [
                    'copyHtml5',
                    'excelHtml5',
                    'csvHtml5',
                    'pdfHtml5',
                    {
                        text: 'Marcar Todos',
                        action: function () {
                            table.rows().select();
                            console.log(table);
                        }
                    },
                    {
                        text: 'Desmarcar',
                        action: function () {
                            table.rows().deselect();
                        }
                    },
                    {
                        text: 'Baixar Grupo',
                        action: function () {

                            var ids = new Array();
                            var total = 0;
                            var valor = 0;


                            var count = table.rows( { selected: true } ).data();


                            for(var i=0; i < count.length; i++){

                                ids[i] = count[i][0];
                                valor = parseFloat(count[i][6]) ;

                                total = total + valor;

                                if(count[i][1] > 0){
                                    alert('Você selecionou contas que já estão baixadas!');
                                    exit();
                                }

                            }





                            document.getElementById('registros').value = ids;
                            document.getElementById('valor_grupo').value = total;

                            $("#exampleModal7").modal();


                        }
                    },
                    {
                        text: 'Antecipação',
                        action: function () {

                            var ids = new Array();
                            var total = 0;
                            var valor = 0;



                            var count = table.rows( { selected: true } ).data();


                            for(var i=0; i < count.length; i++){


                                if(count[i][1] > 0){
                                    alert('Você selecionou contas que já estão baixadas!');
                                    exit();
                                }

                                ids[i] = count[i][0];
                                valor = parseFloat(count[i][6]) ;

                                total = total + valor;

                            }

                            document.getElementById('registros_antecipacao').value = ids;
                            document.getElementById('valor_antecipacao').value = total;

                            $("#exampleModal8").modal();


                        }
                    }
                ],
                'language':{
                    'sSearch': 'Buscar:',
                    "oPaginate": {
                        "sFirst":    "Primero",
                        "sLast":    "Último",
                        "sNext":    "Próximo",
                        "sPrevious": "Anterior"
                    },
                },

            });
        } );


        function baixarGrupo() {


            var data = $("#vendas-form").serialize();


            $.ajax({
                url: '{{route('receber.baixaGrupo')}}',
                type: 'POST',
                data: data,
                success: function(data){

                    $("#exampleModal7").modal('hide');
                    alert('Baixa Efetuada');
                    location.reload();
                },
                error: function(data){

                    $("#exampleModal7").modal('hide');
                    alert('Erro ao tentar efetuar a baixa!')
                }
            });
        }


        function baixarRapida(id) {


            var url = '{{route('receber.index')}}' + '/baixarapida/' + id;


            $.ajax({
                url: url,
                type: 'GET',
                success: function(data){

                    //$("#exampleModal7").modal('hide');
                    alert('Baixa Efetuada');
                    location.reload();
                },
                error: function(data){

                    //$("#exampleModal7").modal('hide');
                    alert('Erro ao tentar efetuar a baixa!')
                }
            });
        }



        function baixarAntecipacao() {


            var data = $("#vendas-form2").serialize();


            $.ajax({
                url: '{{route('receber.baixaAntecipacao')}}',
                type: 'POST',
                data: data,
                success: function(data){

                    var url = '{{route('receber.index')}}'+ '/' + data + '/edit';

                    $("#exampleModal8").modal('hide');
                    alert('Antecipação Registrada');
                    window.location.href = url;
                },
                error: function(data){

                    $("#exampleModal8").modal('hide');
                    alert('Erro ao tentar efetuar a baixa!')
                }
            });
        }


    </script>

@endsection
