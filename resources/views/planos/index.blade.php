@extends('layouts.template')

@section('content')

    <div class="row">

    <div class="col-md-12">
        <div class="card Recent-Users">
            <div class="card-header">
                <h5>Listagem dos Planos</h5>
                <div class="card-header-right">
                    <a href="{{route('planos.create')}}" class="btn btn-rounded btn-sm btn-primary text-white ">NOVO</a>
                </div>
            </div>
            <div class="card-block px-0 py-3">

                        <div class="row" style="padding:20px">

                        @foreach($registros as $registro)



                            <div class="col-xl-4 col-md-6">
                                <div class="card card-border-c-blue" style="padding:41px">

                                    <div class="card-block">

                                        <h5><i class="fa fa-cart-plus m-r-5 text-c-blue" style="font-size:28px"></i> {{$registro->nome}}</h5>
                                        <br>
                                        <div class="text-muted" align="center" style="font-size:20px">Valor: {{$registro->valor_original}}</div>
                                        <div class="row m-t-30">
                                            <div class="col-6 p-r-0">
                                                <a href="{{route('planos.edit', $registro->id)}}" class="btn btn-primary text-uppercase btn-block">Editar</a>
                                            </div>
                                            <div class="col-6">
                                                <a href="#!" class="btn text-uppercase border btn-block btn-outline-secondary">Integrantes</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        @endforeach

                        </div>

            </div>
        </div>
    </div>

    </div>

@endsection
