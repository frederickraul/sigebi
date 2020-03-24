<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imagen;
use App\Pregunta;

class ImagenesController extends Controller
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
         /*****************************
         *      Actualizar Imagen
         ******************************/
            $datos      = $request->all();
            $pregunta   = $datos['pregunta_id'];
            $imageUpload            = Imagen::where('pregunta_id', $pregunta)->first();
            if($imageUpload){
            	//Eliminamos la imagen anterior
                if($imageUpload->imagen != ""){
                 $path=public_path($imageUpload->imagen);
                    if (file_exists($path)) {
                        unlink($path);
                    }
                }
            
            }else{
            	$imageUpload = new Imagen;
            }
            
            //Guardamos imagen 
            $image = $request->file('file');
            $imageName = $image->getClientOriginalName();
            $mime = $image->getClientMimeType();
            $image->move(public_path('data/preguntas/'.$pregunta.'/'),$imageName);

            //Actualizar datos en la BD
            $imageUpload->imagen    	 = 'data/preguntas/'.$pregunta.'/'.$imageName;
            $imageUpload->pregunta_id    = $pregunta;
            if($imageUpload->save()){
               return response()->json(['success'=>$mime]);
            }else{
                $path=public_path('data/preguntas/'.$pregunta.'/'.$imageName);
                if (file_exists($path)) {
                    unlink($path);
                }
                return response()->json(['error'=>$mime]);
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
    	$pregunta 			= Pregunta::find($id);
        $elemento           = Imagen::where('pregunta_id', $id)->first();
        $filename           = $elemento->imagen;
        $elemento->imagen   = "";
        $elemento->update();
            $path=public_path().'/'.$filename;
            if (file_exists($path)) {
                unlink($path);
            }
                
        return redirect()->to('cuestionarios/'.$pregunta['cuestionario_id'].'/#pregunta'.$id);
            
    }
}
