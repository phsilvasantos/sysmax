@extends('layouts.template')

@section('content')

    @if (session('status'))

    @endif

    <form action="{{route('users.update', $registro->id)}}" method="post" name="form1">

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
                            <div><img class="rounded-circle" style="width:40px;margin-left: 20px;" src="{{url('dattaable/assets/images/user/avatar-2.jpg')}}" alt="activity-user"></i></div>
                        </div>
                        <div class="col">
                            <h5>{{$registro->name}}</h5>

                        </div>
                        <div class="col text-right">
                            <a href="{{route('users.index')}}"> <button type="button" class="btn btn-sm btn-default btn-shadow-1 btn-rounded"><i class="feather icon-arrow-left"></i>Voltar</button></a>


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

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Nome do Usuário</label>
                                <input type="text" class="form-control form-control-sm" name="name"  value="{{$registro->name}}">
                            </div>
                        </div>


                        <div class="col-md-4">
                            <div class="form-group">
                                <label>email</label>
                                <input type="email" class="form-control form-control-sm" name="email"  required value="{{$registro->email}}">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>CPF</label>
                                <input type="text" class="form-control form-control-sm" name="cpf"  required value="{{$registro->cpf}}">
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
                    <h5>Papeis</h5>
                    <hr>

                    <div class="row">

                        @if(!$registro->semPapel())

                            @foreach(App\Models\Auth\Roles\Role::all() as $role)

                                <div class="col-md-3">
                                    <div class="form-group text-left">
                                        <div class="checkbox checkbox-fill d-inline">
                                            <input type="checkbox"  name="roles[{{$role->name}}]" id="{{$role->name}}" @foreach($registro->roles as $papeis) {{($papeis->name == $role->name) ? ' checked' : '' }} @endforeach>
                                            <label for="{{$role->name}}" class="cr"> {{$role->name}}</label>
                                        </div>
                                    </div>
                                </div>

                            @endforeach

                        @else

                            @foreach(App\Models\Auth\Roles\Role::all() as $role)

                                <div class="col-md-3">
                                    <div class="form-group text-left">
                                        <div class="checkbox checkbox-fill d-inline">
                                            <input type="checkbox"  name="roles[{{$role->name}}]" id="{{$role->name}}">
                                            <label for="{{$role->name}}" class="cr"> {{$role->name}}</label>
                                        </div>
                                    </div>
                                </div>

                            @endforeach

                        @endif

                    </div>


                </div>

            </div>
        </div>


    </form>


    <form action="{{route('users.password', $registro->id)}}" method="post" name="form2">

        @csrf
        <input type="hidden" name="_method" value="put">
        <input type="hidden" id="origem" name="origem" value="">


        <div class="kt-portlet__body"  style="margin-top: 20px;">
            <div class="tab-content">
                <div class="tab-pane active" id="kt_portlet_base_demo_1_1_tab_content" role="tabpanel">
                    <h5>Nova Senha</h5>
                    <hr>

                    <div class="row">


                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Senha</label>
                                <input type="password" class="form-control form-control-sm" name="password"  required value="">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Confirme a senha</label>
                                <input type="password" class="form-control form-control-sm"   required value="">
                            </div>
                        </div>


                        <div class="col-md-4">
                            <div class="form-group">

                                <button type="submit" class="btn btn-primary" >Confirmar</button>
                            </div>
                        </div>


                    </div>


                </div>

            </div>
        </div>

    </form>


        <div class="kt-portlet__body"  style="margin-top: 20px;">
            <div class="tab-content">
                <div class="tab-pane active" id="kt_portlet_base_demo_1_1_tab_content" role="tabpanel">
                    <h5>Comissionamento</h5>
                    <hr>

                    <br>

                    <div class="row">

                        <div class="col-md-6">

                         <h4>Por Grupo</h4>

                         <hr>
                         <br>

                        <form id="form-procedi" action="{{route('comissao.store')}}" method="post">
                            @csrf
                            <input type="hidden" name="user_id" value="{{$registro->id}}">
                            <input type="hidden" name="tipo" value="grupo">

                            <div class="row">

                                <div class="col-md-6">

                                    <div class="form-group">
                                        <label>Produto ou Serviço</label>
                                        <select class="form-control form-control-sm" name="produto_id">
                                            @foreach(\App\Models\Categorias\Categoria::where('categoria_type','Produtos')->get() as $categoria)
                                                <option value="{{$categoria->id}}">{{$categoria->categoria}}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Fixo</label>
                                        <input type="number" step="0.01" class="form-control form-control-sm" name="valor"   value="">
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>%</label>
                                        <input type="number" step="0.01" class="form-control form-control-sm" name="percentual"   value="">
                                    </div>
                                </div>


                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>...</label>
                                        <button type="submit" class="btn btn-primary" >Incluir</button>
                                    </div>
                                </div>

                            </div>

                            <br>
                            <hr>
                            <br>

                        <table class="table table-hover  table-list" id="myTable4">
                            <thead>
                                <tr>
                                    <th>Categoria</th>
                                    <th>Valor Fixo</th>
                                    <th>Valor %</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach($registro->Grupos as $categoria)
                                    <tr>
                                        <td>{{$categoria->nome}}</td>
                                        <td>{{$categoria->valor}}</td>
                                        <td>{{$categoria->percentual}}</td>
                                    </tr>

                                @endforeach


                            </tbody>

                        </table>

                        </form>

                        </div>





                        <div class="col-md-6">

                            <h4>Por Procedimento</h4>

                            <hr>
                            <br>


                            <form id="form-procedi"  action="{{route('comissao.store')}}" method="post">
                                @csrf
                                <input type="hidden" name="user_id" value="{{$registro->id}}">
                                <input type="hidden" name="tipo" value="procedimento">

                            <div class="row">

                                <div class="col-md-6">

                                    <div class="form-group">
                                     <label>Produto ou Serviço</label>
                                    <select class="form-control form-control-sm js-example-data-ajax" name="produto_id" id="produto_id"></select>

                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Fixo</label>
                                        <input type="number" step="0.01" class="form-control form-control-sm" name="valor"   value="">
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>%</label>
                                        <input type="number" step="0.01" class="form-control form-control-sm" name="percentual"   value="">
                                    </div>
                                </div>


                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>...</label>
                                        <button type="submit" class="btn btn-primary" >Incluir</button>
                                    </div>
                                </div>

                            </div>

                            </form>

                            <br>
                            <hr>
                            <br>

                            <table class="table table-hover  table-list" id="myTable5">
                                <thead>
                                <tr>
                                    <th>Procedimento</th>
                                    <th>Valor Fixo</th>
                                    <th>Valor %</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($registro->Procedimentos as $categoria)
                                    <tr>
                                        <td>{{$categoria->nome}}</td>
                                        <td>{{$categoria->valor}}</td>
                                        <td>{{$categoria->percentual}}</td>
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

    <script>

        //codigo para popular o combo de produtos dinamicamente
        $('#produto_id').select2({
            ajax: {
                url: "{{route('produto.localizar')}}",
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        q: params.term // search term
                    };
                },
                processResults: function (data, params) {
                    return {
                        results: data.results
                    };
                },
            },
            placeholder: 'Digite pelo menos 3 caracteres',
            minimumInputLength: 3,
        });

        $('#produto_id').on('select2:select', function (e) {
            var data = e.params.data;


        });

    </script>

@endsection
