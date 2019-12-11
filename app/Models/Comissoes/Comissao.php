<?php

namespace App\Models\Comissoes;

use Illuminate\Database\Eloquent\Model;

class Comissao extends Model
{
    //
    protected $table = 'comissoes';
    protected $fillable = ['tipo','user_id','produto_id','nome','valor','percentual','created_at','updated_at'];
}
