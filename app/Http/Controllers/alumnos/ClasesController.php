<?php

namespace App\Http\Controllers\Alumnos;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Auth;
use App\Periodo;
use App\Asignatura;
use App\Clase;
use App\Tema;
use App\Chat;

class ClasesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('studentOnly');
    }

    public function index()
    {
        $alumno = Auth::user()->alumno;
        if(!$alumno){
            return redirect()->to('a/alumno'); 
        }
        
        $aulas = $alumno->grupo->aulas;

        return view('a.clases.view', compact('aulas'));
           
        
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
        return view('a.clases.details', compact('clase', 'temas','messages','last'));
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
