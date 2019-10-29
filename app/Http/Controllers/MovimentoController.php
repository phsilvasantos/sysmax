<?php

namespace App\Http\Controllers;

use App\Models\Movimentos\Movimento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MovimentoController extends AppController
{

    public $model = Movimento::class;

    public function index()
    {
        //
        $data_ini = date('Y-m-d', strtotime('-1 weeks', strtotime(date('Y-m-d'))));
        $data_fim = date('Y-m-d');
        $conta_id = 'todas';

        $creditos = $this->model::whereBetween('data', [$data_ini . ' 00:00:00',date('Y-m-d') . ' 23:59:59'])->where('tipo','crédito')->sum('valor');
        $debitos = $this->model::whereBetween('data', [$data_ini . ' 00:00:00',date('Y-m-d') . ' 23:59:59'])->where('tipo','débito')->sum('valor');
        $saldo_inicial = $this->model::where('data','<' ,$data_ini . ' 00:00:00')->sum('valor');


        $registros = $this->model::whereBetween('data', [$data_ini . ' 00:00:00',date('Y-m-d') . ' 23:59:59'])->orderby('id','desc')->get();




        return view($this->name.'.index', compact('registros','data_ini','data_fim','creditos','debitos','saldo_inicial','conta_id'));

    }

    public function pesquisa(Request $request){

        $data_ini = $request->data_ini;
        $data_fim = $request->data_fim;
        $conta_id = $request->conta_id;

        if($request->conta_id == 'todas'){

            $creditos = $this->model::whereBetween('data', [$data_ini . ' 00:00:00',$data_fim . ' 23:59:59'])->where('tipo','crédito')->sum('valor');
            $debitos = $this->model::whereBetween('data', [$data_ini . ' 00:00:00',$data_fim . ' 23:59:59'])->where('tipo','débito')->sum('valor');
            $saldo_inicial = $this->model::where('data','<' ,$data_ini . ' 00:00:00')->sum('valor');
            $registros = $this->model::whereBetween('data', [$data_ini . ' 00:00:00',$data_fim . ' 23:59:59'])->orderby('id','desc')->get();


            return view($this->name.'.index', compact('registros','data_ini','data_fim','creditos','debitos','saldo_inicial','conta_id'));



        }else{

            $creditos = $this->model::whereBetween('data', [$data_ini . ' 00:00:00',$data_fim . ' 23:59:59'])->where('tipo','crédito')->where('conta_id', $conta_id)->sum('valor');
            $debitos = $this->model::whereBetween('data', [$data_ini . ' 00:00:00',$data_fim . ' 23:59:59'])->where('tipo','débito')->where('conta_id', $conta_id)->sum('valor');
            $saldo_inicial = $this->model::where('data','<' ,$data_ini . ' 00:00:00')->where('conta_id', $conta_id)->sum('valor');
            $registros = $this->model::whereBetween('data', [$data_ini . ' 00:00:00',$data_fim . ' 23:59:59'])->where('conta_id', $conta_id)->orderby('id','desc')->get();




            return view($this->name.'.index', compact('registros','data_ini','data_fim','creditos','debitos','saldo_inicial','conta_id'));



        }





    }



    public function store(Request $request)
    {
        //
        if($request->valor < 0) {
            $tipo = 'débito';
        }else{
            $tipo = 'crédito';
        }

        $dados = $request->except('_token','_method');
        $dados['user_id'] = Auth::user()->id;
        $dados['tipo'] = $tipo;



        $registro = new $this->model($dados);
        $registro->save();

        if($request->origem == 'novo'){

            return redirect()->route($this->name.'.create')->with('status', 'Registro Incluído');

        }elseif($request->origem == 'voltar'){

            return redirect()->route($this->name.'.index')->with('status', 'Registro Incluído');
        }

        return redirect()->route($this->name.'.edit', $registro->id)->with('status', 'Registro Incluído');
    }



}
