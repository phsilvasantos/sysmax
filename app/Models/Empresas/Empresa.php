<?php

namespace App\Models\Empresas;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Schema;

class Empresa extends Model
{

    use SoftDeletes;

    //Permitir a alteração em massa dos campos
    protected $guarded = ['id'];

    //Sobrescrever o método para exibir os campos pois ao usar o guarded ele não exibe por padrão
    public function GetFillable()
    {

        $fillable = Schema::getColumnListing($this->getTable());
        return $fillable;
    }

    /*public function Nfce()
    {
        return $this->hasOne('App\Models\Nfces\Nfce', 'empresa_id','id');
    }*/

}
