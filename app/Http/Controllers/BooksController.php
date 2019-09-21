<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use DataTables;
use App\Book;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::OrderBY('clasificacion')->paginate(20);
        return view('books/view', compact('books'));
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

    public function import()
    {
        set_time_limit(0);
        Excel::load('public/book.csv', function($reader) {
 
             foreach ($reader->get() as $book) {
             Book::create([
             'numero'           =>  $book->numero,
             'iniciales'        =>  $book->iniciales,
             'clasificacion'    =>  $book->clasificacion,
             'titulo'           =>  $book->titulo,
             'subtitulo'        =>  $book->subtitulo,
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
         return DataTables::of(Book::query()->with('autor')->with('estado'))->make(true);
    }
}
