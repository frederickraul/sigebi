<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Periodo;
use App\Clase;
use App\Grupo;
use App\Alumno;
use App\Examen;

class ExamenesController extends Controller
{
        public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('teacherOnly');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $periodo = Periodo::OrderBy('year','desc')->OrderBy('semestre','desc')->first();
            $profesor = Auth::user()->id; 
            $clases = Clase::where('periodo_id', $periodo['id'])
                           ->where('profesor_id', $profesor)
                           ->get();
            $grupos = Grupo::OrderBy('grupo')->get();
            return view('examenes.view', compact('clases','grupos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $grupo = Grupo::find($id);
        $alumnos = Alumno::where('grupo_id',$id)->get();
        return view('examenes.details', compact('alumnos','grupo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $examenes = Examen::where('clase_id',1)->get();
        foreach ($examenes as $examen) {
           echo $examen->user['id'];
           echo '<br>';
           /*
            $alumno = new Alumno;
            $alumno->matricula = $examen->user['numero'];;
            $alumno->grupo_id  = 1;
            $alumno->user_id   = $examen->user['id'];;
            $alumno->save();*/
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
