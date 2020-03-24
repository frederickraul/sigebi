<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tema extends Model
{
	    protected $dates = [
        'created_at',
        'updated_at',
    ];

    function clase(){
        return $this->belongsTo('App\Clase');
    }
    function elementosCompartidos(){
    	return $this->hasMany('App\ElementosCompartidos');
    }

    function enlaces(){
    	return $this->hasMany('App\Enlace');
    }

    function actividades(){
        return $this->hasMany('App\Actividad');
    }

    function getUpdateTime(){
    	$time =  $this->updated_at->diffForHumans();
    	return $time;
    }



}
