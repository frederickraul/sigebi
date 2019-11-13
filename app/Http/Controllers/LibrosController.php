<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use DataTables;
use App\Book;
use App\Author;
use App\FirstCategory;
use App\SecondCategory;
use App\ThirdCategory;

class LibrosController extends Controller
{
    public function index()
    {
        return view('libros/view');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorias = FirstCategory::all();
        $autores = Author::get();
        return view('libros/add',compact('autores','categorias'));
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
        'clasificacion' => 'unique:books',
        'autor'  => 'required',
        'titulo'  => 'required',
        'nivel_1' => 'required',
        'nivel_2' => 'required',
        'nivel_3' => 'required',
    ]);

        $max = Book::max('numero');
        $numero = $max + 1;
        $book = new Book;
        $book->clasificacion = $datos['clasificacion'];
        $book->numero        = $numero;
        $book->iniciales     = $datos['iniciales'];
        $book->titulo        = $datos['titulo'];
        $book->subtitulo     = $datos['subtitulo'];
        $book->categoria     = $datos['nivel_2'];
        $book->subcategoria  = $datos['nivel_3'];
        $book->autor         = $datos['autor'];
        $book->paginas       = $datos['paginas'];
        $book->ejemplar      = $datos['ejemplar'];
        $book->volumen       = $datos['volumen'];
        $book->estado        = 1;
        $book->save();
        return redirect()->to('libros');
    }

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
        $categorias = FirstCategory::all();
        $autores = Author::get();
        $libro = Book::where('numero',$id)->firstOrFail();
        return view('libros/details',compact('libro','autores','categorias'));

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
        $book = Book::find($id);

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

    public function import()
    {
        set_time_limit(0);
        Excel::load('public/book.csv', function($reader) {
 
             foreach ($reader->get() as $book) {
            $categoria = 0;
            $value = substr($book->clasificacion, 0, 3); 
            $subcategoria = (int)$value;
            if($subcategoria == 0){
                $subcategoria =1;
            }
            else if($subcategoria%10 == 0){
                $categoria = $subcategoria;
                $subcategoria++;
            }
            else if($subcategoria > 10)  {
                $res = $subcategoria%10;
                $categoria = $subcategoria - $res;
            }
             Book::create([
             'numero'           =>  $book->numero,
             'iniciales'        =>  $book->iniciales,
             'clasificacion'    =>  $book->clasificacion,
             'titulo'           =>  $book->titulo,
             'subtitulo'        =>  $book->subtitulo,
             'categoria'        =>  $categoria,
             'subcategoria'     =>  $subcategoria,
             'paginas'          =>  $book->paginas,
             'autor'            =>  $book->autor,
             'ejemplar'         =>  $book->ejemplar,
             'volumen'          =>  $book->volumen,
             'estado'           =>   1
             ]);
               }
         });
         return Book::all();
    }
}
