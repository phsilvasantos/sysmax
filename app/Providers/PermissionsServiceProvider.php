<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class PermissionsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Permission::get()->map(function($permission){
            Gate::define($permission->name, function($user) use ($permission){
                return $user->hasPermissionTo($permission);
            });
        });

        //blade directives
       /* Blade::directive('role', function ($role){
            return "<?php if(auth()->check() && auth()->user()->hasRole({$role})) :";
        });
        Blade::directive('endrole', function ($role){
            return "<?php endif; ?>";
        });*/

        //blade directives
        Blade::directive('permissao', function ($permission){
            return "<?php if(auth()->check() && auth()->user()->hasPermissionThroughRole({$permission})) :";
        });
        Blade::directive('permissao', function ($permission){
            return "<?php endif; ?>";
        });


    }
}
