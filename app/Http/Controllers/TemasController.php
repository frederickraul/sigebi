<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Clase;
use App\Tema;
use App\Chat;

class TemasController extends Controller
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
       	'clase' 	=> 'required',
        'tema' 		=> 'required',
        'parcial'  	=> 'required',
        'unidad'  	=> 'required',
    	]);

        
        $tema = new Tema;
        $tema->tema = $datos ['tema'];
        $tema->parcial = $datos ['parcial'];
        $tema->unidad = $datos ['unidad'];
        $tema->clase_id = $datos ['clase'];
       
        if($tema->save()){
        	return redirect()->to('temas/'.$datos['clase'])->with('success','Los datos del tema han sido registrados.');
        }else{
        	return redirect()->to('temas/'.$datos['clase'])->with('danger','Hubo un error.');
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
        $messages = Chat::where('clase_id', $id)
                        ->OrderBy('created_at','asc')
                        ->latest()->take(50)->get();

        $last = Chat::where('clase_id', $id)
                        ->latest()
                        ->OrderBy('created_at','desc')
                        ->first();
        if($last){
            $last = $last->created_at;
        }                
        
    	$clase = Clase::findOrFail($id);
    	$temas = Tema::where('clase_id',$id)
    				  ->OrderBy('updated_at', 'desc')
    				  ->get();
        

        return view('temas/view', compact('clase', 'temas','messages','last'));
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
