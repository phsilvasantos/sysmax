<?php

namespace App\Scopes;

use App\Scopes\EmpresaScope;
use Illuminate\Database\Eloquent\Model;

trait EmpresaGlobalScope{
    
protected static function boot(){
    


    parent::boot();
    
    static::addGlobalScope(new EmpresaScope());
    
    static::creating(function(Model $model){
       
       $empresa_id =  \Auth::user()->empresa_id;
       $model->empresa_id =  $empresa_id;
        
    });
    
}
    
}


