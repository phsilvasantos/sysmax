<?php

namespace App\Models\Vendas;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;
use App\Models\Produtos\Produto;

class Venda extends Model
{
    //
    //use SoftDeletes;

    //Permitir a alteração em massa dos campos
    protected $guarded = ['id'];

    //Sobrescrever o método para exibir os campos pois ao usar o guarded ele não exibe por padrão
    public function GetFillable()
    {

        $fillable = Schema::getColumnListing($this->getTable());
        return $fillable;
    }

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




}
