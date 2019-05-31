<?php

namespace App\Http\Controllers;

use App\Models\Clientes\Cliente;
use App\Models\Empresas\Empresa;
use App\Models\Nfces\Nfce;
use App\Models\Nfces\NfceDetalhe;
use App\Models\Pagamentos\Pagamento;
use App\Models\Forma_Pagamentos\Forma_Pagamento;
use App\Models\Vendas\Venda;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use NFePHP\Common\Certificate;
use NFePHP\DA\NFe\Danfce;
use NFePHP\DA\NFe\Danfe;
use NFePHP\NFe\Common\Standardize;
use NFePHP\NFe\Common\Tools;
use NFePHP\NFe\Complements;
use NFePHP\NFe\Make;
use phpDocumentor\Reflection\Types\Self_;
use DB;

class NfceController extends AppController
{
    //
    public $model = Nfce::class;

    protected $make;
    protected $tools;
    protected $certificado;
    protected $config;
    protected $xml;
    protected $xmlAssinado;
    protected $tool;
    protected $recibo;
    public $registro;

    public $total_pis = 0;
    public $total_cofins = 0;
    public $total_iss = 0;

    /**
     * NfceController constructor.
     * @param $make
     */
    public function __construct()
    {

        $instace = new $this->model;

        $this->name = $instace->getTable();
        $this->make =  new Make();

        $empresa = Empresa::where('id', 1)->get()[0]; //todo substituir para obter a empresa logada

        self::tools($empresa);

    }




    public function taginfNFe($empresa){

        $std = new \stdClass();
        $std->versao = $empresa->versao; //versão do layout
        //$std->Id = null;//se o Id de 44 digitos não for passado será gerado automaticamente
        $std->pk_nItem = null; //deixe essa variavel sempre como NULL

        $nfe = $this->make->taginfNFe($std);


    }

    public function tagide($empresa, $venda){

        $std = new \stdClass();
        $std->cUF = $empresa->cUF;                  //Código da UF do emitente do Documento Fiscal
        $std->cNF = $venda->id;          //Código numérico que compõe a Chave de Acesso
        $std->natOp = $empresa->natOp;           // natureza da operação  venda, compra, transferência, devolução
        //$std->indPag = 0;              //NÃO EXISTE MAIS NA VERSÃO 4.00
        $std->mod = $empresa->mod;                  //55 NFE OU 65 NFCE
        $std->serie = $empresa->serie;                 //Série do Documento Fiscal
        $std->nNF = $empresa->nNF;                   //Número do Documento Fiscal.
        $std->dhEmi = date(DATE_ATOM); //Data e hora de emissão do Documento
        $std->dhSaiEnt = null;           //Data e hora de Saída ou da Entrada
        $std->tpNF = $empresa->tpNF;                  //Tipo de Operação 0=Entrada 1=Saída
        $std->idDest = $empresa->idDest;                //1=Operação interna; 2=Operação interestadual; 3=Operação com exterior
        $std->cMunFG = $empresa->cMunFG;          //Código do Município de Ocorrência do Fato Gerador
        $std->tpImp = $empresa->tpImp;                 //0=Sem geração de DANFE;1=DANFE normal, Retrato;2=DANFE normal, Paisagem;3=DANFE Simplificado;4=DANFE NFC-e;5=DANFE NFC-e em mensagem eletrônica
        $std->tpEmis = $empresa->tpEmis;                //1=Emissão normal (não em contingência); 2=Contingência FS-IA, com impressão do DANFE em formulário de segurança; 3=Contingência SCAN (Sistema de Contingência do AmbienteNacional);4=Contingência DPEC (Declaração Prévia da Emissão em Contingência);5=Contingência FS-DA, com impressão do DANFE em formulário de segurança;6=Contingência SVC-AN (SEFAZ Virtual de Contingência do AN); 7=Contingência SVC-RS (SEFAZ Virtual de Contingência do RS);
        $std->cDV = 1;                   //Dígito Verificador da Chave de Acesso da
        $std->tpAmb = $empresa->tpAmb;                 //Identificação do Ambiente 1=Produção/2=Homologação
        $std->finNFe = $empresa->finNFe;                //Finalidade de emissão da NF-e 1=NF-e normal; 2=NF-e complementar; 3=NF-e de ajuste; 4=Devolução de mercadoria.
        $std->indFinal = $empresa->indFinal;              //Indica operação com Consumidor final 0=Normal;  1=Consumidor final;
        $std->indPres = $empresa->indPres;               //Indicador de presença do comprador no estabelecimento comercial 0=Não se aplica (por exemplo, Nota Fiscal complementar ou de ajuste);1=Operação presencial;2=Operação não presencial, pela Internet;3=Operação não presencial, Teleatendimento;4=NFC-e em operação com entrega a domicílio;9=Operação não presencial, outros.
        $std->procEmi = 0;               //0=Emissão de NF-e com aplicativo do contribuinte;1=Emissão de NF-e avulsa pelo Fisco;2=Emissão de NF-e avulsa, pelo contribuinte com seu certificado digital, através do site do Fisco; 3=Emissão NF-e pelo contribuinte com aplicativo fornecido pelo Fisco
        $std->verProc ='2.01.01';        //Versão do Processo de emissão da NF-e
        $std->dhCont = $empresa->dhCont;             //Data e Hora da entrada em contingência
        $std->xJust = $empresa->xJust;              //Justificativa da entrada em contingência

        $nfe = $this->make->tagide($std);

    }


