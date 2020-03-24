<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Actividad extends Model
{
    protected $table = "actividades";

    public function tema()
    {
        return $this->belongsTo('App\Tema');
    }   

    public function trabajos(){
    	return $this->hasMany('App\Trabajo');
    }
}
