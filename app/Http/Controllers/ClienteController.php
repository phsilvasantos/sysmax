<?php

namespace App\Http\Controllers;

use App\Models\Clientes\Cliente;
use Illuminate\Http\Request;
use App\Models\Categorias\Categoria;
use DB;

class ClienteController extends AppController
{

    public $model = Cliente::class;


    //sobrescrever o metodo store para salvar as categorias
    public function store(Request $request)
    {



        $registro = new $this->model($request->except('_token','_method'));
        $registro->save();

        foreach($request->all() as $campo){
            if(is_array($campo)){
                foreach($campo as $categoria) {
                    $categ = Categoria::find($categoria);
                    $registro->categorias()->attach($categ);

                }
            }
        }

        return redirect()->route($this->name.'.edit', $registro->id)->with('status', 'Registro Incluído');

    }

    public function update(Request $request, $id)
    {

        //
        $registro = $this->model::where('id',$id)->get()[0];

        $registro->update($request->except('_token','_method'));

        foreach($request->all() as $campo){
            if(is_array($campo)){
                foreach($campo as $categoria) {
                    $categ = Categoria::find($categoria);
                    $registro->categorias()->attach($categ);

                }
            }
        }

        if($request->origem == 'novo'){

            return redirect()->route($this->name.'.create')->with('status', 'Registro Incluído');

        }elseif($request->origem == 'voltar'){

            return redirect()->route($this->name.'.index')->with('status', 'Registro Incluído');
        }

        return redirect()->route($this->name.'.edit', $registro)->with('status', 'Registro Atualizado');



    }


    public function ficha(Request $request) {

        $registro = $this->model::where('id', $request->id)->get()[0];

        return view('clientes.ficha', compact('registro'));


    }

    public function desassociar(Request $request) {



        $pivot = $this->model::where('id', $request->cliente_id)->get()[0];

        $pivot->categorias()->detach($request->categoria_id);


        return redirect()->route('clientes.edit', $request->cliente_id);


    }



}