    public function tagemit($empresa){

        $std = new \stdClass();
        $std->xNome  = $empresa->razao_social;
        $std->xFant = $empresa->nome_fantasia;
        $std->IE = $empresa->ie;
        $std->IEST = null;
        $std->IM = $empresa->im;
        $std->CNAE = $empresa->cnae;
        $std->CRT = $empresa->CRT;  //Código de Regime Tributário 1=Simples Nacional; 2=Simples Nacional, excesso sublimite de receita bruta; 3=Regime Normal. (v2.0).
        $std->CNPJ = $empresa->cnpj; //indicar apenas um CNPJ ou CPF
        //$std->CPF;

        $nfe = $this->make->tagemit($std);


    }

    public function tagenderEmit($empresa){

        $municipio = DB::table('municipios')->where('id',$empresa->cMunFG)->get();

        $std = new \stdClass();
        $std->xLgr = $empresa->endereco;
        $std->nro = $empresa->numero;
        $std->xCpl = $empresa->complemento;
        $std->xBairro = $empresa->bairro;
        $std->cMun = $empresa->cMunFG; //código do municipio tabela IBGE
        $std->xMun = $municipio[0]->municipio;//nome do municipio
        $std->UF = $municipio[0]->uf;
        $std->CEP = $empresa->cep;
        $std->cPais = 1058;
        $std->xPais = 'BRASIL';
        $std->fone = str_replace(['-','(',')',' '],['','','',''], $empresa->telefone);

        $nfe = $this->make->tagenderEmit($std);
    }

    public function tagdest($cpf_cnpj){

        $std = new \stdClass();
        //$std->xNome = null;
        //$std->indIEDest = null; //Indicador da IE do Destinatário (1=Contribuinte ICMS (informar a IE do destinatário); 2=Contribuinte isento de Inscrição no cadastro de Contribuintes 9=Não Contribuinte Nota 1: No caso de NFC-e informar indIEDest=9 e não informar a tag IE do destinatário;
        //$std->IE = null;
        //$std->ISUF = null;
        //$std->IM = null;
        //$std->email = null;
        if(strlen($cpf_cnpj) == 14){
            $std->CNPJ = $cpf_cnpj; //indicar apenas um CNPJ ou CPF ou idEstrangeiro
        }else{
            $std->CPF = $cpf_cnpj;
        }
        //$std->idEstrangeiro = null;

        $nfe = $this->make->tagdest($std);
    }


    /*public function tagenderDest($cliente){

        $std = new \stdClass();
        $std->xLgr = $cliente->endereco;
        $std->nro = $cliente->numero;
        $std->xCpl = $cliente->complemento;
        $std->xBairro = $cliente->bairro;
        $std->cMun = null;
        $std->xMun = null;
        $std->UF = $cliente->estado;
        $std->CEP = $cliente->cep;
        $std->cPais = 1058;
        $std->xPais = 'BRASIL';
        $std->fone = $cliente->telefone;

        $nfe = $this->make->tagenderDest($std);
    }*/


