<?php

namespace App\Models\Racas;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class Raca extends Model
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
}
