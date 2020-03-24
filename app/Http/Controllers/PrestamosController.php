<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Prestamo;

class PrestamosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('prestamos.view');
    }

    public function record()
    {
        return view('prestamos.record');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('prestamos.add');
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
        $prestamo = new Prestamo;
        $prestamo->tipo = $datos['tipo'];
        $prestamo->usuario = $datos['usuario'];
        $prestamo->grupo = $datos['grupo'];
        $prestamo->libro = $datos['libro'];
        $prestamo->entrega = $datos['fecha'];
        $prestamo->estado = 0;
        $prestamo->save();
        return redirect()->to('prestamos')->with('create','El prestamo ha sido registrado.'); 
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
        $element = Prestamo::find($id);
        return view('prestamos.edit',compact('element'));
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
        $element = Prestamo::find($id);
        $element->estado = 1;
        $element->update();
        return redirect()->to('prestamos/historial');
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
