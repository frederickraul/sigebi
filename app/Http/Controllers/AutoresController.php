<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Autor;

class AutoresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $autores = Autor::all();
        foreach ($autores as $autor) {
            $dato1 = $autor->nombre;
            $dato2 = explode(" ", $dato1);
            $nombre =  $dato2[0];
            $apellido = "";
            if(count($dato2) > 1){
                $apellido = $dato2[1];
            }
            if(count($dato2) > 2){
                $apellido = $dato2[1]." ".$dato2[2];
            }
             if(count($dato2) > 3){
                $apellido = $dato2[1]." ".$dato2[2]." ".$dato2[3];
            }
             if(count($dato2) > 4){
                $apellido = $dato2[1]." ".$dato2[2]." ".$dato2[3]." ".$dato2[4];
            }
             if(count($dato2) > 5){
                $apellido = $dato2[1]." ".$dato2[2]." ".$dato2[3]." ".$dato2[4]." ".$dato2[5];
            }
             if(count($dato2) > 6){
                $apellido = $dato2[1]." ".$dato2[2]." ".$dato2[3]." ".$dato2[4]." ".$dato2[5]." ".$dato2[6];
            }
            
            $A = Autor::find($autor->id);
            $A->nombre = $nombre;
            $A->apellido = $apellido;
            $A->update();
            echo $autor->id;
        }
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
        //
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
