<?php

namespace App\Models\Nfces;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class Nfce extends Model
{

    protected $table = 'nfces';
    //Permitir a alteração em massa dos campos
    protected $guarded = ['id'];

    //Sobrescrever o método para exibir os campos pois ao usar o guarded ele não exibe por padrão
    public function GetFillable()
    {

        $fillable = Schema::getColumnListing($this->getTable());
        return $fillable;
    }

}