    public function tagprod($item){


        $std = new \stdClass();
        $std->item = $item->sequencial; //item da NFe
        $std->cProd = $item->produto_id;
        $std->cEAN = 'SEM GTIN';
        $std->xProd = substr($item->produto->nome, 0, 120);
        $std->NCM = $item->produto->codigo_ncm;

        $std->cBenef = null; //incluido no layout 4.00 obrigatorio para o estado do Paraná somente empresas não optantes pelo simples nacional

        $std->EXTIPI = $item->produto->codigo_ex_tipi;
        $std->CFOP = $item->produto->codigo_cfop;
        $std->uCom = 'UN';
        $std->qCom = $item->qtd;
        $std->vUnCom = number_format($item->valor_unitario,2,'.','');
        $std->vProd = number_format($item->sub_total,2,'.','');
        $std->cEANTrib = 'SEM GTIN';
        $std->uTrib = 'UN';
        $std->qTrib = $item->qtd;
        $std->vUnTrib = number_format($item->valor_unitario,2,'.','');
        $std->vFrete = null;
        $std->vSeg = null;
        if ($item->desconto == '0.0') {
            $std->vDesc = null;
        }else{
            $std->vDesc = number_format($item->desconto,2,'.','');
        }
        $std->vOutro = null;
        $std->indTot = 1;
        $std->xPed = null;
        $std->nItemPed = null;
        $std->nFCI = null;



        $nfe = $this->make->tagprod($std);

    }

    public function tagICMS(){

        $std = new \stdClass();
        $std->item = 1; //item da NFe
        $std->orig = null;
        $std->CST = null;
        $std->modBC = null;
        $std->vBC = null;
        $std->pICMS = null;
        $std->vICMS = null;
        $std->pFCP = null;
        $std->vFCP = null;
        $std->vBCFCP = null;
        $std->modBCST = null;
        $std->pMVAST = null;
        $std->pRedBCST = null;
        $std->vBCST = null;
        $std->pICMSST = null;
        $std->vICMSST = null;
        $std->vBCFCPST = null;
        $std->pFCPST = null;
        $std->vFCPST = null;
        $std->vICMSDeson = null;
        $std->motDesICMS = null;
        $std->pRedBC = null;
        $std->vICMSOp = null;
        $std->pDif = null;
        $std->vICMSDif = null;
        $std->vBCSTRet = null;
        $std->pST = null;
        $std->vICMSSTRet = null;
        $std->vBCFCPSTRet = null;
        $std->pFCPSTRet = null;
        $std->vFCPSTRet = null;
        $std->pRedBCEfet = null;
        $std->vBCEfet = null;
        $std->pICMSEfet = null;
        $std->vICMSEfet = null;
        $std->vICMSSubstituto = null; //NT2018.005_1.10_Fevereiro de 2019

        $nfe = $this->make->tagICMS($std);


    }

    public function tagICMSSN() {

        $std = new \stdClass();
        $std->item = 1; //item da NFe
        $std->orig = 0;
        $std->CSOSN = '101';
        $std->pCredSN = 2.00;
        $std->vCredICMSSN = 20.00;
        $std->modBCST = null;
        $std->pMVAST = null;
        $std->pRedBCST = null;
        $std->vBCST = null;
        $std->pICMSST = null;
        $std->vICMSST = null;
        $std->vBCFCPST = null; //incluso no layout 4.00
        $std->pFCPST = null; //incluso no layout 4.00
        $std->vFCPST = null; //incluso no layout 4.00
        $std->vBCSTRet = null;
        $std->pST = null;
        $std->vICMSSTRet = null;
        $std->vBCFCPSTRet = null; //incluso no layout 4.00
        $std->pFCPSTRet = null; //incluso no layout 4.00
        $std->vFCPSTRet = null; //incluso no layout 4.00
        $std->modBC = null;
        $std->vBC = null;
        $std->pRedBC = null;
        $std->pICMS = null;
        $std->vICMS = null;
        $std->pRedBCEfet = null;
        $std->vBCEfet = null;
        $std->pICMSEfet = null;
        $std->vICMSEfet = null;
        $std->vICMSSubstituto = null;

        $nfe = $this->make->tagICMSSN($std);
    }


    public function tagIPI() {

        $std = new \stdClass();
        $std->item = 1; //item da NFe
        $std->clEnq = null;
        $std->CNPJProd = null;
        $std->cSelo = null;
        $std->qSelo = null;
        $std->cEnq = '999';
        $std->CST = '50';
        $std->vIPI = 150.00;
        $std->vBC = 1000.00;
        $std->pIPI = 15.00;
        $std->qUnid = null;
        $std->vUnid = null;

        $nfe = $this->make->tagIPI($std);
    }


