<?php

namespace App\Models\Contas;

use Illuminate\Database\Eloquent\Model;
use App\Models\ModelDefault;

class Conta extends ModelDefault
{
    //

    public function categorias()
    {
        return $this->belongsTo('App\Models\Categorias\Categoria', 'categoria_id','id');
    }
}
