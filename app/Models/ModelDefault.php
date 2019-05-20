<?php

namespace App\Models;

use App\Scopes\EmpresaGlobalScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Schema;

class ModelDefault extends Model
{
    //
    use EmpresaGlobalScope, SoftDeletes;
    protected $dates = ['created_at','updated_at','deleted_at'];

    //Permitir a alteração em massa dos campos
    protected $guarded = ['id'];

    //Sobrescrever o método para exibir os campos pois ao usar o guarded ele não exibe por padrão
    public function GetFillable()
    {

        $fillable = Schema::getColumnListing($this->getTable());
        return $fillable;
    }
}
