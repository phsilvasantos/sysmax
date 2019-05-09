<?php

namespace App\Http\Controllers;

use App\Models\Empresas\Empresa;
use Illuminate\Http\Request;
use DB;

class EmpresaController extends AppController
{

    public $model = Empresa::class;


    public function edit($id)
    {
        $registro = $this->model::where('id',$id)->get()[0];
        $municipios = DB::table('municipios')->get();
        $servicos = DB::table('servicos')->get();

        //dd($municipios[0]);
        return view($this->name.'.edit', compact('registro','municipios','servicos'));
    }

    public function update(Request $request, $id)
    {


        $registro = $this->model::where('id',$id)->get()[0];

        $dados = $request->except('_token','_method');


        if($request->files->count()){
            foreach($request->files as $key => $arquivo) {

                if ($request->hasFile($key)){

                    $nome = $arquivo->getClientOriginalName();
                    $upload = $request->$key->storeAs('public\arquivos\empresa_id_'.$id ,$nome);
                    $dados[$key] = $nome;
                }

            }
        }

        $registro->update($dados);

        if($request->origem == 'novo'){

            return redirect()->route($this->name.'.create')->with('status', 'Registro Incluído');

        }elseif($request->origem == 'voltar'){

            return redirect()->route($this->name.'.index')->with('status', 'Registro Incluído');
        }

        return redirect()->route($this->name.'.edit', $registro)->with('status', 'Registro Atualizado');

    }

    public function salvar_anexo(Request $request){



    }

}
