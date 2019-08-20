<?php

namespace App\Models\Atendimentos;

use App\Models\ModelDefault;

class Atendimento extends ModelDefault
{
    //

    public function Animal()
    {
        return $this->belongsTo('App\Models\Animais\Animal');
    }

    public function Detalhes()
    {
        return $this->hasMany('App\Models\Atendimentos\Atendimento_Detalhes');
    }

    public function Veterinario()
    {
        return $this->belongsTo('App\User','user_id','id');
    }

    public function Leito()
    {
        return $this->belongsTo('App\Models\Leitos\Leito','leito_id','id');
    }
}
