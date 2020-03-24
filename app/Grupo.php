<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    public function alumnos()
    {
        return $this->hasMany('App\Alumno')->OrderBy('nombre');
    }

    public function aulas()
    {
        return $this->hasMany('App\Aula');
    }
}
