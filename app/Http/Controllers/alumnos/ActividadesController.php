<?php

namespace App\Http\Controllers\Alumnos;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Auth;
use App\Actividad;
use App\Trabajo;
use App\Tema;

class ActividadesController extends Controller
{
        public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('studentOnly');

    }


    public function show($id)
    {
        $alumno_id = Auth::user()->alumno['id'];

        $actividad = Actividad::find($id);
        $trabajo   = Trabajo::where('alumno_id', $alumno_id)
                             ->where('actividad_id',$id)->first();

        //Si no hay trabajo entregado creamos un objeto vacio
        if(!$trabajo){
            $trabajo   = new Trabajo;
            $trabajo->url   ="";    
            $trabajo->archivo   ="";    
            $trabajo->tipo   ="";    
            $trabajo->puntos    = 0;                          
            $trabajo->estado    = 0;                          
        }       

        return view('a.actividades.view',compact('actividad','trabajo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

}
