<?php

namespace App\Models\Produtos;

use App\Models\ModelDefault;
use App\Models\Categorias\Categoria;

class Produto extends ModelDefault
{


    public function TodasCategorias()
    {
        return Categoria::where('categoria_type', 'Produtos')->get();
    }

    public function categorias()
    {
        return $this->belongsTo('App\Models\Categorias\Categoria', 'categoria_id','id');
    }
}
