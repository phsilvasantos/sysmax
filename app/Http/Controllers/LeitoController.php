<?php

namespace App\Http\Controllers;

use App\Models\Leitos\Leito;
use App\Models\Setores\Setor;
use Illuminate\Http\Request;

class LeitoController extends AppController
{
    //
    public $model = Leito::class;


    public function create()
    {

        $setores = Setor::all();

        $instace = new $this->model;


        return view($this->name.'.create', compact('instace','setores'));

    }

    public function edit($id)
    {
        //
        $setores = Setor::all();

        $registro = $this->model::where('id',$id)->get()[0];


        return view($this->name.'.edit', compact('registro','setores'));
    }
}
