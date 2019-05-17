<?php

namespace App\Models\Itens;

use App\Models\ModelDefault;


class Item extends ModelDefault
{


    public function Produto()
    {
        return $this->belongsTo('App\Models\Produtos\Produto');
    }


    public function Usuario()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

}
