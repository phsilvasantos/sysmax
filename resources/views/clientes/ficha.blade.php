@extends('layouts.template')

@section('content')

    <div class="" id="printTable">

    @foreach($registro->categorias as $categ)



    <div class="main-body">
        <div class="page-wrapper">
            <!-- [ Main Content ] start -->
            <div class="row">
                <!-- [ Invoice ] start -->
                <div class="container" id="printable">
                    <div>
                        <div class="card">
                            <div class="row">
                                <div class="col-md-12">

                                    <div class="" style="text-align:center;">
                                        <div>
                                            {{--<i class="fas fa-globe m-r-5" style="font-size:38px; padding-top:50px;"></i>--}}
                                            <img  style="width:100px;" src="{{ url('storage/arquivos/empresa_id_1/'.Auth::user()->Empresa->logo)}}" alt="dashboard-user">
                                        </div>
                                    </div>

                                    <br>
                                        <div class="col-sm-12" style="padding:20px 50px;">
                                            <p> O Centro Brasileiro de Cuidado Animal é uma associação sem fins econômicos, de direito privado. Temos como missão a promoção do cuidado animal de forma sustentável e o fortalecimento dos laços entre os tutores e seus respectivos pets, valorizando as potencialidades, as competências e compondo recursos necessários para os processos de mudança, por meio das características e demandas do terceiro setor, respeitando o fluxo e as necessidades do novo mundo.
                                                Formado por profissionais que atuam em diversas áreas, semeando e incentivando o trabalho associativo, dando suporte técnico e especializado nos mais diversos segmentos de medicina veterinária. </p>
                                        </div>

                                </div>
                                <div class="col-md-4"></div>
                            </div>

                            <div class="row">

                                <div class="col-md-12">

                                    <div class="" style="text-align:center;">
                                       <h4>Ficha de {{$categ->categoria}}</h4>
                                    </div>

                                    <p style="padding:20px 50px">
                                        {{$categ->descricao}}
                                    </p>


                                    <h5><span class="float-right"  style="padding-right:50px"><a class="text-secondary" href="#!">Associado Número:  {{$categ->pivot->id}}</a></span></h5>



                                </div>


                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="col-md-12" style="padding:20px 50px;">
                                            <h5>Dados Gerais</h5>
                                            <hr>

                                            <div class="row">

                                                <div class="col-md-1">
                                                    <div class="form-group">
                                                        <label>ID</label>
                                                        <input type="text" class="form-control form-control-sm" name="id" disabled value="{{$registro->id}}">
                                                    </div>
                                                </div>

                                                <div class="col-md-8">
                                                    <div class="form-group">
                                                        <label>Nome</label>
                                                        <input type="text" class="form-control form-control-sm" name="sexo"   value="{{$registro->nome}}">
                                                    </div>
                                                </div>


                                                <div class="col-md-3">
                                                    <label>Sexo</label><br>
                                                    <input type="text" class="form-control form-control-sm" name="nome"   value="@if($registro->sexo == 'F') Feminino @else Masculino @endif">

                                                </div>

                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Nascimento</label>
                                                        <input type="date" class="form-control form-control-sm" name="nascimento"    value="{{$registro->nascimento}}" >
                                                    </div>
                                                </div>

                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label>Tipo</label>
                                                        <select  class="form-control form-control-sm" name="tipo" >
                                                            <option value="Fisica"  @if($registro->tipo == 'Fisica') selected="" @endif>Física</option>
                                                            <option value="Juridica"  @if($registro->tipo == 'Juridica') selected="" @endif>Jurídica</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>CPF/CNPJ</label>
                                                        <input type="text" class="form-control form-control-sm" name="cpf_cnpj"   value="{{$registro->cpf_cnpj}}"  >
                                                    </div>
                                                </div>

                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label>RG</label>
                                                        <input type="text" class="form-control form-control-sm" name="rg"    value="{{$registro->rg}}" >
                                                    </div>
                                                </div>

                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label>Emissor</label>
                                                        <input type="text" class="form-control form-control-sm" name="emissor"    value="{{$registro->emissor}}" >
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Telefone</label>
                                                        <input type="text" class="form-control form-control-sm" name="telefone"    value="{{$registro->telefone}}" >
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Celular</label>
                                                        <input type="text" class="form-control form-control-sm" name="celular"   value="{{$registro->celular}}"  >
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Email</label>
                                                        <input type="text" class="form-control form-control-sm" name="email"   value="{{$registro->email}}"  >
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Profissão</label>
                                                        <input type="text" class="form-control form-control-sm" name="profissao"   value="{{$registro->profissao}}"  >
                                                    </div>
                                                </div>

                                            </div>

                                            <h5 style="margin-top: 20px;">Endereço</h5>
                                            <hr>

                                            <div class="row">
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label>CEP</label>
                                                        <div class="input-group">
                                                            <input type="text" class="form-control" name="cep"   value="{{$registro->cep}}" >
                                                            <div class="input-group-append"><span class="input-group-text" id="basic-addon2"><i class="fa fa-search"></i></span></div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-10">
                                                    <div class="form-group">
                                                        <label>Endereço</label>
                                                        <input type="text" class="form-control form-control-sm" name="endereco"   value="{{$registro->endereco}}" >
                                                    </div>
                                                </div>

                                                <div class="col-md-1">
                                                    <div class="form-group">
                                                        <label>Número</label>
                                                        <input type="text" class="form-control form-control-sm" name="numero"    value="{{$registro->numero}}" >
                                                    </div>
                                                </div>

                                                <div class="col-md-5">
                                                    <div class="form-group">
                                                        <label>Complemento</label>
                                                        <input type="text" class="form-control form-control-sm" name="complemento"   value="{{$registro->complemento}}"  >
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Bairro</label>
                                                        <input type="text" class="form-control form-control-sm" name="bairro"    value="{{$registro->bairro}}" >
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Cidade</label>
                                                        <input type="text" class="form-control form-control-sm" name="cidade"   value="{{$registro->cidade}}" >
                                                    </div>
                                                </div>

                                                <div class="col-md-1">
                                                    <div class="form-group">
                                                        <label>Estado</label>
                                                        <input type="text" class="form-control form-control-sm" name="estado"   value="{{$registro->estado}}" >
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <p style="padding: 20px 50px;">
                                    Declaro, para todos os fins de direito, meu interesse e inteira concordância em ser associado ao CENTRO BRASILEIRO DE CUIDADO ANIMAL.

                                    Validade indeterminada.
                                </p>

                                <p style="padding: 20px 50px;">
                                    Brasília, {{date('d / m /  Y', strtotime($categ->pivot->created_at))}}
                                </p>


                            </div>

                            <div class="row">
                                <hr>
                                <div class="col-md-12" style="padding:100px 50px; text-align:center;">
                                    <h5><span><a class="text-secondary" href="#!">{{$registro->nome}} </a></span></h5>
                                </div>
                            </div>

                        </div>

                        <div class="row text-center">
                            <div class="col-sm-12 invoice-btn-group text-center">
                                <button type="button" class="btn btn-primary btn-print-invoice m-b-10" id="print">Imprimir</button>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- [ Invoice ] end -->
            </div>
            <!-- [ Main Content ] end -->
        </div>
    </div>

    @endforeach

    </div>
@endsection