    public function tagPIS($item){

        $std = new \stdClass();
        $std->item = $item->sequencial; //item da NFe
        $std->CST = '07';
        $std->vBC = number_format($item->valor_total,2,'.','');
        $std->pPIS = 0.65;
        $std->vPIS = number_format(($item->valor_total  * 0.0065),2,'.','');
          $this->total_pis += 0.00; //number_format(($item->valor_total  * 0.0065),2,'.','');
        $std->qBCProd = $item->quantidade;
        $std->vAliqProd = null;

        $nfe = $this->make->tagPIS($std);
    }

    public function tagCOFINS($item) {

        $std = new \stdClass();
        $std->item = $item->sequencial; //item da NFe
        $std->CST = '07';
        $std->vBC = number_format($item->valor_total,2,'.','');
        $std->pCOFINS = 3.00;
        $std->vCOFINS = number_format(($item->valor_total * 0.03) ,2,'.','') ;
          $this->total_cofins += 0.00; //number_format(($item->valor_total  * 0.03),2,'.','');
        $std->qBCProd = $item->quantidade;
        $std->vAliqProd = null;

        $nfe = $this->make->tagCOFINS($std);
    }


    public function tagISSQN($item, $empresa) {

        $std = new \stdClass();
        $std->item = $item->sequencial; //item da NFe
        $std->vBC = number_format($item->valor_total,2,'.','');
        $std->vAliq = 0.00;
        $std->vISSQN = number_format(($item->valor_total * 0.00),2,'.','');
          $this->total_iss += number_format(($item->valor_total  * 0.00),2,'.','');
        $std->cMunFG = $empresa->cMunFG;
        $std->cListServ = $empresa->cListServ;
        $std->vDeducao = null;
        $std->vOutro = null;
        $std->vDescIncond = null;
        $std->vDescCond = null;
        $std->vISSRet = null;
        $std->indISS = 1;
        $std->cServico = $item->produto_id;
        $std->cMun = $empresa->cMunFG;
        $std->cPais = '1058';
        $std->nProcesso = null;
        $std->indIncentivo = 2;

        $nfe = $this->make->tagISSQN($std);
    }

    public function tagICMSTot($venda) {

        //NOTA: Esta tag não necessita que sejam passados valores, pois a classe irá calcular esses totais e irá usar essa totalização para complementar e gerar esse node, caso nenhum valor seja passado como parâmetro.

        $std = new \stdClass();
//        $std->vServ = number_format($venda->total_venda_bruto ,2,'.','') ;
        $std->vBC = 0.00;
        $std->vICMS = 0.00;
        $std->vICMSDesonv = 0.00;
        //$std->vFCP = 1000.00; //incluso no layout 4.00
        $std->vBCST = 0.00;
        $std->vST = 0.00;
        //$std->vFCPST = 1000.00; //incluso no layout 4.00
        //$std->vFCPSTRet = 1000.00; //incluso no layout 4.00
        $std->vProd = '0.00';
        $std->vFrete = 0.00;
        $std->vSeg = 0.00;
        $std->vDesc = 0.00; //number_format($venda->desconto,2,'.','');
        $std->vII = 0.00;
        $std->vIPI = 0.00;
        //$std->vIPIDevol = 1000.00; //incluso no layout 4.00
        $std->vPIS = '0.00';
        $std->vCOFINS = '0.00';
        $std->vOutro = 0.00;
        $std->vNF = number_format($venda->total_venda_liquido ,2,'.','') ;
        $std->vTotTrib = 0.00;

        $nfe = $this->make->tagICMSTot($std);

    }


    public function tagISSQNTot($venda, $empresa){

        //NOTA: caso os valores não existam indique "null". Se for indocado 0.00 esse numero será incluso no XML o que poderá causar sua rejeição.

        $std = new \stdClass();
        $std->vServ = number_format($venda->total_venda_bruto ,2,'.','') ;
        $std->vBC = number_format($venda->total_venda_liquido ,2,'.','') ;
        //$std->vISS = number_format($this->total_iss ,2,'.','') ;
        //$std->vPIS = number_format($this->total_pis ,2,'.','') ;
        //$std->vCOFINS = number_format($this->total_cofins ,2,'.','') ;
        $std->dCompet = date('Y-m-d');
        $std->vDeducao = null;
        $std->vOutro = null;
        $std->vDescIncond = null;
        $std->vDescCond = null;
        $std->vISSRet = null;
        $std->cRegTrib = $empresa->cRegTrib;

        $nfe = $this->make->tagISSQNTot($std);
    }

