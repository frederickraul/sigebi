<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = ['numero', 'iniciales', 'clasificacion', 'titulo', 'subtitulo', 'paginas', 'autor', 'ejemplar', 'volumen','estado'];

    public function Autor(){
    	return $this->hasOne('App\Author','id','autor');
    }

    public function Estado(){
    	return $this->hasOne('App\Status','id','estado');
    }
}
