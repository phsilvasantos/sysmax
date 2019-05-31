<?php

namespace App\Models\Pagamentos;

use App\Models\ModelDefault;


class Pagamento extends ModelDefault
{


    public function Formas()
    {
        return $this->belongsTo('App\Models\Forma_Pagamentos\Forma_pagamento','id','forma_pagamento_id');
    }

    public function Usuario()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
}
