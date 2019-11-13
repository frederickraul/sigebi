<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Book;
use App\FirstCategory;
use App\SecondCategory;
use App\ThirdCategory;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    { 
         $cont = 1; 
        
        $books = Book::OrderBy('numero')->get();
        foreach ($books as $key => $book) {
            if($book->numero != $cont){
            echo $book->numero." - ".$cont; 
            echo "<br>";
            $cont = $book->numero;
            }
        $cont++;
            }
    }

    public function category1Import()
    {
        set_time_limit(0);
        Excel::load('public/FirstCategory.csv', function($reader) {
 
             foreach ($reader->get() as $category) {

             FirstCategory::create([
             'id'           =>      $category->id,
             'concepto'        =>  $category->concepto,
             ]);
               }
         });
         return FirstCategory::all();
    }    

    public function category2Import()
    {
        set_time_limit(0);
        Excel::load('public/SecondCategory.csv', function($reader) {
 
             foreach ($reader->get() as $category) {

             SecondCategory::create([
             'id'           =>      $category->id,
             'concepto'        =>  $category->concepto,
             'first_category_id'        =>  $category->first_category_id,
             ]);
               }
         });
         return SecondCategory::all();
    }

    public function category3Import()
    {
        set_time_limit(0);
        Excel::load('public/ThirdCategory.csv', function($reader) {
 
             foreach ($reader->get() as $category) {

             ThirdCategory::create([
             'id'               =>      $category->id,
             'concepto'         =>      $category->concepto,
             'second_category_id'        =>  $category->second_category_id,
             ]);
               }
         });
         return ThirdCategory::all();
    }
}
