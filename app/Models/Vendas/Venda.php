<?php

namespace App\Models\Vendas;

use App\Models\ModelDefault;
use App\User;
use App\Models\Produtos\Produto;
use DB;

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

    public function Animal()
    {
        return $this->belongsTo('App\Models\Animais\Animal', 'animal_id', 'id');
    }

    public function TotalItens($id)
    {
        $itens =  DB::table('items')->where('venda_id', $id)->where('deleted_at', null)->get();


        $total = 0;

        if(isset($itens)) {
            foreach ($itens as $item) {

                $total += $item->valor_total;
            }
        }

        return $total;
    }


    public function TotalPagamentos($id)
    {
        $pagamentos =  DB::table('pagamentos')->where('venda_id', $id)->where('deleted_at', null)->get();

        $total = 0;

        if(isset($pagamentos)) {
            foreach ($pagamentos as $pagamento) {

                $total += $pagamento->valor;
            }
        }

        return $total;
    }


}
