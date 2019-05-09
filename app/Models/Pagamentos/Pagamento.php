<?php

namespace App\Models\Pagamentos;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class Pagamento extends Model
{
    //
    //use SoftDeletes;

    //Permitir a alteração em massa dos campos
    protected $guarded = ['id'];

    //Sobrescrever o método para exibir os campos pois ao usar o guarded ele não exibe por padrão
    public function GetFillable()
    {

        $fillable = Schema::getColumnListing($this->getTable());
        return $fillable;
    }


    public function Formas()
    {
        return $this->belongsTo('App\Models\Forma_Pagamentos\Forma_pagamento','forma_pagamento_id','id');
    }

    public function Usuario()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
}
