<?php

namespace App\Http\Controllers;

use App\Models\Atendimentos\Atendimento;
use App\Models\Atendimentos\Atendimento_Detalhes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AtendimentoController extends AppController
{
    //
    public $model = Atendimento::class;

    public function index()
    {
        //
        if(!Auth::user()->roles->contains('name','Veterinário')){
            $registros = $this->model::whereBetween('data_recepcao', [date('Y-m-d') . ' 00:00:00',date('Y-m-d') . ' 23:59:59'])->wherein('tipo',['Ambulatorial',''])->get();

        }else{
            $registros = $this->model::whereBetween('data_recepcao', [date('Y-m-d') . ' 00:00:00',date('Y-m-d') . ' 23:59:59'])->wherein('tipo',['Ambulatorial',''])->whereIn('user_id', [Auth::user()->id, 3])->get();

        }




        return view($this->name.'.index', compact('registros'));

    }


    public function filtrar(Request $request)
    {
        //
        if(!Auth::user()->roles->contains('name','Veterinário')){
            $registros = $this->model::whereBetween('data_recepcao', [$request->data . ' 00:00:00',$request->data . ' 23:59:59'])->wherein('tipo',['Ambulatorial',''])->get();

        }else{
            $registros = $this->model::whereBetween('data_recepcao', [$request->data . ' 00:00:00',$request->data . ' 23:59:59'])->whereIn('user_id', [Auth::user()->id, 3])->wherein('tipo',['Ambulatorial',''])->get();

        }




        return view($this->name.'.index', compact('registros'));

    }




    public function edit($id)
    {
        //
        $registro = $this->model::where('id',$id)->get()[0];

        if($registro->status == 'Aguardando'){

            $registro->status = 'Em Atendimento';
            $registro->user_id = Auth::user()->id;
            $registro->data_atendimento = now();
            $registro->tipo = 'Ambulatorial';
            $registro->save();
        }


        return view($this->name.'.edit', compact('registro'));
    }


    public function update(Request $request, $id)
    {
        //
        $registro = $this->model::where('id',$id)->get()[0];

        $registro->update([
            'status' => 'Atendido'
        ]);

        return redirect()->route($this->name.'.index')->with('status', 'Registro Incluído');

    }

    public function imprimir(Request $request, $id){

        $detalhes = Atendimento_Detalhes::where('id', $id)->get()[0];

        $registro = Atendimento::where('id', $detalhes->atendimento_id)->get()[0];


        return view($this->name.'.imprimir', compact('registro','detalhes'));

    }

    public function store(Request $request)
    {
        //
        $dados = $request->except('_token','_method');
        $dados['tipo'] = 'Ambulatorial';




        $registro = new $this->model($dados);
        $registro->save();


        if($request->peso) {
            $detalhes = Atendimento_Detalhes::create([
                'user_id' => $request->atendente_id,
                'atendimento_id' => $registro->id,
                'categoria' => 'Peso',
                'descricao' => $request->peso,
                'animal_id' => $request->animal_id,

            ]);
        }

        return redirect()->route($this->name.'.index')->with('status', 'Registro Incluído');



    }


    public function internar(Request $request)
    {
        //

        $dados = $request->except('_token','_method','animal_id1');

        if(!isset($request->origem)){
            $dados['animal_id'] = $request->animal_id1;
        }

        $dados['data_atendimento'] = $request->data_recepcao;
        $dados['status'] = 'Em Atendimento';
        $dados['tipo'] = 'Internacao';


        $registro = new $this->model($dados);
        $registro->save();


        if(isset($request->origem)){

            //encerrar o atendimento ambulatorial
            $registro_amb = $this->model::where('id',$request->atendimento_id)->get()[0];
            $registro_amb->update([
                'status' => 'Atendido',
                'atendimento_origem' => $registro->id
            ]);

            return redirect()->route('atendimento.internacao')->with('status', 'Internação Efetuada com sucesso!');

        }else{

            return redirect()->route('clientes.edit', $registro->Animal->Cliente->id)->with('status', 'Internação Efetuada com sucesso!');

        }



    }


    public function internacao(Request $request)
    {

        if(isset($request->data_ini)){

            $registros = $this->model::where('tipo','Internacao')->get();
            $registros_alta = $this->model::where('tipo','Internacao')->whereBetween('data_recepcao', [$request->data_ini . ' 00:00:00', $request->data_fim . ' 23:59:59'])->get();
            $data_ini = $request->data_ini;
            $data_fim = $request->data_fim;

        }else{

            $registros = $this->model::where('tipo','Internacao')->get();
            $registros_alta = $this->model::where('tipo','Internacao')->whereBetween('data_recepcao', [date('Y-m-d') . ' 00:00:00', date('Y-m-d') . ' 23:59:59'])->get();
            $data_ini = date('Y-m-d');
            $data_fim = date('Y-m-d');
        }




        return view($this->name.'.internacao', compact('registros','registros_alta','data_ini','data_fim'));

    }



}
