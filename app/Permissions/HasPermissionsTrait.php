<?php
namespace App\Permissions;

use App\Models\Auth\Permissions\Permission;
use App\Models\Auth\Roles\Role;
use DB;

trait HasPermissionsTrait {

    public function roles() {
        return $this->belongsToMany(Role::class,'users_roles');

    }


    public function permissions() {
        return $this->belongsToMany(Permission::class,'users_permissions');

    }

    public function hasRole( ... $roles ) {
        foreach ($roles as $role) {
            if ($this->roles->contains('name', $role)) {
                return true;
            }
        }
        return false;
    }


    protected function hasPermissionTo($permission) {
        return $this->hasPermission($permission);
    }

    protected function hasPermission($permission) {
        return (bool) $this->permissions->where('name', $permission->name)->count();
    }


    public function hasPermissionThroughRole($permission) {
        foreach ($permission->roles as $role){
            if($this->roles->contains($role)) {
                return true;
            }
        }
        return false;
    }


    public function givePermissionsTo(... $permissions) {
        $permissions = $this->getAllPermissions($permissions);
        //dd($permissions);
        if($permissions === null) {
            return $this;
        }
        $this->permissions()->saveMany($permissions);
        return $this;
    }


    public function deletePermissions( ... $permissions ) {
        $permissions = $this->getAllPermissions($permissions);
        $this->permissions()->detach($permissions);
        return $this;
    }


    public function semPapel(){

        if(DB::table('users_roles')->where('user_id', $this->id)->count() < 1){

            return true;
        }


    }


}
