<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pregunta extends Model
{
    public function respuestas()
    {
        return $this->hasOne('App\Respuesta');
    }

    public function imagen()
    {
        return $this->hasOne('App\Imagen');
    }
}
