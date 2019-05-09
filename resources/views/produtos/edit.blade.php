@extends('layouts.template')

@section('content')



    @if (session('status'))

    @endif

    <form action="{{route('produtos.update', $registro->id)}}" method="post" name="form1">

        @csrf
        <input type="hidden" id="_method" name="_method" value="PUT">
        <input type="hidden" id="origem" name="origem" value="">


        <div class="kt-portlet kt-portlet--tabs">

            <div class="row">

                <div class="col-md-12">
                    <div class="card loction-user">
                        <div class="card-block p-0">
                            <div class="row align-items-center justify-content-center">
                                <div class="col-auto">
                                    <div><i class="fas fa-box-open m-r-5" style="font-size:38px"></i></div>
                                </div>
                                <div class="col">
                                    <h5>{{ strtoupper($registro->nome)}}</h5>
                                    <span>{{ strtoupper($registro->categorias->categoria)}} </span>
                                </div>
                                <div class="col text-right">
                                    <a href="{{route('produtos.index')}}"> <button type="button" class="btn btn-sm btn-default btn-shadow-1 btn-rounded"><i class="feather icon-arrow-left"></i>Voltar</button></a>
                                    <div class="btn-group mb-2 mr-2  btn-rounded">
                                        <button type="submit" class="btn btn-primary btn-rounded">Salvar</button>
                                        <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split  btn-rounded" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="sr-only">Toggle Dropdown</span></button>
                                        <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(92px, 43px, 0px);">
                                            <a class="dropdown-item" href="#!" onclick="salvar('novo')">Salvar e Novo</a>
                                            <a class="dropdown-item" href="#!" onclick="salvar('salvar')">Salvar e Voltar</a>

                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="border-top"></div>

                            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist" style="margin-bottom: 0px !important;">
                                <li class="nav-item">
                                    <a class="nav-link @if(Session::get('status') != 'Animal Incluido') active @endif  show" id="pills-home-tab" data-toggle="pill" href="#kt_portlet_base_demo_1_1_tab_content" role="tab" aria-controls="pills-home" aria-selected="true">Geral</a>
                                </li>

                            </ul>

                        </div>
                    </div>
                </div>

            </div>


            <div class="kt-portlet__body"  style="margin-top: -20px;">


                <div class="tab-content">
                    <div class="tab-pane active" id="kt_portlet_base_demo_1_1_tab_content" role="tabpanel">
                        <h5>Dados Gerais</h5>
                        <hr>

                        <div class="row">

                            <div class="form-group col-md-8">
                                <label for="nome" class="control-label">Produto/Serviço</label>


                                <input type="text" class="form-control form-control-sm" id="nome" name="nome" placeholder="Nome" required=""  value="{{$registro->nome}}">

                            </div>
                            <div class="form-group col-md-4">
                                <label for="tipo" class="control-label">Tipo</label>


                                <select class="form-control form-control-sm" id="tipo" name="tipo" required="" >
                                    <option value="produto" @if($registro->tipo == 'produto') Selected="" @endif>Produto</option>
                                    <option value="servico" @if($registro->tipo == 'servico') Selected="" @endif>Serviço</option>
                                </select>

                            </div>


                        </div>

                        <div class="row">

                            <div class="form-group col-md-4">
                                <label for="categoria_id" class="control-label">Categoria</label>


                                <select class="form-control form-control-sm" name="categoria_id">
                                    @foreach($registro->TodasCategorias() as $categoria)
                                        <option value="{{$categoria->id}}" @if($registro->categoria_id == $categoria->id) Selected="" @endif>{{$categoria->categoria}}</option>
                                    @endforeach
                                </select>

                            </div>


                            <div class="form-group col-md-4">
                                <label for="unidade" class="control-label">Unidade</label>


                                <input type="text" class="form-control form-control-sm" id="unidade" name="unidade" placeholder="Unidade" required="" value="{{$registro->unidade}}">

                            </div>

                            <div class="form-group col-md-4">
                                <label for="cod_barras" class="control-label">Codigo de Barras</label>


                                <input type="text" class="form-control form-control-sm" id="cod_barras" name="cod_barras" placeholder="Codigo de Barras"  value="{{$registro->cod_barras}}">

                            </div>

                        </div>

                        <div class="row">


                            <div class="form-group col-md-4">
                                <label for="cod_ncm" class="control-label">Código NCM</label>


                                <input class="form-control form-control-sm" id="codigo_ncm" name="codigo_ncm" placeholder="Código NCM"   value="{{$registro->codigo_ncm}}">

                            </div>
                            <div class="form-group col-md-4">
                                <label for="cod_ex_tipi" class="control-label">Código EX TIPI</label>


                                <input type="text" class="form-control form-control-sm" id="codigo_extipi" name="codigo_extipi" placeholder="Código EX TIPI"   value="{{$registro->codigo_extipi}}">

                            </div>

                            <div class="form-group col-md-4">
                                <label for="CFOP" class="control-label">CFOP</label>


                                <select  class="form-control form-control-sm" id="codigo_cfop" name="codigo_cfop">
                                    <option value="5101" @if($registro->codigo_cfop == 5101) selected @endif>Venda de produção do estabelecimento</option>
                                    <option value="5102" @if($registro->codigo_cfop == 5102) selected @endif>Venda de mercadoria de terceiros</option>
                                    <option value="5115" @if($registro->codigo_cfop == 5115) selected @endif>Venda de mercadoria de terceiros, recebida anteriormente em consignação mercantil</option>
                                    <option value="5401" @if($registro->codigo_cfop == 5401) selected @endif>Venda de produção do estabelecimento em operação  com produto sujeito a ST, como contribuinte substituto</option>
                                    <option value="5403" @if($registro->codigo_cfop == 5403) selected @endif>Venda de mercadoria de terceiros em operação com mercadoria sujeita a ST, como contribuinte substituto</option>
                                    <option value="5405" @if($registro->codigo_cfop == 5405) selected @endif>Venda de mercadoria de terceiros, sujeita a ST, como contribuinte substituído</option>
                                    <option value="5656" @if($registro->codigo_cfop == 5656) selected @endif>Venda de combustível ou lubrificante de terceiros, para consumidor final</option>
                                    <option value="5933" @if($registro->codigo_cfop == 5933) selected @endif>Prestação de serviço tributado pelo ISSQN (Nota Fiscal conjugada)</option>
                                </select>

                            </div>

                        </div>

                        <hr>

                        <div class="row">

                            <div class="form-group col-md-2">
                                <label for="custo" class="control-label">Custo Médio</label>


                                <input type="number" step="0.01" class="form-control form-control-sm" id="custo" name="custo" placeholder="Preço de Custo"   value="{{$registro->custo}}">

                            </div>
                            {{-- <div class="form-group col-md-2">
                                 <label for="margem_lucro" class="control-label">Margem de Lucro</label>


                                 <div class="input-group">
                                     <input type="number" class="form-control form-control-sm" id="margem_lucro"  onchange=Calc()  name="margem_lucro" placeholder="Margem de Lucro">

                                 </div>

                             </div>


                             <div class="form-group col-md-2">
                                 <label for="preco_sugerido" class="control-label">Preço Sugerido</label>


                                 <input class="form-control form-control-sm" id="preco_sugerido" name="preco_sugerido" placeholder="Preço Sugerido" disabled="">

                             </div>--}}


                            <div class="form-group col-md-2">
                                <label for="preco_venda" class="control-label">Preço Venda</label>


                                <input  type="number" step="0.01" class="form-control form-control-sm" id="preco" name="preco" placeholder="Preço de Venda"   value="{{$registro->preco}}">

                            </div>

                            <div class="form-group col-md-2">
                                <label for="comissao" class="control-label">Comissão em %</label>


                                <div class="input-group">
                                    <input type="number" class="form-control form-control-sm" id="comissao" name="comissao" placeholder="Comissão"   value="{{$registro->comissao}}">

                                </div>




                            </div>

                            <div class="form-group col-md-2">
                                <label for="estoque_minimo" class="control-label">Estoque Mínimo</label>


                                <input type="number" class="form-control form-control-sm" id="estoque_minimo" name="estoque_minimo" placeholder="Estoque Mínimo"   value="{{$registro->estoque_minimo}}">

                            </div>


                            <div class="form-group col-md-2">
                                <label for="estoque_maximo" class="control-label">Estoque Máximo</label>


                                <input type="number" class="form-control form-control-sm" id="estoque_maximo" name="estoque_maximo" placeholder="Estoque Máximo"   value="{{$registro->estoque_maximo}}">

                            </div>

                            <div class="form-group col-md-2">
                                <label for="estoque_atual" class="control-label">Estoque Atual</label>


                                <input class="form-control form-control-sm" id="estoque_atual" name="estoque_atual" placeholder="Estoque Atual"   value="{{$registro->estoque_atual}}">

                            </div>


                            {{--<div class="form-group col-md-2">
                                <label for="tabela_id" class="control-label">Tabela</label>


                                <select class="form-control form-control-sm" id="tabela_id" name="tabela_id" required="" >



                                </select>

                            </div>--}}


                        </div>

                        {{--<div class="row">

                            <div class="form-group col-md-2">
                                <label for="permite_alterar_preco_venda" class="control-label">Permite Alterar Preço</label>


                                <div id="permite_alterar_preco_venda" class="btn-group" data-toggle="buttons">
                                    <label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                                        <input type="radio" name="permite_alterar_preco_venda" value="1" data-parsley-multiple="permite_alterar_preco_venda" data-parsley-id="12" required=""> &nbsp; Sim &nbsp;
                                    </label>
                                    <label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                                        <input type="radio" name="permite_alterar_preco_venda" value="0" data-parsley-multiple="permite_alterar_preco_venda"> Não
                                    </label>
                                </div>



                            </div>
                            <div class="form-group col-md-2">
                                <label for="controla_estoque" class="control-label">Controla Estoque</label>


                                <div id="controla_estoque" class="btn-group" data-toggle="buttons">
                                    <label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                                        <input type="radio" name="controla_estoque" value="1" data-parsley-multiple="controla_estoque" data-parsley-id="12" required=""> &nbsp; Sim &nbsp;
                                    </label>
                                    <label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                                        <input type="radio" name="controla_estoque" value="0" data-parsley-multiple="controla_estoque"> Não
                                    </label>
                                </div>

                            </div>



                            --}}{{--<div class="form-group col-md-2">
                                <label for="data_validade" class="control-label">Data Validade</label>


                                <input type="date" class="form-control form-control-sm" id="data_validade" name="data_validade" placeholder="Validade">

                            </div>--}}{{--





                        </div>--}}


                    </div>

                </div>
            </div>
        </div>

    </form>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirma Desativação</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Ao confirmar este usuário não será mais associado a esta categoria. Voce confirma essa operação?</p>
                </div>
                <div class="modal-footer">
                    <a href="{{route('cliente.desassociar', $registro->id)}}" class="btn btn-danger" onclick="event.preventDefault();
                                                     document.getElementById('delete-form').submit();">Confirmar</a>

                    <form id="delete-form" action="{{ route('cliente.desassociar', $registro->id) }}" method="POST" style="display: none;">
                        @csrf

                        <input type="hidden" name="categoria_id" id="categoria_id" value="">
                        <input type="hidden" name="cliente_id" id="cliente_id" value="{{$registro->id}}">
                    </form>



                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Voltar</button>
                </div>
            </div>
        </div>
    </div>



    <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Cadastrar Animal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form id="animal-form" action="{{ route('animais.store') }}" method="POST">

                    @csrf


                    <div class="modal-body">

                    </div>
                    <div class="modal-footer">
                        <a href="{{route('animais.store')}}" class="btn btn-primary" onclick="event.preventDefault();
                                                         document.getElementById('animal-form').submit();">Salvar</a>



                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Voltar</button>
                    </div>

                </form>

            </div>
        </div>
    </div>






