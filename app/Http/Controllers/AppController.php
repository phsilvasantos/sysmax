<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AppController extends Controller
{

    public $model;
    public $name;

    /**
     * AppController constructor.
     * @param $name
     */
    public function __construct()
    {

        $instace = new $this->model;

        $this->name = $instace->getTable();



    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $registros = $this->model::all();


        return view($this->name.'.index', compact('registros'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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


    public function localizar(Request $request){

        $dados = $this->model::where('nome', 'like', '%'.$request->q.'%')->get();



        foreach ($dados as $key => $registro){

            $registros[$key]['id'] = $registro->id;
            $registros[$key]['text'] = $registro->nome;
        }

        $resultado['results'] = $registros;

        return response()->json($resultado);



    }



}
