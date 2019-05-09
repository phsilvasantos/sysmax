<?php

namespace App\Http\Controllers;

use App\Models\Animais\Animal;
use Illuminate\Http\Request;

class AnimalController extends AppController
{
    //
    public $model = Animal::class;


    public function edit($id)
    {

        $registro = $this->model::where('id',$id)->get()[0];

        return json_encode($registro);


    }


    public function store(Request $request)
    {

        $registro = new $this->model($request->except('_token','_method'));
        $registro->save();


        return redirect()->route('clientes.edit', $registro->cliente_id)->with('status', 'Animal Incluido');

    }

    public function update(Request $request, $id)
    {

        $registro = $this->model::where('id',$id)->get()[0];


        $registro->update($request->except('_token','_method'));

        return redirect()->route('clientes.edit', $registro->cliente_id)->with('status', 'Animal Incluido');


    }

}
