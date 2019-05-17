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
}
