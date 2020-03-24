<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Examen extends Model
{
    protected $table = "examenes";

    public function user()
    {
        return $this->belongsTo('App\User');
    }

     public function resultado()
    {
       	return $this->hasOne('App\Resultado');
    }
}
