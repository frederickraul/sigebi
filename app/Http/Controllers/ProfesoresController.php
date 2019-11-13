<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Profesor;

class ProfesoresController extends Controller
{
     public function index()
    {
        return view('profesores/view');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('profesores/add');

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
        'numero' => 'required|unique:alumnos',
        'nombre'  => 'required',
        'apellido'  => 'required',
    ]);


        $profesor = new Profesor;
        $profesor->foto       ='resources/img/undraw/undraw_male_avatar_323b.svg';
        $profesor->numero     = $datos['numero'];
        $profesor->nombre     = $datos['nombre'];
        $profesor->apellido   = $datos['apellido'];
        $profesor->save();
        return redirect()->to('profesores');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return redirect()->to('profesores');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $profesor = Profesor::find($id);
        if($profesor){
            return view('profesores/details',compact('profesor'));
        }else{
             return redirect()->to('profesores');
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

        $profesor = Profesor::find($id);

        if($profesor->numero == $datos['numero']){
            $request->validate([
            'numero' => 'required',
            'nombre'    => 'required',
            'apellido'  => 'required',
            ]);
        }else{
            $request->validate([
            'numero' => 'required|unique:profesores',
            'nombre'  => 'required',
            'apellido'  => 'required',
            ]);

        }

        $profesor->numero = $datos['numero'];
        $profesor->nombre     = $datos['nombre'];
        $profesor->apellido   = $datos['apellido'];
        $profesor->update();
        return redirect()->to('profesores/'.$id."/edit")->with('update','Los datos del profesor han sido actualizados.'); 
    }
  

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Profesor::find($id)->delete();
        return redirect()->to('profesores')->with('delete','El registro del profesor ha sido eliminado.');    
    }

}
