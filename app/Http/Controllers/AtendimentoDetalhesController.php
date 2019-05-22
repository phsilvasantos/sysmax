<?php

namespace App\Http\Controllers;

use App\Models\Atendimentos\Atendimento_Detalhes;
use App\Models\Modelos\Modelo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AtendimentoDetalhesController extends AppController
{
    //
    public $model = Atendimento_Detalhes::class;


    public function store(Request $request)
    {

        $dados = $request->except('_token','_method');

        //SALVAR ANEXO
        if($request->files->count()){
            foreach($request->files as $key => $arquivo) {

                if ($request->hasFile($key)){

                    $nome = $arquivo->getClientOriginalName();
                    $upload = $request->$key->storeAs('public\arquivos\empresa_id_'. Auth::user()->empresa_id ,$nome);
                    $dados[$key] = $nome;
                }

            }
        }

        //SALVAR MODELO
        if($request->check_modelo == 'on'){

            Modelo::create([
                'user_id' => $request->user_id,
                'tipo' => $request->categoria,
                'nome' => $request->nome_modelo,
                'descricao' => $request->descricao,
                'acesso' => 'Restrito',

            ]);

        };




        $registro = new $this->model($dados);
        $registro->save();

        return redirect()->route('atendimentos.edit', $registro->atendimento_id)->with('status', $registro->categoria);
    }

    public function edit($id)
    {

        $registro = $this->model::where('id',$id)->with('Usuario')->get()[0];

        return json_encode($registro);


    }


    public function update(Request $request, $id)
    {
        $registro = $this->model::where('id',$id)->get()[0];

        $dados = $request->except('_token','_method');

        if($request->files->count()){
            foreach($request->files as $key => $arquivo) {

                if ($request->hasFile($key)){

                    $nome = $arquivo->getClientOriginalName();
                    $upload = $request->$key->storeAs('public\arquivos\empresa_id_'. Auth::user()->empresa_id ,$nome);
                    $dados[$key] = $nome;
                }

            }
        }

        $registro->update($dados);

        return redirect()->route('atendimentos.edit', $registro->atendimento_id)->with('status', $registro->categoria);


    }



}
