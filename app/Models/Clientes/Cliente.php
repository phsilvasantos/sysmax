<?php

namespace App\Models\Clientes;

use App\Models\Categorias\Categoria;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class Cliente extends Model
{
    //use SoftDeletes;

    //Permitir a alteração em massa dos campos
    protected $guarded = ['id'];

    //Sobrescrever o método para exibir os campos pois ao usar o guarded ele não exibe por padrão
    public function GetFillable()
    {

        $fillable = Schema::getColumnListing($this->getTable());
        return $fillable;
    }


    public function TodasCategorias()
    {
        return Categoria::where('categoria_type', 'Clientes')->get();
    }

    public function categorias()
    {
        return $this->belongsToMany('App\Models\Categorias\Categoria');
    }

    public function animais()
    {
        return $this->hasMany('App\Models\Animais\Animal');
    }

}
