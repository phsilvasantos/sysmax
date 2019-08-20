<?php

namespace App\Models\Leitos;

use App\Models\ModelDefault;
use App\Models\Setores\Setor;


class Leito extends ModelDefault
{
    //


    public function setor()
    {
        return $this->belongsTo('App\Models\Setores\Setor', 'setor_id','id');
    }
}
