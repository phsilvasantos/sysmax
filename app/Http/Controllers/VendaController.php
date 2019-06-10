<?php

namespace App\Http\Controllers;

use App\Models\Forma_Pagamentos\Forma_Pagamento;
use App\Models\Itens\Item;
use App\Models\Pagamentos\Pagamento;
use App\Models\Vendas\Venda;
use App\User;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Array_;

class VendaController extends AppController
{
    //
    public $model = Venda::class;


   
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
                ['status' => 'Parcialmente Quitada'
                ]);

        }



        return redirect()->route('vendas.edit', $venda->id );

    }



    public function edit($id){

        $venda = Venda::where('id', $id)->with('Nfce')->get();

        $instace = new $this->model;

        $formaPagamentos = Forma_Pagamento::all();
        $vendedores = User::all();

        return view($this->name.'.edit', compact('instace','formaPagamentos','venda','vendedores'));


    }

    public function update(Request $request, $id)
    {



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
                ['status' => 'Parcialmente Quitada'
                ]);

        }




        return redirect()->route('vendas.edit', $id );


    }

}
