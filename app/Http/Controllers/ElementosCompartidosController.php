<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ElementosCompartidos;
use App\Tema;

class ElementosCompartidosController extends Controller
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
    	$tema = $datos['tema_id2'];

        $image = $request->file('file');
        $imageName = $image->getClientOriginalName();
        $mime = $image->getClientMimeType();
        $image->move(public_path('data/temas/'.$tema.'/'),$imageName);
       
        $imageUpload = new ElementosCompartidos;
        $imageUpload->elemento 		= 'data/temas/'.$tema.'/'.$imageName;
        $imageUpload->descripcion 	= $datos['descripcion'];
        $imageUpload->tipo 			= $mime;
        $imageUpload->tema_id 		= $tema;
        if($imageUpload->save()){
           
        }
        return $datos;
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
    	$clase = Clase::findOrFail($id);
    	$temas = Tema::where('clase_id',$id)
    				  ->OrderBy('updated_at', 'desc')
    				  ->get();
        return view('temas/view', compact('clase', 'temas'));
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
        $elemento 	= ElementosCompartidos::find($id);
        $filename 	= $elemento->elemento;
        $tema 		= Tema::find($elemento->tema_id);
        $clase 		= $tema->clase_id;
        $tema 		= $elemento->tema_id;
        
        $elemento->delete();
            $path=public_path().'/'.$filename;
            if (file_exists($path)) {
                unlink($path);
            }
        return redirect()->to('temas/'.$clase.'#tema'.$tema);
    
    
    }	
}
