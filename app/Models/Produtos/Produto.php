<?php

namespace App\Models\Produtos;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;
use App\Models\Categorias\Categoria;

class Produto extends Model
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
        return Categoria::where('categoria_type', 'Produtos')->get();
    }

    public function categorias()
    {
        return $this->belongsTo('App\Models\Categorias\Categoria', 'categoria_id','id');
    }
}
