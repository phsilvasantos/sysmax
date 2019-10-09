<?php

namespace App\Models\Contas;

use App\Models\Categorias\Categoria;
use App\Models\ModelDefault;
use Illuminate\Database\Eloquent\Model;

class Receber extends ModelDefault
{
    //
    public $table = 'receber';

    public function TodasCategorias()
    {
        return Categoria::where('categoria_type', 'Receber')->orwhere('categoria_type','Pagar')->get();
    }


    public function Cliente()
    {
        return $this->belongsTo('App\Models\Clientes\Cliente');
    }


    public function Parcelas()
    {
        return $this->hasMany('App\Models\Contas\Receber','receber_id','id');
    }




}
