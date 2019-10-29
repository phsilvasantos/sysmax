<?php

namespace App\Http\Controllers;

use App\Models\Contas\Receber;
use App\Models\Movimentos\Movimento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReceberController extends AppController
{
    //
    public $model = Receber::class;


    public function store(Request $request)
    {

        //dd($request);

        $valor = $request->valor_original / $request->parcelas;
        $receber_id =  null;
        $vencimento = null;

        for($i=1; $i<= $request->parcelas; $i++){

            //dd($request);


            if($i == 1) {
                $vencimento = $request->data_vencimento;

            }else{
                $dias = ($i - 1)* $request->periodicidade;
                $vencimento =  date('Y-m-d', strtotime("+". $dias ." days", strtotime($request->data_vencimento)));
            };


            $registro = new $this->model([
                'resumo' => $request->resumo,
                'documento' => $request->documento,
                'descricao' => $request->descricao,
                'data_vencimento' => $vencimento,
                'data_emissao' => $request->data_emissao,
                'data_pagamento' => $request->data_pagamento,
                'valor_documento' => $request->valor_original,
                'valor_original' => $valor,
                /*'valor_desconto' => $request->valor_desconto,
                'valor_juros' => $request->valor_juros,
                'valor_multa' => $request->valor_multa,
                'valor_pago' => $request->valor_pago,*/
                'status' => 'Aberto',
                'parcelas' => $request->parcelas,
                'numero_parcela' => $i,
                'observacao' => $request->observacao,
                /*'imagem' => $request->imagem,*/
                'receber_id' => $receber_id,
                'setor_id' => $request->setor_id,
                'cliente_id' => $request->cliente_id,
                'categoria_id' => $request->categoria_id,
                'tipo' => $request->tipo,
                ]);
            $registro->save();


            if($i == 1 and $request->parcelas >= 1) {
                $receber_id = $registro->id;
            };

            $registro->receber_id = $receber_id;
            $registro->save();

        }





        if($request->origem == 'novo'){

            return redirect()->route($this->name.'.create')->with('status', 'Registro Incluído');

        }elseif($request->origem == 'voltar'){

            return redirect()->route($this->name.'.index')->with('status', 'Registro Incluído');
        }

        return redirect()->route($this->name.'.edit', $registro->id)->with('status', 'Registro Incluído');
    }


    public function edit($id)
    {


        $registro = $this->model::where('id',$id)->get()[0];

        $parcelas = $this->model::where('receber_id',$registro->receber_id)->get();


        return view($this->name.'.edit', compact('registro','parcelas'));
    }

    public function update(Request $request, $id)
    {
        //
        $registro = $this->model::where('id',$id)->get()[0];

        $registro->update($request->except('_token','_method'));

        if($request->status == 'Quitado'){

            $movimento = new Movimento([
                'conta_id' => $request->conta_id,
                'data' => $request->data_pagamento,
                'historico' => $request->resumo,
                'documento' => $request->documento,
                'valor' => ($request->tipo == 'credito') ? $request->valor_pago : $request->valor_pago * -1,
                'tipo' => ($request->tipo == 'credito') ? 'crédito' : 'débito',
                'user_id' => Auth::user()->id,
                'receber_id' => $id,
            ]);

            $movimento->save();
        }

        if($request->origem == 'novo'){

            return redirect()->route($this->name.'.create')->with('status', 'Registro Incluído');

        }elseif($request->origem == 'voltar'){

            return redirect()->route($this->name.'.index')->with('status', 'Registro Incluído');
        }

        return redirect()->route($this->name.'.edit', $registro)->with('status', 'Registro Atualizado');

    }

    public function baixaRapida($id)
    {
        //
        $registro = $this->model::where('id',$id)->get()[0];


        $registro->update([
            'valor_pago' => $registro->valor_original,
            'data_pagamento' => $registro->data_vencimento,
            'forma_pagamento' => 'Débito em Conta',
            'status' => 'Quitado',
            'conta_id' => config('sysmax.conta_corrente_padrao')
        ]);


        $movimento = new Movimento([
            'conta_id' => config('sysmax.conta_corrente_padrao'),
            'data' => $registro->data_vencimento,
            'historico' => $registro->resumo,
            'documento' => $registro->documento,
            'valor' => ($registro->tipo == 'credito') ? $registro->valor_original : $registro->valor_original * -1,
            'tipo' => ($registro->tipo == 'credito') ? 'crédito' : 'débito',
            'user_id' => Auth::user()->id,
            'receber_id' => $id,
        ]);

        $movimento->save();


        return redirect()->back();


        return redirect()->back();

    }

}
