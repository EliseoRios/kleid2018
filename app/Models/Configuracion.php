<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Configuracion extends Model
{
    protected $table = "configuracion";

    public function usuario(){
    	return $this->belongsTo('App\Models\Usuarios','usuarios_id','id');
    }
    
    public function scopeActivos($query){
        return $query->where('estatus','<>',0);
    }
}
