<?php

namespace App\Models\Animais;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class Animal extends Model
{
    //
    //use SoftDeletes;

    //Permitir a alteração em massa dos campos
    protected $guarded = ['id'];

    protected $table = 'animais';

    //Sobrescrever o método para exibir os campos pois ao usar o guarded ele não exibe por padrão
    public function GetFillable()
    {

        $fillable = Schema::getColumnListing($this->getTable());
        return $fillable;
    }

    public function racas()
    {
        return $this->belongsTo('App\Models\Racas\Raca');
    }
}
