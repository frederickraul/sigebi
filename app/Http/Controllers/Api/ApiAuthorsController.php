<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Autor;


class ApiAuthorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Autor::OrderBy('nombre','asc')->OrderBy('apellido','asc')->paginate(50);
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
             $this->validate($request, [
            'nombre' => 'required|min:3',
            ]);
    

         $nombre = Str::lower($data['nombre']);
         $apellido = Str::lower($data['apellido']);

         $autor = Autor::where('nombre',$nombre)
                        ->where('apellido',$apellido)
                        ->first();
        if(count($autor) > 0){
            return response()->json([
            'message' => 'El autor ya existe',
            'errors'  => 'repetido',
            'id'      => $autor->id,
            'nombre'    => $autor->nombre,
            'apellido'    => $autor->apellido,
            ]);
        }

         $autor = new Autor;
         $autor->nombre = $nombre;
         $autor->apellido = $apellido;
         if($autor->save()){
            return response()->json([
            'message' => 'success',
            'errors'  => 'none',
            'id'      => $autor->id,
            'nombre'    => $autor->nombre,
            'apellido'    => $autor->apellido,
            ]);
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
        return Autor::find($id);
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
