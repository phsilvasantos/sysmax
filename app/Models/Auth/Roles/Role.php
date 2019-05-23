<?php

namespace App\Models\Auth\Roles;

//use App\Models\ModelDefault;
use App\Models\Auth\Permissions\Permission;
use App\Scopes\EmpresaGlobalScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class Role extends Model
{
    //
    use EmpresaGlobalScope;


    protected $dates = ['created_at','updated_at','deleted_at'];

    //Permitir a alteração em massa dos campos
    protected $guarded = ['id'];

    //Sobrescrever o método para exibir os campos pois ao usar o guarded ele não exibe por padrão
    public function GetFillable()
    {

        $fillable = Schema::getColumnListing($this->getTable());
        return $fillable;
    }

    public function permissions() {
        return $this->belongsToMany(Permission::class,'roles_permissions');
    }


    public function HasPermission($permission) {
        return Permission::where('name', $permission)->count();
    }

}
