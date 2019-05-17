<?php

namespace App\Models\Nfces;

use App\Models\ModelDefault;


class NfceDetalhe extends ModelDefault
{
    //
    protected $table = 'nfce_detalhes';



    public function Nfce()
    {
        return $this->belongsTo('App\Models\Nfces\Nfce');
    }
}
