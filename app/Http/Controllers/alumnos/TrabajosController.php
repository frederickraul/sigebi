<?php

namespace App\Http\Controllers\alumnos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Actividad;
use App\Trabajo;

class TrabajosController extends Controller
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
            $id= Auth::user()->alumno['id'];
            $data = $request->all();
            $actividad_id = $data['actividad_id'];

            $image = $request->file('file');
            $imageName          =    $image->getClientOriginalName();
            $mime               =    $image->getClientOriginalExtension();
            
            $image->move(public_path('data/trabajos/'.$actividad_id.'/'.$id.'/'),$imageName);
            
            $trabajo = new Trabajo;

            $trabajo->alumno_id     = $id;
            $trabajo->actividad_id  = $actividad_id;
            $trabajo->url       = 'data/trabajos/'.$actividad_id.'/'.$id.'/'.$imageName;
            $trabajo->archivo       = $imageName;
            $trabajo->tipo          = $mime;
            $trabajo->estado        = 1; //Entregada
            $trabajo->puntos        = 0; //puntos
            $trabajo->save();
                
            return response()->json(['success'=>$mime]);

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
        $elemento  = Trabajo::find($id);
        $filename   = $elemento->url;
        $actividad =  $elemento->actividad_id;
        
        $elemento->delete();
            $path=public_path().'/'.$filename;
            if (file_exists($path)) {
                unlink($path);
            }
        return redirect()->to('a/actividades/'.$actividad);
    }
}
