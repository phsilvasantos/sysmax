<?php

namespace App\Models\Atendimentos;

use App\Models\ModelDefault;
use App\Models\Vacinas\Vacina;

class Atendimento_Detalhes extends ModelDefault
{
    //
    protected $table = 'atendimento_detalhes';


    public function Usuario()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function TodasVacinas()
    {
        return Vacina::all();
    }

}
