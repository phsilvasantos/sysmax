<?php

namespace App\Models\Forma_Pagamentos;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class Forma_Pagamento extends Model
{
    //
    protected $table = 'forma_pagamentos';

    //Permitir a alteração em massa dos campos
    protected $guarded = ['id'];

    //Sobrescrever o método para exibir os campos pois ao usar o guarded ele não exibe por padrão
    public function GetFillable()
    {



        $fillable = Schema::getColumnListing($this->getTable());
        return $fillable;
    }
}
