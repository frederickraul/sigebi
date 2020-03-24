<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DataTables;
use App\Asignatura;

class AsignaturasController extends Controller
{
    public function list(){
         return DataTables::of(Asignatura::query()->OrderBy('slug','desc'))->make(true);
    }
}
