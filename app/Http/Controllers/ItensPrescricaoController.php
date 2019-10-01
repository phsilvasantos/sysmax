<?php

namespace App\Http\Controllers;

use App\Models\Prescricoes\ItensPrescricao;
use Illuminate\Http\Request;

class ItensPrescricaoController extends AppController
{
    public $model = ItensPrescricao::class;

    public function store(Request $request)
    {
        //

        $registro = new $this->model($request->except('_token','_method'));
        $registro->save();

        if($request->origem == 'novo'){

            return redirect()->route('itens_prescricao.create')->with('status', 'Registro Incluído');

        }elseif($request->origem == 'voltar'){

            return redirect()->route('itens_prescricao.index')->with('status', 'Registro Incluído');
        }

        return redirect()->route('itens_prescricao.edit', $registro->id)->with('status', 'Registro Incluído');
    }

    public function update(Request $request, $id)
    {
        //
        $registro = $this->model::where('id',$id)->get()[0];

        $registro->update($request->except('_token','_method'));

        if($request->origem == 'novo'){

            return redirect()->route('itens_prescricao.create')->with('status', 'Registro Incluído');

        }elseif($request->origem == 'voltar'){

            return redirect()->route('itens_prescricao.index')->with('status', 'Registro Incluído');
        }

        return redirect()->route('itens_prescricao.edit', $registro)->with('status', 'Registro Atualizado');

    }
}
