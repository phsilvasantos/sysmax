<?php

namespace App\Http\Controllers;

use App\Models\Animais\Animal;
use App\Models\Clientes\Cliente;
use Illuminate\Http\Request;
use App\Models\Categorias\Categoria;
use DB;

class ClienteController extends AppController
{

    public $model = Cliente::class;


    public function index()
    {
        //
        $registros = $this->model::limit(10)->orderBy('id', 'desc')->get();


        return view($this->name.'.index', compact('registros'));

    }

    //sobrescrever o metodo store para salvar
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

    public function pesquisar(Request $request){



        switch($request->campo){
            case 'nome_cliente':
                //
                $registros = $this->model::where('nome', 'like', '%'. $request->descricao .'%')->get();
                break;
            case 'nome_animal':
                //
                $clientes =   DB::table('clientes')->select('clientes.id')->join('animais','animais.cliente_id','clientes.id')->where('animais.nome', 'like', '%'. $request->descricao .'%')->get();

                $ids = array();

                foreach($clientes as $key => $cliente){

                    $ids[] =  $cliente->id;
                }


                $registros = $this->model::whereIn('id',  $ids )->get();

                break;
            case 'CPF':
                //
                $registros = $this->model::where('cpf_cnpj', 'like', '%'. $request->descricao .'%')->get();
                break;

            case 'id':
                //
                $registros = $this->model::where('id', '=', $request->descricao )->get();
                break;


            default :
                //
                $registros = $this->model::where();
                break;

        }



        return view($this->name.'.index', compact('registros'));


    }


    public function validar(Request $request){


        $cpf = Cliente::where('cpf_cnpj', $request->cpf)->first();


        return $cpf;


    }


}
