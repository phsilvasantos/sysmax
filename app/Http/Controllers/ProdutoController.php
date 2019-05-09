<?php

namespace App\Http\Controllers;

use App\Models\Itens\Item;
use App\Models\Produtos\Produto;
use Illuminate\Http\Request;

class ProdutoController extends AppController
{

    public $model = Produto::class;


    public function localizar(Request $request){

        $dados = $this->model::where('nome', 'like', '%'.$request->q.'%')->get();


        foreach ($dados as $key => $registro){

            $registros[$key]['id'] = $registro->id;
            $registros[$key]['text'] = $registro->nome;
            $registros[$key]['preco'] = $registro->preco;
        }

        $resultado['results'] = $registros;

        return response()->json($resultado);



    }

    public function localizar_id(Request $request, $id){


        $produto = Item::select('items.*','produtos.*','items.id as item_id')->join('produtos','items.produto_id','produtos.id')->where("venda_id", $id)->get();

        $produtos['total_count'] = count($produto);
        $produtos['items'] = $produto;

        return response()->json($produtos);



    }




}
