<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clase extends Model
{
     public function asignatura()
    {
        return $this->belongsTo('App\Asignatura');
    }

    public function periodo()
    {
        return $this->belongsTo('App\Periodo');
    }

        public function aulas()
    {
        return $this->hasMany('App\Aula');
    }

    public function profesor()
    {
        return $this->belongsTo('App\User','profesor_id','id');
    }
}
