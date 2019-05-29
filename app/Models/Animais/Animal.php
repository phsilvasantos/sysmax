<?php

namespace App\Models\Animais;

use App\Models\ModelDefault;


class Animal extends ModelDefault
{

    protected $table = 'animais';

    public function racas()
    {
        return $this->belongsTo('App\Models\Racas\Raca');
    }


    public function Cliente()
    {
        return $this->belongsTo('App\Models\Clientes\Cliente');
    }

    public function Raca()
    {
        return $this->belongsTo('App\Models\Racas\Raca');
    }

    public function Detalhes()
    {

        return $this->hasMany('App\Models\Atendimentos\Atendimento_Detalhes');
    }

    public function Atendimentos()
    {

        return $this->hasMany('App\Models\Atendimentos\Atendimento');
    }

}
