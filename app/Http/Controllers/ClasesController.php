<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Auth;
use App\Periodo;
use App\Asignatura;
use App\Clase;

class ClasesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('teacherOnly');
    }
    public function index()
    {
        $asignaturas = Asignatura::OrderBy('slug','asc')->get();
        $asignatura = $asignaturas->first();
        if($asignatura){
            
            }
            else{
                return redirect()->to('catalogos/asignaturas')->with('warning','Registre por lo menos una asignatura antes de registrar una clase.');;
            }

        $periodos = Periodo::OrderBy('year','desc')->OrderBy('semestre','desc')->get();
            $periodo = $periodos->first();
         if($periodo){
            return view('clases/view', compact('periodos','asignaturas','periodo'));
            }
            else{
                return redirect()->to('catalogos/periodos')->with('warning','Registre por lo menos un periodo antes de registrar una clase.');;
            }
        
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
        $profesor = Auth::user()->id; 
        $datos = $request->all();

        $clase = Clase::where("profesor_id", $profesor)
                      ->where("periodo_id", $datos['periodo'])
                      ->where("asignatura_id", $datos['asignatura'])
                      ->first();
       if($clase){
        return redirect()->to('clases')->with('warning','No se puede asignar la misma clase mas de una vez.');
       }
       else{
        $clase = new Clase;
        $clase->periodo_id      = $datos['periodo'];
        $clase->asignatura_id   = $datos['asignatura'];
        $clase->profesor_id     = $profesor;
        if($clase->save()){
            return redirect()->to('clases')->with('success','La clase ha sido asignada.');
        }else{
            return redirect()->to('clases')->with('danger','Hubo un problema.');
        }
       }

    }

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
        $book = Book::where('numero',$id)->firstOrFail();
        if($book->clasificacion == $datos['clasificacion']){
            $request->validate([
            'autor'  => 'required',
            'titulo'  => 'required',
            'nivel_1' => 'required',
            'nivel_2' => 'required',
            'nivel_3' => 'required',
            ]);
        }else{
            $request->validate([
            'clasificacion' => 'unique:books',
            'autor'  => 'required',
            'titulo'  => 'required',
            'nivel_1' => 'required',
            'nivel_2' => 'required',
            'nivel_3' => 'required',
            ]);
        }

        $book->clasificacion = $datos['clasificacion'];
        $book->iniciales     = $datos['iniciales'];
        $book->titulo        = $datos['titulo'];
        $book->subtitulo     = $datos['subtitulo'];
        $book->categoria     = $datos['nivel_2'];
        $book->subcategoria  = $datos['nivel_3'];
        $book->autor         = $datos['autor'];
        $book->paginas       = $datos['paginas'];
        $book->ejemplar      = $datos['ejemplar'];
        $book->volumen       = $datos['volumen'];
        $book->update();
      return redirect()->to('libros/'.$id."/edit")->with('update','Los datos del libro han sido actualizados.');     }

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
