<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Asignatura;

class AsignaturasController extends Controller
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
        return view('catalogos.asignaturas.view');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('catalogos.asignaturas.create');
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
        'nombre' => 'required|unique:asignaturas',
        'nombre_corto'  => 'required',
    ]);


        $element = new Asignatura;
        $element->nombre  = Str::lower($datos['nombre']);
        $element->slug     = Str::lower($datos['nombre_corto']);
        $element->clave    = "00000";
        $element->imagen    = "resources/img/asignaturas/default.jpg";
        $element->save();
        return redirect()->to('catalogos/asignaturas')->with('create','Los datos de la asignatura han sido registrados.');
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
