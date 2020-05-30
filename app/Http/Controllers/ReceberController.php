<?php

namespace App\Http\Controllers;

use App\Models\Contas\Receber;
use App\Models\Movimentos\Movimento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class ReceberController extends AppController
{
    //
    public $model = Receber::class;



    public function index()
    {
        $data_ini = date('Y-m-d', strtotime('-1 weeks', strtotime(date('Y-m-d'))));
        $data_fim = date('Y-m-d');

        $tipo = 'credito';
        $clifor = '';
        $formas = 'todas';
        $statu = 'todas';

        $registros = $this->model::where('tipo', 'credito')->whereBetween('data_vencimento', [$data_ini . ' 00:00:00', $data_fim . ' 23:59:59'])->with('Movimentos')->get();

        //dd($registros);

        return view($this->name . '.index', compact('registros', 'data_ini', 'data_fim', 'tipo', 'clifor', 'formas', 'statu'));
    }


    public function pesquisar(Request $request)
    {
        //
        $data_ini = $request->data_ini;
        $data_fim = $request->data_fim;


        $tipo = $request->tipo;
        $clifor = $request->clifor;
        $formas = $request->forma_pagamento;
        $statu = $request->status;


        if ($request->forma_pagamento == 'todas') {
            $operador_forma = 'like';
            $forma_pagamento = '%%';
        } else {
            $operador_forma = '=';
            $forma_pagamento = $request->forma_pagamento;
        }

        if ($request->status == 'todos') {
            $operador_status = 'like';
            $status = '%%';
        } else {
            $operador_status = '=';
            $status = $request->status;
        }



        if ($clifor) {

            $registros = $this->model::whereBetween('receber.data_vencimento', [$data_ini . ' 00:00:00', $data_fim . ' 23:59:59'])
                ->join('clientes', 'receber.cliente_id', '=', 'clientes.id')
                ->where('receber.tipo', $request->tipo)
                ->where('clientes.nome', 'like', '%' . $clifor . '%')
                ->where('forma_pagamento', $operador_forma, $forma_pagamento)
                ->where('status', $operador_status, $status)
                ->orderby('receber.id', 'desc')
                ->select('receber.*')
                ->get();
        } else {

            $registros = $this->model::whereBetween('data_vencimento', [$data_ini . ' 00:00:00', $data_fim . ' 23:59:59'])
                ->where('tipo', $request->tipo)
                ->where('forma_pagamento', $operador_forma, $forma_pagamento)
                ->where('status', $operador_status, $status)
                ->orderby('id', 'desc')
                ->get();
        }

        return view($this->name . '.index', compact('registros', 'data_ini', 'data_fim', 'tipo', 'clifor', 'formas', 'statu'));
    }


    public function store(Request $request)
    {

        //dd($request);

        $valor = $request->valor_original / $request->parcelas;
        $receber_id =  null;
        $vencimento = null;

        for ($i = 1; $i <= $request->parcelas; $i++) {

            //dd($request);


            if ($i == 1) {
                $vencimento = $request->data_vencimento;
            } else {
                $dias = ($i - 1) * $request->periodicidade;
                $vencimento =  date('Y-m-d', strtotime("+" . $dias . " days", strtotime($request->data_vencimento)));
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
                'forma_pagamento' => 'Dinheiro',
            ]);
            $registro->save();


            if ($i == 1 and $request->parcelas >= 1) {
                $receber_id = $registro->id;
            };

            $registro->receber_id = $receber_id;
            $registro->save();
        }





        if ($request->origem == 'novo') {

            return redirect()->route($this->name . '.create')->with('status', 'Registro Incluído');
        } elseif ($request->origem == 'voltar') {

            return redirect()->route($this->name . '.index')->with('status', 'Registro Incluído');
        }

        return redirect()->route($this->name . '.edit', $registro->id)->with('status', 'Registro Incluído');
    }


    public function edit($id)
    {


        $registro = $this->model::where('id', $id)->get()[0];

        $parcelas = $this->model::where('receber_id', $registro->receber_id)->get();


        return view($this->name . '.edit', compact('registro', 'parcelas'));
    }

    public function update(Request $request, $id)
    {
        //
        $registro = $this->model::where('id', $id)->get()[0];

        $registro->update($request->except('_token', '_method'));

        if ($request->status == 'Quitado') {

            $movimento =  Movimento::create([
                'conta_id' => $request->conta_id,
                'data' => $request->data_pagamento,
                'historico' => $request->resumo,
                'documento' => $request->documento,
                'valor' => ($request->tipo == 'credito') ? $request->valor_pago : $request->valor_pago * -1,
                'tipo' => ($request->tipo == 'credito') ? 'crédito' : 'débito',
                'user_id' => Auth::user()->id,
                'receber_id' => $id,
            ]);

            $registro->update([
                'movimento_id' => $movimento->id
            ]);




            //se Antecipação Atualizar todos os registros antecipados
            if ($request->resumo == 'Antecipação de Vendas') {

                $contas = explode(",", $request->documento);



                foreach ($contas as $id) {

                    $registro = $this->model::where('id', $id)->get()[0];

                    $registro->update([
                        'movimento_id' => $movimento->id
                    ]);
                }
            }
        }







        if ($request->origem == 'novo') {

            return redirect()->route($this->name . '.create')->with('status', 'Registro Incluído');
        } elseif ($request->origem == 'voltar') {

            return redirect()->route($this->name . '.index')->with('status', 'Registro Incluído');
        }

        return redirect()->route($this->name . '.edit', $registro)->with('status', 'Registro Atualizado');
    }

    public function baixaRapida($id)
    {

        $registro = $this->model::where('id', $id)->get()[0];


        $registro->update([
            'valor_pago' => $registro->valor_original,
            'data_pagamento' => $registro->data_vencimento,
            'forma_pagamento' => 'Débito em Conta',
            'status' => 'Quitado',
            'conta_id' => config('sysmax.conta_corrente_padrao')
        ]);


        $movimento = Movimento::create([
            'conta_id' => config('sysmax.conta_corrente_padrao'),
            'data' => $registro->data_vencimento,
            'historico' => $registro->resumo,
            'documento' => $registro->documento,
            'valor' => ($registro->tipo == 'credito') ? $registro->valor_original : $registro->valor_original * -1,
            'tipo' => ($registro->tipo == 'credito') ? 'crédito' : 'débito',
            'user_id' => Auth::user()->id,
            'receber_id' => $id,
        ]);

        $registro->update([
            'movimento_id' => $movimento->id
        ]);


        return $registro;
        //return redirect()->back();


    }

    public function baixaGrupo(Request $request)
    {


        $contas = explode(",", $request->registros);
        $valor = 0;
        $tipo = "";

        foreach ($contas as $id) {

            $registro = $this->model::where('id', $id)->get()[0];

            if ($registro->tipo == 'debito') {
                $liquido = $registro->valor_original;
            } else {
                $liquido = $registro->valor_pago;
            }


            $registro->update([
                'status' => 'Quitado',
                'valor_pago' => $liquido,
                'conta_id' => config('sysmax.conta_corrente_padrao')
            ]);

            $valor += $registro->valor_pago;
            $tipo = $registro->tipo;
        }

        $movimento =  Movimento::create([
            'conta_id' => config('sysmax.conta_corrente_padrao'),
            'data' => $request->data,
            'historico' => $request->historico,
            'documento' => $request->registros,
            'valor' => ($tipo == 'credito') ? $valor : $valor * -1,
            'tipo' => ($tipo == 'credito') ? 'crédito' : 'débito',
            'user_id' => Auth::user()->id,
            'receber_id' => 0,
        ]);




        foreach ($contas as $id) {

            $registro = $this->model::where('id', $id)->get()[0];

            $registro->update([
                'movimento_id' => $movimento->id
            ]);
        }


        return $movimento;
    }



    public function baixaAntecipacao(Request $request)
    {


        $contas = explode(",", $request->registros_antecipacao);
        $valor = 0;
        $tipo = "";

        foreach ($contas as $id) {

            $registro = $this->model::where('id', $id)->get()[0];

            $registro->update([
                'status' => 'Quitado',
                'conta_id' => config('sysmax.conta_corrente_padrao'),
                'data_pagamento' => $request->data_antecipacao,
                'observacao' => 'Antecipacao realizada em ' . $request->data_antecipacao
            ]);

            $valor += $registro->valor_pago;
            $tipo = $registro->tipo;
        }


        $registro = new $this->model([
            'resumo' => 'Antecipação de Vendas',
            'documento' => $request->registros_antecipacao,
            'descricao' => $request->historico_antecipacao,
            'data_vencimento' => $request->data_antecipacao,
            'data_emissao' => $request->data_antecipacao,
            'data_pagamento' => $request->data_antecipacao,
            'valor_documento' => $request->valor_original,
            'valor_original' => $valor,
            'valor_documento' => $valor,
            /*'valor_desconto' => $request->valor_desconto,
            'valor_juros' => $request->valor_juros,
            'valor_multa' => $request->valor_multa,
            'valor_pago' => $request->valor_pago,*/
            'status' => 'Aberto',
            'parcelas' => 1,
            'numero_parcela' => 1,
            'observacao' => 'Referente as Vendas' . $request->registros_antecipacao,
            /*'imagem' => $request->imagem,*/

            'setor_id' => config('sysmax.setor_id_antecipacao'),
            'cliente_id' => config('sysmax.cliente_id_antecipacao'),
            'categoria_id' => config('sysmax.categoria_id_antecipacao'),
            'tipo' => $tipo,
            'forma_pagamento' => 'Transferência'
        ]);
        $registro->save();

        //Atualizar o campo receber_id com o Id  - Importante para exibir no quadro de parcelas
        $registro->update([
            'receber_id' => $registro->id
        ]);
        $registro->save();


        return $registro->id;
    }


    public function delete(Request $request)
    {


        $receber = Receber::find($request->registro_id);

        $contas = Receber::where('receber_id',  $receber->receber_id)->delete();

        // foreach ($contas as $key => $value) {
        //     if ($value->status != 'Aberto') {

        //         return redirect()->route('receber.index')->with('success', 'Não foi possivel excluir, pois existem parcelas Quitadas');
        //     }
        // }

        return redirect()->route('receber.index')->with(['success', 'Registro Excluído com sucesso']);
    }
}
