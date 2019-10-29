<?php

namespace App\Models\Movimentos;

use Illuminate\Database\Eloquent\Model;

use App\Models\ModelDefault;

class Movimento extends ModelDefault
{
    //

    public function conta()
    {
        return $this->belongsTo('App\Models\Contas\Conta');
    }
}