@endsection


@section('posScript')


    <script type="text/javascript">
        var count = 0;


        function addRow() {
            $('table#myTable').dataTable().fnAddData( [

                '<select class="form-control form-control-sm" name="categoria_id[' + count +']">@foreach($registro->TodasCategorias() as $categoria)<option value="{{$categoria->id}}">{{$categoria->categoria}}</option>@endforeach</select>',
                '',
                '<button type="button" class="btn btn-danger btn-sm btn-rounded" onclick="deleteRow(this.parentNode.parentNode.rowIndex);">- Excluir</button>' ] );

            count++;
        }

        function deleteRow (linha) {



            if (count != 0) {
                $("table#myTable").dataTable().fnDeleteRow(linha - 1);

                count--;
            }
        }

        function setar_categoria(id){

            document.getElementById('categoria_id').value = id;
        }

    </script>


    <script>
        function atualiza_raca(){


                if($('#especie').val() != '')
                {
                    var select = $('#especie').attr("id");
                    console.log(select);
                    var value = $('#especie').val();
                    console.log(value);
                    var dependent = $('#especie').data('dependent');
                    console.log(dependent);
                    var _token = $('input[name="_token"]').val();
                    console.log(_token);
                    $.ajax({
                        url:"{{ route('dynamicdependent.fetch') }}",
                        method:"POST",
                        data:{select:select, value:value, _token:_token, dependent:dependent},
                        success:function(result)
                        {

                            $('#'+dependent).html(result);
                        }

                    })
                }



            $('#especie').change(function(){
                $('#raca_id').val('');
            });


        };



        function editar_animal(id){

            var form = document.getElementById("animal-form");

            form.reset();

            form.action = '{{url('animais/')}}' + '/' + id ;


            document.getElementById('method').value = 'PUT';

            var cod = id;
            var _token = $('input[name="_token"]').val();



            $.ajax({
                url: '{{url('animais/')}}' + '/' + id + '/edit',
                method:"GET",
                data:{id:id, _token:_token},
                success:function(result)
                {

                    var obj = JSON.parse(result);

                    console.log(result);

                    $.each(obj, function(index, value) {

                        if(value != null & index != 'created_at' & index != 'updated_at') {


                            console.log(index, value);
                            document.getElementById(index).value = value;

                            if(index == 'raca_id'){
                                atualiza_raca();
                                setTimeout(function(){ document.getElementById(index).value = value; }, 1000);

                            }

                        }
                    });






                }

            });




            $("#exampleModal2").modal();




        };


        function reset_form(){

            var form = document.getElementById("animal-form");

            form.reset();

            form.action = '{{url('animais/store')}}' ;


            document.getElementById('method').value = 'POST';


        }


    </script>

@endsection
