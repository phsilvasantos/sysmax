@extends('layouts.template')

@section('content')

    @if (session('status'))

    @endif

    <form action="{{route('roles.update', $registro->id)}}" method="post" name="form1">

        @csrf
        <input type="hidden" name="_method" value="put">
        <input type="hidden" id="origem" name="origem" value="">

    <div class="kt-portlet kt-portlet--tabs">

        <div class="row">

        <div class="col-md-12">
            <div class="card loction-user">
                <div class="card-block p-0">
                    <div class="row align-items-center justify-content-center">
                        <div class="col-auto">
                            <div><i class="fas fa-list m-r-5" style="font-size:38px"></i></div>
                        </div>
                        <div class="col">
                            <h5>{{$registro->name}}</h5>

                        </div>
                        <div class="col text-right">
                            <a href="{{route('roles.index')}}"> <button type="button" class="btn btn-sm btn-default btn-shadow-1 btn-rounded"><i class="feather icon-arrow-left"></i>Voltar</button></a>


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


                </div>
            </div>
        </div>

        </div>


        <div class="kt-portlet__body" style="margin-top: -20px;">
            <div class="tab-content">
                <div class="tab-pane active" id="kt_portlet_base_demo_1_1_tab_content" role="tabpanel">
                    <h5>Dados Gerais</h5>
                    <hr>

                    <div class="row">

                        <div class="col-md-1">
                            <div class="form-group">
                                <label>ID</label>
                                <input type="text" class="form-control form-control-sm" name="id" disabled value="{{$registro->id}}">
                            </div>
                        </div>

                        <div class="col-md-11">
                            <div class="form-group">
                                <label>Nome do Papel</label>
                                <input type="text" class="form-control form-control-sm" name="name"  value="{{$registro->name}}">
                            </div>
                        </div>


                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Descrição</label>
                                <textarea class="form-control" lin="5" name="descricao">{{$registro->descricao}}</textarea>
                            </div>
                        </div>



                    </div>



                </div>

            </div>
        </div>




    </div>


        <div class="kt-portlet__body"  style="margin-top: 20px;">
            <div class="tab-content">
                <div class="tab-pane active" id="kt_portlet_base_demo_1_1_tab_content" role="tabpanel">
                    <h5>Permissões</h5>
                    <hr>

                    <div class="row">

                        @foreach(App\Models\Auth\Permissions\Permission::all() as $permission)

                            <div class="col-md-3">
                                <div class="form-group text-left">
                                    <div class="checkbox checkbox-fill d-inline">
                                        <input type="checkbox"  name="permissions[{{$permission->name}}]" id="{{$permission->name}}" @foreach($registro->permissions as $permissao) {{($permissao->name == $permission->name) ? ' checked' : '' }} @endforeach>
                                        <label for="{{$permission->name}}" class="cr"> {{$permission->name}}</label>
                                    </div>
                                </div>
                            </div>

                        @endforeach

                    </div>


                </div>

            </div>
        </div>


    </form>






@endsection
