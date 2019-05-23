<?php

namespace App\Models\Auth\Permissions;

//use App\Models\ModelDefault;
use App\Models\Auth\Roles\Role;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class Permission extends Model
{
    //
    protected $dates = ['created_at','updated_at','deleted_at'];

    //Permitir a alteração em massa dos campos
    protected $guarded = ['id'];

    //Sobrescrever o método para exibir os campos pois ao usar o guarded ele não exibe por padrão
    public function GetFillable()
    {

        $fillable = Schema::getColumnListing($this->getTable());
        return $fillable;
    }



    public function roles() {
        return $this->belongsToMany(Role::class,'roles_permissions');
    }


}
