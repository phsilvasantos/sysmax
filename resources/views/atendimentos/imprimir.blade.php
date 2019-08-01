@extends('layouts.template')

@section('content')



            <div class="row">


                <div class="col-md-12 col-sm-12">



                    <div class="tab-content print col-xl-12" id="printable">
                        <div class="tab-pane fade show @if(Session::get('status') != 'Evolução' and Session::get('status') != 'Receituário' and Session::get('status') != 'Vacina'  and Session::get('status') != 'Ocorrência' and Session::get('status') != 'Anexo' and Session::get('status') != 'Peso') active @endif " id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">

                            <div class="col-md-1"><img src="{{url('storage/arquivos/empresa_id_'. Auth::user()->Empresa->id.'/'.Auth::user()->Empresa->logo)}}" width="60px"></div>

                            <div class="col-md-11">
                                <h3> {{Auth::user()->Empresa->nome_fantasia}}</h3>

                            </div>
                                <hr>

                                <div class="row"  style="background-color:#f3f3f3; padding:30px">


                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Nome do Animal</label>
                                            <h5 style="color:darkgrey">{{$registro->Animal->nome}}</h5>
                                        </div>
                                    </div>




                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Proprietario</label>
                                            <h5 style="color:darkgrey">{{$registro->Animal->Cliente->nome}}</h5>
                                        </div>
                                    </div>


                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Telefones</label>
                                            <h5 style="color:darkgrey">{{$registro->Animal->Cliente->celular}} {{$registro->Animal->Cliente->telefone}}</h5>
                                        </div>
                                    </div>






                                </div>

                                <hr>
                                <br>

                                <h5 style="margin-top: 20px;" align="center"></i>  {{$detalhes->categoria}}</h5>


                                <hr>
                                <br>
                                <br>

                                                <textarea id="campo" class="form-control" data-autoresize rows="2" disabled="" style="font-size:18px">{{$detalhes->descricao}}</textarea>






                            <br>
                            <br>
                            <br>

                                <div class="" style="font-size:16px">Brasília, {{ date('d/m/Y', strtotime($detalhes->created_at))}}</div>
                                <br>
                                <br>
                                <br>

                                <div align="center" style="font-size:16px">  {{$detalhes->Usuario->name}}</div>


                                <br>
                                <br>

                                <hr>

                                <div align="center" style="font-size:16px"> {{Auth::user()->Empresa->endereco}} - {{Auth::user()->Empresa->cidade}} - {{Auth::user()->Empresa->estado}}   {{Auth::user()->Empresa->telefone}}</div>

                        </div>

                    </div>


                    <br>


                        <div class="card-block text-right">
                            <button type="button" class="btn btn-outline-accent" onclick=" window.print();"><i class="feather icon-search"></i>Imprimir</button>

                        </div>



                    <br>

                </div>
            </div>







@endsection

@section('posScript')

    <script>

        window.addEventListener('load', function() {


        var elemento = document.getElementById('campo');

        var off = elemento.offsetHeight - elemento.clientHeight;

        jQuery(elemento).css('height', 'auto').css('height', elemento.scrollHeight + off);


/*
        jQuery.each(jQuery('textarea[data-autoresize]'), function() {
            var offset = this.offsetHeight - this.clientHeight;

            var resizeTextarea = function(el) {
                jQuery(el).css('height', 'auto').css('height', el.scrollHeight + offset);
            };
            jQuery(this).on('click', function() { resizeTextarea(this); }).removeAttr('data-autoresize');


        });*/




        });


    </script>


@endsection
