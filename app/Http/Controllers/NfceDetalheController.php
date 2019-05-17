<?php

namespace App\Http\Controllers;

use App\Models\Nfces\NfceDetalhe;
use Illuminate\Http\Request;

class NfceDetalheController extends AppController
{
    //
    public $model = NfceDetalhe::class;


    public function detalhes($nfce_id)
    {


        $registros = $this->model::where('nfce_id', $nfce_id)->get();

        return view('nfces.detalhes', compact('registros'));

    }
}
