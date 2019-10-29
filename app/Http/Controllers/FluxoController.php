<?php

namespace App\Http\Controllers;

use App\Models\Contas\Receber;
use Illuminate\Http\Request;
use DB;

class FluxoController extends Controller
{
    //

    public function fluxo()
    {
        $registros = DB::table('receber')->rightjoin('categorias', 'categorias.id', '=', 'receber.categoria_id')
                                         ->select(DB::raw('sum(receber.valor_original) as valor'), 'categorias.categoria','categorias.categoria_type')
                                         ->whereIn('categorias.categoria_type', ['Pagar','Receber'])
                                         ->groupby('categorias.categoria','categorias.categoria_type')
                                         ->orderby('categorias.categoria_type', 'desc')
                                         ->get();

        //dd($registros);


        return view('fluxo.index', compact('registros'));
    }
}
