<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Periodo;
use App\Clase;
use App\Grupo;
use App\Aula;
use App\Alumno;
use Auth;

class AulasController extends Controller
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
    	if($periodo){
    		$profesor = Auth::user()->id; 
    		$clases = Clase::where('periodo_id', $periodo['id'])
    					   ->where('profesor_id', $profesor)
    					   ->get();
            $grupos = Grupo::OrderBy('grupo')->get();
    		return view('aulas.view', compact('clases','grupos'));
    		
    	}

        return redirect()->to('catalogos/periodos');
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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

        $aula = Aula::where("clase_id", $datos['clase'])
                      ->where("grupo_id", $datos['grupo'])
                      ->first();


       if($aula){
            return redirect()->to('aulas')->with('warning','No se puede asignar el mismo grupo mas de una vez.');
       }
       else{
        $aula = new Aula;
        $aula->clase_id      = $datos['clase'];
        $aula->grupo_id      = $datos['grupo'];
        
        if($aula->save()){
            return redirect()->to('aulas')->with('success','El grupo ha sido asignado a la clase.');
        }else{
            return redirect()->to('clases')->with('danger','Ups.. hubo un problema.');
        }
       }
       
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
        return view('aulas.details', compact('grupo'));

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