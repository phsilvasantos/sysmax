<?php

namespace App\Http\Controllers;

use App\Models\Categorias\Categoria;
use App\Models\Comissoes\Comissao;
use App\Models\Produtos\Produto;
use Illuminate\Http\Request;

class ComissaoController extends Controller
{
    //

    public function store(Request $request){


        $data = $request->except('_token','_method');

        if($request->tipo == 'grupo'){

            $data['nome'] = Categoria::find($request->produto_id)->categoria;

        }else{
            $data['nome'] = Produto::find($request->produto_id)->nome;

        }




        $comissao = Comissao::create($data);

        return redirect()->route('users.edit', $request->user_id);


    }
}
