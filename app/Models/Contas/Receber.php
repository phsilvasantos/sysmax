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
        return Categoria::where('categoria_type', 'Receber')->get();
    }


    public function Cliente()
    {
        return $this->belongsTo('App\Models\Clientes\Cliente');
    }
}
