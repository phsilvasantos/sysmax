@extends('layouts.template')

@section('content')

    <div class="row">

    <div class="col-md-12">
        <div class="card Recent-Users">
            <div class="card-header">
                <h5>Listagem de Produtos</h5>
                <div class="card-header-right">
                    <a href="{{route('produtos.create')}}" class="btn btn-rounded btn-sm btn-primary text-white ">NOVO</a>
                    <a href="#" onclick="event.preventDefault(); $('#exampleModal10').modal('show')" class="btn btn-rounded btn-sm btn-primary text-white ">FILTRAR</a>
                </div>
            </div>
            <div class="card-block px-0 pb-3">






                <div class="table-responsive">
                    <table class="table table-hover  table-list" id="table_produtos">
                        <thead>
                            <tr class="table-success">
                                <th>#</th>
                                <th>Nome</th>
                                <th>Categoria</th>
                                <th>Valor Custo</th>
                                <th>Valor Venda</th>
                                <th  style="text-align:right">Opções</th>
                            </tr>
                        </thead>

                        <tbody>
                        @foreach($registros as $registro)
                            <tr class="unread">
                            <td class="col-auto"><div><i class="fas fa-box-open m-r-5" style="font-size:24px; margin-left:20px;"></i></div></td>
                            <td>
                                <h6 class="mb-1">{{$registro->nome}}</h6>
                                <p class="m-0">{{$registro->descricao}}</p>
                            </td>
                            <td>
                                <h6 class="text-muted"><i class="fas fa-circle text-c-green f-10 m-r-15"></i>{{$registro->categorias->categoria}}</h6>
                            </td>
                            <td>
                                <h6 class="text-muted">{{$registro->custo}}</h6>
                            </td>
                            <td>
                                <h6 class="text-muted">{{$registro->preco}}</h6>
                            </td>
                            <td style="text-align:right;">



                                <a href="{{route('produtos.edit', $registro->id)}}" class="label theme-bg text-white f-12" style="margin-right:20px;">Acessar</a>





                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>


                    @if(Route::currentRouteAction() != 'App\Http\Controllers\ProdutoController@filtrar')

                    {{ $registros->links() }}

                    @endif


                </div>
            </div>
        </div>
    </div>

    </div>


    <div class="modal fade" id="exampleModal10" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-default">Filtrar</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>


                <form method="POST" action="{{route('produto.filtrar')}}">

                    <div class="modal-body">

                            @csrf

                            <div class="row p-2">
                                <input type="text" class="form-control form-control-sm" name="valor" placeholder="Nome do Produto">
                            </div>
                            <br>
                            <div class="row p-2">
                                <input type="submit" class="btn btn-block btn-primary" value="Pesquisar">
                            </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" onclick="$('#exampleModal10').modal('hide');" class="btn btn-default">Voltar</button>

                    </div>

                </form>

            </div>
        </div>
    </div>




@endsection
