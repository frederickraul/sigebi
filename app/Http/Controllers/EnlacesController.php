<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Enlace;
use App\Tema;

class EnlacesController extends Controller
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

        $request->validate([
       	'tema_id'  					=> 'required',
       	'descripcion_del_enlace' 	=> 'required',
        'enlace' 					=> 'required|url',
    	]);

    	$clase = $datos['clase'];
    	$tema = $datos['tema_id'];

    	$enlace = new Enlace;
    	$enlace->enlace 		= $datos['enlace'];
    	$enlace->descripcion 	= $datos['descripcion_del_enlace'];
    	$enlace->tema_id 		= $datos['tema_id'];
  		if($enlace->save()){
        	return redirect()->to('temas/'.$clase.'#tema'.$tema);
        }else{
        	return redirect()->to('temas/'.$datos['clase']);
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
        $enlace = Enlace::find($id);
        $tema = Tema::find($enlace->tema_id);
        $clase = $tema->clase_id;
        $tema = $enlace->tema_id;
        $enlace->delete();


        return redirect()->to('temas/'.$clase.'#tema'.$tema);
      
    }	
    //
}
