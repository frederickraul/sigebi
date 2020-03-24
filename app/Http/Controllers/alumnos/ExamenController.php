<?php

namespace App\Http\Controllers\Alumnos;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Pregunta;
use App\Examen;
use App\Resultado;
use Auth;

class ExamenController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('studentOnly');

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
            $user = Auth::user();
            $examen = Examen::where('user_id',$user->id)->first();
            if($examen){
                abort(403, 'Ehhh tramposillo, tu ya has hecho el examen.');
            }

            $user->authorizeRoles(['user', 'alumno']); 
       
            $preguntas = Pregunta::where('cuestionario_id',3)->inRandomOrder()->limit(10)->get();
            

        return view('a.examenes.view', compact('preguntas'));

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
        $clase = 2;
        $user = Auth::user();
        $parcial = 1;

        $datos = $request->except(['_token']);;
        $puntos = 0;
        if($datos['sel1'] == $datos['res1']){
            $puntos++;
        }
        if($datos['sel2'] == $datos['res2']){
            $puntos++;
        }
        if($datos['sel3'] == $datos['res3']){
            $puntos++;
        }
        if($datos['sel4'] == $datos['res4']){
            $puntos++;
        }
        if($datos['sel5'] == $datos['res5']){
            $puntos++;
        }
        if($datos['sel6'] == $datos['res6']){
            $puntos++;
        }
        if($datos['sel7'] == $datos['res7']){
            $puntos++;
        }
        if($datos['sel8'] == $datos['res8']){
            $puntos++;
        }
        if($datos['sel9'] == $datos['res9']){
            $puntos++;
        }
        if($datos['sel10'] == $datos['res10']){
            $puntos++;
        }

        //return $user->name."---  Calificacion: ".$puntos;
        /*
        $examen = new Examen;
        $examen->clase_id = $clase;
        $examen->parcial = $parcial;
        $examen->user_id = $user;
        if($examen->save()){
            $resultado = new Resultado;
            $resultado->calificacion = $puntos;
            $resultado->examen_id = $examen->id;
            $resultado->save();*/
            return view('a.examenes.results', compact('puntos'));
        

        return  $puntos;
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
