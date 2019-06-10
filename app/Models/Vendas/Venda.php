<?php

namespace App\Models\Vendas;

use App\Models\ModelDefault;
use App\User;
use App\Models\Produtos\Produto;

class Venda extends ModelDefault
{
    //


    public function TodosProdutos()
    {
        return Produto::all();
    }

    public function TodosUsuarios()
    {
        return User::all();
    }

    public function Itens()
    {
        return $this->hasMany('App\Models\Itens\Item', 'venda_id','id');
    }

    public function Pagamentos()
    {
        return $this->hasMany('App\Models\Pagamentos\Pagamento', 'venda_id','id');
    }

    public function Cliente()
    {
        return $this->belongsTo('App\Models\Clientes\Cliente');
    }

    public function Usuario()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }


    public function Nfce()
    {
        return $this->hasMany('App\Models\Nfces\Nfce', 'venda_id','id');
    }


}
