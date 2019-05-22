<?php

namespace App\Http\Controllers;

use App\Models\Atendimentos\Atendimento;
use Illuminate\Http\Request;

class AtendimentoController extends AppController
{
    //
    public $model = Atendimento::class;


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




    }

}
