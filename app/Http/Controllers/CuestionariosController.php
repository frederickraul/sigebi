<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Cuestionario;
use App\Tema;

class CuestionariosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('teacherOnly');
    }
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
      
    ]);


       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cuestionario = Cuestionario::where('tema_id', $id)
                                     ->first();
        if($cuestionario){
            return view('cuestionarios/details', compact('cuestionario'));
        }else{

            $tema = Tema::find($id);
            $cuestionario = new Cuestionario;
            $cuestionario->clase_id = $tema->clase_id;
            $cuestionario->tema_id  = $id;
            $cuestionario->parcial  = $tema->parcial;
            if($cuestionario->save()){
                return view('cuestionarios/details', compact('cuestionario'));
            }
            

            return redirect()->to('clases/');
        }
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       
               

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
    
    }   
  

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      
    }
}
