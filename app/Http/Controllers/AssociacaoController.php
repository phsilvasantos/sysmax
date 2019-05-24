<?php

namespace App\Http\Controllers;

use App\Models\Categorias\Categoria;
use App\Models\Clientes\Cliente;
use App\Models\Produtos\Produto;
use App\Models\Vendas\Venda;
use Illuminate\Http\Request;
use DB;

class AssociacaoController extends Controller
{
    //
    public function index()
    {

        $clientes = Cliente::count();
        $associados = DB::table('categoria_cliente')->count();
        $unicos = DB::table('categoria_cliente')->distinct('cliente_id')->count('cliente_id');

        $categorias = DB::table('categoria_cliente')->select('categorias.categoria', DB::raw('count(categoria_cliente.id) as qtd'))->join('categorias','categoria_id','categorias.id')->groupBy('categorias.categoria')->get();

        $kpi_assoc = (int) (($associados / $clientes)*100);
        $kpi_unico = (int) (($unicos / $clientes)*100);



        $produtos = Produto::count();
        $vendas = Venda::count();

        $ultimosAssociados = DB::table('categoria_cliente')->select('clientes.nome','categorias.categoria')->join('clientes','cliente_id','clientes.id')->join('categorias','categoria_id','categorias.id')->orderBy('categoria_cliente.id', 'desc')->take(5)->get();

        //dd($ultimasVendas);

        return view('associacao.index', compact('clientes','produtos', 'vendas','ultimosAssociados','associados','kpi_assoc','kpi_unico','unicos','categorias'));
    }
}
