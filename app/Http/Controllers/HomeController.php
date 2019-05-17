<?php

namespace App\Http\Controllers;

use App\Models\Clientes\Cliente;
use App\Models\Produtos\Produto;
use App\Models\Vendas\Venda;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $clientes = Cliente::count();
        $produtos = Produto::count();
        $vendas = Venda::count();

        $ultimasVendas = Venda::orderBy('id', 'desc')->take(5)->get();


        return view('home', compact('clientes','produtos', 'vendas','ultimasVendas'));
    }
}
