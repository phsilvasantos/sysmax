@extends('layouts.template')

@section('content')


    <div class="row">
        <div class="col-md-12">

            <div class="row">


                <div class="col-md-12 col-sm-12">

                    @if($registro->status == 'Em Atendimento')

                    <div class="card-block text-right">
                        <button type="button" class="btn btn-outline-accent" onclick=" window.print();"><i class="feather icon-search"></i>Imprimir</button>

                    </div>

                    @endif

                    <br>

                    <div class="tab-content print col-xl-12" id="printable">
                        <div class="tab-pane fade show @if(Session::get('status') != 'Evolução' and Session::get('status') != 'Receituário' and Session::get('status') != 'Vacina'  and Session::get('status') != 'Ocorrência' and Session::get('status') != 'Anexo' and Session::get('status') != 'Peso') active @endif " id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">


                                <h4><img src="{{Auth::user()->Empresa->logo}}">  {{Auth::user()->Empresa->nome_fantasia}}</h4>
                                <hr>

                                <div class="row"  style="background-color:#f3f3f3; padding:30px">


                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Nome do Animal</label>
                                            <h6 style="color:darkgrey">{{$registro->Animal->nome}}</h6>
                                        </div>
                                    </div>




                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Proprietario</label>
                                            <h6 style="color:darkgrey">{{$registro->Animal->Cliente->nome}}</h6>
                                        </div>
                                    </div>


                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Telefones</label>
                                            <h6 style="color:darkgrey">{{$registro->Animal->Cliente->celular}} {{$registro->Animal->Cliente->telefone}}</h6>
                                        </div>
                                    </div>






                                </div>

                                <hr>
                                <br>

                                <h5 style="margin-top: 20px;" align="center"></i>  {{$detalhes->categoria}}</h5>


                                <hr>
                                <br>
                                <br>

                                                <textarea class="form-control" data-autoresize rows="2">{{$detalhes->descricao}}</textarea>






                            <br>
                            <br>
                            <br>

                                <div class="">Brasília, {{ date('d/m/Y', strtotime($detalhes->created_at))}}</div>
                                <br>
                                <br>
                                <br>

                                <div align="center">  {{$detalhes->Usuario->name}}</div>


                                <br>
                                <br>

                                <hr>

                                <div align="center"> {{Auth::user()->Empresa->endereco}} - {{Auth::user()->Empresa->cidade}} - {{Auth::user()->Empresa->estado}}   {{Auth::user()->Empresa->telefone}}</div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>





@endsection

@section('posScript')

    <script>

        jQuery(document).ready(function() { resizeTextarea(this);});

        jQuery.each(jQuery('textarea[data-autoresize]'), function() {
            var offset = this.offsetHeight - this.clientHeight;

            var resizeTextarea = function(el) {
                jQuery(el).css('height', 'auto').css('height', el.scrollHeight + offset);
            };
            jQuery(this).on('keyup input', function() { resizeTextarea(this); }).removeAttr('data-autoresize');

        });



    </script>


@endsection
