<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mensaje;

class MensajesController extends Controller
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
        $mensajes = Mensaje::OrderBy('created_at', 'desc')->get();
        return view("mensajes.view", compact('mensajes'));
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
        'email'       => 'required',
        'nombre'      => 'required',
        'mensaje'     => 'required'
    ]);

         $mensaje = new Mensaje;
         $mensaje->nombre   = $data['nombre'];
         $mensaje->email    = $data['email'];
         $mensaje->mensaje  = $data['mensaje'];
         $mensaje->save();
         return redirect()->to('/login')->with('success','Mensaje enviado.');   
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
