<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Alumno;
class AlumnosController extends Controller
{
     public function index()
    {
        return view('alumnos/view');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('alumnos/add');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $datos = $request->all();
        $request->validate([
        'matricula' => 'required|unique:alumnos',
        'nombre'  => 'required',
        'apellido'  => 'required',
    ]);


        $alumno = new Alumno;
        $alumno->foto 		='resources/img/undraw/undraw_male_avatar_323b.svg';
       	$alumno->matricula  = $datos['matricula'];
       	$alumno->nombre 	= $datos['nombre'];
       	$alumno->apellido   = $datos['apellido'];
       	$alumno->grupo 		= "";
       	$alumno->save();
        return redirect()->to('alumnos');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    	return redirect()->to('alumnos');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $alumno = Alumno::find($id);
        if($alumno){
			return view('alumnos/details',compact('alumno'));
        }else{
        	 return redirect()->to('alumnos');
        }
               

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $datos = $request->all();

        $alumno = Alumno::find($id);

        if($alumno->matricula == $datos['matricula']){
        	$request->validate([
	        'matricula' => 'required',
	        'nombre'  	=> 'required',
	        'apellido'  => 'required',
	    	]);
        }else{
        	$request->validate([
	        'matricula' => 'required|unique:alumnos',
	        'nombre'  => 'required',
	        'apellido'  => 'required',
	    	]);

        }

       	$alumno->matricula  = $datos['matricula'];
       	$alumno->nombre 	= $datos['nombre'];
       	$alumno->apellido   = $datos['apellido'];
       	$alumno->update();
        return redirect()->to('alumnos/'.$id."/edit")->with('update','Los datos del alumno han sido actualizados.'); 
    }
  

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Alumno::find($id)->delete();
        return redirect()->to('alumnos')->with('delete','El registro del alumno ha sido eliminado.');    
    }

}
