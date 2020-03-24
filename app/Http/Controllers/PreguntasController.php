<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pregunta;
use App\Respuesta;

class PreguntasController extends Controller
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
        //
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
        $datos = $request->all();
        $request->validate([
        'pregunta'            => 'required',                
        'cuestionario_id'     => 'required',

        'respuesta_A'         => 'required',
        'respuesta_B'         => 'required',
        'respuesta_C'         => 'required',
        'respuesta_D'         => 'required',
        'respuesta_correcta'  => 'required',
        ]);
        
        $pregunta                   = new Pregunta;
        $pregunta->pregunta         = $datos['pregunta'];
        $pregunta->cuestionario_id  = $datos['cuestionario_id'];

            if($pregunta->save()){
                $respuestas = new Respuesta;
                $respuestas->respuesta_A        = $datos['respuesta_A'];
                $respuestas->respuesta_B        = $datos['respuesta_B'];
                $respuestas->respuesta_C        = $datos['respuesta_C'];
                $respuestas->respuesta_D        = $datos['respuesta_D'];
                $respuestas->respuesta_correcta = $datos['respuesta_correcta'];
                $respuestas->pregunta_id        = $pregunta->id;

                if($respuestas->save()){
                return redirect()->to('cuestionarios/'.$datos['cuestionario_id'])->with('success','Los datos de la pregunta han sido registrados.');
                }

                Pregunta::find($pregunta->id)->delete();
            }

        return redirect()->to('cuestionarios/'.$datos['cuestionario_id'])->with('danger','Ups.. hubo un problema.');
 

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
        $datos = $request->all();
        $request->validate([
        'modificar_pregunta'            => 'required',                
        'modificar_respuesta_A'         => 'required',
        'modificar_respuesta_B'         => 'required',
        'modificar_respuesta_C'         => 'required',
        'modificar_respuesta_D'         => 'required',
        'modificar_respuesta_correcta'  => 'required',
        ]);
        
        $pregunta                   = Pregunta::find($id);
        $pregunta->pregunta         = $datos['modificar_pregunta'];

            if($pregunta->update()){
                $respuestas = Respuesta::where('pregunta_id', $id)->first();
                $respuestas->respuesta_A        = $datos['modificar_respuesta_A'];
                $respuestas->respuesta_B        = $datos['modificar_respuesta_B'];
                $respuestas->respuesta_C        = $datos['modificar_respuesta_C'];
                $respuestas->respuesta_D        = $datos['modificar_respuesta_D'];
                $respuestas->respuesta_correcta = $datos['modificar_respuesta_correcta'];
                

                if($respuestas->update()){
                return redirect()->to('cuestionarios/'.$pregunta['cuestionario_id'])->with('success','Los datos de la pregunta han sido actualizados.');
                }
            }

        return redirect()->to('cuestionarios/'.$datos['cuestionario_id'])->with('danger','Ups.. hubo un problema.');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $elemento      = Pregunta::find($id);
        $cuestionario  = $elemento['cuestionario_id'];
        if($elemento->delete()){
            $elemento = Respuesta::where('pregunta_id',$id)->delete();
              return redirect()->to('cuestionarios/'.$cuestionario)->with('warning','Los datos de la pregunta han sido eliminados.');
        }
          return redirect()->to('cuestionarios/'.$cuestionario)->with('danger','Ups... hubo un problema');
    }
}
