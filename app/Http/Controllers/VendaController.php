<?php

namespace App\Http\Controllers;

use App\Models\Forma_Pagamentos\Forma_Pagamento;
use App\Models\Itens\Item;
use App\Models\Pagamentos\Pagamento;
use App\Models\Vendas\Venda;
use App\User;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Array_;
use DB;

class VendaController extends AppController
{
    //
    public $model = Venda::class;


    public function index()
    {
        //
        $data_ini = date('Y-m-d', strtotime('-1 weeks', strtotime(date('Y-m-d'))));
        $data_fim = date('Y-m-d');


        $registros = $this->model::whereBetween('created_at', [$data_ini . ' 00:00:00',date('Y-m-d') . ' 23:59:59'])->orderby('id','desc')->get();


        return view($this->name.'.index', compact('registros','data_ini','data_fim'));

    }
   
    public function create()
    {
        $instace = new $this->model;

        $formaPagamentos = Forma_Pagamento::all();
        $vendedores = User::all();

        return view($this->name.'.create', compact('instace','formaPagamentos','vendedores'));
    }


    public function store(Request $request)
    {

        $dados['cliente_id'] = $request->cliente_id;
        $dados['user_id'] = $request->vendedor_id;
        $dados['animal_id'] = $request->animal_id;
        $dados['tipo'] = 'Venda';
        $dados['status'] = 'Aberta';

        $venda = new Venda($dados);
        $venda->save();

        $itens = Array();
        $total_itens = 0;
        $total_bruto = 0;
        $total_desconto = 0;

        foreach($request->produto_id as $key => $produto){
            $itens[$key]['venda_id'] = $venda->id;
            $itens[$key]['produto_id'] = $produto;
            $itens[$key]['user_id'] = $request->user_id[$key];
            $itens[$key]['qtd'] = $request->qtd[$key];
            $itens[$key]['valor_unitario'] = $request->preco[$key];
            $itens[$key]['sub_total'] = $request->qtd[$key] * $request->preco[$key];
            $itens[$key]['desconto'] = $request->desconto[$key];
            $itens[$key]['valor_total'] = $request->valor_liquido[$key];

            $total_itens += $request->valor_liquido[$key];
            $total_bruto += ($request->qtd[$key] * $request->preco[$key]);
            $total_desconto += $request->desconto[$key];

            $item = $venda->Itens()->create($itens[$key]);

        }


        $pagamentos = Array();
        $total_pago = 0;

        foreach($request->forma_pagamento_id as $key => $forma){
            $pagamentos[$key]['venda_id'] = $venda->id;
            $pagamentos[$key]['forma_pagamento_id'] = $forma;
            $pagamentos[$key]['user_id'] = auth()->user()->id;
            $pagamentos[$key]['parcelas'] = $request->parcelas[$key];
            $pagamentos[$key]['valor'] = $request->valor_parcela[$key];

            $total_pago += $request->valor_parcela[$key];

            if($pagamentos[$key]['valor'] > 0){

                $pagamento = $venda->Pagamentos()->create($pagamentos[$key]);
            }
        }


        if($total_pago == $total_itens){


            Venda::where('id',$venda->id)->update(
                ['status' => 'Quitada',
                 'total_venda_bruto' => $total_bruto,
                 'total_desconto' => $total_desconto,
                 'total_venda_liquido' => $total_itens,

                ]);


        }elseif($total_pago <= $total_itens && $total_pago > 0){

            Venda::where('id',$venda->id)->update(
                ['status' => 'Parcialmente Quitada',

                ]);

        }



        return redirect()->route('vendas.edit', $venda->id );

    }



    public function edit($id){

        $venda = Venda::where('id', $id)->with('Nfce')->get();

        $instace = new $this->model;

        $formaPagamentos = Forma_Pagamento::all();
        $vendedores = User::all();

        $uvendas = Venda::where('cliente_id', $venda[0]->cliente_id)->where('status','!=','Quitada')->get();

        return view($this->name.'.edit', compact('instace','formaPagamentos','venda','vendedores','uvendas'));


    }

    public function update(Request $request, $id)
    {

        if($request->animal_id != null){
            $dados['animal_id'] = $request->animal_id;
        }

        $dados['cliente_id'] = $request->cliente_id;
        $dados['user_id'] = $request->vendedor_id;



        Venda::where('id',$id)->update($dados);

        $venda = Venda::where('id', $id)->get();

        $total_itens =Item::where('venda_id', $id)->sum('valor_total');
        $total_bruto =Item::where('venda_id', $id)->sum('sub_total');
        $total_desconto =Item::where('venda_id', $id)->sum('desconto');


        $pagamentos = Array();
        $total_pago = Pagamento::where('venda_id', $id)->sum('valor');

        foreach($request->forma_pagamento_id as $key => $forma){



            if($request->valor_parcela[$key] > 0){

            $pagamentos[$key]['venda_id'] = $id;
            $pagamentos[$key]['forma_pagamento_id'] = $forma;
            $pagamentos[$key]['user_id'] = auth()->user()->id;
            $pagamentos[$key]['parcelas'] = $request->parcelas[$key];
            $pagamentos[$key]['valor'] = $request->valor_parcela[$key];

            $total_pago += $request->valor_parcela[$key];



            Pagamento::create($pagamentos[$key]);

            }
        }


        $total[] =  number_format((float) $total_pago, 2, '.', '');
        $total[] = number_format((float) $total_itens, 2, '.', '');


        if( $total[0] == $total[1] ){



            Venda::where('id',$id)->update(
                ['status' => 'Quitada',
                    'total_venda_bruto' => $total_bruto,
                    'total_desconto' => $total_desconto,
                    'total_venda_liquido' => $total_itens,

                ]);


        }else{

            Venda::where('id',$id)->update(
                ['status' => 'Parcialmente Quitada',

                ]);

        }




        return redirect()->route('vendas.edit', $id );


    }

