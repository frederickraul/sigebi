<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use DataTables;
use App\Book;
use App\Author;
use App\FirstCategory;

class ApiBooksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::OrderBY('clasificacion')->paginate(50);
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
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
        'clasificacion' => 'required|unique:books',
        'titulo'  => 'required',
        'nivel_1' => 'required',
        'nivel_2' => 'required',
        'nivel_3' => 'required',
    ]);

        return $request;
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

    public function booksList(){
         return DataTables::of(Book::query()->OrderBy('numero','desc')->with('categoria')->with('subcategoria')->with('autor')->with('estado'))->make(true);
    }
}
