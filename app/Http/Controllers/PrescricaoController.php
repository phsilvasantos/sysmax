<?php

namespace App\Http\Controllers;

use App\Models\Prescricoes\Prescricao;
use Illuminate\Http\Request;

class PrescricaoController extends AppController
{


    public function create()
    {
        //
        $instace = new $this->model;


        return view($this->name.'.create', compact('instace'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        $registro = new $this->model($request->except('_token','_method'));
        $registro->save();

        if($request->origem == 'novo'){

            return redirect()->route($this->name.'.create')->with('status', 'Registro Incluído');

        }elseif($request->origem == 'voltar'){

            return redirect()->route($this->name.'.index')->with('status', 'Registro Incluído');
        }

        return redirect()->route($this->name.'.edit', $registro->id)->with('status', 'Registro Incluído');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Empresas\Empresa  $empresa
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $registro = $this->model::where('id',$id)->get()[0];


        return redirect()->route($this->name.'.create', $registro);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Empresas\Empresa  $empresa
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //


        $registro = $this->model::where('id',$id)->get()[0];


        return view($this->name.'.edit', compact('registro'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Empresas\Empresa  $empresa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $registro = $this->model::where('id',$id)->get()[0];

        $registro->update($request->except('_token','_method'));

        if($request->origem == 'novo'){

            return redirect()->route($this->name.'.create')->with('status', 'Registro Incluído');

        }elseif($request->origem == 'voltar'){

            return redirect()->route($this->name.'.index')->with('status', 'Registro Incluído');
        }

        return redirect()->route($this->name.'.edit', $registro)->with('status', 'Registro Atualizado');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Empresas\Empresa  $empresa
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $registro = $this->model::where('id',$id)->get()[0];

        $registro->delete();

        return redirect()->route($this->name.'.index')->with('status', 'Registro Excluído');

    }
}