    public function pesquisar(Request $request)
    {
        //
        $data_ini = $request->data_ini;
        $data_fim = $request->data_fim;


        $registros = $this->model::whereBetween('created_at', [$data_ini . ' 00:00:00',$data_fim . ' 23:59:59'])->orderby('id','desc')->get();


        return view($this->name.'.index', compact('registros','data_ini','data_fim'));

    }


    public function fechamento(Request $request)
    {
        //
        if(isset($request->data_ini)){

            $data_ini = $request->data_ini;
            $data_fim = $request->data_fim;
        }else{

            $data_ini = date('Y-m-d', strtotime('-1 day', strtotime(date('Y-m-d'))));
            $data_fim = date('Y-m-d');
        }





        $registros1 = $this->model::select('vendas.*', 'pagamentos.valor','pagamentos.parcelas','forma_pagamentos.nome as forma', 'vendas.deleted_at as contribuicao', 'pagamentos.created_at as data_pagamentos')
                                    ->join('pagamentos', 'vendas.id', '=', 'pagamentos.venda_id')
                                    ->join('forma_pagamentos', 'pagamentos.forma_pagamento_id', '=', 'forma_pagamentos.id')
                                    ->join('items', 'vendas.id', '=','items.venda_id')
                                    ->whereBetween('pagamentos.created_at', [$data_ini . ' 00:00:00',$data_fim . ' 23:59:59'])
                                    ->whereIn('vendas.status',['Quitada','Parcialmente Quitada'])
                                    ->where('items.produto_id','<>', '713')
                                    ->whereNull('pagamentos.deleted_at')
                                    ->groupBy('vendas.id','vendas.deleted_at','pagamentos.parcelas','vendas.cliente_id','vendas.user_id','vendas.total_venda_bruto','vendas.total_desconto','vendas.total_venda_liquido','vendas.observacoes','vendas.tipo','vendas.status','vendas.empresa_id','vendas.updated_at','vendas.animal_id','vendas.created_at','forma_pagamentos.nome','pagamentos.valor','vendas.atendimento_id','pagamentos.created_at')
                                    ->orderby('vendas.id','desc');



        $registros = $this->model::select('vendas.*', 'pagamentos.valor','pagamentos.parcelas','forma_pagamentos.nome as forma','vendas.empresa_id as contribuicao', 'pagamentos.created_at as data_pagamentos')
            ->join('pagamentos', 'vendas.id', '=', 'pagamentos.venda_id')
            ->join('forma_pagamentos', 'pagamentos.forma_pagamento_id', '=', 'forma_pagamentos.id')
            ->join('items', 'vendas.id', '=','items.venda_id')
            ->whereBetween('pagamentos.created_at', [$data_ini . ' 00:00:00',$data_fim . ' 23:59:59'])
            ->whereIn('vendas.status',['Quitada'])
            ->where('items.produto_id', '713')
            ->whereNull('pagamentos.deleted_at')
            ->groupBy('vendas.id','vendas.deleted_at','pagamentos.parcelas','vendas.cliente_id','vendas.user_id','vendas.total_venda_bruto','vendas.total_desconto','vendas.total_venda_liquido','vendas.observacoes','vendas.tipo','vendas.status','vendas.empresa_id','vendas.updated_at','vendas.animal_id','vendas.created_at','forma_pagamentos.nome','pagamentos.valor','vendas.atendimento_id','pagamentos.created_at')
            ->orderby('vendas.id','desc')
            ->unionAll ($registros1)
            ->get();



        $resumo = DB::table('vendas')->select(DB::raw('sum(pagamentos.valor) as valor, forma_pagamentos.nome as forma'))
            ->join('pagamentos', 'vendas.id', '=', 'pagamentos.venda_id')
            ->join('forma_pagamentos', 'pagamentos.forma_pagamento_id', '=', 'forma_pagamentos.id')
            ->whereBetween('pagamentos.created_at', [$data_ini . ' 00:00:00',$data_fim . ' 23:59:59'])
            ->whereIn('vendas.status',['Quitada','Parcialmente Quitada'])
            ->groupBy('forma_pagamentos.nome')
            ->get();


        return view($this->name.'.fechamento', compact('registros','data_ini','data_fim','resumo'));

    }



    public function prevenda(Request $request)
    {



        $pvenda = Venda::where('tipo','Venda')->where('atendimento_id', $request->atendimento_id)->where('status','!=','Quitada')->where('animal_id', $request->animal_id)->get();

        if(count($pvenda) > 0){

            return redirect()->route('vendas.edit', $pvenda[0]->id );

        }



        $dados['cliente_id'] = $request->cliente_id;
        $dados['user_id'] = $request->user_id;
        $dados['animal_id'] = $request->animal_id;
        $dados['atendimento_id'] = $request->atendimento_id;
        $dados['tipo'] = 'Venda';
        $dados['status'] = 'Aberta';

        $venda = new Venda($dados);
        $venda->save();


        return redirect()->route('vendas.edit', $venda->id );

    }




}
