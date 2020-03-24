<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Auth;
use App\Alumno;
use App\User;
use App\Role;
class AlumnosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('teacherOnly');
    }

     public function index()
    {
        return view('alumnos/view');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('alumnos/add');

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
        'matricula' => 'required|unique:alumnos',
        'nombre'  => 'required',
        'apellido'  => 'required',
    ]);


        $alumno = new Alumno;
        $alumno->foto 		='resources/img/undraw/undraw_male_avatar_323b.svg';
       	$alumno->matricula  = $datos['matricula'];
       	$alumno->nombre 	= $datos['nombre'];
       	$alumno->apellido   = $datos['apellido'];
       	$alumno->grupo 		= "";
       	$alumno->save();
        return redirect()->to('alumnos');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    	return redirect()->to('alumnos');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $alumno = Alumno::find($id);
        if($alumno){
			return view('alumnos/details',compact('alumno'));
        }else{
        	 return redirect()->to('alumnos');
        }
               

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
        $datos = $request->all();

        $alumno = Alumno::find($id);

        if($alumno->matricula == $datos['matricula']){
        	$request->validate([
	        'matricula' => 'required',
	        'nombre'  	=> 'required',
	        'apellido'  => 'required',
	    	]);
        }else{
        	$request->validate([
	        'matricula' => 'required|unique:alumnos',
	        'nombre'  => 'required',
	        'apellido'  => 'required',
	    	]);

        }

       	$alumno->matricula  = $datos['matricula'];
       	$alumno->nombre 	= $datos['nombre'];
       	$alumno->apellido   = $datos['apellido'];
       	$alumno->update();
        return redirect()->to('alumnos/'.$id."/edit")->with('update','Los datos del alumno han sido actualizados.'); 
    }
  

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Alumno::find($id)->delete();
        return redirect()->to('alumnos')->with('delete','El registro del alumno ha sido eliminado.');    
    }

    public function import()
    {
        set_time_limit(0);
        Excel::load('public/alumnos.csv', function($reader) {
        $i=1;
        foreach ($reader->get() as $alumno) {

            $user = User::where('numero',$alumno->matricula)->first();
             if($user){
                $user->name = $alumno->nombre;
                $user->update();

                  $alum = Alumno::where('user_id', $user->id)->first();
                    if($alum){
                        $alum->matricula = $alumno->matricula;
                        $alum->nombre    = $alumno->nombre;
                        $alum->grupo_id  = $alumno->grupo;
                        $alum->update();
                    }
                    else{
                        $alum = new Alumno();
                        $alum->matricula = $alumno->matricula;
                        $alum->nombre    = $alumno->nombre;
                        $alum->grupo_id  = $alumno->grupo;
                        $alum->user_id  =  $user->id;
                         $alum->save();
                    }

             }else{
                $user = new User;
                $user->name     = $alumno->nombre;
                $user->numero   = $alumno->matricula;
                $user->password   = "123";
                $user->save();
                 $user
                ->roles()
                ->attach(Role::where('name', 'alumno')->first());

                $alum = Alumno::where('matricula', $user->id)->first();
                    if($alum){
                        $alum->matricula = $alumno->matricula;
                        $alum->nombre    = $alumno->nombre;
                        $alum->grupo_id  = $alumno->grupo;
                        $alum->update();
                    }
                    else{
                        $alum = new Alumno();
                        $alum->matricula = $alumno->matricula;
                        $alum->nombre    = $alumno->nombre;
                        $alum->grupo_id  = $alumno->grupo;
                        $alum->user_id  =  $user->id;
                    }
             }

             echo $i++." ".$alum->nombre." ".$alum->grupo."<br>";

             
               
               }
         });
         
    }

    public function verify()
    {
        $users = User::all();
        foreach ($users as $user) {
            $alumno = Alumno::where('user_id', $user->id)->first();
            if($alumno){
                $alumno->nombre = $user->name;
                $alumno->update();
                echo $alumno->nombre." ".$alumno->grupo['grupo']."<br>";
            }else{
                $alumno = new Alumno;
                $alumno->matricula  = $user->numero;
                $alumno->nombre     = $user->name;
                $alumno->update();
                echo "nuevo--".$alumno->nombre." ".$alumno->grupo['grupo']."<br>";
            }
        }
    }

}
