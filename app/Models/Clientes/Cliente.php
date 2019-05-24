<?php

namespace App\Models\Clientes;

use App\Models\Categorias\Categoria;
use App\Models\ModelDefault;


class Cliente extends ModelDefault
{


    public function TodasCategorias()
    {
        return Categoria::where('categoria_type', 'Clientes')->get();
    }

    public function categorias()
    {
        return $this->belongsToMany('App\Models\Categorias\Categoria')->withPivot('id','created_at')->withTimestamps();
    }

    public function animais()
    {
        return $this->hasMany('App\Models\Animais\Animal');
    }

}
