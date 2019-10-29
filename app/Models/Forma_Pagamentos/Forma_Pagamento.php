<?php

namespace App\Models\Forma_Pagamentos;

use App\Models\ModelDefault;



class Forma_Pagamento extends ModelDefault
{
    //
    protected $table = 'forma_pagamentos';


    public function taxas()
    {
        return $this->hasMany('App\Models\Taxas\Taxa', 'forma_pagamento_id','id');
    }
}
