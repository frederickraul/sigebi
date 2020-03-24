<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cuestionario extends Model
{
     public function tema()
    {
        return $this->belongsTo('App\Tema');
    }

     public function preguntas()
    {
        return $this->hasMany('App\Pregunta');
    }
}