    public function tagfat(){

        $std = new \stdClass();
        $std->nFat = '1233';
        $std->vOrig = 1254.22;
        $std->vDesc = null;
        $std->vLiq = 1254.22;

        $nfe = $this->make->tagfat($std);

    }

    public function tagdup(){

        $std = new \stdClass();
        $std->nDup = '1233-1';
        $std->dVenc = '2017-08-22';
        $std->vDup = 1254.22;

        $nfe = $this->make->tagdup($std);;

    }

    public function tagpag(){

        $std = new \stdClass();
        $std->vTroco = null; //incluso no layout 4.00, obrigatório informar para NFCe (65)

        $nfe = $this->make->tagpag($std);
    }

    public function tagdetPag($pagamento) {

        $pagament = Pagamento::where('id', $pagamento->id)->with('forma_pagamentos')->get();

        dd($pagament);

        $std = new \stdClass();
        $std->tPag = $pagamento->Formas->tPag;
        $std->vPag = number_format($pagamento->valor ,2,'.','') ; //Obs: deve ser informado o valor pago pelo cliente
        //$std->CNPJ = '12345678901234';
        $std->tBand = $pagamento->Formas->tBand;
        //$std->cAut = '3333333';
        $std->tpIntegra = 2; //incluso na NT 2015/002
        if ($pagamento->parcelas == 1) {
            $std->indPag = '0'; //0= Pagamento à Vista 1= Pagamento à Prazo
        } else {
            $std->indPag = '1'; //0= Pagamento à Vista 1= Pagamento à Prazo
        }


        $nfe = $this->make->tagdetPag($std);
    }


    public function tagimposto($item) {

        $std = new \stdClass();
        $std->item = $item->sequencial; //item da NFe
        $std->vTotTrib = 0.00; //(number_format(($item->valor_total * 0.05),2,'.',''));

        $nfe = $this->make->tagimposto($std);
    }

    public function tagtransp(){

        $std = new \stdClass();
        $std->modFrete = 9;

        $nfe = $this->make->tagtransp($std);
    }

    public function tools($empresa){

        $certificado =  Storage::get('public/arquivos/empresa_id_'. $empresa->id .'/'.$empresa->certificado);


        $this->certificado = Certificate::readPfx($certificado, $empresa->senha);

        $caracteres = array('.','/','-');
        $substitutos = array('','','');

        $cnpj = str_replace($caracteres,$substitutos,$empresa->cnpj);


        $config = [
            "atualizacao" => date("Y-m-d H:i:s"),
            "tpAmb" => (int) $empresa->tpAmb,
            "razaosocial" => $empresa->razao_social,
            "siglaUF" => $empresa->estado,
            "cnpj" => $cnpj,
            "schemes" => "PL_008i2",
            "versao" => $empresa->versao,
            "tokenIBPT" => $empresa->csc,
            "tokenNFCe" => $empresa->csc,
            "CSC" => $empresa->csc,
            "CSCid" => $empresa->csc_id,
            "tokenNFCeId" => $empresa->csc_id,
            "aProxyConf" => [
                "proxyIp" => "",
                "proxyPort" => "",
                "proxyUser" => "",
                "proxyPass" => ""
            ]
        ];

        $this->config = json_encode($config);


        $this->tools = new Tools($this->config, $this->certificado);

        $this->tools->Model($empresa->mod);


    }

    public function assina($empresa, $venda){


        if( is_numeric($empresa)){


            $empresa = Empresa::where('id', $empresa)->get()[0];
            $venda = Venda::where('id', $venda)->with('cliente','itens','pagamentos')->get()[0];

        }


        $nfce = Nfce::where('venda_id', $venda->id)->get()[0];
        $xml = Storage::get('public/arquivos/empresa_id_'. $empresa->id .'/'.'xml/'.$nfce->mesAno .'/'.$nfce->arquivo.'.xml');



        $this->xmlAssinado = $this->tools->signNFe($xml);


        //obtem a chave para salvar como nome do arquivo
        $nome = $nfce->arquivo;
        //variavel com o mesAno para criar a pasta onde será salvo os arquivos
        $mesAno = date('MY');

        Storage::put('public/arquivos/empresa_id_'. $empresa->id .'/'.'xml/'.$mesAno .'/Assinados/'.$nome.'-assinado.xml', $this->xmlAssinado);


        $nfce = Nfce::where('venda_id', $venda->id)->get()[0];

        $detalhes = NfceDetalhe::create([
            'venda_id' => $venda->id,
            'nfce_id' => $nfce->id,
            'status' => '2 - XML Assinado',
        ]);


    }

