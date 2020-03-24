<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Periodo extends Model
{
    public function clases()
    {
        return $this->hasMany('App\Clase');
    }
}
