<?php

namespace App\Http\Controllers;


use App\Models\Clientes\Cliente;
use Illuminate\Http\Request;
use App\Models\Categorias\Categoria;
use DB;

class FornecedorController extends AppController
{

    public $model = Cliente::class;


    public function index()
    {
        //
        $registros = $this->model::limit(10)->where('clifor','fornecedor')->orderBy('id', 'desc')->get();


        return view('fornecedor.index', compact('registros'));

    }

    //sobrescrever o metodo store para salvar
    public function store(Request $request)
    {


        $registro = new $this->model($request->except('_token','_method'));
        $registro->save();


        return redirect()->route('fornecedor.edit', $registro->id)->with('status', 'Registro Incluído');

    }

    public function update(Request $request, $id)
    {

        //
        $registro = $this->model::where('id',$id)->get()[0];

        $registro->update($request->except('_token','_method'));


        if($request->origem == 'novo'){

            return redirect()->route('fornecedor.create')->with('status', 'Registro Incluído');

        }elseif($request->origem == 'voltar'){

            return redirect()->route('fornecedor.create.index')->with('status', 'Registro Incluído');
        }

        return redirect()->route('fornecedor.create.edit', $registro)->with('status', 'Registro Atualizado');



    }




    public function pesquisar(Request $request){



        switch($request->campo){
            case 'nome_cliente':
                //
                $registros = $this->model::where('nome', 'like', '%'. $request->descricao .'%')->where('clifor','fornecedor')->get();
                break;

            case 'CPF':
                //
                $registros = $this->model::where('cpf_cnpj', 'like', '%'. $request->descricao .'%')->where('clifor','fornecedor')->get();
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



        return view('fornecedor.index', compact('registros'));


    }

    public function create()
    {
        //
        $instace = new $this->model;


        return view('fornecedor.create', compact('instace'));
    }

    public function show($id)
    {
        //
        $registro = $this->model::where('id',$id)->get()[0];


        return redirect()->route('fornecedor.create', $registro);
    }

    public function validar(Request $request){


        $cpf = Cliente::where('cpf_cnpj', $request->cpf)->first();


        return $cpf;


    }

    public function edit($id)
    {
        //


        $registro = $this->model::where('id',$id)->get()[0];


        return view('fornecedor.edit', compact('registro'));
    }

}