    public function montaxml($empresa, $venda){

        $result = $this->make->monta();



        if($result){
            //gera o XML
            $this->xml = $this->make->getXML();
            //obtem a chave para salvar como nome do arquivo
            $nome = $this->make->chNFe;
            //variavel com o mesAno para criar a pasta onde será salvo os arquivos
            $mesAno = date('MY');
            //salva o arquivo
            Storage::put('public/arquivos/empresa_id_'. $empresa->id .'/'.'xml/'.$mesAno .'/'.$nome.'.xml', $this->xml);
            //atualiza a tabela de nfces
            $this->registro = new $this->model([
                'venda_id' => $venda->id,
                'xml_assinado' => 'public/arquivos/empresa_id_'. $empresa->id .'/'.'xml/'.$mesAno .'/'.$nome.'.xml', $this->xml,
                'valor' => $venda->total_venda_liquido,
                'status' => '1 - XML Gerado',
                'mesAno' => $mesAno,
                'arquivo' => $nome,
            ]);
            $this->registro->save();

            $detalhes = NfceDetalhe::create([
                'venda_id' => $venda->id,
                'nfce_id' => $this->registro->id,
                'status' => '1 - XML Gerado',
            ]);


        }
    }

    public function envia($venda, $empresa){

        $this->tool = new \NFePHP\NFe\Tools($this->config, $this->certificado);
        $this->tool->Model($empresa->mod);
        $this->tool->tpAmb = $empresa->tpAmb;

        $nfce = Nfce::where('venda_id', $venda->id)->get()[0];

        $xmlAssinado = Storage::get('public/arquivos/empresa_id_'. $empresa->id .'/'.'xml/'.$nfce->mesAno .'/Assinados/'.$nfce->arquivo.'-assinado.xml');



        try {



            $idLote = str_pad($venda->id, 15, '0', STR_PAD_LEFT);
            //envia o xml para pedir autorização ao SEFAZ
            $resp = $this->tool->sefazEnviaLote([$xmlAssinado], $idLote);
            //transforma o xml de retorno em um stdClass
            $st = new Standardize();
            $std = $st->toStd($resp);
            if ($std->cStat != 103) {
                //erro registrar e voltar
                return "[$std->cStat] $std->xMotivo";
            }
            $recibo = $std->infRec->nRec;
            //esse recibo deve ser guardado para a proxima operação que é a consulta do recibo


            $nfce->update([
                'status' => '2 - XML Enviado',
                'recibo' => $recibo,
            ]);




            $detalhes = NfceDetalhe::create([
                'venda_id' => $venda->id,
                'nfce_id' => $nfce->id,
                'status' => '3 - SUCCESSO na no Envio',
                'descricao' => $resp,
            ]);


            /*header('Content-type: text/xml; charset=UTF-8');
            echo $resp;*/

            return $resp;

        } catch (\Exception $e) {


            $nfce = Nfce::where('venda_id', $venda->id)->get()[0];

            $detalhes = NfceDetalhe::create([
                'venda_id' => $venda->id,
                'nfce_id' => $nfce->id,
                'status' => '3 - ERRO na Tentativa de Envio',
                'descricao' => $e->getMessage(),
            ]);

            return str_replace("\n", "<br/>", $e->getMessage());





        }
    }

