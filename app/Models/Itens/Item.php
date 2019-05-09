<?php

namespace App\Models\Itens;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class Item extends Model
{
    //
    //use SoftDeletes;
    protected $table = 'items';

    //Permitir a alteração em massa dos campos
    protected $guarded = ['id'];

    //Sobrescrever o método para exibir os campos pois ao usar o guarded ele não exibe por padrão
    public function GetFillable()
    {

        $fillable = Schema::getColumnListing($this->getTable());
        return $fillable;
    }

    public function Produto()
    {
        return $this->belongsTo('App\Models\Produtos\Produto');
    }


    public function Usuario()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

}
