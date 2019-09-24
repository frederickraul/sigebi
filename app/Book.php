<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\SecondCategory;
use App\ThirdCategory;
class Book extends Model
{
    protected $fillable = ['numero', 'iniciales', 'clasificacion', 'titulo', 'subtitulo', 'categoria','subcategoria','paginas', 'autor', 'ejemplar', 'volumen','estado'];

    public function Autor(){
    	return $this->hasOne('App\Author','id','autor');
    }

    public function Estado(){
    	return $this->hasOne('App\Status','id','estado');
    }

    public function Categoria(){
    	return $this->hasOne('App\SecondCategory','id','categoria');
    }

     public function Subcategoria(){
    	return $this->hasOne('App\ThirdCategory','id','subcategoria');
    }
}
