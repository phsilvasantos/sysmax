@extends('layouts.template')

@section('content')

    <div class="row">

        <div class=" row col-md-8">

        <!-- [ bitcoin-wallet section ] start-->
        <div class="col-md-6">
            <div class="card Online-Order">
                <div class="card-block" style="padding:30px">
                    <h5>Associações</h5>
                    <h6 class="text-muted d-flex align-items-center justify-content-between m-t-30">Associações / Clientes<span class="float-right f-18 text-c-green">{{$associados}} / {{$clientes}}</span></h6>
                    <div class="progress mt-3">
                        <div class="progress-bar progress-c-theme" role="progressbar" style="width:{{$kpi_assoc}}%;height:6px;" aria-valuenow="{{$kpi_assoc}}" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <span class="text-muted mt-2 d-block">{{$kpi_assoc}}% Associações</span>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card Online-Order">
                <div class="card-block"  style="padding:30px">
                    <h5>Associados Únicos</h5>
                    <h6 class="text-muted d-flex align-items-center justify-content-between m-t-30">Associados / Clientes<span class="float-right f-18 text-c-purple">{{$unicos}} / {{$clientes}}</span></h6>
                    <div class="progress mt-3">
                        <div class="progress-bar progress-c-theme2" role="progressbar" style="width:{{$kpi_unico}}%;height:6px;" aria-valuenow="{{$kpi_unico}}" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <span class="text-muted mt-2 d-block">{{$kpi_unico}}% Associados</span>
                </div>
            </div>
        </div>

            <!-- [ notifications section ] start -->
            <div class="col-md-12">
                <div class="card note-bar">
                    <div class="card-header">
                        <h5>Ultimos Associados</h5>
                        <div class="card-header-right">
                            <div class="btn-group card-option">
                                <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="feather icon-more-horizontal"></i>
                                </button>
                                <ul class="list-unstyled card-option dropdown-menu dropdown-menu-right">
                                    <li class="dropdown-item full-card"><a href="#!"><span><i class="feather icon-maximize"></i> maximize</span><span style="display:none"><i class="feather icon-minimize"></i> Restore</span></a></li>
                                    <li class="dropdown-item minimize-card"><a href="#!"><span><i class="feather icon-minus"></i> collapse</span><span style="display:none"><i class="feather icon-plus"></i> expand</span></a></li>
                                    <li class="dropdown-item reload-card"><a href="#!"><i class="feather icon-refresh-cw"></i> reload</a></li>
                                    <li class="dropdown-item close-card"><a href="#!"><i class="feather icon-trash"></i> remove</a></li>
                                </ul>

                            </div>
                        </div>
                    </div>
                    <div class="card-block p-0">

                        @forelse($ultimosAssociados as $venda)
                            <a href="#" class="media friendlist-box" style="padding:10px 10px">
                                <div class="mr-3 photo-table">
                                    <img class="rounded-circle" style="width:40px;margin-left: 20px;" src="{{url('dattaable/assets/images/user/avatar-2.jpg')}}" alt="activity-user">
                                </div>
                                <div class="media-body">
                                    <h6>{{$venda->nome}}</h6>
                                    <span class="f-12 float-right text-muted">{{$venda->categoria}}</span>
                                    {{--<p class="text-muted m-0">{{$venda->status}}</p>--}}
                                </div>
                            </a>
                        @empty
                            <div style="padding:50px" align="center">
                                <i class="fa fa-shopping-cart f-70"></i>
                                <p></p>
                                <h6>Sem associados no momento!</h6>
                            </div>

                        @endforelse

                    </div>
                </div>
            </div>
            <!-- [ notifications section ] end-->

        </div>


        <div class="col-md-4">

        <div class="col-md-12 col-xl-12">
            <div class="card" style="padding:30px">

                <div class="card-block text-center">
                    <h5 class="mb-4">Total de Associados</h5>
                    <i class="fas fa-user-friends f-30 text-c-green"></i>
                    <h2 class="f-w-300 mt-3">{{$associados}}</h2>
                    <span class="text-muted">Um cliente pode ter mais de uma associação</span>
                    <div class="">
                    <hr>
                    </div>

                </div>

                <div class="card-block">

                        @foreach($categorias as $categoria)
                        <h6 class="text-muted f-w-300 mt-4">{{$categoria->categoria}} <span class="float-right">{{$categoria->qtd}}</span></h6>
                        @endforeach
                    </div>
                </div>
            </div>

        <!-- [ bitcoin-wallet section ] end-->

        </div>




    </div>

@endsection
