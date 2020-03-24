<?php

namespace App\Http\Controllers\Alumnos;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Auth;
use App\Alumno;
use App\Grupo;
class AlumnoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('studentOnly');

    }

     public function index()
    {
        $grupos = Grupo::all();
        return view('a.alumno.grupo', compact('grupos'));
    }



    public function store(Request $request)
    {


    }



    public function update(Request $request, $id)
    {
        $user = Auth::user();
    
        $datos = $request->all();
        $request->validate([
        'grupo' => 'required'
    ]);

          $alumno = Alumno::where('user_id', $user->id)->first();
        if($alumno){
            $alumno->grupo_id = $datos['grupo'];
            $alumno->update();
        }else{
            $alumno = new Alumno;
            $alumno->grupo_id = $datos['grupo'];
            $alumno->matricula = $user->numero;
            $alumno->nombre    = $user->name;
            $alumno->user_id   = $user->id;
            $alumno->save();
        }


        return redirect()->to('a/clases'); 
    }
  

}
