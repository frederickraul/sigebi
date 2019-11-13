<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
USE App\FirstCategory;
USE App\SecondCategory;
USE App\ThirdCategory;


class ApiCategoriasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function nivel1()
    {
        return FirstCategory::all();
    }

    public function nivel2($id)
    {
        return SecondCategory::where('first_category_id',$id)->get();
    }

    public function nivel3($id)
    {
        return ThirdCategory::where('second_category_id',$id)->get();
    }

}