    public function consulta($venda, $empresa, $recibo){

        $tool = new \NFePHP\NFe\Tools($this->config, $this->certificado);
        $tool->Model($empresa->mod);
        $tool->tpAmb = $empresa->tpAmb;



        try {


            //consulta número de recibo
            //$numeroRecibo = número do recíbo do envio do lote
            $xmlResp = $tool->sefazConsultaRecibo($recibo, $empresa->tpAmb);


            //transforma o xml de retorno em um stdClass
            $st = new Standardize();
            $std = $st->toStd($xmlResp);

            if($std->cStat=='103') { //lote enviado
                //Lote ainda não foi precessado pela SEFAZ;
                $nfce = Nfce::where('venda_id', $venda->id)->get()[0];

                $detalhes = NfceDetalhe::create([
                    'venda_id' => $venda->id,
                    'nfce_id' => $nfce->id,
                    'status' => '4 - CONSULTA - Lote ainda não foi processado',

                ]);

                return ["situacao"=>"Enviado",
                    "numeroProtocolo"=>$std->protNFe->infProt->nProt,
                    "xmlProtocolo"=>$xmlResp];
            }
            if($std->cStat=='105') { //lote em processamento
                //tente novamente mais tarde
                $nfce = Nfce::where('venda_id', $venda->id)->get()[0];

                $detalhes = NfceDetalhe::create([
                    'venda_id' => $venda->id,
                    'nfce_id' => $nfce->id,
                    'status' => '4 - CONSULTA - Em Processamento',
                    'descricao' => $xmlResp,

                ]);



                return ["situacao"=>"Em Processamento",
                    "numeroProtocolo"=>$std->protNFe->infProt->nProt,
                    "xmlProtocolo"=>$xmlResp];
            }

            if($std->cStat=='104'){ //lote processado (tudo ok)
                if($std->protNFe->infProt->cStat=='100'){ //Autorizado o uso da NF-e

                    $nfce = Nfce::where('venda_id', $venda->id)->get()[0];

                    $detalhes = NfceDetalhe::create([
                        'venda_id' => $venda->id,
                        'nfce_id' => $nfce->id,
                        'status' => '4 - OK - Autorizado uso',
                        'descricao' => $xmlResp,

                    ]);


                    $empresa->update([
                        'nNF' => $empresa->nNF +1,
                    ]);


                    $pdf = self::autoriza($nfce, $empresa);



                    $nfce->update([
                        'status' => '4 - OK - Autorizado uso',
                        'nfce_pdf' => 'public/arquivos/empresa_id_'. $empresa->id .'/'.'xml/'.$nfce->mesAno .'/PDFs/'.$nfce->arquivo.'.pdf'
                    ]);




                    /*return ["situacao"=>"autorizada",
                        "numeroProtocolo"=>$std->protNFe->infProt->nProt,
                        "xmlProtocolo"=>$xmlResp];*/


                }elseif(in_array($std->protNFe->infProt->cStat,["302"])){ //DENEGADAS

                    $nfce = Nfce::where('venda_id', $venda->id)->get()[0];

                    $detalhes = NfceDetalhe::create([
                        'venda_id' => $venda->id,
                        'nfce_id' => $nfce->id,
                        'status' => '4 - NEGADO - Denegado uso',
                        'descricao' => $std->protNFe->infProt->xMotivo,


                    ]);

                    return ["situacao"=>"denegada",
                        "numeroProtocolo"=>$std->protNFe->infProt->nProt,
                        "motivo"=>$std->protNFe->infProt->xMotivo,
                        "cstat"=>$std->protNFe->infProt->cStat,
                        "xmlProtocolo"=>$xmlResp];

                }else{ //não autorizada (rejeição)


                    $nfce = Nfce::where('venda_id', $venda->id)->get()[0];

                    $detalhes = NfceDetalhe::create([
                        'venda_id' => $venda->id,
                        'nfce_id' => $nfce->id,
                        'status' => '4 - REJEITADO - Rejeitado',
                        'descricao' => $std->protNFe->infProt->xMotivo,
                    ]);


                    return ["situacao"=>"rejeitada",
                        "motivo"=>$std->protNFe->infProt->xMotivo,
                        "cstat"=>$std->protNFe->infProt->cStat];
                }
            } else { //outros erros possíveis

                $nfce = Nfce::where('venda_id', $venda->id)->get()[0];

                $detalhes = NfceDetalhe::create([
                    'venda_id' => $venda->id,
                    'nfce_id' => $nfce->id,
                    'status' => '4 - REJEITADO - Rejeitado',
                    'descricao' => $std->protNFe->infProt->xMotivo,
                ]);

                return ["situacao"=>"rejeitada",
                    "motivo"=>$std->xMotivo,
                    "cstat"=>$std->cStat];
            }

        } catch (\Exception $e) {

            $nfce = Nfce::where('venda_id', $venda->id)->get()[0];

            $detalhes = NfceDetalhe::create([
                'venda_id' => $venda->id,
                'nfce_id' => $nfce->id,
                'status' => '4 - FALHA na tentativa de consulta do recibo',
                'descricao' => $e->getMessage(),
            ]);



            echo str_replace("\n", "<br/>", $e->getMessage());
        }
    }


