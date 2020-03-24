<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Actividad;
use App\Tema;

class ActividadesController extends Controller
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
        $data = $request->all();
        $request->validate([
        'titulo'    => 'required',
        ]);

        $actividad = new Actividad;
        $actividad->titulo          = $data['titulo'];
        $actividad->instrucciones   = $data['instrucciones'];
        $actividad->fecha_de_entrega   = $data['fecha_de_entrega'];
        $actividad->tema_id          = $data['tema_id'];
        if($actividad->save()){
            return redirect()->to('actividades/'.$data['tema_id'])->with('success','La actividad ha sido registrada.');
        }else{
             return redirect()->to('actividades/'.$data['tema_id'])->with('danger','Hubo un error.');
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

        $tema = Tema::find($id);
        $actividades = Actividad::where('tema_id', $id)->get();
        return view('actividades.view',compact('tema','actividades'));
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
        $data = $request->all();
        $accion = $data['action'];

        if($accion == "updateArchivo"){
            $image = $request->file('file');
            $imageName  =    $image->getClientOriginalName();
            $mime       =    $image->getClientOriginalExtension();
            $image->move(public_path('data/actividades/'.$id.'/'),$imageName);
           
            $archivo          = Actividad::find($id);
            $archivo->url       = 'data/actividades/'.$id.'/'.$imageName;
            $archivo->archivo       = $imageName;
            $archivo->tipo          = $mime;
            $archivo->update();

            return response()->json(['success'=>$mime]);
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Borrar imagen
            $elemento          = Actividad::find($id);
            $tema_id           = $elemento->tema_id;
            $filename          = $elemento->url;
            $actividad         =  $elemento->actividad_id;

            $elemento->url       = "";
            $elemento->archivo   = "";
            $elemento->tipo      = "";
            $elemento->update();
        
                $path=public_path().'/'.$filename;
                if (file_exists($path)) {
                    unlink($path);
                }
            return redirect()->to('actividades/'.$tema_id);
    }
}
