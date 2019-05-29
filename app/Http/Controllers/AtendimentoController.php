<?php

namespace App\Http\Controllers;

use App\Models\Atendimentos\Atendimento;
use App\Models\Atendimentos\Atendimento_Detalhes;
use Illuminate\Http\Request;

class AtendimentoController extends AppController
{
    //
    public $model = Atendimento::class;

    public function index()
    {
        //
        $registros = $this->model::whereBetween('data_recepcao', [date('Y-m-d') . ' 00:00:00',date('Y-m-d') . ' 23:59:59'])->get();

        dd($registros);

        return view($this->name.'.index', compact('registros'));

    }


    public function filtrar(Request $request)
    {
        //

        //dd($request->data);

        $registros = $this->model::whereBetween('data_recepcao', [$request->data . ' 00:00:00',$request->data . ' 23:59:59'])->get();


        return view($this->name.'.index', compact('registros'));

    }




    public function edit($id)
    {
        //
        $registro = $this->model::where('id',$id)->get()[0];

        if($registro->status == 'Aguardando'){

            $registro->status = 'Em Atendimento';
            $registro->data_atendimento = now();
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

        $registro = new $this->model($request->except('_token','_method'));
        $registro->save();


        if($request->peso) {
            $detalhes = Atendimento_Detalhes::create([
                'user_id' => $request->atendente_id,
                'atendimento_id' => $registro->id,
                'categoria' => 'Peso',
                'descricao' => $request->peso,
                'animal_id' => $request->animal_id
            ]);
        }

        return redirect()->route($this->name.'.index')->with('status', 'Registro Incluído');



    }

}