    public function gerar(Request $request, $id){




        $nfce = Nfce::where('venda_id', $id)->get();

        $venda = Venda::where('id', $id)->with('cliente','itens','pagamentos')->get()[0];

        $empresa = Empresa::where('id', 1)->get()[0]; //todo alterar para pegar a empresa logada

        self::tools($empresa);



        if(count($nfce)){


            if($nfce[0]->recibo){
                $recibo = $nfce[0]->recibo;
                $consulta = self::consulta($venda, $empresa, $recibo);

                return response()->file(__DIR__ .'\..\..\..\storage\app\public\arquivos\empresa_id_'. $empresa->id .'\\'.'xml\\'.$nfce[0]->mesAno .'\\PDFs\\'.$nfce[0]->arquivo.'.pdf');

            }else{



                $envio = self::envia($venda, $empresa);

                sleep(2);

                $nfce = Nfce::where('venda_id', $venda->id)->get()[0];
                $recibo = $nfce->recibo;

                $consulta = self::consulta($venda, $empresa, $recibo);

                return response()->file(__DIR__ .'\..\..\..\storage\app\public\arquivos\empresa_id_'. $empresa->id .'\\'.'xml\\'.$nfce->mesAno .'\\PDFs\\'.$nfce->arquivo.'.pdf');
            };

        }else {



            self::taginfNFe($empresa);
            self::tagide($empresa, $venda);
            self::tagemit($empresa);
            self::tagenderEmit($empresa);

            $cpf = $request->cpf == '00000000000' ? '' : self::tagdest($request->cpf) ;


            foreach ($venda->Itens as $key => $item) {

                $item->sequencial = $key + 1;
                self::tagprod($item);
                self::tagimposto($item);

                if ($item->produto->tipo == 'servico') {
                    self::tagISSQN($item, $empresa);
                }

                self::tagPIS($item);
                self::tagCOFINS($item);

            }

            self::tagpag();

            foreach ($venda->Pagamentos as $key => $pagamento) {

                self::tagdetPag($pagamento);
            }

            self::tagICMSTot($venda);
            self::tagISSQNTot($venda, $empresa);
            self::tagtransp();

            self::montaxml($empresa, $venda);

            self::assina($empresa, $venda);

            $envio = self::envia($venda, $empresa);



            $nfce = Nfce::where('venda_id', $venda->id)->get()[0];
            $recibo = $nfce->recibo;

            $consulta = self::consulta($venda, $empresa, $recibo);

            return response()->file(__DIR__ .'\..\..\..\storage\app\public\arquivos\empresa_id_'. $empresa->id .'\\'.'xml\\'.$nfce->mesAno .'\\PDFs\\'.$nfce->arquivo.'.pdf');

        };



    }


    public function autoriza($nfce, $empresa){

        $request = Storage::get('public/arquivos/empresa_id_'. $empresa->id .'/'.'xml/'.$nfce->mesAno .'/Assinados/'.$nfce->arquivo.'-assinado.xml');

        $detalhes = NfceDetalhe::where('nfce_id',$nfce->id)->where('status', '4 - OK - Autorizado uso')->get()[0];

        $response = $detalhes->descricao;

        try {
            $xml = Complements::toAuthorize($request, $response);

            $request = Storage::put('public/arquivos/empresa_id_'. $empresa->id .'/'.'xml/'.$nfce->mesAno .'/Autorizados/'.$nfce->arquivo.'-autorizado.xml', $xml);

            $nfce->update([
                'status' => '4 - OK - Autorizado uso',
                'xml_autorizado' =>'public/arquivos/empresa_id_'. $empresa->id .'/'.'xml/'.$nfce->mesAno .'/Autorizados/'.$nfce->arquivo.'-autorizado.xml'
            ]);


            $docxml = Storage::get('public/arquivos/empresa_id_'. $empresa->id .'/'.'xml/'.$nfce->mesAno .'/Autorizados/'.$nfce->arquivo.'-autorizado.xml');
            $pathLogo = url('dattaable/assets/images/NFCe.png');

            $danfce = new  Danfce($docxml, $pathLogo);

            $id = $danfce->monta();
            $pdf = $danfce->render();

            Storage::put('public/arquivos/empresa_id_'. $empresa->id .'/'.'xml/'.$nfce->mesAno .'/PDFs/'.$nfce->arquivo.'.pdf', $pdf);

            return $pdf;

        } catch (\Exception $e) {
            return "Erro: " . $e->getMessage();
        }


    }





}
