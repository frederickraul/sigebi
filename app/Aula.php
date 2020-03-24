<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Aula extends Model
{
    public function grupo()
    {
        return $this->belongsTo('App\Grupo');
    }    

    public function clase()
    {
        return $this->belongsTo('App\Clase');
    }
}
