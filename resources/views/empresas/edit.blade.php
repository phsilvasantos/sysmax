@extends('layouts.template')

@section('content')

    @if (session('status'))

    @endif

    <form action="{{route('empresas.update', $registro->id)}}" method="post" name="form1" enctype="multipart/form-data">

        @csrf
        <input type="hidden" name="_method" value="put">

    <div class="kt-portlet kt-portlet--tabs">

        <div class="row">

        <div class="col-md-12">
            <div class="card loction-user">
                <div class="card-block p-0">
                    <div class="row align-items-center justify-content-center">
                        <div class="col-auto">
                            <img class="img-fluid rounded-circle" style="width:80px;" src="{{url('dattaable/assets/images/user/avatar-7.jpg')}}" alt="dashboard-user">
                        </div>
                        <div class="col">
                            <h5>{{$registro->nome_fantasia}}</h5>
                            <span><i class="fas fa-map-marker-alt f-18 m-r-5"></i> {{$registro->razao_social}}</span>
                        </div>
                        <div class="col text-right">
                            <a href="{{route('empresas.index')}}"> <button type="button" class="btn btn-sm btn-default btn-shadow-1 btn-rounded"><i class="feather icon-arrow-left"></i>Voltar</button></a>
                            <button type="submit" class="btn btn-sm btn-primary btn-shadow-1 btn-rounded"><i class="feather icon-thumbs-up"></i>Salvar</button>

                        </div>
                    </div>
                    <div class="border-top"></div>

                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist" style="margin-bottom: 0px !important;">
                            <li class="nav-item">
                                <a class="nav-link active show" id="pills-home-tab" data-toggle="pill" href="#kt_portlet_base_demo_1_1_tab_content" role="tab" aria-controls="pills-home" aria-selected="true">Geral</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link show" id="pills-profile-tab" data-toggle="pill" href="#kt_portlet_base_demo_1_2_tab_content" role="tab" aria-controls="pills-profile" aria-selected="false">NFCE</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link show" id="pills-contact-tab" data-toggle="pill" href="#kt_portlet_base_demo_1_3_tab_content" role="tab" aria-controls="pills-contact" aria-selected="false">Complemento</a>
                            </li>
                        </ul>

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

                        <div class="col-md-5">
                            <div class="form-group">
                                <label>Nome Fantasia</label>
                                <input type="text" class="form-control form-control-sm" name="nome_fantasia"  value="{{$registro->nome_fantasia}}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Razão Social</label>
                                <input type="text" class="form-control form-control-sm" name="razao_social"  value="{{$registro->razao_social}}">
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Sigla</label>
                                <input type="text" class="form-control form-control-sm" name="sigla"  value="{{$registro->sigla}}">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>CNPJ</label>
                                <input type="text" class="form-control form-control-sm cnpj" name="cnpj"  value="{{$registro->cnpj}}" data-mask="99.999.999/9999-99">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Inscrição Estadual</label>
                                <input type="text" class="form-control form-control-sm" name="ie"  value="{{$registro->ie}}">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Inscrição Municipal</label>
                                <input type="text" class="form-control form-control-sm" name="im"  value="{{$registro->im}}">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Telefone</label>
                                <input type="text" class="form-control form-control-sm telefone" name="telefone"  value="{{$registro->telefone}}">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Site</label>
                                <input type="text" class="form-control form-control-sm" name="site"  value="{{$registro->site}}">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" class="form-control form-control-sm" name="email"  value="{{$registro->email}}">
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
                                    <input type="text" class="form-control" name="cep" id="cep" value="{{$registro->cep}}" onblur="pesquisar_cep()">
                                    <div class="input-group-append" onclick="pesquisar_cep()" ><span class="input-group-text"><i class="fa fa-search"></i></span></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-10">
                            <div class="form-group">
                                <label>Endereço</label>
                                <input type="text" class="form-control form-control-sm" name="endereco" id="endereco"  value="{{$registro->endereco}}">
                            </div>
                        </div>

                        <div class="col-md-1">
                            <div class="form-group">
                                <label>Número</label>
                                <input type="text" class="form-control form-control-sm" name="numero" id="numero"  value="{{$registro->numero}}">
                            </div>
                        </div>

                        <div class="col-md-5">
                            <div class="form-group">
                                <label>Complemento</label>
                                <input type="text" class="form-control form-control-sm" name="complemento" id="complemento" value="{{$registro->complemento}}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Bairro</label>
                                <input type="text" class="form-control form-control-sm" name="bairro" id="bairro" value="{{$registro->bairro}}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Cidade</label>
                                <input type="text" class="form-control form-control-sm" name="cidade" id="cidade" value="{{$registro->cidade}}">
                            </div>
                        </div>

                        <div class="col-md-1">
                            <div class="form-group">
                                <label>Estado</label>
                                <input type="text" class="form-control form-control-sm" name="estado" id="estado"  value="{{$registro->estado}}">
                            </div>
                        </div>

                    </div>


                </div>
                <div class="tab-pane" id="kt_portlet_base_demo_1_2_tab_content" role="tabpanel">
                    <h5>Dados para NFE e NFCE</h5>
                    <hr>


                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Logo <a href="{{url('storage/arquivos/empresa_id_'. $registro->id.'/'.$registro->logo)}}" target="_blank">{{$registro->logo}}</a> </label>
                                <div class="input-group">
                                    {{--<input type="text" class="form-control" name="logo" value="{{$registro->logo}}">--}}
                                    {{--<div class="input-group-append"><span class="input-group-text" id="basic-addon1"><i class="fa fa-search"></i></span></div>--}}
                                    <input type="file" class="form-control" name="logo" value="{{$registro->logo}}">
                                </div>
                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Certificado  <a href="{{url('storage/arquivos/empresa_id_'. $registro->id.'/'.$registro->certificado)}}" target="_blank">{{$registro->certificado}}</a></label>
                                <div class="input-group">
                                    {{--<input type="text" class="form-control" name="certificado" value="{{$registro->certificado}}">
                                    <div class="input-group-append"><span class="input-group-text" id="basic-addon2"><i class="fa fa-search"></i></span></div>--}}
                                    <input type="file" class="form-control" name="certificado" value="{{$registro->certificado}}">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Senha</label>
                                <input type="password" class="form-control form-control-sm" name="senha"  value="{{$registro->senha}}">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>CSC</label>
                                <input type="text" class="form-control form-control-sm" name="csc"  value="{{$registro->csc}}">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>CSC ID</label>
                                <input type="text" class="form-control form-control-sm" name="csc_id"  value="{{$registro->csc_id}}">
                            </div>
                        </div>

                    </div>

                    <br>

                    <h5>Configurações Avançadas</h5>

                        <hr>

                    <div class="row">

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Versão</label>
                                <select  class="form-control form-control-sm" name="versao">
                                    <option value="3.00" @if($registro->versao == '3.00') selected  @endif>3.00</option>
                                    <option value="4.00" @if($registro->versao == '4.00') selected  @endif>4.00</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Serviço</label>
                                <select  class="form-control form-control-sm" name="cListServ" id="cListServ">
                                    @foreach($servicos as $servico)

                                        <option value="{{$servico->cod}}" @if($registro->cListServ == $servico->cod) selected  @endif>{{$servico->cod}} - {{$servico->servico}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Regime Especial de Tributação</label>
                                <select  class="form-control form-control-sm" name="cRegTrib" id="cRegTrib">

                                        <option value="1" @if($registro->cRegTrib == '1') selected  @endif>1=Microempresa Municipal</option>
                                        <option value="2" @if($registro->cRegTrib == '2') selected  @endif>2=Estimativa</option>
                                        <option value="3" @if($registro->cRegTrib == '3') selected  @endif>3=Sociedade de Profissionais</option>
                                        <option value="4" @if($registro->cRegTrib == '4') selected  @endif>4=Cooperativa</option>
                                        <option value="5" @if($registro->cRegTrib == '5') selected  @endif>5=Microempresário Individual (MEI)</option>
                                        <option value="6" @if($registro->cRegTrib == '6') selected  @endif>6=Microempresário e Empresa de Pequeno Porte (ME/EPP) </option>

                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Codigo do UF</label>
                                <select  class="form-control form-control-sm" name="cUF">
                                    <option value='11'@if($registro->cUF == '11') selected  @endif>RO</option>
                                    <option value='12'@if($registro->cUF == '12') selected  @endif>AC</option>
                                    <option value='13'@if($registro->cUF == '13') selected  @endif>AM</option>
                                    <option value='14'@if($registro->cUF == '14') selected  @endif>RR</option>
                                    <option value='15'@if($registro->cUF == '15') selected  @endif>PA</option>
                                    <option value='16'@if($registro->cUF == '16') selected  @endif>AP</option>
                                    <option value='17'@if($registro->cUF == '17') selected  @endif>TO</option>
                                    <option value='21'@if($registro->cUF == '21') selected  @endif>MA</option>
                                    <option value='22'@if($registro->cUF == '22') selected  @endif>PI</option>
                                    <option value='23'@if($registro->cUF == '23') selected  @endif>CE</option>
                                    <option value='24'@if($registro->cUF == '24') selected  @endif>RN</option>
                                    <option value='25'@if($registro->cUF == '25') selected  @endif>PB</option>
                                    <option value='26'@if($registro->cUF == '26') selected  @endif>PE</option>
                                    <option value='27'@if($registro->cUF == '27') selected  @endif>AL</option>
                                    <option value='28'@if($registro->cUF == '28') selected  @endif>SE</option>
                                    <option value='29'@if($registro->cUF == '29') selected  @endif>BA</option>
                                    <option value='31'@if($registro->cUF == '31') selected  @endif>MG</option>
                                    <option value='32'@if($registro->cUF == '32') selected  @endif>ES</option>
                                    <option value='33'@if($registro->cUF == '33') selected  @endif>RJ</option>
                                    <option value='35'@if($registro->cUF == '35') selected  @endif>SP</option>
                                    <option value='41'@if($registro->cUF == '41') selected  @endif>PR</option>
                                    <option value='42'@if($registro->cUF == '42') selected  @endif>SC</option>
                                    <option value='43'@if($registro->cUF == '43') selected  @endif>RS</option>
                                    <option value='50'@if($registro->cUF == '50') selected  @endif>MS</option>
                                    <option value='51'@if($registro->cUF == '51') selected  @endif>MT</option>
                                    <option value='52'@if($registro->cUF == '52') selected  @endif>GO</option>
                                    <option value='53'@if($registro->cUF == '53') selected  @endif>DF</option>
                                </select>
                            </div>
                        </div>


                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Natureza da Operação</label>
                                <select  class="form-control form-control-sm" name="natOp">
                                    <option value="Venda"@if($registro->natOp == 'Venda') selected  @endif>Venda</option>
                                    <option value="Compra"@if($registro->natOp == 'Compra') selected  @endif>Compra</option>
                                    <option value="Transferência"@if($registro->natOp == 'Transferência') selected  @endif>Transferência</option>
                                    <option value="Devolução"@if($registro->natOp == 'Devolução') selected  @endif>Devolução</option>
                                    <option value="Importação"@if($registro->natOp == 'Importação') selected  @endif>Importação</option>
                                    <option value="Consignação"@if($registro->natOp == 'Consignação') selected  @endif>Consignação</option>
                                    <option value="Remessa"@if($registro->natOp == 'Remessa') selected  @endif>Remessa</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Modelo</label>
                                <select  class="form-control form-control-sm" name="mod">
                                    <option value="55"@if($registro->mod == '55') selected  @endif>NFE</option>
                                    <option value="65"@if($registro->mod == '65') selected  @endif>NFCE</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Serie</label>
                                <input type="number" class="form-control form-control-sm" name="serie"  value="{{$registro->serie}}">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Número da NF</label>
                                <input type="number" class="form-control form-control-sm" name="nNF"  value="{{$registro->nNF}}">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Tipo de Operação</label>
                                <select  class="form-control form-control-sm" name="tpNF">
                                    <option value="0"@if($registro->tpNF == '0') selected  @endif>0-Entrada</option>
                                    <option value="1"@if($registro->tpNF == '1') selected  @endif>1-Saída</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Destino da Operação</label>
                                <select  class="form-control form-control-sm" name="idDest">
                                    <option value="1"@if($registro->idDest == '1') selected  @endif>1-Operação Interna</option>
                                    <option value="2"@if($registro->idDest == '2') selected  @endif>2-Operação Interestadual</option>
                                    <option value="3"@if($registro->idDest == '3') selected  @endif>3-Operação com Exterior</option>
                                </select>
                            </div>
                        </div>


                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Codigo Municipio</label>
                                <select  class="form-control form-control-sm" name="cMunFG" id="cMunFG">
                                    @foreach($municipios as $municipio)

                                        <option value="{{$municipio->id}}" @if($registro->cMunFG == $municipio->id) selected  @endif>{{$municipio->id}} - {{$municipio->municipio}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Tipo de Impressão</label>
                                <select  class="form-control form-control-sm" name="tpImp">
                                     <option value="0" @if($registro->tpImp == '0') selected  @endif>Sem geração de DANFE</option>
                                     <option value="1" @if($registro->tpImp == '1') selected  @endif>DANFE normal, Retrato</option>
                                     <option value="2" @if($registro->tpImp == '2') selected  @endif>DANFE normal, Paisagem</option>
                                     <option value="3" @if($registro->tpImp == '3') selected  @endif>DANFE Simplificado</option>
                                     <option value="4" @if($registro->tpImp == '4') selected  @endif>DANFE NFC-e</option>
                                     <option value="5" @if($registro->tpImp == '5') selected  @endif>DANFE NFC-e em mensagem eletrônica</option>

                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Tipo de Emissão</label>
                                <select  class="form-control form-control-sm" name="tpEmis">

                                    <option value="1"@if($registro->tpEmis == '1') selected  @endif>Emissão normal</option>
                                    <option value="2"@if($registro->tpEmis == '2') selected  @endif>Contingência FS-IA, com impressão do DANFE em formulário de segurança</option>
                                    <option value="3"@if($registro->tpEmis == '3') selected  @endif>Contingência SCAN (Sistema de Contingência do Ambiente Nacional);</option>
                                    <option value="4"@if($registro->tpEmis == '4') selected  @endif>Contingência DPEC (Declaração Prévia da Emissão em Contingência)</option>
                                    <option value="5"@if($registro->tpEmis == '5') selected  @endif>Contingência FS-DA, com impressão do DANFE em formulário de segurança</option>
                                    <option value="6"@if($registro->tpEmis == '6') selected  @endif>Contingência SVC-AN (SEFAZ Virtual de Contingência do AN)</option>
                                    <option value="7"@if($registro->tpEmis == '7') selected  @endif>Contingência SVC-RS (SEFAZ Virtual de Contingência do RS)</option>
                                    <option value="9"@if($registro->tpEmis == '9') selected  @endif>Contingência off-line da NFC-e</option>

                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Ambiente</label>
                                <select  class="form-control form-control-sm" name="tpAmb">
                                    <option value="1"@if($registro->tpAmb == '1') selected  @endif>1-Produção</option>
                                    <option value="2"@if($registro->tpAmb == '2') selected  @endif>2-Homologação</option>

                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Finalidade</label>
                                <select  class="form-control form-control-sm" name="finNFe">
                                    <option value="1"@if($registro->finNFe == '1') selected  @endif>1-NF-e normal</option>
                                    <option value="2"@if($registro->finNFe == '2') selected  @endif>2-NF-e complementar</option>
                                    <option value="3"@if($registro->finNFe == '3') selected  @endif>3-NF-e de ajuste</option>
                                    <option value="4"@if($registro->finNFe == '4') selected  @endif>4-Devolução de mercadoria</option>

                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Consumidor Final</label>
                                <select  class="form-control form-control-sm" name="indFinal">
                                    <option value="0"@if($registro->indFinal == '0') selected  @endif>1-Normal</option>
                                    <option value="1"@if($registro->indFinal == '1') selected  @endif>2-Consumidor Final</option>


                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Consumidor Presencial</label>
                                <select  class="form-control form-control-sm" name="indPres">
                                    <option value="0"@if($registro->indPres == '0') selected  @endif>0-Não se aplica</option>
                                    <option value="1"@if($registro->indPres == '1') selected  @endif>1-Operação presencial</option>
                                    <option value="2"@if($registro->indPres == '2') selected  @endif>2-Operação não presencial, pela Internet</option>
                                    <option value="3"@if($registro->indPres == '3') selected  @endif>3-Operação não presencial, Teleatendimento</option>
                                    <option value="4"@if($registro->indPres == '4') selected  @endif>4-NFC-e em operação com entrega a domicílio</option>
                                    <option value="9"@if($registro->indPres == '9') selected  @endif>9-Operação não presencial, outros</option>


                                </select>
                            </div>
                        </div>


                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Data Contigência</label>
                                <input type="datetime-local" class="form-control form-control-sm" name="dhCont"  value="{{$registro->dhCont}}">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Justificativa</label>
                                <input type="text" class="form-control form-control-sm" name="xJust"  value="{{$registro->xJust}}">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>CRT</label>
                                <select  class="form-control form-control-sm" name="CRT">
                                    <option value="1"@if($registro->CRT == '1') selected  @endif>1-Simples Nacional</option>
                                    <option value="2"@if($registro->CRT == '2') selected  @endif>2-Simples Nacional, excesso sublimite de receita bruta</option>
                                    <option value="3"@if($registro->CRT == '3') selected  @endif>3-Regime Normal</option>


                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>CNAE (Opcional)</label>
                                <input type="text" class="form-control form-control-sm" name="CNAE"  value="{{$registro->CNAE}}">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Validade do Certificado</label>
                                <input type="date" class="form-control form-control-sm" name="validade_certificado"  value="{{$registro->validade_certificado}}">
                            </div>
                        </div>



                    </div>


                </div>
                <div class="tab-pane" id="kt_portlet_base_demo_1_3_tab_content" role="tabpanel">
                    <div class="row">
                        <div class="col-md-12">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Observações</label>
                                <input type="text" class="form-control form-control-sm" name="observacoes"  value="{{$registro->observacoes}}">
                            </div>
                        </div>


                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Desativar</label>

                                <button type="button" class="btn btn-danger btn-block" data-toggle="modal" data-target="#exampleModal">
                                   DESATIVAR
                                </button>


                            </div>
                        </div>

                    </div>
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
                    <p>Confirma a Desativação Deste Empresa?</p>
                </div>
                <div class="modal-footer">
                    <a href="{{route('empresas.destroy', $registro->id)}}" class="btn btn-danger" onclick="event.preventDefault();
                                                     document.getElementById('delete-form').submit();">Desativar</a>

                    <form id="delete-form" action="{{ route('empresas.destroy', $registro->id) }}" method="POST" style="display: none;">
                        @csrf
                        <input type="hidden" name="_method" value="DELETE">
                    </form>



                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Voltar</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('posScript')



@endsection

